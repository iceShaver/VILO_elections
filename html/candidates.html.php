<!DOCTYPE html>
<html lang="pl">
    <head>
        
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="./styles/main.css">
        <title>Wybory do samorządu <?php echo date('o'); ?></title>
    </head>
    <body>
        <div id="nav" style="display: none">
            <a id="help" href="#" onClick="
                
    if (document.getElementById('helpCloud').style.display == 'none') {
        document.getElementById('helpCloud').style.display = 'block';
}else{
    document.getElementById('helpCloud').style.display = 'none';
}
           " style="display: none">Pomoc</a>
        </div>
        <div id="helpCloud" style="display: none">
            Aby zagłosować na kandydata wybierz go z poniższej listy, a następnie kliknij przycisk głosuj. Jeżeli nie chcesz głosować 
				na żadnego spośród poniższych kandydatów możesz wybrać pusty głos. Niewybranie żadnego kandydata jest równoważne oddaniu pustego głosu!
        </div>
        <div  id="title" style="display: none">
            Wybory do samorządu 2015
        </div>
		<div class="top" id="instruction">
                    Aby zagłosować na kandydata wybierz go z poniższej listy, a następnie kliknij przycisk głosuj. Jeżeli nie chcesz głosować 
				na żadnego spośród poniższych kandydatów możesz wybrać pusty głos. Niewybranie żadnego kandydata jest równoważne oddaniu pustego głosu!
		 (Kandydaci zostali ułożeni w kolejności alfabetycznej).
		</div>
        <div class="content" id="candidates">
<form name="candidates" action="" method="post">
            <fieldset id="candidates">
                <legend>Kandydaci: </legend>
				

				
	
                <input type="hidden" name="action" value="voted">
                <?php foreach ($candidates as $candidate): ?><p>
		<input type='radio' id="<?php htmlout($candidate['id']); ?>" name="candidate" value="<?php htmlout($candidate['id']); ?>">
                <label for="<?php htmlout($candidate['id']); ?>"><?php htmlout($candidate['name']); ?></label><p>
                <?php endforeach; ?>
				<hr>
				<input type='radio' id="1" name="candidate" value="1">
                <label for="1">Pusty głos</label><br><br>
                
                <input type="submit" value="Głosuj" onclick="this.disabled=true,this.form.submit();">
            </fieldset>
        </form>
        </div>
    </body>
</html>