-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 14 avr. 2025 à 16:31
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `origin`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id_commentaire` int(11) NOT NULL,
  `contenu` varchar(250) NOT NULL,
  `date_commentaire` timestamp NULL DEFAULT current_timestamp(),
  `id_postulation` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commentaire`
--

INSERT INTO `commentaire` (`id_commentaire`, `contenu`, `date_commentaire`, `id_postulation`, `id_membre`) VALUES
(22, 'Aliquam erat volutpat, pellentesque in nulla in nisi dictum interdum, phasellus ac ultricies ex, vel scelerisque tae com', '2025-04-14 09:06:21', 9, 16),
(23, 'Aliquam erat volutpat, pellentesque in nulla in nisi dictum interdum, llor com', '2025-04-14 09:06:36', 8, 5),
(24, 'Aliquam erat volutpat, supertoto com', '2025-04-14 09:06:50', 7, 11),
(25, 'Aliquam erat volutpat, pellentesque in nulla in nisi dictum interdum, phasellus ac thierry com', '2025-04-14 09:39:07', 7, 13);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `email`, `mot_de_passe`, `role`) VALUES
(1, 'test', 'origin@test.com', '$2y$10$hmj0LZNB7zwavgdTTZw.au.hmuQavXaf8msv/L8hAXXj0mbNzMygW', 'membre'),
(5, 'Llorwina', 'llorwina@gmail.com', '2yuDAAwrXQQEw', 'Titan'),
(11, 'SuperToto', 'toto@toto.com', '$2y$10$N9T3ZOZ.lYqX3XBHmaUg7uHE2ishqH.szfDtO0OIsum.65LBEkH5e', 'Titan'),
(13, 'Thierry', 'thierry.bouedo@free.bzh', '$2y$10$PuKZ.uDS4zqDPrVLR22PS.p2feu1Jg6PmUhSySMHBxb.qceUwPxui', 'Titan'),
(15, 'Kiri', 'kiri@origin.com', 'kiri1234', 'Titan'),
(16, 'Tærys', 'tae@origin.com', 'taerys1234', 'Titan');

-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE `personnage` (
  `pseudo_personnage` varchar(50) NOT NULL,
  `royaume` varchar(50) NOT NULL,
  `id_membre` int(11) NOT NULL,
  `id_personnage` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `personnage`
--

INSERT INTO `personnage` (`pseudo_personnage`, `royaume`, `id_membre`, `id_personnage`) VALUES
('eniira', 'Sargeras', 1, 1),
('Jondar', 'Sargeras', 1, 2),
('Llorwina', 'Sargeras', 5, 4),
('toto', 'totoland', 11, 14),
('krukarn', 'sargeras', 1, 15);

-- --------------------------------------------------------

--
-- Structure de la table `postulation`
--

CREATE TABLE `postulation` (
  `id_postulation` int(11) NOT NULL,
  `contenu` varchar(1500) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `date_de_soumission` timestamp NULL DEFAULT current_timestamp(),
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `postulation`
--

INSERT INTO `postulation` (`id_postulation`, `contenu`, `statut`, `date_de_soumission`, `id_membre`) VALUES
(7, 'Toujours une nouvelle postulation Logs : https://www.warcraftlogs.com/character/id/40314961', 'En cours', '2025-04-11 12:41:46', 1),
(8, 'une postulation pour kiri', 'En cours', '2025-04-14 07:10:24', 15),
(9, 'une postulation pour tae', 'Validée', '2025-04-14 07:10:42', 16);

-- --------------------------------------------------------

--
-- Structure de la table `vote`
--

CREATE TABLE `vote` (
  `id_vote` int(11) NOT NULL,
  `choix` tinyint(1) DEFAULT NULL,
  `date_de_vote` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_postulation` int(11) NOT NULL,
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id_commentaire`),
  ADD KEY `id_postulation` (`id_postulation`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`id_membre`),
  ADD UNIQUE KEY `pseudo` (`pseudo`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD PRIMARY KEY (`id_personnage`),
  ADD UNIQUE KEY `pseudo_personnage` (`pseudo_personnage`,`id_membre`),
  ADD KEY `id_membre` (`id_membre`);

--
-- Index pour la table `postulation`
--
ALTER TABLE `postulation`
  ADD PRIMARY KEY (`id_postulation`),
  ADD UNIQUE KEY `id_membre` (`id_membre`);

--
-- Index pour la table `vote`
--
ALTER TABLE `vote`
  ADD PRIMARY KEY (`id_vote`),
  ADD UNIQUE KEY `id_membre` (`id_membre`,`id_postulation`),
  ADD KEY `id_postulation` (`id_postulation`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `id_personnage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `postulation`
--
ALTER TABLE `postulation`
  MODIFY `id_postulation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`id_postulation`) REFERENCES `postulation` (`id_postulation`) ON DELETE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE;

--
-- Contraintes pour la table `personnage`
--
ALTER TABLE `personnage`
  ADD CONSTRAINT `personnage_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE;

--
-- Contraintes pour la table `postulation`
--
ALTER TABLE `postulation`
  ADD CONSTRAINT `postulation_ibfk_1` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE;

--
-- Contraintes pour la table `vote`
--
ALTER TABLE `vote`
  ADD CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`id_postulation`) REFERENCES `postulation` (`id_postulation`) ON DELETE CASCADE,
  ADD CONSTRAINT `vote_ibfk_2` FOREIGN KEY (`id_membre`) REFERENCES `membre` (`id_membre`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
