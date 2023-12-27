<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
include "../../DataBase/connexion.php";

if(isset($_GET['action'])) {
    $action = $_GET['action'];

    if($action == 'supprimer') {
        $NumIns = (int)$_GET['NumIns'];
        $req_supprimer = "DELETE FROM Inscriptions WHERE NumIns = $NumIns";
        $res_supprimer = $conn->query($req_supprimer);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Liste des Inscriptions</title>
    <link rel="stylesheet" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" href="src/css/all.min.css">
</head>
<style>
    .custom-width {
        width: 300px;
        margin: 0 0 0 auto;
    }
</style>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-0 text-danger">Liste des Inscriptions</h5>
                    </div>

                    <div class="container mt-1">
                        <form method="GET" action="">
                            <div class="form-group">
                                <select class="form-select custom-width" id="searchField" name="searchField">
                                    <option value="NumIns">Numero d'inscription :</option>
                                    <option value="MatEtud">Matricule de l'Étudiant</option>
                                </select>
                            </div>
                            <div class="input-group mb-3 custom-width">
                                <input type="text" class="form-control" placeholder="Rechercher..." id="searchInput"
                                    name="searchValue">
                                <div class="input-group-append">
                                    <button class="btn btn-danger" id="searchButton" type="submit">Rechercher</button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table no-wrap user-table mb-0">
                            <thead>
                                <tr>
                                    <th scope="col" class="border-0 text-uppercase font-medium pl-4">NumIns</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">CodeClasse</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">MatEtud</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Session</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">DateInscription</th>
                                    <th scope="col" class="border-0 text-uppercase font-medium">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_GET['searchField']) != "" && isset($_GET['searchValue']) != "") {
                                    $searchField = $_GET['searchField'];
                                    $searchValue = $_GET['searchValue'];
                                    $sql = "SELECT * FROM Inscriptions WHERE $searchField = :searchValue";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->bindParam(':searchValue', $searchValue, PDO::PARAM_STR);
                                    $stmt->execute();
                                } else {
                                    $sql = "SELECT * FROM Inscriptions";
                                    $stmt = $conn->query($sql);
                                }

                                if($stmt->rowCount() > 0) {
                                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $row["NumIns"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["CodeClasse"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["MatEtud"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["Session"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $row["DateInscription"]; ?>
                                            </td>
                                            <td>
                                                <ul class="list-unstyled mb-0 d-flex">
                                                    <li><a href="afficher_by_mum.php?action=afficher&NumIns=<?php echo $row['NumIns']; ?>"
                                                            class="text-primary" data-toggle="tooltip" title=""
                                                            data-original-title="view"><i class="far fa-eye px-2"></i></a></li>
                                                    <li><a href="modifier_by_num.php?action=modifier&NumIns=<?php echo $row['NumIns']; ?>"
                                                            data-toggle="tooltip" title="" data-original-title="Edit"><i
                                                                class="fas fa-pencil-alt px-2"></i></a></li>
                                                    <li><a href="?action=supprimer&NumIns=<?php echo $row['NumIns']; ?>"
                                                            class="text-danger" data-toggle tooltip title=""
                                                            data-original-title="Delete"><i
                                                                class="far fa-trash-alt px-2"></i></a></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>Aucun résultat trouvé dans la table Inscriptions.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>