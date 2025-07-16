<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #007bff;
      padding: 10px 20px;
      color: white;
    }

    .logo {
      font-size: 24px;
      font-weight: bold;
    }

    .menu-toggle {
      display: none;
      flex-direction: column;
      justify-content: space-between;
      width: 30px;
      height: 20px;
      background: none;
      border: none;
      cursor: pointer;
    }

    .menu-toggle .bar {
      height: 4px;
      width: 100%;
      background-color: white;
      border-radius: 2px;
    }

    #main-nav ul {
      display: flex;
      list-style: none;
      margin: 15px;
      padding: 0;
      gap: 20px;
    }

    #main-nav ul li a {
      color: white;
      text-decoration: none;
      font-weight: bold;
    }

    @media (max-width: 768px) {
      .menu-toggle {
        display: flex;
      }
      #main-nav ul li a {
      color: black;
      text-decoration: none;
      font-weight: bold;
    }
      #main-nav {
        display: none;
        position: absolute;
        top:80px;
        left: 0;
        background-color: #e4ebf3e1;
        width: 100%;
        padding: 50px 0;
        color: black;
    }

    #main-nav.show {
        display: block;
    }

    #main-nav ul {
        flex-direction: column;
        align-items: center;
        color: black;
    }

    #main-nav ul li {
        margin: 10px 0;
    }
    }
    </style>
</head>
<body>
    <header>
        <div class="logo">QuizMaster</div>
        <button class="menu-toggle" id="menu-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </button>
        <nav id="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="php/forum.php">Forum</a></li>
                <li><a href="php/classement.php">Classement</a></li>
                <li><a href="php/contact.php">Contact</a></li>
            </ul>
        </nav>
    </header>

    <script src="js/script.js">
    </script>
</body>
</html>