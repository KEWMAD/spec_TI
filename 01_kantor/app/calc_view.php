<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
  <meta charset="utf-8" />
  <title>Kantor</title>
</head>
<body>
  <h1>Kantor</h1>
  <form action="<?php print(_APP_URL);?>/01_kantor/app/calc.php">
    <label for="kwota">Podaj kwote: </label><input type="number" name="kwota" value="<?php echo isset($kwota) ? $kwota : 0 ;?>" /><br>
    <input type="radio" name="waluta" value="4.27" />EURO => PLN <br />
    <input type="radio" name="waluta" value="0.23" />PLN => EURO <br />
    <input type="submit" value="Przelicz" />
  </form>
  <?php
  if (isset($messages)) {
    if (count ( $messages ) > 0) {
      echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
      foreach ( $messages as $msg ) {
        echo '<li>'.$msg.'</li>';
      }
      echo '</ol>';
    }
  }
  ?>
  <?php if (isset($result)){ ?>
  <div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
  <?php echo 'Wynik: '.$result; ?>
  </div>
  <?php } ?>
</body>
</html>