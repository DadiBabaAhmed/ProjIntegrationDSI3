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

<body>
    <div class="container">
        <h2 class="mt-3">List of Etudiants</h2>
        <a class="btn btn-primary mt-3" href="list_etudiants_reduced.php">Informations réduites</a>
            <a class="btn btn-primary mt-3" href="add_etudiant.php">Add Etudiant</a>
        <a class="btn btn-primary mt-3" href="filtre_etudiant.php">filtrage et print</a>
    </div>
    <table id="table-to-print" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>NCIN</th>

                <th>Nom</th>

                <th>Date de Naissance</th>

                <th>NCE</th>

                <th>Type de Bac</th>

                <th>Prénom</th>

                <th>Sexe</th>

                <th>Lieu de Naissance</th>

                <th>Adresse</th>

                <th>Ville</th>

                <th>Code Postal</th>

                <th>Numéro de Téléphone</th>

                <th>Code de Classe</th>

                <th>Décision du Conseil</th>

                <th>Année Universitaire</th>

                <th>Semestre</th>

                <th>Dispenser</th>

                <th>Années d'Opt</th>

                <th>Date Première Inscription</th>

                <th>Gouvernorat</th>

                <th>Mention du Bac</th>

                <th>Nationalité</th>

                <th>Code CNSS</th>

                <th>Nom Arabe</th>

                <th>Prénom Arabe</th>

                <th>Lieu de Naissance Arabe</th>

                <th>Adresse Arabe</th>

                <th>Ville Arabe</th>

                <th>Gouvernorat Arabe</th>

                <th>Type de Bac (AB)</th>

                <th>Photo</th>

                <th>Origine</th>

                <th>Situation de Départ</th>

                <th>NBAC</th>

                <th>Redoublement</th>

                <th>Edit</th>

                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $etudiants->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row["NCIN"] ?? "vide"; ?></td>
                    <td><?php echo $row["Nom"] ?? "vide"; ?></td>
                    <td><?php echo $row["DateNais"] ?? "vide"; ?></td>
                    <td><?php echo $row["NCE"] ?? "vide"; ?></td>
                    <td><?php echo $row["TypBac"] ?? "vide"; ?></td>
                    <td><?php echo $row["Prénom"] ?? "vide"; ?></td>
                    <td><?php if($row["Sexe"] ==1){echo "Homme";}else if($row["Sexe"] ==2){echo "femme";} else{ "vide";} ?></td>
                    <td><?php echo $row["LieuNais"] ?? "vide"; ?></td>
                    <td><?php echo $row["Adresse"] ?? "vide"; ?></td>
                    <td><?php echo $row["Ville"] ?? "vide"; ?></td>
                    <td><?php echo $row["CodePostal"] ?? "vide"; ?></td>
                    <td><?php echo $row["N°Tél"] ?? "vide"; ?></td>
                    <td><?php echo $row["CodClasse"] ?? "vide"; ?></td>
                    <td><?php echo $row["DécisionduConseil"] ?? "vide"; ?></td>
                    <td><?php echo $row["AnnéeUnversitaire"] ?? "vide"; ?></td>
                    <td><?php echo $row["Semestre"] ?? "vide"; ?></td>
                    <td><?php echo $row["Dispenser"] ? "oui" : "non"; ?></td>
                    <td><?php echo $row["Anneesopt"] ?? "vide"; ?></td>
                    <td><?php echo $row["DatePremièreInscp"] ?? "vide"; ?></td>
                    <td><?php echo $row["Gouvernorat"] ?? "vide"; ?></td>
                    <td><?php echo $row["Mention du Bac"] ?? "vide"; ?></td>
                    <td><?php echo $row["Nationalité"] ?? "vide"; ?></td>
                    <td><?php echo $row["CodeCNSS"] ?? "vide"; ?></td>
                    <td><?php echo $row["NomArabe"] ?? "vide"; ?></td>
                    <td><?php echo $row["PrenomArabe"] ?? "vide"; ?></td>
                    <td><?php echo $row["LieuNaisArabe"] ?? "vide"; ?></td>
                    <td><?php echo $row["AdresseArabe"] ?? "vide"; ?></td>
                    <td><?php echo $row["VilleArabe"] ?? "vide"; ?></td>
                    <td><?php echo $row["GouvernoratArabe"] ?? "vide"; ?></td>
                    <td><?php echo $row["TypeBacAB"] ?? "vide"; ?></td>
                    <td><?php echo $row["Photo"] ?? "vide"; ?></td>
                    <td><?php echo $row["Origine"] ?? "vide"; ?></td>
                    <td><?php echo $row["SituationDpart"] ?? "vide"; ?></td>
                    <td><?php echo $row["NBAC"] ?? "vide"; ?></td>
                    <td><?php echo $row["Redaut"] ?? "vide"; ?></td>

                    <td><a class="btn btn-warning" href="edit_etudiant.php?NCIN=<?php echo $row["NCIN"]; ?>">Edit</a></td>
                    <td><a class="btn btn-danger" href="delete_etudiant.php?NCIN=<?php echo $row["NCIN"]; ?>">Delete</a></td>
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