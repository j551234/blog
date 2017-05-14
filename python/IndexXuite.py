#隨意窩Xuite:http://www.a.blog.xuite.net/new_index.php
# -*- coding: UTF-8 -*-

import time
import MySQLdb
import requests
from bs4 import BeautifulSoup

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
sqli = "insert into indexxuite (tag,search_title,search_author,search_href,article_picture) values (%s,%s,%s,%s,%s)" #選擇資料表

#刪除資料庫
deletespli = "truncate table indexxuite"
cur.execute(deletespli) 
conn.commit()

tag_list=['food','travel']
url_list=[15,17]


for topic in range(0,2):
    
    for page in range(1,6):
        url='http://www.a.blog.xuite.net/new_index.php?type=put_list_roller&tag_id='+repr(url_list[topic])+'&p='+repr(page)
        print(url)
        res=requests.get(url)
        res.encoding='utf-8'
        soup=BeautifulSoup (res.text,"lxml")

        for imgs in soup.select('.p1'):
            #文章圖片
            article_picture=imgs.find('img').get('src')
            #網址
            search_href=imgs.find('a').get('href')
            res2=requests.get(search_href)
            res2.encoding='utf-8'
            soup2=BeautifulSoup (res2.text,"lxml")
            article= soup2.select('.ArticleContent')
            #標題
            search_title=article[0].select('.titlename')[0].text
            hrefsplit=search_href.split('/')
            #作者
            search_author=hrefsplit[3]
            #作者網址
            #author_href='http://xuite.net/'+search_author
            cur.execute(sqli,(tag_list[topic],search_title,search_author,search_href,article_picture)) #存入資料庫    
            conn.commit()
            time.sleep(0.5)
           

cur.close() #斷開連結
conn.close()    
