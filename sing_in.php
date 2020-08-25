<!DOCTYPE html>
<html>
<head>
	<title>Sign In </title>


</head>
<link rel="stylesheet"  href="css/sing_in.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body >


  <?php
// les deux clefs récuperer sur google captcha 
 $key_captcha="6LfbUOQUAAAAAHZ3d6I3VsMkwYBcVY9csxEW3Za9";
$private_key="6LfbUOQUAAAAAL3gaNSBgYyobpfyNmO76R867zu2";

//captcha validation

require_once  '/captcha/autoload.php' ; 
  if(isset($_POST['submitpost']) ) {

if(isset($_POST['g-recaptcha-response'])){
//verification de la réponse des utilisateurs 
$recaptcha  =  new  \ ReCaptcha \ ReCaptcha ( $private_key); 
$resp  = $recaptcha->verify ( $_POST['g-recaptcha-response'] ); 

if ( $resp->isSuccess() ) { $R4=4;} 
 else { $errors = $resp->getErrorCodes (); 
    $captcha_mess="Complete the captcha ";
    $R4=0;
}
 }           
                              
}

//input conditions Expressions réguliéres 
 $conn = new PDO("mysql:host=localhost;dbname=contacter","root","");
  if(isset($_POST['submitpost'])){

  //User
$pattern_Gn="/^[a-zA-Z0-9_]{4,12}$/";
if(!preg_match($pattern_Gn, $_POST['User'])){
  
          $err_usr = "invalid username";
                   $R1=0;     
} else { $R1=1;
  $sql="SELECT * FROM personnes WHERE Username=? ";
  $st=$conn->prepare($sql);
  $st->bindParam(1,$_POST['User']);
  $st->execute();
  $Ex=$st->fetch();
  if ($Ex == 0 ){
    $R1=1; 
  }else {
    $err_usr="username been used";$R1=0;
  }
}

//Email_verification
$pattern_mail= "/^([a-zA-Z0-9]+)([\_\-]{1,1}+)*([a-zA-Z0-9]+)*@([a-zA-Z0-9]+\.)+[a-z]{2,4}$/" ;

if(!preg_match($pattern_mail, $_POST['mail'])){
  
  $err_mail = " invalid email ";
  $R2=0;
} else {
     
//Verifier si l'email existe déja dans la BDD
  $query="SELECT * FROM personnes WHERE Email= ?";
  $stmt=$conn->prepare($query);
  $stmt->bindParam(1,$_POST['mail']);
  $stmt->execute();
  $Exist= $stmt->fetch();

 if ($Exist == 0){
   $R2=2;
 }else {
  $err_mail="Email been used "; $R2=0;
 }

}
//Password_verification
$pattern_pass="/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/";

if(!preg_match($pattern_pass, $_POST['PSW'])){
  $errPass = "it must contain at least 6 character ,1 letter 1 number   ";
  $R3=0;
}else {
  $R3=3;
}
//si les expressions sont correcte j'envoie un Mail via serveur smtp en appellant (send_mail.php)
if (($R1  && $R2 && $R3 && $R4)!= 0) {
           require "send_mail.php";
} 

}
?>
<?php
//Partie Se Connecter 
if (isset($_POST['login_btn'])){
   require "login1.php";
}
    
    
    ?>  

    




<div class="grid-container" >

       <div class="grid-item1"> <br>
             
  	 	<form id="login" class="input-group"  method="POST" > 
  	 		<h1> Log In </h1> <br> 
         
  	    <div class="icon" >
          	<i class="fa fa-google"></i>&nbsp; 
          	 <i class="fa fa-facebook-official"></i>&nbsp;
              <i class="fa fa-twitter"></i>
        </div>
         <br>
		  <input type="text"  class="input-field" placeholder="Username" name="Usr" required>
        &nbsp;
          <input type="password" class="input-field"  placeholder=" Password" name="Pswd" required> 
         <div class="lost"><a href="Lost_Pass.php">Lost your password?</a></div> <br><BR>
         <button type="submit" class="submit-btn" name="login_btn">Log In  </button> 
         <div class="meow ">
        Don't have an account ?<a href="#" onclick="register()"><b> Sing Up  </b> </a></div>
           </form>  
            


<form id="register" class="input-group"   method="POST" > 
           <h1> Sign Up </h1> <br>

    <div class="icon" id="ptn">
          	<i class="fa fa-google"></i>&nbsp;
          	 <i class="fa fa-facebook-official"></i>&nbsp;
              <i class="fa fa-twitter"></i>
    </div>
		  <input type="text"  class="input-field" placeholder="Username" name="User" required>
      
       <?php echo isset($err_usr)?"<span  class='error'>{$err_usr}</span>":"" ; ?>

          <input type="text"  class="input-field" placeholder="Email" name="mail" required>

        <?php echo isset($err_mail)?"<span  class='error'>{$err_mail}</span>":"" ; ?>

        <style> .error { font-size: 14px; color:red ; font-family:Bodoni MT;}   </style>

          <input type="password" class="input-field"  placeholder=" Password"  name="PSW" required> 
        
          <?php echo isset( $errPass)?"<span  class='error'>{$errPass}</span>":"" ; ?>
           <BR><BR>
         <button type="submit" class="submit-btn" name="submitpost">Register  </button>     
         <div class="sing ">
         &nbsp;&nbsp;&nbsp;&nbsp;you have an account ?<a href="#" onclick="login()"><b>Login </b> </a></div> 
              
         <div class="g-recaptcha" data-sitekey="6LfbUOQUAAAAAHZ3d6I3VsMkwYBcVY9csxEW3Za9" style="transform: scale(0.85); "> </div>
      <?php echo isset($captcha_mess)?"<span  class='errorC'>{$captcha_mess}</span>":"" ; ?>
          <style> .errorC { font-size: 14px; color:red ; font-family: Bodoni MT; margin-left: 50px;}   </style>

</form>    
 </div>

   <div class="grid-item2"> 
   
      <h3 id="myP" >Join Us Now! </h3>
      
  </div>
</div>




<script>
	var x=document.getElementById("login");
	var y=document.getElementById("register");
	var z=document.getElementById("myP").innerHTML;
    var name=document.getElementByClass("grid-item2");

	function register() {
		
	   	x.style.left="400px";
		y.style.left="20px";
	  var w=z.replace("Welcome Back!","Join Us Now!"); 
    document.getElementById("myP").innerHTML=w ;
      

	}
	function login() {
	

    x.style.left="20px";
		y.style.left="400px";

	var w=z.replace("Join Us Now! ","Welcome Back!");
	document.getElementById("myP").innerHTML = w;
    

   

	}
	
</script>
<script src="https://www.google.com/recaptcha/api.js"></script>
</body>
</html>