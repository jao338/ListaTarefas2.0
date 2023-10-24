-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24/10/2023 às 14:31
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
(1, 'Titulo de teste', 'Descrição de teste', 1, 4),
(2, 'Titulo de teste', 'Descricao de teste', 0, 4);

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
(4, 'João Henrique', 'jao338', '$2y$10$C2AT4eTrl20mMjHAeVoKIO4C7.rXKrTTCEv17sEmCQK31c0Qh7gV.', 0x2f6f70742f6c616d70702f74656d702f70687058487a587643),
(13, 'TesteUpdate', 'teste.123', '$2y$10$w.OXG7AAYBdxgavagqL5Nue0oodO2w9SO.W1yNWjn7AIJo.n4wCs.', NULL),
(14, 'AAAAAA', 'aaaio', '$2y$10$ktCFIGfn4wXvYT4VS/jkq.wUqTEEsx67PjenTPXZU3P4hS7Nlw.lm', NULL);

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
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `Users`
--
ALTER TABLE `Users`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
