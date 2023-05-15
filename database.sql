-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 15-05-2023 a las 20:36:58
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
  `foto` blob NOT NULL,
  `numero` int(11) NOT NULL
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
(1, 'Novela'),
(2, 'Accion');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direcciones`
--

CREATE TABLE `direcciones` (
  `id` int(11) NOT NULL,
  `pais` varchar(45) DEFAULT NULL,
  `ciudad` varchar(45) DEFAULT NULL,
  `direccion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(34, 'sinclejeo', 'SINCELEJO', '10', 'ALPES', '11', 'ALPES', 50),
(35, 'Colombia', 'SINCELEJO', '10', 'ALPES', '1111', 'ALPES', 51),
(36, 'sinclejeo', 'Sincelejo', '11', '18', '17', '18', 53),
(37, 'Sincelejo', 'Sincelejo', '18 ', '67', '11', '67', 54),
(38, 'Colombia', 'Sincelejo', 'Carrera 18 ', 'fatima', '11', 'fatima', 55),
(39, 'venezula', 'sucreq', 'sincelejo', '18', '111', 'SUCRE', 51),
(40, 'sinclejeo', 'SINCELJO', '1111', 'ALPES', '11', 'ALPES', 56),
(41, 'Colombia', 'Sinclejeo', '11', 'FATIMA', '19', 'FATIMA', 57),
(42, 'COLOMBIA', 'SUCRE', 'SINCELEJO', '10', '11', 'ALPES', 58),
(43, 'sinclejeo', 'SUCRE', 'SINCELEJO', 'ALPES', '11', 'ALPES', 61),
(44, 'sinclejeo', 'SUCRE', 'SINCELEJO', 'Venecia', '1111', 'Venecia', 62),
(45, 'sinclejeo', 'SUCRE', 'SINCELEJO', 'FATIMAGOD', '12121', 'FATIMAGOD', 63),
(46, 'sinclejeo', 'SUCRE', 'SINCELJO', 'ALPES', '11', 'ALPES', 64),
(47, 'COLOMBIA', 'SUCRE', 'SINCELEJO', 'Namuel', '19', 'Namuel', 66),
(48, 'sinclejeo', 'SUCRE', 'SINCELEJO', 'ALPES', '11', 'ALPES', 68),
(49, 'sinclejeo', 'SUCRE', 'SINCELEJO', 'ALPES', '11', 'ALPES', 69),
(50, 'sinclejeo', 'SUCRE', 'SINCELEJO', 'ALPES', '11', 'ALPES', 70),
(51, 'sinclejeo', 'SUCRE', 'SINCELEJO', 'ALPES', '12121', 'ALPES', 71),
(52, 'JIJIJIJA', 'JOA', 'ESA LEA', 'LOCO PRI', '123', 'LOCO PRI', 72),
(53, 'COLOMBIA', 'SUCRE', 'Namuel', 'Alpes', '121', 'Alpes', 73),
(54, 'COLOMBIA', 'SUCRE', 'SINCELJO', 'ALPES', '11', 'ALPES', 74),
(55, 'COLOMBIA', 'SUCRE', 'SAMPEDRO', '72', '21', '72', 75);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editoriales_has_direcciones`
--

CREATE TABLE `editoriales_has_direcciones` (
  `Editoriales_id` int(11) NOT NULL,
  `Direcciones_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(45, 'cc', '110114', 'khabib', 'piña zamora', '3131313', '2023-05-10', 'O-', 'Brasil', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(46, 'cc', '121212', 'khabib', 'piña zamora', '3131313', '2023-05-18', 'AB+', 'Colombia', 'Sucre', 'SINCELEJO', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(48, 'cc', '2121313', 'khabib', 'piña zamora', '3131313', '2023-05-23', 'O-', 'NAMUEL', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(49, 'cc', '11011432313', 'khabib', 'piña zamora', '3131313', '2023-05-17', 'B-', 'Brasil', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(50, 'cc', '110114131313', 'khabib', 'piña zamora', '3131313', '2023-05-16', 'O-', 'Colomia', 'Sucre', 'Sincejo', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(51, 'cc', '1101143232', 'khabib', 'piña zamora', '3131313', '2023-05-24', 'O+', 'Sucre', 'Sucre', 'Sincelejo', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(53, 'cc', '131313133', 'khabib', 'piña zamora', '3131313212', '2023-05-11', 'O-', 'Brasil', 'Sucre', 'SINCELEJO', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(54, 'cc', '11011443434', 'khabib', 'piña zamora', '3131313231', '2023-05-25', 'O+', 'Colombia', 'Sucre', 'SINCELEJO', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(55, 'cc', '110114545456', 'khabib', 'piña zamora', '3131313', '2023-05-17', 'O-', 'Namuel', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283633292e706e67, 'BRAIKAN.a@gmail.com'),
(56, 'cc', '12211212', 'khabib', 'piña zamora', '3131313', '2023-05-17', 'O-', 'Brasil', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(57, 'cc', '1101143231', 'khabib', 'piña zamora', '3131313', '2023-05-17', 'AB+', 'Brasil', 'Sucre', 'SINCELEJO', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(58, 'ti', '11011411323', 'khabib', 'piña zamora', '3131313', '2023-05-10', 'O+', 'NAMUEL', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(61, 'cc', '11011442424', 'khabib', 'piña zamora', '31313132121', '2023-05-10', 'O-', 'Brasil', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(62, 'ti', '211313', 'khabib', 'piña zamora', '3131313', '2023-05-11', 'O-', 'Brasil', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(63, 'cc', '11011421', 'khabib', 'piña zamora', '3131313', '2023-05-16', 'O+', 'Brasil', 'Sucre', '12212', 0x433a5c66616b65706174685c436170747572612064652070616e74616c6c6120283538292e706e67, 'BRAIKAN.a@gmail.com'),
(64, 'ti', '3455621', 'khabib', 'piña zamora', '3131313', '2023-05-26', 'O-', 'Namuel', 'Sucre', '12212', 0x4172726179, 'BRAIKAN.a@gmail.com'),
(66, 'cc', '11011421323', 'Namuel', 'Solorzano', '310313413', '1111-12-23', 'B-', 'Colombia', 'Sucre', 'Corozal', 0x657374756469616e74655f696d616765732f363435656461646262383464642e, 'BRAIKAN.a@gmail.com'),
(68, 'cc', '231313', 'khabib', 'piña zamora', '3131313', '2023-05-18', 'O-', 'Brasil', 'Sucre', 'SINCELEJO', 0x657374756469616e74655f696d616765732f363435656464306438356465312e, 'BRAIKAN.a@gmail.com'),
(69, 'ti', '25454', 'khabib', 'piña zamora', '3131313', '2023-05-18', 'O-', 'Brasil', 'Sucre', 'SINCELEJO', 0x657374756469616e74655f696d616765732f363435656464376535346638612e, 'BRAIKAN.a@gmail.com'),
(70, 'cc', '110114323', 'khabib', 'piña zamora', '3131313', '2023-05-11', 'O+', 'Brasil', 'Sucre', 'SINCELEJO', 0x657374756469616e74655f696d616765732f363435656534333537323435662e, 'BRAIKAN.a@gmail.com'),
(71, 'cc', '233131432', 'khabib', 'piña zamora', '3131313', '2023-05-11', 'A+', 'Brasil', 'Sucre', 'SINCELEJO', 0x657374756469616e74655f696d616765732f363435666261366334303466342e, 'BRAIKAN.a@gmail.com'),
(72, 'cc', '21212112', 'Messi bebe', 'Te amo', '111999', '2003-12-31', 'A+', 'CAJONERO', 'SAMUEL', 'CAREMONDA', 0x657374756469616e74655f696d616765732f33366230643161613136633732313562333338383335326330646463623630312e6a7067, 'uwu@gmail.com'),
(73, 'cc', '999999321', 'Namuel', 'David', '31321212', '2023-05-17', 'O+', 'colombia', 'sucre', 'sincelejo', 0x657374756469616e74655f696d616765732f33306534323331666434383665323362373638373237326366623239653034382e6a7067, 'steven@gmail.com'),
(74, 'cc', '121421231', 'Namuel de jesus ', 'nAMUEL', '313131', '2004-01-23', 'B+', 'Brasil', 'Sucre', 'SINCELEJO', 0x657374756469616e74655f696d616765732f65623130616134663863306361323736636439346339333938623963376562662e6a7067, 'BRAIKAN.a@gmail.com'),
(75, 'cc', '1104008652', 'Correcto', 'Namuel', '21134141', '2023-05-17', 'A+', 'Venezuela', 'Bolivar', 'San Pedro', 0x657374756469616e74655f696d616765732f65623537366638306336343839336261643563326338663830383033353132612e6a7067, 'namueldejesus@cecar.edu.co');

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
(3, 'se inscribio', '2023-05-10 14:30:00', 1, 1, 45),
(7, 'Inscripción semestre 2023-2', '2023-05-12 09:30:00', 1, 2, 45),
(8, 'Inscripción semestre 2023-2', '2023-05-12 09:30:00', 1, 3, 45),
(13, 'Estudiudate inscrito', '0000-00-00 00:00:00', 1, 3, 46),
(14, 'Estudiudate inscrito', '0000-00-00 00:00:00', 1, 3, 46),
(16, 'Estudiudate inscrito', '0000-00-00 00:00:00', 1, 1, 50),
(17, 'Estudiudate inscrito', '2023-05-11 17:47:12', 3, 2, 46);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libros`
--

CREATE TABLE `libros` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `Editoriales_id` int(11) NOT NULL,
  `imagen` blob NOT NULL,
  `temas_id` int(11) NOT NULL
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
  `fechaInicio` date DEFAULT NULL,
  `fechaFinal` date DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `Estudiantes_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos_has_libros`
--

CREATE TABLE `prestamos_has_libros` (
  `Prestamos_id` int(11) NOT NULL,
  `Libros_id` int(11) NOT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `editoriales_has_direcciones`
--
ALTER TABLE `editoriales_has_direcciones`
  ADD PRIMARY KEY (`Editoriales_id`,`Direcciones_id`),
  ADD KEY `fk_Editoriales_has_Direcciones_Direcciones1` (`Direcciones_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `direccionesestudiantes`
--
ALTER TABLE `direccionesestudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT de la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `libros`
--
ALTER TABLE `libros`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `autores_has_libros`
--
ALTER TABLE `autores_has_libros`
  ADD CONSTRAINT `fk_Autores_has_Libros_Libros1` FOREIGN KEY (`Libros_id`) REFERENCES `libros` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `direccionesestudiantes`
--
ALTER TABLE `direccionesestudiantes`
  ADD CONSTRAINT `fk_direccionesestudiantes_estudiantes1` FOREIGN KEY (`estudiantes_id`) REFERENCES `estudiantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `editoriales_has_direcciones`
--
ALTER TABLE `editoriales_has_direcciones`
  ADD CONSTRAINT `fk_Editoriales_has_Direcciones_Direcciones1` FOREIGN KEY (`Direcciones_id`) REFERENCES `direcciones` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Editoriales_has_Direcciones_Editoriales1` FOREIGN KEY (`Editoriales_id`) REFERENCES `editoriales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `inscripciones`
--
ALTER TABLE `inscripciones`
  ADD CONSTRAINT `fk_Inscripcion_Carrera1` FOREIGN KEY (`Carrera_id`) REFERENCES `carreras` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Inscripcion_Semestre1` FOREIGN KEY (`Semestre_numero`) REFERENCES `semestre` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripciones_estudiantes1` FOREIGN KEY (`estudiantes_id`) REFERENCES `estudiantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
