# -*- coding: utf-8 -*-
# coding=utf-8
import mysql.connector

def sqlCONN():
    conn = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="root",
            database="mherp",
            unix_socket='/Applications/MAMP/tmp/mysql/mysql.sock'
        )
    return conn
