<?php
include "../../DataBase/Database.php";
include "../../Classes/Repartition.php";

$db = new Database();
$repartition = new Repartition($db->getConnection());

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filter criteria and value from the form
    $critere = $_POST["critere"];
    $val = $_POST["val"];

    // Call the search function to get filtered repartitions
    $repList = $repartition->search($critere, $val);
} else {
    // If form is not submitted, get all repartitions
    $repList = $repartition->getAllRepartitions();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Repartition List</title>
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
    <div class="container">
        <h1>Repartition List</h1>
        <a href="list_repartitions.php" class="btn btn-success">Retour</a>
        <form method="POST" action="filtre_repartitions.php">
            <div class="form-group">
                <label for="critere">Filter by:</label>
                <select name="critere" id="critere" class="form-control">
                    <option value="NumSes" id="NumSes" >NumSes</option>
                    <option value="NSemDeb" id="NSemDeb">NSemDeb</option>
                    <option value="NSemFin" id="NSemFin">NSemFin</option>
                    <option value="TypeSeance" id="TypeSeance">TypeSeance</option>
                    <option value="CodeClasse" id="CodeClasse">CodeClasse</option>
                    <option value="CodeProf" id="CodeProf">CodeProf</option>
                    <option value="CodeMat" id="CodeMat">CodeMat</option>
                    <!-- Add more options for other criteria -->
                </select>
            </div>
            <div class="form-group">
                <label for="val">Value:</label>
                <input type="text" name="val" id="val" class="form-control">
                <script>
                    var critereSelect = document.getElementById("critere");
                    var valInput = document.getElementById("val");

                    critereSelect.addEventListener("change", function() {
                        if (critereSelect.value === "NumSes") {
                            valInput.type = "number";
                        } else if (critereSelect.value === "NSemDeb") {
                            valInput.type = "number";
                        } else if (critereSelect.value === "NSemFin") {
                            valInput.type = "number";
                        } else if (critereSelect.value === "TypeSeance") {
                            valInput.type = "text";
                        } else if (critereSelect.value === "CodeClasse") {
                            valInput.type = "text";
                        } else if (critereSelect.value === "CodeProf") {
                            valInput.type = "number";
                        } else if (critereSelect.value === "CodeMat") {
                            valInput.type = "text";
                        }
                    });
                </script>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <table>
            <tr>
                <th>NumSes</th>
                <th>NSemDeb</th>
                <th>NSemFin</th>
                <th>TypeSeance</th>
                <th>NbGrp</th>
                <th>NBHDT</th>
                <th>CodeClasse</th>
                <th>CodeProf</th>
                <th>CodeMat</th>
                <th>NBHD</th>
                <th>TypeGest</th>
            </tr>
            <?php foreach ($repList as $rep) { ?>
                <tr>
                    <td><?php echo $rep['NumSes']; ?></td>
                    <td><?php echo $rep['NSemDeb']; ?></td>
                    <td><?php echo $rep['NSemFin']; ?></td>
                    <td><?php echo $rep['TypeSeance']; ?></td>
                    <td><?php echo $rep['NbGrp']; ?></td>
                    <td><?php echo $rep['NBHDT']; ?></td>
                    <td><?php echo $rep['CodeClasse']; ?></td>
                    <td><?php echo $rep['CodeProf']; ?></td>
                    <td><?php echo $rep['CodeMat']; ?></td>
                    <td><?php echo $rep['NBHD']; ?></td>
                    <td><?php echo $rep['TypeGest']; ?></td>
                    <td>
                        <a href="edit_repartition.php?Numdist=<?php echo $rep['Numdist']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_repartition.php?Numdist=<?php echo $rep['Numdist']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
</body>

</html>