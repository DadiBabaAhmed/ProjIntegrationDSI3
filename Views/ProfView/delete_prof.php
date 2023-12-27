<?php
include "../../DataBase/Database.php";
include "../../Classes/Prof.php";

$db = new Database();
$Prof = new Prof($db->getConnection());

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
            // If Matricule Prof is not provided in the URL, show a form to enter Matricule Prof
            echo '<form method="POST" action="delete_prof.php">
                <input type="text" name="Matricule" placeholder="Enter Matricule Prof">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
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