-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-04-2022 a las 08:37:49
-- Versión del servidor: 5.7.24
-- Versión de PHP: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistema_de_puntos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comercios`
--

CREATE TABLE `comercios` (
  `rut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `puntos` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `comercios`
--

INSERT INTO `comercios` (`rut`, `nombre`, `puntos`, `created_at`, `updated_at`) VALUES
('1111111-1', 'Evaluacion', 20, '2022-04-07 10:18:47', '2022-04-07 12:34:16'),
('2222222-2', 'Junior', 0, '2022-04-07 04:00:00', '2022-04-07 04:00:00'),
('3333333-3', 'Laravel 7', 20, '2022-04-07 04:00:00', '2022-04-07 12:35:09'),
('9999999-9', 'Persona X', 20, '2022-04-06 04:00:00', '2022-04-07 12:35:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dispositivos`
--

CREATE TABLE `dispositivos` (
  `id_dispositivo` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `dispositivos`
--

INSERT INTO `dispositivos` (`id_dispositivo`, `nombre`, `created_at`, `updated_at`) VALUES
(10001, 'Maquina POS', '2022-04-06 04:00:00', '2022-04-06 04:00:00'),
(10002, 'Pistola codigo Barra', '2022-04-07 10:38:07', '2022-04-07 10:38:07'),
(10003, 'Punto de Venta', '2022-04-07 04:00:00', '2022-04-07 04:00:00'),
(10004, 'Hosting Web', '2022-04-07 04:00:00', '2022-04-07 04:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2022_04_06_194019_create_comercios_table', 1),
(2, '2022_04_06_194521_create_dispositivos_table', 1),
(3, '2022_04_06_194706_create_ventas_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` bigint(20) UNSIGNED NOT NULL,
  `rut` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_dispositivo` bigint(20) UNSIGNED NOT NULL,
  `monto` int(11) NOT NULL,
  `codigo_seguridad` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `rut`, `id_dispositivo`, `monto`, `codigo_seguridad`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1111111-1', 10001, 10000, '$2y$10$LM9hjwaJXSQqBXPy0uKImuKWWeuak5l2GRFsQ5mTE0ILaTVzXNX3i', 1, '2022-04-07 12:33:18', '2022-04-07 12:33:18'),
(2, '1111111-1', 10004, 15000, '$2y$10$y1KCU24vi1xl3zAETPHA2e8qPg/m7fgK9aWn1d1VN4ocyzCxlPojq', 1, '2022-04-07 12:34:16', '2022-04-07 12:34:16'),
(3, '3333333-3', 10004, 15000, '$2y$10$kJzllAXMPaEZMWXr4K5PFeDg1AFWr4NT.3xbSiTQKWO83awk7Atfy', 1, '2022-04-07 12:34:46', '2022-04-07 12:34:46'),
(4, '3333333-3', 10002, 5000, '$2y$10$qhkxlhjX3.iq4R39Godpb.KQ8y9ts0WvuIJMkrzAQ2sGBvyg2XYiO', 1, '2022-04-07 12:35:09', '2022-04-07 12:35:09'),
(5, '9999999-9', 10002, 150000, '$2y$10$4plnn1N9iPRstOq22lV5luoCv5S2bc6gmOvd.X.ak2w2vmU2gfhWK', 1, '2022-04-07 12:35:50', '2022-04-07 12:35:50'),
(6, '9999999-9', 10001, 150000, '$2y$10$gc1rHQ3N1gDQDeqFWWc0iu9lpKJdCpSq3UeEfz4oFg9Q0j/3I/t8e', 1, '2022-04-07 12:35:55', '2022-04-07 12:35:55');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comercios`
--
ALTER TABLE `comercios`
  ADD PRIMARY KEY (`rut`);

--
-- Indices de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  ADD PRIMARY KEY (`id_dispositivo`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `ventas_rut_foreign` (`rut`),
  ADD KEY `ventas_id_dispositivo_foreign` (`id_dispositivo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dispositivos`
--
ALTER TABLE `dispositivos`
  MODIFY `id_dispositivo` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10005;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_id_dispositivo_foreign` FOREIGN KEY (`id_dispositivo`) REFERENCES `dispositivos` (`id_dispositivo`),
  ADD CONSTRAINT `ventas_rut_foreign` FOREIGN KEY (`rut`) REFERENCES `comercios` (`rut`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
