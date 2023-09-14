-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14/09/2023 às 21:36
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
  `preco` decimal(10,2) NOT NULL,
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

INSERT INTO `carro` (`id`, `id_modelo`, `ano_fabricacao`, `cor`, `preco`, `quilometragem`, `modelo_direcao`, `modelo_transmissao`, `placa`, `observacoes`, `disponibilidade`, `tipo_freio`, `motor`, `tipo_combustivel`, `tipo_tracao`, `ano_modelo`) VALUES
(1, 1, '2023', 'Branco', 175444.44, 150, 'Manual', 'Transmissão Manual', 'AAA8A54', 'top', 'Disponível', 'ABS', 'VTEC - 1.6', 'Álcool', 'Traseira', '2023'),
(2, 2, '2023', 'Preto', 250000.00, 0, 'Manual', 'Transmissão Manual', '', 'Melhor honda civic do mercado atual', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023');

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
(5, 'Vitor Garcia', '(44) 99803-5394', 'lvitor2424@gmail.com', '127.984.059-55', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'Casa', '212');

-- --------------------------------------------------------

--
-- Estrutura para tabela `compra`
--

CREATE TABLE `compra` (
  `id` int(11) NOT NULL,
  `id_carro` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `id_vendedor` int(11) NOT NULL,
  `data_compra` datetime NOT NULL DEFAULT current_timestamp(),
  `preco_compra` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, '63ea04b22fadbd8ed7a9bb8eb86c1fab192961.jpg', 1),
(2, '63ea04b22fadbd8ed7a9bb8eb86c1fab203483.jpg', 1),
(3, '63ea04b22fadbd8ed7a9bb8eb86c1fab203483.jpg', 1),
(4, '3162987ce5f1fb392e138513af70cf2f38558.jpg', 2),
(5, '3162987ce5f1fb392e138513af70cf2f39072.jpg', 2),
(6, '3162987ce5f1fb392e138513af70cf2f41016.jpg', 2);

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
(1, 'Volkswagem'),
(2, 'Honda');

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
(1, 'Golf MK 7.5R', 1),
(2, 'Civic', 2);

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
  `tipo_pagamento` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(9, 'Vitor Emanuel Longhi Garcia', '(44) 99803-5394', 'vitor.garcia@gazin.com.br', '127.984.059-55', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '69', '', ''),
(10, 'Vitor Garcia', '(44) 99803-5394', 'gazin@gazin.com.br', '127.984.059-55', 'Ativo', '79100580', 'MS', 'Campo Grande', 'Santo Antônio', 'Rua Ministro Azevedo', 'Casa', '696', '', ''),
(11, 'Jubileu', '(44) 98055-394', 'jubileo@gazin.com.br', '127.984.059-55', 'Ativo', '87485000', 'PR', 'Douradina', 'aa', 'aa', 'aa', '222', '', ''),
(12, 'milenio', '(44) 98055-394', 'milenio.rocha@gazin.com.br', '127.984.059-55', 'Ativo', '87485000', '', '', 'aa', 'aa', 'aa', '222', '', ''),
(13, 'milenio', '(44) 98055-394', 'milenio.rocha@gazin.com.br', '127.984.059-55', 'Ativo', '87485000', 'PR', 'Douradina', 'aaa', 'aa', 'aa', '222', 'milenio', ''),
(14, 'milenio', '(44) 98055-394', 'milenio.rocha@gazin.com.br', '127.984.059-55', 'Ativo', '87485000', '', '', 'aaa', 'aa', 'aa', '222', 'aaa', '123asd'),
(15, 'milenio', '(44) 98055-394', 'milenio.rocha@gazin.com.br', '127.984.059-55', 'Ativo', '87485000', '', '', 'aaa', 'aa', 'aa', '222', '1111', '123'),
(16, 'Ariane', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane', '123'),
(17, 'Ariane', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane', '123'),
(18, 'joao', '(44) 99803-5394', 'joao@gazin.com.br', '127.984.059-55', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '666', 'joao', '1234'),
(19, 'joao', '(44) 99803-5394', 'joao@gazin.com.br', '127.984.059-55', 'Ativo', '04027060', '', '', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '666', 'asdasd', '$2y$10$seepqaB1OLQYUoYKFYEoVu9f4dlYvUULdugFJWDNAzQrVBV/F4sr6'),
(20, 'Cristiano de Sá', '(44) 99803-5394', 'cristiano.sa@gazin.com.br', '047.526.489-46', 'Ativo', '87485000', '', '', '', '', '', '', 'cristiano', '$2y$10$AZRzEwnRnmPkoVwqUG47GeKiPZIdulC18jH02hgTNKW2NTXpbxHLq'),
(21, 'Cristiano de Sá', '(44) 99803-5394', 'cristiano.sa@gazin.com.br', '047.526.489-46', 'Ativo', '87485000', 'PR', 'Douradina', 'Santo Antônio', 'Rua Rubens Cardoso Vieira', 'Casa', '666', 'cristiano', '$2y$10$uOutRkR6gEanLWIwv2.HzuUae/gr5dOaw5XICaJ/VAH36iGjdT6oK'),
(22, 'Ariane', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane', '$2y$10$6xb3lUmM3ggnFiwmia/Nje4AtDUv5/4GddUv//YL7fK/.9gPU4jlq'),
(23, 'Ariane````', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane````', '$2y$10$zDpcLryMj5gHBX5lINuKSe.Mu/q8kTF6.UM8zbCJAY9kZE/PK2NL2'),
(24, 'Ariane````', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane````485', '$2y$10$4kuBM6M7BpDJfguvEig5q.5jfVRpCZj54arBF6TXLcDJ9NMh14E5.'),
(25, 'Ariane````', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane````485234234', '$2y$10$GuroZ8l3PTh2h9iM/tVqE.THHVZ6lt4WxrdcaBEo9Bim1smTOk5Nu'),
(26, 'Ariane````', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane````485234234rewr', '$2y$10$J.qiKzhh4kAe1FHNNoNZgeHj1fRMKL4bt3XeUzywdf2YqahfcHVry'),
(27, 'Ariane````', '(44) 99803-5394', 'ariane@gazin.com.br', '490.688.659-00', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'apartamento 04', '222', 'ariane', '$2y$10$wxKBnU7jC7lLOrP0Ife2V.WX9tdawbxRQa8ZfdoCnRsnJngiiTd3K');

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
  ADD KEY `id_cliente` (`id_cliente`),
  ADD KEY `id_vendedor` (`id_vendedor`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_carro`) REFERENCES `carro` (`id`),
  ADD CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id`),
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
