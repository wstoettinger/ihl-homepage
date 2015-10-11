<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Spenden</h1>
    <h3 class="subtitle">This is just a placeholder page</h3>
  </div>
</div>
<div class="container article">
  <div class="row">
    <div class="col-xs-12">
      <div class="card content">
        <h2 class="card-title">Informationen zum Spenden</h2>
        <p>Nur durch viele kleine und größere Spenden wird es uns ermöglicht ein Laufevent für das mobile Kinderhospiz MOMO auf die Beine zu stellen. Wir würden uns sehr freuen wenn auch du einen kleinen Beitrag dazu leisten möchtest! Jeder Euro hilft uns! Ist das Event erst einmal finanziert wird natürlich jeder weitere Euro an das <a href="http://www.kinderhospizmomo.at/" onclick="ga('send', 'event', 'link', 'click', 'Kinderhospiz');" target="_blank"><b>mobile Kinderhospiz MOMO</b></a> übergeben! </p>
        <p>Spenden für Ich Helfe Laufend 2015 bitte auf folgendes Konto:
          <pre>
            Empfänger: Ich Helfe Laufend
            IBAN: AT242011129441764100
            BIC:  GIBAATWWXXX
            Verwendungszweck: Spende [Dein Name]
          </pre>
          Wenn du nicht namentlich auf der Homepage genannt werden willst, lass einfach deinen Namen beim Verwendungszweck weg. Oder schreib uns eine kurze E-Mail an <?php include("modules/email.php") ?>.
        </p>
        <p><strong>Vielen Dank für eure Unterstützung!</strong><br/>
          2015 danken wir unter anderem:<br/>
          <ul>
            <li>Mag. Markus Stender</li>
            <li>Sonja Lacher</li>
            <li>Dr. Hannes Pichler</li>
            <li>Roland Prinz</li>
            <li>Alexander Zwickl</li>
            <li>Rotary Club Wien-Stephans</li>
            <li>Rotary Club Wien-Marc Aurel</li>
            <li>Sabtours Touristik GmbH</li>
            <li>Göhringer Beton Boden Bau GmbH</li>
          </ul>
          2014 danken wir unter anderem:<br/>
          <ul>
            <li>Christine Ulrich</li>
            <li>Gregor Ulrich</li>
            <li>dem Rotary Club Innsbruck</li>
            <li>dem Rotary Club Innsbruck-Alpin</li>
            <li>dem Rotaract Club Wien-Oper</li>
            <li>dem Rotary Club Vienna-International</li>
          </ul>
        </p>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

?>
