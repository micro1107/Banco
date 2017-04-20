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
id_cuenta int(4) PRIMARY KEY NOT NULL,
tipo varchar(2) NOT NULL,
fecha_crea 
saldo double(10,2),
documento int(15) NOT NULL,
id_sucursal int(4) NOT NULL
);

CREATE TABLE detalle_cuenta(
id_detalle int(2) PRIMARY KEY NOT NULL,
retiro double(10,2),
giro double(10,2),
cuota double(10,2)
);

CREATE TABLE sucursal(
id_sucursal int(4) PRIMARY KEY NOT NULL,
nombre varchar(50) NOT NULL,
direccion varchar(30) NOT NULL,
telefono varchar(15) NOT NULL,
ciudad varchar(50) NOT NULL
);

CREATE TABLE reg_tran(
id_registro int(4) PRIMARY KEY NOT NULL,
cantidad double(10,2) NOT NULL,
cuenta int(15),
fecha 
id_transaccion int(4) NOT NULL,
id_cuenta int(15) NOT NULL
);

CREATE TABLE transaccion(
id_transaccion int(4) PRIMARY KEY NOT NULL,
tipo varchar(2) NOT NULL
);

INSERT INTO rol (id_rol, tipo) VALUES (1,'A');
INSERT INTO rol (id_rol, tipo) VALUES (2,'F');
INSERT INTO rol (id_rol, tipo) VALUES (3,'C');

INSERT INTO usuario (login, pwd, estado, id_rol, documento) VALUES ('pepe',md5(123),'A',1,123);

INSERT INTO cliente (documento, nombre, email, direccion, telefono) VALUES (123, 'Armando Casas', 'armando@gmail.com', 'Carrera 100 56-43', '948828939');

INSERT INTO funcionario (documento, nombre, email, telefono, id_sucursal) VALUES (666, 'Ana Herrera', 'ana@gmail.com', '675665', 1);

