# -*- coding: utf-8 -*-
# coding=utf-8
# !/usr/bin/python
from modules.mydb.db import *
from modules.eloquent.User import *
from eloquent import DatabaseManager, Model

# 1連接資料庫 - 2設定參數 - 3搜尋
# conn = sqlCONN()
# cursor = conn.cursor(dictionary=True)
#
# sqlStatement = "SELECT * from crawler_categories where updated_at is NULL and p_id=0"
# cursor.execute(sqlStatement)
# records = cursor.fetchall()

# Eloquent
eloquentCONN()
users = User.all()
for user in users:
    print user
