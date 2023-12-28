<?php
include '../../DataBase/Database.php';
include '../../Classes/ProfSituation.php';
include '../../Classes/Grade.php';
include '../../Classes/Prof.php';

$db = new Database();
$profsituation = new Profsituation($db->getConnection());
$grade = new Grades($db->getConnection());
$prof = new Prof($db->getConnection());

$gradeList = $grade->getAllGrades();
$profList = $prof->getAllMatProf();
$sql = "SELECT Annee, Numero  FROM session";
$sessionList = $db->getConnection()->query($sql);

$profsituationList = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $critere = $_POST["critere"];
    $val = $_POST["val"];
    $profsituationList = $profsituation->search($critere, $val);
} else {
    $profsituationList = $profsituation->getAllProfSituation();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Profsituation List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <form action="filtre_profsituations.php" method="post">
            <div class="wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-header">
                                <h1>Chercher la ProfSituation</h1>
                                <br>
                            </div>
                            <br>
                            <div class="form-group">
                                <label for="critere">Critere :</label>
                                <select id="critere" name="critere">
                                    <option id="CodeProf" value="CodeProf">Code Prof</option>
                                    <option id="Sess" value="Sess">Sess</option>
                                    <option id="Situation" value="Situation">Situation</option>
                                    <option id="Grade" value="Grade">Grade</option>
                                </select>
                                <br><br>

                                <label for="val">Valeur :</label>
                                <div id="valeur">
                                    <script>
                                        var critereSelect = document.getElementById("critere");
                                        var valInput = document.getElementById("valeur");
                                        valInput.innerHTML = '';
                                        var selectHtml = '<select name="val" id="val">';
                                        <?php foreach ($profList as $row) { ?>
                                            selectHtml += '<option value="<?php echo $row['Matricule']; ?>"><?php echo $row['Nom'] . ' ' . $row['Prenom']; ?></option>';
                                        <?php } ?>
                                        selectHtml += '</select>';
                                        valInput.innerHTML = selectHtml;
                                        critereSelect.addEventListener("change", function() {
                                            if (critereSelect.value === "Situation") {
                                                valInput.innerHTML = '';
                                                valInput.innerHTML += "<input type='text' name='val' id='val'><br><br>";
                                            } else if (critereSelect.value === "CodeProf") {
                                                valInput.innerHTML = '';
                                                var selectHtml = '<select name="val" id="val">';
                                                <?php foreach ($profList as $row) { ?>
                                                    selectHtml += '<option value="<?php echo $row['Matricule']; ?>"><?php echo $row['Nom'] . ' ' . $row['Prenom']; ?></option>';
                                                <?php } ?>
                                                selectHtml += '</select>';
                                                valInput.innerHTML = selectHtml;
                                            } else if (critereSelect.value === "Sess") {
                                                valInput.innerHTML = '';
                                                var selectHtml = '<select name="val" id="val">';
                                                <?php foreach ($sessionList as $row) { ?>
                                                    selectHtml += '<option value="<?php echo $row['Numero']; ?>"><?php echo $row['Annee']; ?></option>';
                                                <?php } ?>
                                                selectHtml += '</select>';
                                                valInput.innerHTML = selectHtml;
                                            } else if (critereSelect.value === "Grade") {
                                                valInput.innerHTML = '';
                                                var selectHtml = '<select name="val" id="val">';
                                                <?php foreach ($gradeList as $row) { ?>
                                                    selectHtml += '<option value="<?php echo $row['Grade']; ?>"><?php echo $row['Grade']; ?></option>';
                                                <?php } ?>
                                                selectHtml += '</select>';
                                                valInput.innerHTML = selectHtml;
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <a class="btn btn-secondary" href="list_profsituations.php">Retour</a>
                            <input type="submit" class="btn btn-primary" name="submit" value="Rechercher">
                            <table class="table">
                                <tr>
                                    <th>Code Prof</th>
                                    <th>Session</th>
                                    <th>Situation</th>
                                    <th>Grade</th>
                                    <th>Actions</th>
                                </tr>
                                <?php foreach ($profsituationList as $profsituation) {
                                    $sql = "SELECT Annee FROM session WHERE Numero = " . $profsituation['Sess'] . "";
                                    $sessionResult = $db->getConnection()->query($sql);

                                    // Fetch the result and get the 'Annee' value
                                    $sessionList = $sessionResult->fetch_assoc(); // Fetch the data as an associative array
                                    $annee = $sessionList['Annee'];
                                    $thisprof = $prof->getProf($profsituation['CodeProf']);
                                    ?>
                        
                                        <tr>
                                            <td><?php echo $thisprof['Nom'] . ' ' . $thisprof['Prenom']; ?></td>
                                        <td><?php echo $annee ?></td>
                                        <td><?php echo $profsituation['Situation']; ?></td>
                                        <td><?php echo $profsituation['Grade']; ?></td>
                                        <td>
                                            <a href="edit_profsituation.php?CodeProf=<?php echo $profsituation['CodeProf']; ?>" class="btn btn-primary">Edit</a>
                                            <a href="delete_profsituation.php?CodeProf=<?php echo $profsituation['CodeProf']; ?>" class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>