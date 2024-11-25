<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// Kontroler podzielono na część definicji etapów (funkcje)
// oraz część wykonawczą, która te funkcje odpowiednio wywołuje.
// Na koniec wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy  przez zmienne.

//pobranie parametrów
function getParams(&$form){
	$form['kwota'] = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : null;
	$form['kurs'] = isset($_REQUEST['kurs']) ? $_REQUEST['kurs'] : null;
	$form['akcja'] = isset($_REQUEST['akcja']) ? $_REQUEST['akcja'] : null;	
}

//walidacja parametrów z przygotowaniem zmiennych dla widoku
function validate(&$form,&$infos,&$msgs,&$hide_intro){

	//sprawdzenie, czy parametry zostały przekazane - jeśli nie to zakończ walidację
	if ( ! (isset($form['kwota']) && isset($form['kurs']) && isset($form['akcja']) ))	return false;	
	
	//parametry przekazane zatem
	//nie pokazuj wstępu strony gdy tryb obliczeń (aby nie trzeba było przesuwać)
	// - ta zmienna zostanie użyta w widoku aby nie wyświetlać całego bloku itro z tłem 
	$hide_intro = true;

	$infos [] = 'Przekazano parametry.';

	// sprawdzenie, czy potrzebne wartości zostały przekazane
	if ( $form['kwota'] == "") $msgs [] = 'Nie podano kwoty';
	if ( $form['kurs'] == "") $msgs [] = 'Nie podano kursu';
	
	//nie ma sensu walidować dalej gdy brak parametrów
	if ( count($msgs)==0 ) {
		// sprawdzenie, czy $kwota i $kurs są liczbami całkowitymi
		if (! is_numeric( $form['kwota'] )) $msgs [] = 'Kwota nie jest liczbą';
		if (! is_numeric( $form['kurs'] )) $msgs [] = 'Kurs nie jest liczbą';
	}	
	
	if ( count($msgs)==0 ) {
	// sprawdzenie, czy parametry są liczbami dodatnimi
	if ($form['kwota']<=0) $msgs [] = 'Kwota jest liczbą ujemną';
		if ($form['kurs']<=0) $msgs [] = 'Kurs jest liczbą ujemną';
	}	

	if (count($msgs)>0) return false;
	else return true;
}
	
// wykonaj obliczenia
function process(&$form,&$infos,&$msgs,&$result){
	$infos [] = 'Parametry poprawne. Wykonuję obliczenia.';
	
	//konwersja parametrów na float
	$form['kwota'] = floatval($form['kwota']);
	$form['kurs'] = floatval($form['kurs']);
	
	//wykonanie operacji
	if ($form['akcja']=='S'){
		$result=$form['kwota']*$form['kurs'];
	}
	else{
		$result=$form['kwota']/$form['kurs'];
	}
}

//inicjacja zmiennych
$form = null;
$infos = array();
$messages = array();
$result = null;
//domyślnie pokazuj wstęp strony (tytuł i tło)
$hide_intro = false;

getParams($form);
if ( validate($form,$infos,$messages,$hide_intro) ){
	process($form,$infos,$messages,$result);
}

//Wywołanie widoku, wcześniej ustalenie zawartości zmiennych elementów szablonu
$page_title = 'Przykład 03';
$page_description = 'Najprostsze szablonowanie oparte na budowaniu widoku poprzez dołączanie kolejnych części HTML zdefiniowanych w różnych plikach .php';
$page_header = 'Proste szablony';
$page_footer = 'przykładowa tresć stopki wpisana do szablonu z kontrolera';

include 'calc_view.php';