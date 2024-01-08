<?php
include "../../DataBase/Database.php";
include "../../Classes/Classe.php";

$db = new Database();
$classes = new Classe($db->getConnection());
try {
if (isset($_GET["id"])) {
    // If the class ID is provided in the URL, confirm and perform the delete
    $classId = $_GET["id"];
    $classes->deleteClass($classId);
    header("Location: list_classes.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
    // If the form is submitted and the class ID is provided, confirm and perform the delete
    $classId = $_POST["id"];
    $classes->deleteClass($classId);
    header("Location: list_classes.php");
    exit();
}
} catch (Exception $e) {
    echo "<h5>Error: " . $e->getMessage()."</h5>";
    // Add a link to go back to list_etudiants.php
    echo '<br><a class="btn btn-secondary" href="list_classes.php">Go back to list</a>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Classe</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Classe</h2>
        <p>Are you sure you want to delete this Classe?</p>

        <?php
        if (isset($_GET["id"])) {
            echo '<a class="btn btn-danger" href="delete_classe.php?id=' . $_GET["id"] . '">Confirm Delete</a>';
        } else {
            $classesList = $classes->getClasses();
            // If ID is not provided in the URL, show a form to enter ID
            echo '<form method="POST" action="delete_classe.php">
                <label for="id">Class ID:</label>
                <select class="form-control" name="id" id="id">';
            foreach ($classesList as $classe) {
                echo '<option value="' . $classe["id"] . '">' . $classe["CodClasse"] . '</option>';
            }
            echo '</select>';
        ?>
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Classe?');">Confirm Delete</button>
            <a class="btn btn-secondary" href="list_classes.php">Cancel</a>
        <?php
            echo '</form>';
        }
        ?>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>