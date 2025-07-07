<?php
$host="localhost";
$user="root";
$password="";
$db_name="gestion_stock";

$conn=new mysqli($host, $user,$password,$db_name);

if($conn->connect_error){
    die("Erreur de connection: ". $conn->connect_error);
}

if($_SERVER['REQUEST_METHOD']==="POST"){
    $nom=$_POST['nom_produit'];
    $quantite=$_POST['quantite'];
    $qualite=$_POST['qualite'];

    $sql="INSERT INTO stock(nom_produit,quantite,qualite) VALUES ('$nom','$quantite','$qualite')";

    if($conn->query($sql)===TRUE){
        echo " ".$nom." est ajouter à votre base de donnée avec succès.  ";
        header("Location:gestion_stock.php");
        exit;

    }else{
        die('Erreur de connexion : '.$conn->connect_error);
    }

}


?>








<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="sty.css">
    <title>Gestion du stock</title>
</head>
<body>

    <main>
        <div class="container">
        <h1>Add New Product</h1>
        <form action="" method="POST">
            <div class="form-group">
                <label for="nom_produit">Product Name:</label>
                <input 
                    type="text" 
                    id="nom_produit" 
                    name="nom_produit" 
                    placeholder="e.g., Wireless Mouse, Organic Coffee Beans" 
                    required 
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="quantite">Quantity:</label>
                <input 
                    type="number" 
                    id="quantite" 
                    name="quantite" 
                    min="1" 
                    value="1" 
                    placeholder="Enter quantity" 
                    required
                >
            </div>

            <div class="form-group">
                <label for="qualite">Quality:</label>
                <select id="qualite" name="qualite" required>
                    <option value="">-- Select Product Quality --</option>
                    <option value="New">New</option>
                    <option value="Used - Excellent">Used - Excellent</option>
                    <option value="Used - Good">Used - Good</option>
                    <option value="Used - Fair">Used - Fair</option>
                    <option value="Refurbished">Refurbished</option>
                    <option value="Damaged">Damaged (for record keeping)</option>
                </select>

            <button type="submit">Add</button>
    </main>

</body>
</html>