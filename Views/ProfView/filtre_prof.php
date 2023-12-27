<?php
include "../../DataBase/Database.php";
include "../../Classes/Prof.php";

$db = new Database();
$prof = new Prof($db->getConnection());
$profs = $prof->getAllProfessors();
$filterOptions = [
    "Matricule" => "Matricule",
    "CIN" => "CIN",
    "Diplôme" => "Diplôme",
];
$professors = null;
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filterValues = [];

    foreach ($filterOptions as $key => $value) {
        if (isset($_POST[$key]) && !empty($_POST[$key])) {
            $filterValues[$key] = $_POST[$key];
        }
    }
    $professors = $prof->filterProfs($filterValues); // Assuming you have a method to fetch all professors
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Filtre Professors</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Filtre of Professors</h2>
        <form method="POST" class="mt-3">
            <?php foreach ($filterOptions as $key => $value) : ?>
                <div class="form-row">
                    <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" class="form-control" placeholder="<?php echo $value; ?> Filter">
                </div>
            <?php endforeach; ?>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-success" id="exportButton">Export to Excel</button>
            </div>
            <div class="col-md-4">
                <br>
                <a class="btn btn-secondary" href="list_profs.php">Return</a>
            </div>
    </div>
    </form>
    <table id="table-to-print" class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Matricule Prof</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>CIN ou Passeport</th>
                <th>Identifiant CNRPS</th>
                <th>Date de naissance</th>
                <th>Nationalité</th>
                <th>Sexe (M/F)</th>
                <th>Date Ent Adm</th>
                <th>Date Ent Etbs</th>
                <th>Diplôme</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Code postal</th>
                <th>N° Téléphone</th>
                <th>Grade</th>
                <th>Date de nomination dans le grade</th>
                <th>Date de titulirisation</th>
                <th>N° Poste</th>
                <th>Département</th>
                <th>Situation</th>
                <th>Spécialité</th>
                <th>N° de Compte</th>
                <th>Banque</th>
                <th>Agence</th>
                <th>Adr pendant les vacances</th>
                <th>Tél pendant les vacances</th>
                <th>Lieu de naissance</th>
                <th>Début du Contrat</th>
                <th>Fin du Contrat</th>
                <th>Type de Contrat</th>
                <th>NB contrat ISETSOUSSE</th>
                <th>NB contrat Autre Etb</th>
                <th>Bureau</th>
                <th>Email</th>
                <th>Email Interne</th>
                <th>NomArabe</th>
                <th>PrenomArabe</th>
                <th>LieuNaisArabe</th>
                <th>AdresseArabe</th>
                <th>VilleArabe</th>
                <th>Disponible</th>
                <th>SousSP</th>
                <th>EtbOrigine</th>
                <th>TypeEnsg</th>
                <th>ControlAcces</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php if ($professors !== null) { 
        while ($row = $professors->fetch_assoc()) : ?>
                <tr>
                    <td><?php echo $row['Matricule']; ?></td>
                    <td><?php echo $row['Nom']; ?></td>
                    <td><?php echo $row['Prenom']; ?></td>
                    <td><?php echo $row['CIN']; ?></td>
                    <td><?php echo $row['Identifiant CNRPS']; ?></td>
                    <td><?php echo $row['Date de naissance']; ?></td>
                    <td><?php echo $row['Nationalité']; ?></td>
                    <td><?php echo $row['Sexe (M/F)']; ?></td>
                    <td><?php echo $row['Date Ent Adm']; ?></td>
                    <td><?php echo $row['Date Ent Etbs']; ?></td>
                    <td><?php echo $row['Diplôme']; ?></td>
                    <td><?php echo $row['Adresse']; ?></td>
                    <td><?php echo $row['Ville']; ?></td>
                    <td><?php echo $row['Code postal']; ?></td>
                    <td><?php echo $row['N° Téléphone']; ?></td>
                    <td><?php echo $row['Grade']; ?></td>
                    <td><?php echo $row['Date de nomination dans le grade']; ?></td>
                    <td><?php echo $row['Date de titulirisation']; ?></td>
                    <td><?php echo $row['N° Poste']; ?></td>
                    <td><?php echo $row['Département']; ?></td>
                    <td><?php echo $row['Situation']; ?></td>
                    <td><?php echo $row['Spécialité']; ?></td>
                    <td><?php echo $row['N° de Compte']; ?></td>
                    <td><?php echo $row['Banque']; ?></td>
                    <td><?php echo $row['Agence']; ?></td>
                    <td><?php echo $row['Adr pendant les vacances']; ?></td>
                    <td><?php echo $row['Tél pendant les vacances']; ?></td>
                    <td><?php echo $row['Lieu de naissance']; ?></td>
                    <td><?php echo $row['Début du Contrat']; ?></td>
                    <td><?php echo $row['Fin du Contrat']; ?></td>
                    <td><?php echo $row['Type de Contrat']; ?></td>
                    <td><?php echo $row['NB contrat ISETSOUSSE']; ?></td>
                    <td><?php echo $row['NB contrat Autre Etb']; ?></td>
                    <td><?php echo $row['Bureau']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Email Interne']; ?></td>
                    <td><?php echo $row['NomArabe']; ?></td>
                    <td><?php echo $row['PrenomArabe']; ?></td>
                    <td><?php echo $row['LieuNaisArabe']; ?></td>
                    <td><?php echo $row['AdresseArabe']; ?></td>
                    <td><?php echo $row['VilleArabe']; ?></td>
                    <td><?php echo $row['Disponible']; ?></td>
                    <td><?php echo $row['SousSP']; ?></td>
                    <td><?php echo $row['EtbOrigine']; ?></td>
                    <td><?php echo $row['TypeEnsg']; ?></td>
                    <td><?php echo $row['ControlAcces']; ?></td>
                    <td>
                        <a href="edit_prof.php?Matricule=<?php echo $row['Matricule']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_prof.php?Matricule=<?php echo $row['Matricule']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php endwhile;} ?>
        </tbody>
    </table>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function exportToCSV() {
        const table = document.getElementById("table-to-print");
        const rows = table.querySelectorAll("tr");
        let csv = [];

        for (const row of rows) {
            const rowData = [];
            for (const cell of row.querySelectorAll("td, th")) {
                rowData.push(cell.innerText);
            }
            csv.push(rowData.join(","));
        }

        const csvContent = "data:text/csv;charset=utf-8," + csv.join("\n");
        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Professors.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    document.getElementById("exportButton").addEventListener("click", function() {
        exportToCSV();
    });
</script>
</body>

</html>