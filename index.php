<?php
session_start();
if (!isset($_SESSION['nombreMystere'])) {
    $_SESSION['nombreMystere'] = rand(0, 1000);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            <?php
            if (!empty($_POST['couleur'])) {
                $couleur = htmlspecialchars($_POST['couleur']);
                echo "background-color: " . $couleur . ";";
            }
            ?>
        }
    </style>
</head>

<body>
    <h1>Exercice Formulaire PHP</h1>

    <section>
        <h2>Exemple :</h2>
        <form action="index.php" method="POST">
            <label for="name">Votre nom</label>
            <input type="text" name="name" id="name">
            <label for="prenom">Votre prénom</label>
            <input type="text" name="prenom" id="prenom">
            <button type="submit">Valider</button>
        </form>

        <p>Bonjour
            <?php
            if (!empty($_POST['name']) && !empty($_POST['prenom'])) {
                $nom = htmlspecialchars($_POST['name']);
                $prenom = htmlspecialchars($_POST['prenom']);
                echo $nom . " " . $prenom;
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 1</h2>
        <!-- pour tester index.php?ville=Paris&transport=train on peut changer la ville et le transport -->
        <p>
            <?php
            if (!empty($_GET['ville']) && !empty($_GET['transport'])) {
                $ville = htmlspecialchars($_GET['ville']);
                $transport = htmlspecialchars($_GET['transport']);
                echo "La ville choisie est " . $ville . " et le voyage se fera en " . $transport . " !";
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 2</h2>
        <form action="index.php" method="GET">
            <label for="animal">Votre animal préféré</label>
            <input type="text" name="animal" id="animal">
            <button type="submit">Valider</button>
        </form>

        <p>
            <?php
            if (!empty($_GET['animal'])) {
                $animal = htmlspecialchars($_GET['animal']);
                echo "Votre animal choisi est : " . $animal;
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 3</h2>
        <form action="index.php" method="POST">
            <label for="pseudo">Votre pseudo</label>
            <input type="text" name="pseudo" id="pseudo">
            <br><br>
            <label for="couleur">Choisissez une couleur</label>
            <input type="color" name="couleur" id="couleur">
            <br><br>
            <button type="submit">Valider</button>
        </form>

        <p>
            <?php
            if (!empty($_POST['pseudo'])) {
                $pseudo = htmlspecialchars($_POST['pseudo']);
                echo $pseudo;
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 4</h2>
        <form action="index.php" method="POST">
            <label for="de">Nombre de dés (multiple de 6)</label>
            <input type="number" name="de" id="de">
            <br><br>
            <button type="submit">Lancer les dés</button>
        </form>

        <p>
            <?php
            if (!empty($_POST['de'])) {
                $nombreDes = $_POST['de'];

                if ($nombreDes % 6 != 0) {
                    header("Location: index.php?erreur=invalide");
                    exit();
                }
            }

            if (!empty($_GET['erreur'])) {
                $erreur = htmlspecialchars($_GET['erreur']);
                echo $erreur;
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 5</h2>
        <form action="index.php" method="POST">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" id="username">
            <br><br>
            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
            <br><br>
            <button type="submit">Se connecter</button>
        </form>

        <p>
            <?php
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $passwordCrypte = password_hash('1234', PASSWORD_DEFAULT);

                if ($username == 'admin' && password_verify($password, $passwordCrypte)) {
                    header("Location: bienvenue.php");
                    exit();
                } else {
                    echo "Nom d'utilisateur ou mot de passe incorrect";
                }
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 6</h2>
        <form action="index.php" method="POST">
            <label for="nombre1">Nombre 1</label>
            <input type="number" name="nombre1" id="nombre1">
            <br><br>
            <label for="nombre2">Nombre 2</label>
            <input type="number" name="nombre2" id="nombre2">
            <br><br>
            <label for="operation">Opération</label>
            <select name="operation" id="operation">
                <option value="addition">Addition</option>
                <option value="soustraction">Soustraction</option>
                <option value="multiplication">Multiplication</option>
                <option value="division">Division</option>
            </select>
            <br><br>
            <button type="submit">Calculer</button>
        </form>

        <p>
            <?php
            if (!empty($_POST['nombre1']) && !empty($_POST['nombre2']) && !empty($_POST['operation'])) {
                $nombre1 = $_POST['nombre1'];
                $nombre2 = $_POST['nombre2'];
                $operation = $_POST['operation'];

                if ($operation == 'addition') {
                    echo $nombre1 + $nombre2;
                } elseif ($operation == 'soustraction') {
                    echo $nombre1 - $nombre2;
                } elseif ($operation == 'multiplication') {
                    echo $nombre1 * $nombre2;
                } elseif ($operation == 'division') {
                    echo $nombre1 / $nombre2;
                }
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 7</h2>
        <form action="index.php" method="POST">
            <label for="montant">Montant en euros</label>
            <input type="number" name="montant" id="montant">
            <br><br>
            <label for="devise">Devise</label>
            <select name="devise" id="devise">
                <option value="dollar">Dollar</option>
                <option value="livre">Livre</option>
                <option value="yen">Yen</option>
            </select>
            <br><br>
            <button type="submit">Convertir</button>
        </form>

        <p>
            <?php
            if (!empty($_POST['montant']) && !empty($_POST['devise'])) {
                $montant = $_POST['montant'];
                $devise = $_POST['devise'];

                if ($devise == 'dollar') {
                    echo $montant * 1.1;
                } elseif ($devise == 'livre') {
                    echo $montant * 0.85;
                } elseif ($devise == 'yen') {
                    echo $montant * 150;
                }
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 8</h2>
        <form action="index.php" method="POST">
            <p>Question 1 : Quelle est la capitale de la France ?</p>
            <input type="radio" name="question1" value="Paris" id="q1r1">
            <label for="q1r1">Paris</label><br>
            <input type="radio" name="question1" value="Lyon" id="q1r2">
            <label for="q1r2">Lyon</label><br>
            <input type="radio" name="question1" value="Marseille" id="q1r3">
            <label for="q1r3">Marseille</label><br>
            <input type="radio" name="question1" value="Bordeaux" id="q1r4">
            <label for="q1r4">Bordeaux</label><br>

            <p>Question 2 : Combien font 2 + 2 ?</p>
            <input type="radio" name="question2" value="3" id="q2r1">
            <label for="q2r1">3</label><br>
            <input type="radio" name="question2" value="4" id="q2r2">
            <label for="q2r2">4</label><br>
            <input type="radio" name="question2" value="5" id="q2r3">
            <label for="q2r3">5</label><br>
            <input type="radio" name="question2" value="6" id="q2r4">
            <label for="q2r4">6</label><br>

            <p>Question 3 : Quelle couleur obtient-on en mélangeant bleu et jaune ?</p>
            <input type="radio" name="question3" value="Rouge" id="q3r1">
            <label for="q3r1">Rouge</label><br>
            <input type="radio" name="question3" value="Vert" id="q3r2">
            <label for="q3r2">Vert</label><br>
            <input type="radio" name="question3" value="Orange" id="q3r3">
            <label for="q3r3">Orange</label><br>
            <input type="radio" name="question3" value="Violet" id="q3r4">
            <label for="q3r4">Violet</label><br>
            <br>
            <button type="submit">Valider</button>
        </form>

        <p>
            <?php
            if (!empty($_POST['question1']) && !empty($_POST['question2']) && !empty($_POST['question3'])) {
                $score = 0;

                if ($_POST['question1'] == 'Paris') {
                    $score++;
                }
                if ($_POST['question2'] == '4') {
                    $score++;
                }
                if ($_POST['question3'] == 'Vert') {
                    $score++;
                }

                echo "Votre score : " . $score . " / 3<br>";
                if ($score == 3) {
                    echo "Félicitations !";
                }
            }
            ?>
        </p>
    </section>

    <section>
        <h2>Exo 9</h2>
        <form action="index.php" method="POST">
            <label for="proposition">Devinez le nombre entre 0 et 1000</label>
            <input type="number" name="proposition" id="proposition">
            <br><br>
            <button type="submit">Valider</button>
        </form>

        <p>
            <?php
            if (!empty($_POST['proposition'])) {
                $proposition = $_POST['proposition'];
                $nombreMystere = $_SESSION['nombreMystere'];

                if ($proposition < $nombreMystere) {
                    echo "Le nombre que vous proposez est trop petit";
                } elseif ($proposition > $nombreMystere) {
                    echo "Le nombre que vous proposez est trop grand";
                } else {
                    echo "Bravo ! Vous avez trouvé le nombre : " . $nombreMystere;
                    unset($_SESSION['nombreMystere']);
                }
            }
            ?>
        </p>
    </section>

</body>

</html>