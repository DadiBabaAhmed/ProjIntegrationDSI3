<?php
include "../../DataBase/Database.php";
include "../../Classes/Matieres.php";

// Create a database connection
$db = new Database();
$matieres = new Matieres($db->getConnection());

if (isset($_GET["Code_Matiere"]) || ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Code_Matiere"]))) {
    $codeMatiere = isset($_GET["Code_Matiere"]) ? $_GET["Code_Matiere"] : $_POST["Code_Matiere"];

    try {
        // Validate and sanitize the input (consider using prepared statements)
        $matieres->deleteMatiere($codeMatiere);
        header("Location: list_matieres.php?delete_success=1");
        exit();
    } catch (mysqli_sql_exception $e) {
        // Handle the exception here
        if ($e->getCode() == 1451) {
            echo "<div class='alert alert-danger'>Error: Cannot delete matiere - it is referenced in other data. Please remove related records first.</div>";
        } else {
            echo "<div class='alert alert-danger'>An error occurred: " . $e->getMessage() . "</div>";
        }
    }
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
            echo '<a class="btn btn-danger" href="delete_matiere.php?Code_Matiere=' . $_GET["Code_Matiere"] . '">Confirm Delete</a><a class="btn btn-secondary" href="list_matieres.php">Cancel</a>';
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