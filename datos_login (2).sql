-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 20-12-2024 a las 23:04:38
-- Versión del servidor: 8.3.0
-- Versión de PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `datos_login`
--
CREATE DATABASE IF NOT EXISTS `datos_login` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `datos_login`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

DROP TABLE IF EXISTS `alumnos`;
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo_alumno` varchar(30) NOT NULL,
  `restringido` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id`, `nombres`, `apellidos`, `correo_alumno`, `restringido`) VALUES
(2, 'carlos', 'sanchez', 'carlosdasilva2905@gmail.com', 0),
(4, 'mario', 'gutierrez', 'mario@gmail.com', 0),
(5, 'alberto', 'Singapur', 'alberto@gmail.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesores`
--

DROP TABLE IF EXISTS `profesores`;
CREATE TABLE IF NOT EXISTS `profesores` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `correo_profe` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `profesores`
--

INSERT INTO `profesores` (`id`, `nombres`, `apellidos`, `correo_profe`) VALUES
(4, 'jorginho', 'figueira', 'figueiramanuel3009@gmail.com'),
(1, 'jorginho', 'sanchez', 'manuelhfugueirav@gmail.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

DROP TABLE IF EXISTS `registro`;
CREATE TABLE IF NOT EXISTS `registro` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `fecha_nac` date NOT NULL,
  `mail` text NOT NULL,
  `cedula` int NOT NULL,
  `telefono` int NOT NULL,
  `usuario` varchar(30) NOT NULL,
  `contrasenia` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `restringido` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id`, `nombres`, `apellidos`, `fecha_nac`, `mail`, `cedula`, `telefono`, `usuario`, `contrasenia`, `restringido`) VALUES
(1, 'jorginho', 'sanchez', '2006-02-20', 'manuelhfugueirav@gmail.com', 8585, 716, 'iefnvo9n', '827ccb0eea8a706c4c34a16891f84e7b', 0),
(2, 'Carlos Eduardo', 'Da Silva De sousa', '2005-07-06', 'carlosdasilva2905@gmail.com', 30793351, 9404344, 'cedd', '827ccb0eea8a706c4c34a16891f84e7b', 1),
(3, 'jose', 'arriaga', '2005-01-17', 'jose170105@gmail.com', 30792829, 2147483647, 'jose', '81dc9bdb52d04dc20036dbd8313ed055', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
