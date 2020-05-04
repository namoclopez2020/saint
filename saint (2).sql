-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-05-2020 a las 17:13:15
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tecnek_demo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `id_almacen` int(11) NOT NULL,
  `nombre_almacen` varchar(50) NOT NULL,
  `codigo_almacen` varchar(40) NOT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `almacen`
--

INSERT INTO `almacen` (`id_almacen`, `nombre_almacen`, `codigo_almacen`, `id_sucursal`) VALUES
(4, 'almacen 1', '001', 4),
(5, 'almacen 2', '002', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categories`
--

CREATE TABLE `categories` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(50, 'cables'),
(51, 'fuentes'),
(52, 'smartphones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `telefono_cliente` varchar(15) CHARACTER SET utf8 DEFAULT NULL,
  `dni_cliente` varchar(50) DEFAULT NULL,
  `direccion_cliente` varchar(40) NOT NULL,
  `email_cliente` varchar(40) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `grupo_cliente` varchar(20) NOT NULL,
  `pedidos_cliente` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nombre_cliente`, `telefono_cliente`, `dni_cliente`, `direccion_cliente`, `email_cliente`, `date_added`, `grupo_cliente`, `pedidos_cliente`) VALUES
(68, 'yesenia castillo', '921977596', '', '', '', NULL, '', ''),
(69, 'enrique more', '965256252', '', '', '', NULL, '', ''),
(70, 'wiliiam rengel', '912671403', '', '', '', NULL, '', ''),
(71, ' josue antaurco', '947318823', '', 'puente piedra', '', NULL, '', ''),
(72, 'jhon huaro', '980784894', '', 'puente piedra', '', NULL, '', ''),
(73, 'manuel mananita otoya', '927775341', '', 'ventanilla', '', NULL, '', ''),
(74, 'IRMA POVES', '981566527', '', '', '', NULL, '', ''),
(75, 'ruben valerio', '981558912', '', '', '', NULL, '', ''),
(76, 'renan palacios', '981035109', '', ' puente piedra', '', NULL, '', ''),
(78, 'alejandro', '987654321', '89678', 'puente piedra', 'alejandro@hotmail.com', NULL, '', ''),
(79, 'alexander francisco lopez', '960278972', '', 'ancon', '', NULL, '', ''),
(80, 'Jose namoc', '922896383', '77923585', 'Puente piedra ', 'Namoc_lopez@hotmail.com', NULL, '', ''),
(81, 'Dani colmenares', '922370772', '', 'Puente piedra ', 'Danicolmenares7@gmail.com', NULL, '', ''),
(82, 'francisco valdez', '910189247', '', 'puente piedra', '', NULL, '', ''),
(83, 'Katy', '2837182', '', 'Los olivos', '', NULL, '', ''),
(84, 'marina vega', '973037528', '', 'puente piedra', '', NULL, '', ''),
(85, 'Santiago martinez', '995453276', '', 'Puente piedra', '', NULL, '', ''),
(86, 'Carmen rosa', '927573332', '', 'Puente piedra', '', NULL, '', ''),
(87, 'esneider meier', '926574857', '', 'puente piedra', '', NULL, '', ''),
(88, 'masiel pilar', '944444842', '', 'puente piedra', '', NULL, '', ''),
(89, 'Gladys chura', '982071971', '', 'puente piedra', '', NULL, '', ''),
(90, 'felipe arroyo', '969754861', '', '', '', NULL, '', ''),
(91, 'Gustavo Miguel silva', '994756289', '', 'puente piedra', '', NULL, '', ''),
(92, 'ali altamirano', '945509498', '', 'puente piedra', '', NULL, '', ''),
(93, 'laura altamirano', '926229408', '', 'puente piedra', '', NULL, '', ''),
(94, 'carolina diaz', '980514163', '', 'puente piedra', '', NULL, '', ''),
(95, 'eliana petros rojas', '970620578', '', 'puente piedra', '', NULL, '', ''),
(96, 'Jonas aguilar trujillo', '926587759', '', 'Puente piedra ', '', NULL, '', ''),
(97, 'patricia palacios', '934513573', '', 'puente piedra', '', NULL, '', ''),
(98, 'rebeca fernandez zapata', '945884597', '', 'ventanilla', '', NULL, '', ''),
(99, 'bravo', '981866372', '', 'puente piedra', '', NULL, '', ''),
(100, 'vilma soto', '959227890', '', 'puente piedra', '', NULL, '', ''),
(101, 'neira valles', '965666226', '', '', '', NULL, '', ''),
(102, 'javier carvajal', '943365679', '', '', '', NULL, '', ''),
(103, 'esteban valdivia terrones', '947782784', '', 'puente piedra', '', NULL, '', ''),
(104, 'javier arce', '', '', 'puente piedra', '', NULL, '', ''),
(105, 'jhonatan blas', '949572507', '', 'puente piedra', '', NULL, '', ''),
(106, 'denis galindo', '926120700', '', 'puente piedra', '', NULL, '', ''),
(107, 'wilyan ayala', '969655230', '', 'puente piedra', '', NULL, '', ''),
(108, 'laura gil', '923705509', '', 'puente piedra', '', NULL, '', ''),
(109, 'yerson fridas', '927386896', '', 'puente piedra', '', NULL, '', ''),
(110, 'JENNY SANTA CRUZ', '957305420', '', '', '', NULL, '', ''),
(111, 'Kelvin castillo', '987546283', '', 'Puente piedra', '', NULL, '', ''),
(112, 'josue maldonado', '941498353', '', 'lima', '', NULL, '', ''),
(113, 'edgar ramos', '927247718', '', 'puente piedra', '', NULL, '', ''),
(114, 'diana', '965472522', '', '', '', NULL, '', ''),
(115, 'Robert quiroz', '981906461', '', 'Puente piedra ', '', NULL, '', ''),
(116, 'Grupo Inkas Gold', '', '20487336115', 'Lima', '', NULL, '', ''),
(117, 'murillo vasquez', '929122599', '', '', '', NULL, '', ''),
(118, 'patrick larosa', '982513340', '', '', '', NULL, '', ''),
(119, 'Manuel pinedo herrera', '962232685', '', 'Puente piedra ', '', NULL, '', ''),
(120, 'jonas veramendi ortiz', '991896136', '', 'puente piedra', '', NULL, '', ''),
(121, 'carlos vega', '999555673', '', 'san benito', '', NULL, '', ''),
(122, 'mayra zuta', '998364190', '', 'puente piedra', '', NULL, '', ''),
(123, 'hector trejo', '984367542', '', 'puente piedra', '', NULL, '', ''),
(124, 'Harol ', '916914345', '', 'Puente piedra ', '', NULL, '', ''),
(125, 'jacky garcia', '954138069', '', 'puente piedra', '', NULL, '', ''),
(126, 'roger martinez bautista', '996495560', '', 'puente piedra', '', NULL, '', ''),
(127, 'noe jaimes inga', '910330142', '', 'puente piedra', '', NULL, '', ''),
(128, 'jose vasquez acuÃ±a', '976070080', '', 'puente piedra', '', NULL, '', ''),
(129, 'franco homero', '990452214', '', 'puente piedra', '', NULL, '', ''),
(130, 'israel mendez', '942818011', '', 'puente piedra', '', NULL, '', ''),
(131, 'ana salinas', '978246343', '', 'puente piedra', '', NULL, '', ''),
(132, 'Jeslin esmith', '941127293', '', 'Comas', '', NULL, '', ''),
(133, 'Domingo pacheco', '966880194', '', 'Puente piedra ', '', NULL, '', ''),
(134, 'Orfelinda ayala', '959439271', '', 'puente piedra', '', NULL, '', ''),
(135, 'Carol Valverde Salas', '943938946', '', 'puente piedra', '', NULL, '', ''),
(136, 'Zenaida horna', '902697237', '', 'Puente piedra ', '', NULL, '', ''),
(138, 'oriana', '', '', '', '', NULL, '', ''),
(139, 'ruben valer', '981558912', '42338119', 'velarde 165', 'grupovisiontecnologica@gmail.com', '2020-03-19 20:36:52', 'Potencial', 'laptop y huawei p20'),
(140, 'hola', '123', '123', '132', '123', '2020-03-19 00:00:00', 'Ordinario', 'Sin pedidos'),
(141, 'dani prueba', '123123', '12312', 'puente', 'asdas', '2020-03-24 21:22:28', 'Ordinario', 'Sin pedidos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id_compra` int(11) NOT NULL,
  `numero_compra` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `costo_total_compra` double NOT NULL,
  `pagado` varchar(10) NOT NULL,
  `fecha_compra` datetime NOT NULL,
  `metodo_pago` varchar(10) NOT NULL,
  `suc_id` int(11) NOT NULL,
  `status_compra` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id_compra`, `numero_compra`, `id_proveedor`, `costo_total_compra`, `pagado`, `fecha_compra`, `metodo_pago`, `suc_id`, `status_compra`) VALUES
(119, 1, 1, 12000, '12000', '2020-05-03 00:00:00', '1', 4, 'Total'),
(120, 2, 5, 2300, '2300', '1969-12-31 19:00:00', '1', 4, 'Total');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_compra`
--

CREATE TABLE `detalle_compra` (
  `id_detalle_comp` int(11) NOT NULL,
  `num_compra` int(11) NOT NULL,
  `id_producto_compra` int(11) NOT NULL,
  `cant_paq` varchar(10) NOT NULL,
  `cant_und` varchar(10) NOT NULL,
  `costo_compra` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_compra`
--

INSERT INTO `detalle_compra` (`id_detalle_comp`, `num_compra`, `id_producto_compra`, `cant_paq`, `cant_und`, `costo_compra`) VALUES
(134, 1, 56, '', '10', 12000),
(135, 2, 56, '', '3', 2300);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `id_detalle` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` varchar(20) NOT NULL,
  `precio_venta` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_movimiento`
--

CREATE TABLE `detalle_movimiento` (
  `id_detalle_mov` int(5) NOT NULL,
  `nombre_tipo_movimiento` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_movimiento`
--

INSERT INTO `detalle_movimiento` (`id_detalle_mov`, `nombre_tipo_movimiento`) VALUES
(1, 'Agregado'),
(2, 'venta'),
(3, 'envio'),
(4, 'recepcion'),
(5, 'Edicion'),
(7, 'Creado desde envio'),
(8, 'compra');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_producto`
--

CREATE TABLE `detalle_producto` (
  `id_detalle` int(11) NOT NULL,
  `numero_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `fecha_agregado` datetime NOT NULL,
  `paq` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `und` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `estado` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_producto`
--

INSERT INTO `detalle_producto` (`id_detalle`, `numero_compra`, `id_producto`, `fecha_agregado`, `paq`, `und`, `id_proveedor`, `estado`) VALUES
(26, 1, 56, '2020-05-03 00:00:00', '', '10', 1, 'vigente'),
(27, 2, 56, '1969-12-31 19:00:00', '', '3', 5, 'vigente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `egreso`
--

CREATE TABLE `egreso` (
  `id_egreso` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `concepto` varchar(500) DEFAULT NULL,
  `monto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `numero_factura` int(11) NOT NULL,
  `fecha_factura` datetime DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `condiciones` varchar(30) DEFAULT NULL,
  `total_venta` varchar(20) DEFAULT NULL,
  `estado_factura` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `general_data`
--

CREATE TABLE `general_data` (
  `id` int(11) NOT NULL,
  `moneda` varchar(5) NOT NULL,
  `representacion` varchar(5) NOT NULL,
  `sucursal` int(11) NOT NULL,
  `impuesto` varchar(5) NOT NULL,
  `porcentaje_impuesto` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `general_data`
--

INSERT INTO `general_data` (`id`, `moneda`, `representacion`, `sucursal`, `impuesto`, `porcentaje_impuesto`) VALUES
(0, 'SOL', 'S/.', 4, 'IGV', 18);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `media`
--

CREATE TABLE `media` (
  `id` int(11) UNSIGNED NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id_movimiento` int(10) NOT NULL,
  `id_tipo_movimiento` int(10) DEFAULT NULL,
  `id_vendedor_mov` int(10) DEFAULT NULL,
  `id_producto_mov` int(10) DEFAULT NULL,
  `cantidad_mov` varchar(10) DEFAULT NULL,
  `fecha_movimiento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `num_compra` int(11) NOT NULL,
  `monto_pagado` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_pago` datetime NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL,
  `metodo_pago` varchar(11) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `num_compra`, `monto_pagado`, `fecha_pago`, `id_usuario`, `id_sucursal`, `metodo_pago`) VALUES
(24, 1, '5000', '2020-05-03 00:00:00', 1, 4, 'Efectivo'),
(25, 1, '1', '2020-05-03 20:58:54', 1, 4, 'Efectivo'),
(26, 1, '6999', '2020-05-03 21:00:01', 1, 4, 'Cheque'),
(27, 2, '1670', '1969-12-31 19:00:00', 1, 4, 'Efectivo'),
(28, 2, '2', '2020-05-03 22:21:37', 1, 4, 'Transferenc'),
(29, 2, '628', '2020-05-03 22:23:18', 1, 4, 'Cheque');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_proveedor`
--

CREATE TABLE `producto_proveedor` (
  `id_producto` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `producto_proveedor`
--

INSERT INTO `producto_proveedor` (`id_producto`, `id_proveedor`) VALUES
(56, 1),
(56, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_producto` int(11) NOT NULL,
  `nombre_producto` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_producto` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `costo_anterior` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `costo_promedio` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `costo_actual` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `precio1` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `precio2` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `precio3` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `es_serial` int(1) NOT NULL,
  `id_almacen` int(11) NOT NULL,
  `impuesto` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `usa_empaque` int(1) NOT NULL,
  `medida_paq` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `medida_und` varchar(4) COLLATE utf8_spanish_ci NOT NULL,
  `fraccion` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock_paq` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL,
  `stock_und` varchar(30) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id_producto`, `nombre_producto`, `codigo_producto`, `costo_anterior`, `costo_promedio`, `costo_actual`, `precio1`, `precio2`, `precio3`, `categorie_id`, `fecha_creado`, `es_serial`, `id_almacen`, `impuesto`, `usa_empaque`, `medida_paq`, `medida_und`, `fraccion`, `stock_paq`, `stock_und`) VALUES
(56, 'huawei p20 128gb', '001', '900', '800', '670', '1670', '1620', '1650', 52, '2020-05-03 20:54:20', 1, 5, '', 0, '', 'und', '', '', '13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `idproveedor` int(11) NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `RUC` varchar(12) CHARACTER SET utf8 DEFAULT NULL,
  `representante` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `direccion` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `Telefono` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`idproveedor`, `nombre`, `RUC`, `representante`, `direccion`, `Telefono`) VALUES
(1, 'mr robot', '98987', 'JOSE NAMOC', 'PUENTE', '98798798'),
(4, 'casa', '98987', 'LUIS', 'PUENTE', '98798798'),
(5, 'Importadora Scoyser S.A.C.', '111', 'Luis Rafael Villa Gomez', 'lima', '111');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seriales`
--

CREATE TABLE `seriales` (
  `id_serial` int(11) NOT NULL,
  `id_detalle_prod` int(11) NOT NULL,
  `serial_number` varchar(80) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `seriales`
--

INSERT INTO `seriales` (`id_serial`, `id_detalle_prod`, `serial_number`, `status`) VALUES
(53, 26, '123123123', 'Vigente'),
(54, 26, '345435', 'Vigente'),
(55, 26, '767675', 'Vigente'),
(56, 26, '454545', 'Vigente'),
(57, 26, '43343', 'Vigente'),
(58, 26, '878765', 'Vigente'),
(59, 26, '8978987', 'Vigente'),
(60, 26, '234234365', 'Vigente'),
(61, 26, '756756', 'Vigente'),
(62, 26, '987987456', 'Vigente'),
(63, 27, '12121', 'Vigente'),
(64, 27, '76000', 'Vigente'),
(65, 27, '0989', 'Vigente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(10) NOT NULL,
  `direccion_sucursal` varchar(50) NOT NULL,
  `nombre_sucursal` varchar(70) NOT NULL,
  `telefono_sucursal` varchar(30) NOT NULL,
  `RUC_SUCURSAL` varchar(12) NOT NULL,
  `image_path` varchar(100) NOT NULL,
  `email_sucursal` varchar(100) NOT NULL,
  `wsp_sucursal` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `direccion_sucursal`, `nombre_sucursal`, `telefono_sucursal`, `RUC_SUCURSAL`, `image_path`, `email_sucursal`, `wsp_sucursal`) VALUES
(4, 'Pasaje Jorge Chavez 147 Stand N6', 'Mr ROBOT', '922896383 - 922370772', '10779235853', 'vvqugjj14.png', 'mralphayomega@gmail.com', '922896383 - 922370772'),
(10, 'pasaje velarde 165 oficina 102', 'grupo vision tecnologica', '981558912', '20603615019', 'jpqy07cy10.png', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp`
--

CREATE TABLE `tmp` (
  `id_tmp` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad_tmp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `precio_tmp` double(8,2) DEFAULT NULL,
  `session_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tmp_compra`
--

CREATE TABLE `tmp_compra` (
  `id_tmp_compra` int(11) NOT NULL,
  `id_producto_compra` int(11) NOT NULL,
  `cantidad_und` varchar(10) NOT NULL,
  `cantidad_paq` varchar(30) DEFAULT NULL,
  `costo_compra_tmp` double NOT NULL,
  `session_id_compra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_level` int(11) NOT NULL,
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `status` int(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `id_sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `user_level`, `image`, `status`, `last_login`, `id_sucursal`) VALUES
(1, 'Administrador', 'Admin', 'd4e8e6deaa7b1f8381e09e3e6b83e36f0b681c5c', 1, 'm318llg1.jpg', 1, '2020-05-03 22:15:04', 4),
(2, 'Special User', 'Special', 'ba36b97a41e7faf742ab09bf88405ac04f99599a', 2, 'no_image.jpg', 1, '2019-07-23 00:54:30', 0),
(3, 'Default User', 'User', '12dea96fec20593566ab75692c9949596833adc9', 3, 'no_image.jpg', 1, '2020-05-01 13:15:29', 5),
(18, 'Dani JosÃ© Colmenares Cadiz ', 'Dani', '1cf2810c459c3dac44a311ace33fb298d334e307', 1, 'no_image.jpg', 1, '2020-03-24 20:28:51', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(150) NOT NULL,
  `group_level` int(11) NOT NULL,
  `group_status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `group_level`, `group_status`) VALUES
(1, 'Administrador', 1, 1),
(2, 'Special', 2, 1),
(3, 'Vendedor', 3, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD PRIMARY KEY (`id_almacen`);

--
-- Indices de la tabla `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id_compra`),
  ADD UNIQUE KEY `numero_compra` (`numero_compra`);

--
-- Indices de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  ADD PRIMARY KEY (`id_detalle_comp`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `numero_cotizacion` (`numero_factura`,`id_producto`);

--
-- Indices de la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  ADD PRIMARY KEY (`id_detalle_mov`);

--
-- Indices de la tabla `detalle_producto`
--
ALTER TABLE `detalle_producto`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `FK_id_prod` (`id_producto`);

--
-- Indices de la tabla `egreso`
--
ALTER TABLE `egreso`
  ADD PRIMARY KEY (`id_egreso`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD UNIQUE KEY `numero_cotizacion` (`numero_factura`);

--
-- Indices de la tabla `general_data`
--
ALTER TABLE `general_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_sucursal` (`id`),
  ADD KEY `general_data_ibfk_1` (`sucursal`);

--
-- Indices de la tabla `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_movimiento`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_user_pago` (`id_usuario`),
  ADD KEY `FK_id_sucursal_pago` (`id_sucursal`),
  ADD KEY `FK_numero_compra_pago` (`num_compra`);

--
-- Indices de la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD KEY `FK_id_producto` (`id_producto`),
  ADD KEY `FK_id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo_producto` (`codigo_producto`),
  ADD KEY `FK_id_almacen` (`id_almacen`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`idproveedor`);

--
-- Indices de la tabla `seriales`
--
ALTER TABLE `seriales`
  ADD PRIMARY KEY (`id_serial`),
  ADD KEY `id_detalle_prod` (`id_detalle_prod`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tmp`
--
ALTER TABLE `tmp`
  ADD PRIMARY KEY (`id_tmp`);

--
-- Indices de la tabla `tmp_compra`
--
ALTER TABLE `tmp_compra`
  ADD PRIMARY KEY (`id_tmp_compra`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `user_level` (`user_level`);

--
-- Indices de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_level` (`group_level`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `almacen`
--
ALTER TABLE `almacen`
  MODIFY `id_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT de la tabla `detalle_compra`
--
ALTER TABLE `detalle_compra`
  MODIFY `id_detalle_comp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5867;

--
-- AUTO_INCREMENT de la tabla `detalle_movimiento`
--
ALTER TABLE `detalle_movimiento`
  MODIFY `id_detalle_mov` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `detalle_producto`
--
ALTER TABLE `detalle_producto`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `egreso`
--
ALTER TABLE `egreso`
  MODIFY `id_egreso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2529;

--
-- AUTO_INCREMENT de la tabla `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_movimiento` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4518;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `seriales`
--
ALTER TABLE `seriales`
  MODIFY `id_serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tmp`
--
ALTER TABLE `tmp`
  MODIFY `id_tmp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6747;

--
-- AUTO_INCREMENT de la tabla `tmp_compra`
--
ALTER TABLE `tmp_compra`
  MODIFY `id_tmp_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_producto`
--
ALTER TABLE `detalle_producto`
  ADD CONSTRAINT `detalle_producto_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `general_data`
--
ALTER TABLE `general_data`
  ADD CONSTRAINT `general_data_ibfk_1` FOREIGN KEY (`sucursal`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`id_sucursal`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_4` FOREIGN KEY (`num_compra`) REFERENCES `compras` (`numero_compra`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_proveedor`
--
ALTER TABLE `producto_proveedor`
  ADD CONSTRAINT `producto_proveedor_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`idproveedor`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `producto_proveedor_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `products` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_almacen`) REFERENCES `almacen` (`id_almacen`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `seriales`
--
ALTER TABLE `seriales`
  ADD CONSTRAINT `seriales_ibfk_1` FOREIGN KEY (`id_detalle_prod`) REFERENCES `detalle_producto` (`id_detalle`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
