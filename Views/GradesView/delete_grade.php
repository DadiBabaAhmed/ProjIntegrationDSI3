<?php
include "../../DataBase/Database.php";
include "../../Classes/Grade.php";

$db = new Database();
$grades = new Grades($db->getConnection());

try {
    if (isset($_GET["Grade"])) {
        // If the grade ID is provided in the URL, confirm and perform the delete
        $gradeId = $_GET["Grade"];
        $grades->deleteGrade($gradeId);
        header("Location: list_grades.php");
        exit();
    } elseif ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["Grade"])) {
        // If the form is submitted and the grade ID is provided, confirm and perform the delete
        $gradeId = $_POST["Grade"];
        $grades->deleteGrade($gradeId);
        header("Location: list_grades.php");
        exit();
    }
} catch (Exception $e) {
    echo "<h5>Error: " . $e->getMessage() . "</h5>";
    // Add a link to go back to list_etudiants.php
    echo '<br><a class="btn btn-secondary" href="list_grades.php">Go back to list</a>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Etudiant</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Delete Grade</h2>
        <p>Are you sure you want to delete this Grade?</p>

        <?php
        if (isset($_GET["Grade"])) {
            echo '<a class="btn btn-danger" href="delete_grade.php?Grade=' . $_GET["Grade"] . '">Confirm Delete</a>';
        } else {
            $gradeList = $grades->getAllGrades();
            // If NCIN is not provided in the URL, show a form to enter NCIN
            echo '<form method="POST" action="delete_grade.php">
                <label for="Grade">Grade:</label>
                <select class="form-control" name="Grade" id="Grade">';
            foreach ($gradeList as $grade) {
                echo '<option value="' . $grade["Grade"] . '">' . $grade["Grade"] . '</option>';
            }
            echo '</select>
                <button type="submit" class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this grade?`);">Confirm Delete</button>
                <a class="btn btn-secondary" href="list_grades.php">Cancel</a>
            </form>';
        }
        ?>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>