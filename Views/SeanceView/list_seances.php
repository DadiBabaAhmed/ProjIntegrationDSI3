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

    <title>Seances CRUD</title>
</head>
<?php include '../inc/header.php'; ?>

<body>
    
  
    <div class="container mt-4">

        <?php include('message.php'); ?>
        <div class="row">
        <div class="col-md-6">
        <form action="search_form.php" method="post">
            <div class="input-group mb-3">
                <input type="text" name="search" class="form-control" placeholder="Rechercher seance">
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
            </div>
        </form>
        </div>
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Details de seance
                            <a href="creer_seance.php" class="btn btn-primary float-end">Creer seance</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SEANCE</th>
                                    <th>Horaire</th>
                                    <th>Heure de debut</th>
                                    <th>Heure de fin</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $query = "SELECT * FROM seances";
                                    $query_run = mysqli_query($con, $query);

                                    if(mysqli_num_rows($query_run) > 0)
                                    {
                                        $seancesData = array();

                                        while ($row = mysqli_fetch_assoc($query_run)) {
                                            $seancesData[] = $row;  // Add each row to the array
                                        }

                                        
                                        $_SESSION['seances'] = $seancesData;
                                        foreach($query_run as $seance)
                                        {
                                            ?>
                                            <tr>
                                                <td><?= $seance['SEANCE']; ?></td>
                                                <td><?= $seance['Horaire']; ?></td>
                                                <td><?= $seance['HDeb']; ?></td>
                                                <td><?= $seance['HFin']; ?></td>
                                                <td>
                                                    <a href="seance-voir.php?SEANCE=<?= $seance['SEANCE']; ?>" class="btn btn-info btn-sm">Voir</a>
                                                
                                                    <form action="code.php" method="POST" class="d-inline">
                                                        <button type="submit" name="supprimer_seance" value="<?=$seance['SEANCE'];?>" class="btn btn-danger btn-sm" onclick="return confirm(`Are you sure you want to delete this seance?`);">Supprimer</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo "<h5> Pas de seance trouvees</h5>";
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                        <form method='POST' action='downloadPDF.php' class='resaultForm'>
                            <input type='hidden' name='seances' value='<?= htmlspecialchars(json_encode($seancesData)) ?>'>
                            <button type='submit'>Imprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>