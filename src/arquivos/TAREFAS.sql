-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30/10/2023 às 15:56
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `TAREFAS`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `Tarefas`
--

CREATE TABLE `Tarefas` (
  `Id` int(11) NOT NULL,
  `Titulo` varchar(255) NOT NULL,
  `Descricao` varchar(255) NOT NULL,
  `Status` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Tarefas`
--

INSERT INTO `Tarefas` (`Id`, `Titulo`, `Descricao`, `Status`, `Id_Usuario`) VALUES
(35, 'Titulo1', 'Descrição1', 0, 19),
(36, 'Titulo2', 'Descrição2', 0, 19),
(37, 'Titulo3', 'Descrição4', 1, 20);

-- --------------------------------------------------------

--
-- Estrutura para tabela `Users`
--

CREATE TABLE `Users` (
  `Id` int(11) NOT NULL,
  `Nome` varchar(255) NOT NULL,
  `Login` varchar(255) NOT NULL,
  `Senha` varchar(255) NOT NULL,
  `Img` blob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `Users`
--

INSERT INTO `Users` (`Id`, `Nome`, `Login`, `Senha`, `Img`) VALUES
(18, 'Danilo', 'danilo.123', '$2y$10$F304e38ixuk3rDiWjYKMquvju/t6eUP9I1i2tR9clsR9P9Aq8EGMO', 0x2e2f7372632f6172717569766f732f696d616765732f64616e696c6f2e3132332e6a7067),
(19, 'João Henrique', 'jao338', '$2y$10$62.8P/m3exl6bOc3mYk7eO/CcJSpwuY35qwA9q9o5GpGW.OmlvHPu', 0x2e2f7372632f6172717569766f732f696d616765732f363533666239333835353834632e6a7067),
(20, 'Teste', 'teete', '$2y$10$.gz6WiRAGUKYj9QjRrrmleCZeu122bf5HLLdZwFvZQD50e/8DEZgS', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `Tarefas`
--
ALTER TABLE `Tarefas`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Id_Usuario` (`Id_Usuario`);

--
-- Índices de tabela `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Login` (`Login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `Tarefas`
--
ALTER TABLE `Tarefas`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `Tarefas`
--
ALTER TABLE `Tarefas`
  ADD CONSTRAINT `Tarefas_ibfk_1` FOREIGN KEY (`Id_Usuario`) REFERENCES `Users` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
