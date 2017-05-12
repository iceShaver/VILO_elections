<?php

function userIsLoggedIn()
{
    if (isset($_POST['action']) and $_POST['action'] == 'login') 
    {
            if (!isset($_POST['name']) or $_POST['name'] == '' or !isset($_POST['password']) or $_POST['password'] == '') 
                {
                    $GLOBALS['loginError'] = 'Oba pola muszą zostać wypełnione';
                    return FALSE;
                }
            $password = md5($_POST['password'] . 'electionsvilo');
            if (dbContainsAuthor($_POST['name'], $password)) {
                session_start();
                $_SESSION['loggedIn'] = TRUE;
                $_SESSION['name'] = $_POST['name'];
                $_SESSION['password'] = $password;
                return TRUE;
            }else
            {
                session_start();
                unset($_SESSION['loggedIn']);
                unset($_SESSION['name']);
                unset($_SESSION['password']);
                $GLOBALS['loginError'] = 'Login lub hasło są niepoprawne.';
                return FALSE;
            }
        
            
        
    }
        
    if ((isset($_POST['action']) and $_POST['action'] == 'logout') or (isset($_GET['logout'])))
    {
        session_start();
        unset($_SESSION['loggedIn']);
        unset($_SESSION['name']);
        unset($_SESSION['password']);
        header('Location: .' );
        exit();
    }
    
    session_start();
    if(isset($_SESSION['loggedIn']))
    {
        return dbContainsAuthor($_SESSION['name'], $_SESSION['password']);
    }
}

function dbContainsAuthor($name, $password) {
    
    include 'dbconnect.inc.php';
    try {
        $sql = 'SELECT COUNT(*) FROM users WHERE name = :name AND password = :password';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $name);
        $s->bindValue(':password', $password);
        $s->execute();
        
    } catch (PDOException $e) {
        $error = 'Błąd przy wyszukiwaniu użytkownika.' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    
    $row = $s->fetch();
    if ($row[0]>0) {
        return TRUE;
    }else
        return FALSE;

}

function userIsAdmin() {
    include 'dbconnect.inc.php';
    try {
        $sql = 'SELECT adminPrivileges FROM users WHERE name = :name';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_SESSION['name']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił błąd podczas sprawdzania praw administracyjnych użytkownika użytkownika' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    
    $row = $s->fetch();
    if ($row['adminPrivileges']=='YES') {
        return TRUE;
    }
    else 
    {
        return FALSE;
    }

}

function userIsLocked()
{
    include 'dbconnect.inc.php';
    try {
        $sql = 'SELECT isLocked FROM users WHERE name = :name';
        $s = $pdo->prepare($sql);
        $s->bindValue(':name', $_SESSION['name']);
        $s->execute();
    } catch (PDOException $e) {
        $error = 'Wystąpił błąd podczas sprawdzania stanu blokowania użytkownika' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
    }
    
    $row = $s->fetch();
    if ($row['isLocked']=='YES') {
        return TRUE;
    }
    else 
    {
        return FALSE;
    }

}



