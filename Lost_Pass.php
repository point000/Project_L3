<?php?>
<!DOCTYPE html>
<html>
<head>
	<title>blalalala</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script >
	
	$(document).ready(function(){
		
     $(".OK").click(function(){
      $(".container").css("display","none");
    });
	});
</script>

</head>
<link rel="stylesheet"  href="Lost_Pass.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php

 $v="Hello"; //message a afficher en cas d'erreurs ou de success

if (isset($_POST['btn'])){
//inisialisation des variables
$cond1=0;
$cond2=0;
//input conditions
//EMAIL
$pattern_mail= "/^([a-zA-Z0-9]+)([\_\-]{1,1}+)*([a-zA-Z0-9]+)*@([a-zA-Z0-9]+\.)+[a-z]{2,4}$/" ;

if(!preg_match($pattern_mail, $_POST['Mail'])){
  
  $v = " invalid email ";
   $cond1=1;
}

//Password 
$pattern_pass="/^(?=.*[0-9]+.*)(?=.*[a-zA-Z]+.*)[0-9a-zA-Z]{6,}$/";

if(!preg_match($pattern_pass, $_POST['Pswd'])){ 
  $cond2=1;
}
//Si les expressions sont correctent + les mots de passes Alor j'affiche success
if ($_POST['PswdC'] == $_POST['Pswd'] && $cond1==0 && $cond2==0 ){
           $v="successfully recovering " ;


 // Puis je met a jour les données dans la BDD          
try{
       $Mail=$_POST['Mail'];
       $password=$_POST['Pswd']; //le Pswd==PswdC 
      $new_Pass=$_POST['PswdC'];
       $Pass_hash=password_hash($password, PASSWORD_BCRYPT); 
    
 
 $conn = new PDO("mysql:host=localhost;dbname=contacter","root","");

$sql = "UPDATE personnes SET passeword=? WHERE Email=?";

$stmt=$conn->prepare($sql);
$stmt->bindParam(1,$Pass_hash);
$stmt->bindParam(2,$Mail);
$stmt->execute();


} 
catch(PDOException $e)
{
echo "Connection failed: " .$e->getMessage();

}

          
}

}



?>

<!-- Une fenetre Modal crée avec le code JS au dessus   -->
	  <div class="container">
	  <!-- une box avec tout le formulaire -->
     	<div class="box">
         <span class="OK">
       <i class="fa fa-times" aria-hidden="true"></i>
        </span>

      	<h1> Password recovery </h1>

       <form class="input-group" method="POST" >
       <p> <?php echo ($v)?> </p>
    
        <br><br><br><br>
     <input type="text"  class="input-field" placeholder="Email" name="Mail" required>
        <input type="password" class="input-field"  placeholder=" Password" name="Pswd" required> 

      <input type="password" class="input-field"  placeholder=" Confirm Password" name="PswdC" required> <br><br>
       <button class="submit" name="btn">OK</button>
	
       </form>
     	</div>
     </div>


</body>
</html>

