<?php
include "../../DataBase/Database.php";
include "../../Classes/Repartition.php";

$db = new Database();
$repartition = new Repartition($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch and sanitize form data
    // ... (Fetch all POST data and sanitize it)

    $repartitionData = [
        "NumSes" => $_POST["NumSes"],
        "NSemDeb" => $_POST["NSemDeb"],
        "NSemFin" => $_POST["NSemFin"],
        "TypeSeance" => $_POST["TypeSeance"],
        "NbGrp" => $_POST["NbGrp"],
        "NBHDT" => $_POST["NBHDT"],
        "CodeClasse" => $_POST["CodeClasse"],
        "CodeProf" => $_POST["CodeProf"],
        "CodeMat" => $_POST["CodeMat"],
        "NBHD" => $_POST["NBHD"],
        "TypeGest" => $_POST["TypeGest"],
    ];

    $added = $repartition->add($repartitionData);

    if ($added) {
        // Successfully added, redirect to a success page or perform further actions
        header("Location: list_repartitions.php");
        exit();
    } else {
        // Handle failure or show error message
        echo "Failed to add Repartition data!";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Repartition</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Add Repartition</h2>

        <form method="POST" action="add_repartition.php">

            <div class="form-group">
                <label for="NumSes">NumSes</label>
                <input type="text" class="form-control" name="NumSes" id="NumSes">
            </div>

            <div class="form-group">
                <label for="NSemDeb">NSemDeb</label>
                <input type="text" class="form-control" name="NSemDeb" id="NSemDeb">
            </div>

            <div class="form-group">
                <label for="NSemFin">NSemFin</label>
                <input type="text" class="form-control" name="NSemFin" id="NSemFin">
            </div>

            <div class="form-group">
                <label for="TypeSeance">TypeSeance</label>
                <input type="text" class="form-control" name="TypeSeance" id="TypeSeance">
            </div>

            <div class="form-group">
                <label for="NbGrp">NbGrp</label>
                <input type="text" class="form-control" name="NbGrp" id="NbGrp">
            </div>

            <div class="form-group">
                <label for="NBHDT">NBHDT</label>
                <input type="text" class="form-control" name="NBHDT" id="NBHDT">
            </div>

            <div class="form-group">
                <label for="CodeClasse">CodeClasse</label>
                <input type="text" class="form-control" name="CodeClasse" id="CodeClasse">
            </div>

            <div class="form-group">
                <label for="CodeProf">CodeProf</label>
                <input type="text" class="form-control" name="CodeProf" id="CodeProf">
            </div>

            <div class="form-group">
                <label for="CodeMat">CodeMat</label>
                <input type="text" class="form-control" name="CodeMat" id="CodeMat">
            </div>

            <div class="form-group">
                <label for="NBHD">NBHD</label>
                <input type="text" class="form-control" name="NBHD" id="NBHD">
            </div>

            <div class="form-group">
                <label for="TypeGest">TypeGest</label>
                <input type="text" class="form-control" name="TypeGest" id="TypeGest">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a class="btn btn-secondary" href="list_repartitions.php">Cancel</a>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>