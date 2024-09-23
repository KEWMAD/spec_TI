<?php
  require_once dirname(__FILE__).'/../config.php';

  $kwota= isset($_REQUEST["kwota"]) ? $_REQUEST["kwota"] : '';
  $waluta=isset($_REQUEST["waluta"])? $_REQUEST["waluta"]: '';

  if ( ! (isset($kwota) && isset($waluta))) {
    $messages [] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
  }
  if ( $kwota == "") {
    $messages [] = 'Nie podano kwoty';
  }
  if ( $waluta == "") {
    $messages [] = 'Nie podano waluty';
  }
  if (empty( $messages )) {
    if (! is_numeric( $kwota )) {
      $messages [] = 'Pierwsza wartość nie jest liczbą całkowitą';
    } else{
      $result=$kwota*$waluta;
    }
  }
  include "calc_view.php";
?>