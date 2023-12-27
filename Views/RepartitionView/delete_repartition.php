<?php
include "../../DataBase/Database.php";
include "../../Classes/Repartition.php";

$db = new Database();
$repartition = new Repartition($db->getConnection());

if (isset($_GET["Numdist"])) {
    $Numdist = $_GET["Numdist "];
    $repartition->delete($Numdist);
    header("Location: list_repartitions.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Numdist"])) {
    // If the form is submitted, and Matricule Prof is provided, confirm and perform the delete
    $Numdist = $_POST["Numdist"];
    $repartition->delete($Numdist);
    header("Location: list_repartitions.php");
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
        <h2>Delete Repartition</h2>
        <p>Are you sure you want to delete this repartition?</p>

        <?php
        if (isset($_GET["Numdist"])) {
            echo '<a class="btn btn-danger" href="delete_repartition.php?Numdist=' . $_GET["Numdist"] . '">Confirm Delete</a>';
        } else {
            // If Matricule Prof is not provided in the URL, show a form to enter Matricule Prof
            echo '<form method="POST" action="delete_repartition.php">
                <input type="text" name="Numdist" placeholder="Enter Numdist">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_repartitions.php">Cancel</a>
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