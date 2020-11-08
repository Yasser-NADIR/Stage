-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 08 nov. 2020 à 23:40
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stage`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_biblio_binaire`
--

CREATE TABLE `t_biblio_binaire` (
  `id_biblio` int(5) NOT NULL,
  `biblio_contenu` binary(20) NOT NULL,
  `biblio_nom` varchar(20) NOT NULL,
  `biblio_extention` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_biblio_binaire`
--

INSERT INTO `t_biblio_binaire` (`id_biblio`, `biblio_contenu`, `biblio_nom`, `biblio_extention`) VALUES
(30, 0x5265736f75726365206964202337000000000000, 'ASIO4ALL v2 Instruct', 'pdf'),
(31, 0x5265736f75726365206964202337000000000000, 'ASIO4ALL v2 Instruct', 'pdf');

-- --------------------------------------------------------

--
-- Structure de la table `t_candidat`
--

CREATE TABLE `t_candidat` (
  `id_candidat` int(5) NOT NULL,
  `nom_candidat` varchar(15) NOT NULL,
  `prenom_candidat` varchar(15) NOT NULL,
  `mail_candidat` varchar(100) NOT NULL,
  `tel_candidat` varchar(15) NOT NULL,
  `CIN_candidat` varchar(10) NOT NULL,
  `code_massar` varchar(10) NOT NULL,
  `id_etablissement` int(5) NOT NULL,
  `id_diplomt` int(5) NOT NULL,
  `note_s1` float NOT NULL,
  `note_s2` float NOT NULL,
  `note_s3` float NOT NULL,
  `note_s4` float NOT NULL,
  `releve_note` int(5) NOT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_candidat`
--

INSERT INTO `t_candidat` (`id_candidat`, `nom_candidat`, `prenom_candidat`, `mail_candidat`, `tel_candidat`, `CIN_candidat`, `code_massar`, `id_etablissement`, `id_diplomt`, `note_s1`, `note_s2`, `note_s3`, `note_s4`, `releve_note`, `id_login`) VALUES
(19, 'yasser', 'nadir', 'yassernadir333@', '+212123456789', 'BB123123', 'R123123123', 1, 2, 12, 12.3, 12.3, 12.3, 30, 20),
(20, 'NADR', 'Zainab', 'nadirzainab93@g', '0622691715', 'BB105205', 'R134825357', 2, 2, 12, 12.3, 12.3, 12.3, 31, 21);

-- --------------------------------------------------------

--
-- Structure de la table `t_concours`
--

CREATE TABLE `t_concours` (
  `id_concours` int(5) NOT NULL,
  `titre_concour` varchar(10) NOT NULL,
  `concours_designation` varchar(4000) NOT NULL,
  `seuil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_concours`
--

INSERT INTO `t_concours` (`id_concours`, `titre_concour`, `concours_designation`, `seuil`) VALUES
(1, 'GLSID', 'Genie Logiciel ', 13),
(2, 'BDCC', 'Big Data Could ', 13);

-- --------------------------------------------------------

--
-- Structure de la table `t_diplomt`
--

CREATE TABLE `t_diplomt` (
  `id_diplomt` int(5) NOT NULL,
  `designation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_diplomt`
--

INSERT INTO `t_diplomt` (`id_diplomt`, `designation`) VALUES
(1, 'DEUST'),
(2, 'DEUG');

-- --------------------------------------------------------

--
-- Structure de la table `t_etablissement`
--

CREATE TABLE `t_etablissement` (
  `id_etablissement` int(5) NOT NULL,
  `designation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_etablissement`
--

INSERT INTO `t_etablissement` (`id_etablissement`, `designation`) VALUES
(1, 'ENSET'),
(2, 'FST');

-- --------------------------------------------------------

--
-- Structure de la table `t_liste_attente`
--

CREATE TABLE `t_liste_attente` (
  `id_candidat` int(5) NOT NULL,
  `id_concours` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_liste_concour`
--

CREATE TABLE `t_liste_concour` (
  `id` int(11) NOT NULL,
  `id_concour` int(11) NOT NULL,
  `id_condidat` int(11) NOT NULL,
  `date_concour` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `t_liste_principale`
--

CREATE TABLE `t_liste_principale` (
  `id_candidat` int(5) NOT NULL,
  `id_concours` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_login`
--

CREATE TABLE `t_login` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `confirmation_token` varchar(60) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_login`
--

INSERT INTO `t_login` (`id`, `pseudo`, `password`, `role`, `confirmation_token`, `confirmed_at`) VALUES
(20, 'qrarzaer', '$2y$10$7.lArWQKXQu0LTUv5JKoguPJqnuuFnfFGjM0xG1HknJqTww724eYe', 1, 'ixWSRewHeoUQpH4HaVOTiSEgaqD3gVMNdKhB0xZ1PDdUW6AEIfkZFRIWdjpZ', NULL),
(21, 'zainab', '$2y$10$G8gE4qGUwKNM1VjxmWUfKe9VFL.STbfEbjB9v2FGKDeisGq9PHrSy', 1, '9q1ptOLuX6SFgKgTi6MzwPaxyEVse0WQQL0TL6zqfvFjTdGsaFYqgMVxenW7', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_responsable`
--

CREATE TABLE `t_responsable` (
  `id_responsable` int(5) NOT NULL,
  `responsable_nom` varchar(15) NOT NULL,
  `responsable_prenom` varchar(15) NOT NULL,
  `responsable_mail` varchar(15) NOT NULL,
  `responsable_tel` varchar(15) NOT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_biblio_binaire`
--
ALTER TABLE `t_biblio_binaire`
  ADD PRIMARY KEY (`id_biblio`);

--
-- Index pour la table `t_candidat`
--
ALTER TABLE `t_candidat`
  ADD PRIMARY KEY (`id_candidat`),
  ADD KEY `id_diplomt` (`id_diplomt`),
  ADD KEY `id_etablissement` (`id_etablissement`),
  ADD KEY `releve_note` (`releve_note`),
  ADD KEY `id_login` (`id_login`),
  ADD KEY `id_login_2` (`id_login`);

--
-- Index pour la table `t_concours`
--
ALTER TABLE `t_concours`
  ADD PRIMARY KEY (`id_concours`);

--
-- Index pour la table `t_diplomt`
--
ALTER TABLE `t_diplomt`
  ADD PRIMARY KEY (`id_diplomt`);

--
-- Index pour la table `t_etablissement`
--
ALTER TABLE `t_etablissement`
  ADD PRIMARY KEY (`id_etablissement`);

--
-- Index pour la table `t_liste_attente`
--
ALTER TABLE `t_liste_attente`
  ADD KEY `id_candidat` (`id_candidat`),
  ADD KEY `id_concours` (`id_concours`);

--
-- Index pour la table `t_liste_concour`
--
ALTER TABLE `t_liste_concour`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_liste_principale`
--
ALTER TABLE `t_liste_principale`
  ADD KEY `id_candidat` (`id_candidat`),
  ADD KEY `id_concours` (`id_concours`);

--
-- Index pour la table `t_login`
--
ALTER TABLE `t_login`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `t_responsable`
--
ALTER TABLE `t_responsable`
  ADD PRIMARY KEY (`id_responsable`),
  ADD KEY `id_login` (`id_login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_biblio_binaire`
--
ALTER TABLE `t_biblio_binaire`
  MODIFY `id_biblio` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `t_candidat`
--
ALTER TABLE `t_candidat`
  MODIFY `id_candidat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `t_concours`
--
ALTER TABLE `t_concours`
  MODIFY `id_concours` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_diplomt`
--
ALTER TABLE `t_diplomt`
  MODIFY `id_diplomt` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_etablissement`
--
ALTER TABLE `t_etablissement`
  MODIFY `id_etablissement` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `t_liste_concour`
--
ALTER TABLE `t_liste_concour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_login`
--
ALTER TABLE `t_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `t_responsable`
--
ALTER TABLE `t_responsable`
  MODIFY `id_responsable` int(5) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_candidat`
--
ALTER TABLE `t_candidat`
  ADD CONSTRAINT `t_candidat_ibfk_1` FOREIGN KEY (`id_diplomt`) REFERENCES `t_diplomt` (`id_diplomt`),
  ADD CONSTRAINT `t_candidat_ibfk_2` FOREIGN KEY (`id_etablissement`) REFERENCES `t_etablissement` (`id_etablissement`),
  ADD CONSTRAINT `t_candidat_ibfk_3` FOREIGN KEY (`releve_note`) REFERENCES `t_biblio_binaire` (`id_biblio`),
  ADD CONSTRAINT `t_candidat_ibfk_4` FOREIGN KEY (`id_login`) REFERENCES `t_login` (`id`);

--
-- Contraintes pour la table `t_liste_attente`
--
ALTER TABLE `t_liste_attente`
  ADD CONSTRAINT `t_liste_attente_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `t_candidat` (`id_candidat`),
  ADD CONSTRAINT `t_liste_attente_ibfk_2` FOREIGN KEY (`id_concours`) REFERENCES `t_concours` (`id_concours`);

--
-- Contraintes pour la table `t_liste_principale`
--
ALTER TABLE `t_liste_principale`
  ADD CONSTRAINT `t_liste_principale_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `t_candidat` (`id_candidat`),
  ADD CONSTRAINT `t_liste_principale_ibfk_2` FOREIGN KEY (`id_concours`) REFERENCES `t_concours` (`id_concours`);

--
-- Contraintes pour la table `t_responsable`
--
ALTER TABLE `t_responsable`
  ADD CONSTRAINT `t_responsable_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
