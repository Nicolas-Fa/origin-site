-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 19 avr. 2025 à 23:08
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
(36, 'Ok Simone !', '2025-04-16 07:15:04', 7, 1);

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `id_membre` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `email` varchar(120) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `role` enum('Membre','Titan','Moderateur','Admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `email`, `mot_de_passe`, `role`) VALUES
(1, 'test', 'origin@test.com', '$2y$10$hmj0LZNB7zwavgdTTZw.au.hmuQavXaf8msv/L8hAXXj0mbNzMygW', 'Membre'),
(5, 'Llorwina', 'llorwina@gmail.com', '2yuDAAwrXQQEw', 'Admin'),
(17, 'Uzui', 'uzui@origin.test', '$2y$10$AbGLqDIGIvUbuLUUYawK0Oj7yqo.RO2EBz98Sg62MJTsYgJvpmyOe', 'Membre'),
(18, 'Linoae', 'linoae@origin.com', '$2y$10$F7qZFVoNQvoPCLxPBSaAkutxOThjhPYuA0myvVFYeliVPODdwaT.G', 'Membre'),
(19, 'Tærys', 'taerys@origin.com', '$2y$10$bu0XBkX/h54mF1dv38iK6OpfvwrUtRFDEO1jv72srN/3uHkzYjM.G', 'Membre'),
(20, 'Hûntor', 'huntor@origin.com', '$2y$10$5isAmQ5tMmYYZVmPi4RmGuet857J8EZRmp3ZEyO3I.fRUa.DvO/ti', 'Membre'),
(21, 'Nhrotz', 'nhrotz@origin.com', '$2y$10$8oGNnTzzi6.RoOU.qc3p5e.sgc1a25fyWsSiftbSX/4pK2wZI.kMy', 'Membre');

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
('krukarn', 'Sargeras', 1, 2),
('Llorwina', 'Sargeras', 5, 4),
('aszhara', 'sargeras', 1, 15),
('bwonsamdi', 'sargeras', 1, 18),
('eniira', 'khaz-modan', 5, 19),
('uzudrood', 'sargeras', 17, 20),
('uzupal', 'sargeras', 17, 21),
('uzuwar', 'sargeras', 17, 23),
('uzuhunt', 'sargeras', 17, 24),
('linoae', 'sargeras', 18, 25),
('tærys', 'sargeras', 19, 26),
('taeylquaida', 'sargeras', 19, 27),
('hûntor', 'sargeras', 20, 28),
('warlocktor', 'sargeras', 20, 29),
('nhrotz', 'sargeras', 21, 30),
('nhrotza', 'sargeras', 21, 31);

-- --------------------------------------------------------

--
-- Structure de la table `postulation`
--

CREATE TABLE `postulation` (
  `id_postulation` int(11) NOT NULL,
  `contenu` varchar(1500) NOT NULL,
  `statut` enum('En cours','Validee','Refusee','') NOT NULL,
  `date_de_soumission` timestamp NULL DEFAULT current_timestamp(),
  `id_membre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `postulation`
--

INSERT INTO `postulation` (`id_postulation`, `contenu`, `statut`, `date_de_soumission`, `id_membre`) VALUES
(7, 'Toujours une nouvelle postulation Logs : https://www.warcraftlogs.com/character/id/40314961', 'En cours', '2025-04-11 12:41:46', 1);

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
-- Déchargement des données de la table `vote`
--

INSERT INTO `vote` (`id_vote`, `choix`, `date_de_vote`, `id_postulation`, `id_membre`) VALUES
(129, 0, '2025-04-17 14:24:58', 7, 5);

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
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `id_personnage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `postulation`
--
ALTER TABLE `postulation`
  MODIFY `id_postulation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

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
