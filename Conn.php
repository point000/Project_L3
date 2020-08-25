<html>
  <head>
    <title>reCAPTCHA demo: Simple page</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  </head>
  <body>
  	<?php

require_once  '/captcha/autoload.php ' ; 
  if(isset($_POST['submitpost'])){

if(isset($_POST['g-recaptcha-response'])){
$recaptcha  =  new  \ ReCaptcha \ ReCaptcha ( '6LfbUOQUAAAAAL3gaNSBgYyobpfyNmO76R867zu2' ); 
$resp  = $recaptcha->verify ( $_POST['g-recaptcha-response'] ); 

if ( $resp->isSuccess() ) { echo "captcha valide "; } 
 else { $errors = $resp->getErrorCodes (); 
                    echo "invalid captcha";
                   var_dump($errors); 
                     }                   
}else {
	var_dump("captcha non rempli");
}


}
    ?>

    <form  method="POST">
      <div class="g-recaptcha" data-sitekey="6LfbUOQUAAAAAHZ3d6I3VsMkwYBcVY9csxEW3Za9"></div>
      <br/>
      <input type="submit" value="Valider" name="submitpost">
    </form>
  </body>
</html>