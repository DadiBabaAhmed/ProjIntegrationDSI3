<?php
include "../../DataBase/Database.php";
include "../../Classes/Etudiant.php";

$db = new Database();
$etudiant = new Etudiant($db->getConnection());
$filteredetudiant = [];
$filterOptions = [
    "sexe" => "Sexe",
    "dispenser" => "Dispenser",
];
$filterOptions2 = [
    "NCIN" => "NCIN",
    "CodClasse" => "Code de Classe",
    "DateNais" => "Date de Naissance",
    "Gouvernorat" => "Gouvernorat",
];

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $filterValues = [];
    $searchValues = [];

    $etudiants_data = [];
    $etudiants1_data = [];

    foreach ($filterOptions as $key => $value) {
        if (isset($_POST[$key]) && !empty($_POST[$key])) {
            $filterValues[$key] = $_POST[$key];
        }
    }

    $critere = $_POST["critere"];
    $val = $_POST["val"];

    $etudiants1 = $etudiant->filterEtudiants($filterValues);
    $etudiants = $etudiant->search($critere, $val);

    while ($row = $etudiants->fetch_assoc()) {
        $etudiants_data[] = $row;
    }

    // Fetch data from search result set
    $etudiants1_data = [];
    while ($row = $etudiants1->fetch_assoc()) {
        $etudiants1_data[] = $row;
    }

    // Find common elements by comparing values
    $filteredetudiant = [];
    if(!empty($etudiants_data) && !empty($etudiants1_data)){
    foreach ($etudiants_data as $data1) {
        foreach ($etudiants1_data as $data2) {
            if ($data1 === $data2) {
                $filteredetudiant[] = $data1;
                break;
            }
        }
    }
}
else if(!empty($etudiants_data) && empty($etudiants1_data)){
    $filteredetudiant = $etudiants_data;
}
else if(empty($etudiants_data) && !empty($etudiants1_data)){
    $filteredetudiant = $etudiants1_data;
}
else{
    $filteredetudiant = [];
}
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>List Etudiants</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style type="text/css" media="print">
        /* Define print styles */
        body * {
            visibility: hidden;
        }

        #table-to-print,
        #table-to-print * {
            visibility: visible;
        }

        #table-to-print {
            page-break-before: always;
        }

        @page {
            size: A4;
            /* Set the page size to A4 or adjust to your desired page size */
            margin: 15mm;
            /* Adjust margins to your needs */
        }
    </style>

</head>

<body>
    <div class="container">
        <h2 class="mt-3 m-0">List of Etudiants</h2>
        <form method="POST" class="mt-3">
            <select name="critere" id="critere" class="form-control">
                <?php foreach ($filterOptions2 as $key => $value) : ?>
                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                <?php endforeach; ?>
            </select>
            <div class="form-group">
                <label for="critere">Filter Value:</label>
                <input type="text" name="val" id="val" class="form-control" placeholder="Enter Filter Value">
            </div>
            <?php foreach ($filterOptions as $key => $value) : ?>
                <div class="form-row">
                    <label for="<?php echo $key; ?>"><?php echo $value; ?>:</label>&emsp;
                    <?php if ($key === "sexe") : ?>
                        <input type="radio" name="<?php echo $key; ?>" value="1"> &ensp; Male &emsp;
                        <input type="radio" name="<?php echo $key; ?>" value="2"> &ensp; Female
                    <?php elseif ($key === "dispenser") : ?>
                        <input type="checkbox" name="<?php echo $key; ?>" id="<?php echo $key; ?>">&ensp; <?php echo $value; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <button type="button" class="btn btn-success" id="exportButton">Export to Excel</button>
            </div>
            <div class="col-md-4">
                <br>
                <a class="btn btn-secondary" href="list_etudiants.php">Return</a>
            </div>
    </div>
    </form>
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
            <?php foreach ($filteredetudiant as $row) : ?>
                <tr>
                    <td><?php echo $row["NCIN"] ?? "vide"; ?></td>

                    <td><?php echo $row["Nom"] ?? "vide"; ?></td>

                    <td><?php echo $row["DateNais"] ?? "vide"; ?></td>

                    <td><?php echo $row["NCE"] ?? "vide"; ?></td>

                    <td><?php echo $row["TypBac"] ?? "vide"; ?></td>

                    <td><?php echo $row["Prénom"] ?? "vide"; ?></td>

                    <td><?php if ($row["Sexe"] == 1) {
                            echo "Homme";
                        } else if ($row["Sexe"] == 2) {
                            echo "femme";
                        } else {
                            "vide";
                        } ?></td>

                    <td><?php echo $row["LieuNais"] ?? "vide"; ?></td>

                    <td><?php echo $row["Adresse"] ?? "vide"; ?></td>

                    <td><?php echo $row["Ville"] ?? "vide"; ?></td>

                    <td><?php echo $row["CodePostal"] ?? "vide"; ?></td>

                    <td><?php echo $row["N°Tél"] ?? "vide"; ?></td>

                    <td><?php echo $row["CodClasse"] ?? "vide"; ?></td>

                    <td><?php echo $row["DécisionduConseil"] ?? "vide"; ?></td>

                    <td><?php echo $row["AnnéeUnversitaire"] ?? "vide"; ?></td>

                    <td><?php echo $row["Semestre"] ?? "vide"; ?></td>

                    <td><?php echo $row["Dispenser"] ?? "vide"; ?></td>

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
                    <td><a class="btn btn-danger" href="delete_etudiant.php?NCIN=<?php echo $row["NCIN"]; ?>" onclick="return confirm('Are you sure you want to delete this Etudiant?');">Delete</a></td>
                </tr>
            <?php endforeach; ?>
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
            link.setAttribute("download", "etudiants.csv");
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