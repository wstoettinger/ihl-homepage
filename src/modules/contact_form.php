<?php if(!defined('IN_INDEX')) die('Hacking attempt');

global $page;
global $ROOT_PATH;

$page->injectScripts .= "
<script>
  document.addEventListener(\"DOMContentLoaded\", function(event) {
    setTimeout(function() {
      var script = document.createElement('script');
      script.src = 'https://www.google.com/recaptcha/api.js';
      document.head.appendChild(script);
    }, 250);
});
</script>";

$name = $page->getFormVar('name');
$phone = $page->getFormVar('phone');
$email = $page->getFormVar('email');
$type = $page->getFormVar('type');
$message = $page->getFormVar('message');

if (isset($_POST["submit"])) {
  $from = 'web@ichhelfelaufend.at';
  $fromName = 'Ich Helfe Laufend Web';
  $to = 'office@ichhelfelaufend.at'; 
  $subject = 'IHL Kontaktformular';

  // Check if name has been entered
  if (!$_POST['name']) {
    $errName = 'Bitte gib deinen Namen ein.';
  }

  // Check if email has been entered and is valid
  if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $errEmail = 'Bitte gib eine korrekte Email Adresse ein.';
  }

  //Check if message has been entered
  if (!$_POST['message']) {
    $errMessage = 'Bitte gib eine Nachricht ein.';
  }

  // check reCAPTCHA
  $secret='6Lczhw4TAAAAAJ5TiqYqutTc_SW6255sgJC4VrO8';
  $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
  $response = json_decode($response, true);
  if($response["success"] !== true) {
    $errHuman='Bitte verifiziere, dass du ein Mensch bist.';
  }

  // If there are no errors, send the email
  if (!$errName && !$errEmail && !$errMessage && !$errHuman) {
    require($_SERVER[DOCUMENT_ROOT] . $ROOT_PATH . '/lib/PHPMailer/PHPMailerAutoload.php');
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->CharSet    = 'UTF-8';
    $mail->Host       = 'smtp.world4you.com';
    $mail->SMTPAuth   = true;
    $mail->Username = 'web@ichhelfelaufend.at';
    $mail->Password = 'toptop123';
    $mail->SMTPSecure = 'tls';


    $mail->SetFrom($from, $fromName);
    $mail->AddReplyTo($email, $name);
    $mail->AddAddress($to, $to);

    $mail->Subject    = $subject;
    
    $body = "From: $name<br/> Phone: $phone<br/> E-Mail: $email<br/> Type: $type<br/> Message:<br/> $message";

    $mail->MsgHTML($body);
    

    if ($mail->send()) {
      $name = "";
      $phone = "";
      $email = "";
      $message = "";
      $result='<div class="alert alert-success"><strong>Vielen Dank!</strong> Ich werde mich so bald wie möglich, bei dir melden.</div>';
    } else {
      $result='<div class="alert alert-danger"><strong>Sorry!</strong> Es gab einen Fehler beim Senden der Nachricht, bitte versuche es später erneut, oder sende mir eine Nachricht an: <a href="mailto:office@ichhelfelaufend.at target="_blank">office@ichhelfelaufend.at</a>.</div>';
    }
  }
}


ob_start(); 
?>
<form class="form-horizontal" role="form" id="kontakt" method="post" action="<?php echo $page->formAction; ?>">
  <div class="form-group">
    <label class="sr-only control-label" for="name">Name</label>
    <input type="text" class="form-control <?php echo $errName ? 'form-control-error' : '' ;?>" id="name" name="name" placeholder="Vor- &amp; Nachname *" value="<?php echo htmlspecialchars($_POST['name']); ?>" required>
    <div class="help-block with-errors"><?php echo $errName ? "<p class='text-danger'>$errName</p>" : "" ;?></div>
  </div>
  <div class="form-group">
    <label class="sr-only control-label" for="phone">Phone</label>
    <input type="phone" class="form-control <?php echo $errPhone ? 'form-control-error' : '' ;?>" id="phone" name="phone" placeholder="+43 660 1234567 (optional)" value="<?php echo htmlspecialchars($_POST['phone']); ?>">
    <div class="help-block with-errors"><?php echo $errPhone ? "<p class='text-danger'>$errPhone</p>" : "" ;?></div>
  </div>
  <div class="form-group">
    <label class="sr-only control-label" for="email">Email</label>
    <input type="email" class="form-control <?php echo $errEmail ? 'form-control-error' : '' ;?>" id="email" name="email" placeholder="email@domain.com *" value="<?php echo htmlspecialchars($_POST['email']); ?>" required>
    <div class="help-block with-errors"><?php echo $errEmail ? "<p class='text-danger'>$errEmail</p>" : "" ;?></div>
  </div>
  <div class="form-group">
    <label class="sr-only control-label" for="type">Thema</label>
    <select class="form-control <?php echo $errMessage ? 'form-control-error' : '' ;?>" rows="5" id="type" name="type">
      <option <?php echo $type =='allgemein' ? 'selected="selected"' : ''; ?> value="allgemein">Allgemeine Anfrage</option>
      <option class="separator" role="separator" disabled="disabled"></option>
      <option disabled="disabled">Teilnehmer:</option>
      <option <?php echo $type =='bewerbe_wertungen' ? 'selected="selected"' : ''; ?> value="bewerbe_wertungen">Bewerbe &amp; Wertungen</option>
      <option <?php echo $type =='anmeldung' ? 'selected="selected"' : ''; ?> value="anmeldung">Anmeldung</option>
      <option <?php echo $type =='goodie_bag' ? 'selected="selected"' : ''; ?> value="goodie_bag">Goodie Bag Abholung</option>
      <option <?php echo $type =='garderobe' ? 'selected="selected"' : ''; ?> value="garderobe">Garderobe &amp; Verpflegung</option>
      <option class="separator" role="separator" disabled="disabled"></option>
      <option disabled="disabled">Du willst helfen?</option>
      <option <?php echo $type =='sponsoring' ? 'selected="selected"' : ''; ?> value="sponsoring">Sponsoring</option>
      <option <?php echo $type =='helfer' ? 'selected="selected"' : ''; ?> value="helfer">Helfer</option>
      <option <?php echo $type =='spendenprojekt' ? 'selected="selected"' : ''; ?> value="spendenprojekt">Spendenprojekt</option>
    </select>
    <div class="help-block with-errors"><?php echo $errType ? "<p class='text-danger'>$errType</p>" : "" ;?></div>
  </div>
  <div class="form-group">
    <label class="sr-only control-label" for="message">Nachricht</label>
    <textarea class="form-control <?php echo $errMessage ? 'form-control-error' : '' ;?>" rows="5" id="message" name="message" placeholder="Deine Nachricht. *" required><?php echo htmlspecialchars($_POST['message']);?></textarea>
    <div class="help-block with-errors"><?php echo $errMessage ? "<p class='text-danger'>$errMessage</p>" : "" ;?></div>
  </div>
  <div class="form-group">
    <div class="g-recaptcha" data-sitekey="6Lczhw4TAAAAAAXFJKVPnU2mzZKo-fwGU5sJZZqj"></div>
    <div class="help-block with-errors"><?php echo $errHuman ? "<p class='text-danger'>$errHuman</p>" : "" ;?></div>
  </div>
  <div class="form-group">
    <button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Anfrage Senden</button>
  </div>
  <?php if ($result) { ?>
  <div class="form-group">
    <?php echo $result; ?>   
  </div>
  <?php } ?>
</form> 
<?php
$page->contactForm = ob_get_clean();
?>