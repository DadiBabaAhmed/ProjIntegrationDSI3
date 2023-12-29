<?php
include_once 'config/init.php';
include '../../Classes/Session.php';
include '../../Classes/template.php';
include '../../DataBase/database2.php';

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

    try {
        if ($session->create($data)) {
            redirect('list_sessions.php', 'Votre session a été ajoutée', 'success');
        } else {
            redirect('list_sessions.php', 'Erreur lors de l\'ajout de la session', 'error');
        }
    } catch (PDOException $e) {
        if ($e->getCode() == '23000') {
            // Handle the duplicate entry error
            $errorMessage = 'Erreur lors de l\'ajout de la session: Duplicate entry';
            redirect('list_sessions.php', $errorMessage, 'error');
        } else {
            // Handle other PDO exceptions
            $errorMessage = 'Erreur lors de l\'ajout de la session: ' . $e->getMessage();
            redirect('list_sessions.php', $errorMessage, 'error');
        }
    }

}
$template = new Template('templates/session-create.php');
$template->title = "sessions";
$template->sessions = $session->getAllSessions();
echo $template;