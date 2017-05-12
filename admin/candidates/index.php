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

if (isset($_POST['action']) and $_POST['action'] == 'editform') {
    
    try {
        $sql = 'UPDATE candidates SET
                name = :name
                WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił bład podczas zapisywania informacji o kandydacie: ' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    
    header('Location: .');
    exit();
}
if(isset($_POST['action']) and $_POST['action'] == 'Usuń'){
    
    include 'confirm.html.php';
    exit();
    
}
if (isset($_POST['action']) && $_POST['action']=='Nie')
{
	header('Location: .');
        exit();
}
if (isset($_POST['action']) and $_POST['action'] == 'Tak') {
    try {
        $sql = 'DELETE FROM candidates WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił bład podczas usuwania kandydata: ' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    header('Location: .');
    exit();

}

if (isset($_POST['action']) and $_POST['action'] == 'addform') {
    
    try {
        $sql = 'INSERT INTO candidates SET
                name = :name,
                votes = 0';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_POST['name']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił bład podczas dodawania nowego kandydata: ' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    header('Location: .');
    exit();
    
}
if (isset($_GET['addcandidate'])) {
    $pageTitle = 'Dodawanie nowego kandydata';
    $action = 'addform';
    $name = '';
    $id = '';
    $button = 'Dodaj';
    
    include 'form.html.php';
    exit();
}




if (isset($_POST['action']) and $_POST['action'] == 'Edytuj') {
    try {
        $sql = 'SELECT id, name FROM candidates WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $_POST['id']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił bład podczas pobierania danych kandydata' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    $row = $s->fetch();
    
    $pageTitle = 'Edycja danych kandydata';
    $action = 'editform';
    $name = $row['name'];
    $id = $row['id'];
    $button = 'Aktualizuj kandydata';
    
    include 'form.html.php';
    exit();
}



    try {
    $result = $pdo->query('SELECT id, name FROM candidates WHERE id != 1 ORDER BY name');
    
    } catch (PDOException $e) {
    $error = 'Wystąpił bład podczas pobierania listy kandydatów';
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
    exit();
    }

    foreach ($result as $row) {
        $candidates[] = array('id' => $row['id'], 'name' => $row['name']);
    }
    
    include 'candidatesmgmt.html.php';
    exit();





