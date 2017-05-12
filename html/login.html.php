<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <title>Zaloguj się</title>
    </head>
    <body oncontextmenu="return false">
        <div class="content">
        <div class="loginform">
            <form name="loginform" id="login" action="" method="post">
                <fieldset align="center">
                    <legend>Zaloguj się</legend>
                    <br>
                    <label for="name">Login: </label><input type="text" name="name" id="name">
                    <br>
                    <label for="password">Hasło: </label><input type="password" name="password" id="password">
                    <br>
                    <input type="hidden" name="action" value="login">
                    <br>
                    <input type="submit" value="Zaloguj">
                </fieldset>
            </form>
        </div>
        </div>
    </body>
</html>



