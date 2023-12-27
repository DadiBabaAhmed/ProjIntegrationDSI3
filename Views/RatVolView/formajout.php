<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Rattrapage</title>
</head>
<body>
<?php 
include("header.php");

?>

<h1>Ajout d'un nouveau Rattrapage</h1>
<form action="ajout.php" method="post">
   Num_Rattrapage: <input type="text" name="NumRattrapage"><br>
   Matricule_Prof: <input type="text" name="MatProf"><br>
   Date_Rattrapage: <input type="date" name="DateRattrapage"><br>
   Séance: <input type="text" maxlength="10" name="Seance"><br>
   Session: 
   <?php
       require_once("../../DataBase/connexion.php");
       $sql = "SELECT numero FROM session";
       $result = $conn->query($sql);
       if ($result->rowCount() > 0) {   
           echo "<select name='Session'>";
           while($row = $result->fetch(PDO::FETCH_ASSOC)) {
               echo "<option value='" . $row['numero'] . "'>" . $row['numero'] . "</option>";
           }
           echo "</select>";
       } else {
           echo "No results found!";
       }
   ?>
   <br>
   Salle: <input type="text" maxlength="10" name="Salle"><br>
   jour: <input type="text" maxlength="10" name="Jour"><br>
   Code_Classe: <input type="text" maxlength="9" name="CodeClasse"><br>
   Code_Matiere: <input type="text" maxlength="10" name="CodeMatiere"><br>
   Etat: <input type="number" name="Etat"><br>
        <input type="submit" value="Ajouter">
</form>
</body>
</html>
