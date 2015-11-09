-- phpMyAdmin SQL Dump
-- version 4.4.14.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2015 at 11:45 AM
-- Server version: 5.6.26
-- PHP Version: 5.5.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `retalapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `shopping_categories`
--

CREATE TABLE IF NOT EXISTS `shopping_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL COMMENT 'label:Nombre',
  `slug` varchar(100) NOT NULL COMMENT 'type:slug',
  `color` varchar(6) NOT NULL COMMENT 'type:color',
  `icon` varchar(100) NOT NULL COMMENT 'type:icon;label:Icono',
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_categories`
--

INSERT INTO `shopping_categories` (`id`, `name`, `slug`, `color`, `icon`, `orden_id`) VALUES
(4, 'Matemáticas financiera', 'matemticas-financiera', '00BD9A', 'fa-bar-chart-o', 5),
(5, 'NIIF', 'niif', '0096CA', 'fa-calendar', 4),
(6, 'Finanzas', 'finanzas', 'FF8328', 'fa-bank', 3),
(7, 'Normatividad', 'normatividad', 'FC4234', 'fa-bullhorn', 2),
(8, 'Leyes', 'leyes', 'FED94F', 'fa-mortar-board', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_conditions`
--

CREATE TABLE IF NOT EXISTS `shopping_conditions` (
  `id` int(11) NOT NULL,
  `conditions` text NOT NULL COMMENT 'type:wisi;label:Términos y condiciones'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_conditions`
--

INSERT INTO `shopping_conditions` (`id`, `conditions`) VALUES
(1, '        <h1 class=" text-left border-title"> Terms and Conditions.</h1>          <p> <strong> Please read the following terms and conditions very carefully as your use of service is subject to your acceptance of and compliance with the following terms and conditions ("Terms"). </strong> </p>          <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus nec fringilla diam. Quisque sed sagittis sem. Nulla ultrices tortor eu ligula pulvinar rutrum. Sed euismod, turpis posuere feugiat lacinia, velit tortor elementum eros, sit amet consectetur risus est varius mi. Curabitur sit amet </p>          <hr>          <div class="w100 clearfix">            <h3> Introduction </h3>            <p> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus risus nisl, fringilla vitae orci non, mollis dapibus dui. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam quis vestibulum nunc. Nam malesuada leo vel nibh ullamcorper varius. In hac habitasse platea dictumst. Pellentesque adipiscing nulla ut justo facilisis, et aliquam ipsum cursus. Nunc ullamcorper cursus ipsum. Nullam dictum, justo a pellentesque tempor, diam risus mollis massa, ac adipiscing orci diam egestas eros. </p>            <hr>            <h3> User Account, Password, and Security: </h3>            <p> Vivamus luctus egestas convallis. Vestibulum arcu sapien, consequat a urna a, gravida molestie est. Mauris iaculis felis id elit laoreet, vitae blandit odio lacinia. Etiam viverra arcu lobortis semper posuere. Curabitur mattis a erat at ultricies. Duis ac porta est, non rhoncus orci. Sed venenatis, nunc sit amet eleifend consequat, nibh leo laoreet purus, id pretium purus quam quis magna. Nullam mollis velit eu velit congue, quis facilisis tortor vestibulum. Sed malesuada nibh vitae neque pulvinar pretium. Nullam fermentum aliquet metus ac sollicitudin. </p>            <hr>            <h3> Privacy Policy: </h3>            <p> Duis eu massa diam. Donec in porta tortor, in pharetra velit. Nunc at justo convallis, tempor tortor non, tempus mauris. Integer tristique nisl hendrerit, rhoncus odio a, semper risus. Integer vehicula tempus porttitor. Praesent odio nibh, commodo vel posuere non, rhoncus id augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pretium eros sit amet gravida blandit. Suspendisse potenti. Integer interdum facilisis urna, nec condimentum dolor consequat at. Etiam eu elit adipiscing, ultricies elit a, tincidunt felis. Proin lobortis auctor lectus, id vestibulum felis tincidunt a. Quisque molestie euismod diam, sit amet condimentum ligula pellentesque a. </p>            <hr>            <h3> User Conduct and Rules: </h3>            <p> Donec sit amet convallis est. Morbi molestie, est sed viverra vehicula, ligula sem egestas urna, vel porta erat purus nec quam. Nunc ac iaculis sem. Aenean varius augue quam, et fringilla turpis porta mollis. Pellentesque quis cursus erat, a molestie neque. Fusce sed magna eu purus rhoncus fermentum. Cras non arcu ac metus volutpat varius. Duis id eros ac felis sodales ornare. </p>            <p> Duis eu massa diam. Donec in porta tortor, in pharetra velit. Nunc at justo convallis, tempor tortor non, tempus mauris. Integer tristique nisl hendrerit, rhoncus odio a, semper risus. Integer vehicula tempus porttitor. Praesent odio nibh, commodo vel posuere non, rhoncus id augue. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus pretium eros sit amet gravida blandit. Suspendisse potenti. Integer interdum facilisis urna, nec condimentum dolor consequat at. Etiam eu elit adipiscing, ultricies elit a, tincidunt felis. Proin lobortis auctor lectus, id vestibulum felis tincidunt a. Quisque molestie euismod diam, sit amet condimentum ligula pellentesque a. </p>            <hr>            <h3> Shipping: </h3>            <p> Etiam tempus sodales luctus. Nam mattis ipsum id magna sollicitudin, et ullamcorper neque eleifend. Integer at augue et purus facilisis ultrices. Mauris aliquet rutrum suscipit. Morbi quis nulla eget quam tempus aliquam in pretium purus. Aliquam porttitor, magna eu euismod lacinia, diam neque facilisis arcu, sit amet condimentum massa turpis vel nisl. Suspendisse lobortis lorem mollis, sodales magna non, eleifend neque. Vestibulum vulputate nibh et lacus luctus venenatis. Mauris pulvinar ultrices libero, interdum convallis urna dapibus sed. Sed libero ligula, ultricies non pharetra at, ullamcorper sed quam. </p>            <hr>            <h3> Delivery: </h3>            <p> sit amet condimentum massa turpis vel nisl. Suspendisse lobortis lorem mollis, sodales magna non, eleifend neque. Vestibulum vulputate nibh et lacus luctus venenatis. Mauris pulvinar ultrices libero, interdum convallis urna dapibus sed. Sed libero ligula, ultricies non pharetra at, ullamcorper sed quam. </p>            <hr>            <h3> Customer : </h3>            <p> </p>            <ul class="list-dot">              <li> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>              <li> Phasellus dignissim eros id nibh lacinia, ac mollis odio vulputate. </li>              <li> Pellentesque sed nibh facilisis, auctor eros sit amet, ultricies ipsum. </li>              <li> Sed vitae sem varius risus imperdiet pulvinar. </li>            </ul>            <p> </p>            <p> </p>            <ul class="list-dot">              <li> Phasellus molestie nisl ultricies neque auctor, eget iaculis justo ultrices. </li>              <li> Vivamus mattis sapien id nisl bibendum, id scelerisque enim faucibus. </li>              <li> Proin ornare odio feugiat urna cursus placerat. </li>              <li> Sed at mi quis quam ornare varius a at ligula. </li>            </ul>            <p> </p>            <p> </p>            <ul class="list-dot">              <li> Fusce nec augue et libero mattis venenatis nec quis arcu. </li>              <li> Nulla mollis neque a orci cursus scelerisque. </li>              <li> Nullam eu enim ut lectus sodales commodo eu ut lorem. </li>              <li> Donec et enim pellentesque, faucibus mauris eu, euismod enim. </li>            </ul>            <p> </p>            <p>            </p><hr>            <h3> Cancellation of Bulk Orders : </h3>            <p> </p>            <ul class="list-number">              <li> Lorem ipsum dolor sit amet, consectetur adipiscing elit. </li>              <li> Phasellus dignissim eros id nibh lacinia, ac mollis odio vulputate. </li>              <li> Pellentesque sed nibh facilisis, auctor eros sit amet, ultricies ipsum. </li>              <li> Sed vitae sem varius risus imperdiet pulvinar. </li>              <li> Phasellus molestie nisl ultricies neque auctor, eget iaculis justo ultrices. </li>              <li> Vivamus mattis sapien id nisl bibendum, id scelerisque enim faucibus. </li>              <li> Proin ornare odio feugiat urna cursus placerat. </li>              <li> Sed at mi quis quam ornare varius a at ligula. </li>            </ul>            <hr>          </div>      ');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_config`
--

CREATE TABLE IF NOT EXISTS `shopping_config` (
  `id` int(11) NOT NULL,
  `request_message` text NOT NULL COMMENT 'type:wisi;label:Instrucción para pedidos',
  `shopping_description` varchar(255) NOT NULL COMMENT 'label:Descripción de la compra',
  `allow_request` tinyint(1) DEFAULT '0' COMMENT 'label:Habilitar pago consignación'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_config`
--

INSERT INTO `shopping_config` (`id`, `request_message`, `shopping_description`, `allow_request`) VALUES
(1, '<p>Para que realicemos la entrega de su regalo usted debe enviarnos el soporte de la consignación o giro nuestro correo electrónico</p><p><strong>Datos para consignación desde Colombia:</strong> <br><em><span style="font-weight: bold;">Cuenta de Ahorros - Banco Davivienda </span><br>Número de cuenta - <span style="font-weight: bold;">123123123123</span></em><span style="font-weight: bold;"> </span><br><em>Titular de la cuenta - <span style="font-weight: bold;">Pedro perez</span></em><br><em>Cédula titular - <span style="font-weight: bold;">123123 de Bogotá</span></em><span style="font-weight: bold;"> </span><br></p><p><strong>Datos para pagos desde el exterior:</strong> <br><em>A nombre&nbsp;</em><em><span style="font-weight: bold;">Pedro perez</span></em><em><span style="font-weight: bold;">&nbsp;</span><br>Cedula: <strong>123123 de Bogotá</strong><br>Dirección: <strong>Carrera 58c # 152b-66 Torre 2 Apto 104</strong><br>Celular: <strong>123123123</strong> <br></em> <br></p>', 'A new shop in MyApp', 0);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_detail`
--

CREATE TABLE IF NOT EXISTS `shopping_detail` (
  `id` int(11) NOT NULL,
  `shopping_items_id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL COMMENT 'label:Nombre',
  `slug` varchar(255) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL COMMENT 'type:img',
  `description` text NOT NULL COMMENT 'label:Descripción corta',
  `description_detail` text NOT NULL COMMENT 'label:Descripción',
  `price` float(9,2) NOT NULL COMMENT 'type:money;label:Precio',
  `amount` int(11) NOT NULL DEFAULT '1' COMMENT 'label:Unds',
  `state` tinyint(1) DEFAULT NULL COMMENT 'label:Estado',
  `shopping_header_id` int(11) NOT NULL,
  `shopping_categories_name` varchar(255) NOT NULL COMMENT 'label:Categoría',
  `orden_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_facilitador`
--

CREATE TABLE IF NOT EXISTS `shopping_facilitador` (
  `id` int(11) NOT NULL,
  `imagen` varchar(100) NOT NULL COMMENT 'type:img',
  `nombre` varchar(100) NOT NULL,
  `perfil` text NOT NULL,
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_facilitador`
--

INSERT INTO `shopping_facilitador` (`id`, `imagen`, `nombre`, `perfil`, `orden_id`) VALUES
(1, '1431069075.png', 'FERNANDO RUIZ HERNANDEZ', 'Contador Pùblico Universidad de Ibaguè. Especialista en Finanzas - Universidad del Tolima. Especialista en Docencia Universitaria - Universidad Cooperativa de Colombia. Estudios de especialización en Administración - Universidad de los Andes. Experto en Ambientes Virtuales de Aprendizaje. Actualmente se desempeña como socio - consultor financiero en Consultores en Finanzas & Auditores SAS. Experiencia en valoración de empresas, revisoría fiscal, portafolios de inversion, auditoria de gestiòn financiera y consultor externo en la implementación y convergencia a Normas Internacionales de InformaciÓn Financieras NIIF Pymes. CEO de Escuela de Finanzas y Negocios. Docente Universitario en el área de Finanzas - Universidad Cooperativa de Colombia.', 2),
(2, '1431069087.png', 'JUAN GONZALES', 'Contador Pùblico Universidad de Ibaguè. Especialista en Finanzas - Universidad del Tolima. Especialista en Docencia Universitaria - Universidad Cooperativa de Colombia. Estudios de especialización en Administración - Universidad de los Andes. Experto en Ambientes Virtuales de Aprendizaje. Actualmente se desempeña como socio - consultor financiero en Consultores en Finanzas & Auditores SAS. Experiencia en valoración de empresas, revisoría fiscal, portafolios de inversion, auditoria de gestiòn financiera y consultor externo en la implementación y convergencia a Normas Internacionales de InformaciÓn Financieras NIIF Pymes. CEO de Escuela de Finanzas y Negocios. Docente Universitario en el área de Finanzas - Universidad Cooperativa de Colombia.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_features`
--

CREATE TABLE IF NOT EXISTS `shopping_features` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img;label:Imagen',
  `title` varchar(100) NOT NULL COMMENT 'label:Título',
  `description` text NOT NULL COMMENT 'label:Descripción',
  `orden_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_features`
--

INSERT INTO `shopping_features` (`id`, `image`, `title`, `description`, `orden_id`) VALUES
(1, '1429848758.png', 'COMPRA FÁCIL Y RÁPIDO', 'Selecciona los regalos que quieres dar e ingresa tus datos y los datos de la persona a la que entregaremos el regalo, tienes la opción de enviarle un mensaje.', 2),
(2, '1429848794.png', 'DIFERENTES METODOS DE PAGO', 'Selecciona la opción de pago desees, puedes pagar a través de tarjeta débito, crédito, consignación, punto de pago Baloto o también la opción de pagar contra entrega así enviamos a uno de nuestros colaboradores a tu domicilio.', 3),
(3, '1429848835.png', 'FOTO DEL MOMENTO DEL OBSEQUIO', 'En todos nuestros servicios incluimos la opción que tu puedas tener una foto del momento de la entrega del regalo, un momento tan especial de grata sorpresa debe quedar registrado en tu memoria y en tu album de fotos.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_header`
--

CREATE TABLE IF NOT EXISTS `shopping_header` (
  `id` int(11) NOT NULL,
  `ref_venta` varchar(255) NOT NULL,
  `buyer_name` varchar(255) NOT NULL COMMENT 'label:Nombre comprador',
  `buyer_email` varchar(255) NOT NULL COMMENT 'type:email;label:Correo comprador',
  `buyer_phone` varchar(255) DEFAULT NULL COMMENT 'label:Teléfono comprador',
  `buyer_address` varchar(255) DEFAULT NULL COMMENT 'label:Dirección comprador',
  `buyer_message` text COMMENT 'label:Mensaje para el destinatario',
  `send_name` varchar(255) DEFAULT NULL COMMENT 'label:Nombre destinatario',
  `send_phone` varchar(255) DEFAULT NULL COMMENT 'label:Teléfono destanatario',
  `send_address` varchar(255) DEFAULT NULL COMMENT 'label:Dirección destinatario',
  `send_date` date DEFAULT NULL COMMENT 'label:Fecha de entrega',
  `created_at` datetime NOT NULL COMMENT 'label:Fecha de la compra',
  `state` int(1) DEFAULT NULL COMMENT 'label:Estado de la compra',
  `pol_response` varchar(255) DEFAULT NULL COMMENT 'label:Respuesta de pasarela de pagos',
  `datetime_return_pay` datetime DEFAULT NULL,
  `message_return_pay` varchar(255) DEFAULT NULL,
  `code_response_pay` varchar(255) DEFAULT NULL,
  `code2_response_pay` varchar(255) DEFAULT NULL,
  `buyer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_images`
--

CREATE TABLE IF NOT EXISTS `shopping_images` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img;label:Imagen',
  `orden_id` int(11) NOT NULL,
  `shopping_items_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_images`
--

INSERT INTO `shopping_images` (`id`, `image`, `orden_id`, `shopping_items_id`) VALUES
(1, '1429794037.jpg', 29, 1),
(2, '1429794045.jpg', 28, 1),
(3, '1429794052.jpg', 27, 1),
(4, '1429795139.jpg', 26, 2),
(8, '1429795317.jpg', 4, 3),
(9, '1429795350.jpg', 7, 3),
(10, '1429826847.jpg', 25, 6),
(11, '1429826853.jpg', 24, 6),
(12, '1429826860.jpg', 23, 6),
(13, '1429826868.jpg', 22, 9),
(14, '1429826875.jpg', 21, 9),
(15, '1429826881.jpg', 20, 9),
(16, '1429826936.jpg', 19, 4),
(17, '1429826944.jpg', 18, 4),
(18, '1429826950.jpg', 17, 4),
(19, '1429826970.jpg', 16, 7),
(20, '1429826977.jpg', 15, 7),
(21, '1429827122.jpg', 14, 2),
(22, '1429827129.jpg', 13, 2),
(23, '1429827136.jpg', 12, 5),
(24, '1429827143.jpg', 11, 5),
(25, '1429827149.jpg', 10, 5),
(26, '1429827156.jpg', 9, 8),
(27, '1429827162.jpg', 8, 8),
(28, '1429827168.jpg', 6, 8),
(29, '1429853557.jpg', 5, 3),
(30, '1429853937.jpg', 3, 29),
(31, '1429853944.jpg', 2, 29),
(32, '1429853952.jpg', 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_info`
--

CREATE TABLE IF NOT EXISTS `shopping_info` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL COMMENT 'label:Descripción',
  `title` varchar(50) NOT NULL COMMENT 'label:Título',
  `image` varchar(100) NOT NULL COMMENT 'type:img;w:1433;h:955;label:Imagen de fondo'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_info`
--

INSERT INTO `shopping_info` (`id`, `description`, `title`, `image`) VALUES
(1, 'Hacemos que con sólo unos clics \r\nlogres desencadenar momentos inolvidables', '¿Que quieres regalar?', '1429848640.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_items`
--

CREATE TABLE IF NOT EXISTS `shopping_items` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL COMMENT 'type:img;label:Imagen',
  `video_promocional` varchar(100) NOT NULL COMMENT 'type:link',
  `name` varchar(60) NOT NULL COMMENT 'label:Nombre',
  `slug` varchar(255) NOT NULL COMMENT 'type:slug;field:name',
  `description` text NOT NULL COMMENT 'label:Descripción corta',
  `description_detail` text NOT NULL COMMENT 'type:wisi;label:Descripción',
  `price` float(9,2) NOT NULL COMMENT 'type:money;label:Precio',
  `free` tinyint(1) DEFAULT '0' COMMENT 'label:Es gratis',
  `state` tinyint(1) DEFAULT NULL COMMENT 'label:Estado',
  `shopping_categories_id` int(11) NOT NULL COMMENT 'type:select;table: shopping_categories;label:Categoría',
  `temas_relacionados` text,
  `shopping_facilitador_id` int(11) NOT NULL COMMENT 'label:Facilitador;type:select;table:shopping_facilitador',
  `orden_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_items`
--

INSERT INTO `shopping_items` (`id`, `image`, `video_promocional`, `name`, `slug`, `description`, `description_detail`, `price`, `free`, `state`, `shopping_categories_id`, `temas_relacionados`, `shopping_facilitador_id`, `orden_id`, `created_at`) VALUES
(10, '1431058948.png', 'https://vimeo.com/59312264', 'NIFF pymes', 'niff-pymes', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 100000.00, 0, 1, 4, 'Instrumentos Financieros - Inventarios - Deterioro de valor - Propiedad Planta y Equipo - Propiedades de Inversión Intangibl', 1, 3, '2015-05-08 06:23:18'),
(11, '1431059208.png', 'https://vimeo.com/106965985', 'Matemáticas financieras aplicadas a las NIFF', 'matemticas-financieras-aplicadas-a-las-niff', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', '<div>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod&nbsp;<span style="line-height: 1.42857142857143;">tempor incididunt ut labore et dolore magna aliqua.</span></div>', 140000.00, 0, 1, 5, ' Intangibles - Diferidos - Valorizaciones - Obligaciones Financieras - Otras Obligaciones - Proveedores Provision', 2, 2, '2015-05-08 06:27:21'),
(12, '1431059295.png', 'https://vimeo.com/126330316', 'Combo NIFF pymes', 'combo-niff-pymes', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'El objetivo del  VIDEO TALLER es facilitar el proceso de elaboración del balance de apertura - Estado de Situación Financiera - de acuerdo a los exigido en las Normas Internacionales de Información Financiera NIIF  para Pymes, mediante un ejercicio 100% PRACTICO  desarrollado en Excel y explicado por medio de videos.', 160000.00, 1, 1, 6, 'Instrumentos Financieros - Inventarios - Deterioro de valor - Propiedad Planta y Equipo - Propiedades de Inversión Intangibles - Diferidos - Valorizaciones - Obligaciones Financieras - Otras Obligaciones - Proveedores Provisiones y Contingencias - y otras cuentas del pasivo y patrimonio', 1, 1, '2015-05-08 06:28:17');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_material`
--

CREATE TABLE IF NOT EXISTS `shopping_material` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `orden_id` int(11) NOT NULL,
  `shopping_items_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_material`
--

INSERT INTO `shopping_material` (`id`, `nombre`, `orden_id`, `shopping_items_id`) VALUES
(1, '1. Archivo de excel con el desarrollo completro de una empresa modelo - caso práctico', 2, 12),
(2, '2. 9 Videos explicando paso a paso el proceso de elaboración del balance de apertura', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_updates`
--

CREATE TABLE IF NOT EXISTS `shopping_updates` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL COMMENT 'type:wisi',
  `orden_id` int(11) NOT NULL,
  `shopping_items_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_updates`
--

INSERT INTO `shopping_updates` (`id`, `message`, `orden_id`, `shopping_items_id`, `created_at`) VALUES
(1, '1. Archivo de excel con el desarrollo completro de una empresa modelo - caso práctico', 2, 12, '0000-00-00 00:00:00'),
(2, '2. 9 Videos explicando paso a paso el proceso de elaboración del balance de apertura', 1, 12, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shopping_videos`
--

CREATE TABLE IF NOT EXISTS `shopping_videos` (
  `id` int(11) NOT NULL,
  `link` varchar(100) DEFAULT NULL COMMENT 'type:link',
  `link_vimeo` varchar(100) DEFAULT NULL COMMENT 'type:link',
  `titulo` varchar(100) NOT NULL COMMENT 'label:Título',
  `descripcion` text NOT NULL COMMENT 'label:Descripción',
  `orden_id` int(11) NOT NULL,
  `shopping_items_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shopping_videos`
--

INSERT INTO `shopping_videos` (`id`, `link`, `link_vimeo`, `titulo`, `descripcion`, `orden_id`, `shopping_items_id`) VALUES
(3, '', 'https://vimeo.com/33400882', 'Lorem ipsum dolor s', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et do.', 5, 10),
(4, '', 'https://vimeo.com/38606677', 'Lorem ipsum d', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et do.', 4, 10),
(5, 'https://www.google.com.co/?gfe_rd=cr&ei=abhMVY6MPKGasgfYrICgCw', '', 'Middle aligned media', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et do.', 3, 10),
(6, '', 'https://vimeo.com/126136408', 'Video #1', 'Descripción Video #1', 2, 11),
(7, '', 'https://vimeo.com/126136408', 'Video #2', 'Descripción video #2', 1, 11);

-- --------------------------------------------------------

--
-- Table structure for table `shopping_view`
--

CREATE TABLE IF NOT EXISTS `shopping_view` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `shopping_video_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shopping_categories`
--
ALTER TABLE `shopping_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_conditions`
--
ALTER TABLE `shopping_conditions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_config`
--
ALTER TABLE `shopping_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_detail`
--
ALTER TABLE `shopping_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_header_id` (`shopping_header_id`);

--
-- Indexes for table `shopping_facilitador`
--
ALTER TABLE `shopping_facilitador`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_features`
--
ALTER TABLE `shopping_features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_header`
--
ALTER TABLE `shopping_header`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_images`
--
ALTER TABLE `shopping_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_info`
--
ALTER TABLE `shopping_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_items`
--
ALTER TABLE `shopping_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_material`
--
ALTER TABLE `shopping_material`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_updates`
--
ALTER TABLE `shopping_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_videos`
--
ALTER TABLE `shopping_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shopping_view`
--
ALTER TABLE `shopping_view`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopping_categories`
--
ALTER TABLE `shopping_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `shopping_conditions`
--
ALTER TABLE `shopping_conditions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shopping_config`
--
ALTER TABLE `shopping_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shopping_detail`
--
ALTER TABLE `shopping_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shopping_facilitador`
--
ALTER TABLE `shopping_facilitador`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shopping_features`
--
ALTER TABLE `shopping_features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shopping_header`
--
ALTER TABLE `shopping_header`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shopping_images`
--
ALTER TABLE `shopping_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `shopping_info`
--
ALTER TABLE `shopping_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shopping_items`
--
ALTER TABLE `shopping_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `shopping_material`
--
ALTER TABLE `shopping_material`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shopping_updates`
--
ALTER TABLE `shopping_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shopping_videos`
--
ALTER TABLE `shopping_videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `shopping_view`
--
ALTER TABLE `shopping_view`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `shopping_detail`
--
ALTER TABLE `shopping_detail`
  ADD CONSTRAINT `shopping_detail_ibfk_1` FOREIGN KEY (`shopping_header_id`) REFERENCES `shopping_header` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
