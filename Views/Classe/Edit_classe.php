<?php
include "../../DataBase/Database.php";
include "../../Classes/Classe.php";

$db = new Database();
$classes = new Classe($db->getConnection());

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process form data to update a class
    // Retrieve and sanitize POST data
    $classId = $_POST["id"];
    $newData = [
        "CodClasse" => $_POST["CodClasse"],
        "IntClasse" => $_POST["IntClasse"],
        "Département" => $_POST["Département"],
        "Opti_on" => $_POST["Opti_on"],
        "Niveau" => $_POST["Niveau"],
        "IntCalsseArabB" => $_POST["IntCalsseArabB"],
        "OptionAaraB" => $_POST["OptionAaraB"],
        "DepartementAaraB" => $_POST["DepartementAaraB"],
        "NiveauAaraB" => $_POST["NiveauAaraB"],
        "CodeEtape" => $_POST["CodeEtape"],
        "CodeSalima" => $_POST["CodeSalima"]
        // Add more fields as necessary
    ];
    try {
        $classes->updateClass($classId, $newData);
        header("Location: list_classes.php");
        exit();
    } catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // 1062 is the error code for 'Duplicate entry'
            echo "<div class='alert alert-danger'>Error: A class with code '{$newData["CodClasse"]}' already exists.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: An error occurred; Please try again later.</div>";
        }
    }
}

if (isset($_GET["id"])) {
    $classId = $_GET["id"];
    $class = $classes->getClassById($classId);

    // Example HTML form for editing a class
    // You need to adjust this form to match your field names and structure
    // Replace the input values with data from the $class array
    ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Edit Classe</title>
        <!-- Add Bootstrap CSS or your preferred CSS framework -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>

    <body>
        <div class="container">
            <h2>Edit Classe</h2>
            <?php
            // Assuming $class is the retrieved class data from the database
            if (isset($class) && !empty($class)) {
                ?>
                <form method="POST" action="edit_classe.php">
                    <input type="hidden" name="id" value="<?php echo $class["id"]; ?>">

                    <div class="form-group">
                        <label for="CodClasse">CodClasse:</label>
                        <input type="text" class="form-control" name="CodClasse" id="CodClasse"
                            value="<?php echo $class["CodClasse"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="IntClasse">IntClasse:</label>
                        <input type="text" class="form-control" name="IntClasse" id="IntClasse"
                            value="<?php echo $class["IntClasse"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Département">Département:</label>
                        <input type="text" class="form-control" name="Département" id="Département"
                            value="<?php echo $class["Département"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Opti_on">Opti_on:</label>
                        <input type="text" class="form-control" name="Opti_on" id="Opti_on"
                            value="<?php echo $class["Opti_on"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Niveau">Niveau:</label>
                        <input type="text" class="form-control" name="Niveau" id="Niveau"
                            value="<?php echo $class["Niveau"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="IntCalsseArabB">IntCalsseArabB:</label>
                        <input type="text" class="form-control" name="IntCalsseArabB" id="IntCalsseArabB"
                            value="<?php echo $class["IntCalsseArabB"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="OptionAaraB">OptionAaraB:</label>
                        <input type="text" class="form-control" name="OptionAaraB" id="OptionAaraB"
                            value="<?php echo $class["OptionAaraB"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="DepartementAaraB">DepartementAaraB:</label>
                        <input type="text" class="form-control" name="DepartementAaraB" id="DepartementAaraB"
                            value="<?php echo $class["DepartementAaraB"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="NiveauAaraB">NiveauAaraB:</label>
                        <input type="text" class="form-control" name="NiveauAaraB" id="NiveauAaraB"
                            value="<?php echo $class["NiveauAaraB"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="CodeEtape">CodeEtape:</label>
                        <input type="text" class="form-control" name="CodeEtape" id="CodeEtape"
                            value="<?php echo $class["CodeEtape"]; ?>">
                    </div>

                    <div class="form-group">
                        <label for="CodeSalima">CodeSalima:</label>
                        <input type="text" class="form-control" name="CodeSalima" id="CodeSalima"
                            value="<?php echo $class["CodeSalima"]; ?>">
                    </div>

                    <!-- Add more fields as necessary -->

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a class="btn btn-secondary" href="list_classes.php">Cancel</a>
                </form>
                <?php
            } else {
                echo "Class not found.";
            }
            ?>
        </div>

        <!-- Add Bootstrap JavaScript or your preferred JS framework -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>

    </html>

    <?php
}
?>