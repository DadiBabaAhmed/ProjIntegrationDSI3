<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../../DataBase/connexion.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MatProf = $_POST["MatProf"];
    $DateRattrapage = $_POST["DateRattrapage"];
    $Seance = $_POST["Seance"];
    $Session = $_POST["Session"];
    $Salle = $_POST["Salle"];
    $Jour = $_POST["Jour"];
    $CodeClasse = $_POST["CodeClasse"];
    $CodeMatiere = $_POST["CodeMatiere"];
    $Etat = $_POST["Etat"];
    $NumRatV = $_POST["NumRattrapage"];

    // Validate DateRattrapage format
    if (!$DateRattrapage) {
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
            'MatProf' => $MatProf,
            'DateRattrapage' => $DateRattrapage,
            'Seance' => $Seance,
            'Session' => $Session,
            'Salle' => $Salle,
            'Jour' => $Jour,
            'CodeClasse' => $CodeClasse,
            'CodeMatiere' => $CodeMatiere,
            'Etat' => $Etat,
            'NumRatV' => $NumRatV
        ];

        $n = $stmt->execute($data);

        if (!$n) {
            print_r($stmt->errorInfo());
        } else {
            echo "Mise à jour réussie";
            header("location: afficher.php");
            exit(); // Terminate script execution after redirect
        }
    } catch (PDOException $e) {
        die("Une erreur s'est produite lors de la mise à jour: " . $e->getMessage());
    }
} else {
    die("Invalid request!");
}
?>
