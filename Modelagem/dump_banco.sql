-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.22-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para onclinic
CREATE DATABASE IF NOT EXISTS `onclinic` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `onclinic`;

-- Copiando estrutura para tabela onclinic.contato
CREATE TABLE IF NOT EXISTS `contato` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Tipo` varchar(20) DEFAULT NULL,
  `Descricao` varchar(100) DEFAULT NULL,
  `Medico` int(11) DEFAULT NULL,
  `Paciente` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Contato_2` (`Medico`),
  KEY `FK_Contato_3` (`Paciente`),
  CONSTRAINT `FK_Contato_2` FOREIGN KEY (`Medico`) REFERENCES `medico` (`Id`),
  CONSTRAINT `FK_Contato_3` FOREIGN KEY (`Paciente`) REFERENCES `paciente` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;


-- Copiando estrutura para tabela onclinic.endereco
CREATE TABLE IF NOT EXISTS `endereco` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Logradouro` varchar(100) DEFAULT NULL,
  `Numero` varchar(10) DEFAULT NULL,
  `Bairro` varchar(100) DEFAULT NULL,
  `Cidade` varchar(100) DEFAULT NULL,
  `UF` char(2) DEFAULT NULL,
  `Complemento` varchar(50) DEFAULT NULL,
  `Medico` int(11) DEFAULT NULL,
  `Paciente` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Endereco_2` (`Medico`),
  KEY `FK_Endereco_3` (`Paciente`),
  CONSTRAINT `FK_Endereco_2` FOREIGN KEY (`Medico`) REFERENCES `medico` (`Id`),
  CONSTRAINT `FK_Endereco_3` FOREIGN KEY (`Paciente`) REFERENCES `paciente` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Copiando estrutura para tabela onclinic.especialidade
CREATE TABLE IF NOT EXISTS `especialidade` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Descricao` varchar(100) DEFAULT NULL,
  `Complemento` varchar(20) DEFAULT NULL,
  `Medico` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Especialidade_2` (`Medico`),
  CONSTRAINT `FK_Especialidade_2` FOREIGN KEY (`Medico`) REFERENCES `medico` (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;


-- Copiando estrutura para tabela onclinic.login
CREATE TABLE IF NOT EXISTS `login` (
  `Usuario` varchar(30) NOT NULL,
  `Senha` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando estrutura para tabela onclinic.medico
CREATE TABLE IF NOT EXISTS `medico` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `NOME` varchar(80) DEFAULT NULL,
  `CRM` varchar(6) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `RG` varchar(25) DEFAULT NULL,
  `Nascimento` date DEFAULT NULL,
  `Remoto` tinyint(1) DEFAULT NULL,
  `Sobre` varchar(500) DEFAULT NULL,
  `Login` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Medico_2` (`Login`),
  CONSTRAINT `FK_Medico_2` FOREIGN KEY (`Login`) REFERENCES `login` (`Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Copiando estrutura para tabela onclinic.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(80) DEFAULT NULL,
  `CPF` varchar(11) DEFAULT NULL,
  `RG` varchar(25) DEFAULT NULL,
  `Nascimento` date DEFAULT NULL,
  `Login` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `FK_Paciente_2` (`Login`),
  CONSTRAINT `FK_Paciente_2` FOREIGN KEY (`Login`) REFERENCES `login` (`Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
