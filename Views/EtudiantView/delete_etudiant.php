<?php
include "../../DataBase/Database.php";
include "../../Classes/Etudiant.php";

$db = new Database();
$etudiant = new Etudiant($db->getConnection());

if (isset($_GET["NCIN"])) {
    // If NCIN is provided in the URL, confirm and perform the delete
    $ncin = $_GET["NCIN"];
    $etudiant->delete($ncin);
    header("Location: list_etudiants.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["NCIN"])) {
    // If the form is submitted, and NCIN is provided, confirm and perform the delete
    $ncin = $_POST["NCIN"];
    $etudiant->delete($ncin);
    header("Location: list_etudiants.php");
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
        <h2>Delete Etudiant</h2>
        <p>Are you sure you want to delete this etudiant?</p>

        <?php
        if (isset($_GET["NCIN"])) {
            echo '<a class="btn btn-danger" href="delete_etudiant.php?NCIN=' . $_GET["NCIN"] . '">Confirm Delete</a>';
        } else {
            // If NCIN is not provided in the URL, show a form to enter NCIN
            echo '<form method="POST" action="delete_etudiant.php">
                <input type="text" name="NCIN" placeholder="Enter NCIN">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_etudiants.php">Cancel</a>
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

