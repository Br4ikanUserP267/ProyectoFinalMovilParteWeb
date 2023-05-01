
-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`Carreras`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Carreras` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NULL,
  `descripcion` VARCHAR(200) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`DireccionesEstudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`DireccionesEstudiantes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `pais` VARCHAR(45) NOT NULL,
  `ciudad` VARCHAR(45) NOT NULL,
  `calle` VARCHAR(45) NOT NULL,
  `numero` VARCHAR(45) NOT NULL,
  `barrio` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Estudiantes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Estudiantes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipoIdentificacion` ENUM("cc", "ti", "ce") NOT NULL,
  `numeroIdentificacion` VARCHAR(45) NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `celular` VARCHAR(45) NULL,
  `fechanacimiento` DATE NOT NULL,
  `Direcciones_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Estudiantes_Direcciones1`
    FOREIGN KEY (`Direcciones_id`)
    REFERENCES `mydb`.`DireccionesEstudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Semestre`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Semestre` (
  `numero` INT NOT NULL,
  `fecaInicio` DATE NOT NULL,
  `fechaFinal` DATE NOT NULL,
  PRIMARY KEY (`numero`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Inscripciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Inscripciones` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NULL,
  `Semestre_numero` INT NOT NULL,
  `Carrera_id` INT NOT NULL,
  `Estudiantes_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_Inscripcion_Semestre1`
    FOREIGN KEY (`Semestre_numero`)
    REFERENCES `mydb`.`Semestre` (`numero`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscripcion_Carrera1`
    FOREIGN KEY (`Carrera_id`)
    REFERENCES `mydb`.`Carreras` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Inscripciones_Estudiantes1`
    FOREIGN KEY (`Estudiantes_id`)
    REFERENCES `mydb`.`Estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Locket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Locket` (
  `idLocket` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(45) NOT NULL,
  `Estudiantes_id` INT NULL,
  PRIMARY KEY (`idLocket`),
  CONSTRAINT `fk_Locket_Estudiantes1`
    FOREIGN KEY (`Estudiantes_id`)
    REFERENCES `mydb`.`Estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Prestamos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Prestamos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fechaInicio` DATE NULL,
  `fechaFinal` DATE NULL,
  `estado` VARCHAR(45) NULL,
  `Estudiantes_id` INT NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_prestamos_Estudiantes1`
    FOREIGN KEY (`Estudiantes_id`)
    REFERENCES `mydb`.`Estudiantes` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Multas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Multas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `fecha` DATE NULL,
  `descripcion` VARCHAR(45) NULL,
  `monto` FLOAT NULL,
  `Prestamos_id` INT NOT NULL,
  PRIMARY KEY (`id`),
 
  CONSTRAINT `fk_Multas_Prestamos1`
    FOREIGN KEY (`Prestamos_id`)
    REFERENCES `mydb`.`Prestamos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Autores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Autores` (
  `idAutores` INT NOT NULL,
  `nombres` VARCHAR(45) NOT NULL,
  `apelldios` VARCHAR(45) NOT NULL,
  `biografia` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`idAutores`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Editoriales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Editoriales` (
  `id` INT NOT NULL,
  `nombre` VARCHAR(45) NULL,
  `correo` VARCHAR(45) NULL,
  `numerocontacto` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Categorias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Libros` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NULL,
  `Editoriales_id` INT NOT NULL,
  `Categorias_id` INT NOT NULL,
  PRIMARY KEY (`id`),

  CONSTRAINT `fk_Libros_Editoriales1`
    FOREIGN KEY (`Editoriales_id`)
    REFERENCES `mydb`.`Editoriales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Libros_Categorias1`
    FOREIGN KEY (`Categorias_id`)
    REFERENCES `mydb`.`Categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Direcciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Direcciones` (
  `id` INT NOT NULL,
  `pais` VARCHAR(45) NULL,
  `ciudad` VARCHAR(45) NULL,
  `direccion` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Editoriales_has_Direcciones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Editoriales_has_Direcciones` (
  `Editoriales_id` INT NOT NULL,
  `Direcciones_id` INT NOT NULL,
  PRIMARY KEY (`Editoriales_id`, `Direcciones_id`),
 
  CONSTRAINT `fk_Editoriales_has_Direcciones_Editoriales1`
    FOREIGN KEY (`Editoriales_id`)
    REFERENCES `mydb`.`Editoriales` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Editoriales_has_Direcciones_Direcciones1`
    FOREIGN KEY (`Direcciones_id`)
    REFERENCES `mydb`.`Direcciones` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Autores_has_Libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Autores_has_Libros` (
  `Autores_idAutores` INT NOT NULL,
  `Libros_id` INT NOT NULL,
  PRIMARY KEY (`Autores_idAutores`, `Libros_id`),

  CONSTRAINT `fk_Autores_has_Libros_Autores1`
    FOREIGN KEY (`Autores_idAutores`)
    REFERENCES `mydb`.`Autores` (`idAutores`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Autores_has_Libros_Libros1`
    FOREIGN KEY (`Libros_id`)
    REFERENCES `mydb`.`Libros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`Prestamos_has_Libros`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`Prestamos_has_Libros` (
  `Prestamos_id` INT NOT NULL,
  `Libros_id` INT NOT NULL,
  PRIMARY KEY (`Prestamos_id`, `Libros_id`),
  CONSTRAINT `fk_Prestamos_has_Libros_Prestamos1`
    FOREIGN KEY (`Prestamos_id`)
    REFERENCES `mydb`.`Prestamos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Prestamos_has_Libros_Libros1`
    FOREIGN KEY (`Libros_id`)
    REFERENCES `mydb`.`Libros` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`usuarios` (
  `numeroIdentificacion` INT NOT NULL,
  `contrasena` VARCHAR(45) NOT NULL,
  `tipousuario` ENUM("b", "a", "e") NULL,
  PRIMARY KEY (`numeroIdentificacion`))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
