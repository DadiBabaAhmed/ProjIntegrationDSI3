<?php
include "../../DataBase/Database.php";
include "../../Classes/Semaine.php";

$db = new Database();
$semaine = new Semaine($db->getConnection());
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the filter criteria and value from the query string
    $critere = $_POST["critere"];
    $val = $_POST["val"];
    // Search for semaines based on the filter criteria and value
    $semaineList = $semaine->search($critere, $val);
} else {
    // If form is not submitted, get all semaines
    $semaineList = $semaine->getAllSemaines();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Semaine List</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Semaine List</h1>
        <a href="list_semaines.php" class="btn btn-primary">Retour</a>
        <br>
        <br>    
        <form action="filtre_semaines.php" method="POST">
            <label for="critere">Filter by:</label>
            <select name="critere" id="critere">
                <option value="NumSem">NumSem</option>
                <option value="DateDebut">DateDebut</option>
                <option value="DateFin">DateFin</option>
                <option value="Session">Session</option>
            </select>
            <input type="text" name="val" id="val" placeholder="Enter value">
            <script>
                var critereSelect = document.getElementById("critere");
                var valInput = document.getElementById("val");

                critereSelect.addEventListener("change", function () {
                    if (critereSelect.value === "NumSem") {
                        valInput.type = "number";
                    } else if (critereSelect.value === "DateDebut") {
                        valInput.type = "date";
                    } else if (critereSelect.value === "DateFin") {
                        valInput.type = "date";
                    } else if (critereSelect.value === "Session") {
                        valInput.type = "number";
                    }
                });
            </script>
            <button type="submit">Filter</button>
        </form>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>NumSem</th>
                    <th>DateDebut</th>
                    <th>DateFin</th>
                    <th>Session</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($semaineList as $semaine) {
                    $sql = "SELECT Annee, Sem FROM session WHERE Numero = " . $semaine['Session'] . "";
                    $sessionResult = $db->getConnection()->query($sql);

                    // Fetch the result and get the 'Annee' value
                    $sessionList = $sessionResult->fetch_assoc(); // Fetch the data as an associative array
                    $annee = $sessionList['Annee']."-".$sessionList['Sem']; ?>
                    <tr>
                        <td>
                            <?php echo $semaine['NumSem']; ?>
                        </td>
                        <td>
                            <?php echo $semaine['DateDebut']; ?>
                        </td>
                        <td>
                            <?php echo $semaine['DateFin']; ?>
                        </td>
                        <td>
                            <?php echo $annee ?>
                        </td>
                        <td>
                            <a href="edit_semaine.php?idSem=<?php echo $semaine['idSem']; ?>"
                                class="btn btn-primary">Edit</a>
                            <a href="delete_semaine.php?idSem=<?php echo $semaine['idSem']; ?>"
                                class="btn btn-danger" onclick="return confirm(`Are you sure you want to delete this Semain?`);">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>