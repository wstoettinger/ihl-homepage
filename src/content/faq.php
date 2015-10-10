<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

$faq = [
'basics' => [
[
'question' => 'Wann und wo findet der Lauf statt?',
'answer' => 'Der 6. Ich Helfe Laufend Spendenlauf findet am 29. Mai 2016 im Augarten in Wien statt.'
],[
'question' => 'Welches Spendenprojekt wird 2016 unterstützt?',
'answer' => 'Das mobile Kinderhopsiz MOMO wird auch 2016 wieder mit unserem gesamten Reinerlös unterstützt.'
]
],
'run' => [[
'question' => 'Kann ich bei beiden Wertungen teilnehmen?',
'answer' => 'Ja, du kannst dich für beide Wertungen (30min und 60min) anmelden, musst dafür aber zwei Tickets kaufen.'
]]
];

$build_faq = function ($section) use ($faq) {
  $s = $faq[$section];
  $i = 0;
  foreach ($s as $e) {
    $id = 'a-' . $section . '-' . $i;
    echo '<h4><a class="nostyle" href="#' . $id . '" data-toggle="collapse" aria-expanded="false" aria-controls="' . $id . '">' . $e['question'] . '</a></h4>' .
    '<p class="collapse" id="' . $id . '">' .  $e['answer'] . '</p>';
    $i++;
  }
};

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">FAQ zum Ich Helfe Laufend Spendenlauf</h1>
    <h3 class="subtitle">Hier findest du die wichtigsten Informationen im Frage &amp; Antwort Stil.</h3>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-6">
      <div class="card">
        <div class="card-block">
          <h2 class="card-title">Grundlegende Informationen</h2>
          <?php $build_faq('basics'); ?>
        </div>
      </div>
      <div class="card">
        <div class="card-block">
          <h2 class="card-title">Bewerbe &amp; Wertungen</h2>
          <?php $build_faq('run'); ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="jumbotron">
  <div class="container">
    <h2 class="title">Melde dich jetzt an</h2>
    <h3 class="subtitle">und unterstütze mit deiner sportlichen Leistung das mobile Kinderhospiz MOMO.</h3>
    <a href="/anmeldung" class="btn btn-primary" onclick="fbq('track', 'Lead');">Jetzt Anmelden! »</a>
  </div>
</div>
<?php
$page->content = ob_get_clean();
?>
