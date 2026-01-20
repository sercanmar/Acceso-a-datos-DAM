import csv

archivo_agenda = "DatosContacto.csv"


def guardar_datos():
    nombre = input("Ingrese el nombre del contacto: ")
    apellido = input("Ingrese el apellido del contacto: ")
    email = input("Ingrese el email del contacto: ")
    telefono1 = input("Ingrese el teléfono1 del contacto: ")
    telefono2 = input("Ingrese el teléfono2 del contacto: ")
    direccion = input("Ingrese la dirección del contacto: ")

    with open(archivo_agenda, 'a', newline='', encoding='utf8') as archivo:
        escritor = csv.writer(archivo, delimiter=';')
        escritor.writerow([nombre, apellido, email, telefono1, telefono2, direccion])

    print("contcto guardado correctamente.")


def modificar_contacto():
    nombre_buscar = input("Introduce el nombre del contacto que quieres modificar: ")
    contactos = []

    with open(archivo_agenda, 'r', newline='', encoding='utf8') as archivo:
        lector = csv.reader(archivo, delimiter=';')
        for fila in lector:
            contactos.append(fila)

    encontrado = False
    for i in range(1, len(contactos)):
        if contactos[i][0].lower() == nombre_buscar.lower():
            print("Contacto encontrado. Deja en blanco si no quieres cambiar algo.")
            nuevo_nombre = input(f"Nuevo nombre ({contactos[i][0]}): ") or contactos[i][0]
            nuevo_apellido = input(f"Nuevo apellido ({contactos[i][1]}): ") or contactos[i][1]
            nuevo_email = input(f"Nuevo email ({contactos[i][2]}): ") or contactos[i][2]
            nuevo_tel1 = input(f"Nuevo teléfono1 ({contactos[i][3]}): ") or contactos[i][3]
            nuevo_tel2 = input(f"Nuevo teléfono2 ({contactos[i][4]}): ") or contactos[i][4]
            nueva_direccion = input(f"Nueva dirección ({contactos[i][5]}): ") or contactos[i][5]
            contactos[i] = [nuevo_nombre, nuevo_apellido, nuevo_email, nuevo_tel1, nuevo_tel2, nueva_direccion]
            encontrado = True
            break

    if encontrado:
        with open(archivo_agenda, 'w', newline='', encoding='utf8') as archivo:
            escritor = csv.writer(archivo, delimiter=';')
            escritor.writerows(contactos)
        print("contacto modificado correctamente.")
    else:
        print("no se encontró el contacto.")


def eliminar_contacto():
    nombre_borrar = input("Introduce el nombre del contacto que quieres eliminar: ")
    contactos = []

    with open(archivo_agenda, 'r', newline='', encoding='utf8') as archivo:
        lector = csv.reader(archivo, delimiter=';')
        for fila in lector:
            contactos.append(fila)

    nuevos_contactos = [contactos[0]]  
    eliminado = False
    for i in range(1, len(contactos)):
        if contactos[i][0].lower() != nombre_borrar.lower():
            nuevos_contactos.append(contactos[i])
        else:
            eliminado = True

    if eliminado:
        with open(archivo_agenda, 'w', newline='', encoding='utf8') as archivo:
            escritor = csv.writer(archivo, delimiter=';')
            escritor.writerows(nuevos_contactos)
        print("contacto eliminado correctamente.")
    else:
        print("no se encontró ningún contacto con ese nombre.")


def buscar_contacto():
    nombre_buscar = input("Introduce el nombre del contacto a buscar: ")
    encontrado = False
    with open(archivo_agenda, 'r', newline='', encoding='utf8') as archivo:
        lector = csv.DictReader(archivo, delimiter=';')
        for fila in lector:
            if fila['nombre'].lower() == nombre_buscar.lower():
                print("\nContacto encontrado:")
                print("Nombre:", fila['nombre'])
                print("Apellido:", fila['apellido'])
                print("Email:", fila['email'])
                print("Teléfono1:", fila['telefono1'])
                print("Teléfono2:", fila['telefono2'])
                print("Dirección:", fila['direccion'])
                encontrado = True
    if not encontrado:
        print("no se encontró el contacto.")


def mostrar_contactos():
    with open(archivo_agenda, 'r', newline='', encoding='utf8') as archivo:
        lector = csv.DictReader(archivo, delimiter=';')
        lista = list(lector)
        if not lista:
            print("La agenda está vacía.")
            return
        lista_ordenada = sorted(lista, key=lambda x: x['nombre'].lower())
        print("\n--- LISTA DE CONTACTOS ---")
        for fila in lista_ordenada:
            print(f"{fila['nombre']} {fila['apellido']} - {fila['telefono1']}")


def main():
    while True:
        print("1. Guardar datos de un contacto")
        print("2. Modificar datos de un contacto")
        print("3. Dar de baja a un contacto (Eliminar)")
        print("4. Buscar un contacto")
        print("5. Mostrar la lista de contactos ordenada")
        print("6. Salir")

        opcion = input("Elige una opción: ")

        if opcion == "1":
            guardar_datos()
        elif opcion == "2":
            modificar_contacto()
        elif opcion == "3":
            eliminar_contacto()
        elif opcion == "4":
            buscar_contacto()
        elif opcion == "5":
            mostrar_contactos()
        elif opcion == "6":
            print("saliendo de la agenda...")
            break
        else:
            print("Opción no válida, inténtalo de nuevo.")


if __name__ == "__main__":
    main()
