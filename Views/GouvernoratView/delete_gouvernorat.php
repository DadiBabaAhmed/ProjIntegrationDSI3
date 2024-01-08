<?php
include "../../DataBase/Database.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$Gouvernorat = new Gouvernorat($db->getConnection());
try{
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
} catch (Exception $e) {
    echo "<h5>Error: " . $e->getMessage()."</h5>";
    // Add a link to go back to list_etudiants.php
    echo '<br><a class="btn btn-secondary" href="list_gouvernorats.php">Go back to list</a>';
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
            $gouvernoratList = $Gouvernorat->getGovernorats();
            // If Gouv is not provided in the URL, show a form to enter Gouv
            echo '<form method="POST" action="delete_gouvernorat.php">
                <label for="Gouv">Gouvernorat:</label>
                <select class="form-control" name="Gouv" id="Gouv">';
            foreach ($gouvernoratList as $gov) {
                echo '<option value="' . $gov["Gouv"] . '">' . $gov["Gouv"] . '</option>';
            }
            echo '</select>;
                <button type="submit" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this gouvernorat?`);">Confirm Delete</button>
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