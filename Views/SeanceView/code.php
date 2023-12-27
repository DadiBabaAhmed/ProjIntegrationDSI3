<?php
session_start();
require '../../DataBase/connect.php';

if(isset($_POST['supprimer_seance']))
{
    $seance= mysqli_real_escape_string($con, $_POST['supprimer_seance']);

    $query = "DELETE FROM seances WHERE SEANCE='$seance' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Seance supprimer avec succees";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Seance pas supprimer";
        header("Location: index.php");
        exit(0);
    }
}

if(isset($_POST['modifier_seance']))
{
    $seance = mysqli_real_escape_string($con, $_POST['SEANCE']);

    $horaire = mysqli_real_escape_string($con, $_POST['Horaire']);
    $hdeb = mysqli_real_escape_string($con, $_POST['HDeb']);
    $hfin = mysqli_real_escape_string($con, $_POST['HFin']);

    $query = "UPDATE seances SET Horaire='$horaire', HDeb='$hdeb', HFin='$hfin' WHERE SEANCE='$seance' ";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Seance modifier avec success!";
        header("Location: index.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Seance pas trouvee";
        header("Location: index.php");
        exit(0);
    }

}


if (isset($_POST['sauv_seance'])) {
    $seance = mysqli_real_escape_string($con, $_POST['SEANCE']);
    $horaire = mysqli_real_escape_string($con, $_POST['Horaire']);
    $hdeb = mysqli_real_escape_string($con, $_POST['HDeb']);
    $hfin = mysqli_real_escape_string($con, $_POST['HFin']);

    // Validate input
    if (!preg_match("/^S[1-6]$/", $seance)) {
        $_SESSION['message'] = "Numero de la seance invalide. Utilisez S1 à S6.";
        header("Location: creer_seance.php");
        exit(0);
    }

    if (!preg_match("/^1h30mn$/", $horaire)) {
        $_SESSION['message'] = "Format d'horaire invalide. Utilisez 1h30mn.";
        header("Location: creer_seance.php");
        exit(0);
    }

    if (!preg_match("/^\d{2}:\d{2}$/", $hdeb) || !preg_match("/^\d{2}:\d{2}$/", $hfin)) {
        $_SESSION['message'] = "Format d'heure invalide. Utilisez hh:mn.";
        header("Location: creer_seance.php");
        exit(0);
    }

    // Ensure heure de debut is less than heure de fin
    if (strtotime($hdeb) >= strtotime($hfin)) {
        $_SESSION['message'] = "Heure de debut doit être inférieure à heure de fin.";
        header("Location: creer_seance.php");
        exit(0);
    }

    $format = 'H:i';
    $start_time = DateTime::createFromFormat($format, $hdeb);
    $end_time = DateTime::createFromFormat($format, $hfin);

    $expected_end_time = clone $start_time;
    $expected_end_time->modify('+1 hour 30 minutes');

    if ($end_time != $expected_end_time) {
        // The difference is not 1h30mn, set an error message
        $_SESSION['message'] = "La différence entre l'heure de début et l'heure de fin doit être de 1h30mn. Veuillez réessayer.";
        header("Location: creer_seance.php");
        exit(0);
    }

    $expected_start_time = null;
    $expected_end_time = null;

    switch ($seance) {
        case 'S1':
            $expected_start_time = '08:30';
            $expected_end_time = '10:00';
            break;
        case 'S2':
            $expected_start_time = '10:05';
            $expected_end_time = '11:35';
            break;
        case 'S3':
            $expected_start_time = '11:40';
            $expected_end_time = '13:10';
            break;
        case 'S4':
            $expected_start_time = '13:15';
            $expected_end_time = '14:45';
            break;
        case 'S5':
            $expected_start_time = '14:50';
            $expected_end_time = '16:20';
            break;
        case 'S6':
            $expected_start_time = '16:25';
            $expected_end_time = '17:55';
            break;
        
        // Add more cases for other seances as needed
        default:
            // Handle the case where an invalid seance is provided
            $_SESSION['message'] = "Seance invalide. Veuillez réessayer.";
            header("Location: creer_seance.php");
            exit(0);
    }

    if ($hdeb !== $expected_start_time || $hfin !== $expected_end_time) {
        // "heure de debut" and/or "heure de fin" do not correspond to the expected time range
        $_SESSION['message'] = "L'heure de début et/ou l'heure de fin ne correspondent pas à la séance $seance. Veuillez réessayer.";
        header("Location: creer_seance.php");
        exit(0);
    }

    $check_query = "SELECT * FROM seances WHERE SEANCE='$seance'";
    $check_result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($check_result) > 0) {
        // Session already exists, set an error message
        $_SESSION['message'] = "La séance avec l'ID $seance existe déjà dans la base de données.";
        header("Location: creer_seance.php");
        exit(0);
    }

    

    // If validation passes, insert the data into the database
    $query = "INSERT INTO seances (SEANCE, Horaire, HDeb, HFin) VALUES ('$seance', '$horaire', '$hdeb', '$hfin')";

    $query_run = mysqli_query($con, $query);
    if ($query_run) {
        $_SESSION['message'] = "Seance Ajoutee avec success";
        header("Location: creer_seance.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Seance pas cree";
        header("Location: creer_seance.php");
        exit(0);
    }
}

