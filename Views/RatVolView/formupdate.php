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
    Num_Rattrapage: <input type="text" name="NumRattrapage" value="<?php echo htmlspecialchars($data['NumRatV']); ?>" readonly><br>
    Matricule_Prof: <input type="text" name="MatProf" value="<?php echo htmlspecialchars($data['MatProf']); ?>"><br>
    Date_Rattrapage: <input type="date" name="DateRattrapage" value="<?php echo htmlspecialchars((new DateTime($data['DateRat']))->format('Y-m-d')); ?>"><br>
    Séance: <input type="text" maxlength="10" name="Seance" value="<?php echo htmlspecialchars($data['Seance']); ?>"><br>
    Session: 
    <?php
        $sql = "SELECT numero FROM session";
        $result = $conn->query($sql);
        if ($result->rowCount() > 0) {   
            echo "<select name='Session'>";
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $row['numero'] . "'";
                if($row['numero'] == $data['Session']) echo " selected";
                echo ">" . $row['numero'] . "</option>";
            }
            echo "</select>";
        } else {
            echo "No results found!";
        }
    ?>
    <br>
    Salle: <input type="text" maxlength="10" name="Salle" value="<?php echo htmlspecialchars($data['Salle']); ?>"><br>
    jour: <input type="text" maxlength="10" name="Jour" value="<?php echo htmlspecialchars($data['Jour']); ?>"><br>
    Code_Classe: <input type="text" maxlength="9" name="CodeClasse" value="<?php echo htmlspecialchars($data['CodeClasse']); ?>"><br>
    Code_Matiere: <input type="text" maxlength="10" name="CodeMatiere" value="<?php echo htmlspecialchars($data['CodeMatiere']); ?>"><br>
    Etat: <input type="number" name="Etat" value="<?php echo htmlspecialchars($data['Etat']); ?>"><br>
    <input type="submit" value="Modifier">
</form>
</body>
</html>
