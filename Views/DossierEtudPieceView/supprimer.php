<?php
include "../../DataBase/connexion.php";

try {

    // Récupération des données du formulaire
    $Ndossier = $_GET['Ndossier'];


    // Requête SQL pour insérer les données dans la table DossierEtud
    $sql = "delete from DossierEtud where Ndossier=$Ndossier ";
    $image_path = "./uploads/" . $_GET['nom'];
    unlink($image_path);
    $conn->exec($sql);
    header('Location: affichage.php');
    exit;  
} catch(PDOException $e) {
    $errorCode = $e->getCode();

    if ($errorCode == 1451) { // Code d'erreur MySQL pour violation de contrainte de clé étrangère
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : Impossible de supprimer cette element car elle est référencée par d'autres enregistrements.</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
    } else {
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : " . $e->getMessage() . "</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
    }
}

$conn = null;
?>
