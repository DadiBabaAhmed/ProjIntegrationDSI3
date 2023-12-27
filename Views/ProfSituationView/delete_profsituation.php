<?php
include '../../DataBase/Database.php';
include '../../Classes/ProfSituation.php';

$db = new Database();
$profsituation = new Profsituation($db->getConnection());

if (isset($_GET["CodeProf"])) {
    $CodeProf = $_GET["CodeProf"];
    $profsituation->delete($CodeProf);
    header("Location: list_profsituations.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["CodeProf"])) {
    // If the form is submitted, and CodeProf is provCodeProfed, confirm and perform the delete
    $CodeProf = $_POST["CodeProf"];
    $profsituation->delete($CodeProf);
    header("Location: list_profsituations.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete ProfSituation</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete ProfSituation</h2>
        <p>Are you sure you want to delete this ProfSituation?</p>

        <?php
        if (isset($_GET["CodeProf"])) {
            echo '<a class="btn btn-danger" href="delete_profsituation.php?CodeProf=' . $_GET["CodeProf"] . '">Confirm Delete</a>';
        } else {
            // If CodeProf is not provCodeProfed in the URL, show a form to enter CodeProf
            echo '<form method="POST" action="delete_profsituation.php">
                <input type="number" name="CodeProf" placeholder="Enter CodeProf">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_profsituations.php">Cancel</a>
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