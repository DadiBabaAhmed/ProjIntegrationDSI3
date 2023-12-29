<?php
include "../../DataBase/Database.php";
include "../../Classes/Matieres.php";

$db = new Database();
$matieres = new Matieres($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filter criteria and value from the form
    $critere = $_POST["critere"];
    $val = $_POST["val"];

    // Call the search function to get filtered matieres
    $matiereList = $matieres->search($critere, $val);
} else {
    // If form is not submitted, get all matieres
    $matiereList = $matieres->getMatieres();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>List Matieres</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>List Matieres</h2>
        <a href="list_matieres.php" class="btn btn-success">List Matiere</a>
        <form method="POST" action="filtere_matieres.php">
            <div class="form-group">
                <label for="critere">Filter by:</label>
                <select name="critere" id="critere" class="form-control">
                    <option value="Nom_Matiere" id="Nom_Matiere">Nom Matiere</option>
                    <option value="Coef_Matiere" id="Coef_Matiere">Coef Matiere</option>
                    <option value="Departement" id="Departement">Departement</option>
                    <option value="Semestre" id="Semestre">Semestre</option>
                    <option value="TypeLabo" id="TypeLabo">Type Labo</option>
                    <option value="Bonus" id="Bonus">Bonus</option>
                    <option value="Categories" id="Categories">Categories</option>
                    <option value="SousCategories" id="SousCategories">Sous Categories</option>
                    <option value="DateDeb" id="DateDeb">Date Debut</option>
                    <option value="DateFin" id="DateFin">Date Fin</option>
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
                        if (critereSelect.value === "Coef_Matiere" || critereSelect.value === "Nb_Heure_CI" || critereSelect.value === "Nb_Heure_TP") {
                            valInput.type = "number";
                        }else if(critereSelect.value === "DateDeb" || critereSelect.value === "DateFin"){
                            valInput.type = "date";
                        } else {
                            valInput.type = "text";
                        }
                    });
                </script>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <th>Code Matiere</th>
                    <th>Nom Matiere</th>
                    <th>Coef Matiere</th>
                    <th>Departement</th>
                    <th>Semestre</th>
                    <th>Options</th>
                    <th>Nb Heure CI</th>
                    <th>Nb Heure TP</th>
                    <th>Type Labo</th>
                    <th>Bonus</th>
                    <th>Categories</th>
                    <th>Sous Categories</th>
                    <th>Date Debut</th>
                    <th>Date Fin</th>
                    <!-- Add more table headers for additional fields -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming $matiereList is an array of matiere objects fetched from the database
                foreach ($matiereList as $matiere) {
                    echo '<tr>';
                    echo '<td>' . $matiere["Code_Matiere"] . '</td>';
                    echo '<td>' . $matiere["Nom_Matiere"] . '</td>';
                    echo '<td>' . $matiere["Coef_Matiere"] . '</td>';
                    echo '<td>' . $matiere["Departement"] . '</td>';
                    echo '<td>' . $matiere["Semestre"] . '</td>';
                    echo '<td>' . $matiere["Options"] . '</td>';
                    echo '<td>' . $matiere["Nb_Heure_CI"] . '</td>';
                    echo '<td>' . $matiere["Nb_Heure_TP"] . '</td>';
                    echo '<td>' . $matiere["TypeLabo"] . '</td>';
                    echo '<td>' . $matiere["Bonus"] . '</td>';
                    echo '<td>' . $matiere["Categories"] . '</td>';
                    echo '<td>' . $matiere["SousCategories"] . '</td>';
                    echo '<td>' . $matiere["DateDeb"] . '</td>';
                    echo '<td>' . $matiere["DateFin"] . '</td>';
                    // Add more <td> elements for additional fields

                    echo '<td>
                            <a href="edit_matiere.php?Code_Matiere=' . $matiere["Code_Matiere"] . '" class="btn btn-primary">Edit</a>
                            <a href="delete_matiere.php?Code_Matiere=' . $matiere["Code_Matiere"] . '" class="btn btn-danger">Delete</a>
                          </td>';

                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
