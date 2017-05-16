DROP DATABSE banco;
CREATE DATABASE banco;
USE banco;

CREATE TABLE usuario (
login varchar(50) PRIMARY KEY NOT NULL,
pwd varchar(50) NOT NULL,
estado varchar(2) NOT NULL,
id_rol int(2) NOT NULL,
documento int(15)
);

CREATE TABLE rol(
id_rol int(2) PRIMARY KEY NOT NULL,
tipo varchar(2)
);

CREATE TABLE cliente(
documento int(15) PRIMARY KEY NOT NULL,
nombre varchar(50) NOT NULL,
email varchar(50) NOT NULL,
direccion varchar(30) NOT NULL,
telefono varchar(15) NOT NULL
);

CREATE TABLE funcionario(
documento int(15) PRIMARY KEY NOT NULL,
nombre varchar(50) NOT NULL,
email varchar(50) NOT NULL,
telefono varchar(15) NOT NULL,
id_sucursal int(15) NOT NULL
);

CREATE TABLE cuenta(
id_cuenta int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
tipo varchar(2) NOT NULL,
fecha_crea timestamp DEFAULT current_timestamp,
saldo double(50,2),
estado varchar(2) NOT NULL,
documento int(15) NOT NULL,
id_sucursal int(4) NOT NULL
);


CREATE TABLE sucursal(
id_sucursal int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL ,
nombre varchar(50) NOT NULL,
direccion varchar(30) NOT NULL,
telefono varchar(15) NOT NULL,
ciudad varchar(50) NOT NULL
);

CREATE TABLE reg_tran(
id_registro int(4) PRIMARY KEY AUTO_INCREMENT NOT NULL,
cantidad double(10,2) NOT NULL,
cuenta int(15),
fecha timestamp DEFAULT current_timestamp,
id_transaccion int(4) NOT NULL,
id_cuenta int(15) NOT NULL
);

CREATE TABLE transaccion(
id_transaccion int(4) PRIMARY KEY NOT NULL,
tipo varchar(2) NOT NULL
);


CREATE TABLE persona_archivo (
  
id int(11) primary key auto_increment,
  
id_persona int(15) NOT NULL,
  
nombre varchar(100) NOT NULL,
  
tipo varchar(30) NOT NULL,
  
archivo mediumblob NOT NULL 
  

) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE tmp_registro (
	id_registro int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
	cantidad double(10,2) NOT NULL,
	cuenta int(15) NOT NULL,
	fecha timestamp DEFAULT current_timestamp,
	id_transaccion int(4) NOT NULL,
	id_cuenta int(15) NOT NULL
);

INSERT INTO rol (id_rol, tipo) VALUES (1,'A');
INSERT INTO rol (id_rol, tipo) VALUES (2,'F');
INSERT INTO rol (id_rol, tipo) VALUES (3,'C');

INSERT INTO usuario (login, pwd, estado, id_rol, documento) VALUES ('pepe',md5(123),'A',1,123);

INSERT INTO transaccion (id_transaccion, tipo) VALUES (1, 'C');
INSERT INTO transaccion (id_transaccion, tipo) VALUES (2, 'R');
INSERT INTO transaccion (id_transaccion, tipo) VALUES (3, 'T');
INSERT INTO transaccion (id_transaccion, tipo) VALUES (4, 'S');

