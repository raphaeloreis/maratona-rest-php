-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17-Fev-2021 às 03:22
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `maratona`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `corredor`
--

CREATE TABLE `corredor` (
  `id` int(5) UNSIGNED NOT NULL,
  `nome` varchar(120) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `nascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `corredor`
--

INSERT INTO `corredor` (`id`, `nome`, `cpf`, `nascimento`) VALUES
(1, 'Raphael', '062.123.321-12', '2000-10-10'),
(2, 'Paulo', '123.123.123-12', '1990-10-11'),
(3, 'Antonio', '062.123.321-12', '1985-05-25'),
(4, 'João', '062.123.321-12', '1950-02-12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prova`
--

CREATE TABLE `prova` (
  `id` int(5) UNSIGNED NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `prova`
--

INSERT INTO `prova` (`id`, `tipo`, `data`) VALUES
(1, '10km', '2020-01-01'),
(2, '5km', '2020-01-02'),
(3, '3km', '2020-01-03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `registro`
--

CREATE TABLE `registro` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_corredor` int(5) NOT NULL,
  `id_prova` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resultado`
--

CREATE TABLE `resultado` (
  `id` int(5) UNSIGNED NOT NULL,
  `id_corredor` int(5) NOT NULL,
  `id_prova` int(5) NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_conclusao` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `resultado`
--

INSERT INTO `resultado` (`id`, `id_corredor`, `id_prova`, `hora_inicio`, `hora_conclusao`) VALUES
(1, 1, 1, '10:00:00', '10:47:30'),
(2, 2, 1, '10:00:00', '10:45:30'),
(3, 3, 1, '10:00:00', '10:48:30'),
(4, 4, 1, '10:00:00', '10:47:50'),
(5, 1, 2, '10:00:00', '11:05:30'),
(6, 2, 2, '10:00:00', '11:07:30'),
(7, 3, 2, '10:00:00', '11:15:30'),
(8, 4, 2, '10:00:00', '11:22:30');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `corredor`
--
ALTER TABLE `corredor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `prova`
--
ALTER TABLE `prova`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Índices para tabela `resultado`
--
ALTER TABLE `resultado`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `corredor`
--
ALTER TABLE `corredor`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `prova`
--
ALTER TABLE `prova`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `registro`
--
ALTER TABLE `registro`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `resultado`
--
ALTER TABLE `resultado`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
