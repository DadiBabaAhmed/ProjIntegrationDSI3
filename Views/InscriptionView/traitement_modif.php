<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "../../DataBase/connexion.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numins = $_POST["NumIns"];
    $codeClasse = $_POST["CodeClasse"];
    $matEtud = $_POST["MatEtud"];
    $session = $_POST["Session"];
    $dateInscription = $_POST["DateInscription"];
    $decisionConseil = $_POST["DecisionConseil"];
    $rachat =  $_POST["Rachat"];
    if ($rachat == '1') {
        $rachate = 1;
    } else {
        $rachate = 0;
    }
    $moyGen = $_POST["MoyGen"];
    $dispense = $_POST["Dispense"];
    if ($dispense == '1') {
        $dispensee = 1;
    } else {
        $dispensee = 0;
    }
    $tauxAbsences = $_POST["TauxAbsences"];
    $redouble = $_POST["Redouble"];
    if ($redouble == '1') {
        $redoublee = 1;
    } else {
        $redoublee = 0;
    }
    $stOuv = $_POST["StOuv"];
    $stTech = $_POST["StTech"];
    $typeInscrip = $_POST["TypeInscrip"];
    $montantIns = $_POST["MontantIns"];
    $remarque = $_POST["Remarque"];
    $sitfin = $_POST["Sitfin"];
    $montant = $_POST["Montant"];
    $noteSO = $_POST["NoteSO"];
    $noteST = $_POST["NoteST"];

    if (empty($errors)) {
        $sql_Update = "UPDATE Inscriptions 
                      SET CodeClasse = '$codeClasse', 
                          MatEtud = '$matEtud', 
                          Session = $session, 
                          DateInscription = '$dateInscription', 
                          DecisionConseil = '$decisionConseil', 
                          Rachat = $rachate, 
                          MoyGen = $moyGen, 
                          Dispense = $dispensee, 
                          TauxAbsences = $tauxAbsences, 
                          Redouble = $redoublee, 
                          StOuv = '$stOuv', 
                          StTech = '$stTech', 
                          TypeInscrip = '$typeInscrip', 
                          MontantIns = '$montantIns', 
                          Remarque = '$remarque', 
                          Sitfin = '$sitfin', 
                          Montant = $montant, 
                          NoteSO = $noteSO, 
                          NoteST = $noteST 
                      WHERE NumIns = $numins";

        try {
            $conn->exec($sql_Update);
            header("Location: afficher.php");
            exit();
        } catch (PDOException $e) {
            $errors[] = "Erreur lors de la mise à jour des données : " . $e->getMessage();
        }
    }

    // Store errors in session and redirect back to the form page
    $_SESSION['errors'] = $errors;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/all.min.css">
</head>
<body>
<div class="container center-buttons">
<?php if (!empty($errors)) : ?>
        <div class="container mt-5">
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Errors Encountered:</h4>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
    <div class="container center-buttons">
        <a href="afficher.php" class="btn btn-primary mx-3" >Afficher la liste des Inscriptions</a> 
    </div>
</body>
</html>