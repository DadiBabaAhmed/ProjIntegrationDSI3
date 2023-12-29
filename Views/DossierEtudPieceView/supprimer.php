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
    echo "Erreur : " . $e->getMessage(). "<a href='affichage.php'>Retour</a>";
}

$conn = null;
?>
