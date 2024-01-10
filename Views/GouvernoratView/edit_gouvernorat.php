<?php
include "../../DataBase/Database.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$Gouvernorat = new Gouvernorat($db->getConnection());

$errors = [];
$Gouv = '';

try{
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (empty($_POST["Gouv"])) {
        $errors[] = "Please enter the Gouvernorat name.";
    }

    if (empty($_POST["CodePostal"])) {
        $errors[] = "Please enter the postal code.";
    }

    if (empty($errors)) {
        $Gouv = $_POST["Gouv"];
        $CodePostal = $_POST["CodePostal"];
        $GouvernoratData = [
            "Gouv" => $Gouv,
            "CodePostal" => $CodePostal
        ];
        $Gouvernorat->update($Gouv, $GouvernoratData);
        header("Location: list_Gouvernorats.php");
        exit();
    }
}

if (isset($_GET["Gouv"])) {
    $Gouv = $_GET["Gouv"];

    $GouvernoratData = $Gouvernorat->getGovernorat($Gouv);
    if (!$GouvernoratData) {
        echo "Gouvernorat with Gouv: $Gouv not found.";
        exit();
    }
}
} catch (Exception $e) {
        $errorCode = $e->getCode();
    
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : Une erreur inattendue s'est produite lors de la modification de ce gouvernorat.</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="list_gouvernorats.php">Retourner à la liste</a>';
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Gouvernorat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Gouvernorat</h2>
        <?php if (!empty($errors)) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <form method="POST" action="edit_Gouvernorat.php">
            <input type="hidden" name="Gouv" value="<?php echo $Gouv; ?>">
            <div class="form-group">
                <label for="Gouv">Gouvernorat:</label>
                <input type="text" class="form-control" id="Gouv" name="Gouv" value="<?php echo $GouvernoratData['Gouv']; ?>">
            </div>
            <div class="form-group">
                <label for="CodePostal">Code Postal:</label>
                <input type="number" class="form-control" id="CodePostal" name="CodePostal" value="<?php echo $GouvernoratData['CodePostal']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a class="btn btn-secondary" href="list_departements.php">Cancel</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
