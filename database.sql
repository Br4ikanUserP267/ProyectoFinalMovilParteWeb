-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 19-05-2023 a las 22:08:14
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `nombres` varchar(45) NOT NULL,
  `apelldios` varchar(45) NOT NULL,
  `biografia` varchar(200) NOT NULL,
  `foto` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autores_has_libros`
--

CREATE TABLE `autores_has_libros` (
  `Autores_idAutores` int(11) NOT NULL,
  `Libros_id` int(11) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(5, 'Derecho', 'No sirve pa na');

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
(11, NULL, NULL, NULL, NULL, 10),
(12, NULL, NULL, NULL, NULL, 10),
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
(56, 'COLOMBIA', 'SUCRE', 'SAMPUES ', 'LA VIRGENCITA', '36-48', 'LA VIRGENCITA', 76);

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
(76, 'cc', '1103739024', 'STEVEN DAVID ', 'GOMEZ FOLIACO', '3218146258', '2023-04-24', 'O+', 'COLOMBIA', 'SUCRE', 'SINCELEJO', 0x657374756469616e74655f696d616765732f30376665353563366635336435373638616538393965376265356266313463372e6a7067, 'stevengomezf@cecar.edu.co');

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
(31, 'Estudiudate inscrito', '2023-05-17 13:53:15', 3, 2, 76);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `Editoriales_id` int(11) NOT NULL,
  `imagen` blob NOT NULL,
  `temas_id` int(11) NOT NULL,
  `valor` varchar(45) NOT NULL,
  `disponibilidad` tinyint(4) NOT NULL,
  `numerounidades` int(11) NOT NULL,
  `ubicacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Disparadores `libros`
--
DELIMITER $$
CREATE TRIGGER `asignar_ubicacion` BEFORE INSERT ON `libros` FOR EACH ROW BEGIN
    DECLARE tema_categoria_id INT;
    DECLARE tema_id INT;
    DECLARE ubicacion VARCHAR(45);

    -- Obtener el tema y la categoría del libro
    SELECT temas_id, Categorias_id INTO tema_id, tema_categoria_id
    FROM temas
    WHERE id = NEW.temas_id;

    -- Construir la ubicación del libro
    SET ubicacion = CONCAT('estante ', tema_categoria_id, ' tema ', tema_id);

    -- Asignar la ubicación al nuevo libro
    SET NEW.ubicacion = ubicacion;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `set_disponibilidad_false` BEFORE INSERT ON `libros` FOR EACH ROW BEGIN
    IF NEW.numerounidades = 0 THEN
        SET NEW.disponibilidad = FALSE;
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `multas`
--

CREATE TABLE `multas` (
  `id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `monto` float DEFAULT NULL,
  `Prestamos_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE `prestamos` (
  `id` int(11) NOT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFinal` date NOT NULL,
  `prestado` tinyint(4) NOT NULL,
  `Estudiantes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  ADD KEY `fk_Multas_Prestamos1` (`Prestamos_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `direcciones`
--
ALTER TABLE `direcciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `direccionesestudiantes`
--
ALTER TABLE `direccionesestudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `editoriales`
--
ALTER TABLE `editoriales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `motivos`
--
ALTER TABLE `motivos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `multas`
--
ALTER TABLE `multas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `fk_Multas_Prestamos1` FOREIGN KEY (`Prestamos_id`) REFERENCES `prestamos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
