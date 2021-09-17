-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3308
-- Tiempo de generación: 17-09-2021 a las 20:18:48
-- Versión del servidor: 5.7.31
-- Versión de PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gamer-x`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Accion'),
(2, 'Aventura'),
(3, 'Terror'),
(4, 'Deportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_pedidos`
--

DROP TABLE IF EXISTS `lineas_pedidos`;
CREATE TABLE IF NOT EXISTS `lineas_pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `pedido_id` int(255) NOT NULL,
  `producto_id` int(255) NOT NULL,
  `unidades` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_linea_pedido` (`pedido_id`),
  KEY `fk_linea_producto` (`producto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
CREATE TABLE IF NOT EXISTS `pedidos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `usuario_id` int(255) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `localidad` varchar(100) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `coste` float(200,2) NOT NULL,
  `estado` varchar(20) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_pedido_usuario` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

DROP TABLE IF EXISTS `productos`;
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `categoria_id` int(255) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  `precio` float(100,2) NOT NULL,
  `stock` int(255) NOT NULL,
  `oferta` varchar(2) DEFAULT NULL,
  `fecha` date NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_producto_categoria` (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `categoria_id`, `nombre`, `descripcion`, `precio`, `stock`, `oferta`, `fecha`, `imagen`) VALUES
(2, 2, 'The Last of Us - Remasterizado', ' PlayStation 4', 499.00, 14, NULL, '2021-09-17', 'last_of_us_remaster.jpg'),
(3, 4, 'Fifa 21', ' PlayStation 4', 749.00, 13, NULL, '2021-09-17', 'el_fefa_2021_ps4.jpg'),
(4, 3, 'Resident Evil VII', ' PlayStation 4', 643.00, 4, NULL, '2021-09-17', 're_vii_doradito_ps4_1.jpg'),
(5, 1, 'Days Gone', ' Playstation 4', 551.00, 21, NULL, '2021-09-17', 'days_gone_1.jpg'),
(6, 4, 'NBA 2K21', ' PlayStation 4', 1119.00, 45, NULL, '2021-09-17', 'nba_2k22_ps4_1.jpg'),
(7, 2, 'Horizon Zero Dawn', ' PlayStation 4', 551.00, 13, NULL, '2021-09-17', 'horizon_completa_.jpg'),
(8, 1, 'The Witcher 3', ' PlayStation 4', 799.00, 50, NULL, '2021-09-17', 'the_witcher_3_ps4_1.jpg'),
(9, 2, 'Assassins Creed Odyssey', ' Xbox One', 505.00, 12, NULL, '2021-09-17', 'odyssey_xbx_1.jpg'),
(10, 1, 'Batman Arkham Kinght', ' Xbox One', 300.00, 23, NULL, '2021-09-17', 'batman-arkham-knight-one_3_1.jpg'),
(11, 3, 'The Evil Within 2', ' Xbox One', 299.00, 39, NULL, '2021-09-17', 'the-evil-within-2-one_1_1.jpg'),
(12, 3, 'The Dark Pictures Man of Medan', 'PlayStation 4', 249.00, 13, NULL, '2021-09-17', 'dark-pictures-ps4_3.jpg'),
(13, 1, 'Spider-Man Miles Morales', ' PlayStation 4', 1260.00, 53, NULL, '2021-09-17', 'millas_morales_plei_4.jpg'),
(14, 1, 'Watch Dogs Legion', ' PlayStation 5', 899.00, 21, NULL, '2021-09-17', 'watch-dogs-legion-ps5_2_1.jpg'),
(15, 2, 'Jedi Fallen Order', ' Xbox One', 649.00, 7, NULL, '2021-09-17', 'jedi_fallen_order_xbox.jpg'),
(16, 2, 'Demon\'s Souls', ' PlayStation 5', 1799.00, 22, NULL, '2021-09-17', 'demon_souls_1.jpg'),
(17, 1, 'Code Vein', ' PlayStation 4', 449.00, 4, NULL, '2021-09-17', 'codigo_venoso_pas4_1.jpg'),
(18, 3, 'Resident Evil Village', ' PlayStation 4', 1529.00, 30, NULL, '2021-09-17', 're8_ps4_1_1.jpg'),
(19, 3, 'Outlast Trinity', ' Xbox One', 649.00, 15, NULL, '2021-09-17', 'outlast-trinity-one.jpg'),
(20, 4, 'Madden NFL 22', ' PlayStation 5', 1609.00, 27, NULL, '2021-09-17', 'madden_22_ps5_1.jpg'),
(21, 4, 'Tony Haws Pro Skater', ' Xbox One', 799.00, 8, NULL, '2021-09-17', 'tony-hawk-one_1_1.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellidos` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(20) DEFAULT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uq_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellidos`, `email`, `password`, `rol`, `imagen`) VALUES
(1, 'Admin', 'Admin', 'admin@admin.com', 'contraseña', 'admin', NULL),
(2, 'Darnell', 'Armas', 'dar@gmail.com', '$2y$04$MXabyrd9zAX8sq6YNE2xleVE4ooKj2oKuQNGisfvfGYBmT.XdiCoy', 'admin', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `lineas_pedidos`
--
ALTER TABLE `lineas_pedidos`
  ADD CONSTRAINT `fk_linea_pedido` FOREIGN KEY (`pedido_id`) REFERENCES `pedidos` (`id`),
  ADD CONSTRAINT `fk_linea_producto` FOREIGN KEY (`producto_id`) REFERENCES `productos` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedido_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_producto_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
