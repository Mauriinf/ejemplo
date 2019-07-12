-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 17-11-2016 a las 16:45:42
-- Versión del servidor: 5.6.12-log
-- Versión de PHP: 5.4.12




/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `gym`
--
CREATE DATABASE IF NOT EXISTS `gym` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `gym`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_tbl`
--

CREATE TABLE IF NOT EXISTS `admin_tbl` (
  `adminid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `time stamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `admin_tbl`
--

INSERT INTO `admin_tbl` (`adminid`, `username`, `password`, `time stamp`) VALUES
(1, 'admin', 'admin', '2015-09-19 08:22:09'),
(2, 'kamal', 'kamal', '2015-09-19 08:22:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_equip`
--

CREATE TABLE IF NOT EXISTS `tbl_equip` (
  `equipid` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `vendor` varchar(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `phone` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`equipid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Volcado de datos para la tabla `tbl_equip`
--

INSERT INTO `tbl_equip` (`equipid`, `name`, `vendor`, `amount`, `phone`, `address`, `date`) VALUES
(12, 'sadas', 'asdasd', 3434, '324234', 'asrwer', '2015-11-25'),
(13, 'walking machine', 'abc', 1234, '12312321', 'dsfdsfsd', '2015-11-29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_userreg`
--

CREATE TABLE IF NOT EXISTS `tbl_userreg` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `age` int(200) DEFAULT NULL,
  `sex` varchar(200) DEFAULT NULL,
  `phone` int(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `service` varchar(200) DEFAULT NULL,
  `timestap` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` int(200) DEFAULT NULL,
  `plan` int(200) NOT NULL,
  `status` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `tbl_userreg`
--

INSERT INTO `tbl_userreg` (`userid`, `firstname`, `lastname`, `age`, `sex`, `phone`, `address`, `service`, `timestap`, `amount`, `plan`, `status`) VALUES
(4, 'Platea21', 'Platea21', 25, 'male', 2147483647, 'Peru', 'gym', '2016-11-17 11:55:00', 200, 180, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
