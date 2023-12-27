<?php
include "../../DataBase/Database.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$governorat = new Gouvernorat($db->getConnection());
$govList = $governorat->getGovernorats();

?>
<!DOCTYPE html>
<html>

<head>
    <title>Governorat List</title>
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
        <h1>Governorat List</h1>
        <a href="add_gouvernorat.php" class="btn btn-success">Add Governorat</a>
        <table>
            <tr>
                <th>Governorat</th>
                <th>CodePostal</th>
            </tr>
            <?php foreach ($govList as $gov) { ?>
                <tr>
                <td><?php echo $gov['Gouv']; ?></td>
                    <td><?php echo $gov['CodePostal']; ?></td>
                    <td>
                        <a href="edit_gouvernorat.php?Gouv=<?php echo $gov['Gouv']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_gouvernorat.php?Gouv=<?php echo $gov['Gouv']; ?>" class="btn btn-danger">Delete</a>
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