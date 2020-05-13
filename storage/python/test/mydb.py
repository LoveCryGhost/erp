

def mysql_select(mycursor, sqlStatement):
    sqlStatement = "SELECT * from crawler_categories where updated_at is NULL and p_id=0"
    mycursor.execute(sqlStatement)
    return mycursor
