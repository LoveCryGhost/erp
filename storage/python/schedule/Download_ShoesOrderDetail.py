# -*- coding: utf-8 -*-
# coding=utf-8

# 載入
from datetime import date, timedelta

import requests
from bs4 import BeautifulSoup as bs
import sys
import mysql.connector
import time
import xlrd
import re
import os

# 系統語言設定
reload(sys)
sys.setdefaultencoding('utf8')

# 紀錄時間
def time_count(case, start,end):
    print(case + " time:%f second" % (end - start))

# 連接資料庫
def sql_connector():
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        passwd="root",
        database="mherp",
        unix_socket="/tmp/mysql.sock"
    )
    return mydb

# 寫進資料庫
def sql_insert(param):
    mydb = sql_connector()
    mycursor = mydb.cursor()
    mycursor.execute("""
        CREATE TABLE IF NOT EXISTS mh_shoes_db(
        id int unsigned not null primary key AUTO_INCREMENT,
        mh_order_code varchar(32),
        customer_name varchar(32),
        c_purchase_code varchar(32),
        c_order_code varchar(32),
        c_model_type varchar(32),
        model_name varchar(32),
        qty varchar(32),
        color varchar(32),
        received_at varchar(32),
        sizes text,
        note varchar(332)
        );""")
    mydb.commit()

    sql_insert_query = "INSERT INTO mh_shoes_db(mh_order_code,customer_name,c_purchase_code,c_order_code,c_model_type,model_name,qty,color,received_at,sizes,note) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
    mycursor.executemany(sql_insert_query, param)
    mydb.commit()

# 登入
def login():
    global session_requests
    LOGIN_URL = "http://221.4.133.66:8086/SRDD_SHOES/InfoLogin.aspx"
    result = session_requests.get(LOGIN_URL)
    soup = bs(result.text, "html.parser")

    payload = {
        '__LASTFOCUS': '',
        '__EVENTTARGET': '',
        '__EVENTARGUMENT': '',
        '__VIEWSTATE': soup.find('input', id='__VIEWSTATE')["value"],
        '__VIEWSTATEGENERATOR': soup.find('input', id='__VIEWSTATEGENERATOR')["value"],
        '__EVENTVALIDATION': soup.find('input', id='__EVENTVALIDATION')["value"],
        'txtUserName': 'Andy',
        'txtPassword': '1234567890',
        'ddlLanguage': 'chs',
        'OKButton': 'login',
    }

    session_requests.post(LOGIN_URL, data = payload, headers = '')

# 取得下載 ControlID
def get_ControlID(start_date, end_date):
    global session_requests
    INDEX_URL = "http://221.4.133.66:8086/SRDD_SHOES/HL_SHOE/DDZL_Report.aspx?ItemParam="
    result = session_requests.get(INDEX_URL)
    soup = bs(result.text, "html.parser")

    payload = {
        "__EVENTTARGET": "",
        "__EVENTARGUMENT": "",
        "__VIEWSTATE": soup.find("input", id="__VIEWSTATE")["value"],
        "__VIEWSTATEGENERATOR": soup.find("input", id="__VIEWSTATEGENERATOR")["value"],
        "__EVENTVALIDATION": soup.find("input", id="__EVENTVALIDATION")["value"],
        "search": "查询",
        "txtZLBH_S": "",
        "ddlDDLX": "鞋墊",
        "jhrq": "",
        "jdrq": start_date,
        "txtCPMC": "",
        "txtKHDDH": "",
        "txtuserid": "Andy",
        "ddlHPLB": "",
        "ddlGSBH": "M",
        "jhrz": "",
        "jdrz": end_date,
        "txtKHCGDH": "",
        "txtKHXTBH": "",
        "ddlDDLB": "",
        "txtXTBH_S": "",
        "txtKHJC_S": "",
        "txtKHWLBH": "",
        "rblCHZT": 1,
        "rblDDZT": 1
    }
    result = session_requests.post(INDEX_URL, data = payload, headers = '')
    INDEX_URL = "http://221.4.133.66:8086/SRDD_ReportCenter/WebUI/BuildReport.aspx?ReportName=DDZL_Search1&Language=CHS&IsPreview=1&fLoginUser=Andy&form=DDZL_Report&ZLBHM=&KHJC=&DDLXMC=&GSBH=M&HPLB=&DDLB=&JHRQ_Begin=&JHRQ_End=&JDRQ_Begin=" + start_date + "&JDRQ_End="+end_date+"&CPMC=&KHCGDH=&DDBH=&XTBH=&KHWLBH=&CHZT=1&DDZT=1"
    result = session_requests.get(INDEX_URL)

    ControlID = re.search('ControlID=(.*)\\u0026Mode=true",',result.text).group(0).replace("ControlID=", "").replace('\u0026Mode=true",', "")
    return ControlID

# 下載Excel
def get_excel(ControlID, xls_path):
    global session_requests
    result = session_requests.get("http://221.4.133.66:8086/SRDD_ReportCenter/Reserved.ReportViewerWebControl.axd?Culture=2052&CultureOverrides=True&UICulture=2052&UICultureOverrides=True&ReportStack=1&ControlID=" + ControlID + "&Mode=true&OpType=Export&FileName=rptOrderSearchFM_CHS&ContentDisposition=OnlyHtmlInline&Format=EXCELOPENXML")

    fp = open(xls_path, "wb")
    fp.write(result.content)
    fp.close()

# 讀取Excel
def excel_read(xls_path):
    workbook = xlrd.open_workbook(xls_path)
    sheets = workbook.sheet_names()
    worksheet = workbook.sheet_by_name(sheets[0])
    nrows = worksheet.nrows
    param = []
    size_param = []
    for i in xrange(5,nrows):
        if i > nrows-2 or i%2 == 0:
            continue
        json_str = ""
        for j in xrange(14,37):
            if worksheet.cell(i, j).value:
                json_str +=  '"' + worksheet.cell(i, j).value.replace('#',"") + '" :' + str(int(worksheet.cell(i+1, j).value)) + ','
        json_str = json_str[:-1]
        param.append([
            worksheet.cell(i, 2).value,
            worksheet.cell(i, 4).value,
            worksheet.cell(i, 5).value,
            worksheet.cell(i, 6).value,
            worksheet.cell(i, 7).value,
            worksheet.cell(i, 8).value,
            worksheet.cell(i, 11).value,
            worksheet.cell(i, 12).value,
            worksheet.cell(i, 13).value,
            "{" + json_str + "}",
            worksheet.cell(i, 39).value,
        ])
    return param

# 刪除 Excel
def rm_excel(ControlID):
    try:
        os.remove(ControlID + ".xls")
    except OSError as e:
        print(e)
    else:
        print("File is deleted successfully")

# 主程式
if __name__ == '__main__':
    # 所以有設定變數
    # 日期頻率 / 儲存路徑 / 開始日期 / 結束日期 / 檔案路徑
    _storage_folder = ""
    _frequency_type = 0  # 天數
    start_date = ""
    end_date = ""
    file_name = ""

    # 判別式排程還是個別執行
    if len(sys.argv) >= 2:
        _storage_folder = sys.argv[1]
        _frequency_type = sys.argv[2]
    else:
        _frequency_type = -1


    if _frequency_type == 0:
        start_date = sys.argv[3]
        end_date = sys.argv[4]

    elif _frequency_type > 0:
        end_date = date.today()
        start_date = end_date - timedelta(days=int(_frequency_type))
        end_date = end_date.strftime("%Y/%m/%d")
        start_date = start_date.strftime("%Y/%m/%d")

    else:
        _storage_folder = "/Users/andy/www/mherp/storage/python/download"
        file_name = raw_input('請輸入檔案名稱(默認為日期時間)')
        start_date = raw_input('請輸入開始日期(例:2020/1/1)(默認今日)')
        end_date = raw_input('請輸入結束日期(例:2020/12/31)(默認今日)')

    if start_date == "":
        today = time.strftime("%Y/%m/%d", time.localtime()).replace("/", "/")
        start_date = today

    if end_date == "":
        today = time.strftime("%Y/%m/%d", time.localtime()).replace("/", "/")
        end_date = today

    file_name = "ShoesOrderDtail-" + (start_date + "~" + end_date).replace("/", "-") + "-" + time.strftime("%H%M%S",time.localtime()) + ".xls"
    xls_path = _storage_folder + "/" + file_name

    session_requests = requests.session()


    # 開始def時間
    start = time.time()

    login() #登入def
    time_count("登入時間- ", start,time.time()) #計算def時間

    start = time.time() #開始def時間
    ControlID = get_ControlID(start_date, end_date) #取得下載ID def
    time_count("取得下載ID- ",start,time.time()) #計算def時間

    start = time.time() #開始def時間
    get_excel(ControlID, xls_path) #下載EXCEL def
    time_count("下載時間-", start,time.time()) #計算def時間

    start = time.time() #開始def時間
    param = excel_read(xls_path) #讀取下載EXCEL def
    time_count("讀取Excel時間-", start,time.time()) #計算def時間

    start = time.time() #開始def時間
    sql_insert(param) #寫入SQL def
    time_count("寫入SQL時間-", start,time.time()) #計算def時間

    start = time.time() #開始def時間
    rm_excel(ControlID) #刪除EXCEL def
    time_count("刪除時間-", start,time.time()) #計算def時間
