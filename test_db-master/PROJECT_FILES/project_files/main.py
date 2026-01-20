import database

if __name__ == '__main__':
    cnx = database.connect_db()
    database.get_actors(cnx)
    #database.get_10_clientes(cnx)
    #database.get_peliculas_pg(cnx)
    #database.get_idiomas(cnx)
    #database.get_categorias_peliculas(cnx)
    #database.get_peliculas_idioma(cnx)
    #database.get_clientes_activos_tienda(cnx)
    #database.get_actores_20(cnx)
    database.get_pagos_cliente_top5(cnx)