/*
MySQL Data Transfer
Source Host: localhost
Source Database: siloh
Target Host: localhost
Target Database: siloh
Date: 22/11/2017 9:55:04 a. m.
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for cliente
-- ----------------------------
DROP TABLE IF EXISTS `cliente`;
CREATE TABLE `cliente` (
  `cli_id` int(20) NOT NULL AUTO_INCREMENT,
  `cli_nombre` varchar(20) NOT NULL,
  `cli_tel` varchar(30) NOT NULL,
  `zon_id` int(20) NOT NULL,
  PRIMARY KEY (`cli_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for empleado
-- ----------------------------
DROP TABLE IF EXISTS `empleado`;
CREATE TABLE `empleado` (
  `emp_id` int(20) NOT NULL AUTO_INCREMENT,
  `emp_nombre` varchar(200) NOT NULL,
  `emp_telefono` varchar(200) NOT NULL,
  PRIMARY KEY (`emp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for estado_tarea
-- ----------------------------
DROP TABLE IF EXISTS `estado_tarea`;
CREATE TABLE `estado_tarea` (
  `est_id` int(11) NOT NULL AUTO_INCREMENT,
  `est_descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`est_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for insumo
-- ----------------------------
DROP TABLE IF EXISTS `insumo`;
CREATE TABLE `insumo` (
  `ins_id` int(10) NOT NULL AUTO_INCREMENT,
  `ins_nombre` varchar(200) NOT NULL,
  `ins_descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`ins_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for localidad
-- ----------------------------
DROP TABLE IF EXISTS `localidad`;
CREATE TABLE `localidad` (
  `loc_id` int(10) NOT NULL AUTO_INCREMENT,
  `loc_nombre` varchar(200) NOT NULL,
  `pro_id` int(20) NOT NULL,
  PRIMARY KEY (`loc_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for medida
-- ----------------------------
DROP TABLE IF EXISTS `medida`;
CREATE TABLE `medida` (
  `med_id` int(11) NOT NULL AUTO_INCREMENT,
  `med_descripcion` varchar(20) NOT NULL,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for provincia
-- ----------------------------
DROP TABLE IF EXISTS `provincia`;
CREATE TABLE `provincia` (
  `pro_id` int(10) NOT NULL AUTO_INCREMENT,
  `pro_nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`pro_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for rango
-- ----------------------------
DROP TABLE IF EXISTS `rango`;
CREATE TABLE `rango` (
  `ran_id` int(20) NOT NULL AUTO_INCREMENT,
  `ran_descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`ran_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tarea
-- ----------------------------
DROP TABLE IF EXISTS `tarea`;
CREATE TABLE `tarea` (
  `tar_id` int(10) NOT NULL AUTO_INCREMENT,
  `tar_descripcion` varchar(200) NOT NULL,
  `tar_estado` binary(2) NOT NULL,
  `cli_id` int(20) NOT NULL,
  `tipPla_id` int(20) NOT NULL,
  `tipTar_id` int(20) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `tar_importe` double(200,2) DEFAULT NULL,
  PRIMARY KEY (`tar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tareaeliminada
-- ----------------------------
DROP TABLE IF EXISTS `tareaeliminada`;
CREATE TABLE `tareaeliminada` (
  `tar_id` int(11) NOT NULL,
  `tar_deleted_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tareaimporte
-- ----------------------------
DROP TABLE IF EXISTS `tareaimporte`;
CREATE TABLE `tareaimporte` (
  `tarImp_id` int(11) NOT NULL AUTO_INCREMENT,
  `tar_id` int(11) NOT NULL,
  `tarImp_importe` double(200,2) NOT NULL,
  `tarImp_fecha` date NOT NULL,
  `cli_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `tipTar_id` int(11) NOT NULL,
  `tipPla_id` int(11) NOT NULL,
  PRIMARY KEY (`tarImp_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tareainiciada
-- ----------------------------
DROP TABLE IF EXISTS `tareainiciada`;
CREATE TABLE `tareainiciada` (
  `tar_id` int(11) NOT NULL,
  `fec_inicio` date NOT NULL,
  `fec_caducidad` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tareainsumo
-- ----------------------------
DROP TABLE IF EXISTS `tareainsumo`;
CREATE TABLE `tareainsumo` (
  `tarIns_id` int(11) NOT NULL AUTO_INCREMENT,
  `tar_id` int(20) NOT NULL,
  `ins_id` int(20) NOT NULL,
  `tarIns_cantidad` int(200) NOT NULL,
  `med_id` int(11) NOT NULL,
  PRIMARY KEY (`tarIns_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tarimpinsumos
-- ----------------------------
DROP TABLE IF EXISTS `tarimpinsumos`;
CREATE TABLE `tarimpinsumos` (
  `tarImp_id` int(11) NOT NULL,
  `ins_id` int(11) NOT NULL,
  `tarIns_cantidad` varchar(20) NOT NULL,
  `med_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tipo_plaga
-- ----------------------------
DROP TABLE IF EXISTS `tipo_plaga`;
CREATE TABLE `tipo_plaga` (
  `tipPla_id` int(10) NOT NULL AUTO_INCREMENT,
  `tipPla_descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`tipPla_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for tipo_tarea
-- ----------------------------
DROP TABLE IF EXISTS `tipo_tarea`;
CREATE TABLE `tipo_tarea` (
  `tipTar_id` int(20) NOT NULL AUTO_INCREMENT,
  `tipTar_descripcion` varchar(200) NOT NULL,
  PRIMARY KEY (`tipTar_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for usuario
-- ----------------------------
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `usu_id` int(20) NOT NULL AUTO_INCREMENT,
  `usu_nombre` varchar(200) NOT NULL,
  `usu_email` varchar(200) NOT NULL,
  `usu_password` varchar(200) NOT NULL,
  `ran_id` int(20) NOT NULL,
  PRIMARY KEY (`usu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Table structure for zona
-- ----------------------------
DROP TABLE IF EXISTS `zona`;
CREATE TABLE `zona` (
  `zon_id` int(10) NOT NULL AUTO_INCREMENT,
  `zon_nombre` varchar(200) NOT NULL,
  `loc_id` int(10) NOT NULL,
  PRIMARY KEY (`zon_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `cliente` VALUES ('1', 'Jose Perez', '4780919', '1');
INSERT INTO `cliente` VALUES ('2', 'PANIFICADORA SOLES S', '4780999', '5');
INSERT INTO `cliente` VALUES ('3', 'ACEROS NID S.A', '4780998', '6');
INSERT INTO `cliente` VALUES ('4', 'Miguel Rodriguez', '4890222', '8');
INSERT INTO `empleado` VALUES ('1', 'Luis Suarez', '3489202');
INSERT INTO `empleado` VALUES ('2', 'Fulano Mengano', '3687990');
INSERT INTO `empleado` VALUES ('3', 'Garcia Juan', '3499999');
INSERT INTO `estado_tarea` VALUES ('1', 'INICIADA');
INSERT INTO `estado_tarea` VALUES ('2', 'FINALIZADA');
INSERT INTO `estado_tarea` VALUES ('3', 'PRECAUCION');
INSERT INTO `insumo` VALUES ('1', 'QUIMICO 01', 'asd aasasd quimico 01');
INSERT INTO `insumo` VALUES ('2', 'QUIMICO 02', 'qwe qwe qwe quimico 02');
INSERT INTO `insumo` VALUES ('3', 'QUMICO 03', 'dfg dfg dfg quimico 03');
INSERT INTO `localidad` VALUES ('1', 'Rio cuarto', '1');
INSERT INTO `localidad` VALUES ('2', 'Rio Tercero', '1');
INSERT INTO `localidad` VALUES ('3', 'Villa Mercedes', '2');
INSERT INTO `localidad` VALUES ('4', 'Merlo', '2');
INSERT INTO `medida` VALUES ('1', 'Gramos');
INSERT INTO `medida` VALUES ('2', 'Centimetros Cubicos');
INSERT INTO `medida` VALUES ('3', 'Litros');
INSERT INTO `medida` VALUES ('4', 'Decimetros Cubicos');
INSERT INTO `provincia` VALUES ('1', 'Cordoba');
INSERT INTO `provincia` VALUES ('2', 'San Luis');
INSERT INTO `rango` VALUES ('0', 'Administrador');
INSERT INTO `rango` VALUES ('1', 'Empleado');
INSERT INTO `rango` VALUES ('2', 'Invitado');
INSERT INTO `tarea` VALUES ('1', 'Nada nuevo, sobro la mitad de la caja', '1', '1', '1', '1', '1', '4367.00');
INSERT INTO `tarea` VALUES ('2', 'Sobro la mitad de la botella', '2', '2', '1', '2', '1', '6677.00');
INSERT INTO `tarea` VALUES ('3', 'Nada importante', '1', '3', '2', '3', '3', '344.00');
INSERT INTO `tarea` VALUES ('4', 'Nada raro', '2', '4', '3', '2', '2', '344.00');
INSERT INTO `tarea` VALUES ('5', 'Nada', '3', '1', '1', '1', '1', '3500.00');
INSERT INTO `tarea` VALUES ('19', 'werw', '1', '1', '1', '1', '2', '233.00');
INSERT INTO `tarea` VALUES ('20', 'werw', '2', '1', '1', '1', '1', '455.00');
INSERT INTO `tarea` VALUES ('21', 'werw', '3', '1', '1', '1', '1', '43553.00');
INSERT INTO `tarea` VALUES ('22', 'df', '1', '2', '3', '2', '3', '33.00');
INSERT INTO `tarea` VALUES ('23', 'sd', '2', '2', '4', '3', '3', '23.00');
INSERT INTO `tarea` VALUES ('24', 'dsf', '1', '2', '2', '2', '1', '345.00');
INSERT INTO `tarea` VALUES ('25', 'dfdf', '1', '1', '2', '2', '3', '5666.00');
INSERT INTO `tarea` VALUES ('26', 'sdf', '3', '1', '1', '1', '3', '455.00');
INSERT INTO `tarea` VALUES ('27', 'dfg', '2', '1', '1', '1', '1', '455.00');
INSERT INTO `tarea` VALUES ('28', 'nada editado', '1', '3', '1', '1', '1', '47.00');
INSERT INTO `tarea` VALUES ('29', 'nada importante', '1', '1', '1', '1', '1', '77.00');
INSERT INTO `tarea` VALUES ('30', 'ssss', '1', '2', '1', '1', '1', '45.00');
INSERT INTO `tarea` VALUES ('31', '', '1', '2', '2', '2', '2', '5.00');
INSERT INTO `tarea` VALUES ('32', '', '1', '0', '0', '0', '0', '0.00');
INSERT INTO `tarea` VALUES ('33', 'nada', '1', '0', '0', '1', '1', '455.00');
INSERT INTO `tareaeliminada` VALUES ('5', '2017-11-14');
INSERT INTO `tareaeliminada` VALUES ('1', '2017-11-20');
INSERT INTO `tareaeliminada` VALUES ('29', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('4', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('2', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('19', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('30', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('25', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('22', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('24', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('20', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('3', '2017-11-22');
INSERT INTO `tareaeliminada` VALUES ('23', '2017-11-22');
INSERT INTO `tareaimporte` VALUES ('26', '1', '788.00', '2017-11-19', '1', '1', '1', '1');
INSERT INTO `tareaimporte` VALUES ('27', '21', '43553.00', '2017-11-20', '1', '1', '1', '1');
INSERT INTO `tareaimporte` VALUES ('28', '4', '344.00', '2017-11-22', '4', '2', '3', '2');
INSERT INTO `tareaimporte` VALUES ('29', '2', '6677.00', '2017-11-22', '2', '1', '1', '2');
INSERT INTO `tareaimporte` VALUES ('30', '20', '455.00', '2017-11-22', '1', '1', '1', '1');
INSERT INTO `tareaimporte` VALUES ('31', '2', '6677.00', '2017-11-22', '2', '1', '1', '2');
INSERT INTO `tareainiciada` VALUES ('1', '2017-11-20', '2017-12-20');
INSERT INTO `tareainiciada` VALUES ('2', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('3', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('4', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('5', '2017-08-01', '2017-09-01');
INSERT INTO `tareainiciada` VALUES ('19', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('20', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('21', '2017-11-20', '2017-11-20');
INSERT INTO `tareainiciada` VALUES ('22', '2017-11-17', '2017-12-17');
INSERT INTO `tareainiciada` VALUES ('23', '2017-11-19', '2017-12-19');
INSERT INTO `tareainiciada` VALUES ('24', '2017-11-19', '2017-12-19');
INSERT INTO `tareainiciada` VALUES ('25', '2017-11-19', '2017-12-19');
INSERT INTO `tareainiciada` VALUES ('26', '2017-11-19', '2017-11-19');
INSERT INTO `tareainiciada` VALUES ('27', '2017-11-19', '2017-12-19');
INSERT INTO `tareainiciada` VALUES ('28', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('29', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('30', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('31', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('32', '2017-11-22', '2017-12-22');
INSERT INTO `tareainiciada` VALUES ('33', '2017-11-22', '2017-12-22');
INSERT INTO `tareainsumo` VALUES ('4', '23', '2', '45', '3');
INSERT INTO `tareainsumo` VALUES ('5', '23', '3', '3', '1');
INSERT INTO `tareainsumo` VALUES ('6', '24', '1', '0', '3');
INSERT INTO `tareainsumo` VALUES ('7', '24', '2', '33', '1');
INSERT INTO `tareainsumo` VALUES ('8', '25', '1', '34', '3');
INSERT INTO `tareainsumo` VALUES ('9', '25', '1', '43', '3');
INSERT INTO `tareainsumo` VALUES ('12', '3', '1', '3', '3');
INSERT INTO `tareainsumo` VALUES ('13', '20', '1', '23', '3');
INSERT INTO `tareainsumo` VALUES ('14', '20', '3', '23', '1');
INSERT INTO `tareainsumo` VALUES ('15', '27', '1', '44', '3');
INSERT INTO `tareainsumo` VALUES ('16', '27', '1', '2', '1');
INSERT INTO `tareainsumo` VALUES ('17', '1', '1', '34', '1');
INSERT INTO `tareainsumo` VALUES ('23', '22', '1', '23', '2');
INSERT INTO `tareainsumo` VALUES ('24', '2', '1', '23', '2');
INSERT INTO `tareainsumo` VALUES ('25', '28', '2', '3', '3');
INSERT INTO `tareainsumo` VALUES ('26', '31', '2', '4', '1');
INSERT INTO `tareainsumo` VALUES ('28', '26', '2', '56', '1');
INSERT INTO `tarimpinsumos` VALUES ('26', '1', '34', '1');
INSERT INTO `tarimpinsumos` VALUES ('27', '1', '34', '1');
INSERT INTO `tarimpinsumos` VALUES ('30', '3', '23', '1');
INSERT INTO `tipo_plaga` VALUES ('1', 'MURCIELAGO');
INSERT INTO `tipo_plaga` VALUES ('2', 'HORMIGA COLORADA');
INSERT INTO `tipo_plaga` VALUES ('3', 'HORMIGA NEGRA');
INSERT INTO `tipo_plaga` VALUES ('4', 'RATA');
INSERT INTO `tipo_plaga` VALUES ('5', 'CUCARACHA');
INSERT INTO `tipo_plaga` VALUES ('6', 'ESCORPION');
INSERT INTO `tipo_tarea` VALUES ('1', 'EXTERMINIO DE PLAGA');
INSERT INTO `tipo_tarea` VALUES ('2', 'LIMPIEZA DE TANQUE DE AGUA');
INSERT INTO `tipo_tarea` VALUES ('3', 'PREVENTIVO');
INSERT INTO `usuario` VALUES ('1', 'Administrador', 'admin@admin', 'admin', '0');
INSERT INTO `usuario` VALUES ('2', 'Empleado', 'emp@emp', 'empleado', '1');
INSERT INTO `zona` VALUES ('1', 'Barrio Alberdi', '1');
INSERT INTO `zona` VALUES ('2', 'Barrio Universidad', '1');
INSERT INTO `zona` VALUES ('3', 'Barrio Hipodromo', '1');
INSERT INTO `zona` VALUES ('4', 'Barrancas Del Rio', '2');
INSERT INTO `zona` VALUES ('5', 'Las Violetas', '2');
INSERT INTO `zona` VALUES ('6', '500 Viviendas', '3');
INSERT INTO `zona` VALUES ('8', 'Piedra Blanca Arriba', '4');
INSERT INTO `zona` VALUES ('9', 'Piedra Blanca Abajo', '4');
