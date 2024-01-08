<?php
include '../../DataBase/Database.php';
include '../../Classes/Jour.php';


$db = new Database();
$jour = new Jour($db->getConnection());
$jourList = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $critere = $_POST["critere"];
    $val = $_POST["val"];
    $jourList = $jour->search($critere, $val);
}else {
    $jourList = $jour->getJours();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Jour List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <form action="filtre_jours.php" method="post">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>Chercher le Jour</h1>
                            <br>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="critere">critere :</label>
                            <select id="critere" name="critere">
                                <option id="N°" value="N°">N°</option>
                                <option id="Lundi" value="Lundi">Lundi</option>
                                <option id="Mardi" value="Mardi">Mardi</option>
                                <option id="Mercredi" value="Mercredi">Mercredi</option>
                                <option id="Jeudi" value="Jeudi">Jeudi</option>
                                <option id="Vendredi" value="Vendredi">Vendredi</option>
                                <option id="Samedi" value="Samedi">Samedi</option>
                                <option id="Code Prof" value="Code Prof">Code Prof</option>
                            </select>
                            <br><br>

                            <label for="critere"> Valeur : </label>
                            <input type="text" name="val" id="val"><br><br>

                            <script>
                                var critereSelect = document.getElementById("critere");
                                var valInput = document.getElementById("val");

                                critereSelect.addEventListener("change", function() {
                                    if (critereSelect.value === "N°" || critereSelect.value === "Code Prof") {
                                        valInput.type = "number";
                                    } else {
                                        valInput.type = "text";
                                    }
                                });
                            </script>
                        </div>

                        <a class="btn btn-secondary" href="list_jours.php">return</a>
                        <input type="submit" class="btn btn-primary" name="submit" value="rechercher">
                        <table>
                            <tr>
                                <th>Num Jour</th>
                                <th>Lundi</th>
                                <th>Mardi</th>
                                <th>Mercredi</th>
                                <th>Jeudi</th>
                                <th>Vendredi</th>
                                <th>Samedi</th>
                                <th>Code Prof</th>
                            </tr>
                            <?php
                            if (isset($jourList)) {
                                foreach ($jourList as $jour) { ?>
                                    <tr>
                                        <td><?php echo $jour['N°']; ?></td>
                                        <td><?php echo $jour['Lundi']; ?></td>
                                        <td><?php echo $jour['Mardi']; ?></td>
                                        <td><?php echo $jour['Mercredi']; ?></td>
                                        <td><?php echo $jour['Jeudi']; ?></td>
                                        <td><?php echo $jour['Vendredi']; ?></td>
                                        <td><?php echo $jour['Samedi']; ?></td>
                                        <td><?php echo $jour['Code Prof']; ?></td>
                                        <td>
                                            <a href="edit_jour.php?N°=<?php echo $jour['N°']; ?>" class="btn btn-primary">Edit</a>
                                            <a href="delete_jour.php?N°=<?php echo $jour['N°']; ?>" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this jour?`);">Delete</a>
                                        </td>
                                    </tr>
                            <?php }
                            } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>