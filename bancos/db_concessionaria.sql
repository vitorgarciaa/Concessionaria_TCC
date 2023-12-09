-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/12/2023 às 04:20
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
-- Banco de dados: `db_concessionaria`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `carro`
--

CREATE TABLE `carro` (
  `id` int(11) NOT NULL,
  `id_modelo` int(11) NOT NULL,
  `ano_fabricacao` year(4) NOT NULL,
  `cor` varchar(50) NOT NULL,
  `preco_venda` decimal(10,2) NOT NULL,
  `quilometragem` int(11) NOT NULL,
  `modelo_direcao` varchar(50) NOT NULL,
  `modelo_transmissao` varchar(50) NOT NULL,
  `placa` varchar(12) NOT NULL,
  `observacoes` varchar(255) NOT NULL,
  `disponibilidade` varchar(50) NOT NULL,
  `tipo_freio` varchar(15) NOT NULL,
  `motor` varchar(15) NOT NULL,
  `tipo_combustivel` varchar(15) NOT NULL,
  `tipo_tracao` varchar(15) NOT NULL,
  `ano_modelo` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `carro`
--

INSERT INTO `carro` (`id`, `id_modelo`, `ano_fabricacao`, `cor`, `preco_venda`, `quilometragem`, `modelo_direcao`, `modelo_transmissao`, `placa`, `observacoes`, `disponibilidade`, `tipo_freio`, `motor`, `tipo_combustivel`, `tipo_tracao`, `ano_modelo`) VALUES
(1, 1, '2022', 'Vermelho', 90000.00, 0, 'Elétrica', 'Transmissão Manual', '', 'Carro excelente para uso diário. ', 'Reservado', 'ABS', '2.0', 'Álcool', 'Dianteira', '2023'),
(3, 3, '2023', 'Preto', 155000.00, 0, 'Hidráulica', 'Transmissão Automático', '', 'Caro de luxo, para quem quer um carro chamativo... ', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(4, 2, '2020', 'Branco', 85000.00, 150, 'Hidráulica', 'Transmissão Manual', 'AAA8A54', 'Carro econômico, bom para trabalhar e rodar na cidade, top! ', 'Indisponível', 'ABS', '1.0', 'Álcool', 'Dianteira', '2021'),
(6, 3, '1994', 'Prata', 95000.00, 175000, 'Manual', 'Transmissão Manual', 'AAA8A69', 'Swap Manual - Motor novo D16y7 STD Turbo 150WHP @0,4', 'Disponível', 'ABS', 'VTEC - 1.6', 'Álcool', 'Traseira', '1995'),
(7, 4, '2014', 'vermelhVV', 200000.00, 0, 'Manual', 'Transmissão Manual', '', 'Carro estilo JDM, excelente. ', 'Disponível', 'ABS', '2.0 Turbo', 'Flex', '4x4', '2015'),
(8, 5, '1994', 'Azul', 1550000.00, 80000, 'Hidráulica', 'Transmissão Manual', 'ABA8A89', 'Carro relíquia, importado diretamente do Japão.', 'Disponível', 'ABS', '2.8 Bi-Turbo', 'Álcool', 'Traseira', '1995');

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` char(15) NOT NULL,
  `status` varchar(12) NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `telefone`, `email`, `cpf`, `status`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `complemento`, `numero`) VALUES
(1, 'Rodrigo Marques Coutinho', '(44) 99173-7701', 'rodrigo.coutinho@gazin.com.br', '075.108.939-76', 'Ativo', '87485000', 'PR', 'Douradina', 'Rural', 'Rural', 'Casa', 'KM01'),
(4, 'carolina palhari', '(44) 99803-5394', 'gazin@gazin.com.br', '127.984.059-55', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '69'),
(5, 'carolina palhari', '(44) 99803-5394', 'gazin@gazin.com.br', '127.984.059-55', 'Inativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '69');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_carro` int(11) NOT NULL,
  `id_fornecedor` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `data_compra` datetime NOT NULL DEFAULT current_timestamp(),
  `preco_custo` decimal(10,2) NOT NULL,
  `tipo_pagamento` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `compra`
--

INSERT INTO `compra` (`id`, `id_carro`, `id_fornecedor`, `id_vendedor`, `data_compra`, `preco_custo`, `tipo_pagamento`) VALUES
(1, 1, 1, 1, '2023-11-28 15:20:24', 85000.00, 'Dinheiro'),
(3, 3, 2, 1, '2023-11-28 15:29:47', 140000.00, 'Dinheiro'),
(4, 4, 2, 1, '2023-11-28 15:58:33', 70000.00, 'Dinheiro'),
(6, 6, 2, 1, '2023-11-28 16:22:16', 80000.00, 'Dinheiro'),
(7, 7, 2, 1, '2023-11-28 16:44:21', 195000.00, 'Dinheiro');

-- --------------------------------------------------------

--
-- Estrutura para tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` char(15) NOT NULL,
  `status` varchar(12) NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `cnpj` char(20) NOT NULL,
  `email_empresa` varchar(100) NOT NULL,
  `nome_fantasia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `nome`, `telefone`, `email`, `cpf`, `status`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `complemento`, `numero`, `cnpj`, `email_empresa`, `nome_fantasia`) VALUES
(1, 'Vitor Garciaa', '(44) 99803-5394', 'lvitor2424@gmail.com', '127.984.059-55', 'Ativo', '87485000', 'PR', 'Douradina', 'Centro', 'XV de Novembro', 'Casa', '260', '12.798.450/0001-55', 'vitor.garcia@gazin.com.br', 'Gazin'),
(2, 'Fornecedor 02', '(44) 99803-5394', 'fornecedor02@gmail.com', '026.624.821-76', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'Apartamento 04', '222', '11.111.111/1111-11', 'fornecedor02@yahoo.com', 'Fornecedor 02 LTDA');

-- --------------------------------------------------------

--
-- Estrutura para tabela `imagem`
--

CREATE TABLE `imagem` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `id_carro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `imagem`
--

INSERT INTO `imagem` (`id`, `nome`, `id_carro`) VALUES
(1, 'eadfa375ac8f8fea909093a8c7e3f6ab247660.png', 1),
(2, 'eadfa375ac8f8fea909093a8c7e3f6ab296867.png', 1),
(3, 'eadfa375ac8f8fea909093a8c7e3f6ab442497.png', 1),
(7, 'e3342b1cc8fa0cd83d34e54f349f1a02280243.png', 3),
(8, 'e3342b1cc8fa0cd83d34e54f349f1a02216312.png', 3),
(9, 'e3342b1cc8fa0cd83d34e54f349f1a02304865.png', 3),
(10, '1912c6841540e8d89f93fe531e45a3b2275097.png', 4),
(11, '1912c6841540e8d89f93fe531e45a3b2233307.png', 4),
(12, '1912c6841540e8d89f93fe531e45a3b2262017.png', 4),
(16, '6d5171c258a15dde9e34f71d55d2d9ce29140.jpg', 6),
(17, '6d5171c258a15dde9e34f71d55d2d9ce33314.jpg', 6),
(18, '6d5171c258a15dde9e34f71d55d2d9ce36642.jpg', 6),
(19, '26af990cfefaededaa1c6d005964bda237154.jpg', 7),
(20, '26af990cfefaededaa1c6d005964bda237653.jpg', 7),
(21, '26af990cfefaededaa1c6d005964bda234572.jpg', 7),
(22, 'e5f3fa205b14a8b4460565dcbeb52750117472.jpg', 8),
(23, 'e5f3fa205b14a8b4460565dcbeb52750113230.jpg', 8),
(24, 'e5f3fa205b14a8b4460565dcbeb52750107886.jpg', 8);

-- --------------------------------------------------------

--
-- Estrutura para tabela `marca`
--

CREATE TABLE `marca` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `marca`
--

INSERT INTO `marca` (`id`, `nome`) VALUES
(1, 'Chevrolet'),
(2, 'Volkswagem'),
(3, 'Honda'),
(4, 'Mitsubishi'),
(5, 'Nissan');

-- --------------------------------------------------------

--
-- Estrutura para tabela `modelo`
--

CREATE TABLE `modelo` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `modelo`
--

INSERT INTO `modelo` (`id`, `nome`, `id_marca`) VALUES
(1, 'Onix', 1),
(2, 'Gol', 2),
(3, 'Civic', 3),
(4, 'Lancer Evo X', 4),
(5, 'Skyline GTR R34 Spec 2', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `id_carro` int(11) DEFAULT NULL,
  `id_cliente` int(11) DEFAULT NULL,
  `id_vendedor` int(11) DEFAULT NULL,
  `data_venda` datetime NOT NULL DEFAULT current_timestamp(),
  `preco_venda` decimal(10,2) DEFAULT NULL,
  `desconto` decimal(10,2) NOT NULL,
  `valor_total` decimal(10,2) NOT NULL,
  `tipo_pagamento` varchar(15) NOT NULL,
  `situacao_pedido` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `venda`
--

INSERT INTO `venda` (`id`, `id_carro`, `id_cliente`, `id_vendedor`, `data_venda`, `preco_venda`, `desconto`, `valor_total`, `tipo_pagamento`, `situacao_pedido`) VALUES
(3, 4, 1, 1, '2023-11-28 16:06:03', 85000.00, 0.00, 0.00, 'Dinheiro', 'Orçado');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vendedor`
--

CREATE TABLE `vendedor` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cpf` char(15) NOT NULL,
  `status` varchar(12) NOT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `cidade` varchar(255) DEFAULT NULL,
  `bairro` varchar(255) DEFAULT NULL,
  `logradouro` varchar(255) DEFAULT NULL,
  `complemento` varchar(255) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `vendedor`
--

INSERT INTO `vendedor` (`id`, `nome`, `telefone`, `email`, `cpf`, `status`, `cep`, `uf`, `cidade`, `bairro`, `logradouro`, `complemento`, `numero`, `usuario`, `senha`) VALUES
(1, 'Vitor Garcia', '(44) 99803-5394', 'vitor.garcia@gazin.com.br', '127.984.059-55', 'Ativo', '87485000', 'PR', 'Douradina', 'Centro', 'Rua XV De Novembro', 'Casa', '260', 'admin', 'admin'),
(2, 'Vitor Garcia', '(44) 99803-5394', 'lvitor2424@gmail.com', '127.984.059-55', 'Ativo', '79100580', 'MS', 'Campo Grande', 'Santo Antônio', 'Rua Ministro Azevedo', 'Casa', '696', 'vitor.garcia', '$2y$10$fjVA.144iNKHF.PC7.if2edVido4HafdQkyym3BXTgoxkE/UZo8I.'),
(3, 'vitor.longhi', '(44) 99803-5394', 'vitor.garcia@gazin.com.br', '127.984.059-55', 'Ativo', '87485000', 'PR', 'Douradina', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '69', 'vitor.longhi', '$2y$10$Myf.00pUKYSJf8E4ZCqg5un2dHcGwli.ZR0NGwjGuy3euVvfRiSmO');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `carro`
--
ALTER TABLE `carro`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carro` (`id_carro`),
  ADD KEY `id_vendedor` (`id_vendedor`),
  ADD KEY `id_fornecedor` (`id_fornecedor`) USING BTREE;

--
-- Índices de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `imagem`
--
ALTER TABLE `imagem`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carro` (`id_carro`);

--
-- Índices de tabela `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `modelo`
--
ALTER TABLE `modelo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Índices de tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_carro` (`id_carro`),
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_vendedor` (`id_vendedor`);

--
-- Índices de tabela `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `carro`
--
ALTER TABLE `carro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_carro`) REFERENCES `carro` (`id`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_fornecedor`) REFERENCES `fornecedor` (`id`),
  ADD CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id`);

--
-- Restrições para tabelas `imagem`
--
ALTER TABLE `imagem`
  ADD CONSTRAINT `imagem_ibfk_1` FOREIGN KEY (`id_carro`) REFERENCES `carro` (`id`);

--
-- Restrições para tabelas `modelo`
--
ALTER TABLE `modelo`
  ADD CONSTRAINT `modelo_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marca` (`id`);

--
-- Restrições para tabelas `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`id_carro`) REFERENCES `carro` (`id`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
  ADD CONSTRAINT `venda_ibfk_3` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
