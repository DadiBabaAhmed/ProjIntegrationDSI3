<!DOCTYPE html>
<html>

<head>
    <title>Liste des enregistrements DossierEtud</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            color: blue;
        }

        a:hover {
            text-decoration: none;
            color: #007bff;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Liste des enregistrements DossierEtud</h2>
        <a class="btn btn-success mb-3" href="create.php">Ajouter un dossier</a>
        <table class="table table-bordered mt-3">
            <thead class="thead-light">
                <tr>
                    <th>Ndossier</th>
                    <th>Motif</th>
                    <th>MatEtud</th>
                    <th>TypePiece</th>
                    <th>DatePiece</th>
                    <th>Session</th>
                    <th>Nomfichierpiece</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                // Replace these with your database connection details
                include "../../DataBase/connexion.php";

                try {
                    // SQL query to select data from the "DossierEtud" table
                    $sql = "SELECT * FROM DossierEtud";
                    $result = $conn->query($sql);

                    foreach ($result as $row) {
                        echo "<tr>";
                        echo "<td>" . $row['Ndossier'] . "</td>";
                        echo "<td>" . $row['Motif'] . "</td>";
                        echo "<td>" . $row['MatEtud'] . "</td>";
                        echo "<td>" . $row['TypePiece'] . "</td>";
                        echo "<td>" . $row['DatePiece'] . "</td>";
                        echo "<td>" . $row['Session'] . "</td>";
                        echo "<td>" . $row['nomfichierpiece'] . "</td>";
                        echo '<td><a href="modifier.php?Ndossier=' . $row['Ndossier'] . '">Modifier</a> | ';
                        echo '<a href="supprimer.php?Ndossier=' . $row['Ndossier'] . '&&nom=' . $row['nomfichierpiece'] . '">Supprimer</a></td>';
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "Erreur : " . $e->getMessage() . " " . "<a href='affichage.php'>Retour</a>";
                }

                $conn = null;
                ?>

            </tbody>
        </table>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>