# -*- coding: utf-8 -*-
# coding=utf-8
from eloquent import DatabaseManager, Model

class User(Model):
    __table__ = 'users'
    __fillable__ = ['first_name', 'last_name', 'email']
    __guarded__ = ['id', 'password']
    __timestamps__ = True
