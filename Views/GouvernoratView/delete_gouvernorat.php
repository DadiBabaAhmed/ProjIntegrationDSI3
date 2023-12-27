<?php
include "../../DataBase/Database.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$Gouvernorat = new Gouvernorat($db->getConnection());

if (isset($_GET["Gouv"])) {
    $Gouv = $_GET["Gouv"];
    $Gouvernorat->delete($Gouv);
    header("Location: list_gouvernorats.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Gouv"])) {
    // If the form is submitted, and Gouv is provided, confirm and perform the delete
    $Gouv = $_POST["Gouv"];
    $Gouvernorat->delete($Gouv);
    header("Location: list_gouvernorats.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Gouvernorat</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Gouvernorat</h2>
        <p>Are you sure you want to delete this Gouvernorat?</p>

        <?php
        if (isset($_GET["Gouv"])) {
            echo '<a class="btn btn-danger" href="delete_gouvernorat.php?Gouv=' . $_GET["Gouv"] . '">Confirm Delete</a>';
        } else {
            // If Gouv is not provided in the URL, show a form to enter Gouv
            echo '<form method="POST" action="delete_gouvernorat.php">
                <input type="number" name="Gouv" placeholder="Enter Gouv">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_gouvernorats.php">Cancel</a>
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