-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: prestadores_iess
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `dct_sistema_tbl_aplicacion`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_aplicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_aplicacion` (
  `apl_id_aplicacion` int(11) NOT NULL,
  `apl_aplicacion` varchar(20) NOT NULL,
  `apl_ruta` varchar(100) NOT NULL,
  `apl_estado` tinyint(1) NOT NULL,
  `apl_nom_superior` varchar(40) NOT NULL,
  `apl_nom_inferior` varchar(40) NOT NULL,
  `apl_id_htm` varchar(20) NOT NULL,
  `apl_id_imagen` varchar(50) NOT NULL,
  PRIMARY KEY (`apl_id_aplicacion`),
  UNIQUE KEY `apl_aplicacion` (`apl_aplicacion`,`apl_ruta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_aplicacion`
--

LOCK TABLES `dct_sistema_tbl_aplicacion` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_aplicacion` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_aplicacion` VALUES (1,'Administración','../../../webAdministracion',1,'Administración','Web','indexLinkTics','fa fa-laptop'),(2,'Mi Negocio','../../../webMiNegocio',1,'Mi Negocio','Web','indexLinkFacturacion','fa fa-laptop'),(3,'Reportes','../../../webReportes',1,'Reportes','Web','indexLinkSalud','fa fa-laptop'),(4,'ssdfsdf','../../../webApiWhatsapp',1,'API Whatsapp','Web','indexLinkSalud','fa fa-laptop');
/*!40000 ALTER TABLE `dct_sistema_tbl_aplicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_aplicacion_empresa`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_aplicacion_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_aplicacion_empresa` (
  `ape_id_aplicacion` int(11) NOT NULL,
  `ape_id_empresa` int(11) NOT NULL,
  `ape_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`ape_id_aplicacion`,`ape_id_empresa`),
  KEY `ape_id_empresa` (`ape_id_empresa`),
  CONSTRAINT `dct_sistema_tbl_aplicacion_empresa_ibfk_1` FOREIGN KEY (`ape_id_aplicacion`) REFERENCES `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`),
  CONSTRAINT `dct_sistema_tbl_aplicacion_empresa_ibfk_2` FOREIGN KEY (`ape_id_empresa`) REFERENCES `dct_sistema_tbl_empresa` (`emp_id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_aplicacion_empresa`
--

LOCK TABLES `dct_sistema_tbl_aplicacion_empresa` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_aplicacion_empresa` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_aplicacion_empresa` VALUES (1,1,1),(1,2,1),(1,3,1),(2,1,1),(2,3,1),(3,1,1),(3,2,1);
/*!40000 ALTER TABLE `dct_sistema_tbl_aplicacion_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_catalogo`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_catalogo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_catalogo` (
  `ctg_id_catalogo` int(11) NOT NULL AUTO_INCREMENT,
  `ctg_key` varchar(2) NOT NULL,
  `ctg_descripcion` varchar(20) NOT NULL,
  `ctg_aplicativo` varchar(20) NOT NULL,
  PRIMARY KEY (`ctg_id_catalogo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_catalogo`
--

LOCK TABLES `dct_sistema_tbl_catalogo` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_catalogo` DISABLE KEYS */;
/*!40000 ALTER TABLE `dct_sistema_tbl_catalogo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_contrasenia`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_contrasenia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_contrasenia` (
  `cts_id_contrasenia` bigint(20) NOT NULL AUTO_INCREMENT,
  `cts_contrasenia` varchar(150) NOT NULL,
  `cts_cod_usuario` varchar(13) NOT NULL,
  `cts_fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cts_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`cts_id_contrasenia`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_contrasenia`
--

LOCK TABLES `dct_sistema_tbl_contrasenia` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_contrasenia` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_contrasenia` VALUES (22,'dFoxdnY4cjZ0d1BFNWRBZmxUL1ZLUW9QaWRUalJQZEU4SWFPQVNuS1ovRXNOYzlGMURSVFJuRGVNVHZ6ajBtRQ==','1234567891','2022-03-18 18:57:03',1),(23,'QWJkeEVnd0NTZ2k0Y2QybkhwVG9MeTBCVnJzUjk4OHd6L1NRWUk1TS9xUjVUeGZ1U0pTQk5pZXhrb2huVFB0TA==','1234567891','2022-03-18 18:57:05',1);
/*!40000 ALTER TABLE `dct_sistema_tbl_contrasenia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_empresa`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_empresa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_empresa` (
  `emp_id_empresa` int(11) NOT NULL,
  `emp_empresa` varchar(80) NOT NULL,
  `emp_ruc` varchar(13) NOT NULL,
  `emp_estado` tinyint(1) NOT NULL,
  `emp_vigencia_desde` date DEFAULT NULL,
  `emp_vigencia_hasta` date DEFAULT NULL,
  PRIMARY KEY (`emp_id_empresa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_empresa`
--

LOCK TABLES `dct_sistema_tbl_empresa` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_empresa` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_empresa` VALUES (1,'Dreconstec','0919664854001',1,'2022-02-08','2500-12-31'),(2,'Odontocenter Salud','0264650623001',1,'2022-02-08','2022-02-28'),(3,'Medical Factura','0264781245001',1,'2022-02-08','2022-02-28');
/*!40000 ALTER TABLE `dct_sistema_tbl_empresa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_opcion`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_opcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_opcion` (
  `opc_id_opcion` int(11) NOT NULL AUTO_INCREMENT,
  `opc_opcion` varchar(40) NOT NULL,
  `opc_estado` tinyint(1) NOT NULL,
  `opc_ruta` varchar(50) NOT NULL,
  `opc_id_aplicacion` int(11) NOT NULL,
  `opc_orden` int(11) NOT NULL,
  PRIMARY KEY (`opc_id_opcion`),
  KEY `opc_id_aplicacion` (`opc_id_aplicacion`),
  CONSTRAINT `dct_sistema_tbl_opcion_ibfk_1` FOREIGN KEY (`opc_id_aplicacion`) REFERENCES `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_opcion`
--

LOCK TABLES `dct_sistema_tbl_opcion` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_opcion` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_opcion` VALUES (1,'Bienvenido',1,'/pages/bienvenido',1,1),(2,'Usuarios',1,'/pages/administrarUsuarios',1,2),(3,'Sistema',1,'/pages/administrarSistema',1,3),(4,'Perfíl',1,'/pages/administrarPerfil',1,4),(5,'Principal',1,'/pages/principal',3,1),(6,'Admisión',1,'/pages/Admisión',3,2),(7,'Enfermería',1,'/pages/estacionEnfermeria',3,3),(8,'Médicos',1,'/pages/atencionMedica',3,4),(9,'Historia Clínical',1,'/pages/historiaClínica',3,5),(10,'Estadística',1,'/pages/estadistica',3,7),(11,'Reportes',1,'/pages/resportes',3,8),(12,'Administración',1,'/pages/administracion',3,9),(13,'Consulta de Citas',1,'/pages/consultaCitas',3,6),(14,'Principal',1,'/pages/principal',2,6),(15,'Venta Facturación',1,'/pages/ventaFacturacion',2,6);
/*!40000 ALTER TABLE `dct_sistema_tbl_opcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_rol`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_rol` (
  `rol_id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol_rol` varchar(30) NOT NULL,
  `rol_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`rol_id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_rol`
--

LOCK TABLES `dct_sistema_tbl_rol` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_rol` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_rol` VALUES (1,'Developer',1),(2,'Administrador',1),(3,'Paciente',1),(4,'Médico',1);
/*!40000 ALTER TABLE `dct_sistema_tbl_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_rol_aplicacion`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_rol_aplicacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_rol_aplicacion` (
  `rla_id` int(11) NOT NULL AUTO_INCREMENT,
  `rla_id_rol` int(11) NOT NULL,
  `rla_id_aplicacion` int(11) NOT NULL,
  `rla_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`rla_id`),
  KEY `dct_sistema_tbl_rol_aplicacion_ibfk_1` (`rla_id_rol`),
  KEY `dct_sistema_tbl_rol_aplicacion_ibfk_2` (`rla_id_aplicacion`),
  CONSTRAINT `dct_sistema_tbl_rol_aplicacion_ibfk_1` FOREIGN KEY (`rla_id_rol`) REFERENCES `dct_sistema_tbl_rol` (`rol_id_rol`),
  CONSTRAINT `dct_sistema_tbl_rol_aplicacion_ibfk_2` FOREIGN KEY (`rla_id_aplicacion`) REFERENCES `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_rol_aplicacion`
--

LOCK TABLES `dct_sistema_tbl_rol_aplicacion` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_rol_aplicacion` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_rol_aplicacion` VALUES (16,1,1,1),(17,1,2,1),(18,1,3,1);
/*!40000 ALTER TABLE `dct_sistema_tbl_rol_aplicacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_rol_opcion`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_rol_opcion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_rol_opcion` (
  `rlo_id` int(11) NOT NULL AUTO_INCREMENT,
  `rlo_id_rol` int(11) NOT NULL,
  `rlo_id_opcion` int(11) NOT NULL,
  `rlo_estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`rlo_id`),
  KEY `dct_sistema_tbl_rol_opcion_ibfk_1` (`rlo_id_rol`),
  KEY `dct_sistema_tbl_rol_opcion_ibfk_2` (`rlo_id_opcion`),
  CONSTRAINT `dct_sistema_tbl_rol_opcion_ibfk_1` FOREIGN KEY (`rlo_id_rol`) REFERENCES `dct_sistema_tbl_rol` (`rol_id_rol`),
  CONSTRAINT `dct_sistema_tbl_rol_opcion_ibfk_2` FOREIGN KEY (`rlo_id_opcion`) REFERENCES `dct_sistema_tbl_opcion` (`opc_id_opcion`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_rol_opcion`
--

LOCK TABLES `dct_sistema_tbl_rol_opcion` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_rol_opcion` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_rol_opcion` VALUES (66,1,1,1),(67,1,2,1),(68,1,3,1),(69,1,4,1),(70,1,5,1),(71,1,6,1);
/*!40000 ALTER TABLE `dct_sistema_tbl_rol_opcion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_token`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_token`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_token` (
  `tok_id_token` bigint(20) NOT NULL AUTO_INCREMENT,
  `tok_token` varchar(150) DEFAULT NULL,
  `tok_tipo` varchar(10) DEFAULT NULL,
  `tok_cedula` varchar(13) DEFAULT NULL,
  `tok_fecha` timestamp NULL DEFAULT NULL,
  `tok_estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`tok_id_token`),
  KEY `tok_id_token` (`tok_id_token`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_token`
--

LOCK TABLES `dct_sistema_tbl_token` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_token` DISABLE KEYS */;
/*!40000 ALTER TABLE `dct_sistema_tbl_token` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_usuario`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_usuario` (
  `usr_id_usuario` bigint(20) NOT NULL AUTO_INCREMENT,
  `usr_cod_usuario` varchar(13) NOT NULL,
  `usr_nombre_1` varchar(15) NOT NULL,
  `usr_nombre_2` varchar(15) NOT NULL,
  `usr_apellido_1` varchar(15) NOT NULL,
  `usr_apellido_2` varchar(15) NOT NULL,
  `usr_contrasenia` varchar(500) NOT NULL,
  `usr_logeado` tinyint(1) NOT NULL,
  `usr_estado` tinyint(1) NOT NULL,
  `usr_ip_pc_acceso` varchar(100) DEFAULT NULL,
  `usr_fecha_acceso` timestamp NULL DEFAULT NULL,
  `usr_correo` varchar(60) NOT NULL,
  `usr_id_rol` int(11) NOT NULL,
  `usr_estado_contrasenia` tinyint(1) NOT NULL,
  `usr_id_empresa` int(11) NOT NULL,
  `usr_fecha_cambio_contrasenia` date DEFAULT NULL,
  `usr_contador_error_contrasenia` smallint(6) DEFAULT NULL,
  `usr_expiro_contrasenia` tinyint(1) NOT NULL,
  `usr_ultimo_acceso` date DEFAULT NULL,
  `usr_usuario_creacion` varchar(13) DEFAULT NULL,
  `usr_usuario_modificacion` varchar(13) DEFAULT NULL,
  `usr_fecha_creacion` timestamp NULL DEFAULT NULL,
  `usr_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `usr_ip_creacion` varchar(100) DEFAULT NULL,
  `usr_ip_modificacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`usr_id_usuario`),
  UNIQUE KEY `usr_cod_usuario` (`usr_cod_usuario`),
  KEY `usr_id_empresa` (`usr_id_empresa`),
  KEY `usr_id_usuario` (`usr_id_usuario`),
  CONSTRAINT `dct_sistema_tbl_usuario_ibfk_1` FOREIGN KEY (`usr_id_empresa`) REFERENCES `dct_sistema_tbl_empresa` (`emp_id_empresa`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_usuario`
--

LOCK TABLES `dct_sistema_tbl_usuario` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_usuario` DISABLE KEYS */;
INSERT INTO `dct_sistema_tbl_usuario` VALUES (1,'0919664854','Mauro','Vinicio','Echeverría','Chugulí','amkyZWwvV0EzTjA5Q2kvKy85aUoxQjh3K1dxZ3kxQlp6NnBwb0E3cGRmVS9VL3cxcHJwOEZaT0tRa2V3N2hSNw==',0,1,NULL,NULL,'maurovinicio.echeverria@gmail.com',1,1,1,'2022-01-15',0,0,'2022-05-21','0919664854','0919664854','2021-05-19 10:20:25','2021-05-19 10:20:25','DESKTOP-5L9FRDR','DESKTOP-5L9FRDR');
/*!40000 ALTER TABLE `dct_sistema_tbl_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dct_sistema_tbl_usuario_adicional`
--

DROP TABLE IF EXISTS `dct_sistema_tbl_usuario_adicional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dct_sistema_tbl_usuario_adicional` (
  `adi_id_usuario` bigint(20) NOT NULL,
  `adi_fecha_nacimiento` date DEFAULT NULL,
  `adi_sexo` varchar(9) DEFAULT NULL,
  `adi_estado_civil` varchar(12) DEFAULT NULL,
  `adi_instruccion` varchar(11) DEFAULT NULL,
  `adi_tipo_sangre` varchar(9) DEFAULT NULL,
  `adi_telefono` varchar(10) DEFAULT NULL,
  `adi_provincia` varchar(5) DEFAULT NULL,
  `adi_canton` varchar(7) DEFAULT NULL,
  `adi_parroquia` varchar(9) DEFAULT NULL,
  `adi_direccion` varchar(70) DEFAULT NULL,
  `adi_referencia` varchar(25) DEFAULT NULL,
  `usr_usuario_creacion` varchar(13) DEFAULT NULL,
  `usr_usuario_modificacion` varchar(13) DEFAULT NULL,
  `usr_fecha_creacion` timestamp NULL DEFAULT NULL,
  `usr_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `usr_ip_creacion` varchar(100) DEFAULT NULL,
  `usr_ip_modificacion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`adi_id_usuario`),
  CONSTRAINT `dct_sistema_tbl_usuario_adicional_ibfk_1` FOREIGN KEY (`adi_id_usuario`) REFERENCES `dct_sistema_tbl_usuario` (`usr_id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dct_sistema_tbl_usuario_adicional`
--

LOCK TABLES `dct_sistema_tbl_usuario_adicional` WRITE;
/*!40000 ALTER TABLE `dct_sistema_tbl_usuario_adicional` DISABLE KEYS */;
/*!40000 ALTER TABLE `dct_sistema_tbl_usuario_adicional` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-23 14:18:48
