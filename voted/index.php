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
try {
    $result=$pdo->query('SELECT settings FROM config WHERE id = "time"');
    
    
} catch (PDOException $e) {
    $error = 'Wystąpił błąd podczas pobierania ustawień' . $e->getMessage();
        include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/error.html.php';
        exit();
}
$time = $result->fetch();

    $_SESSION['wait'] = true;
?>

<!DOCTYPE html>
<html lang="pl">
    <head>
        <script language="javascript">
function odliczaj(n)
{
    n--;
    s = n%60;
    m = Math.floor((n%3600)/60);
    g = Math.floor(n/3600);   
    if (n == 0)
    {
        document.getElementById('timer').innerHTML = '';
    }
    else
    {
        document.getElementById('timer').innerHTML = ((s < 10) ?  + s : s);
        if(n >= 0)
            setTimeout("odliczaj(" + n + ")", 1000);
    }
}
window.onload=function () { odliczaj('<?php htmlout($time[0]+1); ?>'); }
</script>
        <meta http-equiv="Refresh" content="<?php htmlout($time[0]); ?>; url=./protect.php" />
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./../styles/main.css">
        <title>Oddano głos</title>
    </head>
    <body>
        <div  id="title" style="display: none">
            Wybory do samorządu 2015
        </div>
        <div id="nav" style="display: none"></div>
        <div class="content" id="voted">
        
            Dziękujemy za oddanie głosu. Następna osoba będzie mogła zagłosować za <span id="timer"></span>
        
        </div>
    </body>
</html>