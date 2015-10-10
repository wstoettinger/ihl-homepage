<?php

$browserAsString = $_SERVER['HTTP_USER_AGENT'];
$browserIsMobileSafari = false;

if (strstr($browserAsString, ' AppleWebKit/') && strstr($browserAsString, ' Mobile/')) {
  $browserIsMobileSafari = true;
}


class Page { 

  public $title = 'Ich Helfe Laufend Spendenlauf';
  public $pageTitle;
  public $url = '';
  public $ogImageUrl = '';
  public $ogDescription = '';
  public $html = '';
  public $contentFilePath = '/home';
  public $pageToRender = 'content/home.php';

  public $nav_path;

  public $TINY_GIF = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';


  public function __construct($contentFilePath) {
    global $DOC_BASE;

    $this->contentFilePath = $contentFilePath;
    $this->formVars = array();

    $this->url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    if ($contentFilePath == '/')
      $this->pageToRender = 'content/home.php';
    else if (substr($contentFilePath, 0, 6) == '/feed/' || $contentFilePath == '/feed') {
      if(file_exists($_SERVER[DOCUMENT_ROOT] . $DOC_BASE . $contentFilePath . '.json')) {
        define('IN_ARTICLE', true);
        $this->pageToRender = 'feed_article.php';
        $this->feedArticle = substr($this->contentFilePath,1) . '.json';
      }
      else 
        $this->pageToRender = '404.php';
    }
    else if(file_exists($_SERVER[DOCUMENT_ROOT] . $DOC_BASE . '/content' . $contentFilePath . '.php')) 
      $this->pageToRender = 'content' . $contentFilePath . '.php';
    else 
      $this->pageToRender = '404.php';

    $this->nav_path = explode("/",  substr($this->contentFilePath,1));
  }

  public function parseContent() {
    define('IN_PAGE', true);
    include($this->pageToRender);
    include('layout.php');
  }

  public function getOgImageUrl($path) {
    global $DOC_BASE;

    if (file_exists($_SERVER[DOCUMENT_ROOT] . $DOC_BASE . $path))
      return 'http://' . $_SERVER['SERVER_NAME'] . $path;

    $fileEnding = substr($path,strrpos($path, '.'));
    $tempPath = str_replace($fileEnding, '', $path);

    $ret = $tempPath . '-2000w' . $fileEnding;
    if (file_exists($_SERVER[DOCUMENT_ROOT] . $DOC_BASE . $ret))
      return 'http://' . $_SERVER['SERVER_NAME'] . $ret;

    $ret = $tempPath . '-1200w' . $fileEnding;
    if (file_exists($_SERVER[DOCUMENT_ROOT] . $DOC_BASE . $ret))
      return 'http://' . $_SERVER['SERVER_NAME'] . $ret;
  }

  public $FILE_SIZES = [
  'full' => ['640w', '960w', '1080w', '1280w', '1366w', '1600w', '1920w', '2880w'],
  'std'  => ['640w', '960w', '1088w', '1165w', '1440w', '1600w', '1920w', '2330w'],
  'feed' => ['400w', '482w', '600w', '640w', '960w', '1088w', '1600w'],
  'logo' => ['320w', '440w', '640w', '660w']
  ];

  public $DISP_SIZES = [
  'full' => ['xl' => '2000px', 'lg' => '1200px', 'md' => '992px', 'sm' => '768px', 'xs' => '544vw'],
  'std'  => ['xl' => '1165px', 'lg' => '960px',  'md' => '720px', 'xs' => '544px'],
  'feed' => ['xl' => '482px',  'lg' => '400px',  'md' => '300px', 'xs' => '544px'],
  'logo' => ['md' => '320px', 'xs' => '220px']
  ];

  public function build_picture($path, $type = '', $lazybox = 'lazybox-66', $class = '', $alt = '#', $title = '#') {
    global $browserIsMobileSafari;

    if (!in_array($type, array_keys($this->FILE_SIZES)))
      $type = 'std';

    $fileSizes = $this->FILE_SIZES[$type];
    $dispSizes = $this->DISP_SIZES[$type];
    
    $fileEnding = substr($path,strrpos($path, '.'));
    $tempPath = str_replace($fileEnding, '', $path);
    
    // don't use lazybox layouting on mobile safari
    if ($browserIsMobileSafari === true)
      $lazybox = '';
    
    // inline gif as standard src
    $src = $this->TINY_GIF;
    // fallback image as lazyload data-src
    $data_src = $path; 
    // data srcset with all files:

    if (count($fileSizes) == 0) 
      $fileSizes = $this->FILE_SIZES_STD;

    $data_srcset = '';
    foreach($fileSizes as $fileSize) {
      $data_srcset .= $tempPath . '-' . $fileSize . $fileEnding . ' ' . $fileSize . ', ';
    }

    $data_srcset = substr($data_srcset,0, strlen($data_srcset) -2);
    

    $size_arr = array();

    if (isset($dispSizes['xl']))
      $size_arr[] = "(min-width: 75rem) " . $dispSizes['xl'];

    if (isset($dispSizes['lg']))
      $size_arr[] = "(min-width: 62rem) " . $dispSizes['lg'];

    if (isset($dispSizes['md']))
      $size_arr[] = "(min-width: 48rem) " . $dispSizes['md'];

    if (isset($dispSizes['sm']))
      $size_arr[] = "(min-width: 34rem) " . $dispSizes['sm'];

    if (isset($dispSizes['xs']))
      $size_arr[] = $dispSizes['xs'];
    else
      $size_arr[] = "100vw";
    
    // container sizes:
    $size_string = implode (', ', $size_arr);

    return '<div class="' . $lazybox . '"><picture><img alt="' . $alt . '" title="' . $title . '" class="lazyload ' . $class . '" sizes="' . $size_string . '" src="' . $src . '" data-src="' . $data_src .  '" data-srcset="' . $data_srcset . '" /></picture></div>'; 
  }

  public function buildGalery($images, $titles = [], $subtitles = [], $columns = array('xs' => 12, 'md' => 6, 'lg' => 4)) {
    $html = '';
    $itemClass = '';
    foreach($columns as $col => $width) 
      $itemClass .= 'col-' . $col . '-' . $width . ' ';

    
    $html = '<div class="gallery" data-featherlight-gallery data-featherlight-filter="a">';

    foreach ($images as $image) {
      // set title and subtitle for the given image as read from the entry element (if available)
      unset($title);
      unset($subtitle);
      $name = basename($image);
      if ($titles && array_key_exists($name, $titles)) 
        $title = $titles['title'] ;
      if ($subtitles && array_key_exists($name, $subtitles))
        $subtitle = $subtitles['subtitle'];

      $html .= '<div class="' . $itemClass . '" ><a href="' . $image . '" class="feather">' . $this->build_picture($image, 'gallery', 'picturebox lazybox-100', 'gallery-image', $title ?: '#'. $title ?: '#');

      if ($title || $subtitle) {
        $html .= '<div class="title">';
        if ($title)
          $html .= '<h3>' . $title . '</h3>';
        if ($subtitle)
          $html .= '<p>' . $subtitle . '</p>';
        $html .= '</div>';
      }
      $html .= '</div>';
    }

    $html .= '</a></div>';
    return $html;
  }

  public function getFormVar($name) {
    if (isset($_POST['submit']) && isset($_POST[$name]))
      return $_POST[$name]; 
    if (isset($_GET[$name]))
      return $_GET[$name];
    if ($this->formVars[$name])
      return $this->formVars[$name];
  }

  public function readFeedFromDirectories(array $paths = array()) {
    $entries = array();

    // lazily loading parsedown
    if (!isset($this->parsedown)) {
      include_once('lib/Parsedown/Parsedown.php');
      $this->parsedown = new Parsedown();
    }

    foreach ($paths as $path) {

      if ($handle = opendir($path)) {
        while (false !== ($file = readdir($handle))) {
          if ($file!='..' && $file != '.' && substr($file, -5) === '.json') {
            $entry = $this->readFeedFile($path, $file);
            array_push($entries, $entry);
          }
        }
        closedir($handle);
      }
    }
    usort($entries, function($a, $b)
    {
      if ($a->date == $b->date) {
        return 0;
      }
      return ($a->date < $b->date) ? 1 : -1;
    });
    return $entries;
  }

  public function readFeedFile($path, $file = '') {

    if (strlen($file) == 0) {
      $pos = strrpos($path, '/');
      $file = substr($path, $pos + 1);
      $path = substr($path, 0, $pos);
    }

    // lazily loading parsedown
    if (!isset($this->parsedown)) {
      include_once('lib/Parsedown/Parsedown.php');
      $this->parsedown = new Parsedown();
    }

    if (substr($file, -5) === '.json') {
      $content = file_get_contents($path . '/' . $file);
      $entry = json_decode($content);
      $entry->path = $path;
      $entry->name = substr($file, 0, -5);
      $entry->file = $file;
      $entry->id = substr($file, 0, strlen($file)-5);


      if (isset($entry->date)) {
        $entry->date = date_create_from_format('d.m.Y H:i', $entry->date);
      }
      if (isset($entry->title)) {
        $entry->title = $this->parsedown->line($entry->title);
      }
      if (isset($entry->subtitle)) {
        $entry->subtitle = $this->parsedown->line($entry->subtitle);
      }
      if (isset($entry->teaser)) {
        $entry->teaser = $this->parsedown->text($entry->teaser);
      }
      if (isset($entry->content)) {
        $entry->content = $this->parsedown->text($entry->content);
      }
    }
    return $entry;
  }

  public function getFeedTeaserImage($path, $entry) {
    $src = 'img/' . $path . '/' . $entry . '.jpg';
    if (!file_exists($src)) {
      $root = 'img/' . $path . '/' . $entry;
      if (file_exists($root) && $handle = opendir($root)) {
        while (false !==($file = readdir($handle))) {
          if ($file != '.' && $file != '..' && (substr($file, -4) === '.jpg'  || substr($file, -4) === '.png' )) {
            // replace spaces:
            $file = str_replace(' ', '%20', $file);
            $src = $root . '/' . $file;
            break;
          }
        }
      }
    }
    if (file_exists($src))
      return '/' . $src;
  }

  public function getFeedImages($path, $entry) {
    $images = array();

    $root = 'img/' . $path . '/' . $entry;
    if (file_exists($root) && $handle = opendir($root)) {
      while (false !==($file = readdir($handle))) {
        if ($file != '.' && $file != '..' && (substr($file, -4) === '.jpg'  || substr($file, -4) === '.png' )) {
          // replace spaces:
          $file = str_replace(' ', '%20', $file);
          // remove the size definition from the path:
          $image = preg_replace('/-(\d{2,4})w/','', $file);
          $path = '/' . $root . '/' . $image;
          if (!in_array($path, $images))
            $images[] = $path;
        }
      }
    }
    return $images;
  }


  public function buildNav($items = array()) {
    $ret = '<ul>';
    foreach ($items as $item) {
      $ret .= $this->buildEntry($this->nav_path, $item, true);
    }
    $ret .= '</ul>';
    return $ret;
  }

  private function buildEntry($path, $item, $parentActive) {
    $classes = '';

    if ($parentActive && isset($path)) {
      if($path[0] == $item['name'])
        $active = true; 
      else if ($item['name'] == 'home' && (count($path) == 0 || $path[0] == ''))
        $active = true;
    }

    if ($item['sub']) {
      $classes .= 'has-dropdown ';
      if ($active)
        $classes .= 'expanded ';
    }

    if ($active == true)
      $classes .= 'active';

    $ret .= '<li class="' . $classes . '"><a href="' . $item['link'] . '"> ' . $item['text'] . '</a>';
    if ($item['sub']) {
      $ret .= '<a href="#" class="dropdown-toggle ' . ($active ? 'expanded' : '' ) . '">';
      $ret .= '<ul class="dropdown ' . ($active ? 'expanded' : '' ) . '">';
      foreach ($item['sub'] as $sub) {
        if (isset($path) && count($path) > 1)
          $subPath = array_slice($path, 1);
        $ret .= buildEntry($subPath, $sub, $active);
      }
      $ret .= "</ul>";
    }
    $ret .= '</li>';
    return $ret;
  }
}
?>