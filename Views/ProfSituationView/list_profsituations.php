<?php
include '../../DataBase/Database.php';
include '../../Classes/ProfSituation.php';
include '../../Classes/Grade.php';
include '../../Classes/Prof.php';

$db = new Database();
$profsituation = new Profsituation($db->getConnection());
$grade = new Grades($db->getConnection());
$prof = new Prof($db->getConnection());
$profsituationList = $profsituation->getAllProfSituation();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Profsituation List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <h1>Profsituation List</h1>
        <a href="add_profsituation.php" class="btn btn-success">Add Profsituation</a>
        <a href="filtre_profsituations.php" class="btn btn-success">Rechercher</a>
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
                        <a href="delete_profsituation.php?CodeProf =<?php echo $profsituation['CodeProf']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>