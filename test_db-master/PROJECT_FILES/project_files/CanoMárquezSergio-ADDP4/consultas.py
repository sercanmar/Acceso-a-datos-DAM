
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

def obtener_titulo_categoria(cnx):
    cursor = cnx.cursor()
    query =("SELECT f.title, c.name "
            "from film f "
            "JOIN film_category x ON x.film_id = f.film_id "
            "JOIN category c ON x.category_id = c.category_id;")
    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()

def obtener_nombre_direccion(cnx):
    cursor = cnx.cursor()
    query =("SELECT c.first_name,c.last_name,a.address "
            "from customer c "
            "JOIN address a ON c.address_id = a.address_id; ")
    cursor.execute(query)
    for (first_name, last_name,address) in cursor:
        print(first_name, last_name,address)
    cursor.close()
def obtener_direcciones_ciudad(cnx):
    cursor = cnx.cursor()
    query = ("SELECT a.address,c.city "
             "from address a "
             "JOIN city c ON a.city_id = c.city_id; ")
    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()
def obtener_titulo_idioma(cnx):
    cursor = cnx.cursor()
    query = ("SELECT f.title,l.name "
             "from film f "
             "JOIN language l ON f.language_id = l.language_id; ")
    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()

def obtener_tienda_copia(cnx):
    cursor = cnx.cursor()
    query = ("SELECT f.title,a.address "
             "from address a "
             "JOIN store s ON a.address_id = s.address_id "
             "JOIN inventory i ON s.store_id = i.store_id "
             "JOIN film f ON i.film_id = f.film_id "
             "GROUP BY a.address,f.title; ")
    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()

def obtener_pagos_alquileres(cnx):
    cursor = cnx.cursor()
    query = ("SELECT c.first_name,c.last_name,r.rental_id,p.amount "
             "from rental r "
             "JOIN customer c ON r.customer_id = c.customer_id "
             "JOIN payment p ON c.customer_id = p.customer_id "
             "GROUP BY c.first_name, c.last_name, r.rental_id, p.amount; ")
    cursor.execute(query)
    for (first_name, last_name,rental_id,amount) in cursor:
        print(first_name, last_name,rental_id,amount)
    cursor.close()

def insertar_pais(cnx):

    cursor = cnx.cursor()
    query = ("INSERT INTO country (country) "
             "VALUES ('ValenciaLand')")
    cursor.execute(query)
    cnx.commit()
    print("país insertado")
    cursor.close()

    cursor = cnx.cursor()
    query = ("INSERT INTO city (city, country_id) "
             "SELECT 'Ciudad del Abanico', country_id FROM country WHERE country = 'ValenciaLand'")
    cursor.execute(query)
    cnx.commit()
    print("ciudad insertada")
    cursor.close()

    cursor = cnx.cursor()
    query = ("INSERT INTO address (address, address2, district, city_id, postal_code, phone, location) "
             "SELECT 'Calle de los Colibrís, 23', NULL, 'Centro', city_id, '46000', '600123456', ST_GeomFromText('POINT(10 20)', 4326) "
             "FROM city "
             "WHERE city='Ciudad del Abanico'")
    cursor.execute(query)
    cnx.commit()
    print("dirección insertada")
    cursor.close()

    cursor = cnx.cursor()
    query = ("SELECT c.country, i.city, a.address "
             "FROM country c "
             "JOIN city i ON c.country_id = i.country_id "
             "JOIN address a ON i.city_id = a.city_id "
             "WHERE c.country='ValenciaLand'")
    cursor.execute(query)
    for country, city, address in cursor:
        print(country, city, address)
    cursor.close()


def actualizar_ciudad(cnx):
    cursor = cnx.cursor()
    query = ("UPDATE city "
             "SET city='ACTUALIZADOPRUEBA' "
             "WHERE city='Ciudad del Abanico'")
    cursor.execute(query)
    cnx.commit()
    print("dirección insertada")
    cursor.close()

    cursor = cnx.cursor()
    query = ("SELECT i.city, a.address "
             "FROM city i JOIN address a ON i.city_id = a.city_id "
             "WHERE i.city='ACTUALIZADOPRUEBA'")
    cursor.execute(query)
    for city, address in cursor:
        print(city, address)
    cursor.close()


def borrar_cliente(cnx):
    cursor = cnx.cursor()
    query = ("DELETE FROM payment WHERE customer_id=1;")
    query1 = ( "DELETE FROM rental WHERE customer_id=1;")
    query2 =("DELETE FROM customer WHERE customer_id=1;")
    cursor.execute(query)
    cursor.execute(query1)
    cursor.execute(query2)
    cnx.commit()
    print("Borrado exitoso")
    cursor.close()


def borrar_categoria(cnx):
    cursor = cnx.cursor()
    query = ("DELETE FROM film_category WHERE category_id =(Select category_id From category where name='Action');")
    query1 = ("DELETE FROM category WHERE name='Action';")
    cursor.execute(query)
    cursor.execute(query1)
    cnx.commit()
    print("Borrado exitoso")
    cursor.close()