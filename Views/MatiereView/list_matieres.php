<?php
include "../../DataBase/Database.php";
include "../../Classes/Matieres.php";

$db = new Database();
$matieres = new Matieres($db->getConnection());

// Retrieve all matieres from the database
$matiereList = $matieres->getMatieres();
?>

<!DOCTYPE html>
<html>


<head>
    <title>List Matieres</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
    .container {
        margin: 70px 90px 90px 90px;
    }
</style>
</head>
<?php include '../inc/header.php'; ?>


<body>
    <div class="container">
        <h2>List Matieres</h2>
        <a href="add_matiere.php" class="btn btn-success">Add Matiere</a>
        <a href="filtere_matieres.php" class="btn btn-primary">filter</a>
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
                    /*$dateDeb = new DateTime($matiere["DateDeb"]);
                    $matiere["DateDeb"] = $dateDeb->format('Y-m-d');
                    $dateFin = new DateTime($matiere["DateFin"]);
                    $matiere["DateFin"] = $dateFin->format('Y-m-d');*/
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