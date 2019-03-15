-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 15-03-2019 a las 06:27:03
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
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`codigoAlumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `alumnousuario`
--

INSERT INTO `alumnousuario` (`codigoAlumno`, `nombrePila`, `apellidoPaterno`, `apellidoMaterno`, `password`) VALUES
('A215862742', 'Miguel Alejandro', 'Salgado', 'Ramírez', '215862742');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnousuario_has_seccion`
--

DROP TABLE IF EXISTS `alumnousuario_has_seccion`;
CREATE TABLE IF NOT EXISTS `alumnousuario_has_seccion` (
  `AlumnoUsuario_codigoAlumno` varchar(15) NOT NULL,
  `Seccion_nrc` int(11) NOT NULL,
  PRIMARY KEY (`AlumnoUsuario_codigoAlumno`,`Seccion_nrc`),
  KEY `fk_AlumnoUsuario_has_Seccion_Seccion1_idx` (`Seccion_nrc`),
  KEY `fk_AlumnoUsuario_has_Seccion_AlumnoUsuario1_idx` (`AlumnoUsuario_codigoAlumno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cicloescolar`
--

DROP TABLE IF EXISTS `cicloescolar`;
CREATE TABLE IF NOT EXISTS `cicloescolar` (
  `idCiclo` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(5) DEFAULT '0000A',
  PRIMARY KEY (`idCiclo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cicloescolar_has_materia`
--

DROP TABLE IF EXISTS `cicloescolar_has_materia`;
CREATE TABLE IF NOT EXISTS `cicloescolar_has_materia` (
  `CicloEscolar_idCiclo` int(11) NOT NULL,
  `Materia_claveMateria` varchar(10) NOT NULL,
  `ProfesorUsuario_codigoProfesor` int(11) NOT NULL,
  PRIMARY KEY (`CicloEscolar_idCiclo`,`Materia_claveMateria`),
  KEY `fk_CicloEscolar_has_Materia_Materia1_idx` (`Materia_claveMateria`),
  KEY `fk_CicloEscolar_has_Materia_CicloEscolar_idx` (`CicloEscolar_idCiclo`),
  KEY `fk_CicloEscolar_has_Materia_ProfesorUsuario1_idx` (`ProfesorUsuario_codigoProfesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cicloescolar_has_materia_has_practica`
--

DROP TABLE IF EXISTS `cicloescolar_has_materia_has_practica`;
CREATE TABLE IF NOT EXISTS `cicloescolar_has_materia_has_practica` (
  `CicloEscolar_has_Materia_CicloEscolar_idCiclo` int(11) NOT NULL,
  `CicloEscolar_has_Materia_Materia_claveMateria` varchar(10) NOT NULL,
  `Practica_idPractica` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`CicloEscolar_has_Materia_CicloEscolar_idCiclo`,`CicloEscolar_has_Materia_Materia_claveMateria`,`Practica_idPractica`),
  KEY `fk_CicloEscolar_has_Materia_has_Practica_Practica1_idx` (`Practica_idPractica`),
  KEY `fk_CicloEscolar_has_Materia_has_Practica_CicloEscolar_has_M_idx` (`CicloEscolar_has_Materia_CicloEscolar_idCiclo`,`CicloEscolar_has_Materia_Materia_claveMateria`)
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
  `fechaFinalizacion` date DEFAULT NULL,
  `Practica_idPractica` int(10) UNSIGNED NOT NULL,
  `AlumnoUsuario_codigoAlumno` varchar(15) NOT NULL,
  PRIMARY KEY (`idCuestionario`),
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
-- Estructura de tabla para la tabla `materia`
--

DROP TABLE IF EXISTS `materia`;
CREATE TABLE IF NOT EXISTS `materia` (
  `claveMateria` varchar(10) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`claveMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `practica`
--

DROP TABLE IF EXISTS `practica`;
CREATE TABLE IF NOT EXISTS `practica` (
  `idPractica` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `fechaLimite` date NOT NULL,
  PRIMARY KEY (`idPractica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesorusuario`
--

DROP TABLE IF EXISTS `profesorusuario`;
CREATE TABLE IF NOT EXISTS `profesorusuario` (
  `codigoProfesor` int(11) NOT NULL,
  `nombrePila` varchar(100) NOT NULL,
  `apellidoPaterno` varchar(100) NOT NULL,
  `apellidoMaterno` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`codigoProfesor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `profesorusuario`
--

INSERT INTO `profesorusuario` (`codigoProfesor`, `nombrePila`, `apellidoPaterno`, `apellidoMaterno`, `password`) VALUES
(12345, 'Marco Angel', 'Gutierrez', 'Perez', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seccion`
--

DROP TABLE IF EXISTS `seccion`;
CREATE TABLE IF NOT EXISTS `seccion` (
  `nrc` int(11) NOT NULL,
  `claveSeccion` varchar(3) NOT NULL DEFAULT 'D01',
  `dias_semana` varchar(20) NOT NULL DEFAULT 'L,I',
  `hora_inicio` varchar(5) NOT NULL DEFAULT '07:00',
  `hora_fin` varchar(5) NOT NULL DEFAULT '07:50',
  `CicloEscolar_has_Materia_CicloEscolar_idCiclo` int(11) NOT NULL,
  `CicloEscolar_has_Materia_Materia_claveMateria` varchar(10) NOT NULL,
  PRIMARY KEY (`nrc`),
  KEY `fk_Seccion_CicloEscolar_has_Materia1_idx` (`CicloEscolar_has_Materia_CicloEscolar_idCiclo`,`CicloEscolar_has_Materia_Materia_claveMateria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnousuario_has_seccion`
--
ALTER TABLE `alumnousuario_has_seccion`
  ADD CONSTRAINT `fk_AlumnoUsuario_has_Seccion_AlumnoUsuario1` FOREIGN KEY (`AlumnoUsuario_codigoAlumno`) REFERENCES `alumnousuario` (`codigoAlumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_AlumnoUsuario_has_Seccion_Seccion1` FOREIGN KEY (`Seccion_nrc`) REFERENCES `seccion` (`nrc`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cicloescolar_has_materia`
--
ALTER TABLE `cicloescolar_has_materia`
  ADD CONSTRAINT `fk_CicloEscolar_has_Materia_CicloEscolar` FOREIGN KEY (`CicloEscolar_idCiclo`) REFERENCES `cicloescolar` (`idCiclo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CicloEscolar_has_Materia_Materia1` FOREIGN KEY (`Materia_claveMateria`) REFERENCES `materia` (`claveMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CicloEscolar_has_Materia_ProfesorUsuario1` FOREIGN KEY (`ProfesorUsuario_codigoProfesor`) REFERENCES `profesorusuario` (`codigoProfesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cicloescolar_has_materia_has_practica`
--
ALTER TABLE `cicloescolar_has_materia_has_practica`
  ADD CONSTRAINT `fk_CicloEscolar_has_Materia_has_Practica_CicloEscolar_has_Mat1` FOREIGN KEY (`CicloEscolar_has_Materia_CicloEscolar_idCiclo`,`CicloEscolar_has_Materia_Materia_claveMateria`) REFERENCES `cicloescolar_has_materia` (`CicloEscolar_idCiclo`, `Materia_claveMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CicloEscolar_has_Materia_has_Practica_Practica1` FOREIGN KEY (`Practica_idPractica`) REFERENCES `practica` (`idPractica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `cuestionario`
--
ALTER TABLE `cuestionario`
  ADD CONSTRAINT `fk_Cuestionario_AlumnoUsuario1` FOREIGN KEY (`AlumnoUsuario_codigoAlumno`) REFERENCES `alumnousuario` (`codigoAlumno`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cuestionario_Practica1` FOREIGN KEY (`Practica_idPractica`) REFERENCES `practica` (`idPractica`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `evaluacion`
--
ALTER TABLE `evaluacion`
  ADD CONSTRAINT `fk_Evaluacion_Cuestionario1` FOREIGN KEY (`Cuestionario_idCuestionario`) REFERENCES `cuestionario` (`idCuestionario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `seccion`
--
ALTER TABLE `seccion`
  ADD CONSTRAINT `fk_Seccion_CicloEscolar_has_Materia1` FOREIGN KEY (`CicloEscolar_has_Materia_CicloEscolar_idCiclo`,`CicloEscolar_has_Materia_Materia_claveMateria`) REFERENCES `cicloescolar_has_materia` (`CicloEscolar_idCiclo`, `Materia_claveMateria`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
