<?php
include "../../DataBase/Database.php";
include "../../Classes/Matieres.php";

$db = new Database();
$matieres = new Matieres($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form data to update a matiere
    // Retrieve and sanitize POST data
    // ...

    // Example validation and update (replace this with your validation and update process)
    $codeMatiere = $_POST["Code_Matiere"];
    $newData = [
        "Code_Matiere" => $_POST["Code_Matiere"],
        "Nom_Matiere" => $_POST["Nom_Matiere"],
        "Coef_Matiere" => $_POST["Coef_Matiere"],
        "Departement" => $_POST["Departement"],
        "Semestre" => $_POST["Semestre"],
        "Options" => $_POST["Options"],
        "Nb_Heure_CI" => $_POST["Nb_Heure_CI"],
        "Nb_Heure_TP" => $_POST["Nb_Heure_TP"],
        "TypeLabo" => $_POST["TypeLabo"],
        "Bonus" => $_POST["Bonus"],
        "Categories" => $_POST["Categories"],
        "SousCategories" => $_POST["SousCategories"],
        "DateDeb" => $_POST["DateDeb"],
        "DateFin" => $_POST["DateFin"],
        // Add more fields as necessary
    ];

    $matieres->updateMatiere($codeMatiere, $newData);
    header("Location: list_matieres.php");
    exit();
}

if (isset($_GET["Code_Matiere"])) {
    $codeMatiere = $_GET["Code_Matiere"];
    $matiere = $matieres->getMatiereByCode($codeMatiere);

    // Example HTML form for editing a matiere
    // You need to adjust this form to match your field names and structure
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Matiere</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Matiere</h2>
        <?php
        // Assuming $matiere is the retrieved matiere data from the database
        if (isset($matiere) && !empty($matiere)) {
        ?>
            <form method="POST" action="edit_matiere.php">
                <input type="hidden" name="Code_Matiere" value="<?php echo $matiere["Code_Matiere"]; ?>">

                <div class="form-group">
                    <label for="Nom_Matiere">Nom Matiere:</label>
                    <input type="text" class="form-control" name="Nom_Matiere" id="Nom_Matiere" value="<?php echo $matiere["Nom_Matiere"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Coef_Matiere">Coef Matiere:</label>
                    <input type="text" class="form-control" name="Coef_Matiere" id="Coef_Matiere" value="<?php echo $matiere["Coef_Matiere"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Departement">Departement:</label>
                    <input type="text" class="form-control" name="Departement" id="Departement" value="<?php echo $matiere["Departement"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Semestre">Semestre:</label>
                    <input type="text" class="form-control" name="Semestre" id="Semestre" value="<?php echo $matiere["Semestre"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Options">Options:</label>
                    <input type="text" class="form-control" name="Options" id="Options" value="<?php echo $matiere["Options"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Nb_Heure_CI">Nb Heure CI:</label>
                    <input type="text" class="form-control" name="Nb_Heure_CI" id="Nb_Heure_CI" value="<?php echo $matiere["Nb_Heure_CI"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Nb_Heure_TP">Nb Heure TP:</label>
                    <input type="text" class="form-control" name="Nb_Heure_TP" id="Nb_Heure_TP" value="<?php echo $matiere["Nb_Heure_TP"]; ?>">
                </div>

                <div class="form-group">
                    <label for="TypeLabo">Type Labo:</label>
                    <input type="text" class="form-control" name="TypeLabo" id="TypeLabo" value="<?php echo $matiere["TypeLabo"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Bonus">Bonus:</label>
                    <input type="text" class="form-control" name="Bonus" id="Bonus" value="<?php echo $matiere["Bonus"]; ?>">
                </div>

                <div class="form-group">
                    <label for="Categories">Categories:</label>
                    <input type="text" class="form-control" name="Categories" id="Categories" value="<?php echo $matiere["Categories"]; ?>">
                </div>

                <div class="form-group">
                    <label for="SousCategories">Sous Categories:</label>
                    <input type="text" class="form-control" name="SousCategories" id="SousCategories" value="<?php echo $matiere["SousCategories"]; ?>">
                </div>

                <div class="form-group">
                    <label for="DateDeb">Date Debut:</label>
                    <input type="text" class="form-control" name="DateDeb" id="DateDeb" value="<?php echo $matiere["DateDeb"]; ?>">
                </div>

                <div class="form-group">
                    <label for="DateFin">Date Fin:</label>
                    <input type="text" class="form-control" name="DateFin" id="DateFin" value="<?php echo $matiere["DateFin"]; ?>">
                </div>

                <!-- Add more fields as necessary -->

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-secondary" href="list_matieres.php">Cancel</a>
            </form>
        <?php
        } else {
            echo "Matiere not found.";
        }
        ?>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
}
?>
