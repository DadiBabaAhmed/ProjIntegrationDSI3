<?php
include '../../DataBase/Database.php';
include '../../Classes/Jour.php';
include '../../Classes/Prof.php';

$db= new Database();
// Create an instance of the class
$jour = new Jour($db->getConnection());
$prof = new Prof($db->getConnection());

$profList = $prof->getAllMatProf();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $jourData = [
        'N°' => $_POST['N°'],
        'Lundi' => $_POST['Lundi'],
        'Mardi' => $_POST['Mardi'],
        'Mercredi' => $_POST['Mercredi'],
        'Jeudi' => $_POST['Jeudi'],
        'Vendredi' => $_POST['Vendredi'],
        'Samedi' => $_POST['Samedi'],
        'Code Prof' => $_POST['Code_Prof'],
        // Add more fields as needed
    ];

    try
    {
        $jour->add($jourData);
        header('Location: list_jours.php');
        exit;
    }
    catch (mysqli_sql_exception $e)
    {
        if ($e->getCode() == 1062) { // 1062 is the error code for 'Duplicate entry'
            echo "<div class='alert alert-danger' role='alert'>
            <h5>Error: jour deja existe: changer N°.</h5>
            </div>
            <br><a class='btn btn-secondary' href='list_jours.php'>Retourner à la liste</a>";
        } 
        else {
            echo "<div class='alert alert-danger' role='alert'>
            <h5>Error:Une erreur inattendue s'est produite lors de l'ajout de cette element.</h5>
            </div>
            <br><a class='btn btn-secondary' href='list_jours.php'>Retourner à la liste</a>";
        }
    }
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Jour</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <h1>Add Jour</h1>

    <form method="POST" action="">

    <div class="form-group">
        <label for="N°">N°:</label>
        <input type="text" name="N°" id="N°" required><br>
    </div>
    <div class="form-group">
        <label for="Lundi">Lundi:</label>
        <input type="text" name="Lundi" id="Lundi" required><br>
    </div>
    <div class="form-group">
        <label for="Mardi">Mardi:</label>
        <input type="text" name="Mardi" id="Mardi" required><br>
    </div>
    <div class="form-group">
        <label for="Mercredi">Mercredi:</label>
        <input type="text" name="Mercredi" id="Mercredi" required><br>
    </div>
    <div class="form-group">
        <label for="Jeudi">Jeudi:</label>
        <input type="text" name="Jeudi" id="Jeudi" required><br>
    </div>
    <div class="form-group">
        <label for="Vendredi">Vendredi:</label>
        <input type="text" name="Vendredi" id="Vendredi" required><br>
    </div>
    <div class="form-group">
        <label for="Samedi">Samedi:</label>
        <input type="text" name="Samedi" id="Samedi" required><br>
    </div>
    <div class="form-group">
        <label for="Code_Prof">Code Prof:</label>
        <select name="Code_Prof" id="Code_Prof">
            <?php foreach ($profList as $prof) { ?>
                <option value="<?php echo $prof['Matricule']; ?>"><?php echo $prof['Nom'] ." " .$prof['Prenom']; ?></option>
            <?php } ?>
        </select>
    </div>
        <!-- Add more form fields as needed -->
        <button type="submit" class="btn btn-primary">Add Jour</button>
        <a class="btn btn-secondary" href="list_jours.php">Cancel</a>

    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
