<?php



 if (isset($_GET['eid']) && isset($_GET['exd'])){


   date_default_timezone_set("Europe/Paris");
   $Id= urldecode(base64_decode($_GET['eid']));
   $expire=urldecode(base64_decode($_GET['exd']));


 $current_date= date("Y-m-d H:i:s");

  if($current_date >= $expire ){

//Verification de la validation de Mail

$conn = new PDO("mysql:host=localhost;dbname=contacter","root","");
  $SELECT ="SELECT Aut_key from personnes WHERE Email=? ";
  $stmt=$conn->prepare($SELECT);
   $stmt->execute([$Id]);
$usr = $stmt->fetch();
       
       if ($usr['Aut_key'] == 1){
  //si l'email a déja été valider 
        require "Email_alrVer.html";  ;
                         
                          }
 else {
         try {
                //si La validation  a été expirer 
                $Delete= "DELETE FROM personnes WHERE Email=? " ;//supprime les donnée enregistrer sur l'utilisateur 
                $stmt=$conn->prepare($Delete);
                $stmt->execute([$Id]);
 
                require "Email_Expired.html";  
              }catch(PDOException $e) {
echo "Echec Email verification " .$e->getMessage();
                                        }
      }
}

else {
          try{
            $conn = new PDO("mysql:host=localhost;dbname=contacter","root","");

$SELECT ="SELECT Aut_key from personnes WHERE Email=? ";
$stmt=$conn->prepare($SELECT);
$stmt->execute([$Id]);
$user = $stmt->fetch();

if ($user['Aut_key'] == 1){

require "Email_alrVer.html";  
} else {

$query= "UPDATE personnes SET Aut_key = 1 WHERE Email=?"; 
$stmt=$conn->prepare($query);
$stmt->execute([$Id]);
//Si L'Email a été Vérifier 
require "Email_ver.html";  

}
          }
catch(PDOException $e)
{
echo "Echec Email verification " .$e->getMessage();
} 


} 
}

 



?>