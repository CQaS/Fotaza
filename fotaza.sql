-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-06-2021 a las 23:34:40
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
-- Base de datos: `fotaza`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `deletePost`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deletePost` (IN `_var` INT(11))  BEGIN
    start transaction;
           update posts set estado = '0' where id = _var;
           update post_comments set estado = '0' where post_id = _var;
           update post_likes set estado = '0' where post_id = _var;
           update valoracion set estado = '0' where post_id = _var;
        commit;
END$$

--
-- Funciones
--
DROP FUNCTION IF EXISTS `Edad`$$
CREATE DEFINER=`root`@`localhost` FUNCTION `Edad` (`_fecha` DATE) RETURNS INT(11) BEGIN
    DECLARE edad int;
    SET edad = (SELECT TIMESTAMPDIFF(YEAR,_fecha,CURDATE()));
    RETURN edad;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) NOT NULL,
  `user_pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `admin_login`
--

INSERT INTO `admin_login` (`id`, `user_name`, `user_pass`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `auditor_post_delete`
--

DROP TABLE IF EXISTS `auditor_post_delete`;
CREATE TABLE IF NOT EXISTS `auditor_post_delete` (
  `idAuditorPost` int(11) NOT NULL AUTO_INCREMENT,
  `id_del` int(11) NOT NULL,
  `titulo_del` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `username_del` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `decrip_del` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `foto_del` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_del` date NOT NULL,
  PRIMARY KEY (`idAuditorPost`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `auditor_post_delete`
--

INSERT INTO `auditor_post_delete` (`idAuditorPost`, `id_del`, `titulo_del`, `username_del`, `decrip_del`, `foto_del`, `fecha_del`) VALUES
(7, 261, 'Manos', 'kumiko', 'ExtraÃ±o mi familia', 'kumiko/1623760832.jpg', '2021-06-26'),
(6, 261, 'Manos', 'kumiko', 'ExtraÃ±o mi familia', 'kumiko/1623760832.jpg', '2021-06-26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` varchar(255) NOT NULL DEFAULT 'S/D',
  `id_user` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL DEFAULT 'Perfil',
  `categoria` varchar(50) NOT NULL DEFAULT 'S/C',
  `donde` varchar(100) NOT NULL DEFAULT 'S/D',
  `description` varchar(200) NOT NULL DEFAULT 'S/D',
  `palabra1` varchar(100) NOT NULL DEFAULT 'S/D',
  `palabra2` varchar(100) NOT NULL DEFAULT 'S/D',
  `palabra3` varchar(100) NOT NULL DEFAULT 'S/D',
  `photos` text,
  `precio` int(100) DEFAULT NULL,
  `report` tinyint(1) NOT NULL DEFAULT '0',
  `privado` int(5) DEFAULT NULL,
  `estado` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `added_by` (`added_by`),
  KEY `id_user` (`id_user`),
  KEY `added_by_2` (`added_by`)
) ENGINE=InnoDB AUTO_INCREMENT=272 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `post_time`, `added_by`, `id_user`, `titulo`, `categoria`, `donde`, `description`, `palabra1`, `palabra2`, `palabra3`, `photos`, `precio`, `report`, `privado`, `estado`) VALUES
(229, '2021-03-05 20:21:03', 'esteban', 68, 'Perfil', 'S/C', 'S/D', 'cambio tu foto', '', '', '', 'esteban/1614975662.jpg', NULL, 0, 0, 1),
(230, '2021-03-05 20:38:40', 'esteban', 68, 'Perfil', 'S/C', 'S/D', 'cambio tu foto', '', '', '', 'esteban/1614976720.jpg', NULL, 0, 0, 1),
(231, '2021-03-08 04:16:48', 'esteban', 68, 'Luna', 'Amigos', 'Merlo San Luis', 'Amix', 'amiga', 'auto', 'calle', 'esteban/1615177008.jpg', 320, 1, 0, 1),
(232, '2021-03-14 01:19:38', 'florencia', 69, 'Perfil', 'S/C', 'S/D', 'cambio tu foto', '', '', '', 'florencia/1615684778.jpeg', NULL, 0, 0, 1),
(233, '2021-03-14 01:24:26', 'florencia', 69, 'Perfil', 'S/C', 'S/D', 'cambio tu foto', '', '', '', 'florencia/1615685066.jpg', NULL, 0, 0, 1),
(234, '2021-03-19 19:10:06', 'florencia', 69, 'Feliz', 'Break', 'Viena Austria', 'Hora de un recreo', 'viaje', 'montañas', 'europa', 'florencia/1616181006.jpg', 780, 0, 1, 1),
(235, '2021-04-01 01:15:16', 'florencia', 69, 'Aburrido', 'Amigos', 'en el campo', 'mi amigo el burro', 'campo', 'animales', 'burro', 'florencia/1617239716.jpg', 210, 0, 0, 1),
(236, '2021-04-01 01:36:12', 'alexander', 70, 'Perrito', 'Viajes', 'Merlo San Luis', 'caminando por la calle de merlo', 'clima', 'aire', 'compras', 'alexander/1617240972.jpg', 800, 0, 0, 1),
(237, '2021-04-01 03:18:48', 'alexander', 70, 'Perfil', 'S/C', 'S/D', 'Foto de Perfil cambiada', '', '', '', 'alexander/alex.jpg', NULL, 0, 0, 1),
(238, '2021-04-01 03:21:37', 'alexander', 70, 'Dia de campo', 'Viajes', 'Mendoza', 'la granja', 'paseo', 'granja', 'mendoza', 'alexander/1617247297.jpg', 660, 0, 1, 1),
(239, '2021-04-02 22:36:29', 'florencia', 69, 'Infancia', 'Amigos', 'Viena Austria', 'Tiempos felices', 'viena', 'tiempo', 'feliz', 'florencia/1617402989.jpg', 400, 0, 1, 1),
(240, '2021-05-05 20:42:25', 'alexander', 70, 'Mi casa', 'Amigos', 'Merlo San Luis', 'Por fin mi casa', 'country', 'casa', 'nueva', 'alexander/1620247345.jpg', 557, 0, 1, 1),
(241, '2021-05-05 21:12:22', 'esteban', 68, 'Nueva', 'Oficina', 'Viena Austria', 'Nuevo juguete', 'nuevo', 'juguete', 'austria', 'esteban/1620249142.jpg', 364, 0, 1, 1),
(242, '2021-05-05 23:30:08', 'guzman', 71, 'Perfil', 'S/C', 'S/D', 'Foto de Perfil cambiada', '', '', '', 'guzman/1620257408.jpg', NULL, 0, 0, 1),
(243, '2021-05-05 23:54:23', 'guzman', 71, 'Perfil', 'S/C', 'S/D', 'Foto Portada', '', '', '', 'guzman/1620258863.jpg', NULL, 0, 0, 1),
(244, '2021-05-17 23:57:16', 'guzman', 71, 'Trabajo y Creo', 'Oficina', 'MTY', 'mas y mas Creatividad', 'mexico', 'monterrey', 'creativa', 'guzman/1621295836.jpg', 864, 0, 0, 1),
(245, '2021-05-18 00:32:25', 'alexander', 70, 'Perfil', 'S/C', 'S/D', 'Foto Portada', '', '', '', 'alexander/1621297945.jpg', NULL, 0, 0, 1),
(246, '2021-05-18 00:42:00', 'alexander', 70, 'Nuevos amiguitos', 'Amigos', 'Merlo San Luis', 'Tody y Benja', 'tody', 'benja', 'amigos', 'alexander/1621298520.jpg', 457, 0, 0, 1),
(247, '2021-05-21 20:49:50', 'florencia', 69, 'Club', 'Break', 'Juana Koslay', 'Esperando el Partido', 'partido', 'boca', 'comida', 'florencia/1621630189.jpg', 934, 0, 1, 1),
(248, '2021-05-25 23:45:07', 'citlalli', 74, 'Perfil', 'S/C', 'S/D', 'Foto de Perfil cambiada', 'S/D', 'S/D', 'S/D', 'citlalli/1621986306.jpg', NULL, 0, NULL, 1),
(249, '2021-05-25 23:57:06', 'citlalli', 74, 'Perfil', 'S/C', 'S/D', 'Foto Portada', 'S/D', 'S/D', 'S/D', 'citlalli/1621987026.jpg', NULL, 0, NULL, 1),
(250, '2021-05-26 00:16:56', 'citlalli', 74, 'Parque Fundidora', 'Relax', 'Monterry', 'Disfrutando de la primavera', 'parque', 'primavera', 'amigos', 'citlalli/1621988216.jpg', 300, 0, 0, 1),
(251, '2021-05-26 03:43:52', 'esteban', 68, 'Talvez', 'Familia', 'Juana Koslay', 'Esperando el Partido', 'Familia', 'parientes', 'comida', 'esteban/1622000631.jpg', 400, 0, 1, 1),
(252, '2021-05-26 03:53:31', 'kumiko', 75, 'Perfil', 'S/C', 'S/D', 'Foto de Perfil cambiada', 'S/D', 'S/D', 'S/D', 'kumiko/1622001211.jpg', NULL, 0, NULL, 1),
(253, '2021-05-26 04:04:45', 'kumiko', 75, 'Perfil', 'S/C', 'S/D', 'Foto Portada', 'S/D', 'S/D', 'S/D', 'kumiko/1622001885.jpg', NULL, 0, NULL, 1),
(254, '2021-05-26 04:11:07', 'citlalli', 74, 'MTY', 'Break', 'Monterry', 'Que bonito', 'plaza', 'mty', 'descanzo', 'citlalli/1622002267.jpg', 275, 0, 0, 1),
(255, '2021-05-29 22:45:34', 'kumiko', 75, 'Sol naciente', 'Viajes', 'Monte Fuji', 'Paseo por el jardin Huki', 'vista', 'monte', 'fuji', 'kumiko/1622328333.jpg', 760, 0, 0, 1),
(256, '2021-06-03 13:12:06', 'esteban', 68, 'Desarrollo', 'Oficina', 'Villa de Merlo', 'Muchas ideas', 'notebook', 'desarrollo', 'ideas', 'esteban/1622725926.jpg', 567, 1, 0, 1),
(257, '2021-06-07 11:23:59', 'guzman', 71, 'Encuentro', 'Amigos', 'Cortaderas', 'Juntada', 'encuentro', 'amigos', 'juntas', 'guzman/1623065039.jpg', 384, 0, 1, 1),
(258, '2021-06-08 07:05:36', 'citlalli', 74, 'lectura', 'Relax', 'Monterry', 'leer y aprender', 'leer', 'libro', 'calle', 'citlalli/1623135936.jpg', 455, 0, 0, 1),
(259, '2021-06-15 01:10:36', 'kumiko', 75, 'Japon', 'Viajes', 'Tokyo Japon', 'Que bonito', 'tokyo', 'vereda', 'comercio', 'kumiko/1623719436.jpg', 930, 0, 1, 1),
(261, '2021-06-15 12:40:32', 'kumiko', 75, 'Manos', 'Familia', 'Japon', 'ExtraÃ±o mi familia', 'manos', 'madre', 'familia', 'kumiko/1623760832.jpg', 760, 0, 1, 0),
(266, '2021-06-18 23:44:14', 'guzman', 71, 'Idea', 'Break', 'Villa Larca', 'Silla pensante', 'idea', 'silla', 'descanzo', 'guzman/1624059854.jpg', 760, 0, 0, 1),
(267, '2021-06-22 15:13:56', 'rober', 76, 'Perfil', 'S/C', 'S/D', 'Foto de Perfil cambiada', 'S/D', 'S/D', 'S/D', 'rober/1624374836.jpg', NULL, 0, NULL, 1),
(268, '2021-06-22 15:22:07', 'rober', 76, 'Perfil', 'S/C', 'S/D', 'Foto Portada', 'S/D', 'S/D', 'S/D', 'rober/1624375327.jpg', NULL, 0, NULL, 1),
(269, '2021-06-22 16:39:23', 'rober', 76, 'Boscosa', 'Viajes', 'Holanda', 'bosques y caminos', 'bosque', 'camino', 'Holanda', 'rober/1624379963.jpg', 275, 0, 1, 1),
(270, '2021-06-22 17:19:20', 'rober', 76, 'Campos', 'Viajes', 'Holanda', 'Verde Pradera', 'campo', 'verde', 'ovejas', 'rober/1624382360.jpg', 760, 0, 1, 1),
(271, '2021-06-26 01:49:16', 'alexander', 70, 'Mi favorito', 'Amigos', 'Cuba', 'mi favorito', 'favorito', 'auto', 'coupe', 'alexander/1624672156.jpg', 1200, 0, 1, 1);

--
-- Disparadores `posts`
--
DROP TRIGGER IF EXISTS `post_delete`;
DELIMITER $$
CREATE TRIGGER `post_delete` BEFORE UPDATE ON `posts` FOR EACH ROW BEGIN
    INSERT INTO auditor_post_delete (id_del, titulo_del, username_del, decrip_del, foto_del, fecha_del) VALUES (OLD.id, OLD.titulo, OLD.added_by, OLD.description, OLD.photos, NOW());
  END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_comments`
--

DROP TABLE IF EXISTS `post_comments`;
CREATE TABLE IF NOT EXISTS `post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_body` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `posted_by` varchar(255) NOT NULL,
  `posted_to` varchar(255) NOT NULL,
  `post_id` int(11) NOT NULL,
  `estado` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post_comments`
--

INSERT INTO `post_comments` (`id`, `post_body`, `time`, `posted_by`, `posted_to`, `post_id`, `estado`) VALUES
(91, 'aver que foto se puede ver aca!!!', '2021-03-07 01:27:31', 'esteban', 'esteban', 230, 1),
(92, 'otra cosa', '2021-03-07 01:30:37', 'esteban', 'esteban', 230, 1),
(93, 'Genio!', '2021-03-07 02:13:28', 'esteban', 'esteban', 229, 1),
(94, 'Saltanto por las calles...', '2021-06-06 01:27:26', 'florencia', 'florencia', 234, 1),
(95, 'hola', '2021-04-01 01:11:00', 'florencia', 'esteban', 230, 1),
(96, 'En adopcion!!', '2021-06-06 01:25:52', 'florencia', 'florencia', 235, 1),
(97, 'Volveee!!!!', '2021-06-06 02:07:53', 'alexander', 'alexander', 236, 1),
(98, 'Bonito amigo', '2021-04-01 03:22:14', 'alexander', 'alexander', 238, 1),
(99, 'auto raro!!!!!', '2021-04-01 03:22:38', 'alexander', 'esteban', 231, 1),
(100, 'donde vas?', '2021-04-01 23:05:15', 'florencia', 'alexander', 236, 1),
(101, 'como se llama?', '2021-04-01 23:12:11', 'florencia', 'alexander', 238, 1),
(102, 'que cara nene =0', '2021-04-02 00:08:32', 'florencia', 'esteban', 229, 1),
(104, 'otra cosa', '2021-04-02 00:09:03', 'florencia', 'esteban', 229, 1),
(106, 'que cara nene =0', '2021-04-02 00:30:50', 'florencia', 'alexander', 237, 1),
(107, 'hola', '2021-04-02 00:45:01', 'florencia', 'alexander', 238, 1),
(108, 'yo soy yo ajaja', '2021-04-02 01:26:12', 'florencia', 'florencia', 233, 1),
(109, 'Guapa', '2021-04-02 01:36:03', 'florencia', 'esteban', 231, 1),
(110, 'Niñas', '2021-04-08 00:33:25', 'florencia', 'florencia', 239, 1),
(111, 'Venite tengo una idea que te va encantar', '2021-05-06 23:57:32', 'guzman', 'esteban', 241, 1),
(112, 'Hermosa foto!', '2021-06-26 01:28:34', 'guzman', 'alexander', 240, 1),
(113, 'Me encanto como quedo', '2021-05-07 00:03:58', 'guzman', 'guzman', 243, 1),
(114, 'que cara nena jaja', '2021-05-07 00:30:21', 'guzman', 'florencia', 235, 1),
(115, 'Qui bonitu!', '2021-05-10 22:09:45', 'guzman', 'alexander', 238, 1),
(116, 'Muy lindo. Se alquila?', '2021-06-06 02:04:49', 'florencia', 'guzman', 243, 1),
(117, '..??', '2021-05-15 21:13:21', 'florencia', 'guzman', 242, 1),
(118, 'Desde ahora los cuidare del Lobo!', '2021-05-18 00:49:28', 'alexander', 'alexander', 246, 1),
(119, 'Finde Feliz!', '2021-05-26 00:17:49', 'citlalli', 'citlalli', 250, 1),
(120, 'Lindo, a cuanto?', '2021-05-26 08:12:35', 'florencia', 'citlalli', 254, 1),
(121, 'Finde Feliz!', '2021-05-26 08:36:01', 'florencia', 'citlalli', 249, 1),
(123, 'Aun disponible?', '2021-05-26 09:13:43', 'kumiko', 'citlalli', 254, 1),
(124, 'ala venta!', '2021-05-29 01:42:23', 'florencia', 'florencia', 247, 1),
(125, 'very good!!', '2021-05-29 22:37:38', 'kumiko', 'esteban', 251, 1),
(126, 'buena foto!!', '2021-05-29 23:27:19', 'kumiko', 'alexander', 245, 1),
(127, 'Me encanta para mi proyecto! te dejo mp', '2021-06-14 21:04:47', 'citlalli', 'esteban', 251, 1),
(128, 'Excelente!', '2021-06-15 00:34:54', 'kumiko', 'guzman', 244, 1),
(129, 'ala venta!', '2021-06-15 00:56:11', 'kumiko', 'kumiko', 255, 1),
(130, 'Aun ala venta Chicos!!!', '2021-06-19 17:50:04', 'guzman', 'guzman', 244, 1),
(131, 'Ala venta chicos. mp!', '2021-06-20 00:18:55', 'guzman', 'guzman', 266, 1),
(132, 'En venta!!', '2021-06-22 10:40:53', 'guzman', 'guzman', 257, 1),
(133, 'Que modelo es?', '2021-06-22 11:22:18', 'guzman', 'esteban', 231, 1),
(134, 'Que onda mis crack!', '2021-06-22 15:33:45', 'rober', 'rober', 267, 1),
(135, 'Me interesa', '2021-06-22 16:50:18', 'rober', 'esteban', 256, 1),
(136, 'Aun disponible?', '2021-06-22 17:09:43', 'rober', 'kumiko', 259, 1),
(137, 'Lindo, a cuanto?', '2021-06-26 01:46:40', 'alexander', 'rober', 270, 1),
(138, 'Se vende!!!', '2021-06-26 01:49:55', 'alexander', 'alexander', 271, 1),
(139, 'Ã±Ã±Ã±', '2021-06-26 17:34:11', 'kumiko', 'rober', 270, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_likes`
--

DROP TABLE IF EXISTS `post_likes`;
CREATE TABLE IF NOT EXISTS `post_likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(15) NOT NULL,
  `post_id` int(11) NOT NULL,
  `estado` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=357 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_name`, `post_id`, `estado`) VALUES
(268, 'esteban', 229, 1),
(269, 'esteban', 230, 1),
(270, 'florencia', 231, 1),
(271, 'florencia', 233, 1),
(272, 'esteban', 233, 1),
(273, 'esteban', 231, 1),
(279, 'esteban', 234, 1),
(281, 'alexander', 235, 1),
(282, 'alexander', 238, 1),
(283, 'alexander', 233, 1),
(284, 'florencia', 238, 1),
(285, 'florencia', 236, 1),
(288, 'guzman', 243, 1),
(289, 'guzman', 241, 1),
(296, 'florencia', 242, 1),
(298, 'florencia', 243, 1),
(299, 'florencia', 229, 1),
(300, 'guzman', 244, 1),
(301, 'guzman', 231, 1),
(302, 'guzman', 239, 1),
(303, 'alexander', 245, 1),
(304, 'alexander', 237, 1),
(305, 'alexander', 246, 1),
(306, 'florencia', 246, 1),
(307, 'florencia', 247, 1),
(308, 'guzman', 246, 1),
(309, 'citlalli', 249, 1),
(310, 'citlalli', 250, 1),
(311, 'citlalli', 252, 1),
(312, 'citlalli', 254, 1),
(313, 'kumiko', 254, 1),
(314, 'kumiko', 251, 1),
(315, 'kumiko', 231, 1),
(316, 'alexander', 253, 1),
(317, 'alexander', 252, 1),
(318, 'alexander', 251, 1),
(319, 'florencia', 250, 1),
(320, 'florencia', 254, 1),
(321, 'kumiko', 255, 0),
(322, 'kumiko', 255, 1),
(323, 'kumiko', 245, 1),
(327, 'esteban', 256, 1),
(328, 'florencia', 240, 1),
(329, 'florencia', 235, 1),
(330, 'florencia', 244, 1),
(331, 'guzman', 257, 0),
(332, 'citlalli', 258, 1),
(333, 'citlalli', 248, 1),
(334, 'citlalli', 243, 1),
(335, 'citlalli', 251, 1),
(336, 'citlalli', 236, 1),
(337, 'citlalli', 256, 1),
(338, 'kumiko', 244, 1),
(339, 'kumiko', 259, 1),
(340, 'guzman', 266, 1),
(341, 'rober', 267, 1),
(342, 'rober', 269, 1),
(343, 'rober', 256, 1),
(344, 'rober', 254, 1),
(345, 'rober', 236, 1),
(346, 'rober', 259, 1),
(347, 'rober', 239, 1),
(348, 'rober', 270, 1),
(349, 'alexander', 240, 1),
(350, 'alexander', 244, 1),
(351, 'alexander', 270, 1),
(352, 'alexander', 271, 1),
(353, 'kumiko', 269, 1),
(354, 'kumiko', 266, 1),
(355, 'kumiko', 243, 1),
(356, 'kumiko', 248, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `fechNac` date NOT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'S/D',
  `city` text,
  `hometown` text,
  `sign_up_date` date NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '1',
  `blocked_user` enum('0','1') NOT NULL DEFAULT '0',
  `bio` text,
  `queote` text,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `cover_pic` text,
  `mobile` varchar(15) NOT NULL DEFAULT 'S/D',
  `pub_email` varchar(255) NOT NULL DEFAULT 'S/D',
  `company` text,
  `position` text,
  `school` text,
  `concentration` text,
  `verify_id` varchar(3) NOT NULL DEFAULT 'no',
  `chatOnlineTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pregunta` varchar(100) NOT NULL,
  PRIMARY KEY (`id`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `first_name`, `username`, `email`, `password`, `gender`, `fechNac`, `country`, `city`, `hometown`, `sign_up_date`, `activated`, `blocked_user`, `bio`, `queote`, `foto_perfil`, `cover_pic`, `mobile`, `pub_email`, `company`, `position`, `school`, `concentration`, `verify_id`, `chatOnlineTime`, `pregunta`) VALUES
(68, 'Esteban Avila', 'esteban', 'esteban@mail.com', '5d2043966fe03d51d2a236e71f273fce1def4f9d795d6977f4363c241d1abd1d', '1', '1980-02-13', 'Argentina', 'San Luis', 'Merlo', '2021-03-05', '1', '0', 'Desarrollador', 'Que onda carnal!!', 'esteban/1614975662.jpg', 'esteban/1614976720.jpg', '2664562066', 'cqasss@gmail.com', 'ULP', 'Estudiante', 'Merlo', 'Tecnico', 'yes', '2021-06-03 13:06:21', 'esteban'),
(69, 'Flor Arrieta', 'florencia', 'florencia@mail.com', '673eb00020b80bc9e201e4965ba12d23a0f0d19ae7e8789f0ee74dcd132547b0', '2', '2000-12-20', 'Hungria', 'Budapest', 'Merlo SL', '2021-03-14', '0', '0', 'Fotografa de mis Momentos', 'Cualquiera', 'florencia/1615685066.jpg', 'florencia/1615684778.jpeg', '2664562099', 'florflor@mail.com', 'Fotografia', 'FreeLancer', 'Albardon', 'Veterinaria', 'yes', '2021-06-25 20:30:12', 'florencia'),
(70, 'Alex Baldez', 'alexander', 'alex@mail.com', '8eb498704bca8337e864bd5cb3b5a60b8126af9c97ddbf69020a976a4dcc158f', '1', '1970-04-01', 'Argentina', 'San Luis', 'San Luis', '2021-04-01', '0', '0', 'Futbol pasion', 'no se', 'alexander/alex.jpg', 'alexander/1621297945.jpg', '266456209', 'alex@gmail.com', 'UNSL', 'Estudiante', 'JKoslay', 'Lic. Agronomia', 'yes', '2021-06-26 01:45:34', 'bruno'),
(71, 'Aby Guzzman', 'guzman', 'guzman@mail.com', '708fc01bf28448efdc24a9c63355341994a97a84fc299dfae0557b03be6c708b', '2', '2000-12-31', 'Atenas', 'Atenas', 'Jujuy', '2021-05-06', '0', '0', 'Amante del buen Diseño!', 'Lo hecho, hecho esta', 'guzman/1620257408.jpg', 'guzman/1620258863.jpg', '2666666', 'interiores@mail.com', 'Guzman Interiores', 'Jefecita', 'Merlo', 'Diseñadora De Interiores', 'no', '2021-06-22 11:14:52', 'guzman'),
(74, 'Citlalli Torres', 'citlalli', 'citlalli@mail.com', '1896cfcfbb3b3ab7727fd76c50989c770d4eb86e0def5754221d6030f128d2fa', '2', '1979-10-16', 'Mexico', 'Monterry', 'Monterrey', '2021-05-25', '1', '0', NULL, NULL, 'citlalli/1621986306.jpg', 'citlalli/1621987026.jpg', '45457654', 'citly@gmail.com', 'Hospital Dr. Alvaro', 'Admin. Derecho Habientes', 'UAN', 'Tecnicatura', 'no', '2021-06-14 21:13:42', 'citlalli'),
(75, 'Kumiko Dai', 'kumiko', 'kumiko@mail.com', '1d72a4465e0293fc23d725ff068fbde64686acc875d4a3f7a3761a0710327a3c', '1', '1995-05-07', 'Japon', 'Cortaderas', 'Zusuka Japon', '2021-05-26', '1', '0', 'Emprendedor!', 'Sol naciente', 'kumiko/1622001211.jpg', 'kumiko/1622001885.jpg', '56474848', 'kumiko@gmail.com', 'Kiosera Corp.', 'Operator', 'Univercity Of Japon', 'Tecnico Micro Procesadores', 'no', '2021-06-26 19:46:36', 'kumiko'),
(76, 'Rober Carlos', 'rober', 'rober@mail.com', '6c98204cd8643ff14e58adcac23fb1d73bfc086848f0497a0360589cb15e0d79', '1', '1980-06-10', 'Mexico', 'Los Molles', 'MTY', '2021-06-15', '1', '0', 'Buenas fotos', 'Fotografia el destino', 'rober/1624374836.jpg', 'rober/1624375327.jpg', '5474784', 'rober@gmail.com', 'MundoFoto', 'Propietario', 'UAL', 'DiseÃ±ador', 'no', '2021-06-23 05:41:04', 'rober');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valoracion`
--

DROP TABLE IF EXISTS `valoracion`;
CREATE TABLE IF NOT EXISTS `valoracion` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `post_id` int(5) NOT NULL,
  `valor` int(10) NOT NULL,
  `estado` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=117 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `valoracion`
--

INSERT INTO `valoracion` (`id`, `user_name`, `post_id`, `valor`, `estado`) VALUES
(55, 'florencia', 243, 4, 1),
(56, 'florencia', 242, 3, 1),
(57, 'guzman', 243, 5, 1),
(58, 'florencia', 240, 5, 1),
(59, 'florencia', 239, 5, 1),
(60, 'florencia', 233, 4, 1),
(61, 'guzman', 233, 2, 1),
(62, 'guzman', 244, 4, 1),
(63, 'guzman', 231, 2, 1),
(64, 'alexander', 244, 3, 1),
(65, 'alexander', 245, 5, 1),
(66, 'alexander', 246, 5, 1),
(67, 'alexander', 242, 1, 1),
(68, 'alexander', 238, 4, 1),
(69, 'alexander', 235, 5, 1),
(70, 'florencia', 247, 3, 1),
(71, 'guzman', 247, 4, 1),
(72, 'guzman', 246, 3, 1),
(73, 'citlalli', 248, 4, 1),
(74, 'citlalli', 250, 5, 1),
(75, 'esteban', 251, 4, 1),
(76, 'citlalli', 252, 5, 1),
(77, 'florencia', 254, 4, 1),
(78, 'kumiko', 254, 5, 1),
(79, 'alexander', 254, 4, 1),
(80, 'florencia', 245, 4, 1),
(81, 'florencia', 249, 2, 1),
(82, 'florencia', 246, 5, 1),
(83, 'florencia', 252, 4, 1),
(84, 'florencia', 253, 2, 0),
(85, 'florencia', 251, 3, 1),
(86, 'florencia', 250, 3, 1),
(87, 'kumiko', 251, 5, 1),
(88, 'florencia', 238, 2, 1),
(89, 'florencia', 235, 2, 1),
(90, 'kumiko', 239, 3, 1),
(91, 'guzman', 242, 4, 1),
(92, 'guzman', 250, 3, 1),
(93, 'guzman', 249, 5, 1),
(94, 'guzman', 254, 5, 1),
(95, 'citlalli', 240, 4, 1),
(96, 'citlalli', 243, 5, 1),
(97, 'citlalli', 245, 2, 1),
(98, 'citlalli', 239, 4, 1),
(99, 'citlalli', 251, 3, 1),
(100, 'citlalli', 254, 5, 1),
(101, 'citlalli', 236, 2, 1),
(102, 'citlalli', 242, 1, 1),
(103, 'citlalli', 256, 3, 1),
(104, 'kumiko', 243, 3, 1),
(105, 'kumiko', 257, 3, 0),
(106, 'kumiko', 244, 4, 1),
(107, 'guzman', 251, 3, 1),
(108, 'rober', 258, 2, 1),
(109, 'rober', 254, 5, 1),
(110, 'rober', 240, 4, 1),
(111, 'rober', 251, 3, 1),
(112, 'rober', 252, 3, 1),
(113, 'alexander', 270, 4, 1),
(114, 'kumiko', 270, 2, 1),
(115, 'kumiko', 269, 3, 1),
(116, 'kumiko', 240, 3, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `post_comments`
--
ALTER TABLE `post_comments`
  ADD CONSTRAINT `post_comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Filtros para la tabla `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Filtros para la tabla `valoracion`
--
ALTER TABLE `valoracion`
  ADD CONSTRAINT `valoracion_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
