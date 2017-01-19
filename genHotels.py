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
		`id` int(2) auto_increment not null,\
		`address` varchar(20) not null,\
		`pricePerNight` int(4) not null,\
                `block` int(1) default 0,\
                `stars` varchar(6) not null,\
		PRIMARY KEY(id)\
	);";
cursor.execute(q);
for i in range(1, len(places) + 10):
    q = ("insert into hotels(address, pricePerNight, stars) values('{}', '{}', '{}', '{}');".format(
                random.choice(places), random.randint(3, 10) * 10, "*"*random.randint(1,5)
                ))
    cursor.execute(q)
mariadb_connection.commit()
mariadb_connection.close()
