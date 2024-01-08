<?php
include '../../DataBase/Database.php';
include '../../Classes/Jour.php';


$db = new Database();
$jour = new Jour($db->getConnection());

try{
if (isset($_GET["N°"])) {
    $N° = $_GET["N°"];
    $jour->delete($N°);
    header("Location: list_jours.php");
    exit();
} elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["N°"])) {
    // If the form is submitted, and N° is provN°ed, confirm and perform the delete
    $N° = $_POST["N°"];
    $jour->delete($N°);
    header("Location: list_jours.php");
    exit();
}
} catch (Exception $e) {
    echo "<h5>Error: " . $e->getMessage()."</h5>";
    // Add a link to go back to list_etudiants.php
    echo '<br><a class="btn btn-secondary" href="list_jours.php">Go back to list</a>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Jour</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Jour</h2>
        <p>Are you sure you want to delete this Jour?</p>

        <?php
        if (isset($_GET["N°"])) {
            echo '<a class="btn btn-danger" href="delete_jour.php?N°=' . $_GET["N°"] . '">Confirm Delete</a>';
        } else {
            $jourList = $jour->getJours();
            // If N° is not provN°ed in the URL, show a form to enter N°
            echo '<form method="POST" action="delete_jour.php">
                <label for="N°">Jour:</label>
                <select class="form-control" name="N°" id="N°">';
            foreach ($jourList as $j) {
                echo '<option value="' . $j["N°"] . '">' . $j["N°"] . '</option>';
            }
            echo '</select>
                <button type="submit" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this jour?`);">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_jours.php">Cancel</a>
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