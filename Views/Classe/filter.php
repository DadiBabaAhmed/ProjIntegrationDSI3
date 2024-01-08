<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Liste des Classes</title>
    <style>
        @media print {

            #serachform,
            #actionButtons,
            #actions,
            #prbtn {
                display: none;
            }

            #serachform {
                margin: 200px;
                padding: 200px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        // Include the database connection code
        include "../../DataBase/Database.php";
        include "../../Classes/Classe.php";
        $db = new Database();
        $classe = new Classe($db->getConnection());
        ?>

        <!-- Search form -->
        <div id="serachform">
            <form method="get" id="serachform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="form-group">
                    <input id="serachbar" type="text" name="search" class="form-control" placeholder="Search...">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
                <a class="btn btn-secondary" href="list_classes.php">Cancel</a>
            </form>
        </div>

        <br>
        <br>
        <!-- Table -->
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Code Classe</th>
                    <th>Int Classe</th>
                    <th>Departement</th>
                    <th>Options</th>
                    <th>Niveau</th>
                    <th id="actions">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $filteredClasses = []; // Initialize the variable
                
                // Handling search
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $filteredClasses = $classe->search($search);
                }

                // Display data in the table
                foreach ($filteredClasses as $row) { ?>
                    <tr>
                        <td>
                            <?php echo $row['CodClasse']; ?>
                        </td>
                        <td>
                            <?php echo $row['IntClasse']; ?>
                        </td>
                        <td>
                            <?php echo $row['Département']; ?>
                        </td>
                        <td>
                            <?php echo $row['Opti_on']; ?>
                        </td>
                        <td>
                            <?php echo $row['Niveau']; ?>
                        </td>
                        <td id="actionButtons">
                            <a href="edit_classe.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_classe.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this Classe?');">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button onclick="printData()" id="prbtn" class="btn btn-success">Print</button>
    </div>

    <!-- Add Bootstrap JS -->
    <script>
        function printData() {
            window.print();
        }
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>