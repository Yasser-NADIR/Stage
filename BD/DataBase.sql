-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 23 oct. 2020 à 23:46
-- Version du serveur :  10.4.14-MariaDB
-- Version de PHP : 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `data_base`
--

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `login_usernam` varchar(255) NOT NULL,
  `login_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_biblio_binaire`
--

CREATE TABLE `t_biblio_binaire` (
  `id_biblio` int(5) NOT NULL,
  `biblio_contenu` varchar(20) NOT NULL,
  `biblio_nom` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_candidat`
--

CREATE TABLE `t_candidat` (
  `id_candidat` int(5) NOT NULL,
  `nom_candidat` varchar(15) NOT NULL,
  `prenom_candidat` varchar(15) NOT NULL,
  `mail_candidat` varchar(15) NOT NULL,
  `tel_candidat` varchar(15) NOT NULL,
  `CIN_candidat` varchar(10) NOT NULL,
  `code_massar` int(10) NOT NULL,
  `id_etablissement` int(5) NOT NULL,
  `id_diplomt` int(5) NOT NULL,
  `note_s1` float NOT NULL,
  `note_s2` float NOT NULL,
  `note_s3` float NOT NULL,
  `note_s4` float NOT NULL,
  `releve_note` int(5) NOT NULL,
  `id_login` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_concours`
--

CREATE TABLE `t_concours` (
  `id_concours` int(5) NOT NULL,
  `concours_designation` varchar(15) NOT NULL,
  `seuil_s1` float NOT NULL,
  `seuil_s2` float NOT NULL,
  `seuil_s3` float NOT NULL,
  `seuil_s4` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_diplomt`
--

CREATE TABLE `t_diplomt` (
  `id_diplomt` int(5) NOT NULL,
  `des` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `t_etablissement`
--

CREATE TABLE `t_etablissement` (
  `id_etablissement` int(5) NOT NULL,
  `designation` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Structure de la table `t_liste_principale`
--

CREATE TABLE `t_liste_principale` (
  `id_candidat` int(5) NOT NULL,
  `id_concours` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Index pour la table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

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
  ADD KEY `id_login` (`id_login`);

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
-- Index pour la table `t_liste_principale`
--
ALTER TABLE `t_liste_principale`
  ADD KEY `id_candidat` (`id_candidat`),
  ADD KEY `id_concours` (`id_concours`);

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
-- AUTO_INCREMENT pour la table `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_biblio_binaire`
--
ALTER TABLE `t_biblio_binaire`
  MODIFY `id_biblio` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_candidat`
--
ALTER TABLE `t_candidat`
  MODIFY `id_candidat` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_concours`
--
ALTER TABLE `t_concours`
  MODIFY `id_concours` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_diplomt`
--
ALTER TABLE `t_diplomt`
  MODIFY `id_diplomt` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `t_etablissement`
--
ALTER TABLE `t_etablissement`
  MODIFY `id_etablissement` int(5) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `t_candidat_ibfk_4` FOREIGN KEY (`id_login`) REFERENCES `login` (`id_login`);

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
