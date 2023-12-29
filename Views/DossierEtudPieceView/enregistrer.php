<?php
require("upload.php");
try {
    $result = uploadImage('image');
} catch (Exception $e) {
    echo "<div class='alert alert-danger'>Error: An error occurred; Please try again later.</div>
    <br><a href='affichage.php' class='btn btn-primary'>Retour</a>";
}
?>
