<?php
 include "../../DataBase/connexion.php";

try {
    $nomfichierpiece = $_POST["nomfichierpiece"];
    $Motif = $_POST["Motif"];
        $id = $_GET["id"];
        $sql = "UPDATE DossierEtud SET Motif = '$Motif' WHERE Ndossier = '$id';";
        $conn->exec($sql);
    
    
    header('Location: affichage.php');
exit;  
} catch (PDOException $e) {
    echo '<div class="alert alert-danger" role="alert">';
    echo "<h5>Erreur : " . $e->getMessage() . "</h5>";
    echo '</div>';
    echo '<br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
}

$conn = null;
?>
