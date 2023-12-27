<?php
include "../../DataBase/Database.php";
include "../../Classes/Departement.php";
include "../../Classes/Prof.php";

$db = new Database();
$departement = new Departement($db->getConnection());
$prof = new Prof($db->getConnection());

$profList = $prof->getAllMatProf();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    foreach ($profList as $prof) {
        $nom = $prof['Nom'] ." " .$prof['Prenom'];
        if ($nom == $_POST["Responsable"]){
            $matprof=$prof['Matricule'];
        }
    }

    $depData = [
        "Departement" => $_POST["Departement"],
        "Responsable" => $_POST["Responsable"],
        "MatProf" => $matprof,
        "DepartementARAB" => $_POST["DepartementARAB"],
        "CodeDep" => $_POST["CodeDep"],
    ];
    $departement->addDepartment($depData);
    header("Location: list_departements.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Departement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Departement</h2>
        <form method="POST" action="add_departement.php">
            <div class="form-group">
                <label for="CodeDep">CodeDep:</label>
                <input type="text" class="form-control" name="CodeDep" id="CodeDep" max="2">
            </div>
            <div class="form-group">
                <label for="Departement">Departement:</label>
                <input type="text" class="form-control" name="Departement" id="Departement">
            </div>
            <div class="form-group">
                <label for="Responsable">Responsable:</label>
                <select class="form-control" name="Responsable" id="Responsable">
                    <?php foreach ($profList as $prof) { ?>
                        <option value="<?php echo $prof['Nom'] ." " .$prof['Prenom']; ?>"><?php echo $prof['Nom'] ." " .$prof['Prenom']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="DepartementARAB">DepartementARAB:</label>
                <input type="text" class="form-control" name="DepartementARAB" id="DepartementARAB">
            </div>
            <button type="submit" class="btn btn-primary">Add Departement</button>
            <a class="btn btn-secondary" href="list_departements.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
