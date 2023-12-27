<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "../../DataBase/connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $sql = "INSERT INTO Inscriptions (CodeClasse, MatEtud, Session, DateInscription, DecisionConseil, Rachat, MoyGen, Dispense, TauxAbsences, Redouble, StOuv, StTech, TypeInscrip, MontantIns, Remarque, Sitfin, Montant, NoteSO, NoteST) 
            VALUES ('$codeClasse', '$matEtud', $session, '$dateInscription', '$decisionConseil', $rachate, $moyGen, $dispensee, $tauxAbsences, $redoublee, '$stOuv', '$stTech', '$typeInscrip', '$montantIns', '$remarque', '$sitfin', $montant, $noteSO, $noteST)";

    try {
        $conn->query($sql);
        echo "Données insérées avec succès dans la table 'Inscriptions'.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
    }
}

?>