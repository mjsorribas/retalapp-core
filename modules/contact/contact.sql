-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2014 a las 03:10:35
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
-- Estructura de tabla para la tabla `contact_info`
--

CREATE TABLE IF NOT EXISTS `contact_info` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'type:email',
  `title` varchar(100) NOT NULL,
  `subtitle` varchar(100) NOT NULL,
  `contact_text` text NOT NULL,
  `address` varchar(266) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `facebook` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `twitter` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `google_plus` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `linked_in` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `youtube` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `skype` varchar(255) DEFAULT NULL,
  `map_address` varchar(255) NOT NULL COMMENT 'type:map',
  `map_address_lat` float NOT NULL,
  `map_address_lng` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `contact_info`
--

INSERT INTO `contact_info` (`id`, `email`, `title`, `subtitle`, `contact_text`, `address`, `phone`, `facebook`, `twitter`, `google_plus`, `linked_in`, `youtube`, `skype`, `map_address`, `map_address_lat`, `map_address_lng`) VALUES
(1, 'info@mycompany.com', 'STAY IN TOUCH', 'LOREM IPSUM DOLOR SIT AMET', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec lorem quis est ultrices volutpat.', '212-222 Broadway, New York, NY 10038, USA', '+420-123-456-789', 'http://facebook.com', 'https://twitter.com', 'https://google.com', 'https://linkedin.com', 'https://youtube.com', 'myskypeaccount', 'Carrera 67 # 106-1 a 106-99, Bogotá, Cundinamarca, Colombia', 4.68939, -74.0624);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_messages`
--

CREATE TABLE IF NOT EXISTS `contact_messages` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(255) NOT NULL COMMENT 'type:email',
  `message` text NOT NULL,
  `read` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contact_news`
--

CREATE TABLE IF NOT EXISTS `contact_news` (
`id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'type:email',
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `contact_news`
--



--
-- Indices de la tabla `contact_info`
--
ALTER TABLE `contact_info`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contact_messages`
--
ALTER TABLE `contact_messages`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `contact_news`
--
ALTER TABLE `contact_news`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contact_info`
--
ALTER TABLE `contact_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `contact_messages`
--
ALTER TABLE `contact_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `contact_news`
--
ALTER TABLE `contact_news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
