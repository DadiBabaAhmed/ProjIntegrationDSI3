<?php
include "../../DataBase/Database.php";
include "../../Classes/Grade.php";

$db = new Database();
$grades = new Grades($db->getConnection());

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and process form data to add a new grade
    // Retrieve and sanitize POST data
    $grade = $_POST['Grade'];
    $chargeTP = $_POST['ChargeTP'];
    $chargeC = $_POST['ChargeC'];
    $chargeTD = $_POST['ChargeTD'];
    $gradeArab = $_POST['GradeArab'];
    $chargeCI = $_POST['ChargeCI'];
    $chargeTotal = $_POST['ChargeTotal'];

    // Check for empty fields
    if (empty($grade)) {
        $errors[] = "Please enter the Grade.";
    }
    // Check for other required fields and validate if necessary

    if (empty($errors)) {
        // Add the grade to the database
        $grades->addGrade($grade, $chargeTP, $chargeC, $chargeTD, $gradeArab, $chargeCI, $chargeTotal);

        // Redirect to the grades list page
        header("Location: list_grades.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Grade</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Add Grade</h2>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form method="POST" action="add_grade.php">
                <input type="hidden" name="Grade">
                
                <div class="form-group">
                    <label for="Grade">Grade:</label>
                    <input type="text" class="form-control" name="Grade" id="Grade">
                </div>

                <div class="form-group">
                    <label for="ChargeTP">Charge TP:</label>
                    <input type="text" class="form-control" name="ChargeTP" id="ChargeTP">
                </div>

                <div class="form-group">
                    <label for="ChargeC">Charge C:</label>
                    <input type="text" class="form-control" name="ChargeC" id="ChargeC">
                </div>

                <div class="form-group">
                    <label for="ChargeTD">Charge TD:</label>
                    <input type="text" class="form-control" name="ChargeTD" id="ChargeTD">
                </div>

                <div class="form-group">
                    <label for="GradeArab">Grade (Arabic):</label>
                    <input type="text" class="form-control" name="GradeArab" id="GradeArab">
                </div>

                <div class="form-group">
                    <label for="ChargeCI">Charge CI:</label>
                    <input type="text" class="form-control" name="ChargeCI" id="ChargeCI">
                </div>

                <div class="form-group">
                    <label for="ChargeTotal">Charge Total:</label>
                    <input type="text" class="form-control" name="ChargeTotal" id="ChargeTotal">
                </div>

                <!-- Add more fields as necessary -->

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-secondary" href="list_grades.php">Cancel</a>
            </form>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
