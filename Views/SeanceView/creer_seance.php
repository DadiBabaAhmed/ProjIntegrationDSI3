<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Ajouter seance</title>
</head>
<body>
  
    <div class="container mt-5">

        <?php include('message.php'); ?> 

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Ajouter seance 
                            <a href="index.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form action="code.php" method="POST">

                        <div class="mb-3">
                                <label>Numero de la seance (S1 a S6)</label>
                                <select name="SEANCE" id="seanceSelect" class="form-control">
                                    <option value="S1">S1</option>
                                    <option value="S2">S2</option>
                                    <option value="S3">S3</option>
                                    <option value="S4">S4</option>
                                    <option value="S5">S5</option>
                                    <option value="S6">S6</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label>Horaire (1h30mn)</label>
                                <input type="text" name="Horaire" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Heure de debut (hh:mn)</label>
                                <input type="text" name="HDeb" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Heure de fin (hh:mn)</label>
                                <input type="text" name="HFin" class="form-control">
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="sauv_seance" class="btn btn-primary">Sauvegarder la seance</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('seanceSelect').addEventListener('change', function() {
            var selectedSeance = this.value;
            // Use a switch case or if-else to set values based on the selectedSeance
            switch (selectedSeance) {
                case 'S1':
                    document.getElementsByName('Horaire')[0].value = '1h30mn';
                    document.getElementsByName('HDeb')[0].value = '08:30';
                    document.getElementsByName('HFin')[0].value = '10:00';
                    break;
                case 'S2':
                    document.getElementsByName('Horaire')[0].value = '1h30mn';
                    document.getElementsByName('HDeb')[0].value = '10:05';
                    document.getElementsByName('HFin')[0].value = '11:35';
                    break;
                case 'S3':
                    document.getElementsByName('Horaire')[0].value = '1h30mn';
                    document.getElementsByName('HDeb')[0].value = '11:40';
                    document.getElementsByName('HFin')[0].value = '13:10';
                    break;
                case 'S4':
                    document.getElementsByName('Horaire')[0].value = '1h30mn';
                    document.getElementsByName('HDeb')[0].value = '13:15';
                    document.getElementsByName('HFin')[0].value = '14:45';
                    break;
                case 'S5':
                    document.getElementsByName('Horaire')[0].value = '1h30mn';
                    document.getElementsByName('HDeb')[0].value = '14:50';
                    document.getElementsByName('HFin')[0].value = '16:20';
                    break;
                case 'S6':
                    document.getElementsByName('Horaire')[0].value = '1h30mn';
                    document.getElementsByName('HDeb')[0].value = '16:25';
                    document.getElementsByName('HFin')[0].value = '17:55';
                    break;
                default:
                    // Default values or actions if needed
                    break;
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
