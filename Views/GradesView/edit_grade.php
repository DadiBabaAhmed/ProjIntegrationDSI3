<?php
include "../../DataBase/Database.php";
include "../../Classes/Grade.php";

$db = new Database();
$grades = new Grades($db->getConnection());

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize POST data
    $gradeId = $_POST["Grade"];
    $newData = [
        "Grade" => $_POST["Grade"],
        "ChargeTP" => $_POST["ChargeTP"],
        "ChargeC" => $_POST["ChargeC"],
        "ChargeTD" => $_POST["ChargeTD"],
        "GradeArab" => $_POST["GradeArab"],
        "ChargeCI" => $_POST["ChargeCI"],
        "ChargeTotal" => $_POST["ChargeTotal"]
        // Add more fields as necessary
    ];

    // Example validation - add your validation logic here
    if (empty($newData['Grade'])) {
        $errors[] = "Grade cannot be empty.";
    }

    if (empty($errors)) {
        $grades->updateGrade($gradeId, $newData);
        header("Location: list_grades.php");
        exit();
    }
}

if (isset($_GET["Grade"])) {
    $gradeId = $_GET["Grade"];
    $grade = $grades->getGradeById($gradeId);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Grade</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Grade</h2>
        <?php if (isset($grade) && !empty($grade)) : ?>
            <?php if (!empty($errors)) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="edit_grade.php">
                <input type="hidden" name="Grade" value="<?php echo $grade["Grade"]; ?>">
                
                <div class="form-group">
                    <label for="Grade">Grade:</label>
                    <input type="text" class="form-control" name="Grade" id="Grade" value="<?php echo $grade["Grade"]; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="ChargeTP">Charge TP:</label>
                    <input type="text" class="form-control" name="ChargeTP" id="ChargeTP" value="<?php echo $grade["ChargeTP"]; ?>">
                </div>

                <div class="form-group">
                    <label for="ChargeC">Charge C:</label>
                    <input type="text" class="form-control" name="ChargeC" id="ChargeC" value="<?php echo $grade["ChargeC"]; ?>">
                </div>

                <div class="form-group">
                    <label for="ChargeTD">Charge TD:</label>
                    <input type="text" class="form-control" name="ChargeTD" id="ChargeTD" value="<?php echo $grade["ChargeTD"]; ?>">
                </div>

                <div class="form-group">
                    <label for="GradeArab">Grade (Arabic):</label>
                    <input type="text" class="form-control" name="GradeArab" id="GradeArab" value="<?php echo $grade["GradeArab"]; ?>">
                </div>

                <div class="form-group">
                    <label for="ChargeCI">Charge CI:</label>
                    <input type="text" class="form-control" name="ChargeCI" id="ChargeCI" value="<?php echo $grade["ChargeCI"]; ?>">
                </div>

                <div class="form-group">
                    <label for="ChargeTotal">Charge Total:</label>
                    <input type="text" class="form-control" name="ChargeTotal" id="ChargeTotal" value="<?php echo $grade["ChargeTotal"]; ?>">
                </div>

                <!-- Add more fields as necessary -->

                <button type="submit" class="btn btn-primary">Save Changes</button>
                <a class="btn btn-secondary" href="list_grades.php">Cancel</a>
            </form>
            <?php else : ?>
            <p>Grade not found.</p>
        <?php endif; ?>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
}
?>
