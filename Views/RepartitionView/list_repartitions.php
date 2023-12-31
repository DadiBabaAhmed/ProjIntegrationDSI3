<?php
include "../../DataBase/Database.php";
include "../../Classes/Repartition.php";

$db = new Database();
$repartition = new Repartition($db->getConnection());
$repList = $repartition->getAllRepartitions();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Repartition List</title>
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
        <h1>Repartition List</h1>
        <a href="add_repartition.php" class="btn btn-success">Add Repartition</a>
        <a href="filtre_repartitions.php" class="btn btn-success">Rechercher</a>
        <table>
            <tr>
                <th>NumSes</th>
                <th>NSemDeb</th>
                <th>NSemFin</th>
                <th>TypeSeance</th>
                <th>NbGrp</th>
                <th>NBHDT</th>
                <th>CodeClasse</th>
                <th>CodeProf</th>
                <th>CodeMat</th>
                <th>NBHD</th>
                <th>TypeGest</th>
            </tr>
            <?php foreach ($repList as $rep) { ?>
                <tr>
                    <td><?php echo $rep['NumSes']; ?></td>
                    <td><?php echo $rep['NSemDeb']; ?></td>
                    <td><?php echo $rep['NSemFin']; ?></td>
                    <td><?php echo $rep['TypeSeance']; ?></td>
                    <td><?php echo $rep['NbGrp']; ?></td>
                    <td><?php echo $rep['NBHDT']; ?></td>
                    <td><?php echo $rep['CodeClasse']; ?></td>
                    <td><?php echo $rep['CodeProf']; ?></td>
                    <td><?php echo $rep['CodeMat']; ?></td>
                    <td><?php echo $rep['NBHD']; ?></td>
                    <td><?php echo $rep['TypeGest']; ?></td>
                    <td>
                        <a href="edit_repartition.php?Numdist=<?php echo $rep['Numdist']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_repartition.php?Numdist=<?php echo $rep['Numdist']; ?>" class="btn btn-danger">Delete</a>
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