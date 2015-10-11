<?php if(!defined('IN_INDEX')) die('Hacking attempt');
global $page;

$page->title = "Der Ich Helfe Laufend Spendenlauf"; 

ob_start(); 
?>
<div class="jumbotron no-margin">
  <div class="container">
    <h1 class="title">Helfer</h1>
    <h3 class="subtitle">Wir suchen jedes Jahr an die 50 freiwilligen Helfer für unseren Spendenlauf. Bist du interessiert uns zu unterstützen?</h3>
  </div>
</div>
<iframe src="https://docs.google.com/forms/d/1WWdndUOhbZfhWfx4w3187plYS1MqWJlFYhvSIxzTnq8/viewform?embedded=true" width="760" height="1800" frameborder="0" marginheight="0" marginwidth="0">Loading...</iframe>
<?php
$page->content = ob_get_clean();
$page->hideBackground = true;
?>
