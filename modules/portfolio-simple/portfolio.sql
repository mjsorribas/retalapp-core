-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2014 a las 03:15:24
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
-- Estructura de tabla para la tabla `portfolio_items`
--

CREATE TABLE IF NOT EXISTS `portfolio_items` (
`id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img',
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `link` varchar(255) NOT NULL COMMENT 'type:link',
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `portfolio_items`
--

INSERT INTO `portfolio_items` (`id`, `image`, `name`, `description`, `link`, `orden_id`) VALUES
(1, '1417261915.jpg', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec lorem quis est ultrices volutpat.', 'https://www.google.com/', 1),
(2, '1417261932.jpg', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec lorem quis est ultrices volutpat.', 'https://www.google.com/', 2),
(3, '1417261979.jpg', 'Lorem ipsum dolor sit amet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec lorem quis est ultrices volutpat.', 'https://www.google.com/', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `portfolio_items`
--
ALTER TABLE `portfolio_items`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `portfolio_items`
--
ALTER TABLE `portfolio_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
