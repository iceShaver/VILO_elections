<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./../styles/main.css">
        <title>Administracja</title>
    </head>
    <body>
         <div id="nav">
        <a href="./summary">Podsumowanie wyborów</a>
        <a href="./candidates/">Zarządzanie kandydatami</a>
        <a href="./settings/">Ustawienia</a>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/logout.html.php'; ?>
            </div>
        <div class="content" id="admin">
           
        
        <table>
            <tr><th>Użytkownik</th><th>Akcje</th></tr>
            <?php foreach ($users as $user): ?>
            
            <tr><td><?php htmlout($user['name']); ?></td><td>
                    <form name="users" action="" method="post">
                        <input type="hidden" name="id" value="<?php htmlout($user['id']); ?>">
                        <input type="hidden" name="action" value="<?php 
                        if ($user['isLocked'] == 'YES') {
                            echo 'unlock';
                        }  else {
                            echo 'lock';
                        } ?>">
                        <input type="submit" value="<?php 
                        if ($user['isLocked'] == 'YES') {
                            echo 'Odblokuj';
                        }  else {
                            echo 'Zablokuj';
                        } ?>">
                    </form>
            
            
            
            
            </td></tr>
            <?php endforeach; ?>
        </table>
        
        
        
        </div>
    </body>
</html>