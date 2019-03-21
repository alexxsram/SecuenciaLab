-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema secuencialab
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema secuencialab
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `secuencialab` DEFAULT CHARACTER SET utf8 ;
USE `secuencialab` ;

-- -----------------------------------------------------
-- Table `secuencialab`.`PreguntaSeguridad`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`PreguntaSeguridad` (
  `idPreguntaSeguridad` INT NOT NULL,
  `pregunta` TEXT NOT NULL,
  PRIMARY KEY (`idPreguntaSeguridad`))
ENGINE = InnoDB;

--
-- Volcado de datos para la tabla `preguntaseguridad`
--

INSERT INTO `preguntaseguridad` (`idPreguntaSeguridad`, `pregunta`) VALUES
(1, '¿Cual es el nomre de tu mejor amigo de la infacia?'),
(2, '¿Cúal es el nombre de la ciudad de tu primer viaje?'),
(3, '¿Cúal es el nombre de tu primera mascota?');


-- -----------------------------------------------------
-- Table `secuencialab`.`AlumnoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`AlumnoUsuario` (
  `codigoAlumno` VARCHAR(15) NOT NULL,
  `nombrePila` VARCHAR(100) NOT NULL,
  `apellidoPaterno` VARCHAR(100) NOT NULL,
  `apellidoMaterno` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `PreguntaSeguridad_idPreguntaSeguridad` INT NOT NULL DEFAULT 1,
  `respuestaSeguridad` VARCHAR(50) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`codigoAlumno`),
  INDEX `fk_AlumnoUsuario_PreguntaSeguridad1_idx` (`PreguntaSeguridad_idPreguntaSeguridad` ASC),
  CONSTRAINT `fk_AlumnoUsuario_PreguntaSeguridad1`
    FOREIGN KEY (`PreguntaSeguridad_idPreguntaSeguridad`)
    REFERENCES `secuencialab`.`PreguntaSeguridad` (`idPreguntaSeguridad`)
    ON DELETE RESTRICT
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `secuencialab`.`ProfesorUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`ProfesorUsuario` (
  `codigoProfesor` VARCHAR(15) NOT NULL,
  `nombrePila` VARCHAR(100) NOT NULL,
  `apellidoPaterno` VARCHAR(100) NOT NULL,
  `apellidoMaterno` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `PreguntaSeguridad_idPreguntaSeguridad` INT NOT NULL DEFAULT 1,
  `respuestaSeguridad` VARCHAR(50) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`codigoProfesor`),
  INDEX `fk_ProfesorUsuario_PreguntaSeguridad1_idx` (`PreguntaSeguridad_idPreguntaSeguridad` ASC),
  CONSTRAINT `fk_ProfesorUsuario_PreguntaSeguridad1`
    FOREIGN KEY (`PreguntaSeguridad_idPreguntaSeguridad`)
    REFERENCES `secuencialab`.`PreguntaSeguridad` (`idPreguntaSeguridad`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `secuencialab`.`Practica`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`Practica` (
  `idPractica` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `descripcion` VARCHAR(100) NOT NULL,
  `fechaLimite` DATE NOT NULL,
  PRIMARY KEY (`idPractica`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `secuencialab`.`Cuestionario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`Cuestionario` (
  `idCuestionario` INT NOT NULL AUTO_INCREMENT,
  `respuestaPregunta1` TEXT NULL,
  `respuestaPregunta2` TEXT NULL,
  `respuestaPregunta3` TEXT NULL,
  `conclusion` TEXT NULL,
  `fechaFinalizacion` DATE NULL,
  `Practica_idPractica` INT UNSIGNED NOT NULL,
  `AlumnoUsuario_codigoAlumno` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`idCuestionario`),
  INDEX `fk_Cuestionario_Practica1_idx` (`Practica_idPractica` ASC),
  INDEX `fk_Cuestionario_AlumnoUsuario1_idx` (`AlumnoUsuario_codigoAlumno` ASC),
  CONSTRAINT `fk_Cuestionario_Practica1`
    FOREIGN KEY (`Practica_idPractica`)
    REFERENCES `secuencialab`.`Practica` (`idPractica`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Cuestionario_AlumnoUsuario1`
    FOREIGN KEY (`AlumnoUsuario_codigoAlumno`)
    REFERENCES `secuencialab`.`AlumnoUsuario` (`codigoAlumno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `secuencialab`.`Evaluacion`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`Evaluacion` (
  `idEvaluacion` INT NOT NULL AUTO_INCREMENT,
  `califiacion` INT NOT NULL,
  `Cuestionario_idCuestionario` INT NOT NULL,
  PRIMARY KEY (`idEvaluacion`),
  INDEX `fk_Evaluacion_Cuestionario1_idx` (`Cuestionario_idCuestionario` ASC),
  CONSTRAINT `fk_Evaluacion_Cuestionario1`
    FOREIGN KEY (`Cuestionario_idCuestionario`)
    REFERENCES `secuencialab`.`Cuestionario` (`idCuestionario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `secuencialab`.`Clase`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`Clase` (
  `claveAcceso` VARCHAR(10) NOT NULL,
  `nombreMateria` VARCHAR(45) NOT NULL,
  `nrc` INT NOT NULL,
  `claveSeccion` VARCHAR(3) NOT NULL DEFAULT 'D01',
  `nombreClase` VARCHAR(45) NOT NULL,
  `aula` VARCHAR(45) NOT NULL,
  `anio` VARCHAR(4) NOT NULL,
  `cicloEscolar` VARCHAR(45) NOT NULL,
  `ProfesorUsuario_codigoProfesor` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`claveAcceso`),
  UNIQUE INDEX `claveAcceso_UNIQUE` (`claveAcceso` ASC),
  INDEX `fk_Clase_ProfesorUsuario1_idx` (`ProfesorUsuario_codigoProfesor` ASC),
  CONSTRAINT `fk_Clase_ProfesorUsuario1`
    FOREIGN KEY (`ProfesorUsuario_codigoProfesor`)
    REFERENCES `secuencialab`.`ProfesorUsuario` (`codigoProfesor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `secuencialab`.`Clase_has_AlumnoUsuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `secuencialab`.`Clase_has_AlumnoUsuario` (
  `Clase_claveAcceso` VARCHAR(10) NOT NULL,
  `AlumnoUsuario_codigoAlumno` VARCHAR(15) NOT NULL,
  PRIMARY KEY (`Clase_claveAcceso`, `AlumnoUsuario_codigoAlumno`),
  INDEX `fk_Clase_has_AlumnoUsuario_AlumnoUsuario1_idx` (`AlumnoUsuario_codigoAlumno` ASC),
  INDEX `fk_Clase_has_AlumnoUsuario_Clase1_idx` (`Clase_claveAcceso` ASC),
  CONSTRAINT `fk_Clase_has_AlumnoUsuario_Clase1`
    FOREIGN KEY (`Clase_claveAcceso`)
    REFERENCES `secuencialab`.`Clase` (`claveAcceso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Clase_has_AlumnoUsuario_AlumnoUsuario1`
    FOREIGN KEY (`AlumnoUsuario_codigoAlumno`)
    REFERENCES `secuencialab`.`AlumnoUsuario` (`codigoAlumno`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
