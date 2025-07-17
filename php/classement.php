<?php
require_once "config.php";

$sql="SELECT * FROM classement ORDER BY score DESC";

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
    <title>Classement</title>
    <style>
        body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 15px;
        background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
            color: #0056b3;
            margin-bottom: 30px;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 90%;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #5a5c5eff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        p {
            text-align: center;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <?php require "header.php" ?>
    

    <h1>Classement Général</h1>
    
        <?php if (count($classement) === 0): ?>
            <p> Soyez le premier à entrer dans le classement!</p>
        <?php else: ?>
    <table>
        <thead>
            <th>N°</th>
            <th>Nom </th>
            <th>Score</th>
        </thead>
        <?php $i=1; 
        foreach($classement as $cla): ?>
        <tbody>
            <tr>
                <td> <?= htmlspecialchars ($i); $i++; ?></td>
                <td><?= htmlspecialchars($cla['nom']) ;?></td>
                <td><?= htmlspecialchars($cla['score']) ; ?></td>
            </tr>
        </tbody>
        <?php 
    endforeach; endif;?>
    </table>
</body>
</html>

