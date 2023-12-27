<?php
include "../../DataBase/Database.php";
include "../../Classes/Repartition.php";

$db = new Database();
$repartition = new Repartition($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch and sanitize form data
    // ... (Fetch all POST data and sanitize it)
    $numRep = $_POST["Numdist"];
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
    $repartition->update($numRep, $repartitionData);
    header("Location: list_repartitions.php");
    exit();
}
    if (isset($_GET["Numdist"])) {
        $matriculeRep = $_GET["Numdist"];
    
        $sql = "SELECT * FROM repartition WHERE `Numdist` = ?";
        $stmt = $db->getConnection()->prepare($sql);
        $stmt->bind_param("i", $matriculeRep);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows === 1) {
            $newData = $result->fetch_assoc();
        } else {
            echo "Repartition with Numdist: $matriculeRep not found.";
        }
        $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Repartition</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Repartition</h2>

        <form method="POST" action="edit_repartition.php">
        <input type="hidden" name="Numdist" value="<?php echo $matriculeRep; ?>">

            <div class="form-group">
                <label for="NumSes"></label>
                <input type="text" class="form-control" name="NumSes" id="NumSes" value="<?php echo $newData["NumSes"]; ?>">
            </div>

            <div class="form-group">
                <label for="NSemDeb"></label>
                <input type="text" class="form-control" name="NSemDeb" id="NSemDeb" value="<?php echo $newData["NSemDeb"]; ?>">
            </div>

            <div class="form-group">
                <label for="NSemFin"></label>
                <input type="text" class="form-control" name="NSemFin" id="NSemFin" value="<?php echo $newData["NSemFin"]; ?>">
            </div>

            <div class="form-group">
                <label for="TypeSeance"></label>
                <input type="text" class="form-control" name="TypeSeance" id="TypeSeance" value="<?php echo $newData["TypeSeance"]; ?>">
            </div>

            <div class="form-group">
                <label for="NbGrp"></label>
                <input type="text" class="form-control" name="NbGrp" id="NbGrp" value="<?php echo $newData["NbGrp"]; ?>">
            </div>

            <div class="form-group">
                <label for="NBHDT"></label>
                <input type="text" class="form-control" name="NBHDT" id="NBHDT" value="<?php echo $newData["NBHDT"]; ?>">
            </div>
            <div class="form-group">
                <label for="CodeClasse"></label>
                <input type="text" class="form-control" name="CodeClasse" id="CodeClasse" value="<?php echo $newData["CodeClasse"]; ?>">
            </div>

            <div class="form-group">
                <label for="CodeProf"></label>
                <input type="text" class="form-control" name="CodeProf" id="CodeProf" value="<?php echo $newData["CodeProf"]; ?>">
            </div>

            <div class="form-group">
                <label for="CodeMat"></label>
                <input type="text" class="form-control" name="CodeMat" id="CodeMat" value="<?php echo $newData["CodeMat"]; ?>">
            </div>

            <div class="form-group">
                <label for="NBHD"></label>
                <input type="text" class="form-control" name="NBHD" id="NBHD" value="<?php echo $newData["NBHD"]; ?>">
            </div>

            <div class="form-group">
                <label for="TypeGest"></label>
                <input type="text" class="form-control" name="TypeGest" id="TypeGest" value="<?php echo $newData["TypeGest"]; ?>">
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