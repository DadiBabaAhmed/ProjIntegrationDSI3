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
    echo "Erreur : " . $e->getMessage()." ". "<a href='affichage.php'>Retour</a>";
}

$conn = null;
?>
