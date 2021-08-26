-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Jun-2021 às 18:02
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdbiblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `ebooks`
--

DROP TABLE IF EXISTS `ebooks`;
CREATE TABLE IF NOT EXISTS `ebooks` (
  `ID_ebook` int(11) NOT NULL AUTO_INCREMENT,
  `nome_ebook` text NOT NULL,
  `autor_ebook` text NOT NULL,
  `arquivo_ebook` varchar(50) NOT NULL,
  `data_ebook` datetime NOT NULL,
  PRIMARY KEY (`ID_ebook`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `ebooks`
--

INSERT INTO `ebooks` (`ID_ebook`, `nome_ebook`, `autor_ebook`, `arquivo_ebook`, `data_ebook`) VALUES
(3, 'A Filosofia CrÃ­tica de Kant', 'Gilles Deleuze', 'ad960fe71347c20278c16d80c19dc06c.pdf', '2021-04-10 11:25:40'),
(4, 'As Eras do Cinema ', 'Jacques RanciÃ¨re', '5a7522d4bdc0a99637c5afe6854af2f0.pdf', '2021-04-10 11:28:01'),
(5, 'A Escola dos Annales', 'Peter Burke ', '12d846049125592863e4e69813d93465.pdf', '2021-04-10 11:34:08'),
(6, 'Os Anos Dourados - MemÃ³ria e Hegemonia', 'HeloÃ­sa Cardoso', '873f81512271722d9dc446e61c549678.pdf', '2021-04-10 11:34:56'),
(9, 'Poemas Ocultistas', 'Fernando Pessoa', '58390812b73f0e5285f61ec6c022ed59.pdf', '2021-05-17 16:01:29'),
(10, 'Cem Anos de SolidÃ£o', 'Gabriel GarcÃ­a MÃ¡rquez', '538e3feb59eaab20a23ae420823a0246.pdf', '2021-06-02 10:24:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

DROP TABLE IF EXISTS `emprestimos`;
CREATE TABLE IF NOT EXISTS `emprestimos` (
  `ID_emp` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  `ID_liv` int(11) NOT NULL,
  `tombo_emp` date NOT NULL,
  `devolucao_emp` date NOT NULL,
  `renovacao_emp` date DEFAULT NULL,
  `data_emp` datetime NOT NULL,
  PRIMARY KEY (`ID_emp`),
  KEY `ID_user` (`ID_user`),
  KEY `ID_liv` (`ID_liv`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`ID_emp`, `ID_user`, `ID_liv`, `tombo_emp`, `devolucao_emp`, `renovacao_emp`, `data_emp`) VALUES
(13, 3, 2, '2021-03-08', '2021-04-27', '2021-05-18', '2021-04-27 11:41:46'),
(15, 1, 12, '2021-04-29', '2021-06-24', '2021-07-15', '2021-04-29 09:52:21'),
(17, 2, 11, '2021-04-29', '2021-05-07', '2021-05-14', '2021-04-29 11:49:14'),
(18, 5, 4, '2021-04-29', '2021-05-07', NULL, '2021-04-29 11:50:54'),
(20, 5, 7, '2021-04-29', '2021-05-08', NULL, '2021-04-29 12:54:30'),
(21, 4, 6, '2021-04-29', '2021-06-16', '2021-07-07', '2021-04-29 12:55:50'),
(22, 1, 5, '2021-04-30', '2021-05-15', NULL, '2021-04-30 10:09:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

DROP TABLE IF EXISTS `historico`;
CREATE TABLE IF NOT EXISTS `historico` (
  `ID_his` int(11) NOT NULL AUTO_INCREMENT,
  `ID_user` int(11) NOT NULL,
  `ID_liv` int(11) NOT NULL,
  `retorno_his` date NOT NULL,
  `data_his` datetime NOT NULL,
  PRIMARY KEY (`ID_his`),
  KEY `ID_user` (`ID_user`),
  KEY `ID_liv` (`ID_liv`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `historico`
--

INSERT INTO `historico` (`ID_his`, `ID_user`, `ID_liv`, `retorno_his`, `data_his`) VALUES
(1, 1, 3, '2021-04-29', '2021-04-29 10:11:42'),
(2, 4, 1, '2021-04-29', '2021-04-29 13:04:54'),
(5, 5, 2, '2021-04-30', '2021-04-30 10:00:15'),
(6, 2, 13, '2021-04-30', '2021-04-30 10:02:22'),
(7, 2, 14, '2021-05-17', '2021-05-17 16:06:31'),
(8, 12, 8, '2021-05-02', '2021-06-02 10:10:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

DROP TABLE IF EXISTS `livros`;
CREATE TABLE IF NOT EXISTS `livros` (
  `ID_liv` int(11) NOT NULL AUTO_INCREMENT,
  `nome_liv` text NOT NULL,
  `autor_liv` text NOT NULL,
  `quantidade_liv` varchar(100) NOT NULL,
  `topicos_liv` text NOT NULL,
  `data_liv` datetime NOT NULL,
  PRIMARY KEY (`ID_liv`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`ID_liv`, `nome_liv`, `autor_liv`, `quantidade_liv`, `topicos_liv`, `data_liv`) VALUES
(1, 'Helena', 'Machado de Assis', '2', 'Literatura Brasileira', '2021-03-19 12:16:58'),
(2, 'Dom Casmurro', 'Machado de Assis', '5', 'Literatura Brasileira', '2021-03-19 12:22:19'),
(3, 'Manifesto do Partido Comunista', 'Karl Marx', '1', 'Comunismo', '2021-03-19 12:24:22'),
(4, 'Cem anos de solidÃ£o', 'Gabriel Garcia MÃ¡rquez', '2', 'FicÃ§Ã£o', '2021-03-19 12:50:48'),
(5, 'MemÃ³rias do Subsolo', 'FiodÃ³r DostoiÃ©vski', '1', 'Niilismo', '2021-03-19 13:28:19'),
(6, 'Trip', 'Tao Lin', '6', 'PsicodÃ©licos', '2021-03-19 14:08:32'),
(7, 'Ãgua-Viva', 'Clarice Lispector', '5', 'Literatura Brasileira', '2021-03-19 16:05:44'),
(8, 'As veias abertas da AmÃ©rica Latina', 'Eduardo Galeano', '2', 'AmÃ©rica Latina', '2021-03-19 16:08:45'),
(11, 'Futebol ao sol e a sombra', 'Eduardo Galeano', '1', 'Futebol', '2021-03-19 19:37:14'),
(12, 'Dias e Noites de Amor e de Guerra', 'Eduardo Galeano', '1', 'Ditadura militar, Poesia', '2021-03-25 14:36:02'),
(13, 'Cartas a um Jovem Poeta', 'Maria Rilke', '4', 'Romance', '2021-03-25 14:57:34'),
(14, 'O IrmÃ£o AlemÃ£o', 'Chico Buarque', '1', 'Literatura Brasileira', '2021-05-17 16:04:26'),
(15, 'Os Sofrimentos do Jovem Welther', 'Johann Wolfgang Goethe', '1', 'Romance', '2021-05-24 16:59:17'),
(16, 'A Metamorfose', 'Franz Kafka', '1', 'Novela', '2021-06-02 10:26:05');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reservas`
--

DROP TABLE IF EXISTS `reservas`;
CREATE TABLE IF NOT EXISTS `reservas` (
  `ID_res` int(11) NOT NULL AUTO_INCREMENT,
  `ID_liv` int(11) NOT NULL,
  `ID_user` int(11) NOT NULL,
  `data_res` datetime NOT NULL,
  PRIMARY KEY (`ID_res`),
  KEY `ID_liv` (`ID_liv`),
  KEY `ID_user` (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `reservas`
--

INSERT INTO `reservas` (`ID_res`, `ID_liv`, `ID_user`, `data_res`) VALUES
(1, 11, 5, '2021-05-01 10:41:47'),
(2, 2, 4, '2021-05-01 11:41:46'),
(4, 13, 4, '2021-05-01 11:42:31'),
(6, 4, 4, '2021-05-01 12:34:34'),
(7, 14, 1, '2021-05-17 16:04:38'),
(8, 7, 3, '2021-05-24 16:43:47'),
(9, 1, 3, '2021-05-24 16:44:35'),
(10, 5, 3, '2021-05-24 16:44:43'),
(11, 8, 12, '2021-06-02 10:02:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_user` int(11) NOT NULL AUTO_INCREMENT,
  `nome_user` text NOT NULL,
  `nascimento_user` date NOT NULL,
  `email_user` varchar(200) NOT NULL,
  `senha_user` varchar(255) NOT NULL,
  `nivel_user` int(2) NOT NULL,
  `data_user` datetime NOT NULL,
  PRIMARY KEY (`ID_user`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID_user`, `nome_user`, `nascimento_user`, `email_user`, `senha_user`, `nivel_user`, `data_user`) VALUES
(1, 'Anna Beatriz Pereira', '2004-01-20', 'annabeatriz@gmail.com', '$2y$10$8wwa9ATf5.0q0bUdgKnQlO68JIqE8zHcE08tUw/6QNBvMFf0Opx7S', 2, '2021-04-08 12:07:09'),
(2, 'Eduarda Novaes', '2002-03-05', 'eduarda@gmail.com', '$2y$10$92rUs99NZFy..SPiE7Mk7eDBbqX2e0UtX6oUgkd6yS1.03GKhyZIW', 1, '2021-04-08 12:08:58'),
(3, 'Felipe Garcia', '2003-12-18', 'felipe@gmail.com', '$2y$10$URk6XQif3WGqVKMYAVEYtes9GBxKG44L9vt9IBTYJJ3b3g/aJ.Vi.', 1, '2021-04-08 12:10:01'),
(4, 'Mariana Ferreira', '2000-07-07', 'annxgang777@gmail.com', '$2y$10$gQIC3xQ9uRvVNIF2fJkLnOSdWsonayxTY2.hNZ5zX8skBpH9s5nQ.', 1, '2021-04-22 11:28:34'),
(5, 'Guilherme Freitas', '1998-12-01', 'guilherme@gmail.com', '$2y$10$1IWAzx3g.v3HifutrP1Nkuze5myWJTBnVNxCvr7jW3OTrJuoL8Kay', 1, '2021-04-22 11:29:58'),
(6, 'Henrique Souza', '2001-08-14', 'henrique@gmail.com', '$2y$10$LEymhLE6kUsBXm.4IsRL/eMsTq9R/Xx.CEwQlcp0MPlsc58fCs1/e', 1, '2021-05-04 16:27:10'),
(7, 'Fernanda Buendia', '2003-11-04', 'fernanda@gmail.com', '$2y$10$WynaCloy8UtXMVYMnEXLeufGaCwW.fBFpmuzQl0iF2RErP00o0Fii', 1, '2021-05-04 17:27:14'),
(8, 'Heloisa Carvalho', '1999-02-08', 'heloisa@gmail.com', '$2y$10$yFD9DAY6Pe3BM2XgvO9gI.PvzEoX5qnV/5CRLO.QRlIoofIhwMt9y', 1, '2021-05-05 11:03:05'),
(9, 'Matheus Silva', '2001-07-06', 'matheus@gmail.com', '$2y$10$PuCYg367Q1yAUqhOlu2lzezWbRx3LG9V8VQjdk8LxPvQGmeoR3YOK', 1, '2021-05-07 09:41:18'),
(10, 'Gabriel Fernandes', '2002-04-30', 'gabriel@gmail.com', '$2y$10$5VVOZrknZ1DnOtOQU2YUd.my20I7J1nyfC6z1AlNuDrvL/KS4lJKm', 1, '2021-05-07 09:42:49'),
(11, 'Bianca Almeida', '1999-01-03', 'bianca@gmail.com', '$2y$10$3K9ZbAk3a0wmZ5l7.63AXeDTEICIIIP6gdKeQ9POxFnfy.Buaw.DG', 1, '2021-05-25 11:50:26'),
(12, 'Arthur Santos', '1999-06-04', 'arthursantos@gmail.com', '$2y$10$wKUZqG5M5OkgRePrNQPJ2OaMad9lwYlTzVhkEzuo64SeKEw9ZZsy2', 1, '2021-06-02 09:51:38');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `emprestimos_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `usuario` (`ID_user`),
  ADD CONSTRAINT `emprestimos_ibfk_2` FOREIGN KEY (`ID_liv`) REFERENCES `livros` (`ID_liv`);

--
-- Limitadores para a tabela `historico`
--
ALTER TABLE `historico`
  ADD CONSTRAINT `historico_ibfk_1` FOREIGN KEY (`ID_user`) REFERENCES `usuario` (`ID_user`),
  ADD CONSTRAINT `historico_ibfk_2` FOREIGN KEY (`ID_liv`) REFERENCES `livros` (`ID_liv`);

--
-- Limitadores para a tabela `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`ID_liv`) REFERENCES `livros` (`ID_liv`),
  ADD CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`ID_user`) REFERENCES `usuario` (`ID_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
