#!/bin/python
places = [
"Albania Tirana",
"Andora Andora",
"Armenia Erewań",
"Austria Wiedeń",
"Azerbejdżan Baku",
"Belgia Bruksela",
"Białoruś Mińsk",
"Bośnia i Hercegowina Sarajewo",
"Bułgaria Sofia",
"Chorwacja Zagrzeb",
"Cypr Nikozja",
"Czechy Praga",
"Dania Kopenhaga",
"Estonia Tallin",
"Finlandia Helsinki"
]
import random, pymysql as mariadb

mariadb_connection = mariadb.connect(user='root', password='root', database='zpapciapl', charset='utf8')
cursor = mariadb_connection.cursor()
cursor.execute("drop table if exists hotels;");
q = "create table hotels(\
		`id` int(2) auto_increment,\
		`address` varchar(20),\
		`numberOfPlaces` int(4),\
		`pricePerNight` int(4),\
		PRIMARY KEY(id)\
	);";
cursor.execute(q);
for i in range(1, len(places) + 10):
    q = ("insert into hotels(address, numberOfPlaces, pricePerNight) values('{}', '{}', '{}');".format(
                random.choice(places), random.randint(1,5) * 10, random.randint(3, 10) * 10
                ))
    cursor.execute(q)
mariadb_connection.commit()
mariadb_connection.close()
