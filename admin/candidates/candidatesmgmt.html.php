<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./../../styles/main.css">
        <title>Zarządzanie kandydatami</title>
    </head>
    <body>
        <div id="nav">
            <a href="./../">Powrót</a>
        <a href="?addcandidate">Dodaj nowego kandydata</a>
        
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/logout.html.php'; ?>
        </div>
        <div class="content" id="candmgmt">
            
        
        <table>
            <tr><th>Kandydat</th>
                <th>Opcje</th></tr>
        <?php foreach ($candidates as $candidate): ?>
        <tr valign="top">
            <td><?php htmlout($candidate['name']); ?></td>
                    <td>
                        <form name="candmgmt" action="" method="post">
                            <div>
                                <input type="hidden" name="id" value="<?php htmlout($candidate['id']); ?>">
                                <input type="submit" name="action" value="Edytuj">
                                <input type="submit" name="action" value="Usuń">
                            </div>
                        </form>
                    </td>
                </tr>
        <?php endforeach; ?>
        </table>
        </div>
    </body>
</html>

