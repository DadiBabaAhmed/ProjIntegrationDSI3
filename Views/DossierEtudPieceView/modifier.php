<?php
 include "../../DataBase/connexion.php";

try {
    // SQL query to select data from the "DossierEtud" table
    $sql = "SELECT * FROM DossierEtud WHERE Ndossier = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_GET["Ndossier"]);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        ?>
        <form action="maj.php?id=<?php echo $result['Ndossier']; ?>" method="post">
               
            <label for="MatEtud">Matricule Étudiant:</label>
            <input type="text" disabled value="<?php echo $result['MatEtud']; ?>" name="MatEtud" id="MatEtud"><br><br>
    
            <label for="TypePiece">Type de Pièce:</label>
            <input type="text" disabled value="<?php echo $result['TypePiece']; ?>"><br><br>
    
            <label for="DatePiece">Date de Pièce:</label>
            <input type="text" disabled value="<?php echo $result['DatePiece']; ?>"><br><br>
    
            <label for="Session">Session:</label>
            <input type="text" disabled value="<?php echo $result['Session']; ?>"><br><br>
    
            <label for="nomfichierpiece">Nom du fichier pièce:</label>
            <input type="text" disabled value="<?php echo $result['nomfichierpiece']; ?>" name="nomfichierpiece" id="nomfichierpiece"><br><br>
    
            <label for="Motif">Motif:</label>
            <textarea name="Motif" id="Motif" ><?php echo $result['Motif']; ?> </textarea><br><br>

            <button type="submit" name="submit">Submit</button>
            <a href="affichage.php"><button type="button" name="annuler">annuler</button></a>
        </form>
        <?php
    } else {
        echo "Aucun enregistrement trouvé pour l'ID de dossier fourni.";
    }
    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;
?>
