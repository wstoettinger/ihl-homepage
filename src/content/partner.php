<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Unsere Partner und Sponsoren</h1>
    <h4 class="subtitle">Wir danken sehr herzlich unseren Partnern und Sponsoren, dass sie unser Projekt so großzügig unterstützen. Ohne diese Unterstützung wäre unsere Veranstaltung nicht möglich!</h4>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-block">
          Die Partner und Sponsoren für den 6. Ich Helfe Laufend Spendenlauf werden demnächst hier veröffentlicht.
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
