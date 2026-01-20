from databases import select
from databases import insert
from databases import delete
from databases import update
import database

def main():
    while True:

        opcion = input("Elige una opción: ")

        if opcion == "1":
            select.mostrar_personajes(cnx)
        elif opcion == "2":
            select.personajes_afiliacion(cnx)
        elif opcion == "3":
            select.muertes_registradas(cnx)
        elif opcion == "4":
            select.personajes_planeta_pelicula(cnx)
        elif opcion == "5":
            select.muertes_afiliacion_pelicula(cnx)
        elif opcion == "6":
            insert.insertar_films(cnx)
        elif opcion == "7":
            insert.insertar_caracteres(cnx)
        elif opcion == "8":
            insert.insertar_muertes(cnx)
        elif opcion == "9":
            update.actualizar_afiliacion(cnx)
        elif opcion == "10":
            update.actualizar_planeta(cnx)
        elif opcion == "11":
            delete.planetas_sobrantes(cnx)

        else:
            print("Opción no válida, inténtalo de nuevo.")


if __name__ == "__main__":
    cnx = database.connect_db()
    main()
