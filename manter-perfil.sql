-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 09-Ago-2024 às 11:52
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `manter-perfil`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `recuperar_senha`
--

DROP TABLE IF EXISTS `recuperar_senha`;
CREATE TABLE IF NOT EXISTS `recuperar_senha` (
  `email` varchar(255) NOT NULL,
  `data_criacao` datetime NOT NULL,
  `token` char(100) NOT NULL,
  `usado` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `recuperar_senha`
--

INSERT INTO `recuperar_senha` (`email`, `data_criacao`, `token`, `usado`) VALUES
('dienefer.2022311842@aluno.iffar.edu.br', '2024-07-29 16:34:50', 'f7af9933694f29d7195f362be3375b80beec8b28172a4d95398cdf55bf92a244443d9aba3b343fae8687f4bd3c943bbd4022', 0),
('dienefer.2022311842@aluno.iffar.edu.br', '2024-07-29 16:37:25', '223d05de0e44a039748d3c9fda02d37f00e1298bf641d91e08de3be339f097abaa9477ff02972ec81e0edc7f511da95591ae', 0),
('dienefer.2022311842@aluno.iffar.edu.br', '2024-07-29 16:38:09', '497b3fa987bd944ac9746772894cd4b232e017d278551cf4d4f9dd40e10f971e35408a0adb2652567c7e8b4db98f4dfa067d', 1),
('dienefer.2022311842@aluno.iffar.edu.br', '2024-08-09 08:44:30', 'f740ea9eac6e139a739f40527f9a232c981d93e7bc89b42f80945abdf2a7c1b078a9b512e3b2f2a6582cfb4d2decb52f552c', 0),
('dienefer.2022311842@aluno.iffar.edu.br', '2024-08-09 08:46:03', 'adabcc6655e66498513a9fb3421d610a5dd3e047da0d1a6508a2f6dc2b171b6dbfa7c39eff6f8990ef0d51c2e3a1abc0fd61', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` int NOT NULL,
  `foto` varchar(500) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `foto`) VALUES
(2, 'Maite', 'dienefer.2022311842@aluno.iffar.edu.br', 2307, '66b5ff252be04.png'),
(6, 'Maria ', 'maria@gmail.com', 2626, '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
