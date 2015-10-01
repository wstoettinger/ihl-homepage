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
  public $pageFilePath = 'home';
  public $pageToRender = 'home.php';

  public $TINY_GIF = 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';


  public function __construct($pageFilePath) {
    global $ROOT_PATH;

    $this->pageFilePath = $pageFilePath;
    $this->formVars = array();

    $this->url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
    if (strlen($pageFilePath) == 0)
      $this->pageToRender = 'content/home.php';
    else if (substr($pageFilePath, 0, 5) == 'feed/' || $pageFilePath == 'feed') {
      if(file_exists($_SERVER[DOCUMENT_ROOT] . $ROOT_PATH . '/' . $pageFilePath . '.json')) {
        define('IN_ARTICLE', true);
        $this->pageToRender = 'feed_article.php';
        $this->feedArticle = $pageFilePath . '.json';
      }
      else 
        $this->pageToRender = '404.php';
    }
    else if(file_exists($_SERVER[DOCUMENT_ROOT] . $ROOT_PATH . '/content/' . $pageFilePath . '.php')) 
      $this->pageToRender = 'content/' . $pageFilePath . '.php';
    else 
      $this->pageToRender = '404.php';
  }

  public function parseContent() {
    define('IN_PAGE', true);
    include($this->pageToRender);
    include('layout.php');
  }

  public function getOgImageUrl($path) {
    global $ROOT_PATH;

    if (file_exists($_SERVER[DOCUMENT_ROOT] . $ROOT_PATH . $path))
      return 'http://' . $_SERVER['SERVER_NAME'] . $path;

    $fileEnding = substr($path,strrpos($path, '.'));
    $tempPath = str_replace($fileEnding, '', $path);

    $ret = $tempPath . '-2000w' . $fileEnding;
    if (file_exists($_SERVER[DOCUMENT_ROOT] . $ROOT_PATH . $ret))
      return 'http://' . $_SERVER['SERVER_NAME'] . $ret;

    $ret = $tempPath . '-1200w' . $fileEnding;
    if (file_exists($_SERVER[DOCUMENT_ROOT] . $ROOT_PATH . $ret))
      return 'http://' . $_SERVER['SERVER_NAME'] . $ret;
  }

  public function build_picture($path, $sizes, $alt = '#', $class = '') {
    global $browserIsMobileSafari;
    
    $fileEnding = substr($path,strrpos($path, '.'));
    $tempPath = str_replace($fileEnding, '', $path);
    $lazybox = 'lazybox';
    // don't use lazybox layouting on mobile safari
    if ($browserIsMobileSafari === true)
      $lazybox = '';
    
    $src = $this->TINY_GIF;
    $data_src = $tempPath . '-1200w' . $fileEnding;
    $data_srcset = $tempPath . '-200w' . $fileEnding . ' 200w, ' .
    $tempPath . '-400w' . $fileEnding . ' 400w, ' . 
    $tempPath . '-800w' . $fileEnding . ' 800w, ' . 
    $tempPath . '-1200w' . $fileEnding . ' 1200w, ' . 
    $tempPath . '-1600w' . $fileEnding . ' 1600w, ' . 
    $tempPath . '-2000w' . $fileEnding . ' 2000w, ' . 
    $tempPath . '-2400w' . $fileEnding . ' 2400w, ' . 
    $tempPath . '-2800w' . $fileEnding . ' 2800w';

    $size_arr = array();

    if (isset($sizes['xl']))
      $size_arr[] = "(min-width: 75rem) " . $sizes['xl'];

    if (isset($sizes['lg']))
      $size_arr[] = "(min-width: 62rem) " . $sizes['lg'];

    if (isset($sizes['md']))
      $size_arr[] = "(min-width: 48rem) " . $sizes['md'];

    if (isset($sizes['sm']))
      $size_arr[] = "(min-width: 34rem) " . $sizes['sm'];

    if (isset($sizes['xs']))
      $size_arr[] = $sizes['xs'];
    else
      $size_arr[] = "100vw";
    
    // container sizes:
    $size_string = implode (', ', $size_arr);

    if(strlen($alt) > 0)
      $alt = 'alt="' . $alt . '"';

    return '<div class="' . $lazybox . '"><picture><img ' . $alt . ' class="lazyload ' . $class . '" sizes="' . $size_string . '" src="' . $src . '" data-src="' . $data_src .  '" data-srcset="' . $data_srcset . '" /></picture></div>'; 
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
      $entry->file = $file;
      $entry->id = substr($file, 0, strlen($file)-5);

      if (isset($entry->date)) {
        $entry->date = date_create_from_format('d.m.Y', $entry->date);
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


  public function buildNav($path = array(), $items = array()) {
    $ret = '<ul>';
    foreach ($items as $item) {
      $ret .= buildEntry($path, $item, true);
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