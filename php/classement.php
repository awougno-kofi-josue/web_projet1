<?php
require_once "config.php";

$sql="SELECT * FROM classement";

$classement=$conn->query($sql)->fetch_all(MYSQLI_ASSOC);




?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="../image/logo.jpg" type="image/x-icon">
    <title>Message envoyé</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 15px;
        background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <?php require "header.php" ?>
    

    <h1>Classement national</h1>
    
    


</body>
</html>