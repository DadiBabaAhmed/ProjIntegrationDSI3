<?php
include "../../DataBase/Database.php";
include "../../Classes/Semaine.php";

$db = new Database();
$semaine = new Semaine($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $semaineData = [
        "NumSem" => $_POST["NumSem"],
        "DateDebut" => $_POST["DateDebut"],
        "DateFin" => $_POST["DateFin"],
        "Session" => $_POST["Session"]
    ];
    $semaine->add($semaineData);
    header("Location: list_semaines.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Semaine</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Semaine</h2>
        <form method="POST" action="add_semaine.php">
            <div class="form-group">
                <label for="NumSem">NumSem:</label>
                <input type="text" class="form-control" name="NumSem" id="NumSem">
            </div>
            <div class="form-group">
                <label for="DateDebut">DateDebut:</label>
                <input type="date" class="form-control" name="DateDebut" id="DateDebut">
            </div>
            <div class="form-group">
                <label for="DateFin">DateFin:</label>
                <input type="date" class="form-control" name="DateFin" id="DateFin">
            </div>
            <div class="form-group">
                <label for="Session">Session:</label>
                <input type="text" class="form-control" name="Session" id="Session">
            </div>
            <button type="submit" class="btn btn-primary">Add Semaine</button>
            <a class="btn btn-secondary" href="list_semaines.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
