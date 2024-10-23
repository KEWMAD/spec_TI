<?php
require_once dirname(__FILE__).'/../config.php';

// KONTROLER strony kalkulatora

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate($kwota,$kurs,$akcja,$messages){
	// sprawdzenie, czy parametry zostały przekazane
	if ( ! (isset($kwota) && isset($kurs))) {
		$messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
	}
	// sprawdzenie, czy parametry nie są puste
	if ( $kwota == "") {
		$messages [] = 'Nie podano kwoty';
	}
	if ( $kurs == "") {
		$messages [] = 'Nie podano waluty';
	}
	// sprawdzanie czy admin jest zalogowany
	if($_SESSION['role'] != 'admin' && $kwota > 100){
		$messages [] = 'Za duża kwota';
	}
	// sprawdzenie, czy parametry są cyframi
	if (empty( $messages )) {
		if (! is_numeric($kwota)) {
			$messages [] = 'Kwota musi być liczbą';
		}
		if (! is_numeric($kurs)) {
			$messages [] = 'Kurs musi być liczbą';
		}
	// sprawdzenie, czy parametry są liczbami dodatnimi
		if ( $kurs<0 || $kwota<0) {
			$messages [] = 'Kurs ani Kwota nie mogą być ujemne';
		}
	}
	if (count ( $messages ) != 0) return false;
	else return true;
}

function process($kwota,$kurs,$akcja,$messages,$result){
	global $role;
	
	//konwersja parametrów na float
	$kwota= floatval($kwota);
	$kurs= floatval($kurs);
	
	//wykonanie operacji
	if ($akcja=='S'){
		global $result;
		$result=$kwota*$kurs;
	}
	else{
		global $result;
		$result=$kwota/$kurs;
	}
}

//definicja zmiennych kontrolera
$result = null;
$messages = array();


$kwota=isset($_REQUEST["kwota"]) ? $_REQUEST["kwota"] : '';
$kurs=isset($_REQUEST["kurs"])? $_REQUEST["kurs"]: '';
$akcja=isset($_REQUEST["akcja"])? $_REQUEST["akcja"]: '';	

//pobierz parametry i wykonaj zadanie jeśli wszystko w porządku
if ( validate($kwota,$kurs,$akcja,$messages) ) { // gdkurs brak błędów
	process($kwota,$kurs,$akcja,$messages,$result);
}

// Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$kwota,$y,$akcja,$result)
//   będą dostępne w dołączonym skrypcie
include 'calc_view.php';