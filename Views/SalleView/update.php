<?php 

require('../../DataBase/connect.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {

if (isset($_POST["update"])) {
    $newSalle = $_POST["newSalle"];
    $oldSalle= $_POST["oldSalle"];
    $newDepartement = $_POST["newDepartement"];
    $newCategorie = $_POST["newCategorie"];
    $newResponsable = $_POST["newResponsable"];
    $newType = $_POST["newType"];
    $newNbPlaceExamen = $_POST["newNbPlaceExamen"];
    $newNbLignes = $_POST["newNbLignes"];
    $newNbCol = $_POST["newNbCol"];
    $newNbSurv = $_POST["newNbSurv"];
    $newCharge =$_POST["newCharge"];
    $newDisponible = $_POST["newDisponible"];

    $update = "UPDATE Salle SET Salle = '$newSalle', Departement = '$newDepartement', Categorie = '$newCategorie', Responsable = '$newResponsable', Charge = $newCharge, Nb_place_examen = $newNbPlaceExamen, Nb_lignes = $newNbLignes, Nb_col = $newNbCol, Nb_surv = $newNbSurv, Type = '$newType', Disponible='$newDisponible' WHERE Salle = '$oldSalle'";
    if ($con->query($update) === true) {
        echo "Updated";
        header('Location: view.php');
            exit();
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        <h5>Error:Une erreur inattendue s'est produite lors de l'ajout de cette element.</h5>
        </div>
        <br><a class='btn btn-secondary' href='index.php'>Retourner à la liste</a>";
    }
}
}
?>