<?php
include "../../DataBase/Database.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$Gouvernorat = new Gouvernorat($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $Gouv = $_POST["Gouv"];
    $CodePostal = $_POST["CodePostal"];
    $GouvernoratData = [
        "Gouv" => $_POST["Gouv"],
        "CodePostal" => $_POST["CodePostal"]
    ];
    $Gouvernorat->add($GouvernoratData);
    header("Location: list_Gouvernorats.php");
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

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Gouvernorat</h2>
                    </div>
                    <form action="add_Gouvernorat.php" method="post">
                        <div class="form-group">
                            <label>le nom de Gouvernorat</label>
                            <input type="text" name="Gouv" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>codepostal</label>
                            <input type="text" name="CodePostal" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Gouvernorat</button>
                        <a class="btn btn-secondary" href="list_Gouvernorats.php">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>