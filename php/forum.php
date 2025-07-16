<?php
require_once "config.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//  Récupération de tous les sujets
$sql = "SELECT * FROM sujets ORDER BY date_creation DESC";
$sujets = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

// Récupération de toutes les réponses
$sql1 = "SELECT * FROM reponses";
$rep = $conn->query($sql1)->fetch_all(MYSQLI_ASSOC);


$nb_reponses = [];
foreach ($rep as $r) {
    $sid = $r['sujet_id'];
    if (!isset($nb_reponses[$sid])) {
        $nb_reponses[$sid] = 0;
    }
    $nb_reponses[$sid]++;
}

// 4. Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['reponse'], $_POST['nom'], $_POST['sujet_id'])) {
    $reponse = trim($_POST['reponse']);
    $nom = trim($_POST['nom']);
    $sujet_id = (int) $_POST['sujet_id'];

    if (!empty($reponse) && !empty($nom) && $sujet_id > 0) {
        $stmt = $conn->prepare("INSERT INTO reponses (sujet_id, reponse, nom) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $sujet_id, $reponse, $nom);
        $stmt->execute();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    } else {
        $erreur = "Veuillez remplir tous les champs correctement.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Forum</title>
    <link rel="shortcut icon" href="../image/logo.jpg" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f7fb;
            color: #333;
            margin: 0;
            padding: 15px;
            line-height: 1.6;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2em;
            color: #2c3e50;
        }
        p a {
            display: inline-block;
            background-color: #3498db;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-bottom: 20px;
        }
        p a:hover {
            background-color: #2980b9;
        }
        .forum {
            display: flex;
            flex-direction: column;
            gap: 25px;
            max-width: 900px;
            margin: 0 auto;
        }
        .carte_sujet {
            background-color: #fff;
            border-left: 6px solid #3498db;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            padding: 20px;
            border-radius: 12px;
            transition: transform 0.2s ease;
        }
        .carte_sujet:hover {
            transform: scale(1.01);
        }
        .carte_sujet h3 {
            color: #2980b9;
            font-size: 1.4em;
            margin-bottom: 10px;
        }
        .carte_sujet p {
            margin-bottom: 10px;
        }
        .ancien_rep {
            background-color: #ecf0f1;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
            font-size: 0.95em;
        }
        .ancien_rep h5 {
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .form_reponse {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }
        .form_reponse input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 1em;
            width: 100%;
        }
        .form_reponse button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .form_reponse button:hover {
            background-color: #2980b9;
        }
        .btn-toggle-rep {
            background-color: #ddd;
            padding: 8px 12px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 0.95em;
        }
        #btn-rep {
            background-color: #2ecc71;
            color: #fff;
            padding: 8px 14px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 10px;
            font-size: 0.95em;
        }
        @media (max-width: 768px) {
            .carte_sujet {
                padding: 15px;
            }
            h2 {
                font-size: 1.7em;
            }
        }
    </style>
</head>
<body>
<?php require "header.php"; ?>

<h2>Forum de discussion</h2>
<p><a href="ajout_sujet.php">Ajouter un sujet de discussion </a></p>

<section class="forum">
    <?php if (isset($erreur)): ?>
        <p style="color:red;"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <?php if (count($sujets) === 0): ?>
        <p>Aucun sujet pour l'instant. Soyez le premier à en créer un !</p>
    <?php else: ?>
        <?php foreach ($sujets as $sujet): ?>
            <div class="carte_sujet">
                <h3><?= htmlspecialchars($sujet['titre']) ?></h3>
                <p><?= htmlspecialchars($sujet['description']) ?></p>
                <p><strong>Par : <?= htmlspecialchars($sujet['auteur']) ?></strong></p>

                <p>
                    <button class="btn-toggle-rep" data-id="<?= $sujet['id'] ?>">
                        <?php
                            $count = $nb_reponses[$sujet['id']] ?? 0;
                            echo $count > 0 ? "$count commentaire" . ($count > 1 ? "s" : "") : "Aucune réponse";
                        ?>
                    </button>
                </p>

                <?php 
                    $dernier_message = "Aucun";
                    foreach ($rep as $r): 
                        if ($r["sujet_id"] === $sujet['id']) {
                            if ($dernier_message === "Aucun" || strtotime($r['date']) > strtotime($dernier_message)) {
                                $dernier_message = $r['date'];
                            }
                ?>
                    <div class="ancien_rep rep-block-<?= $sujet['id'] ?>" style="display: none;">
                        <h5><?= htmlspecialchars($r["nom"]) ?></h5>
                        <p><?= htmlspecialchars($r['reponse']) ?></p>
                    </div>
                <?php } endforeach; ?>

                <span>Dernier message : <?= htmlspecialchars($dernier_message) ?></span><br>

                <button onclick="toggleForm(<?= $sujet['id'] ?>)" id="btn-rep">💬 Répondre</button>

                <form action="" method="post" class="form_reponse" id="form_<?= $sujet['id'] ?>" style="display:none;">
                    <input type="hidden" name="sujet_id" value="<?= $sujet['id'] ?>">
                    <input type="text" name="nom" placeholder="Votre nom..." required>
                    <input type="text" name="reponse" placeholder="Votre avis..." required>
                    <button type="submit">📤 Envoyer</button>
                </form>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</section>

<script>
function toggleForm(id) {
    const form = document.getElementById("form_" + id);
    form.style.display = form.style.display === "none" ? "block" : "none";
}

document.querySelectorAll(".btn-toggle-rep").forEach(button => {
    button.addEventListener("click", () => {
        const id = button.dataset.id;
        document.querySelectorAll(".rep-block-" + id).forEach(rep => {
            rep.style.display = (rep.style.display === "block") ? "none" : "block";
        });
    });
});
</script>

</body>
</html>
