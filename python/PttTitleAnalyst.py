#PTT批踢踢實業坊 https://www.ptt.cc/
# -*- coding: UTF-8 -*-
import jieba
import jieba.analyse
import MySQLdb
import requests
import time
from bs4 import BeautifulSoup
from selenium import webdriver

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
cur.execute("SELECT search_href,id,search_title FROM ptt")
results = cur.fetchall()


    


# 迴圈撈取資料

for record in results: 
    url = record[0]
    ptt_id = record[1]
    title=record[2]
    title_list=jieba.lcut(title,cut_all=False)
    
    print(title_list)
    print (url)
    soup=BeautifulSoup(get_web_page(url), "lxml")

    article = soup.select('div[id="main-container"]')
    #內文 
    if article!=[]:
        
        main_article=article[0].text.split("※ 發信站: 批踢踢實業坊(ptt.cc)")
        content=main_article[0].strip()
        sentence=content.split("\n")
        sentence=remove_values_from_list(sentence,'')
        title_count=len(title_list)
        total_count=0
        total_article_count=0
        for line in sentence:
            words=jieba.lcut(line, cut_all=False)
            s1 = set(title_list)
            s2 = set(words)
            article_count=len(s2)
            total_article_count=total_article_count+article_count
            intersection=s1.intersection(s2)
            count=len(intersection)
            total_count=total_count+count
        total_count=total_count-title_count
        print(total_article_count)
        print(total_count)
        print(format(total_count/total_article_count,'0.1%'))