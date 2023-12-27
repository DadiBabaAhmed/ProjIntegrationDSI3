<?php
include "../../DataBase/Database.php";
include "../../Classes/Classe.php";

$db = new Database();
$classes = new Classe($db->getConnection());

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
            // If ID is not provided in the URL, show a form to enter ID
            echo '<form method="POST" action="delete_classe.php">
                <input type="text" name="id" placeholder="Enter Class ID">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_classes.php">Cancel</a>
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
