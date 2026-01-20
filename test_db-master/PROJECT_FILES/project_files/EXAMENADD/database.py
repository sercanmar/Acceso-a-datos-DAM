import mysql.connector
from mysql.connector import errorcode


def connect_db():

    try:
        cnx = mysql.connector.connect(user='root', password='dbrootpass',
                                  host='127.0.0.1', port=33006,
                                  database='starwars',auth_plugin="mysql_native_password")
        print(cnx)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

    return cnx
























