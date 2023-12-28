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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $data = [
        'CodeProf' => $_POST['CodeProf'],
        'Sess' => $_POST['Sess'],
        'Situation' => $_POST['Situation'],
        'Grade' => $_POST['Grade'],
    ];
    $result = $profsituation->add($data);

    if ($result) {
        echo 'Profsituation added successfully.';
    } else {
        echo 'Failed to add profsituation.';
    }
    header('Location: list_profsituations.php');
    exit();
}
?>

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
                    <option value="<?php echo $row['Matricule']?>"><?php echo $row['Nom'] ." " .$row['Prenom']?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Sess">Sess:</label>
            <select name="Sess" id="Sess">
                <?php
                foreach ($sessionList as $row) { ?>
                    <option value="<?php echo $row['Numero']?>"><?php echo $row['Annee']?></option>
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
                    <option value="<?php echo $row['Grade']?>"><?php echo $row['Grade']?></option>
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