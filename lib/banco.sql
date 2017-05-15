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

CREATE TABLE detalle_cuenta(
id_detalle int(2) PRIMARY KEY NOT NULL,
retiro double(10,2),
giro double(10,2),
cuota double(10,2)
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


CREATE TABLE archivos (
  id int(10) unsigned PRIMARY KEY NOT NULL auto_increment,
  archivo_binario medium_blob NOT NULL,
  archivo_nombre varchar(255) NOT NULL default '',
  archivo_peso varchar(15) NOT NULL default '',
  archivo_tipo varchar(25) NOT NULL default '',
  documento int(15) NOT NULL
) ;

CREATE TABLE persona_archivo (
  
id int(11) primary key auto_increment,
  
id_persona int(15) NOT NULL,
  
nombre varchar(100) NOT NULL,
  
tipo varchar(30) NOT NULL,
  
archivo mediumblob NOT NULL 
  

) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE tmp_registro (
	id int(10) PRIMARY KEY NOT NULL AUTO_INCREMENT,
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

INSERT INTO cliente (documento, nombre, email, direccion, telefono) VALUES (123, 'Armando Casas', 'armando@gmail.com', 'Carrera 100 56-43', '948828939');

INSERT INTO funcionario (documento, nombre, email, telefono, id_sucursal) VALUES (666, 'Ana Herrera', 'ana@gmail.com', '675665', 1);

INSERT INTO sucursal (nombre, direccion, telefono, ciudad) VALUES ('Centro', 'Calle 5 13-9', '648823', 'Cali');
INSERT INTO sucursal (nombre, direccion, telefono, ciudad) VALUES ('Ciudad Jardin', 'Calle 5 124-31', '787882', 'Cali');

INSERT INTO cuenta (tipo, estado, saldo, documento, id_sucursal) VALUES ('A', 'A', 1000000, 123, 2);

INSERT INTO transaccion (id_transaccion, tipo) VALUES (1, 'C');
INSERT INTO transaccion (id_transaccion, tipo) VALUES (2, 'R');
INSERT INTO transaccion (id_transaccion, tipo) VALUES (3, 'T');
INSERT INTO transaccion (id_transaccion, tipo) VALUES (4, 'S');

SELECT c.id_cuenta, c.tipo, c.saldo, c.id_sucursal, c.fecha_crea, c.estado, c.documento, p.nombre as person, s.nombre 
FROM cuenta c , cliente p , sucursal s  WHERE c.documento = p.documento and c.id_sucursal = s.id_sucursal order by c.fecha_crea;

SELECT s.nombre, sum(r.cantidad) as total, c.id_sucursal
FROM  cuenta c , sucursal s , reg_tran r WHERE r.id_cuenta = c.id_cuenta AND c.id_sucursal = s.id_sucursal GROUP BY s.id_sucursal ORDER BY total desc;
