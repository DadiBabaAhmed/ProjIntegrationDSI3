<?php
include "../../DataBase/Database.php";
include "../../Classes/Matieres.php";

// Create a database connection
$db = new Database();
$matieres = new Matieres($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and process form data to add a new matiere
    // Retrieve and sanitize POST data
    $codeMatiere = $_POST['Code_Matiere'];
    $nomMatiere = $_POST['Nom_Matiere'];
    $coefMatiere = $_POST['Coef_Matiere'];
    $departement = $_POST['Departement'];
    $semestre = $_POST['Semestre'];
    $options = $_POST['Options'];
    $nbHeureCI = $_POST['Nb_Heure_CI'];
    $nbHeureTP = $_POST['Nb_Heure_TP'];
    $typeLabo = $_POST['TypeLabo'];
    $bonus = $_POST['Bonus'];
    $categories = $_POST['Categories'];
    $sousCategories = $_POST['SousCategories'];
    $dateDeb = $_POST['DateDeb'];
    $dateFin = $_POST['DateFin'];

    // Add the matiere to the database
    $matieres->addMatiere($codeMatiere, $nomMatiere, $coefMatiere, $departement, $semestre, $options, $nbHeureCI, $nbHeureTP, $typeLabo, $bonus, $categories, $sousCategories, $dateDeb, $dateFin);

    // Redirect to the matieres list page
    header("Location: list_matieres.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Matiere</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Add Matiere</h2>

        <form method="POST" action="add_matiere.php">
            <div class="form-group">
                <label for="Code_Matiere">Code Matiere:</label>
                <input type="text" class="form-control" name="Code_Matiere" id="Code_Matiere" required>
            </div>

            <div class="form-group">
                <label for="Nom_Matiere">Nom Matiere:</label>
                <input type="text" class="form-control" name="Nom_Matiere" id="Nom_Matiere" required>
            </div>


            <div class="form-group">
                <label for="Coef_Matiere">Coef Matiere:</label>
                <input type="text" class="form-control" name="Coef_Matiere" id="Coef_Matiere" required>

            </div>

            <div class="form-group">
                <label for="Departement">Departement:</label>
                <input type="text" class="form-control" name="Departement" id="Departement" required>
            </div>


            <div class="form-group">
                <label for="Semestre">Semestre:</label>
                <input type="text" class="form-control" name="Semestre" id="Semestre" required>
            </div>


            <div class="form-group">
                <label for="Options">Options:</label>
                <input type="text" class="form-control" name="Options" id="Options" required>
            </div>


            <div class="form-group">
                <label for="Nb_Heure_CI">Nb Heure CI:</label>
                <input type="text" class="form-control" name="Nb_Heure_CI" id="Nb_Heure_CI" required>
            </div>


            <div class="form-group">
                <label for="Nb_Heure_TP">Nb Heure TP:</label>
                <input type="text" class="form-control" name="Nb_Heure_TP" id="Nb_Heure_TP" required>

            </div>


            <div class="form-group">
                <label for="TypeLabo">TypeLabo:</label>
                <input type="text" class="form-control" name="TypeLabo" id="TypeLabo" required>

            </div>


            <div class="form-group">
                <label for="Bonus">Bonus:</label>
                <input type="text" class="form-control" name="Bonus" id="Bonus" required>

            </div>



            <div class="form-group">
                <label for="Categories">Categories:</label>
                <input type="text" class="form-control" name="Categories" id="Categories" required>
            </div>


            <div class="form-group">
                <label for="SousCategories">SousCategories:</label>
                <input type="text" class="form-control" name="SousCategories" id="SousCategories" required>
            </div>


            <div class="form-group">
                <label for="DateDeb">DateDeb:</label>
                <input type="text" class="form-control" name="DateDeb" id="DateDeb" required>
            </div>


            <div class="form-group">
                <label for="DateFin">DateFin:</label>
                <input type="text" class="form-control" name="DateFin" id="DateFin" required>

            </div>

            <button type="submit" class="btn btn-primary">Add Matiere</button>
            <a class="btn btn-secondary" href="list_matieres.php">Cancel</a>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>