#PTT批踢踢實業坊 https://www.ptt.cc/
# -*- coding: UTF-8 -*-
import jieba
import jieba.analyse
import MySQLdb
import requests
import time
from bs4 import BeautifulSoup
from selenium import webdriver


jieba.set_dictionary('dict.txt.big')
jieba.load_userdict('userdict.txt')

def remove_values_from_list(the_list, val):
    return [value for value in the_list if value != val]

def get_web_page(url): #原始地址
    time.sleep(0.5)  # 每次爬取前暫停 0.5 秒以免被 PTT 網站判定為大量惡意爬取
    resp = requests.get(
        url=url,
        cookies={'over18': '1'}
    )
    return resp.text


conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
cur.execute("SELECT search_href,id FROM ptt")
results = cur.fetchall()

with open('positive.txt', 'r',encoding='UTF-8') as positive:
    pos=[]
    for line in positive:
        pos.append(line.strip('\ufeff').strip())
    positive.close()

with open('nagative.txt', 'r',encoding='UTF-8') as nagative:
    nag=[]
    for line in nagative:
        nag.append(line.strip('\ufeff').strip())
    nagative.close()

with open('paid news.txt', 'r',encoding='UTF-8') as paidnews:
    paid=[]
    for line in paidnews:
        paid.append(line.strip('\ufeff').strip())
    paidnews.close()
    
print(pos)
print(nag)
print(paid)

pos_set=set(pos)
nag_set=set(nag)
paid_set=set(paid)

# 迴圈撈取資料

for record in results: 
    url = record[0]
    ptt_id = record[1]
    
    print (url)
    soup=BeautifulSoup(get_web_page(url), "lxml")

    article = soup.select('div[id="main-container"]')
    #內文 
    if article!=[]:
        main_article=article[0].text.split("※ 發信站: 批踢踢實業坊(ptt.cc)")
        content=main_article[0].strip()
        sentence=content.split("\n")
        sentence=remove_values_from_list(sentence,'')

        total_pos_count=0
        total_nag_count=0
        total_paid_count=0
        for line in sentence:

            line2=line.strip()
            words=jieba.lcut(line2, cut_all=False)
            words_set = set(words)
            pos_intersection=words_set.intersection(pos_set)
            nag_intersection=words_set.intersection(nag_set)
            paid_intersection=words_set.intersection(paid_set)
            pos_count=len(pos_intersection)
            nag_count=len(nag_intersection)
            paid_count=len(paid_intersection)

        total_pos_count=total_pos_count+pos_count
        total_nag_count=total_nag_count+nag_count
        total_paid_count=total_paid_count+paid_count
        print(total_pos_count)
        print(total_nag_count)
        print(total_paid_count)