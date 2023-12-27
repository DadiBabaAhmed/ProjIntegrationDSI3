<?php include_once 'config/init.php';
include '../../Classes/Session.php';
include '../../Classes/template.php';
include '../../DataBase/database2.php'; ?>

<?php

$session = new Session;

if (isset($_POST['del_id'])){
    $del_id = $_POST['del_id'];
    try {
        if ($session->deleteSession($del_id)) {
            redirect('index.php', 'Session supprimee', 'success');
        } else {
            redirect('index.php', 'Erreur lors de la suppression de la session', 'error');
        }
    } catch (PDOException $e) {
        if ($e->getCode() == 23000) {
            redirect('index.php', 'Impossible de supprimer cette session car elle est référencée par d\'autres données.', 'error');
        } else {
            redirect('index.php', 'An unexpected error occurred while deleting the session.', 'error');
        }
    }
}

$template = new Template('templates/session-single.php');

$session_id = isset($_GET['id']) ? $_GET['id'] : null;

$template->session = $session->getSession($session_id);
echo $template;