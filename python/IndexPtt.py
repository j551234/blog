import MySQLdb
import requests
import time
from bs4 import BeautifulSoup

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
sqli = "insert into indexptt (tag,search_title,search_author,search_href) values (%s,%s,%s,%s)" #選擇資料

def pttcrawler(a,b):
    current_page= PTT_URL +'/bbs/'+a+'/index.html'
    for page in range(1,5):
        print(current_page)
        print(b)
        res=requests.get(current_page)
        res.encoding='utf-8'
        soup=BeautifulSoup(res.text, "lxml")

        topics=soup.select('.r-ent')

        for article in topics:
            if article.find('a'):  # 有超連結，表示文章存在，未被刪除
                judge = article.find('a').text[1]
                for standard in standard_list:
                    if(judge==standard):
                        search_title = article.find('a').text
                        search_href = PTT_URL +article.find('a')['href']
                        search_author=article.select('.author')[0].text
                        cur.execute(sqli,(b,search_title,search_author,search_href)) #存入資料庫
                        conn.commit()

        #翻上一頁
        bar=soup.find('div', 'btn-group btn-group-paging')
        previous_page= PTT_URL+bar.select('a')[1]['href']
        current_page =previous_page

PTT_URL = 'https://www.ptt.cc'
tag_list=['food','dress','travel','digital']
standard_list=['遊','心','推','食','男','女']
food_list=['Food']
dress_list=['Mix_Match']
travel_list=['travel','Hotel','Japan_Travel']
digital_list=['LCD','hardware','Notebook','Storage_Zone','VideoCard','PC_Shopping']

for food in food_list:
    pttcrawler(food,tag_list[0])
for dress in dress_list:
    pttcrawler(dress,tag_list[1])
for travel in travel_list:
    pttcrawler(travel,tag_list[2])
for digital in digital_list:
    pttcrawler(digital,tag_list[3])

cur.close() #斷開連結
conn.close()