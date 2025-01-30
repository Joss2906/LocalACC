-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-06-2022 a las 22:47:34
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
-- Estructura de tabla para la tabla `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(75) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categories`
--

INSERT INTO `categories` (`category_id`, `category`) VALUES
(1, 'Productividad'),
(2, 'Calidad'),
(3, 'Servicio'),
(4, 'Otro');

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chiefs`
--

INSERT INTO `chiefs` (`chief_id`, `organization_id`, `chief_user_id`, `employee_user_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2, 1, 3, 4, 1, '2022-04-28 16:15:38', NULL, NULL, NULL),
(4, 1, 2, 3, 1, '2022-05-11 11:46:00', NULL, NULL, NULL),
(5, 1, 2, 4, 1, '2022-05-11 16:58:45', NULL, NULL, NULL),
(6, 1, 3, 3, 1, '2022-05-25 10:32:40', NULL, NULL, NULL);

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
-- Estructura de tabla para la tabla `complaints`
--

DROP TABLE IF EXISTS `complaints`;
CREATE TABLE IF NOT EXISTS `complaints` (
  `complaint_id` int(11) NOT NULL AUTO_INCREMENT,
  `complaint_type_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `complaint` text NOT NULL,
  `complaint_status_id` int(11) NOT NULL DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`complaint_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `complaint_type_id`, `user_id`, `category_id`, `complaint`, `complaint_status_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 3, 'pruebas de quejas de servicio 2', 5, 3, '2022-05-13 10:01:52', 2, '2022-05-13 12:39:10', NULL),
(2, 2, 2, 2, 'prueba de quejas de servicios', 1, 3, '2022-05-13 09:55:42', NULL, NULL, '2022-05-13 10:01:30'),
(3, 1, 2, 1, 'prueba de quejas para gerardo', 1, 2, '2022-05-13 12:39:37', NULL, NULL, '2022-05-13 12:43:57'),
(4, 1, 2, 1, 'pruebas gerardo', 1, 2, '2022-05-13 12:44:11', NULL, NULL, NULL),
(5, 1, 2, 1, 'queja para cesar herrera', 1, 2, '2022-05-13 12:46:27', NULL, NULL, NULL),
(6, 1, 2, 1, 'pruebas', 1, 3, '2022-05-13 13:30:16', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complaints_status`
--

DROP TABLE IF EXISTS `complaints_status`;
CREATE TABLE IF NOT EXISTS `complaints_status` (
  `complaint_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(75) NOT NULL,
  PRIMARY KEY (`complaint_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `complaints_status`
--

INSERT INTO `complaints_status` (`complaint_status_id`, `status`) VALUES
(1, 'Nuevo'),
(2, 'En progreso'),
(3, 'Resuelto'),
(4, 'Finalizado'),
(5, 'Cerrado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `complaints_types`
--

DROP TABLE IF EXISTS `complaints_types`;
CREATE TABLE IF NOT EXISTS `complaints_types` (
  `complaint_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(75) NOT NULL,
  PRIMARY KEY (`complaint_type_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `complaints_types`
--

INSERT INTO `complaints_types` (`complaint_type_id`, `type`) VALUES
(1, 'General'),
(2, 'Servicio');

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
  `average` float(10,2) DEFAULT '0.00',
  `roi` decimal(10,2) NOT NULL DEFAULT '0.00',
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

INSERT INTO `employees` (`employee_id`, `user_id`, `first_name`, `second_name`, `last_name`, `second_last_name`, `business_name`, `gender_id`, `birthday`, `email`, `phone`, `mobile`, `civil_status_id`, `economic_dependents`, `street`, `number`, `suburb`, `postal_code`, `estate`, `delegation`, `country_id`, `nationality_id`, `type_user_id`, `salary_amount`, `social_security`, `benefit_1`, `benefit_amount_1`, `benefit_2`, `benefit_amount_2`, `benefit_3`, `benefit_amount_3`, `benefit_4`, `benefit_amount_4`, `total`, `disc`, `date_admission`, `schooling_id`, `organization_id`, `department_id`, `position_id`, `mission`, `vision`, `competitive_advantages`, `comparative_advantages`, `average`, `roi`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Gerardo', 'Francisco', 'Rodriguez', 'Ordaz', '', 1, '1992-10-03', 'gerardofrancisco.rodriguez@hotmail.com', '9994940560111', '9994940561111', 2, '21', '761', '8841', 'Mérida1', '97290', 'YUCATÁN1', 'MËRIDA1', 146, 122, 1, '1.00', '2.00', 'p11', '3.00', 'p21', '5.00', 'p31', '5.00', 'p41', '6.00', '22.02', 11, '2022-04-18', 4, 1, 2, 3, 'aqui terminaaaaaaaaaaaaaaaaaaaaaaaaa', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.						', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 0.00, '0.00', 1, '2022-04-19 16:52:38', 1, '2022-05-18 11:35:12', NULL),
(2, 2, 'Josue', 'Joel', 'Betancurt', 'Lopez', '', 1, '1992-12-03', 'josue.b@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MËRIDA', 146, 122, 1, '1.00', '2.00', 'p1', '3.00', 'p2', '4.00', 'p3', '5.00', 'p4', '6.00', '21.00', 1, '2022-04-19', 4, 1, 2, 2, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum. Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 0.00, '0.00', 1, '2022-04-19 16:52:38', 2, '2022-05-16 14:39:44', NULL),
(3, 3, 'Cesar', '', 'Herrera', '', '', 1, '1992-12-03', 'cesar@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MËRIDA', 146, 122, 1, '14000.00', '1000.00', 'p1', '1000.00', 'p2', '500.00', 'p3', '500.00', 'p4', '0.00', '18000.00', 1, '2022-04-19', 4, 1, 2, 3, NULL, NULL, NULL, NULL, 83.75, '0.50', 1, '2022-04-19 16:52:38', 2, '2022-05-20 13:54:47', NULL),
(4, 4, 'Gissel', 'Dayana', 'Caamal', 'Moo', '', 2, '1992-09-14', 'gis-dayana@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MÉRIDA', 146, 122, 1, '1.00', '2.00', 'p1', '3.00', 'p2', '4.00', 'p3', '5.00', 'p4', '6.00', '21.00', 1, '2022-04-19', 4, 1, 6, 3, NULL, NULL, NULL, NULL, 0.00, '0.00', 1, '2022-04-20 17:18:32', 1, '2022-04-20 17:35:19', NULL);

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
(200, 2, 50, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(199, 2, 49, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(198, 2, 48, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(197, 2, 47, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(196, 2, 46, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(195, 2, 45, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(194, 2, 44, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(193, 2, 43, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(192, 2, 42, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(191, 2, 41, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(190, 2, 40, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(189, 2, 39, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(188, 2, 38, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(187, 2, 37, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(186, 2, 36, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(185, 2, 35, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(184, 2, 34, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(183, 2, 33, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(182, 2, 32, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(181, 2, 31, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(180, 2, 30, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(179, 2, 29, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(178, 2, 28, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(177, 2, 27, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(176, 2, 26, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(175, 2, 25, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(174, 2, 24, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(173, 2, 23, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(172, 2, 22, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(171, 2, 21, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(170, 2, 20, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(169, 2, 19, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(168, 2, 18, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(167, 2, 17, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(166, 2, 16, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(165, 2, 15, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(164, 2, 14, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(163, 2, 13, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(162, 2, 12, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(161, 2, 11, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(160, 2, 10, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(159, 2, 9, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(158, 2, 8, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(157, 2, 7, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(156, 2, 6, 80, 1, '2022-04-22 16:06:13', NULL, NULL),
(155, 2, 5, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(154, 2, 4, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(153, 2, 3, 100, 1, '2022-04-22 16:06:13', NULL, NULL),
(152, 2, 2, 90, 1, '2022-04-22 16:06:13', NULL, NULL),
(151, 2, 1, 100, 1, '2022-04-22 16:06:13', NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `innovations`
--

INSERT INTO `innovations` (`innovation_id`, `user_id`, `innovation`, `annual_value`, `description`, `created_by`, `created_at`) VALUES
(1, 2, 'What is Lorem Ipsum?', '150000.00', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.', 2, '2022-04-25 10:44:33'),
(3, 2, 'pruebas', '150000.00', 'pruebas', 2, '2022-04-25 11:49:05'),
(4, 2, 'What is Lorem Ipsum?', '150000.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 2, '2022-04-25 10:44:33'),
(5, 2, 'pruebas', '150000.00', 'pruebas', 2, '2022-04-25 11:49:05');

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
(1, 'Business & Education Consulting Group', 1, 1, '2022-05-05 09:53:27', NULL, NULL, NULL),
(2, 'Merida Soft ', 2, 1, '2022-04-18 09:58:01', NULL, NULL, NULL),
(3, 'merida soft 2', 1, 1, '2022-04-18 11:27:21', NULL, NULL, NULL),
(4, 'Business & Education Consulting Group 2', 1, 1, '2022-04-19 11:36:30', NULL, NULL, '2022-05-04 15:42:29');

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
(3, 'Programador Jr', 1, 1, '2022-04-18 09:58:15', NULL, NULL, NULL),
(6, 'Tester', 1, 1, '2022-04-18 11:21:42', NULL, NULL, '2022-04-18 11:25:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

DROP TABLE IF EXISTS `pregunta`;
CREATE TABLE IF NOT EXISTS `pregunta` (
  `pregunta_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pregunta` text CHARACTER SET latin1,
  `imagen` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`pregunta_id`),
  UNIQUE KEY `id_UNIQUE` (`pregunta_id`)
) ENGINE=InnoDB AUTO_INCREMENT=224 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`pregunta_id`, `pregunta`, `imagen`) VALUES
(14, '¿QUE DEBE HACER USTED AL TOPARSE CON ESTA SEÑAL DE TRANSITO', '/uploads/imagen_pregunta_14.png'),
(15, '¿QUE INDICACION LE DA UN SEMAFORO QUE TENGA ENCENDIDA LA LUZ ROJA?', ''),
(17, '¿QUE INDICACION LE DA UN SEMAFORO QUE TENGA ENCENDIDA LA LUZ ROJA?', '/uploads/imagen_pregunta_17.png'),
(18, '¿C0M0 SEÑALIZA USTED CON EL BRAZO LA VUELTA A LA DERECHA?', ''),
(19, '¿CUAL DE ESTAS POSICIONES DEL POLICIA INDICA ALTO?', ''),
(20, 'DE ESTAS IMAGENES DEL POLICIA ¿CUAL SIGNIFICA SIGA?', ''),
(21, '¿QUE DEBERA HACER USTED SI FUERA EL CONDUCTOR DEL VEHICULO AMARILLO?', '/uploads/imagen_pregunta_21.png'),
(22, '¿COMO SEÑALA USTED CON EL BRAZO IZQUIERDO, QUE SE VA A DETENER?', ''),
(23, 'EL CONDUCTOR QUE ESTA ADELANTE DE USTED VA A DAR VUELTA A LA IZQUIERDA, ¿QUE SEÑAL HARIA ESTE CONDUCTOR CON EL BRAZO?', ''),
(24, '¿LE ESTA PERMITIDO ADELANTAR AL VEHICULO AZUL QUE TIENE ADELANTE?', '/uploads/imagen_pregunta_24.png'),
(25, '¿CUAL ES LA DISTANCIA MINIMA PARA ESTACIONARSE EN UNA INTERSECCIÓN?', '/uploads/imagen_pregunta_25.png'),
(26, 'EN UNA INTERSECCION EN DONDE USTED VA A VIRAR A LA DERECHA, PERO HAY PEATONES CRUZANDO LA VIA, ¿QUE ES LO QUE DEBE HACER USTED?', '/uploads/imagen_pregunta_26.png'),
(27, '¿LE ESTA PERMITIDO AL VEHICULO ROJO ESTACIONARSE EN UNA ISLETA?', '/uploads/imagen_pregunta_27.png'),
(28, ' TODO VEHICULO DE COMBUSTION O MIXTO O ELECTRICO QUE TRANSITE EN EL ESTADO DE YUCATAAN, DEBERA CONTAR:', ''),
(29, 'TODO VEHIULO QUE CIRCULE EN LAS VIAS PÚBLICAS DEL ESTADO DE YUCATAN, TIENE LA OBLIGACIÓN DE PORTAR:', ''),
(30, 'LOS CONDUCTORES, SIN PERJUICIO DE LAS DEMAS PREVISTAS EN LA LEY Y EN ESTE REGLAMENTO, TENDRAN LAS SIGUIENTES PROHIBICIONES:', ''),
(31, 'EL CONDUCTOR Y LOS PASAJEROS DE VEHICULOS, SEGÚN CORRESPONDA, TENDRAN LAS SIGUIENTES OBLIGACIONES DE CARACTER GENERAL', ''),
(32, 'QUEDA PROHIBIDO CONDUCIR UN VEHICULO A CUALQUIER PERSONA QUE:', ''),
(33, '¿CUÁL ES LA DISTANCIA MAXIMA PARA TRANSITAR EN REVERSA?', ''),
(34, '¿QUE ACCIÓN DEBE TOMAR UN CONDUCTOR AL ACERCARSE UN VEHICULO DE EMERGENCIA QUE LLEVE ENCENDIDAS LAS SEÑALES LUMINOSAS Y AUDIBLES?', ''),
(35, 'EN ZONAS MARCADAS DE PASO DE PEATONES, CON O SIN SEMAFOROS, SEÑALES O AGENTES, ES OBLIGACIÓN DEL CONDUCTOR:', ''),
(36, 'EN CONDUCTOR QUE SE APROXIME A UN CRUCERO DE FERROCARRIL, DEBERÁ:', ''),
(37, '¿EN QUÉ LUGARES OBLIGATORIAMENTE EL CONDUCTOR DEBE DISMINUIR LA VELOCIDAD?', ''),
(38, 'SE PROHIBE ADELANTAR A VEHICULOS:', ''),
(39, 'CUANDO SE SIGA A OTRO VEHICULO A DISTANCIA CERCANA, SE EMPLEARA LA LUZ:', ''),
(40, 'ES LA ACCIÓN QUE EL CONDUCTOR DE UN VEHÍCULO QUE ES ADELANTADO DEBERA REALIZAR CON LAS LUCES.', ''),
(41, 'EL REGLAMENTO DE LA LEY DE TRANSITO EN EL ESTADO DE YUCATAN DICE QUE LA VELOICDAD MAXIMA PERMITIDA EN CALLES, ES DE:', ''),
(42, 'EL REGLAMENTO DE LA LEY DE TRANSITO EN EL ESTADO DE YUCATAN DICE QUE LA VELOICDAD MAXIMA PERMITIDA EN ZONAS ESCOLARES, HOSPITALES Y CENTRO DE REUNION DEBIDAMENTE INDICADOS ES DE:', ''),
(43, 'EL REGLAMENTO DE LA LEY DE TRANSITO EN EL ESTADO DE YUCATAN DICE QUE LA VELOCIDAD MAXIMA PERMITIDA EN CARRETERAS ESTATALES, ES DE:', ''),
(45, 'EL REGLAMENTO DE LA LEY DE TRANSITO EN EL ESTADO DE YUCATAN DICE QUE LA VELOICDAD MAXIMA PERMITIDA EN CARRILES CENTRAL E IZQUIERDO DEL ANILLO PERIFERICO, ES DE:', ''),
(46, 'EL REGLAMENTO DE LA LEY DE TRANSITO EN EL ESTADO DE YUCATAN DICE QUE LA VELOICDAD MAXIMA PERMITIDA EN CARRIL DERECHO DEL ANILLO PERIFERICO, ES DE:', ''),
(47, 'EL REGLAMENTO DE LA LEY DE TRANSITO EN EL ESTADO DE YUCATAN DICE QUE LA VELOICDAD MAXIMA PERMITIDA EN CENTROS DE REUNION DEBIDAMENTE INDICADOS, ES DE:', ''),
(48, 'SE PROHIBE ADELANTAR VEHICULOS:', ''),
(49, 'SE PROHIBE ADELANTAR VEHICULOS:', ''),
(50, 'SE PROHIBE ADELANTAR VEHICULOS:', ''),
(51, 'SE PROHIBE ADELANTAR VEHICULOS:', ''),
(52, 'SE PROHIBE ADELANTAR VEHICULOS:', ''),
(53, 'SE PROHIBE ADELANTAR VEHICULOS:', ''),
(54, 'SE PERMITIRA ADELANTAR POR LA DERECHA EN LOS CASOS SIGUIENTES:', ''),
(55, 'EL VEHICULO DEBERA QUEDAR ORIENTADO EN EL SENTIDO DE LA CIRCULACION, CON LAS RUEDAS PARALELAS A LA ORILLA DE LA VIA, EN ZONAS URBANAS A UNA DISTANCIA DE:', ''),
(56, 'SON LAS LUCES QUE DEBERAN EMPLEARSE CUANDO UN VEHICULO REALIZA PARADA MOMENTANEA.', ''),
(57, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(58, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(59, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(60, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(61, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(62, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(63, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(64, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(65, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(66, 'SE PROHIBE ESTACIONAR UN VEHICULO EN LA VIA PUBLICA, EN LOS SIGUIENTES LUGARES:', ''),
(67, 'SEÑALAMIENTO HORIZONTAL QUE DELIMITA LOS CARRILES DE CIRCULACION.', ''),
(68, 'SEÑALAMIENTO HORIZONTAL QUE DELIMITA LOS CARRILES DE CIRCULACION.', '/uploads/imagen_pregunta_68.png'),
(69, '¿QUE INDICAN LAS GUARNICIONES PINTADAS DE AMARILLO?', '/uploads/imagen_pregunta_69.png'),
(70, 'INDICAN AL CONDUCTOR QUE TIENEN QUE DISMINUIR LA VELOCIDAD', ''),
(71, 'SON DISPOSITIVOS ELECTRONICOS QUE SIRVEN PARA REGULAR EL TRANSITO', ''),
(72, 'LUZ DE SEMAFORO QUE ADVIERTE QUE ESTA PUNTO DE APARECER LA LUZ ROJA.', ''),
(73, 'LUZ DE SEMAFORO QUE INDICA SEGUIR DE FRENTE O CAMBIAR DE DIRECCION A LA DERECHA O IZQUIERDA.', ''),
(74, 'LUZ DE SEMAFORO QUE INDICA DETENERSE Y CERCIORARSE DE QUE NO HAY PELIGRO Y CONTINUAR LA MARCHA.', ''),
(75, 'LUZ DE SEMAFORO QUE INDICA QUE SE PUEDE CONTINUAR CON LA MARCHA CON LAS PRECAUCIONES NECESARIAS.', ''),
(76, 'ES UNA OBLIGACION DE LOS DEMAS VEHICULOS QUE TRANSITEN POR EL LUGAR DEL HECHO DE TRANSITO.', ''),
(77, '¿QUE LE INDICAN LAS RAYAS LONGITUDINALES DOBLES AL VEHICULO ROJO?', '/uploads/imagen_pregunta_77.png'),
(78, '¿QUE LE INDICAN LAS RAYAS LONGITUDINALES DOBLES AL VEHICULO AMARILLO?', '/uploads/imagen_pregunta_78.png'),
(79, '¿QUE LE INDICA LA RAYA LONGITUDINAL CENTRAL AL VEHICULO VERDE?', '/uploads/imagen_pregunta_79.png'),
(80, '¿QUE LE INDICA LA RAYA LONGITUDINAL CENTRAL AL VEHICULO VERDE?', '/uploads/imagen_pregunta_80.png'),
(81, '¿QUE INDICA ESTA SEÑAL?', '/uploads/imagen_pregunta_81.png'),
(82, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_82.png'),
(83, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_83.png'),
(84, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_84.png'),
(85, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_85.png'),
(86, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_86.png'),
(87, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_87.png'),
(88, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_88.png'),
(89, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_89.png'),
(90, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_90.png'),
(91, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_91.png'),
(92, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_92.png'),
(93, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_93.png'),
(94, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_94.png'),
(95, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_95.png'),
(96, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_96.png'),
(97, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_97.png'),
(98, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_98.png'),
(99, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_99.png'),
(100, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_100.png'),
(101, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_101.png'),
(102, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_102.png'),
(103, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_103.png'),
(104, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_104.png'),
(105, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_105.png'),
(106, '¿QUE INDICA ESTA SEÑAL PREVENTIVA?', '/uploads/imagen_pregunta_106.png'),
(107, '¿INDICA QUE TIPO DE SEÑAL ES ESTA?', '/uploads/imagen_pregunta_107.png'),
(108, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_108.png'),
(109, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_109.png'),
(110, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_110.png'),
(111, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_111.png'),
(112, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_112.png'),
(113, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_113.png'),
(114, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_114.png'),
(115, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_115.png'),
(116, '¿QUE INDICA ESTA SEÑAL RESTRICTIVA?', '/uploads/imagen_pregunta_116.png'),
(117, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_117.png'),
(118, '¿QUE SIGNIFICA ESTA SEÑAL INFORMATIVA DE SERVICIOS TURÍSTICOS?', '/uploads/imagen_pregunta_118.png'),
(119, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_119.png'),
(120, '¿ A qué familia pertenece este señalamiento?', '/uploads/imagen_pregunta_120.png'),
(121, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_121.png'),
(122, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_122.png'),
(123, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_123.png'),
(124, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_124.png'),
(125, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_125.png'),
(126, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_126.png'),
(127, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_127.png'),
(128, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_128.png'),
(129, '¿QUE INDICA ESTA SEÑAL DE OBRA?', '/uploads/imagen_pregunta_129.png'),
(130, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_130.jpg'),
(131, '¿QUE INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_131.png'),
(132, '¿QUE SIGNIFICAN LOS NUMEROS QUE TIENE LOS ESCUDOS AL LADO DE CADA FLECHA?', '/uploads/imagen_pregunta_132.png'),
(133, '¿QUE INDICA EL NUMERO QUE TIENE A LA DERECHA DEL NOMBRE DE LA POBLACIÓN CADA UNO DE LOS LETREROS?', '/uploads/imagen_pregunta_133.png'),
(134, '¿QUE TIPO DE SEÑAL INFORMATIVA ES ESTA?', '/uploads/imagen_pregunta_134.png'),
(135, '¿QUE TIPO DE SEÑAL INFORMATIVA ES ESTA?', '/uploads/imagen_pregunta_135.png'),
(136, '¿QUE TIPO DE SEÑAL INFORMATIVA ES ESTA?', '/uploads/imagen_pregunta_136.png'),
(137, '¿QUE NOS INDICA ESTA SEÑAL INFORMATIVA?', '/uploads/imagen_pregunta_137.png'),
(146, 'Indica el significado de la señal', '/uploads/imagen_pregunta_146.jpg'),
(147, 'Independientemente de las luces direccionales, antes de llegar a una interseccion para dar vuelta a la derecha o izquierda, se debe:', ''),
(148, 'El articulo 257 fraccion IV del reglamento de transito y vialidad del estado de Yucatan nos indica que esta prohibido adelantar vehi­culos en:', ''),
(149, '¿Hasta cuantos metros como maximo le esta permitido retroceder a un vehiculo?', '/uploads/imagen_pregunta_149.png'),
(150, '¿Que indica la raya sencilla discontinua que se encuentra pintada sobre el centro del pavimento?', '/uploads/imagen_pregunta_150.gif'),
(151, '¿De cuantos articulos consta la ley de transito y vialidad del estado de Yucatan?', ''),
(152, '¿Que articulo del reglamento de transito del estado de Yucatan obligan al conductor a portar el reglamento en sus vehi­culos?', ''),
(154, 'Son señales que tienen por objeto indicar la existencia de ciertas limitaciones o prohibiciones que regulan el transito', ''),
(155, '¿Esta permitido dar vuelta a la derecha con precaucion cuando la luz del semaforo esta en color rojo?', ''),
(156, 'Un conductor que se aproxime a un crucero de ferrocarril,debera:', '/uploads/imagen_pregunta_156.png'),
(157, 'A que grupo pertenece esta señal', '/uploads/imagen_pregunta_157.png'),
(158, 'Indica el significado de la señal', '/uploads/imagen_pregunta_158.png'),
(159, 'A que grupo pertenece esta señal', '/uploads/imagen_pregunta_159.jpg'),
(160, '¿Que indica la raya sencilla continua que se encuentra pintada sobre el centro del pavimento?', ''),
(161, 'Son las señales que sirven para guiar al usuario a lo largo de su camino informandole sobre numeros de carreteras y destinos,asi como sus distancias', ''),
(162, 'Se emplean para delinear la orilla de una vía de circulacion y sirven para utilizar al conductor durante la noche, o bien, bajo condiciones climatologicas desfavorables', ''),
(163, 'Para adelantar a un vehi­culo en una via con circulacion en ambos sentidos, se debe hacer por el lado:', ''),
(164, 'La ley de transito y vialidad del estado de Yucatan indica en su articulo 204,que es una obligacion para los conductores y pasajeros', ''),
(165, 'El destello ambar del semaforo indica:', ''),
(167, 'Indica el limite de parada de los vehiculos,delimitan tambien la zona de peatones', '/uploads/imagen_pregunta_166.jpg'),
(168, 'Despues de la vencida de licencia de conducir ¿cuantos di­as de prorroga tengo para seguir conduciendo con ella?', ''),
(169, 'Antes de cambiar de carril, de adelantar o  de dar vuelta(izq. o der.)se debe accionar:', '/uploads/imagen_pregunta_169.jpg'),
(170, '¿Que tipo de señal le advierte a usted, que debe disminuir la velocidad cuando transite por un tramo de carretera con demasiadas curvas, una tras de otra?', ''),
(171, '¿CUANTOS CENTIMETROS DEBO DE TENER DE DISTANCIA DE UNA ACERA PARA PODER ABORDAR O BAJAR A UN PASAJERO	?					 						', ''),
(172, 'OBLIGACION GENERAL PARA EL CONDUCTOR.						 		', ''),
(173, 'OBLIGACION GENERAL PARA EL CONDUCTOR.						 		', ''),
(174, 'PROHIBICION GENERAL PARA UN CONDUCTOR						 		', ''),
(175, 'EL ARTICULO 212 DICE LOS CONDUCTORES DE VEHICULOS DE COMBUSTION, HIBRIDOS, MIXTOS O ELECTRICOS  TENDRAN LA OBLIGACION DE LLEVAR EN EL VEHICULO.						', ''),
(176, 'SI VENGO CONDUCIENDO Y ME VOY APROXIMANDO A UN CRUCERO DE FERROCARRIL DEBO DE HACER MI ALTO A UNA DISTANCIA MINIMA DE?						', ''),
(177, 'SI VOY A DETENER LA MARCHA O REDUCIR LA VELOCIDAD DE NO CONTAR CON LAS LUCES DE FRENO ¿DE QUE OTRA MANERA TEMPORALMENTE PUEDO AVISAR DE LA MANIOBRA QUE ESTOY REALIZANDO?', ''),
(178, '¿QUE RAYAS MARCADAS EN EL PAVIMENTO ME PERMITEN ADELANTAR?', ''),
(179, '¿QUE INDICA ESTE SEÑALAMIENTO?', '/uploads/imagen_pregunta_179.png'),
(180, '¿QUE INDICA ESTE SEÑALAMIENTO?', '/uploads/imagen_pregunta_180.jpg'),
(181, '¿AL VENIR CONDUCIENDO Y ME APROXIMO A UN SEMAFORO CON DESTELLOS DE LUZ VERDE EL CONDUCTOR QUE DEBE DE HACER?', ''),
(182, '¿CUAL ES LA VELOCIDAD MAX. Y MIN EN EL CARRIL IZQ. DEL PERIFERICO?', ''),
(183, '¿EL VEHICULO QUE CIRCULA EN EL CARRIL IZQ. DE UNA GLORIETA QUE OPCIONES TIENE PARA CIRCULAR EN ELLA?', ''),
(184, 'CUANDO UN VEHICULO SE CONDUCE EN UNA VIA DE 4 CARRILES CON CIRCULACION EN AMBOS SENTIDOS NO DEBERA SER CONDUCIDO POR EL ?', ''),
(185, '¿CUANDO UN AGENTE ESTE DIRIGIENDO EL TRANSITO LA ESPALDA Y FRENTE DEL AGENTE ME INDICA?', ''),
(186, 'SON AREAS INDICADAS CON RAYAS GRUESAS EN COLOR AMARILLO O BLANCO, EN DONDE LOS CONDUCTORES DEBERAN EXTREMAR PRECAUCIONES', ''),
(187, '¿QUE INDICA ESTA SEÑAL?', '/uploads/imagen_pregunta_187.png'),
(188, '¿QUE INDICA ESTA SEÑAL?', '/uploads/imagen_pregunta_188.png'),
(189, '¿QUE INDICA ESTA SEÑAL?', '/uploads/imagen_pregunta_189.jpg'),
(190, '¿QUE INDICA ESTA SEÑAL?', '/uploads/imagen_pregunta_190.jpg'),
(191, '¿QUE DEBE HACER UN CONDUCTOR SI LLEGANDO A UNA INTERSECCION SE ENCUENTRA LA LUZ AMARILLA INTERMITENTE DE UN SEMAFORO?', ''),
(192, '¿TODO VEHICULO DEBE SER CONDUCIDO EN CALLES DE FRACCIONAMIENTO DE DOBLE SENTIDO POR EL?', ''),
(193, '¿CUAL ES LA VELOCIDAD MAX. Y MIN. DE LAS CALLES?', ''),
(194, '¿A QUE DISTANCIA DE UNA CURVA ES LO MAS CERCA QUE PUEDE QUEDAR UN VEHICULO ESTACIONADO?', ''),
(195, 'LOS CONDUCTORES TIENEN PROHIBIDO DURANTE LA CONDUCCION....', ''),
(196, 'TODOS LOS CONDUCTORES DE VEHICULOS MOTORIZADOS TIENEN LA OBLIGACION DE...', ''),
(197, '¿QUE INDICA ESTE SEÑALAMIENTO DE TRANSITO?', '/uploads/imagen_pregunta_197.jpg'),
(198, '¿QUE INDICA ESTE SEÑALAMIENTO DE TRANSITO?', '/uploads/imagen_pregunta_198.png'),
(199, '¿QUE SIGNIFICA ESTA SEÑAL?', '/uploads/imagen_pregunta_199.jpg'),
(200, '¿QUE INDICA ESTA SEÑALAMIENTO?', '/uploads/imagen_pregunta_200.png'),
(201, '¿EN QUE MOMENTO SE PERMITE ADELANTAR POR LA DERECHA?', ''),
(202, '¿SI AL ESTACIONAR MI VEHICULO ME ENCUENTRO CON UN HIDRATANTE A QUE DISTANCIA DEBO MANTENER MI VEHICULO ALEJADO DEL HIDRATANTE?', ''),
(203, '¿ES UNA PROHIBICION DE LOS CONDUCTORES?', ''),
(204, '¿A CUANTOS METROS DEBO DE PERMANECER EN MI CARRIL DERECHO ANTES DE DAR UNA VUELTA CONTINUA A LA DERECHA CON PRECAUCION?', ''),
(205, '¿SI PRETENDO DAR VUELTA A LA IZQ. EN VIAS DE DOBLE SENTIDO DE CIRCULACION A QUE VEHICULOS ESTOY OBLIGADO A CEDER EL PASO?', ''),
(206, '¿SI PRETENDO DAR VUELTA A LA IZQ. EN VIAS DE DOBLE SENTIDO DE CIRCULACION A QUE VEHICULOS ESTOY OBLIGADO A CEDER EL PASO?', ''),
(207, 'Señalamiento que indica material acamellonado ?', ''),
(208, 'AL ESTACIONARSE EN CARRETERA ¿CUANTOS METROS DE LA SUPERFICIE DE RODAMIENTO NO SE DEBERA INVADIR?', ''),
(209, 'AL ESTACIONARSE EN ZONAS URBANAS LAS RUEDAS DEL VEHICULO DEBERAN DE QUEDAR DE LA CERA,A UNA DISTANCIA NO MAS DE...', ''),
(210, '¿QUE LUCES DEL VEHICULO DEBERAN EMPLEARSE PARA INDICAR CAMBIOS DE DIRECCION?', ''),
(211, '¿EN ZONAS QUE NO ESTEN SUFICIENTEMENTE ILUMINADAS QUE LUCEN DEL VEHICULO SE DEBEN UTILIZAR?', ''),
(212, '¿QUE SEÑALES SIRVEN PARA LLEGAR A DETERMINADOS LUGARES Y EN ALGUNOS CASOS ME INDICA LAS DISTANCIAS A QUE ESTOS SE ENCUENTRAN?', ''),
(213, '¿ A qué familia pertenece esta señal  ?', '/uploads/imagen_pregunta_213.png'),
(214, 'CONDUCIR SUJETANDO CON AMBAS MANOS EL CONTROL DE LA DIRECCION DEL VEHICULO Y MANTENER UNA POSICION  ADECUADA ES...', ''),
(215, 'AL ESCUCHAR LA SIRENA DE UN VEHICULO DE EMERGENCIA QUE ESTE DE TRAS DE NUESTRO VEHICULO DEBEMOS DE...', ''),
(216, 'EL SIMBOLO \'\'FXC\'\' ADVIERTE.............', ''),
(217, 'NINGUN CONDUCTOR DEBERA DE CONDUCIR DESPUES DE....', ''),
(218, '¿QUE SIGNIFICA ESTA SEÑAL?', '/uploads/imagen_pregunta_218.jpg'),
(219, '¿QUE INDICA ESTA SEÑAL?', '/uploads/imagen_pregunta_219.png'),
(220, 'CUANDO LA SUPERFICIE DE RODAMIENTO DE UNA VIA ESTE DIVIDIDA LONGITUDINALMENTE POR UN CAMELLON CERRADO,LINEA CONTINUA O UNA BARRERA,Â¿ES CORRECTO QUE UN VEHICULOTRANSITE POR EL ESPACIO DIVISORIO O SE ESTACIONE EN ESTE?', ''),
(221, '¿QUE INDICA ESTA SEÑAL?', '/uploads/imagen_pregunta_221.png'),
(222, 'AL FINALIZAR UNA VUELTA A LA DERECHA DEBERA DE TOMAR EL CARRIL', ''),
(223, '¿CUAL DE ESTAS SEÑALES INDICA PARQUE NACIONAL?', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `providers`
--

DROP TABLE IF EXISTS `providers`;
CREATE TABLE IF NOT EXISTS `providers` (
  `provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_provider_id` int(11) NOT NULL,
  `supply_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `position_id` int(11) NOT NULL,
  `productivity` text NOT NULL,
  `quality` text NOT NULL,
  `innovation` text NOT NULL,
  `service` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`provider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`provider_id`, `service_provider_id`, `supply_id`, `user_id`, `position_id`, `productivity`, `quality`, `innovation`, `service`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 0, '1', '2', '3', '4', 3, '2022-05-10 16:54:40', NULL, NULL, NULL),
(7, 7, 6, 4, 0, 'dasdas', 'dasdasd', 'dasdasda', 'dasdsadasd', 1, '2022-05-18 11:21:42', NULL, NULL, NULL),
(3, 1, 2, 2, 0, '9', '10', '11', '12', 3, '2022-05-10 16:54:40', NULL, NULL, NULL),
(4, 2, 3, 1, 0, '1', '2', '3', '4', 3, '2022-05-10 16:54:53', NULL, NULL, NULL),
(5, 2, 4, 4, 0, '5', '6', '7', '8', 3, '2022-05-10 16:54:53', NULL, NULL, NULL),
(6, 2, 4, 2, 0, '9', '10', '11', '12', 3, '2022-05-10 16:54:53', NULL, NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `resolutions`
--

INSERT INTO `resolutions` (`resolution_id`, `user_id`, `resolution`, `description`, `created_by`, `created_at`) VALUES
(3, 2, 'pruebas', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.', 2, '2022-04-25 11:48:52'),
(4, 2, 'pruebas 2', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.', 2, '2022-04-25 12:45:01'),
(5, 2, 'pruebas', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.', 2, '2022-04-25 11:48:52'),
(6, 2, 'pruebas 2', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen.', 2, '2022-04-25 12:45:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `satisfaction_categories`
--

DROP TABLE IF EXISTS `satisfaction_categories`;
CREATE TABLE IF NOT EXISTS `satisfaction_categories` (
  `satisfaction_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(75) NOT NULL,
  `color` varchar(25) NOT NULL,
  PRIMARY KEY (`satisfaction_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `satisfaction_categories`
--

INSERT INTO `satisfaction_categories` (`satisfaction_category_id`, `category`, `color`) VALUES
(1, 'Credibilidad', '#f1f132'),
(2, 'Respeto', '#fb051c'),
(3, 'Imparcialidad', '#0101ff'),
(4, 'Orgullo', '#4da92c'),
(5, 'Compañerismo', '#bf94e4'),
(6, 'Preguntas Adicionales de México', '#282d36'),
(7, 'Adicional Cliente', '#f39c4c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `satisfaction_mechanisms`
--

DROP TABLE IF EXISTS `satisfaction_mechanisms`;
CREATE TABLE IF NOT EXISTS `satisfaction_mechanisms` (
  `satisfaction_id` int(11) NOT NULL AUTO_INCREMENT,
  `satisfaction_category_id` int(11) NOT NULL,
  `question` text NOT NULL,
  PRIMARY KEY (`satisfaction_id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `satisfaction_mechanisms`
--

INSERT INTO `satisfaction_mechanisms` (`satisfaction_id`, `satisfaction_category_id`, `question`) VALUES
(1, 1, '¿De qué manera me aseguraré de mantener informado a mis colaboradores acerca de asuntos y cambios importantes?'),
(2, 1, '¿Cómo me aseguraré de comunicar claramente mis expectativas a los colaboradores?'),
(3, 1, '¿Me pueden hacer preguntas razonables y como me aseguraré de dar una respuesta directa?'),
(4, 1, '¿Cómo me aseguraré de ser accesible y  fácil hablar con mis colaboradores?'),
(5, 1, '¿Cómo me aseguraré de manejar el negocio de forma competente?'),
(6, 1, '¿De qué manera me aseguraré de contratar gente acorde con la cultura de la empresa?'),
(7, 1, '¿Cómo me aseguraré de hacer un buen trabajo asignando y coordinando al personal?'),
(8, 1, '¿De qué manera aseguraré que mis colaboradores realicen un buen trabajo sin supervisarlos continuamente?'),
(9, 1, '¿Cómo me aseguraré que mi personal sepa que se les da mucha responsabilidad?'),
(10, 1, '¿Cómo me aseguraré de tener una visión clara de hacia dónde va la organización y de cómo lograrlo?'),
(11, 1, '¿Cómo me aseguraré de cumplir las promesas con mis colaboradores?'),
(12, 1, '¿Cómo me aseguraré que mis palabras coinciden con mis acciones?'),
(13, 1, '¿Cómo me aseguraré que mis colaboradores sepan que la empresa haría un despido masivo sólo como última opción?'),
(14, 1, '¿De qué manera me aseguraré de conducir el negocio de una manera honesta y ética?'),
(15, 2, '¿Ofreceré capacitación u otras formas de desarrollo para el crecimiento laboral de mis colaboradores?'),
(16, 2, '¿De qué manera me aseguraré de brindar los recursos y equipos necesarios para que mis colaboradores realicen su trabajo?'),
(17, 2, '¿Cómo me aseguraré  de apreciar el buen trabajo y el esfuerzo extra de mis colaboradores?'),
(18, 2, '¿De qué manera me aseguraré que mis colaboradores sepan que los jefes pueden cometer errores involuntarios al hacer su trabajo?'),
(19, 2, '¿Me aseguraré de fomentar  y responder genuinamente las sugerencias e ideas de mis colaboradores?'),
(20, 2, '¿De qué manera me aseguraré de involucrar a mis colaboradores en decisiones que afectan su trabajo o su ambiente laboral?'),
(21, 2, '¿Cómo me aseguraré de que sea un lugar físicamente seguro donde trabajar?'),
(22, 2, '¿De qué manera me aseguraré de que este sea un lugar psicológica y emocionalmente saludable donde trabajar?'),
(23, 2, '¿Cómo me aseguraré que las instalaciones contribuyan a un buen ambiente de trabajo?'),
(24, 2, '¿Cómo me aseguraré que cuando sea necesario, puede ausentarse para atender asuntos personales durante el horario de trabajo?'),
(25, 2, '¿De qué manera me aseguraré que mis colaboradores se animen a equilibrar su vida laboral y su vida personal?'),
(26, 2, '¿De qué manera me aseguraré de demostrar un interés sincero a mis colaboradores como personas y no sólo como empleados?'),
(27, 2, '¿Cómo me aseguraré de tener beneficios especiales y únicos en esta empresa?'),
(28, 3, '¿Cómo me aseguraré que a mis colaboradores se les pague justamente por el trabajo que hacen?'),
(29, 3, '¿Cómo me aseguraré que mis colaboradores sientan que reciben una parte justa de las ganancias que obtiene la empresa?'),
(30, 3, '¿De qué manera me aseguraré que todos los colaboradores tengan la oportunidad de recibir un reconocimiento especial?'),
(31, 3, '¿De qué manera me aseguraré de tratar bien a mis colaboradores independientemente de su posición en la empresa?'),
(32, 3, '¿De qué manera me aseguraré de que los ascensos se den a quien más los merecen?'),
(33, 3, '¿De qué manera me aseguraré que mis colaboradores sepan que no tenemos empleados favoritos?'),
(34, 3, '¿Cómo evitar que mis colaboradores hagan grilla para obtener algún beneficio personal?'),
(35, 3, '¿Cómo hacer que la gente sea tratada justamente sin importar su edad?'),
(36, 3, '¿Cómo hacer que la gente sea tratada justamente sin importar su raza?'),
(37, 3, '¿Cómo hacer que la gente sea tratada justamente sin importar su sexo?'),
(38, 3, '¿Cómo hacer que la gente sea tratada justamente sin importar su preferencia sexual?'),
(39, 3, '¿De qué manera me aseguraré, que si uno de mis colaboradores es tratado injustamente, tendrá oportunidad de ser escuchado y recibirá un trato justo?'),
(40, 4, '¿De qué manera me aseguraré que mis colaboradores al participar hacen una diferencia en la organización?'),
(41, 4, '¿De qué manera me aseguraré que los trabajos de mis colaboradores tienen un significado especial y que no “sólo un trabajo”?'),
(42, 4, '¿De qué manera me aseguraré que mis colaboradores se sienta orgullosos de todos los logros?'),
(43, 4, '¿De qué manera me aseguraré que mis colaboradores estén dispuestas a hacer un esfuerzo extra para realizar su trabajo?'),
(44, 4, '¿De qué manera me aseguraré que mis colaboradores deseen trabajar aquí por un largo tiempo?'),
(45, 4, '¿Cómo me aseguraré de que mis colaboradores le digan  a otros que trabajan aquí?'),
(46, 4, '¿De qué manera me aseguraré que a mis colaboradores les guste venir a trabajar aquí?'),
(47, 4, '¿De qué manera me aseguraré que mis colaboradores se sientan bien en la forma que contribuyen en la sociedad?'),
(48, 5, '¿De qué manera me aseguraré que mis colaboradores puedan ser ellos mismos?'),
(49, 5, '¿De qué manera me aseguraré  que mis colaboradores celebren eventos especiales?'),
(50, 5, '¿De qué manera me aseguraré que mis colaboradores sientan que me preocupo por ellos?'),
(51, 5, '¿De qué manera me aseguraré que este sea un lugar amigable para mis colaboradores para trabajar?'),
(52, 5, '¿Cómo me aseguraré que este sea un lugar divertido donde trabajar para mis colaboradores?'),
(53, 5, '¿De qué manera me aseguraré  que cuando mis colaboradores ingresen a la compañía se sientan bienvenidos?'),
(54, 5, '¿De qué manera me aseguraré que mis colaboradores sepan que cuando cambian de funciones o área, se les haga sentir como en casa?'),
(55, 5, '¿Cómo aseguraré que mis colaboradores que hay un sentido de “familia” o equipo?'),
(56, 5, '¿De qué manera me aseguraré que mis colaboradores sepan que estamos todos juntos en esto?'),
(57, 5, '¿De qué manera me aseguraré que mis colaboradores cuentan con todos?'),
(58, 6, '¿De qué manera me aseguraré que mis colaboradores tomando todo en consideración, digan que este es un gran lugar donde trabajar?'),
(59, 6, '¿De qué manera me aseguraré  que mis colaboradores consideren que la comunicación institucional les ayuda para estar informados de los proyectos y actividades de la empresa?'),
(60, 6, '¿De qué manera me aseguraré promueven el trabajo en equipo?'),
(61, 6, '¿De qué manera me aseguraré que los colaboradores vean que los valores de la empresa son importantes y estoy de acuerdo con ellos?'),
(62, 6, '¿Cómo me aseguraré que todos los colaboradores sepan que los valores de la empresa son practicados por todos?'),
(63, 6, '¿De qué manera me aseguraré que mis colaboradores sepan que en esta empresa existen buenas oportunidades de crecimiento?'),
(64, 6, '¿Cómo me aseguraré que mis colaboradores sepan que las personas discapacitadas se les da oportunidad y son tratadas justamente?'),
(65, 6, '¿De qué manera me aseguraré que mis colaboradores sepan que en esta empresa se difunden y conocen la misión y la visión?'),
(66, 6, '¿De qué manera me aseguraré que mis colaboradores sepan que la misión, visión y valores reflejan la importancia de las personas que trabajan en esta empresa?'),
(67, 6, '¿De qué manera me aseguraré que mis colaboradores conozcan los objetivos estratégicos de la empresa?'),
(68, 6, '¿De qué manera me aseguraré que mis colaboradores sepan que su trabajo aporta a la misión y visión de la organización así como al logro de los objetivos del negocio?'),
(69, 6, '¿De qué manera me aseguraré que mis colaboradores sepan sobre los objetivos y metas de trabajo son evaluados con su desempeño?'),
(70, 6, '¿De qué manera me aseguraré que mis colaboradores sepan que se evalúa su desempeño con criterios claros y objetivos?'),
(71, 6, '¿De qué manera me aseguraré de dar una retroalimentación clara para mejorar el desempeño de mis colaboradores?'),
(72, 6, '¿De qué manera me aseguraré de informar a mis colaboradores de sus logros los objetivos estratégicos establecidos por la organización?'),
(73, 6, '¿De qué manera me aseguraré de comunicar con claridad los resultados de mi equipo de trabajo y su contribución a los objetivos estratégicos?'),
(74, 6, '¿De qué manera me aseguraré que mis colaboradores reciban una retribución en función del logro de las metas alineadas a los objetivos estratégicos?'),
(75, 6, '¿De qué manera me aseguraré que mis colaboradores sepan que en esta empresa cuenta con planes de carrera que me permitan orientar su desarrollo profesional?'),
(76, 6, '¿De qué manera me asegurare que mis colaboradores sepan sobre los procesos y las políticas definidas para los ascensos?'),
(77, 7, '¿De qué manera me asegurare que la comunicación de mi team lead es efectiva con mis colaboradores?'),
(78, 7, '¿De qué manera me asegurare que la comunicación de mi Gerente es efectiva con mis colaboradores?'),
(79, 7, '¿De qué manera me asegurare que la capacidad gerencial de mi team lead es efectiva con mis colaboradores?'),
(80, 7, '¿De qué manera me asegurare que la capacidad gerencial de mi Gerente es efectiva con mis colaboradores?'),
(81, 7, '¿De qué manera me asegurare que la integridad de mi team lead es sólida con mis colaboradores?'),
(82, 7, '¿De qué manera me asegurare que la integridad de mi gerente es sólida con mis colaboradores?'),
(83, 7, '¿De qué manera me asegurare que la sinergia entre equipos de trabajo que promueve mi team lead es efectiva con mis colaboradores?'),
(84, 7, '¿De qué manera me asegurare que la sinergia entre equipos de trabajo que promueve mi gerente lead es efectiva con mis colaboradores?'),
(85, 7, '¿De qué manera me asegurare que el empowerment que tiene mi team lead es efectivo con mis colaboradores?'),
(86, 7, '¿De qué manera me asegurare que el empowerment que tiene mi gerente es efectivo con mis colaboradores?'),
(87, 7, '¿De qué manera me asegurare que el reconocimiento que me da mi team lead es efectivo?'),
(88, 7, '¿De qué manera me asegurare que el reconocimiento que me da mi gerente es efectivo?'),
(89, 7, '¿De qué manera me asegurare que mi team lead me trata a todos los miembros del equipo con respeto y sin favoritismos?'),
(90, 7, '¿De qué manera me asegurare que mi Gerente trate a todos los miembros del equipo con respeto y sin favoritismos?'),
(91, 7, '¿De qué manera me asegurare que el team lead les de la autoridad necesaria a mis colaboradores para gestionar su trabajo con excelencia?'),
(92, 7, '¿De qué manera me asegurare que el gerente les de la autoridad necesaria a mis colaboradores para gestionar su trabajo con excelencia?'),
(93, 7, '¿De qué manera me asegurare que el  gerente les de el reconocimiento a mis colaboradores que haga que se motiven de acuerdo a su esfuerzo?'),
(94, 7, '¿De qué manera me asegurare que el team lead de el reconocimiento a mis colaboradores que haga que se motiven de acuerdo a mi esfuerzo?'),
(95, 7, '¿De qué manera me asegurare que el team lead muestre habilidades interpersonales efectivas?'),
(96, 7, '¿De qué manera me asegurare que el gerente lead muestre habilidades interpersonales efectivas?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `satisfaction_responses`
--

DROP TABLE IF EXISTS `satisfaction_responses`;
CREATE TABLE IF NOT EXISTS `satisfaction_responses` (
  `satisfaction_response_id` int(11) NOT NULL AUTO_INCREMENT,
  `satisfaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `response` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`satisfaction_response_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2891 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `satisfaction_responses`
--

INSERT INTO `satisfaction_responses` (`satisfaction_response_id`, `satisfaction_id`, `user_id`, `response`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1931, 1, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1932, 1, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1933, 1, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1934, 1, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1935, 1, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1936, 2, 2, '6-At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1937, 2, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1938, 2, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1939, 2, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1940, 2, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1941, 3, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1942, 3, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1943, 3, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1944, 3, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1945, 3, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1946, 4, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1947, 4, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1948, 4, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1949, 4, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1950, 4, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:25', NULL, NULL, NULL),
(1951, 5, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1952, 5, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1953, 5, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1954, 5, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1955, 5, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1956, 6, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1957, 6, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1958, 6, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1959, 6, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1960, 6, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1961, 7, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1962, 7, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1963, 7, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1964, 7, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1965, 7, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1966, 8, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1967, 8, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1968, 8, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1969, 8, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1970, 8, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1971, 9, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1972, 9, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1973, 9, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1974, 9, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1975, 9, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1976, 10, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1977, 10, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1978, 10, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1979, 10, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1980, 10, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1981, 11, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1982, 11, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1983, 11, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1984, 11, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1985, 11, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1986, 12, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1987, 12, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1988, 12, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1989, 12, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1990, 12, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1991, 13, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1992, 13, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1993, 13, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1994, 13, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1995, 13, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1996, 14, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1997, 14, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1998, 14, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(1999, 14, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(2000, 14, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:26', NULL, NULL, NULL),
(2001, 15, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2002, 15, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2003, 15, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2004, 15, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2005, 15, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2006, 16, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2007, 16, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2008, 16, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2009, 16, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2010, 16, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2011, 17, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2012, 17, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2013, 17, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2014, 17, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2015, 17, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2016, 18, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2017, 18, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2018, 18, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2019, 18, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2020, 18, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2021, 19, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2022, 19, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2023, 19, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2024, 19, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2025, 19, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2026, 20, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2027, 20, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2028, 20, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2029, 20, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2030, 20, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2031, 21, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2032, 21, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2033, 21, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2034, 21, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2035, 21, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2036, 22, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2037, 22, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2038, 22, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2039, 22, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2040, 22, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2041, 23, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2042, 23, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2043, 23, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2044, 23, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2045, 23, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:27', NULL, NULL, NULL),
(2046, 24, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2047, 24, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2048, 24, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2049, 24, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2050, 24, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2051, 25, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2052, 25, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2053, 25, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2054, 25, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2055, 25, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2056, 26, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2057, 26, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2058, 26, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2059, 26, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2060, 26, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2061, 27, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2062, 27, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2063, 27, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2064, 27, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2065, 27, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2066, 28, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2067, 28, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2068, 28, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2069, 28, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2070, 28, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2071, 29, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2072, 29, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2073, 29, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2074, 29, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2075, 29, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2076, 30, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2077, 30, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2078, 30, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2079, 30, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2080, 30, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2081, 31, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2082, 31, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2083, 31, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2084, 31, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2085, 31, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2086, 32, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2087, 32, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2088, 32, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2089, 32, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2090, 32, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:28', NULL, NULL, NULL),
(2091, 33, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2092, 33, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2093, 33, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2094, 33, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2095, 33, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2096, 34, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2097, 34, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2098, 34, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2099, 34, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2100, 34, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2101, 35, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2102, 35, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2103, 35, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2104, 35, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2105, 35, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2106, 36, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2107, 36, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2108, 36, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2109, 36, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2110, 36, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2111, 37, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2112, 37, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2113, 37, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2114, 37, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2115, 37, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2116, 38, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2117, 38, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2118, 38, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2119, 38, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2120, 38, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2121, 39, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2122, 39, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2123, 39, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2124, 39, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2125, 39, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2126, 40, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2127, 40, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2128, 40, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2129, 40, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL);
INSERT INTO `satisfaction_responses` (`satisfaction_response_id`, `satisfaction_id`, `user_id`, `response`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2130, 40, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2131, 41, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2132, 41, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2133, 41, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2134, 41, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2135, 41, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:29', NULL, NULL, NULL),
(2136, 42, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2137, 42, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2138, 42, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2139, 42, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2140, 42, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2141, 43, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2142, 43, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2143, 43, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2144, 43, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2145, 43, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2146, 44, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2147, 44, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2148, 44, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2149, 44, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2150, 44, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2151, 45, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2152, 45, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2153, 45, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2154, 45, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2155, 45, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2156, 46, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2157, 46, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2158, 46, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2159, 46, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2160, 46, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2161, 47, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2162, 47, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2163, 47, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2164, 47, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2165, 47, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2166, 48, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2167, 48, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2168, 48, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2169, 48, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2170, 48, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2171, 49, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2172, 49, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2173, 49, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2174, 49, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2175, 49, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2176, 50, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2177, 50, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2178, 50, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2179, 50, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2180, 50, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:30', NULL, NULL, NULL),
(2181, 51, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2182, 51, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2183, 51, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2184, 51, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2185, 51, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2186, 52, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2187, 52, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2188, 52, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2189, 52, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2190, 52, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2191, 53, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2192, 53, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2193, 53, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2194, 53, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2195, 53, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2196, 54, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2197, 54, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2198, 54, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2199, 54, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2200, 54, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2201, 55, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2202, 55, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2203, 55, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2204, 55, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2205, 55, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2206, 56, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2207, 56, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2208, 56, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2209, 56, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2210, 56, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2211, 57, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2212, 57, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2213, 57, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2214, 57, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2215, 57, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:31', NULL, NULL, NULL),
(2216, 58, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2217, 58, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2218, 58, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2219, 58, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2220, 58, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2221, 59, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2222, 59, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2223, 59, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2224, 59, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2225, 59, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2226, 60, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2227, 60, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2228, 60, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2229, 60, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2230, 60, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2231, 61, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2232, 61, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2233, 61, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2234, 61, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2235, 61, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2236, 62, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2237, 62, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2238, 62, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2239, 62, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2240, 62, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2241, 63, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2242, 63, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2243, 63, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2244, 63, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2245, 63, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2246, 64, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2247, 64, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2248, 64, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2249, 64, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2250, 64, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2251, 65, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2252, 65, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2253, 65, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2254, 65, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2255, 65, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:32', NULL, NULL, NULL),
(2256, 66, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2257, 66, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2258, 66, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2259, 66, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2260, 66, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2261, 67, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2262, 67, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2263, 67, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2264, 67, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2265, 67, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2266, 68, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2267, 68, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2268, 68, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2269, 68, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2270, 68, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2271, 69, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2272, 69, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2273, 69, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2274, 69, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2275, 69, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2276, 70, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2277, 70, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2278, 70, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2279, 70, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2280, 70, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2281, 71, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2282, 71, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2283, 71, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2284, 71, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2285, 71, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2286, 72, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2287, 72, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2288, 72, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2289, 72, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2290, 72, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2291, 73, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2292, 73, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2293, 73, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2294, 73, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2295, 73, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2296, 74, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2297, 74, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2298, 74, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2299, 74, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2300, 74, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:33', NULL, NULL, NULL),
(2301, 75, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2302, 75, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2303, 75, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2304, 75, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2305, 75, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2306, 76, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2307, 76, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2308, 76, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2309, 76, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2310, 76, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2311, 77, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2312, 77, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2313, 77, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2314, 77, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2315, 77, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2316, 78, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2317, 78, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2318, 78, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2319, 78, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2320, 78, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2321, 79, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2322, 79, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2323, 79, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2324, 79, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2325, 79, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2326, 80, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2327, 80, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2328, 80, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL);
INSERT INTO `satisfaction_responses` (`satisfaction_response_id`, `satisfaction_id`, `user_id`, `response`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2329, 80, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2330, 80, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2331, 81, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2332, 81, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2333, 81, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2334, 81, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2335, 81, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2336, 82, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2337, 82, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2338, 82, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2339, 82, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2340, 82, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2341, 83, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2342, 83, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2343, 83, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2344, 83, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2345, 83, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:34', NULL, NULL, NULL),
(2346, 84, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2347, 84, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2348, 84, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2349, 84, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2350, 84, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2351, 85, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2352, 85, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2353, 85, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2354, 85, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2355, 85, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2356, 86, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2357, 86, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2358, 86, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2359, 86, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2360, 86, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2361, 87, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2362, 87, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2363, 87, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2364, 87, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2365, 87, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2366, 88, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2367, 88, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2368, 88, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2369, 88, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2370, 88, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2371, 89, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2372, 89, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2373, 89, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2374, 89, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2375, 89, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2376, 90, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2377, 90, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2378, 90, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2379, 90, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2380, 90, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2381, 91, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2382, 91, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2383, 91, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2384, 91, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2385, 91, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2386, 92, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2387, 92, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2388, 92, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2389, 92, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2390, 92, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:35', NULL, NULL, NULL),
(2391, 93, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2392, 93, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2393, 93, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2394, 93, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2395, 93, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2396, 94, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2397, 94, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2398, 94, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2399, 94, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2400, 94, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2401, 95, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2402, 95, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2403, 95, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2404, 95, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2405, 95, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2406, 96, 2, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2407, 96, 2, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2408, 96, 2, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2409, 96, 2, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2410, 96, 2, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 2, '2022-05-26 16:36:36', NULL, NULL, NULL),
(2411, 1, 3, '3--At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:48', NULL, NULL, NULL),
(2412, 1, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:48', NULL, NULL, NULL),
(2413, 1, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:48', NULL, NULL, NULL),
(2414, 1, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:48', NULL, NULL, NULL),
(2415, 1, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:48', NULL, NULL, NULL),
(2416, 2, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2417, 2, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2418, 2, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2419, 2, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2420, 2, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2421, 3, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2422, 3, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2423, 3, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2424, 3, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2425, 3, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2426, 4, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2427, 4, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2428, 4, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2429, 4, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2430, 4, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2431, 5, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2432, 5, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2433, 5, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2434, 5, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2435, 5, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2436, 6, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2437, 6, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2438, 6, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2439, 6, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2440, 6, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2441, 7, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2442, 7, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2443, 7, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2444, 7, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2445, 7, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2446, 8, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2447, 8, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2448, 8, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2449, 8, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2450, 8, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:49', NULL, NULL, NULL),
(2451, 9, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2452, 9, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2453, 9, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2454, 9, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2455, 9, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2456, 10, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2457, 10, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2458, 10, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2459, 10, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2460, 10, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2461, 11, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2462, 11, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2463, 11, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2464, 11, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2465, 11, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2466, 12, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2467, 12, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2468, 12, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2469, 12, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2470, 12, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2471, 13, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2472, 13, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2473, 13, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2474, 13, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2475, 13, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2476, 14, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2477, 14, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2478, 14, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2479, 14, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2480, 14, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2481, 15, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2482, 15, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2483, 15, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2484, 15, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2485, 15, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2486, 16, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2487, 16, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2488, 16, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2489, 16, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2490, 16, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:50', NULL, NULL, NULL),
(2491, 17, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2492, 17, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2493, 17, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2494, 17, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2495, 17, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2496, 18, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2497, 18, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2498, 18, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2499, 18, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2500, 18, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2501, 19, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2502, 19, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2503, 19, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2504, 19, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2505, 19, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2506, 20, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2507, 20, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2508, 20, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2509, 20, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2510, 20, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2511, 21, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2512, 21, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2513, 21, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2514, 21, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2515, 21, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2516, 22, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2517, 22, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2518, 22, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2519, 22, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2520, 22, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2521, 23, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2522, 23, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2523, 23, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2524, 23, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:51', NULL, NULL, NULL),
(2525, 23, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2526, 24, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2527, 24, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:52', NULL, NULL, NULL);
INSERT INTO `satisfaction_responses` (`satisfaction_response_id`, `satisfaction_id`, `user_id`, `response`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2528, 24, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2529, 24, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2530, 24, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2531, 25, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2532, 25, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2533, 25, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2534, 25, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2535, 25, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2536, 26, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2537, 26, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2538, 26, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2539, 26, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2540, 26, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2541, 27, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2542, 27, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2543, 27, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2544, 27, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2545, 27, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2546, 28, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2547, 28, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2548, 28, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2549, 28, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2550, 28, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2551, 29, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2552, 29, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2553, 29, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2554, 29, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2555, 29, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:52', NULL, NULL, NULL),
(2556, 30, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2557, 30, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2558, 30, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2559, 30, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2560, 30, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2561, 31, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2562, 31, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2563, 31, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2564, 31, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2565, 31, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2566, 32, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2567, 32, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2568, 32, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2569, 32, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2570, 32, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2571, 33, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2572, 33, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2573, 33, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2574, 33, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2575, 33, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2576, 34, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2577, 34, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2578, 34, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2579, 34, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2580, 34, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2581, 35, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2582, 35, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2583, 35, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2584, 35, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2585, 35, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:53', NULL, NULL, NULL),
(2586, 36, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2587, 36, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2588, 36, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2589, 36, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2590, 36, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2591, 37, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2592, 37, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2593, 37, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2594, 37, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2595, 37, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2596, 38, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2597, 38, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2598, 38, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2599, 38, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2600, 38, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2601, 39, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2602, 39, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2603, 39, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2604, 39, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2605, 39, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2606, 40, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2607, 40, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2608, 40, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2609, 40, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2610, 40, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2611, 41, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2612, 41, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2613, 41, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2614, 41, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2615, 41, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2616, 42, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2617, 42, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2618, 42, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2619, 42, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2620, 42, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:54', NULL, NULL, NULL),
(2621, 43, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2622, 43, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2623, 43, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2624, 43, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2625, 43, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2626, 44, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2627, 44, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2628, 44, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2629, 44, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2630, 44, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2631, 45, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2632, 45, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2633, 45, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2634, 45, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2635, 45, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2636, 46, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2637, 46, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2638, 46, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2639, 46, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2640, 46, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2641, 47, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2642, 47, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2643, 47, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2644, 47, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2645, 47, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2646, 48, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2647, 48, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2648, 48, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2649, 48, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2650, 48, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2651, 49, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2652, 49, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2653, 49, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2654, 49, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2655, 49, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2656, 50, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2657, 50, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2658, 50, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2659, 50, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2660, 50, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:55', NULL, NULL, NULL),
(2661, 51, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2662, 51, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2663, 51, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2664, 51, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2665, 51, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2666, 52, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2667, 52, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2668, 52, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2669, 52, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2670, 52, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2671, 53, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2672, 53, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2673, 53, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2674, 53, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2675, 53, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2676, 54, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2677, 54, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2678, 54, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2679, 54, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2680, 54, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2681, 55, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2682, 55, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2683, 55, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2684, 55, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2685, 55, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2686, 56, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2687, 56, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2688, 56, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2689, 56, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2690, 56, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:56', NULL, NULL, NULL),
(2691, 57, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2692, 57, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2693, 57, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2694, 57, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2695, 57, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2696, 58, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2697, 58, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2698, 58, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2699, 58, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2700, 58, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2701, 59, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2702, 59, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2703, 59, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2704, 59, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2705, 59, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2706, 60, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2707, 60, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2708, 60, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2709, 60, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2710, 60, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2711, 61, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2712, 61, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2713, 61, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2714, 61, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2715, 61, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2716, 62, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2717, 62, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2718, 62, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2719, 62, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2720, 62, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:57', NULL, NULL, NULL),
(2721, 63, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2722, 63, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2723, 63, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2724, 63, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2725, 63, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL);
INSERT INTO `satisfaction_responses` (`satisfaction_response_id`, `satisfaction_id`, `user_id`, `response`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2726, 64, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2727, 64, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2728, 64, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2729, 64, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2730, 64, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2731, 65, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2732, 65, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2733, 65, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2734, 65, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2735, 65, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2736, 66, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2737, 66, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2738, 66, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2739, 66, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2740, 66, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2741, 67, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2742, 67, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2743, 67, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2744, 67, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2745, 67, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2746, 68, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2747, 68, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2748, 68, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2749, 68, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2750, 68, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2751, 69, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2752, 69, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2753, 69, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2754, 69, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2755, 69, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2756, 70, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2757, 70, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2758, 70, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2759, 70, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2760, 70, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:58', NULL, NULL, NULL),
(2761, 71, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2762, 71, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2763, 71, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2764, 71, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2765, 71, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2766, 72, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2767, 72, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2768, 72, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2769, 72, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2770, 72, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2771, 73, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2772, 73, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2773, 73, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2774, 73, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2775, 73, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2776, 74, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2777, 74, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2778, 74, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2779, 74, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2780, 74, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2781, 75, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2782, 75, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2783, 75, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2784, 75, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2785, 75, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2786, 76, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2787, 76, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2788, 76, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2789, 76, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2790, 76, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2791, 77, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2792, 77, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2793, 77, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2794, 77, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2795, 77, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:15:59', NULL, NULL, NULL),
(2796, 78, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2797, 78, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2798, 78, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2799, 78, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2800, 78, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2801, 79, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2802, 79, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2803, 79, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2804, 79, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2805, 79, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2806, 80, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2807, 80, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2808, 80, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2809, 80, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2810, 80, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2811, 81, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2812, 81, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2813, 81, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2814, 81, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2815, 81, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2816, 82, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2817, 82, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2818, 82, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2819, 82, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2820, 82, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2821, 83, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2822, 83, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2823, 83, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2824, 83, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2825, 83, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2826, 84, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2827, 84, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2828, 84, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2829, 84, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2830, 84, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:00', NULL, NULL, NULL),
(2831, 85, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2832, 85, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2833, 85, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2834, 85, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2835, 85, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2836, 86, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2837, 86, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2838, 86, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2839, 86, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2840, 86, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2841, 87, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2842, 87, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2843, 87, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2844, 87, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2845, 87, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2846, 88, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2847, 88, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2848, 88, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2849, 88, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2850, 88, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2851, 89, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2852, 89, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2853, 89, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2854, 89, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2855, 89, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2856, 90, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2857, 90, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2858, 90, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2859, 90, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2860, 90, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2861, 91, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:01', NULL, NULL, NULL),
(2862, 91, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2863, 91, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2864, 91, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2865, 91, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2866, 92, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2867, 92, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2868, 92, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2869, 92, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2870, 92, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2871, 93, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2872, 93, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2873, 93, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2874, 93, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2875, 93, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2876, 94, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2877, 94, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2878, 94, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2879, 94, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2880, 94, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2881, 95, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2882, 95, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2883, 95, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2884, 95, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2885, 95, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2886, 96, 3, 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2887, 96, 3, 'Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2888, 96, 3, 'Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2889, 96, 3, 'The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL),
(2890, 96, 3, 'Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 3, '2022-05-27 14:16:02', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `satisfaction_response_ratings`
--

DROP TABLE IF EXISTS `satisfaction_response_ratings`;
CREATE TABLE IF NOT EXISTS `satisfaction_response_ratings` (
  `satisfaction_response_rating_id` int(11) NOT NULL AUTO_INCREMENT,
  `satisfaction_response_id` int(11) NOT NULL,
  `satisfaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `description` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`satisfaction_response_rating_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `satisfaction_response_ratings`
--

INSERT INTO `satisfaction_response_ratings` (`satisfaction_response_rating_id`, `satisfaction_response_id`, `satisfaction_id`, `user_id`, `rating`, `description`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 2411, 1, 3, 100, 'qweqweqweqwe', 2, '2022-05-30 16:58:07', NULL, NULL, NULL),
(2, 2412, 1, 3, 80, 'lorem2', 2, '2022-05-30 16:58:21', 2, '2022-05-30 16:58:57', NULL),
(3, 2413, 1, 3, 5, 'dasdasd', 2, '2022-05-30 16:59:06', NULL, NULL, NULL),
(4, 2414, 1, 3, 75, 'adsdasdasd', 2, '2022-05-30 16:59:09', NULL, NULL, NULL),
(5, 2415, 1, 3, 70, 'sqweqweqweqweqwe', 2, '2022-05-31 10:43:42', NULL, NULL, NULL),
(6, 2436, 6, 3, 20, 'asdasdasdasd', 2, '2022-05-31 11:24:27', 2, '2022-05-31 14:00:51', NULL),
(7, 2416, 2, 3, 90, '', 2, '2022-05-31 13:37:37', NULL, NULL, NULL),
(8, 2417, 2, 3, 100, '', 2, '2022-05-31 13:37:46', NULL, NULL, NULL),
(9, 2418, 2, 3, 80, '', 2, '2022-05-31 13:37:52', NULL, NULL, NULL),
(10, 2419, 2, 3, 70, '', 2, '2022-05-31 13:37:57', NULL, NULL, NULL),
(11, 2420, 2, 3, 55, '', 2, '2022-05-31 13:38:03', NULL, NULL, NULL),
(12, 2437, 6, 3, 55, 'dasdasdasd', 2, '2022-05-31 13:43:48', 2, '2022-05-31 14:00:49', NULL),
(13, 2411, 1, 1, 100, 'qweqweqweqwe', 2, '2022-05-30 16:58:07', NULL, NULL, NULL),
(14, 2412, 1, 1, 80, 'lorem2', 2, '2022-05-30 16:58:21', 2, '2022-05-30 16:58:57', NULL),
(15, 2413, 1, 1, 55, 'dasdasd', 2, '2022-05-30 16:59:06', NULL, NULL, NULL),
(16, 2414, 1, 1, 75, 'adsdasdasd', 2, '2022-05-30 16:59:09', NULL, NULL, NULL),
(17, 2415, 1, 1, 70, 'sqweqweqweqweqwe', 2, '2022-05-31 10:43:42', NULL, NULL, NULL),
(18, 2440, 6, 3, 90, '', 2, '2022-05-31 14:00:41', NULL, NULL, NULL),
(19, 2439, 6, 3, 90, '', 2, '2022-05-31 14:00:44', NULL, NULL, NULL),
(20, 2438, 6, 3, 40, '', 2, '2022-05-31 14:00:46', NULL, NULL, NULL),
(24, 1931, 1, 2, 10, 'dasdasdasdasdasdasd', 3, '2022-06-01 14:36:37', 3, '2022-06-01 14:38:23', NULL),
(25, 1935, 1, 2, 40, 'dasdasdad', 3, '2022-06-01 14:38:17', NULL, NULL, NULL),
(26, 1934, 1, 2, 11, 'dasdasdasdasdasdasdasdasddas', 3, '2022-06-01 14:38:18', NULL, NULL, NULL),
(27, 1933, 1, 2, 22, 'dasdadasdasd', 3, '2022-06-01 14:38:19', NULL, NULL, NULL),
(28, 1932, 1, 2, 55, 'adsdasdasdasd', 3, '2022-06-01 14:38:21', NULL, NULL, NULL),
(29, 0, 0, 0, 55, 'dasdasdasd', 3, '2022-06-01 16:02:42', NULL, NULL, NULL);

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
  `user_id` int(11) DEFAULT NULL,
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `created_admin` int(11) DEFAULT '0',
  `monthly_amount` decimal(10,2) NOT NULL,
  `productivity` text,
  `quality` text,
  `innovation` text,
  `service` text,
  `weighing` int(11) NOT NULL DEFAULT '0',
  `employee_cost` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` int(1) UNSIGNED DEFAULT '1',
  `status_validated` int(1) NOT NULL DEFAULT '1',
  `classification` int(1) DEFAULT '0',
  `file_pdf` text,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`service_id`, `organization_id`, `description`, `frequency`, `user_id`, `position_id`, `created_admin`, `monthly_amount`, `productivity`, `quality`, `innovation`, `service`, `weighing`, `employee_cost`, `status`, `status_validated`, `classification`, `file_pdf`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'servicio # 1 creado por el lider cesar', 'mensual', 3, 3, 0, '3.00', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 70, '0.00', 2, 2, 0, NULL, 3, '2022-05-18 16:47:51', 3, '2022-05-25 14:45:08', NULL),
(2, 1, 'servicio creado para el puesto de programador jr', '2', NULL, 3, 1, '200.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 0, '22.02', 1, 1, 0, NULL, 1, '2022-05-18 16:50:48', NULL, NULL, NULL),
(3, 1, 'servicio creado por el jefe josue betancourt', '3', 2, 2, 0, '300.00', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 0, '0.00', 1, 1, 0, NULL, 2, '2022-05-19 14:17:51', NULL, NULL, NULL),
(4, 1, 'servicio # 2 creado por el lider cesar herrera', 'Semanal', 3, 3, 0, '3.00', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.', 30, '0.00', 2, 2, 0, NULL, 3, '2022-05-25 09:46:03', 3, '2022-05-25 14:45:08', NULL);

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
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`service_competitor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services_competitors`
--

INSERT INTO `services_competitors` (`service_competitor_id`, `service_id`, `company`, `guarantee`, `offered_price`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'merida soft', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '3000.00', 3, '2022-05-25 09:46:21', NULL, NULL, NULL),
(2, 1, 'athlon sa de cv', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '3000.00', 3, '2022-05-25 09:46:21', NULL, NULL, NULL),
(3, 1, 'blue ocean', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '3000.00', 3, '2022-05-25 09:46:21', NULL, NULL, NULL);

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
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`service_customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services_customers`
--

INSERT INTO `services_customers` (`service_customer_id`, `service_id`, `customer_id`, `position_customer_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 3, 3, '2022-05-25 09:46:21', NULL, NULL, NULL),
(2, 1, 2, 2, 3, '2022-05-25 09:46:21', NULL, NULL, NULL),
(3, 1, 4, 3, 3, '2022-05-25 09:46:21', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `services_status`
--

DROP TABLE IF EXISTS `services_status`;
CREATE TABLE IF NOT EXISTS `services_status` (
  `service_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` text NOT NULL,
  PRIMARY KEY (`service_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services_status`
--

INSERT INTO `services_status` (`service_status_id`, `status`) VALUES
(1, 'Sin clasificar'),
(2, 'Común'),
(3, 'Híbrido'),
(4, 'Esporádico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `service_providers`
--

DROP TABLE IF EXISTS `service_providers`;
CREATE TABLE IF NOT EXISTS `service_providers` (
  `service_provider_id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `date_service` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`service_provider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `service_providers`
--

INSERT INTO `service_providers` (`service_provider_id`, `organization_id`, `user_id`, `service_id`, `description`, `date_service`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 3, '', '2022-05-10 16:15:00', 3, '2022-05-10 16:54:40', NULL, NULL, NULL),
(3, 1, 3, 12, '', '2022-05-10 16:15:00', 3, '2022-05-10 16:54:40', NULL, NULL, NULL),
(4, 1, 1, 11, '', '2022-05-16 11:20:40', 1, '2022-05-18 11:20:57', NULL, NULL, NULL),
(5, 1, 1, 11, '', '2022-05-16 11:20:40', 1, '2022-05-18 11:21:05', NULL, NULL, NULL),
(6, 1, 1, 11, '', '2022-05-16 11:20:40', 1, '2022-05-18 11:21:28', NULL, NULL, NULL),
(7, 1, 1, 11, '', '2022-05-16 11:20:40', 1, '2022-05-18 11:21:42', NULL, NULL, NULL),
(8, 1, 4, 13, '', '2022-05-18 11:22:09', 1, '2022-05-18 11:22:16', NULL, NULL, NULL),
(9, 1, 4, 14, '', '2022-05-18 11:22:00', 1, '2022-05-18 11:22:51', NULL, NULL, NULL),
(10, 1, 4, 15, '', '2022-05-18 11:23:39', 1, '2022-05-18 11:23:48', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplies`
--

DROP TABLE IF EXISTS `supplies`;
CREATE TABLE IF NOT EXISTS `supplies` (
  `supply_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_provider_id` int(11) NOT NULL,
  `type_supply_id` int(11) NOT NULL,
  `supply` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime NOT NULL,
  PRIMARY KEY (`supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `supplies`
--

INSERT INTO `supplies` (`supply_id`, `service_provider_id`, `type_supply_id`, `supply`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(5, 6, 4, '', 1, '2022-05-18 11:21:28', NULL, NULL, '0000-00-00 00:00:00'),
(2, 1, 2, 's2', 3, '2022-05-10 16:54:40', NULL, NULL, '0000-00-00 00:00:00'),
(3, 2, 1, 's1', 3, '2022-05-10 16:54:53', NULL, NULL, '0000-00-00 00:00:00'),
(4, 2, 2, 's2', 3, '2022-05-10 16:54:53', NULL, NULL, '0000-00-00 00:00:00'),
(6, 7, 4, '', 1, '2022-05-18 11:21:42', NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `finish_date` datetime DEFAULT NULL,
  `productivity` text NOT NULL,
  `quality` text NOT NULL,
  `innovation` text NOT NULL,
  `service` text NOT NULL,
  `commentary` text NOT NULL,
  `document` text NOT NULL,
  `average_productivity` int(3) DEFAULT NULL,
  `average_quality` int(3) DEFAULT NULL,
  `average_innovation` int(3) DEFAULT NULL,
  `average_service` int(3) DEFAULT NULL,
  `commentary_productivity` text NOT NULL,
  `commentary_quality` text NOT NULL,
  `commentary_innovation` text NOT NULL,
  `commentary_service` text NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT '1',
  `my_productivity` int(1) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks`
--

INSERT INTO `tasks` (`task_id`, `service_id`, `user_id`, `delivery_date`, `start_date`, `finish_date`, `productivity`, `quality`, `innovation`, `service`, `commentary`, `document`, `average_productivity`, `average_quality`, `average_innovation`, `average_service`, `commentary_productivity`, `commentary_quality`, `commentary_innovation`, `commentary_service`, `status_id`, `my_productivity`, `amount`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(4, 1, 3, '2022-05-20 11:16:06', '2022-05-20 11:16:06', '2022-05-20 11:16:06', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'listo.', '', 50, 80, 70, 90, '', '', '', '', 4, 0, 0, 2, '2022-05-23 11:16:25', 2, '2022-05-20 13:54:47', NULL),
(3, 3, 2, '2022-05-19 14:18:25', '2022-05-20 11:16:06', '2022-05-20 11:16:06', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 'Font Awesome gives you scalable vector icons that can instantly be customized — size, color, drop shadow, and anything that can be done with the power of CSS.', 'pruebas', '', NULL, NULL, NULL, NULL, '', '', '', '', 1, 0, 0, 3, '2022-05-23 14:18:33', 2, '2022-05-19 16:00:22', NULL),
(2, 2, 3, '2022-05-18 17:29:53', '2022-05-20 11:16:06', '2022-05-20 11:16:06', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. ', 'pruebas', '1652986985_269b486e3df6b4fc73c1.pdf', 100, 90, 90, 100, 'calificar productividad', 'calificar calidad', 'calificar innovacion', 'calificar servicio', 4, 0, 0, 2, '2022-05-23 17:29:59', 2, '2022-05-20 12:49:47', NULL),
(6, 1, 3, '2022-05-20 12:46:52', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry', '', '', NULL, NULL, NULL, NULL, '', '', '', '', 3, 1, 0, 2, '2022-05-24 12:47:04', NULL, NULL, NULL),
(7, 2, 3, '2022-05-11 13:20:51', NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', '', '', NULL, NULL, NULL, NULL, '', '', '', '', 3, 1, 5, 2, '2022-05-25 13:21:23', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks_status`
--

DROP TABLE IF EXISTS `tasks_status`;
CREATE TABLE IF NOT EXISTS `tasks_status` (
  `task_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(75) NOT NULL,
  PRIMARY KEY (`task_status_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tasks_status`
--

INSERT INTO `tasks_status` (`task_status_id`, `status`) VALUES
(1, 'Requisitado'),
(2, 'En progreso'),
(3, 'Finalizado'),
(4, 'Evaluado'),
(5, 'Rechazado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `type_supplies`
--

DROP TABLE IF EXISTS `type_supplies`;
CREATE TABLE IF NOT EXISTS `type_supplies` (
  `type_supply_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(75) NOT NULL,
  PRIMARY KEY (`type_supply_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `type_supplies`
--

INSERT INTO `type_supplies` (`type_supply_id`, `type`) VALUES
(1, 'Recurso Financiero'),
(2, 'Recurso Tecnologico'),
(3, 'Recurso Material'),
(4, 'Personas'),
(5, 'Información'),
(6, 'Otros');

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
(1, 'root', 'd6383d35a8c11149e13c1729dcfa072b', 1, '1651070092_b70c45ffe4cf5ddcd1e2.jpeg', '1651011538_4e60255e24323a055e68.mp4', NULL, 1, '2022-04-14 12:06:11', 1, '2022-05-04 15:33:52', NULL),
(2, 'jefe', 'c4ca4238a0b923820dcc509a6f75849b', 2, '', '', NULL, 1, '2022-04-14 12:06:11', 1, '2022-05-11 11:38:44', NULL),
(3, 'lider', 'c4ca4238a0b923820dcc509a6f75849b', 3, '', '', NULL, 1, '2022-04-14 12:06:11', 1, '2022-05-11 11:39:00', NULL),
(4, 'empleado', 'c4ca4238a0b923820dcc509a6f75849b', 4, '', '', NULL, 1, '2022-04-20 17:18:32', 1, '2022-05-11 11:39:15', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
