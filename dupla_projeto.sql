-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20-Ago-2020 às 17:42
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
  `id_regiao` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `endereco`
--

INSERT INTO `endereco` (`id`, `cep`, `rua`, `num`, `bairro`, `cidade`, `uf`, `id_regiao`) VALUES
(6, 87010380, 'Rua Tomé de Souza', 296, 'Zona 02', 'Maringá', 'PR', NULL),
(8, 87010380, 'Rua Tomé de Souza', 295, 'Zona 02', 'Maringá', 'PR', NULL),
(9, 87013290, 'Praça José Bonifácio', 111, 'Zona 01', 'Maringá', 'PR', NULL);

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
(15, 1, 5, 50, '2020-08-01', 1),
(18, 1, 7, 1000, '2023-01-01', 1),
(19, 2, 7, 1000, '2023-02-01', 0),
(20, 3, 7, 1000, '2023-03-01', 0),
(21, 4, 7, 1000, '2023-04-01', 0);

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
  `con` tinyint(1) NOT NULL DEFAULT 0,
  `visitado` tinyint(4) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `nascimento`, `id_endereco`, `fone1`, `fone2`, `email`, `id_profissao`, `recpub`, `recimgpel`, `conviteev`, `convitecos`, `con`, `visitado`) VALUES
(6, 'José Bruno Campanholi dos Santos', '1997-03-12', 6, '', '988447123', 'josebrunocampanholi@gmail.com', 185, 0, 0, 0, 1, 1, 1),
(8, 'Elias', '0000-00-00', 8, '', '988447123', 'josebrunocampanholi@gmail.com', 220, 0, 0, 0, 0, 0, 0),
(9, 'Um nome de teste!', '2000-09-05', 9, '', '', '', 2, NULL, NULL, NULL, 0, 0, 0);

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
(7, 'Profissão'),
(8, 'Acabador Mármore'),
(9, 'Açougueiro'),
(10, 'Adm Empresas'),
(11, 'Adm Hospitalar'),
(12, 'Adm Redes'),
(13, 'Adm(a)'),
(14, 'Advogado(a)'),
(15, 'Ag Ambiental'),
(16, 'Ag de Viagens'),
(17, 'Ag Fiscal'),
(18, 'Ag Saúde'),
(19, 'Ag Viagem'),
(20, 'Agricultor(a)'),
(21, 'Agrônomo(a)'),
(22, 'Almoxarife'),
(23, 'Analista Adm'),
(24, 'Analista Com'),
(25, 'Analista Judiciário'),
(26, 'Analista Laboratório'),
(27, 'Analista Legalização'),
(28, 'Analista Marketing'),
(29, 'Analista Negócios'),
(30, 'Analista Pedidos'),
(31, 'Analista Serv Acad'),
(32, 'Analista Sistemas'),
(33, 'Analista TI'),
(34, 'Apontador Obras'),
(35, 'Aposentado(a)'),
(36, 'Arquiteto(a)'),
(37, 'Arquiteto(a)/Urbanista'),
(38, 'Artesã'),
(39, 'Artista Plástico(a)'),
(40, 'Assessor Adv'),
(41, 'Assist Adm'),
(42, 'Assist Cobrança'),
(43, 'Assist Fin'),
(44, 'Assist Int'),
(45, 'Assist Marketing'),
(46, 'Assist Vendas'),
(47, 'Atend Call Center'),
(48, 'Atend Farmácia'),
(49, 'Atendente'),
(50, 'Auditor'),
(51, 'Autonomo(a)'),
(52, 'Aux Adm'),
(53, 'Aux Almox'),
(54, 'Aux Armazenagem'),
(55, 'Aux Cantina'),
(56, 'Aux Cobrança'),
(57, 'Aux Coleta'),
(58, 'Aux Contábil'),
(59, 'Aux Dentista'),
(60, 'Aux Fat/Empresária'),
(61, 'Aux Fin'),
(62, 'Aux Montagem'),
(63, 'Aux Operacional'),
(64, 'Aux Produção'),
(65, 'Aux Prótese Dentária'),
(66, 'Aux Serv Gerais'),
(67, 'Aux Vendas'),
(68, 'Azulejista'),
(69, 'Babá'),
(70, 'Balconista'),
(71, 'Bancário(a)'),
(72, 'Barbeiro'),
(73, 'Bióloga'),
(74, 'Biólogo'),
(75, 'Biomédico(a)'),
(76, 'Bombeiro Militar'),
(77, 'Bordadeira'),
(78, 'Cabelereiro(a)'),
(79, 'Caminhoneiro(a)'),
(80, 'Carpinteiro'),
(81, 'Carteiro(a)'),
(82, 'Cencitário(a)'),
(83, 'Chefe Cozinha'),
(84, 'Cinegrafista'),
(85, 'Cirurgiã(o) Dentista'),
(86, 'Cml Paisagismo'),
(87, 'Comerciante'),
(88, 'Conferente'),
(89, 'Construtor(a)'),
(90, 'Consultor(a) Segurança'),
(91, 'Consultor(a) Vendas'),
(92, 'Consultor(a) RH'),
(93, 'Consultor(a) Turismo'),
(94, 'Contador(a)'),
(95, 'Coord Produção'),
(96, 'Coord Pedagógica'),
(97, 'Corretor(a) Imóveis'),
(98, 'Cortador Roupa'),
(99, 'Costureiro(a)'),
(100, 'Cozinheiro(a)'),
(101, 'Cuidadora Idosos'),
(102, 'Dentista'),
(103, 'Desenvolvedor'),
(104, 'Desenvol Software'),
(105, 'Design Interiores'),
(106, 'Designer'),
(107, 'Designer de Interiores'),
(108, 'Designer e Maquiador(a)'),
(109, 'Designer Floral'),
(110, 'Designer Instrucional'),
(111, 'Diarista'),
(112, 'Diretor Ensino'),
(113, 'Do Lar'),
(114, 'Docente Ens Sup'),
(115, 'Economista'),
(116, 'Educ Infantil'),
(117, 'Educ Social'),
(118, 'Eletricista'),
(119, 'Enc Dep Pessoal'),
(120, 'Emp Doméstica'),
(121, 'Empreendedor(a)'),
(122, 'Empregada Dom'),
(123, 'Empresário(a)'),
(124, 'Enc Almoxarifado'),
(125, 'Enc CPA'),
(126, 'Enc Operacional'),
(127, 'Enc RH'),
(128, 'Enc Faturamento'),
(129, 'Enfermeiro(a)'),
(130, 'Eng Agrônomo(a)'),
(131, 'Eng Civil'),
(132, 'Eng Químico(a)'),
(133, 'Eng Agrônomo'),
(134, 'Eng Civil'),
(135, 'Eng Químico(a)'),
(136, 'Engenheiro(a)'),
(137, 'Eng Agrônomo(a)'),
(138, 'Eng Eletricista'),
(139, 'Engenheiro(a)'),
(140, 'Estagiário(a)'),
(141, 'Estatístico(a)'),
(142, 'Estecista'),
(143, 'Estilista'),
(144, 'Estudante'),
(145, 'Estudante Direito'),
(146, 'Estudante Jornalismo'),
(147, 'Estudante Pedagogia'),
(148, 'Estudante Fisioterapia'),
(149, 'Executivo'),
(150, 'Famacêutico(a)'),
(151, 'Financeiro'),
(152, 'Físico'),
(153, 'Fisioterapeuta'),
(154, 'Fotógrafo(a)'),
(155, 'Fotógrafo Cinegrafista'),
(156, 'Frentista'),
(157, 'Func Público(a)'),
(158, 'Ger Adm'),
(159, 'Ger Comercial'),
(160, 'Ger Projetos'),
(161, 'Gerente'),
(162, 'Ger Produção'),
(163, 'Ger TI'),
(164, 'Gestor(a)'),
(165, 'Gestor(a) Emp'),
(166, 'Gestor(a) Prod Ind'),
(167, 'Gestor(a) Ambiental'),
(168, 'Guarda Municipal'),
(169, 'Guardião'),
(170, 'Guia Turismo'),
(171, 'Hoteleiro(a)'),
(172, 'Industriário(a)'),
(173, 'Instalador(a)'),
(174, 'Jardineiro(a)'),
(175, 'Jornalista'),
(176, 'Juiz(a) de Direito'),
(177, 'Lavadeira'),
(178, 'Leiturista Energia'),
(179, 'Lider Atendimento'),
(180, 'Logista'),
(181, 'Manicure'),
(182, 'Maquiadora'),
(183, 'Marceneiro(a)'),
(184, 'Massoterapeuta'),
(185, 'Mecânico(a)'),
(186, 'Médico(a)'),
(187, 'Médico Veterinário'),
(188, 'Merendeira'),
(189, 'Metalúrgico(a)'),
(190, 'Micro Empresário(a)'),
(191, 'Militar'),
(192, 'Modelista'),
(193, 'Monitor(a)'),
(194, 'Monitor(a) Qualidade'),
(195, 'Motorista'),
(196, 'Músico(a)'),
(197, 'Narrador Esportivo'),
(198, 'Nutricionista'),
(199, 'Of Justiça'),
(200, 'Op Acab Gráficos'),
(201, 'Op Maq  Agricola'),
(202, 'Op Máquinas'),
(203, 'Op Industrial'),
(204, 'Op Caixa'),
(205, 'Pastor Evangélico'),
(206, 'Pedagogo(a)'),
(207, 'Pedreiro(a)'),
(208, 'Pensionista'),
(209, 'Personal Trainer'),
(210, 'Pesquisadora Coca-Cola'),
(211, 'Pintor(a)'),
(212, 'Pintor(a) Automotivo'),
(213, 'Policial Civil'),
(214, 'Policial Militar'),
(215, 'Policial Federalr'),
(216, 'Porteiro(a)'),
(217, 'Produtor(a) Rural'),
(218, 'Prof Aposentada'),
(219, 'Prof Ed Física'),
(220, 'Professor(a)'),
(221, 'Professor Univ'),
(222, 'Professora Música'),
(223, 'Professora e bióloga'),
(224, 'Promotor(a) Vendas'),
(225, 'Propagandista'),
(226, 'Psicólogo(a)'),
(227, 'Publicitário()a'),
(228, 'Recepcionista'),
(229, 'Relações Públicas'),
(230, 'Rep Comercial'),
(231, 'Representante'),
(232, 'Revisor(a)'),
(233, 'Revisor(a) Textos'),
(234, 'Secretário(a)'),
(235, 'Segurança'),
(236, 'Serviços Gerais'),
(237, 'Servidor(a) Público'),
(238, 'Sócio(a) Proprietária'),
(239, 'Soldador(a)'),
(240, 'Sup Escolar'),
(241, 'Sup Ensino'),
(242, 'Sup Vendas'),
(243, 'Sup RH'),
(244, 'Supervisor(a)'),
(245, 'Téc Adm'),
(246, 'Téc Enfermagem'),
(247, 'Téc Estética'),
(248, 'Tec Elevador'),
(249, 'Téc Seg Trabalho'),
(250, 'Téc Contabilidade'),
(251, 'Téc Ótica/Optometria'),
(252, 'Téc Elétrico'),
(253, 'Téc Fisioterapia'),
(254, 'Téc Radiologia'),
(255, 'Téc Judiciário'),
(256, 'Téc Pleno'),
(257, 'Telefonista'),
(258, 'Telemarketing'),
(259, 'Tributarista'),
(260, 'Universitária'),
(261, 'Vendedor(a)'),
(262, 'Zelador(a)'),
(263, 'Zootecnista');

-- --------------------------------------------------------

--
-- Estrutura da tabela `regiao`
--

CREATE TABLE `regiao` (
  `id` int(11) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `zona` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `regiao`
--

INSERT INTO `regiao` (`id`, `bairro`, `zona`) VALUES
(1, 'Bairro', 'Zona'),
(2, 'Centro', 'Central'),
(3, 'Novo Centro', 'Central'),
(4, 'Zona 01', 'Central'),
(5, 'Zona 02', 'Central'),
(6, 'Zona 03', 'Central'),
(7, 'Zona 04', 'Central'),
(8, 'Zona 05', 'Central'),
(9, 'Zona 07', 'Central'),
(10, 'Cj Res Requião', 'Leste'),
(11, 'Jd Ipanema', 'Leste'),
(12, 'Jd Paulista', 'Leste'),
(13, 'Jd Sanenge III', 'Leste'),
(14, 'Res Aeroporto', 'Leste'),
(15, 'Vl Régia', 'Leste'),
(16, 'Zona 08', 'Leste'),
(17, 'Cidade Jardim', 'Norte'),
(18, 'Cidade Nova', 'Norte'),
(19, 'Cj Herman  M Barros', 'Norte'),
(20, 'Ebenezer', 'Norte'),
(21, 'Jd Alvorada', 'Norte'),
(22, 'Jd Batel', 'Norte'),
(23, 'Jd Canadá', 'Norte'),
(24, 'Jd Copacabana II', 'Norte'),
(25, 'Jd Diamante', 'Norte'),
(26, 'Jd Dias I', 'Norte'),
(27, 'Jd Ebenezeer', 'Norte'),
(28, 'Jd Imperial', 'Norte'),
(29, 'Jd Kakogawa', 'Norte'),
(30, 'Jd Lucianópolis', 'Norte'),
(31, 'Jd Maravilha', 'Norte'),
(32, 'Jd Novo Alvorada', 'Norte'),
(33, 'Jd Oásis', 'Norte'),
(34, 'Jd Oriental', 'Norte'),
(35, 'Jd Paris III', 'Norte'),
(36, 'Jd Pilar', 'Norte'),
(37, 'Jd Rebouças', 'Norte'),
(38, 'Jd Sta Izabel', 'Norte'),
(39, 'Jd Sumaré', 'Norte'),
(40, 'Jd Tóquio', 'Norte'),
(41, 'Jd Tupinambá', 'Norte'),
(42, 'Pq das Grevíleas', 'Norte'),
(43, 'Pq das Palmeiras', 'Norte'),
(44, 'Pq dos Camargos', 'Norte'),
(45, 'Pq Ind Duzentão', 'Norte'),
(46, 'Pq Industrial', 'Norte'),
(47, 'Vl Esperança', 'Norte'),
(48, 'Vl Morangueira', 'Norte'),
(49, 'Vl Sta Izabel', 'Norte'),
(50, 'Zona 07', 'Norte'),
(51, 'Jd Aurora', 'Oeste'),
(52, 'Jd dos Pássaros', 'Oeste'),
(53, 'Pq Hortência II', 'Oeste'),
(54, 'São Domingos', 'Oeste'),
(55, 'Zona Rural', 'Rural'),
(56, 'Chácaras Paulista', 'Sul'),
(57, 'jd Higienópolis', 'Sul'),
(58, 'Jd Itália', 'Sul'),
(59, 'Jd Monções', 'Sul'),
(60, 'Jd Novo Horizonte', 'Sul'),
(61, 'Jd Verônica', 'Sul'),
(62, 'Vl Bosque', 'Sul');

-- --------------------------------------------------------

--
-- Estrutura da tabela `soldalicio`
--

CREATE TABLE `soldalicio` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `soldalicio`
--

INSERT INTO `soldalicio` (`id`, `nome`) VALUES
(1, 'Maringá');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `nascimento` date DEFAULT NULL,
  `grupo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `nascimento`, `grupo`) VALUES
(1, 'José Bruno C.', 'jose@teste.com', '698dc19d489c4e4db73e28a713eab07b', '1997-03-12', 1),
(3, 'Elias Cardoso', 'elias@teste.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '0000-00-00', 2);

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
  `resultado` tinyint(1) NOT NULL DEFAULT 0,
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
(5, 6, 1, 1, 1, 1, 1, '2020-07-28', 1, 50, '2020-08-01', '0000-00-00'),
(7, 6, 2, 2, 4, 1, 1, '2222-02-25', 4, 1000, '2023-01-01', '0000-00-00');

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
-- Índices para tabela `regiao`
--
ALTER TABLE `regiao`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `pessoa_consagracao`
--
ALTER TABLE `pessoa_consagracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `profissao`
--
ALTER TABLE `profissao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de tabela `regiao`
--
ALTER TABLE `regiao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT de tabela `soldalicio`
--
ALTER TABLE `soldalicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `visita`
--
ALTER TABLE `visita`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
