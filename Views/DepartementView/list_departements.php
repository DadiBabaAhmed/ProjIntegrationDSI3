<?php
include "../../DataBase/Database.php";
include "../../Classes/Departement.php";

$db = new Database();
$departement = new Departement($db->getConnection());
$depList = $departement->getAllDepartments();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Departement List</title>
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
<?php include '../inc/header.php'; ?>

<body>
    <div class="container">
        <h1>Departement List</h1>
        <a href="add_departement.php" class="btn btn-success">Add Departement</a>
        <a href="filtre_departement.php" class="btn btn-primary">Recherche</a>
        <table>
            <tr>
                <th>CodeDep</th>
                <th>Departement</th>
                <th>Responsable</th>
                <th>Matricule Responsable</th>
                <th>DepartementARAB</th>
            </tr>
            <?php foreach ($depList as $dep) { ?>
                <tr>
                    <td><?php echo $dep['CodeDep']; ?></td>
                    <td><?php echo $dep['Departement']; ?></td>
                    <td><?php echo $dep['Responsable']; ?></td>
                    <td><?php echo $dep['MatProf']; ?></td>
                    <td><?php echo $dep['DepartementARAB']; ?></td>
                    <td>
                        <a href="edit_departement.php?CodeDep=<?php echo $dep['CodeDep']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_departement.php?CodeDep=<?php echo $dep['CodeDep']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this departement?');">Delete</a>
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
</body>

</html>