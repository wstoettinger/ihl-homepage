<?php if(!defined('IN_FEED')) die('Hacking attempt');

global $page;

$entries = $page->readFeedFromDirectories(array($page->feed));

ob_start(); 
?>
<div class="container newsfeed">
  <div class="row"> 
    <?php
    foreach ($entries as $entry) {
      if(isset($entry->image) && strlen($entry->image) > 0)
        $image = true;
      ?>
      <div class="card article">
        <?php if (image) { ?>
        <div class="image col-xs-12 col-md-6 col-lg-4">
          <a href="<?php echo "/{$page->feed}/{$entry->id}";?>"><?php echo $page->build_picture($entry->image,"feed"); ?></a>
        </div>
        <?php } ?>
        <div class="content <?php if (image) echo 'col-xs-12 col-md-6 col-lg-8'; ?>">
          <h3 class="title"><a href="<?php echo "/{$page->feed}/{$entry->id}";?>" class="nostyle"><?php echo $entry->title; ?></a></h3>
          <p class="date">
            <?php 
            $infos = array();
            if (isset($entry->date)) array_push($infos,$entry->date->format('d. F Y')); 
            if (isset($entry->location)) array_push($infos, $entry->location->name); 
            if (isset($entry->tags)) array_push($infos,implode(', ', $entry->tags)); 
            echo implode(" &nbsp;|&nbsp; ", $infos);
            ?>
          </p>
          <?php 
          $more = false;
          if (isset($entry->teaser) && strlen($entry->teaser) > 0) {
            echo $entry->teaser;
            $more = true;
          }
          else
            echo $entry->content;

          if (isset($entry->slider))
            $more = true;
          
          if ($more === true)
            echo "<p class=\"read-on\"><a href=\"/{$page->feed}/{$entry->id}\">weiterlesen</a></p>";
          ?>
        </div>
      </div>
      <?php
    }
    ?>
  </div>
</div>
<?php
$page->feed = ob_get_clean();

?>