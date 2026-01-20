import database
import mysql.connector
import csv


def affiliations(cnx):
    cursor = cnx.cursor()

    with open('data/data/affiliations.csv', newline='', encoding='utf-8') as archivo_csv:
        lector_csv = csv.reader(archivo_csv)
        next(lector_csv)

        for fila in lector_csv:

            datos = fila

            cursor.execute("INSERT INTO affiliations "
                           "VALUES (%s,%s,) ", datos)

    cnx.commit()
    cursor.close()


if __name__ == "__main__":
    cnx = database.connect_db()
    affiliations(cnx)
    cnx.close()