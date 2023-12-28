<?php
include "../../DataBase/Database.php";
include "../../Classes/Classe.php";
include "../../Classes/Departement.php";

$db = new Database();
$classes = new Classe($db->getConnection());

$departement = new Departement($db->getConnection());
$departementList = $departement->getDepartmentsNames();
//var_dump($departementList);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Validate and process form data to add a new classe
    // Retrieve and sanitize POST data
    $codClasse = $_POST['CodClasse'];
    $intClasse = $_POST['IntClasse'];
    $departement = $_POST['Département'];
    $optiOn = $_POST['Opti_on'];
    $niveau = $_POST['Niveau'];
    $intCalsseArabB = $_POST['IntCalsseArabB'];
    $optionAaraB = $_POST['OptionAaraB'];
    $departementAaraB = $_POST['DepartementAaraB'];
    $niveauAaraB = $_POST['NiveauAaraB'];
    $codeEtape = $_POST['CodeEtape'];
    $codeSalima = $_POST['CodeSalima'];

    // Add the classe to the database
    try{
        $classes->addClass($codClasse, $intClasse, $departement, $optiOn, $niveau, $intCalsseArabB, $optionAaraB, $departementAaraB, $niveauAaraB, $codeEtape, $codeSalima);   
        // Redirect to the classes list page
        header("Location: list_classes.php");
        exit();
    }
    catch (mysqli_sql_exception $e) {
        if ($e->getCode() == 1062) { // 1062 is the error code for 'Duplicate entry'
            echo "<div class='alert alert-danger'>Error: classe '$codClasse' deja existe.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error: An error occurred; Please try again later.</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Classe</title>
    <!-- Add Bootstrap CSS or your preferred CSS framework -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Add Classe</h2>

        <form method="POST" action="add_classe.php">
            <div class="form-group">
                <label for="CodClasse">Code Classe:</label>
                <input type="text" class="form-control" name="CodClasse" id="CodClasse" required>
            </div>

            <div class="form-group">
                <label for="IntClasse">Int Classe:</label>
                <input type="text" class="form-control" name="IntClasse" id="IntClasse">
            </div>

            
            <div class="form-group">
                <label for="Département">Département:</label>
                <select class="form-control" name="Département" id="Département">
                    <?php foreach ($departementList as $dep) { ?>
                        <option value= "<?php echo $dep['CodeDep'] ; ?>"><?php echo $dep['Departement']." - ".$dep['CodeDep']?> </option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Opti_on">Opti_on:</label>
                <input type="text" class="form-control" name="Opti_on" id="Opti_on">
            </div>

            <div class="form-group">
                <label for="Niveau">Niveau:</label>
                <input type="text" class="form-control" name="Niveau" id="Niveau">
            </div>

            <div class="form-group">
                <label for="IntCalsseArabB">Int Calsse Arab B:</label>
                <input type="text" class="form-control" name="IntCalsseArabB" id="IntCalsseArabB">
            </div>

            <div class="form-group">
                <label for="OptionAaraB">Option Aara B:</label>
                <input type="text" class="form-control" name="OptionAaraB" id="OptionAaraB">
            </div>

            <div class="form-group">
                <label for="DepartementAaraB">Departement Aara B:</label>
                <input type="text" class="form-control" name="DepartementAaraB" id="DepartementAaraB">
            </div>

            <div class="form-group">
                <label for="NiveauAaraB">Niveau Aara B:</label>
                <input type="text" class="form-control" name="NiveauAaraB" id="NiveauAaraB">
            </div>

            <div class="form-group">
                <label for="CodeEtape">Code Etape:</label>
                <input type="text" class="form-control" name="CodeEtape" id="CodeEtape">
            </div>

            <div class="form-group">
                <label for="CodeSalima">Code Salima:</label>
                <input type="text" class="form-control" name="CodeSalima" id="CodeSalima">
            </div>

            <!-- Add more fields as necessary -->

            <button type="submit" class="btn btn-primary">Add Classe</button>
            <a class="btn btn-secondary" href="list_classes.php">Cancel</a>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript or your preferred JS framework -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
