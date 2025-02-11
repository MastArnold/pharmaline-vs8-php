-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 jan. 2024 à 20:14
-- Version du serveur : 10.4.25-MariaDB
-- Version de PHP : 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pharma8`
--

-- --------------------------------------------------------

--
-- Structure de la table `accesutilisateur`
--

CREATE TABLE `accesutilisateur` (
  `idAccesUtilisateur` int(11) NOT NULL,
  `idUtilisateur` varchar(100) NOT NULL,
  `caisse` tinyint(1) NOT NULL,
  `updateDateVente` tinyint(1) NOT NULL,
  `updateVente` tinyint(1) NOT NULL,
  `saveWaitingVente` tinyint(1) NOT NULL,
  `saveVente` tinyint(1) NOT NULL,
  `deleteVente` tinyint(1) NOT NULL,
  `updateCaissePrixVente` tinyint(1) NOT NULL,
  `maxRemise` int(11) NOT NULL,
  `deleteLineVente` tinyint(1) NOT NULL,
  `switchOperateur` tinyint(1) NOT NULL,
  `waitingVente` tinyint(1) NOT NULL,
  `invisibleWaitingVente` tinyint(1) NOT NULL,
  `deleteWaitingVente` tinyint(1) NOT NULL,
  `editWaitingVente` tinyint(1) NOT NULL,
  `listeVente` tinyint(1) NOT NULL,
  `filterListeVente` tinyint(1) NOT NULL,
  `printVente` tinyint(1) NOT NULL,
  `exportVente` tinyint(1) NOT NULL,
  `showBilanCaissier` tinyint(1) NOT NULL,
  `caVente` tinyint(1) NOT NULL,
  `caAchat` tinyint(1) NOT NULL,
  `client` tinyint(1) NOT NULL,
  `addClient` tinyint(1) NOT NULL,
  `modifyClient` tinyint(1) NOT NULL,
  `deleteClient` tinyint(1) NOT NULL,
  `openClientFollow` tinyint(1) NOT NULL,
  `produit` tinyint(1) NOT NULL,
  `modifyNomNcProduit` tinyint(1) NOT NULL,
  `modifyNomDciProduit` tinyint(1) NOT NULL,
  `modifyPrixAchatProduit` tinyint(1) NOT NULL,
  `modifyPrixVenteProduit` tinyint(1) NOT NULL,
  `modifyPeremptionProduit` tinyint(1) NOT NULL,
  `modifyTvaProduit` tinyint(1) NOT NULL,
  `modifyOrdonnanceProduit` tinyint(1) NOT NULL,
  `deleteProduit` tinyint(1) NOT NULL,
  `openStatProduit` tinyint(1) NOT NULL,
  `giveDetailProduit` tinyint(1) NOT NULL,
  `addProduit` tinyint(1) NOT NULL,
  `entree` tinyint(1) NOT NULL,
  `modifyEntree` tinyint(1) NOT NULL,
  `deleteEntree` tinyint(1) NOT NULL,
  `addEntree` tinyint(1) NOT NULL,
  `stockCorrection` tinyint(1) NOT NULL,
  `addStockCorrection` tinyint(1) NOT NULL,
  `deleteStockCorrection` tinyint(1) NOT NULL,
  `fournisseur` tinyint(1) NOT NULL,
  `addFournisseur` tinyint(1) NOT NULL,
  `modifyFournisseur` tinyint(1) NOT NULL,
  `deleteFournisseur` tinyint(1) NOT NULL,
  `exportFournisseur` tinyint(1) NOT NULL,
  `utilisateur` tinyint(1) NOT NULL,
  `addUtilisateur` tinyint(1) NOT NULL,
  `modifyUtilisateur` tinyint(1) NOT NULL,
  `modifyUserPassword` tinyint(1) NOT NULL,
  `modifyAccesUtilisateur` tinyint(1) NOT NULL,
  `deleteUtilisateur` tinyint(1) NOT NULL,
  `openFollowUtilisateur` tinyint(1) NOT NULL,
  `openConnectionHistory` tinyint(1) NOT NULL,
  `exportUtilisateur` tinyint(1) NOT NULL,
  `parametre` tinyint(1) NOT NULL,
  `magasin` tinyint(1) NOT NULL,
  `editFluxMagasin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Structure de la table `ajustementstock`
--

CREATE TABLE `ajustementstock` (
  `idAjustementStock` int(11) NOT NULL,
  `designationAjustementStock` varchar(100) NOT NULL,
  `dateAjustementStock` date NOT NULL,
  `idUtilisateur` varchar(100) NOT NULL,
  `statutAjustementStock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `ajustementstockitem`
--

CREATE TABLE `ajustementstockitem` (
  `idAjustementStockItem` int(11) NOT NULL,
  `designationAjustementStock` varchar(100) NOT NULL,
  `idProduit` varchar(255) NOT NULL,
  `ancienneQuantiteAjustementStockItem` int(11) NOT NULL,
  `quantiteAjustementStockItem` int(11) NOT NULL,
  `ancienneDatePeremptionAjustement` date DEFAULT NULL,
  `datePeremptionAjustement` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `appareilconnectee`
--

CREATE TABLE `appareilconnectee` (
  `adresseAppareil` varchar(300) NOT NULL,
  `positionAppareil` varchar(300) NOT NULL,
  `statutAppareil` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `approvisionnement`
--

CREATE TABLE `approvisionnement` (
  `idApprovisionnement` varchar(50) NOT NULL,
  `idFournisseur` varchar(100) NOT NULL,
  `totalTvaApprovisionnement` float NOT NULL,
  `totalHtApprovisionnement` int(11) NOT NULL,
  `totalTtcApprovisionnement` int(11) NOT NULL,
  `totalBicApprovisionnement` int(11) NOT NULL,
  `dateApprovisionnement` date NOT NULL,
  `statutApprovisionnement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `approvisionnementitem`
--

CREATE TABLE `approvisionnementitem` (
  `idApprovisionnementItem` int(11) NOT NULL,
  `idApprovisionnement` varchar(50) NOT NULL,
  `idProduit` varchar(255) NOT NULL,
  `tvaApprovisionnement` int(11) NOT NULL,
  `margeApprovisionnement` int(11) NOT NULL,
  `prixAchatHTApprovisionnement` int(11) NOT NULL,
  `quantiteApprovisionnement` int(11) NOT NULL,
  `quantiteUGApprovisionnement` int(11) NOT NULL,
  `datePeremptionApprovisionnement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `nomClient` varchar(200) NOT NULL,
  `telephoneClient` varchar(8) NOT NULL,
  `statutClient` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `connexionutilisateur`
--

CREATE TABLE `connexionutilisateur` (
  `idConnexion` int(11) NOT NULL,
  `idUtilisateur` varchar(100) NOT NULL,
  `dateConnexion` date NOT NULL,
  `heureConnexion` time NOT NULL,
  `dateDeconnexion` date NOT NULL,
  `heureDeconnexion` time NOT NULL,
  `statutConnexion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `fournisseur`
--

CREATE TABLE `fournisseur` (
  `idFournisseur` varchar(100) NOT NULL,
  `nomFournisseur` varchar(100) NOT NULL,
  `telephoneFournisseur` varchar(68) NOT NULL,
  `emailFournisseur` varchar(50) NOT NULL,
  `adresseFournisseur` varchar(150) NOT NULL,
  `statutFournisseur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `notification`
--

CREATE TABLE `notification` (
  `idNotification` int(11) NOT NULL,
  `idUtilisateur` varchar(100) NOT NULL,
  `messageNotification` varchar(300) NOT NULL,
  `typeNotification` varchar(26) NOT NULL,
  `marquageNotification` varchar(100) NOT NULL,
  `statutNotification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `ordonancier`
--

CREATE TABLE `ordonancier` (
  `idOrdonancier` varchar(50) NOT NULL,
  `nomOrdonancier` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `parametre`
--

CREATE TABLE `parametre` (
  `dateCourante` date NOT NULL,
  `estDeGarde` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `parametrenotification`
--

CREATE TABLE `parametrenotification` (
  `idParametreNotification` int(11) NOT NULL,
  `avertissementPeremption` mediumtext NOT NULL,
  `produitPerime` mediumtext NOT NULL,
  `produitModifie` mediumtext NOT NULL,
  `produitModifiePrix` mediumtext NOT NULL,
  `produitAjoute` mediumtext NOT NULL,
  `produitSupprime` mediumtext NOT NULL,
  `venteModifiee` mediumtext NOT NULL,
  `venteSupprimee` mediumtext NOT NULL,
  `clientAjoute` mediumtext NOT NULL,
  `clientInterdit` mediumtext NOT NULL,
  `parametreNotificationModifie` mediumtext NOT NULL,
  `nouvelleRectification` mediumtext NOT NULL,
  `nouveauFournisseur` mediumtext NOT NULL,
  `nouvelUtilisateur` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `parametresauvegarde`
--

CREATE TABLE `parametresauvegarde` (
  `idParametreSauvegarde` int(11) NOT NULL,
  `frequenceJourSauvegarde` int(11) NOT NULL,
  `heureSauvegarde` varchar(50) NOT NULL,
  `onExit` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `presenceutilisateur`
--

CREATE TABLE `presenceutilisateur` (
  `idPresenceUtilisateur` int(11) NOT NULL,
  `idUtilisateur` varchar(100) NOT NULL,
  `datePresenceUtilisateur` date NOT NULL,
  `heurePresenceUtilisateur` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `produit`
--

CREATE TABLE `produit` (
  `idProduit` varchar(255) NOT NULL,
  `nomNcProduit` varchar(255) NOT NULL,
  `nomDciProduit` varchar(255) NOT NULL,
  `categorieProduit` varchar(255) NOT NULL,
  `rayonProduit` varchar(100) NOT NULL,
  `prixVenteProduit` int(11) NOT NULL,
  `prixAchatProduit` int(11) NOT NULL,
  `stockProduit` int(11) NOT NULL,
  `limiteStockProduit` int(11) NOT NULL,
  `uniteParBoite` int(11) NOT NULL,
  `venteEnDetail` tinyint(1) NOT NULL,
  `tvaProduit` int(11) NOT NULL,
  `datePeremptionProduit` date NOT NULL,
  `sousOrdonnance` int(11) NOT NULL,
  `statutProduit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `produitcounter`
--

CREATE TABLE `produitcounter` (
  `counter` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `test`
--

CREATE TABLE `test` (
  `testId` int(11) NOT NULL,
  `testLabel` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `idUtilisateur` varchar(100) NOT NULL,
  `nomUtilisateur` varchar(300) NOT NULL,
  `prenomUtilisateur` varchar(300) NOT NULL,
  `telephoneUtilisateur` varchar(36) NOT NULL,
  `emailUtilisateur` varchar(150) NOT NULL,
  `motDePasseUtilisateur` varchar(100) NOT NULL,
  `privilegeUtilisateur` varchar(50) NOT NULL,
  `statutUtilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `vente`
--

CREATE TABLE `vente` (
  `idVente` int(11) NOT NULL,
  `idUtilisateur` varchar(100) NOT NULL,
  `idOperateur` varchar(100) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idOrdonnancier` varchar(50) NOT NULL,
  `totalVente` int(11) NOT NULL,
  `totalVenteHT` int(11) NOT NULL,
  `totalVenteTVA` int(11) NOT NULL,
  `modePaiementVente` varchar(50) NOT NULL,
  `dateVente` date NOT NULL,
  `heureVente` time NOT NULL,
  `statutVente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Structure de la table `ventedetail`
--

CREATE TABLE `ventedetail` (
  `idVenteDetail` int(11) NOT NULL,
  `idVente` int(11) NOT NULL,
  `idProduit` varchar(300) NOT NULL,
  `prixVenteDetail` int(11) NOT NULL,
  `quantiteVenteDetail` int(11) NOT NULL,
  `remiseVenteDetail` int(11) NOT NULL,
  `statutVenteDetail` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `accesutilisateur`
--
ALTER TABLE `accesutilisateur`
  ADD PRIMARY KEY (`idAccesUtilisateur`);

--
-- Index pour la table `ajustementstock`
--
ALTER TABLE `ajustementstock`
  ADD PRIMARY KEY (`idAjustementStock`);

--
-- Index pour la table `ajustementstockitem`
--
ALTER TABLE `ajustementstockitem`
  ADD PRIMARY KEY (`idAjustementStockItem`);

--
-- Index pour la table `appareilconnectee`
--
ALTER TABLE `appareilconnectee`
  ADD PRIMARY KEY (`adresseAppareil`);

--
-- Index pour la table `approvisionnement`
--
ALTER TABLE `approvisionnement`
  ADD PRIMARY KEY (`idApprovisionnement`);

--
-- Index pour la table `approvisionnementitem`
--
ALTER TABLE `approvisionnementitem`
  ADD PRIMARY KEY (`idApprovisionnementItem`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`);

--
-- Index pour la table `connexionutilisateur`
--
ALTER TABLE `connexionutilisateur`
  ADD PRIMARY KEY (`idConnexion`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`idFournisseur`);

--
-- Index pour la table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`idNotification`);

--
-- Index pour la table `ordonancier`
--
ALTER TABLE `ordonancier`
  ADD PRIMARY KEY (`idOrdonancier`);

--
-- Index pour la table `parametrenotification`
--
ALTER TABLE `parametrenotification`
  ADD PRIMARY KEY (`idParametreNotification`);

--
-- Index pour la table `parametresauvegarde`
--
ALTER TABLE `parametresauvegarde`
  ADD PRIMARY KEY (`idParametreSauvegarde`);

--
-- Index pour la table `presenceutilisateur`
--
ALTER TABLE `presenceutilisateur`
  ADD PRIMARY KEY (`idPresenceUtilisateur`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`idProduit`);

--
-- Index pour la table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`testId`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`idUtilisateur`);

--
-- Index pour la table `vente`
--
ALTER TABLE `vente`
  ADD PRIMARY KEY (`idVente`);

--
-- Index pour la table `ventedetail`
--
ALTER TABLE `ventedetail`
  ADD PRIMARY KEY (`idVenteDetail`);
