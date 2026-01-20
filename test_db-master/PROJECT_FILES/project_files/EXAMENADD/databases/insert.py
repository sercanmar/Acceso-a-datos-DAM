import database
import mysql.connector


def insertar_films(cnx):
    cursor = cnx.cursor()
    datos1=(7,"EPISODE VII","EL DESPERTAR DE LA FUERZA")
    datos2=(8,"EPISODE VIII","LOS ULTIMOS JEDIS")
    datos3=(9,"EPISODE IX","EL ASCENSO DE SKYWALKER")

    cursor.execute("INSERT INTO films "
                   "VALUES (%s,%s,%s) ",datos1)
    cursor.execute("INSERT INTO films "
                   "VALUES (%s,%s,%s) ", datos2)
    cursor.execute("INSERT INTO films "
                   "VALUES (%s,%s,%s) ", datos3)
    cnx.commit()
    cursor.close()
def insertar_caracteres(cnx):
    cursor = cnx.cursor()

    datos1 = ("Rey",107,54,"black", "white", "brown","15DBY","female","Jakku")
    datos2 = ("Finn",178,73,"black", "dark", "dark","11DBY","male","Kamino")
    datos3 = ("Kylo ren",189,89,"black", "white", "brown","5DBY","male","Chandrila")
    cursor.execute("INSERT INTO characters "
                   "VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s) ",datos1)
    cursor.execute("INSERT INTO characters "
                   "VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s) ",datos2)
    cursor.execute("INSERT INTO characters "
                   "VALUES (%s,%s,%s,%s,%s,%s,%s,%s,%s) ",datos3)
    cnx.commit()
    cursor.close()
def insertar_muertes(cnx):
    cursor = cnx.cursor()
    datos=("idHan","idkylo","EPISODIO VII")
    cursor.execute("INSERT INTO deaths "
                   "VALUES (%s,%s,%s) ",datos)
    cnx.commit()
    cursor.close()