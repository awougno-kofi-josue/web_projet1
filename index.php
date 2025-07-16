

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="image/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="css/style.css">
    <title>Test de connaissance</title>
    <style>
        @media screen and (max-width: 768px) {
        .section1 .btn,
    #nb input,
    #nb button,
    #result_box button,
    #bn button,
    #retour {
        width: 90%;
    }

    .categorie {
        width: 90%;
    }

    #bn {
        margin-left: 0;
        align-items: center;
    }

    #bn #question_form input {
        width: 90%;
    }

    .section2 {
        gap: 15px;
        margin-bottom: 60px;
    }

    #ti {
        margin-top: 40px;
    }
}

@media screen and (min-width: 769px) {
    button,
    input[type="number"] {
        width: auto;
        font-size: 18px;
    }
}


    </style>
</head>
<body>
        <?php require "head.php" ;?>  
    <section class="section1">
        <div class="sousContenu">
            <h1>Testez vos connaissances </h1>
            <p>Exporez une variété de quiz dans differents domaines et défiez-vous pour améliorer votre savoir.</p>
        </div>
        
        <button class="btn" onclick="window.location.href='php/quiz.php?id=<?=1;?>'"> Commencer un quiz </button>
    </section>
    <h3 id="ti">Explorez Nos Catégories de Quiz</h3>
    <section class="section2">
        
        <div class="categorie">
            <img src="image/livre.png" alt="">

            <h3>Culture Générale</h3>
            <p>Testez votre savoir sur les actualitées du Togo ainsi que sur des sujets divers</p>

            <button class="btn_sous" onclick="window.location.href='php/quiz.php?id=<?=1?>'">Démarrer </button>
        </div>


        <div class="categorie">
            <img src="image/evolution.png" alt="">

            <h3>Histoire</h3>
            <p>Voyagez à travers le temps et decouvrez les événements marquants de l'humanité.</p>
            <button class="btn_sous" onclick="window.location.href='php/quiz.php?id=<?= 3 ?>' ">Démarrer </button>
        </div>

        <div class="categorie">
            <img src="image/microscope.png" alt="">

            <h3>Sciences</h3>
            <p>Explorez les mistères de la physiques, de la chimie, de la biologie et plus encore</p>
            <button class="btn_sous" onclick="window.location.href='php/quiz.php?id=<?= 5 ?>' ">Démarrer </button>
        </div>

        <div class="categorie">
            <img src="image/globe.png" alt="">
            <h3>Géographie</h3>
            <p>Mettez à l'épreuve vos connaissances sur les pays, les capitales et les merveilles du monde.</p>
            <button class="btn_sous" onclick="window.location.href='php/quiz.php?id=<?= 4 ?>' ">Démarrer </button>
        </div>
        <div class="categorie">
            <img src="image/technologie.png" alt="">
            <h3>Technologie</h3>
            <p>Restez à jour avec les dernières innovations et les concepts technologiques.</p>
            <button class="btn_sous" onclick="window.location.href='php/quiz.php?id=<?= 2 ?>' ">Démarrer </button>
        </div>
        <div class="categorie">
            <img src="image/chaussure-de-course.png" alt="">
            <h3>Sportif</h3>
            <p>Demontrez votre expertise sur le football, l'athlètisme, le tennis, etc...</p>
            <button class="btn_sous" onclick="window.location.href='php/quiz.php?id=<?= 6 ?>' ">Démarrer </button>
        </div>
    </section>
    
</body>
</html>