# -*- coding: utf-8 -*-
# coding=utf-8

import sys

import mysql.connector
import requests
from bs4 import BeautifulSoup as bs

from mydb import mysql_select

reload(sys)
sys.setdefaultencoding('utf-8')

def shopeeSeperator(countryCode):
    if countryCode=="tw":
        return 'shopee.tw'

    elif countryCode=="id":
        return 'shopee.co.id'

    elif countryCode=="th":
        return 'shopee.co.th'


conn = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="root",
        database="mherp",
        unix_socket='/Applications/MAMP/tmp/mysql/mysql.sock'
    )
mycursor = conn.cursor(dictionary=True)
sqlStatement = "SELECT * from crawler_categories where updated_at is NULL and p_id=0"
mycursor = mysql_select(mycursor, sqlStatement);


# 讀取資料
crawlerCategories = mycursor.fetchall()
for crawlerCategory in crawlerCategories:
    # 組合url
    shopee_url = shopeeSeperator(crawlerCategory['local'])
    url = 'https://'+shopee_url+'/Category-cat.' + str(crawlerCategory['catid'])
    # 爬蟲
    result = requests.get(url)
    soup = bs(result.text, "html.parser")
    print(url)
    print(soup)
    exit()
