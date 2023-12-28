<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Rattrapage</title>
</head>

<body>
    <?php
    include("header.php");

    require_once("../../DataBase/connexion.php");
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

    if (isset($_GET['NumRatV'])) {
        $NumRatV = $_GET['NumRatV'];
        $sql = "SELECT * FROM ratvol WHERE NumRatV = :NumRatV";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':NumRatV' => $NumRatV]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("NumRatV not provided.");
    }

    ?>
    <h1>Modifier Rattrapage</h1>

    <form action="update.php" method="post">
        <div class="form-group">
            <label for="NumRattrapage"> Num_Rattrapage: </label>
            <input type="text" name="NumRattrapage" value="<?php echo htmlspecialchars($data['NumRatV']); ?>">
        </div>
        <div class="form-group">
            <label for="MatProf">CodeProf:</label>
            <select name="MatProf" id="MatProf">
                <?php
                foreach ($profList as $row) { ?>
                    <option value="<?php echo $row['Matricule'] ?>" <?php if($row['Matricule'] === $data['MatProf']){echo "selected";} ?>><?php echo $row['Nom'] . " " . $row['Prenom'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="DateRattrapage">Date_Rattrapage:</label>
            <input type="date" name="DateRattrapage" value="<?php echo htmlspecialchars($data['DateRat']); ?>">
        </div>
        <div class="form-group">
            <label for="Seance">Seance:</label>
            <select name="Seance" id="Seance">
                <?php
                foreach ($seanceList as $row) { ?>
                    <option value="<?php echo $row['SEANCE'] ?>" <?php if($row['SEANCE'] === $data['Seance']){echo "selected";} ?>><?php echo $row['SEANCE'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Session">Session:</label>
            <select name="Session" id="Session">
                <?php
                foreach ($sessionList as $row) { ?>
                    <option value="<?php echo $row['Numero'] ?>" <?php if($row['Numero'] === $data['Session']){echo "selected";} ?>><?php echo $row['Annee'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Salle">Salle:</label>
            <select name="Salle" id="Salle">
                <?php
                foreach ($salleList as $row) { ?>
                    <option value="<?php echo $row['Salle'] ?>" <?php if($row['Salle'] === $data['Salle']){echo "selected";} ?>><?php echo $row['Salle'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Jour">jour:</label>
            <input type="text" maxlength="10" name="Jour" value="<?php echo htmlspecialchars($data['Jour']); ?>">
        </div>
        <div class="form-group">
            <label for="CodeClasse">Code_Classe:</label>
            <select name="CodeClasse" id="CodeClasse">
                <?php
                foreach ($classeList as $row) { ?>
                    <option value="<?php echo $row['CodClasse'] ?>" <?php if($row['CodClasse'] === $data['CodeClasse']){echo "selected";} ?>><?php echo $row['CodClasse'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="CodeMatiere">Code_Matiere:</label>
            <select name="CodeMatiere" id="CodeMatiere">
                <?php
                foreach ($matiereList as $row) { ?>
                    <option value="<?php echo $row['Code_Matiere'] ?>" <?php if($row['Code_Matiere'] === $data['CodeMatiere']){echo "selected";} ?>><?php echo $row['Code_Matiere'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Etat">Etat:</label>
            <input type="number" name="Etat" value="<?php echo htmlspecialchars($data['Etat']); ?>">
        </div>
        <input type="submit" value="Modifier">
        <a href="afficher.php">Annuler</a>
    </form>
</body>

</html>