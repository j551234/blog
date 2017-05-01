import MySQLdb
import requests
import time
from bs4 import BeautifulSoup

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
sqli = "insert into indexptt (tag,search_title,search_author,search_href) values (%s,%s,%s,%s)" #選擇資料


PTT_URL = 'https://www.ptt.cc'
#旅遊
#current_page = PTT_URL + '/bbs/travel/index.html'
#食物
#current_page = PTT_URL + '/bbs/Food/index.html'
#DigitalLife
#current_page = PTT_URL + '/bbs//index.html'
#穿搭
#current_page = PTT_URL + '/bbs/Mix_Match/index.html'
tag_split=current_page.split('/')


for page in range(1,5):
    print(current_page)
    res=requests.get(current_page)
    res.encoding='utf-8'
    soup=BeautifulSoup(res.text, "lxml")
    
    topics=soup.select('.r-ent')

    for article in topics:
        if article.find('a'):  # 有超連結，表示文章存在，未被刪除
            search_href = PTT_URL +article.find('a')['href']
            search_title = article.find('a').text
            search_author=article.select('.author')[0].text
            print(search_title)
            #print(search_href)
            #print(search_author)
            cur.execute(sqli,(tag_split[4],search_title,search_author,search_href)) #存入資料庫    
            conn.commit()

    #翻上一頁
    bar=soup.find('div', 'btn-group btn-group-paging')
    previous_page= PTT_URL+bar.select('a')[1]['href']
    current_page =previous_page
    
    
    
cur.close() #斷開連結
conn.close()