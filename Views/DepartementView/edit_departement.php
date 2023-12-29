<?php
include "../../DataBase/Database.php";
include "../../Classes/Departement.php";
include "../../Classes/Prof.php";

$db = new Database();
$departement = new Departement($db->getConnection());
$prof = new Prof($db->getConnection());

$profList = $prof->getAllMatProf();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $CodeDep = $_POST["CodeDep"];
    foreach ($profList as $prof) {
        $nom = $prof['Nom'] ." " .$prof['Prenom'];
        if ($nom == $_POST["Responsable"]){
            $matprof=$prof['Matricule'];
        }
    }
    $departementData = [
        "CodeDep" => $_POST["CodeDep"],
        "Departement" => $_POST["Departement"],
        "Responsable" => $_POST["Responsable"],
        "MatProf" => $matprof,
        "DepartementARAB" => $_POST["DepartementARAB"]
    ];
    try {
        $departement->updateDepartment($CodeDep, $departementData);
        header("Location: list_departements.php");
        exit();
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}

if (isset($_GET["CodeDep"])) {
    $CodeDep = $_GET["CodeDep"];

    $departementData = $departement->getDepartments($CodeDep);
    if (!$departementData) {
        echo "departement with CodeDep: $CodeDep not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit departement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit departement</h2>
        <form method="POST" action="edit_departement.php">
            <input type="hidden" name="CodeDep" value="<?php echo $CodeDep; ?>">
            <div class="form-group">
                <label for="CodeDep">CodeDep:</label>
                <input type="text" class="form-control" name="CodeDep" id="CodeDep" value="<?php echo $departementData['CodeDep']; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="Departement">Departement:</label>
                <input type="text" class="form-control" name="Departement" id="Departement" value="<?php echo $departementData['Departement']; ?>">
            </div>
            <div class="form-group">
                <label for="Responsable">Responsable:</label>
                <select name="Responsable" class="form-control">
                    <?php foreach ($profList as $prof) :
                        if($departementData["Responsable"] == $prof['Nom'] ." " .$prof['Prenom']){ ?>
                            <option value="<?php echo $prof['Nom'] ." " .$prof['Prenom']; ?>" selected><?php echo $prof['Nom'] ." " .$prof['Prenom']; ?></option>
                        <?php }else{ ?>
                            <option value="<?php echo $prof['Nom'] ." " .$prof['Prenom']; ?>"><?php echo $prof['Nom'] ." " .$prof['Prenom']; ?></option>
                    <?php } 
                endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="DepartementARAB">DepartementARAB:</label>
                <input type="text" class="form-control" name="DepartementARAB" id="DepartementARAB" value="<?php echo $departementData['DepartementARAB']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a class="btn btn-secondary" href="list_departements.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>