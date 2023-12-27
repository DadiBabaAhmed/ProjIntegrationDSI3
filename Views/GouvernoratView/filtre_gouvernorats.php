<?php
include "../../DataBase/Database.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$Gouvernorat = new Gouvernorat($db->getConnection());
$filtredGouv=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $critere = $_POST["critere"];
    $val = $_POST["val"];
    $filtredGouv = $Gouvernorat->search($critere, $val);
}else {
    $filtredGouv = $Gouvernorat->getGovernorats();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chercher gouvernorat</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <form action="filtre_gouvernorats.php" method="post">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>Chercher le gouvernorat</h1>
                            <br>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="critere">critere :</label>
                            <select id="critere" name="critere">
                                <option id="Gouv" value="Gouv">gouv</option>
                                <option id="CodePostal" value="CodePostal">Code Postal</option>
                            </select>
                            <br><br>

                            <label for="val"> Valeur : </label>
                            <input type="text" name="val" id="val"><br><br>

                            <script>
                                var critereSelect = document.getElementById("critere");
                                var valInput = document.getElementById("val");

                                critereSelect.addEventListener("change", function() {
                                    if (critereSelect.value === "Gouv") {
                                        valInput.type = "text";
                                    } else if (critereSelect.value === "CodePostal") {
                                        valInput.type = "number";
                                    }
                                });
                            </script>
                        </div>

                        <a class="btn btn-secondary" href="list_Gouvernorats.php">return</a>
                        <input type="submit" class="btn btn-primary" name="submit" value="rechercher">
                        <table class="table table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Gouvernorat</th>
                                    <th>Code Postal</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($filtredGouv)) {
                                    foreach ($filtredGouv as $Gouvernorat) {
                                ?>
                                        <tr>
                                            <td><?php echo $Gouvernorat['Gouv']; ?></td>
                                            <td><?php echo $Gouvernorat['CodePostal']; ?></td>
                                            <td>
                                                <a href="edit_Gouvernorat.php?Gouv=<?php echo $Gouvernorat['Gouv']; ?>" class="btn btn-primary">Edit</a>
                                                <a href="delete_Gouvernorat.php?Gouv=<?php echo $Gouvernorat['Gouv']; ?>" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
    </form>

</body>

</html>