<?php
include "../../DataBase/Database.php";
include "../../Classes/Grade.php";

$db = new Database();
$grades = new Grades($db->getConnection());

// Retrieve all grades from the database
$gradeList = $grades->getGrades();
?>

<!DOCTYPE html>
<html>

<head>
    <title>List Grades</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>List Grades</h2>
        <a href="add_grade.php" class="btn btn-success">Add Grade</a>
        <a href="filtre_grades.php" class="btn btn-success">Rechercher</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Grade</th>
                    <th>Charge TP</th>
                    <th>Charge C</th>
                    <th>Charge TD</th>
                    <th>Grade (Arabic)</th>
                    <th>Charge CI</th>
                    <th>Charge Total</th>
                    <!-- Add more table headers for additional fields -->
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Assuming $grades is an array of grade objects fetched from the database
                foreach ($gradeList as $grade) {
                    echo '<tr>';
                    echo '<td>' . $grade["Grade"] . '</td>';
                    echo '<td>' . $grade["ChargeTP"] . '</td>';
                    echo '<td>' . $grade["ChargeC"] . '</td>';
                    echo '<td>' . $grade["ChargeTD"] . '</td>';
                    echo '<td>' . $grade["GradeArab"] . '</td>';
                    echo '<td>' . $grade["ChargeCI"] . '</td>';
                    echo '<td>' . $grade["ChargeTotal"] . '</td>';
                    // Add more <td> elements for additional fields

                    echo '<td>
                            <a href="edit_grade.php?Grade=' . $grade["Grade"] . '" class="btn btn-primary">Edit</a>
                            <a href="delete_grade.php?Grade=' . $grade["Grade"] . '" class="btn btn-danger">Delete</a>
                          </td>';

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

