<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Placeholder</h1>
    <h3 class="subtitle">This is just a placeholder page</h3>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-block">
          <h2 class="card-title">Offenlegung gemäß § 25 Mediengesetz:</h2>
          <h4>Medieninhaber und Herausgeber:</strong></h4>
          <p>Ich Helfe Laufend (Wohltätigkeitsverein)<br/>
            1090 Wien<br/>
            ZVR: 172085127<br/>
            <?php include("modules/email.php") ?>
          </p>
          <p><strong>Präsident:</strong> Wolfgang Stöttinger</p>
          <p><strong>Vizepräsident:</strong> Alexander Kager</p>
          <p><strong>Schatzmeisterin:</strong> Valerie Uhlig</p>
          <p><strong>Webmaster:</strong> Wolfgang Stöttinger</p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
