<?php
require("upload.php");

$result = uploadImage('image');











/*


// Connexion à la base de données MySQL
$servername = "localhost"; // Remplacez par le nom de votre serveur MySQL
$username = "root"; // Remplacez par votre nom d'utilisateur MySQL
$password = ""; // Remplacez par votre mot de passe MySQL
$dbname = "etude"; // Remplacez par le nom de votre base de données MySQL

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupération des données du formulaire
    $Motif = $_POST['Motif'];
    $MatEtud = $_POST['MatEtud'];
    $TypePiece = $_POST['TypePiece'];
    $DatePiece = $_POST['DatePiece'];
    $Session = $_POST['Session'];
    $nomfichierpiece = $_POST['nomfichierpiece'];

    // Requête SQL pour insérer les données dans la table DossierEtud
    $sql = "INSERT INTO DossierEtud (Motif, MatEtud, TypePiece, DatePiece, Session, nomfichierpiece)
            VALUES ('$Motif', '$MatEtud', '$TypePiece', '$DatePiece', '$Session', '$nomfichierpiece')";

    $conn->exec($sql);
    header('Location: affichage.php');
exit;    

} catch(PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

$conn = null;*/
?>