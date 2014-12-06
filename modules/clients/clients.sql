-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2014 a las 03:18:04
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
-- Estructura de tabla para la tabla `clients_items`
--

CREATE TABLE IF NOT EXISTS `clients_items` (
`id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img',
  `image_hover` varchar(100) NOT NULL COMMENT 'type:img',
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `clients_items`
--

INSERT INTO `clients_items` (`id`, `image`, `image_hover`, `orden_id`) VALUES
(1, '1417254874.jpg', '1417254887.jpg', 1),
(2, '1417254905.jpg', '1417254923.jpg', 2),
(3, '1417254945.jpg', '1417254953.jpg', 3),
(4, '1417254969.jpg', '1417254980.jpg', 4),
(5, '1417254995.jpg', '1417255005.jpg', 5),
(6, '1417255020.jpg', '1417255033.jpg', 6),
(7, '1417255046.jpg', '1417255052.jpg', 7),
(8, '1417255100.jpg', '1417255109.jpg', 8),
(9, '1417255121.jpg', '1417255127.jpg', 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clients_items`
--
ALTER TABLE `clients_items`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clients_items`
--
ALTER TABLE `clients_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
