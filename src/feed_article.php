<?php if(!defined('IN_ARTICLE')) die('Hacking attempt');

global $page;

$entry = $page->readFeedFile($page->feedArticle);

$page->title = $entry->title . " - Ich Helfe Laufend Spendenlauf"; 
$page->entry = $entry;

if (isset($entry->image))
  $page->ogImageUrl = $page->getOgImageUrl($entry->image);
if (isset($entry->teaser))
  $page->description = strip_tags($entry->teaser);
else if (isset($entry->content))
  $page->description = strip_tags($entry->content);

$infos = array();
if (isset($entry->date)) array_push($infos,$entry->date->format('d. F Y')); 
if (isset($entry->location)) array_push($infos, $entry->location->name); 
if (isset($entry->tags)) array_push($infos,implode(', ', $entry->tags)); 

$images = $page->getFeedImages($entry->path, $entry->name);


ob_start(); 
?>
<div class="jumbotron">
  <div class="container">
    <?php 
    echo '<h1 class="title">' . $entry->title . '</h1>';
    if (isset($entry->subtitle))
      echo '<h3 class="subtitle">' . $entry->subtitle . '</h3>';
    ?>
  </div>
</div>
<div class="container">
  <div class="row">
    <?php
    if(isset($entry->image) && strlen($entry->image) > 0)
      $image = true;
    ?>
    <div class="card article">
      <div class="content">
        <?php echo $entry->content; 
        if (count($infos) > 0 )
          echo '<p class="info-bottom">' . implode(" &nbsp;|&nbsp; ", $infos) . '</p>';
        ?>
        <?php echo $page->buildGalery($images, $entry->imageTitles, $entry->imageSubtitles); ?>
      </div>
    </div>
  </div>
</div>
<?php
$page->content = ob_get_clean();
?>