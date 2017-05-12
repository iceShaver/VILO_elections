<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./../../styles/main.css">
        <title>Potwierdzenie</title>
    </head>
    <body>
        <div id="nav">
        <a href=".">Powrót</a>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/logout.html.php'; ?>
            </div>
        <div class="content" id="confirm">
            <form name="confirm" action="" method="post">
            <fieldset>
                <legend>Potwierdź operację</legend>
                <br>
                
                <input type="hidden" name="id" value="<?php htmlout($_POST['id']); ?>">
                <input type="hidden" name="action" value="deleteconfirm">
                <br><br>
                <input type="submit" name="action" value="Tak">
		<input type="submit" name="action" value="Nie">
            </fieldset>
            
        </form>
        </div>
    </body>
</html>