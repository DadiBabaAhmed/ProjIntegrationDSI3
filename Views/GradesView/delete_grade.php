<?php
include "../../DataBase/Database.php";
include "../../Classes/Grade.php";

$db = new Database();
$grades = new Grades($db->getConnection());

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
            echo '<a class="btn btn-danger" href="delete_grade.php?Grade=' . $_GET["Grad"] . '">Confirm Delete</a>';
        } else {
            // If NCIN is not provided in the URL, show a form to enter NCIN
            echo '<form method="POST" action="delete_grade.php">
                <input type="text" name="Grade" placeholder="Enter Grade">
                <button type="submit" class="btn btn-danger">Confirm Delete</button>
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