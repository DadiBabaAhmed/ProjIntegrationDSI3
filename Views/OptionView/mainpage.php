<?php 
    include('../../DataBase/connect.php'); 
    include('../../DataBase/DataBase.php');
    include('../../Classes/Option.php');
    include('../../Classes/Departement.php');

    $db = new DataBase();
    $option = new Option($db->getConnection());
    $departement = new Departement($db->getConnection());

    $listOption = $option->getOptionsNames();
    $departementList = $departement->getDepartmentsNames();

?>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">

<?php
$searchDepartement = "";

if(isset($_POST['ajouter'])) {
    $optionName = $_POST['optionName'];
    $departement = $_POST['departement'];
    $optionArab = $_POST['optionArab'];

    // Vérifier si l'option existe déjà dans la base de données
    $checkQuery = "SELECT * FROM `options` WHERE `Option_Name` = '$optionName'";
    $checkResult = mysqli_query($con, $checkQuery);

    if(mysqli_num_rows($checkResult) > 0) {
        // L'enregistrement existe déjà, afficher un message d'erreur
        $Message = "Erreur : L'enregistrement existe déjà.";
    } else {
        // L'enregistrement n'existe pas, procéder à l'ajout
        $query = "INSERT INTO `options` (`Option_Name`, `Departement`, `Option_AraB`) VALUES ('$optionName', '$departement', '$optionArab')";
        $result = mysqli_query($con, $query);

        if(!$result) {
            die("Query failed: ".mysqli_error($con));
        }
    }
}

    if(isset($_POST['modifier'])) {
        $id = $_POST['id'];
        $optionName = $_POST['optionName'];
        $departement = $_POST['departement'];
        $optionArab = $_POST['optionArab'];

        // Requête de mise à jour
        $query = "UPDATE `options` SET `Option_Name` = '$optionName', `Departement` = '$departement', `Option_AraB` = '$optionArab' WHERE `Code_Option` = '$id'";
        $result = mysqli_query($con, $query);

        if(!$result) {
            die("Query failed: ".mysqli_error($con));
        }
    }

    if(isset($_POST['supprimer'])) {
        $id = $_POST['id'];

        // Requête de suppression
        $query = "DELETE FROM `options` WHERE `Code_Option` = '$id'";
        $result = mysqli_query($con, $query);

        if(!$result) {
            die("Query failed: ".mysqli_error($con));
        }
    }

    if(isset($_POST['buttonfiltre'])) {
        $searchDepartement = $_POST['searchDepartement'];
    }
    ?>
<head>
    <title>Options</title>
</head>
<?php include '../inc/header.php'; ?>

    <div class="container" style="margin-top: 100px;">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="text-center m-0">liste</h2>
            <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Ajouter</button>
        </div>
        <form method="POST" class="mb-3">
            <div class="form-group">
                <select class="form-control" name="searchDepartement" id="searchDepartement">
                    <option value="">Tous les départements</option>
                    <?php
                    // Récupérer la liste des départements depuis la base de données
                    $queryDepartements = "SELECT DISTINCT `Departement` FROM `options`";
                    $resDepartements = mysqli_query($con, $queryDepartements);

                    if(!$resDepartements) {
                        die("query failed".mysqli_error($con));
                    } else {
                        while($rowDepartement = mysqli_fetch_assoc($resDepartements)) {
                            $selected = isset($_GET['searchDepartement']) && $_GET['searchDepartement'] == $rowDepartement['Departement'] ? 'selected' : '';
                            echo "<option value='{$rowDepartement['Departement']}' $selected>{$rowDepartement['Departement']}</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            </div>
            <button type="submit" class="btn btn-primary" name="buttonfiltre">Filtrer</button>
        </form>

        <div class="table-responsive">
            <table class="table table-sm table-striped mx-auto">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Option Name</th>
                        <th scope="col">Departement</th>
                        <th scope="col">Option Arab</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if($searchDepartement == "") {
                        $query = "SELECT * FROM `options`";
                    } else {
                        $query = "SELECT * FROM `options` WHERE `Departement` = '$searchDepartement'";
                    }

                    $res = mysqli_query($con, $query);

                    if(!$res) {
                        die("query failed".mysqli_error($con));
                    } else {
                        while($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <tr>
                                <td>
                                    <?php echo $row['Option_Name']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Departement']; ?>
                                </td>
                                <td>
                                    <?php echo $row['Option_AraB']; ?>
                                </td>
                                <td>
                                    <button class="btn btn-primary open-modal-modifier" data-toggle="modal"
                                        data-target="#modifierModal"
                                        data-parametres='{"id": "<?php echo $row['Code_Option']; ?>", "optionName": "<?php echo $row['Option_Name']; ?>", "departement": "<?php echo $row['Departement']; ?>", "optionArab": "<?php echo $row['Option_AraB']; ?>"}'>
                                        Modifier
                                    </button>
                                </td>
                                <td>
                                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <input type="hidden" name="id" value="<?php echo $row['Code_Option']; ?>">
                                        <button type="submit" class="btn btn-danger" name="supprimer">Supprimer</button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal ajout -->
    <form method="post">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Ajouter</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="optionName">Option Name</label>
                            <input type="text" class="form-control" name="optionName" placeholder="Enter Option Name">
                        </div>
                        <div class="form-group">
                            <label for="departement">Departement</label>
                            <select name="departement" id="departement" class="form-control">
                                <?php
                                foreach ($departementList as $row) { ?>
                                    <option class="form-control" value="<?php echo $row['CodeDep'] ?>"><?php echo $row['CodeDep'] ?>-<?php echo $row['Departement'] ?></option>";
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="optionArab">Option Arab</label>
                            <input type="text" class="form-control" name="optionArab" placeholder="Enter Option Arab">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <input type="submit" class="btn btn-success" name="ajouter" value="Ajouter">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Modal modif -->
    <form method="post">
        <div class="modal fade" id="modifierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">Modifier</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="optionName">Option Name</label>
                            <input type="text" class="form-control" name="optionName" id="optionName">
                        </div>
                        <div class="form-group">
                            <label for="departement">Departement</label>
                            <select name="departement" id="departement" class="form-control">
                                <?php 
                                foreach ($departementList as $row) { ?>
                                    <option class="form-control" value="<?php echo $row['CodeDep'] ?>"><?php echo $row['CodeDep'] ?>-<?php echo $row['Departement'] ?></option>";
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="optionArab">Option Arab</label>
                            <input type="text" class="form-control" name="optionArab" id="optionArab">
                        </div>
                        <input type="text" class="form-control" name="id" id="id" style="display:none;">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        <input type="submit" class="btn btn-success" name="modifier" value="Modifier">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- Include Bootstrap JS (optional, only if you need Bootstrap features that require JS) -->
    <script>
        $(document).ready(function () {
            $('.open-modal-modifier').click(function () {
                var parametres = $(this).data('parametres');
                var id = parametres.id;
                var optionName = parametres.optionName;
                var departement = parametres.departement;
                var optionArab = parametres.optionArab;
                $('#modifierModal').modal('show');
                $('#id').val(id);
                $('#optionName').val(optionName);
                $('#departement').val(departement);
                $('#optionArab').val(optionArab);
            });
        });
    </script>
