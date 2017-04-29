#xuite
import MySQLdb
import sys
import requests
import urllib.parse
from bs4 import BeautifulSoup

#編碼使用




url_key_word = sys.argv[1]
chinese_key_word=urllib.parse.unquote(sys.argv[1])

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
sqli = "insert into xuite (key_word,search_title,search_subtitle,article_picture,search_href,search_author,author_href) values (%s,%s,%s,%s,%s,%s,%s)" #選擇資料表

page = '1'
payload={'type' : 'search','query':url_key_word, 'database':'haarticle','sort':'','p':page  }
res=requests.get("http://blog.xuite.net/new_index.php?",params=payload)
res.encoding='utf-8'
soup = BeautifulSoup (res.text, "html5lib")


for item in soup.select('div[class="n"]'):

#標題
    search_title = item.select('a')[2].text
    print (search_title)
    
#副標題
    search_subtitle = item.select('div[class="after_m_des"]')[0].text
    print (search_subtitle)
    
#網址
    search_href = item.find('a')['href']
    print (search_href)
    
#圖片    
    for img in item.select('div[class="after_m_photo"]'):
        article_picture = img.find('img')['src']
        print (article_picture)
        
#作者    
    search_author = item.select('div[class="after_r_id"]')[0].text
    print (search_author)
    
#作者網址
    for autor in item.select('div[class="after_r_id"]'):
        author_href = autor.find('a')['href']
        print (author_href)
        cur.execute(sqli,(chinese_key_word,search_title, search_subtitle, article_picture, search_href, search_author, author_href)) #存入資料庫    
        conn.commit()

cur.close() #斷開連結
conn.close()

   