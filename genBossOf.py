#!/bin/python
import pymysql as mariadb, random
mariadb_connection = mariadb.connect(user='root', password='root', database='zpapciapl', charset='utf8')
cursor = mariadb_connection.cursor()

q = "drop table if exists bossOf;"
cursor.execute(q)

q = "create table bossOf(\
		`idBoss` int(50),\
		`idWorker` int(10),\
		PRIMARY KEY(idWorker)\
		);"
cursor.execute(q)

q = "select id from workers;"
cursor.execute(q)
idWorkers = []
for i in cursor:
    idWorkers.append(i[0])

if(len(idWorkers) < 2):
    exit("za mało pracowników")


for i in range(1,20):
    a = i
    b = i
    while(a==b):
        b = random.choice(idWorkers)
    q = ("insert into bossOf(idWorker, idBoss) values({}, {});".format(a, b))
    cursor.execute(q)

mariadb_connection.commit()
mariadb_connection.close()
