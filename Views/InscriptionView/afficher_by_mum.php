<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "../../DataBase/connexion.php";

if (isset($_GET['NumIns'])) {
    $numInscription = $_GET['NumIns'];

    $sql = "SELECT * FROM Inscriptions WHERE NumIns = :numInscription";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':numInscription', $numInscription, PDO::PARAM_INT);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);


        if ($resultat) {
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/all.min.css">
</head>
<script src="src/js/all.min.js"></script>
<script src="src/js/bootstrap.bundle.js"></script>
<body>
<div class="container">
        <h3>Détails de l'inscription :</h3>
        <table class="table table-bordered">
            <?php
            echo '<tr><th> Numero d inscription :</th><td>' . $resultat['NumIns'] . '</td></tr>';
            echo '<tr><th>Code de Classe</th><td>' . $resultat['CodeClasse'] . '</td></tr>';
            echo '<tr><th>Matricule de l\'Étudiant</th><td>' . $resultat['MatEtud'] . '</td></tr>';
            echo '<tr><th>Session</th><td>' . $resultat['Session'] . '</td></tr>';
            echo '<tr><th>Date d\'Inscription</th><td>' . $resultat['DateInscription'] . '</td></tr>';
            echo '<tr><th>Decision du Conseil</th><td>' . $resultat['DecisionConseil'] . '</td></tr>';
            echo '<tr><th>Rachat</th><td>' . $resultat['Rachat'] . '</td></tr>';
            echo '<tr><th>Moyenne Générale</th><td>' . $resultat['MoyGen'] . '</td></tr>';
            echo '<tr><th>Dispense</th><td>' . $resultat['Dispense'] . '</td></tr>';
            echo '<tr><th>Taux d\'Absences</th><td>' . $resultat['TauxAbsences'] . '</td></tr>';
            echo '<tr><th>Redoublement</th><td>' . $resultat['Redouble'] . '</td></tr>';
            echo '<tr><th>StOuv</th><td>' . $resultat['StOuv'] . '</td></tr>';
            echo '<tr><th>StTech</th><td>' . $resultat['StTech'] . '</td></tr>';
            echo '<tr><th>Type d\'Inscription</th><td>' . $resultat['TypeInscrip'] . '</td></tr>';
            echo '<tr><th>Montant de l\'Inscription</th><td>' . $resultat['MontantIns'] . '</td></tr>';
            echo '<tr><th>Remarque</th><td>' . $resultat['Remarque'] . '</td></tr>';
            echo '<tr><th>Situation Financière</th><td>' . $resultat['Sitfin'] . '</td></tr>';
            echo '<tr><th>Montant</th><td>' . $resultat['Montant'] . '</td></tr>';
            echo '<tr><th>Note pour SO</th><td>' . $resultat['NoteSO'] . '</td></tr>';
            echo '<tr><th>Note pour ST</th><td>' . $resultat['NoteST'] . '</td></tr>';
            ?>
        </table>
    </div>
        <?php
        } else {
            echo "Aucune inscription trouvée pour ce numéro.";
        }
    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
} else {
    echo "Le paramètre NumIns n'a pas été spécifié dans l'URL.";
}


?>
    <div class="container center-buttons">
        <a href="afficher.php" class="btn btn-success">Retour </a> 
        <a href="afficher.php" class="btn btn-primary mx-3" >Afficher la liste des Inscriptions</a> 
        <a href="ajout.html" class="btn btn-success">Ajouter une inscription</a> 
    </div>
</body>
</html>
