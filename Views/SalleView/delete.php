<?php 
require('../../DataBase/connect.php');

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Salle"])) {
    try {
        $deleteSalle = $_GET["Salle"];
        $delete = $con->prepare("DELETE FROM Salle WHERE Salle = ?");
        $delete->bind_param("s", $deleteSalle);
        
        if ($delete->execute()) {
            echo "The salle was deleted successfully";
            
           
                header('Location: view.php');
                exit();
          
        } else {
            echo "Error deleting: " . $delete->error;
        }
        
        $delete->close();  
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
    }
}
?>