import csv
import xml.etree.ElementTree as ET
import os


def convertir_csv_a_xml():

    print("Convirtiendo 'DatosContacto.csv' a 'agenda.xml'...")

    agenda = ET.Element("agenda")
    contactos = ET.SubElement(agenda, "contactos")

    with open("DatosContacto.csv", newline='', encoding='utf8') as archivo:

        lector = csv.DictReader(archivo)
        numero = 1
        for fila in lector:
            contacto = ET.SubElement(contactos, "contacto", id=str(numero))
            ET.SubElement(contacto, "nombre").text = fila['nombre']
            ET.SubElement(contacto, "apellido").text = fila['apellido']
            ET.SubElement(contacto, "email").text = fila['email']
            ET.SubElement(contacto, "telefono1").text = fila['telefono1']
            ET.SubElement(contacto, "telefono2").text = fila['telefono2']
            ET.SubElement(contacto, "direccion").text = fila['direccion']
            numero += 1

    datos = ET.tostring(agenda)
    with open("agenda.xml", "w", encoding="utf8") as f:
        f.write(datos.decode("utf8"))

    print("se ha creado el archivo agenda.xml correctamente.")


archivo_agenda = "agenda.xml"


def iniciar_agenda():
    if not os.path.exists(archivo_agenda):
        agenda = ET.Element("agenda")
        contactos = ET.SubElement(agenda, "contactos")
        datos = ET.ElementTree(agenda)
        datos.write(archivo_agenda, encoding="utf8")
    else:
        datos = ET.parse(archivo_agenda)
    return datos


def guardar_agenda(datos):
    datos.write(archivo_agenda, encoding="utf8", xml_declaration=True)


def mostrar_menu():
    print("\n--- MENU AGENDA ---")
    print("1. Guardar datos de un contacto")
    print("2. Modificar datos de un contacto")
    print("3. Eliminar un contacto")
    print("4. Buscar un contacto")
    print("5. Salir")
    opcion = input("Elige una opción: ")
    return opcion


def guardar_contacto(datos):
    agenda = datos.getroot()
    lista_contactos = agenda.find("contactos")

    nombre = input("Nombre: ")
    apellidos = input("Apellidos: ")
    email = input("Email: ")
    telefono1 = input("Teléfono 1: ")
    telefono2 = input("Teléfono 2: ")
    direccion = input("Dirección: ")

    id_nuevo = str(len(lista_contactos.findall("contacto")) + 1)
    contacto = ET.SubElement(lista_contactos, "contacto", id=id_nuevo)

    ET.SubElement(contacto, "nombre").text = nombre
    ET.SubElement(contacto, "apellidos").text = apellidos
    ET.SubElement(contacto, "email").text = email
    ET.SubElement(contacto, "telefono1").text = telefono1
    ET.SubElement(contacto, "telefono2").text = telefono2
    ET.SubElement(contacto, "direccion").text = direccion

    guardar_agenda(datos)
    print("Contacto guardado correctamente.")


def buscar_contacto(datos):
    agenda = datos.getroot()
    lista_contactos = agenda.find("contactos")
    nombre_buscar = input("Introduce el nombre del contacto a buscar: ")

    encontrado = False
    for c in lista_contactos.findall("contacto"):
        if c.find("nombre").text.lower() == nombre_buscar.lower():
            print("\nContacto encontrado:")
            print("ID:", c.get("id"))
            print("Nombre:", c.find("nombre").text)
            print("Apellidos:", c.find("apellidos").text)
            print("Email:", c.find("email").text)
            print("Teléfono 1:", c.find("telefono1").text)
            print("Teléfono 2:", c.find("telefono2").text)
            print("Dirección:", c.find("direccion").text)
            encontrado = True
    if not encontrado:
        print("No se encontró ningún contacto con ese nombre.")


def modificar_contacto(datos):
    agenda = datos.getroot()
    lista_contactos = agenda.find("contactos")

    id_modificar = input("Introduce el ID del contacto que quieres modificar: ")

    encontrado = False
    for c in lista_contactos.findall("contacto"):
        if c.get("id") == id_modificar:
            print("Deja vacío si no quieres cambiar el dato.")
            nuevo_nombre = input("Nuevo nombre (" + c.find("nombre").text + "): ")
            nuevo_apellido = input("Nuevos apellidos (" + c.find("apellidos").text + "): ")
            nuevo_email = input("Nuevo email (" + c.find("email").text + "): ")
            nuevo_tel1 = input("Nuevo teléfono 1 (" + c.find("telefono1").text + "): ")
            nuevo_tel2 = input("Nuevo teléfono 2 (" + c.find("telefono2").text + "): ")
            nueva_direccion = input("Nueva dirección (" + c.find("direccion").text + "): ")

            if nuevo_nombre != "":
                c.find("nombre").text = nuevo_nombre
            if nuevo_apellido != "":
                c.find("apellidos").text = nuevo_apellido
            if nuevo_email != "":
                c.find("email").text = nuevo_email
            if nuevo_tel1 != "":
                c.find("telefono1").text = nuevo_tel1
            if nuevo_tel2 != "":
                c.find("telefono2").text = nuevo_tel2
            if nueva_direccion != "":
                c.find("direccion").text = nueva_direccion

            guardar_agenda(datos)
            print("Contacto modificado correctamente.")
            encontrado = True
            break

    if not encontrado:
        print("No existe ningún contacto con ese ID.")


def eliminar_contacto(datos):
    agenda = datos.getroot()
    lista_contactos = agenda.find("contactos")

    id_borrar = input("Introduce el ID del contacto que quieres eliminar: ")

    encontrado = False
    for c in lista_contactos.findall("contacto"):
        if c.get("id") == id_borrar:
            lista_contactos.remove(c)
            guardar_agenda(datos)
            print("Contacto eliminado correctamente.")
            encontrado = True
            break

    if not encontrado:
        print("No se encontró el contacto con ese ID.")


def main():


    if not os.path.exists("agenda.xml"):
        convertir_csv_a_xml()

    datos_agenda = iniciar_agenda()

    while True:
        opcion = mostrar_menu()

        if opcion == "1":
            guardar_contacto(datos_agenda)
        elif opcion == "2":
            modificar_contacto(datos_agenda)
        elif opcion == "3":
            eliminar_contacto(datos_agenda)
        elif opcion == "4":
            buscar_contacto(datos_agenda)
        elif opcion == "5":
            print("sliendo de la agenda...")
            break
        else:
            print("Opción no válida, inténtalo otra vez.")


if __name__ == "__main__":
    main()
