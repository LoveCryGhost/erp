# -*- coding: utf-8 -*-
# coding=utf-8

import mysql.connector
import requests
from datetime import datetime

import sys

reload(sys)
sys.setdefaultencoding('utf-8')


# 取得股票資訊
def crawl_tw_stock_daily_price(date):
    datestr = date.strftime('%Y%m%d')
    # 從網站上依照 datestr 將指定日期的股價抓下來
    return requests.get(
        'https://www.twse.com.tw/exchangeReport/MI_INDEX?response=json&date=' + datestr + '&type=ALLBUT0999')


# 處理每日資料
def handle_data(stock):
    _list = [2, 3, 4, 5, 6, 7, 8, 11, 12, 13, 14]
    for i in _list:
        stock[i] = stock[i].replace(',', '')
        if stock[i] == "--":
            stock[i] = 0
    return stock


# 主程式
if __name__ == '__main__':
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="root",
        database="mherp",
        port="3306",
        unix_socket='/Applications/MAMP/tmp/mysql/mysql.sock'
    )
    mycursor = mydb.cursor()
    resp = crawl_tw_stock_daily_price(datetime(2018, 1, 2))

    stocks_records = []
    for stock in resp.json()['data9']:
        stock = handle_data(stock)

        stocks_records.append([
            datetime(2018, 1, 2).strftime('%Y-%m-%d'),
            stock[0],  # stock_code
            stock[1],  # name
            stock[2],  # volume
            stock[3],  # records
            stock[4],  # amount

            stock[5],  # price_start
            stock[6],  # price_top
            stock[7],  # price_low
            stock[8],  # price_close

            stock[11],  # last_bid_buy_price
            stock[12],  # last_bid_buy_records
            stock[13],  # last_bid_sell_price
            stock[14],  # last_bid_sell_records

            'stock',  # type
            'tw',  # local
        ])

    sql_insert_query = """INSERT INTO stocks(
                            date, stock_code, name, volume, records, amount,
                            price_start, price_top, price_low, price_close,
                            last_bid_buy_price, last_bid_buy_records, last_bid_sell_price, last_bid_sell_records,
                            type, local)
                            VALUES(%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
                            ON DUPLICATE KEY UPDATE
                            date = VALUES(date),
                            stock_code = VALUES(stock_code),
                            type = VALUES(type),
                            local = VALUES(local)
                            """
    mycursor.executemany(sql_insert_query, stocks_records)
    mydb.commit()
