<?php
// Inclure la connexion
require_once '../php/config.php';

// Requête pour récupérer les messages
$sql = "SELECT nom, email, message, date_creation FROM message ORDER BY date_creation DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messagerie Admin</title>
    <style>
        body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4faff;
        color: #222;
        }

        header {
        background-color: #0099cc;
        color: white;
        padding: 20px;
        text-align: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .container {
        max-width: 900px;
        margin: 40px auto;
        padding: 20px;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.08);
        }

        .message {
        border-left: 4px solid #0099cc;
        padding: 16px;
        margin-bottom: 20px;
        background-color: #f9fcff;
        border-radius: 8px;
        }

        .message h3 {
        margin: 0 0 6px;
        font-size: 18px;
        color: #333;
        }

        .message p {
        margin: 6px 0;
        line-height: 1.4;
        color: #444;
        }

        .message .date {
        font-size: 12px;
        color: #888;
        }

        footer {
        text-align: center;
        margin: 40px 0 10px;
        font-size: 14px;
        color: #aaa;
        }
    </style>
    </head>
    <body>

    <header>
    <h1>📬 Interface Admin - Messagerie</h1>
    </header>

    <div class="container">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
        <div class="message">
            <h3><?= htmlspecialchars($row['nom']) ?> &lt;<?= htmlspecialchars($row['email']) ?>&gt;</h3>
            <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            <div class="date">🕒 <?= date('d/m/Y H:i', strtotime($row['date_creation'])) ?></div>
        </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>Aucun message pour le moment.</p>
    <?php endif; ?>
    </div>

    <footer>
    &copy; <?= date('Y') ?> - Messagerie admin
    </footer>

</body>
</html>
