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
    $rachat = $_POST["Rachat"] ? 1 : 0;
    $moyGen = $_POST["MoyGen"];
    $dispense = $_POST["Dispense"] ? 1 : 0;
    $tauxAbsences = $_POST["TauxAbsences"];
    $redouble = $_POST["Redouble"] ? 1 : 0;
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
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $codeClasse);
        $stmt->bindParam(2, $matEtud);
        $stmt->bindParam(3, $session);
        $stmt->bindParam(4, $dateInscription);
        $stmt->bindParam(5, $decisionConseil);
        $stmt->bindParam(6, $rachat, PDO::PARAM_INT);
        $stmt->bindParam(7, $moyGen);
        $stmt->bindParam(8, $dispense, PDO::PARAM_INT);
        $stmt->bindParam(9, $tauxAbsences);
        $stmt->bindParam(10, $redouble, PDO::PARAM_INT);
        $stmt->bindParam(11, $stOuv);
        $stmt->bindParam(12, $stTech);
        $stmt->bindParam(13, $typeInscrip);
        $stmt->bindParam(14, $montantIns);
        $stmt->bindParam(15, $remarque);
        $stmt->bindParam(16, $sitfin);
        $stmt->bindParam(17, $montant);
        $stmt->bindParam(18, $noteSO);
        $stmt->bindParam(19, $noteST);

        $stmt->execute();
        header("Location: afficher.php");
        echo "Données insérées avec succès dans la table 'Inscriptions'.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données : " . $e->getMessage();
        echo "<a href='ajouter.php'>Retour</a>";
    }
}
?>
