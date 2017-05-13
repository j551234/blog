#痞客邦PIXNET https://www.pixnet.net/
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
jieba.load_userdict('userdict.txt')

with open('positive.txt', 'r',encoding='UTF-8') as positive:
    pos=[]
    for line in positive:
        pos.append(line.strip('\ufeff').strip())
    positive.close()

with open('negative.txt', 'r',encoding='UTF-8') as negative:
    neg=[]
    for line in negative:
        neg.append(line.strip('\ufeff').strip())
    negative.close()

with open('paid news.txt', 'r',encoding='UTF-8') as paidnews:
    paid=[]
    for line in paidnews:
        paid.append(line.strip('\ufeff').strip())
    paidnews.close()

pos_set=set(pos)
neg_set=set(neg)
paid_set=set(paid)


conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()

def get ():
    cur.execute("SELECT search_href,id FROM pixnet WHERE content_analyst='-1'")
    results = cur.fetchall()
    return results


def analyst(results):  
    for record in results:    
        db_url = record[0]
        pixnet_id = record[1]
        res=requests.get(db_url)
        res.encoding='utf-8'
        soup = BeautifulSoup (res.text, "lxml")
        # soup2 =  soup.select('meta')[1]

        # original_url =soup2['content'].lstrip('3;url=')


        # res1=requests.get(original_url)
        # res1.encoding='utf-8'
        # soup1 = BeautifulSoup (res1.text, "html5lib")
        #內文
        main_article = soup.select('.article-content-inner') 
        if len(main_article):  

            content=main_article[0].text.strip()
            sentence=content.split("\n")
            sentence=remove_values_from_list(sentence,'')

            total_pos_count=0
            total_neg_count=0
            total_paid_count=0
            for line in sentence:

                line2=line.strip()
                words=jieba.lcut(line2, cut_all=False)
                words_set = set(words)
                pos_intersection=words_set.intersection(pos_set)
                neg_intersection=words_set.intersection(neg_set)
                paid_intersection=words_set.intersection(paid_set)
                pos_count=len(pos_intersection)
                neg_count=len(neg_intersection)
                paid_count=len(paid_intersection)

                total_pos_count=total_pos_count+pos_count
                total_neg_count=total_neg_count+neg_count
                total_paid_count=total_paid_count+paid_count
            total_count = total_pos_count+total_neg_count+total_paid_count

            
            if total_count==0:
                Content_Analyst = "0"

            else:
                Content_Analyst = format(total_pos_count/total_count*100 , '0.2f')
            print (pixnet_id)
            print (Content_Analyst)
            cur.execute ("UPDATE pixnet SET content_analyst=%s WHERE id='%s'" %  (Content_Analyst,pixnet_id))
            conn.commit()
        else :
            cur.execute ("DELETE FROM pixnet WHERE id='%s'" %  (pixnet_id))
            conn.commit()

result=get()
print (len(result))
while(len(result)!=0):
    analyst(result)
    result=get()
    print(len(result))

cur.close()
conn.close()