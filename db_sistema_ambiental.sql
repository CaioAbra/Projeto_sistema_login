-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 10-Fev-2023 às 03:25
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_sistema_ambiental`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `informacoes`
--

DROP TABLE IF EXISTS `informacoes`;
CREATE TABLE IF NOT EXISTS `informacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `descricao` longtext CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `hora` varchar(45) NOT NULL,
  `data` varchar(45) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `informacoes`
--

INSERT INTO `informacoes` (`id`, `descricao`, `hora`, `data`, `usuario`) VALUES
(1, 'Teste para descrição minion numero 1', '18:15', '2023-02-09', 'minion');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userLogin` varchar(200) NOT NULL,
  `senha` varchar(200) NOT NULL,
  `nivel_user` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userLogin_UNIQUE` (`userLogin`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `userLogin`, `senha`, `nivel_user`) VALUES
(1, 'minion', 'minion', 1),
(2, 'minion1', 'minion1', 2),
(3, 'minion2', 'minion2', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
