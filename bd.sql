-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2014 a las 11:31:48
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `diet`
--
CREATE DATABASE IF NOT EXISTS `diet` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `diet`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dishes`
--

CREATE TABLE IF NOT EXISTS `dishes` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `kcal` int(11) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Volcado de datos para la tabla `dishes`
--

INSERT INTO `dishes` (`id`, `name`, `kcal`, `type`) VALUES
(1, 'Coliflor con patata', 99, 1),
(2, 'Hamburguesa a la plancha', 140, 2),
(3, 'Crema de calabacín', 74, 1),
(4, 'Pescado blanco plancha / horno', 125, 2),
(5, 'Arroz a la jardinera', 117, 1),
(6, 'Gambas al ajillo', 115, 2),
(7, 'Acelgas con patatas', 100, 1),
(8, 'Tortilla francesa con quesito light', 103, 2),
(9, 'Patatas al horno', 127, 1),
(10, 'Pollo a la plancha', 140, 2),
(11, 'Sopa', 93, 1),
(12, 'Calamares a la plancha', 98, 2),
(13, 'Guisantes salteados', 131, 1),
(14, 'Filete de ternera a la plancha', 130, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ingredients`
--

CREATE TABLE IF NOT EXISTS `ingredients` (
  `iddishes` int(11) NOT NULL,
  `idingredient` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `ingredients`
--

INSERT INTO `ingredients` (`iddishes`, `idingredient`, `name`, `weight`) VALUES
(1, 1, 'Coliflor', 100),
(1, 2, 'Patatas', 250);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dishes`
--
ALTER TABLE `dishes`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ingredients`
--
ALTER TABLE `ingredients`
 ADD KEY `iddishes` (`iddishes`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dishes`
--
ALTER TABLE `dishes`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
