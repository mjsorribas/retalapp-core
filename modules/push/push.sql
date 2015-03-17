CREATE TABLE IF NOT EXISTS `push_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `android_api_key` varchar(1000) DEFAULT NULL,
  `android_host` varchar(250) DEFAULT NULL,
  `ios_pwd` varchar(500) DEFAULT NULL,
  `ios_cert` varchar(100) DEFAULT NULL COMMENT 'type:file;ext:pem;label:Importar archivo pem',
  `ios_host` varchar(500) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


CREATE TABLE IF NOT EXISTS `push_device_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `push_device_type`
--

INSERT INTO `push_device_type` (`id`, `tipo`) VALUES
(1, 'IOS'),
(2, 'Android');

CREATE TABLE IF NOT EXISTS `push_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mobile_id_from` int(11) NOT NULL,
  `mobile_id_to` int(11) NOT NULL,
  `message` mediumtext,
  `img_imagen` varchar(50) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `mobile_id` (`mobile_id_from`),
  KEY `mobile_id_to` (`mobile_id_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `push_mobiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uuid` varchar(300) NOT NULL,
  `device_type` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `device_type` (`device_type`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

ALTER TABLE `push_message`
  ADD CONSTRAINT `PK_MOBILES_from` FOREIGN KEY (`mobile_id_from`) REFERENCES `push_mobiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `PK_MOBILES_to` FOREIGN KEY (`mobile_id_to`) REFERENCES `push_mobiles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;








