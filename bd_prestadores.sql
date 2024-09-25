-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-05-2024 a las 18:24:33
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_sis_hos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('2c4568d773f226dfb0950e0eed97bb92', 'i:1;', 1715962585),
('2c4568d773f226dfb0950e0eed97bb92:timer', 'i:1715962585;', 1715962585);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `nota_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `datos_cabecera_electronica`
--

INSERT INTO `datos_cabecera_electronica` (`id`, `id_comprobante`, `fecha`, `orden_no`, `cliente`, `direccion`, `telefono`, `ruc`, `tipo_comporbante`, `tipo_identificacion`, `correo`, `establecimiento`, `punto_emi`, `ruc_empresa`, `ambiente`, `razon_social`, `nombre_comercial`, `secuencial`, `direccion_matriz`, `obligado`, `nota_no`, `created_at`, `updated_at`) VALUES
(1, 1, '2022-08-08', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 4, 4, 'kaceto104@gmail.com', '001', '001', '0919664854001', '1', 'Dreconstec', 'Dreconstec', 1181, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1, NULL, NULL),
(9, 2, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 4, 4, 'kaceto104@gmail.com', '001', '002', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 1143, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1, NULL, NULL),
(10, 3, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 4, 4, 'kaceto104@gmail.com', '001', '002', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 1143, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1, NULL, NULL),
(11, 4, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 5, 5, 'kaceto104@gmail.com', '001', '001', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 1142, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1, NULL, NULL),
(12, 25, '2022-08-04', 1, 'Alexandra Albornoz Ortiz', 'Conjunto Brasil 2 Casa 32', 2419867, '0919664854001', 6, 6, 'kaceto104@gmail.com', '001', '001', '0919664854001', '1', 'DIANA KARINA GUERRA LOPEZ', 'GYG', 0, 'PASAJE A LOTE 2 S/N Y 4 DE MARZO', 'SI', 1, NULL, NULL);

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
  `tipo_comprobante` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='		';

--
-- Volcado de datos para la tabla `datos_guia_electronica`
--

INSERT INTO `datos_guia_electronica` (`id`, `ambiente`, `id_comprobante`, `tipo_emision`, `razon_social`, `nombre_comercial`, `cod_doc`, `ruc`, `establecimiento`, `pto_emi`, `secuencial`, `dir_matriz`, `orden_no`, `t_nombre`, `t_ci`, `motivo_translado`, `fecha`, `comprobante_venta`, `tipo_ident_transport`, `t_contabilidad`, `t_f_inicio`, `t_f_final`, `t_placa`, `punto_partida`, `d_ruc`, `d_razon_social`, `d_punto_llegada`, `tipo_comprobante`, `created_at`, `updated_at`) VALUES
(2, 1, 25, 1, 'prueba', 'asdasd', 1, '1716762396001', '001', '001', '1150', 'adsad', 1, 'd', '1716762396001', 'd', '2022-08-05', 1, 4, 'SI', '2022-08-05', '2022-08-05', '001XYZ', 'asd', '1717091506001', 'aaa', 'aaaa', 6, NULL, NULL);

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
  `nota_no` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `datos_nota_credito`
--

INSERT INTO `datos_nota_credito` (`id`, `id_comprobante`, `ambiente`, `tipoEmision`, `razonSocial`, `nombreComercial`, `ruc`, `cod_doc`, `establecimiento`, `ptoEmi`, `secuencial`, `dirMatriz`, `fecha_emision`, `dirEstablecimiento`, `tipoIdentificacionComprador`, `identificacionComprador`, `codDocmodificado`, `numDocModificado`, `contribuyenteEspecial`, `obligadoContabilidad`, `rise`, `fechaEmisionDocSustento`, `total_sin_impuestos`, `valorModificacion`, `codigo`, `codigoPorcentaje`, `baseImponible`, `valor`, `motivo`, `nota_no`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 1, 'COQUE TENORIO MARIA YOLANDA', 'COQUE TENORIO MARIA YOLANDA', '1716762396001', 4, '001', '001', 1015, 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', '2022-02-16', 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', 4, '1716762396001', 1, '000022323', NULL, 'NO', NULL, '2019-02-02', 11.0000, 11.0000, 2, 0, 999, 0.0000, NULL, 1, NULL, NULL);

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
  `campoAdionalFono` varchar(300) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `datos_nota_debito`
--

INSERT INTO `datos_nota_debito` (`id`, `id_comprobante`, `ambiente`, `tipoEmision`, `razonSocialComprador`, `nombreComercial`, `cod_doc`, `establecimiento`, `secuencial`, `direccion_matriz`, `fecha_emision`, `dirEstablecimiento`, `tipoIdentificacionComprador`, `identificacionComprador`, `codDocmodificado`, `numDocModificado`, `contribuyenteEspecial`, `obligadoContabilidad`, `fechaEmisionDocSustento`, `total_sin_impuestos`, `codigo`, `codigoPorcentaje`, `baseImponible`, `valor`, `tarifa`, `valorTotal`, `formapago`, `total`, `plazo`, `unidadTiempo`, `razonDescripcion`, `valorModificado`, `campoAdiconalDirecci`, `campoAdicionalMail`, `campoAdionalFono`, `created_at`, `updated_at`) VALUES
(1, 22, 1, 1, 'aaaa', 'aaa', 5, '001', 1010, 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', '2018-10-05', 'CAMILO PONCE ENRIQUEZ Y PASAJE ALMEIDA CONJUN', 4, '1706034756', 1, '000222323', NULL, 'SI', '2019-02-01', 11.0000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `periodo_fiscal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `datos_retencion_electronica`
--

INSERT INTO `datos_retencion_electronica` (`id`, `ambiente`, `id_comprobante`, `orden_no`, `tipo_emision`, `razon_social`, `nombre_comercial`, `ruc`, `cod_doc`, `estab`, `pto_emi`, `secuencial`, `dir_matriz`, `fecha_emision`, `dir_establecimiento`, `contribuyente_especial`, `obligado_contabilidad`, `tipo_identificacion_sujeto_retenido`, `razon_social_sujeto_retenido`, `identificacion_sujeto_retenido`, `periodo_fiscal`, `created_at`, `updated_at`) VALUES
(2, 1, 25, 1, 1, 'asdsa', 'asdasd', '123123213', 7, '001', '001', 1147, 'asdasd', '2022-08-05', 'a', NULL, 'SI', 4, 'dfgfdgfdg', '1792206375001', '2022-08-05', NULL, NULL);

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
  `dvp_parroquia` varchar(60) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_parametro_tbl_div_politica`
--

INSERT INTO `dct_parametro_tbl_div_politica` (`dvp_codigo_provincia`, `dvp_provincia`, `dvp_codigo_canton`, `dvp_canton`, `dvp_codigo_parroquia`, `dvp_parroquia`, `created_at`, `updated_at`) VALUES
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010101', 'BELLAVISTA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010102', 'CAÑARIBAMBA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010103', 'EL BATÁN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010104', 'EL SAGRARIO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010105', 'EL VECINO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010106', 'GIL RAMÍREZ DÁVALOS', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010107', 'HUAYNACÁPAC', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010108', 'MACHÁNGARA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010109', 'MONAY', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010110', 'SAN BLAS', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010111', 'SAN SEBASTIÁN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010112', 'SUCRE', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010113', 'TOTORACOCHA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010114', 'YANUNCAY', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010115', 'HERMANO MIGUEL', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010150', 'CUENCA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010151', 'BAÑOS', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010152', 'CUMBE', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010153', 'CHAUCHA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010154', 'CHECA (JIDCAY)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010155', 'CHIQUINTAD', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010156', 'LLACAO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010157', 'MOLLETURO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010158', 'NULTI', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010159', 'OCTAVIO CORDERO PALACIOS (SANTA ROSA)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010160', 'PACCHA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010161', 'QUINGEO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010162', 'RICAURTE', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010163', 'SAN JOAQUÍN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010164', 'SANTA ANA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010165', 'SAYAUSÍ', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010166', 'SIDCAY', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010167', 'SININCAY', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010168', 'TARQUI', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010169', 'TURI', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010170', 'VALLE', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0101', 'CUENCA', 'PQ_010171', 'VICTORIA DEL PORTETE (IRQUIS)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0102', 'GIRÓN', 'PQ_010250', 'GIRÓN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0102', 'GIRÓN', 'PQ_010251', 'ASUNCIÓN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0102', 'GIRÓN', 'PQ_010252', 'SAN GERARDO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010350', 'GUALACEO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010351', 'CHORDELEG', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010352', 'DANIEL CÓRDOVA TORAL (EL ORIENTE)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010353', 'JADÁN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010354', 'MARIANO MORENO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010355', 'PRINCIPAL', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010356', 'REMIGIO CRESPO TORAL (GÚLAG)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010357', 'SAN JUAN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010358', 'ZHIDMAD', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010359', 'LUIS CORDERO VEGA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0103', 'GUALACEO', 'PQ_010360', 'SIMÓN BOLÍVAR (CAB. EN GAÑANZOL)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010450', 'NABÓN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010451', 'COCHAPATA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010452', 'EL PROGRESO (CAB.EN ZHOTA)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010453', 'LAS NIEVES (CHAYA)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0104', 'NABÓN', 'PQ_010454', 'OÑA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010550', 'PAUTE', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010551', 'AMALUZA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010552', 'BULÁN (JOSÉ VÍCTOR IZQUIERDO)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010553', 'CHICÁN (GUILLERMO ORTEGA)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010554', 'EL CABO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010555', 'GUACHAPALA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010556', 'GUARAINAG', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010557', 'PALMAS', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010558', 'PAN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010559', 'SAN CRISTÓBAL (CARLOS ORDÓÑEZ LAZO)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010560', 'SEVILLA DE ORO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010561', 'TOMEBAMBA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0105', 'PAUTE', 'PQ_010562', 'DUG DUG', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0106', 'PUCARA', 'PQ_010650', 'PUCARÁ', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0106', 'PUCARA', 'PQ_010651', 'CAMILO PONCE ENRÍQUEZ (CAB. EN RÍO 7 DE MOLLEPONGO)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0106', 'PUCARA', 'PQ_010652', 'SAN RAFAEL DE SHARUG', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0107', 'SAN FERNANDO', 'PQ_010750', 'SAN FERNANDO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0107', 'SAN FERNANDO', 'PQ_010751', 'CHUMBLÍN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010850', 'SANTA ISABEL (CHAGUARURCO)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010851', 'ABDÓN CALDERÓN (LA UNIÓN)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010852', 'EL CARMEN DE PIJILÍ', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010853', 'ZHAGLLI (SHAGLLI)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0108', 'SANTA ISABEL', 'PQ_010854', 'SAN SALVADOR DE CAÑARIBAMBA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010950', 'SIGSIG', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010951', 'CUCHIL (CUTCHIL)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010952', 'GIMA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010953', 'GUEL', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010954', 'LUDO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010955', 'SAN BARTOLOMÉ', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0109', 'SIGSIG', 'PQ_010956', 'SAN JOSÉ DE RARANGA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0110', 'OÑA', 'PQ_011050', 'SAN FELIPE DE OÑA CABECERA CANTONAL', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0110', 'OÑA', 'PQ_011051', 'SUSUDEL', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011150', 'CHORDELEG', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011151', 'PRINCIPAL', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011152', 'LA UNIÓN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011153', 'LUIS GALARZA ORELLANA (CAB.EN DELEGSOL)', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0111', 'CHORDELEG', 'PQ_011154', 'SAN MARTÍN DE PUZHIO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011250', 'EL PAN', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011251', 'AMALUZA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011252', 'PALMAS', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0112', 'EL PAN', 'PQ_011253', 'SAN VICENTE', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0113', 'SEVILLA DE ORO', 'PQ_011350', 'SEVILLA DE ORO', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0113', 'SEVILLA DE ORO', 'PQ_011351', 'AMALUZA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0113', 'SEVILLA DE ORO', 'PQ_011352', 'PALMAS', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0114', 'GUACHAPALA', 'PQ_011450', 'GUACHAPALA', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0115', 'CAMILO PONCE ENRÍQUEZ', 'PQ_011550', 'CAMILO PONCE ENRÍQUEZ', NULL, NULL),
('PR_01', 'AZUAY', 'CN_0115', 'CAMILO PONCE ENRÍQUEZ', 'PQ_011551', 'EL CARMEN DE PIJILÍ', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020101', 'ÁNGEL POLIBIO CHÁVES', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020102', 'GABRIEL IGNACIO VEINTIMILLA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020103', 'GUANUJO', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020150', 'GUARANDA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020151', 'FACUNDO VELA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020152', 'GUANUJO', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020153', 'JULIO E. MORENO (CATANAHUÁN GRANDE)', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020154', 'LAS NAVES', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020155', 'SALINAS', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020156', 'SAN LORENZO', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020157', 'SAN SIMÓN (YACOTO)', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020158', 'SANTA FÉ (SANTA FÉ)', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020159', 'SIMIÁTUG', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0201', 'GUARANDA', 'PQ_020160', 'SAN LUIS DE PAMBIL', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0202', 'CHILLANES', 'PQ_020250', 'CHILLANES', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0202', 'CHILLANES', 'PQ_020251', 'SAN JOSÉ DEL TAMBO (TAMBOPAMBA)', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020350', 'SAN JOSÉ DE CHIMBO', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020351', 'ASUNCIÓN (ASANCOTO)', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020352', 'CALUMA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020353', 'MAGDALENA (CHAPACOTO)', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020354', 'SAN SEBASTIÁN', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0203', 'CHIMBO', 'PQ_020355', 'TELIMBELA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0204', 'ECHEANDÍA', 'PQ_020450', 'ECHEANDÍA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020550', 'SAN MIGUEL', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020551', 'BALSAPAMBA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020552', 'BILOVÁN', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020553', 'RÉGULO DE MORA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020554', 'SAN PABLO (SAN PABLO DE ATENAS)', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020555', 'SANTIAGO', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0205', 'SAN MIGUEL', 'PQ_020556', 'SAN VICENTE', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0206', 'CALUMA', 'PQ_020650', 'CALUMA', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0207', 'LAS NAVES', 'PQ_020701', 'LAS MERCEDES', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0207', 'LAS NAVES', 'PQ_020702', 'LAS NAVES', NULL, NULL),
('PR_02', 'BOLIVAR', 'CN_0207', 'LAS NAVES', 'PQ_020750', 'LAS NAVES', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030101', 'AURELIO BAYAS MARTÍNEZ', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030102', 'AZOGUES', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030103', 'BORRERO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030104', 'SAN FRANCISCO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030150', 'AZOGUES', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030151', 'COJITAMBO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030152', 'DÉLEG', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030153', 'GUAPÁN', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030154', 'JAVIER LOYOLA (CHUQUIPATA)', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030155', 'LUIS CORDERO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030156', 'PINDILIG', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030157', 'RIVERA', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030158', 'SAN MIGUEL', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030159', 'SOLANO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0301', 'AZOGUES', 'PQ_030160', 'TADAY', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030250', 'BIBLIÁN', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030251', 'NAZÓN (CAB. EN PAMPA DE DOMÍNGUEZ)', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030252', 'SAN FRANCISCO DE SAGEO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030253', 'TURUPAMBA', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0302', 'BIBLIÁN', 'PQ_030254', 'JERUSALÉN', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030350', 'CAÑAR', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030351', 'CHONTAMARCA', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030352', 'CHOROCOPTE', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030353', 'GENERAL MORALES (SOCARTE)', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030354', 'GUALLETURO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030355', 'HONORATO VÁSQUEZ (TAMBO VIEJO)', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030356', 'INGAPIRCA', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030357', 'JUNCAL', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030358', 'SAN ANTONIO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030359', 'SUSCAL', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030360', 'TAMBO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030361', 'ZHUD', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030362', 'VENTURA', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0303', 'CAÑAR', 'PQ_030363', 'DUCUR', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0304', 'LA TRONCAL', 'PQ_030450', 'LA TRONCAL', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0304', 'LA TRONCAL', 'PQ_030451', 'MANUEL J. CALLE', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0304', 'LA TRONCAL', 'PQ_030452', 'PANCHO NEGRO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0305', 'EL TAMBO', 'PQ_030550', 'EL TAMBO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0306', 'DÉLEG', 'PQ_030650', 'DÉLEG', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0306', 'DÉLEG', 'PQ_030651', 'SOLANO', NULL, NULL),
('PR_03', 'CAÑAR', 'CN_0307', 'SUSCAL', 'PQ_030750', 'SUSCAL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040101', 'GONZÁLEZ SUÁREZ', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040102', 'TULCÁN', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040150', 'TULCÁN', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040151', 'EL CARMELO (EL PUN)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040152', 'HUACA', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040153', 'JULIO ANDRADE (OREJUELA)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040154', 'MALDONADO', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040155', 'PIOTER', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040156', 'TOBAR DONOSO (LA BOCANA DE CAMUMBÍ)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040157', 'TUFIÑO', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040158', 'URBINA (TAYA)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040159', 'EL CHICAL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040160', 'MARISCAL SUCRE', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0401', 'TULCÁN', 'PQ_040161', 'SANTA MARTHA DE CUBA', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040250', 'BOLÍVAR', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040251', 'GARCÍA MORENO', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040252', 'LOS ANDES', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040253', 'MONTE OLIVO', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040254', 'SAN VICENTE DE PUSIR', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0402', 'BOLÍVAR', 'PQ_040255', 'SAN RAFAEL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040301', 'EL ÁNGEL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040302', '27 DE SEPTIEMBRE', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040350', 'EL ANGEL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040351', 'EL GOALTAL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040352', 'LA LIBERTAD (ALIZO)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0403', 'ESPEJO', 'PQ_040353', 'SAN ISIDRO', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040450', 'MIRA (CHONTAHUASI)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040451', 'CONCEPCIÓN', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040452', 'JIJÓN Y CAAMAÑO (CAB. EN RÍO BLANCO)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0404', 'MIRA', 'PQ_040453', 'JUAN MONTALVO (SAN IGNACIO DE QUIL)', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040501', 'GONZÁLEZ SUÁREZ', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040502', 'SAN JOSÉ', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040550', 'SAN GABRIEL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040551', 'CRISTÓBAL COLÓN', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040552', 'CHITÁN DE NAVARRETE', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040553', 'FERNÁNDEZ SALVADOR', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040554', 'LA PAZ', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0405', 'MONTÚFAR', 'PQ_040555', 'PIARTAL', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0406', 'SAN PEDRO DE HUACA', 'PQ_040650', 'HUACA', NULL, NULL),
('PR_04', 'CARCHI', 'CN_0406', 'SAN PEDRO DE HUACA', 'PQ_040651', 'MARISCAL SUCRE', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050101', 'ELOY ALFARO (SAN FELIPE)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050102', 'IGNACIO FLORES (PARQUE FLORES)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050103', 'JUAN MONTALVO (SAN SEBASTIÁN)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050104', 'LA MATRIZ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050105', 'SAN BUENAVENTURA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050150', 'LATACUNGA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050151', 'ALAQUES (ALÁQUEZ)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050152', 'BELISARIO QUEVEDO (GUANAILÍN)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050153', 'GUAITACAMA (GUAYTACAMA)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050154', 'JOSEGUANGO BAJO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050155', 'LAS PAMPAS', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050156', 'MULALÓ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050157', '11 DE NOVIEMBRE (ILINCHISI)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050158', 'POALÓ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050159', 'SAN JUAN DE PASTOCALLE', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050160', 'SIGCHOS', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050161', 'TANICUCHÍ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050162', 'TOACASO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0501', 'LATACUNGA', 'PQ_050163', 'PALO QUEMADO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050201', 'EL CARMEN', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050202', 'LA MANÁ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050203', 'EL TRIUNFO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050250', 'LA MANÁ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050251', 'GUASAGANDA (CAB.EN GUASAGANDA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0502', 'LA MANÁ', 'PQ_050252', 'PUCAYACU', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050350', 'EL CORAZÓN', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050351', 'MORASPUNGO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050352', 'PINLLOPATA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0503', 'PANGUA', 'PQ_050353', 'RAMÓN CAMPAÑA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050450', 'PUJILÍ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050451', 'ANGAMARCA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050452', 'CHUCCHILÁN (CHUGCHILÁN)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050453', 'GUANGAJE', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050454', 'ISINLIBÍ (ISINLIVÍ)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050455', 'LA VICTORIA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050456', 'PILALÓ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050457', 'TINGO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0504', 'PUJILI', 'PQ_050458', 'ZUMBAHUA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050550', 'SAN MIGUEL', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050551', 'ANTONIO JOSÉ HOLGUÍN (SANTA LUCÍA)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050552', 'CUSUBAMBA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050553', 'MULALILLO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050554', 'MULLIQUINDIL (SANTA ANA)', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0505', 'SALCEDO', 'PQ_050555', 'PANSALEO', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050650', 'SAQUISILÍ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050651', 'CANCHAGUA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050652', 'CHANTILÍN', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0506', 'SAQUISILÍ', 'PQ_050653', 'COCHAPAMBA', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050750', 'SIGCHOS', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050751', 'CHUGCHILLÁN', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050752', 'ISINLIVÍ', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050753', 'LAS PAMPAS', NULL, NULL),
('PR_05', 'COTOPAXI', 'CN_0507', 'SIGCHOS', 'PQ_050754', 'PALO QUEMADO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060101', 'LIZARZABURU', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060102', 'MALDONADO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060103', 'VELASCO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060104', 'VELOZ', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060105', 'YARUQUÍES', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060150', 'RIOBAMBA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060151', 'CACHA (CAB. EN MACHÁNGARA)', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060152', 'CALPI', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060153', 'CUBIJÍES', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060154', 'FLORES', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060155', 'LICÁN', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060156', 'LICTO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060157', 'PUNGALÁ', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060158', 'PUNÍN', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060159', 'QUIMIAG', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060160', 'SAN JUAN', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0601', 'RIOBAMBA', 'PQ_060161', 'SAN LUIS', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060250', 'ALAUSÍ', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060251', 'ACHUPALLAS', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060252', 'CUMANDÁ', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060253', 'GUASUNTOS', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060254', 'HUIGRA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060255', 'MULTITUD', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060256', 'PISTISHÍ (NARIZ DEL DIABLO)', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060257', 'PUMALLACTA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060258', 'SEVILLA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060259', 'SIBAMBE', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0602', 'ALAUSI', 'PQ_060260', 'TIXÁN', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060301', 'CAJABAMBA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060302', 'SICALPA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060350', 'VILLA LA UNIÓN (CAJABAMBA)', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060351', 'CAÑI', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060352', 'COLUMBE', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060353', 'JUAN DE VELASCO (PANGOR)', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0603', 'COLTA', 'PQ_060354', 'SANTIAGO DE QUITO (CAB. EN SAN ANTONIO DE QUITO)', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0604', 'CHAMBO', 'PQ_060450', 'CHAMBO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060550', 'CHUNCHI', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060551', 'CAPZOL', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060552', 'COMPUD', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060553', 'GONZOL', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0605', 'CHUNCHI', 'PQ_060554', 'LLAGOS', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0606', 'GUAMOTE', 'PQ_060650', 'GUAMOTE', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0606', 'GUAMOTE', 'PQ_060651', 'CEBADAS', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0606', 'GUAMOTE', 'PQ_060652', 'PALMIRA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060701', 'EL ROSARIO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060702', 'LA MATRIZ', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060750', 'GUANO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060751', 'GUANANDO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060752', 'ILAPO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060753', 'LA PROVIDENCIA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060754', 'SAN ANDRÉS', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060755', 'SAN GERARDO DE PACAICAGUÁN', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060756', 'SAN ISIDRO DE PATULÚ', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060757', 'SAN JOSÉ DEL CHAZO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060758', 'SANTA FÉ DE GALÁN', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0607', 'GUANO', 'PQ_060759', 'VALPARAÍSO', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0608', 'PALLATANGA', 'PQ_060850', 'PALLATANGA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060950', 'PENIPE', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060951', 'EL ALTAR', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060952', 'MATUS', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060953', 'PUELA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060954', 'SAN ANTONIO DE BAYUSHIG', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060955', 'LA CANDELARIA', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0609', 'PENIPE', 'PQ_060956', 'BILBAO (CAB.EN QUILLUYACU)', NULL, NULL),
('PR_06', 'CHIMBORAZO', 'CN_0610', 'CUMANDÁ', 'PQ_061050', 'CUMANDÁ', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070101', 'LA PROVIDENCIA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070102', 'MACHALA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070103', 'PUERTO BOLÍVAR', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070104', 'NUEVE DE MAYO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070105', 'EL CAMBIO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070150', 'MACHALA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070151', 'EL CAMBIO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0701', 'MACHALA', 'PQ_070152', 'EL RETIRO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070250', 'ARENILLAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070251', 'CHACRAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070252', 'LA LIBERTAD', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070253', 'LAS LAJAS (CAB. EN LA VICTORIA)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070254', 'PALMALES', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0702', 'ARENILLAS', 'PQ_070255', 'CARCABÓN', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070350', 'PACCHA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070351', 'AYAPAMBA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070352', 'CORDONCILLO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070353', 'MILAGRO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070354', 'SAN JOSÉ', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0703', 'ATAHUALPA', 'PQ_070355', 'SAN JUAN DE CERRO AZUL', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0704', 'BALSAS', 'PQ_070450', 'BALSAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0704', 'BALSAS', 'PQ_070451', 'BELLAMARÍA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0705', 'CHILLA', 'PQ_070550', 'CHILLA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070650', 'EL GUABO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070651', 'BARBONES (SUCRE)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070652', 'LA IBERIA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070653', 'TENDALES (CAB.EN PUERTO TENDALES)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0706', 'EL GUABO', 'PQ_070654', 'RÍO BONITO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070701', 'ECUADOR', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070702', 'EL PARAÍSO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070703', 'HUALTACO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070704', 'MILTON REYES', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070705', 'UNIÓN LOJANA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0707', 'HUAQUILLAS', 'PQ_070750', 'HUAQUILLAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0708', 'MARCABELÍ', 'PQ_070850', 'MARCABELÍ', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0708', 'MARCABELÍ', 'PQ_070851', 'EL INGENIO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070901', 'BOLÍVAR', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070902', 'LOMA DE FRANCO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070903', 'OCHOA LEÓN (MATRIZ)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070904', 'TRES CERRITOS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070950', 'PASAJE', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070951', 'BUENAVISTA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070952', 'CASACAY', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070953', 'LA PEAÑA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070954', 'PROGRESO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070955', 'UZHCURRUMI', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0709', 'PASAJE', 'PQ_070956', 'CAÑAQUEMADA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071001', 'LA MATRIZ', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071002', 'LA SUSAYA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071003', 'PIÑAS GRANDE', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071050', 'PIÑAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071051', 'CAPIRO (CAB. EN LA CAPILLA DE CAPIRO)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071052', 'LA BOCANA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071053', 'MOROMORO (CAB. EN EL VADO)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071054', 'PIEDRAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071055', 'SAN ROQUE (AMBROSIO MALDONADO)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0710', 'PIÑAS', 'PQ_071056', 'SARACAY', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071150', 'PORTOVELO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071151', 'CURTINCAPA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071152', 'MORALES', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0711', 'PORTOVELO', 'PQ_071153', 'SALATÍ', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071201', 'SANTA ROSA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071202', 'PUERTO JELÍ', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071203', 'BALNEARIO JAMBELÍ (SATÉLITE)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071204', 'JUMÓN (SATÉLITE)', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071205', 'NUEVO SANTA ROSA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071250', 'SANTA ROSA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071251', 'BELLAVISTA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071252', 'JAMBELÍ', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071253', 'LA AVANZADA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071254', 'SAN ANTONIO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071255', 'TORATA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071256', 'VICTORIA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0712', 'SANTA ROSA', 'PQ_071257', 'BELLAMARÍA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071350', 'ZARUMA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071351', 'ABAÑÍN', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071352', 'ARCAPAMBA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071353', 'GUANAZÁN', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071354', 'GUIZHAGUIÑA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071355', 'HUERTAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071356', 'MALVAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071357', 'MULUNCAY GRANDE', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071358', 'SINSAO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0713', 'ZARUMA', 'PQ_071359', 'SALVIAS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071401', 'LA VICTORIA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071402', 'PLATANILLOS', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071403', 'VALLE HERMOSO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071450', 'LA VICTORIA', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071451', 'LA LIBERTAD', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071452', 'EL PARAÍSO', NULL, NULL),
('PR_07', 'EL ORO', 'CN_0714', 'LAS LAJAS', 'PQ_071453', 'SAN ISIDRO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080101', 'BARTOLOMÉ RUIZ (CÉSAR FRANCO CARRIÓN)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080102', '5 DE AGOSTO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080103', 'ESMERALDAS', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080104', 'LUIS TELLO (LAS PALMAS)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080105', 'SIMÓN PLATA TORRES', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080150', 'ESMERALDAS', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080151', 'ATACAMES', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080152', 'CAMARONES (CAB. EN SAN VICENTE)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080153', 'CRNEL. CARLOS CONCHA TORRES (CAB.EN HUELE)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080154', 'CHINCA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080155', 'CHONTADURO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080156', 'CHUMUNDÉ', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080157', 'LAGARTO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080158', 'LA UNIÓN', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080159', 'MAJUA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080160', 'MONTALVO (CAB. EN HORQUETA)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080161', 'RÍO VERDE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080162', 'ROCAFUERTE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080163', 'SAN MATEO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080164', 'SÚA (CAB. EN LA BOCANA)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080165', 'TABIAZO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080166', 'TACHINA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080167', 'TONCHIGÜE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0801', 'ESMERALDAS', 'PQ_080168', 'VUELTA LARGA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080250', 'VALDEZ (LIMONES)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080251', 'ANCHAYACU', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080252', 'ATAHUALPA (CAB. EN CAMARONES)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080253', 'BORBÓN', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080254', 'LA TOLA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080255', 'LUIS VARGAS TORRES (CAB. EN PLAYA DE ORO)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080256', 'MALDONADO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080257', 'PAMPANAL DE BOLÍVAR', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080258', 'SAN FRANCISCO DE ONZOLE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080259', 'SANTO DOMINGO DE ONZOLE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080260', 'SELVA ALEGRE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080261', 'TELEMBÍ', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080262', 'COLÓN ELOY DEL MARÍA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080263', 'SAN JOSÉ DE CAYAPAS', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0802', 'ELOY ALFARO', 'PQ_080264', 'TIMBIRÉ', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080350', 'MUISNE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080351', 'BOLÍVAR', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080352', 'DAULE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080353', 'GALERA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080354', 'QUINGUE (OLMEDO PERDOMO FRANCO)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080355', 'SALIMA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080356', 'SAN FRANCISCO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080357', 'SAN GREGORIO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0803', 'MUISNE', 'PQ_080358', 'SAN JOSÉ DE CHAMANGA (CAB.EN CHAMANGA)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080450', 'ROSA ZÁRATE (QUININDÉ)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080451', 'CUBE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080452', 'CHURA (CHANCAMA) (CAB. EN EL YERBERO)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080453', 'MALIMPIA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080454', 'VICHE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0804', 'QUININDÉ', 'PQ_080455', 'LA UNIÓN', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080550', 'SAN LORENZO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080551', 'ALTO TAMBO (CAB. EN GUADUAL)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080552', 'ANCÓN (PICHANGAL) (CAB. EN PALMA REAL)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080553', 'CALDERÓN', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080554', 'CARONDELET', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080555', '5 DE JUNIO (CAB. EN UIMBI)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080556', 'CONCEPCIÓN', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080557', 'MATAJE (CAB. EN SANTANDER)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080558', 'SAN JAVIER DE CACHAVÍ (CAB. EN SAN JAVIER)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080559', 'SANTA RITA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080560', 'TAMBILLO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080561', 'TULULBÍ (CAB. EN RICAURTE)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0805', 'SAN LORENZO', 'PQ_080562', 'URBINA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080650', 'ATACAMES', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080651', 'LA UNIÓN', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080652', 'SÚA (CAB. EN LA BOCANA)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080653', 'TONCHIGÜE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0806', 'ATACAMES', 'PQ_080654', 'TONSUPA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080750', 'RIOVERDE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080751', 'CHONTADURO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080752', 'CHUMUNDÉ', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080753', 'LAGARTO', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080754', 'MONTALVO (CAB. EN HORQUETA)', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0807', 'RIOVERDE', 'PQ_080755', 'ROCAFUERTE', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080850', 'LA CONCORDIA', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080851', 'MONTERREY', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080852', 'LA VILLEGAS', NULL, NULL),
('PR_08', 'ESMERALDAS', 'CN_0808', 'LA CONCORDIA', 'PQ_080853', 'PLAN PILOTO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090101', 'AYACUCHO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090102', 'BOLÍVAR (SAGRARIO)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090103', 'CARBO (CONCEPCIÓN)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090104', 'FEBRES CORDERO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090105', 'GARCÍA MORENO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090106', 'LETAMENDI', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090107', 'NUEVE DE OCTUBRE', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090108', 'OLMEDO (SAN ALEJO)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090109', 'ROCA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090110', 'ROCAFUERTE', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090111', 'SUCRE', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090112', 'TARQUI', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090113', 'URDANETA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090114', 'XIMENA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090115', 'PASCUALES', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090150', 'GUAYAQUIL', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090151', 'CHONGÓN', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090152', 'JUAN GÓMEZ RENDÓN (PROGRESO)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090153', 'MORRO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090154', 'PASCUALES', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090155', 'PLAYAS (GRAL. VILLAMIL)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090156', 'POSORJA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090157', 'PUNÁ', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0901', 'GUAYAQUIL', 'PQ_090158', 'TENGUEL', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0902', 'ALFREDO BAQUERIZO MORENO (JUJÁN)', 'PQ_090250', 'ALFREDO BAQUERIZO MORENO (JUJÁN)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0903', 'BALAO', 'PQ_090350', 'BALAO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0904', 'BALZAR', 'PQ_090450', 'BALZAR', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0905', 'COLIMES', 'PQ_090550', 'COLIMES', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0905', 'COLIMES', 'PQ_090551', 'SAN JACINTO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090601', 'DAULE', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090602', 'LA AURORA (SATÉLITE)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090603', 'BANIFE', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090604', 'EMILIANO CAICEDO MARCOS', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090605', 'MAGRO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090606', 'PADRE JUAN BAUTISTA AGUIRRE', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090607', 'SANTA CLARA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090608', 'VICENTE PIEDRAHITA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090650', 'DAULE', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090651', 'ISIDRO AYORA (SOLEDAD)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090652', 'JUAN BAUTISTA AGUIRRE (LOS TINTOS)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090653', 'LAUREL', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090654', 'LIMONAL', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090655', 'LOMAS DE SARGENTILLO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090656', 'LOS LOJAS (ENRIQUE BAQUERIZO MORENO)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0906', 'DAULE', 'PQ_090657', 'PIEDRAHITA (NOBOL)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0907', 'DURÁN', 'PQ_090701', 'ELOY ALFARO (DURÁN)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0907', 'DURÁN', 'PQ_090702', 'EL RECREO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0907', 'DURÁN', 'PQ_090750', 'ELOY ALFARO (DURÁN)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0908', 'EL EMPALME', 'PQ_090850', 'VELASCO IBARRA (EL EMPALME)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0908', 'EL EMPALME', 'PQ_090851', 'GUAYAS (PUEBLO NUEVO)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0908', 'EL EMPALME', 'PQ_090852', 'EL ROSARIO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0909', 'EL TRIUNFO', 'PQ_090950', 'EL TRIUNFO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091050', 'MILAGRO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091051', 'CHOBO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091052', 'GENERAL ELIZALDE (BUCAY)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091053', 'MARISCAL SUCRE (HUAQUES)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0910', 'MILAGRO', 'PQ_091054', 'ROBERTO ASTUDILLO (CAB. EN CRUCE DE VENECIA)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091150', 'NARANJAL', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091151', 'JESÚS MARÍA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091152', 'SAN CARLOS', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091153', 'SANTA ROSA DE FLANDES', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0911', 'NARANJAL', 'PQ_091154', 'TAURA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0912', 'NARANJITO', 'PQ_091250', 'NARANJITO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0913', 'PALESTINA', 'PQ_091350', 'PALESTINA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0914', 'PEDRO CARBO', 'PQ_091450', 'PEDRO CARBO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0914', 'PEDRO CARBO', 'PQ_091451', 'VALLE DE LA VIRGEN', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0914', 'PEDRO CARBO', 'PQ_091452', 'SABANILLA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091601', 'SAMBORONDÓN', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091602', 'LA PUNTILLA (SATÉLITE)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091650', 'SAMBORONDÓN', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0916', 'SAMBORONDÓN', 'PQ_091651', 'TARIFA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0918', 'SANTA LUCÍA', 'PQ_091850', 'SANTA LUCÍA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091901', 'BOCANA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091902', 'CANDILEJOS', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091903', 'CENTRAL', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091904', 'PARAÍSO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091905', 'SAN MATEO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091950', 'EL SALITRE (LAS RAMAS)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091951', 'GRAL. VERNAZA (DOS ESTEROS)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091952', 'LA VICTORIA (ÑAUZA)', NULL, NULL);
INSERT INTO `dct_parametro_tbl_div_politica` (`dvp_codigo_provincia`, `dvp_provincia`, `dvp_codigo_canton`, `dvp_canton`, `dvp_codigo_parroquia`, `dvp_parroquia`, `created_at`, `updated_at`) VALUES
('PR_09', 'GUAYAS', 'CN_0919', 'SALITRE (URBINA JADO)', 'PQ_091953', 'JUNQUILLAL', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092050', 'SAN JACINTO DE YAGUACHI', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092051', 'CRNEL. LORENZO DE GARAICOA (PEDREGAL)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092052', 'CRNEL. MARCELINO MARIDUEÑA (SAN CARLOS)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092053', 'GRAL. PEDRO J. MONTERO (BOLICHE)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092054', 'SIMÓN BOLÍVAR', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092055', 'YAGUACHI VIEJO (CONE)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0920', 'SAN JACINTO DE YAGUACHI', 'PQ_092056', 'VIRGEN DE FÁTIMA', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0921', 'PLAYAS', 'PQ_092150', 'GENERAL VILLAMIL (PLAYAS)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0922', 'SIMÓN BOLÍVAR', 'PQ_092250', 'SIMÓN BOLÍVAR', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0922', 'SIMÓN BOLÍVAR', 'PQ_092251', 'CRNEL.LORENZO DE GARAICOA (PEDREGAL)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0923', 'CORONEL MARCELINO MARIDUEÑA', 'PQ_092350', 'CORONEL MARCELINO MARIDUEÑA (SAN CARLOS)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0924', 'LOMAS DE SARGENTILLO', 'PQ_092450', 'LOMAS DE SARGENTILLO', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0924', 'LOMAS DE SARGENTILLO', 'PQ_092451', 'ISIDRO AYORA (SOLEDAD)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0925', 'NOBOL', 'PQ_092550', 'NARCISA DE JESÚS', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0927', 'GENERAL ANTONIO ELIZALDE', 'PQ_092750', 'GENERAL ANTONIO ELIZALDE (BUCAY)', NULL, NULL),
('PR_09', 'GUAYAS', 'CN_0928', 'ISIDRO AYORA', 'PQ_092850', 'ISIDRO AYORA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100101', 'CARANQUI', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100102', 'GUAYAQUIL DE ALPACHACA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100103', 'SAGRARIO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100104', 'SAN FRANCISCO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100105', 'LA DOLOROSA DEL PRIORATO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100150', 'SAN MIGUEL DE IBARRA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100151', 'AMBUQUÍ', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100152', 'ANGOCHAGUA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100153', 'CAROLINA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100154', 'LA ESPERANZA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100155', 'LITA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100156', 'SALINAS', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1001', 'IBARRA', 'PQ_100157', 'SAN ANTONIO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100201', 'ANDRADE MARÍN (LOURDES)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100202', 'ATUNTAQUI', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100250', 'ATUNTAQUI', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100251', 'IMBAYA (SAN LUIS DE COBUENDO)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100252', 'SAN FRANCISCO DE NATABUELA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100253', 'SAN JOSÉ DE CHALTURA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1002', 'ANTONIO ANTE', 'PQ_100254', 'SAN ROQUE', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100301', 'SAGRARIO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100302', 'SAN FRANCISCO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100350', 'COTACACHI', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100351', 'APUELA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100352', 'GARCÍA MORENO (LLURIMAGUA)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100353', 'IMANTAG', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100354', 'PEÑAHERRERA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100355', 'PLAZA GUTIÉRREZ (CALVARIO)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100356', 'QUIROGA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100357', '6 DE JULIO DE CUELLAJE (CAB. EN CUELLAJE)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1003', 'COTACACHI', 'PQ_100358', 'VACAS GALINDO (EL CHURO) (CAB.EN SAN MIGUEL ALTO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100401', 'JORDÁN', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100402', 'SAN LUIS', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100450', 'OTAVALO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100451', 'DR. MIGUEL EGAS CABEZAS (PEGUCHE)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100452', 'EUGENIO ESPEJO (CALPAQUÍ)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100453', 'GONZÁLEZ SUÁREZ', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100454', 'PATAQUÍ', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100455', 'SAN JOSÉ DE QUICHINCHE', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100456', 'SAN JUAN DE ILUMÁN', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100457', 'SAN PABLO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100458', 'SAN RAFAEL', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1004', 'OTAVALO', 'PQ_100459', 'SELVA ALEGRE (CAB.EN SAN MIGUEL DE PAMPLONA)', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100550', 'PIMAMPIRO', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100551', 'CHUGÁ', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100552', 'MARIANO ACOSTA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1005', 'PIMAMPIRO', 'PQ_100553', 'SAN FRANCISCO DE SIGSIPAMBA', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100650', 'URCUQUÍ CABECERA CANTONAL', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100651', 'CAHUASQUÍ', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100652', 'LA MERCED DE BUENOS AIRES', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100653', 'PABLO ARENAS', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100654', 'SAN BLAS', NULL, NULL),
('PR_10', 'IMBABURA', 'CN_1006', 'SAN MIGUEL DE URCUQUÍ', 'PQ_100655', 'TUMBABIRO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110101', 'EL SAGRARIO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110102', 'SAN SEBASTIÁN', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110103', 'SUCRE', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110104', 'VALLE', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110150', 'LOJA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110151', 'CHANTACO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110152', 'CHUQUIRIBAMBA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110153', 'EL CISNE', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110154', 'GUALEL', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110155', 'JIMBILLA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110156', 'MALACATOS (VALLADOLID)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110157', 'SAN LUCAS', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110158', 'SAN PEDRO DE VILCABAMBA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110159', 'SANTIAGO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110160', 'TAQUIL (MIGUEL RIOFRÍO)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110161', 'VILCABAMBA (VICTORIA)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110162', 'YANGANA (ARSENIO CASTILLO)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1101', 'LOJA', 'PQ_110163', 'QUINARA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110201', 'CARIAMANGA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110202', 'CHILE', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110203', 'SAN VICENTE', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110250', 'CARIAMANGA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110251', 'COLAISACA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110252', 'EL LUCERO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110253', 'UTUANA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1102', 'CALVAS', 'PQ_110254', 'SANGUILLÍN', NULL, NULL),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110301', 'CATAMAYO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110302', 'SAN JOSÉ', NULL, NULL),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110350', 'CATAMAYO (LA TOMA)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110351', 'EL TAMBO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110352', 'GUAYQUICHUMA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110353', 'SAN PEDRO DE LA BENDITA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1103', 'CATAMAYO', 'PQ_110354', 'ZAMBI', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110450', 'CELICA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110451', 'CRUZPAMBA (CAB. EN CARLOS BUSTAMANTE)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110452', 'CHAQUINAL', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110453', '12 DE DICIEMBRE (CAB. EN ACHIOTES)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110454', 'PINDAL (FEDERICO PÁEZ)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110455', 'POZUL (SAN JUAN DE POZUL)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110456', 'SABANILLA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1104', 'CELICA', 'PQ_110457', 'TNTE. MAXIMILIANO RODRÍGUEZ LOAIZA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110550', 'CHAGUARPAMBA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110551', 'BUENAVISTA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110552', 'EL ROSARIO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110553', 'SANTA RUFINA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1105', 'CHAGUARPAMBA', 'PQ_110554', 'AMARILLOS', NULL, NULL),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110650', 'AMALUZA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110651', 'BELLAVISTA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110652', 'JIMBURA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110653', 'SANTA TERESITA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110654', '27 DE ABRIL (CAB. EN LA NARANJA)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110655', 'EL INGENIO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1106', 'ESPÍNDOLA', 'PQ_110656', 'EL AIRO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110750', 'GONZANAMÁ', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110751', 'CHANGAIMINA (LA LIBERTAD)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110752', 'FUNDOCHAMBA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110753', 'NAMBACOLA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110754', 'PURUNUMA (EGUIGUREN)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110755', 'QUILANGA (LA PAZ)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110756', 'SACAPALCA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1107', 'GONZANAMÁ', 'PQ_110757', 'SAN ANTONIO DE LAS ARADAS (CAB. EN LAS ARADAS)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110801', 'GENERAL ELOY ALFARO (SAN SEBASTIÁN)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110802', 'MACARÁ (MANUEL ENRIQUE RENGEL SUQUILANDA)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110850', 'MACARÁ', NULL, NULL),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110851', 'LARAMA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110852', 'LA VICTORIA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1108', 'MACARÁ', 'PQ_110853', 'SABIANGO (LA CAPILLA)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110901', 'CATACOCHA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110902', 'LOURDES', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110950', 'CATACOCHA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110951', 'CANGONAMÁ', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110952', 'GUACHANAMÁ', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110953', 'LA TINGUE', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110954', 'LAURO GUERRERO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110955', 'OLMEDO (SANTA BÁRBARA)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110956', 'ORIANGA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110957', 'SAN ANTONIO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110958', 'CASANGA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1109', 'PALTAS', 'PQ_110959', 'YAMANA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111050', 'ALAMOR', NULL, NULL),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111051', 'CIANO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111052', 'EL ARENAL', NULL, NULL),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111053', 'EL LIMO (MARIANA DE JESÚS)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111054', 'MERCADILLO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1110', 'PUYANGO', 'PQ_111055', 'VICENTINO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111150', 'SARAGURO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111151', 'EL PARAÍSO DE CELÉN', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111152', 'EL TABLÓN', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111153', 'LLUZHAPA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111154', 'MANÚ', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111155', 'SAN ANTONIO DE QUMBE (CUMBE)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111156', 'SAN PABLO DE TENTA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111157', 'SAN SEBASTIÁN DE YÚLUC', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111158', 'SELVA ALEGRE', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111159', 'URDANETA (PAQUISHAPA)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1111', 'SARAGURO', 'PQ_111160', 'SUMAYPAMBA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1112', 'SOZORANGA', 'PQ_111250', 'SOZORANGA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1112', 'SOZORANGA', 'PQ_111251', 'NUEVA FÁTIMA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1112', 'SOZORANGA', 'PQ_111252', 'TACAMOROS', NULL, NULL),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111350', 'ZAPOTILLO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111351', 'MANGAHURCO (CAZADEROS)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111352', 'GARZAREAL', NULL, NULL),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111353', 'LIMONES', NULL, NULL),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111354', 'PALETILLAS', NULL, NULL),
('PR_11', 'LOJA', 'CN_1113', 'ZAPOTILLO', 'PQ_111355', 'BOLASPAMBA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111450', 'PINDAL', NULL, NULL),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111451', 'CHAQUINAL', NULL, NULL),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111452', '12 DE DICIEMBRE (CAB.EN ACHIOTES)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1114', 'PINDAL', 'PQ_111453', 'MILAGROS', NULL, NULL),
('PR_11', 'LOJA', 'CN_1115', 'QUILANGA', 'PQ_111550', 'QUILANGA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1115', 'QUILANGA', 'PQ_111551', 'FUNDOCHAMBA', NULL, NULL),
('PR_11', 'LOJA', 'CN_1115', 'QUILANGA', 'PQ_111552', 'SAN ANTONIO DE LAS ARADAS (CAB. EN LAS ARADAS)', NULL, NULL),
('PR_11', 'LOJA', 'CN_1116', 'OLMEDO', 'PQ_111650', 'OLMEDO', NULL, NULL),
('PR_11', 'LOJA', 'CN_1116', 'OLMEDO', 'PQ_111651', 'LA TINGUE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120101', 'CLEMENTE BAQUERIZO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120102', 'DR. CAMILO PONCE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120103', 'BARREIRO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120104', 'EL SALTO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120150', 'BABAHOYO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120151', 'BARREIRO (SANTA RITA)', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120152', 'CARACOL', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120153', 'FEBRES CORDERO (LAS JUNTAS)', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120154', 'PIMOCHA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1201', 'BABAHOYO', 'PQ_120155', 'LA UNIÓN', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1202', 'BABA', 'PQ_120250', 'BABA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1202', 'BABA', 'PQ_120251', 'GUARE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1202', 'BABA', 'PQ_120252', 'ISLA DE BEJUCAL', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1203', 'MONTALVO', 'PQ_120350', 'MONTALVO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1204', 'PUEBLOVIEJO', 'PQ_120450', 'PUEBLOVIEJO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1204', 'PUEBLOVIEJO', 'PQ_120451', 'PUERTO PECHICHE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1204', 'PUEBLOVIEJO', 'PQ_120452', 'SAN JUAN', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120501', 'QUEVEDO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120502', 'SAN CAMILO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120503', 'SAN JOSÉ', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120504', 'GUAYACÁN', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120505', 'NICOLÁS INFANTE DÍAZ', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120506', 'SAN CRISTÓBAL', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120507', 'SIETE DE OCTUBRE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120508', '24 DE MAYO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120509', 'VENUS DEL RÍO QUEVEDO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120510', 'VIVA ALFARO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120550', 'QUEVEDO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120551', 'BUENA FÉ', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120552', 'MOCACHE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120553', 'SAN CARLOS', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120554', 'VALENCIA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1205', 'QUEVEDO', 'PQ_120555', 'LA ESPERANZA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1206', 'URDANETA', 'PQ_120650', 'CATARAMA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1206', 'URDANETA', 'PQ_120651', 'RICAURTE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120701', '10 DE NOVIEMBRE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120750', 'VENTANAS', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120751', 'QUINSALOMA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120752', 'ZAPOTAL', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120753', 'CHACARITA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1207', 'VENTANAS', 'PQ_120754', 'LOS ÁNGELES', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1208', 'VÍNCES', 'PQ_120850', 'VINCES', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1208', 'VÍNCES', 'PQ_120851', 'ANTONIO SOTOMAYOR (CAB. EN PLAYAS DE VINCES)', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1208', 'VÍNCES', 'PQ_120852', 'PALENQUE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1209', 'PALENQUE', 'PQ_120950', 'PALENQUE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121001', 'SAN JACINTO DE BUENA FÉ', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121002', '7 DE AGOSTO', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121003', '11 DE OCTUBRE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121050', 'SAN JACINTO DE BUENA FÉ', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1210', 'BUENA FÉ', 'PQ_121051', 'PATRICIA PILAR', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1211', 'VALENCIA', 'PQ_121150', 'VALENCIA', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1212', 'MOCACHE', 'PQ_121250', 'MOCACHE', NULL, NULL),
('PR_12', 'LOS RIOS', 'CN_1213', 'QUINSALOMA', 'PQ_121350', 'QUINSALOMA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130101', 'PORTOVIEJO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130102', '12 DE MARZO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130103', 'COLÓN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130104', 'PICOAZÁ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130105', 'SAN PABLO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130106', 'ANDRÉS DE VERA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130107', 'FRANCISCO PACHECO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130108', '18 DE OCTUBRE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130109', 'SIMÓN BOLÍVAR', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130150', 'PORTOVIEJO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130151', 'ABDÓN CALDERÓN (SAN FRANCISCO)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130152', 'ALHAJUELA (BAJO GRANDE)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130153', 'CRUCITA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130154', 'PUEBLO NUEVO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130155', 'RIOCHICO (RÍO CHICO)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130156', 'SAN PLÁCIDO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1301', 'PORTOVIEJO', 'PQ_130157', 'CHIRIJOS', NULL, NULL),
('PR_13', 'MANABI', 'CN_1302', 'BOLÍVAR', 'PQ_130250', 'CALCETA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1302', 'BOLÍVAR', 'PQ_130251', 'MEMBRILLO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1302', 'BOLÍVAR', 'PQ_130252', 'QUIROGA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130301', 'CHONE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130302', 'SANTA RITA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130350', 'CHONE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130351', 'BOYACÁ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130352', 'CANUTO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130353', 'CONVENTO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130354', 'CHIBUNGA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130355', 'ELOY ALFARO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130356', 'RICAURTE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1303', 'CHONE', 'PQ_130357', 'SAN ANTONIO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130401', 'EL CARMEN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130402', '4 DE DICIEMBRE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130450', 'EL CARMEN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130451', 'WILFRIDO LOOR MOREIRA (MAICITO)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1304', 'EL CARMEN', 'PQ_130452', 'SAN PEDRO DE SUMA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1305', 'FLAVIO ALFARO', 'PQ_130550', 'FLAVIO ALFARO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1305', 'FLAVIO ALFARO', 'PQ_130551', 'SAN FRANCISCO DE NOVILLO (CAB. EN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1305', 'FLAVIO ALFARO', 'PQ_130552', 'ZAPALLO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130601', 'DR. MIGUEL MORÁN LUCIO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130602', 'MANUEL INOCENCIO PARRALES Y GUALE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130603', 'SAN LORENZO DE JIPIJAPA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130650', 'JIPIJAPA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130651', 'AMÉRICA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130652', 'EL ANEGADO (CAB. EN ELOY ALFARO)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130653', 'JULCUY', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130654', 'LA UNIÓN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130655', 'MACHALILLA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130656', 'MEMBRILLAL', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130657', 'PEDRO PABLO GÓMEZ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130658', 'PUERTO DE CAYO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1306', 'JIPIJAPA', 'PQ_130659', 'PUERTO LÓPEZ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1307', 'JUNÍN', 'PQ_130750', 'JUNÍN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130801', 'LOS ESTEROS', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130802', 'MANTA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130803', 'SAN MATEO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130804', 'TARQUI', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130805', 'ELOY ALFARO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130850', 'MANTA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130851', 'SAN LORENZO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1308', 'MANTA', 'PQ_130852', 'SANTA MARIANITA (BOCA DE PACOCHE)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130901', 'ANIBAL SAN ANDRÉS', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130902', 'MONTECRISTI', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130903', 'EL COLORADO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130904', 'GENERAL ELOY ALFARO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130905', 'LEONIDAS PROAÑO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130950', 'MONTECRISTI', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130951', 'JARAMIJÓ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1309', 'MONTECRISTI', 'PQ_130952', 'LA PILA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131050', 'PAJÁN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131051', 'CAMPOZANO (LA PALMA DE PAJÁN)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131052', 'CASCOL', NULL, NULL),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131053', 'GUALE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1310', 'PAJÁN', 'PQ_131054', 'LASCANO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1311', 'PICHINCHA', 'PQ_131150', 'PICHINCHA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1311', 'PICHINCHA', 'PQ_131151', 'BARRAGANETE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1311', 'PICHINCHA', 'PQ_131152', 'SAN SEBASTIÁN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1312', 'ROCAFUERTE', 'PQ_131250', 'ROCAFUERTE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131301', 'SANTA ANA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131302', 'LODANA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131350', 'SANTA ANA DE VUELTA LARGA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131351', 'AYACUCHO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131352', 'HONORATO VÁSQUEZ (CAB. EN VÁSQUEZ)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131353', 'LA UNIÓN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131354', 'OLMEDO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1313', 'SANTA ANA', 'PQ_131355', 'SAN PABLO (CAB. EN PUEBLO NUEVO)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131401', 'BAHÍA DE CARÁQUEZ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131402', 'LEONIDAS PLAZA GUTIÉRREZ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131450', 'BAHÍA DE CARÁQUEZ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131451', 'CANOA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131452', 'COJIMÍES', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131453', 'CHARAPOTÓ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131454', '10 DE AGOSTO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131455', 'JAMA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131456', 'PEDERNALES', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131457', 'SAN ISIDRO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1314', 'SUCRE', 'PQ_131458', 'SAN VICENTE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1315', 'TOSAGUA', 'PQ_131550', 'TOSAGUA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1315', 'TOSAGUA', 'PQ_131551', 'BACHILLERO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1315', 'TOSAGUA', 'PQ_131552', 'ANGEL PEDRO GILER (LA ESTANCILLA)', NULL, NULL),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131650', 'SUCRE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131651', 'BELLAVISTA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131652', 'NOBOA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1316', '24 DE MAYO', 'PQ_131653', 'ARQ. SIXTO DURÁN BALLÉN', NULL, NULL),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131750', 'PEDERNALES', NULL, NULL),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131751', 'COJIMÍES', NULL, NULL),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131752', '10 DE AGOSTO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1317', 'PEDERNALES', 'PQ_131753', 'ATAHUALPA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1318', 'OLMEDO', 'PQ_131850', 'OLMEDO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1319', 'PUERTO LÓPEZ', 'PQ_131950', 'PUERTO LÓPEZ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1319', 'PUERTO LÓPEZ', 'PQ_131951', 'MACHALILLA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1319', 'PUERTO LÓPEZ', 'PQ_131952', 'SALANGO', NULL, NULL),
('PR_13', 'MANABI', 'CN_1320', 'JAMA', 'PQ_132050', 'JAMA', NULL, NULL),
('PR_13', 'MANABI', 'CN_1321', 'JARAMIJÓ', 'PQ_132150', 'JARAMIJÓ', NULL, NULL),
('PR_13', 'MANABI', 'CN_1322', 'SAN VICENTE', 'PQ_132250', 'SAN VICENTE', NULL, NULL),
('PR_13', 'MANABI', 'CN_1322', 'SAN VICENTE', 'PQ_132251', 'CANOA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140150', 'MACAS', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140151', 'ALSHI (CAB. EN 9 DE OCTUBRE)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140152', 'CHIGUAZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140153', 'GENERAL PROAÑO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140154', 'HUASAGA (CAB.EN WAMPUIK)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140155', 'MACUMA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140156', 'SAN ISIDRO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140157', 'SEVILLA DON BOSCO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140158', 'SINAÍ', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140159', 'TAISHA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140160', 'ZUÑA (ZÚÑAC)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140161', 'TUUTINENTZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140162', 'CUCHAENTZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140163', 'SAN JOSÉ DE MORONA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1401', 'MORONA', 'PQ_140164', 'RÍO BLANCO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140201', 'GUALAQUIZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140202', 'MERCEDES MOLINA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140250', 'GUALAQUIZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140251', 'AMAZONAS (ROSARIO DE CUYES)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140252', 'BERMEJOS', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140253', 'BOMBOIZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140254', 'CHIGÜINDA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140255', 'EL ROSARIO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140256', 'NUEVA TARQUI', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140257', 'SAN MIGUEL DE CUYES', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1402', 'GUALAQUIZA', 'PQ_140258', 'EL IDEAL', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140350', 'GENERAL LEONIDAS PLAZA GUTIÉRREZ (LIMÓN)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140351', 'INDANZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140352', 'PAN DE AZÚCAR', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140353', 'SAN ANTONIO (CAB. EN SAN ANTONIO CENTRO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140354', 'SAN CARLOS DE LIMÓN (SAN CARLOS DEL', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140355', 'SAN JUAN BOSCO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140356', 'SAN MIGUEL DE CONCHAY', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140357', 'SANTA SUSANA DE CHIVIAZA (CAB. EN CHIVIAZA)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1403', 'LIMÓN INDANZA', 'PQ_140358', 'YUNGANZA (CAB. EN EL ROSARIO)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140450', 'PALORA (METZERA)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140451', 'ARAPICOS', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140452', 'CUMANDÁ (CAB. EN COLONIA AGRÍCOLA SEVILLA DEL ORO)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140453', 'HUAMBOYA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1404', 'PALORA', 'PQ_140454', 'SANGAY (CAB. EN NAYAMANACA)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140550', 'SANTIAGO DE MÉNDEZ', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140551', 'COPAL', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140552', 'CHUPIANZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140553', 'PATUCA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140554', 'SAN LUIS DE EL ACHO (CAB. EN EL ACHO)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140555', 'SANTIAGO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140556', 'TAYUZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1405', 'SANTIAGO', 'PQ_140557', 'SAN FRANCISCO DE CHINIMBIMI', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140650', 'SUCÚA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140651', 'ASUNCIÓN', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140652', 'HUAMBI', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140653', 'LOGROÑO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140654', 'YAUPI', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1406', 'SUCÚA', 'PQ_140655', 'SANTA MARIANITA DE JESÚS', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1407', 'HUAMBOYA', 'PQ_140750', 'HUAMBOYA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1407', 'HUAMBOYA', 'PQ_140751', 'CHIGUAZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1407', 'HUAMBOYA', 'PQ_140752', 'PABLO SEXTO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140850', 'SAN JUAN BOSCO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140851', 'PAN DE AZÚCAR', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140852', 'SAN CARLOS DE LIMÓN', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140853', 'SAN JACINTO DE WAKAMBEIS', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1408', 'SAN JUAN BOSCO', 'PQ_140854', 'SANTIAGO DE PANANZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140950', 'TAISHA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140951', 'HUASAGA (CAB. EN WAMPUIK)', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140952', 'MACUMA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140953', 'TUUTINENTZA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1409', 'TAISHA', 'PQ_140954', 'PUMPUENTSA', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1410', 'LOGROÑO', 'PQ_141050', 'LOGROÑO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1410', 'LOGROÑO', 'PQ_141051', 'YAUPI', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1410', 'LOGROÑO', 'PQ_141052', 'SHIMPIS', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1411', 'PABLO SEXTO', 'PQ_141150', 'PABLO SEXTO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1412', 'TIWINTZA', 'PQ_141250', 'SANTIAGO', NULL, NULL),
('PR_14', 'MORONA SANTIAGO', 'CN_1412', 'TIWINTZA', 'PQ_141251', 'SAN JOSÉ DE MORONA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150150', 'TENA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150151', 'AHUANO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150152', 'CARLOS JULIO AROSEMENA TOLA (ZATZA-YACU)', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150153', 'CHONTAPUNTA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150154', 'PANO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150155', 'PUERTO MISAHUALLI', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150156', 'PUERTO NAPO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150157', 'TÁLAG', NULL, NULL),
('PR_15', 'NAPO', 'CN_1501', 'TENA', 'PQ_150158', 'SAN JUAN DE MUYUNA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150350', 'ARCHIDONA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150351', 'AVILA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150352', 'COTUNDO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150353', 'LORETO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150354', 'SAN PABLO DE USHPAYACU', NULL, NULL),
('PR_15', 'NAPO', 'CN_1503', 'ARCHIDONA', 'PQ_150355', 'PUERTO MURIALDO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150450', 'EL CHACO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150451', 'GONZALO DíAZ DE PINEDA (EL BOMBÓN)', NULL, NULL),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150452', 'LINARES', NULL, NULL),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150453', 'OYACACHI', NULL, NULL),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150454', 'SANTA ROSA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1504', 'EL CHACO', 'PQ_150455', 'SARDINAS', NULL, NULL),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150750', 'BAEZA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150751', 'COSANGA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150752', 'CUYUJA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150753', 'PAPALLACTA', NULL, NULL),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150754', 'SAN FRANCISCO DE BORJA (VIRGILIO DÁVILA)', NULL, NULL),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150755', 'SAN JOSÉ DEL PAYAMINO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1507', 'QUIJOS', 'PQ_150756', 'SUMACO', NULL, NULL),
('PR_15', 'NAPO', 'CN_1509', 'CARLOS JULIO AROSEMENA TOLA', 'PQ_150950', 'CARLOS JULIO AROSEMENA TOLA', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160150', 'PUYO', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160151', 'ARAJUNO', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160152', 'CANELOS', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160153', 'CURARAY', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160154', 'DIEZ DE AGOSTO', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160155', 'FÁTIMA', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160156', 'MONTALVO (ANDOAS)', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160157', 'POMONA', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160158', 'RÍO CORRIENTES', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160159', 'RÍO TIGRE', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160160', 'SANTA CLARA', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160161', 'SARAYACU', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160162', 'SIMÓN BOLÍVAR (CAB. EN MUSHULLACTA)', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160163', 'TARQUI', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160164', 'TENIENTE HUGO ORTIZ', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160165', 'VERACRUZ (INDILLAMA) (CAB. EN INDILLAMA)', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1601', 'PASTAZA', 'PQ_160166', 'EL TRIUNFO', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1602', 'MERA', 'PQ_160250', 'MERA', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1602', 'MERA', 'PQ_160251', 'MADRE TIERRA', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1602', 'MERA', 'PQ_160252', 'SHELL', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1603', 'SANTA CLARA', 'PQ_160350', 'SANTA CLARA', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1603', 'SANTA CLARA', 'PQ_160351', 'SAN JOSÉ', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1604', 'ARAJUNO', 'PQ_160450', 'ARAJUNO', NULL, NULL),
('PR_16', 'PASTAZA', 'CN_1604', 'ARAJUNO', 'PQ_160451', 'CURARAY', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170101', 'BELISARIO QUEVEDO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170102', 'CARCELÉN', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170103', 'CENTRO HISTÓRICO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170104', 'COCHAPAMBA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170105', 'COMITÉ DEL PUEBLO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170106', 'COTOCOLLAO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170107', 'CHILIBULO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170108', 'CHILLOGALLO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170109', 'CHIMBACALLE', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170110', 'EL CONDADO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170111', 'GUAMANÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170112', 'IÑAQUITO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170113', 'ITCHIMBÍA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170114', 'JIPIJAPA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170115', 'KENNEDY', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170116', 'LA ARGELIA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170117', 'LA CONCEPCIÓN', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170118', 'LA ECUATORIANA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170119', 'LA FERROVIARIA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170120', 'LA LIBERTAD', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170121', 'LA MAGDALENA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170122', 'LA MENA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170123', 'MARISCAL SUCRE', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170124', 'PONCEANO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170125', 'PUENGASÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170126', 'QUITUMBE', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170127', 'RUMIPAMBA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170128', 'SAN BARTOLO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170129', 'SAN ISIDRO DEL INCA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170130', 'SAN JUAN', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170131', 'SOLANDA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170132', 'TURUBAMBA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170150', 'QUITO DISTRITO METROPOLITANO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170151', 'ALANGASÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170152', 'AMAGUAÑA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170153', 'ATAHUALPA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170154', 'CALACALÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170155', 'CALDERÓN', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170156', 'CONOCOTO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170157', 'CUMBAYÁ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170158', 'CHAVEZPAMBA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170159', 'CHECA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170160', 'EL QUINCHE', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170161', 'GUALEA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170162', 'GUANGOPOLO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170163', 'GUAYLLABAMBA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170164', 'LA MERCED', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170165', 'LLANO CHICO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170166', 'LLOA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170167', 'MINDO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170168', 'NANEGAL', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170169', 'NANEGALITO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170170', 'NAYÓN', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170171', 'NONO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170172', 'PACTO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170173', 'PEDRO VICENTE MALDONADO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170174', 'PERUCHO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170175', 'PIFO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170176', 'PÍNTAG', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170177', 'POMASQUI', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170178', 'PUÉLLARO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170179', 'PUEMBO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170180', 'SAN ANTONIO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170181', 'SAN JOSÉ DE MINAS', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170182', 'SAN MIGUEL DE LOS BANCOS', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170183', 'TABABELA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170184', 'TUMBACO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170185', 'YARUQUÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170186', 'ZAMBIZA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1701', 'QUITO', 'PQ_170187', 'PUERTO QUITO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170201', 'AYORA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170202', 'CAYAMBE', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170203', 'JUAN MONTALVO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170250', 'CAYAMBE', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170251', 'ASCÁZUBI', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170252', 'CANGAHUA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170253', 'OLMEDO (PESILLO)', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170254', 'OTÓN', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1702', 'CAYAMBE', 'PQ_170255', 'SANTA ROSA DE CUZUBAMBA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170350', 'MACHACHI', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170351', 'ALÓAG', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170352', 'ALOASÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170353', 'CUTUGLAHUA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170354', 'EL CHAUPI', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170355', 'MANUEL CORNEJO ASTORGA (TANDAPI)', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170356', 'TAMBILLO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1703', 'MEJIA', 'PQ_170357', 'UYUMBICHO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170450', 'TABACUNDO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170451', 'LA ESPERANZA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170452', 'MALCHINGUÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170453', 'TOCACHI', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1704', 'PEDRO MONCAYO', 'PQ_170454', 'TUPIGACHI', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170501', 'SANGOLQUÍ', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170502', 'SAN PEDRO DE TABOADA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170503', 'SAN RAFAEL', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170550', 'SANGOLQUI', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170551', 'COTOGCHOA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1705', 'RUMIÑAHUI', 'PQ_170552', 'RUMIPAMBA', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170750', 'SAN MIGUEL DE LOS BANCOS', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170751', 'MINDO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170752', 'PEDRO VICENTE MALDONADO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1707', 'SAN MIGUEL DE LOS BANCOS', 'PQ_170753', 'PUERTO QUITO', NULL, NULL),
('PR_17', 'PICHINCHA', 'CN_1708', 'PEDRO VICENTE MALDONADO', 'PQ_170850', 'PEDRO VICENTE MALDONADO', NULL, NULL);
INSERT INTO `dct_parametro_tbl_div_politica` (`dvp_codigo_provincia`, `dvp_provincia`, `dvp_codigo_canton`, `dvp_canton`, `dvp_codigo_parroquia`, `dvp_parroquia`, `created_at`, `updated_at`) VALUES
('PR_17', 'PICHINCHA', 'CN_1709', 'PUERTO QUITO', 'PQ_170950', 'PUERTO QUITO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180101', 'ATOCHA – FICOA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180102', 'CELIANO MONGE', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180103', 'HUACHI CHICO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180104', 'HUACHI LORETO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180105', 'LA MERCED', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180106', 'LA PENÍNSULA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180107', 'MATRIZ', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180108', 'PISHILATA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180109', 'SAN FRANCISCO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180150', 'AMBATO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180151', 'AMBATILLO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180152', 'ATAHUALPA (CHISALATA)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180153', 'AUGUSTO N. MARTÍNEZ (MUNDUGLEO)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180154', 'CONSTANTINO FERNÁNDEZ (CAB. EN CULLITAHUA)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180155', 'HUACHI GRANDE', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180156', 'IZAMBA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180157', 'JUAN BENIGNO VELA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180158', 'MONTALVO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180159', 'PASA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180160', 'PICAIGUA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180161', 'PILAGÜÍN (PILAHÜÍN)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180162', 'QUISAPINCHA (QUIZAPINCHA)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180163', 'SAN BARTOLOMÉ DE PINLLOG', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180164', 'SAN FERNANDO (PASA SAN FERNANDO)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180165', 'SANTA ROSA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180166', 'TOTORAS', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180167', 'CUNCHIBAMBA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1801', 'AMBATO', 'PQ_180168', 'UNAMUNCHO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180250', 'BAÑOS DE AGUA SANTA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180251', 'LLIGUA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180252', 'RÍO NEGRO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180253', 'RÍO VERDE', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1802', 'BAÑOS DE AGUA SANTA', 'PQ_180254', 'ULBA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1803', 'CEVALLOS', 'PQ_180350', 'CEVALLOS', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1804', 'MOCHA', 'PQ_180450', 'MOCHA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1804', 'MOCHA', 'PQ_180451', 'PINGUILÍ', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180550', 'PATATE', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180551', 'EL TRIUNFO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180552', 'LOS ANDES (CAB. EN POATUG)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1805', 'PATATE', 'PQ_180553', 'SUCRE (CAB. EN SUCRE-PATATE URCU)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1806', 'QUERO', 'PQ_180650', 'QUERO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1806', 'QUERO', 'PQ_180651', 'RUMIPAMBA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1806', 'QUERO', 'PQ_180652', 'YANAYACU - MOCHAPATA (CAB. EN YANAYACU)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180701', 'PELILEO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180702', 'PELILEO GRANDE', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180750', 'PELILEO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180751', 'BENÍTEZ (PACHANLICA)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180752', 'BOLÍVAR', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180753', 'COTALÓ', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180754', 'CHIQUICHA (CAB. EN CHIQUICHA GRANDE)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180755', 'EL ROSARIO (RUMICHACA)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180756', 'GARCÍA MORENO (CHUMAQUI)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180757', 'GUAMBALÓ (HUAMBALÓ)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1807', 'SAN PEDRO DE PELILEO', 'PQ_180758', 'SALASACA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180801', 'CIUDAD NUEVA', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180802', 'PÍLLARO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180850', 'PÍLLARO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180851', 'BAQUERIZO MORENO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180852', 'EMILIO MARÍA TERÁN (RUMIPAMBA)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180853', 'MARCOS ESPINEL (CHACATA)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180854', 'PRESIDENTE URBINA (CHAGRAPAMBA -PATZUCUL)', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180855', 'SAN ANDRÉS', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180856', 'SAN JOSÉ DE POALÓ', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1808', 'SANTIAGO DE PÍLLARO', 'PQ_180857', 'SAN MIGUELITO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1809', 'TISALEO', 'PQ_180950', 'TISALEO', NULL, NULL),
('PR_18', 'TUNGURAHUA', 'CN_1809', 'TISALEO', 'PQ_180951', 'QUINCHICOTO', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190101', 'EL LIMÓN', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190102', 'ZAMORA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190150', 'ZAMORA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190151', 'CUMBARATZA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190152', 'GUADALUPE', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190153', 'IMBANA (LA VICTORIA DE IMBANA)', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190154', 'PAQUISHA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190155', 'SABANILLA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190156', 'TIMBARA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190157', 'ZUMBI', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1901', 'ZAMORA', 'PQ_190158', 'SAN CARLOS DE LAS MINAS', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190250', 'ZUMBA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190251', 'CHITO', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190252', 'EL CHORRO', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190253', 'EL PORVENIR DEL CARMEN', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190254', 'LA CHONTA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190255', 'PALANDA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190256', 'PUCAPAMBA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190257', 'SAN FRANCISCO DEL VERGEL', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190258', 'VALLADOLID', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1902', 'CHINCHIPE', 'PQ_190259', 'SAN ANDRÉS', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1903', 'NANGARITZA', 'PQ_190350', 'GUAYZIMI', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1903', 'NANGARITZA', 'PQ_190351', 'ZURMI', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1903', 'NANGARITZA', 'PQ_190352', 'NUEVO PARAÍSO', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1904', 'YACUAMBI', 'PQ_190450', '28 DE MAYO (SAN JOSÉ DE YACUAMBI)', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1904', 'YACUAMBI', 'PQ_190451', 'LA PAZ', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1904', 'YACUAMBI', 'PQ_190452', 'TUTUPALI', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190550', 'YANTZAZA (YANZATZA)', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190551', 'CHICAÑA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190552', 'EL PANGUI', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1905', 'YANTZAZA (YANZATZA)', 'PQ_190553', 'LOS ENCUENTROS', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190650', 'EL PANGUI', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190651', 'EL GUISME', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190652', 'PACHICUTZA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1906', 'EL PANGUI', 'PQ_190653', 'TUNDAYME', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190750', 'ZUMBI', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190751', 'PAQUISHA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190752', 'TRIUNFO-DORADO', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1907', 'CENTINELA DEL CÓNDOR', 'PQ_190753', 'PANGUINTZA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190850', 'PALANDA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190851', 'EL PORVENIR DEL CARMEN', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190852', 'SAN FRANCISCO DEL VERGEL', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190853', 'VALLADOLID', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1908', 'PALANDA', 'PQ_190854', 'LA CANELA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1909', 'PAQUISHA', 'PQ_190950', 'PAQUISHA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1909', 'PAQUISHA', 'PQ_190951', 'BELLAVISTA', NULL, NULL),
('PR_19', 'ZAMORA CHINCHIPE', 'CN_1909', 'PAQUISHA', 'PQ_190952', 'NUEVO QUITO', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2001', 'SAN CRISTÓBAL', 'PQ_200150', 'PUERTO BAQUERIZO MORENO', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2001', 'SAN CRISTÓBAL', 'PQ_200151', 'EL PROGRESO', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2001', 'SAN CRISTÓBAL', 'PQ_200152', 'ISLA SANTA MARÍA (FLOREANA) (CAB. EN PTO. VELASCO IBARRA)', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2002', 'ISABELA', 'PQ_200250', 'PUERTO VILLAMIL', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2002', 'ISABELA', 'PQ_200251', 'TOMÁS DE BERLANGA (SANTO TOMÁS)', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2003', 'SANTA CRUZ', 'PQ_200350', 'PUERTO AYORA', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2003', 'SANTA CRUZ', 'PQ_200351', 'BELLAVISTA', NULL, NULL),
('PR_20', 'GALAPAGOS', 'CN_2003', 'SANTA CRUZ', 'PQ_200352', 'SANTA ROSA (INCLUYE LA ISLA BALTRA)', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210150', 'NUEVA LOJA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210151', 'CUYABENO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210152', 'DURENO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210153', 'GENERAL FARFÁN', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210154', 'TARAPOA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210155', 'EL ENO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210156', 'PACAYACU', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210157', 'JAMBELÍ', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210158', 'SANTA CECILIA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2101', 'LAGO AGRIO', 'PQ_210159', 'AGUAS NEGRAS', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210250', 'EL DORADO DE CASCALES', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210251', 'EL REVENTADOR', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210252', 'GONZALO PIZARRO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210253', 'LUMBAQUÍ', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210254', 'PUERTO LIBRE', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2102', 'GONZALO PIZARRO', 'PQ_210255', 'SANTA ROSA DE SUCUMBÍOS', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210350', 'PUERTO EL CARMEN DEL PUTUMAYO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210351', 'PALMA ROJA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210352', 'PUERTO BOLÍVAR (PUERTO MONTÚFAR)', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210353', 'PUERTO RODRÍGUEZ', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2103', 'PUTUMAYO', 'PQ_210354', 'SANTA ELENA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210450', 'SHUSHUFINDI', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210451', 'LIMONCOCHA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210452', 'PAÑACOCHA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210453', 'SAN ROQUE (CAB. EN SAN VICENTE)', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210454', 'SAN PEDRO DE LOS COFANES', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2104', 'SHUSHUFINDI', 'PQ_210455', 'SIETE DE JULIO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210550', 'LA BONITA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210551', 'EL PLAYÓN DE SAN FRANCISCO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210552', 'LA SOFÍA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210553', 'ROSA FLORIDA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2105', 'SUCUMBÍOS', 'PQ_210554', 'SANTA BÁRBARA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2106', 'CASCALES', 'PQ_210650', 'EL DORADO DE CASCALES', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2106', 'CASCALES', 'PQ_210651', 'SANTA ROSA DE SUCUMBÍOS', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2106', 'CASCALES', 'PQ_210652', 'SEVILLA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2107', 'CUYABENO', 'PQ_210750', 'TARAPOA', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2107', 'CUYABENO', 'PQ_210751', 'CUYABENO', NULL, NULL),
('PR_21', 'SUCUMBIOS', 'CN_2107', 'CUYABENO', 'PQ_210752', 'AGUAS NEGRAS', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220150', 'PUERTO FRANCISCO DE ORELLANA (EL COCA)', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220151', 'DAYUMA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220152', 'TARACOA (NUEVA ESPERANZA: YUCA)', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220153', 'ALEJANDRO LABAKA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220154', 'EL DORADO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220155', 'EL EDÉN', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220156', 'GARCÍA MORENO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220157', 'INÉS ARANGO (CAB. EN WESTERN)', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220158', 'LA BELLEZA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220159', 'NUEVO PARAÍSO (CAB. EN UNIÓN', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220160', 'SAN JOSÉ DE GUAYUSA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2201', 'ORELLANA', 'PQ_220161', 'SAN LUIS DE ARMENIA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220201', 'TIPITINI', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220250', 'NUEVO ROCAFUERTE', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220251', 'CAPITÁN AUGUSTO RIVADENEYRA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220252', 'CONONACO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220253', 'SANTA MARÍA DE HUIRIRIMA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220254', 'TIPUTINI', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2202', 'AGUARICO', 'PQ_220255', 'YASUNÍ', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220350', 'LA JOYA DE LOS SACHAS', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220351', 'ENOKANQUI', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220352', 'POMPEYA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220353', 'SAN CARLOS', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220354', 'SAN SEBASTIÁN DEL COCA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220355', 'LAGO SAN PEDRO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220356', 'RUMIPAMBA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220357', 'TRES DE NOVIEMBRE', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2203', 'LA JOYA DE LOS SACHAS', 'PQ_220358', 'UNIÓN MILAGREÑA', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220450', 'LORETO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220451', 'AVILA (CAB. EN HUIRUNO)', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220452', 'PUERTO MURIALDO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220453', 'SAN JOSÉ DE PAYAMINO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220454', 'SAN JOSÉ DE DAHUANO', NULL, NULL),
('PR_22', 'ORELLANA', 'CN_2204', 'LORETO', 'PQ_220455', 'SAN VICENTE DE HUATICOCHA', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230101', 'ABRAHAM CALAZACÓN', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230102', 'BOMBOLÍ', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230103', 'CHIGUILPE', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230104', 'RÍO TOACHI', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230105', 'RÍO VERDE', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230106', 'SANTO DOMINGO DE LOS COLORADOS', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230107', 'ZARACAY', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230150', 'SANTO DOMINGO DE LOS COLORADOS', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230151', 'ALLURIQUÍN', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230152', 'PUERTO LIMÓN', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230153', 'LUZ DE AMÉRICA', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230154', 'SAN JACINTO DEL BÚA', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230155', 'VALLE HERMOSO', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230156', 'EL ESFUERZO', NULL, NULL),
('PR_23', 'SANTO DOMINGO DE LOS TSACHILAS', 'CN_2301', 'SANTO DOMINGO', 'PQ_230157', 'SANTA MARÍA DEL TOACHI', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240101', 'BALLENITA', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240102', 'SANTA ELENA', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240150', 'SANTA ELENA', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240151', 'ATAHUALPA', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240152', 'COLONCHE', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240153', 'CHANDUY', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240154', 'MANGLARALTO', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240155', 'SIMÓN BOLÍVAR (JULIO MORENO)', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2401', 'SANTA ELENA', 'PQ_240156', 'SAN JOSÉ DE ANCÓN', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2402', 'LA LIBERTAD', 'PQ_240250', 'LA LIBERTAD', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240301', 'CARLOS ESPINOZA LARREA', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240302', 'GRAL. ALBERTO ENRÍQUEZ GALLO', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240303', 'VICENTE ROCAFUERTE', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240304', 'SANTA ROSA', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240350', 'SALINAS', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240351', 'ANCONCITO', NULL, NULL),
('PR_24', 'SANTA ELENA', 'CN_2403', 'SALINAS', 'PQ_240352', 'JOSÉ LUIS TAMAYO (MUEY)', NULL, NULL),
('PR_90', 'ZONAS NO DELIMITADAS', 'CN_9001', 'LAS GOLONDRINAS', 'PQ_900151', 'LAS GOLONDRINAS', NULL, NULL),
('PR_90', 'ZONAS NO DELIMITADAS', 'CN_9003', 'MANGA DEL CURA', 'PQ_900351', 'MANGA DEL CURA', NULL, NULL),
('PR_90', 'ZONAS NO DELIMITADAS', 'CN_9004', 'EL PIEDRERO', 'PQ_900451', 'EL PIEDRERO', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_advertencia_sri`
--

CREATE TABLE `dct_pos_tbl_advertencia_sri` (
  `sra_codigo` tinyint(1) NOT NULL,
  `sra_descripcion` varchar(150) DEFAULT NULL,
  `sra_motivo` varchar(250) DEFAULT NULL,
  `sra_validacion` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_advertencia_sri`
--

INSERT INTO `dct_pos_tbl_advertencia_sri` (`sra_codigo`, `sra_descripcion`, `sra_motivo`, `sra_validacion`, `created_at`, `updated_at`) VALUES
(2, 'RUC del emisor se encuentra NO ACTIVO.', 'Verificar que el número de RUC se encuentre en estado ACTIVO.', 'AUTORIZACIÓN', NULL, NULL),
(10, 'Establecimiento del emisor se encuentra Clausurado.', 'No se autorizará comprobantes si el establecimiento emisor ha sido clausurado, automáticamente se habilitará el servicio una vez concluido la clausura.', 'AUTORIZACIÓN', NULL, NULL),
(26, 'Tamaño máximo superado', 'Tamaño del archivo supera lo establecido', 'RECEPCIÓN', NULL, NULL),
(27, 'Clase no permitido', 'La clase del contribuyente no puede emitir comprobantes electrónicos.', 'AUTORIZACIÓN', NULL, NULL),
(28, 'Acuerdo de medios electrónicos no aceptado', 'Siempre el contribuyente debe haber aceptado el acuerdo de medio electrónicos en el cual se establece que se acepta que lleguen las notificaciones al buzón del contribuyente.', 'RECEPCIÓN', NULL, NULL),
(34, 'Comprobante no autorizado', 'Cuando el comprobante no ha sido autorizado como parte de la solicitud de emisión del contribuyente.', 'EMISOR', NULL, NULL),
(35, 'Documento inválido', 'Cuando el XML no pasa validación de esquema.', 'RECEPCIÓN', NULL, NULL),
(36, 'Versión esquema descontinuada', 'Cuando la versión del esquema no es la correcta.', 'RECEPCIÓN', NULL, NULL),
(37, 'RUC sin autorización de emisión', 'Cuando el RUC del emisor no cuenta con una solicitud de emisión de comprobantes electrónicos.', 'AUTORIZACIÓN', NULL, NULL),
(39, 'Firma inválida', 'Firma electrónica del emisor no es válida.', 'AUTORIZACIÓN', NULL, NULL),
(40, 'Error en el certificado', 'No se encontró el certificado o no se puede convertir en certificad X509.', 'AUTORIZACIÓN', NULL, NULL),
(42, 'Certificado revocado', 'Certificado que ha superado su fecha de caducidad, y no ha sido renovado.', 'EMISOR', NULL, NULL),
(43, 'Clave acceso registrada', 'Cuando la clave de acceso ya se encuentra registrada en la base de datos.', 'RECEPCIÓN', NULL, NULL),
(45, 'Secuencial registrado', 'Secuencial del comprobante ya se encuentra registrado en la base de datos', 'RECEPCIÓN', NULL, NULL),
(46, 'RUC no existe', 'Cuando el RUC emisor no existe en el Registro Único de Contribuyentes.', 'AUTORIZACIÓN', NULL, NULL),
(47, 'Tipo de comprobante no existe', 'Cuando envían en el tipo de comprobante uno que no exista en el catálogo de nuestros tipos de comprobantes.', 'RECEPCIÓN', NULL, NULL),
(48, 'Esquema XSD no existe', 'Cuando el esquema para el tipo de comprobante enviado no existe.', 'RECEPCIÓN', NULL, NULL),
(49, 'Argumentos que envían al WS nulos', 'Cuando se consume el WS con argumentos nulos.', 'RECEPCIÓN', NULL, NULL),
(50, 'Error interno general', 'Cuando ocurre un error inesperado en el servidor.', 'RECEPCIÓN', NULL, NULL),
(52, 'Error en diferencias', 'Cuando existe error en los cálculos del comprobante.', 'AUTORIZACIÓN', NULL, NULL),
(56, 'Establecimiento cerrado', 'Cuando el establecimiento desde el cual se genera el comprobante se encuentra cerrado.', 'AUTORIZACIÓN', NULL, NULL),
(57, 'Autorización suspendida', 'Cuando la autorización para emisión de comprobantes electrónicos para el emisor se encuentra suspendida por procesos de control de la Administración Tributaria.', 'AUTORIZACIÓN', NULL, NULL),
(58, 'Error en la estructura de clave acceso', 'Cuando la clave de acceso tiene componentes diferentes a los del comprobante.', 'AUTORIZACIÓN', NULL, NULL),
(59, 'Identificación no existe', 'Cuando el número de la identificación del adquirente no existe.', 'COD ERROR 70', NULL, NULL),
(60, 'Ambiente ejecución.', 'Siempre que el comprobante sea emitido en ambiente de certificación o pruebas se enviará como parte de la autorización esta advertencia.', 'COD ERROR 70', NULL, NULL),
(62, 'Identificación incorrecta', 'Cuando el número de la identificación del adquirente del comprobante está incorrecto.  Por ejemplo, cédulas no pasan el dígito verificador.', 'COD ERROR 70', NULL, NULL),
(63, 'RUC clausurado', 'Cuando el RUC del emisor se encuentra clausurado por procesos de control de la Administración Tributaria.', 'AUTORIZACIÓN', NULL, NULL),
(64, 'Código documento sustento', 'Cuando el código del documento sustento no existe en el catálogo de documentos que se tiene en la Administración.', 'EMISOR', NULL, NULL),
(65, 'Fecha de emisión extemporánea', 'Cuando el comprobante emitido no fue enviado de acuerdo con el tiempo del tipo de emisión en el cual fue realizado.', 'EMISOR/ RECEPCIÓN', NULL, NULL),
(67, 'Fecha inválida', 'Cuando existe errores en el formato de la fecha.', 'RECEPCIÓN', NULL, NULL),
(68, 'Documento sustento', 'Cuando el comprobante relacionado no existe como electrónico.', 'COD ERROR 70', NULL, NULL),
(69, 'Identificación del receptor', 'Cuando la identificación asociada al adquirente no existe. En general cuando el RUC del adquirente no existe en el Registro Único de Contribuyentes.', 'EMISOR', NULL, NULL),
(70, 'Clave de acceso en procesamiento', 'Cuando se desea enviar un comprobante que ha sido enviado anteriormente y el mismo no ha terminado su\nprocesamiento.', 'RECEPCIÓN', NULL, NULL),
(80, 'Error en la estructura de clave acceso', 'Cuando se ejecuta la consulta de autorización por clave de acceso y el valor de este parámetro supera los 49 dígitos, tiene caracteres alfanuméricos o cuando el tag\n(claveAccesoComprobante) está vacío', 'AUTORIZACIÓN', NULL, NULL),
(82, 'Error en la fecha de inicio de transporte', 'Cuando la fecha de inicio de transporte es menor a la fecha de emisión de la guía de remisión.', 'RECEPCIÓN', NULL, NULL),
(92, 'Error al validar monto de devolución del IVA.', 'Cuando el valor registrado en el campo de devolución del IVA, en facturas y notas de débito, no corresponde al que fue autorizado por el servicio web DIG.', 'RECEPCIÓN', NULL, NULL);

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
  `cli_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_cientes`
--

INSERT INTO `dct_pos_tbl_cientes` (`cli_id_cliente`, `emp_id_empresa`, `cli_tipo_identificacion`, `cli_identificacion`, `cli_nombre_1`, `cli_nombre_2`, `cli_apellido_1`, `cli_apellido_2`, `cli_correo`, `cli_direccion`, `cli_telefono`, `cli_placa`, `cli_estado`, `cli_usuario_creacion`, `cli_usuario_modificacion`, `cli_fecha_creacion`, `cli_fecha_modificacion`, `cli_ip_creacion`, `cli_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, '05', '1308041134', 'MERY', NULL, 'REINA', NULL, 'mreinacevallos@iess.gob.ec', 'LOS ESTEROS', '0960939030', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, '04', '9999999999999', 'CONSUMIDOR', NULL, 'FINAL', NULL, 'na@na.com', 'CONSUMIDOR FINAL', '0999999999', '--------', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, '04', '1308041135', 'MAURO', NULL, 'ECHEVERRIA', NULL, 'dfgfdg@asdsad.com', 'GUAYAQUI FERTIZA', NULL, NULL, 1, '0919664854', NULL, '2022-08-25 07:24:23', NULL, '::1', NULL, NULL, NULL),
(4, 1, '05', '0919664854', 'MAURO', NULL, 'ECHEVERRIA', NULL, 'rtytryt@asdasd.com', 'GUAYAQUI FERTIZA', NULL, NULL, 1, '0919664854', NULL, '2022-08-25 07:26:26', NULL, '::1', NULL, NULL, NULL),
(5, 1, '04', '12345679012', 'MAURO', 'WERWER', 'ECHEVERRIA', 'WERWER', 'sdfsdf@sadsad.com', 'GUAYAQUI FERTIZA', '2324234234', '34345435', 1, '0919664854', NULL, '2022-08-25 07:27:14', NULL, '::1', NULL, NULL, NULL),
(6, 1, '05', '1706486105', 'MAURO', 'DGDFG', 'ECHEVERRIA', 'DFGDF', 'fghf@df.com', 'GUAYAQUI FERTIZA', '2324234234', 'T34T34T4', 1, '0919664854', NULL, '2022-08-25 09:23:14', NULL, '::1', NULL, NULL, NULL),
(7, 1, '05', '9992525252', 'FGHFGH', 'FGHFGH', 'FGHFGH', 'FGHFGH', 'dgdff@sdfsdf.com', 'FGHFGH', '0426565656', NULL, 1, '0919664854', NULL, '2022-09-18 12:53:10', NULL, '::1', NULL, NULL, NULL),
(8, 1, '04', '0930924853', 'BCVBCVBVC', 'FGHFGH', 'YFTYRTY', 'FGHGH', 'ghg@fdgdfg.com', 'FGHFGH', '0565656565', 'GHFGHGH', 1, '0919664854', NULL, '2022-10-11 07:01:31', NULL, '::1', NULL, NULL, NULL);

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
  `est_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_empresa_establecimiento`
--

INSERT INTO `dct_pos_tbl_empresa_establecimiento` (`est_id_empresa_establecimiento`, `emp_id_empresa`, `est_cod_establecimiento`, `est_nombre`, `est_direccion_emisor`, `est_es_matriz`, `est_estado`, `est_usuario_creacion`, `est_usuario_modificacion`, `est_fecha_creacion`, `est_fecha_modificacion`, `est_ip_creacion`, `est_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '', 'LA RIOJA', 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_empresa_punto_emision`
--

CREATE TABLE `dct_pos_tbl_empresa_punto_emision` (
  `epe_id_empresa_punto_emision` int(11) NOT NULL,
  `epe_id_empresa` int(11) NOT NULL,
  `epe_cod_punto_emision` int(11) NOT NULL,
  `epe_descripcion_punto_emisor` varchar(50) NOT NULL,
  `epe_estado` tinyint(1) NOT NULL,
  `epe_usuario_creacion` varchar(13) DEFAULT NULL,
  `epe_usuario_modificacion` varchar(13) DEFAULT NULL,
  `epe_fecha_creacion` timestamp NULL DEFAULT NULL,
  `epe_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `epe_ip_creacion` varchar(100) DEFAULT NULL,
  `epe_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_empresa_punto_emision`
--

INSERT INTO `dct_pos_tbl_empresa_punto_emision` (`epe_id_empresa_punto_emision`, `epe_id_empresa`, `epe_cod_punto_emision`, `epe_descripcion_punto_emisor`, `epe_estado`, `epe_usuario_creacion`, `epe_usuario_modificacion`, `epe_fecha_creacion`, `epe_fecha_modificacion`, `epe_ip_creacion`, `epe_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'CAJA 1', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `ser_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_empresa_serial`
--

INSERT INTO `dct_pos_tbl_empresa_serial` (`ser_id_empresa_serial`, `emp_id_empresa`, `ser_factura_serie`, `ser_factura_cod_num`, `ser_nota_credito_serie`, `ser_nota_credito_cod_num`, `ser_nota_debito_serie`, `ser_nota_debito_cod_num`, `ser_guia_remision_serie`, `ser_guia_remision_cod_num`, `ser_comp_ret_serie`, `ser_comp_ret_cod_num`, `ser_estado`, `ser_usuario_creacion`, `ser_usuario_modificacion`, `ser_fecha_creacion`, `ser_fecha_modificacion`, `ser_ip_creacion`, `ser_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 152, 154, 1266, 1, 1236, 1, 102, 1, 123, 1, 1, NULL, '0919664854', NULL, '2022-10-16 12:22:45', NULL, '::1', NULL, NULL),
(3, 2, 10, 1, 1266, 1, 1236, 1, 102, 1, 123, 1, 1, NULL, '0919664854', NULL, '2022-08-09 13:44:36', NULL, '::1', NULL, NULL);

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
  `fdt_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_factura_transaccion`
--

CREATE TABLE `dct_pos_tbl_factura_transaccion` (
  `ftr_id_factura_transaccion` int(11) NOT NULL,
  `emp_id_empresa` int(11) NOT NULL,
  `cli_id_cliente` int(11) DEFAULT NULL,
  `ftr_id_forma_pago` varchar(2) DEFAULT NULL,
  `ftr_fecha_emision` varchar(8) DEFAULT NULL,
  `ftr_tipo_comprobante` varchar(2) DEFAULT NULL,
  `ftr_ruc` varchar(13) DEFAULT NULL,
  `ftr_tipo_ambiente` varchar(1) DEFAULT NULL,
  `ftr_establecimiento` varchar(3) DEFAULT NULL,
  `ftr_punto_emision` varchar(3) DEFAULT NULL,
  `ftr_num_comprobante` varchar(9) DEFAULT NULL,
  `ftr_cod_numerico` varchar(8) DEFAULT NULL,
  `ftr_tipo_emision` varchar(1) DEFAULT NULL,
  `ftr_dig_verificador` varchar(1) DEFAULT NULL,
  `ftr_sri_clave_acceso` varchar(49) DEFAULT NULL,
  `ftr_fecha_autorizacion` date DEFAULT NULL,
  `ftr_estado_transaccion` varchar(3) NOT NULL,
  `ftr_cod_error` tinyint(4) DEFAULT NULL,
  `ftr_estado` tinyint(1) NOT NULL,
  `ftr_usuario_creacion` varchar(13) DEFAULT NULL,
  `ftr_usuario_modificacion` varchar(13) DEFAULT NULL,
  `ftr_fecha_creacion` timestamp NULL DEFAULT NULL,
  `ftr_fecha_modificacion` timestamp NULL DEFAULT NULL,
  `ftr_ip_creacion` varchar(100) DEFAULT NULL,
  `ftr_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_factura_transaccion`
--

INSERT INTO `dct_pos_tbl_factura_transaccion` (`ftr_id_factura_transaccion`, `emp_id_empresa`, `cli_id_cliente`, `ftr_id_forma_pago`, `ftr_fecha_emision`, `ftr_tipo_comprobante`, `ftr_ruc`, `ftr_tipo_ambiente`, `ftr_establecimiento`, `ftr_punto_emision`, `ftr_num_comprobante`, `ftr_cod_numerico`, `ftr_tipo_emision`, `ftr_dig_verificador`, `ftr_sri_clave_acceso`, `ftr_fecha_autorizacion`, `ftr_estado_transaccion`, `ftr_cod_error`, `ftr_estado`, `ftr_usuario_creacion`, `ftr_usuario_modificacion`, `ftr_fecha_creacion`, `ftr_fecha_modificacion`, `ftr_ip_creacion`, `ftr_ip_modificacion`, `created_at`, `updated_at`) VALUES
(38, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'TMP', NULL, 1, '0919664854', NULL, '2023-10-06 07:15:58', NULL, '127.0.0.1', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_impuesto`
--

CREATE TABLE `dct_pos_tbl_impuesto` (
  `imp_codigo` int(11) NOT NULL,
  `imp_impuesto` varchar(10) NOT NULL,
  `imp_descripcion` varchar(60) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_impuesto`
--

INSERT INTO `dct_pos_tbl_impuesto` (`imp_codigo`, `imp_impuesto`, `imp_descripcion`, `created_at`, `updated_at`) VALUES
(2, 'IVA', 'Impuesto al Valor Agregado', NULL, NULL),
(3, 'ICE', 'Impuesto a Consumos Especiales', NULL, NULL),
(5, 'IRBPNR', 'Impuesto Redimible Botellas Plásticas no Retornables', NULL, NULL);

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
  `prs_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_producto_servicio`
--

INSERT INTO `dct_pos_tbl_producto_servicio` (`prs_id_prod_serv`, `emp_id_empresa`, `prs_codigo_item`, `prs_codigo_auxiliar`, `prs_descripcion_item`, `prs_valor_unitario`, `prs_descuento`, `prs_iva_cod_impuesto`, `prs_iva_cod_tarifa`, `prs_iva_dif_porc`, `prs_ice_cod_impuesto`, `prs_ice_cod_tarifa`, `prs_irbpnr_cod_impuesto`, `prs_irbpnr_cod_tarifa`, `prs_det_nombre_1`, `prs_det_valor_1`, `prs_det_nombre_2`, `prs_det_valor_2`, `prs_det_nombre_3`, `prs_det_valor_3`, `prs_estado`, `prs_usuario_creacion`, `prs_usuario_modificacion`, `prs_fecha_creacion`, `prs_fecha_modificacion`, `prs_ip_creacion`, `prs_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 'C001', 'CNJ', 'ALQUILER DE HABITACION PERSONAL', 100, 0, 2, 8, 8, 0, 0, 0, 0, 'Tipo', 'Sinple con AC', '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'C002', 'BHY', 'CAMIONETA', 20000, 0, 2, 2, NULL, 0, 0, 0, 0, 'Tipo', '4V en B', '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'C003', 'NY45', 'PARACETAMOL', 0.25, 0, 2, 6, NULL, 0, 0, 0, 0, 'CONCENTRACION', '0.5mg', 'PRESENTACION', 'FRASCO', NULL, NULL, 1, NULL, '0919664854', NULL, '2022-10-05 11:57:05', NULL, '::1', NULL, NULL),
(4, 1, 'C004', 'NY469', 'BOTELLAS PLASTICAS', 0.1, 0, 2, 0, NULL, 0, 0, 0, 0, 'Tipo', 'Estandar', '', '', '', '', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_pos_tbl_tarifa_impuesto`
--

CREATE TABLE `dct_pos_tbl_tarifa_impuesto` (
  `imp_codigo` int(11) NOT NULL,
  `trf_codigo` int(11) NOT NULL,
  `trf_porcentaje` int(11) DEFAULT NULL,
  `trf_valor` double DEFAULT NULL,
  `trf_descripcion` varchar(250) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_tarifa_impuesto`
--

INSERT INTO `dct_pos_tbl_tarifa_impuesto` (`imp_codigo`, `trf_codigo`, `trf_porcentaje`, `trf_valor`, `trf_descripcion`, `created_at`, `updated_at`) VALUES
(2, 0, 0, NULL, '0%', NULL, NULL),
(2, 2, 12, NULL, '12%', NULL, NULL),
(2, 3, 14, NULL, '14%', NULL, NULL),
(2, 6, 0, NULL, 'No Objeto de impuesto', NULL, NULL),
(2, 7, 0, NULL, 'Exento de IVA', NULL, NULL),
(2, 8, NULL, NULL, 'IVA diferenciado', NULL, NULL),
(3, 3011, 14, NULL, 'ICE Cigarrillos Rubios', NULL, NULL),
(3, 3021, 16, NULL, 'ICE Cigarrillos Negros', NULL, NULL),
(3, 3023, 150, NULL, 'ICE Productos del Tabaco y Sucedáneos  del Tabaco excepto Cigarrillos', NULL, NULL),
(3, 3031, 75, NULL, 'ICE Bebidas Alcohólicas', NULL, NULL),
(3, 3033, 722, NULL, 'ICE Alcohol', NULL, NULL),
(3, 3041, 75, NULL, 'ICE Cerveza Industrial Gran Escala', NULL, NULL),
(3, 3043, 115, NULL, 'ICE Cerveza Artesanal', NULL, NULL),
(3, 3053, 18, NULL, 'ICE Bebidas Gaseosas con Alto Contenido de Azúcar', NULL, NULL),
(3, 3054, 10, NULL, 'ICE Bebidas Gaseosas con Bajo Contenido de Azúcar', NULL, NULL),
(3, 3073, 5, NULL, 'ICE Vehículos Motorizados cuyo PVP sea hasta de 20000 USD', NULL, NULL),
(3, 3075, 15, NULL, 'ICE Vehículos Motorizados PVP entre 30000 y 40000', NULL, NULL),
(3, 3077, 20, NULL, 'ICE  Vehículos  Motorizados  cuyo  PVP  superior  USD  40.000 hasta 50.000', NULL, NULL),
(3, 3078, 25, NULL, 'ICE  Vehículos  Motorizados  cuyo  PVP  superior  USD  50.000 hasta 60.000', NULL, NULL),
(3, 3079, 30, NULL, 'ICE  Vehículos  Motorizados  cuyo  PVP  superior  USD  60.000 hasta 70.000', NULL, NULL),
(3, 3080, 35, NULL, 'ICE Vehículos Motorizados cuyo PVP superior USD 70.000', NULL, NULL),
(3, 3081, 15, NULL, 'ICE Aviones, Tricares, yates, Barcos de Recreo', NULL, NULL),
(3, 3092, 15, NULL, 'ICE Servicios de Televisión Prepagada', NULL, NULL),
(3, 3093, 15, NULL, 'ICE Servicios Telefonía Sociedades', NULL, NULL),
(3, 3101, 10, NULL, 'ICE Bebidas Energizantes', NULL, NULL),
(3, 3111, 18, NULL, 'ICE Bebidas No Alcohólicas', NULL, NULL),
(3, 3532, 75, NULL, 'ICE IMPORT. ALCOHOL SENAE', NULL, NULL),
(3, 3533, 75, NULL, 'ICE Import. Bebidas Alcohólicas', NULL, NULL),
(3, 3541, 75, NULL, 'ICE Cerveza Gran Escala Cae', NULL, NULL),
(3, 3542, 16, NULL, 'ICE Cigarrillos Rubios Cae', NULL, NULL),
(3, 3543, 16, NULL, 'ICE Cigarrillos Negros Cae', NULL, NULL),
(3, 3544, 150, NULL, 'ICE Productos del Tabaco y Sucedáneos del Tabaco Excepto Cigarrillos Cae', NULL, NULL),
(3, 3545, 75, NULL, 'ICE CERVEZA ARTESANAL SENAE', NULL, NULL),
(3, 3552, 18, NULL, 'ICE   BEBIDAS   GASEOSAS   CON   ALTO   CONTENIDO   DE AZUCAR SENAE', NULL, NULL),
(3, 3553, 10, NULL, 'ICE   BEBIDAS   GASEOSAS   CON   BAJO   CONTENIDO   DE AZÚCAR SENAE', NULL, NULL),
(3, 3581, 15, NULL, 'ICE Aeronaves Cae', NULL, NULL),
(3, 3582, 15, NULL, 'ICE    Aviones,    Avionetas    y    Helicópteros    Exct.    Aquellos destinados Al Trans. Cae', NULL, NULL),
(3, 3601, 10, NULL, 'ICE Bebidas Energizantes SENAE', NULL, NULL),
(3, 3602, 18, NULL, 'ICE BEBIDAS NO ALCOHOLICAS SENAE', NULL, NULL),
(3, 3610, 20, NULL, 'ICE Perfumes y Aguas de Tocador', NULL, NULL),
(3, 3620, 35, NULL, 'ICE Videojuegos', NULL, NULL),
(3, 3630, 300, NULL, 'ICE Armas de Fuego, Armas deportivas y Municiones', NULL, NULL),
(3, 3640, 100, NULL, 'ICE Focos Incandescentes', NULL, NULL),
(3, 3660, 35, NULL, 'ICE Cuotas Membresías Afiliaciones Acciones', NULL, NULL),
(3, 3671, 100, NULL, 'ICE  CALEFONES  Y  SISTEMAS  DE  CALENTAMIENTO  DE AGUA A GAS SRI', NULL, NULL),
(3, 3680, 4, NULL, 'ICE FUNDAS PLÁSTICAS', NULL, NULL),
(3, 3681, 10, NULL, 'ICE    SERVICIOS    DE    TELEFONÍA    MÓVIL    PERSONAS NATURALES', NULL, NULL),
(3, 3682, 150, NULL, 'ICE   CONSUMIBLES   TABACO   CALENTADO   Y   LIQUIDOS CON NICOTINA SRI', NULL, NULL),
(3, 3683, 150, NULL, 'ICE   CONSUMIBLES   TABACO   CALENTADO   Y   LIQUIDOS CON NICOTINA SENAE', NULL, NULL),
(3, 3684, 5, NULL, 'ICE   VEHÍCULOS   MOTORIZADOS    CAMIONETAS   Y   DE RESCATE CUYO PVP SEA HASTA DE 30.000 USD', NULL, NULL),
(3, 3685, 5, NULL, 'ICE   VEHÍCULOS   MOTORIZADOS    CAMIONETAS   Y  DE RESCATE PVP SEA HASTA DE 30.000 USD SENAE', NULL, NULL),
(3, 3686, 10, NULL, 'ICE VEHÍCULOS MOTORIZADOS EXCEPTO CAMIONETAS Y DE   RESCATE   CUYO   PVP   SEA   SUPERIOR   USD   20.000 HASTA DE 30.000', NULL, NULL),
(3, 3687, 10, NULL, 'ICE VEHÍCULOS MOTORIZADOS EXCEPTO CAMIONETAS Y DE   RESCATE   CUYO   PVP   SEA   SUPERIOR   USD   20.000\nHASTA DE 30.000 SENAE', NULL, NULL),
(3, 3688, 0, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SEA  DE  HASTA USD. 35.000', NULL, NULL),
(3, 3689, 0, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SEA  DE  HASTA USD. 35.000 SENAE', NULL, NULL),
(3, 3690, 8, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n35.000 HASTA 40.000 SENAE', NULL, NULL),
(3, 3691, 8, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n35.000 HASTA 40.000', NULL, NULL),
(3, 3692, 14, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n40.000 HASTA 50.000', NULL, NULL),
(3, 3693, 14, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n40.000 HASTA 50.000 SENAE', NULL, NULL),
(3, 3694, 20, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n50.000 HASTA 60.000 SENAE', NULL, NULL),
(3, 3695, 20, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n50.000 HASTA 60.000', NULL, NULL),
(3, 3696, 26, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n60.000 HASTA 70.000', NULL, NULL),
(3, 3697, 26, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  USD.\n60.000 HASTA 70.000 SENAE', NULL, NULL),
(3, 3698, 32, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  A  USD 70.000', NULL, NULL),
(3, 3699, 32, NULL, 'ICE  VEHÍCULOS  HÍBRIDOS  CUYO  PVP  SUPERIOR  A  USD\n70.000 SENAE', NULL, NULL),
(3, 3710, 20, NULL, 'ICE Perfumes Aguas de Tocador Cae', NULL, NULL),
(3, 3720, 35, NULL, 'ICE Video Juegos Cae', NULL, NULL),
(3, 3730, 300, NULL, 'ICE   Importaciones   Armas   de   Fuego,   Armas   deportivas   y Municiones Cae', NULL, NULL),
(3, 3740, 100, NULL, 'ICE Focos Incandecentes Cae', NULL, NULL),
(3, 3771, 100, NULL, 'ICE  CALEFONES  Y  SISTEMAS  DE  CALENTAMIENTO  DE AGUA A GAS SENAE', NULL, NULL),
(3, 3871, 5, NULL, 'ICE-VEHÍCULOS  MOTORIZADOS  CUYO  PVP  SEA  HASTA DE 20000 USD SENAE', NULL, NULL),
(3, 3873, 15, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   PVP   ENTRE   30000   Y 40000 SENAE', NULL, NULL),
(3, 3874, 20, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 40.000 HASTA 50.000 SENAE', NULL, NULL),
(3, 3875, 25, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 50.000 HASTA 60.000 SENAE', NULL, NULL),
(3, 3876, 30, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 60.000 HASTA 70.000 SENAE', NULL, NULL),
(3, 3877, 35, NULL, 'ICE-VEHÍCULOS   MOTORIZADOS   CUYO   PVP   SUPERIOR USD 70.000 SENAE', NULL, NULL),
(3, 3878, 15, NULL, 'ICE-Aviones, Tricares, Yates, Barcos De Rec SENAE', NULL, NULL),
(5, 1, NULL, 0.02, 'Impuesto Redimible Botellas Plásticas no Retornables', NULL, NULL);

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
  `uep_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_usuario_est_pun_emi`
--

INSERT INTO `dct_pos_tbl_usuario_est_pun_emi` (`uep_id_usuario_epe`, `usr_cod_usuario`, `est_id_empresa_establecimiento`, `epe_id_empresa_punto_emision`, `uep_estado`, `uep_usuario_creacion`, `uep_usuario_modificacion`, `uep_fecha_creacion`, `uep_fecha_modificacion`, `uep_ip_creacion`, `uep_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, '0919664854', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `wsr_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_pos_tbl_ws_sri`
--

INSERT INTO `dct_pos_tbl_ws_sri` (`wsr_id_ws_sri`, `wsr_tipo_ambiente`, `wsr_descripcion`, `wsr_url_1`, `wsr_url_2`, `wsr_estado`, `wsr_usuario_creacion`, `wsr_usuario_modificacion`, `wsr_fecha_creacion`, `wsr_fecha_modificacion`, `wsr_ip_creacion`, `wsr_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 'RECEPCION', 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.recepcion', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'AUTORIZACION', 'https://celcer.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.autorizacion', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'RECEPCION', 'https://cel.sri.gob.ec/comprobantes-electronicos-ws/RecepcionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.recepcion', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'AUTORIZACION', 'https://cel.sri.gob.ec/comprobantes-electronicos-ws/AutorizacionComprobantesOffline?wsdl', 'http://ec.gob.sri.ws.autorizacion', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `apl_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_aplicacion`
--

INSERT INTO `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`, `apl_aplicacion`, `apl_ruta`, `apl_estado`, `apl_nom_superior`, `apl_nom_inferior`, `apl_id_htm`, `apl_id_imagen`, `apl_usuario_creacion`, `apl_usuario_modificacion`, `apl_fecha_creacion`, `apl_fecha_modificacion`, `apl_ip_creacion`, `apl_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 'Administración', '../../../webAdministracion', 1, 'Administración', 'Web', 'indexLinkTics', 'fa fa-laptop', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'POS', '../../../webPosOperaciones', 1, 'POS', 'Operacionoes', 'indexLinkFacturacion', 'fa fa-laptop', NULL, '0919664854', NULL, '2023-10-03 22:56:52', NULL, '127.0.0.1', NULL, '2023-10-03 22:56:52'),
(3, 'Salud', '../../../webSalud', 1, 'POS', 'Operacionoes', 'indexLinkSalud', 'fa fa-laptop', NULL, '0919664854', NULL, '2022-07-29 07:20:48', NULL, '::1', NULL, NULL);

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
  `ape_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_aplicacion_empresa`
--

INSERT INTO `dct_sistema_tbl_aplicacion_empresa` (`ape_id_aplicacion`, `ape_id_empresa`, `ape_estado`, `ape_usuario_creacion`, `ape_usuario_modificacion`, `ape_fecha_creacion`, `ape_fecha_modificacion`, `ape_ip_creacion`, `ape_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0919664854', NULL, '2023-10-05 02:25:05', NULL, NULL, NULL, NULL, NULL),
(2, 1, 1, '0919664854', NULL, '2022-07-31 11:54:45', NULL, '::1', NULL, NULL, NULL),
(3, 1, 1, '0919664854', NULL, '2023-10-03 07:16:09', NULL, '127.0.0.1', NULL, '2023-10-03 07:16:09', '2023-10-03 07:16:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_catalogo`
--

CREATE TABLE `dct_sistema_tbl_catalogo` (
  `ctg_id_catalogo` int(11) NOT NULL,
  `ctg_tipo` varchar(5) NOT NULL,
  `ctg_key` varchar(5) NOT NULL,
  `ctg_descripcion` varchar(40) NOT NULL,
  `ctg_estado` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_catalogo`
--

INSERT INTO `dct_sistema_tbl_catalogo` (`ctg_id_catalogo`, `ctg_tipo`, `ctg_key`, `ctg_descripcion`, `ctg_estado`, `created_at`, `updated_at`) VALUES
(5, 'POS', 'INDEF', 'FACTURACION INDEFINIDA', 1, NULL, NULL),
(7, 'POS', 'LM20', 'FACTURACION LIMITADA 20', 1, NULL, NULL),
(8, 'POS', 'LM50', 'FACTURACION LIMITADA 50', 1, NULL, NULL),
(9, 'POS', 'LM100', 'FACTURACION LIMITADA 100', 1, NULL, NULL),
(10, 'POS', 'LM150', 'FACTURACION LIMITADA 150', 1, NULL, NULL),
(11, 'POS', 'LM200', 'FACTURACION LIMITADA 200', 1, NULL, NULL),
(12, 'POS', 'STAND', 'ESTANDAR', 1, NULL, NULL),
(13, 'IDEN', '04', 'RUC', 1, NULL, NULL),
(14, 'IDEN', '05', 'CEDULA', 1, NULL, NULL),
(15, 'IDEN', '06', 'PASAPORTE', 1, NULL, NULL),
(16, 'IDEN', '07', 'CONSUMIDOR FINAL', 0, NULL, NULL),
(17, 'IDEN', '08', 'IDENTIFICACION DEL EXTERIOR', 1, NULL, NULL),
(18, 'PAGO', '01', 'SIN UTILIZACION DEL SISTEMA FINANCIERO', 0, NULL, NULL),
(19, 'PAGO', '15', 'COMPENSACIÓN DE DEUDAS', 0, NULL, NULL),
(20, 'PAGO', '16', 'TARJETA DE DÉBITO', 1, NULL, NULL),
(21, 'PAGO', '17', 'DINERO ELECTRÓNICO', 0, NULL, NULL),
(22, 'PAGO', '18', 'TARJETA PREPAGO', 0, NULL, NULL),
(23, 'PAGO', '19', 'TARJETA DE CRÉDITO', 1, NULL, NULL),
(24, 'PAGO', '20', 'OTROS CON UTILIZACIÓN DEL SISTEMA FINANC', 1, NULL, NULL),
(25, 'PAGO', '21', 'ENDOSO DE TÍTULOS', 0, NULL, NULL);

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
  `cts_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `emp_contrib_especial` tinyint(4) DEFAULT NULL,
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
  `em_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_empresa`
--

INSERT INTO `dct_sistema_tbl_empresa` (`emp_id_empresa`, `emp_ruc`, `emp_empresa`, `emp_nom_comercial`, `emp_direccion_matriz`, `emp_contrib_especial`, `emp_obli_contabilidad`, `em_logo`, `wsr_tipo_ambiente`, `em_tipo_emision`, `emp_estado`, `emp_vigencia_desde`, `emp_vigencia_hasta`, `em_archivo_fact_elec`, `em_pass_fct_elec`, `ctg_id_catalogo`, `em_usuario_creacion`, `em_usuario_modificacion`, `em_fecha_creacion`, `em_fecha_modificacion`, `em_ip_creacion`, `em_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, '0919664854001', 'DRECONSTEC', 'DRECONSTEC', 'LA RIOJA', 1, 0, '0919664854001.png', 1, 1, 1, '2022-07-25', '2050-07-20', '0919664854001.p12', 'Maruto1984', 5, NULL, '0919664854', NULL, '2023-10-04 05:38:22', NULL, '127.0.0.1', NULL, '2023-10-04 05:38:22');

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
  `opc_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_opcion`
--

INSERT INTO `dct_sistema_tbl_opcion` (`opc_id_opcion`, `opc_opcion`, `opc_estado`, `opc_ruta`, `opc_id_aplicacion`, `opc_orden`, `opc_usuario_creacion`, `opc_usuario_modificacion`, `opc_fecha_creacion`, `opc_fecha_modificacion`, `opc_ip_creacion`, `opc_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 'Panel Principal', 1, 'dashboard', 1, 1, NULL, '0919664854', NULL, '2022-07-29 06:05:06', NULL, '::1', NULL, NULL),
(2, 'Usuarios', 1, 'administrarUsuarios.index', 1, 2, NULL, '0919664854', NULL, '2023-10-03 22:57:08', NULL, '127.0.0.1', NULL, '2023-10-03 22:57:08'),
(3, 'Accesos', 1, 'administrarAccesos.index', 1, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Facturación', 1, 'posFacturacion.index', 2, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Administración', 1, 'posAdministracionPOS.index', 2, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'Clientes', 1, 'posClientes.index', 2, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'Fidelización', 1, 'posFidelizacion.index', 2, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 'Registro FirmaEC', 1, 'posFirmaEC.index', 2, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Reporte Transacciones', 1, 'posReportes.index', 2, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Transacciones', 1, 'posTransacciones.index', 2, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'SMS WhatsApp', 1, 'envio_SMS_WS.index', 1, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 'Administración', 1, 'saludAdministracionSalud.index', 3, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 'Vademecum', 1, 'saludVademecum.index', 3, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'Historia Clínica', 1, 'saludHistoriaClinica.index', 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 'Paciente', 1, 'saludPaciente.index', 3, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 'Consulta Enfermería', 1, 'saludConsultaEnfermeria.index', 3, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Consulta Médica', 1, 'saludConsultaMedica.index', 3, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 'Estadística', 1, 'saludEstadistica.index', 3, 7, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 'Reportes', 1, 'saludReportes.index', 3, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

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
  `rol_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol`
--

INSERT INTO `dct_sistema_tbl_rol` (`rol_id_rol`, `rol_rol`, `rol_estado`, `rol_usuario_creacion`, `rol_usuario_modificacion`, `rol_fecha_creacion`, `rol_fecha_modificacion`, `rol_ip_creacion`, `rol_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 'Developer', 1, '0919664854', '0919664854', '2023-10-04 22:53:25', '2022-07-29 00:50:22', '::1', '::1', NULL, NULL),
(2, 'POS - Administración', 1, '0919664854', '0919664854', '2022-07-29 00:51:07', '2022-07-29 07:21:22', '::1', '::1', NULL, NULL),
(3, 'POS - Ventas', 1, '0919664854', '0919664854', '2022-07-29 00:51:07', '2022-07-29 07:21:22', '::1', '::1', NULL, NULL),
(4, 'POS - Reporte', 1, '0919664854', '0919664854', '2022-07-29 00:51:07', '2022-07-29 07:21:22', '::1', '::1', NULL, NULL),
(5, 'Salud - Administración', 1, '0919664854', '0919664854', '2022-07-29 00:51:07', '2022-07-29 07:21:22', '::1', '::1', NULL, NULL),
(6, 'Salud - Enfermería', 1, '0919664854', '0919664854', '2022-07-29 00:51:07', '2022-07-29 07:21:22', '::1', '::1', NULL, NULL),
(7, 'Salud - Médicos', 1, '0919664854', '0919664854', '2022-07-29 00:51:07', '2022-07-29 07:21:22', '::1', '::1', NULL, NULL);

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
  `rla_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol_aplicacion`
--

INSERT INTO `dct_sistema_tbl_rol_aplicacion` (`rla_id_rol`, `rla_id_aplicacion`, `rla_estado`, `rla_usuario_creacion`, `rla_usuario_modificacion`, `rla_fecha_creacion`, `rla_fecha_modificacion`, `rla_ip_creacion`, `rla_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0919664854', NULL, '2023-10-05 02:24:37', NULL, NULL, NULL, NULL, NULL),
(1, 2, 1, '0919664854', '0919664854', '2023-10-05 02:24:32', '2023-10-04 22:42:48', NULL, '127.0.0.1', NULL, '2023-10-04 22:42:48'),
(1, 3, 1, '0919664854', NULL, '2023-10-05 07:12:57', NULL, '127.0.0.1', NULL, '2023-10-05 07:12:57', '2023-10-05 07:12:57');

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
  `rlo_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol_opcion`
--

INSERT INTO `dct_sistema_tbl_rol_opcion` (`rlo_id_rol`, `rlo_id_opcion`, `rlo_estado`, `rlo_usuario_creacion`, `rlo_usuario_modificacion`, `rlo_fecha_creacion`, `rlo_fecha_modificacion`, `rlo_ip_creacion`, `rlo_ip_modificacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '0919664854', '0919664854', '2023-09-27 23:37:25', '2022-07-29 07:18:15', NULL, '::1', NULL, NULL),
(1, 2, 1, '0919664854', NULL, '2023-09-27 23:37:29', NULL, NULL, NULL, NULL, NULL),
(1, 3, 1, '0919664854', NULL, '2023-09-27 23:37:34', NULL, NULL, NULL, NULL, NULL),
(1, 4, 1, '0919664854', NULL, '2023-10-04 07:02:03', NULL, '127.0.0.1', NULL, '2023-10-04 07:02:03', '2023-10-04 07:02:03'),
(1, 5, 1, '0919664854', NULL, '2023-10-04 07:01:41', NULL, '127.0.0.1', NULL, '2023-10-04 07:01:41', '2023-10-04 07:01:41'),
(1, 6, 1, '0919664854', NULL, '2023-10-04 07:01:55', NULL, '127.0.0.1', NULL, '2023-10-04 07:01:55', '2023-10-04 07:01:55'),
(1, 7, 1, '0919664854', NULL, '2023-10-04 07:02:07', NULL, '127.0.0.1', NULL, '2023-10-04 07:02:07', '2023-10-04 07:02:07'),
(1, 8, 1, '0919664854', NULL, '2023-10-04 07:02:12', NULL, '127.0.0.1', NULL, '2023-10-04 07:02:12', '2023-10-04 07:02:12'),
(1, 9, 1, '0919664854', NULL, '2023-10-05 07:14:01', NULL, '127.0.0.1', NULL, '2023-10-05 07:14:01', '2023-10-05 07:14:01'),
(1, 10, 1, '0919664854', NULL, '2023-10-05 07:13:31', NULL, '127.0.0.1', NULL, '2023-10-05 07:13:31', '2023-10-05 07:13:31'),
(1, 11, 1, '0919664854', NULL, '2023-10-05 07:13:57', NULL, '127.0.0.1', NULL, '2023-10-05 07:13:57', '2023-10-05 07:13:57'),
(1, 12, 1, '0919664854', NULL, '2023-10-05 02:36:14', NULL, '127.0.0.1', NULL, '2023-10-05 02:36:14', '2023-10-05 02:36:14'),
(1, 13, 1, '0919664854', NULL, '2023-10-05 02:36:51', NULL, '127.0.0.1', NULL, '2023-10-05 02:36:51', '2023-10-05 02:36:51'),
(1, 14, 1, '0919664854', NULL, '2023-10-05 02:36:35', NULL, '127.0.0.1', NULL, '2023-10-05 02:36:35', '2023-10-05 02:36:35'),
(1, 15, 1, '0919664854', NULL, '2023-10-05 02:36:42', NULL, '127.0.0.1', NULL, '2023-10-05 02:36:42', '2023-10-05 02:36:42'),
(1, 16, 1, '0919664854', NULL, '2023-10-05 02:36:20', NULL, '127.0.0.1', NULL, '2023-10-05 02:36:20', '2023-10-05 02:36:20'),
(1, 17, 1, '0919664854', NULL, '2023-10-05 02:36:25', NULL, '127.0.0.1', NULL, '2023-10-05 02:36:25', '2023-10-05 02:36:25'),
(1, 18, 1, '0919664854', NULL, '2023-10-05 02:36:25', NULL, '127.0.0.1', NULL, '2023-10-05 02:36:25', '2023-10-05 02:36:25'),
(1, 19, 1, '0919664854', NULL, '2023-10-05 07:14:06', NULL, '127.0.0.1', NULL, '2023-10-05 07:14:06', '2023-10-05 07:14:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_token`
--

CREATE TABLE `dct_sistema_tbl_token` (
  `tok_id_token` int(11) NOT NULL,
  `tok_token` varchar(150) DEFAULT NULL,
  `tok_tipo` varchar(10) DEFAULT NULL,
  `tok_cedula` varchar(13) DEFAULT NULL,
  `tok_estado` tinyint(1) DEFAULT NULL,
  `tok_ip_creacion` varchar(100) DEFAULT NULL,
  `tok_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_token`
--

INSERT INTO `dct_sistema_tbl_token` (`tok_id_token`, `tok_token`, `tok_tipo`, `tok_cedula`, `tok_estado`, `tok_ip_creacion`, `tok_ip_modificacion`, `created_at`, `updated_at`) VALUES
(38, 'df11d6a9dd6e3d8ac4b8176ff2d5e5ac', 'ACTIVACION', '1308041134', 0, '127.0.0.1', '127.0.0.1', '2023-09-19 05:43:46', '2023-09-19 05:44:19'),
(39, '16d5cbb71625c0b96969df2c597ef562', 'ACTIVACION', '45677686788', 0, '127.0.0.1', '127.0.0.1', '2023-09-29 04:36:12', '2023-09-29 07:12:38');

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
  `usr_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_usuario`
--

INSERT INTO `dct_sistema_tbl_usuario` (`usr_cod_usuario`, `usr_nombre_1`, `usr_nombre_2`, `usr_apellido_1`, `usr_apellido_2`, `usr_logeado`, `usr_estado`, `usr_ip_pc_acceso`, `usr_fecha_acceso`, `usr_correo`, `usr_estado_correo`, `usr_id_rol`, `usr_estado_contrasenia`, `usr_id_empresa`, `usr_fecha_cambio_contrasenia`, `usr_contador_error_contrasenia`, `usr_expiro_contrasenia`, `usr_ultimo_acceso`, `usr_usuario_creacion`, `usr_usuario_modificacion`, `usr_fecha_creacion`, `usr_fecha_modificacion`, `usr_ip_creacion`, `usr_ip_modificacion`, `created_at`, `updated_at`) VALUES
('0919664854', 'MAURO', 'VINICIO', 'ECHEVERRIA', 'CHUGULI', 1, 1, '127.0.0.1', '2023-02-01 09:43:32', 'maurovinicio.echeverria@gmail.com', 1, 1, 1, 1, '2023-01-01', 0, 0, '2023-01-31', '0919664854', '0919664854', NULL, NULL, 'DESKTOP-5L9FRDR', 'DESKTOP-5L9FRDR', NULL, NULL);

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
  `usr_ip_modificacion` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_usuario_adicional`
--

INSERT INTO `dct_sistema_tbl_usuario_adicional` (`usr_cod_usuario`, `adi_fecha_nacimiento`, `adi_sexo`, `adi_estado_civil`, `adi_instruccion`, `adi_tipo_sangre`, `adi_celular`, `adi_provincia`, `adi_canton`, `adi_parroquia`, `adi_direccion`, `adi_referencia`, `usr_usuario_creacion`, `usr_usuario_modificacion`, `usr_fecha_creacion`, `usr_fecha_modificacion`, `usr_ip_creacion`, `usr_ip_modificacion`, `created_at`, `updated_at`) VALUES
('0919664854', '1984-08-22', 'MASCULINO', 'CASADO/A', 'SUPERIOR', 'O +', '593960939030', 'PR_09', 'CN_0901', 'PQ_090114', 'LOS ESTEROS POPULAR', 'EN EL PARQUEO DE LA ESCUELS ROBERTO GILBERT', '0919664854', '0919664854', '2022-07-25 18:20:27', '2022-07-28 14:39:57', '::1', '::1', NULL, NULL);

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
  `valor_irbpnr` decimal(10,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_factura_electronica`
--

INSERT INTO `detalle_factura_electronica` (`id_tabla`, `orden_no`, `cantidad`, `item`, `precio_u`, `total`, `iva`, `ice`, `irbpnr`, `codigo_ice`, `codigoPorcentaje_ice`, `baseImponible_ice`, `tarifa_ice`, `valor_ice`, `codigo_irbpnr`, `codigoPorcentaje_irbpnr`, `tarifa_irbpnr`, `baseImponible_irbpnr`, `valor_irbpnr`, `created_at`, `updated_at`) VALUES
(25, 1, 2, 'Pulpa de COCO', 3.37, 6.74, 0, 0, 0, '3', '0', 0.00, 5.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL),
(26, 1, 900, 'Pulpa de NARANJILLA CMP', 0.25, 225.00, 0, 0, 0, '3', '0', 0.00, 0.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL),
(27, 1, 1600, 'Pulpa de GUANABANA CMP', 0.31, 496.00, 0, 0, 0, '3', '0', 0.00, 5.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL),
(28, 1, 1600, 'Pulpa de MORA CAMP', 0.27, 432.00, 0, 0, 0, '3', '0', 0.00, 0.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL),
(25, 1, 2, 'Pulpa de COCO', 3.37, 6.74, 0, 0, 0, '3', '0', 0.00, 5.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL),
(26, 1, 900, 'Pulpa de NARANJILLA CMP', 0.25, 225.00, 0, 0, 0, '3', '0', 0.00, 0.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL),
(27, 1, 1600, 'Pulpa de GUANABANA CMP', 0.31, 496.00, 0, 0, 0, '3', '0', 0.00, 5.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL),
(28, 1, 1600, 'Pulpa de MORA CAMP', 0.27, 432.00, 0, 0, 0, '3', '0', 0.00, 0.00, 0.00, '5', '0', 5.00, 5.00, 5.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_guia_electronica`
--

CREATE TABLE `detalle_guia_electronica` (
  `orden_no` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `unidad` varchar(50) NOT NULL,
  `productos` varchar(50) NOT NULL,
  `id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_guia_electronica`
--

INSERT INTO `detalle_guia_electronica` (`orden_no`, `cantidad`, `unidad`, `productos`, `id`, `created_at`, `updated_at`) VALUES
(1, 1, '1', '1', 1, NULL, NULL);

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
  `total` decimal(19,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_nota_electronica`
--

INSERT INTO `detalle_nota_electronica` (`id_tabla`, `nota_no`, `cantidad`, `item`, `precio_u`, `total`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 11.0000, 11.0000, NULL, NULL),
(3, 2, 1, '1', 11.0000, 11.0000, NULL, NULL),
(1, 1, 1, '1', 11.0000, 11.0000, NULL, NULL),
(3, 2, 1, '1', 11.0000, 11.0000, NULL, NULL);

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
  `impuesto` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_retencion_electronica`
--

INSERT INTO `detalle_retencion_electronica` (`id`, `orden_no`, `codigo`, `codigo_retencion`, `base_imponible`, `porcentaje_retencion`, `valor_retenido`, `tipo_comprobante`, `impuesto`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 332, 3280.0000, 0, 0.0000, '01', '100', NULL, NULL),
(1, 1, 1, 332, 3280.0000, 0, 0.0000, '01', '100', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_05_16_200657_add_two_factor_columns_to_users_table', 1),
(5, '2024_05_16_200735_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('CPoCInu2rSB8M4LoToCU9aNMqlCnWog1Ek3UPFMO', NULL, '127.0.0.1', 'PostmanRuntime/7.36.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVG1PZ0J0MDlsQlo0Wjc4RUc1dmxEeFBJRUxkbUlYNldlRWI1b0h4diI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXN0ZW1hL2FkbWluaXN0cmFyVXN1YXJpb3MvcHJvY2Vzb18xIjt9fQ==', 1715955627),
('epK3JEnduJJEge1rC5M0sonnST7fpUkTRpJtG5tG', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiVGJsNHJHMDhJREh4bG9aRGp6bGxkZ3g3Q3ZiRFp4RUJVSlp6RUNXTiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9zaXN0ZW1hL2FkbWluaXN0cmFyQWNjZXNvcyI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTIkMGFCZVVDdWx6V2NHVzN3V2ZOZmNrdXA1UFVQWWxvSC9lZVVadG9ZVkx0U3B0SWtWckhJRE8iO30=', 1715962914);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `two_factor_secret` text DEFAULT NULL,
  `two_factor_recovery_codes` text DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `current_team_id` bigint(20) UNSIGNED DEFAULT NULL,
  `profile_photo_path` varchar(2048) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`) VALUES
(1, 'Mauro Vinicio Echeverría Chugulí', 'maurovinicio.echeverria@gmail.com', NULL, '$2y$12$0aBeUCulzWcGW3wWfNfckup5PUPYloH/eeUZtoYVLtSptIkVrHIDO', NULL, NULL, NULL, NULL, NULL, NULL, '2024-05-17 01:13:24', '2024-05-17 17:40:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indices de la tabla `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

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
  ADD PRIMARY KEY (`emp_id_empresa`),
  ADD UNIQUE KEY `emp_ruc` (`emp_ruc`);

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
  ADD PRIMARY KEY (`rla_id_rol`,`rla_id_aplicacion`) USING BTREE;

--
-- Indices de la tabla `dct_sistema_tbl_rol_opcion`
--
ALTER TABLE `dct_sistema_tbl_rol_opcion`
  ADD PRIMARY KEY (`rlo_id_rol`,`rlo_id_opcion`) USING BTREE;

--
-- Indices de la tabla `dct_sistema_tbl_token`
--
ALTER TABLE `dct_sistema_tbl_token`
  ADD PRIMARY KEY (`tok_id_token`),
  ADD UNIQUE KEY `tok_token` (`tok_token`);

--
-- Indices de la tabla `dct_sistema_tbl_usuario`
--
ALTER TABLE `dct_sistema_tbl_usuario`
  ADD PRIMARY KEY (`usr_cod_usuario`),
  ADD UNIQUE KEY `usr_correo` (`usr_correo`);

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
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indices de la tabla `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

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
  MODIFY `ser_id_empresa_serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_factura_detalle`
--
ALTER TABLE `dct_pos_tbl_factura_detalle`
  MODIFY `fdt_id_factura_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT de la tabla `dct_pos_tbl_factura_transaccion`
--
ALTER TABLE `dct_pos_tbl_factura_transaccion`
  MODIFY `ftr_id_factura_transaccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

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
  MODIFY `apl_id_aplicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `emp_id_empresa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_opcion`
--
ALTER TABLE `dct_sistema_tbl_opcion`
  MODIFY `opc_id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_rol`
--
ALTER TABLE `dct_sistema_tbl_rol`
  MODIFY `rol_id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_token`
--
ALTER TABLE `dct_sistema_tbl_token`
  MODIFY `tok_id_token` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
