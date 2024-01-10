<?php
include "../../DataBase/Database.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$Gouvernorat = new Gouvernorat($db->getConnection());

$errors = [];

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
        $Gouvernorat->add($GouvernoratData);
        header("Location: list_Gouvernorats.php");
        exit();
    }
}
} catch (Exception $e) {
        $errorCode = $e->getCode();
    
        echo '<div class="alert alert-danger" role="alert">';
        echo "<h5>Erreur : Une erreur inattendue s'est produite lors de l'ajout d'un gouvernorat.</h5>";
        echo '</div>';
        echo '<br><a class="btn btn-secondary" href="list_gouvernorats.php">Retourner à la liste</a>';
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Departement</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Add Gouvernorat</h2>
                    </div>
                    <?php if (!empty($errors)) : ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <form action="add_Gouvernorat.php" method="post">
                        <div class="form-group">
                            <label>le nom de Gouvernorat</label>
                            <input type="text" name="Gouv" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>codepostal</label>
                            <input type="text" name="CodePostal" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Gouvernorat</button>
                        <a class="btn btn-secondary" href="list_Gouvernorats.php">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
