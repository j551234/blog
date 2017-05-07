import MySQLdb
import requests
import urllib.parse
import time
import sys
from bs4 import BeautifulSoup
from selenium import webdriver


conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor() 

Google_url='https://www.google.com/'
mobile01_url='https://www.mobile01.com/'


url_key_word=sys.argv[1]
chinese_key_word=urllib.parse.unquote(url_key_word)
print (url_key_word)
sqli = "insert into mobile01 (key_word,search_title,search_href,search_time,search_author,article_picture,author_href,search_view) values (%s,%s,%s,%s,%s,%s,%s,%s)" #選擇資料表

#driver=webdriver.Chrome(executable_path=r'C:/Users/user/MingChien/chromedriver') #模擬瀏覽器
driver=webdriver.PhantomJS(executable_path=r'C:/xampp/htdocs/project/python/phantomjs-2.1.1-windows/bin/phantomjs.exe')
driver.maximize_window()
payload={'q':url_key_word,'site':'site:https://www.mobile01.com/'}
url='https://google.com.tw/search?q='+payload['q']+'+'+payload['site']
driver.get(url)



for change in range(2,5):
    pageSource = driver.page_source #重新讀取當前頁面
    soup = BeautifulSoup (pageSource, "lxml") #流入BeautifulSoup

    for link in soup.select('.r'):
        
        #ChromeDriver
        #search_href=link.find('a')['href']
        
        #PhantomJS
        search_href=Google_url + link.find('a')['href']
        res=requests.get(search_href)
        res.encoding='utf-8'
        soup2 = BeautifulSoup (res.text, "lxml")
        for Main_article in soup2.find_all('main'):

            #ChromeDriver
            #href_split=search_href.split('%')
            #if href_split[0]=='https://www.mobile01.com/topicdetail.php':
            #
            #PhantomJS
            href_split=search_href.split('%')
            if href_split[0]=='https://www.google.com//url?q=https://www.mobile01.com/topicdetail.php':
                #標題
                search_title=Main_article.select('.topic')[0].text
                #作者、作者網址
                authors = Main_article.select('.inner')
                author_name = authors[0].select('.fn')
                search_author=author_name[0].find('a').text
                author_href=mobile01_url+author_name[0].find('a')['href']
                
                #人氣
                info=authors[0].select('.info')
                search_view=info[0].text.strip('文章人氣:').lstrip().replace(',','')
                #文章時間
                time1=authors[0].select('.date')
                search_time=time1[0].text.strip('#1')
                #文章圖片
                post = Main_article.select('.single-post-content')
                if post[0].find('img')!=None:
                    picture=post[0].find('img')['src'].strip()
                    split=picture.split('/')
                    if split[2]=='attach.mobile01.com':
                        article_picture='https:'+picture
                    elif split[2]=='download.mobile01.com':
                        article_picture='https:'+picture
                    elif split[2]=='attach2.mobile01.com':
                        article_picture='./img/mobile01.jpg'
                    else:
                        article_picture=picture
                else:
                    article_picture='./img/mobile01.jpg'
                cur.execute(sqli,(chinese_key_word,search_title,search_href,search_time,search_author,article_picture,author_href,search_view)) #存入資料庫    
                conn.commit()
        time.sleep(0.5)

    a=repr(change)
    driver.find_element_by_link_text(a).click() #點擊下一頁

driver.close()
cur.close() #斷開連結
conn.close()
