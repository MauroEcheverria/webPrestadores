-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-02-2022 a las 22:49:00
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `prestadores_iess`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_aplicacion`
--

CREATE TABLE `dct_sistema_tbl_aplicacion` (
  `apl_id_aplicacion` int(11) NOT NULL,
  `apl_aplicacion` varchar(20) NOT NULL,
  `apl_ruta` varchar(100) NOT NULL,
  `apl_estado` varchar(1) NOT NULL,
  `apl_nom_superior` varchar(40) NOT NULL,
  `apl_nom_inferior` varchar(40) NOT NULL,
  `apl_id_htm` varchar(20) NOT NULL,
  `apl_id_imagen` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_aplicacion`
--

INSERT INTO `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`, `apl_aplicacion`, `apl_ruta`, `apl_estado`, `apl_nom_superior`, `apl_nom_inferior`, `apl_id_htm`, `apl_id_imagen`) VALUES
(1, 'Sistema', '../../../webMain', 'A', 'Sistemas', 'Loco', 'indexLinkTics', 'fa fa-laptop'),
(2, 'Facturación', '../../../webFacturacion', 'A', 'Facturación', 'Web', 'indexLinkFacturacion', 'fa fa-laptop'),
(3, 'Salud', '../../../webSalud', 'A', 'Salud', 'Web', 'indexLinkSalud', 'fa fa-laptop');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_aplicacion_empresa`
--

CREATE TABLE `dct_sistema_tbl_aplicacion_empresa` (
  `ape_id_aplicacion` int(11) NOT NULL,
  `ape_id_empresa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_aplicacion_empresa`
--

INSERT INTO `dct_sistema_tbl_aplicacion_empresa` (`ape_id_aplicacion`, `ape_id_empresa`) VALUES
(1, 1),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_catalogo`
--

CREATE TABLE `dct_sistema_tbl_catalogo` (
  `ctg_id_catalogo` int(11) NOT NULL,
  `ctg_key` varchar(2) NOT NULL,
  `ctg_descripcion` varchar(20) NOT NULL,
  `ctg_aplicativo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_catalogo`
--

INSERT INTO `dct_sistema_tbl_catalogo` (`ctg_id_catalogo`, `ctg_key`, `ctg_descripcion`, `ctg_aplicativo`) VALUES
(1, 'S', 'SI', 'SISTEMA'),
(2, 'N', 'NO', 'SISTEMA'),
(3, 'A', 'ACTIVO', 'SISTEMA'),
(4, 'I', 'INACTIVO', 'SISTEMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_contrasenia`
--

CREATE TABLE `dct_sistema_tbl_contrasenia` (
  `cts_id_contrasenia` bigint(20) NOT NULL,
  `cts_contrasenia` varchar(150) NOT NULL,
  `cts_cod_usuario` varchar(13) NOT NULL,
  `cts_fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `cts_estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_contrasenia`
--

INSERT INTO `dct_sistema_tbl_contrasenia` (`cts_id_contrasenia`, `cts_contrasenia`, `cts_cod_usuario`, `cts_fecha_cambio`, `cts_estado`) VALUES
(22, 'dFoxdnY4cjZ0d1BFNWRBZmxUL1ZLUW9QaWRUalJQZEU4SWFPQVNuS1ovRXNOYzlGMURSVFJuRGVNVHZ6ajBtRQ==', '1234567891', '2022-01-09 20:17:46', 'I'),
(23, 'QWJkeEVnd0NTZ2k0Y2QybkhwVG9MeTBCVnJzUjk4OHd6L1NRWUk1TS9xUjVUeGZ1U0pTQk5pZXhrb2huVFB0TA==', '1234567891', '2022-01-09 20:17:46', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_empresa`
--

CREATE TABLE `dct_sistema_tbl_empresa` (
  `emp_id_empresa` int(11) NOT NULL,
  `emp_empresa` varchar(80) NOT NULL,
  `emp_ruc` varchar(13) NOT NULL,
  `emp_estado` varchar(1) NOT NULL,
  `emp_vigencia_desde` date DEFAULT NULL,
  `emp_vigencia_hasta` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_empresa`
--

INSERT INTO `dct_sistema_tbl_empresa` (`emp_id_empresa`, `emp_empresa`, `emp_ruc`, `emp_estado`, `emp_vigencia_desde`, `emp_vigencia_hasta`) VALUES
(1, 'Dreconstec', '0919664854001', 'A', '2022-02-08', '2022-02-28'),
(2, 'Odontocenter Salud', '0264650623001', 'A', '2022-02-08', '2022-02-28'),
(3, 'Medical Factura', '0264781245001', 'A', '2022-02-08', '2022-02-28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_opcion`
--

CREATE TABLE `dct_sistema_tbl_opcion` (
  `opc_id_opcion` int(11) NOT NULL,
  `opc_opcion` varchar(40) NOT NULL,
  `opc_estado` varchar(1) NOT NULL,
  `opc_ruta` varchar(50) NOT NULL,
  `opc_id_aplicacion` int(11) NOT NULL,
  `opc_orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_opcion`
--

INSERT INTO `dct_sistema_tbl_opcion` (`opc_id_opcion`, `opc_opcion`, `opc_estado`, `opc_ruta`, `opc_id_aplicacion`, `opc_orden`) VALUES
(1, 'Bienvenido', 'A', '/pages/bienvenido', 1, 1),
(2, 'Administrar Usuarios', 'A', '/pages/administrarUsuarios', 1, 2),
(3, 'Administrar Roles', 'A', '/pages/administrarRoles', 1, 3),
(4, 'Administrar Perfíl', 'A', '/pages/administrarPerfil', 1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_rol`
--

CREATE TABLE `dct_sistema_tbl_rol` (
  `rol_id_rol` int(11) NOT NULL,
  `rol_rol` varchar(30) NOT NULL,
  `rol_estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol`
--

INSERT INTO `dct_sistema_tbl_rol` (`rol_id_rol`, `rol_rol`, `rol_estado`) VALUES
(1, 'Developer', 'A'),
(2, 'Administrador', 'A'),
(3, 'Paciente', 'A'),
(4, 'Médico', 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_rol_aplicacion`
--

CREATE TABLE `dct_sistema_tbl_rol_aplicacion` (
  `rla_id` int(11) NOT NULL,
  `rla_id_rol` int(11) NOT NULL,
  `rla_id_aplicacion` int(11) NOT NULL,
  `rla_estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol_aplicacion`
--

INSERT INTO `dct_sistema_tbl_rol_aplicacion` (`rla_id`, `rla_id_rol`, `rla_id_aplicacion`, `rla_estado`) VALUES
(16, 1, 1, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_rol_opcion`
--

CREATE TABLE `dct_sistema_tbl_rol_opcion` (
  `rlo_id` int(11) NOT NULL,
  `rlo_id_rol` int(11) NOT NULL,
  `rlo_id_opcion` int(11) NOT NULL,
  `rlo_estado` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `dct_sistema_tbl_rol_opcion`
--

INSERT INTO `dct_sistema_tbl_rol_opcion` (`rlo_id`, `rlo_id_rol`, `rlo_id_opcion`, `rlo_estado`) VALUES
(66, 1, 1, 'A'),
(67, 1, 2, 'A'),
(68, 1, 3, 'A'),
(69, 1, 4, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_token`
--

CREATE TABLE `dct_sistema_tbl_token` (
  `tok_id_token` bigint(20) NOT NULL,
  `tok_token` varchar(150) DEFAULT NULL,
  `tok_tipo` varchar(10) DEFAULT NULL,
  `tok_cedula` varchar(13) DEFAULT NULL,
  `tok_fecha` timestamp NULL DEFAULT NULL,
  `tok_estado` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dct_sistema_tbl_usuario`
--

CREATE TABLE `dct_sistema_tbl_usuario` (
  `usr_id_usuario` bigint(20) NOT NULL,
  `usr_cod_usuario` varchar(13) NOT NULL,
  `usr_nombre_1` varchar(15) NOT NULL,
  `usr_nombre_2` varchar(15) NOT NULL,
  `usr_apellido_1` varchar(15) NOT NULL,
  `usr_apellido_2` varchar(15) NOT NULL,
  `usr_contrasenia` varchar(500) NOT NULL,
  `usr_logeado` varchar(1) NOT NULL,
  `usr_estado` varchar(1) NOT NULL,
  `usr_ip_pc_acceso` varchar(100) DEFAULT NULL,
  `usr_fecha_acceso` timestamp NULL DEFAULT NULL,
  `usr_correo` varchar(60) NOT NULL,
  `usr_id_rol` int(11) NOT NULL,
  `usr_estado_contrasenia` varchar(1) NOT NULL,
  `usr_id_empresa` int(11) NOT NULL,
  `usr_fecha_cambio_contrasenia` date DEFAULT NULL,
  `usr_contador_error_contrasenia` smallint(6) DEFAULT NULL,
  `usr_expiro_contrasenia` varchar(1) DEFAULT NULL,
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

INSERT INTO `dct_sistema_tbl_usuario` (`usr_id_usuario`, `usr_cod_usuario`, `usr_nombre_1`, `usr_nombre_2`, `usr_apellido_1`, `usr_apellido_2`, `usr_contrasenia`, `usr_logeado`, `usr_estado`, `usr_ip_pc_acceso`, `usr_fecha_acceso`, `usr_correo`, `usr_id_rol`, `usr_estado_contrasenia`, `usr_id_empresa`, `usr_fecha_cambio_contrasenia`, `usr_contador_error_contrasenia`, `usr_expiro_contrasenia`, `usr_usuario_creacion`, `usr_usuario_modificacion`, `usr_fecha_creacion`, `usr_fecha_modificacion`, `usr_ip_creacion`, `usr_ip_modificacion`) VALUES
(1, '0919664854', 'Mauro', 'Vinicio', 'Echeverría', 'Chugulí', 'amkyZWwvV0EzTjA5Q2kvKy85aUoxQjh3K1dxZ3kxQlp6NnBwb0E3cGRmVS9VL3cxcHJwOEZaT0tRa2V3N2hSNw==', '0', 'A', NULL, NULL, 'mauroviniciO@gmail.com', 1, 'A', 1, '2021-07-15', 0, 'N', '0919664854', '0919664854', '2021-05-19 10:20:25', '2021-05-19 10:20:25', 'DESKTOP-5L9FRDR', 'DESKTOP-5L9FRDR');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dct_sistema_tbl_aplicacion`
--
ALTER TABLE `dct_sistema_tbl_aplicacion`
  ADD PRIMARY KEY (`apl_id_aplicacion`),
  ADD UNIQUE KEY `apl_aplicacion` (`apl_aplicacion`,`apl_ruta`);

--
-- Indices de la tabla `dct_sistema_tbl_aplicacion_empresa`
--
ALTER TABLE `dct_sistema_tbl_aplicacion_empresa`
  ADD PRIMARY KEY (`ape_id_aplicacion`,`ape_id_empresa`),
  ADD KEY `ape_id_empresa` (`ape_id_empresa`);

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
  ADD PRIMARY KEY (`opc_id_opcion`),
  ADD KEY `opc_id_aplicacion` (`opc_id_aplicacion`);

--
-- Indices de la tabla `dct_sistema_tbl_rol`
--
ALTER TABLE `dct_sistema_tbl_rol`
  ADD PRIMARY KEY (`rol_id_rol`);

--
-- Indices de la tabla `dct_sistema_tbl_rol_aplicacion`
--
ALTER TABLE `dct_sistema_tbl_rol_aplicacion`
  ADD PRIMARY KEY (`rla_id`),
  ADD KEY `dct_sistema_tbl_rol_aplicacion_ibfk_1` (`rla_id_rol`),
  ADD KEY `dct_sistema_tbl_rol_aplicacion_ibfk_2` (`rla_id_aplicacion`);

--
-- Indices de la tabla `dct_sistema_tbl_rol_opcion`
--
ALTER TABLE `dct_sistema_tbl_rol_opcion`
  ADD PRIMARY KEY (`rlo_id`),
  ADD KEY `dct_sistema_tbl_rol_opcion_ibfk_1` (`rlo_id_rol`),
  ADD KEY `dct_sistema_tbl_rol_opcion_ibfk_2` (`rlo_id_opcion`);

--
-- Indices de la tabla `dct_sistema_tbl_token`
--
ALTER TABLE `dct_sistema_tbl_token`
  ADD PRIMARY KEY (`tok_id_token`),
  ADD KEY `tok_id_token` (`tok_id_token`);

--
-- Indices de la tabla `dct_sistema_tbl_usuario`
--
ALTER TABLE `dct_sistema_tbl_usuario`
  ADD PRIMARY KEY (`usr_id_usuario`),
  ADD UNIQUE KEY `usr_cod_usuario` (`usr_cod_usuario`),
  ADD KEY `usr_id_empresa` (`usr_id_empresa`),
  ADD KEY `usr_id_usuario` (`usr_id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_catalogo`
--
ALTER TABLE `dct_sistema_tbl_catalogo`
  MODIFY `ctg_id_catalogo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_contrasenia`
--
ALTER TABLE `dct_sistema_tbl_contrasenia`
  MODIFY `cts_id_contrasenia` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_opcion`
--
ALTER TABLE `dct_sistema_tbl_opcion`
  MODIFY `opc_id_opcion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_rol`
--
ALTER TABLE `dct_sistema_tbl_rol`
  MODIFY `rol_id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_rol_aplicacion`
--
ALTER TABLE `dct_sistema_tbl_rol_aplicacion`
  MODIFY `rla_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_rol_opcion`
--
ALTER TABLE `dct_sistema_tbl_rol_opcion`
  MODIFY `rlo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_token`
--
ALTER TABLE `dct_sistema_tbl_token`
  MODIFY `tok_id_token` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `dct_sistema_tbl_usuario`
--
ALTER TABLE `dct_sistema_tbl_usuario`
  MODIFY `usr_id_usuario` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `dct_sistema_tbl_aplicacion_empresa`
--
ALTER TABLE `dct_sistema_tbl_aplicacion_empresa`
  ADD CONSTRAINT `dct_sistema_tbl_aplicacion_empresa_ibfk_1` FOREIGN KEY (`ape_id_aplicacion`) REFERENCES `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`),
  ADD CONSTRAINT `dct_sistema_tbl_aplicacion_empresa_ibfk_2` FOREIGN KEY (`ape_id_empresa`) REFERENCES `dct_sistema_tbl_empresa` (`emp_id_empresa`);

--
-- Filtros para la tabla `dct_sistema_tbl_opcion`
--
ALTER TABLE `dct_sistema_tbl_opcion`
  ADD CONSTRAINT `dct_sistema_tbl_opcion_ibfk_1` FOREIGN KEY (`opc_id_aplicacion`) REFERENCES `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`);

--
-- Filtros para la tabla `dct_sistema_tbl_rol_aplicacion`
--
ALTER TABLE `dct_sistema_tbl_rol_aplicacion`
  ADD CONSTRAINT `dct_sistema_tbl_rol_aplicacion_ibfk_1` FOREIGN KEY (`rla_id_rol`) REFERENCES `dct_sistema_tbl_rol` (`rol_id_rol`),
  ADD CONSTRAINT `dct_sistema_tbl_rol_aplicacion_ibfk_2` FOREIGN KEY (`rla_id_aplicacion`) REFERENCES `dct_sistema_tbl_aplicacion` (`apl_id_aplicacion`);

--
-- Filtros para la tabla `dct_sistema_tbl_rol_opcion`
--
ALTER TABLE `dct_sistema_tbl_rol_opcion`
  ADD CONSTRAINT `dct_sistema_tbl_rol_opcion_ibfk_1` FOREIGN KEY (`rlo_id_rol`) REFERENCES `dct_sistema_tbl_rol` (`rol_id_rol`),
  ADD CONSTRAINT `dct_sistema_tbl_rol_opcion_ibfk_2` FOREIGN KEY (`rlo_id_opcion`) REFERENCES `dct_sistema_tbl_opcion` (`opc_id_opcion`);

--
-- Filtros para la tabla `dct_sistema_tbl_usuario`
--
ALTER TABLE `dct_sistema_tbl_usuario`
  ADD CONSTRAINT `dct_sistema_tbl_usuario_ibfk_1` FOREIGN KEY (`usr_id_empresa`) REFERENCES `dct_sistema_tbl_empresa` (`emp_id_empresa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
