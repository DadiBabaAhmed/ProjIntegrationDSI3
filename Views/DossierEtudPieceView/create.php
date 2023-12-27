<?php
include "../../DataBase/Database.php";
include "../../DataBase/connexion.php";
include "../../Classes/Etudiant.php";


$db = new Database();
$Etudiant = new Etudiant($db->getConnection());


$result = $Etudiant->getAllMatEtud();

// SQL query to select data from the "Piece" table
$sql = "SELECT Typepiece,LibPiece FROM Piece";
$typep = $conn->query($sql);

$query = "SELECT Numero, Annee FROM Session";
$annsession = $conn->query($query);

?>



<!DOCTYPE html>
<html>

<head>
    <title>Créer un enregistrement</title>
</head>

<body>
    <h2>Créer un enregistrement</h2>
    <form action="enregistrer.php" method="post" enctype="multipart/form-data">
        <label for="Motif">Motif:</label>
        <input type="text" name="Motif" id="Motif"><br><br>
        <label for="MatEtud">Matricule Étudiant:</label>
        <select name="MatEtud" id="MatEtud">
            <?php
            foreach ($result as $row) {
                echo "<option value=" . $row['NCE'] . ">" . $row['NCE'] . "</option>";
            }
            ?>
        </select><br><br>
        <label for='TypePiece'>Type de Pièce:</label>
            <?php
            if ($typep->rowCount() > 0) {
                echo "<select name='TypePiece' id='TypePiece' >";
                while ($row = $typep->fetch()) {
                    echo "<option value=" . $row["Typepiece"] . ">" . $row["LibPiece"] . "</option>";
                }
                echo "</select> <br><br>";
            }

            ?>

            <label for="DatePiece">Date de Pièce:</label>
            <input type="date" name="DatePiece" id="DatePiece"><br><br>

            <label for="Session">Session :</label>
            <select name="Session" id="Session">
                <?php
                foreach ($annsession as $row) {
                    echo "<option value=" . $row['Numero'] . ">" . $row['Annee'] . "</option>";
                }
                ?>
            </select>
            <br><br>


            <label for="image">Sélectionnez une image à télécharger</label>
            <input type="file" class="form-control-file" id="image" name="image"><br><br>

            <input type="submit" value="Créer">
            <a href="affichage.php"><button type='button' name="annuler">annuler</button></a>
    </form>
</body>

</html>