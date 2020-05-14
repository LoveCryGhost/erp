# -*- coding: utf-8 -*-
#coding=utf-8
import sys
import time
import mysql.connector
import requests
import xlrd
from bs4 import BeautifulSoup as bs

reload(sys)
sys.setdefaultencoding('utf8')

# 开始时间
start_time = time.time()

xls_name = ""
start_date = ""
end_date = ""

if len(sys.argv) >= 2:
    _storage_folder = sys.argv[1]
    start_date = sys.argv[2]
    end_date = sys.argv[3]
    print(_storage_folder,start_date,end_date)
else:
    xls_name = raw_input('請輸入檔案名稱(默認為日期時間)')
    _storage_folder = "/Users/andy/www/python/Example/Storage/MaterialControl/"
    start_date = raw_input('請輸入開始日期(例:2020/1/1)(默認今日)')
    end_date = raw_input('請輸入結束日期(例:2020/12/31)(默認今日)')

if xls_name == "":
    today = time.strftime("%Y-%m-%d %H%M%S", time.localtime())
    xls_name = today + ".xls"
else:
    xls_name = ".xls"

xls_path = _storage_folder+ "/" + xls_name



if start_date == "":
    today = time.strftime("%Y/%m/%d", time.localtime()).replace("/0", "/")
    start_date = today

if end_date == "":
    today = time.strftime("%Y/%m/%d", time.localtime()).replace("/0", "/")
    end_date = today

LOGIN_URL = "http://221.4.133.66:8086/SRDD_SHOES/InfoLogin.aspx"


session_requests = requests.session()
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

INDEX_URL = "http://221.4.133.66:8086/SRDD_SHOES/Purchase/WKZZB.aspx?ItemParam="
result = session_requests.get(INDEX_URL)
soup = bs(result.text, "html.parser")

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

print("下載中請稍候<br>")

result = session_requests.post(INDEX_URL, data = payload, headers = headers)
fp = open(xls_path, "wb")
fp.write(result.content)
fp.close()
print(start_date)
print(end_date)
print("下載完成,檔案名稱為" + xls_name+"<br>")
print("正在將EXCEL寫入資料庫<br>")

mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  passwd="root",
  database="mherp",
  unix_socket='/tmp/mysql.sock'
)
mycursor = mydb.cursor()

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

#sql_insert_query = "INSERT INTO mh_shoes_ee(指令编号,接单日期,出货状态,订单状态,采购单号,客户简称,客户订单号,型体编号,计划编号,计划内容,物料编号,物料名称,单位,订单类型,BOM类型,指令量正批,指令量损耗,计划采购,采购日期,采购量,验收日期,入库量,粒料指令,出库日期,正批领料,补料领料,快速领料,加工领料,厂商,单价) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"
sql_insert_query = "INSERT INTO mh_shoes_ee(mh_order_code,received_at,outbound_condition,order_condition,m_purchase_code,c_name,c_order_code,model_name,puchase_plan,purchase_content,material_code,material_name,material_unit,order_type,bom_type,purchase_a_qty,purchase_loss_qty,purchase_plan_qty,purchase_at,purchase_qty,material_received_at,inbound_qty,particle_qty,outbound_at,material_a_outbound_qty,material_o_outbound_qty,material_fass_outbound_qty,material_reprocess_outbound_qty,supplier_name,material_price) VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)"


mycursor.executemany(sql_insert_query, param)
mydb.commit()

end_time = time.time()  # 结束时间
print("time:%d" % (end_time - start_time)+"<br>")  # 结束时间-开始时间
