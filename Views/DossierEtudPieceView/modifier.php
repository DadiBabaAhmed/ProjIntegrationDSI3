<!DOCTYPE html>
<html>

<head>
    <title>Modifier un enregistrement</title>
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 class="text-center">Modifier un enregistrement</h2>
        <?php
        include "../../DataBase/connexion.php";

        try {
            // SQL query to select data from the "DossierEtud" table
            $sql = "SELECT * FROM DossierEtud WHERE Ndossier = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $_GET["Ndossier"]);
            $stmt->execute();

            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                ?>
                <form action="maj.php?id=<?php echo $result['Ndossier']; ?>" method="post">
                    <div class="form-group">
                        <label for="MatEtud">Matricule Étudiant:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $result['MatEtud']; ?>" name="MatEtud" id="MatEtud">
                    </div>

                    <div class="form-group">
                        <label for="TypePiece">Type de Pièce:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $result['TypePiece']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="DatePiece">Date de Pièce:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $result['DatePiece']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="Session">Session:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $result['Session']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="nomfichierpiece">Nom du fichier pièce:</label>
                        <input type="text" class="form-control" disabled value="<?php echo $result['nomfichierpiece']; ?>" name="nomfichierpiece" id="nomfichierpiece">
                    </div>

                    <div class="form-group">
                        <label for="Motif">Motif:</label>
                        <textarea class="form-control" name="Motif" id="Motif"><?php echo $result['Motif']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                        <a href="affichage.php"><button type="button" class="btn btn-secondary" name="annuler">annuler</button></a>
                    </div>
                </form>
                <?php
            } else {
                echo "Aucun enregistrement trouvé pour l'ID de dossier fourni.";
            }
            
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">';
            echo "<h5>Erreur : " . $e->getMessage() . "</h5>";
            echo '</div>';
            echo '<br><a class="btn btn-secondary" href="afficher.php">Retourner à la liste</a>';
        }

        $conn = null;
        ?>
    </div>

    <!-- Add Bootstrap JavaScript (Popper.js and Bootstrap JS) if needed -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>