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
insert into workers(name, dateOfBirth, address) values ('mateusz Pachla', '1960-06-06', 'address 33A');
insert into workers(name, dateOfBirth, address) values ('mateusz Pachla', '1998-06-10', 'address 35c');
insert into workers(name, dateOfBirth, address) values ('mateusz Dudek', '1991-08-09', 'address 35l');
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

insert into bossOf(idBoss, idWorker) values(1, 13);
insert into bossOf(idBoss, idWorker) values(2, 15);
insert into bossOf(idBoss, idWorker) values(3, 4);
insert into bossOf(idBoss, idWorker) values(4, 8);
insert into bossOf(idBoss, idWorker) values(5, 4);
insert into bossOf(idBoss, idWorker) values(6, 17);
insert into bossOf(idBoss, idWorker) values(7, 6);
insert into bossOf(idBoss, idWorker) values(8, 2);
insert into bossOf(idBoss, idWorker) values(9, 1);
insert into bossOf(idBoss, idWorker) values(10, 2);
insert into bossOf(idBoss, idWorker) values(11, 6);
insert into bossOf(idBoss, idWorker) values(12, 3);
insert into bossOf(idBoss, idWorker) values(13, 17);
insert into bossOf(idBoss, idWorker) values(14, 9);
insert into bossOf(idBoss, idWorker) values(15, 17);
insert into bossOf(idBoss, idWorker) values(16, 5);
insert into bossOf(idBoss, idWorker) values(17, 13);
insert into bossOf(idBoss, idWorker) values(18, 19);
insert into bossOf(idBoss, idWorker) values(19, 8);

