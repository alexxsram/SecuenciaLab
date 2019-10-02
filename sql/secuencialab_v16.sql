-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-09-2019 a las 07:14:52
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `nombreMateria` varchar(45) NOT NULL,
  `nrc` int(11) NOT NULL,
  `claveSeccion` varchar(3) NOT NULL DEFAULT 'D01',
  `nombreClase` varchar(45) NOT NULL,
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
('OVJbNQVUtN', 'SISTEMAS DE CONTROL SECUENCIAL', 12345, 'D01', 'LABORATORIO DE CONTROL', 'S01', '2019', 0, '', '2019-09-24 10:09:54', '2019-09-24 10:09:54', 2, 'M215862742');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  UNIQUE KEY `nombreClave_UNIQUE` (`nombreClave`),
  KEY `fk_Cuestionario_Practica1_idx` (`Practica_idPractica`),
  KEY `fk_Cuestionario_AlumnoUsuario1_idx` (`AlumnoUsuario_codigoAlumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `permiso` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`codigoProfesor`),
  KEY `fk_ProfesorUsuario_PreguntaSeguridad1_idx` (`PreguntaSeguridad_idPreguntaSeguridad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesorusuario`
--

INSERT INTO `profesorusuario` (`codigoProfesor`, `nombrePila`, `apellidoPaterno`, `apellidoMaterno`, `email`, `PreguntaSeguridad_idPreguntaSeguridad`, `respuestaSeguridad`, `password`, `permiso`) VALUES
('M123456789', 'Admin', 'Adm', 'Adm', 'administracion@secuencialab.com', 1, 'admin', '123456789', 'dba'),
('M215257628', 'Sergio', 'Ortiz', 'Neri', 'sergio.ortiz@alumnos.udg.mx', 2, 'solovino', '215257628', 'dba'),
('M215861738', 'Cristian Michell', 'Castillo', 'Serrano', 'cristian.castillo@alumnos.udg.mx', 2, 'firulais', '215861738', 'dba'),
('M215862742', 'Miguel Alejandro', 'Salgado', 'Ramírez', 'miguel.salgado@alumnos.udg.mx', 1, 'luis', '215862742', 'pnormal'),
('P111222333', 'PROFESOR DE PRUEBA 1', 'PRUEBA', 'PRUEBA', 'profesorprueba1@mail.com', 1, 'nulo 1', '111222333', 'padmin'),
('P123456789', 'PROFESOR DE PRUEBA', 'PRUEBA', 'PRUEBA', 'profesorprueba@mail.com', 1, 'nulo', '123456789', 'padmin'),
('P444555666', 'PROFESOR DE PRUEBA 2', 'PRUEBA', 'PRUEBA', 'profesorprueba2@mail.com', 1, 'nulo 2', '444555666', 'pnormal');

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