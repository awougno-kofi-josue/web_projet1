<?php
require_once "config.php";

$erreur = "";
$success = "";

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $titre = trim($_POST["titre"]);
    $description = trim($_POST["description"]);
    $auteur = trim($_POST["auteur"]);

    if (!empty($titre) && !empty($description) && !empty($auteur)) {
        $stmt = $conn->prepare("INSERT INTO sujets (titre, description, auteur) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $titre, $description, $auteur);
        $stmt->execute();

        $success = "Sujet ajouté avec succès !";
        header("Location: forum.php");
        exit;
    } else {
        $erreur = "Tous les champs sont requis.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un sujet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/logo.jpg" type="image/x-icon">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f8;
            padding: 15px;
            margin: 0;

        }

        .container {
            
            max-width: 600px;
            background-color: #fff;
            margin: 20px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #2c3e50;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1em;
        }

        button[type="submit"] {
            background-color: #2ecc71;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
        }

        button[type="submit"] :hover {
            background-color: #27ae60;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .message.error {
            color: red;
        }

        .message.success {
            color: green;
        }
    </style>
</head>
<body>
    <?php  require "header.php"  ?>
<div class="container">
    
    <h2>Ajouter un sujet</h2>

    <?php if ($erreur): ?>
        <p class="message error"><?= htmlspecialchars($erreur) ?></p>
    <?php elseif ($success): ?>
        <p class="message success"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>

    <form method="post">
        <input type="text" name="titre" placeholder="Titre du sujet" required>
        <textarea name="description" rows="5" placeholder="Décrivez votre sujet..." required></textarea>
        <input type="text" name="auteur" placeholder="Votre nom" required>
        <button type="submit">➕ Ajouter</button>
    </form>
</div>

</body>
</html>
