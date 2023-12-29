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

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cp = $_POST['CodeProf'];
    $data = [
        'CodeProf' => $_POST['CodeProf'],
        'Sess' => $_POST['Sess'],
        'Situation' => $_POST['Situation'],
        'Grade' => $_POST['Grade'],
    ];

    // Validation: Check if any field is empty
    foreach ($data as $key => $value) {
        if (empty($value)) {
            $errors[] = ucfirst($key) . ' is required.';
        }
    }

    if (empty($errors)) {
        $result = $profsituation->update($cp, $data);
        if ($result) {
            echo 'Profsituation updated successfully.';
            header('Location: list_profsituations.php');
            exit();
        } else {
            $errors[] = 'Failed to update profsituation.';
        }
    }

    // Store errors in session and redirect back to the form page
    $_SESSION['errors'] = $errors;
    $_SESSION['formData'] = $data;
    header('Location: edit_profsituation.php?CodeProf=' . $cp);
    exit();
}

if (isset($_GET["CodeProf"])) {
    $CodeProf = $_GET["CodeProf"];

    $profsitData = $profsituation->getProfSituation($CodeProf);
    if (!$profsitData) {
        echo "Profsit with CodeProf: $CodeProf not found.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Profsituation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Edit Profsituation</h1>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                <h4 class="alert-heading">Errors Encountered:</h4>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST" action="edit_profsituation.php">
            <input type="hidden" name="N°" value="<?php echo $cp; ?>">
            <div class="form-group">
                <label for="CodeProf">CodeProf:</label>
                <select name="CodeProf" id="CodeProf" class="form-control">
                    <?php foreach ($profList as $row) : ?>
                        <option value="<?php echo $row['Matricule'] ?>" <?php if ($row['Matricule'] === $profsitData['CodeProf']) {echo "selected";} ?>><?php echo $row['Nom'] . " " . $row['Prenom'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Sess">Sess:</label>
                <select name="Sess" id="Sess" class="form-control">
                    <?php foreach ($sessionList as $row) : ?>
                        <option value="<?php echo $row['Numero'] ?>" <?php if ($row['Numero'] === $profsitData['Sess']) {echo "selected";} ?>><?php echo $row['Annee'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Situation">Situation:</label>
                <input type="text" name="Situation" id="Situation" value="<?php echo $profsitData['Situation']; ?>" class="form-control"><br><br>
            </div>
            <div class="form-group">
                <label for="Grade">Grade:</label>
                <select name="Grade" id="Grade" class="form-control">
                    <?php foreach ($gradeList as $row) : ?>
                        <option value="<?php echo $row['Grade'] ?>" <?php if ($row['Grade'] === $profsitData['Grade']) {echo "selected";} ?>><?php echo $row['Grade'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <input type="submit" value="Edit Profsituation" class="btn btn-primary">
            <a href="list_profsituations.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>