<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Liste des Départements</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Liste des Départements</h2>
        <?php
        // Inclure le code de connexion à la base de données
        // require '../departements/connexion.php';
        include "../../DataBase/Database.php";
        include "../../Classes/Departement.php";

        $idcom = new Database();
        $departement = new Departement($idcom->getConnection());

        // Traitement de la suppression
        if (isset($_GET['action']) && isset($_GET['id'])) {
            if ($_GET['action'] == 'delete') {
                $idToDelete = $_GET['id'];
                try {
                    $departement->deleteDepartment($idToDelete);
                    echo "Enregistrement supprimé avec succès.";
                } catch (PDOException $e) {
                    echo "Erreur lors de la suppression : " . $e->getMessage();
                }
            }
        }
        ?>

        <!-- Barre de recherche -->
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher...">
            </div>
            <button type="submit" class="btn btn-primary">Rechercher</button>
            <a class="btn btn-secondary" href="list_departements.php">Retour</a>
            
        </form>
        <br>
        <!-- Tableau -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>CodeDep</th>
                    <th>Département</th>
                    <th>Responsable</th>
                    <th>Matricule Responsable</th>
                    <th>DépartementARAB</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filteredDepartements = []; // Initialize the variable

                // Traitement de la recherche
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $filteredDepartements = $departement->search($search);
                }

                // Affichage des données dans le tableau
                foreach ($filteredDepartements as $row) { ?>
                    <tr>
                        <td><?php echo $row['CodeDep']; ?></td>
                        <td><?php echo $row['Departement']; ?></td>
                        <td><?php echo $row['Responsable']; ?></td>
                        <td><?php echo $row['MatProf']; ?></td>
                        <td><?php echo $row['DepartementARAB']; ?></td>
                        <td>
                            <a href="edit_departement.php?CodeDep=<?php echo $row['CodeDep']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_departement.php?CodeDep=<?php echo $row['CodeDep']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this departement?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>