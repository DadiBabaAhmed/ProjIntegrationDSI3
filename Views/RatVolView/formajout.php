<?php
include("header.php");
include "../../DataBase/Database.php";
include "../../Classes/Prof.php";
include "../../Classes/Classe.php";
include "../../Classes/Matieres.php";

$database = new Database();
$db = $database->getConnection();
$prof = new Prof($db);
$classe = new Classe($db);
$matiere = new Matieres($db);

$profList = $prof->getAllMatProf();
$classeList = $classe->getClasseNames();
$matiereList = $matiere->getMatieres();

$sql = "SELECT Annee, Numero  FROM session";
$sessionList = $db->query($sql);

$sql1 = "SELECT SEANCE FROM seances";
$seanceList = $db->query($sql1);

$sql2 = "SELECT Salle FROM salle";
$salleList = $db->query($sql2);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Add Rattrapage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Ajout d'un nouveau Rattrapage</h1>
        <form action="ajout.php" method="post">
            <div class="form-group">
                <label for="MatProf">CodeProf:</label>
                <select name="MatProf" id="MatProf" class="form-control">
                    <?php foreach ($profList as $row) : ?>
                        <option value="<?php echo $row['Matricule']; ?>"><?php echo $row['Nom'] . " " . $row['Prenom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="DateRattrapage">Date_Rattrapage:</label>
                <input type="date" name="DateRattrapage" class="form-control">
            </div>
            <div class="form-group">
                <label for="Seance">Seance:</label>
                <select name="Seance" id="Seance" class="form-control">
                    <?php
                    foreach ($seanceList as $row) { ?>
                        <option value="<?php echo $row['SEANCE'] ?>"><?php echo $row['SEANCE'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Session">Session:</label>
                <select name="Session" id="Session" class="form-control">
                    <?php
                    foreach ($sessionList as $row) { ?>
                        <option value="<?php echo $row['Numero'] ?>"><?php echo $row['Annee'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Salle">Salle:</label>
                <select name="Salle" id="Salle" class="form-control">
                    <?php
                    foreach ($salleList as $row) { ?>
                        <option value="<?php echo $row['Salle'] ?>"><?php echo $row['Salle'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Jour">jour:</label>
                <input type="text" maxlength="10" name="Jour" class="form-control">
            </div>
            <div class="form-group">
                <label for="CodeClasse">Code_Classe:</label>
                <select name="CodeClasse" id="CodeClasse" class="form-control">
                    <?php
                    foreach ($classeList as $row) { ?>
                        <option value="<?php echo $row['CodClasse'] ?>"><?php echo $row['CodClasse'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="CodeMatiere">Code_Matiere:</label>
                <select name="CodeMatiere" id="CodeMatiere" class="form-control">
                    <?php
                    foreach ($matiereList as $row) { ?>
                        <option value="<?php echo $row['Code_Matiere'] ?>"><?php echo $row['Code_Matiere'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Etat">Etat:</label>
                <input type="number" name="Etat" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Ajouter">
                <a href="afficher.php" class="btn btn-secondary">Annuler</a>
            </div>

        </form>
    </div>
</body>

</html>



<!--
    <!DOCTYPE html>
<html>

<head>
    <title>Add Profsituation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <h1>Add Profsituation</h1>
    <form method="POST" action="add_profsituation.php">
        <div class="form-group">
            <label for="CodeProf">CodeProf:</label>
             <select name="CodeProf" id="CodeProf">
             <?php
                foreach ($profList as $row) { ?>
                    <option value="<?php echo $row['Matricule'] ?>"><?php echo $row['Nom'] . " " . $row['Prenom'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Sess">Sess:</label>
            <select name="Sess" id="Sess">
                <?php
                foreach ($sessionList as $row) { ?>
                    <option value="<?php echo $row['Numero'] ?>"><?php echo $row['Annee'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Situation">Situation:</label>
            <input type="text" name="Situation" id="Situation" required><br><br>
        </div>
        <div class="form-group">
            <label for="Grade">Grade:</label>
            <select name="Grade" id="Grade">
                <?php
                foreach ($gradeList as $row) { ?>
                    <option value="<?php echo $row['Grade'] ?>"><?php echo $row['Grade'] ?></option>
                <?php } ?>
            </select>
        </div>
        <input type="submit" value="Add Profsituation">
        <a href="list_profsituations.php">Cancel</a>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>