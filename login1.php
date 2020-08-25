<?php 
session_start();

try{
//create connection

$_SESSION['pseudo']=$_POST['Usr'];
$_SESSION['Psd']=$_POST['Pswd'];

 $conn = new PDO("mysql:host=localhost;dbname=contacter","root","");

$sql="SELECT * FROM personnes WHERE Username=? ";

$statement=$conn->prepare($sql);
$statement->bindParam(1,$_SESSION['pseudo']);
$statement->execute();
$row=$statement->fetchAll();
	
//$UsrEncod=urlencode(base64_encode($Usr));//encoder le username puis l'integrer dans le lien qui méne vers l'espace commentaires 

 //var_dump($row);
 foreach ($row as $cont) {
if (password_verify($_SESSION['Psd'], $cont['Passeword'])){//il est preferable d'éviter les test (==) 

           //Lien vers l'espace commentaires c
      header('Location:coment.php');
      
     

 }
 else {
 
     echo '<script > window.onload=alert("Username OR password not muched ")</script>' ;
     //message de retour en cas d'erreurs 
 }
     
 
}

}

catch(PDOException $e)
{
echo "Connection failed: " .$e->getMessage();
}


?>

