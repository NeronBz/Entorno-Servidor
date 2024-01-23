drop database if exists tenis;
create database tenis;
use tenis;

create table jugador(
    nombre varchar(100) not null primary key,
    ganados int not null default 0
)engine innodb;
insert into jugador(nombre)  values 
('Nadal'),
('Badosa'),
('Muguruza'),
('Alacaraz'),
('Ferrer'),
('Suárez');

create table partido(
	codigo int primary key auto_increment,
	jugador1 varchar(100) not null,
    jugador2 varchar(100) not null,
    fecha date not null,
    numSets int not null default 3,
    finalizado boolean not null default false,
    foreign key(jugador1) references jugador(nombre),
    foreign key(jugador2) references jugador(nombre)
)engine innodb;

insert into partido(jugador1,jugador2,fecha) values
	('Nadal','Suárez',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Badosa','Muguruza',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Nadal','Alacaraz',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Alacaraz','Badosa',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Muguruza','Ferrer',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Ferrer','Nadal',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Alacaraz','Muguruza',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Suárez','Badosa',adddate(curdate(), interval round(rand()*10,0) day)),
    ('Suárez','Ferrer',adddate(curdate(), interval round(rand()*10,0) day));

create table resultadoPartido(
	partido int not null,
    numSet int not null,
    juegosJ1 int not null default 0,
    juegosJ2 int not null default 0,
    primary key(partido,numSet),
    foreign key(partido) references partido(codigo)
)engine Innodb
    

    