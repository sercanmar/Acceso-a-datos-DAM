import consultas


def main():
    while True:
        print("1. Obtener el nombre y la categoría de los puertos ganados por ciclistas del equipo ‘Banesto’")
        print("2. Obtener el nombre de cada puerto indicando el número (netapa) y los kilómetros de la etapa en la que se encuentra el puerto.")
        print("3. Obtener el nombre y el director de los equipos a los que pertenezca algún ciclista mayor de 33 años.")
        print("4. Obtener el nombre de los ciclistas con el color de cada maillot que hayan llevado")
        print("5. Obtener pares de nombre de ciclista y número de etapa tal que ese ciclista haya ganado esa etapa habiendo llevado el maillot de color ‘Amarillo’ al menos una vez.")
        print("6. Obtener el valor del atributo netapa de las etapas que no comienzan en la misma ciudad en que acabó la anterior etapa.")
        print("7. Obtener el nombre de los equipos que tengan ciclistas indicando cuántos tiene cada uno.")
        print("8. Crea un equipo")
        print("9. Crea 5 ciclistas y asociados al equipo creado")
        print("10.  Crea 3 etapas y asociales como ciclista ganador alguno de los 5 ciclistas creados anteriormente.")
        print("11. Salir")

        opcion = input("Elige una opción: ")

        if opcion == "1":
            consultas.obtener_nombre_categoria(cnx)
        elif opcion == "2":
            consultas.obtener_nombre_puerto(cnx)
        elif opcion == "3":
            consultas.obtener_nombre_director(cnx)
        elif opcion == "4":
            consultas.obtener_ciclistas_maillot(cnx)
        elif opcion == "5":
            consultas.obtener_ciclista_etapa(cnx)
        elif opcion == "6":
            consultas.obtener_valor_atributo_etapa(cnx)
        elif opcion == "7":
            consultas.obtener_equipo(cnx)

        elif opcion == "8":
           nomeq= input("Dime el nombre del equipo:")
           director= input("Dime el nombre del director:")
           consultas.crear_equipo(cnx,nomeq,director)

        elif opcion == "9":
            nomeq = input("Dime el nombre del equipo para añadir ciclistas:")
            ciclista1 = input("Dime el nombre del ciclista 1:")
            ciclista2 = input("Dime el nombre del ciclista 2:")
            ciclista3 = input("Dime el nombre del ciclista 3:")
            ciclista4 = input("Dime el nombre del ciclista 4:")
            ciclista5 = input("Dime el nombre del ciclista 5:")
            consultas.crear_ciclistas_asociados(cnx,nomeq,ciclista1,ciclista2,ciclista3,ciclista4,ciclista5)

        elif opcion == "10":
            consultas.crear_etapas_asociales(cnx)

        elif opcion == "11":
            print("saliendo del menu...")
            break
        else:
            print("Opción no válida, inténtalo de nuevo.")


if __name__ == "__main__":
    cnx = consultas.connect_db()
    main()
