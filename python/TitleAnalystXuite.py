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
cur.execute("SELECT search_href,id,search_title FROM xuite WHERE title_analyst='-1'")
results = cur.fetchall()


for record in results: 
    db_url = record[0]
    xuite_id= record[1]
    title=record[2]
    title_list=jieba.lcut(title,cut_all=False)

    res=requests.get(db_url)
    res.encoding='utf-8'
    soup = BeautifulSoup (res.text, "html5lib")
    #內文
    main_article = soup.select('#content_all')   
    sentence=main_article[0].select('span')
    total_count=0
    total_article_count=0
    for line in sentence:

        line2=line.text.strip()
        words=jieba.lcut(line2, cut_all=False)
        s1 = set(title_list)
        s2 = set(words)
        article_count=len(s2)
        total_article_count=total_article_count+article_count
        intersection=s1.intersection(s2)
        count=len(intersection)
        total_count=total_count+count

    if total_article_count==0:
        Title_Analyst = "0"

    else:
        Title_Analyst = format(total_count/total_article_count*100 , '0.2f')

    cur.execute ("UPDATE xuite SET title_analyst=%s WHERE id='%s'" %  (Title_Analyst,xuite_id))
    conn.commit()
    
cur.close()
conn.close()    