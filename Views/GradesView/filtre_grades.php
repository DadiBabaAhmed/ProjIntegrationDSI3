<?php
include "../../DataBase/Database.php";
include "../../Classes/Grade.php";

$db = new Database();
$grades = new Grades($db->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $critere = $_POST["critere"];
    $val = $_POST["val"];
    $gradeList = $grades->search($critere, $val);
} else {
    $gradeList = $grades->getGrades();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>List Grades</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <form action="filtre_grades.php" method="post">
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="page-header">
                            <h1>Chercher le Grade</h1>
                            <br>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="critere">critere :</label>
                            <select id="critere" name="critere">
                                <option id="Grade" value="Grade">Grade</option>
                                <option id="GradeArab" value="GradeArab">GradeArab</option>
                            </select>
                            <br><br>

                            <label for="critere"> Valeur : </label>
                            <input type="text" name="val" id="val"><br><br>

                            <script>
                                var critereSelect = document.getElementById("critere");
                                var valInput = document.getElementById("val");

                                critereSelect.addEventListener("change", function() {
                                    if (critereSelect.value === "Grade") {
                                        valInput.type = "text";
                                    } else if (critereSelect.value === "GradeArab") {
                                        valInput.type = "text";
                                    }
                                });
                            </script>
                        </div>

                        <a class="btn btn-secondary" href="list_grades.php">return</a>
                        <input type="submit" class="btn btn-primary" name="submit" value="rechercher">
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Assuming $grades is an array of grade objects fetched from the database
                                if (isset($gradeList)) {
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
                            <a href="delete_grade.php?Grade=' . $grade["Grade"] . '" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this grade?`);">Delete</a>
                          </td>';

                                        echo '</tr>';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>