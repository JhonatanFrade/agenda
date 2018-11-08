-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 02-Nov-2018 às 01:23
-- Versão do servidor: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oc_agenda_web_2`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `centro_custos`
--

CREATE TABLE `centro_custos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `date_create` varchar(80) NOT NULL,
  `date_update` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `centro_custos`
--

INSERT INTO `centro_custos` (`id`, `nome`, `date_create`, `date_update`) VALUES
(5, 'laser', '01-11-2018 19:46:09', '01-11-2018 19:46:09'),
(6, 'roupa', '01-11-2018 19:46:14', '01-11-2018 19:46:14'),
(7, 'luz', '01-11-2018 19:46:18', '01-11-2018 19:46:18'),
(8, 'gasolina', '01-11-2018 19:46:24', '01-11-2018 19:46:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas`
--

CREATE TABLE `contas` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_update` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contas`
--

INSERT INTO `contas` (`id`, `nome`, `date_create`, `date_update`) VALUES
(12, 'Jon Snow', '2018-10-31 14:16:57', '2018-10-31 14:16:57'),
(13, 'Dracarys Jr', '2018-10-31 10:18:42', '2018-10-31 10:19:03'),
(14, 'Neymar jr', '2018-10-31 11:21:44', '2018-10-31 11:21:44'),
(15, 'Banco do Brasil', '2018-10-31 11:24:29', '2018-10-31 11:24:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `date_create` varchar(80) NOT NULL,
  `date_update` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`id`, `descricao`, `date_create`, `date_update`) VALUES
(1, 'laser', '01-11-2018 10:19:46', '01-11-2018 10:19:46'),
(2, 'telefone', '01-11-2018 10:21:58', '01-11-2018 10:21:58'),
(4, 'luz', '01-11-2018 10:22:14', '01-11-2018 10:22:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacao`
--

CREATE TABLE `movimentacao` (
  `id` int(11) NOT NULL,
  `id_centro_custos` int(11) NOT NULL,
  `id_conta` int(11) NOT NULL,
  `tipo_mov` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `parcelas`
--

CREATE TABLE `parcelas` (
  `id` int(11) NOT NULL,
  `id_centro_custos` int(11) NOT NULL,
  `id_conta` int(11) NOT NULL,
  `id_item` int(11) NOT NULL,
  `tipo_mov` varchar(10) NOT NULL,
  `parcela` varchar(10) NOT NULL,
  `vencimento` datetime NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `status_pagamento` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recorrentes`
--

CREATE TABLE `recorrentes` (
  `id` int(11) NOT NULL,
  `id_centro_custos` int(11) NOT NULL,
  `id_conta` int(11) NOT NULL,
  `tipo_mov` varchar(10) NOT NULL,
  `dia` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `valor` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recorrentes_movimentacao`
--

CREATE TABLE `recorrentes_movimentacao` (
  `id_recorrentes` int(11) NOT NULL,
  `id_movimentacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `centro_custos`
--
ALTER TABLE `centro_custos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contas`
--
ALTER TABLE `contas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_conta` (`id_conta`),
  ADD KEY `id_centro_custos` (`id_centro_custos`);

--
-- Indexes for table `parcelas`
--
ALTER TABLE `parcelas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_centro_custos` (`id_centro_custos`),
  ADD KEY `id_conta` (`id_conta`),
  ADD KEY `id_item` (`id_item`);

--
-- Indexes for table `recorrentes`
--
ALTER TABLE `recorrentes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_centro_custos` (`id_centro_custos`),
  ADD KEY `id_conta` (`id_conta`);

--
-- Indexes for table `recorrentes_movimentacao`
--
ALTER TABLE `recorrentes_movimentacao`
  ADD KEY `id_movimentacao` (`id_movimentacao`),
  ADD KEY `id_recorrentes` (`id_recorrentes`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `centro_custos`
--
ALTER TABLE `centro_custos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `contas`
--
ALTER TABLE `contas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `movimentacao`
--
ALTER TABLE `movimentacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcelas`
--
ALTER TABLE `parcelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recorrentes`
--
ALTER TABLE `recorrentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `movimentacao`
--
ALTER TABLE `movimentacao`
  ADD CONSTRAINT `movimentacao_ibfk_1` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id`),
  ADD CONSTRAINT `movimentacao_ibfk_2` FOREIGN KEY (`id_centro_custos`) REFERENCES `centro_custos` (`id`);

--
-- Limitadores para a tabela `parcelas`
--
ALTER TABLE `parcelas`
  ADD CONSTRAINT `parcelas_ibfk_1` FOREIGN KEY (`id_centro_custos`) REFERENCES `centro_custos` (`id`),
  ADD CONSTRAINT `parcelas_ibfk_2` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id`),
  ADD CONSTRAINT `parcelas_ibfk_3` FOREIGN KEY (`id_item`) REFERENCES `item` (`id`);

--
-- Limitadores para a tabela `recorrentes`
--
ALTER TABLE `recorrentes`
  ADD CONSTRAINT `recorrentes_ibfk_1` FOREIGN KEY (`id_centro_custos`) REFERENCES `centro_custos` (`id`),
  ADD CONSTRAINT `recorrentes_ibfk_2` FOREIGN KEY (`id_conta`) REFERENCES `contas` (`id`);

--
-- Limitadores para a tabela `recorrentes_movimentacao`
--
ALTER TABLE `recorrentes_movimentacao`
  ADD CONSTRAINT `recorrentes_movimentacao_ibfk_1` FOREIGN KEY (`id_movimentacao`) REFERENCES `movimentacao` (`id`),
  ADD CONSTRAINT `recorrentes_movimentacao_ibfk_2` FOREIGN KEY (`id_recorrentes`) REFERENCES `recorrentes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
