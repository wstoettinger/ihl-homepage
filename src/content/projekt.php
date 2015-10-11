<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Spendenprojekt</h1>
    <h3 class="subtitle">Wir freuen uns, auch dieses Jahr wieder das mobile Kinderhospiz MOMO unterstützen zu können!</h3>
  </div>
</div>
<div class="container article">
  <div class="row">
    <div class="col-xs-12 col-md-5">
      <div class="card image">
        <a href="http://www.kinderhospizmomo.at/" onclick="ga('send', 'event', 'link', 'click', 'Kinderhospiz');" target="_blank" title="mobiles Kinderhospiz MOMO">
          <?php echo $page->build_picture('/img/feed/news/Momo_hausbesuch.jpg', 'feed'); ?>
        </a>
      </div>
    </div>
    <div class="col-xs-12 col-md-7">
      <div class="card content">
        <h2 class="card-title">Informationen zum mobilen Kinderhospiz MOMO</h2>
        <p>Auch dieses Jahr unterstützen wir mit unserer Spende wieder das <strong>mobile Kinderhospiz MOMO</strong>. </p>
        <p>Momo setzt sich für Familien mit schwerstkranken Kindern und Jugendlichen ein und hilft, dass Kinder möglichst viel wertvolle Zeit zu Hause sein können. MOMO ist für Familien mit Kindern von 0 bis 18 Jahren mit lebensbedrohlichen und lebensverkürzenden Erkrankungen da. Dabei wird die notwendige Unterstützung organisiert, die betroffene Eltern brauchen: medizinische und pflegerische Betreuung, psychische und soziale Beratung, Hilfe für Angehörige und Geschwisterkinder.</p>
        <p>In Wien und im Umland gibt es rund 800 Kinder, die an unheilbaren Krankheiten leiden. Es ist traurige Realität, dass etwa 120 Mädchen und Buben jährlich in Wien sterben. Damit auch schwerstkranke Kinder und Jugendliche in der Geborgenheit ihrer Familien Zeit zu Hause verbringen können, organisiert MOMO die notwendige Unterstützung.</p>
        <p>MOMO wurde auf Initiative von Caritas, Caritas Socialis und MOKI-Wien Mobile Kinderkrankenpflege gegründet und arbeitet eng mit Kinderspitälern, Kinderabteilungen und niedergelassenen ÄrztInnen zusammen.</p>
        <p>Mehr Informationen findet Ihr auf der <a href="http://www.kinderhospizmomo.at/" onclick="ga('send', 'event', 'link', 'click', 'Kinderhospiz');" target="_blank">offiziellen Homepage</a>.</p>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
