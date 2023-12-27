<?php
include '../../DataBase/Database.php';
include '../../Classes/Jour.php';


$db = new Database();
$jour = new Jour($db->getConnection());
$jourList = $jour->getJours();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Jour List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
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
        <h1>Jour List</h1>
        <a href="add_jour.php" class="btn btn-success">Add Jour</a>
        <a href="filtre_jours.php" class="btn btn-success">Rechercher</a>
        <table>
            <tr>
                <th>Num Jour</th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Code Prof</th>
            </tr>
            <?php foreach ($jourList as $jour) { ?>
                <tr>
                    <td><?php echo $jour['N°']; ?></td>
                    <td><?php echo $jour['Lundi']; ?></td>
                    <td><?php echo $jour['Mardi']; ?></td>
                    <td><?php echo $jour['Mercredi']; ?></td>
                    <td><?php echo $jour['Jeudi']; ?></td>
                    <td><?php echo $jour['Vendredi']; ?></td>
                    <td><?php echo $jour['Samedi']; ?></td>
                    <td><?php echo $jour['Code Prof']; ?></td>
                    <td>
                        <a href="edit_jour.php?N°=<?php echo $jour['N°']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_jour.php?N°=<?php echo $jour['N°']; ?>" class="btn btn-danger">Delete</a>
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