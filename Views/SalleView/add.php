<?php
require('../../DataBase/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $salle = $_POST["salle"];
    $departement = $_POST["departement"];
    $categorie = $_POST["categorie"];
    $responsable = $_POST["responsable"];
    $charge = $_POST["charge"];
    $nb_place_examen = $_POST["nb_place_examen"];
    $nb_lignes = $_POST["nb_lignes"];
    $nb_col = $_POST["nb_col"];
    $nb_surv = $_POST["nb_surv"];
    $type = $_POST["type"];
    $disponible = $_POST["disponible"];
    $checkInsertion = "SELECT COUNT(*) AS count FROM Salle WHERE Salle = '$salle'";
    $result = $con->query($checkInsertion);
    $count = $result->fetch_assoc()['count'];

    if ($count > 0) {
        echo '<head> <style>.btn-primary { background-color: #007bff; border: 1px solid #007bff; color: #fff; } .btn-primary:hover { background-color: #0056b3; border: 1px solid #0056b3; color: #fff; }
        .alert-danger { background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; }
        </style></head>';
        echo '<div class="alert alert-danger" role="alert">Error: Salle existante</div>';
        echo '<a href="index.php" class="btn btn-primary" >Return</a>';
    } else {
        if ($salle && $departement && $categorie && $responsable && $charge && $nb_place_examen && $nb_lignes && $nb_col && $nb_surv && $type && $disponible) {
            $insertion = "INSERT INTO Salle (Salle, Departement, Categorie, Responsable, Charge, Nb_place_examen, Nb_lignes, Nb_col, Nb_surv, Type, Disponible) 
                          VALUES ('$salle', '$departement', '$categorie', '$responsable', $charge, $nb_place_examen, $nb_lignes, $nb_col, $nb_surv, '$type', '$disponible')";

            if ($con->query($insertion) === true) {
                echo "Data inserted";

                header('Location: view.php');
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>
        <h5>Error:Une erreur inattendue s'est produite lors de l'ajout de cette element.</h5>
        </div>
        <br><a class='btn btn-secondary' href='index.php'>Retourner à la liste</a>";
            }
        } else {
            echo "<div class='alert alert-danger' role='alert'>
            <h5>Error: Missing values</h5>
            </div>
            <br><a class='btn btn-secondary' href='index.php'>Retourner à la liste</a>";
        }
    }
}
