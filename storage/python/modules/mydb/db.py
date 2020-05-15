# -*- coding: utf-8 -*-
# coding=utf-8
import mysql.connector
from eloquent import DatabaseManager, Model


def sqlCONN():
    conn = mysql.connector.connect(
            host="localhost",
            user="root",
            passwd="root",
            database="mherp",
            unix_socket='/Applications/MAMP/tmp/mysql/mysql.sock'
        )
    return conn

def eloquentCONN():
    config = {
         'mysql': {
        'driver': 'mysql',
        'host': 'localhost',
        'database': 'mherp',
        'user': 'root',
        'password': 'root',
        'prefix': '',
        'unix_socket': '/Applications/MAMP/tmp/mysql/mysql.sock'
    }
    }
    db = DatabaseManager(config)
    Model.set_connection_resolver(db)

