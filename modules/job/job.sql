-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 30-10-2014 a las 20:26:02
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
-- Estructura de tabla para la tabla `job_messages`
--

CREATE TABLE IF NOT EXISTS `job_messages` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'type:email',
  `message` text NOT NULL,
  `file` varchar(100) NOT NULL COMMENT 'type:file',
  `read` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `job_messages`
--

INSERT INTO `job_messages` (`id`, `name`, `phone`, `email`, `message`, `file`, `read`, `created_at`) VALUES
(1, 'Test name', '123123123123', 'gsalgadotoledo@gmail.com', 'This is a test', 'APP.rar...', 0, '2014-10-28 21:10:06');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `job_messages`
--
ALTER TABLE `job_messages`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `job_messages`
--
ALTER TABLE `job_messages`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
