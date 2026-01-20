import database
import mysql.connector


def mostrar_personajes(cnx):
    cursor = cnx.cursor()
    cursor.execute("SELECT c.name, p.name, f.title "
                   "FROM characters c "
                   "JOIN planets p ON c.planet_id = p.id "
                   "JOIN character_films x ON c.id = x.id_character "
                   "JOIN films f ON x.id_film = f.id")
    for (character_name, planet_name, film_title) in cursor:
        print(character_name)
        print(planet_name)
        print(film_title)
    cursor.close()


def personajes_afiliacion(cnx):
    cursor = cnx.cursor()
    cursor.execute("SELECT f.title, a.affiliation, count(c.id) "
                   "FROM characters c "
                   "JOIN character_films x ON c.id = x.id_character "
                   "JOIN films f ON x.id_film = f.id "
                   "JOIN character_affiliations y ON c.id = y.id_character "
                   "JOIN affiliations a ON y.id_affiliation = a.id "
                   "GROUP BY f.title, a.affiliation")
    for (title, affiliation, count) in cursor:
        print(title, affiliation, count)
    cursor.close()






def personajes_planeta_pelicula(cnx):

    cursor = cnx.cursor()
    cursor.execute("SELECT p.name, count(DISTINCT c.id), count(DISTINCT f.id) "
                   "FROM characters c "
                   "JOIN planets p ON c.planet_id = p.id "
                   "JOIN character_films x ON c.id = x.id_character "
                   "JOIN films f ON x.id_film = f.id "
                   "GROUP BY p.name")

    for (planet_name, character_count, film_count) in cursor:
        print(planet_name,character_count, film_count)
    cursor.close()

def muertes_afiliacion_pelicula(cnx):

    cursor = cnx.cursor()
    cursor.execute("SELECT a.affiliation, f.title, count(DISTINCT d.id) "
                   "FROM deaths d "
                   "JOIN films f ON d.id_film = f.id "
                   "JOIN characters c ON d.id_character = c.id "
                   "JOIN character_affiliations x ON c.id = x.id_character "
                   "JOIN affiliations a ON x.id_affiliation = a.id "
                   "GROUP BY f.title, a.affiliation")

    for(affiliation, name, count) in cursor:
        print(affiliation, name, count)
    cursor.close()
