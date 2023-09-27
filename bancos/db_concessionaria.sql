-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 27/09/2023 às 22:37
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
(1, 1, '2023', 'Branco', 0.00, 150, 'Manual', 'Transmissão Manual', 'AAA8A54', 'top', 'Disponível', 'ABS', 'VTEC - 1.6', 'Álcool', 'Traseira', '2023'),
(2, 2, '2023', 'Preto', 0.00, 0, 'Manual', 'Transmissão Manual', '', 'Melhor honda civic do mercado atual', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(3, 2, '2023', 'Branco', 1.50, 0, 'Manual', 'Transmissão Manual', '', 'a', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(4, 1, '2023', 'vermelho', 1750000.00, 0, 'Hidráulica', 'Transmissão Manual', '', 'aaaaaa', 'Disponível', 'a Disco', '2.0 Turbo', 'Álcool', 'Dianteira', '2023'),
(5, 1, '2023', 'vermelho', 1750000.00, 0, 'Hidráulica', 'Transmissão Manual', '', 'aaaaaa', 'Disponível', 'a Disco', '2.0 Turbo', 'Álcool', 'Dianteira', '2023'),
(6, 1, '2023', 'vermelho', 1750000.00, 0, 'Hidráulica', 'Transmissão Manual', '', 'qaaaaaa', 'Disponível', 'a Disco', '2.0 Turbo', 'Álcool', 'Dianteira', '2023'),
(7, 4, '2023', 'Branco', 17.50, 0, 'Manual', 'Transmissão Manual', '', 'sdfsfsdfsdfsdf', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(8, 1, '2023', 'vermelho', 165000.00, 0, 'Manual', 'Transmissão Automático', '', '', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(9, 1, '2023', 'Branco', 175000.00, 0, 'Manual', 'Transmissão Manual', '', '', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023'),
(10, 2, '2023', 'Branco', 175000.00, 0, 'Manual', 'Transmissão Manual', '', '', 'Disponível', 'ABS', '2.0 Turbo', 'Álcool', 'Traseira', '2023');

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
(4, 9, 4, 16, '2023-09-27 17:24:19', 145000.00, 'dinheiro');

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
(4, 'Vitor Garcia', '(44) 44444-4444', 'lvitor2424@gmail.com', '127.984.059-55', 'Ativo', '04027060', 'SP', 'São Paulo', 'Indianópolis', 'Rua Rubens Cardoso Vieira', 'aaa', '111', '11.111.111/1111-11', 'aaa@gazin.com.br', 'aaaa'),
(5, 'Fornecedor 1', '(11) 1234-5678', 'fornecedor1@email.com', '123.456.789-01', 'Ativo', '12345-678', 'SP', 'São Paulo', 'Centro', 'Rua A', 'Apto 101', '1', '12.345.678/0001-01', 'empresa1@email.com', 'Fantasia 1'),
(6, 'Fornecedor 2', '(22) 2345-6789', 'fornecedor2@email.com', '234.567.890-12', 'Inativo', '23456-789', 'RJ', 'Rio de Janeiro', 'Copacabana', 'Avenida B', 'Sala 201', '2', '23.456.789/0002-02', 'empresa2@email.com', 'Fantasia 2'),
(7, 'Fornecedor 3', '(33) 3456-7890', 'fornecedor3@email.com', '345.678.901-23', 'Ativo', '34567-890', 'MG', 'Belo Horizonte', 'Savassi', 'Rua C', 'Casa 301', '3', '34.567.890/0003-03', 'empresa3@email.com', 'Fantasia 3'),
(8, 'Fornecedor 4', '(44) 4567-8901', 'fornecedor4@email.com', '456.789.012-34', 'Inativo', '45678-901', 'RS', 'Porto Alegre', 'Moinhos de Vento', 'Avenida D', 'Apto 401', '4', '45.678.901/0004-04', 'empresa4@email.com', 'Fantasia 4'),
(9, 'Fornecedor 5', '(55) 5678-9012', 'fornecedor5@email.com', '567.890.123-45', 'Ativo', '56789-012', 'BA', 'Salvador', 'Barra', 'Rua E', 'Casa 501', '5', '56.789.012/0005-05', 'empresa5@email.com', 'Fantasia 5'),
(10, 'Fornecedor 6', '(66) 6789-0123', 'fornecedor6@email.com', '678.901.234-56', 'Inativo', '67890-123', 'PE', 'Recife', 'Boa Viagem', 'Avenida F', 'Sala 601', '6', '67.890.123/0006-06', 'empresa6@email.com', 'Fantasia 6'),
(11, 'Fornecedor 7', '(77) 7890-1234', 'fornecedor7@email.com', '789.012.345-67', 'Ativo', '78901-234', 'DF', 'Brasília', 'Asa Sul', 'Quadra G', 'Apto 701', '7', '78.901.234/0007-07', 'empresa7@email.com', 'Fantasia 7'),
(12, 'Fornecedor 8', '(88) 8901-2345', 'fornecedor8@email.com', '890.123.456-78', 'Inativo', '89012-345', 'CE', 'Fortaleza', 'Aldeota', 'Rua H', 'Casa 801', '8', '89.012.345/0008-08', 'empresa8@email.com', 'Fantasia 8'),
(13, 'Fornecedor 9', '(99) 9012-3456', 'fornecedor9@email.com', '901.234.567-89', 'Ativo', '90123-456', 'PR', 'Curitiba', 'Batel', 'Avenida I', 'Sala 901', '9', '90.123.456/0009-09', 'empresa9@email.com', 'Fantasia 9'),
(14, 'Fornecedor 10', '(10) 0123-4567', 'fornecedor10@email.com', '012.345.678-90', 'Inativo', '01234-567', 'SC', 'Florianópolis', 'Centro', 'Rua J', 'Apto 1001', '10', '01.234.567/0010-10', 'empresa10@email.com', 'Fantasia 10');

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
(6, '3162987ce5f1fb392e138513af70cf2f41016.jpg', 2),
(7, '551f8d050672d83a5998e703bbace0b9117924webp', 3),
(8, '551f8d050672d83a5998e703bbace0b9307294.png', 3),
(9, '551f8d050672d83a5998e703bbace0b996914webp', 3),
(10, '6617771a3ebea79c2a2844fc2ed6483196914webp', 4),
(11, '6617771a3ebea79c2a2844fc2ed64831117924webp', 4),
(12, '6617771a3ebea79c2a2844fc2ed64831307294.png', 4),
(13, '28f06c11e85956ad64e01d7e66340f4596914webp', 5),
(14, '28f06c11e85956ad64e01d7e66340f45117924webp', 5),
(15, '28f06c11e85956ad64e01d7e66340f45307294.png', 5),
(16, 'a830ec2bd7afe88b07d045c4f7d60062307294.png', 6),
(17, 'a830ec2bd7afe88b07d045c4f7d60062117924webp', 6),
(18, 'a830ec2bd7afe88b07d045c4f7d6006296914webp', 6),
(19, 'f6a49ace721f4866b3d03f499575ff4296914webp', 7),
(20, 'f6a49ace721f4866b3d03f499575ff42117924webp', 7),
(21, 'f6a49ace721f4866b3d03f499575ff42123554webp', 7),
(22, '4bb3ac9502203714e545bf06c402bf3f96914webp', 8),
(23, '4bb3ac9502203714e545bf06c402bf3f117924webp', 8),
(24, '4bb3ac9502203714e545bf06c402bf3f123554webp', 8),
(25, '00e5931314e76abf065e17dd410472b896914webp', 9),
(26, '00e5931314e76abf065e17dd410472b8117924webp', 9),
(27, '00e5931314e76abf065e17dd410472b8123554webp', 9),
(28, 'eea7d0f02be0c58af462a686d727ed9a96914webp', 10),
(29, 'eea7d0f02be0c58af462a686d727ed9a117924webp', 10),
(30, 'eea7d0f02be0c58af462a686d727ed9a123554webp', 10);

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
(2, 'Honda'),
(3, 'netinho');

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
(2, 'Civic', 2),
(3, 'netinho', 3),
(4, 'matehsu', 2);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `compra`
--
ALTER TABLE `compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `imagem`
--
ALTER TABLE `imagem`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `marca`
--
ALTER TABLE `marca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `modelo`
--
ALTER TABLE `modelo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
