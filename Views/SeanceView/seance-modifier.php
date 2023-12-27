<?php
session_start();
require '../../DataBase/connect.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Seance Modification</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Seance Modifier 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if(isset($_GET['SEANCE']))
                        {
                            $SEANCE = mysqli_real_escape_string($con, $_GET['SEANCE']);
                            $query = "SELECT * FROM seances WHERE SEANCE='$SEANCE' ";
                            $query_run = mysqli_query($con, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $seance = mysqli_fetch_array($query_run);
                                ?>
                                <form action="code.php" method="POST">
                                    <input type="hidden" name="SEANCE" value="<?= $seance['SEANCE']; ?>">

                                    <div class="mb-3">
                                        <label>Horaire</label>
                                        <input type="text" name="Horaire" value="<?=$seance['Horaire'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Heure de debut</label>
                                        <input type="text" name="HDeb" value="<?=$seance['HDeb'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label>Heure de fin</label>
                                        <input type="text" name="HFin" value="<?=$seance['HFin'];?>" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" name="modifier_seance" class="btn btn-primary">
                                            Modifier seance
                                        </button>
                                    </div>

                                </form>
                                <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>