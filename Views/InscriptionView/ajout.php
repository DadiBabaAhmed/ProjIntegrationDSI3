<?php
include "../../DataBase/Database.php";
include "../../Classes/Etudiant.php";
include "../../Classes/Classe.php";

$db = new Database();
$etudiant = new Etudiant($db->getConnection());
$classe = new Classe($db->getConnection());

$listclasses = $classe->getClasseNames();
$listEtudiant = $etudiant->getAllMatEtud();

$sql = "SELECT Numero, Annee FROM Session";
$result = $db->getConnection()->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Inscription</title>
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/all.min.css">
    <!--<link rel="stylesheet" href="src/css/style.css">-->
</head>
<script src="src/js/all.min.js"></script>
<script src="src/js/bootstrap.bundle.js"></script>

<body>
    <div class="container mt-5 bg-dark">

        <h1 class="mb-4 text-danger">Ajouter une Inscription</h1>
        <form action="traitement_ajout.php" method="post" onsubmit="">

            <label for="CodeClasse" class="form-label text-primary">Code de la Classe :</label>
            <select name="CodeClasse" id="CodeClasse">
                <?php
                foreach ($listclasses as $row) { ?>
                    <option value="<?php echo $row['CodClasse'] ?>"><?php echo $row['CodClasse'] ?></option>";
                <?php } ?>
            </select>
            <div>
                <label for="MatEtud" class="form-label text-primary">Matricule de l'Étudiant :</label>
                <select name="MatEtud" id="MatEtud">
                    <?php
                    foreach ($listEtudiant as $row) { ?>
                        <option value="<?php echo $row['NCE'] ?>"><?php echo $row['NCE'] ?></option>";
                    <?php } ?>
                </select>
            </div>
            <div>
                <label for="Session" class="form-label text-primary">Session :</label>
                <select name="Session" id="Session">
                    <?php
                    foreach ($result as $row) { ?>
                        <option value="<?php echo $row['Numero'] ?>"><?php echo $row['Annee'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <label for="DateInscription" class="form-label text-primary">Date d'Inscription :</label>
            <input type="date" id="DateInscription" name="DateInscription" class="form-control" placeholder="Sélectionnez la date d'inscription">

            <label for="DecisionConseil" class="form-label text-primary">Decision du Conseil :</label>
            <input type="text" id="DecisionConseil" name="DecisionConseil" class="form-control" placeholder="Entrez la décision du conseil">

            <label class="form-check-label text-primary">Rachat :</label>
            <br>
            <label for="Oui_Rachat" class="form-check-label text-light">Oui</label>
            <input type="radio" id="Oui_Rachat" name="Rachat" value="1" class="form-check-input">
            <label for="Non_Rachat" class="form-check-label text-light">Non</label>
            <input type="radio" id="Non_Rachat" name="Rachat" value="0" class="form-check-input" checked>
            <br>

            <label for="MoyGen" class="form-label text-primary">Moyenne Générale :</label>
            <input type="number" step="0.01" id="MoyGen" name="MoyGen" class="form-control" placeholder="Entrez la moyenne générale">

            <label class="form-check-label text-primary">Dispense :</label>
            <br>
            <label for="Oui_Dispense" class="form-check-label text-light">Oui</label>
            <input type="radio" id="Oui_Dispense" name="Dispense" value="1" class="form-check-input">
            <label for="Non_Dispense" class="form-check-label text-light">Non</label>
            <input type="radio" id="Non_Dispense" name="Dispense" value="0" class="form-check-input" checked>
            <br>

            <label for="TauxAbsences" class="form-label text-primary">Taux d'Absences :</label>
            <input type="number" step="0.01" id="TauxAbsences" name="TauxAbsences" class="form-control" placeholder="Entrez le taux d'absences">

            <label class="form-check-label text-primary">Redouble :</label>
            <br>
            <label for="Oui_Redouble" class="form-check-label text-light">Oui</label>
            <input type="radio" id="Oui_Redouble" name="Redouble" value="1" class="form-check-input">
            <label for="Non_Redouble" class="form-check-label text-light">Non</label>
            <input type="radio" id="Non_Redouble" name="Redouble" value="0" class="form-check-input" checked>
            <br>

            <label for="StOuv" class="form-label text-primary">Statut Ouverture :</label>
            <input type="text" id="StOuv" name="StOuv" class="form-control" placeholder="Entrez le statut d'ouverture">

            <label for="StTech" class="form-label text-primary">Statut Technique :</label>
            <input type="text" id="StTech" name="StTech" class="form-control" placeholder="Entrez le statut technique">

            <label for="TypeInscrip" class="form-label text-primary">Type d'Inscription :</label>
            <input type="text" id="TypeInscrip" name="TypeInscrip" class="form-control" placeholder="Entrez le type d'inscription">

            <label for="MontantIns" class="form-label text-primary">Montant d'Inscription :</label>
            <input type="text" id="MontantIns" name="MontantIns" class="form-control" placeholder="Entrez le montant de l'inscription">

            <label for="Remarque" class="form-label text-primary">Remarque :</label>
            <input type="text" id="Remarque" name="Remarque" class="form-control" placeholder="Ajoutez une remarque">

            <label for="Sitfin" class="form-label text-primary">Situation Financière :</label>
            <input type="text" id="Sitfin" name="Sitfin" class="form-control" placeholder="Entrez la situation financière">

            <label for="Montant" class="form-label text-primary">Montant :</label>
            <input type="number" step="0.01" id="Montant" name="Montant" class="form-control" placeholder="Entrez le montant">

            <label for="NoteSO" class="form-label text-primary">Note Service Orienté :</label>
            <input type="number" step="0.01" id="NoteSO" name="NoteSO" class="form-control" placeholder="Entrez la note du service orienté">

            <label for="NoteST" class="form-label text-primary">Note Service Technique :</label>
            <input type="number" step="0.01" id="NoteST" name="NoteST" class="form-control" placeholder="Entrez la note du service technique">
            <br>

            <div class="mb-3">
                <input type="reset" value="Annuler" class="btn btn-danger" id="annulerButton">
                <input type="submit" value="Ajouter l'Inscription" class="btn btn-success">
            </div>
            <br>
        </form>
    </div>
    <script>
        document.getElementById('annulerButton').addEventListener('click', function() {
            window.location.href = 'afficher.php';
        });
    </script>

</body>

</html>