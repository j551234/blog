import MySQLdb
import requests
import urllib.parse
import time
from bs4 import BeautifulSoup
from selenium import webdriver

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
sqli = "insert into indexmobile01 (tag,search_title,search_author,search_href,article_picture) values (%s,%s,%s,%s,%s)" #選擇資料表

def Mobile01crawler(a,b):
        url=a
        print(url)
        res=requests.get(url)
        res.encoding='utf-8'
        soup=BeautifulSoup (res.text,"lxml")
        # 頭條
        # 網址
        firstnews=soup.select('#headline')
        search_href=mobile01_url+firstnews[0].find('a')['href']
        print(search_href)
        # 標題
        search_title=firstnews[0].find('a')['title']
        print(search_title)
        # 圖片
        article_picture='https:'+firstnews[0].find('img')['src']
        # 作者
        res2=requests.get(search_href)
        res2.encoding='utf-8'
        soup2=BeautifulSoup (res2.text,"lxml")
        
        href_split=search_href.split('?')
        if href_split[0]=='https://www.mobile01.com/waypointtopicdetail.php':
            author_name = soup2.select('.fn')
            search_author=author_name[0].find('a').text
        else:
            author=soup2.select('.sidebar-authur')
            search_author=author[0].text.strip().lstrip('本文作者').strip().lstrip('無圖示')
        cur.execute(sqli,(b,search_title,search_author,search_href,article_picture)) #存入資料庫    
        conn.commit()

        for item in soup.select('.item'):
            for article in item.find_all('a'):
                #網址
                search_href=mobile01_url+article['href']
                print(search_href)
                #標題
                search_title=article.find('img')['alt']
                print(search_title)
                #圖片
                article_picture='https:'+article.find('img')['src']
                #作者
                res2=requests.get(search_href)
                res2.encoding='utf-8'
                soup2=BeautifulSoup (res2.text,"lxml")
                
                href_split=search_href.split('?')
                if href_split[0]=='https://www.mobile01.com/waypointtopicdetail.php':
                    author_name = soup2.select('.fn')
                    search_author=author_name[0].find('a').text
                else:
                    author=soup2.select('.sidebar-authur')
                    search_author=author[0].text.strip().lstrip('本文作者').strip().lstrip('無圖示')
                cur.execute(sqli,(b,search_title,search_author,search_href,article_picture)) #存入資料庫    
                conn.commit()
                time.sleep(0.5)


tag_list=['food','travel','dress','digital']
food_list=['https://www.mobile01.com/waypoint.php']
travel_list=['https://www.mobile01.com/waypoint.php']
dress_list=['https://www.mobile01.com/category.php?id=17']
digital_list=['https://www.mobile01.com/category.php?id=3','https://www.mobile01.com/category.php?id=2','https://www.mobile01.com/category.php?id=4','https://www.mobile01.com/category.php?id=5']

mobile01_url='https://www.mobile01.com/'

for food in food_list:
    Mobile01crawler(food,tag_list[0])
for dress in dress_list:
    Mobile01crawler(dress,tag_list[2])
for digital in digital_list:
    Mobile01crawler(digital,tag_list[3])
    


cur.close() #斷開連結
conn.close()