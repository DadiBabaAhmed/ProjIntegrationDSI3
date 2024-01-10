<?php
include "../../DataBase/Database.php";
include "../../Classes/Prof.php";
include '../../Classes/Grade.php';
include '../../Classes/Departement.php';

$db = new Database();
$prof = new Prof($db->getConnection());
$grade = new Grades($db->getConnection());
$departement = new Departement($db->getConnection());

$gradeList = $grade->getAllGrades();
$departementList = $departement->getDepartmentsNames();

try{
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch and sanitize form data
    // ... (Fetch all POST data and sanitize it)

    // Construct an array with the updated professor data
    $updatedProfData = [
        "Nom" => $_POST["Nom"],
        "Prenom" => $_POST["Prenom"],
        "CIN" => $_POST["CIN_ou_Passeport"],
        "Identifiant CNRPS" => $_POST["Identifiant_CNRPS"],
        "Date de naissance" => $_POST["Date_de_naissance"],
        "Nationalité" => $_POST["Nationalité"],
        "Sexe (M/F)" => $_POST['Sexe_M_F'],
        "Date Ent Adm" => $_POST['Date_Ent_Adm'],
        "Date Ent Etbs" => $_POST['Date_Ent_Etbs'],
        "Diplôme" => $_POST['Diplôme'],
        "Adresse" => $_POST['Adresse'],
        "Ville" => $_POST['Ville'],
        "Code postal" => $_POST['Code_postal'],
        "N° Téléphone" => $_POST['N_Téléphone'],
        "Grade" => $_POST['Grade'],
        "Date de nomination dans le grade" => $_POST['Date_de_nomination_dans_le_grade'],
        "Date de titulirisation" =>  $_POST['Date_de_titulirisation'],
        "N° Poste" => $_POST['N_Poste'],
        "Département" => $_POST['departement'],
        "Situation" => $_POST['Situation'],
        "Spécialité" => $_POST['Spécialité'],
        "N° de Compte" => $_POST['N_de_Compte'],
        "Banque" => $_POST['Banque'],
        "Agence" => $_POST['Agence'],
        "Adr pendant les vacances" => $_POST['Adr_pendant_les_vacances'],
        "Tél pendant les vacances" => $_POST['Tél_pendant_les_vacances'],
        "Lieu de naissance" => $_POST['Lieu_de_naissance'],
        "Début du Contrat" => $_POST['Début_du_Contrat'],
        "Fin du Contrat" => $_POST['Fin_du_Contrat'],
        "Type de Contrat" => $_POST['Type_de_Contrat'],
        "NB contrat ISETSOUSSE" => $_POST['NB_contrat_ISETSOUSSE'],
        "NB contrat Autre Etb" => $_POST['NB_contrat_Autre_Etb'],
        "Bureau" => $_POST['Bureau'],
        "Email" => $_POST['Email'],
        "Email Interne" => $_POST['Email_Interne'],
        "NomArabe" => $_POST['NomArabe'],
        "PrenomArabe" => $_POST['PrenomArabe'],
        "LieuNaisArabe" => $_POST['LieuNaisArabe'],
        "AdresseArabe" => $_POST['AdresseArabe'],
        "VilleArabe" => $_POST['VilleArabe'],
        "Disponible" => $_POST['Disponible'],
        "SousSP" => $_POST['SousSP'],
        "EtbOrigine" => $_POST['EtbOrigine'],
        "TypeEnsg" => $_POST['TypeEnsg'],
        "ControlAcces" => $_POST['ControlAcces']
    ];

    // Update the professor data in the database
    $prof->update($_POST["Matricule"], $updatedProfData);
    header("Location: list_profs.php");
    exit();
}

if (isset($_GET["Matricule"])) {
    $matriculeProf = $_GET["Matricule"];

    $sql = "SELECT * FROM prof WHERE `Matricule` = ?";
    $stmt = $db->getConnection()->prepare($sql);
    $stmt->bind_param("i", $matriculeProf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $profData = $result->fetch_assoc();
    } else {
        echo "Professor with Matricule Prof: $matriculeProf not found.";
    }
    $stmt->close();
}
} catch (Exception $e) {
        echo "<div class='alert alert-danger' role='alert'>
        <h5>Error:Une erreur inattendue s'est produite lors de la modification de cette element.</h5>
        </div>
        <br><a class='btn btn-secondary' href='list_profs.php'>Retourner à la liste</a>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Professor</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Edit Professor</h2>
        <form method="POST" action="edit_prof.php">
            <input type="hidden" name="Matricule" value="<?php echo $profData["Matricule"]; ?>"><br>

            <div class="form-group">
                <label for="Nom">Nom:</label>
                <input type="text" class="form-control" name="Nom" id="Nom" value="<?php echo $profData["Nom"]; ?>">
            </div>
            <div class="form-group">
                <label for="Prenom">Prenom:</label>
                <input type="text" class="form-control" name="Prenom" id="Prenom" value="<?php echo $profData["Prenom"]; ?>">
            </div>

            <div class="form-group">
                <label for="CIN_ou_Passeport">CIN ou Passeport:</label>
                <input type="text" class="form-control" name="CIN_ou_Passeport" id="CIN_ou_Passeport" value="<?php echo $profData["CIN"]; ?>">
            </div>

            <div class="form-group">
                <label for="Identifiant_CNRPS">Identifiant CNRPS:</label>
                <input type="text" class="form-control" name="Identifiant_CNRPS" id="Identifiant_CNRPS" value="<?php echo $profData["Identifiant CNRPS"]; ?>">
            </div>

            <div class="form-group">
                <label for="Date_de_naissance">Date de naissance:</label>
                <input type="date" class="form-control" name="Date_de_naissance" id="Date_de_naissance" value="<?php echo $profData["Date de naissance"]; ?>">
            </div>

            <div class="form-group">
                <label for="Nationalité">Nationalité:</label>
                <input type="text" class="form-control" name="Nationalité" id="Nationalité" value="<?php echo $profData["Nationalité"]; ?>">
            </div>

            <div class="form-group">
                <label for="Sexe_M_F">Sexe M/F:</label>
                <input type="text" class="form-control" name="Sexe_M_F" id="Sexe_M_F" value="<?php echo $profData["Sexe (M/F)"]; ?>">
            </div>

            <div class="form-group">
                <label for="Date_Ent_Adm">Date Ent Adm:</label>
                <input type="date" class="form-control" name="Date_Ent_Adm" id="Date_Ent_Adm" value="<?php echo $profData["Date Ent Adm"]; ?>">
            </div>

            <div class="form-group">
                <label for="Date_Ent_Etbs">Date Ent Etbs:</label>
                <input type="date" class="form-control" name="Date_Ent_Etbs" id="Date_Ent_Etbs" value="<?php echo $profData["Date Ent Etbs"]; ?>">
            </div>

            <div class="form-group">
                <label for="Diplôme">Diplôme:</label>
                <input type="text" class="form-control" name="Diplôme" id="Diplôme" value="<?php echo $profData["Diplôme"]; ?>">
            </div>

            <div class="form-group">
                <label for="Adresse">Adresse:</label>
                <input type="text" class="form-control" name="Adresse" id="Adresse" value="<?php echo $profData["Adresse"]; ?>">
            </div>

            <div class="form-group">
                <label for="Ville">Ville:</label>
                <input type="text" class="form-control" name="Ville" id="Ville" value="<?php echo $profData["Ville"]; ?>">
            </div>

            <div class="form-group">
                <label for="Code_postal">Code postal:</label>
                <input type="text" class="form-control" name="Code_postal" id="Code_postal" value="<?php echo $profData["Code postal"]; ?>">
            </div>

            <div class="form-group">
                <label for="N_Téléphone">N Téléphone:</label>
                <input type="text" class="form-control" name="N_Téléphone" id="N_Téléphone" value="<?php echo $profData["N° Téléphone"]; ?>">
            </div>

            <div class="form-group">
                <label for="Grade">Grade:</label>
                <select class="form-control" name="Grade" id="Grade">
                    <?php foreach ($gradeList as $row) { ?>
                        <option class="form-control" value="<?php echo $row['Grade']; ?>"<?php if($row['Grade'] === $profData["Grade"]){echo "selected"; } ?>><?php echo $row['Grade']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Date_de_nomination_dans_le_grade">Date de nomination dans le grade:</label>
                <input type="date" class="form-control" name="Date_de_nomination_dans_le_grade" id="Date_de_nomination_dans_le_grade" value="<?php echo $profData["Date de nomination dans le grade"]; ?>">
            </div>

            <div class="form-group">
                <label for="Date_de_titulirisation">Date de titulirisation:</label>
                <input type="date" class="form-control" name="Date_de_titulirisation" id="Date_de_titulirisation" value="<?php echo $profData["Date de titulirisation"]; ?>">
            </div>

            <div class="form-group">
                <label for="N_Poste">N Poste:</label>
                <input type="text" class="form-control" name="N_Poste" id="N_Poste" value="<?php echo $profData["N° Poste"]; ?>">
            </div>

            <div class="form-group">
                <label for="Département">Département:</label>
                <select class="form-control" name="departement" id="departement">
                    <?php foreach ($departementList as $row) { ?>
                        <option class="form-control" value="<?php echo $row['CodeDep']; ?>"<?php if($row['CodeDep'] === $profData["Département"]){echo "selected"; } ?>><?php echo $row['CodeDep']; ?>-<?php echo $row['Departement']; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label for="Situation">Situation:</label>
                <input type="text" class="form-control" name="Situation" id="Situation" value="<?php echo $profData["Situation"]; ?>">
            </div>

            <div class="form-group">
                <label for="Spécialité">Spécialité:</label>
                <input type="text" class="form-control" name="Spécialité" id="Spécialité" value="<?php echo $profData["Spécialité"]; ?>">
            </div>

            <div class="form-group">
                <label for="N_de_Compte">N de Compte:</label>
                <input type="text" class="form-control" name="N_de_Compte" id="N_de_Compte" value="<?php echo $profData["N° de Compte"]; ?>">
            </div>

            <div class="form-group">
                <label for="Banque">Banque:</label>
                <input type="text" class="form-control" name="Banque" id="Banque" value="<?php echo $profData["Banque"]; ?>">
            </div>

            <div class="form-group">
                <label for="Agence">Agence:</label>
                <input type="text" class="form-control" name="Agence" id="Agence" value="<?php echo $profData["Agence"]; ?>">
            </div>

            <div class="form-group">
                <label for="Adr_pendant_les_vacances">Adr pendant les vacances:</label>
                <input type="text" class="form-control" name="Adr_pendant_les_vacances" id="Adr_pendant_les_vacances" value="<?php echo $profData["Adr pendant les vacances"]; ?>">
            </div>

            <div class="form-group">
                <label for="Tél_pendant_les_vacances">Tél pendant les vacances:</label>
                <input type="text" class="form-control" name="Tél_pendant_les_vacances" id="Tél_pendant_les_vacances" value="<?php echo $profData["Tél pendant les vacances"]; ?>">
            </div>

            <div class="form-group">
                <label for="Lieu_de_naissance">Lieu de naissance:</label>
                <input type="text" class="form-control" name="Lieu_de_naissance" id="Lieu_de_naissance" value="<?php echo $profData["Lieu de naissance"]; ?>">
            </div>

            <div class="form-group">
                <label for="Début_du_Contrat">Début du Contrat:</label>
                <input type="date" class="form-control" name="Début_du_Contrat" id="Début_du_Contrat" value="<?php echo $profData["Début du Contrat"]; ?>">
            </div>

            <div class="form-group">
                <label for="Fin_du_Contrat">Fin du Contrat:</label>
                <input type="date" class="form-control" name="Fin_du_Contrat" id="Fin_du_Contrat" value="<?php echo $profData["Fin du Contrat"]; ?>">
            </div>

            <div class="form-group">
                <label for="Type_de_Contrat">Type de Contrat:</label>
                <input type="text" class="form-control" name="Type_de_Contrat" id="Type_de_Contrat" value="<?php echo $profData["Type de Contrat"]; ?>">
            </div>

            <div class="form-group">
                <label for="NB_contrat_ISETSOUSSE">NB contrat ISETSOUSSE:</label>
                <input type="text" class="form-control" name="NB_contrat_ISETSOUSSE" id="NB_contrat_ISETSOUSSE" value="<?php echo $profData["NB contrat ISETSOUSSE"]; ?>">
            </div>

            <div class="form-group">
                <label for="NB_contrat_Autre_Etb">NB contrat Autre Etb:</label>
                <input type="text" class="form-control" name="NB_contrat_Autre_Etb" id="NB_contrat_Autre_Etb" value="<?php echo $profData["NB contrat Autre Etb"]; ?>">
            </div>

            <div class="form-group">
                <label for="Bureau">Bureau:</label>
                <input type="text" class="form-control" name="Bureau" id="Bureau" value="<?php echo $profData["Bureau"]; ?>">
            </div>

            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="text" class="form-control" name="Email" id="Email" value="<?php echo $profData["Email"]; ?>">
            </div>

            <div class="form-group">
                <label for="Email_Interne">Email Interne:</label>
                <input type="text" class="form-control" name="Email_Interne" id="Email_Interne" value="<?php echo $profData["Email Interne"]; ?>">
            </div>

            <div class="form-group">
                <label for="NomArabe">Nom Arabe:</label>
                <input type="text" class="form-control" name="NomArabe" id="NomArabe" value="<?php echo $profData["NomArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="PrenomArabe">Prenom Arabe:</label>
                <input type="text" class="form-control" name="PrenomArabe" id="PrenomArabe" value="<?php echo $profData["PrenomArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="LieuNaisArabe">LieuNais Arabe:</label>
                <input type="text" class="form-control" name="LieuNaisArabe" id="LieuNaisArabe" value="<?php echo $profData["LieuNaisArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="AdresseArabe">Adresse Arabe:</label>
                <input type="text" class="form-control" name="AdresseArabe" id="AdresseArabe" value="<?php echo $profData["AdresseArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="VilleArabe">Ville Arabe:</label>
                <input type="text" class="form-control" name="VilleArabe" id="VilleArabe" value="<?php echo $profData["VilleArabe"]; ?>">
            </div>

            <div class="form-group">
                <label for="Disponible">Disponible:</label>
                <input type="text" class="form-control" name="Disponible" id="Disponible" value="<?php echo $profData["Disponible"]; ?>">
            </div>

            <div class="form-group">
                <label for="SousSP">SousSP:</label>
                <input type="text" class="form-control" name="SousSP" id="SousSP" value="<?php echo $profData["SousSP"]; ?>">
            </div>

            <div class="form-group">
                <label for="EtbOrigine">EtbOrigine:</label>
                <input type="text" class="form-control" name="EtbOrigine" id="EtbOrigine" value="<?php echo $profData["EtbOrigine"]; ?>">
            </div>

            <div class="form-group">
                <label for="TypeEnsg">TypeEnsg:</label>
                <input type="text" class="form-control" name="TypeEnsg" id="TypeEnsg" value="<?php echo $profData["TypeEnsg"]; ?>">
            </div>

            <div class="form-group">
                <label for="ControlAcces">ControlAcces:</label>
                <input type="text" class="form-control" name="ControlAcces" id="ControlAcces" value="<?php echo $profData["ControlAcces"]; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a class="btn btn-secondary" href="list_profs.php">Cancel</a>
        </form>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>