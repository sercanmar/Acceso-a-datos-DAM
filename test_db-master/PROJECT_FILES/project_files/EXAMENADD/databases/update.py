import database
import mysql.connector


def actualizar_afiliacion(cnx):
    cursor = cnx.cursor()
    cursor.execute("UPDATE character_affiliations "
                   "SET id_affiliation = (SELECT id FROM affiliations WHERE affiliation = 'Sith' ) )"
                   "WHERE id = idAnakin Skywalker ")
    cnx.commit()
    cursor.close()
def actualizar_planeta(cnx):
    cursor = cnx.cursor()
    cursor.execute("UPDATE characters "
                   "SET planet_id = (SELECT id FROM planets WHERE name = 'Alderaan' ) "
                   "WHERE name = 'Leia Organa' ")
    cnx.commit()
    cursor.close()

