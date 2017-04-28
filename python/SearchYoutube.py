#youtube
import re
import requests
import urllib.parse
import MySQLdb
import sys
from bs4 import BeautifulSoup
from selenium import webdriver
requests.packages.urllib3.disable_warnings()
#編碼使用
url_key_word = sys.argv[1]
chinese_key_word=urllib.parse.unquote(sys.argv[1])

url = "https://www.youtube.com/results?search_query=" + chinese_key_word
res = requests.get(url, verify = False)
soup = BeautifulSoup (res.text, "html5lib")
last = None

conn = MySQLdb.connect(host="localhost", user="root", passwd="", db="python",charset='utf8')#連結資料庫
cur = conn.cursor()
sqli = "insert into youtube (key_word,search_title,search_subtitle,search_href,author_href,search_author,search_time,article_picture,push_count,boo_count) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)" #選擇資料表


for change in range(1,2):
    for entry in soup.select('a'):

        m = re.search("v=(.*)",entry['href'])
        if m:        

            target = m.group(1)
            if target == last:
                continue
            if re.search("list",target):
                continue
            last = target
            #網址
            search_href = ("https://www.youtube.com/watch?v="+target)
            EachRes = requests.get(search_href, verify = False)
            EachPage = BeautifulSoup (EachRes.text, "lxml")
            
            #標題
            title = EachPage.select('span[class="watch-title"]')
            search_title =  title[0].text.strip()
            
            #作者網址
            author = EachPage.select('a[class="g-hovercard yt-uix-sessionlink spf-link "]')
            a =  author[0]
            author_href = "https://www.youtube.com"+a['href']
            
            #作者
            search_author =  author[0].text
            
            #時間
            time = EachPage.select('strong[class="watch-time-text"]')
            search_time =  time[0].text.replace('發佈日期：','')

            #觀看次數
            views=EachPage.select('div[class="watch-view-count"]')
            search_view = views[0].text.replace('觀看次數：','')
            
            #推噓
            for LikeButton in EachPage.select('span[class="like-button-renderer "]'):
                PushBoo = LikeButton.select('span[class="yt-uix-button-content"]')
                if  (PushBoo[0].text=='登入'):
                    push_count=0
                    boo_count=0
                    
                else:
                    push_count=(PushBoo[0].text)
                    boo_count=(PushBoo[3].text)
                    
            #描述取出
            #目前無法克服網址問題
            
            description=EachPage.select('p[id="eow-description"]')
            search_subtitle = description[0].text          
            '''
            #取出網址部分的程式碼
            if (description[0].select('a[class="yt-uix-servicelink "]')):
                for WebHref in description[0].select('a[class="yt-uix-servicelink "]'):
                    print(WebHref['href'])
            if (description[0].select('a[class="yt-uix-sessionlink "]')):
                for YoutubeHref in description[0].select('a[class="yt-uix-sessionlink "]'):
                    print(YoutubeHref['href'])
            '''
            #圖片
            article_picture =  "http://i.ytimg.com/vi/"+ target + "/0.jpg"
            
            cur.execute(sqli,(chinese_key_word,search_title,search_subtitle,search_href,author_href,search_author,search_time,article_picture,push_count,boo_count)) #存入資料庫    
            conn.commit()
            
        n = re.search("sp=S(.*)",entry['href'])
        
        if n:
            target = n.group(1)
            if target == last:
                continue
            if re.search("list",target):
                continue
            last = target
        
    
    url=("https://www.youtube.com/results?search_query=" + chinese_key_word +"&sp=S" + target )

    res = requests.get(url, verify = False)
    soup = BeautifulSoup (res.text, "lxml")
    last = None

cur.close() #斷開連結
conn.close()
    
