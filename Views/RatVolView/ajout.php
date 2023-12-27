<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../../DataBase/connexion.php");

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

// echo $NumRattrapage,$MatProf,$DateRattrapage,$Seance,$Session,$Salle,$Jour,$CodeClasse,$CodeMatiere,$Etat;

try {

    $requete = "INSERT INTO `ratvol`(`NumRatV`, `MatProf`, `DateRat`, `Seance`, `Session`, `Salle`, `Jour`, `CodeClasse`, `CodeMatiere`, `Etat`) 
                VALUES (:NumRattrapage, :MatProf, :DateRattrapage, :Seance, :Session, :Salle, :Jour, :CodeClasse, :CodeMatiere, :Etat)";

    $stmt = $conn->prepare($requete);

    $data = [
        'NumRattrapage' => $NumRattrapage,
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

    if ($n == 0) {
        echo "Insertion échoué";
        echo"<br>";
        echo"check ID";
    } else {
        echo "Ajout avec succès";
        header("location:afficher.php");

    }
} catch (PDOException $e) {
    die("Une erreur s'est produite lors de l'insertion: " . $e->getMessage());
    
}

?>
