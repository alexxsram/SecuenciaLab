-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 19-10-2019 a las 03:08:22
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `secuencialab`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnousuario`
--

DROP TABLE IF EXISTS `alumnousuario`;
CREATE TABLE IF NOT EXISTS `alumnousuario` (
  `codigoAlumno` varchar(15) NOT NULL,
  `nombrePila` varchar(100) NOT NULL,
  `apellidoPaterno` varchar(100) NOT NULL,
  `apellidoMaterno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PreguntaSeguridad_idPreguntaSeguridad` int(11) NOT NULL DEFAULT '1',
  `respuestaSeguridad` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`codigoAlumno`),
  KEY `fk_AlumnoUsuario_PreguntaSeguridad1_idx` (`PreguntaSeguridad_idPreguntaSeguridad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnousuario`
--

INSERT INTO `alumnousuario` (`codigoAlumno`, `nombrePila`, `apellidoPaterno`, `apellidoMaterno`, `email`, `PreguntaSeguridad_idPreguntaSeguridad`, `respuestaSeguridad`, `password`) VALUES
('A123456789', 'JUAN', 'ÑOPEZ', 'TARZO', 'agua_cristian@hotmail.com', 1, 'pepe', '123456789'),
('A208631778', 'MARCO ANTONIO', 'LEMUS', 'TORRE', 'marco.lemus@alumnos.udg.mx', 1, 'Gabriel', 'superman'),
('A210543673', 'RICARDO ALEJANDRO', 'MEZA', 'BADILLO', 'ricardo.meza@alumnos.udg.mx', 1, 'Tito', 'cheese123'),
('A210582822', 'JOSUE MARTIN', 'MARTÍNEZ', 'PULIDO', 'josue.martinez@alumnos.udg.mx', 2, 'shadow', 'shadows1'),
('A210627923', 'RICARDO ESTEBAN', 'PERALTA', 'MARTÍNEZ', 'ricardo.peralta@alumnos.udg.mx', 3, 'Jennifer Carpenter', 'contrasena'),
('A210640474', 'FELIPE DE JESÚS', 'RODRÍGUEZ', 'REYNAGA', 'felipe.rodriguex@alumnos.udg.mx', 3, 'Will Smith', 'windows95'),
('A210705169', 'OSCAR ALEJANDRO ', 'PEÑA', 'CHINA', 'oscar.pena@alumnos.udg.mx', 2, 'Reycuazar', 'computadora'),
('A211115489', 'ALAN IVAN', 'GALLARDO', 'FLORES', 'alan.gallardo@alumnos.udg.mx', 1, 'Luisito', '12345679'),
('A211413471', 'VÍCTOR ENRIQUE', 'MARTÍNEZ', 'ALVARADO', 'victor.martinez@alumnos.udg.mx', 1, 'Daniel', 'whatever'),
('A211423299', 'DIEGO ANTONIO', 'GUEVARA', 'RUÍZ', 'diego.guevara@alumnos.udg.mx', 1, 'Felix', 'adminadmin'),
('A211463975', 'ARANTXA PAOLA', 'HUIZAR', 'MOTA', 'arantxa.huizar@alumnos.udg.mx', 1, 'Martha', 'monkeydluffy'),
('A211528228', 'OSCAR BRANDON PAUL', 'RAMOS', 'SANCHEZ', 'oscar.ramos@alumnos.udg.mx', 2, 'Chuco', 'barman$91'),
('A211529771', 'BRAULIO', 'JIMÉNEZ', 'MILANES', 'braulio.jimenez@alumnos.udg.mx', 2, 'Tiendita', 'drago123'),
('A211530273', 'KEVIN OMAR', 'RAMOS', 'CHAVEZ', 'kevin.ramos@alumnos.udg.mx', 1, 'Israel', 'jevomar99'),
('A211532667', 'ANTONIO DE JESUS', 'RICO', 'HERNANDEZ', 'antonio.rico@alumnos.udg.mx', 2, 'Perrito', 'welcome7'),
('A211561217', 'ROBERTO RAFAEL', 'LAZO', 'VILLA', 'roberto.lazo@alumnos.udg.mx', 3, 'Tom Cruise', 'baseball'),
('A211576109', 'JOSÉ MARÍA', 'HERNÁNDEZ', 'HERNÁNDEZ', 'jose.hernandex@alumnos.udg.mx', 3, 'Jackie Chan', 'abc12345'),
('A211584799', 'STEVEN AUGUSTO', 'ARANA', 'MOLINERO', 'steven.arana@alumnos.udg.mx', 2, 'Doffy', 'radio1997'),
('A211599788', 'DAVID NEFTALI', 'REYES', 'SOLORIO', 'david.reyes@alumnos.udg.mx', 1, 'Davil villalobos', 'internet#'),
('A211614256', 'SILVIA ANDREA', 'URIBE', 'RANGEL', 'silvia.uribe@alumnos.udg.mx', 1, 'rangelsilvia', 'rangelsilvia'),
('A211668542', 'ABRAHAM', 'MORALES', 'CALDERÓN', 'abraham.morales@alumnos.udg.mx', 3, 'Jessica Biel', 'nintendo'),
('A211671373', 'ANGEL EDUARDO', 'ZAMUDIO', 'HERNÁNDEZ', 'angel.zamudio@alumnos.udg.mx', 1, 'Angel', 'contrasena'),
('A211677193', 'JESSICA LIZETH', 'MARIN', 'NADA', 'jessica.marin@alumnos.udg.mx', 1, 'Chris Hemsworth', 'starwats'),
('A211677649', 'MARTIN', 'HERNÁNDEZ', 'PÉREZ', 'martin.hernandex@alumnos.udg.mx', 2, 'Gato', 'football'),
('A211688756', 'BRYAN JOSUÉ ', 'GONZÁLEZ', 'LUNA', 'bryan.gonzalezx@alumnos.udg.mx', 2, 'Lazaro', 'iloveyou'),
('A211735592', 'ALDAIR YAEL', 'JASSO', 'ABURTO', 'aldair.jasso@alumnos.udg.mx', 3, 'Adam Sandler', '!@#$%^'),
('A212092423', 'LUIS ALBERTO', 'PANDURO', 'PARTIDA', 'luis.panduro@alumnos.udg.mx', 1, 'Leonardo', 'f---you1'),
('A212137826', 'OSCAR BALTAZAR', 'CERVANTES', 'CANDELARIO', 'oscar.cervantex@alumnos.udg.mx', 1, 'Miguel Angel', '12345678'),
('A212395515', 'JOSÉ YAIR', 'ROVERO', 'MEDINA', 'jose.rovero@alumnos.udg.mx', 2, 'Kurame', 'kurama12'),
('A212449275', 'ANA GEORGINA', 'SANDOVAL', 'GUZMÁN', 'ana.sandoval@alumnan.udg.mx', 1, 'Maria Jose Castro', 'georginadeluz'),
('A212493738', 'JOSÉ MIGUEL', 'RODRÍGUEZ', 'SEÁÑEZ', 'jose.rodriguex@alumnos.udg.mx', 1, 'Ricardo Tapia', 'jose@qwerty'),
('A212517475', 'VÍCTOR ALEJANDRO', 'AYALA', 'BRYANT', 'victor.ayala@alumnos.udg.mx', 3, 'Will Smith', 'password'),
('A212533594', 'JACOB ', 'NUÑO', 'GÓMEZ', 'jacob.nuno@alumnos.udg.mx', 3, 'Natalie Portman', 'football'),
('A212548834', 'ISAAC HAZAEL', 'VILLASEÑOR', 'COHEN', 'isaac.villasenor@alumnos.udg.mx', 1, 'Reyna', 'password'),
('A212578873', 'CARLOS ANDRÉS', 'BLANCO', 'ORNELAS', 'carlos.blanco@alumnos.udg.mx', 1, 'Cristian', '123456789'),
('A212584407', 'JOSÉ EMMANUEL', 'GIL', 'CARBAJAL', 'jose.gil@alumnos.udg.mx', 1, 'Chepe', 'sunshine'),
('A212585578', 'MÓNICA ALEJANDRA', 'GONZÁLEZ', 'MENA', 'monica.gonzalezx@alumnos.udg.mx', 1, 'Federico', 'princess'),
('A212635575', 'JUAN ENRIQUE', 'GONZÁLEZ', 'CASTELLANOS', 'juan.gonzalez@alumnos.udg.mx', 1, 'Cristian', 'qwerty12'),
('A212637128', 'ATHZIRI', 'VAZQUEZ', 'GERVACIO', 'athziri.vazquez@alumnos.udg.mx', 1, 'Gabriel Montiel', 'guadalajara'),
('A212644639', 'CARLOS ISMAEL', 'SALAS', 'DIMAS', 'carlos.salas@alumnos.udg.mx', 3, 'Charlize Theron', 'anitasandoval'),
('A212679955', 'ANGEL BRIAN ADONAI ', 'VELAZQUEZ', 'RUIZ', 'angel.velazquex@alumos.udg.mx', 2, 'Fermin', 'contrasena'),
('A212699573', 'ARTURO', 'GUZMÁN', 'VÁZQUEZ', 'arturo.guzman@alumnos.udg.mx', 3, 'Robert Downey Jr.', '66666666'),
('A212730756', 'SANTOS EDUARDO', 'RENTERÍA', 'ALCALÁ', 'santos.renteria@alumnos.udg.mx', 1, 'Ricardo', 'santos'),
('A213496692', 'ARTURO', 'PLASCENCIA', 'MATA', 'arturo.plascencia@alumnos.udg.mx', 2, 'Nami', 'arturo1997'),
('A214289593', 'JAIME ANTONIO', 'DE LA O', 'YERENAS', 'jaime.yerenes@alumnos.udg.mx', 2, 'Waldo', '987654321'),
('A214519521', 'SAÚL EDUARDO', 'PÉREZ', 'SANABRIA', 'saul.perez@alumnos.udg.mx', 2, 'Zoro', 'master5687'),
('A214519548', 'ALEJANDRO DE JESÚS', 'RODRÍGUEZ', 'MARTÍNEZ', 'alejandro.rodriguez@alumnos.udg.mx', 3, 'Amanda Peet', 'A214519548'),
('A214519629', 'RAÚL RODRIGO', 'PÉREZ', 'MARRERO', 'raul.perez@alumnos.udg.mx', 1, 'passw0rd', 'passw0rd'),
('A214519661', 'LUIS MANUEL', 'FLORES', 'CAMARENA', 'luis.flores@alumnos.udg.mx', 1, 'Carlos Villanueva', '11111111'),
('A214519874', 'JOSÉ FERNANDO', 'LÓPEZ', 'AGUILAR HERNÁNDEZ', 'jose.lopez@alumnos.udg.mx', 2, 'Trafalgar', 'gizmodo1'),
('A214519998', 'LEONARDO', 'HERRERA', 'ORNELAS', 'leonardo.herrera@alumnos.udg.mx', 2, 'Lalito', '12341234'),
('A214520244', 'JOSÉ CARLOS ', 'RAYGOZA', 'GONZÁLEZ', 'jose.raygoza@alumnos.udg.mx', 2, 'Marmolin', 'raygoza$123@'),
('A215861177', 'DAN EMMANUEL', 'ALTAMIRANO', 'MORELOS', 'dan.altamirano@alumnos.udg.mx', 1, 'Ismael', 'Dan12345'),
('A215861266', 'SOFÍA', 'ROBLES ', 'SANDOVAL', 'sofia.robles@alumnos.udg.mx', 2, 'Dodo', 'skadlsks'),
('A215861495', 'ALAN', 'UGALDE', 'BRAVO', 'alan.ugalde@alumnos.udg.mx', 1, 'Paulina Romero', 'Saitamasama'),
('A215861576', 'OSCAR OMAR', 'RODRÍGUEZ', 'GONZÁLEZ', 'oscar.rodriguez@alumnos.udg.mx', 1, 'Alex', 'gonzalezdos'),
('A215861584', 'PABLO ', 'RIVERA ', 'CHÁVEZ', 'pablo.rivera@alumnos.udg.mx', 1, 'Alan Ugalde', 'soledad98'),
('A215861614', 'SARAHI ESMERALDA', 'RODRIGUEZ', 'MUÑOZ', 'sarahi.rodriguex@alumnsa.udg.mx', 1, 'Silvia Andrea', 'elchino27@'),
('A215861738', 'CRISTIAN MICHELL', 'CASTILLO', 'SERRANO', 'cristian.castillo1@alumnos.udg.mx', 1, 'SEBASTIAN', 'cris0789'),
('A215861739', 'CRISTIAN MICHELL', 'CASTILLO', 'SERRANO', 'articuno0789@yahoo.com.mx', 1, 'Sebastian', '123456789'),
('A215861819', 'KARINA REBECA', 'ROMO', 'FLORES', 'karina.romo@alumnos.udg.mx', 3, 'Ellen Page', 'karinita67'),
('A215861932', 'RICARDO', 'GUTIÉRREZ', 'BARBA', 'ricardo.gutierrex@alumnos.udg.mx', 2, 'Luffy', 'welcome2'),
('A216307114', 'LUIS FERNANDO', 'ILLAN', 'MARTÍNEZ', 'luis.illan@alumnos.udg.mx', 3, 'Dwayne Johnson', 'ady654322');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuncio`
--

DROP TABLE IF EXISTS `anuncio`;
CREATE TABLE IF NOT EXISTS `anuncio` (
  `idAnuncio` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `contenido` longtext NOT NULL,
  `fechaPublicacion` date NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `ProfesorUsuario_codigoProfesor` varchar(15) NOT NULL,
  `Clase_claveAcceso` varchar(10) NOT NULL,
  PRIMARY KEY (`idAnuncio`),
  KEY `fk_Anuncio_ProfesorUsuario1_idx` (`ProfesorUsuario_codigoProfesor`),
  KEY `fk_Anuncio_Clase1_idx` (`Clase_claveAcceso`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `anuncio`
--

INSERT INTO `anuncio` (`idAnuncio`, `titulo`, `contenido`, `fechaPublicacion`, `eliminado`, `ProfesorUsuario_codigoProfesor`, `Clase_claveAcceso`) VALUES
(1, 'Prueba de crear anuncio desde admin', 'ajsjksdakj', '2019-10-06', 0, 'M215861738', 'OVJbNQVUtN'),
(2, 'Bienvenidos al curso', 'Bienvenidos Alumnos:\nMediante esta plataforma estaremos trabajando lo que resta del semestre en curso.\nPor este medio recordarles que la evaluación es:\nPrácticas - 70%, Tareas 10%, Proyectos 20%\n\nLas actividades se deben entregar en la presente plataforma en la fecha especificada, en caso de que las tareas no sean entregadas a tiempo estas serán calificadas automáticamente con 0.\n\nCabe recordar que para tener derecho a ordinario es necesario contar con el 80% de las asistencias del semestre.\n\nles dejo mi correo para cualquier cuestión:\nangel.gutierrez@profesores.udg.mx', '2019-09-29', 0, 'P2425836', 'dAurieaPOg'),
(3, 'Bienvenidos', 'Bienvenidos Alumnos: Mediante esta plataforma estaremos trabajando lo que resta del semestre en curso. Por este medio recordarles que la evaluación es: Examenes (3) - 60%, Tareas 10%, Proyectos 20%, Actividades de clase 10%. Las actividades se deben entregar en la presente plataforma en la fecha especificada, en caso de que las tareas no sean entregadas a tiempo estas serán calificadas automáticamente con 0. Cabe recordar que para tener derecho a ordinario es necesario contar con el 80% de las asistencias del semestre. les dejo mi correo para cualquier cuestión: angel.gutierrez@profesores.udg.mx ', '2019-10-01', 0, 'P2425836', 'MCbFfm2YEA'),
(4, 'Bienvenidos al curso', 'Bienvenidos Alumnos:\nMediante esta plataforma estaremos trabajando lo que resta del semestre en curso.\nPor este medio recordarles que la evaluación es:\nExamenes (3) - 60%, Tareas 10%, Proyectos 20%, Actividades de clase 10%.\n\nLas actividades se deben entregar en la presente plataforma en la fecha especificada, en caso de que las tareas no sean entregadas a tiempo estas serán calificadas automáticamente con 0.\n\nCabe recordar que para tener derecho a ordinario es necesario contar con el 80% de las asistencias del semestre.\n\nles dejo mi correo para cualquier cuestión:\nangel.gutierrez@profesores.udg.mx\n', '2019-09-29', 0, 'P2425836', 'wfcC7PiByF'),
(5, 'Práctica #1', 'Nueva práctica - Encendido simple actuadores.\nPrimera práctica para verificar funcionamiento del simulador.', '2019-10-13', 0, 'P2425836', 'dAurieaPOg'),
(6, 'Práctica #2', 'Nueva práctica - Encendido múltiple actuadores.\nPrimera práctica para verificar funcionamiento del simulador.', '2019-10-15', 0, 'P2425836', 'dAurieaPOg'),
(7, 'Práctica #3', 'Nueva práctica - Control temporizado de motor trifásico de 220v y dos devanados (Temporizador ondelay). Primera práctica para verificar funcionamiento del simulador. \n', '2019-10-17', 0, 'P2425836', 'dAurieaPOg'),
(8, 'Práctica #4', 'Nueva práctica - Control temporizado de motor trifásico de 220v y dos devanados (Temporizador offdelay). Primera práctica para verificar funcionamiento del simulador. ', '2019-10-24', 0, 'P2425836', 'dAurieaPOg'),
(9, 'Práctica #5', 'Nueva práctica - Potenciometro de resistencia variable. Primera práctica para verificar funcionamiento del simulador. ', '2019-11-01', 0, 'P2425836', 'dAurieaPOg'),
(10, 'Práctica #6', 'Nueva práctica - Bobina de cambio de estado', '2019-11-07', 0, 'P2425836', 'dAurieaPOg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cicloescolar`
--

DROP TABLE IF EXISTS `cicloescolar`;
CREATE TABLE IF NOT EXISTS `cicloescolar` (
  `idCicloEscolar` int(11) NOT NULL AUTO_INCREMENT,
  `ciclo` varchar(10) NOT NULL,
  PRIMARY KEY (`idCicloEscolar`),
  UNIQUE KEY `ciclo_UNIQUE` (`ciclo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cicloescolar`
--

INSERT INTO `cicloescolar` (`idCicloEscolar`, `ciclo`) VALUES
(1, 'A'),
(2, 'B'),
(3, 'V');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

DROP TABLE IF EXISTS `clase`;
CREATE TABLE IF NOT EXISTS `clase` (
  `claveAcceso` varchar(10) NOT NULL,
  `nombreMateria` varchar(80) NOT NULL,
  `nrc` int(11) NOT NULL,
  `claveSeccion` varchar(3) NOT NULL DEFAULT 'D01',
  `nombreClase` varchar(80) NOT NULL,
  `aula` varchar(45) NOT NULL,
  `anio` varchar(4) NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `eliminadoPor` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NOT NULL,
  `updatedAt` timestamp NOT NULL,
  `CicloEscolar_idCicloEscolar` int(11) NOT NULL,
  `ProfesorUsuario_codigoProfesor` varchar(15) NOT NULL,
  PRIMARY KEY (`claveAcceso`),
  UNIQUE KEY `claveAcceso_UNIQUE` (`claveAcceso`),
  KEY `fk_Clase_ProfesorUsuario1_idx` (`ProfesorUsuario_codigoProfesor`),
  KEY `fk_Clase_CicloEscolar1_idx` (`CicloEscolar_idCicloEscolar`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`claveAcceso`, `nombreMateria`, `nrc`, `claveSeccion`, `nombreClase`, `aula`, `anio`, `eliminado`, `eliminadoPor`, `createdAt`, `updatedAt`, `CicloEscolar_idCicloEscolar`, `ProfesorUsuario_codigoProfesor`) VALUES
('1nROSIhUUx', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL	', 126184, 'D08', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL / JUEVES 15:00-16:55', 'DEDS', '2019', 0, '', '2019-10-14 00:54:02', '2019-10-14 00:54:02', 2, 'P2525692'),
('4V2nEd0oe9', 'SISTEMAS DE CONTROL SECUENCIAL	', 165439, 'D05', 'CONTROL SENCUENCIAL VIERNES 9:00-12:55', 'DEDQ-A019', '2019', 0, '', '2019-10-14 00:46:56', '2019-10-14 00:46:56', 2, 'P2739689'),
('9jsjqBLtcI', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL	D', 163881, 'D11', 'LAB SECUENCIAL SABADOS 13-15', 'DEDS', '2019', 0, '', '2019-10-14 00:59:25', '2019-10-14 00:59:25', 2, 'P2945549'),
('CtadXJdQdz', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL', 126181, 'D05', 'LAB. CONTROL SECUENCIAL L 15-17', 'DEDS', '2019', 0, '', '2019-10-14 00:55:28', '2019-10-14 00:55:28', 2, 'P2625980'),
('D6C35fNHlv', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL', 126183, 'D07', 'LAB. CONTROL SECUENCIAL I 15-17', 'DEDS', '2019', 0, '', '2019-10-14 00:56:00', '2019-10-14 00:56:00', 2, 'P2625980'),
('dAurieaPOg', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL', 126179, 'D03', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL J 13-15', 'DEDS', '2019', 0, '', '2019-10-14 00:42:57', '2019-10-14 00:42:57', 2, 'P2425836'),
('Iz4KPIjMSu', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL	', 163880, 'D10', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL - J 19_21', 'DEDS', '2019', 0, '', '2019-10-14 00:58:08', '2019-10-14 00:58:08', 2, 'P2817999'),
('K3DeF4IC1S', 'SISTEMAS DE CONTROL SECUENCIAL	', 126161, 'D04', 'SISTEMAS SECUENCIAL VIERNES', 'DEDP/A011', '2019', 0, '', '2019-10-14 00:48:44', '2019-10-14 00:48:44', 2, 'P2568699'),
('kpGdq9iYKm', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL', 126178, 'D02', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL / MARTES 15:00-16:55', 'DEDS', '2019', 0, '', '2019-10-14 00:51:38', '2019-10-14 00:51:38', 2, 'P2525692'),
('MCbFfm2YEA', 'SISTEMAS DE CONTROL SECUENCIAL', 126159, 'D02', 'SISTEMAS DE CONTROL SECUENCIAL MJ 9-11, 9-10', 'A010', '2019', 1, 'MARCO ANGEL GUTIERREZ CASTRO', '2019-10-14 00:38:10', '2019-10-14 03:38:14', 2, 'P2425836'),
('nfA20el7fo', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL', 126180, 'D04', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL / VIERNES 13:00-14:55', 'DEDS', '2019', 0, '', '2019-10-14 00:52:33', '2019-10-14 00:52:33', 2, 'P2525692'),
('oN25edeSp5', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL', 126182, 'D06', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL / VIERNES 11:00-12:55', 'DEDS', '2019', 0, '', '2019-10-14 00:53:23', '2019-10-14 00:53:23', 2, 'P2525692'),
('OVJbNQVUtN', 'SISTEMAS DE CONTROL SECUENCIAL', 12345, 'D01', 'LABORATORIO DE CONTROL', 'S01', '2019', 0, '', '2019-09-24 10:09:54', '2019-09-24 10:09:54', 2, 'M215862742'),
('Pm3vj8FQiI', 'SISTEMAS DE CONTROL SECUENCIAL	', 126158, 'D01', 'CONTROL SECUENCIAL MAR/JUE 15:00-16:55', 'A009', '2019', 0, '', '2019-10-14 00:44:51', '2019-10-14 00:44:51', 2, 'P2739689'),
('ttnNvdvcqP', 'CONTROL SECUENCIAL', 46259, 'd01', 'LABORATORIO', 'x25', '2019', 0, 'PROFESOR DE PRUEBA PRUEBA PRUEBA', '2019-10-07 03:46:47', '2019-10-07 03:47:24', 2, 'P123456789'),
('uyXnfA2N3Y', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL', 163880, 'D10', 'LABORATORIO DE SISTEMAS DE CONTROL SECUENCIAL - I 19_21', 'DEDS', '2019', 0, '', '2019-10-14 00:57:33', '2019-10-14 00:57:33', 2, 'P2817999'),
('wfcC7PiByF', 'SISTEMAS DE CONTROL SECUENCIAL', 126160, 'D03', 'SISTEMAS DE CONTROL SECUENCIAL MJ 11-13,11-12', 'A011', '2019', 0, '', '2019-10-14 00:41:42', '2019-10-14 00:41:42', 2, 'P2425836');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase_has_alumnousuario`
--

DROP TABLE IF EXISTS `clase_has_alumnousuario`;
CREATE TABLE IF NOT EXISTS `clase_has_alumnousuario` (
  `Clase_claveAcceso` varchar(10) NOT NULL,
  `AlumnoUsuario_codigoAlumno` varchar(15) NOT NULL,
  `matriculado` tinyint(4) NOT NULL,
  `permiso` tinyint(4) NOT NULL DEFAULT '0',
  `createdAt` timestamp NOT NULL,
  `updatedAt` timestamp NOT NULL,
  PRIMARY KEY (`Clase_claveAcceso`,`AlumnoUsuario_codigoAlumno`),
  KEY `fk_Clase_has_AlumnoUsuario_AlumnoUsuario1_idx` (`AlumnoUsuario_codigoAlumno`),
  KEY `fk_Clase_has_AlumnoUsuario_Clase1_idx` (`Clase_claveAcceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `clase_has_alumnousuario`
--

INSERT INTO `clase_has_alumnousuario` (`Clase_claveAcceso`, `AlumnoUsuario_codigoAlumno`, `matriculado`, `permiso`, `createdAt`, `updatedAt`) VALUES
('dAurieaPOg', 'A208631778', 1, 1, '2019-10-14 03:05:28', '2019-10-14 03:05:28'),
('dAurieaPOg', 'A210582822', 1, 1, '2019-10-14 03:07:07', '2019-10-14 03:07:07'),
('dAurieaPOg', 'A210627923', 1, 1, '2019-10-14 03:08:14', '2019-10-14 03:08:14'),
('dAurieaPOg', 'A211561217', 1, 1, '2019-10-14 03:17:48', '2019-10-14 03:17:48'),
('dAurieaPOg', 'A211576109', 1, 1, '2019-10-14 03:16:55', '2019-10-14 03:16:55'),
('dAurieaPOg', 'A211584799', 1, 1, '2019-10-14 03:16:18', '2019-10-14 03:16:18'),
('dAurieaPOg', 'A211599788', 1, 1, '2019-10-14 03:15:32', '2019-10-14 03:15:32'),
('dAurieaPOg', 'A211614256', 1, 1, '2019-10-14 03:14:55', '2019-10-14 03:14:55'),
('dAurieaPOg', 'A211671373', 1, 1, '2019-10-14 03:13:00', '2019-10-14 03:13:00'),
('dAurieaPOg', 'A211677193', 1, 1, '2019-10-14 03:12:08', '2019-10-14 03:12:08'),
('dAurieaPOg', 'A211677649', 1, 1, '2019-10-14 03:11:01', '2019-10-14 03:11:01'),
('dAurieaPOg', 'A211735592', 1, 0, '2019-10-14 03:18:41', '2019-10-14 03:18:41'),
('dAurieaPOg', 'A212092423', 1, 1, '2019-10-14 03:19:57', '2019-10-14 03:19:57'),
('dAurieaPOg', 'A212137826', 1, 0, '2019-10-14 03:20:27', '2019-10-14 03:20:27'),
('dAurieaPOg', 'A212395515', 1, 0, '2019-10-14 03:21:12', '2019-10-14 03:21:12'),
('dAurieaPOg', 'A212449275', 1, 0, '2019-10-14 03:21:49', '2019-10-14 03:21:49'),
('dAurieaPOg', 'A215861739', 1, 1, '2019-10-14 03:37:49', '2019-10-14 03:37:49'),
('Pm3vj8FQiI', 'A212637128', 1, 0, '2019-10-14 03:28:05', '2019-10-14 03:28:05'),
('Pm3vj8FQiI', 'A212644639', 1, 0, '2019-10-14 03:28:35', '2019-10-14 03:28:35'),
('Pm3vj8FQiI', 'A212679955', 1, 0, '2019-10-14 03:29:03', '2019-10-14 03:29:03'),
('Pm3vj8FQiI', 'A212699573', 1, 0, '2019-10-14 03:29:33', '2019-10-14 03:29:33'),
('Pm3vj8FQiI', 'A212730756', 1, 0, '2019-10-14 03:30:00', '2019-10-14 03:30:00'),
('Pm3vj8FQiI', 'A213496692', 1, 0, '2019-10-14 03:30:25', '2019-10-14 03:30:25'),
('Pm3vj8FQiI', 'A214289593', 1, 0, '2019-10-14 03:30:49', '2019-10-14 03:30:49'),
('Pm3vj8FQiI', 'A214519521', 1, 0, '2019-10-14 03:31:17', '2019-10-14 03:31:17'),
('Pm3vj8FQiI', 'A214519548', 1, 0, '2019-10-14 03:32:08', '2019-10-14 03:32:08'),
('Pm3vj8FQiI', 'A214519629', 1, 0, '2019-10-14 03:32:42', '2019-10-14 03:32:42'),
('ttnNvdvcqP', 'A123456789', 1, 1, '2019-10-13 09:51:54', '2019-10-13 09:51:54'),
('wfcC7PiByF', 'A208631778', 1, 1, '2019-10-14 03:05:43', '2019-10-14 03:05:43'),
('wfcC7PiByF', 'A210543673', 1, 1, '2019-10-14 03:06:26', '2019-10-14 03:06:26'),
('wfcC7PiByF', 'A210582822', 1, 1, '2019-10-14 03:06:58', '2019-10-14 03:06:58'),
('wfcC7PiByF', 'A210627923', 1, 1, '2019-10-14 03:08:04', '2019-10-14 03:08:04'),
('wfcC7PiByF', 'A210640474', 1, 1, '2019-10-14 03:08:47', '2019-10-14 03:08:47'),
('wfcC7PiByF', 'A210705169', 1, 1, '2019-10-14 03:09:22', '2019-10-14 03:09:22'),
('wfcC7PiByF', 'A211561217', 1, 1, '2019-10-14 03:17:39', '2019-10-14 03:17:39'),
('wfcC7PiByF', 'A211576109', 1, 1, '2019-10-14 03:17:03', '2019-10-14 03:17:03'),
('wfcC7PiByF', 'A211584799', 1, 1, '2019-10-14 03:16:08', '2019-10-14 03:16:08'),
('wfcC7PiByF', 'A211668542', 1, 1, '2019-10-14 03:13:46', '2019-10-14 03:13:46'),
('wfcC7PiByF', 'A211671373', 1, 1, '2019-10-14 03:13:09', '2019-10-14 03:13:09'),
('wfcC7PiByF', 'A211677193', 1, 1, '2019-10-14 03:11:49', '2019-10-14 03:11:49'),
('wfcC7PiByF', 'A211677649', 1, 1, '2019-10-14 03:10:51', '2019-10-14 03:10:51'),
('wfcC7PiByF', 'A211688756', 1, 1, '2019-10-14 03:10:17', '2019-10-14 03:10:17'),
('wfcC7PiByF', 'A211735592', 1, 1, '2019-10-14 03:18:49', '2019-10-14 03:18:49'),
('wfcC7PiByF', 'A212092423', 1, 1, '2019-10-14 03:19:48', '2019-10-14 03:19:48'),
('wfcC7PiByF', 'A212137826', 1, 1, '2019-10-14 03:20:40', '2019-10-14 03:20:40'),
('wfcC7PiByF', 'A212395515', 1, 1, '2019-10-14 03:21:03', '2019-10-14 03:21:03'),
('wfcC7PiByF', 'A212449275', 1, 1, '2019-10-14 03:21:59', '2019-10-14 03:21:59'),
('wfcC7PiByF', 'A212493738', 1, 1, '2019-10-14 03:22:28', '2019-10-14 03:22:28'),
('wfcC7PiByF', 'A212517475', 1, 1, '2019-10-14 03:23:07', '2019-10-14 03:23:07'),
('wfcC7PiByF', 'A212533594', 1, 1, '2019-10-14 03:23:35', '2019-10-14 03:23:35'),
('wfcC7PiByF', 'A212548834', 1, 1, '2019-10-14 03:24:41', '2019-10-14 03:24:41'),
('wfcC7PiByF', 'A212578873', 1, 0, '2019-10-14 03:25:08', '2019-10-14 03:25:08'),
('wfcC7PiByF', 'A212585578', 1, 0, '2019-10-14 03:25:45', '2019-10-14 03:25:45'),
('wfcC7PiByF', 'A212635575', 1, 0, '2019-10-14 03:26:12', '2019-10-14 03:26:12'),
('wfcC7PiByF', 'A215861739', 1, 1, '2019-10-14 03:38:00', '2019-10-14 03:38:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

DROP TABLE IF EXISTS `comentario`;
CREATE TABLE IF NOT EXISTS `comentario` (
  `idComentario` int(11) NOT NULL AUTO_INCREMENT,
  `comentario` longtext NOT NULL,
  `Anuncio_idAnuncio` int(11) NOT NULL,
  PRIMARY KEY (`idComentario`),
  KEY `fk_Comentario_Anuncio1_idx` (`Anuncio_idAnuncio`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `comentario`, `Anuncio_idAnuncio`) VALUES
(1, 'Cristian Michell Castillo Serrano (October 6, 2019, 10:38 pm): Prueba de comentario', 1),
(2, 'MARCO ANGEL GUTIERREZ CASTRO (October 19, 2019, 12:54 am): kjskjsak', 10),
(3, 'CRISTIAN MICHELL CASTILLO SERRANO (October 19, 2019, 12:54 am): Prueba', 10),
(4, 'ROBERTO RAFAEL LAZO VILLA (October 19, 2019, 1:10 am): Podria retasar la entrega de la actividad profesor?', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuestionario`
--

DROP TABLE IF EXISTS `cuestionario`;
CREATE TABLE IF NOT EXISTS `cuestionario` (
  `idCuestionario` int(11) NOT NULL AUTO_INCREMENT,
  `respuestaPregunta1` text,
  `respuestaPregunta2` text,
  `respuestaPregunta3` text,
  `conclusion` text,
  `fechaEntrega` date DEFAULT NULL,
  `rutaArchivo` varchar(100) NOT NULL,
  `Practica_idPractica` int(10) UNSIGNED NOT NULL,
  `AlumnoUsuario_codigoAlumno` varchar(15) NOT NULL,
  `nombreClave` varchar(80) NOT NULL,
  `nombreOriginal` varchar(80) NOT NULL,
  PRIMARY KEY (`idCuestionario`),
  KEY `fk_Cuestionario_Practica1_idx` (`Practica_idPractica`),
  KEY `fk_Cuestionario_AlumnoUsuario1_idx` (`AlumnoUsuario_codigoAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `cuestionario`
--

INSERT INTO `cuestionario` (`idCuestionario`, `respuestaPregunta1`, `respuestaPregunta2`, `respuestaPregunta3`, `conclusion`, `fechaEntrega`, `rutaArchivo`, `Practica_idPractica`, `AlumnoUsuario_codigoAlumno`, `nombreClave`, `nombreOriginal`) VALUES
(1, 'no contestó', 'no contestó', 'no contestó', 'no contestó', '2019-10-13', '../../images/files/XXXX12345.jpg', 2, 'A123456789', 'XXXX12345.jpg', 'no_entrego.jpg'),
(2, 'jjkjkjk', 'jk', 'jk', 'jkjk', '2019-10-13', '../../images/files/FJ9pmRvpXL.png', 3, 'A123456789', 'FJ9pmRvpXL.png', 'Act 7 - Debian 9.x 64 bit-2019-10-09-17-00-27.png'),
(3, 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-14', '../../images/files/xygAzMAYKZ.png', 4, 'A215861739', 'xygAzMAYKZ.png', '13_10_2019 05_58_10 p. m..png'),
(4, 'EL POTENCIOMETRO ES UN DISPOSITIVO QUE SE ENCARGA POR MEDIO DE UN RESISTENCIA VARIABLE, DE REGULAR LA POTENCIA ELÉCTRICA ENTRANTE', 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico. Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. Si no se realiza de esta manera el campo se volverá inestable y el motor se puede dañar.', '2019-10-14', '../../images/files/3EH9xhbctn.png', 9, 'A215861739', '3EH9xhbctn.png', '13_10_2019 06_45_25 p. m..png'),
(5, 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-14', '../../images/files/in1QkJbK17.png', 5, 'A215861739', 'in1QkJbK17.png', '13_10_2019 06_00_43 p. m..png'),
(6, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-14', '../../images/files/eNU0qXKFaQ.png', 6, 'A215861739', 'eNU0qXKFaQ.png', '13_10_2019 06_23_11 p. m..png'),
(7, 'Las bobinas son elementos que se energizan y las cuales provocan un movimiento mecánico.', 'Mediante la energización de bobinas se puede producir un cambio de estado en los bornes de conexión. Este elemento es una alternativa ante los botones pulsadores u otros elementos mecánicos.', 'Para poder utilizar una bobina es importante conocer sus parámetros de operación. Para estar seguros de su tiempo de carga y descarga.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', '2019-10-14', '../../images/files/JA4Dp7LSnQ.png', 10, 'A215861739', 'JA4Dp7LSnQ.png', '13_10_2019 07_25_40 p. m..png'),
(8, 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-14', '../../images/files/FOttsexH7O.png', 4, 'A208631778', 'FOttsexH7O.png', '13_10_2019 05_56_25 p. m..png'),
(9, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada.', 'Este temporizador en particular tiene un rango desde 0 a 30 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-14', '../../images/files/Hmh2mzM7GJ.png', 6, 'A208631778', 'Hmh2mzM7GJ.png', '13_10_2019 06_23_44 p. m..png'),
(10, 'EL POTENCIOMETRO ES UN DISPOSITIVO QUE SE ENCARGA POR MEDIO DE UN RESISTENCIA VARIABLE, DE REGULAR LA POTENCIA ELÉCTRICA ENTRANTE', 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente ', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico. Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. Si no se realiza de esta manera el campo se volverá inestable y el motor se puede dañar.', '2019-10-14', '../../images/files/HZx6rViXBd.png', 9, 'A208631778', 'HZx6rViXBd.png', '13_10_2019 06_45_04 p. m..png'),
(11, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es desenergizada,', 'Este temporizador en particular tiene un rango desde 0 a 45 segundos.', '-----------', 'Un temporizador offdely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-14', '../../images/files/wnyDPYD8h9.png', 7, 'A208631778', 'wnyDPYD8h9.png', '13_10_2019 06_23_11 p. m..png'),
(12, 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-14', '../../images/files/RWI0XAuD04.png', 4, 'A210627923', 'RWI0XAuD04.png', '13_10_2019 06_45_25 p. m..png'),
(13, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este temporizador puede ser variado de 0.1 a 45 segundos.', '---', 'Este temporizador se puede utilizar para medir tiempo.', '2019-10-14', '../../images/files/8bvmJvx0dg.png', 7, 'A210627923', '8bvmJvx0dg.png', '13_10_2019 06_23_11 p. m..png'),
(14, 'Mediante la energización de bobinas se puede producir un cambio de estado en los bornes de conexión. Este elemento es una alternativa ante los botones pulsadores u otros elementos mecánicos.', 'Las bobinas son elementos que se energizan y las cuales provocan un movimiento mecánico.', 'Para poder utilizar una bobina es importante conocer sus parámetros de operación. Para estar seguros de su tiempo de carga y descarga.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', '2019-10-14', '../../images/files/OpKvfBMjcm.png', 10, 'A210627923', 'OpKvfBMjcm.png', '13_10_2019 07_25_40 p. m..png'),
(15, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada.', 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-14', '../../images/files/iii54dmjP6.png', 6, 'A210627923', 'iii54dmjP6.png', '13_10_2019 06_06_18 p. m..png'),
(16, 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-14', '../../images/files/AY4Z71O4GM.png', 5, 'A210627923', 'AY4Z71O4GM.png', '13_10_2019 07_25_40 p. m..png'),
(17, 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'EL POTENCIOMETRO ES UN DISPOSITIVO QUE SE ENCARGA POR MEDIO DE UN RESISTENCIA VARIABLE, DE REGULAR LA POTENCIA ELÉCTRICA ENTRANTE', 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico. Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. Si no se realiza de esta manera el campo se volverá inestable y el motor se puede dañar.', '2019-10-14', '../../images/files/MU6BLFRIxc.png', 9, 'A210627923', 'MU6BLFRIxc.png', '13_10_2019 06_45_04 p. m..png'),
(18, 'Las bobinas son elementos que se energizan y las cuales provocan un movimiento mecánico.', 'Mediante la energización de bobinas se puede producir un cambio de estado en los bornes de conexión. Este elemento es una alternativa ante los botones pulsadores u otros elementos mecánicos.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', '2019-10-14', '../../images/files/KG9qAu5NkV.png', 10, 'A211677193', 'KG9qAu5NkV.png', '13_10_2019 07_25_40 p. m..png'),
(19, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-14', '../../images/files/mQP4Zvkfcw.png', 6, 'A211677193', 'mQP4Zvkfcw.png', '13_10_2019 06_06_18 p. m..png'),
(20, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-14', '../../images/files/bkvggguhqv.png', 8, 'A211677193', 'bkvggguhqv.png', '13_10_2019 06_00_43 p. m..png'),
(21, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-14', '../../images/files/ws2AXlosih.png', 7, 'A211677193', 'ws2AXlosih.png', '13_10_2019 06_23_11 p. m..png'),
(22, 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-14', '../../images/files/y8uBgGB39H.png', 5, 'A211677193', 'y8uBgGB39H.png', '13_10_2019 06_00_43 p. m..png'),
(23, 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', '2019-10-14', '../../images/files/G1uMGjRWXk.png', 4, 'A211677193', 'G1uMGjRWXk.png', '13_10_2019 05_56_25 p. m..png'),
(24, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-14', '../../images/files/gZf71Pq4Vg.png', 6, 'A212092423', 'gZf71Pq4Vg.png', '13_10_2019 06_23_11 p. m..png'),
(25, 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-14', '../../images/files/QGChZo5TJB.png', 5, 'A212092423', 'QGChZo5TJB.png', '13_10_2019 07_25_40 p. m..png'),
(26, 'Mediante la energización de bobinas se puede producir un cambio de estado en los bornes de conexión. Este elemento es una alternativa ante los botones pulsadores u otros elementos mecánicos.', 'Las bobinas son elementos que se energizan y las cuales provocan un movimiento mecánico.', 'Para poder utilizar una bobina es importante conocer sus parámetros de operación. Para estar seguros de su tiempo de carga y descarga.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', '2019-10-14', '../../images/files/fUPkSqxlrT.png', 10, 'A212092423', 'fUPkSqxlrT.png', '13_10_2019 07_25_40 p. m..png'),
(27, 'EL POTENCIOMETRO ES UN DISPOSITIVO QUE SE ENCARGA POR MEDIO DE UN RESISTENCIA VARIABLE, DE REGULAR LA POTENCIA ELÉCTRICA ENTRANTE', 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico.', '2019-10-14', '../../images/files/MNeu3Cpos0.png', 9, 'A212092423', 'MNeu3Cpos0.png', '13_10_2019 06_45_25 p. m..png'),
(28, 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-14', '../../images/files/OTWG3YvqK4.png', 4, 'A212092423', 'OTWG3YvqK4.png', '13_10_2019 05_58_10 p. m..png'),
(29, 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-14', '../../images/files/9VpTgJ4OqJ.png', 4, 'A211599788', '9VpTgJ4OqJ.png', '13_10_2019 05_58_10 p. m..png'),
(30, 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este elemento pertenece a la sección de elementos de control.', 'De hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-14', '../../images/files/OHRU8O97fc.png', 6, 'A211599788', 'OHRU8O97fc.png', '13_10_2019 06_23_11 p. m..png'),
(31, 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'klsaklxklsaklkl', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico. Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. Si no se realiza de esta manera el campo se volverá inestable y el motor se puede dañar.', '2019-10-14', '../../images/files/mlhpOzE94r.png', 9, 'A211599788', 'mlhpOzE94r.png', '13_10_2019 06_45_25 p. m..png'),
(32, 'Mediante la energización de bobinas se puede producir un cambio de estado en los bornes de conexión. Este elemento es una alternativa ante los botones pulsadores u otros elementos mecánicos.', 'Para poder utilizar una bobina es importante conocer sus parámetros de operación. Para estar seguros de su tiempo de carga y descarga.', 'Las bobinas son elementos que se energizan y las cuales provocan un movimiento mecánico.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', '2019-10-14', '../../images/files/P4WFAaNxJI.png', 10, 'A211599788', 'P4WFAaNxJI.png', '13_10_2019 07_25_40 p. m..png'),
(33, 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-14', '../../images/files/SGwOSiDujE.png', 5, 'A211599788', 'SGwOSiDujE.png', '13_10_2019 06_00_52 p. m..png'),
(34, 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-14', '../../images/files/VsZ6i1lAdd.png', 4, 'A211614256', 'VsZ6i1lAdd.png', '02_10_2019 07_48_37 p. m..png'),
(35, 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', '2019-10-14', '../../images/files/QkV68oalkC.png', 6, 'A211614256', 'QkV68oalkC.png', '02_10_2019 07_48_37 p. m..png'),
(36, 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', '2019-10-14', '../../images/files/LJICaijHHl.png', 8, 'A211614256', 'LJICaijHHl.png', '02_10_2019 07_48_37 p. m..png'),
(37, 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', '2019-10-14', '../../images/files/W7WAnvccCp.png', 9, 'A211614256', 'W7WAnvccCp.png', '02_10_2019 07_48_37 p. m..png'),
(38, 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', '2019-10-14', '../../images/files/X6KoMLQgwz.png', 7, 'A211614256', 'X6KoMLQgwz.png', '02_10_2019 07_48_37 p. m..png'),
(39, 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', 'No creo que se revise esta actividad', '2019-10-14', '../../images/files/dbMq6iUZhw.png', 5, 'A211614256', 'dbMq6iUZhw.png', '02_10_2019 07_48_37 p. m..png'),
(40, 'No alcance a hacerlo', 'No alcance a hacerlo', 'No alcance a hacerlo', 'No alcance a hacerlo', '2019-10-14', '../../images/files/GBkNdpZrZN.png', 10, 'A211614256', 'GBkNdpZrZN.png', '13_10_2019 06_45_25 p. m..png'),
(41, 'Un offdelay ejecuta su tiempo de retardo al des energizarse.\r\n', 'Debido a que se involucran elementos de fuerza hay que utilizar 220v', 'Para esta práctica el tiempo idoneo es de 15 segundos', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-19', '../../images/files/FtikUsLzcH.png', 7, 'A215861739', 'FtikUsLzcH.png', '13_10_2019 06_23_11 p. m..png'),
(42, 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-19', '../../images/files/jqa2Q2mUKR.png', 4, 'A210582822', 'jqa2Q2mUKR.png', '13_10_2019 05_58_22 p. m..png'),
(43, 'Para esta práctica el tiempo idoneo es de 18 segundos', 'Un offdelay ejecuta su tiempo de retardo al des energizarse.\r\n', 'Debido a que se involucran elementos de fuerza hay que utilizar 220v', 'Un temporizador 0ofdely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-19', '../../images/files/tNPIO1Edlk.png', 7, 'A210582822', 'tNPIO1Edlk.png', '13_10_2019 06_06_18 p. m..png'),
(44, 'Conteste la actividad en el libro de prácticas.', 'Conteste la actividad en el libro de prácticas.', 'Conteste la actividad en el libro de prácticas.', 'Conteste la actividad en el libro de prácticas.', '2019-10-19', '../../images/files/RA1WKF7gaG.png', 8, 'A210582822', 'RA1WKF7gaG.png', '13_10_2019 06_23_11 p. m..png'),
(45, 'Este elemento pertenece a la sección de elementos de control.', 'Este temporizador en particular tiene un rango desde 5 a 45 segundos.', 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-19', '../../images/files/nHBcGxHyMG.png', 6, 'A210582822', 'nHBcGxHyMG.png', '13_10_2019 06_23_44 p. m..png'),
(46, 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-19', '../../images/files/NiUbruWvk3.png', 5, 'A211561217', 'NiUbruWvk3.png', '13_10_2019 06_03_11 p. m..png'),
(47, 'Debido a que se involucran elementos de fuerza hay que utilizar 220v', 'Un offdelay ejecuta su tiempo de retardo al des energizarse.\r\n', 'Para esta práctica el tiempo debe de ser de 10 segundos\r\n', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-19', '../../images/files/NTJtSpYd3k.png', 7, 'A211561217', 'NTJtSpYd3k.png', '13_10_2019 06_45_25 p. m..png'),
(48, 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico. Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. ', '2019-10-19', '../../images/files/WMz1xrytZb.png', 9, 'A211561217', 'WMz1xrytZb.png', '13_10_2019 06_45_25 p. m..png'),
(49, 'Para esta práctica el tiempo idoneo es de 17 segundos', 'Debido a que se involucran elementos de fuerza hay que utilizar 220v', 'Un offdelay ejecuta su tiempo de retardo al des energizarse.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-19', '../../images/files/etZO8L1jLB.png', 8, 'A211561217', 'etZO8L1jLB.png', '13_10_2019 07_21_21 p. m..png'),
(50, 'Este elemento pertenece a la sección de elementos de control.', 'Nose', 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-19', '../../images/files/MIPBqJFOUw.png', 6, 'A211561217', 'MIPBqJFOUw.png', '13_10_2019 06_23_44 p. m..png'),
(51, 'Para poder encender el foco en este caso se utilizo una linea de 127v o 220v y neutro.', 'El foco se puede dañar si se enchufan dos cables con diferentes lineas.', 'Los actuadores pueden ser tanto motores, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-19', '../../images/files/QjNxPYKTzq.png', 4, 'A211584799', 'QjNxPYKTzq.png', '13_10_2019 05_56_25 p. m..png'),
(52, 'Para poder encender el foco en este caso se utilizo una linea de 220v y neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-19', '../../images/files/D9MwxOIk15.png', 5, 'A211584799', 'D9MwxOIk15.png', '13_10_2019 06_03_07 p. m..png'),
(53, 'Debido a que se involucran elementos de fuerza hay que utilizar 220v, porque con 127 voltios no se energiza el funcionamiento del elemento.', 'Para esta práctica el tiempo idoneo es de 22 segundos', 'Un offdelay ejecuta su tiempo de retardo al des energizarse.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-19', '../../images/files/KeLG6aTcq2.png', 7, 'A211584799', 'KeLG6aTcq2.png', '13_10_2019 06_06_18 p. m..png'),
(54, 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'Ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. Si no se realiza de esta manera el campo se volverá inestable y el motor se puede dañar.', '2019-10-19', '../../images/files/F4lt1KtAch.png', 8, 'A211584799', 'F4lt1KtAch.png', '13_10_2019 06_23_44 p. m..png'),
(55, 'Este elemento pertenece a la sección de elementos de control.', 'Desde 5 a 35 segundos.', 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada.', 'De hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-19', '../../images/files/owQEoM4mPU.png', 6, 'A211584799', 'owQEoM4mPU.png', '13_10_2019 06_06_18 p. m..png'),
(56, 'Mediante la energización de bobinas se puede producir un cambio de estado en los bornes de conexión. Este elemento es una alternativa ante los botones pulsadores u otros elementos mecánicos.', 'Para poder utilizar una bobina es importante conocer sus parámetros de operación. Para estar seguros de su tiempo de carga y descarga.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', '2019-10-19', '../../images/files/4t5apnuvvl.png', 10, 'A211584799', '4t5apnuvvl.png', '13_10_2019 07_25_40 p. m..png'),
(57, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A215861739', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(59, 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-19', '../../images/files/tc5nJuFg7z.png', 4, 'A211677649', 'tc5nJuFg7z.png', '13_10_2019 05_55_59 p. m..png'),
(60, 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Este temporizador  desde 7 a 26 segundos.', 'Este elemento pertenece a la sección de elementos de control.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.', '2019-10-19', '../../images/files/kgNIgeJFmo.png', 6, 'A211677649', 'kgNIgeJFmo.png', '13_10_2019 06_06_18 p. m..png'),
(61, 'Para esta práctica el tiempo idoneo es de 17 segundos', 'Debido a que se involucran elementos de fuerza hay que utilizar 220v', 'Un offdelay ejecuta su tiempo de retardo al des energizarse.', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-19', '../../images/files/TLPMndSMLO.png', 7, 'A211677649', 'TLPMndSMLO.png', '13_10_2019 06_23_44 p. m..png'),
(62, 'Un potenciometro puede llegar a parar todo el voltaje, mientras que el voltaje no exceda los limites de paro.', 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'EL POTENCIOMETRO ES UN DISPOSITIVO QUE SE ENCARGA POR MEDIO DE UN RESISTENCIA VARIABLE, DE REGULAR LA POTENCIA ELÉCTRICA ENTRANTE', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico. Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. Si no se realiza de esta manera el campo se volverá inestable y el motor se puede dañar.', '2019-10-19', '../../images/files/fjVzHOhfDF.png', 8, 'A211677649', 'fjVzHOhfDF.png', '13_10_2019 07_21_21 p. m..png'),
(63, 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-19', '../../images/files/Ek7ACBR2tp.png', 5, 'A211677649', 'Ek7ACBR2tp.png', '13_10_2019 06_03_11 p. m..png'),
(65, 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro.', 'Si se colocan dos lineas diferentes, el foco al tener polaridad, se quema.', 'Los actuadores pueden ser tanto focos, motores, temporizadores, elementos mecanicos, etc.', 'Por medio de esta práctica he podido aprender como es que se utiliza el simulador y las bases del control secuencial', '2019-10-19', '../../images/files/AY7szQoqbV.png', 4, 'A211576109', 'AY7szQoqbV.png', '02_10_2019 07_48_37 p. m..png'),
(66, 'El módulo 3 del simulador en este caso funciona para poder invertir la polaridad de las puertas dentro de los bornes de conexión para cerrar las puertas abiertas y abrir las puertas cerradas.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Para poder encender el foco en este caso se utilizo una linea de 127v y un cable neutro. Esta práctica es similar a la práctica uno, con la diferencia de que con un solo elemento se pueden controlar múltiples acecines.', 'Con esta práctica pudimos observar como es que se puede cambiar el estado de un componente por medio de una acción mecánica.', '2019-10-19', '../../images/files/DmEzXtYV7U.png', 5, 'A211576109', 'DmEzXtYV7U.png', '13_10_2019 06_00_43 p. m..png'),
(67, 'Este elemento pertenece a la sección de elementos de control.', 'Este temporizador en particular tiene un rnago desde 0 a 30 segundos.', 'Estos son temporizadores que inicial su conteo o retardo de tiempo para hacer cambiar sus contactos en el mismo instante en que su bobina es energizada,', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.\r\n', '2019-10-19', '../../images/files/zXM8EL4axf.png', 6, 'A211576109', 'zXM8EL4axf.png', '13_10_2019 06_00_43 p. m..png'),
(68, 'Un offdelay ejecuta su tiempo de retardo al des energizarse.\r\n', 'Debido a que se involucran elementos de fuerza hay que utilizar 220v', 'Para esta práctica el tiempo idoneo es de 15 segundos', 'Un temporizador ondely es un elemento indispensable en los circuitos de control secuencial, ya que este nos permite realizar cambios graduales, con el fin de evitar cambios abruptos, que puedan producir fallas y averías.\r\nDe hecho estos temporizadores son muy útiles cuando como medida de protección para los motores trifásicos.', '2019-10-19', '../../images/files/hBXLiM0uS9.png', 7, 'A211576109', 'hBXLiM0uS9.png', '13_10_2019 06_23_11 p. m..png'),
(69, 'El potenciometro se dice que es una resistencia variable, ya que al girar su perilla se varia la cantidad de corriente y voltaje eléctrico que se permite pasar.', 'Nose', 'Nose', 'Por medio de esta práctica pude comprender como se puede utilizar una resistencia variable para poder regular la velocidad de giro de un motor trifásico. Hay que destacar que para evitar averías en el motor es necesario que se altera al mismo tiempo el campo electromagnético rotatorio del motor. Si no se realiza de esta manera el campo se volverá inestable y el motor se puede dañar.', '2019-10-19', '../../images/files/V8qeTOaWTS.png', 9, 'A211576109', 'V8qeTOaWTS.png', '13_10_2019 06_45_04 p. m..png'),
(70, 'Las bobinas son elementos que se energizan y las cuales provocan un movimiento mecánico.', 'Para poder utilizar una bobina es importante conocer sus parámetros de operación. Para estar seguros de su tiempo de carga y descarga.', 'Mediante la energización de bobinas se puede producir un cambio de estado en los bornes de conexión. Este elemento es una alternativa ante los botones pulsadores u otros elementos mecánicos.', 'Con esta práctica puede concluir que existen muchos tipos de elementos lógicos que pueden sustituir a los elementos mecánicos tradicionales. Estos elementos en particular tienen la ventaja de que tienen un mayor tiempo de vida que los mecánicos y que en general son más fiables.', '2019-10-19', '../../images/files/t7c5bnBAD1.png', 10, 'A211576109', 't7c5bnBAD1.png', '13_10_2019 07_25_40 p. m..png'),
(71, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A208631778', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(72, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A211668542', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(73, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A211735592', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(74, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A212517475', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(75, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A210543673', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(76, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A210705169', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(77, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A212493738', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(78, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A211677193', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(79, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A211671373', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(80, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A211688756', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg'),
(81, 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', 'Evaluación difusa', '2019-10-19', '../../images/files/XXXX67890.jpg', 12, 'A210627923', 'XXXX67890.jpg', 'evaluacion_difusa_clase.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluacion`
--

DROP TABLE IF EXISTS `evaluacion`;
CREATE TABLE IF NOT EXISTS `evaluacion` (
  `idEvaluacion` int(11) NOT NULL AUTO_INCREMENT,
  `califiacion` int(11) NOT NULL,
  `Cuestionario_idCuestionario` int(11) NOT NULL,
  PRIMARY KEY (`idEvaluacion`),
  KEY `fk_Evaluacion_Cuestionario1_idx` (`Cuestionario_idCuestionario`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evaluacion`
--

INSERT INTO `evaluacion` (`idEvaluacion`, `califiacion`, `Cuestionario_idCuestionario`) VALUES
(1, 0, 1),
(2, 75, 2),
(3, 100, 3),
(4, 95, 4),
(5, 65, 6),
(6, 85, 9),
(7, 75, 11),
(8, 92, 8),
(9, 77, 13),
(10, 90, 16),
(11, 84, 12),
(12, 91, 14),
(13, 45, 17),
(14, 10, 15),
(15, 90, 20),
(16, 87, 21),
(17, 100, 23),
(18, 99, 22),
(19, 68, 18),
(20, 78, 19),
(21, 83, 25),
(22, 100, 24),
(23, 79, 26),
(24, 87, 27),
(25, 93, 28),
(26, 99, 29),
(27, 100, 30),
(28, 96, 31),
(29, 94, 32),
(30, 100, 33),
(31, 0, 40),
(32, 0, 39),
(33, 50, 38),
(34, 0, 37),
(35, 15, 36),
(36, 10, 35),
(37, 2, 34),
(38, 100, 57),
(39, 95, 42),
(40, 90, 43),
(41, 89, 44),
(42, 100, 45),
(43, 100, 46),
(44, 96, 47),
(45, 85, 49),
(46, 92, 48),
(47, 93, 50),
(48, 70, 51),
(49, 85, 52),
(50, 77, 53),
(51, 90, 54),
(52, 90, 55),
(53, 88, 56),
(54, 60, 60),
(55, 0, 59),
(56, 85, 62),
(57, 95, 61),
(58, 100, 63),
(59, 95, 41),
(60, 75, 10),
(61, 85, 65),
(62, 67, 67),
(63, 95, 66),
(64, 95, 68),
(65, 40, 69),
(66, 55, 70),
(67, 95, 5),
(68, 100, 71),
(69, 100, 72),
(70, 100, 73),
(71, 100, 74),
(72, 100, 75),
(73, 100, 76),
(74, 100, 77),
(75, 100, 78),
(76, 100, 79),
(77, 100, 80),
(78, 100, 81);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evaluaciondifusa`
--

DROP TABLE IF EXISTS `evaluaciondifusa`;
CREATE TABLE IF NOT EXISTS `evaluaciondifusa` (
  `idEvaluacionDifusa` int(11) NOT NULL AUTO_INCREMENT,
  `Practica_idPractica` int(10) UNSIGNED NOT NULL,
  `AlumnoUsuario_codigoAlumno` varchar(15) NOT NULL,
  `dificulSimuNitido` int(11) NOT NULL,
  `dificulSimuDifuso` varchar(20) NOT NULL,
  `apoyoSimuNitido` int(11) NOT NULL,
  `apoyoSimuDifuso` varchar(20) NOT NULL,
  `CalMatApoNitido` int(11) NOT NULL,
  `CalMatApoDifuso` varchar(20) NOT NULL,
  `ClarMatApoNitido` int(11) NOT NULL,
  `ClarMatApoDifuso` varchar(20) NOT NULL,
  `CantMatApoNitido` int(11) NOT NULL,
  `CantMatApoDifuso` varchar(20) NOT NULL,
  `CalContNitido` int(11) NOT NULL,
  `CalContDifuso` varchar(20) NOT NULL,
  `ClarContNitido` int(11) NOT NULL,
  `ClarContDifuso` varchar(20) NOT NULL,
  `CantContNitido` int(11) NOT NULL,
  `CantContDifuso` varchar(20) NOT NULL,
  `nivelAprendizajeNitido` int(11) NOT NULL,
  `nivelAprendizajeDifuso` varchar(20) NOT NULL,
  `calificacionClaseNitido` int(11) NOT NULL,
  `calificacionClaseDifuso` varchar(20) NOT NULL,
  `calificacion` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idEvaluacionDifusa`),
  KEY `fk_EvaluacionDifusa_Practica1_idx` (`Practica_idPractica`),
  KEY `fk_EvaluacionDifusa_AlumnoUsuario1_idx` (`AlumnoUsuario_codigoAlumno`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `evaluaciondifusa`
--

INSERT INTO `evaluaciondifusa` (`idEvaluacionDifusa`, `Practica_idPractica`, `AlumnoUsuario_codigoAlumno`, `dificulSimuNitido`, `dificulSimuDifuso`, `apoyoSimuNitido`, `apoyoSimuDifuso`, `CalMatApoNitido`, `CalMatApoDifuso`, `ClarMatApoNitido`, `ClarMatApoDifuso`, `CantMatApoNitido`, `CantMatApoDifuso`, `CalContNitido`, `CalContDifuso`, `ClarContNitido`, `ClarContDifuso`, `CantContNitido`, `CantContDifuso`, `nivelAprendizajeNitido`, `nivelAprendizajeDifuso`, `calificacionClaseNitido`, `calificacionClaseDifuso`, `calificacion`) VALUES
(1, 12, 'A215861739', 36, 'Dificil', 14, 'Mala', 75, 'Buena', 90, 'MuyClaro', 44, 'Poco', 50, 'MuyClaro', 77, 'MuyClaro', 94, 'Demasiado', 81, 'Buena', 40, 'Buena', 100),
(2, 12, 'A211677649', 95, 'MuyFacil', 64, 'Promedio', 90, 'Buena', 63, 'Claro', 85, 'Mucho', 91, 'Claro', 85, 'MuyClaro', 69, 'Suficiente', 100, 'Excelente', 50, 'Excelente', 100),
(3, 12, 'A211576109', 100, 'MuyFacil', 73, 'Buena', 63, 'Promedio', 83, 'MuyClaro', 36, 'Poco', 94, 'MuyClaro', 17, 'NadaClaro', 83, 'Mucho', 80, 'Buena', 62, 'Excelente', 100),
(4, 12, 'A208631778', 78, 'Facil', 64, 'Promedio', 67, 'Promedio', 45, 'PocoClaro', 26, 'MuyPoco', 67, 'PocoClaro', 54, 'Claro', 35, 'Poco', 20, 'Deficiente', 11, 'Insuficiente', 100),
(5, 12, 'A211668542', 19, 'MuyDificil', 27, 'Insuficiente', 95, 'Excelente', 50, 'PocoClaro', 76, 'Mucho', 21, 'PocoClaro', 80, 'MuyClaro', 69, 'Suficiente', 55, 'Promedio', 11, 'Insuficiente', 100),
(6, 12, 'A211735592', 50, 'Dificil', 50, 'Insuficiente', 50, 'Insuficiente', 50, 'PocoClaro', 50, 'Poco', 50, 'PocoClaro', 50, 'PocoClaro', 50, 'Poco', 50, 'Insuficiente', 10, 'Deficiente', 100),
(7, 12, 'A212517475', 37, 'Dificil', 88, 'Buena', 81, 'Buena', 73, 'MuyClaro', 100, 'Demasiado', 75, 'MuyClaro', 65, 'Claro', 97, 'Demasiado', 76, 'Buena', 52, 'Buena', 100),
(8, 12, 'A210543673', 82, 'Facil', 81, 'Buena', 73, 'Buena', 72, 'MuyClaro', 26, 'MuyPoco', 55, 'MuyClaro', 49, 'PocoClaro', 84, 'Mucho', 21, 'Deficiente', 16, 'Promedio', 100),
(9, 12, 'A210705169', -1, 'MuyDificil', 76, 'Buena', 77, 'Buena', 95, 'Clarisimo', 76, 'Mucho', 73, 'Clarisimo', 22, 'NadaClaro', 88, 'Mucho', 62, 'Promedio', 25, 'Promedio', 100),
(10, 12, 'A212493738', 35, 'Dificil', 56, 'Promedio', 86, 'Buena', 66, 'Claro', 80, 'Mucho', 74, 'Claro', 60, 'Claro', 69, 'Suficiente', 37, 'Insuficiente', 23, 'Insuficiente', 100),
(11, 12, 'A211677193', 50, 'Dificil', 50, 'Insuficiente', 50, 'Insuficiente', 50, 'PocoClaro', 50, 'Poco', 50, 'PocoClaro', 50, 'PocoClaro', 50, 'Poco', 50, 'Insuficiente', 10, 'Deficiente', 100),
(12, 12, 'A211671373', 95, 'MuyFacil', 99, 'Excelente', 100, 'Excelente', 100, 'Clarisimo', 97, 'Demasiado', 98, 'Clarisimo', 94, 'Clarisimo', 95, 'Demasiado', 98, 'Excelente', 79, 'Excelente', 100),
(13, 12, 'A211688756', 97, 'MuyFacil', 83, 'Buena', 95, 'Excelente', 90, 'MuyClaro', 100, 'Demasiado', 98, 'MuyClaro', 98, 'Clarisimo', 89, 'Mucho', 100, 'Excelente', 50, 'Excelente', 100),
(14, 12, 'A210627923', 50, 'Dificil', 50, 'Insuficiente', 19, 'Mala', 50, 'PocoClaro', 28, 'Poco', 50, 'PocoClaro', 50, 'PocoClaro', 20, 'MuyPoco', 20, 'Deficiente', 7, 'Deficiente', 100);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practica`
--

DROP TABLE IF EXISTS `practica`;
CREATE TABLE IF NOT EXISTS `practica` (
  `idPractica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` longtext NOT NULL,
  `fechaLimite` date NOT NULL,
  `eliminado` tinyint(4) NOT NULL DEFAULT '0',
  `Clase_claveAcceso` varchar(10) NOT NULL,
  PRIMARY KEY (`idPractica`),
  KEY `fk_Practica_Clase1_idx` (`Clase_claveAcceso`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `practica`
--

INSERT INTO `practica` (`idPractica`, `nombre`, `descripcion`, `fechaLimite`, `eliminado`, `Clase_claveAcceso`) VALUES
(1, 'Potenciometro vairables', 'Crear un circuito de logica y fuerza para crear un moviemitno zig zag de un motor trifasico de dos debanados de 220v.', '2019-10-31', 0, 'OVJbNQVUtN'),
(2, 'Practica de prueba #3', 'asklsdkl', '2019-10-14', 1, 'ttnNvdvcqP'),
(3, 'nnmnm', 'nnm', '2019-10-15', 0, 'ttnNvdvcqP'),
(4, 'Encendido simple actuadores', 'Por medio del simulador de control secuencial el alumno deberá realizar el circuito de lógica y fuerza necesario para poder prender y apagar un foco, mediante un botón de encendido y apagado de tres bornes de conexión.', '2019-10-19', 0, 'dAurieaPOg'),
(5, 'Encendido múltiple actuadores.', 'Por medio del simulador de control secuencial el alumno deberá realizar el circuito de lógica y fuerza necesario para poder prender y apagar tres foco. Mediante esta práctica se deberá utilizar el módulo 3 del simulador, para realizar la inversión de estado de los bornes de conexión, mediante una corriente de 220v. ', '2019-10-21', 0, 'dAurieaPOg'),
(6, 'Control temporizado de motor trifásico de 220v y dos devanados (Temporizador ondelay)', 'Por medio del simulador de control secuencial el alumno deberá realizar el circuito de lógica y fuerza necesario para poder encender a su máxima velocidad un motor de 220v y dos devanados, durante 15 segundos, después de ese tiempo el motor se debe apagar.\nEl sistema debe ser capaz de iniciar de nuevo si se le indica mediante un botón de paro y de arranque.\nNota: Para esta práctica es necesario utilizar un temporizador on-delay.\n', '2019-10-23', 0, 'dAurieaPOg'),
(7, 'Control temporizado de motor trifásico de 220v y dos devanados (Temporizador offdelay)', 'Por medio del simulador de control secuencial el alumno deberá realizar el circuito de lógica y fuerza necesario para poder encender a su máxima velocidad un motor de 220v y dos devanados, durante 15 segundos, después de ese tiempo el motor se debe apagar.\nEl sistema debe ser capaz de iniciar de nuevo si se le indica mediante un botón de paro y de arranque.\nNota: Para esta práctica es necesario utilizar un temporizador off-delay.\n', '2019-10-25', 0, 'dAurieaPOg'),
(8, 'Alterar velocidad de un motor trifásico de 220v y dos devanados mediante un transformador de poder.', 'Por medio del simulador de alterar la rotación del motor, mediante la utilización de un transformador de voltaje. Es necesario que el circuito sea reconfigurable y poder varias las revoluciones del motor, de acuerdo a la relación vista en clase.', '2019-10-28', 0, 'dAurieaPOg'),
(9, 'Potenciómetro de resistencia variable', 'Por medio del simulador de alterar la rotación del motor, mediante la utilización de un potenciómetro de resistencia variable.', '2019-11-07', 0, 'dAurieaPOg'),
(10, 'Bobina de cambio de estado', 'Por medio del simulador de control secuencial el alumno deberá realizar el circuito de lógica y fuerza necesario para poder prender y apagar un foco, mediante la utilización de un bobina de cambio de fase (Cambio eléctrico), en lugar de utilizar un botón pulsador.', '2019-11-13', 0, 'dAurieaPOg'),
(11, 'Movimiento lavadora motor', 'Crear un circuito de lógica y fuerza para permitir que un motor trifasico de dos devanados, se mueva con un movimiento de zig zag.', '2019-11-15', 0, 'dAurieaPOg'),
(12, 'Evaluación difusa de la clase', 'En este apartado el profesor puede asignar la evaluación de la clase. Esta actividad únicamente se puede asignar una vez en todo el curso. La presente evaluación sirve para que el docente reciba retroalimentación del contenido de la clase de parte de sus estudiantes.', '2019-11-28', 0, 'wfcC7PiByF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntaseguridad`
--

DROP TABLE IF EXISTS `preguntaseguridad`;
CREATE TABLE IF NOT EXISTS `preguntaseguridad` (
  `idPreguntaSeguridad` int(11) NOT NULL,
  `pregunta` text NOT NULL,
  PRIMARY KEY (`idPreguntaSeguridad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `preguntaseguridad`
--

INSERT INTO `preguntaseguridad` (`idPreguntaSeguridad`, `pregunta`) VALUES
(1, '¿Cuál es nombre de tu mejor amigo de la infancia?'),
(2, '¿Cuál es nombre de tu primer mascota?'),
(3, '¿Cuál es el nombre de tu actor/actriz favorito?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesorusuario`
--

DROP TABLE IF EXISTS `profesorusuario`;
CREATE TABLE IF NOT EXISTS `profesorusuario` (
  `codigoProfesor` varchar(15) NOT NULL,
  `nombrePila` varchar(100) NOT NULL,
  `apellidoPaterno` varchar(100) NOT NULL,
  `apellidoMaterno` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `PreguntaSeguridad_idPreguntaSeguridad` int(11) NOT NULL DEFAULT '1',
  `respuestaSeguridad` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `permiso` varchar(10) DEFAULT 'pnormal',
  PRIMARY KEY (`codigoProfesor`),
  KEY `fk_ProfesorUsuario_PreguntaSeguridad1_idx` (`PreguntaSeguridad_idPreguntaSeguridad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesorusuario`
--

INSERT INTO `profesorusuario` (`codigoProfesor`, `nombrePila`, `apellidoPaterno`, `apellidoMaterno`, `email`, `PreguntaSeguridad_idPreguntaSeguridad`, `respuestaSeguridad`, `password`, `permiso`) VALUES
('M123456789', 'Admin', 'Adm', 'Adm', 'administracion@secuencialab.com', 1, 'admin', '123456789', 'dba'),
('M215257628', 'SERGIO', 'ORTIZ', 'NERI', 'sergio.ortiz@alumnos.udg.mx', 2, 'solovino', '215257628', 'dba'),
('M215861738', 'CRISTIAN MICHELL', 'CASTILLO', 'SERRANO', 'cristian.castillo@alumnos.udg.mx', 2, 'firulais', '215861738', 'dba'),
('M215862742', 'MIGUEL ALEJANDRO', 'SALGADO', 'RAMIREZ', 'miguel.salgado@alumnos.udg.mx', 1, 'luis', '215862742', 'pnormal'),
('P123456789', 'PROFESOR DE PRUEBA', 'PRUEBA', 'PRUEBA', 'profesorprueba@mail.com', 1, 'nulo', '123456789', 'padmin'),
('P2425836', 'MARCO ANGEL', 'GUTIERREZ', 'CASTRO', 'angel.gutierrez@profesores.udg.mx', 1, 'Manuel Rubio', '123456789', 'pnormal'),
('P2525692', 'JUAN RAMON', 'MORALES ', 'BELTRAN', 'ramon.morales@profesores.udg.mx', 3, 'Will Smith', '123456789', 'pnormal'),
('P2568699', 'EDUARDO', 'MERCADO ', 'URIBE', 'eduardo.mercado@profesores.udg.mx', 1, 'Mariana Rodriguez', '123456789', 'pnormal'),
('P2625980', 'JULIO HECTOR', 'SALDAÑA ', 'OROPEZA', 'julio.saldana@profesores.udg.mx', 1, 'Michell Perez', '123456789', 'pnormal'),
('P2718669', 'CARLOS ALBERTO', 'LÓPEZ', 'DE ALBA', 'carlos.lopez@profesores.udg.mx', 1, 'Miguel Angel Serrano', '123456789', 'padmin'),
('P2739689', 'J. JESUS', 'MONTES', 'RUELAS', 'jesus.montes@profesores.udg.mx', 1, 'Juan Jose Gimenez', '123456789', 'pnormal'),
('P2817999', 'RICARDO', 'RODRIGUEZ ', 'RODRIGUEZ ', 'ricardo.rodriguez@profesores.udg.mx', 2, 'Gato', '123456789', 'pnormal'),
('P2945549', 'SERGIO DE JESUS', 'ORTIZ', 'PEREZ', 'sergio.ortiz@profesores.udg.mx', 1, 'Sebatina Daniel Castillo', '123456789', 'pnormal');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnousuario`
--
ALTER TABLE `alumnousuario`
  ADD CONSTRAINT `fk_AlumnoUsuario_PreguntaSeguridad1` FOREIGN KEY (`PreguntaSeguridad_idPreguntaSeguridad`) REFERENCES `preguntaseguridad` (`idPreguntaSeguridad`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `anuncio`
--
ALTER TABLE `anuncio`
  ADD CONSTRAINT `fk_Anuncio_Clase1` FOREIGN KEY (`Clase_claveAcceso`) REFERENCES `clase` (`claveAcceso`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Anuncio_ProfesorUsuario1` FOREIGN KEY (`ProfesorUsuario_codigoProfesor`) REFERENCES `profesorusuario` (`codigoProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `clase`
--
ALTER TABLE `clase`
  ADD CONSTRAINT `fk_Clase_CicloEscolar1` FOREIGN KEY (`CicloEscolar_idCicloEscolar`) REFERENCES `cicloescolar` (`idCicloEscolar`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Clase_ProfesorUsuario1` FOREIGN KEY (`ProfesorUsuario_codigoProfesor`) REFERENCES `profesorusuario` (`codigoProfesor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `clase_has_alumnousuario`
--
ALTER TABLE `clase_has_alumnousuario`
  ADD CONSTRAINT `fk_Clase_has_AlumnoUsuario_AlumnoUsuario1` FOREIGN KEY (`AlumnoUsuario_codigoAlumno`) REFERENCES `alumnousuario` (`codigoAlumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Clase_has_AlumnoUsuario_Clase1` FOREIGN KEY (`Clase_claveAcceso`) REFERENCES `clase` (`claveAcceso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_Comentario_Anuncio1` FOREIGN KEY (`Anuncio_idAnuncio`) REFERENCES `anuncio` (`idAnuncio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD CONSTRAINT `fk_Cuestionario_AlumnoUsuario1` FOREIGN KEY (`AlumnoUsuario_codigoAlumno`) REFERENCES `alumnousuario` (`codigoAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Cuestionario_Practica1` FOREIGN KEY (`Practica_idPractica`) REFERENCES `practica` (`idPractica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `fk_Evaluacion_Cuestionario1` FOREIGN KEY (`Cuestionario_idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `evaluaciondifusa`
--
ALTER TABLE `evaluaciondifusa`
  ADD CONSTRAINT `fk_EvaluacionDifusa_AlumnoUsuario1` FOREIGN KEY (`AlumnoUsuario_codigoAlumno`) REFERENCES `alumnousuario` (`codigoAlumno`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_EvaluacionDifusa_Practica1` FOREIGN KEY (`Practica_idPractica`) REFERENCES `practica` (`idPractica`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `practica`
--
ALTER TABLE `practica`
  ADD CONSTRAINT `fk_Practica_Clase1` FOREIGN KEY (`Clase_claveAcceso`) REFERENCES `clase` (`claveAcceso`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `profesorusuario`
--
ALTER TABLE `profesorusuario`
  ADD CONSTRAINT `fk_ProfesorUsuario_PreguntaSeguridad1` FOREIGN KEY (`PreguntaSeguridad_idPreguntaSeguridad`) REFERENCES `preguntaseguridad` (`idPreguntaSeguridad`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
