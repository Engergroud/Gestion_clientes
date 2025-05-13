-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3310
-- Tiempo de generación: 13-05-2025 a las 20:57:57
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestion_clientes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudades`
--

CREATE TABLE `ciudades` (
  `id_ciudad` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ciudades`
--

INSERT INTO `ciudades` (`id_ciudad`, `nombre`) VALUES
(1, 'Santo Domingo'),
(2, 'Santiago de los Caballeros'),
(3, 'San Pedro de Macorís'),
(4, 'La Romana'),
(5, 'San Francisco de Macorís'),
(6, 'San Cristóbal'),
(7, 'La Vega'),
(8, 'Puerto Plata'),
(9, 'Higüey'),
(10, 'Bonao'),
(11, 'Moca'),
(12, 'San Juan de la Maguana'),
(13, 'Barahona'),
(14, 'Baní'),
(15, 'Nagua'),
(16, 'Azua'),
(17, 'Hato Mayor del Rey'),
(18, 'Monte Plata'),
(19, 'Cotuí'),
(20, 'Salcedo'),
(21, 'San José de Ocoa'),
(22, 'Dajabón'),
(23, 'El Seibo'),
(24, 'Monte Cristi'),
(25, 'Samaná'),
(26, 'Pedernales'),
(27, 'Duvergé'),
(28, 'Sabana Grande de Boyá'),
(29, 'Villa Altagracia'),
(30, 'Jarabacoa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `rnc` varchar(20) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `id_ciudad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `nombre`, `rnc`, `telefono`, `direccion`, `id_ciudad`) VALUES
(314, 'Enger', '51235712', '8097054361', 'Pantojas, Renovacion #30', 14),
(315, 'Jeffry', '12365123', '8097054361', 'Pantojas, Renovacion #30', 19),
(317, 'Smerlyn', '1290823', '8492632454', 'Santo Dominco Renovacion Pantoja', 29);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  ADD PRIMARY KEY (`id_ciudad`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `clientes_ciduades` (`id_ciudad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudades`
--
ALTER TABLE `ciudades`
  MODIFY `id_ciudad` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=318;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `clientes_ciduades` FOREIGN KEY (`id_ciudad`) REFERENCES `ciudades` (`id_ciudad`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
