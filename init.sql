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

create table places(
		`id` int(10) auto_increment,
		`address` varchar(35),
		`openingHours` varchar(15),
		PRIMARY KEY(id)
	);

insert into places(address, opddeningHours) values
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
