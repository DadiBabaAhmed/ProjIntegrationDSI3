<?php
include "../../DataBase/Database.php";
include "../../Classes/Classe.php";

$db = new Database();
$classes = new Classe($db->getConnection());

try {
    if (isset($_GET["id"])) {
        // Si l'identifiant de la classe est fourni dans l'URL, confirmer et effectuer la suppression
        $classId = $_GET["id"];
        $classes->deleteClass($classId);
        header("Location: list_classes.php");
        exit();
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["id"])) {
        // Si le formulaire est soumis et que l'identifiant de la classe est fourni, confirmer et effectuer la suppression
        $classId = $_POST["id"];
        $classes->deleteClass($classId);
        header("Location: list_classes.php");
        exit();
    }
} catch (Exception $e) {
    $errorCode = $e->getCode();

    if ($errorCode == 1451) { // Code d'erreur MySQL pour violation de contrainte de clé étrangère
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : Impossible de supprimer cette classe car elle est référencée par d'autres enregistrements.</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="list_classes.php">Retourner à la liste</a>';
    } else {
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : " . $e->getMessage() . "</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="list_classes.php">Retourner à la liste</a>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Supprimer la classe</title>
    <!-- Ajouter Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Supprimer la classe</h2>
        <p>Êtes-vous sûr de vouloir supprimer cette classe ?</p>

        <?php
        if (isset($_GET["id"])) {
            echo '<a class="btn btn-danger" href="delete_classe.php?id=' . $_GET["id"] . '">Confirmer la suppression</a>';
        } else {
            $classesList = $classes->getClasses();
            // Si l'identifiant n'est pas fourni dans l'URL, afficher un formulaire pour saisir l'identifiant
            echo '<form method="POST" action="delete_classe.php">
                <label for="id">Identifiant de la classe :</label>
                <select class="form-control" name="id" id="id">';
            foreach ($classesList as $classe) {
                echo '<option value="' . $classe["id"] . '">' . $classe["CodClasse"] . '</option>';
            }
            echo '</select>';
            ?>
            <button type="submit" class="btn btn-danger"
                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette classe ?');">Confirmer la suppression</button>
            <a class="btn btn-secondary" href="list_classes.php">Annuler</a>
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
