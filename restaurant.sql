-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 26 juin 2020 à 18:03
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.2.30
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;
/*!40101 SET NAMES utf8mb4 */
;
--
-- Base de données : `restaurant`
--
-- --------------------------------------------------------
--
-- Structure de la table `booking`
--
CREATE TABLE `booking` (
  `Id` int(11) NOT NULL,
  `BookingDate` date NOT NULL,
  `BookingTime` time NOT NULL,
  `NumberOfSeats` tinyint(4) NOT NULL,
  `User_Id` int(11) NOT NULL,
  `CreationTimestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Déchargement des données de la table `booking`
--
INSERT INTO `booking` (
    `Id`,
    `BookingDate`,
    `BookingTime`,
    `NumberOfSeats`,
    `User_Id`,
    `CreationTimestamp`
  )
VALUES (
    32,
    '2020-04-01',
    '17:15:00',
    5,
    1,
    '2020-06-25 01:18:11'
  ),
  (
    33,
    '2021-04-01',
    '00:00:00',
    4,
    1,
    '2020-06-25 01:33:05'
  );
-- --------------------------------------------------------
--
-- Structure de la table `menu`
--
CREATE TABLE `menu` (
  `Id` int(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Photo` varchar(30) NOT NULL,
  `Price` float NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Déchargement des données de la table `menu`
--
INSERT INTO `menu` (`Id`, `Name`, `Photo`, `Price`)
VALUES (1, 'biskvi', 'biskvi.jpg', 5.5),
  (2, 'princesstårta', 'princesstarta.jpg', 3.2),
  (3, 'arraksboll', 'arraksboll.jpg', 2.5),
  (4, 'kanelbulle', 'kanelbulle.jpg', 6.5),
  (5, 'chokladboll', 'chockladboll.jpg', 3.5),
  (6, 'kladdkaka', 'kladdkaka.jpg', 2.6),
  (7, 'kolatårta', 'kolatarta.jpg', 4.7),
  (8, 'lussekatt', 'lussekatt.jpg', 0.8),
  (9, 'punchrulle', 'punchrulle.jpg', 1.8),
  (10, 'semla', 'semla.jpg', 1.3),
  (11, 'saffranskaka', 'saffranskaka.jpg', 1.4),
  (12, 'hallongrotta', 'hallongrotta.jpg', 1.5),
  (26, 'test', 'unknown-menu.jpg', 5);
-- --------------------------------------------------------
--
-- Structure de la table `staff`
--
CREATE TABLE `staff` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `LastName` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Occupation` varchar(30) CHARACTER SET utf8 NOT NULL,
  `Category` varchar(15) COLLATE utf8_swedish_ci NOT NULL,
  `Photo` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_swedish_ci;
--
-- Déchargement des données de la table `staff`
--
INSERT INTO `staff` (
    `Id`,
    `FirstName`,
    `LastName`,
    `Occupation`,
    `Category`,
    `Photo`
  )
VALUES (
    1,
    'Victor',
    'Barinov',
    'chef',
    'chefs',
    'victor.jpg'
  ),
  (
    2,
    'Elena',
    'Sokolova',
    'chef',
    'chefs',
    'elena.jpg'
  ),
  (
    3,
    'Lev',
    'Solovev',
    'sous-chef',
    'chefs',
    'lev.jpg'
  ),
  (
    4,
    'Dimitrij',
    'Nagijev',
    'owner',
    'management',
    'dimitrij.jpg'
  ),
  (
    5,
    'Victoria ',
    'Goncharova',
    'staff manager',
    'management',
    'victoria.jpg'
  ),
  (
    6,
    'Maxim',
    'Lavrov',
    'cook',
    'cooks',
    'maxim.jpg'
  ),
  (
    7,
    'Arsenij',
    'Chuganin',
    'cook',
    'cooks',
    'arsenij.jpg'
  ),
  (
    8,
    'Fjodor',
    'Jurchenko',
    'cook',
    'cooks',
    'fjodor.jpg'
  ),
  (
    9,
    'Louis',
    'Benoit',
    'confectionner',
    'cooks',
    'louis.jpg'
  ),
  (
    10,
    'Ekaterina',
    'Barinova',
    'cook',
    'cooks',
    'ekaterina.jpg'
  ),
  (
    11,
    'Anastasia',
    'Fomina',
    'waitress',
    'waiters',
    'anastasia.jpg'
  ),
  (
    12,
    'Ilja',
    'A.',
    'waiter',
    'waiters',
    'ilja.jpg'
  ),
  (
    13,
    'Alexandra',
    'Bubnova',
    'waitress',
    'waiters',
    'alexandra.jpg'
  ),
  (
    14,
    'Constantin',
    'Anisimov',
    'bartender',
    'other',
    'constantin.jpg'
  ),
  (
    15,
    'Denis',
    'Krylov',
    'pianist',
    'other',
    'denis.jpg'
  ),
  (
    16,
    'Ajnura',
    'Kenensarova',
    'cleaner',
    'other',
    'ajnura.jpg'
  ),
  (
    17,
    'Test',
    'Test',
    'tester',
    'chefs',
    'unknown-staff.jpg'
  );
-- --------------------------------------------------------
--
-- Structure de la table `testimonial`
--
CREATE TABLE `testimonial` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(30) NOT NULL,
  `LastName` varchar(30) NOT NULL,
  `Comment` varchar(150) NOT NULL,
  `Photo` varchar(50) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Déchargement des données de la table `testimonial`
--
INSERT INTO `testimonial` (
    `Id`,
    `FirstName`,
    `LastName`,
    `Comment`,
    `Photo`
  )
VALUES (
    1,
    'Sven',
    'Svensson',
    'Saften där var utmärkt, precis som i Sverige, men det fanns ingen coca vid beställning',
    'johan.jpg'
  ),
  (
    2,
    'Glenn',
    'Å.',
    'Vilken glädje, allt smakade jävla gott! Chefen var super... men han super för mycket',
    'lars.jpg'
  ),
  (
    3,
    'Gilbert',
    'Pique-assiette',
    'Bonne expérience culinaire, le chef paraît assez grincheux, il est impossible de le séparer de son verre de rhum',
    'clouseau.jpg'
  );
-- --------------------------------------------------------
--
-- Structure de la table `user`
--
CREATE TABLE `user` (
  `Id` int(11) NOT NULL,
  `FirstName` varchar(40) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `BirthDate` date NOT NULL,
  `Address` varchar(250) NOT NULL,
  `City` varchar(40) NOT NULL,
  `ZipCode` char(5) NOT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `Phone` char(10) NOT NULL,
  `CreationTimestamp` datetime NOT NULL,
  `LastLoginTimestamp` datetime DEFAULT NULL,
  `Admin` tinyint(1) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8;
--
-- Déchargement des données de la table `user`
--
INSERT INTO `user` (
    `Id`,
    `FirstName`,
    `LastName`,
    `Email`,
    `Password`,
    `BirthDate`,
    `Address`,
    `City`,
    `ZipCode`,
    `Country`,
    `Phone`,
    `CreationTimestamp`,
    `LastLoginTimestamp`,
    `Admin`
  )
VALUES (
    1,
    'test',
    'test',
    'test',
    '$r$io1er$44137cfr45ge12he54fwtu67dLAPClL.zJfiF9/j7EBe1U68K',
    '1914-01-01',
    'test',
    'test',
    'test',
    'test',
    'test',
    '2020-06-13 07:06:51',
    NULL,
    0
  );
--
-- Index pour les tables déchargées
--
--
-- Index pour la table `booking`
--
ALTER TABLE `booking`
ADD PRIMARY KEY (`Id`),
  ADD KEY `User_Id` (`User_Id`);
--
-- Index pour la table `menu`
--
ALTER TABLE `menu`
ADD PRIMARY KEY (`Id`);
--
-- Index pour la table `staff`
--
ALTER TABLE `staff`
ADD PRIMARY KEY (`Id`);
--
-- Index pour la table `testimonial`
--
ALTER TABLE `testimonial`
ADD PRIMARY KEY (`Id`);
--
-- Index pour la table `user`
--
ALTER TABLE `user`
ADD PRIMARY KEY (`Id`),
  ADD UNIQUE KEY `Email` (`Email`);
--
-- AUTO_INCREMENT pour les tables déchargées
--
--
-- AUTO_INCREMENT pour la table `booking`
--
ALTER TABLE `booking`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 34;
--
-- AUTO_INCREMENT pour la table `menu`
--
ALTER TABLE `menu`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 27;
--
-- AUTO_INCREMENT pour la table `staff`
--
ALTER TABLE `staff`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 72;
--
-- AUTO_INCREMENT pour la table `testimonial`
--
ALTER TABLE `testimonial`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 54;
--
-- Contraintes pour les tables déchargées
--
--
-- Contraintes pour la table `booking`
--
ALTER TABLE `booking`
ADD CONSTRAINT `Booking_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `user` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;