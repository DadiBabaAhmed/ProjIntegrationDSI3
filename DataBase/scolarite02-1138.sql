-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2023 at 11:38 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scolarite02`
--

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `CodClasse` varchar(9) NOT NULL,
  `IntClasse` char(60) DEFAULT NULL,
  `Département` char(2) DEFAULT NULL,
  `Opti_on` char(55) DEFAULT NULL,
  `Niveau` char(12) DEFAULT NULL,
  `IntCalsseArabB` char(60) DEFAULT NULL,
  `OptionAaraB` char(55) DEFAULT NULL,
  `DepartementAaraB` char(55) DEFAULT NULL,
  `NiveauAaraB` char(10) DEFAULT NULL,
  `CodeEtape` varchar(8) DEFAULT NULL,
  `CodeSalima` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `Departement` char(55) NOT NULL,
  `Responsable` char(50) DEFAULT NULL,
  `MatProf` smallint(6) DEFAULT NULL,
  `DepartementARAB` char(55) DEFAULT NULL,
  `CodeDep` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`Departement`, `Responsable`, `MatProf`, `DepartementARAB`, `CodeDep`) VALUES
('Management', 'mounnir', 123, 'MAN', 'ME'),
('tech dinfo', 'mounir', 123, 'te9', 'TI');

-- --------------------------------------------------------

--
-- Table structure for table `dossieretud`
--

CREATE TABLE `dossieretud` (
  `Ndossier` int(11) NOT NULL,
  `Motif` varchar(50) DEFAULT NULL,
  `MatEtud` char(10) DEFAULT NULL,
  `TypePiece` int(11) DEFAULT NULL,
  `DatePiece` date DEFAULT NULL,
  `Session` int(11) DEFAULT NULL,
  `nomfichierpiece` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `etudiant`
--

CREATE TABLE `etudiant` (
  `Nom` varchar(25) DEFAULT '0',
  `DateNais` date DEFAULT NULL,
  `NCIN` varchar(10) NOT NULL,
  `NCE` varchar(15) NOT NULL,
  `TypBac` varchar(20) DEFAULT NULL,
  `Prénom` varchar(25) DEFAULT NULL,
  `Sexe` int(11) DEFAULT NULL,
  `LieuNais` varchar(60) DEFAULT NULL,
  `Adresse` varchar(100) DEFAULT NULL,
  `Ville` varchar(30) DEFAULT NULL,
  `CodePostal` smallint(6) DEFAULT NULL,
  `N°Tél` varchar(10) DEFAULT NULL,
  `CodClasse` varchar(9) DEFAULT NULL,
  `DécisionduConseil` varchar(12) DEFAULT NULL,
  `AnnéeUnversitaire` varchar(5) DEFAULT NULL,
  `Semestre` tinyint(4) DEFAULT NULL,
  `Dispenser` bit(1) NOT NULL,
  `Anneesopt` date DEFAULT NULL,
  `DatePremièreInscp` date DEFAULT NULL,
  `Gouvernorat` varchar(12) DEFAULT NULL,
  `Mention du Bac` varchar(12) DEFAULT NULL,
  `Nationalité` varchar(25) DEFAULT NULL,
  `CodeCNSS` varchar(3) DEFAULT NULL,
  `NomArabe` varchar(25) DEFAULT NULL,
  `PrenomArabe` varchar(25) DEFAULT NULL,
  `LieuNaisArabe` varchar(60) DEFAULT NULL,
  `AdresseArabe` varchar(100) DEFAULT NULL,
  `VilleArabe` varchar(30) DEFAULT NULL,
  `GouvernoratArabe` varchar(15) DEFAULT NULL,
  `TypeBacAB` varchar(15) DEFAULT NULL,
  `Photo` varchar(10) DEFAULT NULL,
  `Origine` varchar(20) DEFAULT NULL,
  `SituationDpart` varchar(25) DEFAULT NULL,
  `NBAC` varchar(12) DEFAULT NULL,
  `Redaut` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gouvernorats`
--

CREATE TABLE `gouvernorats` (
  `Gouv` varchar(20) NOT NULL,
  `CodePostal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `Grade` char(25) NOT NULL,
  `ChargeTP` double DEFAULT NULL,
  `ChargeC` double DEFAULT NULL,
  `ChargeTD` double DEFAULT NULL,
  `GradeArab` char(25) DEFAULT NULL,
  `ChargeCI` double DEFAULT NULL,
  `ChargeTotal` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`Grade`, `ChargeTP`, `ChargeC`, `ChargeTD`, `GradeArab`, `ChargeCI`, `ChargeTotal`) VALUES
('AZERTY', 334, 4444, 444, 'HHH', 222, 3334555),
('mouch_normal', 0, 0, 0, '0', 0, 0),
('test', 1, 1, 1, 'test', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inscriptions`
--

CREATE TABLE `inscriptions` (
  `CodeClasse` char(9) NOT NULL,
  `MatEtud` char(10) NOT NULL,
  `Session` int(11) NOT NULL,
  `DateInscription` datetime DEFAULT NULL,
  `DecisionConseil` char(12) DEFAULT '*****',
  `Rachat` tinyint(1) NOT NULL DEFAULT 0,
  `MoyGen` double DEFAULT NULL,
  `Dispense` tinyint(1) NOT NULL DEFAULT 0,
  `TauxAbsences` float DEFAULT NULL,
  `Redouble` tinyint(1) NOT NULL DEFAULT 0,
  `StOuv` varchar(20) DEFAULT NULL,
  `StTech` char(20) DEFAULT NULL,
  `TypeInscrip` char(7) DEFAULT 'NR',
  `MontantIns` char(13) DEFAULT NULL,
  `NumIns` int(11) NOT NULL,
  `Remarque` char(20) DEFAULT NULL,
  `Sitfin` char(20) DEFAULT NULL,
  `Montant` decimal(18,0) DEFAULT NULL,
  `NoteSO` double DEFAULT NULL,
  `NoteST` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `jours`
--

CREATE TABLE `jours` (
  `N°` int(11) NOT NULL,
  `Lundi` char(10) DEFAULT NULL,
  `Mardi` char(10) DEFAULT NULL,
  `Mercredi` char(10) DEFAULT NULL,
  `Jeudi` char(10) DEFAULT NULL,
  `Vendredi` char(10) DEFAULT NULL,
  `Samedi` char(10) DEFAULT NULL,
  `Code Prof` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jours`
--

INSERT INTO `jours` (`N°`, `Lundi`, `Mardi`, `Mercredi`, `Jeudi`, `Vendredi`, `Samedi`, `Code Prof`) VALUES
(1, '1', '1', '0', '1', '0', '1', NULL),
(2, '0', '1', '01', '1', '01', '01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `matieres`
--

CREATE TABLE `matieres` (
  `Code_Matiere` varchar(10) NOT NULL,
  `Nom_Matiere` varchar(50) DEFAULT NULL,
  `Coef_Matiere` float DEFAULT NULL,
  `Departement` varchar(55) DEFAULT NULL,
  `Semestre` varchar(12) DEFAULT NULL,
  `Options` varchar(55) DEFAULT NULL,
  `Nb_Heure_CI` double DEFAULT NULL,
  `Nb_Heure_TP` double DEFAULT NULL,
  `TypeLabo` varchar(13) DEFAULT NULL,
  `Bonus` double DEFAULT NULL,
  `Categories` varchar(35) DEFAULT NULL,
  `SousCategories` varchar(35) DEFAULT NULL,
  `DateDeb` datetime DEFAULT NULL,
  `DateFin` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `optionniveau`
--

CREATE TABLE `optionniveau` (
  `id` int(11) NOT NULL,
  `Option` char(55) NOT NULL,
  `Niveau` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `optionniveau`
--

INSERT INTO `optionniveau` (`id`, `Option`, `Niveau`) VALUES
(1, 'technologie informatique', '2'),
(2, 'DSI', '3'),
(14, 'electrique', '1');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `Code_Option` int(11) NOT NULL,
  `Option_Name` char(55) NOT NULL,
  `Departement` char(2) DEFAULT NULL,
  `Option_AraB` char(55) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `piece`
--

CREATE TABLE `piece` (
  `Typepiece` int(11) NOT NULL,
  `LibPiece` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `piece`
--

INSERT INTO `piece` (`Typepiece`, `LibPiece`) VALUES
(1, 'CIN'),
(2, 'Passport');

-- --------------------------------------------------------

--
-- Table structure for table `prof`
--

CREATE TABLE `prof` (
  `Matricule` smallint(6) NOT NULL,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `CIN` varchar(255) DEFAULT NULL,
  `Identifiant CNRPS` varchar(255) DEFAULT NULL,
  `Date de naissance` date DEFAULT NULL,
  `Nationalité` varchar(255) DEFAULT NULL,
  `Sexe (M/F)` char(1) DEFAULT NULL,
  `Date Ent Adm` date DEFAULT NULL,
  `Date Ent Etbs` date DEFAULT NULL,
  `Diplôme` varchar(255) DEFAULT NULL,
  `Adresse` varchar(255) DEFAULT NULL,
  `Ville` varchar(255) DEFAULT NULL,
  `Code postal` varchar(255) DEFAULT NULL,
  `N° Téléphone` varchar(255) DEFAULT NULL,
  `Grade` varchar(255) DEFAULT NULL,
  `Date de nomination dans le grade` date DEFAULT NULL,
  `Date de titulirisation` date DEFAULT NULL,
  `N° Poste` varchar(255) DEFAULT NULL,
  `Département` char(2) DEFAULT NULL,
  `Situation` varchar(255) DEFAULT NULL,
  `Spécialité` varchar(255) DEFAULT NULL,
  `N° de Compte` varchar(255) DEFAULT NULL,
  `Banque` varchar(255) DEFAULT NULL,
  `Agence` varchar(255) DEFAULT NULL,
  `Adr pendant les vacances` varchar(255) DEFAULT NULL,
  `Tél pendant les vacances` varchar(255) DEFAULT NULL,
  `Lieu de naissance` varchar(255) DEFAULT NULL,
  `Début du Contrat` date DEFAULT NULL,
  `Fin du Contrat` date DEFAULT NULL,
  `Type de Contrat` varchar(255) DEFAULT NULL,
  `NB contrat ISETSOUSSE` int(11) DEFAULT NULL,
  `NB contrat Autre Etb` int(11) DEFAULT NULL,
  `Bureau` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Email Interne` varchar(255) DEFAULT NULL,
  `NomArabe` varchar(255) DEFAULT NULL,
  `PrenomArabe` varchar(255) DEFAULT NULL,
  `LieuNaisArabe` varchar(255) DEFAULT NULL,
  `AdresseArabe` varchar(255) DEFAULT NULL,
  `VilleArabe` varchar(255) DEFAULT NULL,
  `Disponible` tinyint(1) DEFAULT NULL,
  `SousSP` varchar(255) DEFAULT NULL,
  `EtbOrigine` varchar(255) DEFAULT NULL,
  `TypeEnsg` varchar(255) DEFAULT NULL,
  `ControlAcces` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prof`
--

INSERT INTO `prof` (`Matricule`, `Nom`, `Prenom`, `CIN`, `Identifiant CNRPS`, `Date de naissance`, `Nationalité`, `Sexe (M/F)`, `Date Ent Adm`, `Date Ent Etbs`, `Diplôme`, `Adresse`, `Ville`, `Code postal`, `N° Téléphone`, `Grade`, `Date de nomination dans le grade`, `Date de titulirisation`, `N° Poste`, `Département`, `Situation`, `Spécialité`, `N° de Compte`, `Banque`, `Agence`, `Adr pendant les vacances`, `Tél pendant les vacances`, `Lieu de naissance`, `Début du Contrat`, `Fin du Contrat`, `Type de Contrat`, `NB contrat ISETSOUSSE`, `NB contrat Autre Etb`, `Bureau`, `Email`, `Email Interne`, `NomArabe`, `PrenomArabe`, `LieuNaisArabe`, `AdresseArabe`, `VilleArabe`, `Disponible`, `SousSP`, `EtbOrigine`, `TypeEnsg`, `ControlAcces`) VALUES
(123, 'mounir', 'mnayr', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(321, 'mounira', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mouch_normal', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(362, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'mouch_normal', NULL, NULL, NULL, 'TI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `profsituation`
--

CREATE TABLE `profsituation` (
  `CodeProf` smallint(6) NOT NULL,
  `Sess` int(11) NOT NULL,
  `Situation` varchar(35) DEFAULT NULL,
  `Grade` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ratvol`
--

CREATE TABLE `ratvol` (
  `NumRatV` int(11) NOT NULL,
  `MatProf` smallint(6) NOT NULL,
  `DateRat` datetime NOT NULL,
  `Seance` char(10) NOT NULL,
  `Session` int(11) NOT NULL,
  `Salle` char(10) NOT NULL,
  `Jour` char(10) NOT NULL,
  `CodeClasse` char(9) DEFAULT NULL,
  `CodeMatiere` varchar(10) DEFAULT NULL,
  `Etat` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `repartition`
--

CREATE TABLE `repartition` (
  `Numdist` int(11) NOT NULL,
  `NumSes` int(11) NOT NULL,
  `NSemDeb` int(11) NOT NULL,
  `NSemFin` int(11) NOT NULL,
  `TypeSeance` char(10) NOT NULL,
  `NbGrp` float NOT NULL,
  `NBHDT` float DEFAULT NULL,
  `CodeClasse` char(9) NOT NULL,
  `CodeProf` smallint(6) NOT NULL,
  `CodeMat` char(10) NOT NULL,
  `NBHD` float NOT NULL,
  `TypeGest` char(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE `salle` (
  `Salle` varchar(20) NOT NULL,
  `Departement` varchar(2) DEFAULT NULL,
  `Categorie` varchar(12) DEFAULT NULL,
  `Responsable` varchar(10) DEFAULT NULL,
  `Charge` tinyint(4) DEFAULT NULL,
  `Nb_place_examen` tinyint(4) DEFAULT NULL,
  `Nb_lignes` tinyint(4) DEFAULT NULL,
  `Nb_col` tinyint(4) DEFAULT NULL,
  `Nb_surv` smallint(6) DEFAULT NULL,
  `Type` varchar(25) DEFAULT NULL,
  `Disponible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`Salle`, `Departement`, `Categorie`, `Responsable`, `Charge`, `Nb_place_examen`, `Nb_lignes`, `Nb_col`, `Nb_surv`, `Type`, `Disponible`) VALUES
('G02', 'ME', 'TP', 'mounira', 30, 30, 10, 3, 2, 'cours', 0);

-- --------------------------------------------------------

--
-- Table structure for table `seances`
--

CREATE TABLE `seances` (
  `SEANCE` varchar(3) NOT NULL,
  `Horaire` varchar(13) DEFAULT NULL,
  `HDeb` varchar(10) DEFAULT NULL,
  `HFin` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `semaine`
--

CREATE TABLE `semaine` (
  `idSem` int(11) NOT NULL,
  `NumSem` int(11) NOT NULL,
  `DateDebut` datetime DEFAULT NULL,
  `DateFin` datetime DEFAULT NULL,
  `Session` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semaine`
--

INSERT INTO `semaine` (`idSem`, `NumSem`, `DateDebut`, `DateFin`, `Session`) VALUES
(6, 3, '2023-12-01 00:13:45', '2023-12-02 00:13:45', 101),
(7, 6, NULL, NULL, 100),
(9, 7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 100);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `Numero` int(11) NOT NULL,
  `Annee` char(5) NOT NULL,
  `Sem` char(1) NOT NULL,
  `SemAb` char(1) DEFAULT NULL,
  `Debut` date DEFAULT NULL,
  `Fin` date DEFAULT NULL,
  `Debsem` date DEFAULT NULL,
  `Finsem` date DEFAULT NULL,
  `Annea` char(5) DEFAULT NULL,
  `Anneab` char(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`Numero`, `Annee`, `Sem`, `SemAb`, `Debut`, `Fin`, `Debsem`, `Finsem`, `Annea`, `Anneab`) VALUES
(100, '2021', '1', '2', '2021-09-09', '2022-06-09', '2021-09-09', '2022-01-10', '2021', '2022'),
(101, '2022', '2', '1', '2021-09-09', '2022-09-09', '2022-01-17', '2022-09-09', '2021', '2022'),
(102, '2022', '1', '2', '2022-09-09', '2023-06-06', '2022-09-09', '2023-01-16', '2022', '2023'),
(103, '2023', '2', '1', '2022-09-09', '2023-06-09', '2023-01-17', '2023-06-09', '2022', '2023'),
(104, '2023', '1', '2', '2023-09-04', '2024-06-10', '2023-09-04', '2023-12-09', '2023', '2024');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CodClasse` (`CodClasse`) USING BTREE,
  ADD KEY `classe_fk` (`Département`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`CodeDep`),
  ADD KEY `MatProf` (`MatProf`);

--
-- Indexes for table `dossieretud`
--
ALTER TABLE `dossieretud`
  ADD PRIMARY KEY (`Ndossier`),
  ADD KEY `dossier_etud_fk_1` (`MatEtud`),
  ADD KEY `dossier_session_fk2` (`Session`),
  ADD KEY `dossier_piece_fk3` (`TypePiece`);

--
-- Indexes for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD PRIMARY KEY (`NCE`),
  ADD UNIQUE KEY `NCIN` (`NCIN`),
  ADD KEY `CodClasse` (`CodClasse`),
  ADD KEY `Gouvernorat` (`Gouvernorat`);

--
-- Indexes for table `gouvernorats`
--
ALTER TABLE `gouvernorats`
  ADD PRIMARY KEY (`Gouv`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`Grade`);

--
-- Indexes for table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD PRIMARY KEY (`NumIns`),
  ADD KEY `insc_classe_fk1` (`CodeClasse`),
  ADD KEY `insc_etud_fk2` (`MatEtud`),
  ADD KEY `insc_session_fk3` (`Session`);

--
-- Indexes for table `jours`
--
ALTER TABLE `jours`
  ADD PRIMARY KEY (`N°`),
  ADD KEY `Code Prof` (`Code Prof`);

--
-- Indexes for table `matieres`
--
ALTER TABLE `matieres`
  ADD PRIMARY KEY (`Code_Matiere`) USING BTREE,
  ADD KEY `matiere_dep_fk1` (`Departement`);

--
-- Indexes for table `optionniveau`
--
ALTER TABLE `optionniveau`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`Code_Option`),
  ADD KEY `Departement` (`Departement`);

--
-- Indexes for table `piece`
--
ALTER TABLE `piece`
  ADD PRIMARY KEY (`Typepiece`);

--
-- Indexes for table `prof`
--
ALTER TABLE `prof`
  ADD PRIMARY KEY (`Matricule`),
  ADD KEY `Grade` (`Grade`),
  ADD KEY `Département` (`Département`);

--
-- Indexes for table `profsituation`
--
ALTER TABLE `profsituation`
  ADD PRIMARY KEY (`CodeProf`),
  ADD KEY `Sess` (`Sess`),
  ADD KEY `profsituation_ibfk_3` (`Grade`);

--
-- Indexes for table `ratvol`
--
ALTER TABLE `ratvol`
  ADD PRIMARY KEY (`NumRatV`),
  ADD KEY `ratvol_session_fk1` (`Session`),
  ADD KEY `ratvol_prof_fk2` (`MatProf`),
  ADD KEY `ratvol_seance_fk3` (`Seance`),
  ADD KEY `ravol_classe_fk4` (`CodeClasse`),
  ADD KEY `ratvol_matieres_5` (`CodeMatiere`),
  ADD KEY `ratvol_salle_fk6` (`Salle`);

--
-- Indexes for table `repartition`
--
ALTER TABLE `repartition`
  ADD PRIMARY KEY (`Numdist`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
  ADD PRIMARY KEY (`Salle`),
  ADD KEY `Departement` (`Departement`);

--
-- Indexes for table `seances`
--
ALTER TABLE `seances`
  ADD PRIMARY KEY (`SEANCE`);

--
-- Indexes for table `semaine`
--
ALTER TABLE `semaine`
  ADD PRIMARY KEY (`idSem`),
  ADD UNIQUE KEY `NumSem` (`NumSem`),
  ADD KEY `Session` (`Session`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`Numero`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `dossieretud`
--
ALTER TABLE `dossieretud`
  MODIFY `Ndossier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `inscriptions`
--
ALTER TABLE `inscriptions`
  MODIFY `NumIns` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jours`
--
ALTER TABLE `jours`
  MODIFY `N°` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `optionniveau`
--
ALTER TABLE `optionniveau`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `piece`
--
ALTER TABLE `piece`
  MODIFY `Typepiece` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `prof`
--
ALTER TABLE `prof`
  MODIFY `Matricule` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32768;

--
-- AUTO_INCREMENT for table `ratvol`
--
ALTER TABLE `ratvol`
  MODIFY `NumRatV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `repartition`
--
ALTER TABLE `repartition`
  MODIFY `Numdist` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semaine`
--
ALTER TABLE `semaine`
  MODIFY `idSem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `Numero` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_fk` FOREIGN KEY (`Département`) REFERENCES `departements` (`CodeDep`);

--
-- Constraints for table `departements`
--
ALTER TABLE `departements`
  ADD CONSTRAINT `departements_ibfk_1` FOREIGN KEY (`MatProf`) REFERENCES `prof` (`Matricule`);

--
-- Constraints for table `dossieretud`
--
ALTER TABLE `dossieretud`
  ADD CONSTRAINT `dossier_etud_fk_1` FOREIGN KEY (`MatEtud`) REFERENCES `etudiant` (`NCE`),
  ADD CONSTRAINT `dossier_piece_fk3` FOREIGN KEY (`TypePiece`) REFERENCES `piece` (`Typepiece`),
  ADD CONSTRAINT `dossier_session_fk2` FOREIGN KEY (`Session`) REFERENCES `session` (`Numero`);

--
-- Constraints for table `etudiant`
--
ALTER TABLE `etudiant`
  ADD CONSTRAINT `CodClasse_constraint` FOREIGN KEY (`CodClasse`) REFERENCES `classe` (`CodClasse`),
  ADD CONSTRAINT `etudiant_ibfk_1` FOREIGN KEY (`Gouvernorat`) REFERENCES `gouvernorats` (`Gouv`);

--
-- Constraints for table `inscriptions`
--
ALTER TABLE `inscriptions`
  ADD CONSTRAINT `insc_classe_fk1` FOREIGN KEY (`CodeClasse`) REFERENCES `classe` (`CodClasse`),
  ADD CONSTRAINT `insc_etud_fk2` FOREIGN KEY (`MatEtud`) REFERENCES `etudiant` (`NCE`),
  ADD CONSTRAINT `insc_session_fk3` FOREIGN KEY (`Session`) REFERENCES `session` (`Numero`);

--
-- Constraints for table `jours`
--
ALTER TABLE `jours`
  ADD CONSTRAINT `jours_ibfk_1` FOREIGN KEY (`Code Prof`) REFERENCES `prof` (`Matricule`);

--
-- Constraints for table `matieres`
--
ALTER TABLE `matieres`
  ADD CONSTRAINT `matiere_dep_fk1` FOREIGN KEY (`Departement`) REFERENCES `departements` (`CodeDep`) ON UPDATE NO ACTION;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `option_fk1` FOREIGN KEY (`Departement`) REFERENCES `departements` (`CodeDep`);

--
-- Constraints for table `prof`
--
ALTER TABLE `prof`
  ADD CONSTRAINT `prof_department_fk2` FOREIGN KEY (`Département`) REFERENCES `departements` (`CodeDep`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `prof_grade_fk1` FOREIGN KEY (`Grade`) REFERENCES `grades` (`Grade`);

--
-- Constraints for table `profsituation`
--
ALTER TABLE `profsituation`
  ADD CONSTRAINT `profsitu_grade_fk3` FOREIGN KEY (`Grade`) REFERENCES `grades` (`Grade`),
  ADD CONSTRAINT `profsitu_prof_fk1` FOREIGN KEY (`CodeProf`) REFERENCES `prof` (`Matricule`),
  ADD CONSTRAINT `profsitu_session_fk2` FOREIGN KEY (`Sess`) REFERENCES `session` (`Numero`);

--
-- Constraints for table `ratvol`
--
ALTER TABLE `ratvol`
  ADD CONSTRAINT `ratvol_matieres_5` FOREIGN KEY (`CodeMatiere`) REFERENCES `matieres` (`Code_Matiere`),
  ADD CONSTRAINT `ratvol_prof_fk2` FOREIGN KEY (`MatProf`) REFERENCES `prof` (`Matricule`),
  ADD CONSTRAINT `ratvol_salle_fk6` FOREIGN KEY (`Salle`) REFERENCES `salle` (`Salle`),
  ADD CONSTRAINT `ratvol_seance_fk3` FOREIGN KEY (`Seance`) REFERENCES `seances` (`SEANCE`),
  ADD CONSTRAINT `ratvol_session_fk1` FOREIGN KEY (`Session`) REFERENCES `session` (`Numero`),
  ADD CONSTRAINT `ravol_classe_fk4` FOREIGN KEY (`CodeClasse`) REFERENCES `classe` (`CodClasse`);

--
-- Constraints for table `salle`
--
ALTER TABLE `salle`
  ADD CONSTRAINT `salle_ibfk_1` FOREIGN KEY (`Departement`) REFERENCES `departements` (`CodeDep`);

--
-- Constraints for table `semaine`
--
ALTER TABLE `semaine`
  ADD CONSTRAINT `semaine_ibfk_1` FOREIGN KEY (`Session`) REFERENCES `session` (`Numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
