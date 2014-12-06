-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2014 a las 03:17:01
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `host_page`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `price_features`
--

CREATE TABLE IF NOT EXISTS `price_features` (
`id` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL COMMENT 'type:icon',
  `name` varchar(100) NOT NULL,
  `price_items_id` int(11) NOT NULL,
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Volcado de datos para la tabla `price_features`
--

INSERT INTO `price_features` (`id`, `icon`, `name`, `price_items_id`, `orden_id`) VALUES
(1, 'fa-building', '100 GB Storage', 1, 1),
(2, 'fa-bar-chart-o', 'Unlimited Traffic', 1, 2),
(3, 'fa-tasks', 'Unlimited Bandwidth', 1, 3),
(4, 'fa-suitcase', 'Custom Domain', 1, 4),
(5, 'fa-user', '24/7 Support', 1, 5),
(6, 'fa-building', '100 GB Storage', 2, 1),
(7, 'fa-bar-chart-o', 'Unlimited Traffic', 2, 2),
(8, 'fa-tasks', 'Unlimited Bandwidth', 2, 3),
(9, 'fa-suitcase', 'Custom Domain', 2, 4),
(10, 'fa-user', '24/7 Support', 2, 5),
(11, 'fa-building', '100 GB Storage', 3, 1),
(12, 'fa-bar-chart-o', 'Unlimited Traffic', 3, 2),
(13, 'fa-tasks', 'Unlimited Bandwidth', 3, 3),
(14, 'fa-suitcase', 'Custom Domain', 3, 4),
(15, 'fa-user', '24/7 Support', 3, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `price_items`
--

CREATE TABLE IF NOT EXISTS `price_items` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `price` float(10,2) NOT NULL COMMENT 'type:money',
  `pay_per` varchar(100) NOT NULL,
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `price_items`
--

INSERT INTO `price_items` (`id`, `name`, `subtitle`, `price`, `pay_per`, `orden_id`) VALUES
(1, 'BASIC', '', 29.99, 'per month', 1),
(2, 'STANDARD', 'MOST POPULAR', 39.99, 'per month', 2),
(3, 'PREMIUM', '', 49.99, 'per month', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `price_features`
--
ALTER TABLE `price_features`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `price_items`
--
ALTER TABLE `price_items`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `price_features`
--
ALTER TABLE `price_features`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT de la tabla `price_items`
--
ALTER TABLE `price_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
