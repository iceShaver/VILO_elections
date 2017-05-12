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
if (userIsAdmin()) {
    header('Location: ./admin');
    exit();
}

if (isset($_SESSION['wait']) and $_SESSION['wait'] == true) {
    header('Location: ./voted/');
    exit();
}


if (isset($_POST['action']) and $_POST['action'] == 'voted') {
    $candidateid = 1;
    if(isset($_POST['candidate']))
        $candidateid = $_POST['candidate'];
    try {
        $sql = 'UPDATE candidates SET votes = votes + 1 WHERE id = :id';
        $s = $pdo->prepare($sql);
        $s->bindValue(':id', $candidateid);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił błąd podczas wprowadzania głosu do bazy danych. Skontaktuj się z administratorem systemu.'
                . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    try {
        $sql = 'INSERT INTO votes SET
                candidateid = :candidateid,
                username = :username,
                votetime = CURRENT_TIMESTAMP()';
        $s = $pdo->prepare($sql);
        $s->bindValue(':candidateid', $candidateid);
        $s->bindValue(':username', $_SESSION['name']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił błąd podczas wprowadzania głosu do bazy danych. Skontaktuj się z administratorem systemu.'
                . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }

    header('Location: ./voted/');
    exit();
}


try {
    $result = $pdo->query('SELECT id, name FROM candidates WHERE id != 1');
    
} catch (PDOException $e) {
    $error = 'Wystąpił błąd podczas pobierania listy kandydatów z bazy danych: ' . $e->getMessage();
    include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
    exit();
}

foreach ($result as $row) {
    $candidates [] = array('id' => $row['id'], 'name' =>$row['name']);
}

include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/candidates.html.php';

//TODO:
//DONE--grafika
//DONE--odliczanie w 'voted
//odświeżanie wyników (jednego div'a zamiast całości)

//rozmiary pól?

//DONE--kolory przycisków (blokowanie)
//resetowanie wyborów
//DONE--potwierdzenie usunięcia kandydata
//DONE--efekt wyboru (poprawić rozmiary, cienie, kolor, hover itd.)
//popr. str. błedów (odwołania do css)
//DONE--dodać pusty głos (nie liczyć procentów)
//DONE--wyniki: wypisac puste glosy
//DONE--!uniemożliwienie cofnięcia po zagłosowaniu (set session na poczatku 
//DONE---> przekierownie na dodatkowa strone, tam unset) 
//DONE--+ sprawdzanie czy obecny na pocz index.php jesli tak to przkierowanie do voted
//DONE--DODAC OBSLUGE NIEZAZNACZONEGO KANDYDATA!
//DONE--zablokowanie podwojnego kliniecia submit

