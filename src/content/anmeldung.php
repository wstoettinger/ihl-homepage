<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Anmeldung</h1>
    <h3 class="subtitle">Melde dich jetzt online an zum 6. Ich Helfe Laufend Spendenlauf 2016!</h3>
    <a href="https://www.eventbrite.de/e/6-ich-helfe-laufend-spendenlauf-2016-tickets-16927032209" target="_blank" class="btn btn-primary" onclick="fbq('track', 'Lead');">Jetzt Anmelden! »</a>
    powered by <img class="img-inline" src="/img/misc/eventbrite-135w.png">
  </div>
</div>
<div class="container">
  <div class="card">
    <div class="card-block">
      <h2 class="card-title">Informationen zur Anmeldung</h2>
      <p>Die Anmeldung zum <strong>6. Ich Helfe Laufend Spendenlauf</strong> wird über <strong>Eventbrite</strong> abgewickelt. Mit der Anmeldung akzeptierst du unsere <a href="/teilnahmebedingungen" target="_blank"><b>Teilnahme&shy;bedingungen</b></a>.</p>
      <p>Die <strong>Anmeldegebühren</strong> sind folgendermaßen gestaffelt:</p>
      <div class="row">
        <div class="col-xs-12 col-lg-5">
          <dl class="table">
            <dt>Anmeldung bis 31.01.2015</dt>
            <dd>15 €</dd>
            <dt>Anmeldung bis 31.03.2015</dt>
            <dd>17 €</dd>
            <dt>Anmeldung bis 22.05.2015</dt>
            <dd>20 €</dd>
            <dt>Nachmeldung bis 25.05.2015</dt>
            <dd>25 €</dd>
          </dl>
        </div>
        <div class="col-xs-12 col-lg-7">
          <p>Unser Ziel ist es dieses Jahr 100% der Anmelde&shy;gebühren an unser <strong>Sozialprojekt, das mobile Kinderhospiz MOMO</strong> zu spenden. Wir und Momo sind dir dennoch für jeden zusätzlichen Euro dankbar, den du bei der Anmeldung spendest!</p>
        </div>
      </div>
      <a href="https://www.eventbrite.de/e/6-ich-helfe-laufend-spendenlauf-2016-tickets-16927032209" target="_blank" class="btn btn-primary" onclick="fbq('track', 'Lead');">Jetzt Anmelden! »</a>
    </div>

  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
