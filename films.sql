-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : jeu. 20 mars 2025 à 14:03
-- Version du serveur : 8.0.30
-- Version de PHP : 8.3.6

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
-- Structure de la table `films`
--

DROP TABLE IF EXISTS `films`;
CREATE TABLE `films` (
  `id_film` int NOT NULL,
  `categorie_id` int NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `director` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `actors` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `ageLimit` varchar(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duration` time NOT NULL,
  `synopsis` text COLLATE utf8mb4_general_ci NOT NULL,
  `date` date NOT NULL,
  `image` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `price` float NOT NULL,
  `stock` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `films`
--

INSERT INTO `films` (`id_film`, `categorie_id`, `title`, `director`, `actors`, `ageLimit`, `duration`, `synopsis`, `date`, `image`, `price`, `stock`) VALUES
(1, 8, 'Avatar', 'James Cameron', 'Sam Worthingt on/Zoe Saldana/Sigourney Weaver/Stephen Lang', '13', '02:42:00', 'Malgré sa paralysie, Jake\r\nSully, un ancien marine\r\nimmobilisé dans un\r\nfauteuil roulant, est resté\r\nun combattant au plus\r\nprofond de son être. Il est\r\nrecruté pour se rendre à\r\ndes années-lumière de la\r\nTerre, sur Pandora, où de\r\npuissants groupes\r\nindustriels exploitent un\r\nminerai rarissime destiné\r\nà résoudre la crise\r\nénergétique sur Terre.\r\nParce que l&amp;amp;#039;atmosphère de\r\nPandora est toxique pour\r\nles humains, ceux-ci ont\r\ncréé le Programme Avatar,\r\nqui permet à des &amp;amp;quot; pilotes\r\n&amp;amp;quot; humains de lier leur\r\nesprit à un avatar, un\r\ncorps biologique\r\ncommandé à distance,\r\ncapable de survivre dans\r\ncette atmosphère létale.\r\nCes avatars sont des\r\nhybrides créés\r\ngénétiquement en\r\ncroisant l&amp;amp;#039;ADN humain\r\navec celui des Na&amp;amp;#039;vi, les\r\nautochtones de Pandora.', '2009-12-16', 'avatar.jpg', 15, 21),
(5, 5, 'Interstellar', 'Christopher Nolan', 'Matthew McConaughey/Anne Hathaway /Michael Caine', '13', '02:48:00', 'Le film raconte les\r\naventures d’un groupe\r\nd’explorateurs qui utilisent\r\nune faille récemment\r\n\r\ndécouverte dans l’espace-\r\ntemps afin de repousser\r\n\r\nles limites humaines et\r\npartir à la conquête des\r\ndistances astronomiques', '2014-11-05', 'interstellar.jpg', 15, 10),
(6, 3, 'Matrix', 'Wachowski sisters', 'Keanu Reeves/Laurence Fishburne/  Carrie- Anne  Moss', '13', '02:15:00', 'Programmeur anonyme\ndans un service\nadministratif le jour,\nThomas Anderson devient\nNeo la nuit venue. Sous ce\npseudonyme, il est l\'un\ndes pirates les plus\n\nrecherchés du cyber-\nespace. A cheval entre\n\ndeux mondes, Neo est\nassailli par d&amp;amp;#039;étranges\nsonges et des messages\ncryptés provenant d\'un\ncertain Morpheus. Celui-ci\nl\'exhorte à aller au-delà\ndes apparences et à\ntrouver la réponse à la\nquestion qui hante\nconstamment ses pensées\n: qu\'est-ce que la Matrice\n? Nul ne le sait, et aucun\nhomme n\'est encore\nparvenu à en percer les\ndefenses. Mais Morpheus\nest persuadé que Neo est\nl\'Elu, le libérateur\nmythique de l\'humanité\nannoncé selon la\nprophétie. Ensemble, ils se\nlancent dans une lutte\nsans retour contre la\nMatrice et ses terribles\nagents...', '1999-05-24', 'matrix.jpg', 10, 30),
(7, 6, 'Wall -E', 'Andrew Stanton', 'Ben Burtt/Eliss a Knight/Jeff Garlin', '10', '01:37:00', 'Faites la connaissance de\r\nWALL•E (prononcez\r\n&quot;Walli&quot;) : WALL•E est le\r\ndernier être sur Terre et\r\ns&#039;avère être un... petit\r\nrobot ! 700 ans plus tôt,\r\nl&#039;humanité a déserté notre\r\nplanète laissant à cette\r\nincroyable petite machine\r\nle soin de nettoyer la\r\nTerre. Mais au bout de ces\r\nlongues années, WALL•E a\r\ndéveloppé un petit défaut\r\ntechnique : une forte\r\npersonnalité.\r\nExtrêmement curieux, très\r\nindiscret, il est surtout un\r\npeu trop seul...\r\nCependant, sa vie\r\ns&#039;apprête à être\r\nbouleversée avec l&#039;arrivée\r\nd&#039;une petite &quot;robote&quot;,\r\nbien carénée et\r\nprénommée EVE. Tombant\r\ninstantanément et\r\néperdument amoureux\r\nd&#039;elle, WALL•E va tout\r\nmettre en oeuvre pour la\r\nséduire. Et lorsqu&#039;EVE est\r\nrappelée dans l&#039;espace\r\npour y terminer sa\r\nmission, WALL•E n&#039;hésite\r\npas un seul instant : il se\r\nlance à sa poursuite...\r\nHors de question pour lui\r\nde laisser passer le seul\r\namour de sa vie... Pour\r\nêtre à ses côtés, il est prêt\r\nà aller au bout de l&#039;univers\r\net vivre la plus fantastique\r\ndes aventures !', '2008-07-30', 'wall_e.jpg', 15, 25),
(8, 4, 'E.T.', 'Steven Spielberg', 'Henry Thomas/Drew Barrymore /Dee Wallace', '10', '02:00:00', 'Une soucoupe volante\r\natterrit en pleine nuit près\r\nde Los Angeles. Quelques\r\nextraterrestres, envoyés\r\nsur Terre en mission\r\nd&amp;amp;#039;exploration botanique,\r\nsortent de l&amp;amp;#039;engin, mais un\r\n\r\ndes leurs s&amp;amp;#039;aventure au-\r\ndelà de la clairière où se\r\n\r\ntrouve la navette. Celui-ci\r\nse dirige alors vers la ville.\r\nC&amp;amp;#039;est sa première\r\ndécouverte de la\r\ncivilisation humaine.\r\nBientôt traquée par des\r\nmilitaires et abandonnée\r\npar les siens, cette petite\r\ncréature apeurée se\r\nnommant E.T. se réfugie\r\ndans une résidence de\r\nbanlieue.', '2002-04-03', 'ET.jpg', 15, 10),
(9, 4, 'Avengers', 'Joss Whedon', 'Robert Downey Jr./Chris Evans/Mark Ruffalo', '13', '02:23:00', 'Lorsque Nick Fury, le\r\ndirecteur du S.H.I.E.L.D.,\r\nl&#039;organisation qui préserve\r\nla paix au plan mondial,\r\ncherche à former une\r\néquipe de choc pour\r\nempêcher la destruction\r\ndu monde, Iron Man,\r\nHulk, Thor, Captain\r\nAmerica, Hawkeye et\r\nBlack Widow répondent\r\nprésents. Les Avengers ont\r\nbeau constituer la plus\r\nfantastique des équipes, il\r\nleur reste encore à\r\napprendre à travailler\r\nensemble, et non les uns\r\ncontre les autres, d&#039;autant\r\nque le redoutable Loki a\r\nréussi à accéder au Cube\r\nCosmique et à son pouvoir\r\nillimité...', '2012-04-20', 'avengers.jpg', 15, 5),
(10, 4, '7ans au Tibet', 'Jean- Jacques  Annaud', 'Brad Pitt / David Thewlis / Jamyang Jamtsho Wangchuk / David Thewlis / B.D Wong', '13', '02:15:00', 'A la fin de l&#039;été 1939,\r\nl&#039;alpiniste autrichien\r\nHeinrich Harrer, premier\r\nvainqueur de la face Nord\r\nde l&#039;Eiger et qui rêve de\r\nconquérir le Nanga Parbat,\r\nsommet inviolé de\r\nl&#039;Himalaya, accepte de\r\nl&#039;argent nazi pour y\r\nplanter le drapeau à croix\r\ngammée. La guerre éclate.\r\nPrisonnier des\r\nBritanniques à la frontiere\r\nde l&#039;Inde, il s&#039;évade.\r\nCommence alors la\r\nvéritable aventure de sa\r\nvie : une longue errance\r\nqui se termine à Lhassa,\r\n\r\nrésidence du jeune Dalaï-\r\nlama avec qui il se lie\r\n\r\nd&#039;amitié.', '1997-10-08', '7-ans-au-Tibet.jpg', 15, 8),
(11, 5, 'Green Book : sur les routes du sud', 'Peter Farrelly', 'Viggo Mortensen / Mahershala Ali / Linda Cardellini / Nick Vallelonga / Dimiter Marinov', '13', '02:10:00', 'En 1962, alors que règne\r\nla ségrégation, Tony Lip,\r\nun videur italo-américain\r\ndu Bronx, est engagé pour\r\nconduire et protéger le Dr\r\nDon Shirley, un pianiste\r\nnoir de renommée\r\nmondiale, lors d’une\r\ntournée de concerts.', '2019-01-23', 'Green-Book.jpg', 15, 15),
(12, 5, 'LION', 'Garth Davis', 'Dev Patel / Saroo Brierley / Nicole Kidman / Sunny Pawar / David Wenham', '13', '02:58:00', 'Une incroyable histoire\r\nvraie : à 5 ans, Saroo se\r\nretrouve seul dans un\r\ntrain traversant l’Inde qui\r\nl’emmène malgré lui à des\r\nmilliers de kilomètres de\r\nsa famille. Perdu, le petit\r\ngarçon doit apprendre à\r\nsurvivre seul dans\r\nl’immense ville de\r\nCalcutta. Après des mois\r\nd’errance, il est recueilli\r\ndans un orphelinat et\r\nadopté par un couple\r\nd’Australiens. 25 ans plus\r\ntard, Saroo est devenu un\r\nvéritable Australien, mais\r\nil pense toujours à sa\r\nfamille en Inde. Armé de\r\nquelques rares souvenirs\r\net d’une inébranlable\r\ndétermination, il\r\ncommence à parcourir des\r\nphotos satellites sur\r\nGoogle Earth, dans l’espoir\r\nde reconnaître son village.\r\nMais peut-on imaginer\r\nretrouver une simple\r\nfamille dans un pays d’un\r\nmilliard d’habitants ?', '2017-02-22', 'Lion.jpg', 15, 30),
(13, 8, 'Comme un avion', 'Bruno Podalydés', 'Bruno PODALYDÈ S / Sandrine KIBERLAIN / Denis PODALYDÈ\nS / Agnès\nJAOUI /\nMichel\nVUILLERM\nOZ', '10', '01:45:00', 'Michel, la cinquantaine,\r\nest infographiste.\r\nPassionné par\r\nl&#039;Aéropostale, il se rêve en\r\nJean Mermoz quand il\r\nprend son scooter. Un\r\njour, Michel tombe en\r\narrêt devant des photos\r\nde kayak: on dirait le\r\nfuselage d&#039;un avion. C&#039;est\r\nle coup de foudre.', '2015-06-10', 'comme-un-avion.jpg', 15, 5),
(14, 8, 'Bienvenue à Marly - Go mo nt', 'Julien Rambaldi', 'Lebli BAYNON / Aïssa MAIGA / Marc ZINGA / Médina DIARRA et Kamini', '10', '01:34:00', 'Le film s&#039;inspire de\r\nl&#039;histoire du père de Julien\r\nRambaldi En 1975, Seyolo\r\nZantoko, médecin\r\nfraîchement diplômé\r\noriginaire de Kinshasa,\r\nsaisit l’opportunité d’un\r\nposte de médecin de\r\ncampagne dans un petit\r\nvillage français. Arrivés à\r\nMarly-Gomont, Seyolo et\r\nsa famille déchantent. Les\r\nhabitants ont peur, ils\r\nn’ont jamais vu de noirs de\r\nleur vie. Mais Seyolo est\r\nbien décidé à réussir son\r\npari et va tout mettre en\r\nœuvre pour gagner la\r\nconfiance des villageois...', '2016-06-08', 'bienvenue-à-Marly-Gomont.jpg', 15, 10),
(15, 8, 'Que justice soit faite', 'F. Gary Gray', 'Gérard BUTLER / Jamie FOXX / Leslie BIBB / Viola DAVIS / Colm MEANEY', '16', '01:49:00', 'Dix ans après le meurtre\r\nde sa femme et sa fille, un\r\nhomme se dresse contre\r\nle procureur en charge du\r\nprocès des meurtriers,\r\npour obtenir lui-même la\r\njustice. Sa vengeance\r\nmenace tout aussi bien\r\nl&#039;homme qui leur a\r\naccordé la clémence, que\r\n\r\nle système et la ville elle-\r\nmême.', '2010-10-22', 'Que-justice- soit-faite.jpg', 15, 22),
(16, 5, 'Invictus', 'Clint Eastwood', 'Morgan Freeman / Matt Damon / Tony Kgoroge / Adjoa Andoh / Marguerite Wheatley', '13', '02:12:00', 'À l&#039;issue de la chute de\nl&#039;apartheid, le président\nNelson Mandela,\nrécemment élu, est\nconfronté à une Afrique\ndu Sud qui est racialement\net économiquement\ndivisée.', '2009-12-01', 'Invictus.png', 15, 30),
(18, 5, 'teste', 'tessst', 'teo/toe/et', '10', '02:45:00', 'fhpehohPD FI hfiemzq ihdi pdùh iùHFIH IQ%HDI %Q', '2022-02-01', 'affiches-films-bleu-orange-2.jpg', 17, 890);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `films`
--
ALTER TABLE `films`
  ADD PRIMARY KEY (`id_film`),
  ADD KEY `categorie_id` (`categorie_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `films`
--
ALTER TABLE `films`
  MODIFY `id_film` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `films`
--
ALTER TABLE `films`
  ADD CONSTRAINT `films_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `films_ibfk_2` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `films_ibfk_3` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `films_ibfk_4` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`),
  ADD CONSTRAINT `films_ibfk_5` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id_categorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
