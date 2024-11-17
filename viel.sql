-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/11/2024 às 03:54
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `viel`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `camisetas`
--

CREATE TABLE `camisetas` (
  `id` int(11) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `tamanho` varchar(10) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL,
  `material` varchar(100) NOT NULL,
  `imagem` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `camisetas`
--

INSERT INTO `camisetas` (`id`, `cor`, `tamanho`, `quantidade`, `valor`, `descricao`, `material`, `imagem`) VALUES
(1, 'Branca', 'G', 2, 220.00, 'linda camisa', 'pedra', 'uploads/673914ae36d31.jpeg'),
(2, 'Preto', 'M', 1, 109.00, 'camiseta preta', 'sabão', 'uploads/67392317d428a.jpeg'),
(3, 'Cinza', 'GG', 10, 109.00, 'camiseta cinza', 'tijolo', 'img/67392774ee31a.jpeg'),
(4, 'Branca', 'M', 45, 159.00, 'camiseta branca', 'borracha', 'img/camisabranca1.jpeg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

CREATE TABLE `clientes` (
  `cpf` varchar(11) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nome` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `telefone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `cidade` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `estado` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `endereco` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `senha` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tipo` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`cpf`, `nome`, `email`, `telefone`, `data_nascimento`, `cidade`, `estado`, `endereco`, `senha`, `tipo`) VALUES
('09091323990', 'Guilherme Grecco da Cruz Paz', 'cezarleonardo873@gmail.com', '(45) 99814-0848', '2000-08-28', 'Cascavel', 'PR', 'Rua Avaetés', '123456', '1'),
('12345678910', 'Leonardo Cezar da Cruz Paz', 'leonardinho@gmail.com', '45998010678', '2006-07-28', 'Cascavel', 'PR', 'Rua Avaetés', '12345', '0');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `camisetas`
--
ALTER TABLE `camisetas`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `camisetas`
--
ALTER TABLE `camisetas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
