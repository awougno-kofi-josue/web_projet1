


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
        padding: 40px;
        background-color: #f9f9f9;
        }
        .confirmation {
        
        text-align: center;
        padding: 40px;
    }

    .confirmation i {
        font-size: 50px;
        color: green;
        margin-bottom: 20px;
    }

    .confirmation p {
        font-size: 18px;
        color: #333;
        margin-bottom: 20px;
        }

    .confirmation button {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .confirmation button:hover {
        background-color: #0056b3;
    }

    </style>
</head>
<body>
    <?php require "header.php" ?>
    <div class="confirmation" id="confirmationSection">
        <i class="fas fa-check-circle"></i>
        <h2>Message envoyé !</h2>
        <p>Merci de nous avoir contactés. Nous avons bien reçu votre message et vous répondrons dans les plus brefs délais.</p>
        <button onclick="window.location.href='../index.php'">Retourner à la page d'accueil</button>
    </div>
</body>
</html>