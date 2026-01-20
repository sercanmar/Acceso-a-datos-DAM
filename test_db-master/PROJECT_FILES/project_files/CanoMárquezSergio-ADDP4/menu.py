import consultas



def main():

    
    while True:
        print("1. Obtener el título de cada película y su categoría")
        print("2. Mostrar el nombre completo del cliente y la dirección asociada")
        print("3. Ver las direcciones junto con el nombre de la ciudad")
        print("4. Mostrar el título de las películas junto con el idioma en que están disponibles")
        print("5. Ver qué tienda tiene cada copia de película")
        print("6. Obtener los pagos realizados por cada cliente en sus alquileres")
        print("7. Insertamos un nuevo país llamado 'ValenciaLand' y ciudad")
        print("8. Actualizar una ciudad existente")
        print("9. Borra un cliente (id=1) con actividad")
        print("10. Borrar una categoría (Action) con películas.")
        print("11. Salir")

        opcion = input("Elige una opción: ")

        if opcion == "1":
            consultas.obtener_nombre_categoria(cnx)
        elif opcion == "2":
            consultas.obtener_nombre_direccion(cnx)
        elif opcion == "3":
           consultas.obtener_direcciones_ciudad(cnx)
        elif opcion == "4":
            consultas.obtener_titulo_idioma(cnx)
        elif opcion == "5":
            consultas.obtener_tienda_copia(cnx)
        elif opcion == "6":
            consultas.obtener_pagos_alquileres(cnx)
        elif opcion == "7":
            consultas.insertar_pais(cnx)
        elif opcion == "8":
            consultas.actualizar_ciudad(cnx)
        elif opcion == "9":
            consultas.borrar_cliente(cnx)
        elif opcion == "10":
            consultas.borrar_categoria(cnx)

        elif opcion == "11":
            print("saliendo del menu...")
            break
        else:
            print("Opción no válida, inténtalo de nuevo.")


if __name__ == "__main__":
    cnx = consultas.connect_db()
    main()
    
