-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-05-2022 a las 22:43:26
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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `chiefs`
--

INSERT INTO `chiefs` (`chief_id`, `organization_id`, `chief_user_id`, `employee_user_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2, 1, 3, 4, 1, '2022-04-28 16:15:38', NULL, NULL, NULL),
(4, 1, 2, 3, 1, '2022-05-11 11:46:00', NULL, NULL, NULL),
(5, 1, 2, 4, 1, '2022-05-11 16:58:45', NULL, NULL, NULL);

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
(3, 1, 1, 1, 'prueba de quejas para gerardo', 1, 2, '2022-05-13 12:39:37', NULL, NULL, '2022-05-13 12:43:57'),
(4, 1, 1, 1, 'pruebas gerardo', 1, 2, '2022-05-13 12:44:11', NULL, NULL, NULL),
(5, 1, 3, 1, 'queja para cesar herrera', 1, 2, '2022-05-13 12:46:27', NULL, NULL, NULL),
(6, 1, 1, 1, 'pruebas', 1, 3, '2022-05-13 13:30:16', NULL, NULL, NULL);

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

INSERT INTO `employees` (`employee_id`, `user_id`, `first_name`, `second_name`, `last_name`, `second_last_name`, `business_name`, `gender_id`, `birthday`, `email`, `phone`, `mobile`, `civil_status_id`, `economic_dependents`, `street`, `number`, `suburb`, `postal_code`, `estate`, `delegation`, `country_id`, `nationality_id`, `type_user_id`, `salary_amount`, `social_security`, `benefit_1`, `benefit_amount_1`, `benefit_2`, `benefit_amount_2`, `benefit_3`, `benefit_amount_3`, `benefit_4`, `benefit_amount_4`, `total`, `disc`, `date_admission`, `schooling_id`, `organization_id`, `department_id`, `position_id`, `mission`, `vision`, `competitive_advantages`, `comparative_advantages`, `roi`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Gerardo', 'Francisco', 'Rodriguez', 'Ordaz', '', 1, '1992-12-03', 'gerardofrancisco.rodriguez@hotmail.com', '9994940560111', '9994940561111', 2, '21', '761', '8841', 'Mérida1', '97290', 'YUCATÁN1', 'MËRIDA1', 146, 122, 1, '1.00', '2.00', 'p11', '3.00', 'p21', '5.01', 'p31', '5.00', 'p41', '6.00', '22.02', 11, '2022-04-19', 4, 1, 2, 3, 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.						', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas \"Letraset\", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', '0.00', 1, '2022-04-19 16:52:38', 1, '2022-04-25 12:47:54', NULL),
(2, 2, 'Josue', 'Joel', 'Betancurt', 'Lopez', '', 1, '1992-12-03', 'josue.b@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MËRIDA', 146, 122, 1, '1.00', '2.00', 'p1', '3.00', 'p2', '4.00', 'p3', '5.00', 'p4', '6.00', '21.00', 1, '2022-04-19', 4, 1, 2, 2, NULL, NULL, NULL, NULL, '0.00', 1, '2022-04-19 16:52:38', 1, '2022-04-20 17:16:10', NULL),
(3, 3, 'Cesar', '', 'Herrera', '', '', 1, '1992-12-03', 'cesar@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MËRIDA', 146, 122, 1, '14000.00', '1000.00', 'p1', '1000.00', 'p2', '500.00', 'p3', '500.00', 'p4', '0.00', '18000.00', 1, '2022-04-19', 4, 1, 2, 3, NULL, NULL, NULL, NULL, '4.17', 1, '2022-04-19 16:52:38', 1, '2022-05-05 16:31:30', NULL),
(4, 4, 'Gissel', 'Dayana', 'Caamal', 'Moo', '', 2, '1992-09-14', 'gis-dayana@hotmail.com', '9994940560', '9994940561', 2, '2', '76', '884', 'Mérida', '97290', 'YUCATÁN', 'MÉRIDA', 146, 122, 1, '1.00', '2.00', 'p1', '3.00', 'p2', '4.00', 'p3', '5.00', 'p4', '6.00', '21.00', 1, '2022-04-19', 4, 1, 6, 3, NULL, NULL, NULL, NULL, '4285.71', 1, '2022-04-20 17:18:32', 1, '2022-04-20 17:35:19', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `providers`
--

INSERT INTO `providers` (`provider_id`, `service_provider_id`, `supply_id`, `user_id`, `position_id`, `productivity`, `quality`, `innovation`, `service`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 0, '1', '2', '3', '4', 3, '2022-05-10 16:54:40', NULL, NULL, NULL),
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
  `user_id` int(11) DEFAULT NULL,
  `position_id` int(10) UNSIGNED DEFAULT NULL,
  `created_admin` int(11) DEFAULT '0',
  `monthly_amount` decimal(10,2) NOT NULL,
  `productivity` text,
  `quality` text,
  `innovation` text,
  `service` text,
  `weighing` float NOT NULL DEFAULT '0',
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `services`
--

INSERT INTO `services` (`service_id`, `organization_id`, `description`, `frequency`, `user_id`, `position_id`, `created_admin`, `monthly_amount`, `productivity`, `quality`, `innovation`, `service`, `weighing`, `employee_cost`, `status`, `status_validated`, `classification`, `file_pdf`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'No registrado', '', 0, 0, 0, '0.00', '', '', '', '', 0, '0.00', 1, 1, 0, '', 0, '2022-05-05 17:48:26', NULL, NULL, NULL),
(3, 1, 'pruebas', 'diario', 3, 3, 0, '2.00', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 0, '0.00', 1, 1, 0, NULL, 3, '2022-05-03 12:44:38', NULL, NULL, NULL),
(11, 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'mensual', NULL, 3, 1, '3.00', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 0, '22.02', 1, 1, 0, '1652283442_17e2b4d52e35aa7c2b72.pdf', 1, '2022-05-05 11:20:28', NULL, NULL, NULL),
(12, 1, 'servicio del empleado de gissel caamal', 'mensual', 3, NULL, 0, '50.00', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 0, '0.00', 2, 2, 0, NULL, 3, '2022-05-11 11:44:28', 2, '2022-05-11 17:24:35', NULL),
(13, 1, 'servicio del empleado de gissel caamal', 'mensual', 4, NULL, 0, '50.00', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 0, '0.00', 2, 2, 0, NULL, 4, '2022-05-11 11:44:28', 2, '2022-05-11 17:46:56', NULL),
(14, 1, 'servicio del empleado de gissel caamal', 'mensual', 4, NULL, 0, '50.00', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 0, '0.00', 3, 2, 0, NULL, 4, '2022-05-11 11:44:28', 2, '2022-05-12 10:27:07', NULL),
(15, 1, 'servicio del empleado de gissel caamal', 'mensual', 4, NULL, 0, '50.00', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 0, '0.00', 4, 1, 0, NULL, 4, '2022-05-11 11:44:28', 3, '2022-05-12 10:15:09', NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services_competitors`
--

INSERT INTO `services_competitors` (`service_competitor_id`, `service_id`, `company`, `guarantee`, `offered_price`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'competidor 1', 'Garantias ofrecidas	1', '30000.00', 3, '2022-05-11 16:10:56', NULL, NULL, NULL),
(12, 11, 'c2', 'g2', '30000.00', 1, '2022-05-06 11:01:01', NULL, NULL, NULL),
(13, 11, 'c3', 'g3', '30000.00', 1, '2022-05-06 11:01:01', NULL, NULL, NULL),
(11, 11, 'c1', 'g1', '30000.00', 1, '2022-05-06 11:01:01', NULL, NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `services_customers`
--

INSERT INTO `services_customers` (`service_customer_id`, `service_id`, `customer_id`, `position_customer_id`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 10, 1, 1, 0, '2022-05-05 10:45:53', NULL, NULL, NULL),
(2, 10, 1, 2, 0, '2022-05-05 10:45:53', NULL, NULL, NULL),
(4, 10, 2, 4, 0, '2022-05-05 10:45:53', NULL, NULL, NULL),
(6, 1, 1, 6, 3, '2022-05-05 11:23:19', NULL, NULL, NULL),
(10, 11, 1, 3, 1, '2022-05-06 11:01:01', NULL, NULL, NULL),
(9, 11, 2, 2, 1, '2022-05-06 11:01:01', NULL, NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `service_providers`
--

INSERT INTO `service_providers` (`service_provider_id`, `organization_id`, `user_id`, `service_id`, `description`, `date_service`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(1, 1, 3, 3, '', '2022-05-10 16:15:00', 3, '2022-05-10 16:54:40', NULL, NULL, NULL),
(3, 1, 3, 12, '', '2022-05-10 16:15:00', 3, '2022-05-10 16:54:40', NULL, NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `supplies`
--

INSERT INTO `supplies` (`supply_id`, `service_provider_id`, `type_supply_id`, `supply`, `created_by`, `created_at`, `modified_by`, `updated_at`, `deleted_at`) VALUES
(2, 1, 2, 's2', 3, '2022-05-10 16:54:40', NULL, NULL, '0000-00-00 00:00:00'),
(3, 2, 1, 's1', 3, '2022-05-10 16:54:53', NULL, NULL, '0000-00-00 00:00:00'),
(4, 2, 2, 's2', 3, '2022-05-10 16:54:53', NULL, NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_date` datetime NOT NULL,
  `start_date` datetime NOT NULL,
  `finish_date` datetime NOT NULL,
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
  `created_by` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
