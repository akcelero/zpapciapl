drop database if exists zpapciapl;
create database zpapciapl;

use zpapciapl;

create table users(
		`id` int(10) auto_increment,
		`login` varchar(20),
		`password` varchar(32),
		`level` int(3),PRIMARY KEY (ID)
	);

insert into users(login, password, level) values("admin", "admin", "0");
select level from users where login='admin' and password='admin';
