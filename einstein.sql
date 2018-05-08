-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 08-Maio-2018 às 14:52
-- Versão do servidor: 10.1.19-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `einstein`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `codigoCliente` int(11) NOT NULL,
  `nomeCliente` varchar(45) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(128) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `dataNas` date NOT NULL,
  `celular` varchar(45) NOT NULL,
  `telefoneFixo` varchar(255) DEFAULT NULL,
  `tipoUsuario` varchar(255) NOT NULL DEFAULT '0',
  `dataCadas` datetime NOT NULL,
  `FKEndereco` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`codigoCliente`, `nomeCliente`, `email`, `senha`, `salt`, `cpf`, `dataNas`, `celular`, `telefoneFixo`, `tipoUsuario`, `dataCadas`, `FKEndereco`) VALUES
(1, 'wesllen alves de sousa aa', 'wesllenalves@gmail.com', '123456789', '', '03230944143', '0000-00-00', '1111111', '', '', '0000-00-00 00:00:00', 1),
(2, 'wesllen alves de sousa', 'wesllenalves3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '', '03230944143', '0000-00-00', '619817456595', '', '', '0000-00-00 00:00:00', 2),
(3, 'wesllen alves de sousa', 'wesllenalves@gmail.com', '123456', '', '03230944143', '0000-00-00', '619817456595', '', '', '0000-00-00 00:00:00', 3),
(4, 'wesllen alves de sousa', 'wesllenalves@gmail.com', '', '', '03230944143', '0000-00-00', '619817456595', '', '', '0000-00-00 00:00:00', 4),
(5, 'lucas maria da silva', 'teste@teste.com', '123456', '', '03230944143', '0000-00-00', '619817456595', '', 'comun', '0000-00-00 00:00:00', 5),
(6, 'teste teste', 'teste@teste.com', '123456', '', '03230944156', '0000-00-00', '61981745566', '', 'comun', '0000-00-00 00:00:00', 6),
(7, 'teste', 'admin@admin.com', '123456', '', '03230944143', '0000-00-00', '61981745695', '', 'admin', '0000-00-00 00:00:00', 7),
(8, 'wesllen alves de sousa', 'teste01@maile3.com', 'MTI=', '$2y$10$ESDYqyakf14hcBE7ZXWbF.81.WGaLlQCb3u4qKWnRmzkNdjkxWafG', '03230944103', '2018-05-04', '61981745695', '', '0', '2018-05-04 13:08:40', 12),
(9, 'wesllen alves de sousa', 'wesllenalves1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '$2y$10$hGi3svvs4Fd4R7QEPcOy2.s5Xtau21D010EVKsoLmNhnDTg/fY7lw', '03230944122', '1993-09-24', '61981745695', '61981745695', '0', '2018-05-07 10:31:04', 13),
(11, 'wesllen alves de sousa', 'wesllenalves2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '$2y$10$9WtSPt8iUerzGulDx.io0OBkY8VOhJsMIh9ydMyMTT.0KkrSKQj2.', '03230944121', '1993-09-24', '61981745695', '61981745695', '0', '2018-05-08 09:19:28', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `codigoEndereco` int(11) NOT NULL,
  `cep` varchar(255) NOT NULL,
  `rua` varchar(255) NOT NULL,
  `bairro` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `estado` varchar(255) NOT NULL,
  `complemento` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`codigoEndereco`, `cep`, `rua`, `bairro`, `cidade`, `estado`, `complemento`) VALUES
(1, '', '', '', '', '', ''),
(2, '', '', '', '', '', ''),
(3, '', '', '', '', '', ''),
(4, '', '', '', '', '', ''),
(5, '', '', '', '', '', ''),
(6, '', '', '', '', '', ''),
(7, '', '', '', '', '', ''),
(8, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'Brasília', 'DF', 'Green Park'),
(9, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'Brasília', 'DF', 'Green Park'),
(10, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'Brasília', 'DF', 'Green Park'),
(11, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'Brasília', 'DF', 'Green Park'),
(12, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'Brasília', 'DF', 'Green Park'),
(13, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'BrasÃ­lia', 'DF', 'Green Park'),
(14, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'BrasÃ­lia', 'DF', 'Green Park'),
(15, '70645160', 'SRES Quadra 10 Bloco P', 'Cruzeiro Velho', 'BrasÃ­lia', 'DF', 'Green Park');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `codigoFornecedor` int(11) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `nomeFornecedor` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`codigoFornecedor`, `cnpj`, `nomeFornecedor`, `telefone`, `email`) VALUES
(1, '', 'casa do sapato', '61981745395', 'wesllen@gmail.com'),
(2, '', 'casa do sapato', '61981745395', 'wesllen@gmail.com'),
(3, '', 'casa do sapato', '61981745395', 'wesllen@gmail.com'),
(4, '', 'casa do sapato', '61981745395', 'wesllen@gmail.com'),
(5, '', 'casa do sapato', '61981745395', 'wesllen@gmail.com'),
(6, '', 'casa do sapato', '61981745395', 'wesllen@gmail.com'),
(7, '', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(8, '1234567', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(9, '1234567', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(10, '1234567', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(11, '1234567', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(12, '1234567', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(13, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(14, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(15, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(16, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(17, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(18, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(19, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(20, '123456544554', 'casa do sapato', '6198174595', 'wesllen@gmail.com'),
(21, '01234566789', 'Casa dos tenis ', '6198475358', 'teste@teste.com'),
(22, '01234566789', 'Casa dos tenis ', '6198475358', 'teste@teste.com'),
(23, '01234566789', 'Casa dos tenis ', '6198475358', 'teste@teste.com'),
(24, '000000', 'tecttudo', '00000000000', 'tect@teste.com'),
(25, 'teste', 'teste', '00000000000', 'tect@teste.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `idFuncionario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(256) NOT NULL,
  `telefoneCelular` varchar(255) NOT NULL,
  `telefoneFixo` varchar(255) NOT NULL,
  `dataNascimento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`idFuncionario`, `nome`, `rg`, `email`, `senha`, `telefoneCelular`, `telefoneFixo`, `dataNascimento`) VALUES
(1, 'wesllen', '297145', 'wesllenalves@gmail.com', '123456', '6198174595', '30459780', '2018-04-19');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_projeto`
--

CREATE TABLE `funcionario_projeto` (
  `FKFuncionario` int(11) NOT NULL,
  `FKProjeto` int(11) NOT NULL,
  `nomeFase` varchar(255) NOT NULL,
  `dataInicialFase` date NOT NULL,
  `dataFinalFase` date NOT NULL,
  `statusFase` int(1) NOT NULL,
  `observacaoFase` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

CREATE TABLE `login_attempts` (
  `idlogin_attempts` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `login_attempts`
--

INSERT INTO `login_attempts` (`idlogin_attempts`, `user_id`, `created_at`) VALUES
(36, 2, '0000-00-00 00:00:00'),
(37, 2, '0000-00-00 00:00:00'),
(38, 2, '0000-00-00 00:00:00'),
(39, 2, '0000-00-00 00:00:00'),
(40, 2, '0000-00-00 00:00:00'),
(41, 2, '0000-00-00 00:00:00'),
(42, 2, '0000-00-00 00:00:00'),
(43, 2, '0000-00-00 00:00:00'),
(44, 2, '0000-00-00 00:00:00'),
(46, 9, '0000-00-00 00:00:00'),
(47, 9, '0000-00-00 00:00:00'),
(48, 9, '0000-00-00 00:00:00'),
(49, 9, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `codigoProduto` int(11) NOT NULL,
  `nomeProduto` varchar(255) NOT NULL,
  `descricaoProduto` text NOT NULL,
  `qtdEstoque` int(11) NOT NULL,
  `valor` decimal(18,2) NOT NULL,
  `fotoProduto` varchar(255) DEFAULT NULL,
  `FKFornecedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`codigoProduto`, `nomeProduto`, `descricaoProduto`, `qtdEstoque`, `valor`, `fotoProduto`, `FKFornecedor`) VALUES
(1, 'tennis', 'novo', 3, '25.00', 'tenis-nike-air-behold-low-masculino.jpg', 20),
(2, 'sapatennis', 'um confortÃ¡vel sapato para o verao', 10, '80.00', 'main-product01.jpg', 22),
(3, 'sapatennis', 'testetes para testes', 100, '90.00', 'main-product02.jpg', 23),
(4, 'robo', 'robozinho', 200, '100.00', 'zenbo.jpg', 24),
(5, 'teste', 'teste', 1, '101.11', 'teste.png', 25);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `idprojeto` int(11) NOT NULL,
  `nomeProjeto` varchar(255) NOT NULL,
  `descricaoProjeto` text NOT NULL,
  `dataInicio` date NOT NULL,
  `dataFim` date NOT NULL,
  `statusProjeto` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `recoveries`
--

CREATE TABLE `recoveries` (
  `idpassword` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `idroles` int(11) NOT NULL,
  `role` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`idroles`, `role`) VALUES
(1, 'Admin'),
(2, 'Users');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `idusers` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `cpf` varchar(255) NOT NULL,
  `dataNasc` date NOT NULL,
  `dataCad` datetime NOT NULL,
  `salt` char(128) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`idusers`, `nome`, `email`, `senha`, `cpf`, `dataNasc`, `dataCad`, `salt`, `role_id`, `status`) VALUES
(2, 'wesllen alves de sousa', 'wesllenalves@gmail.com', 'MTIzNDU2', '03230944143', '1993-09-24', '2018-04-02 17:16:53', '$2y$10$PmE7iiQOPU6/tSoOHLdq.eGNCfzZGsdFGb42/M8rjd9dC5rBnEb4C', 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`codigoCliente`),
  ADD UNIQUE KEY `FKEndereco_constraint` (`FKEndereco`) USING BTREE;

--
-- Indexes for table `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`codigoEndereco`);

--
-- Indexes for table `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`codigoFornecedor`);

--
-- Indexes for table `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`idFuncionario`);

--
-- Indexes for table `funcionario_projeto`
--
ALTER TABLE `funcionario_projeto`
  ADD PRIMARY KEY (`FKFuncionario`,`FKProjeto`),
  ADD KEY `fk_funcionario_has_projeto_projeto1_idx` (`FKProjeto`),
  ADD KEY `fk_funcionario_has_projeto_funcionario_idx` (`FKFuncionario`);

--
-- Indexes for table `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD PRIMARY KEY (`idlogin_attempts`),
  ADD KEY `login_attempts_user_id` (`user_id`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`codigoProduto`,`FKFornecedor`),
  ADD KEY `FKFornecedor_codigoFornecedor_idx` (`FKFornecedor`);

--
-- Indexes for table `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`idprojeto`);

--
-- Indexes for table `recoveries`
--
ALTER TABLE `recoveries`
  ADD PRIMARY KEY (`idpassword`),
  ADD KEY `password_user_id` (`user_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idroles`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idusers`),
  ADD KEY `roles_role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `codigoCliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `endereco`
--
ALTER TABLE `endereco`
  MODIFY `codigoEndereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `codigoFornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `idFuncionario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `login_attempts`
--
ALTER TABLE `login_attempts`
  MODIFY `idlogin_attempts` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `codigoProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `projeto`
--
ALTER TABLE `projeto`
  MODIFY `idprojeto` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recoveries`
--
ALTER TABLE `recoveries`
  MODIFY `idpassword` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idusers` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `FKEndereco_constraint` FOREIGN KEY (`FKEndereco`) REFERENCES `endereco` (`codigoEndereco`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `funcionario_projeto`
--
ALTER TABLE `funcionario_projeto`
  ADD CONSTRAINT `fk_funcionario_has_projeto_funcionario` FOREIGN KEY (`FKFuncionario`) REFERENCES `funcionario` (`idFuncionario`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_funcionario_has_projeto_projeto1` FOREIGN KEY (`FKProjeto`) REFERENCES `projeto` (`idprojeto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `login_attempts`
--
ALTER TABLE `login_attempts`
  ADD CONSTRAINT `login_attempts_user_id` FOREIGN KEY (`user_id`) REFERENCES `cliente` (`codigoCliente`);

--
-- Limitadores para a tabela `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `FKFornecedor_codigoFornecedor` FOREIGN KEY (`FKFornecedor`) REFERENCES `fornecedor` (`codigoFornecedor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `recoveries`
--
ALTER TABLE `recoveries`
  ADD CONSTRAINT `password_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`idusers`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `roles_role_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`idroles`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
