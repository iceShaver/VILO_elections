<?php

include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/magicquotes.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/helpers.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/access.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/dbconnect.inc.php';
if (!userIsLoggedIn()) {
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/login.html.php';
    exit();
}

if (userIsLocked()) {
    header('refresh: 1');
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/locked.html.php';
    
    exit();
    
}

    $_SESSION['wait'] = FALSE;
    header('Location: ./../');




