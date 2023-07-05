-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 05-07-2023 a las 07:27:19
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `constructora`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_permisos`
--

CREATE TABLE `detalle_permisos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_permiso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `detalle_permisos`
--

INSERT INTO `detalle_permisos` (`id`, `id_usuario`, `id_permiso`) VALUES
(429, 3, 1),
(430, 3, 2),
(431, 3, 3),
(432, 3, 4),
(433, 3, 5),
(434, 3, 6),
(435, 3, 7),
(436, 3, 8),
(437, 3, 9),
(438, 3, 10),
(439, 3, 11),
(440, 3, 12),
(441, 3, 13),
(442, 3, 14),
(443, 3, 15),
(444, 3, 16),
(445, 3, 17),
(446, 3, 18),
(447, 3, 19),
(448, 3, 20),
(449, 3, 21),
(450, 3, 22),
(451, 3, 23),
(452, 3, 24),
(477, 20, 2),
(478, 20, 3),
(479, 20, 4),
(480, 20, 5),
(481, 20, 6),
(482, 20, 7),
(483, 20, 8),
(484, 20, 9),
(485, 20, 10),
(486, 20, 11),
(487, 20, 12),
(488, 20, 13),
(489, 20, 14),
(490, 20, 15),
(491, 20, 16),
(492, 20, 17),
(493, 20, 18),
(494, 20, 19),
(495, 20, 20),
(496, 20, 21),
(497, 20, 22),
(498, 20, 23),
(499, 20, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `elementos`
--

CREATE TABLE `elementos` (
  `id_elemento` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `elementos`
--

INSERT INTO `elementos` (`id_elemento`, `nombre`) VALUES
(1, 'Piso'),
(2, 'Techo'),
(3, 'Pared');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `id` int(11) NOT NULL,
  `idElemento` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `nomMaterial` varchar(150) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioBajoMate` decimal(10,2) NOT NULL,
  `precioMedioMate` decimal(10,2) NOT NULL,
  `precioAltoMate` decimal(10,2) NOT NULL,
  `precioBajoT` decimal(10,2) NOT NULL,
  `precioMedioT` decimal(10,2) NOT NULL,
  `precioAltoT` decimal(10,2) NOT NULL,
  `fechaEnv` datetime NOT NULL,
  `manoObra` decimal(10,2) NOT NULL,
  `manoObra1` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial`
--

INSERT INTO `historial` (`id`, `idElemento`, `idUser`, `nomMaterial`, `cantidad`, `precioBajoMate`, `precioMedioMate`, `precioAltoMate`, `precioBajoT`, `precioMedioT`, `precioAltoT`, `fechaEnv`, `manoObra`, `manoObra1`) VALUES
(0, 3, 1, 'Pintura', 10, 950.00, 980.00, 1020.00, 952.40, 982.40, 1022.40, '2023-07-05 00:12:58', 2.40, 2.40),
(0, 3, 1, 'Papel Pintado', 4, 300.00, 320.00, 360.00, 1254.44, 1304.44, 1384.44, '2023-07-05 00:12:58', 2.04, 4.44),
(0, 1, 1, 'Cemento Pulido', 10, 170.00, 180.00, 200.00, 171.20, 181.20, 201.20, '2023-07-05 00:13:33', 1.20, 1.20),
(0, 1, 1, 'Losa Aligerada', 10, 1600.00, 1790.00, 2000.00, 1773.20, 1973.20, 2203.20, '2023-07-05 00:13:33', 2.00, 3.20),
(0, 2, 1, 'calaminas', 1, 25.00, 30.00, 32.00, 26.25, 31.25, 33.25, '2023-07-05 00:22:22', 1.25, 1.25),
(0, 2, 1, 'calaminas', 1, 25.00, 30.00, 32.00, 26.25, 31.25, 33.25, '2023-07-05 00:24:10', 1.25, 1.25),
(0, 2, 1, 'Techo Trapezoidal PV4 1.05 m x 3.60m 0.30 mm', 5, 604.50, 634.50, 654.50, 631.95, 666.95, 688.95, '2023-07-05 00:24:10', 1.20, 2.45);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(150) NOT NULL,
  `id_medida` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precioBajo` decimal(10,2) NOT NULL,
  `precioMedio` decimal(10,2) NOT NULL,
  `precioAlto` decimal(10,2) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1,
  `id_elemento` int(11) NOT NULL,
  `totalBajo` decimal(10,2) NOT NULL,
  `totalMedio` decimal(10,2) NOT NULL,
  `totalAlto` decimal(10,2) NOT NULL,
  `manoObra` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id`, `nombre`, `id_medida`, `cantidad`, `precioBajo`, `precioMedio`, `precioAlto`, `estado`, `id_elemento`, `totalBajo`, `totalMedio`, `totalAlto`, `manoObra`) VALUES
(1, 'Cerámica Lisa', 1, 100, 18.90, 20.90, 40.90, 0, 1, 18.90, 20.90, 40.90, 0.00),
(2, 'Pintura', 3, 50, 95.00, 98.00, 102.00, 1, 3, 47.50, 49.00, 51.00, 12.00),
(3, 'calaminas', 1, 5, 25.00, 30.00, 32.00, 1, 2, 1.25, 1.50, 1.60, 12.50),
(7, 'Cemento Pulido', 1, 100, 17.00, 18.00, 20.00, 1, 1, 17.00, 18.00, 20.00, 12.00),
(8, 'Losa Aligerada', 1, 100, 160.00, 179.00, 200.00, 1, 1, 160.00, 179.00, 200.00, 20.00),
(9, 'foco', 1, 2, 17.00, 20.00, 22.00, 1, 2, 0.34, 0.40, 0.44, 0.00),
(10, 'Pavimento de Hidrocondreto', 2, 20, 100.00, 104.00, 110.00, 1, 1, 20.00, 20.80, 22.00, 0.00),
(11, 'Papel Pintado', 1, 20, 75.00, 80.00, 90.00, 1, 3, 15.00, 16.00, 18.00, 10.20),
(12, 'Paneles de Madera', 1, 45, 40.00, 48.00, 50.00, 1, 3, 18.00, 21.60, 22.50, 0.00),
(13, 'Azulejo', 1, 60, 7.00, 8.50, 10.00, 1, 3, 4.20, 5.10, 6.00, 0.00),
(14, 'Vinilo', 1, 100, 70.00, 75.00, 80.00, 1, 1, 70.00, 75.00, 80.00, 0.00),
(15, 'Alfombra', 1, 50, 20.90, 22.90, 24.90, 1, 1, 10.45, 11.45, 12.45, 0.00),
(16, 'mmmmmm', 2, 65, 3.00, 65.00, 56.00, 0, 3, 1.95, 42.25, 36.40, 0.00),
(17, 'Baldosas', 1, 100, 24.00, 44.00, 54.00, 1, 1, 24.00, 44.00, 54.00, 0.00),
(18, 'Cielo Raso', 4, 40, 16.50, 18.12, 20.00, 1, 2, 6.60, 7.25, 8.00, 0.00),
(19, 'Zocalo 0.1 m * 0.45 m', 5, 2222, 11.00, 17.00, 25.00, 1, 1, 244.42, 377.74, 555.50, 0.00),
(20, 'Techo Trapezoidal PV4 1.05 m x 3.60m 0.30 mm', 1, 48, 120.90, 126.90, 130.90, 1, 2, 58.03, 60.91, 62.83, 12.00);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medidas`
--

CREATE TABLE `medidas` (
  `id` int(11) NOT NULL,
  `medida` varchar(50) NOT NULL,
  `diminutivo` varchar(50) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medidas`
--

INSERT INTO `medidas` (`id`, `medida`, `diminutivo`, `estado`) VALUES
(1, 'Metros', 'm', 1),
(2, 'Kilo Gramos', 'Kg', 1),
(3, 'Galones', 'Gl', 1),
(4, 'Unidad', 'Ud.', 1),
(5, 'metro lineal', 'Ml', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `id` int(11) NOT NULL,
  `permiso` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `permiso`) VALUES
(1, 'usuarios'),
(2, 'Material Piso'),
(3, 'Material Pared'),
(4, 'Material Techo'),
(5, 'Registrar Usuario'),
(6, 'Registrar Material Piso'),
(7, 'Registrar Material Pared'),
(8, 'Registrar Material Techo'),
(9, 'Editar Usuario'),
(10, 'Editar Material Piso'),
(11, 'Editar Material Pared'),
(12, 'Editar Material Techo'),
(13, 'Eliminar Usuario'),
(14, 'Eliminar Material Piso'),
(15, 'Eliminar Material Pared'),
(16, 'Eliminar Material Techo'),
(17, 'Reingresar Usuario'),
(18, 'Reingresar Material Piso'),
(19, 'Reingresar Material Pared'),
(20, 'Reingresar Material Techo'),
(21, 'Asignar Permisos'),
(22, 'Ver Piso Inactivo'),
(23, 'Ver Pared Inactivo'),
(24, 'Ver Techo Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(150) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `rol`, `estado`) VALUES
(1, 'Administrador', 1),
(2, 'economia', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `clave` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `nombre`, `clave`, `id_rol`, `estado`) VALUES
(1, 'Melissa', 'admin', '116907dc430d4b20878cc79d56e1fefd445740706a1a53228c3389eb4673e010', 1, 1),
(2, 'jhens', 'jhens', '7e040973efd95446b9ba8cabc7da2bd0dc176da84fc0aa744e27a2d6c2259e8a', 2, 1),
(3, 'ghost ', 'ghost XDsafd', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2, 1),
(15, 'miller', 'miller', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2, 1),
(16, 'miller12', 'safsdf', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92', 2, 1),
(17, 'xD', 'sxafsdaf', '0ffe1abd1a08215353c233d6e009613e95eec4253832a761af28ff37ac5a150c', 2, 1),
(18, 'vcdxxzcv', 'xvcdsfa', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1, 1),
(20, 'juan', 'juan', 'ed08c290d7e22f7bb324b15cbadce35b0b348564fd2d5f95752388d86d71bcca', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`,`id_permiso`),
  ADD KEY `id_permiso` (`id_permiso`);

--
-- Indices de la tabla `elementos`
--
ALTER TABLE `elementos`
  ADD PRIMARY KEY (`id_elemento`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_elemento` (`id_elemento`),
  ADD KEY `id_medida` (`id_medida`),
  ADD KEY `id_medida_2` (`id_medida`);

--
-- Indices de la tabla `medidas`
--
ALTER TABLE `medidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=500;

--
-- AUTO_INCREMENT de la tabla `elementos`
--
ALTER TABLE `elementos`
  MODIFY `id_elemento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `medidas`
--
ALTER TABLE `medidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_permisos`
--
ALTER TABLE `detalle_permisos`
  ADD CONSTRAINT `detalle_permisos_ibfk_1` FOREIGN KEY (`id_permiso`) REFERENCES `permisos` (`id`),
  ADD CONSTRAINT `detalle_permisos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD CONSTRAINT `materiales_ibfk_1` FOREIGN KEY (`id_elemento`) REFERENCES `elementos` (`id_elemento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
