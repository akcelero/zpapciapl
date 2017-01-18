drop database if exists zpapciapl;
create database zpapciapl;

use zpapciapl;

create table users(
		`id` int(10) auto_increment,
		`login` varchar(20),
		`password` varchar(32),
		`level` int(3),
		PRIMARY KEY (id)
	);

insert into users(login, password, level) values("admin", "admin", "0");

create table clients(
		`id` int(10) auto_increment,
		`name` varchar(50),
		`dateOfBirth` date,
		`address` varchar(50),
		PRIMARY KEY(id)
	);

insert into clients(name, dateOfBirth, address) values
	("Andrzej Andrzejewski", "1992-12-01 12:00", "takietam abcde"),
	("Andrzej Andrzejek", "1993-12-01 12:00", "Dubojsow 1"),
	("Andrzej Andrzemierz", "1994-12-01 12:00", "Dubojsow 2"),
	("Andrzej Andreu", "1995-12-01 12:00", "Dubojsow 3");


create table places(
		`id` int(10) auto_increment,
		`address` varchar(35),
		`openingHours` varchar(15),
		PRIMARY KEY(id)
	);

insert into places(address, openingHours) values
	("Bardzka 37", "7:00-18:00"),
	("Dubojsowa 39", "8:00-15:30"),
	("Armandzka 2a", "7:30-16:00");

create table visits(
		`id` int(10) auto_increment,
		`idClient` int(10),
		`idPlace` int(10),
		`data` date,
		PRIMARY KEY(id)
		);

insert into visits(idClient, idPlace, data) values('4', '2', '1991-08-18');
insert into visits(idClient, idPlace, data) values('4', '2', '1991-08-11');
insert into visits(idClient, idPlace, data) values('4', '3', '1991-03-29');
insert into visits(idClient, idPlace, data) values('2', '2', '1991-05-30');
insert into visits(idClient, idPlace, data) values('3', '2', '1997-03-25');
insert into visits(idClient, idPlace, data) values('2', '1', '2000-02-05');
insert into visits(idClient, idPlace, data) values('4', '2', '1997-10-04');
insert into visits(idClient, idPlace, data) values('4', '3', '1994-02-08');
insert into visits(idClient, idPlace, data) values('4', '2', '1999-02-19');
insert into visits(idClient, idPlace, data) values('3', '1', '1993-02-23');
insert into visits(idClient, idPlace, data) values('4', '2', '1995-06-29');
insert into visits(idClient, idPlace, data) values('3', '3', '1996-03-12');
insert into visits(idClient, idPlace, data) values('3', '1', '2000-05-08');
insert into visits(idClient, idPlace, data) values('1', '2', '1996-02-11');
insert into visits(idClient, idPlace, data) values('4', '1', '1996-10-11');
insert into visits(idClient, idPlace, data) values('3', '2', '1993-07-07');
insert into visits(idClient, idPlace, data) values('3', '2', '1995-01-24');
insert into visits(idClient, idPlace, data) values('1', '3', '1996-10-26');
insert into visits(idClient, idPlace, data) values('1', '1', '1993-09-08');
insert into visits(idClient, idPlace, data) values('3', '2', '1991-07-15');


create table workers(
	`id` int(10) auto_increment,
	`name` varchar(50),
	`dateOfBirth` date,
	`address` varchar(50),
	PRIMARY KEY(id)
	);

insert into workers(name, dateOfBirth, address) values ('Andrzej Cieślak', '1960-09-19', 'address 31U');
insert into workers(name, dateOfBirth, address) values ('Aleksander Szewczyk', '1975-07-01', 'address 33j');
insert into workers(name, dateOfBirth, address) values ('Michal Krawczyk', '1972-01-16', 'address 17u');
insert into workers(name, dateOfBirth, address) values ('Wojtek Sikora', '1991-08-01', 'address 12W');
insert into workers(name, dateOfBirth, address) values ('Wojtek Swat', '1963-05-17', 'address 38c');
insert into workers(name, dateOfBirth, address) values ('Kamil Cieślak', '1961-05-04', 'address 12f');
insert into workers(name, dateOfBirth, address) values ('Piotr Swat', '1992-09-03', 'address 22v');
insert into workers(name, dateOfBirth, address) values ('Michal Kaczmarek', '1971-12-08', 'address 38M');
insert into workers(name, dateOfBirth, address) values ('Kamil Wróbel', '1978-10-11', 'address 31Y');
insert into workers(name, dateOfBirth, address) values ('Marta Szewczyk', '1972-02-13', 'address 48F');
insert into workers(name, dateOfBirth, address) values ('Kamil Cieślak', '1960-12-07', 'address 30w');
insert into workers(name, dateOfBirth, address) values ('Mateusz Pachla', '1960-06-06', 'address 33A');
insert into workers(name, dateOfBirth, address) values ('Mateusz Pachla', '1998-06-10', 'address 35c');
insert into workers(name, dateOfBirth, address) values ('Mateusz Dudek', '1991-08-09', 'address 35l');
insert into workers(name, dateOfBirth, address) values ('Wojtek Kaczmarek', '1987-07-15', 'address 6R');
insert into workers(name, dateOfBirth, address) values ('Wojtek Swat', '1987-09-22', 'address 47f');
insert into workers(name, dateOfBirth, address) values ('Jacek Swat', '1982-02-10', 'address 45d');
insert into workers(name, dateOfBirth, address) values ('Aleksander Zięba', '1994-04-14', 'address 28w');
insert into workers(name, dateOfBirth, address) values ('Piotr Cieślak', '1991-12-23', 'address 1I');

create table bossOf(
		`idBoss` int(50),
		`idWorker` int(10),
		PRIMARY KEY(idBoss, idWorker)
		);

insert into bossOf(idWorker, idBoss) values(1, 14);
insert into bossOf(idWorker, idBoss) values(2, 16);
insert into bossOf(idWorker, idBoss) values(3, 2);
insert into bossOf(idWorker, idBoss) values(4, 6);
insert into bossOf(idWorker, idBoss) values(5, 1);
insert into bossOf(idWorker, idBoss) values(6, 15);
insert into bossOf(idWorker, idBoss) values(7, 12);
insert into bossOf(idWorker, idBoss) values(8, 17);
insert into bossOf(idWorker, idBoss) values(9, 17);
insert into bossOf(idWorker, idBoss) values(10, 5);
insert into bossOf(idWorker, idBoss) values(11, 9);
insert into bossOf(idWorker, idBoss) values(12, 18);
insert into bossOf(idWorker, idBoss) values(13, 11);
insert into bossOf(idWorker, idBoss) values(14, 4);
insert into bossOf(idWorker, idBoss) values(15, 13);
insert into bossOf(idWorker, idBoss) values(16, 5);
insert into bossOf(idWorker, idBoss) values(17, 8);
insert into bossOf(idWorker, idBoss) values(18, 12);
insert into bossOf(idWorker, idBoss) values(19, 13);


create table workIn(
		`idWorker` int(10),
		`idPlace` int(10),
		`agreement` date,
		`salary` float,
		`position` varchar(100),
		PRIMARY KEY(idWorker)
	);

insert into workIn(idWorker, idPlace, agreement, salary, position) values('1', '3', '2022-12-01', '1300', 'doradca');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('2', '3', '2017-12-01', '2000', 'sprzątacz');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('3', '1', '2018-08-07', '2300', 'kasjer');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('4', '1', '2021-12-13', '3000', 'prezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('5', '1', '2020-03-01', '1600', 'prawnik');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('6', '3', '2022-06-18', '2600', 'sprzątacz');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('7', '1', '2022-03-30', '2100', 'kasjer');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('8', '2', '2019-01-02', '1300', 'prezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('9', '3', '2022-06-24', '1300', 'prezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('10', '1', '2020-12-07', '1300', 'prezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('11', '1', '2017-09-11', '1200', 'prezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('12', '1', '2021-06-12', '1500', 'viceprezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('13', '1', '2021-03-27', '1900', 'doradca');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('14', '2', '2017-07-21', '1300', 'prezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('15', '3', '2017-12-10', '2300', 'doradca');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('16', '3', '2017-08-29', '2800', 'viceprezes');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('17', '2', '2020-05-15', '3000', 'kasjer');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('18', '3', '2019-04-30', '2000', 'doradca');
insert into workIn(idWorker, idPlace, agreement, salary, position) values('19', '2', '2022-07-03', '2600', 'sprzątacz');

create table hotels(
		`id` int(2) auto_increment,
		`address` varchar(20),
		`numberOfPlaces` int(4),
		`pricePerNight` int(4),
		PRIMARY KEY(id)
	);

insert into hotels(address, numberOfPlaces, pricePerNight) values('Armenia Erewań', '40', '50');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Dania Kopenhaga', '50', '70');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '20', '30');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '30', '60');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '30', '50');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Dania Kopenhaga', '30', '90');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Belgia Bruksela', '20', '70');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Austria Wiedeń', '20', '80');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Cpr Nikozja', '40', '40');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Albania Tirana', '30', '80');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '50', '80');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '40', '90');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '10', '90');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Bułgaria Sofia', '10', '100');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Albania Tirana', '10', '90');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Armenia Erewań', '30', '30');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Estonia Tallin', '20', '50');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Albania Tirana', '10', '80');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Armenia Erewań', '50', '30');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '30', '100');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Albania Tirana', '10', '50');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Albania Tirana', '10', '30');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Armenia Erewań', '50', '50');
insert into hotels(address, numberOfPlaces, pricePerNight) values('Czechy Praga', '50', '30');

create table flights(
		`id` int(3) auto_increment,
		`price` int(5),
		`date` date,
		`numberOfPlaces` int(3),
		`destination` varchar(50),
		PRIMARY KEY(id)
		);
insert into flights(price, date, destination, numberOfPlaces) values('600', '2017-04-14', 'Estonia Tallin', '75');
insert into flights(price, date, destination, numberOfPlaces) values('600', '2016-05-19', 'Belgia Bruksela', '60');
insert into flights(price, date, destination, numberOfPlaces) values('450', '2016-05-13', 'Austria Wiedeń', '45');
insert into flights(price, date, destination, numberOfPlaces) values('450', '2016-11-29', 'Cpr Nikozja', '30');
insert into flights(price, date, destination, numberOfPlaces) values('1050', '2017-10-02', 'Dania Kopenhaga', '45');
insert into flights(price, date, destination, numberOfPlaces) values('1050', '2017-05-21', 'Bośnia i Hercegowina Sarajewo', '45');
insert into flights(price, date, destination, numberOfPlaces) values('1350', '2017-03-20', 'Bośnia i Hercegowina Sarajewo', '45');
insert into flights(price, date, destination, numberOfPlaces) values('1200', '2017-11-25', 'Cpr Nikozja', '75');
insert into flights(price, date, destination, numberOfPlaces) values('150', '2017-07-14', 'Chorwacja Zagrzeb', '45');
insert into flights(price, date, destination, numberOfPlaces) values('150', '2017-04-11', 'Bośnia i Hercegowina Sarajewo', '60');
insert into flights(price, date, destination, numberOfPlaces) values('900', '2016-12-13', 'Albania Tirana', '30');

create table travels(
		`id` int(4),
		`idClient` int(4),
		`idWorker` int(4),
		`idFlight` int(4),
		`idHotel` int(4),
		`dateOfSale` date,
		`price` int(6),
		`discount` int(6),
		`dayStart` date,
		`dayEnd` date,
		PRIMARY KEY(id)
	);
