-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/11/2023 às 17:33
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
(1, 1, '2023', 'vermelho', 1.00, 0, 'Manual', 'Transmissão Manual', '', 'top', 'Indisponível', 'ABS', '2.0 Turbo', 'Álcool', 'Dianteira', '2023'),
(2, 1, '2023', 'Branco', 195000.00, 1500000, 'Hidráulica', 'Transmissão Automático', 'AAA8A54', 'TOP TOP', 'Indisponível', 'a Disco', '2.0 Turbo', 'Diesel', 'Dianteira', '2023'),
(3, 1, '2023', 'vermelho', 1750000.00, 150000000, 'Hidráulica', 'Transmissão Manual', 'AAA8A54', 'aa', 'Disponível', 'a Disco', '2.0 Turbo', 'Diesel', 'Dianteira', '2023'),
(4, 1, '2027', 'vermelho', 1750000.00, 15000, 'Manual', 'Transmissão Manual', 'AAA8A54', 'aa', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(5, 1, '2027', 'Branco', 1750000.00, 0, 'Manual', 'Transmissão Manual', '', 'aa', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(6, 1, '2023', 'vermelho', 1750000.00, 0, 'Manual', 'Transmissão Manual', '', 'aa', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(7, 1, '2023', 'vermelho', 1750000.00, 0, 'Manual', 'Transmissão Manual', '', 'a', 'Disponível', 'ABS', '2.0 Turbo', 'Diesel', 'Dianteira', '2023');

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
(1, 'Vitor Garcia', '(44) 99803-5394', 'lvitor2424@gmail.com', '127.984.059-55', 'Ativo', '79100580', 'MS', 'Campo Grande', 'Santo Antônio', 'Rua Ministro AzevedoA', 'apartamento 04', '222');

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
(2, 2, 1, 1, '2023-11-20 14:06:25', 184000.00, 'Cheque'),
(3, 3, 1, 1, '2023-11-20 14:13:20', 1500000.00, 'Dinheiro'),
(4, 4, 1, 1, '2023-11-20 14:14:16', 1500000.00, 'Cartão');

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
(1, 'Vitor Garcia', '(44) 98055-394', 'lvitor2424@gmail.com', '127.984.059-55', 'Ativo', '87485000', 'PR', 'Douradina', 'Santo Antônio', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '260', '12.798.450/0001-55', 'vitor.garcia@gazin.com.br', 'Empresa top');

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
(1, '9e883752242b1e315b2cb6c93057a0eb38558.jpg', 1),
(2, '9e883752242b1e315b2cb6c93057a0eb39072.jpg', 1),
(3, '9e883752242b1e315b2cb6c93057a0eb41016.jpg', 1),
(4, 'fe825c0eec55a154ea4ce60be856a6f679513.png', 2),
(5, 'fe825c0eec55a154ea4ce60be856a6f646188.png', 2),
(6, 'fe825c0eec55a154ea4ce60be856a6f65286.png', 2),
(7, 'ef8be0fd4d618daf36ab2e885cf529fb202010.png', 3),
(8, 'ef8be0fd4d618daf36ab2e885cf529fb216508.png', 3),
(9, 'ef8be0fd4d618daf36ab2e885cf529fb200426.png', 3),
(10, 'ea39c4019ff3d47cad6d2368759c8e83202010.png', 4),
(11, 'ea39c4019ff3d47cad6d2368759c8e83216508.png', 4),
(12, 'ea39c4019ff3d47cad6d2368759c8e83200426.png', 4),
(13, 'cf7ebc50b2aeb0ea3aa215195ba64872200426.png', 5),
(14, 'cf7ebc50b2aeb0ea3aa215195ba64872216508.png', 5),
(15, 'cf7ebc50b2aeb0ea3aa215195ba64872202010.png', 5),
(16, '7e48f52f0e97eeefe3513eafc6836a9036899.png', 6),
(17, '7e48f52f0e97eeefe3513eafc6836a90202010.png', 6),
(18, '7e48f52f0e97eeefe3513eafc6836a90216508.png', 6),
(19, 'b2e13acd43a9fd0afeeae27dea5323da216508.png', 7),
(20, 'b2e13acd43a9fd0afeeae27dea5323da202010.png', 7),
(21, 'b2e13acd43a9fd0afeeae27dea5323da200426.png', 7);

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
(1, 'Honda');

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
(1, 'Civic', 1);

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
(6, 1, 1, 1, '0000-00-00 00:00:00', 100000.00, 0.00, 0.00, 'Dinheiro', 'Fechado'),
(7, 2, 1, 1, '0000-00-00 00:00:00', 195000.00, 0.00, 0.00, 'Dinheiro', 'Orçado');

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
(2, 'Vitor Garcia', '(44) 99803-5394', 'lvitor2424@gmail.com', '127.984.059-55', 'Inativo', '79100580', 'MS', 'Campo Grande', 'Santo Antônio', 'Rua Ministro Azevedo', 'Casa', '696', 'vitor.garcia', '$2y$10$lvUfS1r.VpoclM5799W9ae7uTvjmqxeDZoCCgKXAYK1RezJYJ6PvO');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
