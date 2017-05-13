import sys
import urllib.parse
url_key_word=sys.argv[1]
chinese_key_word=urllib.parse.unquote(url_key_word)
vocabulary={chinese_key_word}
insert=chinese_key_word+'\n'
dictionary=[]
with open('C://xampp/htdocs/project/python/userdict.txt','r+',encoding='UTF-8') as dict:
    for line in dict:
        dictionary.append(line.strip('\ufeff').strip())
    dictset=set(dictionary)
    intersection=vocabulary.intersection(dictset)
    if len(intersection)==0:
        dict.write(insert)
    
 