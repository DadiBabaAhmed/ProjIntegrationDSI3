<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../../DataBase/connexion.php");

if (isset($_GET['NumRatV'])) {
    $NumRattrapage = $_GET['NumRatV'];

    $sql = "DELETE FROM ratvol WHERE NumRatV = :numRatV";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numRatV', $NumRattrapage, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo '<div class="alert alert-success" role="alert">';
        echo "Record with NumRatV = $NumRattrapage deleted successfully";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
    } catch (PDOException $e) {
        $errorCode = $e->getCode();

        if ($errorCode == 1451) { // Code d'erreur MySQL pour violation de contrainte de clé étrangère
            echo '<div class="alert alert-danger" role="alert">';
            echo "<h5>Erreur : Impossible de supprimer cette element car elle est référencée par d'autres enregistrements.</h5>";
            echo '</div>';
            echo '<br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo "<h5>Erreur : Une erreur inattendue s'est produite lors de la suppression de l'element.</h5>";
            echo '</div>';
            echo '<br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
        }
    }
} else {
    echo '<div class="alert alert-danger" role="alert"><h5>NumRatV not provided!</h5></div>
    <br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
}
