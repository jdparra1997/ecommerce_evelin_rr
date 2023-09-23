-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 06-12-2021 a las 18:53:39
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_ecommerce`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `codped` int(11) NOT NULL,
  `codusu` int(11) NOT NULL,
  `codpro` int(11) NOT NULL,
  `fecped` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `dirusuped` varchar(50) COLLATE utf8_bin NOT NULL,
  `telusuped` varchar(12) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`codped`, `codusu`, `codpro`, `fecped`, `estado`, `dirusuped`, `telusuped`) VALUES
(11, 2, 14, '2021-10-30 18:19:27', 0, 'Calle 1', '111'),
(12, 2, 19, '2021-10-30 18:19:33', 0, 'Calle 1', '111'),
(13, 2, 18, '2021-10-30 18:25:46', 0, '1111', '111'),
(14, 1, 20, '2021-11-03 16:33:45', 0, 'Calle 1', '123 456 7890'),
(15, 1, 14, '2021-11-03 16:33:50', 0, 'Calle 1', '123 456 7890'),
(16, 1, 13, '2021-11-03 16:36:53', 0, 'Calle 23', '23'),
(17, 1, 14, '2021-11-03 16:36:59', 4, 'Calle 23', '23'),
(18, 3, 22, '2021-11-03 17:51:24', 0, '1', '1'),
(19, 3, 14, '2021-11-03 18:34:32', 0, '1', '1'),
(20, 3, 13, '2021-11-03 18:34:36', 0, '1', '1'),
(21, 3, 22, '2021-11-03 18:34:43', 0, '1', '1'),
(22, 3, 14, '2021-11-04 21:42:46', 0, '1', '1'),
(23, 3, 13, '2021-11-04 21:42:50', 0, '1', '1'),
(24, 2, 19, '2021-12-06 07:25:00', 2, 'Calle 1', '311'),
(25, 2, 20, '2021-12-06 08:35:44', 0, 'Calle 1', '310');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `codpro` int(11) NOT NULL,
  `nompro` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `despro` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `prepro` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `rutimapro` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `canpro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`codpro`, `nompro`, `despro`, `prepro`, `estado`, `rutimapro`, `canpro`) VALUES
(13, 'Audifonos bluethoot rosa', 'Audifonos Bluethoot con orejas de gato color ROSA', 45000, 1, '20211019164024.jpg', 2),
(14, 'Mouse Rosa', 'Mouse Color Rosa', 35000, 1, '20211019164446.jpg', 8),
(18, 'Aro de Luz & Tripode', 'Aro de luz LED recargable, 26 cm. TrÃ­pode ajustable de 70cm de ancho ', 100000, 1, '20211021183441.jpg', 5),
(19, 'Diadema Bluethoot', 'Diadema Bluethoot variedad de colores', 70000, 1, '20211021183602.jpg', 8),
(20, 'Cable Auxiliar 3M', 'Cable Auxiliar Jack 3,5mm de 3 Metros', 10000, 1, '20211021183724.jpg', 10),
(21, 'Micro SD 32gb', 'Tarjeta Micro SD de 32Gb Sandisk original no fake', 24000, 1, '20211021183939.jpg', 15),
(22, 'Audifonos Inalambricos', 'Audifonos Inalambricos i12', 25000, 1, '20211021184026.jpg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `codusu` int(11) NOT NULL,
  `nomusu` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `apeusu` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `emausu` varchar(50) COLLATE utf8_bin NOT NULL,
  `pasusu` varchar(20) COLLATE utf8_bin NOT NULL,
  `rolusu` varchar(20) COLLATE utf8_bin NOT NULL,
  `estado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`codusu`, `nomusu`, `apeusu`, `emausu`, `pasusu`, `rolusu`, `estado`) VALUES
(1, 'Usuario', 'Demo', 'correo@example.com', '123456', 'Usuario', 1),
(2, 'Admin', 'Prueba', 'admin@gmail.com', 'admin123', 'Administrador', 1),
(3, 'Camilo', 'Salazar', 'juansacruz06@gmail.com', 'juan06', 'Usuario', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`codped`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`codpro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`codusu`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `codped` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `codpro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `codusu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
