-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 23/08/2018 às 11:50
-- Versão do servidor: 5.7.22-0ubuntu18.04.1
-- Versão do PHP: 7.2.7-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ithappens`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `estoque`
--

CREATE TABLE `estoque` (
  `est_id` int(11) NOT NULL,
  `est_fil_id` int(11) NOT NULL,
  `est_pro_id` int(11) NOT NULL,
  `est_disponivel` int(11) DEFAULT NULL,
  `est_reservado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `estoque`
--

INSERT INTO `estoque` (`est_id`, `est_fil_id`, `est_pro_id`, `est_disponivel`, `est_reservado`) VALUES
(1, 1, 1, 50, 0),
(3, 1, 2, 700, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `filial`
--

CREATE TABLE `filial` (
  `fil_id` int(11) NOT NULL,
  `fil_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `filial`
--

INSERT INTO `filial` (`fil_id`, `fil_nome`) VALUES
(1, 'mateus centro'),
(2, 'mateus cohama');

-- --------------------------------------------------------

--
-- Estrutura para tabela `Item_pedido_estoque`
--

CREATE TABLE `Item_pedido_estoque` (
  `ipe_id` int(11) NOT NULL,
  `ipe_ped_id` int(11) NOT NULL,
  `ipe_pro_id` int(11) NOT NULL,
  `ipe_quantidade` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `Item_pedido_estoque`
--

INSERT INTO `Item_pedido_estoque` (`ipe_id`, `ipe_ped_id`, `ipe_pro_id`, `ipe_quantidade`) VALUES
(2, 1, 1, 2),
(4, 1, 2, 50);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pedido_estoque`
--

CREATE TABLE `pedido_estoque` (
  `ped_id` int(11) NOT NULL,
  `ped_descricao` varchar(255) DEFAULT NULL,
  `ped_user_id` int(11) DEFAULT NULL,
  `ped_fil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `pedido_estoque`
--

INSERT INTO `pedido_estoque` (`ped_id`, `ped_descricao`, `ped_user_id`, `ped_fil_id`) VALUES
(1, 'dsfdsf', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `produto`
--

CREATE TABLE `produto` (
  `pro_id` int(11) NOT NULL,
  `pro_fil_id` int(11) NOT NULL,
  `pro_nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `produto`
--

INSERT INTO `produto` (`pro_id`, `pro_fil_id`, `pro_nome`) VALUES
(1, 1, 'caneta'),
(2, 1, 'papeis');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`est_id`,`est_fil_id`),
  ADD KEY `fk_estoque_filial1_idx` (`est_fil_id`),
  ADD KEY `fk_estoque_produto1_idx` (`est_pro_id`);

--
-- Índices de tabela `filial`
--
ALTER TABLE `filial`
  ADD PRIMARY KEY (`fil_id`);

--
-- Índices de tabela `Item_pedido_estoque`
--
ALTER TABLE `Item_pedido_estoque`
  ADD PRIMARY KEY (`ipe_id`,`ipe_ped_id`,`ipe_pro_id`),
  ADD KEY `fk_Item_pedido_estoque_pedido_estoque1_idx` (`ipe_ped_id`),
  ADD KEY `fk_Item_pedido_estoque_produto1_idx` (`ipe_pro_id`);

--
-- Índices de tabela `pedido_estoque`
--
ALTER TABLE `pedido_estoque`
  ADD PRIMARY KEY (`ped_id`);

--
-- Índices de tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `fk_produto_filial` (`pro_fil_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `estoque`
--
ALTER TABLE `estoque`
  MODIFY `est_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de tabela `filial`
--
ALTER TABLE `filial`
  MODIFY `fil_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `Item_pedido_estoque`
--
ALTER TABLE `Item_pedido_estoque`
  MODIFY `ipe_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT de tabela `pedido_estoque`
--
ALTER TABLE `pedido_estoque`
  MODIFY `ped_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `estoque`
--
ALTER TABLE `estoque`
  ADD CONSTRAINT `fk_estoque_filial1` FOREIGN KEY (`est_fil_id`) REFERENCES `filial` (`fil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estoque_produto1` FOREIGN KEY (`est_pro_id`) REFERENCES `produto` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `Item_pedido_estoque`
--
ALTER TABLE `Item_pedido_estoque`
  ADD CONSTRAINT `fk_Item_pedido_estoque_pedido_estoque1` FOREIGN KEY (`ipe_ped_id`) REFERENCES `pedido_estoque` (`ped_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Item_pedido_estoque_produto1` FOREIGN KEY (`ipe_pro_id`) REFERENCES `produto` (`pro_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `produto`
--
ALTER TABLE `produto`
  ADD CONSTRAINT `fk_produto_filial` FOREIGN KEY (`pro_fil_id`) REFERENCES `filial` (`fil_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
