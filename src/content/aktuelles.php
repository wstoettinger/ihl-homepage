<?php if(!defined('IN_INDEX')) die('Hacking attempt');

global $page;

$page->title = "Aktuelles | Ich Helfe Laufend Spendenlauf"; 

define('IN_FEED', true);
$page->feed = 'feed/news';
include('feed.php');

ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <h1>Aktuelles</h1>
    <p>Hier findest du aktuelle Informationen rund um den Spendenlauf.</p>
  </div>
</div>
<?php
$page->content = ob_get_clean() . $page->feed;
?>