-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-05-2022 a las 22:44:32
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `accelerate`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `business_maturity`
--

DROP TABLE IF EXISTS `business_maturity`;
CREATE TABLE IF NOT EXISTS `business_maturity` (
  `maturity_id` int(11) NOT NULL AUTO_INCREMENT,
  `maturity` varchar(250) NOT NULL,
  PRIMARY KEY (`maturity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `business_maturity`
--

INSERT INTO `business_maturity` (`maturity_id`, `maturity`) VALUES
(1, 'Sin clasificar'),
(2, 'Madurez basica'),
(3, 'Madurez intermedia'),
(4, 'Madurez avanzada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chiefs`
--

DROP TABLE IF EXISTS `chiefs`;
CREATE TABLE IF NOT EXISTS `chiefs` (
  `chief_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `chief_user_id` int(11) NOT NULL,
  `employee_user_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`chief_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chiefs`
--

INSERT INTO `chiefs` (`chief_id`, `organization_id`, `chief_user_id`, `employee_user_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2, 1, 1, 4, 1, '2022-04-28 16:15:38', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `civil_status`
--

DROP TABLE IF EXISTS `civil_status`;
CREATE TABLE IF NOT EXISTS `civil_status` (
  `civil_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `civil_status` varchar(75) NOT NULL,
  PRIMARY KEY (`civil_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `civil_status`
--

INSERT INTO `civil_status` (`civil_status_id`, `civil_status`) VALUES
(1, 'Soltero(a)'),
(2, 'Casado(a)'),
(3, 'Divorciado(a)'),
(4, 'Viudo(a)'),
(5, 'Union libre'),
(6, 'Union civil'),
(7, 'Sociedad de convivencia'),
(8, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencies`
--

DROP TABLE IF EXISTS `competencies`;
CREATE TABLE IF NOT EXISTS `competencies` (
  `competency_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `competency` varchar(250) NOT NULL,
  PRIMARY KEY (`competency_id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `competencies`
--

INSERT INTO `competencies` (`competency_id`, `competency`) VALUES
(1, 'Coeficiente Intelectual'),
(2, 'Competencia en Análisis de Problemas'),
(3, 'Competencia para la Toma de Decisiones'),
(4, 'Competencia de Juicio'),
(5, 'Competencia en Comunicación'),
(6, 'Competencia en Liderazgo'),
(7, 'Competencia para la Delegación'),
(8, 'Competencia para el Desarrollo de Colaboradores'),
(9, 'Competencia para el Trabajo en Equipo'),
(10, 'Competencia en Inteligencia Emocional'),
(11, 'Competencia para la Tolerancia a la Presión'),
(12, 'Competencia en Actitud de Servicio'),
(13, 'Competencia para el Seguimiento y Control'),
(14, 'Competencia en Planeación y Organización'),
(15, 'Competencia en Enfoque a Resultados'),
(16, 'Gusto por la Venta'),
(17, 'Capacidad de Negociación'),
(18, 'Habilidades de Comunicación'),
(19, 'Empatía'),
(20, 'Orientación a Resultados para las ventas'),
(21, 'Tolerancia al Rechazo'),
(22, 'Autodisciplina'),
(23, 'Liderazgo Directivo'),
(24, 'Liderazgo Participativo ó Democrático'),
(25, 'Liderazgo Delegativo'),
(26, 'Liderazgo Transformacional'),
(27, 'Liderazgo Transaccional'),
(28, 'Capacidad de Comunicación'),
(29, 'Inteligencia Emocional'),
(30, 'Toma de Decisiones'),
(31, 'Orientación a Resultados'),
(32, 'Habilidades de Negociación'),
(33, 'Capacidad de Mando'),
(34, 'Capacidad de Planeación'),
(35, 'Conciencia de sus Fortalezas'),
(36, 'Desarrollo Personal y de su Equipo'),
(37, 'Carisma y Habilidades Sociales'),
(38, 'Conciencia Social'),
(39, 'Creatividad e Innovación'),
(40, 'Responsabilidad'),
(41, 'Habilidad de Información'),
(42, 'Adaptación al Cambio'),
(43, 'Índice de Confianza'),
(44, 'Descripción del Nivel de Certidumbre y Confianza General'),
(45, 'Nivel de Honestidad'),
(46, 'Descripción del Nivel de Honestidad'),
(47, 'Nivel de ética'),
(48, 'Descripción del Nivel de ética'),
(49, 'Nivel de Valores'),
(50, 'Descripción del Nivel de Valores');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(2) DEFAULT NULL,
  `country` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `countries`
--

INSERT INTO `countries` (`country_id`, `code`, `country`) VALUES
(1, 'AF', 'Afganistán'),
(2, 'AX', 'Islas Gland'),
(3, 'AL', 'Albania'),
(4, 'DE', 'Alemania'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antártida'),
(9, 'AG', 'Antigua y Barbuda'),
(10, 'AN', 'Antillas Holandesas'),
(11, 'SA', 'Arabia Saudí'),
(12, 'DZ', 'Argelia'),
(13, 'AR', 'Argentina'),
(14, 'AM', 'Armenia'),
(15, 'AW', 'Aruba'),
(16, 'AU', 'Australia'),
(17, 'AT', 'Austria'),
(18, 'AZ', 'Azerbaiyán'),
(19, 'BS', 'Bahamas'),
(20, 'BH', 'Bahréin'),
(21, 'BD', 'Bangladesh'),
(22, 'BB', 'Barbados'),
(23, 'BY', 'Bielorrusia'),
(24, 'BE', 'Bélgica'),
(25, 'BZ', 'Belice'),
(26, 'BJ', 'Benin'),
(27, 'BM', 'Bermudas'),
(28, 'BT', 'Bhután'),
(29, 'BO', 'Bolivia'),
(30, 'BA', 'Bosnia y Herzegovina'),
(31, 'BW', 'Botsuana'),
(32, 'BV', 'Isla Bouvet'),
(33, 'BR', 'Brasil'),
(34, 'BN', 'Brunéi'),
(35, 'BG', 'Bulgaria'),
(36, 'BF', 'Burkina Faso'),
(37, 'BI', 'Burundi'),
(38, 'CV', 'Cabo Verde'),
(39, 'KY', 'Islas Caimán'),
(40, 'KH', 'Camboya'),
(41, 'CM', 'Camerún'),
(42, 'CA', 'Canadá'),
(43, 'CF', 'República Centroafricana'),
(44, 'TD', 'Chad'),
(45, 'CZ', 'República Checa'),
(46, 'CL', 'Chile'),
(47, 'CN', 'China'),
(48, 'CY', 'Chipre'),
(49, 'CX', 'Isla de Navidad'),
(50, 'VA', 'Ciudad del Vaticano'),
(51, 'CC', 'Islas Cocos'),
(52, 'CO', 'Colombia'),
(53, 'KM', 'Comoras'),
(54, 'CD', 'República Democrática del Congo'),
(55, 'CG', 'Congo'),
(56, 'CK', 'Islas Cook'),
(57, 'KP', 'Corea del Norte'),
(58, 'KR', 'Corea del Sur'),
(59, 'CI', 'Costa de Marfil'),
(60, 'CR', 'Costa Rica'),
(61, 'HR', 'Croacia'),
(62, 'CU', 'Cuba'),
(63, 'DK', 'Dinamarca'),
(64, 'DM', 'Dominica'),
(65, 'DO', 'República Dominicana'),
(66, 'EC', 'Ecuador'),
(67, 'EG', 'Egipto'),
(68, 'SV', 'El Salvador'),
(69, 'AE', 'Emiratos Árabes Unidos'),
(70, 'ER', 'Eritrea'),
(71, 'SK', 'Eslovaquia'),
(72, 'SI', 'Eslovenia'),
(73, 'ES', 'España'),
(74, 'UM', 'Islas ultramarinas de Estados Unidos'),
(75, 'US', 'Estados Unidos'),
(76, 'EE', 'Estonia'),
(77, 'ET', 'Etiopía'),
(78, 'FO', 'Islas Feroe'),
(79, 'PH', 'Filipinas'),
(80, 'FI', 'Finlandia'),
(81, 'FJ', 'Fiyi'),
(82, 'FR', 'Francia'),
(83, 'GA', 'Gabón'),
(84, 'GM', 'Gambia'),
(85, 'GE', 'Georgia'),
(86, 'GS', 'Islas Georgias del Sur y Sandwich del Sur'),
(87, 'GH', 'Ghana'),
(88, 'GI', 'Gibraltar'),
(89, 'GD', 'Granada'),
(90, 'GR', 'Grecia'),
(91, 'GL', 'Groenlandia'),
(92, 'GP', 'Guadalupe'),
(93, 'GU', 'Guam'),
(94, 'GT', 'Guatemala'),
(95, 'GF', 'Guayana Francesa'),
(96, 'GN', 'Guinea'),
(97, 'GQ', 'Guinea Ecuatorial'),
(98, 'GW', 'Guinea-Bissau'),
(99, 'GY', 'Guyana'),
(100, 'HT', 'Haití'),
(101, 'HM', 'Islas Heard y McDonald'),
(102, 'HN', 'Honduras'),
(103, 'HK', 'Hong Kong'),
(104, 'HU', 'Hungría'),
(105, 'IN', 'India'),
(106, 'ID', 'Indonesia'),
(107, 'IR', 'Irán'),
(108, 'IQ', 'Iraq'),
(109, 'IE', 'Irlanda'),
(110, 'IS', 'Islandia'),
(111, 'IL', 'Israel'),
(112, 'IT', 'Italia'),
(113, 'JM', 'Jamaica'),
(114, 'JP', 'Japón'),
(115, 'JO', 'Jordania'),
(116, 'KZ', 'Kazajstán'),
(117, 'KE', 'Kenia'),
(118, 'KG', 'Kirguistán'),
(119, 'KI', 'Kiribati'),
(120, 'KW', 'Kuwait'),
(121, 'LA', 'Laos'),
(122, 'LS', 'Lesotho'),
(123, 'LV', 'Letonia'),
(124, 'LB', 'Líbano'),
(125, 'LR', 'Liberia'),
(126, 'LY', 'Libia'),
(127, 'LI', 'Liechtenstein'),
(128, 'LT', 'Lituania'),
(129, 'LU', 'Luxemburgo'),
(130, 'MO', 'Macao'),
(131, 'MK', 'ARY Macedonia'),
(132, 'MG', 'Madagascar'),
(133, 'MY', 'Malasia'),
(134, 'MW', 'Malawi'),
(135, 'MV', 'Maldivas'),
(136, 'ML', 'Malí'),
(137, 'MT', 'Malta'),
(138, 'FK', 'Islas Malvinas'),
(139, 'MP', 'Islas Marianas del Norte'),
(140, 'MA', 'Marruecos'),
(141, 'MH', 'Islas Marshall'),
(142, 'MQ', 'Martinica'),
(143, 'MU', 'Mauricio'),
(144, 'MR', 'Mauritania'),
(145, 'YT', 'Mayotte'),
(146, 'MX', 'México'),
(147, 'FM', 'Micronesia'),
(148, 'MD', 'Moldavia'),
(149, 'MC', 'Mónaco'),
(150, 'MN', 'Mongolia'),
(151, 'MS', 'Montserrat'),
(152, 'MZ', 'Mozambique'),
(153, 'MM', 'Myanmar'),
(154, 'NA', 'Namibia'),
(155, 'NR', 'Nauru'),
(156, 'NP', 'Nepal'),
(157, 'NI', 'Nicaragua'),
(158, 'NE', 'Níger'),
(159, 'NG', 'Nigeria'),
(160, 'NU', 'Niue'),
(161, 'NF', 'Isla Norfolk'),
(162, 'NO', 'Noruega'),
(163, 'NC', 'Nueva Caledonia'),
(164, 'NZ', 'Nueva Zelanda'),
(165, 'OM', 'Omán'),
(166, 'NL', 'Países Bajos'),
(167, 'PK', 'Pakistán'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestina'),
(170, 'PA', 'Panamá'),
(171, 'PG', 'Papúa Nueva Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Perú'),
(174, 'PN', 'Islas Pitcairn'),
(175, 'PF', 'Polinesia Francesa'),
(176, 'PL', 'Polonia'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'GB', 'Reino Unido'),
(181, 'RE', 'Reunión'),
(182, 'RW', 'Ruanda'),
(183, 'RO', 'Rumania'),
(184, 'RU', 'Rusia'),
(185, 'EH', 'Sahara Occidental'),
(186, 'SB', 'Islas Salomón'),
(187, 'WS', 'Samoa'),
(188, 'AS', 'Samoa Americana'),
(189, 'KN', 'San Cristóbal y Nevis'),
(190, 'SM', 'San Marino'),
(191, 'PM', 'San Pedro y Miquelón'),
(192, 'VC', 'San Vicente y las Granadinas'),
(193, 'SH', 'Santa Helena'),
(194, 'LC', 'Santa Lucía'),
(195, 'ST', 'Santo Tomé y Príncipe'),
(196, 'SN', 'Senegal'),
(197, 'CS', 'Serbia y Montenegro'),
(198, 'SC', 'Seychelles'),
(199, 'SL', 'Sierra Leona'),
(200, 'SG', 'Singapur'),
(201, 'SY', 'Siria'),
(202, 'SO', 'Somalia'),
(203, 'LK', 'Sri Lanka'),
(204, 'SZ', 'Suazilandia'),
(205, 'ZA', 'Sudáfrica'),
(206, 'SD', 'Sudán'),
(207, 'SE', 'Suecia'),
(208, 'CH', 'Suiza'),
(209, 'SR', 'Surinam'),
(210, 'SJ', 'Svalbard y Jan Mayen'),
(211, 'TH', 'Tailandia'),
(212, 'TW', 'Taiwán'),
(213, 'TZ', 'Tanzania'),
(214, 'TJ', 'Tayikistán'),
(215, 'IO', 'Territorio Británico del Océano Índico'),
(216, 'TF', 'Territorios Australes Franceses'),
(217, 'TL', 'Timor Oriental'),
(218, 'TG', 'Togo'),
(219, 'TK', 'Tokelau'),
(220, 'TO', 'Tonga'),
(221, 'TT', 'Trinidad y Tobago'),
(222, 'TN', 'Túnez'),
(223, 'TC', 'Islas Turcas y Caicos'),
(224, 'TM', 'Turkmenistán'),
(225, 'TR', 'Turquía'),
(226, 'TV', 'Tuvalu'),
(227, 'UA', 'Ucrania'),
(228, 'UG', 'Uganda'),
(229, 'UY', 'Uruguay'),
(230, 'UZ', 'Uzbekistán'),
(231, 'VU', 'Vanuatu'),
(232, 'VE', 'Venezuela'),
(233, 'VN', 'Vietnam'),
(234, 'VG', 'Islas Vírgenes Británicas'),
(235, 'VI', 'Islas Vírgenes de los Estados Unidos'),
(236, 'WF', 'Wallis y Futuna'),
(237, 'YE', 'Yemen'),
(238, 'DJ', 'Yibuti'),
(239, 'ZM', 'Zambia'),
(240, 'ZW', 'Zimbabue');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `credentials`
--

DROP TABLE IF EXISTS `credentials`;
CREATE TABLE IF NOT EXISTS `credentials` (
  `credential_id` int(11) NOT NULL AUTO_INCREMENT,
  `credential` varchar(75) NOT NULL,
  PRIMARY KEY (`credential_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `credentials`
--

INSERT INTO `credentials` (`credential_id`, `credential`) VALUES
(1, 'Administrador'),
(2, 'Jefe'),
(3, 'Lider de equipo'),
(4, 'Empleado'),
(5, 'Cliente'),
(6, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(250) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departments`
--

INSERT INTO `departments` (`department_id`, `department`, `organization_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2, 'Sistemas', 1, 1, '2022-04-18 09:56:38', NULL, NULL, NULL),
(3, 'Sistemas', 2, 1, '2022-04-18 09:58:15', NULL, NULL, NULL),
(6, 'Sistemas 2', 1, 1, '2022-04-18 11:21:42', NULL, NULL, '2022-04-18 11:25:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(75) NOT NULL,
  `second_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `second_last_name` varchar(75) NOT NULL,
  `business_name` varchar(75) NOT NULL,
  `gender_id` int(11) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(75) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `civil_status_id` int(11) NOT NULL,
  `economic_dependents` varchar(11) NOT NULL,
  `street` varchar(75) NOT NULL,
  `number` varchar(10) NOT NULL,
  `suburb` varchar(75) NOT NULL,
  `postal_code` varchar(5) NOT NULL,
  `estate` varchar(75) NOT NULL,
  `delegation` varchar(75) NOT NULL,
  `country_id` int(11) NOT NULL,
  `nationality_id` int(11) NOT NULL,
  `type_user_id` int(11) NOT NULL,
  `salary_amount` decimal(10,2) NOT NULL DEFAULT '0.00',
  `social_security` decimal(10,2) NOT NULL DEFAULT '0.00',
  `benefit_1` varchar(75) NOT NULL,
  `benefit_amount_1` decimal(10,2) NOT NULL DEFAULT '0.00',
  `benefit_2` varchar(75) NOT NULL,
  `benefit_amount_2` decimal(10,2) NOT NULL DEFAULT '0.00',
  `benefit_3` varchar(75) NOT NULL,
  `benefit_amount_3` decimal(10,2) NOT NULL DEFAULT '0.00',
  `benefit_4` varchar(75) NOT NULL,
  `benefit_amount_4` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total` decimal(10,2) NOT NULL,
  `disc` int(11) NOT NULL,
  `date_admission` date NOT NULL,
  `schooling_id` int(11) NOT NULL,
  `organization_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `mission` text,
  `vision` text,
  `competitive_advantages` text,
  `comparative_advantages` text,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`employee_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `employees`
--

INSERT INTO `employees` (`employee_id`, `user_id`, `first_name`, `second_name`, `last_name`, `second_last_name`, `business_name`, `gender_id`, `birthday`, `email`, `phone`, `mobile`, `civil_status_id`, `economic_dependents`, `street`, `number`, `suburb`, `postal_code`, `estate`, `delegation`, `country_id`, `nationality_id`, `type_user_id`, `salary_amount`, `social_security`, `benefit_1`, `benefit_amount_1`, `benefit_2`, `benefit_amount_2`, `benefit_3`, `benefit_amount_3`, `benefit_4`, `benefit_amount_4`, `total`, `disc`, `date_admission`, `schooling_id`, `organization_id`, `department_id`, `position_id`, `mission`, `vision`, `competitive_advantages`, `comparative_advantages`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Gerardo', 'Francisco', 'Rodriguez', 'Ordaz', '', 1, '1992-12-03', 'gerardofrancisco.rodriguez@hotmail.com', '9994940560111', '9994940561111', 2, '21', '761', '8841', 'Mérida1', '97290', 'YUCATÁN1', 'MËRIDA1', 146, 122, 1, '1.00', '2.00', 'p11', '3.00', 'p21', '5.01', 'p31', '5.00', 'p41', '6.00', '22.02', 11, '2022-04-19', 4, 1, 2, 2, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.						', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 1, '2022-04-19 16:52:38', 1, '2022-04-25 12:47:54', NULL),
(2, 2, 'Josue', 'Joel', 'Betancurt', 'Lopez', '', 1, '1992-12-03', 'josue.b@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MËRIDA', 146, 122, 1, '1.00', '2.00', 'p1', '3.00', 'p2', '4.00', 'p3', '5.00', 'p4', '6.00', '21.00', 1, '2022-04-19', 4, 1, 2, 2, NULL, NULL, NULL, NULL, 1, '2022-04-19 16:52:38', 1, '2022-04-20 17:16:10', NULL),
(3, 3, 'Cesar', '', 'Herrera', '', '', 1, '1992-12-03', 'cesar@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MËRIDA', 146, 122, 1, '1.00', '2.00', 'p1', '3.00', 'p2', '5.00', 'p3', '5.00', 'p4', '6.00', '21.00', 1, '2022-04-19', 4, 1, 2, 2, NULL, NULL, NULL, NULL, 1, '2022-04-19 16:52:38', 1, '2022-04-28 16:59:07', NULL),
(4, 4, 'Gissel', 'Dayana', 'Caamal', 'Moo', '', 2, '1992-09-14', 'gis-dayana@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MÉRIDA', 146, 122, 1, '1.00', '2.00', 'p1', '3.00', 'p2', '4.00', 'p3', '5.00', 'p4', '6.00', '21.00', 1, '2022-04-19', 4, 1, 6, 3, NULL, NULL, NULL, NULL, 1, '2022-04-20 17:18:32', 1, '2022-04-20 17:35:19', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employees_competencies`
--

DROP TABLE IF EXISTS `employees_competencies`;
CREATE TABLE IF NOT EXISTS `employees_competencies` (
  `employee_competency_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `competency_id` int(11) NOT NULL,
  `qualification` int(3) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`employee_competency_id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `employees_competencies`
--

INSERT INTO `employees_competencies` (`employee_competency_id`, `user_id`, `competency_id`, `qualification`, `created_by`, `created_at`, `modified_by`, `updated_at`) VALUES
(200, 1, 50, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(199, 1, 49, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(198, 1, 48, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(197, 1, 47, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(196, 1, 46, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(195, 1, 45, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(194, 1, 44, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(193, 1, 43, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(192, 1, 42, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(191, 1, 41, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(190, 1, 40, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(189, 1, 39, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(188, 1, 38, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(187, 1, 37, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(186, 1, 36, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(185, 1, 35, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(184, 1, 34, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(183, 1, 33, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(182, 1, 32, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(181, 1, 31, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(180, 1, 30, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(179, 1, 29, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(178, 1, 28, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(177, 1, 27, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(176, 1, 26, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(175, 1, 25, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(174, 1, 24, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(173, 1, 23, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(172, 1, 22, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(171, 1, 21, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(170, 1, 20, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(169, 1, 19, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(168, 1, 18, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(167, 1, 17, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(166, 1, 16, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(165, 1, 15, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(164, 1, 14, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(163, 1, 13, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(162, 1, 12, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(161, 1, 11, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(160, 1, 10, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(159, 1, 9, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(158, 1, 8, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(157, 1, 7, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(156, 1, 6, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(155, 1, 5, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(154, 1, 4, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(153, 1, 3, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(152, 1, 2, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(151, 1, 1, 100, 1, '2022-04-22 16:06:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `genders`
--

DROP TABLE IF EXISTS `genders`;
CREATE TABLE IF NOT EXISTS `genders` (
  `gender_id` int(11) NOT NULL AUTO_INCREMENT,
  `gender` varchar(75) NOT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `genders`
--

INSERT INTO `genders` (`gender_id`, `gender`) VALUES
(1, 'Masculino'),
(2, 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `innovations`
--

DROP TABLE IF EXISTS `innovations`;
CREATE TABLE IF NOT EXISTS `innovations` (
  `innovation_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `innovation` varchar(250) NOT NULL,
  `annual_value` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`innovation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `innovations`
--

INSERT INTO `innovations` (`innovation_id`, `user_id`, `innovation`, `annual_value`, `description`, `created_by`, `created_at`) VALUES
(1, 1, 'What is Lorem Ipsum?', '150000.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2022-04-25 10:44:33'),
(3, 1, 'pruebas', '150000.00', 'pruebas', 1, '2022-04-25 11:49:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nationalities`
--

DROP TABLE IF EXISTS `nationalities`;
CREATE TABLE IF NOT EXISTS `nationalities` (
  `nationality_id` int(11) NOT NULL AUTO_INCREMENT,
  `nationality` text NOT NULL,
  PRIMARY KEY (`nationality_id`)
) ENGINE=InnoDB AUTO_INCREMENT=202 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nationalities`
--

INSERT INTO `nationalities` (`nationality_id`, `nationality`) VALUES
(1, 'AFGANA'),
(2, 'ALBANESA'),
(3, 'ALEMANA'),
(4, 'ANDORRANA'),
(5, 'ANGOLEÑA'),
(6, 'ANTIGUANA'),
(7, 'SAUDÍ'),
(8, 'ARGELINA'),
(9, 'ARGENTINA'),
(10, 'ARMENIA'),
(11, 'ARUBEÑA'),
(12, 'AUSTRALIANA'),
(13, 'AUSTRIACA'),
(14, 'AZERBAIYANA'),
(15, 'BAHAMEÑA'),
(16, 'BANGLADESÍ'),
(17, 'BARBADENSE'),
(18, 'BAREINÍ'),
(19, 'BELGA'),
(20, 'BELICEÑA'),
(21, 'BENINÉSA'),
(22, 'BIELORRUSA'),
(23, 'BIRMANA'),
(24, 'BOLIVIANA'),
(25, 'BOSNIA'),
(26, 'BOTSUANA'),
(27, 'BRASILEÑA'),
(28, 'BRUNEANA'),
(29, 'BÚLGARA'),
(30, 'BURKINÉS'),
(31, 'BURUNDÉSA'),
(32, 'BUTANÉSA'),
(33, 'CABOVERDIANA'),
(34, 'CAMBOYANA'),
(35, 'CAMERUNESA'),
(36, 'CANADIENSE'),
(37, 'CATARÍ'),
(38, 'CHADIANA'),
(39, 'CHILENA'),
(40, 'CHINA'),
(41, 'CHIPRIOTA'),
(42, 'VATICANA'),
(43, 'COLOMBIANA'),
(44, 'COMORENSE'),
(45, 'NORCOREANA'),
(46, 'SURCOREANA'),
(47, 'MARFILEÑA'),
(48, 'COSTARRICENSE'),
(49, 'CROATA'),
(50, 'CUBANA'),
(51, 'DANÉSA'),
(52, 'DOMINIQUÉS'),
(53, 'ECUATORIANA'),
(54, 'EGIPCIA'),
(55, 'SALVADOREÑA'),
(56, 'EMIRATÍ'),
(57, 'ERITREA'),
(58, 'ESLOVACA'),
(59, 'ESLOVENA'),
(60, 'ESPAÑOLA'),
(61, 'ESTADOUNIDENSE'),
(62, 'ESTONIA'),
(63, 'ETÍOPE'),
(64, 'FILIPINA'),
(65, 'FINLANDÉSA'),
(66, 'FIYIANA'),
(67, 'FRANCÉSA'),
(68, 'GABONÉSA'),
(69, 'GAMBIANA'),
(70, 'GEORGIANA'),
(71, 'GIBRALTAREÑA'),
(72, 'GHANÉSA'),
(73, 'GRANADINA'),
(74, 'GRIEGA'),
(75, 'GROENLANDÉSA'),
(76, 'GUATEMALTECA'),
(77, 'ECUATOGUINEANA'),
(78, 'GUINEANA'),
(79, 'GUINEANA'),
(80, 'GUYANESA'),
(81, 'HAITIANA'),
(82, 'HONDUREÑA'),
(83, 'HÚNGARA'),
(84, 'HINDÚ'),
(85, 'INDONESIA'),
(86, 'IRAQUÍ'),
(87, 'IRANÍ'),
(88, 'IRLANDÉSA'),
(89, 'ISLANDÉSA'),
(90, 'COOKIANA'),
(91, 'MARSHALÉSA'),
(92, 'SALOMONENSE'),
(93, 'ISRAELÍ'),
(94, 'ITALIANA'),
(95, 'JAMAIQUINA'),
(96, 'JAPONÉSA'),
(97, 'JORDANA'),
(98, 'KAZAJA'),
(99, 'KENIATA'),
(100, 'KIRGUISA'),
(101, 'KIRIBATIANA'),
(102, 'KUWAITÍ'),
(103, 'LAOSIANA'),
(104, 'LESOTENSE'),
(105, 'LETÓNA'),
(106, 'LIBANÉSA'),
(107, 'LIBERIANA'),
(108, 'LIBIA'),
(109, 'LIECHTENSTEINIANA'),
(110, 'LITUANA'),
(111, 'LUXEMBURGUÉSA'),
(112, 'MALGACHE'),
(113, 'MALASIA'),
(114, 'MALAUÍ'),
(115, 'MALDIVA'),
(116, 'MALIENSE'),
(117, 'MALTÉSA'),
(118, 'MARROQUÍ'),
(119, 'MARTINIQUÉS'),
(120, 'MAURICIANA'),
(121, 'MAURITANA'),
(122, 'MEXICANA'),
(123, 'MICRONESIA'),
(124, 'MOLDAVA'),
(125, 'MONEGASCA'),
(126, 'MONGOLA'),
(127, 'MONTENEGRINA'),
(128, 'MOZAMBIQUEÑA'),
(129, 'NAMIBIA'),
(130, 'NAURUANA'),
(131, 'NEPALÍ'),
(132, 'NICARAGÜENSE'),
(133, 'NIGERINA'),
(134, 'NIGERIANA'),
(135, 'NORUEGA'),
(136, 'NEOZELANDÉSA'),
(137, 'OMANÍ'),
(138, 'NEERLANDÉSA'),
(139, 'PAKISTANÍ'),
(140, 'PALAUANA'),
(141, 'PALESTINA'),
(142, 'PANAMEÑA'),
(143, 'PAPÚ'),
(144, 'PARAGUAYA'),
(145, 'PERUANA'),
(146, 'POLACA'),
(147, 'PORTUGUÉSA'),
(148, 'PUERTORRIQUEÑA'),
(149, 'BRITÁNICA'),
(150, 'CENTROAFRICANA'),
(151, 'CHECA'),
(152, 'MACEDONIA'),
(153, 'CONGOLEÑA'),
(154, 'CONGOLEÑA'),
(155, 'DOMINICANA'),
(156, 'SUDAFRICANA'),
(157, 'RUANDÉSA'),
(158, 'RUMANA'),
(159, 'RUSA'),
(160, 'SAMOANA'),
(161, 'CRISTOBALEÑA'),
(162, 'SANMARINENSE'),
(163, 'SANVICENTINA'),
(164, 'SANTALUCENSE'),
(165, 'SANTOTOMENSE'),
(166, 'SENEGALÉSA'),
(167, 'SERBIA'),
(168, 'SEYCHELLENSE'),
(169, 'SIERRALEONÉSA'),
(170, 'SINGAPURENSE'),
(171, 'SIRIA'),
(172, 'SOMALÍ'),
(173, 'CEILANÉSA'),
(174, 'SUAZI'),
(175, 'SURSUDANÉSA'),
(176, 'SUDANÉSA'),
(177, 'SUECA'),
(178, 'SUIZA'),
(179, 'SURINAMESA'),
(180, 'TAILANDÉSA'),
(181, 'TANZANA'),
(182, 'TAYIKA'),
(183, 'TIMORENSE'),
(184, 'TOGOLÉSA'),
(185, 'TONGANA'),
(186, 'TRINITENSE'),
(187, 'TUNECINA'),
(188, 'TURCOMANA'),
(189, 'TURCA'),
(190, 'TUVALUANA'),
(191, 'UCRANIANA'),
(192, 'UGANDÉSA'),
(193, 'URUGUAYA'),
(194, 'UZBEKA'),
(195, 'VANUATUENSE'),
(196, 'VENEZOLANA'),
(197, 'VIETNAMITA'),
(198, 'YEMENÍ'),
(199, 'YIBUTIANA'),
(200, 'ZAMBIANA'),
(201, 'ZIMBABUENSE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `organizations`
--

DROP TABLE IF EXISTS `organizations`;
CREATE TABLE IF NOT EXISTS `organizations` (
  `organization_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization` varchar(250) NOT NULL,
  `maturity_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`organization_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `organizations`
--

INSERT INTO `organizations` (`organization_id`, `organization`, `maturity_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 'Business & Education Consulting Group', 1, 1, '2022-04-15 17:38:14', NULL, NULL, NULL),
(2, 'Merida Soft ', 2, 1, '2022-04-18 09:58:01', NULL, NULL, NULL),
(3, 'merida soft 2', 1, 1, '2022-04-18 11:27:21', NULL, NULL, NULL),
(4, 'Business & Education Consulting Group 2', 1, 1, '2022-04-19 11:36:30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `positions`
--

DROP TABLE IF EXISTS `positions`;
CREATE TABLE IF NOT EXISTS `positions` (
  `position_id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(250) NOT NULL,
  `organization_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`position_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `positions`
--

INSERT INTO `positions` (`position_id`, `position`, `organization_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2, 'Programador Sr', 1, 1, '2022-04-18 09:56:38', NULL, NULL, NULL),
(3, 'Programador Sr', 2, 1, '2022-04-18 09:58:15', NULL, NULL, NULL),
(6, 'Sistemas 2', 1, 1, '2022-04-18 11:21:42', NULL, NULL, '2022-04-18 11:25:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resolutions`
--

DROP TABLE IF EXISTS `resolutions`;
CREATE TABLE IF NOT EXISTS `resolutions` (
  `resolution_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `resolution` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`resolution_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resolutions`
--

INSERT INTO `resolutions` (`resolution_id`, `user_id`, `resolution`, `description`, `created_by`, `created_at`) VALUES
(3, 1, 'pruebas', 'pruebas', 1, '2022-04-25 11:48:52'),
(4, 1, 'pruebas 2', 'pruebas 2', 1, '2022-04-25 12:45:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `schooling`
--

DROP TABLE IF EXISTS `schooling`;
CREATE TABLE IF NOT EXISTS `schooling` (
  `schooling_id` int(11) NOT NULL AUTO_INCREMENT,
  `schooling` varchar(75) NOT NULL,
  PRIMARY KEY (`schooling_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `schooling`
--

INSERT INTO `schooling` (`schooling_id`, `schooling`) VALUES
(1, 'Primaria'),
(2, 'Secundaria'),
(3, 'Bachillerato'),
(4, 'Licenciatura'),
(5, 'Maestría'),
(6, 'Doctorado'),
(7, 'N/A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `service_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `description` text,
  `frequency` varchar(75) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `created_admin` int(11) DEFAULT '0',
  `monthly_amount` decimal(10,2) NOT NULL,
  `productivity` text,
  `quality` text,
  `innovation` text,
  `service` text,
  `weighing` float NOT NULL DEFAULT '0',
  `employee_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `roi` decimal(10,2) DEFAULT '0.00',
  `status` int(1) UNSIGNED DEFAULT '1',
  `classification` int(1) DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`service_id`, `organization_id`, `description`, `frequency`, `employee_id`, `position_id`, `created_admin`, `monthly_amount`, `productivity`, `quality`, `innovation`, `service`, `weighing`, `employee_cost`, `roi`, `status`, `classification`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'pruebas de servicio', 'mensualmente', 3, 3, 0, '1.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, '0.00', '0.00', 1, 0, 3, '2022-05-03 11:25:52', NULL, NULL, NULL),
(2, 1, 'pruebas', 'semanal', NULL, 6, 0, '1.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 12:34:13', NULL, NULL, '2022-05-03 14:10:25'),
(3, 1, 'pruebas', 'diario', 3, 3, 0, '4.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, '0.00', '0.00', 1, 0, 3, '2022-05-03 12:44:38', NULL, NULL, NULL),
(4, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'anual', NULL, 2, 0, '1.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 12:45:44', NULL, NULL, NULL),
(5, 1, 'qweqwe', 'eqweqwe', NULL, 2, 1, '123123.00', 'qweqwewqe', 'eqweqwe', 'eqweqweqwe', 'eqweqweqwe', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 15:38:42', NULL, NULL, NULL),
(6, 1, 'qweqwe', 'eqweqwe', NULL, 2, 1, '123123.00', 'qweqwewqe', 'eqweqwe', 'eqweqweqwe', 'eqweqweqwe', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 15:39:28', NULL, NULL, NULL),
(7, 1, 'qweqwe', 'eqweqwe', NULL, 2, 1, '123123.00', 'qweqwewqe', 'eqweqwe', 'eqweqweqwe', 'eqweqweqwe', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 15:42:46', NULL, NULL, NULL),
(8, 1, 'qweqwe', 'eqweqwe', NULL, 2, 1, '123123.00', 'qweqwewqe', 'eqweqwe', 'eqweqweqwe', 'eqweqweqwe', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 15:43:22', NULL, NULL, NULL),
(9, 1, 'qweqwe', 'eqweqwe', NULL, 2, 1, '123123.00', 'qweqwewqe', 'eqweqwe', 'eqweqweqwe', 'eqweqweqwe', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 16:10:28', NULL, NULL, NULL),
(10, 1, 'qweqwe', 'eqweqwe', NULL, 2, 1, '123123.00', 'qweqwewqe', 'eqweqwe', 'eqweqweqwe', 'eqweqweqwe', 0, '22.02', '0.00', 1, 0, 1, '2022-05-03 16:18:11', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_competitors`
--

DROP TABLE IF EXISTS `services_competitors`;
CREATE TABLE IF NOT EXISTS `services_competitors` (
  `service_competitor_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `company` varchar(250) NOT NULL,
  `guarantee` text NOT NULL,
  `offered_price` decimal(10,2) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`service_competitor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services_competitors`
--

INSERT INTO `services_competitors` (`service_competitor_id`, `service_id`, `company`, `guarantee`, `offered_price`, `created_by`, `created_at`) VALUES
(1, 10, 'eqweqwe', 'eqweqweqwe', '1.00', NULL, '0000-00-00 00:00:00'),
(2, 10, 'eqweqweqweqwe', 'eqweqweqweweeqweqwe', '2.00', NULL, '0000-00-00 00:00:00'),
(3, 10, 'dasdasd', 'dasdasdasd', '12121221.00', 1, '2022-05-03 16:34:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_customers`
--

DROP TABLE IF EXISTS `services_customers`;
CREATE TABLE IF NOT EXISTS `services_customers` (
  `service_customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `position_customer_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`service_customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services_customers`
--

INSERT INTO `services_customers` (`service_customer_id`, `service_id`, `customer_id`, `position_customer_id`, `created_by`, `created_at`) VALUES
(1, 10, 1, 2, 1, '0000-00-00 00:00:00'),
(2, 10, 1, 2, 1, '0000-00-00 00:00:00'),
(3, 10, 1, 2, 1, '2022-05-03 16:34:06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_users`
--

DROP TABLE IF EXISTS `type_users`;
CREATE TABLE IF NOT EXISTS `type_users` (
  `type_user_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_user` varchar(75) NOT NULL,
  PRIMARY KEY (`type_user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `type_users`
--

INSERT INTO `type_users` (`type_user_id`, `type_user`) VALUES
(1, 'Empleado'),
(2, 'Cliente'),
(3, 'Proveedor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(25) NOT NULL,
  `password` text NOT NULL,
  `credential_id` int(11) NOT NULL,
  `profile_picture` text NOT NULL,
  `profile_video` text NOT NULL,
  `recover` int(1) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`user_id`, `user`, `password`, `credential_id`, `profile_picture`, `profile_video`, `recover`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 'root', 'd6383d35a8c11149e13c1729dcfa072b', 1, '1651070092_b70c45ffe4cf5ddcd1e2.jpeg', '1651011538_4e60255e24323a055e68.mp4', NULL, 1, '2022-04-14 12:06:11', 1, '2022-04-27 17:16:17', NULL),
(2, 'root2', '1a704972fe1c82ff2e8b97e65d089eb6', 2, '', '', NULL, 1, '2022-04-14 12:06:11', 1, '2022-04-20 17:16:31', NULL),
(3, 'root3', 'd6383d35a8c11149e13c1729dcfa072b', 3, '', '', NULL, 1, '2022-04-14 12:06:11', 1, '2022-04-21 10:58:54', NULL),
(4, 'root4', 'd6383d35a8c11149e13c1729dcfa072b', 4, '', '', NULL, 1, '2022-04-20 17:18:32', NULL, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
