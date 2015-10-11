<?php if(!defined('IN_FEED')) die('Hacking attempt');

global $page;

$entries = $page->readFeedFromDirectories(array($page->feed));

ob_start(); 
?>
<div class="container newsfeed">
  <div class="row"> 
    <?php
    if (!isset($entries) || count($entries) == 0) {
      ?>
      <div class="card article">
        <div class="content">
          <p>Keine Einträge vorhanden.</p>
        </div>
      </div>
      <?php
    }
    else {
      foreach ($entries as $entry) {

        // only show articles after their designated datetime
        if (new DateTime() > $entry->date) {

          $image = false;
          $infos = array();
          if (isset($entry->date)) array_push($infos,$entry->date->format('d. F Y')); 
          if (isset($entry->location)) array_push($infos, $entry->location->name); 
          if (isset($entry->tags)) array_push($infos, implode(', ', $entry->tags)); 

          if(!isset($entry->image)) {
            $entry->image = $page->getFeedTeaserImage($entry->path, $entry->name);
          }

          if(isset($entry->image) && strlen($entry->image) > 0)
            $image = true;
          ?>
          <div class="card article">
            <?php if ($image) { ?>
            <div class="image col-xs-12 col-md-5">
              <a href="<?php echo "/{$page->feed}/{$entry->id}";?>"><?php echo $page->build_picture($entry->image, 'feed'); ?></a>
            </div>
            <?php } ?>
            <div class="content col-xs-12 <?php if ($image) echo 'col-md-7'; ?>">
              <?php
              echo '<h3 class="title"><a href="/' . $page->feed . '/' . $entry->id . '" >' . $entry->title . '</a></h3>';
              if (count($infos) > 0 )
                echo '<p class="info">' . implode(" &nbsp;|&nbsp; ", $infos) . '</p>';
              if (isset($entry->subtitle))
                echo '<h4 class="subtitle">' . $entry->subtitle . '</a></h4>';


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
      }
    }
    ?>
  </div>
</div>
<?php
$page->feed = ob_get_clean();

?>