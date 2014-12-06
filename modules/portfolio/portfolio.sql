-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-10-2014 a las 20:27:29
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
-- Estructura de tabla para la tabla `portfolio_categories`
--

CREATE TABLE IF NOT EXISTS `portfolio_categories` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img',
  `description` text NOT NULL,
  `orden_id` int(11) NOT NULL,
  `color` varchar(8) NOT NULL COMMENT 'type:color'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `portfolio_categories`
--

INSERT INTO `portfolio_categories` (`id`, `name`, `image`, `description`, `orden_id`, `color`) VALUES
(1, 'Publicidad', '1414511210.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 1, 'ff7f7f'),
(2, 'Cine y Tv', '1414511231.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 2, '61e8e8'),
(3, 'Entretenimiento', '1414511246.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 3, 'f5ee62'),
(4, 'En Vivo', '1414511259.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 4, '87faa6');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portfolio_items`
--

CREATE TABLE IF NOT EXISTS `portfolio_items` (
`id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `preview` varchar(100) NOT NULL COMMENT 'type:img',
  `image` varchar(100) DEFAULT NULL COMMENT 'type:img',
  `video` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `audio` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `prominent` tinyint(1) NOT NULL,
  `created_at` double NOT NULL,
  `orden_id` int(11) NOT NULL,
  `portfolio_categories_id` int(11) NOT NULL COMMENT 'type:select;table:portfolio_categories'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `portfolio_items`
--

INSERT INTO `portfolio_items` (`id`, `title`, `date`, `preview`, `image`, `video`, `audio`, `prominent`, `created_at`, `orden_id`, `portfolio_categories_id`) VALUES
(1, 'Portfolio1', '2014-10-30', '1414453224.png', '1414453229.png', '', '', 1, 2014, 1, 1),
(2, 'Portfolio2', '2014-10-23', '1414453255.png', '1414453258.png', '', '', 1, 2014, 2, 1),
(3, 'Portfolio3', '2014-10-13', '1414453290.png', '1414453295.png', '', '', 1, 2014, 3, 2),
(4, 'Portfolio4', '2014-10-25', '1414453321.png', '1414453325.png', '', '', 0, 2014, 4, 3),
(5, 'Portfolio5', '2014-12-12', '1414453347.png', '1414453352.png', '', '', 1, 2014, 5, 4),
(6, 'Portfolio6', '2014-12-20', '1414453378.png', '1414453382.png', '', '', 1, 2014, 6, 4),
(7, 'Portfolio7', '2014-12-19', '1414453406.png', '1414453410.png', '', '', 1, 2014, 7, 3),
(8, 'Portfolio8', '2014-10-07', '1414453434.png', '1414453440.png', '', '', 1, 2014, 8, 4),
(9, 'Portfolio9', '2014-10-21', '1414453472.png', '1414453476.png', '', '', 0, 2014, 9, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `portfolio_text`
--

CREATE TABLE IF NOT EXISTS `portfolio_text` (
`id` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `portfolio_text`
--

INSERT INTO `portfolio_text` (`id`, `text`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `portfolio_items`
--
ALTER TABLE `portfolio_items`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `portfolio_text`
--
ALTER TABLE `portfolio_text`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `portfolio_categories`
--
ALTER TABLE `portfolio_categories`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `portfolio_items`
--
ALTER TABLE `portfolio_items`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `portfolio_text`
--
ALTER TABLE `portfolio_text`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
