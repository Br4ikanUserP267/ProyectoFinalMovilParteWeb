-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8mb4 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`autores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`autores` (
  `idAutores` INT(11) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apelldios` VARCHAR(45) NOT NULL,
  `biografia` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idAutores`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`categorias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`editoriales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`editoriales` (
  `id` INT(11) NOT NULL,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `correo` VARCHAR(45) NULL DEFAULT NULL,
  `numerocontacto` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`libros` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL DEFAULT NULL,
  `Editoriales_id` INT(11) NOT NULL,
  `Categorias_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Libros_Editoriales1` (`Editoriales_id` ASC) VISIBLE,
  INDEX `fk_Libros_Categorias1` (`Categorias_id` ASC) VISIBLE,
  CONSTRAINT `fk_Libros_Categorias1`
    FOREIGN KEY (`Categorias_id`)
    REFERENCES `mydb`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libros_Editoriales1`
    FOREIGN KEY (`Editoriales_id`)
    REFERENCES `mydb`.`editoriales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`autores_has_libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`autores_has_libros` (
  `Autores_idAutores` INT(11) NOT NULL,
  `Libros_id` INT(11) NOT NULL,
  PRIMARY KEY (`Autores_idAutores`, `Libros_id`),
  INDEX `fk_Autores_has_Libros_Libros1` (`Libros_id` ASC) VISIBLE,
  CONSTRAINT `fk_Autores_has_Libros_Autores1`
    FOREIGN KEY (`Autores_idAutores`)
    REFERENCES `mydb`.`autores` (`idAutores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Autores_has_Libros_Libros1`
    FOREIGN KEY (`Libros_id`)
    REFERENCES `mydb`.`libros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`carrera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`carrera` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL DEFAULT NULL,
  `descripcion` VARCHAR(200) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`direcciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`direcciones` (
  `id` INT(11) NOT NULL,
  `pais` VARCHAR(45) NULL DEFAULT NULL,
  `ciudad` VARCHAR(45) NULL DEFAULT NULL,
  `direccion` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`estudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`estudiantes` (
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
-- Table `mydb`.`direccionesestudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`direccionesestudiantes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `pais` VARCHAR(45) NOT NULL,
  `ciudad` VARCHAR(45) NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `barrio` VARCHAR(45) NOT NULL,
  `estudiantes_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_direccionesestudiantes_estudiantes1_idx` (`estudiantes_id` ASC) VISIBLE,
  CONSTRAINT `fk_direccionesestudiantes_estudiantes1`
    FOREIGN KEY (`estudiantes_id`)
    REFERENCES `mydb`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`editoriales_has_direcciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`editoriales_has_direcciones` (
  `Editoriales_id` INT(11) NOT NULL,
  `Direcciones_id` INT(11) NOT NULL,
  PRIMARY KEY (`Editoriales_id`, `Direcciones_id`),
  INDEX `fk_Editoriales_has_Direcciones_Direcciones1` (`Direcciones_id` ASC) VISIBLE,
  CONSTRAINT `fk_Editoriales_has_Direcciones_Direcciones1`
    FOREIGN KEY (`Direcciones_id`)
    REFERENCES `mydb`.`direcciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Editoriales_has_Direcciones_Editoriales1`
    FOREIGN KEY (`Editoriales_id`)
    REFERENCES `mydb`.`editoriales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`semestre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`semestre` (
  `numero` INT(11) NOT NULL,
  `fecaInicio` DATE NOT NULL,
  `fechaFinal` DATE NOT NULL,
  PRIMARY KEY (`numero`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`inscripciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`inscripciones` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `Semestre_numero` INT(11) NOT NULL,
  `Carrera_id` INT(11) NOT NULL,
  `estudiantes_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Inscripcion_Semestre1` (`Semestre_numero` ASC) VISIBLE,
  INDEX `fk_Inscripcion_Carrera1` (`Carrera_id` ASC) VISIBLE,
  INDEX `fk_inscripciones_estudiantes1_idx` (`estudiantes_id` ASC) VISIBLE,
  CONSTRAINT `fk_Inscripcion_Carrera1`
    FOREIGN KEY (`Carrera_id`)
    REFERENCES `mydb`.`carrera` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscripcion_Semestre1`
    FOREIGN KEY (`Semestre_numero`)
    REFERENCES `mydb`.`semestre` (`numero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscripciones_estudiantes1`
    FOREIGN KEY (`estudiantes_id`)
    REFERENCES `mydb`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`locket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`locket` (
  `idLocket` INT(11) NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  `Estudiantes_id` INT(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idLocket`),
  INDEX `fk_Locket_Estudiantes1` (`Estudiantes_id` ASC) VISIBLE,
  CONSTRAINT `fk_Locket_Estudiantes1`
    FOREIGN KEY (`Estudiantes_id`)
    REFERENCES `mydb`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`prestamos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`prestamos` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fechaInicio` DATE NULL DEFAULT NULL,
  `fechaFinal` DATE NULL DEFAULT NULL,
  `estado` VARCHAR(45) NULL DEFAULT NULL,
  `Estudiantes_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_prestamos_Estudiantes1` (`Estudiantes_id` ASC) VISIBLE,
  CONSTRAINT `fk_prestamos_Estudiantes1`
    FOREIGN KEY (`Estudiantes_id`)
    REFERENCES `mydb`.`estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `mydb`.`multas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`multas` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL DEFAULT NULL,
  `descripcion` VARCHAR(45) NULL DEFAULT NULL,
  `monto` FLOAT NULL DEFAULT NULL,
  `Prestamos_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Multas_Prestamos1` (`Prestamos_id` ASC) VISIBLE,
  CONSTRAINT `fk_Multas_Prestamos1`
    FOREIGN KEY (`Prestamos_id`)
    REFERENCES `mydb`.`prestamos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`prestamos_has_libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`prestamos_has_libros` (
  `Prestamos_id` INT(11) NOT NULL,
  `Libros_id` INT(11) NOT NULL,
  `fecha` DATE NULL,
  PRIMARY KEY (`Prestamos_id`, `Libros_id`),
  INDEX `fk_Prestamos_has_Libros_Libros1` (`Libros_id` ASC) VISIBLE,
  CONSTRAINT `fk_Prestamos_has_Libros_Libros1`
    FOREIGN KEY (`Libros_id`)
    REFERENCES `mydb`.`libros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prestamos_has_Libros_Prestamos1`
    FOREIGN KEY (`Prestamos_id`)
    REFERENCES `mydb`.`prestamos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `numeroIdentificacion` INT(11) NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `tipousuario` ENUM('b', 'a', 'e') NULL DEFAULT NULL,
  PRIMARY KEY (`numeroIdentificacion`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
