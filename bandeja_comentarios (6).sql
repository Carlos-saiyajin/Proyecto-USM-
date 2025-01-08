-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 04-01-2025 a las 22:29:18
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
-- Base de datos: `bandeja_comentarios`
--
CREATE DATABASE IF NOT EXISTS `bandeja_comentarios` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `bandeja_comentarios`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `comentario` varchar(500) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `nombre`, `comentario`, `fecha`) VALUES
(45, 'jorginho sanchez', 'hola', '2024-12-21 02:09:33'),
(44, 'jorginho sanchez', 'hola buenos dias', '2024-12-12 14:32:53'),
(43, 'jorginho sanchez', 'hola', '2024-12-11 18:49:10'),
(42, 'jorginho sanchez', 'chao', '2024-12-07 23:21:02'),
(40, 'Manuel figueira valbuena', 'buenos dias', '2024-12-02 15:07:04'),
(41, 'Manuel figueira valbuena', 'como estas', '2024-12-02 15:10:23'),
(37, 'Manuel figueira valbuena', 'bien y tu?', '2024-11-28 19:33:35'),
(36, 'jorginho sanchez', 'como estas', '2024-11-28 19:32:53'),
(35, 'jorginho sanchez', 'buenas noches', '2024-11-28 19:32:44'),
(34, 'Manuel figueira valbuena', 'buenos dias', '2024-11-28 19:32:07'),
(46, 'jorginho sanchez', 'berro si chamo', '2024-12-21 02:10:14'),
(47, 'jorginho sanchez', 'wao ', '2024-12-21 02:10:21'),
(48, 'jorginho sanchez', 'hola', '2024-12-21 02:19:00'),
(49, 'jorginho sanchez', 'dddd', '2024-12-21 02:19:05'),
(50, 'jorginho sanchez', 'qwdq', '2024-12-21 02:19:08'),
(51, 'jorginho sanchez', 'hola buenos días familia', '2024-12-21 02:25:46');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
