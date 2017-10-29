<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/magicquotes.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/helpers.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/access.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/dbconnect.inc.php';

if (!userIsLoggedIn()) {
    include './../html/login1.html.php';
    exit();
}
if (!userIsAdmin()) {
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/accessdenied.html.php';
    exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'set') {
    try {
        $sql = 'UPDATE config SET settings = :settings WHERE id = "time"';
        $s=$pdo->prepare($sql);
        $s->bindValue(':settings', $_POST['time']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił bład podczas zapisywania ustawień';
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
    exit();
    }
    header('Location: .');
    exit();
    
    
}

try {
    $result = $pdo->query('SELECT settings FROM config WHERE id = "time"');
} catch (PDOException $e) {
    $error = 'Wystąpił bład podczas odczytywania ustawień';
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
    exit();
}
$selected = $result->fetch();


include $_SERVER['DOCUMENT_ROOT'] . '/Elections/admin/settings/settings.html.php';





