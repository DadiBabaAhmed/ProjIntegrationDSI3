<?php
require_once("config/config.php");
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASS;
$dbname = DB_NAME;  
try {
$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion à la base de données réussie.";
} catch (PDOException $e) {
    
    echo "Erreur de connexion : " . $e->getMessage();
}
?>