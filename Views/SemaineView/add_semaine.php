<?php
include "../../DataBase/Database.php";
include "../../Classes/Semaine.php";


$db = new Database();
$semaine = new Semaine($db->getConnection());

$sql = "SELECT Numero, Annee, Sem FROM `session` ORDER BY Annee DESC, Sem DESC";
$sessionList = $db->getConnection()->query($sql);
// Fetch the results from the query
$sessionList = $sessionList->fetch_all(MYSQLI_ASSOC);

//var_dump($sessionList);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $semaineData = [
        "NumSem" => $_POST["NumSem"],
        "DateDebut" => $_POST["DateDebut"],
        "DateFin" => $_POST["DateFin"],
        "Session" => $_POST["Session"]
    ];
    try {
        $semaine->add($semaineData);
        header("Location: list_semaines.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // 1062 is the error code for 'Duplicate entry'
            echo "<div class='alert alert-danger'>Error: semaine deja existe: changer NumSem.</div>";
        } 
        else {
            echo "<div class='alert alert-danger'>Error: An error occurred; Please try again later.</div>";
        }
    }
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
            <div>
                <label for="Session">Session:</label>
                <select class="form-control" name="Session" id="Session">
                        <?php foreach ($sessionList as $sess) { ?>
                            <option value="<?php echo $sess['Numero']; ?>"><?php echo $sess['Annee']."-".$sess['Sem']; ?></option>
                        <?php } ?>
                </select>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Add Semaine</button>
            <a class="btn btn-secondary" href="list_semaines.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>