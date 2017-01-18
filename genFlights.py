#!/bin/python
destinations = [
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

import pymysql as mariadb, random
mariadb_connection = mariadb.connect(user='root', password='root', database='zpapciapl', charset='utf8')
cursor = mariadb_connection.cursor()

q = "drop table if exists flights;"
cursor.execute(q)

q = "create table flights(\
		`id` int(3) auto_increment not null,\
		`price` int(5) not null,\
		`date` date not null,\
		`numberOfPlaces` int(3) not null,\
		`destination` varchar(50) not null,\
                `block` int(1) default 0 not null,\
		PRIMARY KEY(id)\
		);";
cursor.execute(q)


for place in destinations:
    q = ("insert into flights(price, date, destination, numberOfPlaces) values('{}', '{}-{:02d}-{:02d}', '{}', '{}');".format(
                random.randint(1, 10) * 150,
                random.randint(2016, 2017), random.randint(1,12), random.randint(1,30),
                place,
                random.randint(2,5) * 15
                ))
    cursor.execute(q)

mariadb_connection.commit()
mariadb_connection.close()
