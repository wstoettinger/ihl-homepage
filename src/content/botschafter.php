<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Unsere Botschafter</h1>
    <h4 class="subtitle">Wir danken sehr herzlich unseren Botschaftern, dass sie unser Projekt unterstützen und unsere Idee nach außen tragen.</h4>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-block">
          Die Botschafter für den 6. Ich Helfe Laufend Spendenlauf werden demnächst hier veröffentlicht.
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
