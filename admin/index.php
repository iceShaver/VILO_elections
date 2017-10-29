<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/magicquotes.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/helpers.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/access.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/Elections/includes/dbconnect.inc.php';

if (!userIsLoggedIn()) {
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/admin/html/login.html.php';
    exit();
}
if (!userIsAdmin()) {
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/admin/html/accessdenied.html.php';
    exit();
}



if (isset($_POST['action']) and $_POST['action'] == 'unlock') {
    
    
    try {
        $sql = 'UPDATE users SET
            isLocked = "NO"
            WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił błąd podczas odblokowywania uzytkownika';
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }

    header('Location: .');
    exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'lock') {
    
    
    try {
        $sql = 'UPDATE users SET
            isLocked = "YES"
            WHERE id = :id';
    $s = $pdo->prepare($sql);
    $s->bindValue(':id', $_POST['id']);
    $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił błąd podczas zablokowywania użytkownika';
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/hmtl/error.html.php';
        exit();
    }
    header('Location: .');
    exit();
    
}
try {
    $result = $pdo->query('SELECT id, name, isLocked FROM users');
} catch (PDOException $e) {
    $error = 'Wystąpił błąd podczas pobierania informacji o użytkownikach';
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/hmtl/error.html.php';
    exit();
}

foreach ($result as $row) {
    $users[] = array('id' => $row['id'], 'name' => $row['name'], 'isLocked' => $row['isLocked']);
}


include $_SERVER['DOCUMENT_ROOT'] . '/Elections/admin/html/admin.html.php';