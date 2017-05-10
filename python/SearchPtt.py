#PTT批踢踢實業坊 https://www.ptt.cc/
# -*- coding: UTF-8 -*-

import MySQLdb
import requests
import sys
import time
import urllib.parse
from bs4 import BeautifulSoup
from selenium import webdriver
import os



def get_web_page(url): #原始地址
    time.sleep(0.5)  # 每次爬取前暫停 0.5 秒以免被 PTT 網站判定為大量惡意爬取
    resp = requests.get(
        url=url,
        cookies={'over18': '1'}
    )
    #if resp.status_code != 200:
    #    print('Invalid url:', resp.url)
    #    return None
    #else:
    return resp.text

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()



#編碼使用


url_key_word = sys.argv[1]
chinese_key_word=urllib.parse.unquote(url_key_word)
sqli = "insert into ptt (key_word,search_title,search_href,search_board,search_time,search_author,push_count,boo_count,arrow_count) values (%s,%s,%s,%s,%s,%s,%s,%s,%s)" #選擇資料表

#driver=webdriver.Chrome(executable_path=r'C:/Users/user/MingChien/chromedriver') #模擬瀏覽器
driver=webdriver.PhantomJS(executable_path=r'C:/xampp/htdocs/project/python/phantomjs-2.1.1-windows/bin/phantomjs.exe')
driver.maximize_window()


payload={'q':url_key_word,'site':'site:https://www.ptt.cc/'}
url='https://google.com.tw/search?q='+payload['q']+'+'+payload['site']

print(url)

driver.get(url)


#由於翻頁功能因此for迴圈從2開始執行

for change in range(2,3):
    
    pageSource = driver.page_source #重新讀取當前頁面
    soup = BeautifulSoup (pageSource, "lxml") #流入BeautifulSoup

    
    for object in soup.select('div.g'):
        for link in object.find_all('cite'):
            search_href=link.text
            #文章基本資料處理
            soup2=BeautifulSoup(get_web_page(search_href), "lxml")
            data =soup2.select('span[class="article-meta-value"]')
            if data!=[]:
                if len(data)==3:
                    data.insert(1,'unknown')
                    search_board=data[1]
                else:
                    search_board=data[1].get_text()
                
                search_author=data[0].get_text()
                search_title=data[2].get_text()
                search_time=data[3].get_text()
                
                
                #推噓箭頭處理
                push_count=0
                boo_count=0
                arrow_count=0
                for PushTag in soup2.select('span[class="hl push-tag"]'):
                    push_count+=1
                for RedTag in soup2.select('span[class="f1 hl push-tag"]'):
                    if RedTag.text.strip()=='噓':
                        boo_count+=1 
                    else:
                        arrow_count+=1    

                cur.execute(sqli,(chinese_key_word,search_title,search_href,search_board,search_time,search_author,push_count,boo_count,arrow_count)) #存入資料庫
                conn.commit()
    a=repr(change)
    driver.find_element_by_link_text(a).click() #點擊下一頁


driver.close()
cur.close() #斷開連結
conn.close()

