#!/usr/bin/python
import pymysql as mariadb, random
mariadb_connection = mariadb.connect(user='root', password='root', database='zpapciapl')
cursor = mariadb_connection.cursor()


q = "drop table if exists travels;"
cursor.execute(q)

q = "create table travels(\
		`id` int(4) auto_increment,\
		`idClient` int(4),\
		`idWorker` int(4),\
                `idPlace` int(4),\
		`idFlight` int(4),\
		`idHotel` int(4),\
		`dateOfSale` date,\
		`price` int(6),\
		`discount` int(6),\
		`dayStart` date,\
		`dayEnd` date,\
		PRIMARY KEY(id)\
	);";

cursor.execute(q);


cursor.execute("Select id from clients;")
idClients = []
for i in cursor:
    idClients.append(i[0])

cursor.execute("Select id from workers;")
idWorkers = []
for i in cursor:
    idWorkers.append(i[0])

cursor.execute("Select id from places;")
idPlacess = []
for i in cursor:
    idPlacess.append(i[0])

cursor.execute("Select id from flights;")
idFlights = []
for i in cursor:
    idFlights.append(i[0])

cursor.execute("Select id from hotels;")
idHotels = []
for i in cursor:
    idHotels.append(i[0])

for i in range(1,5000):
    year = random.randint(2000,2017)
    msc = random.randint(1,11)
    q = ("insert into travels(idClient, idWorker, idPlace, idFlight, idHotel, dateOfSale, price,discount, dayStart, dayEnd)\
values('{}', '{}', '{}', '{}', '{}', '{}-{:02d}-{:02}', '{}', '{}', '{}-{:02d}-{:02}', '{}-{:02}-{:02}');".format(\
    random.choice(idClients),
    random.choice(idWorkers),
    random.choice(idPlaces),
    random.choice(idFlights),
    random.choice(idHotels),
    year, msc, random.randint(1,15),
    random.randint(10,40)*100,
    0,
    year, msc+1, random.randint(1,15),
    year, msc+1, random.randint(15,28) 
    ));
    cursor.execute(q);

mariadb_connection.commit();
mariadb_connection.close();
