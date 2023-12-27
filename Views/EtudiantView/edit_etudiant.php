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
        $newData = [
            "Nom" => $_POST["Nom"] ,
            "DateNais" => $_POST["DateNais"] ,
            "NCE" => $_POST["NCE"] ,
            "TypBac" => $_POST["TypBac"] ,
            "Prénom" => $_POST["Prénom"] ,
            "Sexe" => $_POST["Sexe"] ,
            "LieuNais" => $_POST["LieuNais"] ,
            "Adresse" => $_POST["Adresse"] ,
            "Ville" => $_POST["Ville"] ,
            "CodePostal" => $_POST["CodePostal"] ,
            "N°Tél" => $_POST["N°Tél"] ,
            "CodClasse" => $_POST["CodClasse"],
            "DécisionduConseil" => $_POST["DécisionduConseil"] ,
            "AnnéeUnversitaire" => $_POST["AnnéeUnversitaire"] ,
            "Semestre" => $_POST["Semestre"] ,
            "Dispenser" => isset($_POST["Dispenser"]) ? 1 : 0,
            "Anneesopt" => $_POST["Anneesopt"] ,
            "DatePremièreInscp" => $_POST["DatePremièreInscp"] ,
            "Gouvernorat" => $_POST["Gouvernorat"] ,
            "Mention du Bac" => $_POST["Mention_du_Bac"] ,
            "Nationalité" => $_POST["Nationalité"] ,
            "CodeCNSS" => $_POST["CodeCNSS"] ,
            "NomArabe" => $_POST["NomArabe"] ,
            "PrenomArabe" => $_POST["PrenomArabe"] ,
            "LieuNaisArabe" => $_POST["LieuNaisArabe"] ,
            "AdresseArabe" => $_POST["AdresseArabe"] ,
            "VilleArabe" => $_POST["VilleArabe"] ,
            "GouvernoratArabe" => $_POST["GouvernoratArabe"] ,
            "TypeBacAB" => $_POST["TypeBacAB"] ,
            "Photo" => $_POST["Photo"] ,
            "Origine" => $_POST["Origine"] ,
            "SituationDpart" => $_POST["SituationDpart"] ,
            "NBAC" => $_POST["NBAC"] ,
            "Redaut" => $_POST["Redaut"]
        ];
        $etudiant->update($_POST["NCIN"], $newData);
        header("Location: list_etudiants.php");
        exit();
    }
}

if (isset($_GET["NCIN"])) {
    $ncin = $_GET["NCIN"];

    $sql = "SELECT * FROM etudiant WHERE NCIN = ?";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bind_param("s", $ncin);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $etudiantData = $result->fetch_assoc();
    } else {
        echo "Etudiant with NCIN: $ncin not found. <a class='btn btn-secondary' href='list_etudiants.php'>Return</a>Back to Etudiant List</a>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Etudiant</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Etudiant</h2>
        <?php include('message.php'); ?>
        <form method="POST" action="edit_etudiant.php">
            <input type="hidden" name="NCIN" value="<?php echo $etudiantData["NCIN"]; ?>"><br>

            <div class="form-group">
                <label for="Nom">Nom:</label>
                <input type="text" class="form-control" name="Nom" id="Nom" value="<?php echo $etudiantData["Nom"]; ?>">
            </div>

            <div class="form-group">
                <label for="DateNais">DateNais:</label>
                <input type="date" class="form-control" name="DateNais" id="DateNais" placeholder="DateNais" >
            </div>


            <div class="form-group">
                <label for="NCE">NCE:</label>
                <input type="text" class="form-control" name="NCE" id="NCE" value="<?php echo $etudiantData["NCE"]; ?>">
            </div>

            <div class="form-group">
                <label for="TypBac">Type Bac:</label>
                <input type="text" class="form-control" name="TypBac" id="TypBac" value="<?php echo $etudiantData["TypBac"]; ?>">
            </div>

            <div class="form-group">
                <label for="Prénom">Prénom:</label>
                <input type="text" class="form-control" name="Prénom" id="Prénom" value="<?php echo $etudiantData["Prénom"]; ?>">
            </div>

            <div class="form-group">
                <label for="Sexe">Sexe:</label>&emsp;
                <input type="radio" name="Sexe" value="1"> &ensp; Male &emsp;
                <input type="radio" name="Sexe" value="2"> &ensp; Female
            </div>

            <div class="form-group">
                <label for="LieuNais">Lieu Nais:</label>
                <input type="text" class="form-control" name="LieuNais" id="LieuNais" value="<?php echo $etudiantData["LieuNais"]; ?>">
            </div>

            <div class="form-group">
                <label for="Adresse">Adresse:</label>
                <input type="text" class="form-control" name="Adresse" id="Adresse" value="<?php echo $etudiantData["Adresse"]; ?>">
            </div>

            <div class="form-group">
                <label for="Ville">Ville:</label>
                <input type="text" class="form-control" name="Ville" id="Ville" value="<?php echo $etudiantData["Ville"]; ?>">
            </div>

            <div class="form-group">
                <label for="CodePostal">CodePostal:</label>
                <input type="number" class="form-control" name="CodePostal" id="CodePostal" value="<?php echo $etudiantData["CodePostal"]; ?>">
            </div>

            <div class="form-group">
                <label for="N°Tél">N°Tél:</label>
                <input type="text" class="form-control" name="N°Tél" id="N°Tél" value="<?php echo $etudiantData["N°Tél"]; ?>">
            </div>

            <div class="form-group">
                <label for="CodClasse">CodClasse:</label>
                <select name="CodClasse" class="form-control">
                    <?php foreach ($listclasses as $classe) :
                        if($classe["CodClasse"]==$etudiantData["CodClasse"]){ ?>
                            <option value="<?php echo $classe["CodClasse"]; ?>" selected><?php echo $classe["CodClasse"]; ?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $classe["CodClasse"]; ?>"><?php echo $classe["CodClasse"]; ?></option>
                    <?php } 
                endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="DécisionduConseil">Décision du Conseil:</label>
                <input type="text" class="form-control" name="DécisionduConseil" id="DécisionduConseil" value="<?php echo $etudiantData["DécisionduConseil"]; ?>">
            </div>

            <div class="form-group">
                <label for="AnnéeUnversitaire">Année Unversitaire:</label>
                <input type="text" class="form-control" name="AnnéeUnversitaire" id="AnnéeUnversitaire" value="<?php echo $etudiantData["AnnéeUnversitaire"]; ?>">
            </div>

            <div class="form-group">
                <label for="Semestre">Semestre:</label>
                <input type="number" class="form-control" name="Semestre" id="Semestre" value="<?php echo $etudiantData["Semestre"]; ?>">
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="Dispenser" id="Dispenser" <?php if ($etudiantData["Dispenser"]) echo "checked"; ?>>
                <label class="form-check-label" for="Dispenser">Dispenser</label>
            </div>

            <div class="form-group">
                <label for="Anneesopt">Annees opt:</label>
                <input type="date" class="form-control" name="Anneesopt" id="Anneesopt" value="<?php echo $etudiantData["Anneesopt"]; ?>">
            </div>

            <div class="form-group">
                <label for="DatePremièreInscp">Date Première Inscp:</label>
                <input type="date" class="form-control" name="DatePremièreInscp" id="DatePremièreInscp" value="<?php echo $etudiantData["DatePremièreInscp"]; ?>">
            </div>

            <div class="form-group">
                <label for="Gouvernorat">Gouvernorat:</label>
                <select name="Gouvernorat" class="form-control">
                    <?php foreach ($listgouvernorats as $gouvernorat) :
                        if($gouvernorat["Gouv"]==$etudiantData["Gouvernorat"]){ ?>
                            <option value="<?php echo $gouvernorat["Gouv"]; ?>" selected><?php echo $gouvernorat["Gouv"]; ?></option>
                        <?php }else{ ?>
                        <option value="<?php echo $gouvernorat["Gouv"]; ?>"><?php echo $gouvernorat["Gouv"]; ?></option>
                    <?php }
                endforeach; ?>
                </select>                
            </div>

            <div class="form-group">
                <label for="MentionduBac">Mention du Bac:</label>
                <input type="text" class="form-control" name="MentionduBac" id="MentionduBac" value="<?php echo $etudiantData["Mention du Bac"]; ?>">
            </div>

            <div class="form-group">
                <label for="Nationalité">Nationalité:</label>
                <input type="text" class="form-control" name="Nationalité" id="Nationalité" value="<?php echo $etudiantData["Nationalité"]; ?>">
            </div>

            <div class="form-group">
                <label for="CodeCNSS">Code CNSS:</label>
                <input type="text" class="form-control" name="CodeCNSS" id="CodeCNSS" value="<?php echo $etudiantData["CodeCNSS"]; ?>">
            </div>

            <div class="form-group">
                <label for="NomArabe">Nom Arabe:</label>
                <input type="text" class="form-control" name="NomArabe" id="NomArabe" value="<?php echo $etudiantData["NomArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="PrenomArabe">Prenom Arabe:</label>
                <input type="text" class="form-control" name="PrenomArabe" id="PrenomArabe" value="<?php echo $etudiantData["PrenomArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="LieuNaisArabe">Lieu Nais Arabe:</label>
                <input type="text" class="form-control" name="LieuNaisArabe" id="LieuNaisArabe" value="<?php echo $etudiantData["LieuNaisArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="AdresseArabe">Adresse Arabe:</label>
                <input type="text" class="form-control" name="AdresseArabe" id="AdresseArabe" value="<?php echo $etudiantData["AdresseArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="VilleArabe">Ville Arabe:</label>
                <input type="text" class="form-control" name="VilleArabe" id="VilleArabe" value="<?php echo $etudiantData["VilleArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="GouvernoratArabe">Gouvernorat Arabe:</label>
                <input type="text" class="form-control" name="GouvernoratArabe" id="GouvernoratArabe" value="<?php echo $etudiantData["GouvernoratArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="TypeBacAB">Bac AB:</label>
                <input type="text" class="form-control" name="TypeBacAB" id="TypeBacAB" value="<?php echo $etudiantData["TypeBacAB"]; ?>">
            </div>

            <div class="form-group">
                <label for="Photo">Photo:</label>
                <input type="text" class="form-control" name="Photo" id="Photo" value="<?php echo $etudiantData["Photo"]; ?>">
            </div>

            <div class="form-group">
                <label for="Origine">Origine:</label>
                <input type="text" class="form-control" name="Origine" id="Origine" value="<?php echo $etudiantData["Origine"]; ?>">
            </div>

            <div class="form-group">
                <label for="SituationDpart">Situation Dpart:</label>
                <input type="text" class="form-control" name="SituationDpart" id="SituationDpart" value="<?php echo $etudiantData["SituationDpart"]; ?>">
            </div>

            <div class="form-group">
                <label for="NBAC">NBAC:</label>
                <input type="text" class="form-control" name="NBAC" id="NBAC" value="<?php echo $etudiantData["NBAC"]; ?>">
            </div>

            <div class="form-group">
                <label for="Redaut">Redaut:</label>
                <input type="text" class="form-control" name="Redaut" id="Redaut" value="<?php echo $etudiantData["Redaut"]; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
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