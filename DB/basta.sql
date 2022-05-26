-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-05-2022 a las 16:05:50
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `basta`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `Id` int(11) NOT NULL,
  `Nombre` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`Id`, `Nombre`) VALUES
(6, 'Español'),
(7, 'Matematicas'),
(8, 'Mar'),
(9, 'a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `catetorneo`
--

CREATE TABLE `catetorneo` (
  `Id` int(11) NOT NULL,
  `IdTorneo` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `catetorneo`
--

INSERT INTO `catetorneo` (`Id`, `IdTorneo`, `IdCategoria`) VALUES
(1, 1, 6),
(2, 2, 8),
(3, 3, 8),
(4, 4, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inscritos`
--

CREATE TABLE `inscritos` (
  `Id` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Pago` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `IdTorneo` int(11) NOT NULL,
  `Factura` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `inscritos`
--

INSERT INTO `inscritos` (`Id`, `Fecha`, `Pago`, `IdUsuario`, `IdTorneo`, `Factura`) VALUES
(7, '2022-04-01', 22, 2, 1, 1),
(9, '0000-00-00', 11, 1, 2, 1),
(12, '2022-04-01', 1000, 1, 1, 0),
(14, '2022-04-15', 10, 13, 1, 1),
(15, '2022-04-08', 1, 22, 1, 0),
(16, '2022-04-06', 1000, 23, 4, 1),
(17, '2022-05-11', 2, 25, 2, 0),
(18, '2022-03-31', 2, 25, 1, 0),
(19, '2022-05-17', 100, 26, 2, 0),
(20, '2022-03-31', 2, 25, 1, 0),
(21, '2022-05-17', 100, 25, 2, 0),
(22, '2022-04-06', 1000, 25, 3, 0),
(23, '2022-05-17', 100, 25, 4, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `palabras`
--

CREATE TABLE `palabras` (
  `Id` int(11) NOT NULL,
  `Palabra` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `palabras`
--

INSERT INTO `palabras` (`Id`, `Palabra`) VALUES
(14, 'divicion'),
(15, 'Literatura'),
(16, 'Calculo'),
(17, 'Animales');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pala_categoria`
--

CREATE TABLE `pala_categoria` (
  `Id` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `IdPalabra` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pala_categoria`
--

INSERT INTO `pala_categoria` (`Id`, `IdCategoria`, `IdPalabra`) VALUES
(1, 6, 16),
(2, 7, 17);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rondas`
--

CREATE TABLE `rondas` (
  `Id` int(11) NOT NULL,
  `Palabra` int(11) NOT NULL,
  `NumeRondas` int(11) NOT NULL,
  `IdInscritos` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `Puntos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rondas`
--

INSERT INTO `rondas` (`Id`, `Palabra`, `NumeRondas`, `IdInscritos`, `IdCategoria`, `Puntos`) VALUES
(1, 5, 3, 7, 6, 100),
(2, 2, 3, 12, 7, 10),
(3, 4, 3, 22, 8, 100),
(4, 2, 1, 23, 6, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `Id` int(11) NOT NULL,
  `Nombre` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`Id`, `Nombre`) VALUES
(1, 'Admin'),
(2, 'Normal'),
(3, 'Juez'),
(15, 'gerente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `torneo`
--

CREATE TABLE `torneo` (
  `Id` int(11) NOT NULL,
  `FechaLimite` date NOT NULL,
  `Fecha` date NOT NULL,
  `Costo` float NOT NULL,
  `TiemRonda` int(11) NOT NULL,
  `Premio` float NOT NULL,
  `HoraInicio` time NOT NULL,
  `NumeRondasMaximas` int(11) NOT NULL,
  `PuntosMeta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `torneo`
--

INSERT INTO `torneo` (`Id`, `FechaLimite`, `Fecha`, `Costo`, `TiemRonda`, `Premio`, `HoraInicio`, `NumeRondasMaximas`, `PuntosMeta`) VALUES
(1, '2022-04-04', '2022-03-31', 102, 142420, 1000, '13:24:21', 4, 88),
(2, '2022-04-01', '2022-03-31', 10, 204500, 100, '20:48:00', 3, 10),
(3, '2022-04-15', '2022-04-14', 69, 14700, 6969, '11:52:00', 69, 69),
(4, '2022-04-19', '2022-04-12', 100, 25, 1000, '09:23:52', 3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Id` int(11) NOT NULL,
  `Email` char(80) NOT NULL,
  `Nombre` char(30) NOT NULL,
  `Apellido` char(30) NOT NULL,
  `Genero` char(1) NOT NULL,
  `Foto` char(4) NOT NULL,
  `Clave` char(44) NOT NULL,
  `FechaUltiAcceso` datetime NOT NULL,
  `IdTipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Id`, `Email`, `Nombre`, `Apellido`, `Genero`, `Foto`, `Clave`, `FechaUltiAcceso`, `IdTipo`) VALUES
(1, 'admin@basta.com', 'Yomero', 'Castro', 'M', '', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', '2022-03-22 16:37:20', 1),
(2, 'ivan@basta.com', 'ivan', 'martinez', 'M', 'png', '*4CEEEA15E6B260BCFB0C183B13E48F65709A969E', '2022-03-24 17:02:24', 2),
(13, 'liz@basta.com', 'liz', 'Ramirez', 'F', '', '*A8D50CBDD2AE882930031E64808821056568FF46', '0000-00-00 00:00:00', 1),
(18, 'q', 'q1', 'q', 'O', '', '', '0000-00-00 00:00:00', 1),
(20, 'ss', 'ssqqa123', 'ss', 'F', '', '*80926D3F75126C85D893B06075303123B69AAD58', '0000-00-00 00:00:00', 1),
(21, 'z', 'z', 'z', 'M', '', '', '0000-00-00 00:00:00', 15),
(22, 'pp', 'pp', 'pp', 'M', '', '*525497F9D524FE25E449610C17BD0E4D83CE3A34', '0000-00-00 00:00:00', 1),
(23, 'pedro@basta.om', 'Pedro', 'R', 'M', '', 'pedro', '2022-04-05 16:24:51', 2),
(24, 'maria@mario.com', 'maria', 'risa', 'F', '', '*8061C323A725701555411A7E18421F077A840CD7', '2022-05-16 17:41:48', 2),
(25, 'jose@jose.com', 'jose', 'martinez', 'H', '', '*9B7E9CB5C7418FF658BE5C710AC2A3688DFAABF8', '2022-05-16 17:42:38', 2),
(26, 'Liz@liz.com', 'liz', 'ramirez', 'F', '', '*A8D50CBDD2AE882930031E64808821056568FF46', '2022-05-16 17:42:38', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `catetorneo`
--
ALTER TABLE `catetorneo`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdTorneo_2` (`IdTorneo`,`IdCategoria`),
  ADD KEY `catetorneo_categoria` (`IdCategoria`);

--
-- Indices de la tabla `inscritos`
--
ALTER TABLE `inscritos`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdUsuario_3` (`IdUsuario`,`IdTorneo`);

--
-- Indices de la tabla `palabras`
--
ALTER TABLE `palabras`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `pala_categoria`
--
ALTER TABLE `pala_categoria`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `palacategoria_categoria` (`IdCategoria`),
  ADD KEY `palacategoria_palabra` (`IdPalabra`);

--
-- Indices de la tabla `rondas`
--
ALTER TABLE `rondas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `rondas-categoria` (`IdCategoria`),
  ADD KEY `IdInscritos` (`IdInscritos`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `torneo`
--
ALTER TABLE `torneo`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD KEY `usuario-tipo` (`IdTipo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `catetorneo`
--
ALTER TABLE `catetorneo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `inscritos`
--
ALTER TABLE `inscritos`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `palabras`
--
ALTER TABLE `palabras`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `pala_categoria`
--
ALTER TABLE `pala_categoria`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `rondas`
--
ALTER TABLE `rondas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `torneo`
--
ALTER TABLE `torneo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `catetorneo`
--
ALTER TABLE `catetorneo`
  ADD CONSTRAINT `catetorneo-torneo` FOREIGN KEY (`IdTorneo`) REFERENCES `torneo` (`Id`),
  ADD CONSTRAINT `catetorneo_categoria` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`Id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `inscritos`
--
ALTER TABLE `inscritos`
  ADD CONSTRAINT `inscrito-usuario` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `inscritos_torneo` FOREIGN KEY (`IdTorneo`) REFERENCES `torneo` (`Id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `pala_categoria`
--
ALTER TABLE `pala_categoria`
  ADD CONSTRAINT `palacategoria_categoria` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `palacategoria_palabra` FOREIGN KEY (`IdPalabra`) REFERENCES `palabras` (`Id`);

--
-- Filtros para la tabla `rondas`
--
ALTER TABLE `rondas`
  ADD CONSTRAINT `rondas-Inscritos` FOREIGN KEY (`IdInscritos`) REFERENCES `inscritos` (`Id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `rondas-categoria` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`Id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario-tipo` FOREIGN KEY (`IdTipo`) REFERENCES `tipousuario` (`Id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
