<?php if(!defined('IN_PAGE')) die('Hacking attempt');

global $page;

if (!isset($page->title))
  $page->title = "Ich Helfe Laufend Spendenlauf";
if (!isset($page->ogImageUrl))
  $page->ogImageUrl = "http://www.ichhelfelaufend.at/"; // TODO: put Image here!
if (!isset($page->description))
  $page->description = "Ich Helfe Laufend ist ein Spendenlauf der jedes Jahr stattfindet um benachteiligte Kinder in Österreich zu unterstützen.";

if (!isset($page->canonical))
  $page->canonical = $page->url;

$userAgent = $_SERVER['HTTP_USER_AGENT'];
$clientTouch = false;

if (preg_match('/Android|BlackBerry|iPhone|iPad|iPod|Opera Mini|IEMobile/i', $userAgent)) 
  $clientTouch = true;

$nav_projekt = 
[['name' => 'projekt', 'text' => 'Sozialprojekt', 'link' => '/projekt'], 
['name' => 'spenden', 'text' => 'Spenden', 'link' => '/spenden'], 
['name' => 'helfer', 'text' => 'Mithelfen', 'link' => '/helfer'], 
['name' => 'botschafter', 'text' => 'Botschafter', 'link' => '/botschafter'], 
['name' => 'partner', 'text' => 'Partner&nbsp;und&nbsp;Sponsoren', 'link' => '/partner']];

$nav_ruek = 
[['name' => 'ihl2014', 'text' => 'IHL 2014', 'link' => '/archive/ihl2014'],
['name' => 'ihl2013', 'text' => 'IHL 2013', 'link' => '/archive/ihl2013'],
['name' => 'ihl2012', 'text' => 'IHL 2012', 'link' => '/archive/ihl2012'],
['name' => 'ihl2011', 'text' => 'IHL 2011', 'link' => '/archive/ihl2011']];

$nav_lauf = 
[['name' => 'laufinfo', 'text' => 'Informationen', 'link' => '/lauf'],
['name' => 'anmeldung', 'text' => 'Anmeldung', 'link' => '/anmeldung'],
['name' => 'startnummernabholung', 'text' => 'Startnummernabholung', 'link' => '/lauf#Abholung'],
['name' => 'ergebnisse', 'text' => 'Ergebnisse', 'link' => '/ergebnisse']/*,
['name' => 'rueckblick', 'text' => 'Rückblick', 'link' => '#', 'sub' => $nav_ruek]*/];

$nav = 
[['name' => 'lauf', 'text' => 'Lauf', 'link' => '/lauf', 'sub' => $nav_lauf],
['name' => 'projekt', 'text' => 'Projekt', 'link' => '/projekt', 'sub' => $nav_projekt],
['name' => 'aktuelles', 'text' => 'Aktuelles', 'link' => '/aktuelles'],
['name' => 'fotos', 'text' => 'Fotos', 'link' => '/fotos'],
['name' => 'kontakt', 'text' => 'Kontakt', 'link' => '/kontakt']];

ob_start();

?>
<!DOCTYPE html>
<html lang="de" xml:lang="de">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# ichhelfelaufend: http://ogp.me/ns/fb/ichhelfelaufend#">
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport"    content="width=device-width, initial-scale=0.7, maximum-scale=0.7, user-scalable=no" />
  <meta name="description" content="<?php echo $page->description ?>" />
  <meta name="keywords"    content="Charity, Charity Run, Spendenlauf, Ich Helfe Laufend, Wien" />
  <title><?php echo $page->title ?></title>

  <!-- Facebook open Graph Information -->
  <meta property="fb:app_id"                            content="1786891308202559" /> 
  <meta property="fb:admins"                            content="1363196455" />
  <meta property="og:type"                              content="ichhelfelaufend:run" /> 
  <meta property="og:url"                               content="<?php echo $page->url ?>" />
  <meta property="og:title"                             content="<?php echo $page->title ?>" />
  <meta property="og:description"                       content="<?php echo $page->description ?>" />
  <meta property="og:image"                             content="<?php echo $page->ogImageUrl ?>" />
  <meta property="place:location:latitude"              content="48.225512" /> 
  <meta property="place:location:longitude"             content="16.374933" /> 
  <meta property="og:locale"                            content="de_DE" />

  <link rel="icon" type="image/png" href="/favicon.png" />
  <link rel="icon" href="/favicon.ico" />
  <link rel="canonical" href="<?php echo $page->canonical; ?>" />
  <?php if (isset($page->injectHead)) echo $page->injectHead; ?>
  <style>
    <?php include('css/embed.css'); ?>
  </style>
  <script src="/js/lazysizes.min.js" async=""></script>
</head>
<body>
  <script> /* Google Analytics with mailchimp integration*/
    location.getParameter = function(item){
      var svalue = location.search.match(new RegExp("[\?\&]" + item + "=([^\&]*)(\&?)","i"));
      return svalue ? svalue[1] : svalue;
    };
    var mailchimpId = location.getParameter('mc_eid');
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    if (mailchimpId === null) {ga('create', 'UA-45581382-1', 'auto');} 
    else {ga('create', 'UA-45581382-1', {'userId': mailchimpId});ga('set', 'dimension1', mailchimpId);}
    ga('require', 'displayfeatures'); ga('send', 'pageview');
  </script>
  <script>/* FB Connect APP */
    window.fbAsyncInit = function() {FB.init({appId: '1786891308202559',xfbml: true,version: 'v2.2'});};
    (function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk')); 
  </script>
  <script>/*FB Tracking Pixel*/
    (function() {var _fbq = window._fbq || (window._fbq = []);if (!_fbq.loaded) 
      {var fbds = document.createElement('script');fbds.async = true;fbds.src = '//connect.facebook.net/en_US/fbds.js';
      var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(fbds, s);_fbq.loaded = true;}
    })();window._fbq = window._fbq || [];window._fbq.push(['track', '6034047257020', {'value':'0.00','currency':'EUR'}]);
  </script>
  <noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6034047257020&amp;cd[value]=0.00&amp;cd[currency]=EUR&amp;noscript=1" /></noscript>
  <header>
    <div class="nav-bar">
      <nav class="mynav">
        <div class="logo left"> 
          <a href="/"><?php echo $page->build_picture('/img/logo/Logo-text-runner.png', 'logo', '', 'logo-picture', 'Ich Helfe Laufend Logo', 'Ich Helfe Laufend Homepage'); ?></a>
          <span class="menu-toggle right"><a href="#" alt="Menü"></a></span>
        </div>
        <div class="menu right">
         <?php echo $page->buildNav($nav);?>
       </div>
     </nav>
   </div>
 </header>
 <main <?php if ($page->hideBackground) echo 'class="no-bg"'; ?>>
    <!--[if lt IE 10]>
    <div class="container"><div class="client-warning alert alert-danger">
      <p class="browsehapp">Du verwendest einen <strong>veralteten</strong> Browser. Bitte <a href="http://browsehappy.com/">aktualisiere deinen Browser</a> um eine ideale User Experience zu erfahren.</p>
    </div></div>
    <![endif]-->
    <noscript><div class="container"><div class="client-warning alert alert-danger">
      <p>Du musst JavaScript aktivieren, um die Seite verwenden zu können.</p>
    </div></div></noscript>
    <div class="content">
      <?php if ($page->message) { ?>
      <div class="page-message-box">
        <span class="close-button">✕</span>
        <div class="container">
          <?php echo $page->message; ?>   
        </div>
      </div>
      <?php } ?>
      <?php 
      if (isset($page->content)) 
        echo $page->content;
      ?>
    </div>
    <?php      
    if (isset($page->contactForm)) {
      ?>
      <div class="contact-form-container">
        <div class="arrow_box hidden" id="got-questions">
          <span class="close-button">✕</span>
          <h3>Noch Fragen?</h3>
        </div>
        <div class="contact-form">
          <a class="contact-form-button" href="#contact-form-collapse" data-toggle="collapse" <?php if (isset($_POST["contact-form"]) && !$_POST["success"] == true) echo 'aria-expanded="true"'; else echo 'aria-expanded="false"'; ?> aria-controls="contact-form-collapse"><i class="fa fa-comment-o"></i> Kontakt</a>
          <div class="collapse<?php if (isset($_POST["contact-form"]) && !$_POST["success"] == true) echo ' in';?>" id="contact-form-collapse">
            <?php echo $page->contactForm; ?>
          </div>
        </div>
      </div>
      <?php
    }
    ?>
  </main>
  <footer>
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 col-lg-2 col-lg-offset-1">
            <h4>29. Mai 2016</h4>
            <div class="footer-card">
              <p>Augarten Wien<br/>Kastanien-Hauptallee</p>
              <p>Beginn: 09:30<br/>Start: TBA</p>
            </div>
          </div>
          <div class="col-xs-6 col-lg-3">
            <h4>Links</h4>
            <div class="footer-card">
              <ul class="list-unstyled">
                <li><a href="/faq" title="FAQs">FAQs</a></li>
                <li><a href="/about" title="Über uns">Über uns</a></li>
                <li><a href="/impressum" title="Impressum">Impressum</a></li>
                <li><a href="/datenschutz" title="Datenschutz">Datenschutz</a></li>
                <li><a href="/teilnahmebedingungen" title="Teilnahmebedingungen">Teilnahmebedingungen</a></li>
              </ul>
            </div>
          </div>
          <div class="col-xs-6 col-lg-3">
            <h4>Newsletter</h4>
            <div class="footer-card">
              <!-- Begin MailChimp Signup Form -->
              <div id="mc_embed_signup">
                <form action="//ichhelfelaufend.us3.list-manage.com/subscribe/post?u=8f0f10c06fba1e2f44b85a472&amp;id=91a98df09f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" role="form" target="_blank" >    
                  <div style="position: absolute; left: -5000px;"><input type="text" name="b_8f0f10c06fba1e2f44b85a472_91a98df09f" tabindex="-1" value="" /></div>
                  <input type="hidden" value="JA" name="MMERGE11" class="" id="mce-MMERGE11">
                  <div class="form-group" style="margin-bottom: 5px;">
                    <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email *" required />
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm" onclick="ga('send', 'event', 'button', 'click', 'Subscribe Newsletter');" >Anmelden</button>
                  </div>
                </form>
              </div>
              <!--End mc_embed_signup-->
            </div>
          </div>
          <div class="col-xs-6 col-lg-2">
            <h4>Facebook</h4>
            <div class="footer-card">
              <div class="fb-like" data-href="https://www.facebook.com/IchHelfeLaufend" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
            </div>
          </div>
        </div>
        <span>Built with &nbsp;<i class="fa fa-heart" style="color: #a94442;"></i>&nbsp; by <a href="http://www.wolfography.at" target="_blank"><b>wolfography.at</b></a> © 2015 Ich Helfe Laufend Wohltätigkeitsverein</span>
      </div>
    </div>
  </footer>
  <script src="/js/vendor.min.js"></script>
  <script src="/js/main.js"></script>
  <?php if (isset($page->injectScripts)) echo $page->injectScripts; ?>
</body>
</html>
<!-- below the fold includes -->
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway:300,500,700' />
<?php if (isset($page->injectCSS)) echo $page->injectCSS; ?>
<link rel="stylesheet" href="/css/styles_<?php if ($clientTouch) echo "touch"; else echo "pointer"; ?>.css" />
<?php
$page->html = ob_get_clean();
?>
