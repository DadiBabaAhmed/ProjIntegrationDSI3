<?php
include "../../DataBase/Database.php";
include "../../Classes/Classe.php";

$db = new Database();
$classes = new Classe($db->getConnection());

// Retrieve all classes from the database
$classList = $classes->getClasses();
?>

<!DOCTYPE html>
<html>

<head>
    <title>List Classes</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<?php include '../inc/header.php'; ?>

<body>
    <div class="container" style = "margin-left: 85px;">
        <h2>List Classes</h2>
        <a href="add_classe.php" class="btn btn-success mb-3">Add Classe</a>
        <a href="filter.php" class="btn btn-primary mb-3">rechercher</a>
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>CodClasse</th>
                    <th>IntClasse</th>
                    <th>Département</th>
                    <th>Option</th>
                    <th>Niveau</th>
                    <th>IntCalsseArabB</th>
                    <th>OptionAaraB</th>
                    <th>DepartementAaraB</th>
                    <th>NiveauAaraB</th>
                    <th>CodeEtape</th>
                    <th>CodeSalima</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming $classList is an array of class objects fetched from the database
                foreach ($classList as $class) {
                    echo '<tr>';
                    //echo '<td>' . $class["id"] . '</td>';
                    echo '<td>' . $class["CodClasse"] . '</td>';
                    echo '<td>' . $class["IntClasse"] . '</td>';
                    echo '<td>' . $class["Département"] . '</td>';
                    echo '<td>' . $class["Opti_on"] . '</td>';
                    echo '<td>' . $class["Niveau"] . '</td>';
                    echo '<td>' . $class["IntCalsseArabB"] . '</td>';
                    echo '<td>' . $class["OptionAaraB"] . '</td>';
                    echo '<td>' . $class["DepartementAaraB"] . '</td>';
                    echo '<td>' . $class["NiveauAaraB"] . '</td>';
                    echo '<td>' . $class["CodeEtape"] . '</td>';
                    echo '<td>' . $class["CodeSalima"] . '</td>';

                    echo '<td>
                            <a href="edit_classe.php?id=' . $class["id"] . '" class="btn btn-primary">Edit</a>'; ?>
                    <a href="delete_classe.php?id=<?php echo $class['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Classe?');">Delete</a>
                <?php
                    echo '</td>';

                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>