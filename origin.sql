-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 23 avr. 2025 à 12:08
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
(42, 'Un mec cool, disponible mais pas ouf mécaniquement', '2025-04-23 09:23:11', 10, 17),
(43, 'Déjà tanké avec lui, parle pas, ne joue que DK... sinon gars cool en friend', '2025-04-23 09:26:57', 11, 17),
(44, 'Efficace tant qu&#039;il n&#039;y a pas plus de 3 mécas, tape fort. Point négatif, fait des blagues nulles.', '2025-04-23 09:28:57', 12, 17),
(45, 'Logs propres, y’a du potentiel.\r\nFaudrait juste voir s’il est aussi carré sur la comm et le teamplay. Quelqu’un sait comment il tournait chez Maze ?', '2025-04-23 09:49:56', 13, 17),
(46, 'Il joue uniquement son hunt, ou il a des rerolls viables ?\r\nJe suis allé check vite fait, pas vu de gros alt sur son compte. Ça peut être limitant en cas de compo chelou.', '2025-04-23 09:54:03', 13, 31),
(47, 'Il est aussi en apply chez Echoes, mais ils sont restés en 4 soirs.\r\nFaut juste qu’on s’assure qu’il cherche pas juste un plan B par confort. Sinon, il a l’air motivé et clair dans sa démarche.', '2025-04-23 09:55:28', 13, 29),
(48, 'Le progress chez Maze c’est pas rien.\r\nIl doit avoir l’habitude des strats tendues et des soirées clean. À voir si ça colle avec notre dynamique 3 soirs. Moi je suis curieux.', '2025-04-23 09:56:40', 13, 32);

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
(5, 'Llorwina', 'llorwina@gmail.com', '$2y$10$nkCw6ZQ1zL7wiaMDnle9UOqbkk0y4HdxZTGQGktmits2Ck6ASIQQa', 'Admin'),
(17, 'Uzui', 'uzui@origin.com', '$2y$10$AbGLqDIGIvUbuLUUYawK0Oj7yqo.RO2EBz98Sg62MJTsYgJvpmyOe', 'Titan'),
(18, 'Doki', 'linoae@origin.com', '$2y$10$F7qZFVoNQvoPCLxPBSaAkutxOThjhPYuA0myvVFYeliVPODdwaT.G', 'Membre'),
(19, 'Tærys', 'taerys@origin.com', '$2y$10$bu0XBkX/h54mF1dv38iK6OpfvwrUtRFDEO1jv72srN/3uHkzYjM.G', 'Moderateur'),
(20, 'Hûntor', 'huntor@origin.com', '$2y$10$5isAmQ5tMmYYZVmPi4RmGuet857J8EZRmp3ZEyO3I.fRUa.DvO/ti', 'Moderateur'),
(21, 'Nhrotz', 'nhrotz@origin.com', '$2y$10$8oGNnTzzi6.RoOU.qc3p5e.sgc1a25fyWsSiftbSX/4pK2wZI.kMy', 'Membre'),
(24, 'kiri', 'kiri@origin.com', '$2y$10$sruWEpKWTuTWm6oDxGqmQOE5JOBQHtbHAyyopWLXPtS5hbMhkv9MK', 'Moderateur'),
(25, 'Hemorragy', 'hemorragy@origin.com', '$2y$10$l9/oUE44dtNHIUxmq07F/.PRcfopJuTcoitHTZqlUxH/W0xD6rQZe', 'Moderateur'),
(26, 'Bodym', 'bodym@origin.com', '$2y$10$2yVbXUiVdZ1UIFVxz.94sudBei6GJi0T3g6mKmAw1StMxWrUmOUHC', 'Membre'),
(27, 'elie', 'elie@origin.com', '$2y$10$V/LQBs3yE7H/CHIxP5e9Je0S.Hkh6UorDVqokEvAeggep1xadjqDu', 'Membre'),
(28, 'Andra', 'andra@origin.com', '$2y$10$Sz5icp4HdG1Wz0CaNsmRyuK3jM68FegZTf1xlKdFnygQ.zloZJiWa', 'Titan'),
(29, 'Fresh', 'fresh@origin.com', '$2y$10$KdTzeyI4w8p3xCA2UnGhOuv5cOl/AtDxEx2MtoqYcZLUIA0PCKgkS', 'Moderateur'),
(30, 'Alkasham', 'alka@origin.com', '$2y$10$Uy1CeLRdaKzAOMihwMNjJOkT7mbsNSzcQrz/n6v.JaZyM/ESmGxqC', 'Membre'),
(31, 'Arino', 'arino@origin.com', '$2y$10$rLKV9zH9AKE.en9nvcSVTepk7y6czHl8ykMKNBAT6AF9AbWkSVt7i', 'Titan'),
(32, 'Xugan', 'xugan@origin.com', '$2y$10$cNWOLZHyDoZOJ2HBsb.ny.JSYZycNcel6Dc.NC5.ShvFr9jS6M6w2', 'Titan'),
(33, 'Biloue', 'biloue@origin.com', '$2y$10$oKES80Fy8p/vORviNuc6l.IS7cWwV1Noikl0UYst3.H8J5b3r06ca', 'Titan'),
(34, 'Freya', 'freya@origin.com', '$2y$10$TjkRen0WE8QBg9YLwApIHuXV9hX6ODUhdk9oEJjsD6Tpx2Ghi9uPC', 'Titan'),
(35, 'Goudy', 'goudy@origin.com', '$2y$10$0tiFHdmpqzS0/JzWbZCP2e5LpJlT6SWPUfL8AqMMyOe6gBJjUy7DC', 'Membre'),
(36, 'Eresus', 'eresus@origin.com', '$2y$10$yYNp9Hi5h3d9J5nBvJl4A.8FWcBChYVWM1Qx973WpndLFXFWA.nm.', 'Titan'),
(37, 'Drifer', 'drifer@origin.com', '$2y$10$lUEuPZTsbC6cDhtBo89fEevgB41NHQ/CPHzMjEkqfdRRGpzV5bSfi', 'Membre'),
(38, 'Rosaphir', 'rosa@origin.com', '$2y$10$RjfgPAib6g1zUkS/J4k9t.SSCZp5SGu3SHmZ5WeaH6gKcgZcQRSme', 'Titan'),
(39, 'Gaunain', 'gaunain@origin.com', '$2y$10$6NMqw6kkLh1en5zyJk2GauCGje2mBFrpL3EmHZjO7HyhR7JECCY4i', 'Membre'),
(40, 'Chimofire', 'chimo@origin.com', '$2y$10$GXFQyyaRa.KoS0fdRX4CGeK9DEnLzo23.sjtTcDYnGHYI6qa8rZmC', 'Titan'),
(41, 'Zokow', 'zokow@origin.com', '$2y$10$RY.IL8eEY2FtUS2Op4KsWu6TkSdQ.EtTOt3mZttHKjRMYctUMUYqm', 'Titan'),
(42, 'Dragonsorrow', 'dragon@origin.com', '$2y$10$isAeBzn4jh3ZJhfjM0Qi8uqZyKccnDQZPvx.rWup.PrhWL0tDpIw2', 'Membre'),
(43, 'Bønnierotten', 'bonnie@origin.com', '$2y$10$yClg/Rf7TOLHoA5SBV1sTOpE420IW8Sul6W0/K0KbJNEJua4RreAS', 'Titan'),
(44, 'N4tsu', 'natsu@origin.com', '$2y$10$WP1FylkuczhxGnxb9ziX3OTnLsSrlWXmmzCkoSIjrq8XYcIXiUGyG', 'Membre'),
(45, 'Suncy', 'suncy@origin.com', '$2y$10$U5yb406qJKVdz2OR6Pt6RegN/nCNkKPhfHTO338W89ZSl7mYaAtuq', 'Membre');

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
('aszhara', 'sargeras', 1, 15),
('bwonsamdi', 'sargeras', 1, 18),
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
('nhrotza', 'sargeras', 21, 31),
('kirimonk', 'sargeras', 24, 42),
('kirivoker', 'sargeras', 24, 43),
('kirid', 'sargeras', 24, 44),
('goulgivre', 'sargeras', 25, 45),
('anemia', 'sargeras', 25, 46),
('bodym', 'sargeras', 26, 47),
('mydob', 'sargeras', 26, 48),
('êlie', 'sargeras', 27, 49),
('andraker', 'sargeras', 28, 50),
('andralamech', 'sargeras', 28, 51),
('fresh', 'sargeras', 29, 52),
('badlands', 'sargeras', 29, 53),
('alkasham', 'sargeras', 30, 54),
('alkarior', 'hyjal', 30, 57),
('pistachus', 'sargeras', 31, 58),
('arino', 'sargeras', 31, 59),
('xugan', 'sargeras', 32, 60),
('xudrood', 'sargeras', 32, 61),
('mecadolphe', 'sargeras', 33, 62),
('magichienass', 'sargeras', 33, 63),
('kultirachien', 'sargeras', 33, 64),
('freyadk', 'sargeras', 34, 65),
('freyuno', 'sargeras', 34, 66),
('freÿà', 'sargeras', 34, 67),
('llorwina', 'sargeras', 5, 70),
('eniira', 'khaz-modan', 5, 71),
('goudy', 'sargeras', 35, 72),
('eresus', 'sargeras', 36, 73),
('reresus', 'sargeras', 36, 74),
('drifer', 'nerzhul', 37, 75),
('rosaphir', 'sargeras', 38, 76),
('cumburbatch', 'sargeras', 38, 77),
('gaunain', 'sargeras', 39, 82),
('gausan', 'sargeras', 39, 83),
('chimoshadow', 'sargeras', 40, 85),
('chimofire', 'sargeras', 40, 86),
('zokow', 'sargeras', 41, 87),
('zoco', 'sargeras', 41, 88),
('dragonsorrow', 'chogall', 42, 89),
('bønnierotten', 'sargeras', 43, 90),
('bønnii', 'sargeras', 43, 91),
('natsuzorr', 'hyjal', 44, 92),
('natssuu', 'hyjal', 44, 93),
('suncy', 'hyjal', 45, 94),
('sùnz', 'hyjal', 45, 95);

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
(7, 'Toujours une nouvelle postulation Logs : https://www.warcraftlogs.com/character/id/40314961', 'Refusee', '2025-04-11 12:41:46', 1),
(10, 'Je cherche une guilde capable de clean chaque pallier dans les meilleures conditions possibles. Sans drama, sans égocentrisme. Je veux juste jouer avec une équipe qui s&#039;entend bien.\r\nCommentaires\r\nJe monte un moine tank si le paladin devient vraiment pas bon, mais j&#039;aimerai privilégier ce dernier, vu qu&#039;il est mon personnage depuis 16 ans maintenant. Logs : https://www.warcraftlogs.com/character/eu/sargeras/linoae', 'En cours', '2025-04-23 08:56:11', 18),
(11, 'Je cherche a passer côté Horde, mon objectif est une guilde 3 ou 4 soirs semaine avec un bon progress et une place de tank dans l&#039;idéal même si j&#039;ai plusieurs persos. Après recherche, de toutes les guildes, Origin est celle qui présente le mieux que ce soit sur la page wowprogress ou sur ce site. La description de la guilde donne envie, j&#039;aimerais participer a votre aventure sur les prochains raids !\r\nPS :\r\nJe joue dk tank uniquement Logs : https://www.warcraftlogs.com/character/eu/sargeras/nhrotz', 'En cours', '2025-04-23 08:57:35', 21),
(12, 'Joueur depuis 16 ans sur wow, j&#039;ai toujours fait du pve hl. Je suis passé par le top 4 fr à l&#039;époque de mop. J&#039;ai envie de retrouver un peu plus l&#039;esprit try hard comme j&#039;ai pu le faire par le passé pendant des années.\r\nEtant à 8/10 pour le moment, si ça ne nous prend pas trop de temps à finir de clean j&#039;aimerais finir avec craze, je vous rejoindrais bien évidemment avant le pallier suivant pour pouvoir être testé et jouer avec vous avant le nouveau raid.\r\nSi je vois que le pallier arrive vite que et je n&#039;ai toujours pas clean je viendrais quand même jouer avec vous avant pour me faire tester.\r\nMon but n&#039;étant pas de vouloir possiblement mettre craze en difficulté en les quittant en plein progress.\r\nJe n&#039;ai pas mis craze au courant de ma recherche, je le ferais quand même a l&#039;avance si vous êtes intéressé par mon profil.\r\n\r\nMerci à vous, en attente de votre retour. Logs : https://www.warcraftlogs.com/character/eu/sargeras/bodym', 'En cours', '2025-04-23 09:03:35', 26),
(13, 'Ayant fait ce progress chez Maze je souhaite baisser mon temps de raid et rejouer avec mon pote Bodym je recherche une guilde en 3 soirs et au vu de vos performances je postule chez vous\r\nCommentaires\r\nJ ajoute que je suis actuellement en apply chez Echoes j ai postulé chez eux pour du 3 soirs avec du push 4 soirs sur 2 semaines mais ils ont décidé de rester en 4 soirs permanent Logs : https://www.warcraftlogs.com/character/eu/sargeras/%c3%8alie', 'En cours', '2025-04-23 09:05:28', 27),
(14, 'Venant d&#039;une guilde d&#039;amis, joueurs casu, nous avons atteint 4/10MM. Mais les limites se font sentir, tant en terme de niveau de jeu qu&#039;en terme de stabilité du roster.\r\nJe cherche donc une guilde stable, solide, permettant de progress sérieusement et efficacement tout en restant dans une ambiance détendue. La guilde Origin me semble correspondre à ces attentes. Logs : https://www.warcraftlogs.com/character/eu/sargeras/alkasham', 'En cours', '2025-04-23 09:06:15', 30),
(15, 'Je me suis bien entendu avec Hûntor Lors de notre entretien , je ne vous connais pas encore donc difficile de me projeter. Logs : https://www.warcraftlogs.com/character/eu/sargeras/goudy', 'En cours', '2025-04-23 09:06:57', 35),
(16, 'J&#039;ai décidé d&#039;apply chez Origin car mon ami Taerys est dedans et il a déja mentionner la bonne qualité du corps officier, la guilde est stable depuis pas mal de temps (ce que je recherche).Ma guilde Aftermath ayant disband, j&#039;apply dans le but de clean les paliers et raid dans la bonne humeur, faire des mm+ et jouer dans une bonne communauté. Logs : https://www.warcraftlogs.com/character/eu/chogall/dragonsorrow', 'En cours', '2025-04-23 09:07:22', 42),
(17, 'Je cherche une guilde en 3-4 soirs semaine, qui vise un clean du raid rapide. J&#039;ai cru comprendre que les places DPS étaient assez fermées, mais votre roster me convient tout à fait. Taerys m&#039;a dit que d&#039;un palier à l&#039;autre l&#039;entrée dans le roster était possible donc sur du plus long terme c&#039;est ce que je viserai.\r\nCommentaires\r\nJe suis actuellement warlock mais je souhaiterai passer shadow priest sur le prochain palier. Si c&#039;est absolument impossible je reste très flexible sur mon choix de perso du moment que je reste rdps. Logs : https://www.warcraftlogs.com/character/eu/hyjal/natsuzorr', 'En cours', '2025-04-23 09:07:56', 44),
(18, 'Joueur de WoW depuis fin wod, je fais du progress compétitif depuis 1 an. Je suis à la recherche d&#039;une guilde stable, qui tout comme moi aime se préparer et se donner à fond sur le jeux. Toujours prêt à relever le défi, je jongle entre le côté on a &quot;tous une vie&quot; et mon amour de WoW. C&#039;est pourquoi, je me donne à fond trois soirs par semaine pour profiter à fond du moment. Joueur equi depuis la Tombe de Sargeras j&#039;aime préparer les figth à fond afin d&#039;être prêt le soir venu, aller faire des donjons pour m’équiper et ainsi pouvoir amener un maximum de ressources en raid. Je suis motivé et vraiment chaud pour intégrer un bon roster qui tient sur le long terme. Logs : https://www.warcraftlogs.com/character/eu/hyjal/suncy', 'En cours', '2025-04-23 09:08:22', 45),
(19, 'Je joue à wow depuis bc. comme j&#039;ai dit en entretien j&#039;ai clean certain palier comme d&#039;autres non ( environ les 3/4) ( exemple de clean yog saron 25, Archimonde ( époque draenor) etc. \r\nJe me suis permis suite à ma guilde qui faute de motivation a décidé de stop, regarder les guildes qui recherchent un heal. Vous êtes une grosse guilde avec d&#039;ambition et c&#039;est cela que je recherche .\r\nRetrouver une guilde avec une structure efficace, optimiser mon temps de jeu et parcourir le contenu du jeu avec ambition et la volonté de clean. mais aussi a m&#039;optimiser au maximum\r\nComme j&#039;ai eu un entretien discord, vous recherchez plus un monk et je comprends. je suis prêt à refaire un reroll, à m&#039;optimiser afin de faire avancer la guilde dans la même ambition que moi.\r\nbien évidement je préfère jouer heal\r\nEn espérant avoir de vos nouvelles Logs : https://www.warcraftlogs.com/character/eu/sargeras/gaunain', 'En cours', '2025-04-23 09:11:43', 39);

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
(129, 0, '2025-04-17 14:24:58', 7, 5),
(131, 1, '2025-04-23 09:16:58', 10, 17),
(132, 0, '2025-04-23 09:17:06', 11, 17),
(133, 1, '2025-04-23 09:17:54', 12, 17),
(134, 1, '2025-04-23 09:18:07', 13, 17),
(135, 1, '2025-04-23 09:18:42', 14, 17),
(136, 0, '2025-04-23 09:19:03', 15, 17),
(137, 1, '2025-04-23 09:19:08', 16, 17),
(138, 1, '2025-04-23 09:19:12', 17, 17),
(139, 1, '2025-04-23 09:19:33', 19, 17),
(140, 1, '2025-04-23 09:19:42', 18, 17),
(141, 0, '2025-04-23 09:53:44', 13, 31),
(142, 1, '2025-04-23 09:56:24', 13, 32);

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
  MODIFY `id_commentaire` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `id_membre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `personnage`
--
ALTER TABLE `personnage`
  MODIFY `id_personnage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT pour la table `postulation`
--
ALTER TABLE `postulation`
  MODIFY `id_postulation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `vote`
--
ALTER TABLE `vote`
  MODIFY `id_vote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

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
