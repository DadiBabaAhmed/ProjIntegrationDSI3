<?php
include "../../DataBase/Database.php";
include "../../Classes/Semaine.php";

$db = new Database();
$semaine = new Semaine($db->getConnection());

try {
    $semaineList = $semaine->getAllSemaines();
    if (isset($_GET["idSem"])) {
        $idSem = $_GET["idSem"];
        $semaine->delete($idSem);
        header("Location: list_semaines.php");
        exit();
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["idSem"])) {

        // If the form is submitted, and Matricule Prof is provided, confirm and perform the delete
        $idSem = $_POST["idSem"];
        $semaine->delete($idSem);
        header("Location: list_semaines.php");
        exit();
    }
} catch (Exception $e) {
    $errorCode = $e->getCode();

    if ($errorCode == 1451) { // Code d'erreur MySQL pour violation de contrainte de clé étrangère
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : Impossible de supprimer cette element car elle est référencée par d'autres enregistrements.</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="list_semaines.php">Go back to list</a>';
    } else {
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : Une erreur inattendue s'est produite lors de la suppression de l'element.</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="list_semaines.php">Go back to list</a>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Semaine</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Semaine</h2>
        <p>Are you sure you want to delete this Semaine?</p>

        <?php
        if (isset($_GET["idSem"])) {
            echo '<a class="btn btn-danger" href="delete_semaine.php?idSem=' . $_GET["idSem"] . '">Confirm Delete</a>';
        } else {
            // If Matricule Prof is not provided in the URL, show a form to enter Matricule Prof
            echo '<form method="POST" action="delete_semaine.php">
                <label for="idSem">idSem:</label>
                <select class="form-control" name="idSem" id="idSem">';
            foreach ($semaineList as $sem) {
                echo '<option value="' . $sem["idSem"] . '">' . $sem["NumSem"] . "_" . $sem["Session"] . '</option>';
            }
            echo '</select>
                <button type="submit" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this Semain?`);">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_semaines.php">Cancel</a>
            </form>';
        }
        ?>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>