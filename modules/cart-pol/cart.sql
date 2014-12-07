-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 07-12-2014 a las 23:34:55
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pregunti_preguntica`
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
(1, 4, NULL, NULL, 3, 'kjhkjhkjh kjh kj', 'kjhkjh', '65765767676', 'This is a test', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=135 ;

--
-- Volcado de datos para la tabla `cart_shopping_detail`
--

INSERT INTO `cart_shopping_detail` (`id`, `cart_shoping_header_id`, `product_id`, `table_related`, `unit_value`, `currency`, `quantity`, `tax_rate`, `created_at`) VALUES
(1, 1, 4, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:36:02'),
(2, 1, 5, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:36:02'),
(3, 1, 6, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:36:02'),
(4, 1, 7, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:36:02'),
(5, 2, 4, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:37:51'),
(6, 2, 5, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:37:51'),
(7, 2, 6, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:37:51'),
(8, 2, 7, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:37:51'),
(9, 2, 8, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:37:51'),
(10, 3, 9, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:56:23'),
(11, 4, 9, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:56:30'),
(12, 4, 10, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 19:56:30'),
(13, 5, 9, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:05:47'),
(14, 5, 10, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:05:47'),
(15, 5, 11, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:05:47'),
(16, 6, 9, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:15:52'),
(17, 6, 10, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:15:52'),
(18, 6, 11, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:15:52'),
(19, 6, 12, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:15:52'),
(20, 7, 9, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:58:41'),
(21, 7, 10, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:58:41'),
(22, 7, 11, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:58:41'),
(23, 7, 12, 'PreguntanosPreguntas', 100000, 'COP', 1, 16, '2014-09-28 20:58:41'),
(24, 7, 13, 'PreguntanosPreguntas', 104000, 'COP', 1, 16, '2014-09-28 20:58:41'),
(25, 8, 14, 'PreguntanosPreguntas', 103000, 'COP', 1, 16, '2014-09-28 21:05:01'),
(26, 9, 15, 'PreguntanosPreguntas', 102000, 'COP', 1, 16, '2014-09-28 21:11:02'),
(27, 10, 16, 'PreguntanosPreguntas', 103000, 'COP', 1, 0, '2014-09-28 21:13:02'),
(28, 11, 17, 'PreguntanosPreguntas', 102000, 'COP', 1, 0, '2014-09-28 21:21:50'),
(29, 12, 18, 'PreguntanosPreguntas', 102000, 'COP', 1, 0, '2014-09-28 21:21:57'),
(30, 13, 19, 'PreguntanosPreguntas', 102000, 'COP', 1, 0, '2014-09-28 21:24:10'),
(31, 14, 20, 'PreguntanosPreguntas', 102000, 'COP', 1, 0, '2014-09-28 21:24:19'),
(32, 15, 21, 'PreguntanosPreguntas', 104000, 'COP', 1, 0, '2014-09-28 21:32:15'),
(33, 16, 22, 'PreguntanosPreguntas', 100000, 'COP', 1, 0, '2014-09-28 21:35:00'),
(34, 17, 23, 'PreguntanosPreguntas', 103000, 'COP', 1, 0, '2014-09-28 21:35:20'),
(35, 18, 24, 'PreguntanosPreguntas', 4200, 'COP', 1, 0, '2014-09-28 21:37:47'),
(36, 19, 25, 'PreguntanosPreguntas', 3200, 'COP', 1, 0, '2014-09-29 21:16:15'),
(37, 20, 26, 'PreguntanosPreguntas', 2200, 'COP', 1, 0, '2014-09-29 21:16:53'),
(38, 21, 27, 'PreguntanosPreguntas', 200.02, 'COP', 1, 0, '2014-09-29 22:15:24'),
(39, 22, 28, 'PreguntanosPreguntas', 200.02, 'COP', 1, 0, '2014-09-30 05:13:19'),
(40, 23, 29, 'PreguntanosPreguntas', 200.02, 'COP', 1, 0, '2014-10-01 21:09:25'),
(41, 24, 30, 'PreguntanosPreguntas', 200.02, 'COP', 1, 0, '2014-10-01 21:09:30'),
(42, 25, 31, 'PreguntanosPreguntas', 4200, 'COP', 1, 0, '2014-10-05 23:35:41'),
(43, 26, 32, 'PreguntanosPreguntas', 65010, 'COP', 1, 0, '2014-10-12 09:04:09'),
(44, 27, 33, 'PreguntanosPreguntas', 21000, 'COP', 1, 0, '2014-10-12 11:44:44'),
(45, 28, 34, 'PreguntanosPreguntas', 70000, 'COP', 1, 0, '2014-10-12 12:31:00'),
(46, 29, 35, 'PreguntanosPreguntas', 31000, 'COP', 1, 0, '2014-10-12 17:30:31'),
(47, 30, 36, 'PreguntanosPreguntas', 24000, 'COP', 1, 0, '2014-10-12 17:31:36'),
(48, 31, 37, 'PreguntanosPreguntas', 65000, 'COP', 1, 0, '2014-10-12 17:32:47'),
(49, 32, 38, 'PreguntanosPreguntas', 36000, 'COP', 1, 0, '2014-10-12 18:10:08'),
(50, 33, 39, 'PreguntanosPreguntas', 26000, 'COP', 1, 0, '2014-10-12 21:14:23'),
(51, 34, 40, 'PreguntanosPreguntas', 75000, 'COP', 1, 0, '2014-10-13 19:05:12'),
(52, 35, 41, 'PreguntanosPreguntas', 70000, 'COP', 1, 0, '2014-10-13 19:16:35'),
(53, 36, 42, 'PreguntanosPreguntas', 70000, 'COP', 1, 0, '2014-10-13 19:35:38'),
(54, 37, 43, 'PreguntanosPreguntas', 45000, 'COP', 1, 0, '2014-10-21 10:03:52'),
(55, 38, 44, 'PreguntanosPreguntas', 45000, 'COP', 1, 0, '2014-10-21 10:04:03'),
(56, 39, 45, 'PreguntanosPreguntas', 42000, 'COP', 1, 0, '2014-10-21 12:07:52'),
(57, 40, 46, 'PreguntanosPreguntas', 42000, 'COP', 1, 0, '2014-10-21 12:11:18'),
(58, 41, 47, 'PreguntanosPreguntas', 26000, 'COP', 1, 0, '2014-10-25 17:51:47'),
(59, 42, 48, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-10-25 19:55:01'),
(60, 43, 49, 'PreguntanosPreguntas', 70000, 'COP', 1, 0, '2014-10-26 09:19:09'),
(61, 44, 50, 'PreguntanosPreguntas', 65000, 'COP', 1, 0, '2014-10-26 09:25:10'),
(62, 45, 51, 'PreguntanosPreguntas', 21000, 'COP', 1, 0, '2014-10-26 11:32:07'),
(63, 46, 52, 'PreguntanosPreguntas', 25000, 'COP', 1, 0, '2014-10-26 11:34:07'),
(64, 47, 53, 'PreguntanosPreguntas', 64000, 'COP', 1, 0, '2014-10-26 12:44:07'),
(65, 48, 54, 'PreguntanosPreguntas', 69000, 'COP', 1, 0, '2014-10-26 13:01:57'),
(66, 49, 55, 'PreguntanosPreguntas', 45000, 'COP', 1, 0, '2014-10-27 21:43:53'),
(67, 50, 56, 'PreguntanosPreguntas', 36000, 'COP', 1, 0, '2014-10-27 22:02:42'),
(68, 51, 57, 'PreguntanosPreguntas', 70000, 'COP', 1, 0, '2014-10-28 22:12:56'),
(69, 52, 58, 'PreguntanosPreguntas', 33000, 'COP', 1, 0, '2014-11-02 16:39:49'),
(70, 53, 59, 'PreguntanosPreguntas', 62000, 'COP', 1, 0, '2014-11-02 16:45:44'),
(71, 54, 60, 'PreguntanosPreguntas', 28000, 'COP', 1, 0, '2014-11-02 19:01:50'),
(72, 55, 61, 'PreguntanosPreguntas', 62000, 'COP', 1, 0, '2014-11-02 19:03:51'),
(73, 56, 62, 'PreguntanosPreguntas', 33000, 'COP', 1, 0, '2014-11-02 19:05:22'),
(74, 57, 63, 'PreguntanosPreguntas', 62000, 'COP', 1, 0, '2014-11-02 19:06:48'),
(75, 58, 64, 'PreguntanosPreguntas', 23000, 'COP', 1, 0, '2014-11-02 19:08:05'),
(76, 59, 65, 'PreguntanosPreguntas', 24000, 'COP', 1, 0, '2014-11-02 19:11:27'),
(77, 60, 66, 'PreguntanosPreguntas', 24000, 'COP', 1, 0, '2014-11-02 21:18:30'),
(78, 61, 67, 'PreguntanosPreguntas', 27000, 'COP', 1, 0, '2014-11-02 21:20:15'),
(79, 62, 68, 'PreguntanosPreguntas', 33000, 'COP', 1, 0, '2014-11-02 21:23:15'),
(80, 63, 69, 'PreguntanosPreguntas', 75000, 'COP', 1, 0, '2014-11-02 21:30:53'),
(81, 64, 70, 'PreguntanosPreguntas', 26000, 'COP', 1, 0, '2014-11-02 21:33:34'),
(82, 65, 71, 'PreguntanosPreguntas', 71000, 'COP', 1, 0, '2014-11-02 21:35:28'),
(83, 66, 72, 'PreguntanosPreguntas', 65000, 'COP', 1, 0, '2014-11-02 21:39:50'),
(84, 67, 73, 'PreguntanosPreguntas', 75000, 'COP', 1, 0, '2014-11-02 21:44:41'),
(85, 68, 74, 'PreguntanosPreguntas', 26000, 'COP', 1, 0, '2014-11-02 21:46:25'),
(86, 69, 75, 'PreguntanosPreguntas', 36000, 'COP', 1, 0, '2014-11-02 21:54:01'),
(87, 70, 76, 'PreguntanosPreguntas', 36000, 'COP', 1, 0, '2014-11-02 21:56:54'),
(88, 71, 77, 'PreguntanosPreguntas', 75000, 'COP', 1, 0, '2014-11-02 21:59:39'),
(89, 72, 78, 'PreguntanosPreguntas', 26000, 'COP', 1, 0, '2014-11-02 22:02:03'),
(90, 73, 79, 'PreguntanosPreguntas', 31000, 'COP', 1, 0, '2014-11-02 22:03:30'),
(91, 74, 80, 'PreguntanosPreguntas', 26000, 'COP', 1, 0, '2014-11-02 22:04:50'),
(92, 75, 81, 'PreguntanosPreguntas', 67000, 'COP', 1, 0, '2014-11-03 13:09:31'),
(93, 76, 82, 'PreguntanosPreguntas', 36000, 'COP', 1, 0, '2014-11-03 13:20:49'),
(94, 77, 83, 'PreguntanosPreguntas', 26000, 'COP', 1, 0, '2014-11-09 21:34:20'),
(95, 78, 84, 'PreguntanosPreguntas', 24000, 'COP', 1, 0, '2014-11-13 09:01:02'),
(96, 79, 85, 'PreguntanosPreguntas', 21000, 'COP', 1, 0, '2014-11-13 09:08:02'),
(97, 80, 86, 'PreguntanosPreguntas', 21000, 'COP', 1, 0, '2014-11-13 09:08:45'),
(98, 81, 87, 'PreguntanosPreguntas', 45000, 'COP', 1, 0, '2014-11-13 10:38:42'),
(99, 82, 88, 'PreguntanosPreguntas', 39000, 'COP', 1, 0, '2014-11-13 10:40:24'),
(100, 83, 89, 'PreguntanosPreguntas', 20000, 'COP', 1, 0, '2014-11-13 10:41:40'),
(101, 84, 90, 'PreguntanosPreguntas', 20000, 'COP', 1, 0, '2014-11-13 15:58:56'),
(102, 85, 91, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-13 17:11:33'),
(103, 86, 92, 'PreguntanosPreguntas', 30000, 'COP', 1, 0, '2014-11-14 10:34:08'),
(104, 87, 93, 'PreguntanosPreguntas', 20000, 'COP', 1, 0, '2014-11-14 10:37:45'),
(105, 88, 94, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-14 10:54:40'),
(106, 89, 95, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-14 10:54:49'),
(107, 90, 96, 'PreguntanosPreguntas', 20000, 'COP', 1, 0, '2014-11-14 11:00:33'),
(108, 91, 97, 'PreguntanosPreguntas', 25000, 'COP', 1, 0, '2014-11-14 14:40:31'),
(109, 92, 98, 'PreguntanosPreguntas', 21000, 'COP', 1, 0, '2014-11-16 15:36:33'),
(110, 93, 99, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-18 07:57:25'),
(111, 94, 100, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-18 09:40:54'),
(112, 95, 101, 'PreguntanosPreguntas', 25000, 'COP', 1, 0, '2014-11-18 09:59:44'),
(113, 96, 102, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-18 14:26:44'),
(114, 97, 103, 'PreguntanosPreguntas', 60000, 'COP', 1, 0, '2014-11-18 16:55:21'),
(115, 98, 104, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-18 20:10:20'),
(116, 99, 105, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-19 10:22:32'),
(117, 100, 106, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-19 10:35:32'),
(118, 101, 107, 'PreguntanosPreguntas', 70000, 'COP', 1, 0, '2014-11-19 11:27:48'),
(119, 102, 108, 'PreguntanosPreguntas', 60000, 'COP', 1, 0, '2014-11-19 12:26:37'),
(120, 103, 109, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-20 16:25:59'),
(121, 104, 110, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-21 09:43:53'),
(122, 105, 111, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-24 10:20:53'),
(123, 106, 112, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-24 11:53:42'),
(124, 107, 113, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-24 12:58:37'),
(125, 108, 114, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-24 14:31:09'),
(126, 109, 115, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-25 12:25:46'),
(127, 110, 116, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-25 13:04:35'),
(128, 111, 117, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-25 13:47:50'),
(129, 112, 118, 'PreguntanosPreguntas', 55000, 'COP', 1, 0, '2014-11-26 18:25:03'),
(130, 113, 119, 'PreguntanosPreguntas', 55000, 'COP', 1, 0, '2014-11-26 18:26:30'),
(131, 114, 120, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-27 08:50:04'),
(132, 115, 121, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-27 09:04:11'),
(133, 116, 122, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-27 09:24:37'),
(134, 117, 123, 'PreguntanosPreguntas', 50000, 'COP', 1, 0, '2014-11-27 09:33:14');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=118 ;

--
-- Volcado de datos para la tabla `cart_shopping_header`
--

INSERT INTO `cart_shopping_header` (`id`, `ref_venta`, `users_id`, `total`, `shipping_cost`, `overall_tax`, `cart_states_id`, `signature`, `created_at`, `updated_at`, `datetime_go_pay`, `datetime_return_pay`, `message_return_pay`, `code_response_pay`, `code2_response_pay`) VALUES
(1, 'PREG00001', 2, 348000, 0, 16, 1, NULL, '2014-09-28 19:36:02', '2014-09-28 19:36:02', '2014-09-28 19:36:02', NULL, NULL, NULL, NULL),
(2, 'PREG00002', 2, 464000, 0, 16, 3, '62e412cfafdc7f4d92704c78b16fd0da', '2014-09-28 19:37:51', '2014-09-28 19:37:51', '2014-09-28 19:37:51', '2014-09-28 19:47:56', 'Aprobada', '4', 'APPROVED'),
(3, 'PREG00003', 3, 0, 0, 16, 1, '731785a1ed77bc72f56def1196a86dbe', '2014-09-28 19:56:23', '2014-09-28 19:56:23', '2014-09-28 19:56:23', NULL, NULL, NULL, NULL),
(4, 'PREG00004', 3, 116000, 0, 16, 1, '12c4b368cb5b4bf6cd1c6701d3bf614c', '2014-09-28 19:56:30', '2014-09-28 19:56:30', '2014-09-28 19:56:30', NULL, NULL, NULL, NULL),
(5, 'PREG00005', 3, 232000, 0, 16, 1, '0238a5137ac2c6a1b200ae76f77c2f19', '2014-09-28 20:05:47', '2014-09-28 20:05:47', '2014-09-28 20:05:47', NULL, NULL, NULL, NULL),
(6, 'PREG00006', 3, 348000, 0, 16, 1, '2963ce621043b41b6feee76c41d521a5', '2014-09-28 20:15:52', '2014-09-28 20:15:52', '2014-09-28 20:15:52', NULL, NULL, NULL, NULL),
(7, 'PREG00007', 3, 464000, 0, 16, 1, '58e71b6d9b7a2a7930c414e14d96e167', '2014-09-28 20:58:41', '2014-09-28 20:58:41', '2014-09-28 20:58:41', NULL, NULL, NULL, NULL),
(8, 'PREG00008', 3, 0, 0, 16, 1, '959643c561a98dc14418e00e98e488f9', '2014-09-28 21:05:01', '2014-09-28 21:05:01', '2014-09-28 21:05:01', NULL, NULL, NULL, NULL),
(9, 'PREG00009', 3, 0, 0, 16, 1, '44894e37acbd12e198f9fecec56f012e', '2014-09-28 21:11:02', '2014-09-28 21:11:02', '2014-09-28 21:11:02', NULL, NULL, NULL, NULL),
(10, 'PREG00010', 3, 0, 0, 0, 1, 'f49115365ceaf8963130710c2ead353a', '2014-09-28 21:13:02', '2014-09-28 21:13:02', '2014-09-28 21:13:02', NULL, NULL, NULL, NULL),
(11, 'PREG00011', 3, 0, 0, 0, 1, 'e7e8698588833b827054b39907604404', '2014-09-28 21:21:50', '2014-09-28 21:21:50', '2014-09-28 21:21:50', NULL, NULL, NULL, NULL),
(12, 'PREG00012', 3, 0, 0, 0, 1, '302901442640607d83d7bb0a84bbf880', '2014-09-28 21:21:57', '2014-09-28 21:21:57', '2014-09-28 21:21:57', NULL, NULL, NULL, NULL),
(13, 'PREG00013', 3, 0, 0, 0, 1, 'efdbd6dd1d2c122093617da96f65e39e', '2014-09-28 21:24:10', '2014-09-28 21:24:10', '2014-09-28 21:24:10', NULL, NULL, NULL, NULL),
(14, 'PREG00014', 3, 0, 0, 0, 1, '650219bef9cdcd0c4972fe5ddb28fe6f', '2014-09-28 21:24:19', '2014-09-28 21:24:19', '2014-09-28 21:24:19', NULL, NULL, NULL, NULL),
(15, 'PREG00015', 3, 0, 0, 0, 1, '0fd3c5cbe2980526baa2932c8639f92d', '2014-09-28 21:32:15', '2014-09-28 21:32:15', '2014-09-28 21:32:15', NULL, NULL, NULL, NULL),
(16, 'PREG00016', 3, 0, 0, 0, 1, 'c02dadcd78c76a93706b02f891f16d42', '2014-09-28 21:35:00', '2014-09-28 21:35:00', '2014-09-28 21:35:00', NULL, NULL, NULL, NULL),
(17, 'PREG00017', 3, 0, 0, 0, 3, 'f7eb696a83977c5e71da59de29b5c79e', '2014-09-28 21:35:20', '2014-09-28 21:35:20', '2014-09-28 21:35:20', '2014-09-28 21:36:41', 'Aprobada', '4', 'APPROVED'),
(18, 'PREG00018', 3, 0, 0, 0, 3, '17796a0525ad499814f013a80fbc7199', '2014-09-28 21:37:47', '2014-09-28 21:37:47', '2014-09-28 21:37:47', '2014-09-28 21:39:07', 'Aprobada', '4', 'APPROVED'),
(19, 'PREG00019', 3, 0, 0, 0, 1, '3bfda4590f2b2021bd4a7c4c1c5e13a9', '2014-09-29 21:16:15', '2014-09-29 21:16:15', '2014-09-29 21:16:15', NULL, NULL, NULL, NULL),
(20, 'PREG00020', 3, 0, 0, 0, 1, '33a0ba4d7cebbb44a3d5a4bf05b6fea2', '2014-09-29 21:16:53', '2014-09-29 21:16:53', '2014-09-29 21:16:53', NULL, NULL, NULL, NULL),
(21, 'PREG00021', 3, 0, 0, 0, 1, 'bd26a35f413d394e931f75ee169e0c64', '2014-09-29 22:15:24', '2014-09-29 22:15:24', '2014-09-29 22:15:24', NULL, NULL, NULL, NULL),
(22, 'PREG00022', 3, 0, 0, 0, 1, 'ce1495e1c3e2535a0587d93c287bd8df', '2014-09-30 05:13:19', '2014-09-30 05:13:19', '2014-09-30 05:13:19', NULL, NULL, NULL, NULL),
(23, 'PREG00023', 3, 0, 0, 0, 1, '3d2f7518efcd3ffbc79a05bb7be89efc', '2014-10-01 21:09:25', '2014-10-01 21:09:25', '2014-10-01 21:09:25', NULL, NULL, NULL, NULL),
(24, 'PREG00024', 3, 0, 0, 0, 1, 'a66156331dc260f8b553f0c08f20d366', '2014-10-01 21:09:30', '2014-10-01 21:09:30', '2014-10-01 21:09:30', NULL, NULL, NULL, NULL),
(25, 'PREG00025', 7, 0, 0, 0, 3, '84fc293a1959c908d52b440f5aa44802', '2014-10-05 23:35:41', '2014-10-05 23:35:41', '2014-10-05 23:35:41', '2014-10-05 23:37:34', 'Aprobada', '4', 'APPROVED'),
(26, 'MODO00026', 6, 0, 0, 0, 3, '7c85aae0dbca6c0e6c7cc83f7987c558', '2014-10-12 09:04:09', '2014-10-12 09:04:09', '2014-10-12 09:04:09', '2014-10-12 09:11:48', 'Aprobada', '4', 'APPROVED'),
(27, 'PREG00027', 6, 0, 0, 0, 3, '1148870a61469d33722b24562cb38f26', '2014-10-12 11:44:44', '2014-10-12 11:44:44', '2014-10-12 11:44:44', '2014-10-12 11:46:07', 'Aprobada', '4', 'APPROVED'),
(28, 'PREG00028', 6, 0, 0, 0, 3, '8aa800dc06e4f135bede965f115bb12b', '2014-10-12 12:31:00', '2014-10-12 12:31:00', '2014-10-12 12:31:00', '2014-10-12 12:32:27', 'Aprobada', '4', 'APPROVED'),
(29, 'PREG00029', 6, 0, 0, 0, 1, 'c5c7c958aacd45f93b2da1de803fcb0a', '2014-10-12 17:30:31', '2014-10-12 17:30:31', '2014-10-12 17:30:31', NULL, NULL, NULL, NULL),
(30, 'PREG00030', 6, 0, 0, 0, 1, '99f3d877db0a9798325cacc27dd3b551', '2014-10-12 17:31:36', '2014-10-12 17:31:36', '2014-10-12 17:31:36', NULL, NULL, NULL, NULL),
(31, 'PREG00031', 6, 0, 0, 0, 1, '334598e5d9af766279970d9036ac8875', '2014-10-12 17:32:47', '2014-10-12 17:32:47', '2014-10-12 17:32:47', NULL, NULL, NULL, NULL),
(32, 'PREG00032', 6, 0, 0, 0, 3, 'c6675aaec658a84f4edc57ccbc150d10', '2014-10-12 18:10:08', '2014-10-12 18:10:08', '2014-10-12 18:10:08', '2014-10-12 18:12:10', 'Aprobada', '4', 'APPROVED'),
(33, 'PREG00033', 6, 0, 0, 0, 1, '682f9f972971d1dfa2c7580d178df41f', '2014-10-12 21:14:23', '2014-10-12 21:14:23', '2014-10-12 21:14:23', NULL, NULL, NULL, NULL),
(34, 'PREG00034', 7, 0, 0, 0, 3, '09d54b18f1beafef7ea82a526cf0ab87', '2014-10-13 19:05:12', '2014-10-13 19:05:12', '2014-10-13 19:05:12', '2014-10-13 19:06:33', 'Aprobada', '4', 'APPROVED'),
(35, 'PREG00035', 6, 0, 0, 0, 3, 'b2cb62b419291b87c2c4ca5e065f3aab', '2014-10-13 19:16:35', '2014-10-13 19:16:35', '2014-10-13 19:16:35', '2014-10-13 19:18:46', 'Aprobada', '4', 'APPROVED'),
(36, 'PREG00036', 6, 0, 0, 0, 3, 'd301aac5a07d336959c3da2636dee81c', '2014-10-13 19:35:38', '2014-10-13 19:35:38', '2014-10-13 19:35:38', '2014-10-13 19:36:43', 'Aprobada', '4', 'APPROVED'),
(37, 'PREG00037', 14, 0, 0, 0, 1, '08d432153652864b2e3d1a9401f0f69f', '2014-10-21 10:03:52', '2014-10-21 10:03:52', '2014-10-21 10:03:52', NULL, NULL, NULL, NULL),
(38, 'PREG00038', 14, 0, 0, 0, 4, 'c252e79ad0cc6a789a336e2e85951060', '2014-10-21 10:04:03', '2014-10-21 10:04:03', '2014-10-21 10:04:03', '2014-10-21 10:19:37', 'ENTITY_DECLINED', '6', 'ENTITY_DECLINED'),
(39, 'PREG00039', 1, 0, 0, 0, 4, '54390ec59a1c7f0a0cbcceb9390d807b', '2014-10-21 12:07:52', '2014-10-21 12:07:52', '2014-10-21 12:07:52', '2014-10-21 13:20:19', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(40, 'PREG00040', 14, 0, 0, 0, 3, 'e5e82094d7b3d7b2ce443343868cc692', '2014-10-21 12:11:18', '2014-10-21 12:11:18', '2014-10-21 12:11:18', '2014-10-21 12:12:59', 'APPROVED', '4', 'APPROVED'),
(41, 'PREG00041', 22, 0, 0, 0, 3, 'e70b54862f7e774479353cb2ad2d291d', '2014-10-25 17:51:47', '2014-10-25 17:51:47', '2014-10-25 17:51:47', '2014-10-25 17:55:01', 'Aprobada', '4', 'APPROVED'),
(42, 'PREG00042', 22, 0, 0, 0, 1, '134e2e7afc1a2b96bfc0196ee7195a91', '2014-10-25 19:55:01', '2014-10-25 19:55:01', '2014-10-25 19:55:01', NULL, NULL, NULL, NULL),
(43, 'PREG00043', 8, 0, 0, 0, 1, 'ea063112d75688a980256c942131e34f', '2014-10-26 09:19:09', '2014-10-26 09:19:09', '2014-10-26 09:19:09', NULL, NULL, NULL, NULL),
(44, 'PREG00044', 8, 0, 0, 0, 3, '4ffb00642244216036013fbba780d21a', '2014-10-26 09:25:10', '2014-10-26 09:25:10', '2014-10-26 09:25:10', '2014-10-26 09:26:43', 'Aprobada', '4', 'APPROVED'),
(45, 'PREG00045', 8, 0, 0, 0, 1, '1e4628109b3893a9c56554f1dac844d0', '2014-10-26 11:32:07', '2014-10-26 11:32:07', '2014-10-26 11:32:07', NULL, NULL, NULL, NULL),
(46, 'PREG00046', 8, 0, 0, 0, 1, 'bc6c68bd1328347dd429f9b1ac730de4', '2014-10-26 11:34:07', '2014-10-26 11:34:07', '2014-10-26 11:34:07', NULL, NULL, NULL, NULL),
(47, 'PREG00047', 23, 0, 0, 0, 3, '538c36d091a2c99d5cbd3203cf4fbd51', '2014-10-26 12:44:07', '2014-10-26 12:44:07', '2014-10-26 12:44:07', '2014-10-26 12:45:32', 'Aprobada', '4', 'APPROVED'),
(48, 'PREG00048', 8, 0, 0, 0, 3, 'c75b42a79588c6233ece504dd6966679', '2014-10-26 13:01:57', '2014-10-26 13:01:57', '2014-10-26 13:01:57', '2014-10-26 13:03:50', 'Aprobada', '4', 'APPROVED'),
(49, 'PREG00049', 26, 0, 0, 0, 1, '34c793c1aa5319009dc3f65a072ce374', '2014-10-27 21:43:53', '2014-10-27 21:43:53', '2014-10-27 21:43:53', NULL, NULL, NULL, NULL),
(50, 'PREG00050', 26, 0, 0, 0, 1, 'bc3fea04e34593cbd614ea761b9cfa52', '2014-10-27 22:02:42', '2014-10-27 22:02:42', '2014-10-27 22:02:42', NULL, NULL, NULL, NULL),
(51, 'PREG00051', 26, 0, 0, 0, 3, '4ee9f7b7f6a9147976bf774d91b8690a', '2014-10-28 22:12:56', '2014-10-28 22:12:56', '2014-10-28 22:12:56', '2014-10-28 22:15:01', 'Aprobada', '4', 'APPROVED'),
(52, 'PREG00052', 15, 0, 0, 0, 3, 'c3f192ef134d126f3f13973ddf97134c', '2014-11-02 16:39:49', '2014-11-02 16:39:49', '2014-11-02 16:39:49', '2014-11-02 16:41:38', 'Aprobada', '4', 'APPROVED'),
(53, 'PREG00053', 15, 0, 0, 0, 3, '8f79f02a63c3165f2679a15fc4a42f2e', '2014-11-02 16:45:44', '2014-11-02 16:45:44', '2014-11-02 16:45:44', '2014-11-02 16:47:25', 'Aprobada', '4', 'APPROVED'),
(54, 'PREG00054', 15, 0, 0, 0, 3, 'feba28a1155b303367c0bf9affb5f489', '2014-11-02 19:01:50', '2014-11-02 19:01:50', '2014-11-02 19:01:50', '2014-11-02 19:04:19', 'APPROVED', '4', 'APPROVED'),
(55, 'PREG00055', 15, 0, 0, 0, 3, '3f19db1cbb3c5d4518036a35f5cd4a0d', '2014-11-02 19:03:51', '2014-11-02 19:03:51', '2014-11-02 19:03:51', '2014-11-02 19:05:36', 'APPROVED', '4', 'APPROVED'),
(56, 'PREG00056', 15, 0, 0, 0, 3, '4cd4afb878010c404ca4f203af65986a', '2014-11-02 19:05:22', '2014-11-02 19:05:22', '2014-11-02 19:05:22', '2014-11-02 19:07:20', 'APPROVED', '4', 'APPROVED'),
(57, 'PREG00057', 15, 0, 0, 0, 3, 'e2292ccb343c05d2156e380b48145472', '2014-11-02 19:06:48', '2014-11-02 19:06:48', '2014-11-02 19:06:48', '2014-11-02 19:08:37', 'APPROVED', '4', 'APPROVED'),
(58, 'PREG00058', 15, 0, 0, 0, 3, 'a0a4835a76f59cbe30e880ba9d90fd77', '2014-11-02 19:08:05', '2014-11-02 19:08:05', '2014-11-02 19:08:05', '2014-11-02 19:10:39', 'APPROVED', '4', 'APPROVED'),
(59, 'PREG00059', 15, 0, 0, 0, 3, '5371e812616738500a2a659f0dbadc15', '2014-11-02 19:11:27', '2014-11-02 19:11:27', '2014-11-02 19:11:27', '2014-11-02 19:16:00', 'APPROVED', '4', 'APPROVED'),
(60, 'PREG00060', 15, 0, 0, 0, 3, '5da376a73fda3cfa4fbdb66608c746e9', '2014-11-02 21:18:30', '2014-11-02 21:18:30', '2014-11-02 21:18:30', '2014-11-02 21:19:52', 'APPROVED', '4', 'APPROVED'),
(61, 'PREG00061', 15, 0, 0, 0, 3, 'd1a8ff9848b040649c69a19f96f5eb93', '2014-11-02 21:20:15', '2014-11-02 21:20:15', '2014-11-02 21:20:15', '2014-11-02 21:21:36', 'APPROVED', '4', 'APPROVED'),
(62, 'PREG00062', 15, 0, 0, 0, 3, 'd25f8ae3a619179513b39d13a2abd6af', '2014-11-02 21:23:15', '2014-11-02 21:23:15', '2014-11-02 21:23:15', '2014-11-02 21:24:37', 'APPROVED', '4', 'APPROVED'),
(63, 'PREG00063', 8, 0, 0, 0, 3, '07f6a8650dc293a334ddddb8fbb4a2fd', '2014-11-02 21:30:53', '2014-11-02 21:30:53', '2014-11-02 21:30:53', '2014-11-02 21:32:12', 'APPROVED', '4', 'APPROVED'),
(64, 'PREG00064', 8, 0, 0, 0, 3, '6bd6602432c1021e2476d13340eeede1', '2014-11-02 21:33:34', '2014-11-02 21:33:34', '2014-11-02 21:33:34', '2014-11-02 21:34:46', 'APPROVED', '4', 'APPROVED'),
(65, 'PREG00065', 8, 0, 0, 0, 3, 'cdd387b4f1f28e35e1140c81b7bd48e1', '2014-11-02 21:35:28', '2014-11-02 21:35:28', '2014-11-02 21:35:28', '2014-11-02 21:36:42', 'APPROVED', '4', 'APPROVED'),
(66, 'PREG00066', 8, 0, 0, 0, 3, '386d5273c657ca93c24433f807bdf8ee', '2014-11-02 21:39:50', '2014-11-02 21:39:50', '2014-11-02 21:39:50', '2014-11-02 21:42:17', 'APPROVED', '4', 'APPROVED'),
(67, 'PREG00067', 8, 0, 0, 0, 3, '3862b4197c186a697db6f40527d80762', '2014-11-02 21:44:41', '2014-11-02 21:44:41', '2014-11-02 21:44:41', '2014-11-02 21:46:04', 'APPROVED', '4', 'APPROVED'),
(68, 'PREG00068', 8, 0, 0, 0, 3, '0584ca014c8eab6a09f82440041ab99b', '2014-11-02 21:46:25', '2014-11-02 21:46:25', '2014-11-02 21:46:25', '2014-11-02 21:53:50', 'APPROVED', '4', 'APPROVED'),
(69, 'PREG00069', 8, 0, 0, 0, 3, '90f630fd9ec9187c5e3516465c7a3151', '2014-11-02 21:54:01', '2014-11-02 21:54:01', '2014-11-02 21:54:01', '2014-11-02 21:55:08', 'APPROVED', '4', 'APPROVED'),
(70, 'PREG00070', 8, 0, 0, 0, 3, '009dc0f0ef4419c2a933195af5bd7b93', '2014-11-02 21:56:54', '2014-11-02 21:56:54', '2014-11-02 21:56:54', '2014-11-02 21:58:08', 'APPROVED', '4', 'APPROVED'),
(71, 'PREG00071', 8, 0, 0, 0, 3, '9cd7528e75d8ddb28588e9b2840a1269', '2014-11-02 21:59:39', '2014-11-02 21:59:39', '2014-11-02 21:59:39', '2014-11-02 22:00:54', 'APPROVED', '4', 'APPROVED'),
(72, 'PREG00072', 8, 0, 0, 0, 3, 'd294ef8566e92ce356ec9ffcc24d654b', '2014-11-02 22:02:03', '2014-11-02 22:02:03', '2014-11-02 22:02:03', '2014-11-02 22:03:10', 'APPROVED', '4', 'APPROVED'),
(73, 'PREG00073', 8, 0, 0, 0, 3, 'f2061b28c7682d6f31fc4f6cf011efab', '2014-11-02 22:03:30', '2014-11-02 22:03:30', '2014-11-02 22:03:30', '2014-11-02 22:04:25', 'APPROVED', '4', 'APPROVED'),
(74, 'PREG00074', 8, 0, 0, 0, 3, '1d146df03353758ae7070a9fed913f55', '2014-11-02 22:04:50', '2014-11-02 22:04:50', '2014-11-02 22:04:50', '2014-11-02 22:05:54', 'APPROVED', '4', 'APPROVED'),
(75, 'PREG00075', 15, 0, 0, 0, 3, '2cd9c74a4f9252df610c92a084ac3cd8', '2014-11-03 13:09:31', '2014-11-03 13:09:31', '2014-11-03 13:09:31', '2014-11-03 13:10:33', 'APPROVED', '4', 'APPROVED'),
(76, 'PREG00076', 8, 0, 0, 0, 3, 'b404417ac8699bf36b266d71896a93d7', '2014-11-03 13:20:49', '2014-11-03 13:20:49', '2014-11-03 13:20:49', '2014-11-03 13:23:40', 'APPROVED', '4', 'APPROVED'),
(77, 'PREG00077', 8, 0, 0, 0, 3, 'b90c725a368f00d54d5aa41eaa0fcb4c', '2014-11-09 21:34:20', '2014-11-09 21:34:20', '2014-11-09 21:34:20', '2014-11-09 21:36:27', 'APPROVED', '4', 'APPROVED'),
(78, 'PREG00078', 27, 0, 0, 0, 1, '05f4e2aff3f336e369d0becdf1c83da0', '2014-11-13 09:01:02', '2014-11-13 09:01:02', '2014-11-13 09:01:02', NULL, NULL, NULL, NULL),
(79, 'PREG00079', 27, 0, 0, 0, 1, 'c037fca0d6b067dc148e96928d820a07', '2014-11-13 09:08:02', '2014-11-13 09:08:02', '2014-11-13 09:08:02', NULL, NULL, NULL, NULL),
(80, 'PREG00080', 27, 0, 0, 0, 1, 'f52f86285daa103a18dc30c18243fa5d', '2014-11-13 09:08:45', '2014-11-13 09:08:45', '2014-11-13 09:08:45', NULL, NULL, NULL, NULL),
(81, 'PREG00081', 28, 0, 0, 0, 1, '738fe845c895bb20039f7814672ecbcd', '2014-11-13 10:38:42', '2014-11-13 10:38:42', '2014-11-13 10:38:42', NULL, NULL, NULL, NULL),
(82, 'PREG00082', 28, 0, 0, 0, 1, '40f69d7b74351b641224c37cbe38c195', '2014-11-13 10:40:24', '2014-11-13 10:40:24', '2014-11-13 10:40:24', NULL, NULL, NULL, NULL),
(83, 'PREG00083', 28, 0, 0, 0, 1, 'eb7f7249c0977c1161b1365259d4c357', '2014-11-13 10:41:40', '2014-11-13 10:41:40', '2014-11-13 10:41:40', NULL, NULL, NULL, NULL),
(84, 'PREG00084', 28, 0, 0, 0, 1, '987d822002583c198a1fea7814e7c68b', '2014-11-13 15:58:56', '2014-11-13 15:58:56', '2014-11-13 15:58:56', NULL, NULL, NULL, NULL),
(85, 'PREG00085', 28, 0, 0, 0, 1, '242ff829da18403b56baf7561f149eae', '2014-11-13 17:11:33', '2014-11-13 17:11:33', '2014-11-13 17:11:33', NULL, NULL, NULL, NULL),
(86, 'PREG00086', 1, 0, 0, 0, 4, '2d62d056a2ebbe526a3310ac6abd6099', '2014-11-14 10:34:08', '2014-11-14 10:34:08', '2014-11-14 10:34:08', '2014-11-14 11:40:29', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(87, 'PREG00087', 1, 0, 0, 0, 4, 'd8424d5ac2f27a79e768d7e18c07cb87', '2014-11-14 10:37:45', '2014-11-14 10:37:45', '2014-11-14 10:37:45', '2014-11-14 11:40:29', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(88, 'PREG00088', 28, 0, 0, 0, 1, '26e91c89bd6a4397cc5309273d5c4eec', '2014-11-14 10:54:40', '2014-11-14 10:54:40', '2014-11-14 10:54:40', NULL, NULL, NULL, NULL),
(89, 'PREG00089', 28, 0, 0, 0, 1, '03a5a410302fbf80d4858704d2fee505', '2014-11-14 10:54:49', '2014-11-14 10:54:49', '2014-11-14 10:54:49', NULL, NULL, NULL, NULL),
(90, 'PREG00090', 1, 0, 0, 0, 4, '9a8d8fedf32e65b26ad7c3365e3f4745', '2014-11-14 11:00:33', '2014-11-14 11:00:33', '2014-11-14 11:00:33', '2014-11-14 12:20:07', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(91, 'PREG00091', 1, 0, 0, 0, 4, '493620171cb011be261bc8b7c1fbd322', '2014-11-14 14:40:31', '2014-11-14 14:40:31', '2014-11-14 14:40:31', '2014-11-14 16:00:08', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(92, 'PREG00092', 27, 0, 0, 0, 1, 'c75e4aa3a1d0f94eae41a660719a4a36', '2014-11-16 15:36:33', '2014-11-16 15:36:33', '2014-11-16 15:36:33', NULL, NULL, NULL, NULL),
(93, 'PREG00093', 29, 0, 0, 0, 4, '3adf18cca15642485d50d8cf234d6963', '2014-11-18 07:57:25', '2014-11-18 07:57:25', '2014-11-18 07:57:25', '2014-11-18 09:00:11', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(94, 'PREG00094', 1, 0, 0, 0, 4, 'c7bcfa33fecdb700a80001d60213133d', '2014-11-18 09:40:54', '2014-11-18 09:40:54', '2014-11-18 09:40:54', '2014-11-18 11:19:59', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(95, 'PREG00095', 1, 0, 0, 0, 1, '078a73d3bb6ab536f8d4eb41115fefb6', '2014-11-18 09:59:44', '2014-11-18 09:59:44', '2014-11-18 09:59:44', NULL, NULL, NULL, NULL),
(96, 'PREG00096', 1, 0, 0, 0, 4, '3bd9a3faaeca6d5677eaad7c009b2f7d', '2014-11-18 14:26:44', '2014-11-18 14:26:44', '2014-11-18 14:26:44', '2014-11-18 15:40:47', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(97, 'PREG00097', 1, 0, 0, 0, 4, '3a476f5feb543fa9edea592a13e7dcc6', '2014-11-18 16:55:21', '2014-11-18 16:55:21', '2014-11-18 16:55:21', '2014-11-18 18:20:26', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(98, 'PREG00098', 30, 0, 0, 0, 4, '126aa3e7909d372f264b41cccba00666', '2014-11-18 20:10:20', '2014-11-18 20:10:20', '2014-11-18 20:10:20', '2014-11-18 21:20:00', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(99, 'PREG00099', 28, 0, 0, 0, 3, '89854dee27ad9fa3818cc5e70aa54cd7', '2014-11-19 10:22:32', '2014-11-19 10:22:32', '2014-11-19 10:22:32', '2014-11-19 10:27:15', 'APPROVED', '4', 'APPROVED'),
(100, 'PREG00100', 30, 0, 0, 0, 3, '6ede687ff3c52c71b3b72fd98d4c3631', '2014-11-19 10:35:32', '2014-11-19 10:35:32', '2014-11-19 10:35:32', '2014-11-19 10:36:50', 'APPROVED', '4', 'APPROVED'),
(101, 'PREG00101', 31, 0, 0, 0, 3, '780551ab9a0a7c65a24c8955fa5ec05f', '2014-11-19 11:27:48', '2014-11-19 11:27:48', '2014-11-19 11:27:48', '2014-11-19 11:29:39', 'APPROVED', '4', 'APPROVED'),
(102, 'PREG00102', 31, 0, 0, 0, 3, 'c1e27e039895e7a503c9fb6fd969edbe', '2014-11-19 12:26:37', '2014-11-19 12:26:37', '2014-11-19 12:26:37', '2014-11-19 12:32:10', 'APPROVED', '4', 'APPROVED'),
(103, 'PREG00103', 30, 0, 0, 0, 1, 'a1230b1a0be3c7597036206ea3eb857d', '2014-11-20 16:25:59', '2014-11-20 16:25:59', '2014-11-20 16:25:59', NULL, NULL, NULL, NULL),
(104, 'PREG00104', 27, 0, 0, 0, 1, '1c8fbd3e66aeb655389dea0c1eadbb2b', '2014-11-21 09:43:53', '2014-11-21 09:43:53', '2014-11-21 09:43:53', NULL, NULL, NULL, NULL),
(105, 'PREG00105', 15, 0, 0, 0, 4, 'd90b9f11e1ebd44c11245b6875f8c5c8', '2014-11-24 10:20:53', '2014-11-24 10:20:53', '2014-11-24 10:20:53', '2014-11-24 11:40:24', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(106, 'PREG00106', 27, 0, 0, 0, 4, '5174a412a2f70627a4d00778d6767317', '2014-11-24 11:53:42', '2014-11-24 11:53:42', '2014-11-24 11:53:42', '2014-11-24 13:00:43', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(107, 'PREG00107', 39, 0, 0, 0, 3, '4887753facb644663a755b3f4238ed9e', '2014-11-24 12:58:37', '2014-11-24 12:58:37', '2014-11-24 12:58:37', '2014-11-24 13:06:44', 'APPROVED', '4', 'APPROVED'),
(108, 'PREG00108', 30, 0, 0, 0, 3, '04f6333723a7a3271747291a11948a81', '2014-11-24 14:31:09', '2014-11-24 14:31:09', '2014-11-24 14:31:09', '2014-11-24 14:33:04', 'APPROVED', '4', 'APPROVED'),
(109, 'PREG00109', 39, 0, 0, 0, 1, '55b5b0ab6efcd000daf7430d75a88180', '2014-11-25 12:25:46', '2014-11-25 12:25:46', '2014-11-25 12:25:46', NULL, NULL, NULL, NULL),
(110, 'PREG00110', 30, 0, 0, 0, 3, '3869a623cf97283c3a92edb74725fc79', '2014-11-25 13:04:35', '2014-11-25 13:04:35', '2014-11-25 13:04:35', '2014-11-25 13:07:24', 'APPROVED', '4', 'APPROVED'),
(111, 'PREG00111', 30, 0, 0, 0, 3, '1f846fb400bd295c886dff147eb5a568', '2014-11-25 13:47:50', '2014-11-25 13:47:50', '2014-11-25 13:47:50', '2014-11-25 13:50:54', 'APPROVED', '4', 'APPROVED'),
(112, 'PREG00112', 8, 0, 0, 0, 1, '3cdd073a93052e2c5af9cad0ef8ebfd5', '2014-11-26 18:25:03', '2014-11-26 18:25:03', '2014-11-26 18:25:03', NULL, NULL, NULL, NULL),
(113, 'PREG00113', 8, 0, 0, 0, 3, '94aa3ac72d984876b7655df6a1f34081', '2014-11-26 18:26:30', '2014-11-26 18:26:30', '2014-11-26 18:26:30', '2014-11-26 18:29:27', 'APPROVED', '4', 'APPROVED'),
(114, 'PREG00114', 40, 0, 0, 0, 3, 'ef615aebb9b87db58f8d1e6cb3bee317', '2014-11-27 08:50:04', '2014-11-27 08:50:04', '2014-11-27 08:50:04', '2014-11-27 08:52:06', 'APPROVED', '4', 'APPROVED'),
(115, 'PREG00115', 40, 0, 0, 0, 3, '4655f851992875c10959a6536fb35d4e', '2014-11-27 09:04:11', '2014-11-27 09:04:11', '2014-11-27 09:04:11', '2014-11-27 09:06:08', 'APPROVED', '4', 'APPROVED'),
(116, 'PREG00116', 15, 0, 0, 0, 4, 'a5e76e22e13885d57988607e70acd5c0', '2014-11-27 09:24:37', '2014-11-27 09:24:37', '2014-11-27 09:24:37', '2014-11-27 10:40:10', 'ABANDONED_TRANSACTION', '6', 'ABANDONED_TRANSACTION'),
(117, 'PREG00117', 40, 0, 0, 0, 3, '729ed87f8735fd97dc396d843b03c418', '2014-11-27 09:33:14', '2014-11-27 09:33:14', '2014-11-27 09:33:14', '2014-11-27 09:37:15', 'APPROVED', '4', 'APPROVED');

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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cart_config`
--
ALTER TABLE `cart_config`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_log_purchases`
--
ALTER TABLE `cart_log_purchases`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cart_shipment_data`
--
ALTER TABLE `cart_shipment_data`
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
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cart_config`
--
ALTER TABLE `cart_config`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cart_log_purchases`
--
ALTER TABLE `cart_log_purchases`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `cart_shipment_data`
--
ALTER TABLE `cart_shipment_data`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cart_shopping_detail`
--
ALTER TABLE `cart_shopping_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=135;
--
-- AUTO_INCREMENT de la tabla `cart_shopping_header`
--
ALTER TABLE `cart_shopping_header`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=118;
--
-- AUTO_INCREMENT de la tabla `cart_states`
--
ALTER TABLE `cart_states`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
