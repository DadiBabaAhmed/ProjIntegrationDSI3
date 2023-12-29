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

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Fetch and sanitize form data
    // ... (Fetch all POST data and sanitize it)
    //Matricule Prof`, `Nom`, `Prénom`, `CIN ou Passeport`, `Identifiant CNRPS`, `Date de naissance`, `Nationalité`, `Sexe (M/F)`, `Date Ent Adm`, `Date Ent Etbs`, `Diplôme`, `Adresse`, `Ville`, `Code postal`, `N° Téléphone`, `Grade`, `Date de nomination dans le grade`, `Date de titulirisation`, `N° Poste`, `Département`, `Situation`, `Spécialité`, `N° de Compte`, `Banque`, `Agence`, `Adr pendant les vacances`, `Tél pendant les vacances`, `Lieu de naissance`, `Début du Contrat`, `Fin du Contrat`, `Type de Contrat`, `NB contrat ISETSOUSSE`, `NB contrat Autre Etb`, `Bureau`, `Email`, `Email Interne`, `NomArabe`, `PrenomArabe`, `LieuNaisArabe`, `AdresseArabe`, `VilleArabe`, `Disponible`, `SousSP`, `EtbOrigine`, `TypeEnsg`, `ControlAcces
    $profData = [
        "Matricule" => $_POST["Matricule"],
        "Nom" => $_POST["Nom"],
        "Prenom" => $_POST["Prénom"],
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
    
    $requiredFields = [
        "Matricule", "Nom", "Prénom", "CIN_ou_Passeport", // Add all required fields here
    ];

    // Validate required fields
    foreach ($requiredFields as $field) {
        if (empty($_POST[$field])) {
            $errors[] = ucfirst($field) . " is required.";
        } else {
            // Sanitize the input (Example: trim spaces)
            $profData[$field] = trim($_POST[$field]);
        }
    }

    // Check if there are any errors
    if (empty($errors)) {
        // Insert the professor data into the database
        $prof->add($profData);
        header("Location: list_profs.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f5f9;
            padding: 20px;
        }

        h1 {
            color: #2c3e50;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>

</head>

<body>
    <form method="POST" action="add_prof.php">
        <h1>INFORMATION DU PROF</h1>
        <div class="form-group">
            <label for="matriculeProf">Matricule Prof</label>
            <input type="text" id="matriculeProf" name="Matricule" placeholder="Matricule Prof" required>
        </div>
        <div class="form-group">
            <label for="Nom">Nom:</label>
            <input type="text" class="form-control" name="Nom" id="Nom">
        </div>
        <div class="form-group">
            <label for="Prénom">Prénom:</label>
            <input type="text" class="form-control" name="Prénom" id="Prénom">
        </div>

        <div class="form-group">
            <label for="CIN_ou_Passeport">CIN ou Passeport:</label>
            <input type="text" class="form-control" name="CIN_ou_Passeport" id="CIN_ou_Passeport">
        </div>

        <div class="form-group">
            <label for="Identifiant_CNRPS">Identifiant CNRPS:</label>
            <input type="text" class="form-control" name="Identifiant_CNRPS" id="Identifiant_CNRPS">
        </div>

        <div class="form-group">
            <label for="Date_de_naissance">Date de naissance:</label>
            <input type="date" class="form-control" name="Date_de_naissance" id="Date_de_naissance">
        </div>

        <div class="form-group">
            <label for="Nationalité">Nationalité:</label>
            <input type="text" class="form-control" name="Nationalité" id="Nationalité">
        </div>

        <div class="form-group">
            <label for="Sexe_M_F">Sexe M/F:</label>
            <input type="text" class="form-control" name="Sexe_M_F" id="Sexe_M_F">
        </div>

        <div class="form-group">
            <label for="Date_Ent_Adm">Date Ent Adm:</label>
            <input type="date" class="form-control" name="Date_Ent_Adm" id="Date_Ent_Adm">
        </div>

        <div class="form-group">
            <label for="Date_Ent_Etbs">Date Ent Etbs:</label>
            <input type="date" class="form-control" name="Date_Ent_Etbs" id="Date_Ent_Etbs">
        </div>

        <div class="form-group">
            <label for="Diplôme">Diplôme:</label>
            <input type="text" class="form-control" name="Diplôme" id="Diplôme">
        </div>

        <div class="form-group">
            <label for="Adresse">Adresse:</label>
            <input type="text" class="form-control" name="Adresse" id="Adresse">
        </div>

        <div class="form-group">
            <label for="Ville">Ville:</label>
            <input type="text" class="form-control" name="Ville" id="Ville">
        </div>

        <div class="form-group">
            <label for="Code_postal">Code postal:</label>
            <input type="text" class="form-control" name="Code_postal" id="Code_postal">
        </div>

        <div class="form-group">
            <label for="N_Téléphone">N Téléphone:</label>
            <input type="text" class="form-control" name="N_Téléphone" id="N_Téléphone">
        </div>

        <div class="form-group">
            <label for="Grade">Grade:</label>
            <select name="Grade" id="Grade" class="form-control">
                <?php foreach ($gradeList as $row) { ?>
                    <option class="form-control" value="<?php echo $row['Grade']; ?>"><?php echo $row['Grade']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label for="Date_de_nomination_dans_le_grade">Date de nomination dans le grade:</label>
            <input type="date" class="form-control" name="Date_de_nomination_dans_le_grade" id="Date_de_nomination_dans_le_grade">
        </div>

        <div class="form-group">
            <label for="Date_de_titulirisation">Date de titulirisation:</label>
            <input type="date" class="form-control" name="Date_de_titulirisation" id="Date_de_titulirisation">
        </div>

        <div class="form-group">
            <label for="N_Poste">N Poste:</label>
            <input type="text" class="form-control" name="N_Poste" id="N_Poste">
        </div>

        <div class="form-group">
            <label for="Département">Département:</label>
            <select name="departement" id="departement" class="form-control">
                <?php foreach ($departementList as $row) { ?>
                    <option class="form-control" value="<?php echo $row['CodeDep']; ?>"><?php echo $row['CodeDep']; ?></option>
                <?php } ?> 
                </select>  
        </div>

        <div class="form-group">
            <label for="Situation">Situation:</label>
            <input type="text" class="form-control" name="Situation" id="Situation">
        </div>

        <div class="form-group">
            <label for="Spécialité">Spécialité:</label>
            <input type="text" class="form-control" name="Spécialité" id="Spécialité">
        </div>

        <div class="form-group">
            <label for="N_de_Compte">N de Compte:</label>
            <input type="text" class="form-control" name="N_de_Compte" id="N_de_Compte">
        </div>

        <div class="form-group">
            <label for="Banque">Banque:</label>
            <input type="text" class="form-control" name="Banque" id="Banque">
        </div>

        <div class="form-group">
            <label for="Agence">Agence:</label>
            <input type="text" class="form-control" name="Agence" id="Agence">
        </div>

        <div class="form-group">
            <label for="Adr_pendant_les_vacances">Adr pendant les vacances:</label>
            <input type="text" class="form-control" name="Adr_pendant_les_vacances" id="Adr_pendant_les_vacances">
        </div>

        <div class="form-group">
            <label for="Tél_pendant_les_vacances">Tél pendant les vacances:</label>
            <input type="text" class="form-control" name="Tél_pendant_les_vacances" id="Tél_pendant_les_vacances">
        </div>

        <div class="form-group">
            <label for="Lieu_de_naissance">Lieu de naissance:</label>
            <input type="text" class="form-control" name="Lieu_de_naissance" id="Lieu_de_naissance">
        </div>

        <div class="form-group">
            <label for="Début_du_Contrat">Début du Contrat:</label>
            <input type="date" class="form-control" name="Début_du_Contrat" id="Début_du_Contrat">
        </div>

        <div class="form-group">
            <label for="Fin_du_Contrat">Fin du Contrat:</label>
            <input type="date" class="form-control" name="Fin_du_Contrat" id="Fin_du_Contrat">
        </div>

        <div class="form-group">
            <label for="Type_de_Contrat">Type de Contrat:</label>
            <input type="text" class="form-control" name="Type_de_Contrat" id="Type_de_Contrat">
        </div>

        <div class="form-group">
            <label for="NB_contrat_ISETSOUSSE">NB contrat ISETSOUSSE:</label>
            <input type="text" class="form-control" name="NB_contrat_ISETSOUSSE" id="NB_contrat_ISETSOUSSE">
        </div>

        <div class="form-group">
            <label for="NB_contrat_Autre_Etb">NB contrat Autre Etb:</label>
            <input type="text" class="form-control" name="NB_contrat_Autre_Etb" id="NB_contrat_Autre_Etb">
        </div>

        <div class="form-group">
            <label for="Bureau">Bureau:</label>
            <input type="text" class="form-control" name="Bureau" id="Bureau">
        </div>

        <div class="form-group">
            <label for="Email">Email:</label>
            <input type="text" class="form-control" name="Email" id="Email">
        </div>

        <div class="form-group">
            <label for="Email_Interne">Email Interne:</label>
            <input type="text" class="form-control" name="Email_Interne" id="Email_Interne">
        </div>

        <div class="form-group">
            <label for="NomArabe">Nom Arabe:</label>
            <input type="text" class="form-control" name="NomArabe" id="NomArabe">
        </div>

        <div class="form-group">
            <label for="PrenomArabe">Prenom Arabe:</label>
            <input type="text" class="form-control" name="PrenomArabe" id="PrenomArabe">
        </div>

        <div class="form-group">
            <label for="LieuNaisArabe">LieuNais Arabe:</label>
            <input type="text" class="form-control" name="LieuNaisArabe" id="LieuNaisArabe">
        </div>

        <div class="form-group">
            <label for="AdresseArabe">Adresse Arabe:</label>
            <input type="text" class="form-control" name="AdresseArabe" id="AdresseArabe">
        </div>

        <div class="form-group">
            <label for="VilleArabe">Ville Arabe:</label>
            <input type="text" class="form-control" name="VilleArabe" id="VilleArabe">
        </div>

        <div class="form-group">
            <label for="Disponible">Disponible:</label>
            <input type="text" class="form-control" name="Disponible" id="Disponible">
        </div>

        <div class="form-group">
            <label for="SousSP">SousSP:</label>
            <input type="text" class="form-control" name="SousSP" id="SousSP">
        </div>

        <div class="form-group">
            <label for="EtbOrigine">EtbOrigine:</label>
            <input type="text" class="form-control" name="EtbOrigine" id="EtbOrigine">
        </div>

        <div class="form-group">
            <label for="TypeEnsg">TypeEnsg:</label>
            <input type="text" class="form-control" name="TypeEnsg" id="TypeEnsg">
        </div>

        <div class="form-group">
            <label for="ControlAcces">ControlAcces:</label>
            <input type="text" class="form-control" name="ControlAcces" id="ControlAcces">
        </div>

        <button type="submit" class="btn btn-primary">Ajouter</button>
        <a href="list_profs.php" class="btn btn-secondary">Retour</a>

    </form>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>