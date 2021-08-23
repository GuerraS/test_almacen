-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-08-2021 a las 09:30:09
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
-- Base de datos: `control_inventario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_calidad`
--

CREATE TABLE `tbl_calidad` (
  `id_calidad` int(11) NOT NULL,
  `descripcion_calidad` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_calidad`
--

INSERT INTO `tbl_calidad` (`id_calidad`, `descripcion_calidad`) VALUES
(1, 'Baja'),
(2, 'Alta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_item`
--

CREATE TABLE `tbl_item` (
  `id_item` int(11) NOT NULL,
  `color` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `capacidad` mediumint(9) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `id_calidad` int(11) NOT NULL,
  `id_material` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_material`
--

CREATE TABLE `tbl_material` (
  `id_material` int(11) NOT NULL,
  `descripcion_material` varchar(60) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_material`
--

INSERT INTO `tbl_material` (`id_material`, `descripcion_material`) VALUES
(1, 'porcelana'),
(2, 'Yeso'),
(3, 'Cerámica'),
(4, 'Jade'),
(5, 'Barro'),
(6, 'Plástico'),
(8, 'Poliestireno');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_modelo`
--

CREATE TABLE `tbl_modelo` (
  `id_modelo` int(11) NOT NULL,
  `descripcion_modelo` varchar(60) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `tbl_modelo`
--

INSERT INTO `tbl_modelo` (`id_modelo`, `descripcion_modelo`) VALUES
(1, 'Sublimado sencillo'),
(2, 'Vinil'),
(3, 'Artesanal'),
(4, 'Taza mágica'),
(5, 'Vintage');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_movimientos`
--

CREATE TABLE `tbl_movimientos` (
  `id_movimento` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '1 = entries, 2 = exits',
  `entrie_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_calidad`
--
ALTER TABLE `tbl_calidad`
  ADD PRIMARY KEY (`id_calidad`);

--
-- Indices de la tabla `tbl_item`
--
ALTER TABLE `tbl_item`
  ADD PRIMARY KEY (`id_item`);

--
-- Indices de la tabla `tbl_material`
--
ALTER TABLE `tbl_material`
  ADD PRIMARY KEY (`id_material`);

--
-- Indices de la tabla `tbl_modelo`
--
ALTER TABLE `tbl_modelo`
  ADD PRIMARY KEY (`id_modelo`);

--
-- Indices de la tabla `tbl_movimientos`
--
ALTER TABLE `tbl_movimientos`
  ADD PRIMARY KEY (`id_movimento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_calidad`
--
ALTER TABLE `tbl_calidad`
  MODIFY `id_calidad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_item`
--
ALTER TABLE `tbl_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_material`
--
ALTER TABLE `tbl_material`
  MODIFY `id_material` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tbl_modelo`
--
ALTER TABLE `tbl_modelo`
  MODIFY `id_modelo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tbl_movimientos`
--
ALTER TABLE `tbl_movimientos`
  MODIFY `id_movimento` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
