#隨意窩Xuite:https://blog.xuite.net/
# -*- coding: UTF-8 -*-

import requests
import MySQLdb
from bs4 import BeautifulSoup
import jieba
import jieba.analyse

def remove_values_from_list(the_list, val):
    return [value for value in the_list if value != val]

def get_web_page(url): #原始地址
    time.sleep(0.5)  # 每次爬取前暫停 0.5 秒以免被 PTT 網站判定為大量惡意爬取
    resp = requests.get(
        url=url,
        cookies={'over18': '1'}
    )
    return resp.text

jieba.set_dictionary('dict.txt.big')

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
cur.execute("SELECT search_href,id FROM xuite")
results = cur.fetchall()

with open('list.txt', 'r',encoding='UTF-8') as list:
    list1=[]
    for line in list:
        list1.append(line.strip('\ufeff').strip())
    list.close()

for record in results: 
    db_url = record[0]
    xuite_id= record[1]

    print (db_url)

    res=requests.get(db_url)
    res.encoding='utf-8'
    soup = BeautifulSoup (res.text, "html5lib")
    #內文
    main_article = soup.select('#content_all')   
    sentence=main_article[0].select('span')
    total_count=0
    for line in sentence:

        line2=line.text.strip()
        words=jieba.lcut(line2, cut_all=False)
        s1 = set(list1)
        s2 = set(words)
        intersection=s1.intersection(s2)
        count=len(intersection)
        total_count=total_count+count
    print(total_count)