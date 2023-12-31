<?php
include('../../DataBase/connect.php');
include('../../DataBase/DataBase.php');
include('../../Classes/Option.php');

$db = new DataBase();
$option = new Option($db->getConnection());

$listOption = $option->getOptionsNames();

?>

<!-- Include Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="style.css">

<?php
$searchNiveau = "";

if (isset($_POST['ajouter'])) {
    $niveau = $_POST['niveau'];
    $option = $_POST['option'];

    // Vérifier si le niveau et l'option existent déjà dans la base de données
    $checkQuery = "SELECT * FROM `optionniveau` WHERE `Niveau` = '$niveau' AND `Option` = '$option'";
    $checkResult = mysqli_query($con, $checkQuery);

    if (mysqli_num_rows($checkResult) > 0) {
        // L'enregistrement existe déjà, afficher un message d'erreur
        $Message = "Erreur : L'enregistrement  existe déjà.";
    } else {
        // L'enregistrement n'existe pas, procéder à l'ajout
        $query = "INSERT INTO `optionniveau` (`Niveau`, `Option`) VALUES ('$niveau', '$option')";
        $result = mysqli_query($con, $query);

        if (!$result) {
            die("Query failed: " . mysqli_error($con));
        }
    }
}

if (isset($_POST['modifier'])) {
    $id = $_POST['id'];
    $niveau = $_POST['niveau'];
    $option = $_POST['option'];


    //  requête de mise à jour 

    $query = "UPDATE `optionniveau` SET `Niveau` = '$niveau', `Option` = '$option' WHERE `id` = '$id'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }
}

if (isset($_POST['supprimer'])) {
    $id = $_POST['id'];

    // Requête de suppression
    $query = "DELETE FROM `optionniveau` WHERE `id` = '$id'";
    $result = mysqli_query($con, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }
}

if (isset($_POST['buttonfiltre'])) {
    $searchNiveau = $_POST['searchNiveau'];
}
?>

<head>
    <title>OptionNiveau</title>
</head>
<?php include '../inc/header.php'; ?>

<div class="container" style="margin-top: 100px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="text-center m-0">liste</h2>
        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Ajouter</button>
    </div>
    <form method="POST" class="mb-3">
        <div class="form-group">
            <select class="form-control" name="searchNiveau" id="searchNiveau">
                <option value="">Tous les niveaux</option>
                <?php
                // Récupérer la liste des niveaux depuis la base de données
                $queryNiveaux = "SELECT DISTINCT `Niveau` FROM `optionniveau`";
                $resNiveaux = mysqli_query($con, $queryNiveaux);

                if (!$resNiveaux) {
                    die("query failed" . mysqli_error($con));
                } else {
                    while ($rowNiveau = mysqli_fetch_assoc($resNiveaux)) {
                        $selected = isset($_GET['searchNiveau']) && $_GET['searchNiveau'] == $rowNiveau['Niveau'] ? 'selected' : '';
                        echo "<option value='{$rowNiveau['Niveau']}' $selected>{$rowNiveau['Niveau']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="buttonfiltre">Filtrer</button>
    </form>

    <div class="table-responsive">
        <table class="table table-sm table-striped mx-auto">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Niveau</th>
                    <th scope="col">Option</th>
                    <th scope="col">Modifier</th>
                    <th scope="col">Supprimer</th>


                </tr>
            </thead>
            <tbody>
                <?php
                if ($searchNiveau == "") {
                    $query = "select * from optionniveau ";
                } else {
                    $query = "select * from optionniveau where Niveau =" . $searchNiveau;
                }

                $res = mysqli_query($con, $query);

                if (!$res) {
                    die("query failed" . mysqli_error($con));
                } else {
                    while ($row = mysqli_fetch_assoc($res)) {
                ?>
                        <tr>

                            <td>
                                <?php echo $row['Niveau']; ?>
                            </td>
                            <td>
                                <?php echo $row['Option']; ?>
                            </td>

                            <td>
                                <button class="btn btn-primary open-modal-modifier" data-toggle="modal" data-target="#modifierModal" data-parametres='{"id": "<?php echo $row['id']; ?>", "niveau": "<?php echo $row['Niveau']; ?>", "option": "<?php echo $row['Option']; ?>"}'>
                                    Modifier
                                </button>
                            </td>

                            <td>
                                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger" name="supprimer">Supprimer</button>
                                </form>
                                <!-- <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="deleteForm">
                                        <input type="hidden" name="id" id="deleteId">
                                        <button type="submit" class="btn btn-danger" onclick="confirmDelete()">Supprimer</button>
                                    </form> -->
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
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Ajouter</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your modal content goes here -->
                    <!-- Replace the following placeholder content with your form or other content -->

                    <div class="form-group">
                        <label for="niveau">niveau</label>
                        <input type="text" class="form-control" name="niveau" placeholder="enter niveau">
                    </div>
                    <div class="form-group">
                        <label for="option">option</label>
                        <select class="form-control" name="option" id="option">
                            <?php
                            foreach ($listOption as $row) { ?>
                                <option value="<?php echo $row['Code_Option'] ?>">
                                    <?php echo $row['Option_Name'] ?>
                                </option>";
                            <?php } ?>
                        </select>
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
    <div class="modal fade" id="modifierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Modifier</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your modal content goes here -->
                    <!-- Replace the following placeholder content with your form or other content -->

                    <div class="form-group">
                        <label for="niveau">niveau</label>
                        <input type="text" class="form-control" name="niveau" id="niveau">
                    </div>
                    <div class="form-group">
                        <label for="option">option</label>
                        <select class="form-control" name="option" id="option">
                            <?php
                            foreach ($listOption as $row) { ?>
                                <option value="<?php echo $row['Code_Option'] ?>">
                                    <?php echo $row['Option_Name'] ?>
                                </option>";
                            <?php } ?>
                        </select>
                    </div>
                    <input type="text" class="form-control" name="id" id="id" style="display:none;">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-success" name="modifier" value="modifier">
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
    $(document).ready(function() {
        $('.open-modal-modifier').click(function() {
            var parametres = $(this).data('parametres');
            var id = parametres.id;
            var niveau = parametres.niveau;
            var option = parametres.option;
            $('#modifierModal').modal('show');
            $('#id').val(id);
            $('#niveau').val(niveau);
            $('#option').val(option);
        });
    });
    //dialoge supression
    // function confirmDelete(id) {
    //     var result = confirm("Êtes-vous sûr de vouloir supprimer cet élément ?");
    //     if (result) {
    //         // Si l'utilisateur clique sur OK, soumettez le formulaire de suppression
    //         document.getElementById('deleteForm').elements['id'].value = id;
    //         document.getElementById('deleteForm').submit();
    //     } else {
    //         // Sinon, ne faites rien
    //     }
    // }
</script>