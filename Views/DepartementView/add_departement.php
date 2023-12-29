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
    try {
        $departement->addDepartment($depData);
        header("Location: list_departements.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // 1062 is the error code for 'Duplicate entry'
            echo "<div class='alert alert-danger'>Error: Departement deja existe: changer CodeDep.</div>";
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
    <title>Add Departement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2>Add Departement</h2>
        <form method="POST" action="add_departement.php">
            <div class="form-group">
                <label for="CodeDep">Code du Deperatment:</label>
                <input type="text" class="form-control" name="CodeDep" id="CodeDep" maxlength="2" minlength="2" placeholder="Exemple : TI, GM, ..." required>
            </div>
            <div class="form-group">
                <label for="Departement">Nom du Departement:</label>
                <input type="text" class="form-control" name="Departement" id="Departement" maxlength="55" placeholder="Nom du Departement..." required>
            </div>
            <div class="form-group">
                <label for="Responsable">Responsable:</label>
                <select class="form-control" name="Responsable" id="Responsable" required>
                    <option value="" selected disabled>Choisir un responsable</option>
                    <?php foreach ($profList as $prof) { ?>
                        <option value="<?php echo $prof['Nom'] ." " .$prof['Prenom']; ?>"><?php echo $prof['Nom'] ." " .$prof['Prenom']; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="DepartementARAB">Departement en ARAB:</label>
                <input type="text" class="form-control" name="DepartementARAB" maxlength="55" id="DepartementARAB" placeholder="exemple: تكنولوجيا الاعلامية ...">
            </div>
            <button type="submit" class="btn btn-primary">Add Departement</button>
            <a class="btn btn-secondary" href="list_departements.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
