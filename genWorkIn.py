#!/bin/python
import pymysql as mariadb, random
mariadb_connection = mariadb.connect(user='root', password='root', database='zpapciapl', charset='utf8')
cursor = mariadb_connection.cursor()

positions = ["prezes", "viceprezes", "kasjer", "doradca", "prawnik", "sprzątacz"]

q = "drop table if exists workIn;"
cursor.execute(q)

q = "create table workIn(\
		`idWorker` int(10) auto_increment,\
		`idPlace` int(10),\
		`agreement` date,\
		`salary` float,\
		`position` varchar(100),\
		PRIMARY KEY(idWorker)\
	);"
cursor.execute(q)

q = "select id from workers;"
cursor.execute(q)
idWorkers = []
for i in cursor:
    idWorkers.append(i[0])

q = "select id from places;"
cursor.execute(q)
idPlaces = []
for i in cursor:
    idPlaces.append(i[0])


for i in idWorkers:
    q = ("insert into workIn(idWorker, idPlace, agreement, salary, position) values('{}', '{}', '{}-{:02d}-{:02d}', '{}', '{}');".format(
            i, random.choice(idPlaces), random.randint(0,5)+2017, random.randint(1,12), random.randint(1,30),
            random.randint(10,30) * 100, random.choice(positions)
         ));
    cursor.execute(q)

mariadb_connection.commit()
mariadb_connection.close()
