<?php
include "../../DataBase/Database.php";
include "../../DataBase/connexion.php";
include "../../Classes/Etudiant.php";


$db = new Database();
$Etudiant = new Etudiant($db->getConnection());


$result = $Etudiant->getAllMatEtud2();

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
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Créer un enregistrement</h2>
        <form action="enregistrer.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Motif">Motif:</label>
                <input type="text" class="form-control" name="Motif" id="Motif">
            </div>

            <div class="form-group">
                <label for="MatEtud">Matricule Étudiant:</label>
                <select class="form-control" name="MatEtud" id="MatEtud">
                    <?php
                    foreach ($result as $row) {
                        echo "<option value=" . $row['NCE'] . ">" . $row['Nom'] ." ". $row['Prénom']. "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for='TypePiece'>Type de Pièce:</label>
                <?php
                if ($typep->rowCount() > 0) {
                    echo "<select class='form-control' name='TypePiece' id='TypePiece'>";
                    while ($row = $typep->fetch()) {
                        echo "<option value=" . $row["Typepiece"] . ">" . $row["LibPiece"] . "</option>";
                    }
                    echo "</select>";
                }
                ?>
            </div>

            <div class="form-group">
                <label for="DatePiece">Date de Pièce:</label>
                <input type="date" class="form-control" name="DatePiece" id="DatePiece">
            </div>

            <div class="form-group">
                <label for="Session">Session :</label>
                <select class="form-control" name="Session" id="Session">
                    <?php
                    foreach ($annsession as $row) {
                        echo "<option value=" . $row['Numero'] . ">" . $row['Annee'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Sélectionnez une image à télécharger</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <div class="form-group">
                <label for="Motif">Motif:</label>
                <textarea class="form-control" name="Motif" id="Motif"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Créer">
                <a href="affichage.php"><button type='button' class="btn btn-secondary" name="annuler">annuler</button></a>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>