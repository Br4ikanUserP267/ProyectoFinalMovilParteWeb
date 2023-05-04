-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema dbbiblioteca
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema dbbiblioteca
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `dbbiblioteca` DEFAULT CHARACTER SET utf8mb4 ;
USE `dbbiblioteca` ;

-- -----------------------------------------------------
-- Table `dbbiblioteca`.`autores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`autores` (
  `idAutores` INT(11) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apelldios` VARCHAR(45) NOT NULL,
  `biografia` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idAutores`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`categorias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`editoriales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`editoriales` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `correo` VARCHAR(45) NULL DEFAULT NULL,
  `numerocontacto` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`libros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `Editoriales_id` INT(11) NOT NULL,
  `Categorias_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_Libros_Categorias1`
    FOREIGN KEY (`Categorias_id`)
    REFERENCES `dbbiblioteca`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libros_Editoriales1`
    FOREIGN KEY (`Editoriales_id`)
    REFERENCES `dbbiblioteca`.`editoriales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`autores_has_libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`autores_has_libros` (
  `Autores_idAutores` INT(11) NOT NULL,
  `Libros_id` INT(11) NOT NULL,
  PRIMARY KEY (`Autores_idAutores`, `Libros_id`),

  CONSTRAINT `fk_Autores_has_Libros_Autores1`
    FOREIGN KEY (`Autores_idAutores`)
    REFERENCES `dbbiblioteca`.`autores` (`idAutores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Autores_has_Libros_Libros1`
    FOREIGN KEY (`Libros_id`)
    REFERENCES `dbbiblioteca`.`libros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`carrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`carrera` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`direcciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`direcciones` (
  `id` INT(11) NOT NULL,
  `pais` VARCHAR(45) NULL DEFAULT NULL,
  `ciudad` VARCHAR(45) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`estudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`estudiantes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `tipoIdentificacion` ENUM('cc', 'ti', 'ce') NOT NULL,
  `numeroIdentificacion` VARCHAR(45) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `celular` VARCHAR(45) NULL DEFAULT NULL,
  `fechanacimiento` DATE NOT NULL,
  `tiposagre` ENUM('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-') NOT NULL,
  `ciudadnacimiento` VARCHAR(45) NOT NULL,
  `paisnacimiento` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`direccionesestudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`direccionesestudiantes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pais` VARCHAR(45) NOT NULL,
  `ciudad` VARCHAR(45) NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `barrio` VARCHAR(45) NOT NULL,
  `estudiantes_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_direccionesestudiantes_estudiantes1`
    FOREIGN KEY (`estudiantes_id`)
    REFERENCES `dbbiblioteca`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`editoriales_has_direcciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`editoriales_has_direcciones` (
  `Editoriales_id` INT(11) NOT NULL,
  `Direcciones_id` INT(11) NOT NULL,
  PRIMARY KEY (`Editoriales_id`, `Direcciones_id`),
 
  CONSTRAINT `fk_Editoriales_has_Direcciones_Direcciones1`
    FOREIGN KEY (`Direcciones_id`)
    REFERENCES `dbbiblioteca`.`direcciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Editoriales_has_Direcciones_Editoriales1`
    FOREIGN KEY (`Editoriales_id`)
    REFERENCES `dbbiblioteca`.`editoriales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`semestre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`semestre` (
  `numero` INT(11) NOT NULL,
  `fecaInicio` DATE NOT NULL,
  `fechaFinal` DATE NOT NULL,
  PRIMARY KEY (`numero`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`inscripciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`inscripciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `Semestre_numero` INT(11) NOT NULL,
  `Carrera_id` INT(11) NOT NULL,
  `estudiantes_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_Inscripcion_Carrera1`
    FOREIGN KEY (`Carrera_id`)
    REFERENCES `dbbiblioteca`.`carrera` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscripcion_Semestre1`
    FOREIGN KEY (`Semestre_numero`)
    REFERENCES `dbbiblioteca`.`semestre` (`numero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscripciones_estudiantes1`
    FOREIGN KEY (`estudiantes_id`)
    REFERENCES `dbbiblioteca`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`locket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`locket` (
  `idLocket` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  `Estudiantes_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idLocket`),

  CONSTRAINT `fk_Locket_Estudiantes1`
    FOREIGN KEY (`Estudiantes_id`)
    REFERENCES `dbbiblioteca`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`prestamos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`prestamos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` DATE NULL DEFAULT NULL,
  `fechaFinal` DATE NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `Estudiantes_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
 
  CONSTRAINT `fk_prestamos_Estudiantes1`
    FOREIGN KEY (`Estudiantes_id`)
    REFERENCES `dbbiblioteca`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`multas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`multas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL DEFAULT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `monto` FLOAT NULL DEFAULT NULL,
  `Prestamos_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_Multas_Prestamos1`
    FOREIGN KEY (`Prestamos_id`)
    REFERENCES `dbbiblioteca`.`prestamos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`prestamos_has_libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`prestamos_has_libros` (
  `Prestamos_id` INT(11) NOT NULL,
  `Libros_id` INT(11) NOT NULL,
  `fecha` DATE NULL,
  PRIMARY KEY (`Prestamos_id`, `Libros_id`),

  CONSTRAINT `fk_Prestamos_has_Libros_Libros1`
    FOREIGN KEY (`Libros_id`)
    REFERENCES `dbbiblioteca`.`libros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prestamos_has_Libros_Prestamos1`
    FOREIGN KEY (`Prestamos_id`)
    REFERENCES `dbbiblioteca`.`prestamos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `dbbiblioteca`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `dbbiblioteca`.`usuarios` (
  `numeroIdentificacion` INT(11) NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `tipousuario` ENUM('b', 'a', 'e') NULL DEFAULT NULL,
  PRIMARY KEY (`numeroIdentificacion`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
