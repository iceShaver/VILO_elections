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
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/admin/html/accessdenied.html.php';
    exit();
}

    try {
    $sql = 'SELECT name, votes FROM candidates WHERE id != 1 ORDER BY votes DESC';
    $result = $pdo->query($sql);
} catch (PDOException $e) {
    $error = 'Wystąpił błąd podczas pobierania informacji o głosach';
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/hmtl/error.html.php';
    exit();
}
$totalVotesNotNull = 0;
foreach ($result as $row) {
    $score[] = array('name' => $row['name'], 'votes' => $row['votes']);
    $totalVotesNotNull += $row['votes'];
}
try {
    $result = $pdo->query('SELECT votes FROM candidates WHERE id = 1');
    $nullVotes = $result->fetch();
} catch (PDOException $e) {
    $error = 'Wystąpił błąd podczas pobierania informacji o głosach';
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/hmtl/error.html.php';
    exit();
}
$totalVotes = $totalVotesNotNull + $nullVotes[0];



$i = 0;

//    header('refresh: 1;');
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/admin/summary/summary.html.php';