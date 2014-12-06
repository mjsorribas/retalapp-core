-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-10-2014 a las 20:26:41
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `retalapp_base`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `location_gps`
--

CREATE TABLE IF NOT EXISTS `location_gps` (
`id` int(11) NOT NULL,
  `map_address` varchar(255) NOT NULL,
  `map_address_lat` float NOT NULL,
  `map_address_lng` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `location_gps`
--

INSERT INTO `location_gps` (`id`, `map_address`, `map_address_lat`, `map_address_lng`) VALUES
(1, 'Carrera 27 # 30-2 a 30-100, Palmira, Valle Del Cauca, Colombia', 3.52717, -76.2977);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `location_gps`
--
ALTER TABLE `location_gps`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `location_gps`
--
ALTER TABLE `location_gps`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
