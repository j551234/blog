import jieba
import MySQLdb
import requests
import time
from bs4 import BeautifulSoup
from selenium import webdriver

def remove_values_from_list(the_list, val):
    return [value for value in the_list if value != val]

jieba.set_dictionary('dict.txt.big')
jieba.load_userdict('userdict.txt')

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor() 
cur.execute("SELECT search_href,id FROM mobile01 WHERE content_analyst='-1'")
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
    

pos_set=set(pos)
nag_set=set(nag)
paid_set=set(paid)

for record in results: 
    db_url = record[0]
    mobile01_id= record[1]
    print (db_url)
    
    res=requests.get(db_url)
    res.encoding='utf-8'
    soup = BeautifulSoup (res.text, "html5lib")
    main_article=soup.select('.single-post-content')
    content=main_article[0].text.strip()
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
    total_count = total_pos_count+total_nag_count+total_paid_count


    if total_count==0:
        Content_Analyst = "0"

    else:
        Content_Analyst = format(total_pos_count/total_count*100 , '0.2f')

    print(Content_Analyst)
    cur.execute ("UPDATE mobile01 SET content_analyst=%s WHERE id='%s'" %  (Content_Analyst,mobile01_id))
    conn.commit()
    time.sleep(0.5)
    
cur.close() #斷開連結
conn.close()
