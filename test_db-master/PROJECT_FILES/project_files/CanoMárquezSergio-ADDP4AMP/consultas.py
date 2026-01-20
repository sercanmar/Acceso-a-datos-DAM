import mysql.connector
import random
from mysql.connector import errorcode


def connect_db():
    try:
        cnx = mysql.connector.connect(user='root', password='dbrootpass',
                                      host='127.0.0.1', port=33006,
                                      database='ciclistas', auth_plugin="mysql_native_password")
        print(cnx)
    except mysql.connector.Error as err:
        if err.errno == errorcode.ER_ACCESS_DENIED_ERROR:
            print("Something is wrong with your user name or password")
        elif err.errno == errorcode.ER_BAD_DB_ERROR:
            print("Database does not exist")
        else:
            print(err)

    return cnx


def obtener_nombre_categoria(cnx):
    cursor = cnx.cursor()
    query = (
        "SELECT c.nombre, p.categoria "
        "FROM ciclista c "
        "JOIN etapa e ON c.dorsal = e.dorsal "
        "JOIN puerto p ON e.netapa = p.netapa "
        "WHERE c.nomeq = 'Banesto';"
    )

    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()



def obtener_nombre_puerto(cnx):
    cursor = cnx.cursor()
    query = (
        "SELECT p.nompuerto,p.netapa,e.km "
        "FROM puerto p "
        "JOIN etapa e ON p.netapa = e.netapa "
    )

    cursor.execute(query)
    for (first_name, last_name,km) in cursor:
        print(first_name, last_name,km)
    cursor.close()


def obtener_nombre_director(cnx):
    cursor = cnx.cursor()
    query = (
        "SELECT e.nomeq, e.director "
        "FROM equipo e "
        "JOIN ciclista c ON e.nomeq = c.nomeq "
        "WHERE c.edad > 33;"
    )

    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()


def obtener_ciclistas_maillot(cnx):
    cursor = cnx.cursor()
    query = (
        "SELECT c.nombre, m.color "
        "FROM ciclista c "
        "JOIN llevar l ON c.dorsal = l.dorsal "
        "JOIN maillot m ON l.codigo = m.codigo"
    )

    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()


def obtener_ciclista_etapa(cnx):
    cursor = cnx.cursor()
    query = (
        "SELECT c.nombre, e.netapa "
        "FROM ciclista c "
        "JOIN etapa e ON c.dorsal = e.dorsal "
        "JOIN llevar l ON c.dorsal = l.dorsal "
        "JOIN maillot m ON l.codigo = m.codigo "
        "WHERE m.color = 'Amarillo';"
    )

    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()


def obtener_valor_atributo_etapa(cnx):
    cursor = cnx.cursor()
    query = (
        "SELECT e1.netapa "
        "FROM etapa e1 "
        "JOIN etapa e2 ON e1.netapa = e2.netapa + 1 "
        "WHERE e1.salida != e2.llegada;"
    )

    cursor.execute(query)
    for (first_name) in cursor:
        print(first_name)
    cursor.close()


def obtener_equipo(cnx):
    cursor = cnx.cursor()
    query = (
        "SELECT e.nomeq,count(c.dorsal) "
        "FROM equipo e "
        "JOIN ciclista c ON e.nomeq = c.nomeq "
        "Group by e.nomeq ;"
    )

    cursor.execute(query)
    for (first_name, last_name) in cursor:
        print(first_name, last_name)
    cursor.close()


def crear_equipo(cnx,nomeq,director):
    cursor = cnx.cursor()
    query = ("INSERT INTO equipo (nomeq, director) "
             "VALUES (%s, %s);")
    datos=(nomeq,director)
    cursor.execute(query,datos)
    cnx.commit()
    print("equipo insertado")
    cursor.close()


def crear_ciclistas_asociados(cnx, nomeq, c1, c2, c3, c4, c5):
    cursor = cnx.cursor()
    cursor.execute("SELECT COUNT(*) FROM equipo WHERE nomeq = %s;", (nomeq,))
    existe_equipo = cursor.fetchone()[0]

    if existe_equipo == 0:
        print(f"Error: El equipo '{nomeq}' no existe. No se pueden insertar ciclistas.")
        cursor.close()
        return

    cursor.execute("SELECT MAX(dorsal) FROM ciclista;")
    max_dorsal = cursor.fetchone()[0]
    if max_dorsal is None:
        next_dorsal = 101
    else:
        next_dorsal = max_dorsal + 1

    query = ("INSERT INTO ciclista (dorsal, nombre, edad, nomeq) "
             "VALUES (%s, %s, %s, %s);")

    ciclistas = [c1, c2, c3, c4, c5]
    dorsales_insertados = []

    for i, ciclista in enumerate(ciclistas):
        dorsal_asignado = next_dorsal + i
        datos = (dorsal_asignado, ciclista, 30, nomeq)
        cursor.execute(query, datos)
        dorsales_insertados.append((dorsal_asignado, ciclista))

    cnx.commit()
    print(f"\nse han insertado 5 ciclistas en el equipo '{nomeq}':")
    for dorsal, nombre in dorsales_insertados:
        print(f"- {nombre} (dorsal: {dorsal})")
    print("ciclistas insertados correctamente!")

    cursor.close()


def crear_etapas_asociales(cnx):
    cursor = cnx.cursor()

    query_ciclistas = ("SELECT dorsal FROM ciclista ORDER BY dorsal DESC LIMIT 5;")
    cursor.execute(query_ciclistas)
    ciclistas = cursor.fetchall()

    if not ciclistas:
        print("Error: No hay ciclistas en la base de datos para asignar como ganadores.")
        cursor.close()
        return

    query_max_etapa = ("SELECT MAX(netapa) FROM etapa;")
    cursor.execute(query_max_etapa)
    max_netapa = cursor.fetchone()[0]

    if max_netapa is None:
        next_netapa = 22
    else:
        next_netapa = max_netapa + 1

    query_insert = ("INSERT INTO etapa (netapa, km, salida, llegada, dorsal) "
                    "VALUES (%s, %s, %s, %s, %s);")

    ciudades = [
        ("Madrid", "Toledo"),
        ("Sevilla", "Granada"),
        ("Valencia", "Alicante"),
        ("Burgos", "León"),
        ("Zaragoza", "Huesca")
    ]

    etapas_insertadas = []

    for i in range(3):
        netapa_asignada = next_netapa + i
        km = random.randint(100, 250)
        salida, llegada = random.choice(ciudades)
        dorsal_ganador = random.choice(ciclistas)[0]

        datos = (netapa_asignada, km, salida, llegada, dorsal_ganador)
        cursor.execute(query_insert, datos)
        etapas_insertadas.append((netapa_asignada, km, salida, llegada, dorsal_ganador))

    cnx.commit()
    print("\nse han creado 3 nuevas etapas:")
    for netapa, km, salida, llegada, dorsal in etapas_insertadas:
        print(f"- etapa {netapa}: {salida} a {llegada}, {km}km. Ganador dorsal: {dorsal}")
    print("etapas creadas y ganadores asociados correctamente!")

    cursor.close()