<?php
include "../../DataBase/Database.php";
include "../../Classes/Repartition.php";
include "../../Classes/Prof.php";
include "../../Classes/Classe.php";
include "../../Classes/Matieres.php";

$db = new Database();
$conn = $db->getConnection();
$repartition = new Repartition($conn);
$prof = new Prof($conn);
$classe = new Classe($conn);
$matiere = new Matieres($conn);

$profList = $prof->getAllMatProf();
$classeList = $classe->getClasseNames();
$matiereList = $matiere->getMatieres();

$sql = "SELECT Numero FROM session";
$sessionList = $conn->query($sql);

$sql1 = "SELECT NumSem FROM semaine";
$semaineList = $conn->query($sql1);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch and sanitize form data
    // ... (Fetch all POST data and sanitize it)
    
    // Check if NSemDeb is inferior to NSemFin
    if ($_POST["NSemDeb"] < $_POST["NSemFin"]) {
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
            echo "<div class='alert alert-danger'>Failed to add Repartition data! </div>";
        }
    } else {
        // NSemDeb is not inferior to NSemFin, show error message
        echo "<div class='alert alert-danger'> NSemDeb should be inferior to NSemFin! </div>";
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
                <select name="NumSes" id="NumSes" class="form-control">
                    <?php
                    foreach ($sessionList as $row) { ?>
                        <option value="<?php echo $row['Numero'] ?>"><?php echo $row['Numero'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="NSemDeb">NSemDeb</label>
                <select name="NSemDeb" id="NSemDeb" class="form-control">
                    <?php
                    foreach ($semaineList as $row) { ?>
                        <option value="<?php echo $row['NumSem'] ?>"><?php echo $row['NumSem'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="NSemFin">NSemFin</label>
                <select name="NSemFin" id="NSemFin" class="form-control">
                    <?php
                    foreach ($semaineList as $row) { ?>
                        <option value="<?php echo $row['NumSem'] ?>"><?php echo $row['NumSem'] ?></option>
                    <?php } ?>
                </select>
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
                <select name="CodeClasse" id="CodeClasse" class="form-control">
                    <?php
                    foreach ($classeList as $row) { ?>
                        <option value="<?php echo $row['CodClasse'] ?>"><?php echo $row['CodClasse'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="CodeProf">CodeProf</label>
                <select name="CodeProf" id="CodeProf" class="form-control">
                    <?php
                    foreach ($profList as $row) { ?>
                        <option value="<?php echo $row['Matricule'] ?>"><?php echo $row['Matricule'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="CodeMat">CodeMat</label>
                <select name="CodeMat" id="CodeMat" class="form-control">
                    <?php
                    foreach ($matiereList as $row) { ?>
                        <option value="<?php echo $row['Code_Matiere'] ?>"><?php echo $row['Code_Matiere'] ?></option>
                    <?php } ?>
                </select>
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