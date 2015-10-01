<?php if(!defined('IN_ARTICLE')) die('Hacking attempt');

global $page;

$entry = $page->readFeedFile($page->feedArticle);

$page->pageTitle = $entry->title; 
$page->title = $page->pageTitle . " - Wolfography"; 

if (isset($entry->image))
  $page->ogImageUrl = $page->getOgImageUrl($entry->image);

if (isset($entry->teaser))
  $page->description = strip_tags($entry->teaser);
else if (isset($entry->content))
  $page->description = strip_tags($entry->content);

ob_start(); 
?>
<div class="container">
  <div class="row">
    <?php
    if(isset($entry->image) && strlen($entry->image) > 0)
      $image = true;
    ?>
    <div class="card article">
      <div class="content">
        <p class="date">
          <?php 
          $infos = array();
          if (isset($entry->date)) array_push($infos,$entry->date->format('d. F Y')); 
          if (isset($entry->location)) array_push($infos, $entry->location->name); 
          if (isset($entry->tags)) array_push($infos,implode(', ', $entry->tags)); 
          echo implode(" &nbsp;|&nbsp; ", $infos);
          ?>
        </p>
        <?php echo $entry->content; ?>
      </div>
    </div>
    <?php if (isset($entry->slider)) { 
      $slides = array();
      foreach ($entry->slider as $f) {
        $slide = array();
        $slide["file"] = $f->file;
        $slide["title"] = $f->title;
        array_push($slides, $slide);
      }
      if (count($slides) > 0) {
        ?>
        <div class="card article">
          <?php 
          echo $page->build_syncslider('slider-eins', $slides);
          ?>
        </div>
        <?php 
      }
    } ?>
  </div>
</div>
<?php
$page->content = ob_get_clean();
?>