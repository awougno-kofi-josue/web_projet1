<?php 

$host="localhost";
$user="root";
$password="";
$db= "quiz";


$conn=new mysqli($host,$user,$password,$db);
if($conn->connect_error){
    die ("Erreur de connexion à la base de données : " .$conn->connect_error);
}



?>