-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-10-2022 a las 04:25:30
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_prestadores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_cabecera_electronica`
--

CREATE TABLE `datos_cabecera_electronica` (
  `id` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `orden_no` int(11) NOT NULL,
  `cliente` varchar(50) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `telefono` int(11) NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `tipo_comporbante` int(11) NOT NULL,
  `tipo_identificacion` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `establecimiento` varchar(45) DEFAULT NULL,
  `punto_emi` varchar(45) DEFAULT NULL,
  `ruc_empresa` varchar(45) DEFAULT NULL,
  `ambiente` varchar(45) DEFAULT NULL,
  `razon_social` varchar(45) DEFAULT NULL,
  `nombre_comercial` varchar(45) DEFAULT NULL,
  `secuencial` int(11) DEFAULT NULL,
  `direccion_matriz` varchar(45) DEFAULT NULL,
  `obligado` varchar(2) DEFAULT NULL,
  `nota_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_cabecera_electronica`
--

INSERT INTO `datos_cabecera_electronica` (`id`, `id_comprobante`, `fecha`, `orden_no`, `cliente`, `direccion`, `telefono`, `ruc`, `tipo_comporbante`, `tipo_identificacion`, `correo`, `establecimiento`, `punto_emi`, `ruc_empresa`, `ambiente`, `razon_social`, `nombre_comercial`, `secuencial`, `direccion_matriz`, `obligado`, `nota_no`) VALUES
(1, 1, '2022-08-08', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 4, 4, 'kaceto104@gmail.com', '001', '001', '0919664854001', '1', 'Dreconstec', 'Dreconstec', 1181, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1),
(9, 2, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 4, 4, 'kaceto104@gmail.com', '001', '002', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 1143, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1),
(10, 3, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 4, 4, 'kaceto104@gmail.com', '001', '002', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 1143, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1),
(11, 4, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 5, 5, 'kaceto104@gmail.com', '001', '001', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 1142, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1),
(12, 25, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 6, 6, 'kaceto104@gmail.com', '001', '001', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 0, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_guia_electronica`
--

CREATE TABLE `datos_guia_electronica` (
  `id` int(11) NOT NULL,
  `ambiente` int(11) DEFAULT NULL,
  `id_comprobante` int(11) DEFAULT NULL,
  `tipo_emision` int(11) DEFAULT NULL,
  `razon_social` varchar(45) DEFAULT NULL,
  `nombre_comercial` varchar(45) DEFAULT NULL,
  `cod_doc` int(11) DEFAULT NULL,
  `ruc` varchar(45) DEFAULT NULL,
  `establecimiento` varchar(4) DEFAULT NULL,
  `pto_emi` varchar(3) DEFAULT NULL,
  `secuencial` varchar(45) DEFAULT NULL,
  `dir_matriz` varchar(45) DEFAULT NULL,
  `orden_no` int(11) NOT NULL,
  `t_nombre` varchar(50) NOT NULL,
  `t_ci` varchar(13) NOT NULL,
  `motivo_translado` varchar(250) NOT NULL,
  `fecha` date NOT NULL,
  `comprobante_venta` int(11) NOT NULL,
  `tipo_ident_transport` int(11) DEFAULT NULL,
  `t_contabilidad` varchar(3) DEFAULT NULL,
  `t_f_inicio` date NOT NULL,
  `t_f_final` date NOT NULL,
  `t_placa` varchar(9) NOT NULL,
  `punto_partida` varchar(250) NOT NULL,
  `d_ruc` varchar(13) NOT NULL,
  `d_razon_social` varchar(250) NOT NULL,
  `d_punto_llegada` varchar(250) NOT NULL,
  `tipo_comprobante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='		';

--
-- Volcado de datos para la tabla `datos_guia_electronica`
--

INSERT INTO `datos_guia_electronica` (`id`, `ambiente`, `id_comprobante`, `tipo_emision`, `razon_social`, `nombre_comercial`, `cod_doc`, `ruc`, `establecimiento`, `pto_emi`, `secuencial`, `dir_matriz`, `orden_no`, `t_nombre`, `t_ci`, `motivo_translado`, `fecha`, `comprobante_venta`, `tipo_ident_transport`, `t_contabilidad`, `t_f_inicio`, `t_f_final`, `t_placa`, `punto_partida`, `d_ruc`, `d_razon_social`, `d_punto_llegada`, `tipo_comprobante`) VALUES
(2, 1, 25, 1, 'prueba', 'asdasd', 1, '1716762396001', '001', '001', '1150', 'adsad', 1, 'd', '1716762396001', 'd', '2022-08-05', 1, 4, 'SI', '2022-08-05', '2022-08-05', '001XYZ', 'asd', '1717091506001', 'aaa', 'aaaa', 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_nota_credito`
--

CREATE TABLE `datos_nota_credito` (
  `id` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL DEFAULT 0,
  `ambiente` int(11) DEFAULT NULL,
  `tipoEmision` int(11) DEFAULT NULL,
  `razonSocial` varchar(45) DEFAULT NULL,
  `nombreComercial` varchar(45) DEFAULT NULL,
  `ruc` varchar(45) DEFAULT NULL,
  `cod_doc` int(11) DEFAULT NULL,
  `establecimiento` varchar(45) DEFAULT NULL,
  `ptoEmi` varchar(45) DEFAULT NULL,
  `secuencial` int(11) DEFAULT NULL,
  `dirMatriz` varchar(45) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `dirEstablecimiento` varchar(45) DEFAULT NULL,
  `tipoIdentificacionComprador` int(11) DEFAULT NULL,
  `identificacionComprador` varchar(45) DEFAULT NULL,
  `codDocmodificado` int(11) DEFAULT NULL,
  `numDocModificado` varchar(50) DEFAULT NULL,
  `contribuyenteEspecial` int(11) DEFAULT NULL,
  `obligadoContabilidad` varchar(45) DEFAULT NULL,
  `rise` varchar(45) DEFAULT NULL,
  `fechaEmisionDocSustento` date DEFAULT NULL,
  `total_sin_impuestos` decimal(19,4) DEFAULT NULL,
  `valorModificacion` decimal(19,4) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `codigoPorcentaje` int(11) DEFAULT NULL,
  `baseImponible` int(11) DEFAULT NULL,
  `valor` decimal(19,4) DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `nota_no` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_nota_credito`
--

INSERT INTO `datos_nota_credito` (`id`, `id_comprobante`, `ambiente`, `tipoEmision`, `razonSocial`, `nombreComercial`, `ruc`, `cod_doc`, `establecimiento`, `ptoEmi`, `secuencial`, `dirMatriz`, `fecha_emision`, `dirEstablecimiento`, `tipoIdentificacionComprador`, `identificacionComprador`, `codDocmodificado`, `numDocModificado`, `contribuyenteEspecial`, `obligadoContabilidad`, `rise`, `fechaEmisionDocSustento`, `total_sin_impuestos`, `valorModificacion`, `codigo`, `codigoPorcentaje`, `baseImponible`, `valor`, `motivo`, `nota_no`) VALUES
(1, 2, 1, 1, 'COQUE TENORIO MARIA YOLANDA', 'COQUE TENORIO MARIA YOLANDA', '1716762396001', 4, '001', '001', 1015, 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', '2022-02-16', 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', 4, '1716762396001', 1, '000022323', NULL, 'NO', NULL, '2019-02-02', '11.0000', '11.0000', 2, 0, 999, '0.0000', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_nota_debito`
--

CREATE TABLE `datos_nota_debito` (
  `id` int(11) NOT NULL,
  `id_comprobante` int(11) NOT NULL DEFAULT 0,
  `ambiente` int(11) DEFAULT NULL,
  `tipoEmision` int(11) DEFAULT NULL,
  `razonSocialComprador` varchar(45) DEFAULT NULL,
  `nombreComercial` varchar(45) DEFAULT NULL,
  `cod_doc` int(11) DEFAULT NULL,
  `establecimiento` varchar(45) DEFAULT NULL,
  `secuencial` int(11) DEFAULT NULL,
  `direccion_matriz` varchar(45) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `dirEstablecimiento` varchar(45) DEFAULT NULL,
  `tipoIdentificacionComprador` int(11) DEFAULT NULL,
  `identificacionComprador` varchar(45) DEFAULT NULL,
  `codDocmodificado` int(11) DEFAULT NULL,
  `numDocModificado` varchar(50) DEFAULT NULL,
  `contribuyenteEspecial` int(11) DEFAULT NULL,
  `obligadoContabilidad` varchar(45) DEFAULT NULL,
  `fechaEmisionDocSustento` date DEFAULT NULL,
  `total_sin_impuestos` decimal(19,4) DEFAULT NULL,
  `codigo` int(2) DEFAULT NULL,
  `codigoPorcentaje` int(11) DEFAULT NULL,
  `baseImponible` int(11) DEFAULT NULL,
  `valor` decimal(19,4) DEFAULT NULL,
  `tarifa` decimal(19,4) DEFAULT NULL,
  `valorTotal` decimal(19,4) DEFAULT NULL,
  `formapago` int(2) DEFAULT NULL,
  `total` decimal(19,4) DEFAULT NULL,
  `plazo` int(2) DEFAULT NULL,
  `unidadTiempo` varchar(45) DEFAULT NULL,
  `razonDescripcion` varchar(45) DEFAULT NULL,
  `valorModificado` decimal(19,4) DEFAULT NULL,
  `campoAdiconalDirecci` varchar(300) DEFAULT NULL,
  `campoAdicionalMail` varchar(300) DEFAULT NULL,
  `campoAdionalFono` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_nota_debito`
--

INSERT INTO `datos_nota_debito` (`id`, `id_comprobante`, `ambiente`, `tipoEmision`, `razonSocialComprador`, `nombreComercial`, `cod_doc`, `establecimiento`, `secuencial`, `direccion_matriz`, `fecha_emision`, `dirEstablecimiento`, `tipoIdentificacionComprador`, `identificacionComprador`, `codDocmodificado`, `numDocModificado`, `contribuyenteEspecial`, `obligadoContabilidad`, `fechaEmisionDocSustento`, `total_sin_impuestos`, `codigo`, `codigoPorcentaje`, `baseImponible`, `valor`, `tarifa`, `valorTotal`, `formapago`, `total`, `plazo`, `unidadTiempo`, `razonDescripcion`, `valorModificado`, `campoAdiconalDirecci`, `campoAdicionalMail`, `campoAdionalFono`) VALUES
(1, 22, 1, 1, 'aaaa', 'aaa', 5, '001', 1010, 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', '2018-10-05', 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', 4, '1706034756', 1, '000222323', NULL, 'SI', '2019-02-01', '11.0000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_retencion_electronica`
--

CREATE TABLE `datos_retencion_electronica` (
  `id` int(11) NOT NULL,
  `ambiente` int(3) NOT NULL,
  `id_comprobante` int(5) NOT NULL,
  `orden_no` int(5) NOT NULL,
  `tipo_emision` int(3) DEFAULT NULL,
  `razon_social` varchar(100) DEFAULT NULL,
  `nombre_comercial` varchar(45) DEFAULT NULL,
  `ruc` varchar(45) DEFAULT NULL,
  `cod_doc` int(11) DEFAULT NULL,
  `estab` varchar(45) DEFAULT NULL,
  `pto_emi` varchar(45) DEFAULT NULL,
  `secuencial` int(11) DEFAULT NULL,
  `dir_matriz` varchar(100) DEFAULT NULL,
  `fecha_emision` date DEFAULT NULL,
  `dir_establecimiento` varchar(100) DEFAULT NULL,
  `contribuyente_especial` varchar(45) DEFAULT NULL,
  `obligado_contabilidad` varchar(2) DEFAULT NULL,
  `tipo_identificacion_sujeto_retenido` int(11) DEFAULT NULL,
  `razon_social_sujeto_retenido` varchar(100) DEFAULT NULL,
  `identificacion_sujeto_retenido` varchar(45) DEFAULT NULL,
  `periodo_fiscal` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `datos_retencion_electronica`
--

INSERT INTO `datos_retencion_electronica` (`id`, `ambiente`, `id_comprobante`, `orden_no`, `tipo_emision`, `razon_social`, `nombre_comercial`, `ruc`, `cod_doc`, `estab`, `pto_emi`, `secuencial`, `dir_matriz`, `fecha_emision`, `dir_establecimiento`, `contribuyente_especial`, `obligado_contabilidad`, `tipo_identificacion_sujeto_retenido`, `razon_social_sujeto_retenido`, `identificacion_sujeto_retenido`, `periodo_fiscal`) VALUES
(2, 1, 25, 1, 1, 'asdsa', 'asdasd', '123123213', 7, '001', '001', 1147, 'asdasd', '2022-08-05', 'a', NULL, 'SI', 4, 'dfgfdgfdg', '1792206375001', '2022-08-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_parametro_tbl_div_politica`
--

CREATE TABLE `dct_parametro_tbl_div_politica` (
  `dvp_codigo_provincia` varchar(5) NOT NULL,
  `dvp_provincia` varchar(30) NOT NULL,
  `dvp_codigo_canton` varchar(7) NOT NULL,
  `dvp_canton` varchar(35) NOT NULL,
  `dvp_codigo_parroquia` varchar(9) NOT NULL,
  `dvp_parroquia` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_parametro_tbl_div_politica`
--

INSERT INTO `dct_parametro_tbl_div_politica` (`dvp_codigo_provincia`, `dvp_provincia`, `dvp_codigo_canton`, `dvp_canton`, `dvp_codigo_parroquia`, `dvp_parroquia`) VALUES
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010101', 'BELLAVISTA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010102', 'CAÑARIBAMBA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010103', 'EL BATÁN'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010104', 'EL SAGRARIO'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010105', 'EL VECINO'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010106', 'GIL RAMÍREZ DÁVALOS'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010107', 'HUAYNACÁPAC'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010108', 'MACHÁNGARA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010109', 'MONAY'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010110', 'SAN BLAS'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010111', 'SAN SEBASTIÁN'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010112', 'SUCRE'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010113', 'TOTORACOCHA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010114', 'YANUNCAY'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010115', 'HERMANO MIGUEL'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010150', 'CUENCA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010151', 'BAÑOS'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010152', 'CUMBE'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010153', 'CHAUCHA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010154', 'CHECA (JIDCAY)'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010155', 'CHIQUINTAD'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010156', 'LLACAO'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010157', 'MOLLETURO'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010158', 'NULTI'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010159', 'OCTAVIO CORDERO PALACIOS (SANTA ROSA)'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010160', 'PACCHA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010161', 'QUINGEO'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010162', 'RICAURTE'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010163', 'SAN JOAQUÍN'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010164', 'SANTA ANA'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010165', 'SAYAUSÍ'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010166', 'SIDCAY'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010167', 'SININCAY'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010168', 'TARQUI'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010169', 'TURI'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010170', 'VALLE'),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010171', 'VICTORIA DEL PORTETE (IRQUIS)'),
('PR_01', 'AZUAY', 'CN_0102', 'GIRÓN', 'PQ_010250', 'GIRÓN'),
('PR_01', 'AZUAY', 'CN_0102', 'GIRÓN', 'PQ_010251', 'ASUNCIÓN'),
('PR_01', 'AZUAY', 'CN_0102', 'GIRÓN', 'PQ_010252', 'SAN GERARDO'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010350', 'GUALACEO'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010351', 'CHORDELEG'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010352', 'DANIEL CÓRDOVA TORAL (EL ORIENTE)'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010353', 'JADÁN'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010354', 'MARIANO MORENO'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010355', 'PRINCIPAL'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010356', 'REMIGIO CRESPO TORAL (GÚLAG)'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010357', 'SAN JUAN'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010358', 'ZHIDMAD'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010359', 'LUIS CORDERO VEGA'),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010360', 'SIMÓN BOLÍVAR (CAB. EN GAÑANZOL)'),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010450', 'NABÓN'),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010451', 'COCHAPATA'),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010452', 'EL PROGRESO (CAB.EN ZHOTA)'),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010453', 'LAS NIEVES (CHAYA)'),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010454', 'OÑA'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010550', 'PAUTE'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010551', 'AMALUZA'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010552', 'BULÁN (JOSÉ VÍCTOR IZQUIERDO)'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010553', 'CHICÁN (GUILLERMO ORTEGA)'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010554', 'EL CABO'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010555', 'GUACHAPALA'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010556', 'GUARAINAG'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010557', 'PALMAS'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010558', 'PAN'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010559', 'SAN CRISTÓBAL (CARLOS ORDÓÑEZ LAZO)'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010560', 'SEVILLA DE ORO'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010561', 'TOMEBAMBA'),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010562', 'DUG DUG'),
('PR_01', 'AZUAY', 'CN_0106', 'PUCARA', 'PQ_010650', 'PUCARÁ'),
('PR_01', 'AZUAY', 'CN_0106', 'PUCARA', 'PQ_010651', 'CAMILO PONCE ENRÍQUEZ (CAB. EN RÍO 7 DE MOLLEPONGO)'),
('PR_01', 'AZUAY', 'CN_0106', 'PUCARA', 'PQ_010652', 'SAN RAFAEL DE SHARUG'),
('PR_01', 'AZUAY', 'CN_0107', 'SAN FERNANDO', 'PQ_010750', 'SAN FERNANDO'),
('PR_01', 'AZUAY', 'CN_0107', 'SAN FERNANDO', 'PQ_010751', 'CHUMBLÍN'),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010850', 'SANTA ISABEL (CHAGUARURCO)'),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010851', 'ABDÓN CALDERÓN (LA UNIÓN)'),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010852', 'EL CARMEN DE PIJILÍ'),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010853', 'ZHAGLLI (SHAGLLI)'),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010854', 'SAN SALVADOR DE CAÑARIBAMBA'),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010950', 'SIGSIG'),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010951', 'CUCHIL (CUTCHIL)'),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010952', 'GIMA'),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010953', 'GUEL'),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010954', 'LUDO'),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010955', 'SAN BARTOLOMÉ'),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010956', 'SAN JOSÉ DE RARANGA'),
('PR_01', 'AZUAY', 'CN_0110', 'OÑA', 'PQ_011050', 'SAN FELIPE DE OÑA CABECERA CANTONAL'),
('PR_01', 'AZUAY', 'CN_0110', 'OÑA', 'PQ_011051', 'SUSUDEL'),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011150', 'CHORDELEG'),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011151', 'PRINCIPAL'),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011152', 'LA UNIÓN'),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011153', 'LUIS GALARZA ORELLANA (CAB.EN DELEGSOL)'),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011154', 'SAN MARTÍN DE PUZHIO'),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011250', 'EL PAN'),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011251', 'AMALUZA'),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011252', 'PALMAS'),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011253', 'SAN VICENTE'),
('PR_01', 'AZUAY', 'CN_0113', 'SEVILLA DE ORO', 'PQ_011350', 'SEVILLA DE ORO'),
('PR_01', 'AZUAY', 'CN_0113', 'SEVILLA DE ORO', 'PQ_011351', 'AMALUZA'),
('PR_01', 'AZUAY', 'CN_0113', 'SEVILLA DE ORO', 'PQ_011352', 'PALMAS'),
('PR_01', 'AZUAY', 'CN_0114', 'GUACHAPALA', 'PQ_011450', 'GUACHAPALA'),
('PR_01', 'AZUAY', 'CN_0115', 'CAMILO PONCE ENRÍQUEZ', 'PQ_011550', 'CAMILO PONCE ENRÍQUEZ'),
('PR_01', 'AZUAY', 'CN_0115', 'CAMILO PONCE ENRÍQUEZ', 'PQ_011551', 'EL CARMEN DE PIJILÍ'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020101', 'ÁNGEL POLIBIO CHÁVES'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020102', 'GABRIEL IGNACIO VEINTIMILLA'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020103', 'GUANUJO'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020150', 'GUARANDA'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020151', 'FACUNDO VELA'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020152', 'GUANUJO'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020153', 'JULIO E. MORENO (CATANAHUÁN GRANDE)'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020154', 'LAS NAVES'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020155', 'SALINAS'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020156', 'SAN LORENZO'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020157', 'SAN SIMÓN (YACOTO)'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020158', 'SANTA FÉ (SANTA FÉ)'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020159', 'SIMIÁTUG'),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020160', 'SAN LUIS DE PAMBIL'),
('PR_02', 'BOLIVAR', 'CN_0202', 'CHILLANES', 'PQ_020250', 'CHILLANES'),
('PR_02', 'BOLIVAR', 'CN_0202', 'CHILLANES', 'PQ_020251', 'SAN JOSÉ DEL TAMBO (TAMBOPAMBA)'),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020350', 'SAN JOSÉ DE CHIMBO'),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020351', 'ASUNCIÓN (ASANCOTO)'),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020352', 'CALUMA'),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020353', 'MAGDALENA (CHAPACOTO)'),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020354', 'SAN SEBASTIÁN'),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020355', 'TELIMBELA'),
('PR_02', 'BOLIVAR', 'CN_0204', 'ECHEANDÍA', 'PQ_020450', 'ECHEANDÍA'),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020550', 'SAN MIGUEL'),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020551', 'BALSAPAMBA'),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020552', 'BILOVÁN'),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020553', 'RÉGULO DE MORA'),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020554', 'SAN PABLO (SAN PABLO DE ATENAS)'),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020555', 'SANTIAGO'),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020556', 'SAN VICENTE'),
('PR_02', 'BOLIVAR', 'CN_0206', 'CALUMA', 'PQ_020650', 'CALUMA'),
('PR_02', 'BOLIVAR', 'CN_0207', 'LAS NAVES', 'PQ_020701', 'LAS MERCEDES'),
('PR_02', 'BOLIVAR', 'CN_0207', 'LAS NAVES', 'PQ_020702', 'LAS NAVES'),
('PR_02', 'BOLIVAR', 'CN_0207', 'LAS NAVES', 'PQ_020750', 'LAS NAVES'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030101', 'AURELIO BAYAS MARTÍNEZ'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030102', 'AZOGUES'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030103', 'BORRERO'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030104', 'SAN FRANCISCO'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030150', 'AZOGUES'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030151', 'COJITAMBO'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030152', 'DÉLEG'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030153', 'GUAPÁN'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030154', 'JAVIER LOYOLA (CHUQUIPATA)'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030155', 'LUIS CORDERO'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030156', 'PINDILIG'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030157', 'RIVERA'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030158', 'SAN MIGUEL'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030159', 'SOLANO'),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030160', 'TADAY'),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030250', 'BIBLIÁN'),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030251', 'NAZÓN (CAB. EN PAMPA DE DOMÍNGUEZ)'),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030252', 'SAN FRANCISCO DE SAGEO'),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030253', 'TURUPAMBA'),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030254', 'JERUSALÉN'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030350', 'CAÑAR'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030351', 'CHONTAMARCA'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030352', 'CHOROCOPTE'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030353', 'GENERAL MORALES (SOCARTE)'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030354', 'GUALLETURO'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030355', 'HONORATO VÁSQUEZ (TAMBO VIEJO)'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030356', 'INGAPIRCA'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030357', 'JUNCAL'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030358', 'SAN ANTONIO'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030359', 'SUSCAL'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030360', 'TAMBO'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030361', 'ZHUD'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030362', 'VENTURA'),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030363', 'DUCUR'),
('PR_03', 'CAÑAR', 'CN_0304', 'LA TRONCAL', 'PQ_030450', 'LA TRONCAL'),
('PR_03', 'CAÑAR', 'CN_0304', 'LA TRONCAL', 'PQ_030451', 'MANUEL J. CALLE'),
('PR_03', 'CAÑAR', 'CN_0304', 'LA TRONCAL', 'PQ_030452', 'PANCHO NEGRO'),
('PR_03', 'CAÑAR', 'CN_0305', 'EL TAMBO', 'PQ_030550', 'EL TAMBO'),
('PR_03', 'CAÑAR', 'CN_0306', 'DÉLEG', 'PQ_030650', 'DÉLEG'),
('PR_03', 'CAÑAR', 'CN_0306', 'DÉLEG', 'PQ_030651', 'SOLANO'),
('PR_03', 'CAÑAR', 'CN_0307', 'SUSCAL', 'PQ_030750', 'SUSCAL'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040101', 'GONZÁLEZ SUÁREZ'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040102', 'TULCÁN'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040150', 'TULCÁN'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040151', 'EL CARMELO (EL PUN)'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040152', 'HUACA'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040153', 'JULIO ANDRADE (OREJUELA)'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040154', 'MALDONADO'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040155', 'PIOTER'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040156', 'TOBAR DONOSO (LA BOCANA DE CAMUMBÍ)'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040157', 'TUFIÑO'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040158', 'URBINA (TAYA)'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040159', 'EL CHICAL'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040160', 'MARISCAL SUCRE'),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040161', 'SANTA MARTHA DE CUBA'),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040250', 'BOLÍVAR'),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040251', 'GARCÍA MORENO'),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040252', 'LOS ANDES'),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040253', 'MONTE OLIVO'),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040254', 'SAN VICENTE DE PUSIR'),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040255', 'SAN RAFAEL'),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040301', 'EL ÁNGEL'),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040302', '27 DE SEPTIEMBRE'),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040350', 'EL ANGEL'),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040351', 'EL GOALTAL'),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040352', 'LA LIBERTAD (ALIZO)'),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040353', 'SAN ISIDRO'),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040450', 'MIRA (CHONTAHUASI)'),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040451', 'CONCEPCIÓN'),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040452', 'JIJÓN Y CAAMAÑO (CAB. EN RÍO BLANCO)'),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040453', 'JUAN MONTALVO (SAN IGNACIO DE QUIL)'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040501', 'GONZÁLEZ SUÁREZ'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040502', 'SAN JOSÉ'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040550', 'SAN GABRIEL'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040551', 'CRISTÓBAL COLÓN'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040552', 'CHITÁN DE NAVARRETE'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040553', 'FERNÁNDEZ SALVADOR'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040554', 'LA PAZ'),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040555', 'PIARTAL'),
('PR_04', 'CARCHI', 'CN_0406', 'SAN PEDRO DE HUACA', 'PQ_040650', 'HUACA'),
('PR_04', 'CARCHI', 'CN_0406', 'SAN PEDRO DE HUACA', 'PQ_040651', 'MARISCAL SUCRE'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050101', 'ELOY ALFARO (SAN FELIPE)'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050102', 'IGNACIO FLORES (PARQUE FLORES)'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050103', 'JUAN MONTALVO (SAN SEBASTIÁN)'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050104', 'LA MATRIZ'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050105', 'SAN BUENAVENTURA'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050150', 'LATACUNGA'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050151', 'ALAQUES (ALÁQUEZ)'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050152', 'BELISARIO QUEVEDO (GUANAILÍN)'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050153', 'GUAITACAMA (GUAYTACAMA)'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050154', 'JOSEGUANGO BAJO'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050155', 'LAS PAMPAS'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050156', 'MULALÓ'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050157', '11 DE NOVIEMBRE (ILINCHISI)'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050158', 'POALÓ'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050159', 'SAN JUAN DE PASTOCALLE'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050160', 'SIGCHOS'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050161', 'TANICUCHÍ'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050162', 'TOACASO'),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050163', 'PALO QUEMADO'),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050201', 'EL CARMEN'),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050202', 'LA MANÁ'),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050203', 'EL TRIUNFO'),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050250', 'LA MANÁ'),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050251', 'GUASAGANDA (CAB.EN GUASAGANDA'),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050252', 'PUCAYACU'),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050350', 'EL CORAZÓN'),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050351', 'MORASPUNGO'),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050352', 'PINLLOPATA'),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050353', 'RAMÓN CAMPAÑA'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050450', 'PUJILÍ'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050451', 'ANGAMARCA'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050452', 'CHUCCHILÁN (CHUGCHILÁN)'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050453', 'GUANGAJE'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050454', 'ISINLIBÍ (ISINLIVÍ)'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050455', 'LA VICTORIA'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050456', 'PILALÓ'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050457', 'TINGO'),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050458', 'ZUMBAHUA'),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050550', 'SAN MIGUEL'),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050551', 'ANTONIO JOSÉ HOLGUÍN (SANTA LUCÍA)'),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050552', 'CUSUBAMBA'),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050553', 'MULALILLO'),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050554', 'MULLIQUINDIL (SANTA ANA)'),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050555', 'PANSALEO'),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050650', 'SAQUISILÍ'),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050651', 'CANCHAGUA'),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050652', 'CHANTILÍN'),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050653', 'COCHAPAMBA'),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050750', 'SIGCHOS'),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050751', 'CHUGCHILLÁN'),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050752', 'ISINLIVÍ'),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050753', 'LAS PAMPAS'),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050754', 'PALO QUEMADO'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060101', 'LIZARZABURU'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060102', 'MALDONADO'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060103', 'VELASCO'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060104', 'VELOZ'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060105', 'YARUQUÍES'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060150', 'RIOBAMBA'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060151', 'CACHA (CAB. EN MACHÁNGARA)'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060152', 'CALPI'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060153', 'CUBIJÍES'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060154', 'FLORES'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060155', 'LICÁN'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060156', 'LICTO'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060157', 'PUNGALÁ'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060158', 'PUNÍN'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060159', 'QUIMIAG'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060160', 'SAN JUAN'),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060161', 'SAN LUIS'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060250', 'ALAUSÍ'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060251', 'ACHUPALLAS'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060252', 'CUMANDÁ'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060253', 'GUASUNTOS'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060254', 'HUIGRA'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060255', 'MULTITUD'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060256', 'PISTISHÍ (NARIZ DEL DIABLO)'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060257', 'PUMALLACTA'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060258', 'SEVILLA'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060259', 'SIBAMBE'),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060260', 'TIXÁN'),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060301', 'CAJABAMBA'),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060302', 'SICALPA'),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060350', 'VILLA LA UNIÓN (CAJABAMBA)'),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060351', 'CAÑI'),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060352', 'COLUMBE'),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060353', 'JUAN DE VELASCO (PANGOR)'),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060354', 'SANTIAGO DE QUITO (CAB. EN SAN ANTONIO DE QUITO)'),
('PR_06', 'CHIMBORAZO', 'CN_0604', 'CHAMBO', 'PQ_060450', 'CHAMBO'),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060550', 'CHUNCHI'),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060551', 'CAPZOL'),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060552', 'COMPUD'),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060553', 'GONZOL'),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060554', 'LLAGOS'),
('PR_06', 'CHIMBORAZO', 'CN_0606', 'GUAMOTE', 'PQ_060650', 'GUAMOTE'),
('PR_06', 'CHIMBORAZO', 'CN_0606', 'GUAMOTE', 'PQ_060651', 'CEBADAS'),
('PR_06', 'CHIMBORAZO', 'CN_0606', 'GUAMOTE', 'PQ_060652', 'PALMIRA'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060701', 'EL ROSARIO'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060702', 'LA MATRIZ'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060750', 'GUANO'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060751', 'GUANANDO'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060752', 'ILAPO'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060753', 'LA PROVIDENCIA'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060754', 'SAN ANDRÉS'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060755', 'SAN GERARDO DE PACAICAGUÁN'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060756', 'SAN ISIDRO DE PATULÚ'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060757', 'SAN JOSÉ DEL CHAZO'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060758', 'SANTA FÉ DE GALÁN'),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060759', 'VALPARAÍSO'),
('PR_06', 'CHIMBORAZO', 'CN_0608', 'PALLATANGA', 'PQ_060850', 'PALLATANGA'),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060950', 'PENIPE'),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060951', 'EL ALTAR'),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060952', 'MATUS'),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060953', 'PUELA'),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060954', 'SAN ANTONIO DE BAYUSHIG'),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060955', 'LA CANDELARIA'),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060956', 'BILBAO (CAB.EN QUILLUYACU)'),
('PR_06', 'CHIMBORAZO', 'CN_0610', 'CUMANDÁ', 'PQ_061050', 'CUMANDÁ'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070101', 'LA PROVIDENCIA'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070102', 'MACHALA'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070103', 'PUERTO BOLÍVAR'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070104', 'NUEVE DE MAYO'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070105', 'EL CAMBIO'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070150', 'MACHALA'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070151', 'EL CAMBIO'),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070152', 'EL RETIRO'),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070250', 'ARENILLAS'),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070251', 'CHACRAS'),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070252', 'LA LIBERTAD'),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070253', 'LAS LAJAS (CAB. EN LA VICTORIA)'),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070254', 'PALMALES'),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070255', 'CARCABÓN'),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070350', 'PACCHA'),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070351', 'AYAPAMBA'),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070352', 'CORDONCILLO'),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070353', 'MILAGRO'),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070354', 'SAN JOSÉ'),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070355', 'SAN JUAN DE CERRO AZUL'),
('PR_07', 'EL ORO', 'CN_0704', 'BALSAS', 'PQ_070450', 'BALSAS'),
('PR_07', 'EL ORO', 'CN_0704', 'BALSAS', 'PQ_070451', 'BELLAMARÍA'),
('PR_07', 'EL ORO', 'CN_0705', 'CHILLA', 'PQ_070550', 'CHILLA'),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070650', 'EL GUABO'),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070651', 'BARBONES (SUCRE)'),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070652', 'LA IBERIA'),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070653', 'TENDALES (CAB.EN PUERTO TENDALES)'),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070654', 'RÍO BONITO'),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070701', 'ECUADOR'),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070702', 'EL PARAÍSO'),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070703', 'HUALTACO'),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070704', 'MILTON REYES'),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070705', 'UNIÓN LOJANA'),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070750', 'HUAQUILLAS'),
('PR_07', 'EL ORO', 'CN_0708', 'MARCABELÍ', 'PQ_070850', 'MARCABELÍ'),
('PR_07', 'EL ORO', 'CN_0708', 'MARCABELÍ', 'PQ_070851', 'EL INGENIO'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070901', 'BOLÍVAR'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070902', 'LOMA DE FRANCO'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070903', 'OCHOA LEÓN (MATRIZ)'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070904', 'TRES CERRITOS'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070950', 'PASAJE'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070951', 'BUENAVISTA'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070952', 'CASACAY'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070953', 'LA PEAÑA'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070954', 'PROGRESO'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070955', 'UZHCURRUMI'),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070956', 'CAÑAQUEMADA'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071001', 'LA MATRIZ'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071002', 'LA SUSAYA'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071003', 'PIÑAS GRANDE'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071050', 'PIÑAS'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071051', 'CAPIRO (CAB. EN LA CAPILLA DE CAPIRO)'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071052', 'LA BOCANA'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071053', 'MOROMORO (CAB. EN EL VADO)'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071054', 'PIEDRAS'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071055', 'SAN ROQUE (AMBROSIO MALDONADO)'),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071056', 'SARACAY'),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071150', 'PORTOVELO'),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071151', 'CURTINCAPA'),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071152', 'MORALES'),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071153', 'SALATÍ'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071201', 'SANTA ROSA'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071202', 'PUERTO JELÍ'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071203', 'BALNEARIO JAMBELÍ (SATÉLITE)'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071204', 'JUMÓN (SATÉLITE)'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071205', 'NUEVO SANTA ROSA'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071250', 'SANTA ROSA'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071251', 'BELLAVISTA'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071252', 'JAMBELÍ'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071253', 'LA AVANZADA'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071254', 'SAN ANTONIO'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071255', 'TORATA'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071256', 'VICTORIA'),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071257', 'BELLAMARÍA'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071350', 'ZARUMA'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071351', 'ABAÑÍN'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071352', 'ARCAPAMBA'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071353', 'GUANAZÁN'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071354', 'GUIZHAGUIÑA'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071355', 'HUERTAS'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071356', 'MALVAS'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071357', 'MULUNCAY GRANDE'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071358', 'SINSAO'),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071359', 'SALVIAS'),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071401', 'LA VICTORIA'),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071402', 'PLATANILLOS'),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071403', 'VALLE HERMOSO'),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071450', 'LA VICTORIA'),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071451', 'LA LIBERTAD'),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071452', 'EL PARAÍSO'),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071453', 'SAN ISIDRO'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080101', 'BARTOLOMÉ RUIZ (CÉSAR FRANCO CARRIÓN)'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080102', '5 DE AGOSTO'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080103', 'ESMERALDAS'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080104', 'LUIS TELLO (LAS PALMAS)'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080105', 'SIMÓN PLATA TORRES'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080150', 'ESMERALDAS'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080151', 'ATACAMES'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080152', 'CAMARONES (CAB. EN SAN VICENTE)'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080153', 'CRNEL. CARLOS CONCHA TORRES (CAB.EN HUELE)'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080154', 'CHINCA'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080155', 'CHONTADURO'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080156', 'CHUMUNDÉ'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080157', 'LAGARTO'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080158', 'LA UNIÓN'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080159', 'MAJUA'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080160', 'MONTALVO (CAB. EN HORQUETA)'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080161', 'RÍO VERDE'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080162', 'ROCAFUERTE'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080163', 'SAN MATEO'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080164', 'SÚA (CAB. EN LA BOCANA)'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080165', 'TABIAZO'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080166', 'TACHINA'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080167', 'TONCHIGÜE'),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080168', 'VUELTA LARGA'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080250', 'VALDEZ (LIMONES)'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080251', 'ANCHAYACU'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080252', 'ATAHUALPA (CAB. EN CAMARONES)'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080253', 'BORBÓN'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080254', 'LA TOLA'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080255', 'LUIS VARGAS TORRES (CAB. EN PLAYA DE ORO)'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080256', 'MALDONADO'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080257', 'PAMPANAL DE BOLÍVAR'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080258', 'SAN FRANCISCO DE ONZOLE'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080259', 'SANTO DOMINGO DE ONZOLE'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080260', 'SELVA ALEGRE'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080261', 'TELEMBÍ'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080262', 'COLÓN ELOY DEL MARÍA'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080263', 'SAN JOSÉ DE CAYAPAS'),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080264', 'TIMBIRÉ'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080350', 'MUISNE'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080351', 'BOLÍVAR'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080352', 'DAULE'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080353', 'GALERA'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080354', 'QUINGUE (OLMEDO PERDOMO FRANCO)'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080355', 'SALIMA'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080356', 'SAN FRANCISCO'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080357', 'SAN GREGORIO'),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080358', 'SAN JOSÉ DE CHAMANGA (CAB.EN CHAMANGA)'),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080450', 'ROSA ZÁRATE (QUININDÉ)'),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080451', 'CUBE'),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080452', 'CHURA (CHANCAMA) (CAB. EN EL YERBERO)'),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080453', 'MALIMPIA'),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080454', 'VICHE'),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080455', 'LA UNIÓN'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080550', 'SAN LORENZO'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080551', 'ALTO TAMBO (CAB. EN GUADUAL)'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080552', 'ANCÓN (PICHANGAL) (CAB. EN PALMA REAL)'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080553', 'CALDERÓN'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080554', 'CARONDELET'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080555', '5 DE JUNIO (CAB. EN UIMBI)'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080556', 'CONCEPCIÓN'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080557', 'MATAJE (CAB. EN SANTANDER)'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080558', 'SAN JAVIER DE CACHAVÍ (CAB. EN SAN JAVIER)'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080559', 'SANTA RITA'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080560', 'TAMBILLO'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080561', 'TULULBÍ (CAB. EN RICAURTE)'),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080562', 'URBINA'),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080650', 'ATACAMES'),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080651', 'LA UNIÓN'),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080652', 'SÚA (CAB. EN LA BOCANA)'),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080653', 'TONCHIGÜE'),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080654', 'TONSUPA'),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080750', 'RIOVERDE'),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080751', 'CHONTADURO'),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080752', 'CHUMUNDÉ'),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080753', 'LAGARTO'),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080754', 'MONTALVO (CAB. EN HORQUETA)'),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080755', 'ROCAFUERTE'),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080850', 'LA CONCORDIA'),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080851', 'MONTERREY'),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080852', 'LA VILLEGAS'),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080853', 'PLAN PILOTO'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090101', 'AYACUCHO'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090102', 'BOLÍVAR (SAGRARIO)'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090103', 'CARBO (CONCEPCIÓN)'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090104', 'FEBRES CORDERO'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090105', 'GARCÍA MORENO'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090106', 'LETAMENDI'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090107', 'NUEVE DE OCTUBRE'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090108', 'OLMEDO (SAN ALEJO)'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090109', 'ROCA'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090110', 'ROCAFUERTE'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090111', 'SUCRE'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090112', 'TARQUI'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090113', 'URDANETA'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090114', 'XIMENA'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090115', 'PASCUALES'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090150', 'GUAYAQUIL'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090151', 'CHONGÓN'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090152', 'JUAN GÓMEZ RENDÓN (PROGRESO)'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090153', 'MORRO'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090154', 'PASCUALES'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090155', 'PLAYAS (GRAL. VILLAMIL)'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090156', 'POSORJA'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090157', 'PUNÁ'),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090158', 'TENGUEL'),
('PR_09', 'GUAYAS', 'CN_0902', 'ALFREDO BAQUERIZO MORENO (JUJÁN)', 'PQ_090250', 'ALFREDO BAQUERIZO MORENO (JUJÁN)'),
('PR_09', 'GUAYAS', 'CN_0903', 'BALAO', 'PQ_090350', 'BALAO'),
('PR_09', 'GUAYAS', 'CN_0904', 'BALZAR', 'PQ_090450', 'BALZAR'),
('PR_09', 'GUAYAS', 'CN_0905', 'COLIMES', 'PQ_090550', 'COLIMES'),
('PR_09', 'GUAYAS', 'CN_0905', 'COLIMES', 'PQ_090551', 'SAN JACINTO'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090601', 'DAULE'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090602', 'LA AURORA (SATÉLITE)'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090603', 'BANIFE'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090604', 'EMILIANO CAICEDO MARCOS'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090605', 'MAGRO'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090606', 'PADRE JUAN BAUTISTA AGUIRRE'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090607', 'SANTA CLARA'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090608', 'VICENTE PIEDRAHITA'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090650', 'DAULE'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090651', 'ISIDRO AYORA (SOLEDAD)'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090652', 'JUAN BAUTISTA AGUIRRE (LOS TINTOS)'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090653', 'LAUREL'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090654', 'LIMONAL'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090655', 'LOMAS DE SARGENTILLO'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090656', 'LOS LOJAS (ENRIQUE BAQUERIZO MORENO)'),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090657', 'PIEDRAHITA (NOBOL)'),
('PR_09', 'GUAYAS', 'CN_0907', 'DURÁN', 'PQ_090701', 'ELOY ALFARO (DURÁN)'),
('PR_09', 'GUAYAS', 'CN_0907', 'DURÁN', 'PQ_090702', 'EL RECREO'),
('PR_09', 'GUAYAS', 'CN_0907', 'DURÁN', 'PQ_090750', 'ELOY ALFARO (DURÁN)'),
('PR_09', 'GUAYAS', 'CN_0908', 'EL EMPALME', 'PQ_090850', 'VELASCO IBARRA (EL EMPALME)'),
('PR_09', 'GUAYAS', 'CN_0908', 'EL EMPALME', 'PQ_090851', 'GUAYAS (PUEBLO NUEVO)'),
('PR_09', 'GUAYAS', 'CN_0908', 'EL EMPALME', 'PQ_090852', 'EL ROSARIO'),
('PR_09', 'GUAYAS', 'CN_0909', 'EL TRIUNFO', 'PQ_090950', 'EL TRIUNFO'),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091050', 'MILAGRO'),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091051', 'CHOBO'),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091052', 'GENERAL ELIZALDE (BUCAY)'),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091053', 'MARISCAL SUCRE (HUAQUES)'),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091054', 'ROBERTO ASTUDILLO (CAB. EN CRUCE DE VENECIA)'),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091150', 'NARANJAL'),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091151', 'JESÚS MARÍA'),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091152', 'SAN CARLOS'),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091153', 'SANTA ROSA DE FLANDES'),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091154', 'TAURA'),
('PR_09', 'GUAYAS', 'CN_0912', 'NARANJITO', 'PQ_091250', 'NARANJITO'),
('PR_09', 'GUAYAS', 'CN_0913', 'PALESTINA', 'PQ_091350', 'PALESTINA'),
('PR_09', 'GUAYAS', 'CN_0914', 'PEDRO CARBO', 'PQ_091450', 'PEDRO CARBO'),
('PR_09', 'GUAYAS', 'CN_0914', 'PEDRO CARBO', 'PQ_091451', 'VALLE DE LA VIRGEN'),
('PR_09', 'GUAYAS', 'CN_0914', 'PEDRO CARBO', 'PQ_091452', 'SABANILLA'),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091601', 'SAMBORONDÓN'),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091602', 'LA PUNTILLA (SATÉLITE)'),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091650', 'SAMBORONDÓN'),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091651', 'TARIFA'),
('PR_09', 'GUAYAS', 'CN_0918', 'SANTA LUCÍA', 'PQ_091850', 'SANTA LUCÍA'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091901', 'BOCANA'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091902', 'CANDILEJOS'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091903', 'CENTRAL'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091904', 'PARAÍSO'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091905', 'SAN MATEO'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091950', 'EL SALITRE (LAS RAMAS)'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091951', 'GRAL. VERNAZA (DOS ESTEROS)'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091952', 'LA VICTORIA (ÑAUZA)'),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091953', 'JUNQUILLAL'),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092050', 'SAN JACINTO DE YAGUACHI'),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092051', 'CRNEL. LORENZO DE GARAICOA (PEDREGAL)'),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092052', 'CRNEL. MARCELINO MARIDUEÑA (SAN CARLOS)'),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092053', 'GRAL. PEDRO J. MONTERO (BOLICHE)'),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092054', 'SIMÓN BOLÍVAR'),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092055', 'YAGUACHI VIEJO (CONE)'),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092056', 'VIRGEN DE FÁTIMA'),
('PR_09', 'GUAYAS', 'CN_0921', 'PLAYAS', 'PQ_092150', 'GENERAL VILLAMIL (PLAYAS)'),
('PR_09', 'GUAYAS', 'CN_0922', 'SIMÓN BOLÍVAR', 'PQ_092250', 'SIMÓN BOLÍVAR'),
('PR_09', 'GUAYAS', 'CN_0922', 'SIMÓN BOLÍVAR', 'PQ_092251', 'CRNEL.LORENZO DE GARAICOA (PEDREGAL)'),
('PR_09', 'GUAYAS', 'CN_0923', 'CORONEL MARCELINO MARIDUEÑA', 'PQ_092350', 'CORONEL MARCELINO MARIDUEÑA (SAN CARLOS)'),
('PR_09', 'GUAYAS', 'CN_0924', 'LOMAS DE SARGENTILLO', 'PQ_092450', 'LOMAS DE SARGENTILLO'),
('PR_09', 'GUAYAS', 'CN_0924', 'LOMAS DE SARGENTILLO', 'PQ_092451', 'ISIDRO AYORA (SOLEDAD)'),
('PR_09', 'GUAYAS', 'CN_0925', 'NOBOL', 'PQ_092550', 'NARCISA DE JESÚS'),
('PR_09', 'GUAYAS', 'CN_0927', 'GENERAL ANTONIO ELIZALDE', 'PQ_092750', 'GENERAL ANTONIO ELIZALDE (BUCAY)'),
('PR_09', 'GUAYAS', 'CN_0928', 'ISIDRO AYORA', 'PQ_092850', 'ISIDRO AYORA'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100101', 'CARANQUI'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100102', 'GUAYAQUIL DE ALPACHACA'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100103', 'SAGRARIO'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100104', 'SAN FRANCISCO'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100105', 'LA DOLOROSA DEL PRIORATO'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100150', 'SAN MIGUEL DE IBARRA'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100151', 'AMBUQUÍ'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100152', 'ANGOCHAGUA'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100153', 'CAROLINA'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100154', 'LA ESPERANZA'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100155', 'LITA'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100156', 'SALINAS'),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100157', 'SAN ANTONIO'),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100201', 'ANDRADE MARÍN (LOURDES)'),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100202', 'ATUNTAQUI'),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100250', 'ATUNTAQUI'),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100251', 'IMBAYA (SAN LUIS DE COBUENDO)'),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100252', 'SAN FRANCISCO DE NATABUELA'),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100253', 'SAN JOSÉ DE CHALTURA'),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100254', 'SAN ROQUE'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100301', 'SAGRARIO'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100302', 'SAN FRANCISCO'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100350', 'COTACACHI'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100351', 'APUELA'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100352', 'GARCÍA MORENO (LLURIMAGUA)'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100353', 'IMANTAG'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100354', 'PEÑAHERRERA'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100355', 'PLAZA GUTIÉRREZ (CALVARIO)'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100356', 'QUIROGA'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100357', '6 DE JULIO DE CUELLAJE (CAB. EN CUELLAJE)'),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100358', 'VACAS GALINDO (EL CHURO) (CAB.EN SAN MIGUEL ALTO'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100401', 'JORDÁN'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100402', 'SAN LUIS'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100450', 'OTAVALO'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100451', 'DR. MIGUEL EGAS CABEZAS (PEGUCHE)'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100452', 'EUGENIO ESPEJO (CALPAQUÍ)'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100453', 'GONZÁLEZ SUÁREZ'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100454', 'PATAQUÍ'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100455', 'SAN JOSÉ DE QUICHINCHE'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100456', 'SAN JUAN DE ILUMÁN'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100457', 'SAN PABLO'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100458', 'SAN RAFAEL'),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100459', 'SELVA ALEGRE (CAB.EN SAN MIGUEL DE PAMPLONA)'),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100550', 'PIMAMPIRO'),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100551', 'CHUGÁ'),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100552', 'MARIANO ACOSTA'),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100553', 'SAN FRANCISCO DE SIGSIPAMBA'),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100650', 'URCUQUÍ CABECERA CANTONAL'),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100651', 'CAHUASQUÍ'),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100652', 'LA MERCED DE BUENOS AIRES'),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100653', 'PABLO ARENAS'),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100654', 'SAN BLAS'),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100655', 'TUMBABIRO'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110101', 'EL SAGRARIO'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110102', 'SAN SEBASTIÁN'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110103', 'SUCRE'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110104', 'VALLE'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110150', 'LOJA'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110151', 'CHANTACO'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110152', 'CHUQUIRIBAMBA'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110153', 'EL CISNE'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110154', 'GUALEL'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110155', 'JIMBILLA'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110156', 'MALACATOS (VALLADOLID)'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110157', 'SAN LUCAS'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110158', 'SAN PEDRO DE VILCABAMBA'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110159', 'SANTIAGO'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110160', 'TAQUIL (MIGUEL RIOFRÍO)'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110161', 'VILCABAMBA (VICTORIA)'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110162', 'YANGANA (ARSENIO CASTILLO)'),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110163', 'QUINARA'),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110201', 'CARIAMANGA'),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110202', 'CHILE'),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110203', 'SAN VICENTE');
INSERT INTO `dct_parametro_tbl_div_politica` (`dvp_codigo_provincia`, `dvp_provincia`, `dvp_codigo_canton`, `dvp_canton`, `dvp_codigo_parroquia`, `dvp_parroquia`) VALUES
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110250', 'CARIAMANGA'),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110251', 'COLAISACA'),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110252', 'EL LUCERO'),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110253', 'UTUANA'),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110254', 'SANGUILLÍN'),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110301', 'CATAMAYO'),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110302', 'SAN JOSÉ'),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110350', 'CATAMAYO (LA TOMA)'),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110351', 'EL TAMBO'),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110352', 'GUAYQUICHUMA'),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110353', 'SAN PEDRO DE LA BENDITA'),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110354', 'ZAMBI'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110450', 'CELICA'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110451', 'CRUZPAMBA (CAB. EN CARLOS BUSTAMANTE)'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110452', 'CHAQUINAL'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110453', '12 DE DICIEMBRE (CAB. EN ACHIOTES)'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110454', 'PINDAL (FEDERICO PÁEZ)'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110455', 'POZUL (SAN JUAN DE POZUL)'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110456', 'SABANILLA'),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110457', 'TNTE. MAXIMILIANO RODRÍGUEZ LOAIZA'),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110550', 'CHAGUARPAMBA'),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110551', 'BUENAVISTA'),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110552', 'EL ROSARIO'),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110553', 'SANTA RUFINA'),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110554', 'AMARILLOS'),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110650', 'AMALUZA'),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110651', 'BELLAVISTA'),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110652', 'JIMBURA'),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110653', 'SANTA TERESITA'),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110654', '27 DE ABRIL (CAB. EN LA NARANJA)'),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110655', 'EL INGENIO'),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110656', 'EL AIRO'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110750', 'GONZANAMÁ'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110751', 'CHANGAIMINA (LA LIBERTAD)'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110752', 'FUNDOCHAMBA'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110753', 'NAMBACOLA'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110754', 'PURUNUMA (EGUIGUREN)'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110755', 'QUILANGA (LA PAZ)'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110756', 'SACAPALCA'),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110757', 'SAN ANTONIO DE LAS ARADAS (CAB. EN LAS ARADAS)'),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110801', 'GENERAL ELOY ALFARO (SAN SEBASTIÁN)'),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110802', 'MACARÁ (MANUEL ENRIQUE RENGEL SUQUILANDA)'),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110850', 'MACARÁ'),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110851', 'LARAMA'),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110852', 'LA VICTORIA'),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110853', 'SABIANGO (LA CAPILLA)'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110901', 'CATACOCHA'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110902', 'LOURDES'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110950', 'CATACOCHA'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110951', 'CANGONAMÁ'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110952', 'GUACHANAMÁ'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110953', 'LA TINGUE'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110954', 'LAURO GUERRERO'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110955', 'OLMEDO (SANTA BÁRBARA)'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110956', 'ORIANGA'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110957', 'SAN ANTONIO'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110958', 'CASANGA'),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110959', 'YAMANA'),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111050', 'ALAMOR'),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111051', 'CIANO'),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111052', 'EL ARENAL'),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111053', 'EL LIMO (MARIANA DE JESÚS)'),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111054', 'MERCADILLO'),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111055', 'VICENTINO'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111150', 'SARAGURO'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111151', 'EL PARAÍSO DE CELÉN'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111152', 'EL TABLÓN'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111153', 'LLUZHAPA'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111154', 'MANÚ'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111155', 'SAN ANTONIO DE QUMBE (CUMBE)'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111156', 'SAN PABLO DE TENTA'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111157', 'SAN SEBASTIÁN DE YÚLUC'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111158', 'SELVA ALEGRE'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111159', 'URDANETA (PAQUISHAPA)'),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111160', 'SUMAYPAMBA'),
('PR_11', 'LOJA', 'CN_1112', 'SOZORANGA', 'PQ_111250', 'SOZORANGA'),
('PR_11', 'LOJA', 'CN_1112', 'SOZORANGA', 'PQ_111251', 'NUEVA FÁTIMA'),
('PR_11', 'LOJA', 'CN_1112', 'SOZORANGA', 'PQ_111252', 'TACAMOROS'),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111350', 'ZAPOTILLO'),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111351', 'MANGAHURCO (CAZADEROS)'),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111352', 'GARZAREAL'),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111353', 'LIMONES'),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111354', 'PALETILLAS'),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111355', 'BOLASPAMBA'),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111450', 'PINDAL'),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111451', 'CHAQUINAL'),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111452', '12 DE DICIEMBRE (CAB.EN ACHIOTES)'),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111453', 'MILAGROS'),
('PR_11', 'LOJA', 'CN_1115', 'QUILANGA', 'PQ_111550', 'QUILANGA'),
('PR_11', 'LOJA', 'CN_1115', 'QUILANGA', 'PQ_111551', 'FUNDOCHAMBA'),
('PR_11', 'LOJA', 'CN_1115', 'QUILANGA', 'PQ_111552', 'SAN ANTONIO DE LAS ARADAS (CAB. EN LAS ARADAS)'),
('PR_11', 'LOJA', 'CN_1116', 'OLMEDO', 'PQ_111650', 'OLMEDO'),
('PR_11', 'LOJA', 'CN_1116', 'OLMEDO', 'PQ_111651', 'LA TINGUE'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120101', 'CLEMENTE BAQUERIZO'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120102', 'DR. CAMILO PONCE'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120103', 'BARREIRO'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120104', 'EL SALTO'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120150', 'BABAHOYO'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120151', 'BARREIRO (SANTA RITA)'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120152', 'CARACOL'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120153', 'FEBRES CORDERO (LAS JUNTAS)'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120154', 'PIMOCHA'),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120155', 'LA UNIÓN'),
('PR_12', 'LOS RIOS', 'CN_1202', 'BABA', 'PQ_120250', 'BABA'),
('PR_12', 'LOS RIOS', 'CN_1202', 'BABA', 'PQ_120251', 'GUARE'),
('PR_12', 'LOS RIOS', 'CN_1202', 'BABA', 'PQ_120252', 'ISLA DE BEJUCAL'),
('PR_12', 'LOS RIOS', 'CN_1203', 'MONTALVO', 'PQ_120350', 'MONTALVO'),
('PR_12', 'LOS RIOS', 'CN_1204', 'PUEBLOVIEJO', 'PQ_120450', 'PUEBLOVIEJO'),
('PR_12', 'LOS RIOS', 'CN_1204', 'PUEBLOVIEJO', 'PQ_120451', 'PUERTO PECHICHE'),
('PR_12', 'LOS RIOS', 'CN_1204', 'PUEBLOVIEJO', 'PQ_120452', 'SAN JUAN'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120501', 'QUEVEDO'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120502', 'SAN CAMILO'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120503', 'SAN JOSÉ'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120504', 'GUAYACÁN'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120505', 'NICOLÁS INFANTE DÍAZ'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120506', 'SAN CRISTÓBAL'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120507', 'SIETE DE OCTUBRE'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120508', '24 DE MAYO'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120509', 'VENUS DEL RÍO QUEVEDO'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120510', 'VIVA ALFARO'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120550', 'QUEVEDO'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120551', 'BUENA FÉ'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120552', 'MOCACHE'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120553', 'SAN CARLOS'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120554', 'VALENCIA'),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120555', 'LA ESPERANZA'),
('PR_12', 'LOS RIOS', 'CN_1206', 'URDANETA', 'PQ_120650', 'CATARAMA'),
('PR_12', 'LOS RIOS', 'CN_1206', 'URDANETA', 'PQ_120651', 'RICAURTE'),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120701', '10 DE NOVIEMBRE'),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120750', 'VENTANAS'),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120751', 'QUINSALOMA'),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120752', 'ZAPOTAL'),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120753', 'CHACARITA'),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120754', 'LOS ÁNGELES'),
('PR_12', 'LOS RIOS', 'CN_1208', 'VÍNCES', 'PQ_120850', 'VINCES'),
('PR_12', 'LOS RIOS', 'CN_1208', 'VÍNCES', 'PQ_120851', 'ANTONIO SOTOMAYOR (CAB. EN PLAYAS DE VINCES)'),
('PR_12', 'LOS RIOS', 'CN_1208', 'VÍNCES', 'PQ_120852', 'PALENQUE'),
('PR_12', 'LOS RIOS', 'CN_1209', 'PALENQUE', 'PQ_120950', 'PALENQUE'),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121001', 'SAN JACINTO DE BUENA FÉ'),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121002', '7 DE AGOSTO'),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121003', '11 DE OCTUBRE'),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121050', 'SAN JACINTO DE BUENA FÉ'),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121051', 'PATRICIA PILAR'),
('PR_12', 'LOS RIOS', 'CN_1211', 'VALENCIA', 'PQ_121150', 'VALENCIA'),
('PR_12', 'LOS RIOS', 'CN_1212', 'MOCACHE', 'PQ_121250', 'MOCACHE'),
('PR_12', 'LOS RIOS', 'CN_1213', 'QUINSALOMA', 'PQ_121350', 'QUINSALOMA'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130101', 'PORTOVIEJO'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130102', '12 DE MARZO'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130103', 'COLÓN'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130104', 'PICOAZÁ'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130105', 'SAN PABLO'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130106', 'ANDRÉS DE VERA'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130107', 'FRANCISCO PACHECO'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130108', '18 DE OCTUBRE'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130109', 'SIMÓN BOLÍVAR'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130150', 'PORTOVIEJO'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130151', 'ABDÓN CALDERÓN (SAN FRANCISCO)'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130152', 'ALHAJUELA (BAJO GRANDE)'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130153', 'CRUCITA'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130154', 'PUEBLO NUEVO'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130155', 'RIOCHICO (RÍO CHICO)'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130156', 'SAN PLÁCIDO'),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130157', 'CHIRIJOS'),
('PR_13', 'MANABI', 'CN_1302', 'BOLÍVAR', 'PQ_130250', 'CALCETA'),
('PR_13', 'MANABI', 'CN_1302', 'BOLÍVAR', 'PQ_130251', 'MEMBRILLO'),
('PR_13', 'MANABI', 'CN_1302', 'BOLÍVAR', 'PQ_130252', 'QUIROGA'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130301', 'CHONE'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130302', 'SANTA RITA'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130350', 'CHONE'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130351', 'BOYACÁ'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130352', 'CANUTO'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130353', 'CONVENTO'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130354', 'CHIBUNGA'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130355', 'ELOY ALFARO'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130356', 'RICAURTE'),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130357', 'SAN ANTONIO'),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130401', 'EL CARMEN'),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130402', '4 DE DICIEMBRE'),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130450', 'EL CARMEN'),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130451', 'WILFRIDO LOOR MOREIRA (MAICITO)'),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130452', 'SAN PEDRO DE SUMA'),
('PR_13', 'MANABI', 'CN_1305', 'FLAVIO ALFARO', 'PQ_130550', 'FLAVIO ALFARO'),
('PR_13', 'MANABI', 'CN_1305', 'FLAVIO ALFARO', 'PQ_130551', 'SAN FRANCISCO DE NOVILLO (CAB. EN'),
('PR_13', 'MANABI', 'CN_1305', 'FLAVIO ALFARO', 'PQ_130552', 'ZAPALLO'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130601', 'DR. MIGUEL MORÁN LUCIO'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130602', 'MANUEL INOCENCIO PARRALES Y GUALE'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130603', 'SAN LORENZO DE JIPIJAPA'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130650', 'JIPIJAPA'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130651', 'AMÉRICA'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130652', 'EL ANEGADO (CAB. EN ELOY ALFARO)'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130653', 'JULCUY'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130654', 'LA UNIÓN'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130655', 'MACHALILLA'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130656', 'MEMBRILLAL'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130657', 'PEDRO PABLO GÓMEZ'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130658', 'PUERTO DE CAYO'),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130659', 'PUERTO LÓPEZ'),
('PR_13', 'MANABI', 'CN_1307', 'JUNÍN', 'PQ_130750', 'JUNÍN'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130801', 'LOS ESTEROS'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130802', 'MANTA'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130803', 'SAN MATEO'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130804', 'TARQUI'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130805', 'ELOY ALFARO'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130850', 'MANTA'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130851', 'SAN LORENZO'),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130852', 'SANTA MARIANITA (BOCA DE PACOCHE)'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130901', 'ANIBAL SAN ANDRÉS'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130902', 'MONTECRISTI'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130903', 'EL COLORADO'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130904', 'GENERAL ELOY ALFARO'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130905', 'LEONIDAS PROAÑO'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130950', 'MONTECRISTI'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130951', 'JARAMIJÓ'),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130952', 'LA PILA'),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131050', 'PAJÁN'),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131051', 'CAMPOZANO (LA PALMA DE PAJÁN)'),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131052', 'CASCOL'),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131053', 'GUALE'),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131054', 'LASCANO'),
('PR_13', 'MANABI', 'CN_1311', 'PICHINCHA', 'PQ_131150', 'PICHINCHA'),
('PR_13', 'MANABI', 'CN_1311', 'PICHINCHA', 'PQ_131151', 'BARRAGANETE'),
('PR_13', 'MANABI', 'CN_1311', 'PICHINCHA', 'PQ_131152', 'SAN SEBASTIÁN'),
('PR_13', 'MANABI', 'CN_1312', 'ROCAFUERTE', 'PQ_131250', 'ROCAFUERTE'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131301', 'SANTA ANA'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131302', 'LODANA'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131350', 'SANTA ANA DE VUELTA LARGA'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131351', 'AYACUCHO'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131352', 'HONORATO VÁSQUEZ (CAB. EN VÁSQUEZ)'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131353', 'LA UNIÓN'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131354', 'OLMEDO'),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131355', 'SAN PABLO (CAB. EN PUEBLO NUEVO)'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131401', 'BAHÍA DE CARÁQUEZ'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131402', 'LEONIDAS PLAZA GUTIÉRREZ'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131450', 'BAHÍA DE CARÁQUEZ'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131451', 'CANOA'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131452', 'COJIMÍES'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131453', 'CHARAPOTÓ'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131454', '10 DE AGOSTO'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131455', 'JAMA'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131456', 'PEDERNALES'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131457', 'SAN ISIDRO'),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131458', 'SAN VICENTE'),
('PR_13', 'MANABI', 'CN_1315', 'TOSAGUA', 'PQ_131550', 'TOSAGUA'),
('PR_13', 'MANABI', 'CN_1315', 'TOSAGUA', 'PQ_131551', 'BACHILLERO'),
('PR_13', 'MANABI', 'CN_1315', 'TOSAGUA', 'PQ_131552', 'ANGEL PEDRO GILER (LA ESTANCILLA)'),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131650', 'SUCRE'),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131651', 'BELLAVISTA'),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131652', 'NOBOA'),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131653', 'ARQ. SIXTO DURÁN BALLÉN'),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131750', 'PEDERNALES'),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131751', 'COJIMÍES'),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131752', '10 DE AGOSTO'),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131753', 'ATAHUALPA'),
('PR_13', 'MANABI', 'CN_1318', 'OLMEDO', 'PQ_131850', 'OLMEDO'),
('PR_13', 'MANABI', 'CN_1319', 'PUERTO LÓPEZ', 'PQ_131950', 'PUERTO LÓPEZ'),
('PR_13', 'MANABI', 'CN_1319', 'PUERTO LÓPEZ', 'PQ_131951', 'MACHALILLA'),
('PR_13', 'MANABI', 'CN_1319', 'PUERTO LÓPEZ', 'PQ_131952', 'SALANGO'),
('PR_13', 'MANABI', 'CN_1320', 'JAMA', 'PQ_132050', 'JAMA'),
('PR_13', 'MANABI', 'CN_1321', 'JARAMIJÓ', 'PQ_132150', 'JARAMIJÓ'),
('PR_13', 'MANABI', 'CN_1322', 'SAN VICENTE', 'PQ_132250', 'SAN VICENTE'),
('PR_13', 'MANABI', 'CN_1322', 'SAN VICENTE', 'PQ_132251', 'CANOA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140150', 'MACAS'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140151', 'ALSHI (CAB. EN 9 DE OCTUBRE)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140152', 'CHIGUAZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140153', 'GENERAL PROAÑO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140154', 'HUASAGA (CAB.EN WAMPUIK)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140155', 'MACUMA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140156', 'SAN ISIDRO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140157', 'SEVILLA DON BOSCO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140158', 'SINAÍ'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140159', 'TAISHA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140160', 'ZUÑA (ZÚÑAC)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140161', 'TUUTINENTZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140162', 'CUCHAENTZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140163', 'SAN JOSÉ DE MORONA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140164', 'RÍO BLANCO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140201', 'GUALAQUIZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140202', 'MERCEDES MOLINA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140250', 'GUALAQUIZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140251', 'AMAZONAS (ROSARIO DE CUYES)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140252', 'BERMEJOS'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140253', 'BOMBOIZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140254', 'CHIGÜINDA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140255', 'EL ROSARIO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140256', 'NUEVA TARQUI'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140257', 'SAN MIGUEL DE CUYES'),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140258', 'EL IDEAL'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140350', 'GENERAL LEONIDAS PLAZA GUTIÉRREZ (LIMÓN)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140351', 'INDANZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140352', 'PAN DE AZÚCAR'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140353', 'SAN ANTONIO (CAB. EN SAN ANTONIO CENTRO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140354', 'SAN CARLOS DE LIMÓN (SAN CARLOS DEL'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140355', 'SAN JUAN BOSCO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140356', 'SAN MIGUEL DE CONCHAY'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140357', 'SANTA SUSANA DE CHIVIAZA (CAB. EN CHIVIAZA)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140358', 'YUNGANZA (CAB. EN EL ROSARIO)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140450', 'PALORA (METZERA)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140451', 'ARAPICOS'),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140452', 'CUMANDÁ (CAB. EN COLONIA AGRÍCOLA SEVILLA DEL ORO)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140453', 'HUAMBOYA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140454', 'SANGAY (CAB. EN NAYAMANACA)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140550', 'SANTIAGO DE MÉNDEZ'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140551', 'COPAL'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140552', 'CHUPIANZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140553', 'PATUCA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140554', 'SAN LUIS DE EL ACHO (CAB. EN EL ACHO)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140555', 'SANTIAGO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140556', 'TAYUZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140557', 'SAN FRANCISCO DE CHINIMBIMI'),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140650', 'SUCÚA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140651', 'ASUNCIÓN'),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140652', 'HUAMBI'),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140653', 'LOGROÑO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140654', 'YAUPI'),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140655', 'SANTA MARIANITA DE JESÚS'),
('PR_14', 'MORONA SANTIAGO', 'CN_1407', 'HUAMBOYA', 'PQ_140750', 'HUAMBOYA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1407', 'HUAMBOYA', 'PQ_140751', 'CHIGUAZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1407', 'HUAMBOYA', 'PQ_140752', 'PABLO SEXTO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140850', 'SAN JUAN BOSCO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140851', 'PAN DE AZÚCAR'),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140852', 'SAN CARLOS DE LIMÓN'),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140853', 'SAN JACINTO DE WAKAMBEIS'),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140854', 'SANTIAGO DE PANANZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140950', 'TAISHA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140951', 'HUASAGA (CAB. EN WAMPUIK)'),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140952', 'MACUMA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140953', 'TUUTINENTZA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140954', 'PUMPUENTSA'),
('PR_14', 'MORONA SANTIAGO', 'CN_1410', 'LOGROÑO', 'PQ_141050', 'LOGROÑO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1410', 'LOGROÑO', 'PQ_141051', 'YAUPI'),
('PR_14', 'MORONA SANTIAGO', 'CN_1410', 'LOGROÑO', 'PQ_141052', 'SHIMPIS'),
('PR_14', 'MORONA SANTIAGO', 'CN_1411', 'PABLO SEXTO', 'PQ_141150', 'PABLO SEXTO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1412', 'TIWINTZA', 'PQ_141250', 'SANTIAGO'),
('PR_14', 'MORONA SANTIAGO', 'CN_1412', 'TIWINTZA', 'PQ_141251', 'SAN JOSÉ DE MORONA'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150150', 'TENA'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150151', 'AHUANO'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150152', 'CARLOS JULIO AROSEMENA TOLA (ZATZA-YACU)'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150153', 'CHONTAPUNTA'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150154', 'PANO'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150155', 'PUERTO MISAHUALLI'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150156', 'PUERTO NAPO'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150157', 'TÁLAG'),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150158', 'SAN JUAN DE MUYUNA'),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150350', 'ARCHIDONA'),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150351', 'AVILA'),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150352', 'COTUNDO'),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150353', 'LORETO'),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150354', 'SAN PABLO DE USHPAYACU'),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150355', 'PUERTO MURIALDO'),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150450', 'EL CHACO'),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150451', 'GONZALO DíAZ DE PINEDA (EL BOMBÓN)'),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150452', 'LINARES'),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150453', 'OYACACHI'),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150454', 'SANTA ROSA'),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150455', 'SARDINAS'),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150750', 'BAEZA'),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150751', 'COSANGA'),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150752', 'CUYUJA'),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150753', 'PAPALLACTA'),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150754', 'SAN FRANCISCO DE BORJA (VIRGILIO DÁVILA)'),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150755', 'SAN JOSÉ DEL PAYAMINO'),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150756', 'SUMACO'),
('PR_15', 'NAPO', 'CN_1509', 'CARLOS JULIO AROSEMENA TOLA', 'PQ_150950', 'CARLOS JULIO AROSEMENA TOLA'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160150', 'PUYO'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160151', 'ARAJUNO'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160152', 'CANELOS'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160153', 'CURARAY'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160154', 'DIEZ DE AGOSTO'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160155', 'FÁTIMA'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160156', 'MONTALVO (ANDOAS)'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160157', 'POMONA'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160158', 'RÍO CORRIENTES'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160159', 'RÍO TIGRE'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160160', 'SANTA CLARA'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160161', 'SARAYACU'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160162', 'SIMÓN BOLÍVAR (CAB. EN MUSHULLACTA)'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160163', 'TARQUI'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160164', 'TENIENTE HUGO ORTIZ'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160165', 'VERACRUZ (INDILLAMA) (CAB. EN INDILLAMA)'),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160166', 'EL TRIUNFO'),
('PR_16', 'PASTAZA', 'CN_1602', 'MERA', 'PQ_160250', 'MERA'),
('PR_16', 'PASTAZA', 'CN_1602', 'MERA', 'PQ_160251', 'MADRE TIERRA'),
('PR_16', 'PASTAZA', 'CN_1602', 'MERA', 'PQ_160252', 'SHELL'),
('PR_16', 'PASTAZA', 'CN_1603', 'SANTA CLARA', 'PQ_160350', 'SANTA CLARA'),
('PR_16', 'PASTAZA', 'CN_1603', 'SANTA CLARA', 'PQ_160351', 'SAN JOSÉ'),
('PR_16', 'PASTAZA', 'CN_1604', 'ARAJUNO', 'PQ_160450', 'ARAJUNO'),
('PR_16', 'PASTAZA', 'CN_1604', 'ARAJUNO', 'PQ_160451', 'CURARAY'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170101', 'BELISARIO QUEVEDO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170102', 'CARCELÉN'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170103', 'CENTRO HISTÓRICO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170104', 'COCHAPAMBA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170105', 'COMITÉ DEL PUEBLO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170106', 'COTOCOLLAO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170107', 'CHILIBULO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170108', 'CHILLOGALLO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170109', 'CHIMBACALLE'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170110', 'EL CONDADO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170111', 'GUAMANÍ'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170112', 'IÑAQUITO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170113', 'ITCHIMBÍA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170114', 'JIPIJAPA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170115', 'KENNEDY'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170116', 'LA ARGELIA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170117', 'LA CONCEPCIÓN'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170118', 'LA ECUATORIANA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170119', 'LA FERROVIARIA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170120', 'LA LIBERTAD'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170121', 'LA MAGDALENA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170122', 'LA MENA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170123', 'MARISCAL SUCRE'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170124', 'PONCEANO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170125', 'PUENGASÍ'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170126', 'QUITUMBE'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170127', 'RUMIPAMBA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170128', 'SAN BARTOLO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170129', 'SAN ISIDRO DEL INCA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170130', 'SAN JUAN'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170131', 'SOLANDA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170132', 'TURUBAMBA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170150', 'QUITO DISTRITO METROPOLITANO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170151', 'ALANGASÍ'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170152', 'AMAGUAÑA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170153', 'ATAHUALPA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170154', 'CALACALÍ'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170155', 'CALDERÓN'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170156', 'CONOCOTO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170157', 'CUMBAYÁ'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170158', 'CHAVEZPAMBA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170159', 'CHECA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170160', 'EL QUINCHE'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170161', 'GUALEA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170162', 'GUANGOPOLO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170163', 'GUAYLLABAMBA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170164', 'LA MERCED'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170165', 'LLANO CHICO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170166', 'LLOA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170167', 'MINDO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170168', 'NANEGAL'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170169', 'NANEGALITO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170170', 'NAYÓN'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170171', 'NONO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170172', 'PACTO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170173', 'PEDRO VICENTE MALDONADO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170174', 'PERUCHO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170175', 'PIFO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170176', 'PÍNTAG'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170177', 'POMASQUI'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170178', 'PUÉLLARO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170179', 'PUEMBO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170180', 'SAN ANTONIO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170181', 'SAN JOSÉ DE MINAS'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170182', 'SAN MIGUEL DE LOS BANCOS'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170183', 'TABABELA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170184', 'TUMBACO'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170185', 'YARUQUÍ'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170186', 'ZAMBIZA'),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170187', 'PUERTO QUITO'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170201', 'AYORA'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170202', 'CAYAMBE'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170203', 'JUAN MONTALVO'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170250', 'CAYAMBE'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170251', 'ASCÁZUBI'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170252', 'CANGAHUA'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170253', 'OLMEDO (PESILLO)'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170254', 'OTÓN'),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170255', 'SANTA ROSA DE CUZUBAMBA'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170350', 'MACHACHI'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170351', 'ALÓAG'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170352', 'ALOASÍ'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170353', 'CUTUGLAHUA'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170354', 'EL CHAUPI'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170355', 'MANUEL CORNEJO ASTORGA (TANDAPI)'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170356', 'TAMBILLO'),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170357', 'UYUMBICHO'),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170450', 'TABACUNDO'),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170451', 'LA ESPERANZA'),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170452', 'MALCHINGUÍ'),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170453', 'TOCACHI'),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170454', 'TUPIGACHI'),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170501', 'SANGOLQUÍ'),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170502', 'SAN PEDRO DE TABOADA'),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170503', 'SAN RAFAEL'),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170550', 'SANGOLQUI'),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170551', 'COTOGCHOA'),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170552', 'RUMIPAMBA'),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170750', 'SAN MIGUEL DE LOS BANCOS'),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170751', 'MINDO'),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170752', 'PEDRO VICENTE MALDONADO'),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170753', 'PUERTO QUITO'),
('PR_17', 'PICHINCHA', 'CN_1708', 'PEDRO VICENTE MALDONADO', 'PQ_170850', 'PEDRO VICENTE MALDONADO'),
('PR_17', 'PICHINCHA', 'CN_1709', 'PUERTO QUITO', 'PQ_170950', 'PUERTO QUITO'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180101', 'ATOCHA – FICOA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180102', 'CELIANO MONGE'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180103', 'HUACHI CHICO'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180104', 'HUACHI LORETO'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180105', 'LA MERCED'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180106', 'LA PENÍNSULA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180107', 'MATRIZ'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180108', 'PISHILATA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180109', 'SAN FRANCISCO'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180150', 'AMBATO'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180151', 'AMBATILLO'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180152', 'ATAHUALPA (CHISALATA)'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180153', 'AUGUSTO N. MARTÍNEZ (MUNDUGLEO)'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180154', 'CONSTANTINO FERNÁNDEZ (CAB. EN CULLITAHUA)'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180155', 'HUACHI GRANDE'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180156', 'IZAMBA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180157', 'JUAN BENIGNO VELA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180158', 'MONTALVO'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180159', 'PASA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180160', 'PICAIGUA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180161', 'PILAGÜÍN (PILAHÜÍN)'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180162', 'QUISAPINCHA (QUIZAPINCHA)'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180163', 'SAN BARTOLOMÉ DE PINLLOG'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180164', 'SAN FERNANDO (PASA SAN FERNANDO)'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180165', 'SANTA ROSA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180166', 'TOTORAS'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180167', 'CUNCHIBAMBA'),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180168', 'UNAMUNCHO'),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180250', 'BAÑOS DE AGUA SANTA'),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180251', 'LLIGUA'),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180252', 'RÍO NEGRO'),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180253', 'RÍO VERDE'),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180254', 'ULBA'),
('PR_18', 'TUNGURAHUA', 'CN_1803', 'CEVALLOS', 'PQ_180350', 'CEVALLOS'),
('PR_18', 'TUNGURAHUA', 'CN_1804', 'MOCHA', 'PQ_180450', 'MOCHA'),
('PR_18', 'TUNGURAHUA', 'CN_1804', 'MOCHA', 'PQ_180451', 'PINGUILÍ'),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180550', 'PATATE'),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180551', 'EL TRIUNFO'),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180552', 'LOS ANDES (CAB. EN POATUG)'),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180553', 'SUCRE (CAB. EN SUCRE-PATATE URCU)'),
('PR_18', 'TUNGURAHUA', 'CN_1806', 'QUERO', 'PQ_180650', 'QUERO'),
('PR_18', 'TUNGURAHUA', 'CN_1806', 'QUERO', 'PQ_180651', 'RUMIPAMBA'),
('PR_18', 'TUNGURAHUA', 'CN_1806', 'QUERO', 'PQ_180652', 'YANAYACU - MOCHAPATA (CAB. EN YANAYACU)'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180701', 'PELILEO'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180702', 'PELILEO GRANDE'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180750', 'PELILEO'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180751', 'BENÍTEZ (PACHANLICA)'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180752', 'BOLÍVAR'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180753', 'COTALÓ'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180754', 'CHIQUICHA (CAB. EN CHIQUICHA GRANDE)'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180755', 'EL ROSARIO (RUMICHACA)'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180756', 'GARCÍA MORENO (CHUMAQUI)'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180757', 'GUAMBALÓ (HUAMBALÓ)'),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180758', 'SALASACA'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180801', 'CIUDAD NUEVA'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180802', 'PÍLLARO'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180850', 'PÍLLARO'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180851', 'BAQUERIZO MORENO'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180852', 'EMILIO MARÍA TERÁN (RUMIPAMBA)'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180853', 'MARCOS ESPINEL (CHACATA)'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180854', 'PRESIDENTE URBINA (CHAGRAPAMBA -PATZUCUL)'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180855', 'SAN ANDRÉS'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180856', 'SAN JOSÉ DE POALÓ'),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180857', 'SAN MIGUELITO'),
('PR_18', 'TUNGURAHUA', 'CN_1809', 'TISALEO', 'PQ_180950', 'TISALEO'),
('PR_18', 'TUNGURAHUA', 'CN_1809', 'TISALEO', 'PQ_180951', 'QUINCHICOTO'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190101', 'EL LIMÓN'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190102', 'ZAMORA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190150', 'ZAMORA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190151', 'CUMBARATZA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190152', 'GUADALUPE'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190153', 'IMBANA (LA VICTORIA DE IMBANA)'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190154', 'PAQUISHA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190155', 'SABANILLA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190156', 'TIMBARA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190157', 'ZUMBI'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190158', 'SAN CARLOS DE LAS MINAS'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190250', 'ZUMBA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190251', 'CHITO'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190252', 'EL CHORRO'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190253', 'EL PORVENIR DEL CARMEN'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190254', 'LA CHONTA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190255', 'PALANDA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190256', 'PUCAPAMBA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190257', 'SAN FRANCISCO DEL VERGEL'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190258', 'VALLADOLID'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190259', 'SAN ANDRÉS'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1903', 'NANGARITZA', 'PQ_190350', 'GUAYZIMI'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1903', 'NANGARITZA', 'PQ_190351', 'ZURMI'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1903', 'NANGARITZA', 'PQ_190352', 'NUEVO PARAÍSO'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1904', 'YACUAMBI', 'PQ_190450', '28 DE MAYO (SAN JOSÉ DE YACUAMBI)'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1904', 'YACUAMBI', 'PQ_190451', 'LA PAZ'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1904', 'YACUAMBI', 'PQ_190452', 'TUTUPALI'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190550', 'YANTZAZA (YANZATZA)'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190551', 'CHICAÑA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190552', 'EL PANGUI'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190553', 'LOS ENCUENTROS'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190650', 'EL PANGUI'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190651', 'EL GUISME'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190652', 'PACHICUTZA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190653', 'TUNDAYME'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190750', 'ZUMBI'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190751', 'PAQUISHA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190752', 'TRIUNFO-DORADO'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190753', 'PANGUINTZA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190850', 'PALANDA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190851', 'EL PORVENIR DEL CARMEN'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190852', 'SAN FRANCISCO DEL VERGEL'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190853', 'VALLADOLID'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190854', 'LA CANELA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1909', 'PAQUISHA', 'PQ_190950', 'PAQUISHA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1909', 'PAQUISHA', 'PQ_190951', 'BELLAVISTA'),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1909', 'PAQUISHA', 'PQ_190952', 'NUEVO QUITO'),
('PR_20', 'GALAPAGOS', 'CN_2001', 'SAN CRISTÓBAL', 'PQ_200150', 'PUERTO BAQUERIZO MORENO'),
('PR_20', 'GALAPAGOS', 'CN_2001', 'SAN CRISTÓBAL', 'PQ_200151', 'EL PROGRESO'),
('PR_20', 'GALAPAGOS', 'CN_2001', 'SAN CRISTÓBAL', 'PQ_200152', 'ISLA SANTA MARÍA (FLOREANA) (CAB. EN PTO. VELASCO IBARRA)'),
('PR_20', 'GALAPAGOS', 'CN_2002', 'ISABELA', 'PQ_200250', 'PUERTO VILLAMIL'),
('PR_20', 'GALAPAGOS', 'CN_2002', 'ISABELA', 'PQ_200251', 'TOMÁS DE BERLANGA (SANTO TOMÁS)'),
('PR_20', 'GALAPAGOS', 'CN_2003', 'SANTA CRUZ', 'PQ_200350', 'PUERTO AYORA'),
('PR_20', 'GALAPAGOS', 'CN_2003', 'SANTA CRUZ', 'PQ_200351', 'BELLAVISTA'),
('PR_20', 'GALAPAGOS', 'CN_2003', 'SANTA CRUZ', 'PQ_200352', 'SANTA ROSA (INCLUYE LA ISLA BALTRA)'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210150', 'NUEVA LOJA'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210151', 'CUYABENO'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210152', 'DURENO'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210153', 'GENERAL FARFÁN'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210154', 'TARAPOA'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210155', 'EL ENO'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210156', 'PACAYACU'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210157', 'JAMBELÍ'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210158', 'SANTA CECILIA'),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210159', 'AGUAS NEGRAS'),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210250', 'EL DORADO DE CASCALES'),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210251', 'EL REVENTADOR'),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210252', 'GONZALO PIZARRO'),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210253', 'LUMBAQUÍ'),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210254', 'PUERTO LIBRE'),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210255', 'SANTA ROSA DE SUCUMBÍOS'),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210350', 'PUERTO EL CARMEN DEL PUTUMAYO'),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210351', 'PALMA ROJA'),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210352', 'PUERTO BOLÍVAR (PUERTO MONTÚFAR)'),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210353', 'PUERTO RODRÍGUEZ'),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210354', 'SANTA ELENA'),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210450', 'SHUSHUFINDI'),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210451', 'LIMONCOCHA'),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210452', 'PAÑACOCHA'),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210453', 'SAN ROQUE (CAB. EN SAN VICENTE)'),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210454', 'SAN PEDRO DE LOS COFANES'),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210455', 'SIETE DE JULIO'),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210550', 'LA BONITA'),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210551', 'EL PLAYÓN DE SAN FRANCISCO'),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210552', 'LA SOFÍA'),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210553', 'ROSA FLORIDA'),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210554', 'SANTA BÁRBARA'),
('PR_21', 'SUCUMBIOS', 'CN_2106', 'CASCALES', 'PQ_210650', 'EL DORADO DE CASCALES'),
('PR_21', 'SUCUMBIOS', 'CN_2106', 'CASCALES', 'PQ_210651', 'SANTA ROSA DE SUCUMBÍOS'),
('PR_21', 'SUCUMBIOS', 'CN_2106', 'CASCALES', 'PQ_210652', 'SEVILLA'),
('PR_21', 'SUCUMBIOS', 'CN_2107', 'CUYABENO', 'PQ_210750', 'TARAPOA'),
('PR_21', 'SUCUMBIOS', 'CN_2107', 'CUYABENO', 'PQ_210751', 'CUYABENO'),
('PR_21', 'SUCUMBIOS', 'CN_2107', 'CUYABENO', 'PQ_210752', 'AGUAS NEGRAS'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220150', 'PUERTO FRANCISCO DE ORELLANA (EL COCA)'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220151', 'DAYUMA'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220152', 'TARACOA (NUEVA ESPERANZA: YUCA)'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220153', 'ALEJANDRO LABAKA'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220154', 'EL DORADO'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220155', 'EL EDÉN'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220156', 'GARCÍA MORENO'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220157', 'INÉS ARANGO (CAB. EN WESTERN)'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220158', 'LA BELLEZA'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220159', 'NUEVO PARAÍSO (CAB. EN UNIÓN'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220160', 'SAN JOSÉ DE GUAYUSA'),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220161', 'SAN LUIS DE ARMENIA'),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220201', 'TIPITINI'),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220250', 'NUEVO ROCAFUERTE'),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220251', 'CAPITÁN AUGUSTO RIVADENEYRA');
INSERT INTO `dct_parametro_tbl_div_politica` (`dvp_codigo_provincia`, `dvp_provincia`, `dvp_codigo_canton`, `dvp_canton`, `dvp_codigo_parroquia`, `dvp_parroquia`) VALUES
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220252', 'CONONACO'),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220253', 'SANTA MARÍA DE HUIRIRIMA'),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220254', 'TIPUTINI'),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220255', 'YASUNÍ'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220350', 'LA JOYA DE LOS SACHAS'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220351', 'ENOKANQUI'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220352', 'POMPEYA'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220353', 'SAN CARLOS'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220354', 'SAN SEBASTIÁN DEL COCA'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220355', 'LAGO SAN PEDRO'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220356', 'RUMIPAMBA'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220357', 'TRES DE NOVIEMBRE'),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220358', 'UNIÓN MILAGREÑA'),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220450', 'LORETO'),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220451', 'AVILA (CAB. EN HUIRUNO)'),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220452', 'PUERTO MURIALDO'),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220453', 'SAN JOSÉ DE PAYAMINO'),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220454', 'SAN JOSÉ DE DAHUANO'),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220455', 'SAN VICENTE DE HUATICOCHA'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230101', 'ABRAHAM CALAZACÓN'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230102', 'BOMBOLÍ'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230103', 'CHIGUILPE'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230104', 'RÍO TOACHI'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230105', 'RÍO VERDE'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230106', 'SANTO DOMINGO DE LOS COLORADOS'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230107', 'ZARACAY'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230150', 'SANTO DOMINGO DE LOS COLORADOS'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230151', 'ALLURIQUÍN'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230152', 'PUERTO LIMÓN'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230153', 'LUZ DE AMÉRICA'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230154', 'SAN JACINTO DEL BÚA'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230155', 'VALLE HERMOSO'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230156', 'EL ESFUERZO'),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230157', 'SANTA MARÍA DEL TOACHI'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240101', 'BALLENITA'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240102', 'SANTA ELENA'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240150', 'SANTA ELENA'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240151', 'ATAHUALPA'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240152', 'COLONCHE'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240153', 'CHANDUY'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240154', 'MANGLARALTO'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240155', 'SIMÓN BOLÍVAR (JULIO MORENO)'),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240156', 'SAN JOSÉ DE ANCÓN'),
('PR_24', 'SANTA ELENA', 'CN_2402', 'LA LIBERTAD', 'PQ_240250', 'LA LIBERTAD'),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240301', 'CARLOS ESPINOZA LARREA'),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240302', 'GRAL. ALBERTO ENRÍQUEZ GALLO'),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240303', 'VICENTE ROCAFUERTE'),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240304', 'SANTA ROSA'),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240350', 'SALINAS'),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240351', 'ANCONCITO'),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240352', 'JOSÉ LUIS TAMAYO (MUEY)'),
('PR_90', 'ZONAS NO DELIMITADAS', 'CN_9001', 'LAS GOLONDRINAS', 'PQ_900151', 'LAS GOLONDRINAS'),
('PR_90', 'ZONAS NO DELIMITADAS', 'CN_9003', 'MANGA DEL CURA', 'PQ_900351', 'MANGA DEL CURA'),
('PR_90', 'ZONAS NO DELIMITADAS', 'CN_9004', 'EL PIEDRERO', 'PQ_900451', 'EL PIEDRERO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_advertencia_sri`
--

CREATE TABLE `dct_pos_tbl_advertencia_sri` (
  `sra_codigo` tinyint(1) NOT NULL,
  `sra_descripcion` varchar(150) DEFAULT NULL,
  `sra_motivo` varchar(250) DEFAULT NULL,
  `sra_validacion` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_advertencia_sri`
--

INSERT INTO `dct_pos_tbl_advertencia_sri` (`sra_codigo`, `sra_descripcion`, `sra_motivo`, `sra_validacion`) VALUES
(2, 'RUC del emisor se encuentra NO ACTIVO.', 'Verificar que el número de RUC se encuentre en estado ACTIVO.', 'AUTORIZACIÓN'),
(10, 'Establecimiento del emisor se encuentra Clausurado.', 'No se autorizará comprobantes si el establecimiento emisor ha sido clausurado, automáticamente se habilitará el servicio una vez concluido la clausura.', 'AUTORIZACIÓN'),
(26, 'Tamaño máximo superado', 'Tamaño del archivo supera lo establecido', 'RECEPCIÓN'),
(27, 'Clase no permitido', 'La clase del contribuyente no puede emitir comprobantes electrónicos.', 'AUTORIZACIÓN'),
(28, 'Acuerdo de medios electrónicos no aceptado', 'Siempre el contribuyente debe haber aceptado el acuerdo de medio electrónicos en el cual se establece que se acepta que lleguen las notificaciones al buzón del contribuyente.', 'RECEPCIÓN'),
(34, 'Comprobante no autorizado', 'Cuando el comprobante no ha sido autorizado como parte de la solicitud de emisión del contribuyente.', 'EMISOR'),
(35, 'Documento inválido', 'Cuando el XML no pasa validación de esquema.', 'RECEPCIÓN'),
(36, 'Versión esquema descontinuada', 'Cuando la versión del esquema no es la correcta.', 'RECEPCIÓN'),
(37, 'RUC sin autorización de emisión', 'Cuando el RUC del emisor no cuenta con una solicitud de emisión de comprobantes electrónicos.', 'AUTORIZACIÓN'),
(39, 'Firma inválida', 'Firma electrónica del emisor no es válida.', 'AUTORIZACIÓN'),
(40, 'Error en el certificado', 'No se encontró el certificado o no se puede convertir en certificad X509.', 'AUTORIZACIÓN'),
(42, 'Certificado revocado', 'Certificado que ha superado su fecha de caducidad, y no ha sido renovado.', 'EMISOR'),
(43, 'Clave acceso registrada', 'Cuando la clave de acceso ya se encuentra registrada en la base de datos.', 'RECEPCIÓN'),
(45, 'Secuencial registrado', 'Secuencial del comprobante ya se encuentra registrado en la base de datos', 'RECEPCIÓN'),
(46, 'RUC no existe', 'Cuando el RUC emisor no existe en el Registro Único de Contribuyentes.', 'AUTORIZACIÓN'),
(47, 'Tipo de comprobante no existe', 'Cuando envían en el tipo de comprobante uno que no exista en el catálogo de nuestros tipos de comprobantes.', 'RECEPCIÓN'),
(48, 'Esquema XSD no existe', 'Cuando el esquema para el tipo de comprobante enviado no existe.', 'RECEPCIÓN'),
(49, 'Argumentos que envían al WS nulos', 'Cuando se consume el WS con argumentos nulos.', 'RECEPCIÓN'),
(50, 'Error interno general', 'Cuando ocurre un error inesperado en el servidor.', 'RECEPCIÓN'),
(52, 'Error en diferencias', 'Cuando existe error en los cálculos del comprobante.', 'AUTORIZACIÓN'),
(56, 'Establecimiento cerrado', 'Cuando el establecimiento desde el cual se genera el comprobante se encuentra cerrado.', 'AUTORIZACIÓN'),
(57, 'Autorización suspendida', 'Cuando la autorización para emisión de comprobantes electrónicos para el emisor se encuentra suspendida por procesos de control de la Administración Tributaria.', 'AUTORIZACIÓN'),
(58, 'Error en la estructura de clave acceso', 'Cuando la clave de acceso tiene componentes diferentes a los del comprobante.', 'AUTORIZACIÓN'),
(59, 'Identificación no existe', 'Cuando el número de la identificación del adquirente no existe.', 'COD ERROR 70'),
(60, 'Ambiente ejecución.', 'Siempre que el comprobante sea emitido en ambiente de certificación o pruebas se enviará como parte de la autorización esta advertencia.', 'COD ERROR 70'),
(62, 'Identificación incorrecta', 'Cuando el número de la identificación del adquirente del comprobante está incorrecto.  Por ejemplo, cédulas no pasan el dígito verificador.', 'COD ERROR 70'),
(63, 'RUC clausurado', 'Cuando el RUC del emisor se encuentra clausurado por procesos de control de la Administración Tributaria.', 'AUTORIZACIÓN'),
(64, 'Código documento sustento', 'Cuando el código del documento sustento no existe en el catálogo de documentos que se tiene en la Administración.', 'EMISOR'),
(65, 'Fecha de emisión extemporánea', 'Cuando el comprobante emitido no fue enviado de acuerdo con el tiempo del tipo de emisión en el cual fue realizado.', 'EMISOR/ RECEPCIÓN'),
(67, 'Fecha inválida', 'Cuando existe errores en el formato de la fecha.', 'RECEPCIÓN'),
(68, 'Documento sustento', 'Cuando el comprobante relacionado no existe como electrónico.', 'COD ERROR 70'),
(69, 'Identificación del receptor', 'Cuando la identificación asociada al adquirente no existe. En general cuando el RUC del adquirente no existe en el Registro Único de Contribuyentes.', 'EMISOR'),
(70, 'Clave de acceso en procesamiento', 'Cuando se desea enviar un comprobante que ha sido enviado anteriormente y el mismo no ha terminado su\nprocesamiento.', 'RECEPCIÓN'),
(80, 'Error en la estructura de clave acceso', 'Cuando se ejecuta la consulta de autorización por clave de acceso y el valor de este parámetro supera los 49 dígitos, tiene caracteres alfanuméricos o cuando el tag\n(claveAccesoComprobante) está vacío', 'AUTORIZACIÓN'),
(82, 'Error en la fecha de inicio de transporte', 'Cuando la fecha de inicio de transporte es menor a la fecha de emisión de la guía de remisión.', 'RECEPCIÓN'),
(92, 'Error al validar monto de devolución del IVA.', 'Cuando el valor registrado en el campo de devolución del IVA, en facturas y notas de débito, no corresponde al que fue autorizado por el servicio web DIG.', 'RECEPCIÓN');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_cientes`
--

CREATE TABLE `dct_pos_tbl_cientes` (
  `cli_id_cliente` int(11) NOT NULL,
  `emp_id_empresa` int(11) NOT NULL,
  `cli_tipo_identificacion` varchar(2) NOT NULL,
  `cli_identificacion` varchar(13) NOT NULL,
  `cli_nombre_1` varchar(10) NOT NULL,
  `cli_nombre_2` varchar(10) DEFAULT NULL,
  `cli_apellido_1` varchar(10) NOT NULL,
  `cli_apellido_2` varchar(10) DEFAULT NULL,
  `cli_correo` varchar(50) NOT NULL,
  `cli_direccion` varchar(150) DEFAULT NULL,
  `cli_telefono` varchar(10) DEFAULT NULL,
  `cli_placa` varchar(8) DEFAULT NULL,
  `cli_estado` tinyint(1) NOT NULL,
  `cli_usuario_creacion` varchar(13) DEFAULT NULL,
  `cli_usuario_modificacion` varchar(13) DEFAULT NULL,
  `cli_fecha_creacion` timestamp NULL DEFAULT NULL,
  `cli_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `cli_ip_creacion` varchar(100) DEFAULT NULL,
  `cli_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_cientes`
--

INSERT INTO `dct_pos_tbl_cientes` (`cli_id_cliente`, `emp_id_empresa`, `cli_tipo_identificacion`, `cli_identificacion`, `cli_nombre_1`, `cli_nombre_2`, `cli_apellido_1`, `cli_apellido_2`, `cli_correo`, `cli_direccion`, `cli_telefono`, `cli_placa`, `cli_estado`, `cli_usuario_creacion`, `cli_usuario_modificacion`, `cli_fecha_creacion`, `cli_fecha_modificacion`, `cli_ip_creacion`, `cli_ip_modificacion`) VALUES
(1, 1, '05', '1308041134', 'MERY', NULL, 'REINA', NULL, 'mreinacevallos@iess.gob.ec', 'LOS ESTEROS', '0960939030', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, '04', '9999999999999', 'CONSUMIDOR', NULL, 'FINAL', NULL, 'na@na.com', 'CONSUMIDOR FINAL', '0999999999', '--------', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, '04', '1308041135', 'MAURO', NULL, 'ECHEVERRIA', NULL, 'dfgfdg@asdsad.com', 'GUAYAQUI FERTIZA', NULL, NULL, 1, '0919664854', NULL, '2022-08-24 21:24:23', NULL, '::1', NULL),
(4, 1, '05', '0919664854', 'MAURO', NULL, 'ECHEVERRIA', NULL, 'rtytryt@asdasd.com', 'GUAYAQUI FERTIZA', NULL, NULL, 1, '0919664854', NULL, '2022-08-24 21:26:26', NULL, '::1', NULL),
(5, 1, '04', '12345679012', 'MAURO', 'WERWER', 'ECHEVERRIA', 'WERWER', 'sdfsdf@sadsad.com', 'GUAYAQUI FERTIZA', '2324234234', '34345435', 1, '0919664854', NULL, '2022-08-24 21:27:14', NULL, '::1', NULL),
(6, 1, '05', '1706486105', 'MAURO', 'DGDFG', 'ECHEVERRIA', 'DFGDF', 'fghf@df.com', 'GUAYAQUI FERTIZA', '2324234234', 'T34T34T4', 1, '0919664854', NULL, '2022-08-24 23:23:14', NULL, '::1', NULL),
(7, 1, '05', '9992525252', 'FGHFGH', 'FGHFGH', 'FGHFGH', 'FGHFGH', 'dgdff@sdfsdf.com', 'FGHFGH', '0426565656', NULL, 1, '0919664854', NULL, '2022-09-18 02:53:10', NULL, '::1', NULL),
(8, 1, '04', '0930924853', 'BCVBCVBVC', 'FGHFGH', 'YFTYRTY', 'FGHGH', 'ghg@fdgdfg.com', 'FGHFGH', '0565656565', 'GHFGHGH', 1, '0919664854', NULL, '2022-10-10 21:01:31', NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_empresa_establecimiento`
--

CREATE TABLE `dct_pos_tbl_empresa_establecimiento` (
  `est_id_empresa_establecimiento` int(11) NOT NULL,
  `emp_id_empresa` int(11) NOT NULL,
  `est_cod_establecimiento` int(11) NOT NULL,
  `est_nombre` varchar(125) NOT NULL,
  `est_direccion_emisor` varchar(300) NOT NULL,
  `est_es_matriz` tinyint(4) NOT NULL,
  `est_estado` tinyint(1) NOT NULL,
  `est_usuario_creacion` varchar(13) DEFAULT NULL,
  `est_usuario_modificacion` varchar(13) DEFAULT NULL,
  `est_fecha_creacion` timestamp NULL DEFAULT NULL,
  `est_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `est_ip_creacion` varchar(100) DEFAULT NULL,
  `est_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_empresa_establecimiento`
--

INSERT INTO `dct_pos_tbl_empresa_establecimiento` (`est_id_empresa_establecimiento`, `emp_id_empresa`, `est_cod_establecimiento`, `est_nombre`, `est_direccion_emisor`, `est_es_matriz`, `est_estado`, `est_usuario_creacion`, `est_usuario_modificacion`, `est_fecha_creacion`, `est_fecha_modificacion`, `est_ip_creacion`, `est_ip_modificacion`) VALUES
(1, 1, 1, '', 'LA RIOJA', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_empresa_punto_emision`
--

CREATE TABLE `dct_pos_tbl_empresa_punto_emision` (
  `epe_id_empresa_punto_emision` int(11) NOT NULL,
  `epe_id_empresa_establecimiento` int(11) NOT NULL,
  `epe_cod_punto_emision` int(11) NOT NULL,
  `epe_descripcion_punto_emisor` varchar(50) NOT NULL,
  `epe_estado` tinyint(1) NOT NULL,
  `epe_usuario_creacion` varchar(13) DEFAULT NULL,
  `epe_usuario_modificacion` varchar(13) DEFAULT NULL,
  `epe_fecha_creacion` timestamp NULL DEFAULT NULL,
  `epe_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `epe_ip_creacion` varchar(100) DEFAULT NULL,
  `epe_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_empresa_punto_emision`
--

INSERT INTO `dct_pos_tbl_empresa_punto_emision` (`epe_id_empresa_punto_emision`, `epe_id_empresa_establecimiento`, `epe_cod_punto_emision`, `epe_descripcion_punto_emisor`, `epe_estado`, `epe_usuario_creacion`, `epe_usuario_modificacion`, `epe_fecha_creacion`, `epe_fecha_modificacion`, `epe_ip_creacion`, `epe_ip_modificacion`) VALUES
(1, 1, 1, 'CAJA 1', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_empresa_serial`
--

CREATE TABLE `dct_pos_tbl_empresa_serial` (
  `ser_id_empresa_serial` int(11) NOT NULL,
  `emp_id_empresa` int(11) NOT NULL,
  `ser_factura_serie` int(11) NOT NULL,
  `ser_factura_cod_num` int(11) NOT NULL,
  `ser_nota_credito_serie` int(11) NOT NULL,
  `ser_nota_credito_cod_num` int(11) NOT NULL,
  `ser_nota_debito_serie` int(11) NOT NULL,
  `ser_nota_debito_cod_num` int(11) NOT NULL,
  `ser_guia_remision_serie` int(11) NOT NULL,
  `ser_guia_remision_cod_num` int(11) NOT NULL,
  `ser_comp_ret_serie` int(11) NOT NULL,
  `ser_comp_ret_cod_num` int(11) NOT NULL,
  `ser_estado` tinyint(1) NOT NULL,
  `ser_usuario_creacion` varchar(13) DEFAULT NULL,
  `ser_usuario_modificacion` varchar(13) DEFAULT NULL,
  `ser_fecha_creacion` timestamp NULL DEFAULT NULL,
  `ser_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `ser_ip_creacion` varchar(100) DEFAULT NULL,
  `ser_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_empresa_serial`
--

INSERT INTO `dct_pos_tbl_empresa_serial` (`ser_id_empresa_serial`, `emp_id_empresa`, `ser_factura_serie`, `ser_factura_cod_num`, `ser_nota_credito_serie`, `ser_nota_credito_cod_num`, `ser_nota_debito_serie`, `ser_nota_debito_cod_num`, `ser_guia_remision_serie`, `ser_guia_remision_cod_num`, `ser_comp_ret_serie`, `ser_comp_ret_cod_num`, `ser_estado`, `ser_usuario_creacion`, `ser_usuario_modificacion`, `ser_fecha_creacion`, `ser_fecha_modificacion`, `ser_ip_creacion`, `ser_ip_modificacion`) VALUES
(1, 1, 152, 154, 1266, 1, 1236, 1, 102, 1, 123, 1, 1, NULL, '0919664854', NULL, '2022-10-16 02:22:45', NULL, '::1'),
(3, 2, 10, 1, 1266, 1, 1236, 1, 102, 1, 123, 1, 1, NULL, '0919664854', NULL, '2022-08-09 03:44:36', NULL, '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_factura_detalle`
--

CREATE TABLE `dct_pos_tbl_factura_detalle` (
  `fdt_id_factura_detalle` int(11) NOT NULL,
  `ftr_id_factura_transaccion` int(11) NOT NULL,
  `prs_id_prod_serv` int(11) NOT NULL,
  `fdt_cantidad` int(11) NOT NULL,
  `fdt_estado` tinyint(1) NOT NULL,
  `fdt_usuario_creacion` varchar(13) DEFAULT NULL,
  `fdt_usuario_modificacion` varchar(13) DEFAULT NULL,
  `fdt_fecha_creacion` timestamp NULL DEFAULT NULL,
  `fdt_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `fdt_ip_creacion` varchar(100) DEFAULT NULL,
  `fdt_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_factura_detalle`
--

INSERT INTO `dct_pos_tbl_factura_detalle` (`fdt_id_factura_detalle`, `ftr_id_factura_transaccion`, `prs_id_prod_serv`, `fdt_cantidad`, `fdt_estado`, `fdt_usuario_creacion`, `fdt_usuario_modificacion`, `fdt_fecha_creacion`, `fdt_fecha_modificacion`, `fdt_ip_creacion`, `fdt_ip_modificacion`) VALUES
(1, 1, 1, 10, 1, '0919664854', NULL, '2022-10-07 19:00:26', NULL, '::1', NULL),
(2, 2, 3, 30, 1, '0919664854', NULL, '2022-10-07 19:09:40', NULL, '::1', NULL),
(3, 2, 1, 40, 1, '0919664854', NULL, '2022-10-07 19:09:45', NULL, '::1', NULL),
(4, 3, 3, 30, 1, '0919664854', NULL, '2022-10-07 19:12:49', NULL, '::1', NULL),
(5, 3, 1, 20, 1, '0919664854', NULL, '2022-10-07 19:12:52', NULL, '::1', NULL),
(6, 4, 1, 10, 1, '0919664854', NULL, '2022-10-08 17:39:51', NULL, '::1', NULL),
(7, 4, 3, 10, 1, '0919664854', NULL, '2022-10-08 17:39:53', NULL, '::1', NULL),
(8, 5, 3, 20, 1, '0919664854', NULL, '2022-10-08 20:31:26', NULL, '::1', NULL),
(9, 6, 2, 1, 1, '0919664854', NULL, '2022-10-10 19:55:43', NULL, '::1', NULL),
(10, 7, 2, 1, 1, '0919664854', NULL, '2022-10-10 20:53:50', NULL, '::1', NULL),
(11, 8, 2, 1, 1, '0919664854', NULL, '2022-10-10 20:55:34', NULL, '::1', NULL),
(12, 9, 3, 2500, 1, '0919664854', NULL, '2022-10-10 21:02:03', NULL, '::1', NULL),
(13, 10, 3, 20, 1, '0919664854', NULL, '2022-10-13 03:09:11', NULL, '::1', NULL),
(14, 11, 3, 20, 1, '0919664854', NULL, '2022-10-13 03:11:28', NULL, '::1', NULL),
(15, 11, 1, 30, 1, '0919664854', NULL, '2022-10-13 03:11:32', NULL, '::1', NULL),
(16, 12, 1, 50, 1, '0919664854', NULL, '2022-10-13 03:11:54', NULL, '::1', NULL),
(17, 12, 2, 10, 1, '0919664854', NULL, '2022-10-13 03:11:58', NULL, '::1', NULL),
(18, 12, 3, 500, 1, '0919664854', NULL, '2022-10-13 03:12:01', NULL, '::1', NULL),
(19, 12, 4, 30, 1, '0919664854', NULL, '2022-10-13 03:12:07', NULL, '::1', NULL),
(20, 13, 2, 1, 1, '0919664854', NULL, '2022-10-13 03:30:57', NULL, '::1', NULL),
(21, 13, 3, 20, 1, '0919664854', NULL, '2022-10-13 03:30:59', NULL, '::1', NULL),
(22, 14, 3, 20, 1, '0919664854', NULL, '2022-10-13 03:37:29', NULL, '::1', NULL),
(23, 15, 3, 20, 1, '0919664854', NULL, '2022-10-13 03:38:03', NULL, '::1', NULL),
(24, 16, 3, 10, 1, '0919664854', NULL, '2022-10-14 13:44:42', NULL, '::1', NULL),
(25, 17, 3, 10, 1, '0919664854', NULL, '2022-10-14 15:13:01', NULL, '::1', NULL),
(26, 18, 3, 12, 1, '0919664854', NULL, '2022-10-14 15:14:46', NULL, '::1', NULL),
(27, 19, 2, 10, 1, '0919664854', NULL, '2022-10-14 15:16:11', NULL, '::1', NULL),
(28, 20, 2, 1, 1, '0919664854', NULL, '2022-10-14 15:21:48', NULL, '::1', NULL),
(29, 20, 3, 2, 1, '0919664854', NULL, '2022-10-14 15:21:50', NULL, '::1', NULL),
(30, 21, 3, 23, 1, '0919664854', NULL, '2022-10-14 16:44:09', NULL, '::1', NULL),
(31, 21, 4, 56, 1, '0919664854', NULL, '2022-10-14 16:44:13', NULL, '::1', NULL),
(32, 22, 2, 1, 1, '0919664854', NULL, '2022-10-14 16:44:54', NULL, '::1', NULL),
(33, 22, 3, 20, 1, '0919664854', NULL, '2022-10-14 16:44:58', NULL, '::1', NULL),
(34, 23, 1, 10, 1, '0919664854', NULL, '2022-10-15 14:15:16', NULL, '::1', NULL),
(35, 24, 1, 2, 1, '0919664854', NULL, '2022-10-15 15:06:20', NULL, '::1', NULL),
(36, 25, 2, 1, 1, '0919664854', NULL, '2022-10-15 15:08:27', NULL, '::1', NULL),
(37, 26, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:13:01', NULL, '::1', NULL),
(38, 27, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:16:04', NULL, '::1', NULL),
(39, 28, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:19:28', NULL, '::1', NULL),
(40, 29, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:20:23', NULL, '::1', NULL),
(41, 30, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:23:53', NULL, '::1', NULL),
(42, 31, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:30:52', NULL, '::1', NULL),
(43, 32, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:31:24', NULL, '::1', NULL),
(44, 33, 3, 10, 0, '0919664854', '0919664854', '2022-10-15 15:34:42', '2022-10-15 15:34:54', '::1', '::1'),
(45, 33, 2, 1, 1, '0919664854', NULL, '2022-10-15 15:34:59', NULL, '::1', NULL),
(46, 34, 2, 1, 1, '0919664854', NULL, '2022-10-15 15:36:30', NULL, '::1', NULL),
(47, 35, 1, 10, 1, '0919664854', NULL, '2022-10-15 15:40:27', NULL, '::1', NULL),
(48, 36, 4, 10, 1, '0919664854', NULL, '2022-10-16 02:22:37', NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_factura_transaccion`
--

CREATE TABLE `dct_pos_tbl_factura_transaccion` (
  `ftr_id_factura_transaccion` int(11) NOT NULL,
  `emp_id_empresa` int(11) NOT NULL,
  `cli_id_cliente` int(11) DEFAULT NULL,
  `ftr_id_forma_pago` varchar(2) DEFAULT NULL,
  `ftr_fecha_emision` varchar(8) NOT NULL,
  `ftr_tipo_comprobante` varchar(2) NOT NULL,
  `ftr_ruc` varchar(13) NOT NULL,
  `ftr_tipo_ambiente` varchar(1) NOT NULL,
  `ftr_establecimiento` varchar(3) NOT NULL,
  `ftr_punto_emision` varchar(3) NOT NULL,
  `ftr_num_comprobante` varchar(9) NOT NULL,
  `ftr_cod_numerico` varchar(8) NOT NULL,
  `ftr_tipo_emision` varchar(1) NOT NULL,
  `ftr_dig_verificador` varchar(1) NOT NULL,
  `ftr_sri_clave_acceso` varchar(49) NOT NULL,
  `ftr_fecha_autorizacion` date DEFAULT NULL,
  `ftr_estado_transaccion` varchar(3) NOT NULL,
  `ftr_cod_error` tinyint(4) DEFAULT NULL,
  `ftr_estado` tinyint(1) NOT NULL,
  `ftr_usuario_creacion` varchar(13) DEFAULT NULL,
  `ftr_usuario_modificacion` varchar(13) DEFAULT NULL,
  `ftr_fecha_creacion` timestamp NULL DEFAULT NULL,
  `ftr_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `ftr_ip_creacion` varchar(100) DEFAULT NULL,
  `ftr_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_factura_transaccion`
--

INSERT INTO `dct_pos_tbl_factura_transaccion` (`ftr_id_factura_transaccion`, `emp_id_empresa`, `cli_id_cliente`, `ftr_id_forma_pago`, `ftr_fecha_emision`, `ftr_tipo_comprobante`, `ftr_ruc`, `ftr_tipo_ambiente`, `ftr_establecimiento`, `ftr_punto_emision`, `ftr_num_comprobante`, `ftr_cod_numerico`, `ftr_tipo_emision`, `ftr_dig_verificador`, `ftr_sri_clave_acceso`, `ftr_fecha_autorizacion`, `ftr_estado_transaccion`, `ftr_cod_error`, `ftr_estado`, `ftr_usuario_creacion`, `ftr_usuario_modificacion`, `ftr_fecha_creacion`, `ftr_fecha_modificacion`, `ftr_ip_creacion`, `ftr_ip_modificacion`) VALUES
(1, 1, 1, '20', '07102022', '01', '0919664854001', '1', '001', '001', '000000116', '00000118', '1', '3', '0710202201091966485400110010010000001160000011813', '2022-10-07', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-07 19:00:13', '2022-10-07 19:06:15', '::1', '::1'),
(2, 1, 1, '19', '07102022', '01', '0919664854001', '1', '001', '001', '000000117', '00000119', '1', '6', '0710202201091966485400110010010000001170000011916', NULL, 'DVT', 45, 1, '0919664854', '0919664854', '2022-10-07 19:09:35', '2022-10-07 19:11:36', '::1', '::1'),
(3, 1, 1, '19', '07102022', '01', '0919664854001', '1', '001', '001', '000000118', '00000120', '1', '2', '0710202201091966485400110010010000001180000012012', NULL, 'NAT', 52, 1, '0919664854', '0919664854', '2022-10-07 19:12:43', '2022-10-07 19:13:03', '::1', '::1'),
(4, 1, 1, '20', '08102022', '01', '0919664854001', '1', '001', '001', '000000119', '00000121', '1', '1', '0810202201091966485400110010010000001190000012111', NULL, 'NAT', 52, 1, '0919664854', '0919664854', '2022-10-08 17:39:43', '2022-10-08 17:40:04', '::1', '::1'),
(5, 1, 1, '19', '08102022', '01', '0919664854001', '1', '001', '001', '000000120', '00000122', '1', '2', '0810202201091966485400110010010000001200000012212', '2022-10-08', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-08 20:31:21', '2022-10-08 20:31:34', '::1', '::1'),
(6, 1, 1, '19', '10102022', '01', '0919664854001', '1', '001', '001', '000000121', '00000123', '1', '2', '1010202201091966485400110010010000001210000012312', '2022-10-10', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-10 19:55:31', '2022-10-10 20:51:43', '::1', '::1'),
(7, 1, 1, '19', '10102022', '01', '0919664854001', '1', '001', '001', '000000122', '00000124', '1', '5', '1010202201091966485400110010010000001220000012415', '2022-10-10', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-10 20:53:41', '2022-10-10 20:54:05', '::1', '::1'),
(8, 1, 1, '19', '10102022', '01', '0919664854001', '1', '001', '001', '000000123', '00000125', '1', '8', '1010202201091966485400110010010000001230000012518', '2022-10-10', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-10 20:55:26', '2022-10-10 20:57:42', '::1', '::1'),
(9, 1, 2, '20', '10102022', '01', '0919664854001', '1', '001', '001', '000000124', '00000126', '1', '0', '1010202201091966485400110010010000001240000012610', '2022-10-10', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-10 21:00:35', '2022-10-10 21:02:16', '::1', '::1'),
(10, 1, 1, '19', '12102022', '01', '0919664854001', '1', '001', '001', '000000125', '00000127', '1', '2', '1210202201091966485400110010010000001250000012712', '2022-10-12', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-13 03:06:52', '2022-10-13 03:11:20', '::1', '::1'),
(11, 1, 1, '19', '12102022', '01', '0919664854001', '1', '001', '001', '000000126', '00000128', '1', '5', '1210202201091966485400110010010000001260000012815', '2022-10-12', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-13 03:11:22', '2022-10-13 03:11:41', '::1', '::1'),
(12, 1, 1, '16', '12102022', '01', '0919664854001', '1', '001', '001', '000000127', '00000129', '1', '8', '1210202201091966485400110010010000001270000012918', '2022-10-12', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-13 03:11:48', '2022-10-13 03:12:20', '::1', '::1'),
(13, 1, 1, '19', '12102022', '01', '0919664854001', '1', '001', '001', '000000128', '00000130', '1', '4', '1210202201091966485400110010010000001280000013014', NULL, 'DVT', 35, 1, '0919664854', '0919664854', '2022-10-13 03:30:49', '2022-10-13 03:31:11', '::1', '::1'),
(14, 1, 1, '19', '12102022', '01', '0919664854001', '1', '001', '001', '000000129', '00000131', '1', '7', '1210202201091966485400110010010000001290000013117', NULL, 'DVT', 35, 1, '0919664854', '0919664854', '2022-10-13 03:37:20', '2022-10-13 03:37:34', '::1', '::1'),
(15, 1, 1, '19', '12102022', '01', '0919664854001', '1', '001', '001', '000000130', '00000132', '1', '1', '1210202201091966485400110010010000001300000013211', NULL, 'DVT', 35, 1, '0919664854', '0919664854', '2022-10-13 03:37:57', '2022-10-13 03:38:08', '::1', '::1'),
(16, 1, 1, '19', '14102022', '01', '0919664854001', '1', '001', '001', '000000131', '00000133', '1', '1', '1410202201091966485400110010010000001310000013311', NULL, 'DVT', 35, 1, '0919664854', '0919664854', '2022-10-14 13:37:39', '2022-10-14 14:16:44', '::1', '::1'),
(17, 1, 1, '19', '14102022', '01', '0919664854001', '1', '001', '001', '000000132', '00000134', '1', '4', '1410202201091966485400110010010000001320000013414', NULL, 'NAT', 52, 1, '0919664854', '0919664854', '2022-10-14 15:12:53', '2022-10-14 15:13:13', '::1', '::1'),
(18, 1, 1, '19', '14102022', '01', '0919664854001', '1', '001', '001', '000000133', '00000135', '1', '7', '1410202201091966485400110010010000001330000013517', NULL, 'PPR', NULL, 1, '0919664854', '0919664854', '2022-10-14 15:14:39', '2022-10-14 15:14:49', '::1', '::1'),
(19, 1, 1, '19', '14102022', '01', '0919664854001', '1', '001', '001', '000000134', '00000136', '1', '1', '1410202201091966485400110010010000001340000013611', '2022-10-14', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-14 15:16:03', '2022-10-14 15:16:19', '::1', '::1'),
(20, 1, 1, '19', '14102022', '01', '0919664854001', '1', '001', '001', '000000135', '00000137', '1', '2', '1410202201091966485400110010010000001350000013712', '2022-10-14', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-14 15:21:41', '2022-10-14 15:22:05', '::1', '::1'),
(21, 1, 1, '16', '14102022', '01', '0919664854001', '1', '001', '001', '000000136', '00000138', '1', '5', '1410202201091966485400110010010000001360000013815', '2022-10-14', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-14 16:44:04', '2022-10-14 16:44:27', '::1', '::1'),
(22, 1, 1, '19', '14102022', '01', '0919664854001', '1', '001', '001', '000000137', '00000139', '1', '8', '1410202201091966485400110010010000001370000013918', '2022-10-14', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-14 16:44:48', '2022-10-14 16:45:09', '::1', '::1'),
(23, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000138', '00000140', '1', '9', '1510202201091966485400110010010000001380000014019', NULL, 'PPR', NULL, 1, '0919664854', '0919664854', '2022-10-15 14:15:04', '2022-10-15 15:05:35', '::1', '::1'),
(24, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000139', '00000141', '1', '1', '1510202201091966485400110010010000001390000014111', NULL, 'PPR', NULL, 1, '0919664854', '0919664854', '2022-10-15 15:06:14', '2022-10-15 15:07:26', '::1', '::1'),
(25, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000140', '00000142', '1', '4', '1510202201091966485400110010010000001400000014214', '2022-10-15', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-15 15:08:19', '2022-10-15 15:08:47', '::1', '::1'),
(26, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000141', '00000143', '1', '7', '1510202201091966485400110010010000001410000014317', NULL, 'PPR', NULL, 1, '0919664854', '0919664854', '2022-10-15 15:12:52', '2022-10-15 15:13:12', '::1', '::1'),
(27, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000142', '00000144', '1', '1', '1510202201091966485400110010010000001420000014411', NULL, 'PPR', NULL, 1, '0919664854', '0919664854', '2022-10-15 15:15:56', '2022-10-15 15:16:07', '::1', '::1'),
(28, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000143', '00000145', '1', '2', '1510202201091966485400110010010000001430000014512', NULL, 'NAT', 52, 1, '0919664854', '0919664854', '2022-10-15 15:19:22', '2022-10-15 15:19:58', '::1', '::1'),
(29, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000144', '00000146', '1', '5', '1510202201091966485400110010010000001440000014615', NULL, 'NAT', 52, 1, '0919664854', '0919664854', '2022-10-15 15:20:13', '2022-10-15 15:20:36', '::1', '::1'),
(30, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000145', '00000147', '1', '8', '1510202201091966485400110010010000001450000014718', NULL, 'NAT', 0, 1, '0919664854', '0919664854', '2022-10-15 15:23:38', '2022-10-15 15:30:32', '::1', '::1'),
(31, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000146', '00000148', '1', '0', '1510202201091966485400110010010000001460000014810', NULL, 'NAT', 0, 1, '0919664854', '0919664854', '2022-10-15 15:30:45', '2022-10-15 15:31:02', '::1', '::1'),
(32, 1, 1, '16', '15102022', '01', '0919664854001', '1', '001', '001', '000000147', '00000149', '1', '3', '1510202201091966485400110010010000001470000014913', NULL, 'NAT', 52, 1, '0919664854', '0919664854', '2022-10-15 15:31:17', '2022-10-15 15:31:43', '::1', '::1'),
(33, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000148', '00000150', '1', '1', '1510202201091966485400110010010000001480000015011', '2022-10-15', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-15 15:34:36', '2022-10-15 15:35:08', '::1', '::1'),
(34, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000149', '00000151', '1', '2', '1510202201091966485400110010010000001490000015112', '2022-10-15', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-15 15:36:24', '2022-10-15 15:36:58', '::1', '::1'),
(35, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000150', '00000152', '1', '5', '1510202201091966485400110010010000001500000015215', '2022-10-15', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-15 15:40:16', '2022-10-15 15:40:35', '::1', '::1'),
(36, 1, 1, '19', '15102022', '01', '0919664854001', '1', '001', '001', '000000151', '00000153', '1', '8', '1510202201091966485400110010010000001510000015318', '2022-10-15', 'AUT', 0, 1, '0919664854', '0919664854', '2022-10-16 02:22:33', '2022-10-16 02:22:56', '::1', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_impuesto`
--

CREATE TABLE `dct_pos_tbl_impuesto` (
  `imp_codigo` int(11) NOT NULL,
  `imp_impuesto` varchar(10) NOT NULL,
  `imp_descripcion` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_impuesto`
--

INSERT INTO `dct_pos_tbl_impuesto` (`imp_codigo`, `imp_impuesto`, `imp_descripcion`) VALUES
(2, 'IVA', 'Impuesto al Valor Agregado'),
(3, 'ICE', 'Impuesto a Consumos Especiales'),
(5, 'IRBPNR', 'Impuesto Redimible Botellas Plásticas no Retornables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_producto_servicio`
--

CREATE TABLE `dct_pos_tbl_producto_servicio` (
  `prs_id_prod_serv` int(11) NOT NULL,
  `emp_id_empresa` int(11) NOT NULL,
  `prs_codigo_item` varchar(12) NOT NULL,
  `prs_codigo_auxiliar` varchar(12) DEFAULT NULL,
  `prs_descripcion_item` varchar(200) NOT NULL,
  `prs_valor_unitario` double NOT NULL,
  `prs_descuento` int(11) DEFAULT NULL,
  `prs_iva_cod_impuesto` int(11) NOT NULL,
  `prs_iva_cod_tarifa` int(11) DEFAULT NULL,
  `prs_iva_dif_porc` int(11) DEFAULT NULL,
  `prs_ice_cod_impuesto` int(11) DEFAULT NULL,
  `prs_ice_cod_tarifa` int(11) DEFAULT NULL,
  `prs_irbpnr_cod_impuesto` int(11) DEFAULT NULL,
  `prs_irbpnr_cod_tarifa` int(11) DEFAULT NULL,
  `prs_det_nombre_1` varchar(100) DEFAULT NULL,
  `prs_det_valor_1` varchar(100) DEFAULT NULL,
  `prs_det_nombre_2` varchar(100) DEFAULT NULL,
  `prs_det_valor_2` varchar(100) DEFAULT NULL,
  `prs_det_nombre_3` varchar(100) DEFAULT NULL,
  `prs_det_valor_3` varchar(100) DEFAULT NULL,
  `prs_estado` tinyint(1) NOT NULL,
  `prs_usuario_creacion` varchar(13) DEFAULT NULL,
  `prs_usuario_modificacion` varchar(13) DEFAULT NULL,
  `prs_fecha_creacion` timestamp NULL DEFAULT NULL,
  `prs_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `prs_ip_creacion` varchar(100) DEFAULT NULL,
  `prs_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_producto_servicio`
--

INSERT INTO `dct_pos_tbl_producto_servicio` (`prs_id_prod_serv`, `emp_id_empresa`, `prs_codigo_item`, `prs_codigo_auxiliar`, `prs_descripcion_item`, `prs_valor_unitario`, `prs_descuento`, `prs_iva_cod_impuesto`, `prs_iva_cod_tarifa`, `prs_iva_dif_porc`, `prs_ice_cod_impuesto`, `prs_ice_cod_tarifa`, `prs_irbpnr_cod_impuesto`, `prs_irbpnr_cod_tarifa`, `prs_det_nombre_1`, `prs_det_valor_1`, `prs_det_nombre_2`, `prs_det_valor_2`, `prs_det_nombre_3`, `prs_det_valor_3`, `prs_estado`, `prs_usuario_creacion`, `prs_usuario_modificacion`, `prs_fecha_creacion`, `prs_fecha_modificacion`, `prs_ip_creacion`, `prs_ip_modificacion`) VALUES
(1, 1, 'C001', 'CNJ', 'ALQUILER DE HABITACION PERSONAL', 100, 0, 2, 8, 8, 0, 0, 0, 0, 'Tipo', 'Sinple con AC', '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'C002', 'BHY', 'CAMIONETA', 20000, 0, 2, 2, NULL, 0, 0, 0, 0, 'Tipo', '4V en B', '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'C003', 'NY45', 'PARACETAMOL', 0.25, 0, 2, 6, NULL, 0, 0, 0, 0, 'CONCENTRACION', '0.5mg', 'PRESENTACION', 'FRASCO', NULL, NULL, 1, NULL, '0919664854', NULL, '2022-10-05 01:57:05', NULL, '::1'),
(4, 1, 'C004', 'NY469', 'BOTELLAS PLASTICAS', 0.1, 0, 2, 0, NULL, 0, 0, 0, 0, 'Tipo', 'Estandar', '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_tarifa_impuesto`
--

CREATE TABLE `dct_pos_tbl_tarifa_impuesto` (
  `imp_codigo` int(11) NOT NULL,
  `trf_codigo` int(11) NOT NULL,
  `trf_porcentaje` int(11) DEFAULT NULL,
  `trf_valor` double DEFAULT NULL,
  `trf_descripcion` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_tarifa_impuesto`
--

INSERT INTO `dct_pos_tbl_tarifa_impuesto` (`imp_codigo`, `trf_codigo`, `trf_porcentaje`, `trf_valor`, `trf_descripcion`) VALUES
(2, 0, 0, NULL, '0%'),
(2, 2, 12, NULL, '12%'),
(2, 3, 14, NULL, '14%'),
(2, 6, 0, NULL, 'No Objeto de impuesto'),
(2, 7, 0, NULL, 'Exento de IVA'),
(2, 8, NULL, NULL, 'IVA diferenciado'),
(3, 3011, 14, NULL, 'ICE Cigarrillos Rubios'),
(3, 3021, 16, NULL, 'ICE Cigarrillos Negros'),
(3, 3023, 150, NULL, 'ICE Productos del Tabaco y Sucedáneos  del Tabaco excepto Cigarrillos'),
(3, 3031, 75, NULL, 'ICE Bebidas Alcohólicas'),
(3, 3033, 722, NULL, 'ICE Alcohol'),
(3, 3041, 75, NULL, 'ICE Cerveza Industrial Gran Escala'),
(3, 3043, 115, NULL, 'ICE Cerveza Artesanal'),
(3, 3053, 18, NULL, 'ICE Bebidas Gaseosas con Alto Contenido de Azúcar'),
(3, 3054, 10, NULL, 'ICE Bebidas Gaseosas con Bajo Contenido de Azúcar'),
(3, 3073, 5, NULL, 'ICE Vehículos Motorizados cuyo PVP sea hasta de 20000 USD'),
(3, 3075, 15, NULL, 'ICE Vehículos Motorizados PVP entre 30000 y 40000'),
(3, 3077, 20, NULL, 'ICE  Vehículos  Motorizados  cuyo  PVP  superior  USD  40.000 hasta 50.000'),
(3, 3078, 25, NULL, 'ICE  Vehículos  Motorizados  cuyo  PVP  superior  USD  50.000 hasta 60.000'),
(3, 3079, 30, NULL, 'ICE  Vehículos  Motorizados  cuyo  PVP  superior  USD  60.000 hasta 70.000'),
(3, 3080, 35, NULL, 'ICE Vehículos Motorizados cuyo PVP superior USD 70.000'),
(3, 3081, 15, NULL, 'ICE Aviones, Tricares, yates, Barcos de Recreo'),
(3, 3092, 15, NULL, 'ICE Servicios de Televisión Prepagada'),
(3, 3093, 15, NULL, 'ICE Servicios Telefonía Sociedades'),
(3, 3101, 10, NULL, 'ICE Bebidas Energizantes'),
(3, 3111, 18, NULL, 'ICE Bebidas No Alcohólicas'),
(3, 3532, 75, NULL, 'ICE IMPORT. ALCOHOL SENAE'),
(3, 3533, 75, NULL, 'ICE Import. Bebidas Alcohólicas'),
(3, 3541, 75, NULL, 'ICE Cerveza Gran Escala Cae'),
(3, 3542, 16, NULL, 'ICE Cigarrillos Rubios Cae'),
(3, 3543, 16, NULL, 'ICE Cigarrillos Negros Cae'),
(3, 3544, 150, NULL, 'ICE Productos del Tabaco y Sucedáneos del Tabaco Excepto Cigarrillos Cae'),
(3, 3545, 75, NULL, 'ICE CERVEZA ARTESANAL SENAE'),
(3, 3552, 18, NULL, 'ICE   BEBIDAS   GASEOSAS   CON   ALTO   CONTENIDO   DE AZUCAR SENAE'),
(3, 3553, 10, NULL, 'ICE   BEBIDAS   GASEOSAS   CON   BAJO   CONTENIDO   DE AZÚCAR SENAE'),
(3, 3581, 15, NULL, 'ICE Aeronaves Cae'),
(3, 3582, 15, NULL, 'ICE    Aviones,    Avionetas    y    Helicópteros    Exct.    Aquellos destinados Al Trans. Cae'),
(3, 3601, 10, NULL, 'ICE Bebidas Energizantes SENAE'),
(3, 3602, 18, NULL, 'ICE BEBIDAS NO ALCOHOLICAS SENAE'),
(3, 3610, 20, NULL, 'ICE Perfumes y Aguas de Tocador'),
(3, 3620, 35, NULL, 'ICE Videojuegos'),
(3, 3630, 300, NULL, 'ICE Armas de Fuego, Armas deportivas y Municiones'),
(3, 3640, 100, NULL, 'ICE Focos Incandescentes'),
(3, 3660, 35, NULL, 'ICE Cuotas Membresías Afiliaciones Acciones'),
(3, 3671, 100, NULL, 'ICE  CALEFONES  Y  SISTEMAS  DE  CALENTAMIENTO  DE AGUA A GAS SRI'),
(3, 3680, 4, NULL, 'ICE FUNDAS PLÁSTICAS'),
(3, 3681, 10, NULL, 'ICE    SERVICIOS    DE    TELEFONÍA    MÓVIL    PERSONAS NATURALES'),
(3, 3682, 150, NULL, 'ICE   CONSUMIBLES   TABACO   CALENTADO   Y   LIQUIDOS CON NICOTINA SRI'),
(3, 3683, 150, NULL, 'ICE   CONSUMIBLES   TABACO   CALENTADO   Y   LIQUIDOS CON NICOTINA SENAE'),
(3, 3684, 5, NULL, 'ICE   VEHÍCULOS   MOTORIZADOS    CAMIONETAS   Y   DE RESCATE CUYO PVP SEA HASTA DE 30.000 USD'),
(3, 3685, 5, NULL, 'ICE   VEHÍCULOS   MOTORIZADOS    CAMIONETAS   Y  DE RESCATE PVP SEA HASTA DE 30.000 USD SENAE'),
(3, 3686, 10, NULL, 'ICE VEHÍCULOS MOTORIZADOS EXCEPTO CAMIONETAS Y DE   RESCATE   CUYO   PVP   SEA   SUPERIOR   USD   20.000 HASTA DE 30.000'),
(3, 3687, 10, NULL, 'ICE VEHÍCULOS MOTORIZADOS EXCEPTO CAMIONETAS Y DE   RESCATE   CUYO   PVP   SEA   SUPERIOR   USD   20.000\nHASTA DE 30.000 SENAE'),
(3, 3688, 0, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SEA  DE  HASTA USD. 35.000'),
(3, 3689, 0, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SEA  DE  HASTA USD. 35.000 SENAE'),
(3, 3690, 8, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n35.000 HASTA 40.000 SENAE'),
(3, 3691, 8, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n35.000 HASTA 40.000'),
(3, 3692, 14, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n40.000 HASTA 50.000'),
(3, 3693, 14, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n40.000 HASTA 50.000 SENAE'),
(3, 3694, 20, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n50.000 HASTA 60.000 SENAE'),
(3, 3695, 20, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n50.000 HASTA 60.000'),
(3, 3696, 26, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n60.000 HASTA 70.000'),
(3, 3697, 26, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n60.000 HASTA 70.000 SENAE'),
(3, 3698, 32, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  A  USD 70.000'),
(3, 3699, 32, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  A  USD\n70.000 SENAE'),
(3, 3710, 20, NULL, 'ICE Perfumes Aguas de Tocador Cae'),
(3, 3720, 35, NULL, 'ICE Video Juegos Cae'),
(3, 3730, 300, NULL, 'ICE   Importaciones   Armas   de   Fuego,   Armas   deportivas   y Municiones Cae'),
(3, 3740, 100, NULL, 'ICE Focos Incandecentes Cae'),
(3, 3771, 100, NULL, 'ICE  CALEFONES  Y  SISTEMAS  DE  CALENTAMIENTO  DE AGUA A GAS SENAE'),
(3, 3871, 5, NULL, 'ICE-VEHÍCULOS  MOTORIZADOS  CUYO  PVP  SEA  HASTA DE 20000 USD SENAE'),
(3, 3873, 15, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   PVP   ENTRE   30000   Y 40000 SENAE'),
(3, 3874, 20, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 40.000 HASTA 50.000 SENAE'),
(3, 3875, 25, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 50.000 HASTA 60.000 SENAE'),
(3, 3876, 30, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 60.000 HASTA 70.000 SENAE'),
(3, 3877, 35, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 70.000 SENAE'),
(3, 3878, 15, NULL, 'ICE-Aviones, Tricares, Yates, Barcos De Rec SENAE'),
(5, 1, NULL, 0.02, 'Impuesto Redimible Botellas Plásticas no Retornables');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_usuario_est_pun_emi`
--

CREATE TABLE `dct_pos_tbl_usuario_est_pun_emi` (
  `uep_id_usuario_epe` int(11) NOT NULL,
  `usr_cod_usuario` varchar(13) NOT NULL,
  `est_id_empresa_establecimiento` int(11) NOT NULL,
  `epe_id_empresa_punto_emision` int(11) NOT NULL,
  `uep_estado` tinyint(1) NOT NULL,
  `uep_usuario_creacion` varchar(13) DEFAULT NULL,
  `uep_usuario_modificacion` varchar(13) DEFAULT NULL,
  `uep_fecha_creacion` timestamp NULL DEFAULT NULL,
  `uep_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `uep_ip_creacion` varchar(100) DEFAULT NULL,
  `uep_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_usuario_est_pun_emi`
--

INSERT INTO `dct_pos_tbl_usuario_est_pun_emi` (`uep_id_usuario_epe`, `usr_cod_usuario`, `est_id_empresa_establecimiento`, `epe_id_empresa_punto_emision`, `uep_estado`, `uep_usuario_creacion`, `uep_usuario_modificacion`, `uep_fecha_creacion`, `uep_fecha_modificacion`, `uep_ip_creacion`, `uep_ip_modificacion`) VALUES
(1, '0919664854', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_ws_sri`
--

CREATE TABLE `dct_pos_tbl_ws_sri` (
  `wsr_id_ws_sri` int(11) NOT NULL,
  `wsr_tipo_ambiente` int(11) NOT NULL,
  `wsr_descripcion` varchar(30) NOT NULL,
  `wsr_url_1` varchar(200) NOT NULL,
  `wsr_url_2` varchar(100) NOT NULL,
  `wsr_estado` tinyint(1) NOT NULL,
  `wsr_usuario_creacion` varchar(13) DEFAULT NULL,
  `wsr_usuario_modificacion` varchar(13) DEFAULT NULL,
  `wsr_fecha_creacion` timestamp NULL DEFAULT NULL,
  `wsr_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `wsr_ip_creacion` varchar(100) DEFAULT NULL,
  `wsr_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_pos_tbl_ws_sri`
--

INSERT INTO `dct_pos_tbl_ws_sri` (`wsr_id_ws_sri`, `wsr_tipo_ambiente`, `wsr_descripcion`, `wsr_url_1`, `wsr_url_2`, `wsr_estado`, `wsr_usuario_creacion`, `wsr_usuario_modificacion`, `wsr_fecha_creacion`, `wsr_fecha_modificacion`, `wsr_ip_creacion`, `wsr_ip_modificacion`) VALUES
(1, 1, 'RECEPCION', 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.recepcion', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'AUTORIZACION', 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.autorizacion', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'RECEPCION', 'https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.recepcion', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'AUTORIZACION', 'https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.autorizacion', 1, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_aplicacion`
--

CREATE TABLE `dct_sistema_tbl_aplicacion` (
  `apl_id_aplicacion` int(11) NOT NULL,
  `apl_aplicacion` varchar(20) NOT NULL,
  `apl_ruta` varchar(100) NOT NULL,
  `apl_estado` tinyint(1) NOT NULL,
  `apl_nom_superior` varchar(40) NOT NULL,
  `apl_nom_inferior` varchar(40) NOT NULL,
  `apl_id_htm` varchar(20) NOT NULL,
  `apl_id_imagen` varchar(50) NOT NULL,
  `apl_usuario_creacion` varchar(13) DEFAULT NULL,
  `apl_usuario_modificacion` varchar(13) DEFAULT NULL,
  `apl_fecha_creacion` timestamp NULL DEFAULT NULL,
  `apl_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `apl_ip_creacion` varchar(100) DEFAULT NULL,
  `apl_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_aplicacion`
--

INSERT INTO `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`, `apl_aplicacion`, `apl_ruta`, `apl_estado`, `apl_nom_superior`, `apl_nom_inferior`, `apl_id_htm`, `apl_id_imagen`, `apl_usuario_creacion`, `apl_usuario_modificacion`, `apl_fecha_creacion`, `apl_fecha_modificacion`, `apl_ip_creacion`, `apl_ip_modificacion`) VALUES
(1, 'Administración', '../../../webAdministracion', 1, 'Administración', 'Web', 'indexLinkTics', 'fa fa-laptop', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'POS Operaciones', '../../../webPosOperaciones', 1, 'POS', 'Operacionoes', 'indexLinkFacturacion', 'fa fa-laptop', NULL, '0919664854', NULL, '2022-07-28 21:20:48', NULL, '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_aplicacion_empresa`
--

CREATE TABLE `dct_sistema_tbl_aplicacion_empresa` (
  `ape_id_aplicacion` int(11) NOT NULL,
  `ape_id_empresa` int(11) NOT NULL,
  `ape_estado` tinyint(1) NOT NULL,
  `ape_usuario_creacion` varchar(13) DEFAULT NULL,
  `ape_usuario_modificacion` varchar(13) DEFAULT NULL,
  `ape_fecha_creacion` timestamp NULL DEFAULT NULL,
  `ape_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `ape_ip_creacion` varchar(100) DEFAULT NULL,
  `ape_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_aplicacion_empresa`
--

INSERT INTO `dct_sistema_tbl_aplicacion_empresa` (`ape_id_aplicacion`, `ape_id_empresa`, `ape_estado`, `ape_usuario_creacion`, `ape_usuario_modificacion`, `ape_fecha_creacion`, `ape_fecha_modificacion`, `ape_ip_creacion`, `ape_ip_modificacion`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 1, '0919664854', NULL, '2022-07-31 01:54:45', NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_catalogo`
--

CREATE TABLE `dct_sistema_tbl_catalogo` (
  `ctg_id_catalogo` int(11) NOT NULL,
  `ctg_tipo` varchar(5) NOT NULL,
  `ctg_key` varchar(5) NOT NULL,
  `ctg_descripcion` varchar(40) NOT NULL,
  `ctg_estado` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_catalogo`
--

INSERT INTO `dct_sistema_tbl_catalogo` (`ctg_id_catalogo`, `ctg_tipo`, `ctg_key`, `ctg_descripcion`, `ctg_estado`) VALUES
(5, 'POS', 'INDEF', 'FACTURACION INDEFINIDA', 1),
(7, 'POS', 'LM20', 'FACTURACION LIMITADA 20', 1),
(8, 'POS', 'LM50', 'FACTURACION LIMITADA 50', 1),
(9, 'POS', 'LM100', 'FACTURACION LIMITADA 100', 1),
(10, 'POS', 'LM150', 'FACTURACION LIMITADA 150', 1),
(11, 'POS', 'LM200', 'FACTURACION LIMITADA 200', 1),
(12, 'POS', 'STAND', 'ESTANDAR', 1),
(13, 'IDEN', '04', 'RUC', 1),
(14, 'IDEN', '05', 'CEDULA', 1),
(15, 'IDEN', '06', 'PASAPORTE', 1),
(16, 'IDEN', '07', 'CONSUMIDOR FINAL', 0),
(17, 'IDEN', '08', 'IDENTIFICACION DEL EXTERIOR', 1),
(18, 'PAGO', '01', 'SIN UTILIZACION DEL SISTEMA FINANCIERO', 0),
(19, 'PAGO', '15', 'COMPENSACIÓN DE DEUDAS', 0),
(20, 'PAGO', '16', 'TARJETA DE DÉBITO', 1),
(21, 'PAGO', '17', 'DINERO ELECTRÓNICO', 0),
(22, 'PAGO', '18', 'TARJETA PREPAGO', 0),
(23, 'PAGO', '19', 'TARJETA DE CRÉDITO', 1),
(24, 'PAGO', '20', 'OTROS CON UTILIZACIÓN DEL SISTEMA FINANC', 1),
(25, 'PAGO', '21', 'ENDOSO DE TÍTULOS', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_contrasenia`
--

CREATE TABLE `dct_sistema_tbl_contrasenia` (
  `cts_id_contrasenia` int(11) NOT NULL,
  `cts_contrasenia` varchar(150) NOT NULL,
  `cts_cod_usuario` varchar(13) NOT NULL,
  `cts_fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cts_estado` tinyint(1) NOT NULL,
  `cts_usuario_creacion` varchar(13) DEFAULT NULL,
  `cts_usuario_modificacion` varchar(13) DEFAULT NULL,
  `cts_fecha_creacion` timestamp NULL DEFAULT NULL,
  `cts_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `cts_ip_creacion` varchar(100) DEFAULT NULL,
  `cts_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_empresa`
--

CREATE TABLE `dct_sistema_tbl_empresa` (
  `emp_id_empresa` int(11) NOT NULL,
  `emp_ruc` varchar(13) NOT NULL,
  `emp_empresa` varchar(300) NOT NULL,
  `emp_nom_comercial` varchar(300) DEFAULT NULL,
  `emp_direccion_matriz` varchar(300) NOT NULL,
  `emp_contrib_especial` varchar(5) DEFAULT NULL,
  `emp_obli_contabilidad` tinyint(4) NOT NULL,
  `em_logo` varchar(300) DEFAULT NULL,
  `wsr_tipo_ambiente` tinyint(4) NOT NULL,
  `em_tipo_emision` tinyint(4) NOT NULL,
  `emp_estado` tinyint(1) NOT NULL,
  `emp_vigencia_desde` date NOT NULL,
  `emp_vigencia_hasta` date NOT NULL,
  `em_archivo_fact_elec` varchar(17) DEFAULT NULL,
  `em_pass_fct_elec` varchar(40) DEFAULT NULL,
  `ctg_id_catalogo` int(11) NOT NULL,
  `em_usuario_creacion` varchar(13) DEFAULT NULL,
  `em_usuario_modificacion` varchar(13) DEFAULT NULL,
  `em_fecha_creacion` timestamp NULL DEFAULT NULL,
  `em_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `em_ip_creacion` varchar(100) DEFAULT NULL,
  `em_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_empresa`
--

INSERT INTO `dct_sistema_tbl_empresa` (`emp_id_empresa`, `emp_ruc`, `emp_empresa`, `emp_nom_comercial`, `emp_direccion_matriz`, `emp_contrib_especial`, `emp_obli_contabilidad`, `em_logo`, `wsr_tipo_ambiente`, `em_tipo_emision`, `emp_estado`, `emp_vigencia_desde`, `emp_vigencia_hasta`, `em_archivo_fact_elec`, `em_pass_fct_elec`, `ctg_id_catalogo`, `em_usuario_creacion`, `em_usuario_modificacion`, `em_fecha_creacion`, `em_fecha_modificacion`, `em_ip_creacion`, `em_ip_modificacion`) VALUES
(1, '0919664854001', 'DRECONSTEC', 'DRECONSTEC', 'LA RIOJA', '1956', 0, '0919664854001.png', 1, 1, 1, '2022-07-25', '2050-07-20', '0919664854001.p12', 'Maruto1984', 5, NULL, '0919664854', NULL, '2022-08-11 02:11:46', NULL, '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_opcion`
--

CREATE TABLE `dct_sistema_tbl_opcion` (
  `opc_id_opcion` int(11) NOT NULL,
  `opc_opcion` varchar(40) NOT NULL,
  `opc_estado` tinyint(1) NOT NULL,
  `opc_ruta` varchar(50) NOT NULL,
  `opc_id_aplicacion` int(11) NOT NULL,
  `opc_orden` int(11) NOT NULL,
  `opc_usuario_creacion` varchar(13) DEFAULT NULL,
  `opc_usuario_modificacion` varchar(13) DEFAULT NULL,
  `opc_fecha_creacion` timestamp NULL DEFAULT NULL,
  `opc_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `opc_ip_creacion` varchar(100) DEFAULT NULL,
  `opc_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_opcion`
--

INSERT INTO `dct_sistema_tbl_opcion` (`opc_id_opcion`, `opc_opcion`, `opc_estado`, `opc_ruta`, `opc_id_aplicacion`, `opc_orden`, `opc_usuario_creacion`, `opc_usuario_modificacion`, `opc_fecha_creacion`, `opc_fecha_modificacion`, `opc_ip_creacion`, `opc_ip_modificacion`) VALUES
(1, 'Bienvenido', 1, '/pages/principal', 1, 1, NULL, '0919664854', NULL, '2022-07-28 20:05:06', NULL, '::1'),
(2, 'Usuarios', 1, '/pages/administrarUsuarios', 1, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Sistema', 1, '/pages/administrarSistema', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Perfíl', 1, '/pages/administrarPerfil', 1, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Principal', 1, '/pages/principal', 2, 1, NULL, '0919664854', NULL, '2022-07-28 21:21:01', NULL, '::1'),
(6, 'Facturación', 1, '/pages/facturacion', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Administración', 1, '/pages/administracion', 2, 4, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Clientes', 1, '/pages/clientes', 2, 6, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Fidelización', 1, '/pages/fidelizacion', 2, 7, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Registro FirmaEC', 1, '/pages/registroFirmaEC', 2, 8, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'Reporte Transacciones', 1, '/pages/reporteTransacciones', 2, 9, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Transacciones', 1, '/pages/transacciones', 2, 3, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_rol`
--

CREATE TABLE `dct_sistema_tbl_rol` (
  `rol_id_rol` int(11) NOT NULL,
  `rol_rol` varchar(30) NOT NULL,
  `rol_estado` tinyint(1) NOT NULL,
  `rol_usuario_creacion` varchar(13) DEFAULT NULL,
  `rol_usuario_modificacion` varchar(13) DEFAULT NULL,
  `rol_fecha_creacion` timestamp NULL DEFAULT NULL,
  `rol_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `rol_ip_creacion` varchar(100) DEFAULT NULL,
  `rol_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol`
--

INSERT INTO `dct_sistema_tbl_rol` (`rol_id_rol`, `rol_rol`, `rol_estado`, `rol_usuario_creacion`, `rol_usuario_modificacion`, `rol_fecha_creacion`, `rol_fecha_modificacion`, `rol_ip_creacion`, `rol_ip_modificacion`) VALUES
(1, 'Developer', 1, NULL, '0919664854', NULL, '2022-07-28 14:50:22', NULL, '::1'),
(2, 'POS - Administración', 1, '0919664854', '0919664854', '2022-07-28 14:51:07', '2022-07-28 21:21:22', '::1', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_rol_aplicacion`
--

CREATE TABLE `dct_sistema_tbl_rol_aplicacion` (
  `rla_id_rol` int(11) NOT NULL,
  `rla_id_aplicacion` int(11) NOT NULL,
  `rla_estado` tinyint(1) NOT NULL,
  `rla_usuario_creacion` varchar(13) DEFAULT NULL,
  `rla_usuario_modificacion` varchar(13) DEFAULT NULL,
  `rla_fecha_creacion` timestamp NULL DEFAULT NULL,
  `rla_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `rla_ip_creacion` varchar(100) DEFAULT NULL,
  `rla_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol_aplicacion`
--

INSERT INTO `dct_sistema_tbl_rol_aplicacion` (`rla_id_rol`, `rla_id_aplicacion`, `rla_estado`, `rla_usuario_creacion`, `rla_usuario_modificacion`, `rla_fecha_creacion`, `rla_fecha_modificacion`, `rla_ip_creacion`, `rla_ip_modificacion`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 2, 1, NULL, '0919664854', NULL, '2022-07-28 20:31:00', NULL, '::1'),
(9, 1, 1, '0919664854', NULL, '2022-07-31 02:01:10', NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_rol_opcion`
--

CREATE TABLE `dct_sistema_tbl_rol_opcion` (
  `rlo_id_rol` int(11) NOT NULL,
  `rlo_id_opcion` int(11) NOT NULL,
  `rlo_estado` tinyint(1) NOT NULL,
  `rlo_usuario_creacion` varchar(13) DEFAULT NULL,
  `rlo_usuario_modificacion` varchar(13) DEFAULT NULL,
  `rlo_fecha_creacion` timestamp NULL DEFAULT NULL,
  `rlo_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `rlo_ip_creacion` varchar(100) DEFAULT NULL,
  `rlo_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol_opcion`
--

INSERT INTO `dct_sistema_tbl_rol_opcion` (`rlo_id_rol`, `rlo_id_opcion`, `rlo_estado`, `rlo_usuario_creacion`, `rlo_usuario_modificacion`, `rlo_fecha_creacion`, `rlo_fecha_modificacion`, `rlo_ip_creacion`, `rlo_ip_modificacion`) VALUES
(1, 1, 1, NULL, '0919664854', NULL, '2022-07-28 21:18:15', NULL, '::1'),
(1, 2, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 3, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 4, 1, NULL, NULL, NULL, NULL, NULL, NULL),
(1, 5, 1, '0919664854', NULL, '2022-08-01 16:29:41', NULL, '::1', NULL),
(1, 6, 1, '0919664854', '0919664854', '2022-08-01 16:29:49', '2022-08-20 01:57:40', '::1', '::1'),
(1, 7, 1, '0919664854', NULL, '2022-08-01 16:38:56', NULL, '::1', NULL),
(1, 8, 1, '0919664854', NULL, '2022-08-01 16:39:02', NULL, '::1', NULL),
(1, 9, 1, '0919664854', NULL, '2022-08-01 16:39:06', NULL, '::1', NULL),
(1, 10, 1, '0919664854', NULL, '2022-08-01 16:39:12', NULL, '::1', NULL),
(1, 11, 1, '0919664854', NULL, '2022-08-01 16:39:15', NULL, '::1', NULL),
(1, 12, 1, '0919664854', NULL, '2022-07-31 02:07:28', NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_token`
--

CREATE TABLE `dct_sistema_tbl_token` (
  `tok_id_token` int(11) NOT NULL,
  `tok_token` varchar(150) DEFAULT NULL,
  `tok_tipo` varchar(10) DEFAULT NULL,
  `tok_cedula` varchar(13) DEFAULT NULL,
  `tok_fecha` timestamp NULL DEFAULT NULL,
  `tok_estado` tinyint(1) DEFAULT NULL,
  `tok_usuario_creacion` varchar(13) DEFAULT NULL,
  `tok_usuario_modificacion` varchar(13) DEFAULT NULL,
  `tok_fecha_creacion` timestamp NULL DEFAULT NULL,
  `tok_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `tok_ip_creacion` varchar(100) DEFAULT NULL,
  `tok_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_token`
--

INSERT INTO `dct_sistema_tbl_token` (`tok_id_token`, `tok_token`, `tok_tipo`, `tok_cedula`, `tok_fecha`, `tok_estado`, `tok_usuario_creacion`, `tok_usuario_modificacion`, `tok_fecha_creacion`, `tok_fecha_modificacion`, `tok_ip_creacion`, `tok_ip_modificacion`) VALUES
(26, 'YjZNQnNMYS84b2ZhT012TWIxckVsN2trYUd2cG8xelVPVWZERkx4UGZqWkhoWCtsM2NPTTRQbGtTQmFEUUt5cw==', 'ACTIVACION', '1308041134', '2022-07-31 04:00:03', 0, '0919664854', NULL, '2022-07-31 04:00:03', NULL, '::1', NULL),
(27, 'MXEyV2dYVm4vb3AvWDJmczlOZDdKR01BRkxlelhaN054RU1lbXhWTzBlRnA2VmhtRFhTSW9wWFBpd3NGK1FGYQ==', 'ACTIVACION', '1308041134', '2022-07-31 05:38:00', 0, '0919664854', NULL, '2022-07-31 05:38:00', NULL, '::1', NULL),
(28, 'VGgwU1ZMeVRkdk9FYWE5NFhpaThiZ2t1WmI1aFRQa2FWNHIxT2RrME5zam1ET3NkZHg0dTBhU1E5dWxDdGhKMA==', 'ACTIVACION', '45677686788', '2022-07-31 06:03:09', 1, '0919664854', NULL, '2022-07-31 06:03:09', NULL, '::1', NULL),
(29, 'enhPMVJLMno3QXAwRXdqUk02b0R5V1VjMUNkRHNCdzAwRHpheUdLdTRYUFZzV3MzSkQxcTNCV3FZSjBtWlRHUA==', 'ACTIVACION', '1308041134', '2022-08-02 23:06:11', 0, '0919664854', '1308041134', '2022-08-02 23:06:11', '2022-08-02 23:06:45', '::1', '::1'),
(30, 'RGxtaEI3cytwbVBqOS9pSmtjdlpJb1U0VW9lcDBaNFNkNWR3eVc5UlAzWjFXazRFQ1p3VkFXOU1RMUI2VERjOA==', 'ACTIVACION', '1308041134', '2022-08-02 23:22:38', 1, '0919664854', NULL, '2022-08-02 23:22:38', NULL, '::1', NULL),
(31, 'bU9ybm41aW1teExnZi9UZHE2NldnZ1NlbXhSNzRYV0pvR0NXRnBYdkJ3RnZHOUJQcDhUZjZ3dS9OSlpGYlhLdg==', 'ACTIVACION', '1308041134', '2022-08-02 23:24:09', 1, '0919664854', NULL, '2022-08-02 23:24:09', NULL, '::1', NULL),
(32, 'aHZCWDRkaUR3alIyTlZFWGdBdFFYbGRHc0JWUzd0MUtlMnAzbHlBT0dKVzk0S1l3NGl0cDZGZUx2cnliWEFxVQ==', 'ACTIVACION', '1308041134', '2022-08-02 23:28:06', 1, '0919664854', NULL, '2022-08-02 23:28:06', NULL, '::1', NULL),
(33, 'bWJMWDZTdWJMeC9QRHZYS1FWeDFsT1p3bGhISDRJTStNYlFjQ0FxK05xMG16MnphU3RRL3djMVg0UG9XUC92Ug==', 'ACTIVACION', '1308041134', '2022-08-02 23:29:17', 1, '0919664854', NULL, '2022-08-02 23:29:17', NULL, '::1', NULL),
(34, 'bzRGSWp6QU11aXFBRmYrYzlETjZmWmpyZFkwdlplY3RveE56ZXJRcEE1cERUOXNGNWxkVk1nUERaalBpckFFcQ==', 'ACTIVACION', '1308041134', '2022-08-02 23:35:56', 1, '0919664854', NULL, '2022-08-02 23:35:56', NULL, '::1', NULL),
(35, 'TUhMM1VtYWh3WkN3RkIrVWlsMllXMEM0UW5nM3htV2V0U2FWeTdaalJvbUFlemhDNnU3QXh0RlQ5a3B2Y09nVg==', 'RESETEO', '0919664854', '2022-08-19 03:31:15', 0, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 'RGc0STdsRE5WMlFhaW1qazVwazBrblEwV3FGSVlSQVhkd2NkYkpXUzhYRWNMazNDMVJ4REJ2eTRvNmJXdTlobw==', 'ACTIVACION', '45677686788', '2022-09-03 14:21:18', 1, '0919664854', NULL, '2022-09-03 14:21:18', NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_usuario`
--

CREATE TABLE `dct_sistema_tbl_usuario` (
  `usr_cod_usuario` varchar(13) NOT NULL,
  `usr_nombre_1` varchar(15) NOT NULL,
  `usr_nombre_2` varchar(15) NOT NULL,
  `usr_apellido_1` varchar(15) NOT NULL,
  `usr_apellido_2` varchar(15) DEFAULT NULL,
  `usr_contrasenia` varchar(500) NOT NULL,
  `usr_logeado` tinyint(1) NOT NULL,
  `usr_estado` tinyint(1) NOT NULL,
  `usr_ip_pc_acceso` varchar(100) DEFAULT NULL,
  `usr_fecha_acceso` timestamp NULL DEFAULT NULL,
  `usr_correo` varchar(60) NOT NULL,
  `usr_estado_correo` tinyint(4) NOT NULL,
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
  `usr_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_usuario`
--

INSERT INTO `dct_sistema_tbl_usuario` (`usr_cod_usuario`, `usr_nombre_1`, `usr_nombre_2`, `usr_apellido_1`, `usr_apellido_2`, `usr_contrasenia`, `usr_logeado`, `usr_estado`, `usr_ip_pc_acceso`, `usr_fecha_acceso`, `usr_correo`, `usr_estado_correo`, `usr_id_rol`, `usr_estado_contrasenia`, `usr_id_empresa`, `usr_fecha_cambio_contrasenia`, `usr_contador_error_contrasenia`, `usr_expiro_contrasenia`, `usr_ultimo_acceso`, `usr_usuario_creacion`, `usr_usuario_modificacion`, `usr_fecha_creacion`, `usr_fecha_modificacion`, `usr_ip_creacion`, `usr_ip_modificacion`) VALUES
('0919664854', 'Mauro', 'Vinicio', 'Echeverría', 'Chugulí', 'amkyZWwvV0EzTjA5Q2kvKy85aUoxQjh3K1dxZ3kxQlp6NnBwb0E3cGRmVS9VL3cxcHJwOEZaT0tRa2V3N2hSNw==', 1, 1, '::1', '2022-10-16 03:58:29', 'maurovinicio.echeverria@gmail.com', 1, 1, 1, 1, '2022-10-03', 0, 0, '2022-10-15', '0919664854', '0919664854', '2021-05-19 20:20:25', '2021-05-19 20:20:25', 'DESKTOP-5L9FRDR', 'DESKTOP-5L9FRDR'),
('0930921853', 'Erick', 'Joel', 'Jalón', 'Gómez', 'elRmR0JqaDNrR3VuVGtoRmN6Zlh4MFRYRFh3Rjg4SXpXTXBuSk13VUEydlpMYS9rUE5DUVRlaTR5ZkFuL2Jteg==', 0, 1, NULL, NULL, 'jjalon90@gmail.com', 1, 1, 1, 1, '2022-07-03', 0, 0, '2022-08-11', '0930921853', '0930921853', '2021-05-19 20:20:25', '2021-05-19 20:20:25', 'DESKTOP-5L9FRDR', 'DESKTOP-5L9FRDR'),
('45677686788', 'THFGHFG', 'HFGHFGH', 'FGHFGHFG', 'HFGHFGH', 'VGJjSWZicjBKbVRPWDd3Q1hMVVdCN090VGVYRU10VU5nZ01oMHU0dlQ0Si9IWjVOaGFiSk9aMUFmL1FCNFByUA==', 0, 1, NULL, NULL, 'mreinacevallos@gmail.com', 0, 9, 1, 1, '2022-09-03', 0, 1, NULL, '0919664854', NULL, '2022-09-03 14:21:18', NULL, '::1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_usuario_adicional`
--

CREATE TABLE `dct_sistema_tbl_usuario_adicional` (
  `usr_cod_usuario` varchar(13) NOT NULL,
  `adi_fecha_nacimiento` date DEFAULT NULL,
  `adi_sexo` varchar(9) DEFAULT NULL,
  `adi_estado_civil` varchar(12) DEFAULT NULL,
  `adi_instruccion` varchar(11) DEFAULT NULL,
  `adi_tipo_sangre` varchar(9) DEFAULT NULL,
  `adi_celular` varchar(13) DEFAULT NULL,
  `adi_provincia` varchar(5) DEFAULT NULL,
  `adi_canton` varchar(7) DEFAULT NULL,
  `adi_parroquia` varchar(9) DEFAULT NULL,
  `adi_direccion` varchar(70) DEFAULT NULL,
  `adi_referencia` varchar(50) DEFAULT NULL,
  `usr_usuario_creacion` varchar(13) DEFAULT NULL,
  `usr_usuario_modificacion` varchar(13) DEFAULT NULL,
  `usr_fecha_creacion` timestamp NULL DEFAULT NULL,
  `usr_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `usr_ip_creacion` varchar(100) DEFAULT NULL,
  `usr_ip_modificacion` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_usuario_adicional`
--

INSERT INTO `dct_sistema_tbl_usuario_adicional` (`usr_cod_usuario`, `adi_fecha_nacimiento`, `adi_sexo`, `adi_estado_civil`, `adi_instruccion`, `adi_tipo_sangre`, `adi_celular`, `adi_provincia`, `adi_canton`, `adi_parroquia`, `adi_direccion`, `adi_referencia`, `usr_usuario_creacion`, `usr_usuario_modificacion`, `usr_fecha_creacion`, `usr_fecha_modificacion`, `usr_ip_creacion`, `usr_ip_modificacion`) VALUES
('0919664854', '1984-08-22', 'MASCULINO', 'CASADO/A', 'SUPERIOR', 'O +', '593960939030', 'PR_09', 'CN_0901', 'PQ_090114', 'LOS ESTEROS POPULAR', 'EN EL PARQUEO DE LA ESCUELS ROBERTO GILBERT', '0919664854', '0919664854', '2022-07-25 08:20:27', '2022-07-28 04:39:57', '::1', '::1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura_electronica`
--

CREATE TABLE `detalle_factura_electronica` (
  `id_tabla` int(11) NOT NULL,
  `orden_no` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `precio_u` decimal(19,2) NOT NULL,
  `total` decimal(19,2) NOT NULL,
  `iva` decimal(10,0) NOT NULL DEFAULT 0,
  `ice` decimal(10,0) NOT NULL DEFAULT 0,
  `irbpnr` decimal(10,0) NOT NULL DEFAULT 0,
  `codigo_ice` varchar(50) NOT NULL DEFAULT '3',
  `codigoPorcentaje_ice` varchar(50) NOT NULL DEFAULT '0',
  `baseImponible_ice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `tarifa_ice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor_ice` decimal(10,2) NOT NULL DEFAULT 0.00,
  `codigo_irbpnr` varchar(50) NOT NULL DEFAULT '5',
  `codigoPorcentaje_irbpnr` varchar(50) NOT NULL DEFAULT '0',
  `tarifa_irbpnr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `baseImponible_irbpnr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `valor_irbpnr` decimal(10,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_factura_electronica`
--

INSERT INTO `detalle_factura_electronica` (`id_tabla`, `orden_no`, `cantidad`, `item`, `precio_u`, `total`, `iva`, `ice`, `irbpnr`, `codigo_ice`, `codigoPorcentaje_ice`, `baseImponible_ice`, `tarifa_ice`, `valor_ice`, `codigo_irbpnr`, `codigoPorcentaje_irbpnr`, `tarifa_irbpnr`, `baseImponible_irbpnr`, `valor_irbpnr`) VALUES
(25, 1, 2, 'Pulpa de COCO', '3.37', '6.74', '0', '0', '0', '3', '0', '0.00', '5.00', '0.00', '5', '0', '5.00', '5.00', '5.00'),
(26, 1, 900, 'Pulpa de NARANJILLA CMP', '0.25', '225.00', '0', '0', '0', '3', '0', '0.00', '0.00', '0.00', '5', '0', '5.00', '5.00', '5.00'),
(27, 1, 1600, 'Pulpa de GUANABANA CMP', '0.31', '496.00', '0', '0', '0', '3', '0', '0.00', '5.00', '0.00', '5', '0', '5.00', '5.00', '5.00'),
(28, 1, 1600, 'Pulpa de MORA CAMP', '0.27', '432.00', '0', '0', '0', '3', '0', '0.00', '0.00', '0.00', '5', '0', '5.00', '5.00', '5.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_guia_electronica`
--

CREATE TABLE `detalle_guia_electronica` (
  `orden_no` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `productos` varchar(50) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_guia_electronica`
--

INSERT INTO `detalle_guia_electronica` (`orden_no`, `cantidad`, `unidad`, `productos`, `id`) VALUES
(1, 1, '1', '1', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_nota_electronica`
--

CREATE TABLE `detalle_nota_electronica` (
  `id_tabla` int(11) NOT NULL,
  `nota_no` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `item` varchar(50) NOT NULL,
  `precio_u` decimal(19,4) NOT NULL,
  `total` decimal(19,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_nota_electronica`
--

INSERT INTO `detalle_nota_electronica` (`id_tabla`, `nota_no`, `cantidad`, `item`, `precio_u`, `total`) VALUES
(1, 1, 1, '1', '11.0000', '11.0000'),
(3, 2, 1, '1', '11.0000', '11.0000');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_retencion_electronica`
--

CREATE TABLE `detalle_retencion_electronica` (
  `id` int(11) NOT NULL,
  `orden_no` int(11) DEFAULT NULL,
  `codigo` int(11) DEFAULT NULL,
  `codigo_retencion` int(11) DEFAULT NULL,
  `base_imponible` decimal(19,4) DEFAULT NULL,
  `porcentaje_retencion` int(11) DEFAULT NULL,
  `valor_retenido` decimal(19,4) DEFAULT NULL,
  `tipo_comprobante` varchar(45) DEFAULT NULL,
  `impuesto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_retencion_electronica`
--

INSERT INTO `detalle_retencion_electronica` (`id`, `orden_no`, `codigo`, `codigo_retencion`, `base_imponible`, `porcentaje_retencion`, `valor_retenido`, `tipo_comprobante`, `impuesto`) VALUES
(1, 1, 1, 332, '3280.0000', 0, '0.0000', '01', '100');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `datos_cabecera_electronica`
--
ALTER TABLE `datos_cabecera_electronica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_guia_electronica`
--
ALTER TABLE `datos_guia_electronica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_nota_credito`
--
ALTER TABLE `datos_nota_credito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_nota_debito`
--
ALTER TABLE `datos_nota_debito`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `datos_retencion_electronica`
--
ALTER TABLE `datos_retencion_electronica`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `dct_pos_tbl_advertencia_sri`
--
ALTER TABLE `dct_pos_tbl_advertencia_sri`
  ADD PRIMARY KEY (`sra_codigo`);

--
-- Indices de la tabla `dct_pos_tbl_cientes`
--
ALTER TABLE `dct_pos_tbl_cientes`
  ADD PRIMARY KEY (`cli_id_cliente`);

--
-- Indices de la tabla `dct_pos_tbl_empresa_establecimiento`
--
ALTER TABLE `dct_pos_tbl_empresa_establecimiento`
  ADD PRIMARY KEY (`est_id_empresa_establecimiento`);

--
-- Indices de la tabla `dct_pos_tbl_empresa_punto_emision`
--
ALTER TABLE `dct_pos_tbl_empresa_punto_emision`
  ADD PRIMARY KEY (`epe_id_empresa_punto_emision`);

--
-- Indices de la tabla `dct_pos_tbl_empresa_serial`
--
ALTER TABLE `dct_pos_tbl_empresa_serial`
  ADD PRIMARY KEY (`ser_id_empresa_serial`);

--
-- Indices de la tabla `dct_pos_tbl_factura_detalle`
--
ALTER TABLE `dct_pos_tbl_factura_detalle`
  ADD PRIMARY KEY (`fdt_id_factura_detalle`);

--
-- Indices de la tabla `dct_pos_tbl_factura_transaccion`
--
ALTER TABLE `dct_pos_tbl_factura_transaccion`
  ADD PRIMARY KEY (`ftr_id_factura_transaccion`);

--
-- Indices de la tabla `dct_pos_tbl_impuesto`
--
ALTER TABLE `dct_pos_tbl_impuesto`
  ADD PRIMARY KEY (`imp_codigo`);

--
-- Indices de la tabla `dct_pos_tbl_producto_servicio`
--
ALTER TABLE `dct_pos_tbl_producto_servicio`
  ADD PRIMARY KEY (`prs_id_prod_serv`);

--
-- Indices de la tabla `dct_pos_tbl_tarifa_impuesto`
--
ALTER TABLE `dct_pos_tbl_tarifa_impuesto`
  ADD PRIMARY KEY (`imp_codigo`,`trf_codigo`);

--
-- Indices de la tabla `dct_pos_tbl_usuario_est_pun_emi`
--
ALTER TABLE `dct_pos_tbl_usuario_est_pun_emi`
  ADD PRIMARY KEY (`uep_id_usuario_epe`);

--
-- Indices de la tabla `dct_pos_tbl_ws_sri`
--
ALTER TABLE `dct_pos_tbl_ws_sri`
  ADD PRIMARY KEY (`wsr_id_ws_sri`);

--
-- Indices de la tabla `dct_sistema_tbl_aplicacion`
--
ALTER TABLE `dct_sistema_tbl_aplicacion`
  ADD PRIMARY KEY (`apl_id_aplicacion`);

--
-- Indices de la tabla `dct_sistema_tbl_aplicacion_empresa`
--
ALTER TABLE `dct_sistema_tbl_aplicacion_empresa`
  ADD PRIMARY KEY (`ape_id_aplicacion`,`ape_id_empresa`,`ape_estado`);

--
-- Indices de la tabla `dct_sistema_tbl_catalogo`
--
ALTER TABLE `dct_sistema_tbl_catalogo`
  ADD PRIMARY KEY (`ctg_id_catalogo`);

--
-- Indices de la tabla `dct_sistema_tbl_contrasenia`
--
ALTER TABLE `dct_sistema_tbl_contrasenia`
  ADD PRIMARY KEY (`cts_id_contrasenia`);

--
-- Indices de la tabla `dct_sistema_tbl_empresa`
--
ALTER TABLE `dct_sistema_tbl_empresa`
  ADD PRIMARY KEY (`emp_id_empresa`);

--
-- Indices de la tabla `dct_sistema_tbl_opcion`
--
ALTER TABLE `dct_sistema_tbl_opcion`
  ADD PRIMARY KEY (`opc_id_opcion`);

--
-- Indices de la tabla `dct_sistema_tbl_rol`
--
ALTER TABLE `dct_sistema_tbl_rol`
  ADD PRIMARY KEY (`rol_id_rol`);

--
-- Indices de la tabla `dct_sistema_tbl_rol_aplicacion`
--
ALTER TABLE `dct_sistema_tbl_rol_aplicacion`
  ADD PRIMARY KEY (`rla_id_rol`,`rla_id_aplicacion`,`rla_estado`);

--
-- Indices de la tabla `dct_sistema_tbl_rol_opcion`
--
ALTER TABLE `dct_sistema_tbl_rol_opcion`
  ADD PRIMARY KEY (`rlo_id_rol`,`rlo_id_opcion`,`rlo_estado`);

--
-- Indices de la tabla `dct_sistema_tbl_token`
--
ALTER TABLE `dct_sistema_tbl_token`
  ADD PRIMARY KEY (`tok_id_token`);

--
-- Indices de la tabla `dct_sistema_tbl_usuario`
--
ALTER TABLE `dct_sistema_tbl_usuario`
  ADD PRIMARY KEY (`usr_cod_usuario`);

--
-- Indices de la tabla `dct_sistema_tbl_usuario_adicional`
--
ALTER TABLE `dct_sistema_tbl_usuario_adicional`
  ADD PRIMARY KEY (`usr_cod_usuario`);

--
-- Indices de la tabla `detalle_guia_electronica`
--
ALTER TABLE `detalle_guia_electronica`
  ADD PRIMARY KEY (`orden_no`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_cientes`
--
ALTER TABLE `dct_pos_tbl_cientes`
  MODIFY `cli_id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_empresa_establecimiento`
--
ALTER TABLE `dct_pos_tbl_empresa_establecimiento`
  MODIFY `est_id_empresa_establecimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_empresa_punto_emision`
--
ALTER TABLE `dct_pos_tbl_empresa_punto_emision`
  MODIFY `epe_id_empresa_punto_emision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_empresa_serial`
--
ALTER TABLE `dct_pos_tbl_empresa_serial`
  MODIFY `ser_id_empresa_serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_factura_detalle`
--
ALTER TABLE `dct_pos_tbl_factura_detalle`
  MODIFY `fdt_id_factura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_factura_transaccion`
--
ALTER TABLE `dct_pos_tbl_factura_transaccion`
  MODIFY `ftr_id_factura_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_producto_servicio`
--
ALTER TABLE `dct_pos_tbl_producto_servicio`
  MODIFY `prs_id_prod_serv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_usuario_est_pun_emi`
--
ALTER TABLE `dct_pos_tbl_usuario_est_pun_emi`
  MODIFY `uep_id_usuario_epe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_aplicacion`
--
ALTER TABLE `dct_sistema_tbl_aplicacion`
  MODIFY `apl_id_aplicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_catalogo`
--
ALTER TABLE `dct_sistema_tbl_catalogo`
  MODIFY `ctg_id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_contrasenia`
--
ALTER TABLE `dct_sistema_tbl_contrasenia`
  MODIFY `cts_id_contrasenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_empresa`
--
ALTER TABLE `dct_sistema_tbl_empresa`
  MODIFY `emp_id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_opcion`
--
ALTER TABLE `dct_sistema_tbl_opcion`
  MODIFY `opc_id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_rol`
--
ALTER TABLE `dct_sistema_tbl_rol`
  MODIFY `rol_id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_token`
--
ALTER TABLE `dct_sistema_tbl_token`
  MODIFY `tok_id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
