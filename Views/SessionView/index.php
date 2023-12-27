<?php
include_once 'config/init.php';

$session = new Session;
$template = new Template('templates/frontpage.php');

$Annee = isset($_GET['Annee']) ? $_GET['Annee'] : null;
print_r($Annee);
if ($Annee) {
    $template->sessions = $session->getByAnnee($Annee);
    $template->title = 'Sessions pour ' . $_GET['Annee'];
} else {
    $template->title = 'Toutes les sessions';
    $template->sessions = $session->getAllSessions();
}

$template->Annees = $session->getAllAnne();
$template->sessions = $session->getAllSessions();
echo $template;
?>