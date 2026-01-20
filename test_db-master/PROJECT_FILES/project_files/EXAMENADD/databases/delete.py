import database
import mysql.connector


def planetas_sobrantes(cnx):
    cursor = cnx.cursor()
    cursor.execute("DELETE FROM planets "
                   "WHERE id=NOT EXISTS(SELECT planet_id FROM characters) ")
    cnx.commit()
    cursor.close()
