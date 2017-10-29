<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./../../styles/main.css">
        <title>Administracja - ustawienia</title>
    </head>
    <body>
         <div id="nav">
        <a href="./../">Powrót</a>
        
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/logout.html.php'; ?>
            </div>
        <div class="content" id="settings">
           
        
            <p>
            <form action="" method="post">
                <label for="time">Odstęp czasowy pomiędzy kolejnymi głosami (w sekundach):</label>
                <select name="time" id="time">
                    <?php
                    
                    for($i = 0; $i<=50; $i++)
                    {
                        
                            echo "<option>$i</option>";
                    }   
                    ?>
                </select>
                <input type="hidden" name="action" value="set">
                <input type="submit" value="Zapisz">
                
            </form>
            </p>
        
        
        
        </div>
    </body>
</html>