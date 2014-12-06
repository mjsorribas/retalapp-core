-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-10-2014 a las 20:28:10
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
-- Estructura de tabla para la tabla `team_items`
--

CREATE TABLE IF NOT EXISTS `team_items` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `position` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL COMMENT 'type:img',
  `description` text NOT NULL,
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `team_items`
--

INSERT INTO `team_items` (`id`, `name`, `position`, `image`, `description`, `orden_id`) VALUES
(1, 'Juan Gonzalez', 'Diseñador', '1414502017.png', 'This is a test description', 1),
(2, 'Pedro Perez', 'SEO', '1414502082.png', 'This is a test description', 2),
(3, 'Luis Perez', 'Founder', '1414502114.png', 'This is a test description', 3),
(4, 'Harol Suarez', 'Vendedor', '1414502152.png', 'This is a test description', 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `team_items`
--
ALTER TABLE `team_items`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `team_items`
--
ALTER TABLE `team_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
