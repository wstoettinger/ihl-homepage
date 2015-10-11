<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Fotos</h1>
    <h3 class="subtitle">Nach dem Lauf werden wir hier die Fotos von der Veranstaltung veröffentlichen.</h3>
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="card-block">
      <h2 class="card-title">Fotos vom letzten Spendenlauf</h2>
      <div id="photos">
        <iframe src="http://embedsocial.com/facebook_album/album_photos/1066532403376545" width="100%" height="1450" frameborder="0" scrolling="no" marginheight="0"  marginwidth="0"></iframe>
      </div>
      <div id="photos">
        <iframe src="http://embedsocial.com/facebook_album/album_photos/1069811013048684" width="100%" height="1450" frameborder="0" scrolling="no" marginheight="0"  marginwidth="0"></iframe>
      </div>
      <div id="photos">
        <iframe src="http://embedsocial.com/facebook_album/album_photos/1069851163044669" width="100%" height="1450" frameborder="0" scrolling="no" marginheight="0"  marginwidth="0"></iframe>
      </div>
      <div id="photos">
        <iframe src="http://embedsocial.com/facebook_album/album_photos/1067626976600421" width="100%" height="1450" frameborder="0" scrolling="no" marginheight="0"  marginwidth="0"></iframe>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
