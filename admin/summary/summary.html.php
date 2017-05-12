<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./../../styles/main.css">
        <title>Wyniki</title>
    </head>
    <body>
        <div id="nav">
        <a href="./../">Powrót</a>
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/Elections/html/logout.html.php'; ?>
            </div>
        <div class="content" id="summary">
            
        
        Wyniki:<hr>
        Liczba oddanych głosów: <?php htmlout($totalVotes); ?><br>
        Liczba pustych głosów: <?php htmlout($nullVotes[0]); ?><br>
        Liczba niepustych głosów: <?php htmlout($totalVotesNotNull); ?><br>
        
        <table  cellpadding="10">
            <tr><th>Kandydat </th><th>Liczba głosów</th><th>Procent głosów</th></tr>
            <?php foreach ($score as $candidate): ?>
            <tr <?php
            
                if ($i == 0) {
                    echo 'bgcolor="lightblue"';
                }
            $i+=1;
            ?>><td><?php htmlout($candidate['name']); ?></td><td><?php htmlout($candidate['votes']); ?></td><td><?php 
            
            if($totalVotesNotNull == 0)
                htmlout ('0');
            else
                htmlout(round(($candidate['votes']/$totalVotesNotNull)*100, 2)); ?>%</td></tr>
            <?php endforeach; ?>
        </table>
      
        </div>
    </body>
</html>