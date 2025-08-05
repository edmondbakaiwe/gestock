<?php
session_start();
include('config.php');

if (isset($_SESSION['email'])) {
    header("Location: dashboard.php");
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $email_saisi = $_POST['email'];
    $password_saisi = $_POST['password'];

    try {
        $requete = 'SELECT * FROM user WHERE email = :email';
        $afficher = $mysqlclient->prepare($requete);
        $afficher->execute(['email' => $email_saisi]);
        $user = $afficher->fetch();

        if ($user && password_verify($password_saisi, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['nom'] = $user['nom'];
            header("Location: dashboard.php");
            exit;
        } else {
            echo 'Identifiants incorrects';
        }
    } catch (Exception $e) {
        die('Erreur: Connexion Echoué' . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #6dd5fa, #2980b9);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            text-align: center;
        }

        h1 {
            color: white;
            margin-bottom: 20px;
        }

        .form-container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.8s ease-in-out;
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 1rem;
        }

        input[type="submit"] {
            width: 100%;
            background: #2980b9;
            color: white;
            padding: 10px;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        input[type="submit"]:hover {
            background: #1f6694;
        }

        p {
            margin-top: 15px;
            font-size: 0.9rem;
        }

        p a {
            color: #2980b9;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <h1>Connecte-toi !</h1>

    <div class="form-container">
        <form action="" method="post">
            <label for="email">Email :</label>
            <input type="email" name="email" required>

            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>

            <input type="submit" value="Se connecter">
        </form>
        <p>Pas encore inscrit ? <a href="signup.php">Inscrivez-vous</a></p>
    </div>

</body>
</html>
