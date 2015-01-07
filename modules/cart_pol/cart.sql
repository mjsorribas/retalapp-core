-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-01-2015 a las 14:48:16
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `menteswe_itw`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_config`
--

CREATE TABLE IF NOT EXISTS `cart_config` (
`id` int(11) NOT NULL,
  `overall_tax` int(11) DEFAULT '0',
  `shipping_cost` float DEFAULT NULL,
  `shipping_data_required` tinyint(1) DEFAULT NULL,
  `editor_purchase_terms` text NOT NULL,
  `email_just_test` varchar(255) DEFAULT NULL,
  `pol_api_key` varchar(255) DEFAULT NULL,
  `pol_merchant_id` varchar(255) DEFAULT NULL,
  `pol_test` tinyint(1) DEFAULT NULL,
  `pol_currency` varchar(3) NOT NULL DEFAULT 'USD',
  `pol_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cart_config`
--

INSERT INTO `cart_config` (`id`, `overall_tax`, `shipping_cost`, `shipping_data_required`, `editor_purchase_terms`, `email_just_test`, `pol_api_key`, `pol_merchant_id`, `pol_test`, `pol_currency`, `pol_description`) VALUES
(1, 0, 0, 0, '<h1>Terminos y condiciones</h1>       <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>       <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>       <p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>', '', '', '', 1, 'COP', 'Compra en Preguntica');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_credits`
--

CREATE TABLE IF NOT EXISTS `cart_credits` (
`id` int(11) NOT NULL,
  `date_transaction` date NOT NULL COMMENT 'label:Fecha',
  `quantity` int(11) NOT NULL,
  `users_users_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `description` text NOT NULL,
  `value` int(11) NOT NULL,
  `state` tinyint(1) DEFAULT NULL COMMENT 'label:Estado de transacción',
  `secret_code` varchar(255) DEFAULT NULL COMMENT 'unique:1',
  `users_location_cities_id` int(11) DEFAULT NULL,
  `users_location_states_id` int(11) DEFAULT NULL,
  `sub` tinyint(1) DEFAULT '0',
  `expired_at` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Volcado de datos para la tabla `cart_credits`
--

INSERT INTO `cart_credits` (`id`, `date_transaction`, `quantity`, `users_users_id`, `created_at`, `description`, `value`, `state`, `secret_code`, `users_location_cities_id`, `users_location_states_id`, `sub`, `expired_at`) VALUES
(18, '2015-01-06', 50, 4, '2015-01-06 21:25:24', 'Agregado un código válido', 50, 1, '34hj42lk', 5004, 5, 0, '2015-01-26 21:25:24'),
(19, '2015-01-06', 50, 4, '2015-01-06 22:02:14', 'Agregado un código válido', 50, 1, '34hj44lk', 8078, 8, 0, '2015-01-26 22:02:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_log_purchases`
--

CREATE TABLE IF NOT EXISTS `cart_log_purchases` (
`id` int(11) NOT NULL,
  `level` varchar(128) DEFAULT NULL,
  `category` varchar(128) DEFAULT NULL,
  `logtime` int(11) DEFAULT NULL,
  `message` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_secret_codes`
--

CREATE TABLE IF NOT EXISTS `cart_secret_codes` (
`id` int(11) NOT NULL,
  `secret_code` varchar(100) NOT NULL COMMENT 'unique:1',
  `created_at` datetime NOT NULL,
  `state` tinyint(1) DEFAULT NULL,
  `cart_upload_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `cart_secret_codes`
--

INSERT INTO `cart_secret_codes` (`id`, `secret_code`, `created_at`, `state`, `cart_upload_id`) VALUES
(4, '34hj42lk', '2015-01-05 23:01:35', 0, 2),
(5, '34hj44lk', '2015-01-05 23:01:35', 0, 2),
(6, '34hj46lk', '2015-01-05 23:01:35', 1, 2),
(7, '34hj43lk', '2015-01-05 23:01:35', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_shipment_data`
--

CREATE TABLE IF NOT EXISTS `cart_shipment_data` (
`id` int(11) NOT NULL,
  `users_users_id` int(11) NOT NULL,
  `users_country_delivery_id` int(11) DEFAULT NULL,
  `users_state_delivery_id` int(11) DEFAULT NULL,
  `users_city_delivery_id` int(11) DEFAULT NULL,
  `address_delivery` varchar(255) NOT NULL,
  `contact_receiving` varchar(255) NOT NULL,
  `contact_phone` varchar(100) NOT NULL,
  `comment` text,
  `deliver_same_address` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `cart_shipment_data`
--

INSERT INTO `cart_shipment_data` (`id`, `users_users_id`, `users_country_delivery_id`, `users_state_delivery_id`, `users_city_delivery_id`, `address_delivery`, `contact_receiving`, `contact_phone`, `comment`, `deliver_same_address`) VALUES
(1, 4, NULL, 11, 11001, 'zxczxc', 'kjhkjh', '123123123', 'zxczxc', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_shoping_pending`
--

CREATE TABLE IF NOT EXISTS `cart_shoping_pending` (
`id` int(11) NOT NULL,
  `users_users_id` int(11) NOT NULL,
  `cart` text
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Volcado de datos para la tabla `cart_shoping_pending`
--

INSERT INTO `cart_shoping_pending` (`id`, `users_users_id`, `cart`) VALUES
(8, 4, 'a:13:{s:2:"id";N;s:9:"ref_venta";N;s:8:"users_id";N;s:13:"shipping_data";N;s:8:"form_pol";N;s:14:"cart_states_id";i:0;s:10:"created_at";s:19:"2015-01-05 17:03:39";s:10:"updated_at";s:19:"2015-01-05 17:03:39";s:5:"items";a:1:{i:0;a:9:{s:22:"cart_shoping_header_id";N;s:13:"table_related";s:15:"PremiosCatalogo";s:4:"type";s:15:"PremiosCatalogo";s:10:"product_id";s:2:"58";s:10:"unit_value";s:2:"60";s:8:"quantity";s:1:"1";s:8:"currency";s:3:"COP";s:8:"tax_rate";s:1:"0";s:10:"created_at";s:19:"2015-01-06 22:03:22";}}s:9:"sub_total";i:60;s:9:"total_tax";i:0;s:13:"shipping_cost";s:1:"0";s:5:"total";i:60;}'),
(9, 3, 'a:13:{s:2:"id";N;s:9:"ref_venta";N;s:8:"users_id";N;s:13:"shipping_data";N;s:8:"form_pol";N;s:14:"cart_states_id";i:0;s:10:"created_at";s:19:"2015-01-05 20:35:47";s:10:"updated_at";s:19:"2015-01-05 20:35:47";s:5:"items";a:0:{}s:9:"sub_total";i:0;s:9:"total_tax";i:0;s:13:"shipping_cost";s:1:"0";s:5:"total";i:0;}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_shopping_detail`
--

CREATE TABLE IF NOT EXISTS `cart_shopping_detail` (
`id` int(11) NOT NULL,
  `cart_shoping_header_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `table_related` varchar(255) NOT NULL,
  `unit_value` float NOT NULL,
  `currency` varchar(3) NOT NULL DEFAULT 'USD',
  `quantity` int(11) NOT NULL,
  `tax_rate` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `cart_shopping_detail`
--

INSERT INTO `cart_shopping_detail` (`id`, `cart_shoping_header_id`, `product_id`, `table_related`, `unit_value`, `currency`, `quantity`, `tax_rate`, `created_at`) VALUES
(1, 3, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:06:07'),
(2, 4, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:17:49'),
(3, 5, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:22:43'),
(4, 6, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:28:55'),
(5, 7, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:29:13'),
(6, 8, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:30:37'),
(7, 9, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:31:39'),
(8, 10, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:34:00'),
(9, 11, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:34:31'),
(10, 12, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:35:18'),
(11, 13, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 16:43:27'),
(12, 14, 4, 'PremiosCatalogo', 150, 'COP', 1, 0, '2015-01-05 16:46:22'),
(13, 15, 4, 'PremiosCatalogo', 150, 'COP', 3, 0, '2015-01-05 16:48:45'),
(14, 16, 4, 'PremiosCatalogo', 150, 'COP', 5, 0, '2015-01-05 16:51:50'),
(15, 17, 4, 'PremiosCatalogo', 150, 'COP', 2, 0, '2015-01-05 17:03:31'),
(16, 17, 6, 'PremiosCatalogo', 100, 'COP', 1, 0, '2015-01-05 17:03:31'),
(17, 17, 33, 'PremiosCatalogo', 150, 'COP', 1, 0, '2015-01-05 17:03:31'),
(18, 17, 28, 'PremiosCatalogo', 100, 'COP', 1, 0, '2015-01-05 17:03:31');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_shopping_header`
--

CREATE TABLE IF NOT EXISTS `cart_shopping_header` (
`id` int(11) NOT NULL,
  `ref_venta` varchar(50) DEFAULT NULL,
  `users_id` int(11) NOT NULL,
  `total` float NOT NULL,
  `shipping_cost` float DEFAULT NULL,
  `overall_tax` int(11) NOT NULL,
  `cart_states_id` int(11) NOT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `datetime_go_pay` datetime DEFAULT NULL,
  `datetime_return_pay` datetime DEFAULT NULL,
  `message_return_pay` text,
  `code_response_pay` varchar(100) DEFAULT NULL,
  `code2_response_pay` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Volcado de datos para la tabla `cart_shopping_header`
--

INSERT INTO `cart_shopping_header` (`id`, `ref_venta`, `users_id`, `total`, `shipping_cost`, `overall_tax`, `cart_states_id`, `signature`, `created_at`, `updated_at`, `datetime_go_pay`, `datetime_return_pay`, `message_return_pay`, `code_response_pay`, `code2_response_pay`) VALUES
(3, 'ITW00003', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:06:07', '2015-01-05 16:06:07', '2015-01-05 16:06:07', NULL, NULL, NULL, NULL),
(4, 'ITW00004', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:17:48', '2015-01-05 16:17:48', '2015-01-05 16:17:48', NULL, NULL, NULL, NULL),
(5, 'ITW00005', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:22:43', '2015-01-05 16:22:43', '2015-01-05 16:22:43', NULL, NULL, NULL, NULL),
(6, 'ITW00006', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:28:55', '2015-01-05 16:28:55', '2015-01-05 16:28:55', NULL, NULL, NULL, NULL),
(7, 'ITW00007', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:29:13', '2015-01-05 16:29:13', '2015-01-05 16:29:13', NULL, NULL, NULL, NULL),
(8, 'ITW00008', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:30:37', '2015-01-05 16:30:37', '2015-01-05 16:30:37', NULL, NULL, NULL, NULL),
(9, 'ITW00009', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:31:39', '2015-01-05 16:31:39', '2015-01-05 16:31:39', NULL, NULL, NULL, NULL),
(10, 'ITW00010', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:33:59', '2015-01-05 16:33:59', '2015-01-05 16:33:59', NULL, NULL, NULL, NULL),
(11, 'ITW00011', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:34:31', '2015-01-05 16:34:31', '2015-01-05 16:34:31', NULL, NULL, NULL, NULL),
(12, 'ITW00012', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:35:18', '2015-01-05 16:35:18', '2015-01-05 16:35:18', NULL, NULL, NULL, NULL),
(13, 'ITW00013', 4, 300, 0, 0, 1, NULL, '2015-01-05 16:43:27', '2015-01-05 16:43:27', '2015-01-05 16:43:27', NULL, NULL, NULL, NULL),
(14, 'ITW00014', 4, 150, 0, 0, 1, NULL, '2015-01-05 16:46:21', '2015-01-05 16:46:21', '2015-01-05 16:46:21', NULL, NULL, NULL, NULL),
(15, 'ITW00015', 4, 450, 0, 0, 1, NULL, '2015-01-05 16:48:45', '2015-01-05 16:48:45', '2015-01-05 16:48:45', NULL, NULL, NULL, NULL),
(16, 'ITW00016', 4, 750, 0, 0, 1, NULL, '2015-01-05 16:51:49', '2015-01-05 16:51:49', '2015-01-05 16:51:49', NULL, NULL, NULL, NULL),
(17, 'ITW00017', 4, 650, 0, 0, 1, NULL, '2015-01-05 17:03:31', '2015-01-05 17:03:31', '2015-01-05 17:03:31', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_states`
--

CREATE TABLE IF NOT EXISTS `cart_states` (
`id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `icon_class` varchar(100) NOT NULL,
  `class_status` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `cart_states`
--

INSERT INTO `cart_states` (`id`, `description`, `icon_class`, `class_status`) VALUES
(1, 'Registro', 'fa-exclamation-circle', 'default'),
(2, 'Pendiente', 'fa-exclamation-triangle', 'warning'),
(3, 'Aprobado', 'fa-check-circle', 'success'),
(4, 'Rechazado', 'fa-ban', 'danger');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cart_upload`
--

CREATE TABLE IF NOT EXISTS `cart_upload` (
`id` int(11) NOT NULL,
  `file` varchar(100) NOT NULL COMMENT 'type:file;ext:csv',
  `created_at` datetime NOT NULL,
  `users_users_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `cart_upload`
--

INSERT INTO `cart_upload` (`id`, `file`, `created_at`, `users_users_id`) VALUES
(1, '1420495204.csv', '2015-01-05 23:00:06', 3),
(2, '1420495294.csv', '2015-01-05 23:01:35', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart_config`
--
ALTER TABLE `cart_config`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_credits`
--
ALTER TABLE `cart_credits`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_log_purchases`
--
ALTER TABLE `cart_log_purchases`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_secret_codes`
--
ALTER TABLE `cart_secret_codes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_shipment_data`
--
ALTER TABLE `cart_shipment_data`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_shoping_pending`
--
ALTER TABLE `cart_shoping_pending`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_shopping_detail`
--
ALTER TABLE `cart_shopping_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_shopping_header`
--
ALTER TABLE `cart_shopping_header`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_states`
--
ALTER TABLE `cart_states`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_upload`
--
ALTER TABLE `cart_upload`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart_config`
--
ALTER TABLE `cart_config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cart_credits`
--
ALTER TABLE `cart_credits`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT de la tabla `cart_log_purchases`
--
ALTER TABLE `cart_log_purchases`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cart_secret_codes`
--
ALTER TABLE `cart_secret_codes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT de la tabla `cart_shipment_data`
--
ALTER TABLE `cart_shipment_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cart_shoping_pending`
--
ALTER TABLE `cart_shoping_pending`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT de la tabla `cart_shopping_detail`
--
ALTER TABLE `cart_shopping_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `cart_shopping_header`
--
ALTER TABLE `cart_shopping_header`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT de la tabla `cart_states`
--
ALTER TABLE `cart_states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de la tabla `cart_upload`
--
ALTER TABLE `cart_upload`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;