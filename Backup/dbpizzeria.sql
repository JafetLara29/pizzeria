-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 09-05-2022 a las 16:06:32
-- Versión del servidor: 10.5.12-MariaDB
-- Versión de PHP: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id18453827_dbpizzeria`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbaccount`
--

CREATE TABLE `tbaccount` (
  `id` int(7) NOT NULL,
  `user` varchar(100) COLLATE utf8_bin NOT NULL,
  `password` varchar(100) COLLATE utf8_bin NOT NULL,
  `type` char(1) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbaccount`
--

INSERT INTO `tbaccount` (`id`, `user`, `password`, `type`) VALUES
(1, 'admin', 'admin', 'a'),
(2, 'Yimy', '1234', 'd'),
(3, 'JafetLara', '29112000', 'c'),
(4, 'Luis Valerio', 'laroskymelapela', 'c'),
(5, 'Trafalgar', '1234', 'c'),
(6, 'Alfredantonio13@gmail.com ', 'tLY3iMrmwi8Sr43', 'c'),
(7, 'Jona_guitar ', 'JONATAN12', 'c'),
(8, 'flori', 'Amarilloazul', 'c'),
(9, 'PILO ', 'Tanjiro16Nezuko', 'c'),
(10, 'Lizethsolorzano', 'Liz123', 'c'),
(11, 'Lizsolorzano', 'liz123', 'c'),
(12, 'Manuel', 'mrvg', 'c'),
(13, 'Andrés Hernández Arguedas ', 'a1234', 'c'),
(14, 'Andrés Hernández ', 'a1234', 'c'),
(15, 'Cárlos', 'carlosLara', 'c');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbclient`
--

CREATE TABLE `tbclient` (
  `id` int(7) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `lastname` varchar(100) COLLATE utf8_bin NOT NULL,
  `address` varchar(500) COLLATE utf8_bin NOT NULL,
  `phone_number` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbclient`
--

INSERT INTO `tbclient` (`id`, `name`, `lastname`, `address`, `phone_number`) VALUES
(1, 'admin', 'admin', 'admin', '1'),
(2, 'Deliver', 'Deliver', 'Deliver', '1'),
(3, 'Jafet', 'Lara Lopez', '150m norte de la parada de la chavez', '61051138'),
(4, 'Luis', 'Antonio', '50 metros sur y 50 oeste del ebais en colonia cubujuqui Horquetas Sarapiquí', '84231122'),
(5, 'Yimbito', 'Nakano', 'Ciudad z', '62311582'),
(6, 'Alfred Antonio', 'López', 'La Chaves', '85271986'),
(7, 'Jonatan ', 'Hernandez Arguedas ', 'Horquetas de sarapiqui, en la esperanza 100m norte de la soda la capacidad edificio a mano derecha ', '86365678'),
(8, 'Floriana', 'Hernández Masis', 'Heredia', '88036505'),
(9, 'Alexis', 'Aburto', 'Horquetas, El Mortero 125m NO y 150m NE de la escuela  La Paz.', '61536592'),
(10, 'Lizeth', 'Solorzano', '25mts Norte de la iglesia', '86517649'),
(11, 'Lis', 'Solorzano ', '25mt norte', '86517649'),
(12, 'Manuel ', 'Valerio', 'Cubujuqui, Horquetas', '60040534'),
(13, 'Andrés ', 'Hernández Arguedas ', 'Cubujuqui ', '89943965'),
(14, 'Andrés ', 'Hernández Arguedas ', 'Cubujuqui ', '89943965'),
(15, 'Carlos', 'Lara', '150m Norte Parada Chávez', '61051138');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbinventary`
--

CREATE TABLE `tbinventary` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_bin NOT NULL,
  `description` varchar(200) COLLATE utf8_bin NOT NULL,
  `price` int(11) NOT NULL,
  `image_path` varchar(100) COLLATE utf8_bin NOT NULL,
  `type` varchar(9) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbinventary`
--

INSERT INTO `tbinventary` (`id`, `name`, `description`, `price`, `image_path`, `type`) VALUES
(1, 'Pizza de Jamon y queso', 'Salsa especial, queso, jamon', 0, 'pizza2.jpg', 'pizza'),
(2, 'Pizza Napolitana', 'Deliciosa pizza napolitana', 7000, 'pizza2.jpg', 'pizza'),
(3, 'Pizza pepperoni', 'Deliciosa pizza de pepperoni', 7000, 'pizza2.jpg', 'pizza'),
(4, 'Pizza BrasileÃ±a', 'Deliciosa pizza brasileÃ±a', 0, 'pizza2.jpg', 'pizza'),
(5, 'Pizza Hawaiana', 'Deliciosa pizza', 0, 'pizza1.jpg', 'pizza'),
(6, 'Pizza Mexicana', 'Deliciosa pizza', 2, 'pizza3.jpg', 'pizza'),
(7, 'Pizza', 'Deliciosa pizza', 5343, 'pizza-card.jpg', 'pizza'),
(8, 'Pizza', 'Deliciosa pizza', 345345, 'pizza1.jpg', 'pizza'),
(9, 'Pizza', 'Deliciosa pizza', 34543, 'pizza2.jpg', 'pizza'),
(10, 'Pepsi 2L', 'Pepsi de 2 litros', 1500, 'cocacola.jpg', 'beverage'),
(11, 'Coca Cola 2L', 'Coca Cola de 2 Litros', 2000, 'cocacola.jpg', 'beverage'),
(12, 'Pizza francesa', 'Deliciosa pizza francesa', 0, 'pizza2.jpg', 'pizza'),
(13, 'PequeÃ±a', '5 slides', 5000, '-', 'tamanio'),
(14, 'Mediana', '7 slides', 7000, '-', 'tamanio'),
(15, 'Grande', '12 slides', 12000, '-', 'tamanio'),
(16, 'Familiar', '16 slides', 14000, '-', 'tamanio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbnote`
--

CREATE TABLE `tbnote` (
  `id` int(3) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(200) COLLATE utf8_bin NOT NULL,
  `note` varchar(300) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tbnote`
--

INSERT INTO `tbnote` (`id`, `date`, `title`, `note`) VALUES
(1, '2022-02-08', 'Llamar al proveedor de refrescos', 'Quedan pocas existencias'),
(2, '2022-02-08', 'Queda poco queso', 'Ir por queso'),
(3, '2022-02-08', 'Implementar nueva pizza', 'Pizza brasileÃ±a. Seguir reseta: youtube.com/resetapizzabrasileÃ±a');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tborder`
--

CREATE TABLE `tborder` (
  `id` int(9) NOT NULL,
  `clientid` int(9) NOT NULL,
  `client_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `client_lastname` varchar(100) COLLATE utf8_bin NOT NULL,
  `client_phone_number` varchar(100) COLLATE utf8_bin NOT NULL,
  `client_address` varchar(100) COLLATE utf8_bin NOT NULL,
  `pizza` varchar(200) COLLATE utf8_bin NOT NULL,
  `size` varchar(200) COLLATE utf8_bin NOT NULL,
  `beverage` varchar(200) COLLATE utf8_bin NOT NULL,
  `comment` varchar(100) COLLATE utf8_bin NOT NULL,
  `state` int(1) NOT NULL DEFAULT 0,
  `date` date DEFAULT NULL,
  `total` int(100) NOT NULL,
  `number_beverages` int(3) NOT NULL,
  `xpress` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `tborder`
--

INSERT INTO `tborder` (`id`, `clientid`, `client_name`, `client_lastname`, `client_phone_number`, `client_address`, `pizza`, `size`, `beverage`, `comment`, `state`, `date`, `total`, `number_beverages`, `xpress`) VALUES
(1, 4, '-', '-', '-', '-', '1', '14', '11', 'Prueba', 3, '2022-02-21', 9000, 1, 1),
(2, 0, 'rayel fernanda', 'valerio mora', '3333333', 'la chavez', '1', '14', 'Ninguno', 'demen a luis sabroso', 2, '2022-02-22', 7000, 0, 1),
(3, 0, 'Luis', 'Antonio', '8423112', 'Cubujuquí', '1', '15', '11', 'Nada', 3, '2022-02-23', 14000, 1, 1),
(4, 4, '-', '-', '-', '-', '1-6', '15-16', 'Ninguno', 'Prueba', 3, '2022-02-26', 26000, 0, 1),
(6, 0, 'Jafet', 'Lara', '61062323', '-', '4', '16', '11', 'Nada', 2, '2022-03-05', 16000, 1, 0),
(7, 3, '-', '-', '-', '-', '2-5', '15-15', '10-10', 'Con los bordes bien rellenos', 2, '2022-03-05', 27000, 2, 0),
(8, 3, '-', '-', '-', '-', '2', '16', 'Ninguno', 'Nada', 2, '2022-03-05', 14000, 0, 1),
(9, 0, 'Luis', 'Antonio', '84231122', 'Cubujuquí', '1', '14', '10', 'Extra queso', 3, '2022-03-07', 8500, 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbaccount`
--
ALTER TABLE `tbaccount`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbclient`
--
ALTER TABLE `tbclient`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbinventary`
--
ALTER TABLE `tbinventary`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tbnote`
--
ALTER TABLE `tbnote`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tborder`
--
ALTER TABLE `tborder`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
