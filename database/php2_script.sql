-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.14 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             9.5.0.5253
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para php2
CREATE DATABASE IF NOT EXISTS `php2` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `php2`;

-- Volcando estructura para tabla php2.alumnos
CREATE TABLE IF NOT EXISTS `alumnos` (
  `id_alumno` int(11) NOT NULL AUTO_INCREMENT,
  `paterno` varchar(30) NOT NULL,
  `materno` varchar(30) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `cumple` date DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_alumno`),
  UNIQUE KEY `dni` (`dni`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla php2.alumnos: ~8 rows (aproximadamente)
/*!40000 ALTER TABLE `alumnos` DISABLE KEYS */;
INSERT INTO `alumnos` (`id_alumno`, `paterno`, `materno`, `nombre`, `dni`, `cumple`, `correo`) VALUES
	(1, 'ALMEYDA', 'LÉVANO', 'PERCY', '12345678', '1975-11-07', 'palmeyda@php.uni'),
	(2, 'AGREDA', 'ZAPATA', 'CÉSAR', '12345671', '1976-12-08', 'cagreda@php.uni'),
	(3, 'ACEDO', 'ROJAS', 'EVA', '12345672', '2018-02-24', 'eacedo@php.uni'),
	(4, 'ACEVEDO', 'SANCHEZ', 'INÉS', '12345673', '1980-02-24', 'iacevedo@php.uni'),
	(5, 'ACERO', 'TORRES', 'KATHERINE', '12345674', '1983-08-25', 'kacero@php.uni'),
	(6, 'CARRERA', 'PEÑA', 'LUIS', '12345675', '1975-03-29', 'lcarrera@php.uni'),
	(7, 'CABRERA', 'QUIROZ', 'MARTIN', '12345676', '2004-06-13', 'mcabrera@php.uni'),
	(8, 'CASPORERA', 'POZO', 'CARMEN', '12345677', '1986-02-27', 'ccasporera@php.uni');
/*!40000 ALTER TABLE `alumnos` ENABLE KEYS */;

-- Volcando estructura para tabla php2.alumno_curso
CREATE TABLE IF NOT EXISTS `alumno_curso` (
  `id_alumno` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `n1` double NOT NULL DEFAULT '0',
  `n2` double NOT NULL DEFAULT '0',
  `n3` double NOT NULL DEFAULT '0',
  `n4` double NOT NULL DEFAULT '0',
  `promedio` double NOT NULL DEFAULT '0',
  `notificado` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_alumno`,`id_curso`),
  KEY `fk_curso` (`id_curso`),
  CONSTRAINT `fk_alumno` FOREIGN KEY (`id_alumno`) REFERENCES `alumnos` (`id_alumno`),
  CONSTRAINT `fk_curso` FOREIGN KEY (`id_curso`) REFERENCES `cursos` (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla php2.alumno_curso: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `alumno_curso` DISABLE KEYS */;
/*!40000 ALTER TABLE `alumno_curso` ENABLE KEYS */;

-- Volcando estructura para tabla php2.cursos
CREATE TABLE IF NOT EXISTS `cursos` (
  `id_curso` int(11) NOT NULL AUTO_INCREMENT,
  `curso_nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla php2.cursos: ~3 rows (aproximadamente)
/*!40000 ALTER TABLE `cursos` DISABLE KEYS */;
INSERT INTO `cursos` (`id_curso`, `curso_nombre`) VALUES
	(1, 'PHP1 - BASICO'),
	(2, 'PHP2 - INTERMEDIO '),
	(3, 'PHP3 - AVANZADO');
/*!40000 ALTER TABLE `cursos` ENABLE KEYS */;

-- Volcando estructura para tabla php2.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `clave` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Volcando datos para la tabla php2.usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` (`id_usuario`, `login`, `clave`, `password`) VALUES
	(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
	(2, 'alumno', '123456', 'e10adc3949ba59abbe56e057f20f883e');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;

-- Volcando estructura para disparador php2.alumno_curso_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `alumno_curso_before_insert` BEFORE INSERT ON `alumno_curso` FOR EACH ROW BEGIN
set new.promedio=(new.n1 + new.n2 + new.n3 + new.n4) /4 ;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador php2.alumno_curso_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `alumno_curso_before_update` BEFORE UPDATE ON `alumno_curso` FOR EACH ROW BEGIN
set new.promedio=(new.n1 + new.n2 + new.n3 + new.n4) /4 ;
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador php2.usuarios_before_insert
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `usuarios_before_insert` BEFORE INSERT ON `usuarios` FOR EACH ROW BEGIN
set new.password=md5(new.clave);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

-- Volcando estructura para disparador php2.usuarios_before_update
SET @OLDTMP_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION';
DELIMITER //
CREATE TRIGGER `usuarios_before_update` BEFORE UPDATE ON `usuarios` FOR EACH ROW BEGIN
set new.password=md5(new.clave);
END//
DELIMITER ;
SET SQL_MODE=@OLDTMP_SQL_MODE;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
