-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 20 mars 2025 à 10:47
-- Version du serveur : 8.0.30
-- Version de PHP : 8.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cinema`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `description` mediumtext COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`) VALUES
(8, 'Science-Fiction', 'A science fiction film uses fictional representations, often based on science that is not entirely accepted (or even completely rejected) by traditional science, such as, for example, extraterrestrial life forms, extraterrestrial worlds, extrasensory perception, and time travel.'),
(9, 'Action', 'The action film is a cinematic genre that features a series of spectacular, often stereotypical scenes (car chases, shootouts, explosions, etc.) built around a conflict that is resolved violently, typically through the death of the hero&amp;#039;s enemies.'),
(10, 'Adventure', 'An adventure film (singular) is a cinematic genre characterized by the presence of a fictional or non-fictional hero, whose status is derived from the myth they inspire, the particular action that unfolds, the use of distinctive settings, sometimes a temporal shift from the contemporary, as well as, at times, deliberate implausibilities that characterize its eccentricity, all conveying a general sense of escapism.'),
(11, 'Drama', 'Drama is a cinematic genre that deals with generally non-epic situations in a serious context, with a tone more likely to inspire sadness than laughter. Typically, a drama relies on a script that addresses a grave theme (death, poverty, rape, drug addiction, etc.) with as little humor as possible, which can be painful or outrageous; an injustice. It may draw inspiration from history (with themes such as World War II) or current events.'),
(12, 'Animation', 'Animated Film: A cinematic technique that allows for the creation of movement in objects and characters through frame-by-frame filming. A cinematic film made from a series of drawings representing the successive phases of bodily movement.'),
(13, 'Fantasy', 'Fantasy cinema is a cinematic genre that encompasses films featuring the supernatural, horror, the unusual, or monsters. The plot is based on irrational or unrealistic elements. The genre is characterized by its great diversity: it includes works inspired by the marvelous, horror films that evoke terror, nightmares, and madness.'),
(14, 'Family', 'Category encompassing all films whose main characters form a family, with familial relationships being well represented in the story, whether it is a dramatic film, a comedy, or an adventure film.');

-- --------------------------------------------------------

--
-- Structure de la table `films`
--

CREATE TABLE `films` (
  `id` int NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `director` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `actors` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ageLimit` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `synopsis` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `stock` bigint NOT NULL,
  `category_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id`, `title`, `director`, `actors`, `ageLimit`, `duration`, `synopsis`, `date`, `image`, `price`, `stock`, `category_id`) VALUES
(14, 'Get Rich or Die Tryin\'', 'Jim Sheridan', '50 Cent/ Joy Bryant/ Adewale Akinnuoye-Agbaje', '16', '01h57', 'A tale of an inner city drug dealer who turns away from a life of crime to pursue his passion of rap music.', '2006-02-22', 'assets/img/film_67dbeb572e34b.png', 15, 10, 11),
(16, 'Together', 'Michael Shanks', 'Alison Brie/ Damon Herriman/ Dave Franco', '16', '01h42', 'A couple\'s move to the countryside triggers a supernatural incident that drastically alters their relationship, existence, and physical form.', '2025-01-26', 'assets/img/film_67dbf094426d8.png', 20, 50, 8);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `nickname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `civility` enum('m','f') COLLATE utf8mb4_general_ci NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `zipcode` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `city` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `country` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `nickname`, `password`, `email`, `phone`, `civility`, `birthday`, `address`, `zipcode`, `city`, `country`, `role`) VALUES
(1, 'Severus', 'Snape', 'the dark one', '$2y$12$k6RqB07vwnaGUL9XNQEWfu7E/.mxk3UMlxWXnQEm/v5QEgRcKlbUq', 'thebestslytherin@gmail.com', '1776623954', 'm', '1969-01-01', '69 slytherin alley', '98876', 'Hogwarts', 'United Kingdom', 'user'),
(2, 'Mamadou', 'Amadou', 'Doums', '$2y$12$KLS95aUwuTIu1Q0qFQ0EEOD3TaRR8qtTo9uxPFfsc.Hd1FBNhmaoq', 'mamadou.amadou@colombbus.org', '0606060606', 'm', '1983-09-06', '28 rue du Télégraphe', '75020', 'Paris', 'France', 'admin'),
(4, 'Hermione', 'Granger', 'Hermy', '$2y$12$l3yYCayT7DDHs63jwDVFZeu5s3H8fwm8BY7LSn.UHHSOSTE6a4ihG', 'hermione.granger@hogwarts.edu', '3455969787', 'f', '1996-11-01', '1 Griffyndor Hall', '68456', 'London', 'United Kingdom', 'admin'),
(5, 'Mamadou', 'Amadou', 'mamad', '$2y$12$DNyBXccYDGKr7Z6/T2QH6.fxaA.aL2aYw6DwDfE2VG1wLNnyKhqoy', 'mamadou.ngatte@outlook.fr', '0662429320', 'm', '2001-01-01', '28 rue du Télégraphe', '75020', 'Paris', 'France', 'admin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
