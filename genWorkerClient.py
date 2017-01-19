#!/bin/python

import pymysql as mariadb, random, string
mariadb_connection = mariadb.connect(user='root', password='root', database='zpapciapl', charset='utf8')
cursor = mariadb_connection.cursor()

names = ['Ania', 'Wojtek', 'Andrzej', 'Michal', 'Mateusz', 'Ewa', 'Jacek', 'Piotr', 'Kamil', 'Aleksander', 'Kasia', 'Monika', 'Marta']
surnames = ['Pachla', 'Wróbel', 'Dudek', 'Sikora', 'Zięba', 'Woźniak', 'Krawczyk', 'Szewczyk', 'Swat', 'Kaczmarek', 'Wdowiak', 'Cieślak']
streets = ['Wiertnicza ', 'Karmelowa ', 'Jana Pawla II ','Sienkiewicza ','Wisniowa ','Wierzbowa ','Brzozowa ','Debowa ','Cisowa ','Bazodanowa','Czekoladowa','Herbaciana','Czerwona','Kwasowa','Zasadowa']

q = "drop table if exists clients;"
cursor.execute(q)

q = "create table clients(\
		`id` int(10) auto_increment,\
		`name` varchar(50),\
		`dateOfBirth` date,\
		`address` varchar(50),\
		PRIMARY KEY(id)\
	);"
cursor.execute(q)

q = "drop table if exists workers;"
cursor.execute(q)

q = "create table workers(\
		`id` int(10) auto_increment,\
		`name` varchar(50),\
		`dateOfBirth` date,\
		`address` varchar(50),\
		PRIMARY KEY(id)\
	);"
cursor.execute(q)

for i in range(1,30):
    q = ("insert into workers(name, dateOfBirth, address) values ('{} {}', '{}-{:02d}-{:02d}', '{}');".format(
                    random.choice(names),
                    random.choice(surnames),
                    random.randint(1960,1999),random.randint(1,12), random.randint(1,30),
                    random.choice(streets)+' '+str(random.randint(1,50))+random.choice(string.ascii_letters)
                ));
    cursor.execute(q)
for i in range(1,50):
    q = ("insert into clients(name, dateOfBirth, address) values ('{} {}', '{}-{:02d}-{:02d}', '{}');".format(
                    random.choice(names),
                    random.choice(surnames),
                    random.randint(1960,1999),random.randint(1,12), random.randint(1,30),
                    random.choice(streets)+' '+str(random.randint(1,50))+random.choice(string.ascii_letters)
                ));
    cursor.execute(q)
mariadb_connection.commit()
mariadb_connection.close()
