<?php
include "../../DataBase/Database.php";
include "../../Classes/Semaine.php";

$db = new Database();
$semaine = new Semaine($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $idSem = $_POST["idSem"];
    $semaineData = [
        "NumSem" => $_POST["NumSem"],
        "DateDebut" => $_POST["DateDebut"],
        "DateFin" => $_POST["DateFin"],
        "Session" => $_POST["Session"]
    ];
    try {
        $semaine->update($idSem, $semaineData);
        header("Location: list_semaines.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // 1062 is the error code for 'Duplicate entry'
            echo "<div class='alert alert-danger' role='alert'><h5>Error: semaine deja existe: changer NumSem.</h5></div>
            <br><a class='btn btn-secondary' href='list_semaines.php'>Retourner à la liste</a>";
        } 
        else {
            echo "<div class='alert alert-danger' role='alert'><h5>Error: An error occurred; Please try again later.</h5></div>
            <br><a class='btn btn-secondary' href='list_semaines.php'>Retourner à la liste</a>";
        }
}
}

if (isset($_GET["idSem"])) {
    $idSem = $_GET["idSem"];

    $semaineData = $semaine->getSemaine($idSem);
    if (!$semaineData) {
        echo "Semaine with NumSem: $idSem not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Semaine</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Semaine</h2>
        <form method="POST" action="edit_semaine.php">
            <input type="hidden" name="idSem" value="<?php echo $idSem; ?>">

            <div class="form-group">
                <label for="NumSem">NumSem:</label>
                <input type="text" class="form-control" name="NumSem" id="NumSem" value="<?php echo $semaineData['NumSem']; ?>">
            </div>
            <div class="form-group">
                <label for="DateDebut">DateDebut:</label>
                <input type="date" class="form-control" name="DateDebut" id="DateDebut" value="<?php echo $semaineData['DateDebut']; ?>">
            </div>
            <div class="form-group">
                <label for="DateFin">DateFin:</label>
                <input type="date" class="form-control" name="DateFin" id="DateFin" value="<?php echo $semaineData['DateFin']; ?>">
            </div>
            <div class="form-group">
                <label for="Session">Session:</label>
                <input type="text" class="form-control" name="Session" id="Session" value="<?php echo $semaineData['Session']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a class="btn btn-secondary" href="list_semaines.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>