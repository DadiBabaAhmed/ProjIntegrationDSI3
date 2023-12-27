<?php
include '../../DataBase/Database.php';
include '../../Classes/Jour.php';
include '../../Classes/Prof.php';

$db= new Database();

$jour = new Jour($db->getConnection());
$prof = new Prof($db->getConnection());

$profList = $prof->getAllMatProf();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $N° = $_POST["N°"];
    $jData = [
        "N°" => $_POST["N°"],
        "Lundi" => $_POST["Lundi"],
        "Mardi" => $_POST["Mardi"],
        "Mercredi" => $_POST["Mercredi"],
        "Jeudi" => $_POST["Jeudi"],
        "Vendredi" => $_POST["Vendredi"],
        "Samedi" => $_POST["Samedi"],
        "Code Prof" => $_POST["Code_Prof"]
    ];
    $jour->update($N°, $jData);
    header("Location: list_jours.php");
    exit();
}

if (isset($_GET["N°"])) {
    $N° = $_GET["N°"];

    $jourData = $jour->getJour($N°);
    if (!$jourData) {
        echo "jour with N°: $N° not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Jour</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
<div class="container">
        <h2>Edit Jour</h2>
        <form method="POST" action="edit_jour.php">
        <input type="hidden" name="N°" value="<?php echo $N°; ?>">
            <div class="form-group">
                <label for="N°">N°:</label>
                <input type="text" class="form-control" id="N°" name="N°" value="<?php echo $jourData['N°']; ?>">
            </div>
            <div class="form-group">
                <label for="Lundi">Lundi:</label>
                <input type="text" class="form-control" id="Lundi" name="Lundi" value="<?php echo $jourData['Lundi']; ?>">
            </div>
            <div class="form-group">
                <label for="Mardi">Mardi:</label>
                <input type="text" class="form-control" id="Mardi" name="Mardi" value="<?php echo $jourData['Mardi']; ?>">
            </div>
            <div class="form-group">
                <label for="Mercredi">Mercredi:</label>
                <input type="text" class="form-control" id="Mercredi" name="Mercredi" value="<?php echo $jourData['Mercredi']; ?>">
            </div>
            <div class="form-group">
                <label for="Jeudi">Jeudi:</label>
                <input type="text" class="form-control" id="Jeudi" name="Jeudi" value="<?php echo $jourData['Jeudi']; ?>">
            </div>
            <div class="form-group">
                <label for="Vendredi">Vendredi:</label>
                <input type="text" class="form-control" id="Vendredi" name="Vendredi" value="<?php echo $jourData['Vendredi']; ?>">
            </div>
            <div class="form-group">
                <label for="Samedi">Samedi:</label>
                <input type="text" class="form-control" id="Samedi" name="Samedi" value="<?php echo $jourData['Samedi']; ?>">
            </div>
            <div class="form-group">
                <label for="Code_Prof">Code Prof:</label>
                <select name="Code_Prof" id="Code_Prof">
                    <?php foreach ($profList as $prof) {?>
                        <option value="<?php echo $prof['Matricule']; ?>" <?php if ($jourData['Code Prof'] === $prof['Matricule']) echo 'selected'; ?>>
                            <?php echo $prof['Nom'] ." " .$prof['Prenom']; ?>
                        </option>
                    <?php } ?> 
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-secondary" href="list_jours.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>