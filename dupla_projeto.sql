-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Jul-2020 às 00:11
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dupla_projeto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `consagracao`
--

CREATE TABLE `consagracao` (
  `id` int(11) NOT NULL,
  `turma` int(11) NOT NULL,
  `id_soldalicio` int(11) NOT NULL,
  `inicio` date NOT NULL,
  `fim` date NOT NULL,
  `consagracao_data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `consagracao`
--

INSERT INTO `consagracao` (`id`, `turma`, `id_soldalicio`, `inicio`, `fim`, `consagracao_data`) VALUES
(1, 75, 1, '2020-03-21', '2020-05-21', '2020-05-21');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dupla`
--

CREATE TABLE `dupla` (
  `id` int(11) NOT NULL,
  `nome1` varchar(100) NOT NULL,
  `nome2` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `dupla`
--

INSERT INTO `dupla` (`id`, `nome1`, `nome2`) VALUES
(1, 'Anderson', 'Lucas'),
(2, 'Felipe', 'Territo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE `endereco` (
  `id` int(11) NOT NULL,
  `cep` int(8) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `num` int(11) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(20) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `zona` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `rua`, `num`, `bairro`, `cidade`, `uf`, `zona`) VALUES
(6, 87010380, 'Rua Tomé de Souza', 296, 'Zona 02', 'Maringá', 'PR', NULL),
(8, 87010380, 'Rua Tomé de Souza', 295, 'Zona 02', 'Maringá', 'PR', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `finalidade_doacao`
--

CREATE TABLE `finalidade_doacao` (
  `id` int(11) NOT NULL,
  `finalidade` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `finalidade_doacao`
--

INSERT INTO `finalidade_doacao` (`id`, `finalidade`) VALUES
(1, 'Construção da Igreja'),
(2, 'Construção do Mosteiro'),
(3, 'Ajuda Sede'),
(4, 'Afiliado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

CREATE TABLE `forma_pagamento` (
  `id` int(11) NOT NULL,
  `pagamento` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`id`, `pagamento`) VALUES
(1, 'Débito Automático'),
(2, 'Cheque'),
(3, 'Cartão de Crédito'),
(4, 'Dinheiro'),
(5, 'Carnê');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parcela`
--

CREATE TABLE `parcela` (
  `id` int(11) NOT NULL,
  `n_parcela` int(11) NOT NULL,
  `id_visita` int(11) NOT NULL,
  `valor` float NOT NULL,
  `vencimento` date NOT NULL,
  `pagamento` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `parcela`
--

INSERT INTO `parcela` (`id`, `n_parcela`, `id_visita`, `valor`, `vencimento`, `pagamento`) VALUES
(11, 1, 3, 50, '2020-08-01', NULL),
(12, 2, 3, 50, '2020-09-01', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `id_endereco` int(11) NOT NULL,
  `fone1` varchar(20) DEFAULT NULL,
  `fone2` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `id_profissao` int(11) DEFAULT NULL,
  `recpub` tinyint(1) DEFAULT 0,
  `recimgpel` tinyint(1) DEFAULT 0,
  `conviteev` tinyint(1) DEFAULT 0,
  `convitecos` tinyint(1) DEFAULT 0,
  `con` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Erro ao ler dados para tabela dupla_projeto.pessoa: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `dupla_projeto`.`pessoa`' na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_consagracao`
--

CREATE TABLE `pessoa_consagracao` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `renovacao` tinyint(1) NOT NULL,
  `concluido` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoa_consagracao`
--

INSERT INTO `pessoa_consagracao` (`id`, `id_pessoa`, `id_curso`, `renovacao`, `concluido`) VALUES
(2, 6, 1, 0, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `profissao`
--

CREATE TABLE `profissao` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `profissao`
--

INSERT INTO `profissao` (`id`, `nome`) VALUES
(1, 'Médico'),
(2, 'Advogado'),
(3, 'Programador'),
(4, 'Professor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `soldalicio`
--

CREATE TABLE `soldalicio` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-- Erro ao ler dados para tabela dupla_projeto.soldalicio: #1064 - Você tem um erro de sintaxe no seu SQL próximo a 'FROM `dupla_projeto`.`soldalicio`' na linha 1

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `grupo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `grupo`) VALUES
(1, 'José', 'jose@teste.com', '698dc19d489c4e4db73e28a713eab07b', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visita`
--

CREATE TABLE `visita` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_dupla` int(11) NOT NULL,
  `id_forma_pagamento` int(11) DEFAULT NULL,
  `id_finalidade` int(11) DEFAULT NULL,
  `id_soldalicio` int(11) NOT NULL,
  `resultado` tinyint(1) NOT NULL,
  `data` date NOT NULL,
  `n_parcela` int(11) DEFAULT NULL,
  `valor` float DEFAULT NULL,
  `inicio` date DEFAULT NULL,
  `termino` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `visita`
--

INSERT INTO `visita` (`id`, `id_pessoa`, `id_dupla`, `id_forma_pagamento`, `id_finalidade`, `id_soldalicio`, `resultado`, `data`, `n_parcela`, `valor`, `inicio`, `termino`) VALUES
(3, 6, 1, 1, 3, 1, 1, '2020-07-21', 2, 50, '2020-08-01', '0000-00-00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `consagracao`
--
ALTER TABLE `consagracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `dupla`
--
ALTER TABLE `dupla`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `endereco`
--
ALTER TABLE `endereco`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `finalidade_doacao`
--
ALTER TABLE `finalidade_doacao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `parcela`
--
ALTER TABLE `parcela`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pessoa_consagracao`
--
ALTER TABLE `pessoa_consagracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `profissao`
--
ALTER TABLE `profissao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `soldalicio`
--
ALTER TABLE `soldalicio`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `visita`
--
ALTER TABLE `visita`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `consagracao`
--
ALTER TABLE `consagracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `dupla`
--
ALTER TABLE `dupla`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `endereco`
--
ALTER TABLE `endereco`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `finalidade_doacao`
--
ALTER TABLE `finalidade_doacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `forma_pagamento`
--
ALTER TABLE `forma_pagamento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `parcela`
--
ALTER TABLE `parcela`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `pessoa_consagracao`
--
ALTER TABLE `pessoa_consagracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `profissao`
--
ALTER TABLE `profissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `soldalicio`
--
ALTER TABLE `soldalicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `visita`
--
ALTER TABLE `visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
