-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 06-12-2014 a las 03:12:18
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
-- Estructura de tabla para la tabla `blog_author`
--

CREATE TABLE IF NOT EXISTS `blog_author` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img',
  `email` varchar(255) NOT NULL COMMENT 'type:email'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `blog_author`
--

INSERT INTO `blog_author` (`id`, `name`, `description`, `image`, `email`) VALUES
(1, 'John Doe', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Curabitur posuere vel nisi et scelerisque. Curabitur posuere vel nisi et scelerisque.', '1417226130.jpg', 'johndoe@website.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog_posts`
--

CREATE TABLE IF NOT EXISTS `blog_posts` (
`id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL COMMENT 'type:select;table:blog_author',
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL COMMENT 'type:redactor',
  `youtube` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `vimeo` varchar(255) DEFAULT NULL COMMENT 'type:link',
  `image` varchar(100) DEFAULT NULL COMMENT 'type:img',
  `orden_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `author_id`, `title`, `text`, `youtube`, `vimeo`, `image`, `orden_id`, `created_at`) VALUES
(1, 1, 'Blog post with Vimeo video', '<p>\r\n	<span style="background-color: initial;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</span>\r\n</p>', '', 'https://vimeo.com/23617801', '', 1, '2014-11-29 03:01:31'),
(2, 1, 'This is a test', '<p>\r\n	<span style="background-color: initial;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</span>\r\n</p>', '', '', '1417228461.JPG', 1, '2014-11-29 03:01:31'),
(3, 1, 'My Blog sample', '<p>\r\n	 <span style="background-color: initial;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</span>\r\n</p>', '', '', '1417228147.jpg', 1, '2014-11-29 03:01:31'),
(4, 1, 'My own blog', '<p>\r\n	<span style="background-color: initial;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</span>\r\n</p>', '', '', '', 1, '2014-11-29 03:01:31'),
(5, 1, 'This is important test', '<p>\r\n	<span style="background-color: initial;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</span>\r\n</p>', '', '', '', 1, '2014-11-29 03:01:31'),
(6, 1, 'Hi everybody', '<p>\r\n	<span style="background-color: initial;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</span>\r\n</p>', '', '', '', 1, '2014-11-29 03:01:31'),
(7, 1, 'One two three four five', '<p>\r\n	<span style="background-color: initial;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam auctor dictum nibh, ac gravida orci porttitor et. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Nullam posuere magna a dapibus luctus. Curabitur posuere vel nisi et scelerisque. Praesent imperdiet sed enim et ornare. In congue quis enim ut gravida. Aenean non justo varius, dapibus ipsum eu, mattis urna.</span>\r\n</p>', '', '', '', 1, '2014-11-29 03:01:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `blog_author`
--
ALTER TABLE `blog_author`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `blog_posts`
--
ALTER TABLE `blog_posts`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `blog_author`
--
ALTER TABLE `blog_author`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `blog_posts`
--
ALTER TABLE `blog_posts`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
