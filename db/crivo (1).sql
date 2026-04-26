-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/04/2026 às 00:03
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crivo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `analises`
--

CREATE TABLE `analises` (
  `id_analise` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_site` int(11) NOT NULL,
  `resultado_risco` varchar(50) NOT NULL,
  `detalhes` text DEFAULT NULL,
  `data_analise` timestamp NOT NULL DEFAULT current_timestamp(),
  `parecer_ia` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `analises`
--

INSERT INTO `analises` (`id_analise`, `id_usuario`, `id_site`, `resultado_risco`, `detalhes`, `data_analise`, `parecer_ia`) VALUES
(1, 3, 1, 'Baixo', 'Pontuação final: 100/100', '2026-03-15 21:56:00', NULL),
(2, 3, 2, 'Baixo', 'Pontuação final: 95/100', '2026-03-15 21:58:51', NULL),
(3, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-19 00:14:30', NULL),
(4, 2, 4, 'Baixo', 'Pontuação final: 100/100', '2026-03-19 00:20:52', NULL),
(5, 2, 5, 'Médio', 'Pontuação final: 35/100', '2026-03-22 20:58:48', NULL),
(6, 2, 6, 'Médio', 'Pontuação final: 35/100', '2026-03-22 22:10:50', NULL),
(7, 2, 6, 'Médio', 'Pontuação final: 35/100', '2026-03-22 22:11:38', NULL),
(8, 2, 7, 'Médio', 'Pontuação final: 35/100', '2026-03-22 22:22:16', NULL),
(9, 2, 6, 'Médio', 'Pontuação final: 35/100', '2026-03-22 22:22:43', NULL),
(10, 2, 6, 'Médio', 'Pontuação final: 35/100', '2026-03-22 22:26:39', NULL),
(11, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 17:22:45', NULL),
(12, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 17:23:04', NULL),
(13, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 20:13:33', NULL),
(14, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 20:39:11', NULL),
(15, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 20:39:36', NULL),
(16, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 20:45:04', NULL),
(17, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 20:47:03', NULL),
(18, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 20:59:12', NULL),
(19, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 20:59:38', NULL),
(20, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 21:02:08', NULL),
(21, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 21:04:10', NULL),
(22, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 21:06:26', NULL),
(23, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 21:54:14', NULL),
(24, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 21:57:37', NULL),
(25, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 22:09:45', NULL),
(26, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 22:38:39', NULL),
(27, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 22:44:37', NULL),
(28, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 22:48:04', NULL),
(29, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 22:50:47', NULL),
(30, 2, 4, 'Baixo', 'Pontuação final: 100/100', '2026-03-29 22:51:29', NULL),
(31, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 22:57:49', NULL),
(32, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 23:01:15', NULL),
(33, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-03-29 23:27:44', NULL),
(34, 2, 9, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 20:35:21', NULL),
(35, 2, 9, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 20:41:57', NULL),
(36, 2, 10, 'Médio', 'Pontuação final: 35/100', '2026-04-12 20:59:34', NULL),
(37, 2, 10, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 21:01:02', NULL),
(38, 2, 11, 'Médio', 'Pontuação final: 35/100', '2026-04-12 21:11:55', NULL),
(39, 2, 11, 'Médio', 'Pontuação final: 35/100', '2026-04-12 21:12:07', NULL),
(40, 2, 11, 'Médio', 'Pontuação final: 35/100', '2026-04-12 21:12:44', NULL),
(41, 2, 12, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 21:26:10', NULL),
(42, 2, 12, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 21:44:20', NULL),
(43, 2, 13, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 22:00:37', NULL),
(44, 2, 13, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 22:09:13', NULL),
(45, 2, 13, 'Baixo', 'Pontuação final: 60/100', '2026-04-12 22:32:33', NULL),
(46, 2, 14, 'Médio', 'Pontuação final: 35/100', '2026-04-19 20:12:04', NULL),
(47, 2, 14, 'Médio', 'Pontuação final: 35/100', '2026-04-19 20:12:38', NULL),
(48, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-04-19 20:13:38', NULL),
(49, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-04-19 20:19:05', NULL),
(50, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-04-19 21:29:15', 'Não foi possível gerar um parecer automático no momento. Baseie a sua decisão na classificação de risco geral.'),
(51, 2, 3, 'Médio', 'Pontuação final: 35/100', '2026-04-19 21:36:26', 'Não foi possível gerar um parecer automático no momento. Baseie a sua decisão na classificação de risco geral.'),
(52, 2, 12, 'Baixo', 'Pontuação final: 60/100', '2026-04-19 21:36:50', 'Não foi possível gerar um parecer automático no momento. Baseie a sua decisão na classificação de risco geral.'),
(53, 2, 15, 'Baixo', 'Pontuação final: 60/100', '2026-04-19 21:46:36', 'Google recusou a conexão. Motivo: {\n  \"error\": {\n    \"code\": 404,\n    \"message\": \"models/gemini-1.5-flash is not found for API version v1beta, or is not supported for generateContent. Call ListModels to see the list of available models and their supported methods.\",\n    \"status\": \"NOT_FOUND\"\n  }\n}\n'),
(54, 2, 16, 'Baixo', 'Pontuação final: 100/100', '2026-04-19 21:51:19', 'Com base na análise rápida do sistema Crivo, o risco detetado para o Pinterest é baixo e o domínio tem impressionantes 16 anos. Estes são fortes indicadores de uma plataforma estabelecida e segura. Sim, pode confiar e utilizar o site com tranquilidade.'),
(55, 2, 16, 'Baixo', 'Pontuação final: 100/100', '2026-04-19 21:54:51', 'Olá! A nossa análise do Pinterest indica um cenário robusto e seguro para si. Com um risco API baixo e um domínio ativo há 16 anos, todos os indicadores apontam para a sua fiabilidade. Pode confiar no site e utilizá-lo com tranquilidade.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

CREATE TABLE `avaliacoes` (
  `id_avaliacao` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_site` int(11) NOT NULL,
  `comentario` text NOT NULL,
  `data_avaliacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `nota` int(11) DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id_avaliacao`, `id_usuario`, `id_site`, `comentario`, `data_avaliacao`, `nota`) VALUES
(1, 2, 3, 'Otimo', '2026-03-29 23:27:25', 5),
(2, 2, 11, 'Bom', '2026-04-12 21:12:22', 5),
(3, 2, 13, 'bom', '2026-04-12 22:54:17', 5),
(4, 2, 14, 'Otimo recomendo', '2026-04-19 20:12:27', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `sites`
--

CREATE TABLE `sites` (
  `id_site` int(11) NOT NULL,
  `url` varchar(2048) NOT NULL,
  `primeira_analise` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sites`
--

INSERT INTO `sites` (`id_site`, `url`, `primeira_analise`) VALUES
(1, 'https://floravenida.com/', '2026-03-15 21:56:00'),
(2, 'https://suellenflores.shop/', '2026-03-15 21:58:50'),
(3, 'http://localhost/crivo/dashboard', '2026-03-19 00:14:30'),
(4, 'https://www.amazon.com/', '2026-03-19 00:20:52'),
(5, 'http://localhost/crivo/#', '2026-03-22 20:58:48'),
(6, 'http://localhost/crivo/#sobre', '2026-03-22 22:10:50'),
(7, 'http://localhost/crivo/#sobrehttp://localhost/crivo/#sobre', '2026-03-22 22:22:16'),
(8, 'http://localhost/crivo/avaliacoes', '2026-03-29 17:25:23'),
(9, 'https://www.compradiretaempresas.com.br/lavanderia/maquina-de-lavar?srsltid=AfmBOoog9O47WIRG4uAvm0wso5_0Ul5KAR2ZItfAJ3FBC-KJpmwdvfJx', '2026-04-12 20:35:21'),
(10, 'https://www.trocafone.com.br/smartphones/smartphones/apple?gad_source=1&gad_campaignid=21273343869&gbraid=0AAAAADjd0LkViX8HceT7K5YYLgt_SeIJY&gclid=CjwKCAjwhe3OBhABEiwA6392zBnAl9LbOQ2E35jqYV1pbNN0_TS9wyxXXCq2QkTmvj8zLQwQv6DmuxoCG8UQAvD_BwE', '2026-04-12 20:59:34'),
(11, 'http://localhost/crivo/dashboard#', '2026-04-12 21:11:55'),
(12, 'https://shop.simpress.com.br/smartphone-samsung-galaxy-a12-64-gb-4-gb-ram-preto?parceiro=6005&gad_source=1&gad_campaignid=23200870268&gbraid=0AAAABB0cdZCs9OH_XYLaH9HvCz_IRlwnb&gclid=CjwKCAjwhe3OBhABEiwA6392zL6cGMZGPJf2Tue0Asv3JV13O_nRIz5o4OTsC3EpY4IMNA4B22l85xoCBDoQAvD_BwE', '2026-04-12 21:26:10'),
(13, 'https://www.bethyflores.com.br/?srsltid=AfmBOoqLZkmrary2pLwy3_heWcFGwxeHiqODvW2BdZL3hQKnNMBP428M', '2026-04-12 22:00:37'),
(14, 'http://localhost/crivo/', '2026-04-19 19:49:56'),
(15, 'https://www.iplace.com.br/apple-iphone-17/100435PR?gad_source=1&gad_campaignid=23029626201&gbraid=0AAAAADmSXe-9BU_WO_5_YdfztJVfbngZ9&gclid=Cj0KCQjw-pHPBhCdARIsAHXYWP_pK0yMgJRSU0MauZMKZ_P5qNNpoYhaaJCb5V5lifFUXBj0L3fhKKMaAh56EALw_wcB', '2026-04-19 21:46:36'),
(16, 'https://br.pinterest.com/', '2026-04-19 21:51:11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha_hash` varchar(255) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha_hash`, `data_cadastro`) VALUES
(1, 'rayssa', 'rayssa@gmail.com', '$2y$10$RA61sRE1SAFyP5UGsOrn1OZqYF0zJBQMyNvjL9lBA330iHHquGvxG', '2025-10-19 21:41:02'),
(2, 'Usuário Teste', 'teste@crivo.com', '$2y$10$9XTZMG7OukokFlREutjIWuB0VTGW9R4ivUvFUKTIs8gt./N1X5G9W', '2026-03-01 19:05:17'),
(3, 'Usuário Test', 'teste@crivo.com', '$2y$10$3OdU6towc8dV/GMhtRfSoecttuX9tqfrc9zGwTQ8C/uJVQMTph1GO', '2026-03-15 21:54:27');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `analises`
--
ALTER TABLE `analises`
  ADD PRIMARY KEY (`id_analise`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_site` (`id_site`);

--
-- Índices de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD PRIMARY KEY (`id_avaliacao`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_site` (`id_site`);

--
-- Índices de tabela `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id_site`),
  ADD UNIQUE KEY `url_unica` (`url`(255));

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `email_unico` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `analises`
--
ALTER TABLE `analises`
  MODIFY `id_analise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT de tabela `avaliacoes`
--
ALTER TABLE `avaliacoes`
  MODIFY `id_avaliacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `sites`
--
ALTER TABLE `sites`
  MODIFY `id_site` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `analises`
--
ALTER TABLE `analises`
  ADD CONSTRAINT `analises_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `analises_ibfk_2` FOREIGN KEY (`id_site`) REFERENCES `sites` (`id_site`);

--
-- Restrições para tabelas `avaliacoes`
--
ALTER TABLE `avaliacoes`
  ADD CONSTRAINT `avaliacoes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `avaliacoes_ibfk_2` FOREIGN KEY (`id_site`) REFERENCES `sites` (`id_site`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
