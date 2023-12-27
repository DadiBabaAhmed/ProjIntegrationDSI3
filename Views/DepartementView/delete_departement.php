<?php
include "../../DataBase/Database.php";
include "../../Classes/Departement.php";

$db = new Database();
$departement = new Departement($db->getConnection());

if (isset($_GET["CodeDep"])) {
    $CodeDep = $_GET["CodeDep"];
    $departement->deleteDepartment($CodeDep);
    header("Location: list_departements.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["CodeDep"])) {
    // If the form is submitted, and Matricule Prof is provided, confirm and perform the delete
    $CodeDep = $_POST["CodeDep"];
    $departement->deleteDepartment($CodeDep);
    header("Location: list_departements.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Departement</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete departement</h2>
        <p>Are you sure you want to delete this departement?</p>

        <?php
        if (isset($_GET["CodeDep"])) {
            echo '<a class="btn btn-danger" href="delete_departement.php?CodeDep=' . $_GET["CodeDep"] . '">Confirm Delete</a>';
        } else {
            // If Matricule Prof is not provided in the URL, show a form to enter Matricule Prof
            echo '<form method="POST" action="delete_departement.php">
                <input type="number" name="CodeDep" placeholder="Enter CodeDep">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_departements.php">Cancel</a>
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