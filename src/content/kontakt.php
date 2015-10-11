<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

include('modules/contact_form.php');

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1 class="title">Hast du Fragen?</h1>
    <h3 class="subtitle">Bitte lies erst unsere <a href="/faq"><strong>FAQs</strong></a>, solltest du dann noch Fragen haben, beantworten wir sie dir gerne!</h3>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <div class="card">
        <div class="card-block">
          <h2 class="card-title">Kontaktformular</h2>
          <?php echo $page->contactForm; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();

unset ($page->contactForm);


?>
