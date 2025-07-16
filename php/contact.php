<?php 
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $nom     = $_POST['nom'] ?? '';
    $email   = $_POST['email'] ?? '';
    $sujet   = $_POST['sujet'] ?? '';
    $message = $_POST['message'] ?? '';

    // Prévention contre les injections SQL
    $stmt = $conn->prepare("INSERT INTO message (Nom, email, sujet, Message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nom, $email, $sujet, $message);

    if ($stmt->execute()) {
        header("Location: thanks.php");
        exit;
    } else {
        die("Erreur d'envoi de message : " . $conn->error);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="shortcut icon" href="../image/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15px;
            background-color: #f9f9f9;
        }

        .contact-container {
            display: flex;
            flex-wrap: wrap;
            max-width: 1000px;
            margin: 30px auto;
            background: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .contact-info, .contact-form {
            flex: 1;
            min-width: 300px;
            padding: 30px;
        }

        .contact-info h2,
        .contact-form h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .contact-info p {
            margin: 10px 0;
            font-size: 16px;
            color: #555;
        }

        .social-icons a {
            margin-right: 15px;
            font-size: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .contact-form form {
            display: flex;
            flex-direction: column;
        }

        .contact-form label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .contact-form input,
        .contact-form textarea {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        .contact-form button:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 768px) {
            
            .contact-container {
                flex-direction: column;
                padding: 20px;
            }

            .contact-info, .contact-form {
                padding: 5px;
                min-width: 100%;
            }

            .contact-form input,
            .contact-form textarea {
                font-size: 15px;
            }

            .contact-form button {
                font-size: 15px;
                padding: 10px;
            }

            .social-icons a {
                font-size: 18px;
                margin-right: 10px;
            }
        }
    </style>
</head>
<body>

<?php require 'header.php'; ?>

<div class="contact-container" id="contactSection">
    <div class="contact-info">
        <h2>Entrer en contact</h2>
        <p>📧 josueawougno@gmail.com</p>
        <p>📞 + (228) 93 94 71 71</p>
        <p>📍 Lomé, Agoè-Nyivé, Legbassito</p>

        <h3>Suivez-moi</h3>
        <div class="social-icons">
            <a href="#"><i class="fab fa-linkedin"></i></a>
            <a href="#"><i class="fab fa-github"></i></a>
            <a href="#"><i class="fab fa-facebook"></i></a>
        </div>
    </div>

    <div class="contact-form" id="formSection">
        <h2>Envoyez-nous un message</h2>
        <form method="post" action="">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" placeholder="Votre nom" required>

            <label for="email">E-mail</label>
            <input type="email" name="email" id="email" placeholder="Votre e-mail" required>

            <label for="sujet">Sujet</label>
            <input type="text" name="sujet" id="sujet" placeholder="Sujet du message">

            <label for="message">Message</label>
            <textarea name="message" id="message" rows="5" placeholder="Votre message..." required></textarea>

            <button type="submit">Envoyer le message</button>
        </form>
    </div>
</div>

</body>
</html>
