<?php
include "../../DataBase/Database.php";
include "../../Classes/Etudiant.php";

$db = new Database();
$etudiant = new Etudiant($db->getConnection());
$etudiants = $etudiant->read();
?>

<!DOCTYPE html>
<html>

<head>
    <title>List Etudiants</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<?php include '../inc/header.php'; ?>

<body>
    <div class="container">
        <h2 class="mt-3">Liste d'Etudiants reduite</h2>
        <a class="btn btn-primary mt-3" href="list_etudiants.php">Tous les informations</a>
    </div>
    <table id="table-to-print" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>NCIN</th>
                <th>NCE</th>
                <th>Code de Classe</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Sexe</th>
                <th>Date de Naissance</th>
                <th>Prénom Arabe</th>
                <th>Nom Arabe</th>
                <th>Numéro de Téléphone</th>
                <th>Ville</th>
                <th>Gouvernorat</th>
                <th>Année Universitaire</th>
                <th>Semestre</th>
                <th>Décision du Conseil</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $etudiants->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php echo $row["NCIN"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["NCE"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["CodClasse"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["Nom"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["Prénom"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php if ($row["Sexe"] == 1) {
                            echo "Homme";
                        } else if ($row["Sexe"] == 2) {
                            echo "femme";
                        } else {
                            "vide";
                        } ?>
                    </td>
                    <td>
                        <?php echo $row["DateNais"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["PrenomArabe"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["NomArabe"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["N°Tél"] ?? "vide"; ?>
                    </td>

                    <td>
                        <?php echo $row["Ville"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["Gouvernorat"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["AnnéeUnversitaire"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["Semestre"] ?? "vide"; ?>
                    </td>
                    <td>
                        <?php echo $row["DécisionduConseil"] ?? "vide"; ?>
                    </td>

                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>


    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>