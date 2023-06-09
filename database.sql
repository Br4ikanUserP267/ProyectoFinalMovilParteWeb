-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 07-06-2023 a las 17:24:01
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbbiblioteca`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `CambiarEstadoPrestamo` (IN `prestamoId` INT)   BEGIN
UPDATE prestamos
    SET prestado = CASE WHEN prestado = TRUE THEN FALSE ELSE TRUE END,
        fechaFinal = CASE WHEN prestado = TRUE THEN DATE_ADD(fechaInicio, INTERVAL 8 DAY) ELSE fechaFinal END
    WHERE id = prestamoId;
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `nombres` varchar(45) DEFAULT NULL,
  `apellidos` varchar(45) DEFAULT NULL,
  `biografia` varchar(200) DEFAULT NULL,
  `foto` blob DEFAULT NULL,
  `fechanacimiento` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores`
--

INSERT INTO `autores` (`id`, `nombres`, `apellidos`, `biografia`, `foto`, `fechanacimiento`) VALUES
(29, 'Braikan', 'Piña', 'dadad', 0x6175746f725f696d616765732f61646565313437626230643435396338373663333133363765646466313538622e6a7067, '2023-06-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores_has_libros`
--

CREATE TABLE `autores_has_libros` (
  `Autores_idAutores` int(11) NOT NULL,
  `Libros_id` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `autores_has_libros`
--

INSERT INTO `autores_has_libros` (`Autores_idAutores`, `Libros_id`, `fecha`) VALUES
(29, 2, '0000-00-00'),
(29, 5, '2023-06-14'),
(29, 7, '2023-06-13'),
(29, 8, '2023-06-13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(11) NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `descripcion` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `titulo`, `descripcion`) VALUES
(1, 'Ingeniería de sistemas', 'La ingeniería de sistemas es un campo interdisciplinario de la ingeniería que permite estudiar y comprender la realidad, con el propósito de implementar u optimizar sistemas complejos.'),
(2, 'Arquitectura', 'es una carrera muy bonita\n'),
(3, 'Diseño industrial', 'El diseño industrial es una actividad proyectual de diseño de productos seriados o industriales, que podemos diferenciar en dos tipos: bienes de consumo y bienes de capital'),
(4, 'Psicologia', 'No se '),
(6, 'ASTRONAUTA', 'AAAAAA wao');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Ciencias'),
(2, 'Psicologia'),
(3, 'Arte'),
(4, 'Artes Marciales'),
(5, 'Ingenerias');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL,
  `departamento` varchar(45) DEFAULT NULL,
  `id_editorial` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `direcciones`
--

INSERT INTO `direcciones` (`id`, `pais`, `ciudad`, `direccion`, `departamento`, `id_editorial`) VALUES
(1, 'País de la dirección', 'Ciudad de la dirección ', 'Dirección completa', 'Departamento de la dirección', 1),
(9, 'País de la dirección 2', 'Ciudad de la dirección 2', 'Dirección completa 2', 'Departamento de la dirección 2', 8),
(10, 'País de la dirección 3', 'Ciudad de la dirección 3', 'Dirección completa 3', 'Departamento de la dirección 3', 8),
(11, '1', '2', '3', '4', 10),
(12, '5', '5', '6', '7', 10),
(13, '12121', '1212', '2121', '12121212', 12),
(14, '12121', '1212', '12121|', '12121212', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccionesestudiantes`
--

CREATE TABLE `direccionesestudiantes` (
  `id` int(11) NOT NULL,
  `pais` varchar(45) NOT NULL,
  `departamento` varchar(45) NOT NULL,
  `ciudad` varchar(45) NOT NULL,
  `calle` varchar(45) NOT NULL,
  `numero` varchar(45) NOT NULL,
  `barrio` varchar(45) NOT NULL,
  `estudiantes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `direccionesestudiantes`
--

INSERT INTO `direccionesestudiantes` (`id`, `pais`, `departamento`, `ciudad`, `calle`, `numero`, `barrio`, `estudiantes_id`) VALUES
(56, 'COLOMBIA', 'SUCRE', 'SAMPUES ', 'LA VIRGENCITA', '36-48', 'LA VIRGENCITA', 76),
(57, 'COLOMBIA', 'SUCRE', 'SINCELEJO', 'la balsa', '11', 'la balsa', 77),
(58, 'COLOMBIA', 'SUCRE', 'SINCELEJO', 'ALPES', '11', 'ALPES', 78);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales`
--

CREATE TABLE `editoriales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `correo` varchar(45) DEFAULT NULL,
  `numerocontacto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `editoriales`
--

INSERT INTO `editoriales` (`id`, `nombre`, `correo`, `numerocontacto`) VALUES
(1, 'Nombre de la editorial ', 'correo@example.com', '123456789'),
(8, 'Pepitos', 'pepitos@example.com', '987654321'),
(9, NULL, NULL, NULL),
(10, 'Editorial san carlos', 'braikan@gmail.com', '323131'),
(11, 'Editorial san carlos 2', 'braikan@gmail.com', '323131'),
(12, 'Editorial san carlos', 'braikan@gmail.com', '323131');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `id` int(11) NOT NULL,
  `tipoIdentificacion` enum('cc','ti','ce') NOT NULL,
  `numeroIdentificacion` varchar(45) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apellidos` varchar(45) NOT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `fechanacimiento` date NOT NULL,
  `tiposagre` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') NOT NULL,
  `paisnacimiento` varchar(45) NOT NULL,
  `departamentonacimiento` varchar(45) NOT NULL,
  `ciudadnacimiento` varchar(45) NOT NULL,
  `foto` blob NOT NULL,
  `correoelectronico` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`id`, `tipoIdentificacion`, `numeroIdentificacion`, `nombres`, `apellidos`, `celular`, `fechanacimiento`, `tiposagre`, `paisnacimiento`, `departamentonacimiento`, `ciudadnacimiento`, `foto`, `correoelectronico`) VALUES
(76, 'cc', '1103739024', 'STEVEN DAVID ', 'GOMEZ FOLIACO', '3218146258', '2023-04-24', 'O+', 'COLOMBIA', 'SUCRE', 'SINCELEJO', 0x657374756469616e74655f696d616765732f30376665353563366635336435373638616538393965376265356266313463372e6a7067, 'stevengomezf@cecar.edu.co'),
(77, 'cc', '9999111', 'jajaja', 'jejeje', '12121212', '2000-12-31', 'O-', 'Colombia', 'Sucre', 'SINCELEJO', 0x657374756469616e74655f696d616765732f66306538376363623338353162623964376333653164303366323737663062612e6a7067, 'steven@gmail.com'),
(78, 'cc', '224455', 'steven ', 'gomez', '12121212', '2008-12-31', 'O+', 'Brasil', 'Sucre', 'SINCELEJO', 0x657374756469616e74655f696d616765732f62356237666130363139346137363832303266323330386364353466643166372e6a7067, 'BRAIKAN.a@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscripciones`
--

CREATE TABLE `inscripciones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `fecha` datetime DEFAULT NULL,
  `Semestre_numero` int(11) NOT NULL,
  `Carrera_id` int(11) NOT NULL,
  `estudiantes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `inscripciones`
--

INSERT INTO `inscripciones` (`id`, `descripcion`, `fecha`, `Semestre_numero`, `Carrera_id`, `estudiantes_id`) VALUES
(29, 'Estudiudate inscrito', '2023-05-16 09:45:38', 3, 2, 76),
(30, 'Estudiudate inscrito', '2023-05-17 13:53:14', 3, 2, 76),
(31, 'Estudiudate inscrito', '2023-05-17 13:53:15', 3, 2, 76),
(32, 'Se inscriboó', '2023-05-21 13:22:01', 5, 1, 76),
(45, 'kaslkaslkas', '2023-06-05 12:55:26', 5, 6, 77),
(46, 'kaslkaslkas', '2023-06-05 12:55:28', 5, 6, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `Editoriales_id` int(11) DEFAULT NULL,
  `imagen` blob DEFAULT NULL,
  `temas_id` int(11) NOT NULL,
  `valor` float DEFAULT NULL,
  `disponibilidad` tinyint(4) DEFAULT NULL,
  `numerounidades` int(11) DEFAULT NULL,
  `resumen` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `libros`
--

INSERT INTO `libros` (`id`, `nombre`, `Editoriales_id`, `imagen`, `temas_id`, `valor`, `disponibilidad`, `numerounidades`, `resumen`) VALUES
(2, 'mil maravillas', 1, 0x6c6962726f5f696d616765732f63376365313936376364613438356636613562383561666465383634363963382e6a7067, 1, 100, 1, -3, 'hola soy un libro divertido'),
(5, 'Editorial san carlos', 10, 0x6c6962726f5f696d616765732f39373037383438343534643936316537323335313864396236666332616136342e6a7067, 1, 100, 1, 76, 'HoLA SOY UN LIBRO MUY PRO'),
(7, '300 libro de amor ', 10, 0x6c6962726f5f696d616765732f30386664653039396665393730386664323535313864306636393064343433642e6a7067, 1, 10000, 0, 0, 'Es un ibro demasiado bonito'),
(8, 'Mi vida diomedes ', 10, 0x6c6962726f5f696d616765732f64353537333464666538656232396565346264363561313837303033373538352e6a7067, 1, 10000, 0, 0, 'Es un ibro demasiado bonito'),
(9, 'libro nuevo', 1, 0x6c6962726f5f696d616765732f64653536393731663165313632376439346638366266363963383038313265632e6a7067, 1, 1000, 1, 100, 'este es un resumen del libro creado');

--
-- Disparadores `libros`
--
DELIMITER $$
CREATE TRIGGER `set_disponibilidad_false_before_insert` BEFORE INSERT ON `libros` FOR EACH ROW BEGIN
    IF NEW.numerounidades = 0 OR NEW.numerounidades IS NULL THEN
        SET NEW.disponibilidad = FALSE;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_disponibilidad_false_before_update` BEFORE UPDATE ON `libros` FOR EACH ROW BEGIN
    IF NEW.numerounidades = 0 OR NEW.numerounidades IS NULL THEN
        SET NEW.disponibilidad = FALSE;
     ELSE
        SET NEW.disponibilidad = TRUE;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `motivos`
--

CREATE TABLE `motivos` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `motivos`
--

INSERT INTO `motivos` (`id`, `descripcion`) VALUES
(1, 'Vencimiento'),
(2, 'Robo/Perdida'),
(4, 'hackeo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `motivo_id` int(11) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `Prestamos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `multas`
--
DELIMITER $$
CREATE TRIGGER `calcular_multa` BEFORE INSERT ON `multas` FOR EACH ROW BEGIN
    DECLARE total_monto FLOAT;
    
    IF NEW.motivo_id = 1 THEN
        SET NEW.monto = 0.04 * 1200000;
    ELSEIF NEW.motivo_id = 2 THEN
        SELECT SUM(l.valor) INTO total_monto
        FROM prestamos p
        INNER JOIN prestamos_has_libros pl ON p.id = pl.Prestamos_id
        INNER JOIN libros l ON pl.Libros_id = l.id
        WHERE p.id = NEW.Prestamos_id;
        
        SET NEW.monto = total_monto;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date DEFAULT NULL,
  `prestado` tinyint(4) NOT NULL,
  `Estudiantes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `prestamos`
--

INSERT INTO `prestamos` (`id`, `fechaInicio`, `fechaFinal`, `prestado`, `Estudiantes_id`) VALUES
(3, '2023-06-01', '2023-06-15', 1, 76),
(5, '2023-06-05', '2023-06-10', 1, 76),
(6, '2023-06-05', '2023-06-10', 1, 76),
(8, '2023-06-04', '2023-06-12', 1, 76),
(9, '2023-06-04', '2023-06-11', 0, 76),
(10, '2023-06-04', '2023-06-11', 0, 76),
(11, '2023-06-04', '2023-06-11', 1, 76),
(13, '2023-06-04', '2023-06-12', 1, 76),
(15, '2023-06-04', '2023-06-16', 1, 76),
(16, '2023-06-04', '2023-06-11', 1, 76),
(17, '2023-06-05', '2023-06-12', 1, 76),
(18, '2023-06-05', '2023-06-12', 1, 76),
(19, '2023-06-05', '2023-06-12', 1, 76),
(20, '2023-06-05', '2023-06-12', 0, 76),
(21, '2023-06-05', '2023-06-12', 1, 77),
(22, '2023-06-05', '2023-06-13', 1, 77),
(23, '2023-06-05', '2023-06-12', 1, 77),
(24, '2023-06-05', '2023-06-12', 0, 77),
(25, '2023-06-05', '2023-06-12', 1, 77),
(26, '2023-06-05', '2023-06-12', 1, 77),
(27, '2023-06-05', '2023-06-12', 1, 77),
(28, '2023-06-05', '2023-06-12', 1, 77),
(29, '2023-06-05', '2023-06-12', 1, 77),
(30, '2023-06-05', '2023-06-12', 1, 77),
(31, '2023-06-05', '2023-06-12', 1, 77);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_has_libros`
--

CREATE TABLE `prestamos_has_libros` (
  `Prestamos_id` int(11) NOT NULL,
  `Libros_id` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `prestamos_has_libros`
--

INSERT INTO `prestamos_has_libros` (`Prestamos_id`, `Libros_id`, `fecha`) VALUES
(8, 2, '2023-06-04 00:00:00'),
(9, 2, '2023-06-04 00:00:00'),
(10, 2, '2023-06-04 00:00:00'),
(11, 2, '2023-06-04 00:00:00'),
(13, 2, '2023-06-04 00:00:00'),
(15, 2, '2023-06-04 00:00:00'),
(17, 5, '2023-06-05 00:00:00'),
(18, 2, '2023-06-05 00:00:00'),
(18, 5, '2023-06-05 00:00:00'),
(18, 7, '2023-06-05 00:00:00'),
(19, 2, '2023-06-05 00:00:00'),
(20, 8, '2023-06-05 00:00:00'),
(21, 2, '2023-06-05 00:00:00'),
(22, 7, '2023-06-05 00:00:00'),
(22, 8, '2023-06-05 00:00:00'),
(23, 7, '2023-06-05 00:00:00'),
(24, 8, '2023-06-05 00:00:00'),
(25, 7, '2023-06-05 00:00:00'),
(26, 7, '2023-06-05 00:00:00'),
(27, 7, '2023-06-05 00:00:00'),
(28, 7, '2023-06-05 00:00:00'),
(29, 7, '2023-06-05 00:00:00'),
(30, 7, '2023-06-05 00:00:00'),
(31, 7, '2023-06-05 00:00:00');

--
-- Disparadores `prestamos_has_libros`
--
DELIMITER $$
CREATE TRIGGER `disminuir_unidades_disponibles` AFTER INSERT ON `prestamos_has_libros` FOR EACH ROW BEGIN
    UPDATE dbbiblioteca.libros
    SET numerounidades = numerounidades - 1
    WHERE id = NEW.Libros_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestre`
--

CREATE TABLE `semestre` (
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `semestre`
--

INSERT INTO `semestre` (`numero`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temas`
--

CREATE TABLE `temas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `Categorias_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `temas`
--

INSERT INTO `temas` (`id`, `nombre`, `Categorias_id`) VALUES
(1, 'Judo', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `numeroIdentificacion` int(11) NOT NULL,
  `contrasena` varchar(45) NOT NULL,
  `tipousuario` enum('b','a','e') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`numeroIdentificacion`, `contrasena`, `tipousuario`) VALUES
(224455, '123', 'e'),
(9999111, '123', 'e'),
(110114111, 'maria', 'e'),
(1005472938, 'andresbertel', 'b'),
(1103739024, 'GOMEZf', 'e'),
(1104255477, 'namuel', 'a'),
(1104255477, 'namuel', 'e'),
(1104258093, 'braikanteodio', 'e'),
(2147483647, 'TEAMO', 'b');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `autores_has_libros`
--
ALTER TABLE `autores_has_libros`
  ADD PRIMARY KEY (`Autores_idAutores`,`Libros_id`),
  ADD KEY `fk_Autores_has_Libros_Libros1` (`Libros_id`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_editorial` (`id_editorial`);

--
-- Indices de la tabla `direccionesestudiantes`
--
ALTER TABLE `direccionesestudiantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_direccionesestudiantes_estudiantes1` (`estudiantes_id`);

--
-- Indices de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numeroIdentificacion_UNIQUE` (`numeroIdentificacion`);

--
-- Indices de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Inscripcion_Carrera1` (`Carrera_id`),
  ADD KEY `fk_Inscripcion_Semestre1` (`Semestre_numero`),
  ADD KEY `fk_inscripciones_estudiantes1` (`estudiantes_id`);

--
-- Indices de la tabla `libros`
--
ALTER TABLE `libros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_temas` (`temas_id`);

--
-- Indices de la tabla `motivos`
--
ALTER TABLE `motivos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `multas`
--
ALTER TABLE `multas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Multas_Prestamos1` (`Prestamos_id`),
  ADD KEY `fk_multa_motivos` (`motivo_id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_prestamos_Estudiantes1` (`Estudiantes_id`);

--
-- Indices de la tabla `prestamos_has_libros`
--
ALTER TABLE `prestamos_has_libros`
  ADD PRIMARY KEY (`Prestamos_id`,`Libros_id`),
  ADD KEY `fk_Prestamos_has_Libros_Libros1` (`Libros_id`);

--
-- Indices de la tabla `semestre`
--
ALTER TABLE `semestre`
  ADD PRIMARY KEY (`numero`);

--
-- Indices de la tabla `temas`
--
ALTER TABLE `temas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Categorias_id` (`Categorias_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`numeroIdentificacion`,`tipousuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `direccionesestudiantes`
--
ALTER TABLE `direccionesestudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `motivos`
--
ALTER TABLE `motivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `multas`
--
ALTER TABLE `multas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `temas`
--
ALTER TABLE `temas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autores_has_libros`
--
ALTER TABLE `autores_has_libros`
  ADD CONSTRAINT `fk_Autores_has_Libros_Libros1` FOREIGN KEY (`Libros_id`) REFERENCES `libros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direcciones`
--
ALTER TABLE `direcciones`
  ADD CONSTRAINT `id_editorial` FOREIGN KEY (`id_editorial`) REFERENCES `editoriales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direccionesestudiantes`
--
ALTER TABLE `direccionesestudiantes`
  ADD CONSTRAINT `fk_direccionesestudiantes_estudiantes1` FOREIGN KEY (`estudiantes_id`) REFERENCES `estudiantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `fk_Inscripcion_Carrera1` FOREIGN KEY (`Carrera_id`) REFERENCES `carreras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Inscripcion_Semestre1` FOREIGN KEY (`Semestre_numero`) REFERENCES `semestre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripciones_estudiantes1` FOREIGN KEY (`estudiantes_id`) REFERENCES `estudiantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `libros`
--
ALTER TABLE `libros`
  ADD CONSTRAINT `id_temas` FOREIGN KEY (`temas_id`) REFERENCES `temas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `multas`
--
ALTER TABLE `multas`
  ADD CONSTRAINT `fk_Multas_Prestamos1` FOREIGN KEY (`Prestamos_id`) REFERENCES `prestamos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_multa_motivos` FOREIGN KEY (`motivo_id`) REFERENCES `motivos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD CONSTRAINT `fk_prestamos_Estudiantes1` FOREIGN KEY (`Estudiantes_id`) REFERENCES `estudiantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `prestamos_has_libros`
--
ALTER TABLE `prestamos_has_libros`
  ADD CONSTRAINT `fk_Prestamos_has_Libros_Libros1` FOREIGN KEY (`Libros_id`) REFERENCES `libros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Prestamos_has_Libros_Prestamos1` FOREIGN KEY (`Prestamos_id`) REFERENCES `prestamos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `temas`
--
ALTER TABLE `temas`
  ADD CONSTRAINT `Categorias_id` FOREIGN KEY (`Categorias_id`) REFERENCES `categorias` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
