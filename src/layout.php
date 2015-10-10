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

$nav = [
['name' => 'home', 'text' => 'Home', 'link' => '/'],
['name' => 'aktuelles', 'text' => 'Aktuelles', 'link' => '/aktuelles']
];

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
    body{display:none; }
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
 <main>
    <!--[if lt IE 10]>
    <div class="container"><div class="client-warning alert alert-danger">
      <p class="browsehapp">Du verwendest einen <strong>veralteten</strong> Browser. Bitte <a href="http://browsehappy.com/">aktualisiere deinen Browser</a> um eine ideale User Experience zu erfahren.</p>
    </div></div>
    <![endif]-->
    <noscript><div class="container"><div class="client-warning alert alert-danger">
      <p>Du musst JavaScript aktivieren, um die Seite verwenden zu können.</p>
    </div></div></noscript>
    <div class="content">
      <?php 
      if (isset($page->content)) 
        echo $page->content;
      ?>
    </div>
    <?php      
    if (isset($page->contactForm)) {
      ?>
      <div class="contact-form-container">
        <div class="arrow_box hidden" id ="got-questions">
          <h3>Noch Fragen?</h3>
        </div>
        <div class="contact-form">
          <a class="contact-form-button" href="#contact-form-collapse" data-toggle="collapse" aria-expanded="false" aria-controls="contact-form-collapse"><i class="fa fa-comment-o"></i> Kontakt</a>
          <div class="collapse" id="contact-form-collapse">
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
          <div class="col-xs-12 col-lg-10 col-lg-offset-1">
            <div class="row">
              <div class="col-xs-6 col-md-3">
                <h4>17. Mai 2015</h4>
                <div class="footer-card">
                  <p>Augarten Wien<br/>Kastanien-Hauptallee</p>
                  <p>Beginn: 09:30<br/>Start: 11:00</p>
                </div>
              </div>
              <div class="col-xs-6 col-md-3">
                <h4>Informationen</h4>
                <div class="footer-card">
                  <ul class="list-unstyled">
                    <li><a href="/about">Über uns</a></li>
                    <li><a href="/project">Sozialprojekt</a></li>
                    <li><a href="/botschafter">Botschafter</a></li>
                    <li><a href="/spenden">Spenden</a></li>
                    <li><a href="/sponsors">Sponsoren</a></li>
                    <li><a href="/contact">Kontakt</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xs-6 col-md-3 col-lg-4 col-xl-3">
                <h4>Newsletter</h4>
                <div class="footer-card">
                  <p>Die wichtigsten Infos gibts in unserem Newsletter!</p>
                  <!-- Begin MailChimp Signup Form -->
                  <div id="mc_embed_signup">
                    <form action="//ichhelfelaufend.us3.list-manage.com/subscribe/post?u=8f0f10c06fba1e2f44b85a472&amp;id=91a98df09f" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" role="form" target="_blank" >    
                      <div style="position: absolute; left: -5000px;"><input type="text" name="b_8f0f10c06fba1e2f44b85a472_91a98df09f" tabindex="-1" value="" /></div>
                      <input type="hidden" value="JA" name="MMERGE11" class="" id="mce-MMERGE11">

                      <div class="form-group" style="margin-bottom: 5px;">
                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email *" style="width: 100%;" required /><br/>
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-sm" onclick="ga('send', 'event', 'button', 'click', 'Subscribe Newsletter');" >Anmelden</button>
                      </div>
                    </form>
                  </div>
                  <!--End mc_embed_signup-->
                </div>
              </div>
              <div class="col-xs-6 col-md-3 col-lg-2 col-xl-3">
                <h4>Rückblick</h4>
                <div class="footer-card">
                  <ul class="list-unstyled">
                    <li><a href="/rueckblick/ihl2014">IHL 2014</a></li>
                    <li><a href="/rueckblick/ihl2013">IHL 2013</a></li>
                    <li><a href="/rueckblick/ihl2012">IHL 2012</a></li>
                    <li><a href="/rueckblick/ihl2011">IHL 2011</a></li>
                  </ul>
                </div>
                <div class="fb-like" data-href="https://www.facebook.com/IchHelfeLaufend" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-6 col-md-4">
            <small>Built with &nbsp;<i class="fa fa-heart" style="color: #a94442;"></i>&nbsp; by <a href="http://www.wolfography.at" target="_blank"><b>wolfography.at</b></a><br/>
              © 2015 Ich Helfe Laufend Wohltätigkeitsverein</small>
            </div>
            <div class="col-xs-6 col-md-8">
              <span class="right"><a href="/kontakt">Kontakt</a> &nbsp;|&nbsp; <a href="/impressum">Impressum</a> &nbsp;|&nbsp; <a href="/agb">AGB &amp; Datenschutz</a> &nbsp;|&nbsp; <a href="/teilnahmebedingungen">Teilnahmebedingungen</a></span>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.4.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/bootstrap/3.3.1/bootstrap.min.js"></script>
    <script src="/js/jquery.detect_swipe.js"></script>
    <script src="/js/jquery.easing.1.3.js"></script>
    <script src="/js/owl.carousel.js"></script>
    <script src="/js/parallax.min.js"></script>
    <script src="/js/featherlight.min.js"></script>
    <script src="/js/featherlight.gallery.min.js"></script>
    <script src="/js/main.js"></script>
    <?php if (isset($page->injectScripts)) echo $page->injectScripts; ?>
  </body>
  </html>
  <!-- below the fold includes -->
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway:300,500,700' />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
  <link rel="stylesheet" href="/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/css/featherlight.css" />
  <link rel="stylesheet" href="/css/featherlight.gallery.css" />
  <link rel="stylesheet" href="/css/owl.carousel.css" />
  <?php if (isset($page->injectCSS)) echo $page->injectCSS; ?>
  <link rel="stylesheet" href="/css/style.css" />
  <?php
  $page->html = ob_get_clean();
  ?>
