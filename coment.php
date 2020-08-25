<?php
session_start();//DEBUT DE SESSION 
?>

<?php

 $conn = new PDO("mysql:host=localhost;dbname=contacter","root","");
  $commentaires=$conn->prepare("SELECT * FROM forum ");
  $commentaires->execute();
  //afficher tout les commentaires existant dans la BDD
  $c=$commentaires->fetchAll();

   //on a deux parties une pour les commentaires poster l'autre pour leurs avis 
   //Partie Commentaires 
       if (isset($_POST['btn']) ){
                  $Com=$_POST['commentaires'];
                  $Variable=0;//determine si l'utilisateur a donner don avis(rating )
                                                                    
             if($Variable == 0 ) {
          
           $conn = new PDO("mysql:host=localhost;dbname=contacter","root","");         
          $INSERT="INSERT INTO forum (Comment,Pseudo) VALUES (?,?)";

              $rep=$conn->prepare($INSERT);
               $rep->bindParam(1, $Com);
               $rep->bindParam(2,$_SESSION['pseudo']);
               $rep->execute();
            
                
    //reaficher toute la liste des commentaires avec le nouveau commentaire
      $commentaires=$conn->prepare("SELECT * FROM forum");
        $commentaires->execute();
         $c=$commentaires->fetchAll();
            $Variable=1;
}
        //Partie rating 
                              if (isset($_POST['valeur'])){
                              $x=$_POST['valeur'];}

      $rep=$conn->prepare("SELECT * FROM rating WHERE User_name=?");
      $rep->bindParam(1,$_SESSION['pseudo']);
      $rep->execute();
      $result=$rep->fetch();
      //si l'avis ne figure pas dans la BDD on l'insert tout simplement 
      if($result == 0) { 
              $INSERT="INSERT INTO rating (User_name,Value) VALUES (?,?)";
              $rep=$conn->prepare($INSERT);
               $rep->bindParam(1, $_SESSION['pseudo']);
               $rep->bindParam(2,$x);
               $rep->execute();
  //sinon on met à jour  l'avis de l'utilisateur      
 } else {
          $UPT="UPDATE  rating SET Value =? WHERE User_name=?";

               $rep=$conn->prepare($UPT);
               $rep->bindParam(1,$x);
               $rep->bindParam(2,$_SESSION['pseudo']);
               $rep->execute();
}
}
if (isset($_POST['Decox']) ){
  session_destroy();
  header('location:sing_in.php');
  exit;

}


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
	<title>Comment space </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<link rel="stylesheet"  href="css/coment.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body >
   
<form method="POST">
 <ul style="margin-left:20%; padding-top:4%;">
<button name="user"><?php  echo ($_SESSION['pseudo']); ?></button>
<button name="Decox">Déconnexion</button>
</ul>
  </form>
  


  <div class="flex-container">
  <div class="grid" id="item1">
  	<div class="element">
    <h2>Rate your experience: </h2>
       <div class="test">
<form method="POST">
        what do you think about this app?
        <div class="rating_1" >
   <input type="checkbox" name="valeur" value="bad"> &nbsp;&nbsp;&nbsp;
    <span class="fa fa-star checked"></span>
     <span class="fa fa-star checked"></span>
     <span class="fa fa-star "></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <i class="fa fa-frown-o" aria-hidden="true"></i>
       </div>
    <div class="rating_1" >
   <input type="checkbox" name="valeur" value="Good"> &nbsp;&nbsp;&nbsp;
    <span class="fa fa-star checked"></span>
     <span class="fa fa-star checked"></span>
     <span class="fa fa-star checked"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <i class="fa fa-meh-o" aria-hidden="true"></i>
       </div>
    <div class="rating_1" >
   <input type="checkbox" name="valeur" value="Perfect"> &nbsp;&nbsp;&nbsp;
    <span class="fa fa-star checked"></span>
     <span class="fa fa-star checked"></span>
     <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <i class="fa fa-smile-o" aria-hidden="true"></i>

       </div>
<br>


      </div>
    <form method="POST" class="form-group">
     <h2> Add a Comment </h2>
     Help us to improve the experience 
      <textarea name="commentaires"  required id="text"></textarea> <br> 
      <input  type="submit" value="POST " name="btn" required id="btn"> 
      
    </form>
    </form>
   </div>
   </div>
   <div class="grid" id="item2">
  	<h2 id="T2">Comments</h2>
  	What other users think about this project ?
      <br> <br>
         <?php  foreach ( $c as $x) {   ?>
       <div class="affichage">
      <b id="Pseudo"><?= $x['Pseudo'] ;?> :</b>


      <?= $x['Comment']; ?>
     </div>
      	  <br> <BR>

      <?php  } ?>
  </div>
</div>







</body>
</html>