<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Der Ich Helfe Laufend Spendenlauf</h1>
    <h3 class="subtitle">Wir unterstützen die Kleinsten unter uns die dringend Hilfe brauchen! Seit dem ersten Spendenlauf 2011 spenden wir unseren Reinerlös an hilfsbedürftige Kinder und Jugendliche in Östereich.</h3>
  </div>
</div>
<!--div class="parallax-window">
  <div class="parallax-slider owl-carousel">
    <img src="/img/bg-layers/DSC_9364-2000w.jpg" >
    <img src="/img/bg-layers/DSC_8896-HDR-2000w.jpg" >
  </div>
</div -->
<div class="container">
  <div class="card">
<div class="card-block">
      <h2 class="card-title" style="font-size: 2.2rem;">Save The Date!</h2>
      <h3 style="font-weight: 300;">Am <strong>29. Mai 2016</strong> ist es wieder soweit!</h3>
      <p>Der Ich Helfe Laufend Spendenlauf geht im Augarten in seine nächste Runde. Merkt euch jetzt schon das Datum vor! Wir haben einige Neuerungen für euch, die wir in Kürze hier Online stellen werden.</p>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();
?>
