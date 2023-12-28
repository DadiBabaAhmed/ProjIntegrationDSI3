<?php
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

    <title>Voir seance</title>
</head>
<body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Details de la seance
                            <a href="list_seances.php" class="btn btn-danger float-end">BACK</a>
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
                                
                                    <div class="mb-3">
                                        <label>Horaire seance</label>
                                        <p class="form-control">
                                            <?=$seance['Horaire'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Heure debut seance</label>
                                        <p class="form-control">
                                            <?=$seance['HDeb'];?>
                                        </p>
                                    </div>
                                    <div class="mb-3">
                                        <label>Heure fin seance</label>
                                        <p class="form-control">
                                            <?=$seance['HFin'];?>
                                        </p>
                                    </div>


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