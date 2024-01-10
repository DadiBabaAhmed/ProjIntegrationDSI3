<?php
require('../../DataBase/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Salle"])) {
    try {
        $deleteSalle = $_GET["Salle"];
        $delete = $con->prepare("DELETE FROM Salle WHERE Salle = ?");
        $delete->bind_param("s", $deleteSalle);

        if ($delete->execute()) {
            echo "<div class='alert alert-success' role='alert'>";
            echo "<h5>The salle was deleted successfully</h5>";
            echo "</div><a href='index.php' class='btn btn-secondary'>Go back to list</a>";
        } else {
            echo '<div class="alert alert-danger" role="alert">';
            echo "<h5>Erreur : Une erreur inattendue s'est produite lors de la suppression de l'element.</h5>";
            echo '</div>';
            echo "<a href='index.php' class='btn btn-secondary'>Go back to list</a>";
        }

        $delete->close();
    } catch (Exception $e) {
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>An error occurred: " . $e->getMessage() . "</h5>";
        echo "<a href='index.php' class='btn btn-secondary'>Go back to list</a>";
    }
}
