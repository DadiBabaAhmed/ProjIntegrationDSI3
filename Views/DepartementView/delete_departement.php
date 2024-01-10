<?php
include "../../DataBase/Database.php";
include "../../Classes/Departement.php";

$db = new Database();
$departement = new Departement($db->getConnection());

try {
    if (isset($_GET["CodeDep"])) {
        $CodeDep = $_GET["CodeDep"];
        $departement->deleteDepartment($CodeDep);
        header("Location: list_departements.php");
        exit();
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["CodeDep"])) {
        // Si le formulaire est soumis et que le CodeDepartement est fourni, confirmer et effectuer la suppression
        $CodeDep = $_POST["CodeDep"];
        $departement->deleteDepartment($CodeDep);
        header("Location: list_departements.php");
        exit();
    }
} catch (Exception $e) {
    $errorCode = $e->getCode();

    echo '<div class="alert alert-danger" role="alert">';
    if ($errorCode == 1451) { // Code d'erreur MySQL pour violation de contrainte de clé étrangère
        echo "<h5>Erreur : Impossible de supprimer ce département car il est référencé par d'autres enregistrements.</h5>";
    } else {
        echo "<h5>Erreur : Une erreur inattendue s'est produite lors de la suppression du département.</h5>";
    }
    echo '</div>';
    // Ajouter un lien pour revenir à la liste des départements
    echo '<br><a class="btn btn-secondary" href="list_departements.php">Retourner à la liste</a>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Supprimer le département</title>
    <!-- Ajouter Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Supprimer le département</h2>
        <p>Êtes-vous sûr de vouloir supprimer ce département ?</p>

        <?php
        if (isset($_GET["CodeDep"])) {
            echo '<a class="btn btn-danger" href="delete_departement.php?CodeDep=' . $_GET["CodeDep"] . '">Confirmer la suppression</a>';
        } else {
            $departementList = $departement->getAllDepartments();
            // Si le CodeDepartement n'est pas fourni dans l'URL, afficher un formulaire pour saisir le CodeDepartement
            echo '<form method="POST" action="delete_departement.php">
                <label for="CodeDep">Code Département :</label>
                <select class="form-control" name="CodeDep" id="CodeDep">';
            foreach ($departementList as $dep) {
                echo '<option value="' . $dep["CodeDep"] . '">' . $dep["CodeDep"] . '</option>';
            }
            echo '</select>';
        ?>
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce département ?');">Confirmer la suppression</button>
            <a class="btn btn-secondary" href="list_departements.php">Annuler</a>
        <?php
            echo '</form>';
        }
        ?>
    </div>

    <!-- Ajouter Bootstrap JavaScript (Popper.js et Bootstrap JS) si nécessaire -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
