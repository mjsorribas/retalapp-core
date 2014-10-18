-- phpMyAdmin SQL Dump
-- version 4.1.0
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-08-2014 a las 23:02:04
-- Versión del servidor: 5.6.15
-- Versión de PHP: 5.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `menteswe_imaginate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_access_tokens`
--

CREATE TABLE IF NOT EXISTS `users_access_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acces_token` varchar(255) NOT NULL,
  `apps_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `acces_token_refresh` varchar(255) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Volcado de datos para la tabla `users_access_tokens`
--

INSERT INTO `users_access_tokens` (`id`, `acces_token`, `apps_id`, `users_id`, `acces_token_refresh`, `code`) VALUES
(1, '78VWzjWXeKAWeJadS8yjqNQ4P7xDNFVMbnewW3PW', 3, 1, 'VPorXfIMqdPa5z5FhoiIXJBYsgHfQQAhBJuvK673cJx0EvBiagRTQpJ8Vsbh', NULL),
(2, 'qKd8RfvkGbAQjyhU8Y3f4m5YqkPWdhMpOKJ4rAHT', 3, 1, '6qDhJGzy372EvPMF5wtk8QZj7Dh86773PCEvj8pcYGGKwTnqG3WgNsqHRXhQ', NULL),
(3, 'rtwew8x5NYatbwICANjGFvOtSMxjKPFXe44wXQqg', 3, 1, '5cf7hp0b0OH33YqukHpf5JCJkPag5H42gCZoNRKj3pcYIsOTZYUTaX7kezR5', NULL),
(4, 'RyIM0Pb2mVbJf3jqIpFsSsuAqXT0ehXRbc7xR0TY', 3, 1, 'e7JOwgZiNzmhYm2PFW3yugnPSwQo8hq8gVJ5yfcGaOOUVkf366rSE77trPcQ', NULL),
(5, 'f2apuQipTmyMzba5ScrybDbD6mjckIwmBwwVeAgX', 3, 1, 'zKRHRQIoTrjCQ8IygwUTghMprvjzU2QqhDTzq6eAKOd3jMrQaCbcJIr3awsU', NULL),
(6, 'm8Q4BvehuKCejkca0UoHjJxnqeKrIsSvNeSpzSsk', 3, 1, 'fAoxyJTQaANtoQT77nnMhdpGnx8QCisDj4xdhMPhiywsJGrfuzRx55ZKvz3T', NULL),
(7, '3dPdM8mP86eefhsjw6cuGbheP622RhakKmotKvDg', 3, 1, 'YMrTMSXhCGDeKxOhro6TbF2gOksmZCdUkQfWe7ZCBzhnSRuAAOU4QnDatVHO', 'Iwkw2mIQJUhrIPjqtHun4bXsGFaNf8gORNBoUKZa'),
(8, 'UWKNswGtNHCjhxxYRyCWEUQ7owzdOsTaJAIXSqHb', 3, 1, 'nZFUPQJUzv4fMjiHtBIfzzsDwuKJVorDjWUUEag8rDA6IEG4Gq74Gr3YcHeX', '5zDyjibrqyOGU0gMusF2bXgntjGImQPJmtDrxA8i'),
(9, 'qNjCVCzF4ETpWc2RM3p6nRzVQrQzwHwHvbgMe3O4', 3, 1, 'UehOM3CTW3wzCbTFWcnPKTqvconVDJ8UOhe2aCmx8DoCA6et3raHFqYDZGZz', 'Ohkb78tmDeCRb7wp73q6WMRoYY43Fvuq5ar3ZfEz'),
(10, 'KOzRGRSC765FaSt2D7Ph6UeUZSDaHEYtpTBVcuY4', 3, 1, 'Gnyc5wjS3TG0DXjManR52sA3yJ5T3I2DRUBKMK8I2cAa0kHwtzuqiri52gsy', NULL),
(11, 'TQ7TqGDrCKtXqac7YqkTb6UqdHMgPV0ehzTx4XF0', 3, 1, 'MIPddPIhVB2yTKC3tbgoRDqw7fRaYdWGHhJmSptfnKzBWXYGYbUHAc80hR0B', NULL),
(12, 'vXxhqNVefknwdG6H33S0JHycnuQXWq5jEvnQ8Dvf', 3, 1, 'bz4vxZQQ2OrPSihmCKMHRVMFTH5b3Mb5G6T8YbmrK6B7CfKFQtjdkRjZzdWs', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(13, 'O4U5RzbHutOdfB4ORAi3du3Ih04T8eBj4WhPNEtC', 3, 1, 'GVhWBaAkJb00gbjEptcqTHbxncYK2K376aR0Aogkp6gv8QwJAu0q43EFz7Ns', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(14, 'efGaYkqfRm86OvitVmVi48S2mZUqdH7DIB8DiPEZ', 3, 1, 'ZqaQmkeot4yYKeCdmuqbAnAreoWPXzGpkGASRE4B5V0EVYe7Ouap5A45JqNd', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(15, 'aYAorjdkC6Fwn7m7H7Pr7gUrjRzMVn7VGZATEaah', 3, 1, 'ykxhmcmPxP5xEIGz7QjFbRSvmmQ54OyRYRzBPcrDRkWwT8rOmWqnfe8rmqpI', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(16, 'g3hsm4DATbu20igYN5khCys0u0meCPkEHsxTq2QA', 3, 1, 'QdiCMIGEzMdwvARtuzbswE6fpYtufJdRImuvrWVheU7vrQjGGKU6qta2NpQO', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(17, 'NkNN7M37SATajI0xjmxSf56AQNciyZqhFYQbGNav', 3, 1, '28IqCRSYtPuAxukC3adazxsWNXigMT6iPdusveMfT4cMsnkpijp7c6wKw0ND', NULL),
(18, 'h6OGnw6oChOnnIay68uQo07Eromgr84uYmWC7vQ5', 3, 1, 'nBTDA8uUUZ8XVfwPYd3A3OdStHd3hsRuTgXUBIkWeFmZhdg4g7y7I4o5frvi', NULL),
(19, '7Uzz560EFoxKSjx28E6OvyzQo5SPN8iiuddoB7OD', 3, 1, 'VG0rxxSPOtfywDbyVACrmSaeGfGkgO65RUkJI6ZxR2nI0oCsObewPEwsJ75M', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(20, 'ZCiWb74wXvBEQ2j5hYn67OGtjzMENbpiDx3AsYtK', 3, 1, 'GwzDtJteocyYiE4fkoSffaDJHIpWMWdtpyWdDGdojxHo5btekdjq7j0GSkz0', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(21, 'NXuGv0Xs6aejuR7C5nOjeIghw38CZ5FiRwKHoaZM', 3, 1, '7mqONECpdjDfOk7Ja4FbZZnHUFpIvmPuT2ac3CRairFW4A6X5eYTZC4qIMv8', '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV'),
(22, '2TGCg3yAAkVBZKwfi4EYfNU8k0TCPcomVQOXNHuo', 3, 1, 'mDdyyU33Rz4fF5pFEh5eEz8Nws2s7DokhnAbCX6QSwVyqF8QIXvjSQxFDTy7', 'Iwkw2mIQJUhrIPjqtHun4bXsGFaNf8gORNBoUKZa'),
(23, 'uQvRhJzioSdg66x3Yvaxe5WYXhJO0SFqeW6HcXQm', 3, 1, 'z2MbAUj3Dk0xZEv7wgYMQ8BZzixZdkyyCBz7sA0wGWpcxb3kHRSyruPm5HG3', 'Iwkw2mIQJUhrIPjqtHun4bXsGFaNf8gORNBoUKZa'),
(24, 'vBJGix7hUB0ra5iUExsNPVfcVztyqhzGIAjoyivJ', 3, 1, 'SrNwO6UuCrxa0n30ROD22eUAvu2o8IFoZtfJR0ZqnSqe2Iaox8gT8WuvHMeH', '5zDyjibrqyOGU0gMusF2bXgntjGImQPJmtDrxA8i'),
(25, 'QPW6U6wRf0g6rKqbNPHsczOFtaAEqz7ckVA2uSjv', 3, 1, 'KIstcz8k5Q4G3OfJcDD7j3gQWu4yY4eBcwUenqkG4ejvSpArOemy3sFPD8j5', '5zDyjibrqyOGU0gMusF2bXgntjGImQPJmtDrxA8i'),
(26, 'EgQDz2xf7WSfcmsyRJjeEvwJiEhEEupfWAERx4xW', 3, 1, '6JZdESEep4xdWtJ8JGVavyzq55nQIEZhpvgqjhquEexxX6WdBj7WdyH4wUo3', '5zDyjibrqyOGU0gMusF2bXgntjGImQPJmtDrxA8i'),
(27, 'dZjVnIEc32yoE4ZRqru8fU7t5ZbboPmrGrDT0IVt', 3, 1, 'wNMwsC30UQ2dxt4w7MkJimU3F5PZKQg68SUNroIG8bFSQDFKmrvqymn8fXzM', NULL),
(28, '2nvVzNwqokE2pQrbIyckSI6MHgXcTecMnXdDcvTm', 3, 1, 'JXesjmSHgDDRMUWtQX5fJGgV5ob8rZu2tuO5B5BDBfvO0o6HG2IrdqD3zA3m', NULL),
(29, '6IMuIrvCz8mbTu3g2iz8eEVYFnAIb8MZeyPIgFmb', 3, 1, 'bZDkQHdJiu8e57HkHaSCxxxKVw8dsJapBDzsmY5QJXQHWytaYC6R0wYNoyQ3', NULL),
(30, '8BKAW8goBYO6yKNmKEmB0STMCbtDAfZ0GGWZcYID', 3, 1, 'qJqI6PEdkx4jtsbM3cukOcwJiUHBv3PGC2qbHvEOj5X6QUkIW0TCYGnC4QeS', NULL),
(31, 'GrRUG06oShRDvEP4jhHd0RE0aGMbB5BEpTzVKyE7', 3, 1, 'pfiQeFfubv3EsziITwCrXgmFaEI2jNeYtigtkmehcBMuWrYmi4YB8BDZgnsM', NULL),
(32, '8mUUkQIfnAUZXIoHmBZmN8keW0UBxVbtCsEN8OpM', 3, 1, 'GoXi7toyZjCITS0KTfTRDAVf7TGe0vb6AvG8jUyb0WJPgBwZhmNKHaMdutdm', NULL),
(33, 'RwvNCbzr7G6oRbObE8GsJUaSgzfNs3YEtPoRQeam', 3, 1, 'DfA34n40K3QsSMTbrp8qtOdUb7rZ4wm3xnuvzRrBp6T6ke83TZiDjhyggg48', 'MTXU3C6dIQQrATVRU8rHwK2zr2KcMqMyAfk5DEbn'),
(34, 'yIpQ3PQpoK7QHmAAdsND74J4aF76Vs6P2I3uyoad', 4, 1, 'whB0cwMKOJTZ5M408NfmDFqb0uQRn8paCQWfDeMsJbIeIgaePBqTh3QdRcrZ', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_apps`
--

CREATE TABLE IF NOT EXISTS `users_apps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `client_secret` varchar(255) NOT NULL,
  `redirect_uri` varchar(255) DEFAULT NULL,
  `users_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `users_apps`
--

INSERT INTO `users_apps` (`id`, `name`, `client_id`, `client_secret`, `redirect_uri`, `users_id`) VALUES
(3, 'Android app', 'android-app', 'x0DF4OK8HOd2ufIKdMbAQnzQPkvUQnPf', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_apps_scopes`
--

CREATE TABLE IF NOT EXISTS `users_apps_scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apps_id` int(11) NOT NULL,
  `scopes_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Volcado de datos para la tabla `users_apps_scopes`
--

INSERT INTO `users_apps_scopes` (`id`, `apps_id`, `scopes_id`) VALUES
(6, 1, '1'),
(7, 1, '2'),
(8, 1, '3'),
(9, 2, '3'),
(10, 2, '4'),
(33, 3, 'admin'),
(34, 3, 'editor'),
(35, 4, 'root'),
(36, 4, 'subscriber');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_authassignment`
--

CREATE TABLE IF NOT EXISTS `users_authassignment` (
  `itemname` varchar(64) NOT NULL,
  `userid` varchar(64) NOT NULL,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`itemname`,`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users_authassignment`
--

INSERT INTO `users_authassignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
('admin', '1', NULL, 'N;'),
('admin', '3', NULL, 'N;'),
('root', '3', NULL, 'N;'),
('subscriber', '2', NULL, 'N;');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_authitem`
--

CREATE TABLE IF NOT EXISTS `users_authitem` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `bizrule` text,
  `data` text,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users_authitem`
--

INSERT INTO `users_authitem` (`name`, `type`, `description`, `bizrule`, `data`) VALUES
('admin', 2, 'Administrador con amplio dominio del sistema', NULL, 'N;'),
('editor', 2, 'Editor de contenido, con permisos restringidos', NULL, 'N;'),
('root', 2, 'Usuario todopoderoso =) para el developer y PM', NULL, 'N;'),
('subscriber', 2, 'Usuario registrado y principalmente enfocado a front (Cliente)', NULL, 'N;');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_authitemchild`
--

CREATE TABLE IF NOT EXISTS `users_authitemchild` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_code_auth`
--

CREATE TABLE IF NOT EXISTS `users_code_auth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Volcado de datos para la tabla `users_code_auth`
--

INSERT INTO `users_code_auth` (`id`, `users_id`, `code`, `created_at`) VALUES
(1, 1, '8Pi4hTYH3SW3xBefhy8pYksOMoB0sUEsfNKn6bQV', '2014-07-14 17:30:19'),
(2, 1, 'XEsvO7fBTmmp7WEaoyn2PPgrqhmazPEOqSE8sgBC', '2014-07-14 17:30:55'),
(3, 1, 'mZoY7ZmwnuCGtIw6VGYdDwZ2aZ7gYynBPw2ONDB0', '2014-07-14 17:30:55'),
(4, 1, 'g0tXorJTixxfBVeGSgwZHB8nOMM44zE8VXTAJ7uS', '2014-07-14 17:30:55'),
(5, 1, 'ZAMCgwsFT8YR6UJM8estMDjPY3nzNJ8eKHGRZYtp', '2014-07-14 17:30:55'),
(6, 1, 'SBhvmw0yBtxDTF7iNfm6dXkikNM04nyQJbCVt6Pr', '2014-07-14 17:30:55'),
(7, 1, 'zCz67nDBV7os4WWYqr0NPdHEirNivHBmg3JFjoh2', '2014-07-14 17:30:55'),
(8, 1, 'dghsGeDnsTOoQYVeU8dC0sOw2gabUPfXRihYNGG2', '2014-07-14 17:30:55'),
(9, 1, 'TAt3pJpGeMr7uP8JnMvHMhIKce2cYmmjHaGWgRZk', '2014-07-14 17:30:55'),
(10, 1, 'WEvu53beW6sMAVSZaCXFGozKRoFOEThxUyNOvJpN', '2014-07-14 17:30:55'),
(11, 1, 'k0JN2yxImzCoKqiujkHqZez7fbCdPigVaMa2FxfN', '2014-07-14 17:30:55'),
(12, 1, 'KOt7brxxfmE2aVaXR0YV5ept3WAdazwGIggFx7Y5', '2014-07-14 17:30:55'),
(13, 1, 'B2d238RSqQ53KGO6hsDT02R4mpOoGj7egcAd4oRI', '2014-07-14 17:30:55'),
(14, 1, 'UuypVTaHqrX0vhKG3Uskmy07tFJNqSWFHMUZ4QdI', '2014-07-14 17:30:55'),
(15, 1, 'toNKQAQ0NrwPCmkRpEz4UHQgMN8iEhMyvvECwRYE', '2014-07-14 17:30:55'),
(16, 1, 'zzSrhjsgBFEPUtWdMO0GXuTU37YNA6YZynHbs0dq', '2014-07-14 17:30:55'),
(17, 1, '7qwmVuGpuVeBfp3uqgDhHGFs2x05jEziUNqm6WwS', '2014-07-14 17:30:55'),
(18, 1, 'F5YDXJSDcjDgfJbczaz3Gg8fJHIdTmezfzz6EN5d', '2014-07-14 17:30:55'),
(19, 1, 'xJ5XQV4oVFRoPZUCms47f04ItOsjKPFaZDXhZrrn', '2014-07-14 17:30:56'),
(20, 1, 'fGNyoFVikyDIXUZ6dJTwno548T2Rg88mgnfUSW66', '2014-07-14 17:30:56'),
(21, 1, 'cnrDa8TUIgOiXgv0Rxn6tUFd34gOPQOs62R6wGtb', '2014-07-14 17:30:56'),
(22, 1, 'XtMu5oraKRAx35KzDo6thATSi2FsYn2sbeh7ouzY', '2014-07-14 17:30:56'),
(23, 1, 'pnRXSavg6KSpGZi0gME6mjOeCVp7Sp463kwmKIsj', '2014-07-14 17:31:42'),
(24, 1, 'WqMgssECIMcgbCFXON0qABG6MUgHdQzVBCXqU6S7', '2014-07-14 17:31:58'),
(25, 1, 'gX2HByKxc4GnqHpWgMc5FMntHV68wuAyI4BkRI7u', '2014-07-14 17:32:09'),
(26, 1, 'IT5T4XCJVKrFSDTjXRyXKzqM6Scd2jXB7RvWKycc', '2014-07-14 17:32:21'),
(27, 1, 'EsBORjy4pu6qRHUXcG44yvm6dWGV3eJBwhMfnFC4', '2014-07-14 17:32:29'),
(28, 1, 'KXE7Z4PvPnFUc80mQ63pZoT7goS4pRN0kSvBmgS2', '2014-07-21 01:06:13'),
(29, 1, 'WENWsJEDPx0TzMajSbnUFZXnVxUnQDBiEp2WvbWF', '2014-07-21 01:07:10'),
(30, 1, 'XbgkEqjJzSYWNWfgPAqKXYDu30nbFFtzGzFmgPR3', '2014-07-21 01:08:43'),
(31, 1, 'QEeZvA84u26ZH0xYmaJYFbivPJgV73jK4ogpJcMZ', '2014-07-21 01:13:11'),
(32, 1, 'xhBrcjTW6xR52UXBHvst3UKGfjGBtA7miAygko6E', '2014-07-21 01:14:08'),
(33, 1, 'WEtsc6K7QG8HSWF6TZUrvexHSd7wGSm7xanzYyuk', '2014-07-21 01:15:10'),
(34, 1, 'Iwkw2mIQJUhrIPjqtHun4bXsGFaNf8gORNBoUKZa', '2014-07-21 01:15:20'),
(35, 1, 'TNqBv8pWE2mAjtgw3zKRZQPCEJOyXFZnpKJfgzyh', '2014-07-21 01:17:20'),
(36, 1, 'vEwiyeyMIjNdoudXnx5mY4zKIfMrszoi0bnufGBJ', '2014-07-21 01:18:51'),
(37, 1, '5zDyjibrqyOGU0gMusF2bXgntjGImQPJmtDrxA8i', '2014-07-21 01:29:26'),
(38, 1, 'Ohkb78tmDeCRb7wp73q6WMRoYY43Fvuq5ar3ZfEz', '2014-07-21 01:29:32'),
(39, 1, 'XmpQtG0XrdKMGSqQrbEupf03YaGXV07pho20QSPC', '2014-07-21 01:31:21'),
(40, 1, 'BkccmTsZ4cJZmmj2Jvq0GbKeqvxZbpz6zX2CiJ5g', '2014-07-21 01:31:23'),
(41, 1, 'AXYkwIr4mykjgc2kXE2a4GHBDfKsOyskRnrERdc6', '2014-07-21 01:32:49'),
(42, 1, 'pxzuGWYs0j5MqRJknjndS4CxdP8Xh4msrChXzcGr', '2014-07-21 01:33:55'),
(43, 1, '07kBnVNX3ZjPtb5Ziu2XqJ520hSBaVJ0rUX7HgSA', '2014-07-21 01:34:36'),
(44, 1, 'hYROMi5aCTJ0unZfRsqgwposB8yRWQpZkBFSFDpI', '2014-07-21 01:34:55'),
(45, 1, 'ZwxsrRIpPhRsqkeGKXHcvFSo7eEHPiPK2D6NrDXB', '2014-07-21 01:37:13'),
(46, 1, 'fMDtpDYgD2F2SIpmmYsbr0xjc60EwyJ3BjMMNgOn', '2014-07-21 01:39:30'),
(47, 1, 'aPkC7ndISntBw6IrTA8QkhfHOUNZkUMgbSjAAnfP', '2014-07-21 01:39:44'),
(48, 1, 'YAHtRmGGZoubh6MoHDY0Gp6KdGfnDGK5hPrY2T3S', '2014-07-21 01:42:46'),
(49, 1, 'o0PSD8teSuwFxjgJKyxiZ2sVW8qVX3aGxmVWKJWz', '2014-08-02 22:12:58'),
(50, 1, 'ZqaKG7RFPeEgXKfrSnTWd0QF8ceuqf5GV6Oy4bZI', '2014-08-03 00:16:44'),
(51, 1, 'MTXU3C6dIQQrATVRU8rHwK2zr2KcMqMyAfk5DEbn', '2014-08-03 00:17:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_code_auth_apps_scopes`
--

CREATE TABLE IF NOT EXISTS `users_code_auth_apps_scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apps_id` int(11) NOT NULL,
  `scopes_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `users_code_auth_apps_scopes`
--

INSERT INTO `users_code_auth_apps_scopes` (`id`, `apps_id`, `scopes_id`) VALUES
(6, 1, '1'),
(7, 1, '2'),
(8, 1, '3'),
(9, 2, '3'),
(10, 2, '4'),
(11, 3, '1'),
(12, 3, '2'),
(13, 3, '3'),
(14, 3, '4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_users`
--

CREATE TABLE IF NOT EXISTS `users_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `name` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL,
  `state_email` tinyint(1) NOT NULL DEFAULT '0',
  `img` varchar(255) DEFAULT NULL,
  `registered` datetime NOT NULL,
  `papelera` tinyint(1) NOT NULL DEFAULT '0',
  `phone` int(10) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `users_users`
--

INSERT INTO `users_users` (`id`, `password`, `email`, `name`, `lastname`, `username`, `state`, `state_email`, `img`, `registered`, `papelera`, `phone`, `address`, `birthdate`) VALUES
(1, 'd033e22ae348aeb5660fc2140aec35850c4da997', 'admin@email.com', 'Admin', 'Admin', 'admin', 1, 1, NULL, '2013-10-30 02:39:34', 0, NULL, NULL, NULL),
(2, '12dea96fec20593566ab75692c9949596833adc9', 'user@email.com', 'User', 'Site', 'user', 1, 1, NULL, '2014-05-30 15:04:47', 0, NULL, NULL, NULL),
(3, 'dc76e9f0c0006e8f919e0c515c66dbba3982f785', 'root@email.com', 'Root', 'Root', 'root', 1, 1, NULL, '2014-05-30 15:04:47', 0, NULL, NULL, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users_authassignment`
--
ALTER TABLE `users_authassignment`
  ADD CONSTRAINT `users_authassignment_ibfk_1` FOREIGN KEY (`itemname`) REFERENCES `users_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `users_authitemchild`
--
ALTER TABLE `users_authitemchild`
  ADD CONSTRAINT `users_authitemchild_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `users_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_authitemchild_ibfk_2` FOREIGN KEY (`child`) REFERENCES `users_authitem` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
