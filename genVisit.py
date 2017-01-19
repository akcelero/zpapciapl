#!/bin/python
import pymysql as mariadb, random
mariadb_connection = mariadb.connect(user='root', password='root', database='zpapciapl', charset='utf8')
cursor = mariadb_connection.cursor()

q = "drop table if exists visits;"
cursor.execute(q)

q = "create table visits(\
		`id` int(40) auto_increment,\
		`idClient` int(40),\
		`idPlace` int(40),\
		`date` date,\
		PRIMARY KEY(id)\
		);"
cursor.execute(q)

cursor.execute("Select id from clients;")
idClients = []
for i in cursor:
    idClients.append(i[0])

cursor.execute("Select id from places;")
idPlaces = []
for i in cursor:
    idPlaces.append(i[0])

    

for i in range(200):
    q = "insert into visits(idClient, idPlace, date) values('{}', '{}', '{}-{:02d}-{:02d}');".format(
                random.choice(idClients),
                random.choice(idPlaces),
                random.randint(2000,2016), random.randint(1,12), random.randint(1,28)
                );
    cursor.execute(q)

mariadb_connection.commit()
mariadb_connection.close()
