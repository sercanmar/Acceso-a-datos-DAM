import mysql.connector
from mysql.connector import errorcode


def connect_db():

    try:
        cnx = mysql.connector.connect(user='root', password='dbrootpass',
                                  host='127.0.0.1', port=33006,
                                  database='sakila',auth_plugin="mysql_native_password")
        print(cnx)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

    return cnx

def get_actors(cnx):
    cursor= cnx.cursor()
    query ="SELECT first_name, last_name from actor;"
    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()

def get_10_clientes(cnx):
    cursor= cnx.cursor()
    query ="SELECT first_name, last_name from customer;"
    cursor.execute(query)
    i=0
    for (first_name, last_name) in cursor :
        if i<=10:
            print(first_name, last_name)
            i=i+1
    cursor.close()

def get_peliculas_pg(cnx):
    cursor= cnx.cursor()
    query ="SELECT title, rating from film where rating ='PG';"
    cursor.execute(query)
    for (title,rating) in cursor:
        print(title, rating)
    cursor.close()

def get_idiomas(cnx):
    cursor= cnx.cursor()
    query ="SELECT distinct(name) from language;"
    cursor.execute(query)
    for (name) in cursor:
        print(name)
    cursor.close()

def get_categorias_peliculas(cnx):
    cursor= cnx.cursor()
    query ="SELECT distinct(name) from category;"
    cursor.execute(query)
    for (name) in cursor:
        print(name)
    cursor.close()

def get_peliculas_idioma(cnx):
    cursor= cnx.cursor()
    query ="SELECT f.title, l.name FROM film f INNER JOIN language l ON f.language_id = l.language_id;"
    cursor.execute(query)
    for (title,lname) in cursor:
        print(title,lname)
    cursor.close()

def get_clientes_activos_tienda(cnx):
    cursor= cnx.cursor()
    query ="SELECT c.first_name, s.store_id FROM customer c INNER JOIN store s ON c.store_id = s.store_id WHERE c.active = 1;"
    cursor.execute(query)
    for (cname,storeid) in cursor:
        print(cname,storeid)
    cursor.close()

def get_actores_20(cnx):
    cursor= cnx.cursor()
    query ="SELECT a.first_name, COUNT(f.actor_id) FROM actor a INNER JOIN film_actor f ON a.actor_id = f.actor_id GROUP BY a.actor_id HAVING COUNT(f.actor_id) > 20;"
    cursor.execute(query)
    for (cname,storeid) in cursor:
        print(cname,storeid)
    cursor.close()

def get_pagos_cliente_top5(cnx):
    cursor= cnx.cursor()
    query ="SELECT c.first_name, COUNT(p.payment_id) FROM customer c INNER JOIN payment p ON c.customer_id = p.customer_id GROUP BY c.first_name ORDER BY COUNT(p.payment_id) DESC LIMIT 5;"
    cursor.execute(query)
    for (cname,storeid) in cursor:
        print(cname,storeid)
    cursor.close()

def get_peliculas_mas_alquiladas(cnx):
    cursor= cnx.cursor()
    query ="SELECT f.title, COUNT(r.inventory_id) FROM film f INNER JOIN payment p ON c.customer_id = p.customer_id GROUP BY c.first_name ORDER BY COUNT(p.payment_id) DESC LIMIT 5;"
    cursor.execute(query)
    for (cname,storeid) in cursor:
        print(cname,storeid)
    cursor.close()
def nuevo_actor(cnx):
    first_name=input("name:")
    last_name=input("lastname:")
    add_actor="""
    INSERT into actor
    """
    data_actor={
        'first_name':first_name,
        'last_name':last_name
    }
    cursor =cnx.cursor()
    cursor.execute(add_actor,data_actor)
    cnx.commit()
    cursor.close

def close_db(cnx):
    cnx.close()

    return 0


