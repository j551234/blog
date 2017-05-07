#痞客邦PIXNET https://www.pixnet.net/
# -*- coding: UTF-8 -*-

import MySQLdb
import sys
import requests
import urllib.parse
from bs4 import BeautifulSoup

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
#編碼使用
url_key_word = sys.argv[1]
chinese_key_word=urllib.parse.unquote(sys.argv[1])
sqli = "insert into pixnet (key_word,search_title,search_subtitle,article_picture,search_time,search_href,search_author,author_href,author_picture,search_view) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)" #選擇資料表

x = 1
for  x  in range(3*x-2,3*x+1) :    
    payload={'q':url_key_word,'page':x}
    res=requests.get("https://www.pixnet.net/searcharticle",params=payload)
    res.encoding='utf-8'
    soup = BeautifulSoup (res.text, "html5lib")
    for item in soup.select('.search-list'):
        
        #取出標題
        search_title = (item.select('.search-title')[0].text) 

        #取小標題
        search_subtitle=item.select('.search-desc')[0].text.strip('繼續閱讀 »') 
        
        #取出各個網址
        href =item.find('a')['href'] 
        res2=requests.get(href)
        res2.encoding='utf-8'
        soup1 = BeautifulSoup (res2.text, "lxml")
        soup2 =  soup1.select('meta')[1]
        search_href =soup2['content'].lstrip('3;url=')
        
        #取得發表時間
        search_time = item.select('.search-postTime')[0].text
        
        #文章圖片
        href_res=requests.get(search_href)
        href_res.encoding='utf-8'
        soup3 = BeautifulSoup (href_res.text, "html5lib")
        main_article = soup3.select('.article-content-inner')
        article_picture = main_article[0].find('img')['src']
        
        #作者名字
        search_author=item.select('.search-author')[0].text
        
        #作者部落格
        for author in item.select('.search-meta'):
            author_href=author.find('a')['href']
        
        #取出作者圖片
        for src in item.select('.search-avatar'):
            author_picture=item.find('img')['src']
        
        #文章人氣
        search_view= item.select('.search-views')[0].text.strip('人氣( )')

        time.sleep(0.5)

        cur.execute(sqli,(chinese_key_word,search_title, search_subtitle, article_picture, search_time, search_href, search_author, author_href, author_picture,search_view)) #存入資料庫    
        conn.commit()

cur.close() #斷開連結
conn.close()