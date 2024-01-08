<?php
include '../../DataBase/Database.php';
include '../../Classes/ProfSituation.php';

$db = new Database();
$profsituation = new Profsituation($db->getConnection());

try{
    $profsituationList = $profsituation->getAllProfSituation();
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
}catch (Exception $e) {
    echo "<h5>Error: " . $e->getMessage()."</h5>";
    // Add a link to go back to list_etudiants.php
    echo '<br><a class="btn btn-secondary" href="list_profsituations.php">Go back to list</a>';
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
                <label for="CodeProf">CodeProf:</label>
                <select class="form-control" name="CodeProf" id="CodeProf">';
            foreach ($profsituationList as $prof) {
                echo '<option value="' . $prof["CodeProf"] . '">' . $prof["CodeProf"] . "_" . $prof["Sess"] . '</option>';
            }
            echo '</select>
                <button type="submit" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this ProfSituation?`);">Confirm Delete</button>
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