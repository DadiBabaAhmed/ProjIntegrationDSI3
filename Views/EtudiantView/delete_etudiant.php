<?php
include "../../DataBase/Database.php";
include "../../Classes/Etudiant.php";

$db = new Database();
$etudiant = new Etudiant($db->getConnection());

try {
    if (isset($_GET["NCIN"])) {
        $ncin = $_GET["NCIN"];
        $etudiant->delete($ncin);
        header("Location: list_etudiants.php");
        exit();
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["NCIN"])) {
        $ncin = $_POST["NCIN"];
        $etudiant->delete($ncin);
        header("Location: list_etudiants.php");
        exit();
    }
} catch (Exception $e) {
    $errorCode = $e->getCode();

    echo '<div class="alert alert-danger" role="alert">';
    if ($errorCode === 23000 || $errorCode === 1452) {
        echo "<h5>Erreur : 1452 Erreur lors de la suppression de l'enregistrement : Impossible de supprimer ou de mettre à jour une ligne parente</h5>";
    } elseif ($errorCode === 1451) {
        echo "<h5>Erreur : 1451 Erreur lors de la suppression de l'enregistrement : Impossible de supprimer ou de mettre à jour une ligne parente : une contrainte de clé étrangère échoue</h5>";
    } elseif ($errorCode === 1217) {
        echo "<h5>Erreur : 1217 Erreur lors de la suppression de l'enregistrement : Impossible de supprimer ou de mettre à jour une ligne parente : échec de la vérification de contrainte de clé étrangère</h5>";
    } else {
        echo '<h5>Erreur : Une erreur inattendue s\'est produite lors de la suppression de l\'étudiant. Il est probable que ces données soient liées à d\'autres données.</h5>';
    }
    echo '</div>';
    // Ajouter un lien pour revenir à la liste des étudiants
    echo '<br><a class="btn btn-secondary" href="list_etudiants.php">Retourner à la liste</a>';
}
?>


 
<!DOCTYPE html>
<html>

<head>
    <title>Supprimer Etudiant</title>
    <!-- Ajouter Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Supprimer Etudiant</h2>
        <p>Êtes-vous sûr de vouloir supprimer cet étudiant ?</p>

        <?php
        if (isset($_GET["NCIN"])) {
            echo '<a class="btn btn-danger" href="delete_etudiant.php?NCIN=' . $_GET["NCIN"] . '">Confirmer la suppression</a>';
        } else {
            $etudiantList = $etudiant->getAllMatEtud2();
            // Si le NCIN n'est pas fourni dans l'URL, afficher un formulaire pour saisir le NCIN
            echo '<form method="POST" action="delete_etudiant.php">
                <label for="NCIN">NCIN :</label>
                <select class="form-control" name="NCIN" id="NCIN">';
            foreach ($etudiantList as $etud) {
                echo '<option value="' . $etud["NCIN"] . '">' . $etud["Nom"] . " " . $etud["Prénom"] . '</option>';
            }
            echo '</select>';
        ?>

                <button type="submit" class="btn btn-danger"
                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Confirmer la suppression</button>
                <a class="btn btn-secondary" href="list_etudiants.php">Annuler</a>
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
