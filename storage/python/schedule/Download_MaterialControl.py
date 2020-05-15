# -*- coding: utf-8 -*-
# coding=utf-8

# 載入
import os
import sys
import time
from datetime import date, timedelta
import mysql.connector
import requests
import xlrd
from bs4 import BeautifulSoup as bs


# 系統語言設定
reload(sys)
sys.setdefaultencoding('utf8')


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

file_name = "ShoesMaterialControl-" + (start_date + "~" + end_date).replace("/", "-") + "-" +time.strftime("%H%M%S", time.localtime()) + ".xls"
xls_path = _storage_folder + "/" + file_name

# 登入
LOGIN_URL = "http://221.4.133.66:8086/SRDD_SHOES/InfoLogin.aspx"
session_requests = requests.session()
result = session_requests.get(LOGIN_URL)
soup = bs(result.text, "html.parser")


# 登入參數
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
session_requests.post(LOGIN_URL, data=payload, headers='')

# 下載檔案
INDEX_URL = "http://221.4.133.66:8086/SRDD_SHOES/Purchase/WKZZB.aspx?ItemParam="
result = session_requests.get(INDEX_URL)
soup = bs(result.text, "html.parser")

# 下載檔案參數
payload = {
    "__EVENTTARGET": '',
    "__EVENTARGUMENT": '',
    "__VIEWSTATE": soup.find('input', id='__VIEWSTATE')["value"],
    "__VIEWSTATEGENERATOR": soup.find('input', id='__VIEWSTATEGENERATOR')["value"],
    "__EVENTVALIDATION": soup.find('input', id='__EVENTVALIDATION')["value"],
    "btnExport": "Excel印表",
    "txtZLBH": '',
    "txtXTBH": '',
    "jhrqq": start_date,
    "ddlDDLB": '',
    "ddlBOM": '',
    "txtKHDDBH": '',
    "txtKHXTBH": '',
    "jhrqz": end_date,
    "ddlDDLX": '',
    "txtCPBH": '',
}
headers = {
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9",
    "Accept-Encoding": "gzip, deflate",
    "Accept-Language": "zh-TW,zh;q=0.9,en-US;q=0.8,en;q=0.7",
    "Cache-Control": "max-age=0",
    "Connection": "keep-alive",
    "Content-Type": "application/x-www-form-urlencoded"
}

print("下載中請稍候")
# 儲存檔案
result = session_requests.post(INDEX_URL, data=payload, headers=headers)
fp = open(xls_path, "wb")
fp.write(result.content)
fp.close()
print ("檔案下載完成")

# 寫入資料庫
# 連接資料庫
mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="root",
  database="mherp",
  unix_socket='/tmp/mysql.sock'
)
mycursor = mydb.cursor()

# 創建資料表
mycursor.execute("""
    CREATE TABLE IF NOT EXISTS mh_shoes_ee(
    id int unsigned not null primary key AUTO_INCREMENT,
     mh_order_code varchar(32) comment '指令编号',
     received_at varchar(32) comment '接单日期',
     outbound_condition varchar(32) comment '出货状态',
     m_purchase_code varchar(32) comment '茂弘采购单号',
     order_condition varchar(32) comment '订单状态',
     c_name varchar(32) comment '客户简称',
     c_order_code varchar(100) comment '客户订单号',
     model_name varchar(32) comment '型体编号',
     puchase_plan varchar(32) comment '计划编号',
     purchase_content text comment '计划内容',
     material_code varchar(32) comment '物料编号',
     material_name varchar(255) comment '物料名称',
     material_unit varchar(32) comment '单位',
     order_type varchar(32) comment '订单类型',
     bom_type varchar(32) comment 'BOM类型',
     purchase_a_qty varchar(32) comment '指令量正批',
     purchase_loss_qty varchar(32) comment '指令量损耗',
     purchase_plan_qty varchar(32) comment '计划采购',
     purchase_at varchar(32) comment '采购日期',
     purchase_qty varchar(32) comment '采购量',
     material_received_at varchar(32) comment '验收日期',
     inbound_qty varchar(32) comment '入库量',
     particle_qty varchar(32) comment '粒料指令',
     outbound_at varchar(32) comment '出库日期',
     material_a_outbound_qty varchar(32) comment '正批领料',
     material_o_outbound_qty varchar(32) comment '补料领料',
     material_fass_outbound_qty varchar(32) comment '快速领料',
     material_reprocess_outbound_qty varchar(32) comment '加工领料',
     supplier_name varchar(32) comment '厂商',
     material_price varchar(32)  comment '单价'
    );""")
mydb.commit()

# 讀取Excel
workbook = xlrd.open_workbook(xls_path)
sheets = workbook.sheet_names()
worksheet = workbook.sheet_by_name(sheets[0])
nrows = worksheet.nrows
param = []
for i in xrange(1,nrows):
    if i < 3:
        continue
    param.append([
        worksheet.cell(i, 0).value,
        worksheet.cell(i, 1).value,
        worksheet.cell(i, 2).value,
        worksheet.cell(i, 3).value,
        worksheet.cell(i, 4).value,
        worksheet.cell(i, 5).value,
        worksheet.cell(i, 6).value,
        worksheet.cell(i, 7).value,
        worksheet.cell(i, 8).value,
        worksheet.cell(i, 9).value,
        worksheet.cell(i, 10).value,
        worksheet.cell(i, 11).value,
        worksheet.cell(i, 12).value,
        worksheet.cell(i, 13).value,
        worksheet.cell(i, 14).value,
        worksheet.cell(i, 15).value,
        worksheet.cell(i, 16).value,
        worksheet.cell(i, 17).value,
        worksheet.cell(i, 18).value,
        worksheet.cell(i, 19).value,
        worksheet.cell(i, 20).value,
        worksheet.cell(i, 21).value,
        worksheet.cell(i, 22).value,
        worksheet.cell(i, 23).value,
        worksheet.cell(i, 24).value,
        worksheet.cell(i, 25).value,
        worksheet.cell(i, 26).value,
        worksheet.cell(i, 27).value,
        worksheet.cell(i, 28).value,
        worksheet.cell(i, 29).value
    ])

# 寫入資料庫
sql_insert_query = "INSERT INTO mh_shoes_ee(mh_order_code,received_at,outbound_condition,order_condition,m_purchase_code,c_name,c_order_code,model_name,puchase_plan,purchase_content,material_code,material_name,material_unit,order_type,bom_type,purchase_a_qty,purchase_loss_qty,purchase_plan_qty,purchase_at,purchase_qty,material_received_at,inbound_qty,particle_qty,outbound_at,material_a_outbound_qty,material_o_outbound_qty,material_fass_outbound_qty,material_reprocess_outbound_qty,supplier_name,material_price) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
mycursor.executemany(sql_insert_query, param)
mydb.commit()

# 刪除檔案
os.remove(xls_path)
