-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 26 déc. 2020 à 15:09
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
(32, 0x5265736f75726365206964202337000000000000, 'dark-cosmic-jhin', 'jpg'),
(33, 0x5265736f75726365206964202337000000000000, 'dark-cosmic-jhin', 'jpg'),
(34, 0x5265736f75726365206964202337000000000000, 'dark-cosmic-jhin', 'jpg');

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
(3, 'NADIR', 'Zainab', 'yassernadir333@gmail.com', '0622691715', 'BB123123', 'R123123123', 1, 1, 12, 12.3, 12.3, 12.3, 32, 22),
(4, 'NADIR', 'yasser', 'yassernadir761@gmail.com', '0622691715', 'BB105205', 'R012398745', 2, 2, 14, 14, 14, 14, 33, 23),
(5, 'Kaci', 'Oussama', 'yasser@dude.com', '0610065615', 'BB1231234', 'K765678789', 1, 2, 19, 12.3, 13, 9, 34, 25);

-- --------------------------------------------------------

--
-- Structure de la table `t_concours`
--

CREATE TABLE `t_concours` (
  `id_concours` int(5) NOT NULL,
  `titre_concour` varchar(10) NOT NULL,
  `concours_designation` varchar(400) CHARACTER SET latin7 NOT NULL,
  `lien_module` varchar(255) DEFAULT NULL,
  `seuil` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_concours`
--

INSERT INTO `t_concours` (`id_concours`, `titre_concour`, `concours_designation`, `lien_module`, `seuil`) VALUES
(1, 'GLSID', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam nisi tincidunt dui placerat, quis bibendum dolor aliquet.', 'https://www.enset-media.ac.ma/formations/initiales/17776/modules', 13),
(2, 'IIBCCC', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam nisi tincidunt dui placerat, quis bibendum dolor aliquet.', 'https://www.enset-media.ac.ma/formations/initiales/19559/modules', 13),
(3, 'SEER', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam nisi tincidunt dui placerat, quis bibendum dolor aliquet.', 'https://www.enset-media.ac.ma/formations/initiales/17973/modules', 13),
(4, 'GECSI', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam nisi tincidunt dui placerat, quis bibendum dolor aliquet.', 'https://www.enset-media.ac.ma/formations/initiales/19294/modules', 13),
(5, 'GMSI', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam nisi tincidunt dui placerat, quis bibendum dolor aliquet.', 'https://www.enset-media.ac.ma/formations/initiales/19560/modules', 13),
(6, 'GIL', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam nisi tincidunt dui placerat, quis bibendum dolor aliquet.', 'https://www.enset-media.ac.ma/formations/initiales/17659/modules', 13);

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
-- Structure de la table `t_liste_candidat_concour`
--

CREATE TABLE `t_liste_candidat_concour` (
  `id` int(6) NOT NULL,
  `id_concour` int(6) NOT NULL,
  `id_condidat` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_liste_candidat_concour`
--

INSERT INTO `t_liste_candidat_concour` (`id`, `id_concour`, `id_condidat`) VALUES
(8, 1, 4),
(9, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_liste_concour`
--

CREATE TABLE `t_liste_concour` (
  `id` int(11) NOT NULL,
  `id_concour` int(11) NOT NULL,
  `id_condidat` int(11) NOT NULL,
  `date_concour` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_liste_concour`
--

INSERT INTO `t_liste_concour` (`id`, `id_concour`, `id_condidat`, `date_concour`) VALUES
(14, 2, 4, NULL),
(15, 1, 4, NULL),
(16, 1, 3, NULL),
(17, 2, 3, NULL),
(18, 1, 5, NULL),
(19, 3, 3, NULL);

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
(22, 'zainab', '$2y$10$we/th5iaFbezVelChdL.O.x/KK7bA2JRk/h6FDGhv5PoJawkjGCtq', 1, 'lcX06zl8HYJupdoDXxNBnRxR6cT1gG9MiK6THwMpN1jeRR2B95lvIJm4yyhU', NULL),
(23, 'yasser', '$2y$10$qfxXPYGx6sTGFcFLSJFOeufMBG7nRzr2rq.7SxPm0vL2OlWzrym6.', 1, '3ujgtevkj74LKOiiAKLSDpSrqYf5t5LNnkLBriUSgTblHrm5aB8JafdYqUQA', NULL),
(24, 'tata', '$2y$10$hrf07bnnkkN7rr4MeJBv.OyucFPvYScP85ObEgzTebpWzcAw9nemC', 2, NULL, NULL),
(25, 'oussama', '$2y$10$03/FrPbhGPeLCdcMCqFl/..2YhUlnnBM19/YTPqQAgL5ok7fvlzIm', 1, 'hHaw0q5S2ySRa4uVkqrSQKA9mosE6RLXHyigX53pqezD6EYxgv2vaVrjwGKS', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_nbr_principale_attente`
--

CREATE TABLE `t_nbr_principale_attente` (
  `id` int(1) NOT NULL,
  `nbrListePrincipale` int(3) NOT NULL,
  `nbrListeAttente` int(3) NOT NULL,
  `id_concour` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_nbr_principale_attente`
--

INSERT INTO `t_nbr_principale_attente` (`id`, `nbrListePrincipale`, `nbrListeAttente`, `id_concour`) VALUES
(5, 2, 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_note_concour`
--

CREATE TABLE `t_note_concour` (
  `id_note` int(6) NOT NULL,
  `id_candidat` int(6) NOT NULL,
  `note` float NOT NULL,
  `id_concour` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_note_concour`
--

INSERT INTO `t_note_concour` (`id_note`, `id_candidat`, `note`, `id_concour`) VALUES
(13, 3, 0, 1),
(14, 4, 12.4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_responsable`
--

CREATE TABLE `t_responsable` (
  `id_responsable` int(5) NOT NULL,
  `responsable_nom` varchar(15) NOT NULL,
  `responsable_prenom` varchar(15) NOT NULL,
  `responsable_mail` varchar(30) NOT NULL,
  `responsable_tel` varchar(15) NOT NULL,
  `id_login` int(11) NOT NULL,
  `id_concour` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `t_responsable`
--

INSERT INTO `t_responsable` (`id_responsable`, `responsable_nom`, `responsable_prenom`, `responsable_mail`, `responsable_tel`, `id_login`, `id_concour`) VALUES
(2, 'NADIR', 'Yasser', 'yassernadir761@gmail.com', '0610065615', 24, 1);

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
-- Index pour la table `t_liste_candidat_concour`
--
ALTER TABLE `t_liste_candidat_concour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_concour` (`id_concour`),
  ADD KEY `id_condidat` (`id_condidat`);

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
-- Index pour la table `t_nbr_principale_attente`
--
ALTER TABLE `t_nbr_principale_attente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `t_nbr_principale_attente_ibfk_1` (`id_concour`);

--
-- Index pour la table `t_note_concour`
--
ALTER TABLE `t_note_concour`
  ADD PRIMARY KEY (`id_note`),
  ADD KEY `id_candidat` (`id_candidat`),
  ADD KEY `id_concour` (`id_concour`);

--
-- Index pour la table `t_responsable`
--
ALTER TABLE `t_responsable`
  ADD PRIMARY KEY (`id_responsable`),
  ADD KEY `id_login` (`id_login`),
  ADD KEY `t_responsable_ibfk_2` (`id_concour`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_biblio_binaire`
--
ALTER TABLE `t_biblio_binaire`
  MODIFY `id_biblio` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `t_candidat`
--
ALTER TABLE `t_candidat`
  MODIFY `id_candidat` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_concours`
--
ALTER TABLE `t_concours`
  MODIFY `id_concours` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- AUTO_INCREMENT pour la table `t_liste_candidat_concour`
--
ALTER TABLE `t_liste_candidat_concour`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `t_liste_concour`
--
ALTER TABLE `t_liste_concour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `t_login`
--
ALTER TABLE `t_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `t_nbr_principale_attente`
--
ALTER TABLE `t_nbr_principale_attente`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `t_note_concour`
--
ALTER TABLE `t_note_concour`
  MODIFY `id_note` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `t_responsable`
--
ALTER TABLE `t_responsable`
  MODIFY `id_responsable` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- Contraintes pour la table `t_liste_candidat_concour`
--
ALTER TABLE `t_liste_candidat_concour`
  ADD CONSTRAINT `t_liste_candidat_concour_ibfk_1` FOREIGN KEY (`id_concour`) REFERENCES `t_concours` (`id_concours`),
  ADD CONSTRAINT `t_liste_candidat_concour_ibfk_2` FOREIGN KEY (`id_condidat`) REFERENCES `t_candidat` (`id_candidat`);

--
-- Contraintes pour la table `t_liste_principale`
--
ALTER TABLE `t_liste_principale`
  ADD CONSTRAINT `t_liste_principale_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `t_candidat` (`id_candidat`),
  ADD CONSTRAINT `t_liste_principale_ibfk_2` FOREIGN KEY (`id_concours`) REFERENCES `t_concours` (`id_concours`);

--
-- Contraintes pour la table `t_nbr_principale_attente`
--
ALTER TABLE `t_nbr_principale_attente`
  ADD CONSTRAINT `t_nbr_principale_attente_ibfk_1` FOREIGN KEY (`id_concour`) REFERENCES `t_concours` (`id_concours`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_note_concour`
--
ALTER TABLE `t_note_concour`
  ADD CONSTRAINT `t_note_concour_ibfk_1` FOREIGN KEY (`id_candidat`) REFERENCES `t_candidat` (`id_candidat`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `t_note_concour_ibfk_2` FOREIGN KEY (`id_concour`) REFERENCES `t_concours` (`id_concours`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `t_responsable`
--
ALTER TABLE `t_responsable`
  ADD CONSTRAINT `t_responsable_ibfk_1` FOREIGN KEY (`id_login`) REFERENCES `t_login` (`id`),
  ADD CONSTRAINT `t_responsable_ibfk_2` FOREIGN KEY (`id_concour`) REFERENCES `t_concours` (`id_concours`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
