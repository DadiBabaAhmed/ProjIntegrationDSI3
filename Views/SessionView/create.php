<?php include_once 'config/init.php'; ?>

<?php

$session = new Session;

if (isset($_POST['submit'])) {
    // Create Data Array
    $data = array();
    $data['Annee'] = $_POST['Annee'];
    $data['Sem'] = $_POST['Sem'];
    $data['SemAb'] = $_POST['SemAb'];
    $data['Debut'] = $_POST['Debut'];
    $data['Fin'] = $_POST['Fin'];
    $data['Debsem'] = $_POST['Debsem'];
    $data['Finsem'] = $_POST['Finsem'];
    $data['Annea'] = $_POST['Annea'];
    $data['Anneab'] = $_POST['Anneab'];
    
    if ($session->create($data)) {
        redirect('index.php', 'Votre session a ete ajoutee', 'success');
    } else {
        redirect('index.php', 'Erreur lors de l\'ajout de la session', 'error');
    }
}





$template = new Template('templates/session-create.php');
$template->title = "sessions";
$template->sessions = $session->getAllSessions();
echo $template;