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
          <h2 class="card-title">Nothing to see here</h2>
          bla bla bla
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
