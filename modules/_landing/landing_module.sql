-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 11-11-2014 a las 15:46:19
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `retalapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_contact_info`
--

CREATE TABLE IF NOT EXISTS `landing_contact_info` (
`id` int(11) NOT NULL,
  `call_to_action` text,
  `email` varchar(255) DEFAULT NULL COMMENT 'type:email',
  `phone` varchar(100) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `google_plus` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `twitter` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `linkedin` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `dribbble` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `youtube` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `pinterest` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `skype` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `github` varchar(255) DEFAULT NULL COMMENT 'type:link'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `landing_contact_info`
--

INSERT INTO `landing_contact_info` (`id`, `call_to_action`, `email`, `phone`, `facebook`, `google_plus`, `twitter`, `linkedin`, `dribbble`, `youtube`, `pinterest`, `skype`, `instagram`, `github`) VALUES
(1, 'LET''S GET STARTED', 'info@yourcompani.com', '(571) 999-999-999', 'https://www.facebook.com/', 'https://plus.google.com/', 'https://twitter.com/', 'https://www.linkedin.com/', '', 'https://www.youtube.com', '', '', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_elements`
--

CREATE TABLE IF NOT EXISTS `landing_elements` (
`id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img',
  `name` varchar(100) NOT NULL,
  `module` varchar(255) NOT NULL COMMENT 'type:select',
  `type` varchar(100) NOT NULL COMMENT 'type:select',
  `landing_elements_positions_id` int(10) NOT NULL COMMENT 'type:select;table:landing_elements_positions',
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `landing_elements`
--

INSERT INTO `landing_elements` (`id`, `image`, `name`, `module`, `type`, `landing_elements_positions_id`, `orden_id`) VALUES
(1, 'Empty for now', 'Same for now', 'landing', 'menu-1', 1, 1),
(3, 'Empty for now', 'Same for now', 'landing', 'footer-1', 3, 1),
(4, 'Empty for now', 'Same for now', 'landing', 'footer-small-1', 3, 2),
(26, 'Empty for now', 'Same for now', 'landing', 'content-1', 2, 1),
(27, 'Empty for now', 'Same for now', 'landing', 'header-slider-1', 2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_elements_positions`
--

CREATE TABLE IF NOT EXISTS `landing_elements_positions` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `landing_elements_positions`
--

INSERT INTO `landing_elements_positions` (`id`, `name`) VALUES
(1, 'Header'),
(2, 'Content'),
(3, 'Footer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `landing_elements_slider`
--

CREATE TABLE IF NOT EXISTS `landing_elements_slider` (
`id` int(11) NOT NULL,
  `image` varchar(100) DEFAULT NULL COMMENT 'type:img',
  `title` varchar(100) NOT NULL,
  `text` text NOT NULL,
  `orden_id` int(11) NOT NULL,
  `link` varchar(100) NOT NULL COMMENT 'type:link'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `landing_elements_slider`
--

INSERT INTO `landing_elements_slider` (`id`, `image`, `title`, `text`, `orden_id`, `link`) VALUES
(1, '', 'This is a theme made for Start Bootstrap', 'Free Bootstrap Themes & Templates', 1, 'http://startbootstrap.com/');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `landing_contact_info`
--
ALTER TABLE `landing_contact_info`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `landing_elements`
--
ALTER TABLE `landing_elements`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `landing_elements_positions`
--
ALTER TABLE `landing_elements_positions`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `landing_elements_slider`
--
ALTER TABLE `landing_elements_slider`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `landing_contact_info`
--
ALTER TABLE `landing_contact_info`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `landing_elements`
--
ALTER TABLE `landing_elements`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT de la tabla `landing_elements_positions`
--
ALTER TABLE `landing_elements_positions`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `landing_elements_slider`
--
ALTER TABLE `landing_elements_slider`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
