<?php
include "../../DataBase/Database.php";
include "../../Classes/Etudiant.php";
include "../../Classes/Classe.php";
include "../../Classes/Gouvernorat.php";

$db = new Database();
$etudiant = new Etudiant($db->getConnection());
$classe = new Classe($db->getConnection());
$gouvernorat = new Gouvernorat($db->getConnection());

$listclasses = $classe->getClasseNames();
$listgouvernorats = $gouvernorat->getAllCodes();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!preg_match("/^\d{8}$/", $_POST["NCIN"])) {
            $_SESSION['message'] = "NCIN doit contenir exactement 8 chiffres.";
            header("Location: add_etudiant.php");
            exit();
        }

        // Validate NCE (6 characters, first letter in caps and rest numbers)
        if (!preg_match("/^[A-Z]\d{5}$/", $_POST["NCE"])) {
            $_SESSION['message'] = "NCE doit commencer par une lettre majuscule suivie de 5 chiffres.";
            header("Location: add_etudiant.php");
            exit();
        }
        $dateOfBirth = $_POST["DateNais"];
        if (strtotime($dateOfBirth) === false || strtotime($dateOfBirth) > strtotime('-18 years')) {
            $_SESSION['message'] = "La date de naissance doit être valide et au moins 18 ans en arrière.";
            header("Location: add_etudiant.php");
            exit();
        }
        if (!isset($_POST["Sexe"])) {
            $_SESSION['message'] = "Veuillez sélectionner le sexe.";
            header("Location: add_etudiant.php");
            exit();
        }
        $etudiant->create(
            $_POST["Nom"],
            $_POST["DateNais"],
            $_POST["NCIN"],
            $_POST["NCE"],
            $_POST["TypBac"],
            $_POST["Prénom"],
            $_POST["Sexe"],
            $_POST["LieuNais"],
            $_POST["Adresse"],
            $_POST["Ville"],
            $_POST["CodePostal"],
            $_POST["N°Tél"],
            $_POST["CodClasse"],
            $_POST["DécisionduConseil"],
            $_POST["AnnéeUnversitaire"],
            $_POST["Semestre"],
            isset($_POST["Dispenser"]) ? 1 : 0,
            $_POST["Anneesopt"],
            $_POST["DatePremièreInscp"],
            $_POST["Gouvernorat"],
            $_POST["MentionduBac"],
            $_POST["Nationalité"],
            $_POST["CodeCNSS"],
            $_POST["NomArabe"],
            $_POST["PrenomArabe"],
            $_POST["LieuNaisArabe"],
            $_POST["AdresseArabe"],
            $_POST["VilleArabe"],
            $_POST["GouvernoratArabe"],
            $_POST["TypeBacAB"],
            $_POST["Photo"],
            $_POST["Origine"],
            $_POST["SituationDpart"],
            $_POST["NBAC"],
            $_POST["Redaut"]
        );
        header("Location: list_etudiants.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Etudiant</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Add Etudiant</h2>
        <form method="POST" action="add_etudiant.php">
            <div class="form-group">
                <label for="Nom">Nom:</label>
                <input type="text" class="form-control" name="Nom" placeholder="Nom" required>
            </div>

            <div class="form-group">
                <label for="DateNais">DateNais:</label>
                <input type="date" class="form-control" name="DateNais" id="DateNais" placeholder="DateNais" required>
            </div>

            <div class="form-group">
                <label for="NCIN">NCIN:</label>
                <input type="text" class="form-control" name="NCIN" placeholder="NCIN" required>
            </div>

            <div class="form-group">
                <label for="NCE">NCE:</label>
                <input type="text" class="form-control" name="NCE" placeholder="NCE" required>
            </div>

            <div class="form-group">
                <label for="TypBac">TypBac:</label>
                <input type="text" class="form-control" name="TypBac" placeholder="TypBac">
            </div>

            <div class="form-group">
                <label for="Prénom">Prénom:</label>
                <input type="text" class="form-control" name="Prénom" placeholder="Prénom" required>
            </div>

            <div class="form-group">
                <label for="Sexe">Sexe:</label>&emsp;
                <input type="radio" name="Sexe" value="1"> &ensp; Male &emsp;
                <input type="radio" name="Sexe" value="2"> &ensp; Female
            </div>

            <div class="form-group">
                <label for="LieuNais">LieuNais:</label>
                <input type="text" class="form-control" name="LieuNais" placeholder="LieuNais">
            </div>

            <div class="form-group">
                <label for="Adresse">Adresse:</label>
                <input type="text" class="form-control" name="Adresse" placeholder="Adresse">
            </div>

            <div class="form-group">
                <label for="Ville">Ville:</label>
                <input type="text" class="form-control" name="Ville" placeholder="Ville">
            </div>

            <div class="form-group">
                <label for="CodePostal">Code Postal:</label>
                <input type="number" class="form-control" name="CodePostal" placeholder="CodePostal">
            </div>

            <div class="form-group">
                <label for="N°Tél">N°Tél:</label>
                <input type="text" class="form-control" name="N°Tél" placeholder="N°Tél">
            </div>

            <div class="form-group">
                <label for="CodClasse">Code Classe:</label>
                <select name="CodClasse" class="form-control">
                    <?php foreach ($listclasses as $classe) : ?>
                        <option value="<?php echo $classe["CodClasse"]; ?>"><?php echo $classe["CodClasse"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="DécisionduConseil">Décision du Conseil:</label>
                <input type="text" class="form-control" name="DécisionduConseil" placeholder="DécisionduConseil">
            </div>

            <div class="form-group">
                <label for="AnnéeUnversitaire">AnnéeUnversitaire:</label>
                <input type="text" class="form-control" name="AnnéeUnversitaire" placeholder="AnnéeUnversitaire">
            </div>

            <div class="form-group">
                <label for="Semestre">Semestre:</label>
                <input type="number" class="form-control" name="Semestre" placeholder="Semestre">
            </div>

            <div class="form-check">
                <label for="Dispenser">Dispenser:</label>
                <input type="checkbox" name="Dispenser" value="1" require><br>
            </div>

            <div class="form-group">
                <label for="Anneesopt">Anneesopt:</label>
                <input type="date" class="form-control" name="Anneesopt" placeholder="Anneesopt">
            </div>

            <div class="form-group">
                <label for="DatePremièreInscp">Date Première Inscp:</label>
                <input type="date" class="form-control" name="DatePremièreInscp" placeholder="DatePremièreInscp">
            </div>

            <div class="form-group">
                <label for="Gouvernorat">Gouvernorat:</label>
                <select name="Gouvernorat" class="form-control">
                    <?php foreach ($listgouvernorats as $gouvernorat) : ?>
                        <option value="<?php echo $gouvernorat["Gouv"]; ?>"><?php echo $gouvernorat["Gouv"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="MentionduBac">Mention du Bac:</label>
                <input type="text" class="form-control" name="MentionduBac" placeholder="MentionduBac">
            </div>

            <div class="form-group">
                <label for="Nationalité">Nationalité:</label>
                <input type="text" class="form-control" name="Nationalité" placeholder="Nationalité">
            </div>

            <div class="form-group">
                <label for="CodeCNSS">Code CNSS:</label>
                <input type="text" class="form-control" name="CodeCNSS" placeholder="CodeCNSS">
            </div>

            <div class="form-group">
                <label for="NomArabe">NomArabe:</label>
                <input type="text" class="form-control" name="NomArabe" placeholder="NomArabe">
            </div>

            <div class="form-group">
                <label for="PrenomArabe">Prenom Arabe:</label>
                <input type="text" class="form-control" name="PrenomArabe" placeholder="PrenomArabe">
            </div>

            <div class="form-group">
                <label for="LieuNaisArabe">Lieu Nais Arabe:</label>
                <input type="text" class="form-control" name="LieuNaisArabe" placeholder="LieuNaisArabe">
            </div>

            <div class="form-group">
                <label for="AdresseArabe">Adresse Arabe:</label>
                <input type="text" class="form-control" name="AdresseArabe" placeholder="AdresseArabe">
            </div>

            <div class="form-group">
                <label for="VilleArabe">Ville Arabe:</label>
                <input type="text" class="form-control" name="VilleArabe" placeholder="VilleArabe">
            </div>

            <div class="form-group">
                <label for="GouvernoratArabe">Gouvernorat Arabe:</label>
                <input type="text" class="form-control" name="GouvernoratArabe" placeholder="GouvernoratArabe">
            </div>

            <div class="form-group">
                <label for="TypeBacAB">Type Bac AB:</label>
                <input type="text" class="form-control" name="TypeBacAB" placeholder="TypeBacAB">
            </div>

            <div class="form-group">
                <label for="Photo">Photo:</label>
                <input type="text" class="form-control" name="Photo" placeholder="Photo">
            </div>

            <div class="form-group">
                <label for="Origine">Origine:</label>
                <input type="text" class="form-control" name="Origine" placeholder="Origine">
            </div>

            <div class="form-group">
                <label for="SituationDpart">SituationDpart:</label>
                <input type="text" class="form-control" name="SituationDpart" placeholder="SituationDpart">
            </div>

            <div class="form-group">
                <label for="NBAC">NBAC:</label>
                <input type="number" class="form-control" name="NBAC" placeholder="NBAC">
            </div>

            <div class="form-group">
                <label for="Redaut">Redaut:</label>
                <input type="number" class="form-control" name="Redaut" placeholder="Redaut">
            </div>

            <button type="submit" class="btn btn-primary">Add Etudiant</button>
            <a class="btn btn-secondary" href="list_etudiants.php">Return</a>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Function to check if the entered date is at least 18 years ago
        function validateDateOfBirth() {
            var dateOfBirth = new Date(document.getElementById("DateNais").value);
            var today = new Date();
            var eighteenYearsAgo = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());

            if (dateOfBirth > eighteenYearsAgo) {
                alert("Date of Birth should be at least 18 years ago.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }

        // Add this event listener to the form submission
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!validateDateOfBirth()) {
                event.preventDefault(); // Stop form submission if date validation fails
            }
        });
    </script>

</body>

</html>