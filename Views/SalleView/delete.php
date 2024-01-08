<?php 
require('../../DataBase/connect.php');

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["Salle"])) {
    try {
        $deleteSalle = $_GET["Salle"];
        $delete = $con->prepare("DELETE FROM Salle WHERE Salle = ?");
        $delete->bind_param("s", $deleteSalle);
        
        if ($delete->execute()) {
            echo "The salle was deleted successfully";
            echo "<a href='view.php'>Go back to list</a>";
          
        } else {
            echo "Error deleting: " . $delete->error;
            echo "<a href='view.php'>Go back to list</a>";
        }
        
        $delete->close();  
    } catch (Exception $e) {
        echo "An error occurred: " . $e->getMessage();
        echo "<a href='view.php'>Go back to list</a>";
    }
}

?>