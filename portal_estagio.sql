-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 11:07 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `portal_estagio`
--

-- --------------------------------------------------------

--
-- Table structure for table `curriculos`
--

CREATE TABLE `curriculos` (
  `id` int(11) NOT NULL,
  `estudante_id` int(11) DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `data_envio` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `tipo` enum('estudante','empresa') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `tipo`) VALUES
(1, 'padu', 'carvalhopadu@gmail.com', '$2y$10$gktzmKUg45KNqvBvm8sGlea18c1TO2xUoJLZsVFl.Bi2GkYMPvFLC', 'estudante'),
(2, 'empresa', 'empresa@gmail.com', '$2y$10$wYHlf1WEgYGh7zfh7qAeWeFecho.9wa4NbPZNwp/jsudqZiHmR8mW', 'empresa');

-- --------------------------------------------------------

--
-- Table structure for table `vagas`
--

CREATE TABLE `vagas` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `titulo` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `local` varchar(100) DEFAULT NULL,
  `bolsa` decimal(10,2) DEFAULT NULL,
  `data_criacao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vagas`
--

INSERT INTO `vagas` (`id`, `empresa_id`, `titulo`, `descricao`, `local`, `bolsa`, `data_criacao`) VALUES
(8, 2, 'Estagiário(a) de Desenvolvimento Web', 'Apoiar a equipe de front-end e back-end em tarefas de implementação, correção de bugs e testes. Excelente oportunidade para aprender HTML, CSS, JavaScript e conceitos de APIs.', 'São Paulo (presencial) — possibilidade híbrida 2x/semana.', 1600.00, '2025-10-21 16:22:55'),
(9, 2, 'Estagiário(a) de Análise de Dados', 'Coletar, limpar e analisar dados; preparar dashboards básicos e relatórios para tomadas de decisão. Desejável conhecimento em Excel e noções de SQL ou Python.', 'Belo Horizonte (presencial) ou remoto.', 1400.00, '2025-10-21 16:23:39'),
(10, 2, 'Estagiário(a) de Marketing Digital', 'Auxiliar em planejamento de conteúdo, gestão de redes sociais, análise de métricas e campanhas pagas. Ideal para quem domina ferramentas de social media e tem boa escrita.', 'Rio de Janeiro (híbrido)', 1200.00, '2025-10-21 16:24:10'),
(11, 2, 'Estagiário(a) de UX/UI Design', 'Apoiar na criação de wireframes, protótipos e testes de usabilidade; colaborar com desenvolvedores para implementação. Conhecimento básico de Figma ou Adobe XD é um plus.', 'Florianópolis (presencial).', 1500.00, '2025-10-21 16:24:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `curriculos`
--
ALTER TABLE `curriculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudante_id` (`estudante_id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `empresa_id` (`empresa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `curriculos`
--
ALTER TABLE `curriculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vagas`
--
ALTER TABLE `vagas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `curriculos`
--
ALTER TABLE `curriculos`
  ADD CONSTRAINT `curriculos_ibfk_1` FOREIGN KEY (`estudante_id`) REFERENCES `usuarios` (`id`);

--
-- Constraints for table `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `vagas_ibfk_1` FOREIGN KEY (`empresa_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
