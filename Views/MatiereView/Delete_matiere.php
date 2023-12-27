<?php
include "../../DataBase/Database.php";
include "../../Classes/Matieres.php";

// Create a database connection
$db = new Database();
$matieres = new Matieres($db->getConnection());

if (isset($_GET["Code_Matiere"])) {
    // If the Code_Matiere is provided in the URL, confirm and perform the delete
    $codeMatiere = $_GET["Code_Matiere"];
    $matieres->deleteMatiere($codeMatiere);
    header("Location: list_matieres.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Code_Matiere"])) {
    // If the form is submitted and the Code_Matiere is provided, confirm and perform the delete
    $codeMatiere = $_POST["Code_Matiere"];
    $matieres->deleteMatiere($codeMatiere);
    header("Location: list_matieres.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Matiere</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Matiere</h2>
        <p>Are you sure you want to delete this Matiere?</p>

        <?php
        if (isset($_GET["Code_Matiere"])) {
            echo '<a class="btn btn-danger" href="delete_matiere.php?Code_Matiere=' . $_GET["Code_Matiere"] . '">Confirm Delete</a>';
        } else {
            // If Code_Matiere is not provided in the URL, show a form to enter Code_Matiere
            echo '<form method="POST" action="delete_matiere.php">
                <input type="text" name="Code_Matiere" placeholder="Enter Code Matiere">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_matieres.php">Cancel</a>
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
