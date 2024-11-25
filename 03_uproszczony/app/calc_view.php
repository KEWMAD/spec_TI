<?php //góra strony z szablonu 
include _ROOT_PATH.'/templates/top.php';
?>

<h3>Prosty kantor</h2>

<form class="pure-form pure-form-stacked" action="<?php print(_APP_ROOT);?>/app/calc.php" method="post">
<fieldset>
    <label for="kwota">Podaj kwote: </label><input id="kwota" type="text" placeholder="kwota" name="kwota" value="<?php out($form['kwota']); ?>" /><br>
    <label for="kurs"> Podaj kurs: </label><input id="kurs" type="text" placeholder="kurs" name="kurs" value="<?php out($form['kurs']); ?>" /><br>
    <input type="radio" name="akcja" value="K" checked=true/>Kup <br /> <!-- zamiast radio, text gdzie użytkownik wpisuje kurs, radio do wybrania  -->
    <input type="radio" name="akcja" value="S"/>Sprzedaj <br />
	</fieldset>	
	<button type="submit" class="pure-button pure-button-primary">Przelicz</button>
</form>	

<div class="messages">

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
	if (count ( $messages ) > 0) {
	echo '<h4>Wystąpiły błędy: </h4>';
	echo '<ol class="err">';
		foreach ( $messages as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php
//wyświeltenie listy informacji, jeśli istnieją
if (isset($infos)) {
	if (count ( $infos ) > 0) {
	echo '<h4>Informacje: </h4>';
	echo '<ol class="inf">';
		foreach ( $infos as $key => $msg ) {
			echo '<li>'.$msg.'</li>';
		}
		echo '</ol>';
	}
}
?>

<?php if (isset($result)){ ?>
	<h4>Wynik</h4>
	<p class="res">
<?php print($result); ?>
	</p>
<?php } ?>

</div>

<?php //dół strony z szablonu 
include _ROOT_PATH.'/templates/bottom.php';
?>