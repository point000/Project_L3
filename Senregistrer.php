<?php


   $username=$_POST['User'];
    $password=$_POST['PSW'];
     $Mail=$_POST['mail'];

//hashage du mot de passe 
 $Pass_hash=password_hash($password, PASSWORD_BCRYPT); 
 
try{


 $conn = new PDO("mysql:host=localhost;dbname=contacter","root","");
//insertion de données en BDD

$INSERT="INSERT INTO personnes (Username,Email,Passeword) VALUES (?,?,?)";

$rep=$conn->prepare($INSERT);
$rep->bindParam(1, $username);
$rep->bindParam(2, $Mail);
$rep->bindParam(3,$Pass_hash);

$rep->execute();

$V=1;

} 
catch(PDOException $e)
{
echo "Connection failed: " .$e->getMessage();
$V=0;
}

if ($V=1){
    //Envoie d'un message indiquant qu'un Email a été envoyer 
	require("message.html");
}



?>



