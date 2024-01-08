<?php
include "../../DataBase/Database.php";
include "../../Classes/Prof.php";

$db = new Database();
$Prof = new Prof($db->getConnection());

try{
if (isset($_GET["Matricule"])) {
    // If Matricule Prof is provided in the URL, confirm and perform the delete
    $Matricule_Prof = $_GET["Matricule"];
    $Prof->delete($Matricule_Prof);
    header("Location: list_profs.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Matricule"])) {
    // If the form is submitted, and Matricule Prof is provided, confirm and perform the delete
    $Matricule_Prof = $_POST["Matricule"];
    $Prof->delete($Matricule_Prof);
    header("Location: list_profs.php");
    exit();
}
} catch (Exception $e) {
    echo "<h5>Error: " . $e->getMessage()."</h5>";
    // Add a link to go back to list_etudiants.php
    echo '<br><a class="btn btn-secondary" href="list_profs.php">Go back to list</a>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Etudiant</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Prof</h2>
        <p>Are you sure you want to delete this prof?</p>

        <?php
        if (isset($_GET["Matricule"])) {
            echo '<a class="btn btn-danger" href="delete_prof.php?Matricule=' . $_GET["Matricule"] . '">Confirm Delete</a>';
        } else {
            $ProfList = $Prof->getAllMatProf();
            // If Matricule Prof is not provided in the URL, show a form to enter Matricule Prof
            echo '<form method="POST" action="delete_prof.php">
                <label for="Matricule">Matricule Prof:</label>
                <select class="form-control" name="Matricule" id="Matricule">';
            foreach ($ProfList as $prof) {
                echo '<option value="' . $prof["Matricule"] . '">' . $prof["Nom"] . " " . $prof["Prenom"] . '</option>';
            }
            echo '</select>
                <button type="submit" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this Professeur?`);">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_profs.php">Cancel</a>
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