<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../../DataBase/connexion.php");

if (!isset($_POST['NumRattrapage'])) {
    die("NumRattrapage N'est pas Indiqué.");
}

$NumRattrapage = $_POST['NumRattrapage'];
$MatProf = $_POST["MatProf"];
$DateRattrapage = $_POST["DateRattrapage"];
$Seance = $_POST["Seance"];
$Session = $_POST["Session"];
$Salle = $_POST["Salle"];
$Jour = $_POST["Jour"];
$CodeClasse = $_POST["CodeClasse"];
$CodeMatiere = $_POST["CodeMatiere"];
$Etat = $_POST["Etat"];

// Validate DateRattrapage format
if (!DateTime::createFromFormat('Y-m-d', $DateRattrapage)) {
    die("Invalid date format for DateRattrapage!");
}

try {

    $requete = "UPDATE `ratvol` 
                SET 
                `MatProf` = :MatProf, 
                `DateRat` = :DateRattrapage, 
                `Seance` = :Seance, 
                `Session` = :Session, 
                `Salle` = :Salle, 
                `Jour` = :Jour, 
                `CodeClasse` = :CodeClasse, 
                `CodeMatiere` = :CodeMatiere, 
                `Etat` = :Etat 
                WHERE `NumRatV` = :NumRatV";

    $stmt = $conn->prepare($requete);

    $data = [
        'NumRatV' => $NumRattrapage,
        'MatProf' => $MatProf,
        'DateRattrapage' => $DateRattrapage,
        'Seance' => $Seance,
        'Session' => $Session,
        'Salle' => $Salle,
        'Jour' => $Jour,
        'CodeClasse' => $CodeClasse,
        'CodeMatiere' => $CodeMatiere,
        'Etat' => $Etat
    ];

    $n = $stmt->execute($data);

    if (!$n) {
        print_r($stmt->errorInfo());
    } else {
        echo "Mise à jour réussie";
        header("location:afficher.php");
    }
} catch (PDOException $e) {
    die("Une erreur s'est produite lors de la mise à jour: " . $e->getMessage());   
}
?>
