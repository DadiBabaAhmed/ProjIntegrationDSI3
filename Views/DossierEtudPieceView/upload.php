<?php

function uploadImage($image_name) {
    include "../../DataBase/connexion.php";
    
    // Check if the image field is not empty
    if (!empty($_FILES[$image_name]['name'])) {

        // Get the file information
        $file_name = $_FILES[$image_name]['name'];
        $file_tmp = $_FILES[$image_name]['tmp_name'];
        $file_size = $_FILES[$image_name]['size'];
        $file_error = $_FILES[$image_name]['error'];

        // Get the file extension
        $file_ext = explode('.', $file_name);
        $file_ext = strtolower(end($file_ext));

        // Allowed file extensions
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        // Check if the file extension is allowed
        if (in_array($file_ext, $allowed_extensions)) {

            // Check for errors
            if ($file_error === 0) {

                // Check for file size
                if ($file_size <= 2097152) {

                    // Generate a new file name
                    $file_name_new =$_POST['Motif'].$_POST['MatEtud'].$_POST['TypePiece'].$_POST['DatePiece'].$_POST['Session'] .'.' . $file_ext;

                    // Set the destination path
                    $file_destination = './uploads/' . $file_name_new;

                    // Move the file to the destination folder
                    if (move_uploaded_file($file_tmp, $file_destination)) {

                        try {
                        $Motif = $_POST['Motif'];
                        $MatEtud = $_POST['MatEtud'];
                        $TypePiece = $_POST['TypePiece'];
                        $DatePiece = $_POST['DatePiece'];
                        $Session = $_POST['Session'];
                       // $nomfichierpiece = $_POST['nomfichierpiece'];
                    
                        // Requête SQL pour insérer les données dans la table DossierEtud
                        $sql = "INSERT INTO DossierEtud (Motif, MatEtud, TypePiece, DatePiece, Session, nomfichierpiece) VALUES ('$Motif', '$MatEtud', '$TypePiece', '$DatePiece', '$Session', '$file_name_new')";
                        $conn->exec($sql);
                        header('Location: affichage.php');
                    exit;    
                    
                    } catch(PDOException $e) {
                        echo "Erreur : " . $e->getMessage();
                    }
                    

                    } else {
                        echo "Il y a eu une erreur lors du téléchargement de l'image";
                        return false;
                    }

                } else {
                    echo "L'image est trop lourde. Taille maximum : 2 Mo";
                    return false;
                }

            } else {
                echo "Il y a eu une erreur lors du téléchargement de l'image";
                return false;
            }

        } else {
            echo "L'extension de fichier n'est pas autorisée. Extensions autorisées : jpg, jpeg, png, gif";
            return false;
        }

    } else {
        echo "Veuillez sélectionner une image";
        return false;
    }

}