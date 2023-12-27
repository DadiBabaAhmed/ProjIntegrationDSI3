<?php
include '../../DataBase/Database.php';
include '../../Classes/ProfSituation.php';

$db = new Database();
$profsituation = new Profsituation($db->getConnection());
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
            <input type="text" name="CodeProf" id="CodeProf" required><br><br>
        </div>
        <div class="form-group">
            <label for="Sess">Sess:</label>
            <input type="text" name="Sess" id="Sess" required><br><br>
        </div>
        <div class="form-group">
            <label for="Situation">Situation:</label>
            <input type="text" name="Situation" id="Situation" required><br><br>
        </div>
        <div class="form-group">
            <label for="Grade">Grade:</label>
            <input type="text" name="Grade" id="Grade" required><br><br>
        </div>
        <input type="submit" value="Add Profsituation">
        <a href="list_profsituations.php">Cancel</a>
    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>