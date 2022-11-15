-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-11-2022 a las 20:13:21
-- Versión del servidor: 10.4.25-MariaDB
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_anuros`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anuros`
--

CREATE TABLE `anuros` (
  `id` int(11) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `especie` varchar(50) NOT NULL,
  `familia` varchar(50) NOT NULL,
  `conservacion` varchar(50) NOT NULL,
  `id_ecosistema_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `anuros`
--

INSERT INTO `anuros` (`id`, `foto`, `especie`, `familia`, `conservacion`, `id_ecosistema_fk`) VALUES
(1, 'oophaga_pumilio.jpg', 'Oophaga pumilio', 'Dendrobatidae', 'Preocupación menor (LC)', 1),
(2, 'rhacophorus_nigropalmatus.jpg', 'Rhacophorus nigropalmatus', 'Rhacophoridae', 'Preocupación menor (LC)', 1),
(3, 'breviceps_macrops.jpg', 'Breviceps macrops', 'Brevicipitidae', 'Casi amenazado (NT)', 2),
(4, 'hylorina_sylvatica.jpg', 'Hylorina sylvatica', 'Batrachylidae', 'Preocupación menor (LC)', 1),
(5, 'anaxyrus_punctatus.jpg', 'Anaxyrus punctatus', 'Bufonidae', 'Preocupación menor (LC)', 2),
(6, 'pelophylax_ridibundus.jpg', 'Pelophylax ridibundus', 'Ranidae', 'Preocupación menor (LC)', 4),
(7, 'lithobates_heckscheri.jpg', 'Lithobates heckscheri', 'Ranidae', 'Preocupación menor (LC)', 4),
(8, 'lithobates_sylvaticus.jpg', 'Lithobates sylvaticus', 'Ranidae', 'Preocupación menor (LC)', 5),
(34, 'test.jpg', 'test', 'test', 'test', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ecosistemas`
--

CREATE TABLE `ecosistemas` (
  `id_e` int(11) NOT NULL,
  `ecosistema` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `ecosistemas`
--

INSERT INTO `ecosistemas` (`id_e`, `ecosistema`) VALUES
(1, 'Bosque Tropical'),
(2, 'Desierto'),
(3, 'Matorral'),
(4, 'Pantano'),
(5, 'Bosque Boreal');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `anuros`
--
ALTER TABLE `anuros`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ecosistema_fk` (`id_ecosistema_fk`);

--
-- Indices de la tabla `ecosistemas`
--
ALTER TABLE `ecosistemas`
  ADD PRIMARY KEY (`id_e`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `anuros`
--
ALTER TABLE `anuros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `ecosistemas`
--
ALTER TABLE `ecosistemas`
  MODIFY `id_e` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `anuros`
--
ALTER TABLE `anuros`
  ADD CONSTRAINT `fk_anuros_ecosistemas` FOREIGN KEY (`id_ecosistema_fk`) REFERENCES `ecosistemas` (`id_e`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
