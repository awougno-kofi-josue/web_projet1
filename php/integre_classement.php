<?php
require_once "config.php"; 
$domaine_id = $_GET["id"];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $score = (int)$_POST['score'];

    // Vérifier si l'utilisateur existe déjà
    $select = $conn->query("SELECT * FROM classement WHERE email = '$email'");

    $result=$select->fetch_assoc();


    if ($result) {
        // ➕ Ajouter au score existant
        $nouveau_score = $result['score'] + $score;

        $update = $conn->prepare("UPDATE classement SET score = ? WHERE email = ?");
        $update->execute([$nouveau_score, $email]);
    } else {
        // ➕ Insérer nouvel utilisateur
        $insert = $conn->prepare("INSERT INTO classement (domaine_id, nom, email, score) VALUES (?, ?, ?, ?)");
        $insert->execute([$domaine_id, $nom, $email, $score]);
    }

    echo "<script>localStorage.removeItem('scoreFinal');</script>";
    header("Location: classement.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajout au classement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 30px;
        }
        form {
            background: white;
            padding: 20px;
            max-width: 400px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input, button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
            font-size: 16px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<h2>Entrez vos informations pour enregistrer votre score</h2>

<form method="post" action="">
    <input type="text" name="nom" placeholder="Votre nom" required>
    <input type="email" name="email" placeholder="Votre email" required>
    <input type="hidden" name="score" id="score_input">
    <button type="submit">Envoyer</button>
</form>

<script>
    // Récupération du score depuis le localStorage
    document.addEventListener("DOMContentLoaded", () => {
        const score = localStorage.getItem("scoreFinal") || 0;
        document.getElementById("score_input").value = score;
    });
</script>

</body>
</html>
