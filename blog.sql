-- phpMyAdmin SQL Dump
-- version 2.11.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2016 at 06:33 PM
-- Server version: 5.1.57
-- PHP Version: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `a4322667_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `sid` varchar(255) NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateurs`
--

INSERT INTO `utilisateurs` VALUES(0, 'test@test.fr', 'e10adc3949ba59abbe56e057f20f883e', '8a4cbe7a75c68c3f29f4acdabec2f102', 'DOE', 'John');
INSERT INTO `utilisateurs` VALUES(0, 'fiquet.samuel@outlook.fr', '4bb1b6d1cff7c16e7328c1c6abc6a954', '12c437336dd1a6e3b67cc57387fdd645', 'FIQUET', 'Samuel');
