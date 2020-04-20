-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-04-2020 a las 02:11:19
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_oftalmologo_henry`
--
CREATE DATABASE IF NOT EXISTS `sistema_oftalmologo_henry` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistema_oftalmologo_henry`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aumento`
--

CREATE TABLE `aumento` (
  `id` int(11) NOT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `aumento`
--

INSERT INTO `aumento` (`id`, `nombre`, `fecha`) VALUES
(1, 'PL', '2019-12-03 21:34:03'),
(2, 'PL-0,50', '2019-12-03 21:34:31'),
(3, 'PL-1,00', '2019-12-03 22:07:44'),
(4, '+0,25', '2019-12-03 22:07:53'),
(5, '+0,50', '2019-12-03 22:08:05'),
(6, '+0,25+0,25', '2019-12-03 22:08:20'),
(7, '+0,25+0,50', '2019-12-03 22:08:36'),
(8, '+0,50-0,25', '2019-12-03 22:08:44'),
(9, '+0,50-0,50', '2019-12-03 22:08:52'),
(10, '+0,75', '2019-12-03 22:09:01'),
(11, '+0,75+0,25', '2019-12-03 22:09:12'),
(12, '+0,75+0,50', '2019-12-03 22:09:21'),
(13, '+0,75+0,75', '2019-12-03 22:09:30'),
(14, '+1,00', '2019-12-03 22:09:38'),
(15, '+1,25', '2019-12-03 22:09:45'),
(16, '+1,50', '2019-12-03 22:09:52'),
(17, '+1,75', '2019-12-03 22:10:00'),
(18, '+2,00', '2019-12-03 22:10:08'),
(19, '+2,25', '2019-12-03 22:10:16'),
(20, '+2,50', '2019-12-03 22:10:23'),
(21, '+2,75', '2019-12-03 22:10:33'),
(22, '+3,00', '2019-12-03 22:10:39'),
(23, '-0,25', '2019-12-03 22:10:52'),
(24, '-0,50', '2019-12-03 22:11:31'),
(25, '-0,25-0,25', '2019-12-03 22:11:41'),
(26, '-0,25-0,50', '2019-12-03 22:11:48'),
(27, '-0,50-0,25', '2019-12-03 22:11:57'),
(28, '-0,50-0,50', '2019-12-03 22:12:05'),
(29, '-0,75', '2019-12-03 22:12:12'),
(30, '-0,75-0,25', '2019-12-03 22:12:21'),
(31, '-0,75-0,50', '2019-12-03 22:12:28'),
(32, '-1,00', '2019-12-03 22:12:38'),
(33, '-1,25', '2019-12-03 22:12:48'),
(34, '-1,50', '2019-12-03 22:12:56'),
(35, '-1,75', '2019-12-03 22:13:03'),
(36, '-2,00', '2019-12-03 22:13:11'),
(37, '-2,25', '2019-12-03 22:13:18'),
(38, '-2,50', '2019-12-03 22:13:31'),
(39, '-2,75', '2019-12-03 22:13:39'),
(40, '-3,00', '2019-12-03 22:13:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `categoria` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `historia` int(11) NOT NULL,
  `documento` text COLLATE utf8_spanish_ci NOT NULL,
  `email` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `compras` int(11) NOT NULL,
  `ultima_compra` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cristales`
--

CREATE TABLE `cristales` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_cristal` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `aumento_cristal` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entre`
--

CREATE TABLE `entre` (
  `id` int(11) NOT NULL,
  `tipo_cristal` text NOT NULL,
  `aumento_cristal` text NOT NULL,
  `codigo` text NOT NULL,
  `descripcion` text NOT NULL,
  `lugar` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `fecha_entregado` text NOT NULL,
  `fecha_pedido_entregado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entregados`
--

CREATE TABLE `entregados` (
  `id` int(11) NOT NULL,
  `tipo_cristal` text NOT NULL,
  `aumento_cristal` text NOT NULL,
  `codigo` text NOT NULL,
  `descripcion` text NOT NULL,
  `lugar` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` int(11) NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `fecha_entregado` text NOT NULL,
  `fecha_pedido_entregado` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id` int(11) NOT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id`, `nombre`, `fecha`) VALUES
(1, 'Compra realizada ', '2019-12-07 20:01:45'),
(3, 'En proceso', '2019-12-07 20:15:51'),
(4, 'Terminado  ', '2019-12-07 20:16:51'),
(5, 'Entregado', '2019-12-07 20:17:03'),
(6, 'Anulado', '2019-12-08 05:58:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `laboratorio`
--

CREATE TABLE `laboratorio` (
  `id` int(11) NOT NULL,
  `laboratorio` text NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `llegados`
--

CREATE TABLE `llegados` (
  `id` int(11) NOT NULL,
  `tipo_cristal` text NOT NULL,
  `aumento_cristal` text NOT NULL,
  `codigo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text NOT NULL,
  `lugar` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_terminado` text NOT NULL,
  `fecha_de_terminado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `local`
--

CREATE TABLE `local` (
  `id` int(11) NOT NULL,
  `tipo_cristal` text NOT NULL,
  `aumento_cristal` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugar` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugar`
--

CREATE TABLE `lugar` (
  `id` int(11) NOT NULL,
  `categoria` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `lugar`
--

INSERT INTO `lugar` (`id`, `categoria`, `fecha`) VALUES
(1, 'Laboratorio 1', '2020-04-07 14:42:01'),
(2, 'Laboratorio 2', '2020-04-07 14:42:06'),
(3, 'Laboratorio 3', '2020-04-07 14:42:49'),
(4, 'Laboratorio 4', '2020-04-07 14:43:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `tipo_cristal` text NOT NULL,
  `aumento_cristal` text NOT NULL,
  `codigo` text NOT NULL,
  `descripcion` text NOT NULL,
  `lugar` text NOT NULL,
  `imagen` text NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `codigo` text COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text COLLATE utf8_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` float NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `terminados`
--

CREATE TABLE `terminados` (
  `id` int(11) NOT NULL,
  `tipo_cristal` text NOT NULL,
  `aumento_cristal` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `codigo` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `lugar` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `imagen` text CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `precio_compra` float NOT NULL,
  `precio_venta` int(11) NOT NULL,
  `estado` int(11) NOT NULL,
  `ventas` int(11) NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_terminado` text NOT NULL,
  `fecha_de_terminado` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo`
--

CREATE TABLE `tipo` (
  `id` int(11) NOT NULL,
  `nombre` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipo`
--

INSERT INTO `tipo` (`id`, `nombre`, `fecha`) VALUES
(1, 'Visión Sencilla - CR Terminado', '2020-04-20 10:26:20'),
(2, 'Visión Sencilla - AR Terminado', '2020-04-20 10:26:46'),
(3, 'Visión Sencilla - CR Tallado', '2020-04-20 10:27:10'),
(4, 'Visión Sencilla - AR Tallado', '2020-04-20 10:27:27'),
(5, 'Visión Sencilla - Fotocromático Tallado', '2020-04-20 10:28:52'),
(6, 'Visión Sencilla - Fotocromático AR Tallado', '2020-04-20 10:29:13'),
(7, 'Visión Sencilla - Hi-Index Tallado', '2020-04-20 10:32:30'),
(8, 'Policarbonato - Terminado', '2020-04-20 10:33:33'),
(9, 'Policarbonato - Tallado', '2020-04-20 10:33:47'),
(10, 'Bifocal - Kripto Terminado', '2020-04-20 10:34:45'),
(11, 'Bifocal - Kripto Tallado', '2020-04-20 10:35:16'),
(12, 'Bifocal - Invisible Fotocromático AR Tallado\r\n', '2020-04-20 10:35:48'),
(13, 'Progresivos - Tallado', '2020-04-20 10:36:23'),
(14, 'Progresivos - Fotocromático Tallado', '2020-04-20 10:37:13'),
(15, 'Progresivos - Fotocromático Anti-Blue Convencional Tallado\r\n', '2020-04-20 10:37:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `password` text COLLATE utf8_spanish_ci NOT NULL,
  `perfil` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `usuario`, `password`, `perfil`, `foto`, `estado`, `ultimo_login`, `fecha`) VALUES
(1, 'Administrador', 'admin', '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 'Administrador', 'vistas/img/usuarios/admin/191.jpg', 1, '2020-04-20 08:17:33', '2020-04-20 13:17:33');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `codigo` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `productos` text COLLATE utf8_spanish_ci NOT NULL,
  `cristales` text COLLATE utf8_spanish_ci NOT NULL,
  `impuesto` float NOT NULL,
  `neto` float NOT NULL,
  `falta` float NOT NULL,
  `totaldolar` float NOT NULL,
  `total` float NOT NULL,
  `tasadeldia` float NOT NULL,
  `metodo_pago` text COLLATE utf8_spanish_ci NOT NULL,
  `metodo_pago_2` text COLLATE utf8_spanish_ci NOT NULL,
  `metodo_pago_3` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aumento`
--
ALTER TABLE `aumento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cristales`
--
ALTER TABLE `cristales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entre`
--
ALTER TABLE `entre`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entregados`
--
ALTER TABLE `entregados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `llegados`
--
ALTER TABLE `llegados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `local`
--
ALTER TABLE `local`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugar`
--
ALTER TABLE `lugar`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `terminados`
--
ALTER TABLE `terminados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo`
--
ALTER TABLE `tipo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aumento`
--
ALTER TABLE `aumento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `cristales`
--
ALTER TABLE `cristales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `entre`
--
ALTER TABLE `entre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `entregados`
--
ALTER TABLE `entregados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `laboratorio`
--
ALTER TABLE `laboratorio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `llegados`
--
ALTER TABLE `llegados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `local`
--
ALTER TABLE `local`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `lugar`
--
ALTER TABLE `lugar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT de la tabla `terminados`
--
ALTER TABLE `terminados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT de la tabla `tipo`
--
ALTER TABLE `tipo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
