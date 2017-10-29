<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./../../styles/main.css">
        <title><?php echo $pageTitle; ?></title>
    </head>
    <body>
        <div id="nav">
        <a href=".">Powrót</a>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/logout.html.php'; ?>
            </div>
        <div class="content" id="candform">
            <form name="addeditcand" action="" method="post">
            <fieldset>
                <legend><?php echo $pageTitle; ?></legend>
                <br>
                <label for="name">Imię i Nazwisko: </label><input type="text" name="name" id="name" value="<?php htmlout($name); ?>">
                <input type="hidden" name="id" value="<?php htmlout($id); ?>">
                <input type="hidden" name="action" value="<?php echo $action; ?>">
                <br><br>
                <input type="submit" value="<?php echo $button; ?>">
            </fieldset>
            
        </form>
        </div>
    </body>
</html>