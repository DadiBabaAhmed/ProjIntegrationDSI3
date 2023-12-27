<?php
include "../../DataBase/Database.php";
include "../../Classes/Semaine.php";

$db = new Database();
$semaine = new Semaine($db->getConnection());
$semaineList = $semaine->getAllSemaines();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Semaine List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Semaine List</h1>
        <a href="add_semaine.php" class="btn btn-success">Add Semaine</a>
        <table class="table">
            <thead>
                <tr>
                    <th>NumSem</th>
                    <th>DateDebut</th>
                    <th>DateFin</th>
                    <th>Session</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($semaineList as $semaine) { ?>
                    <tr>
                        <td><?php echo $semaine['NumSem']; ?></td>
                        <td><?php echo $semaine['DateDebut']; ?></td>
                        <td><?php echo $semaine['DateFin']; ?></td>
                        <td><?php echo $semaine['Session']; ?></td>
                        <td>
                            <a href="edit_semaine.php?idSem=<?php echo $semaine['idSem']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_semaine.php?idSem=<?php echo $semaine['idSem']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
