-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-05-2015 a las 17:55:32
-- Versión del servidor: 5.6.20
-- Versión de PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `tienda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE IF NOT EXISTS `categorias` (
`id_cat` int(11) NOT NULL,
  `cod_cat` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `anuncio` text COLLATE utf8_spanish_ci,
  `oculto` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_cat`, `cod_cat`, `nombre`, `descripcion`, `anuncio`, `oculto`) VALUES
(1, 'VCONS', 'Videoconsolas', 'Playstation, X-Box, Nintendo DS...', 'Disfruta de la mejor oferta en videoconsolas del mercado', NULL),
(2, 'TVIDE', 'Televisión y Vídeo', 'Imagen, Blu-Ray, DVD, etc', 'Disfruta de la mejor experiencia visual con nuestra gama de televisores y reproductores de Blu-Ray o DVD.', NULL),
(3, 'TLFNO', 'Teléfono', 'Móviles, Teléfonos inhalámbricos', 'Disfruta de la mejor comunicación gracias a nuestra gama en telefonía.', NULL),
(4, 'CAMFV', 'Cámaras Fotos y Vídeo', 'Cámaras de fotografías y cámaras de vídeo', 'Disfruta de la mejor calidad a la hora de hacer tus reportajes fotográficos o de vídeo con nuestra gama de cámaras.', NULL),
(5, 'INFOR', 'Informática', 'Ordenadores de sobremesa, portátiles, impresoras, etc', 'Disfruta de la mejor variedad en equipamiento informático con nuestra gama de ordenadores', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(45) COLLATE utf8_spanish_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) COLLATE utf8_spanish_ci NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('f183ed1f8ffb248357c5ddf94a72a517', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64; rv:34.0) Gecko/20100101 Firefox/34.0', 1431445971, 'a:1:{s:9:"user_data";s:0:"";}');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `linea_pedido`
--

CREATE TABLE IF NOT EXISTS `linea_pedido` (
  `cod_pedido` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `precio` decimal(10,0) DEFAULT NULL,
  `descuento` decimal(10,0) DEFAULT NULL,
  `iva` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE IF NOT EXISTS `pedido` (
`cod_pedido` int(11) NOT NULL,
  `cod_usuario` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `direccion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre_cliente` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `apellidos_cliente` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `poblacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_provincia` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `cod_postal` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE IF NOT EXISTS `productos` (
`id_prod` int(11) NOT NULL,
  `cod_pro` varchar(5) COLLATE utf8_spanish_ci NOT NULL,
  `id_cat` int(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT NULL,
  `descuento` decimal(10,2) DEFAULT NULL,
  `imagen` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `iva` decimal(10,0) DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish_ci,
  `anuncio` text COLLATE utf8_spanish_ci,
  `destacado` tinyint(1) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `inicio_dest` datetime DEFAULT NULL,
  `fin_dest` datetime DEFAULT NULL,
  `oculto` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_prod`, `cod_pro`, `id_cat`, `nombre`, `precio`, `descuento`, `imagen`, `iva`, `descripcion`, `anuncio`, `destacado`, `stock`, `inicio_dest`, `fin_dest`, `oculto`) VALUES
(1, 'PLAY4', 1, 'PLAYSTATION 4 500 Gb', '399.90', NULL, 'play4-500gb.jpg', '21', 'Videoconsola Playstation 4 de capacidad 500 Gb. Incluye 1 mando.', 'Disfruta de la mejor diversión con esta Playstation 4. La videoconsola de Sony de la nueva generación de videoconsolas.', 1, 20, NULL, NULL, 0),
(2, 'XBOX1', 1, 'XBOX ONE 500 Gb', '369.90', NULL, 'xbox-one.jpg', '21', 'Videoconsola XBOX-ONE de capacidad 500 Gb. Incluye 1 mando.', 'Disfruta de la mejor diversión con esta XBOX-ONE. La videoconsola de Microsoft de la nueva generación de videoconsolas.', NULL, NULL, NULL, NULL, NULL),
(3, 'PLAY3', 1, 'Playstation 3', '204.90', NULL, 'play3-12gb.jpg', '21', 'Videoconsola Playstation 3 con un disco duro de 12 Gb. Incluye un mando.', 'Disfruta de la mejor diversión con la videoconsola más vendida de Sony.', NULL, 10, NULL, NULL, NULL),
(4, 'XBOX3', 1, 'XBOX 360', '249.90', NULL, 'xbox-360.jpg', '21', 'Videoconsola XBOX-360. Incluye dos juegos y un mando.', 'Disfruta de la mejor experiencia jugable con esta videoconsola de Microsoft.', 1, 8, NULL, NULL, NULL),
(5, 'WIIUU', 1, 'WIIU', '299.90', NULL, 'wiu.jpg', '21', 'Pack de Videoconsola WIIU con un mando y un juego.', 'Disfruta de la mejor diversión con la videoconsola más vendida de Nintendo.', NULL, 10, NULL, NULL, NULL),
(6, '3DSNE', 1, 'NINTENDO 3DS-XL', '199.90', NULL, '3ds.jpg', '21', 'Videoconsola Nintendo 3DS-XL de color negro.', 'Disfruta de la mejor experiencia jugable con esta videoconsola portátil de Nintendo.', 1, 8, NULL, NULL, NULL),
(7, 'TVPAN', 2, 'TV LED 32'''' Panasonic TX-32A300E', '279.00', NULL, 'tvpanasonic.jpg', '17', 'TV LED 32'''' Panasonic TX-32A300E HD Ready, 2 HDMI y 2 USB. Color Negro.', 'Disfruta de la mejor imagen al mejor precio con este LED Panasonic.', NULL, 15, NULL, NULL, NULL),
(8, 'LEDLG', 2, 'TV LED 60'''' LG 60LB870V', '2400.99', NULL, 'tvlghd.jpg', '17', 'TV LED 60'''' LG 60LB870V Full HD, Wi-Fi, Smart TV y Cinema 3D. Incluye 2 Gafas Cinema 3D. Cámara web integrada.', 'Disfruta de la mejor calidad de imagen y sonido con este LED 3D.', 1, 5, NULL, NULL, NULL),
(11, 'DVDSO', 2, 'DVD Sony DVP-SR170B', '35.00', NULL, 'dvdsony.jpg', '17', 'DVD Sony DVP-SR170B. Explorador de contenido, Reproducción rápida y lenta con sonido, Multi-Disc resume.', 'Reproduce tus DVDs en este gran reproductor de DVD de Sony.', NULL, 7, NULL, NULL, NULL),
(12, 'BLUPI', 2, 'Reproductor Blu-Ray 3D Pioneer BDP-170', '159.00', NULL, 'bluraypioneer.jpg', '17', 'Reproductor Blu-Ray 3D Pioneer BDP-170, DLNA, Ethernet y Wi-Fi.', 'Reproduce tus Blu-Ray en este gran reproductor de la marca Pioneer.', NULL, 11, NULL, NULL, NULL),
(13, 'TDT01', 2, 'Sintonizador TDT Giga TV M420T', '19.90', NULL, 'tdttv.jpg', '17', 'Sintonizador TDT Giga TV M420T con USB\r\nGigaTV. Color Negro.', 'Sintoniza tus canales TDT con este sibntonizador digital de gran calidad.', NULL, 5, NULL, NULL, NULL),
(14, 'TVPHI', 2, 'TV LED 47'''' Philips 47PFH6309', '699.00', NULL, 'tvled47.jpg', '17', 'TV LED 47'''' Philips 47PFH6309 Ambilight Full HD 3D, Wi-Fi y Smart TV.', 'Disfruta de la mejor calidad de imagen con este LED 3D Philips.', NULL, 9, NULL, NULL, NULL),
(17, 'TLF01', 3, 'Samsung Galaxy Core Plus SM-G350', '119.00', NULL, 'samsung_galaxy_plus.jpg', '15', 'Smartphone libre Samsung Galaxy Core Plus SM-G350 blanco. Android 4.2 Jelly Bean, pantalla 4,3'''', cámara 5 MP, memoria interna 4 GB, procesador 1,2 Ghz.', 'Nunca estará desconectado con este Smartphone libre de Samsung.', 1, 50, NULL, NULL, NULL),
(18, 'TLF02', 3, 'Funda de piel azul Apple para iPhone 6', '45.00', NULL, 'funda01.jpg', '7', 'Funda diseñada por Apple en piel de primera calidad. Interior suave de microfibra.', 'Viste a tu iPhone con esta funda de gran calidad.', NULL, 25, NULL, NULL, NULL),
(21, 'TLF03', 3, 'Teléfono inalámbrico Dect Gigaset A420', '29.95', NULL, 'telefono01.jpg', '7', 'Iluminado, Teclas de navegación, Tecla de identificador de mensaje. Lista de las últimas 10 llamadas realizadas, llamadas perdidas 25 últimos números, Menú multilingüe hasta para 24 idiomas, Pantalla monocromo 3 líneas.', 'Estarás conectado en tu casa con este teléfono inalámbrico de gran calidad y al mejor precio.', NULL, 14, NULL, NULL, NULL),
(22, 'TLF04', 3, 'Smartphone libre Motorola Nexus 6 blanco', '599.00', NULL, 'motorola_nexus.jpg', '7', '4G, Android 5, pantalla 5,96'''', cámara 13 MP, memoria interna 32 GB, procesador 2,7 Ghz.', 'Gran smartphone de la marca Motorola al mejor precio.', NULL, 13, NULL, NULL, NULL),
(23, 'CAM01', 4, 'Cámara réflex digital Nikon D3200', '399.00', NULL, 'camara_nikon.jpg', '15', 'Cámara réflex digital Nikon D3200 + Objetivo 18-55 mm G. Sistema de reconocimiento de escena. Disparo continuo de 4 fps. Menú de retoque de fotos. Autofoco inteligente para vídeos.', 'Tus mejores fotografías con esta cámara Nikon de gran calidad.', NULL, 14, NULL, NULL, NULL),
(24, 'CAM02', 4, 'Cámara Evil Sony Alpha 5000', '399.00', NULL, 'camara_sony.jpg', '15', 'Cámara Evil Sony Alpha 5000 con Objetivo 16-50 mm. Grabación de vídeos Full HD, Envía al instante tus fotos o vídeos mp4 a un smartphone o tablet Android gracias al Wi-Fi integrado y a NFC.', 'Sony nos trae esta cámara de gran calidad y al mejor precio.', NULL, 16, NULL, NULL, NULL),
(25, 'CAM03', 4, 'Videocámara Polaroid Cube HD Sports Action', '99.00', NULL, 'camara_polaroid.jpg', '17', 'Diseñada para tomar fotografías en movimiento e imantada para colocarla en cualquier lugar, Sumergible hasta 10 metros con la carcasa acuática (accesorio opcional, no incluido), Batería de alta capacidad (hasta 90 minutos), Gran Angular de 124º.', 'Cámara deportiva resistente a salpicaduras y a prueba de golpes al mejor precio.', NULL, 18, NULL, NULL, NULL),
(26, 'CAM04', 4, 'Videocámara Sony HDR-AZ1VW', '399.00', NULL, 'videocamara_sony.jpg', '15', 'Diseño compacto y a prueba de salpicaduras, aproximadamente dos tercios del tamaño de las Action Cam anteriores.\r\n', 'Sony nos trae una gran videocámara con una gran calidad de grabación.', NULL, 10, NULL, NULL, NULL),
(27, 'INF01', 5, 'Portátil Toshiba 15,6'''' Satellite L50-B-1D5 Intel Core i3 40', '479.99', NULL, 'portatil_toshiba.jpg', '21', '- 4 GB RAM / 750 GB disco duro.\r\n- Webcam HD con micrófono integrado.\r\n- Pantalla con 200 NITs.\r\n- Soporta contenido Ultra HD (4K2K) en TV externa por HDMI.\r\n- Certificación Skullcandy.\r\n- La autonomía de la batería podrá variar según las configuraciones de hardware y software.', 'Disfruta con este ordenador portátil de Toshiba de gran calidad.', 1, 18, NULL, NULL, NULL),
(28, 'INF02', 5, 'Ordenador Sobremesa HP Envy Phoenix 810-304ns Intel Core i7', '1999.00', NULL, 'ordenador_hp.jpg', '21', 'Modelo: K2G41EA.\r\n32 GB RAM / 2 TB disco duro + 128 GB SSD / 2 GB gráfica dedicada.', 'Ordenador HP de gran calidad.', NULL, 17, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE IF NOT EXISTS `provincias` (
  `cod_provincia` char(2) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cod_provincia`, `nombre`) VALUES
('01', 'Alava'),
('02', 'Albacete'),
('03', 'Alicante'),
('04', 'Almera'),
('05', 'Avila'),
('06', 'Badajoz'),
('07', 'Balears (Illes)'),
('08', 'Barcelona'),
('09', 'Burgos'),
('10', 'Cáceres'),
('11', 'Cádiz'),
('12', 'Castellón'),
('13', 'Ciudad Real'),
('14', 'Córdoba'),
('15', 'Coruña (A)'),
('16', 'Cuenca'),
('17', 'Girona'),
('18', 'Granada'),
('19', 'Guadalajara'),
('20', 'Guipzcoa'),
('21', 'Huelva'),
('22', 'Huesca'),
('23', 'Jaén'),
('24', 'León'),
('25', 'Lleida'),
('26', 'Rioja (La)'),
('27', 'Lugo'),
('28', 'Madrid'),
('29', 'Málaga'),
('30', 'Murcia'),
('31', 'Navarra'),
('32', 'Ourense'),
('33', 'Asturias'),
('34', 'Palencia'),
('35', 'Palmas (Las)'),
('36', 'Pontevedra'),
('37', 'Salamanca'),
('38', 'Santa Cruz de Tenerife'),
('39', 'Cantabria'),
('40', 'Segovia'),
('41', 'Sevilla'),
('42', 'Soria'),
('43', 'Tarragona'),
('44', 'Teruel'),
('45', 'Toledo'),
('46', 'Valencia'),
('47', 'Valladolid'),
('48', 'Vizcaya'),
('49', 'Zamora'),
('50', 'Zaragoza'),
('51', 'Ceuta'),
('52', 'Melilla');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
`cod_usuario` int(11) NOT NULL,
  `usuario` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `correo` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(75) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_postal` varchar(5) COLLATE utf8_spanish_ci DEFAULT NULL,
  `poblacion` varchar(45) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_provincia` char(2) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`cod_usuario`, `usuario`, `clave`, `correo`, `nombre`, `apellidos`, `dni`, `direccion`, `cod_postal`, `poblacion`, `cod_provincia`) VALUES
(3, 'mario', '81dc9bdb52d04dc20036dbd8313ed055', 'mario@gmail.com', 'Mario', 'Vilches', '44202799L', 'Plaza Sancho Panza', '21007', 'Huelva', '21');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
 ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`), ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indices de la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
 ADD PRIMARY KEY (`cod_pedido`), ADD KEY `fk_linea_pedido_pedido1_idx` (`cod_pedido`), ADD KEY `fk_linea_pedido_productos1_idx` (`id_prod`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
 ADD PRIMARY KEY (`cod_pedido`,`cod_usuario`,`cod_provincia`), ADD KEY `fk_pedido_usuarios1_idx` (`cod_usuario`), ADD KEY `fk_pedido_provincias1_idx` (`cod_provincia`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
 ADD PRIMARY KEY (`id_prod`), ADD KEY `fk_productos_categorias1_idx` (`id_cat`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
 ADD PRIMARY KEY (`cod_provincia`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
 ADD PRIMARY KEY (`cod_usuario`,`cod_provincia`), ADD KEY `fk_usuarios_provincias1_idx` (`cod_provincia`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
MODIFY `id_cat` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `cod_pedido` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `linea_pedido`
--
ALTER TABLE `linea_pedido`
ADD CONSTRAINT `fk_linea_pedido_pedido1` FOREIGN KEY (`cod_pedido`) REFERENCES `pedido` (`cod_pedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_linea_pedido_productos1` FOREIGN KEY (`id_prod`) REFERENCES `productos` (`id_prod`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `fk_pedido_provincias1` FOREIGN KEY (`cod_provincia`) REFERENCES `provincias` (`cod_provincia`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_pedido_usuarios1` FOREIGN KEY (`cod_usuario`) REFERENCES `usuarios` (`cod_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
ADD CONSTRAINT `fk_productos_categorias1` FOREIGN KEY (`id_cat`) REFERENCES `categorias` (`id_cat`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
ADD CONSTRAINT `fk_usuarios_provincias1` FOREIGN KEY (`cod_provincia`) REFERENCES `provincias` (`cod_provincia`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
