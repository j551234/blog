import MySQLdb
import sys
import requests
import urllib.parse
from bs4 import BeautifulSoup


conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()

sqli = "insert into indexpixnet (tag,search_title,search_author,search_href,article_picture) values (%s,%s,%s,%s,%s)" #選擇資料表


for  x  in range(1,11) : 

    res=requests.get('https://www.pixnet.net/blog/articles/group/3/hot/'+repr (x))
    res.encoding='utf-8'
    soup = BeautifulSoup (res.text, "html5lib")

    if x == 1:
        for content in soup.select("#content"):    
                for rank in content.select(".featured"):        
                    for author in rank.select('.author'):
                        #作者
                        AUTHOR = author.text

                    for title in rank.select('h3'):
                        #標題
                        TITLE = title.text

                        #網址
                        HREF = title.find('a')['href']                    

                    for picture in rank.select('.thumb'):
                        #圖片
                        PICTURE =  picture['src'].strip('amp;')

                        cur.execute(sqli,("food",TITLE, AUTHOR, HREF, PICTURE)) #存入資料庫    


        for content in soup.select("#content"):
            for  y  in range(2,11) : 
                for rank in content.select(".rank-"+repr (y)):        
                    for author in rank.select('.author'):
                        #作者
                        AUTHOR = author.text

                    for title in rank.select('h3'):
                        #標題
                        TITLE = title.text

                        #網址
                        HREF = title.find('a')['href']

                    for picture in rank.select('.thumb'):
                        #圖片
                        PICTURE =  picture['src'].strip('amp;')

                        cur.execute(sqli,("food",TITLE, AUTHOR, HREF, PICTURE)) #存入資料庫    


    else:
        for content in soup.select("#content"):
            for  y  in range(x*10-10,x*10+1) : 
                for rank in content.select(".rank-"+repr (y)):        
                    for author in rank.select('.author'):
                        #作者
                        AUTHOR = author.text

                    for title in rank.select('h3'):
                        #標題
                        TITLE = title.text

                        #網址
                        HREF = title.find('a')['href']


                    for picture in rank.select('.thumb'):
                        #圖片
                        PICTURE =  picture['src'].strip('amp;')

                        cur.execute(sqli,("food",TITLE, AUTHOR, HREF, PICTURE)) #存入資料庫 
                    
cur.close() #斷開連結
conn.commit()
conn.close()
            

            
    






       

    
        