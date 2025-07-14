<?php
session_start();
    include('config.php');
    if (isset($_SESSION['email'])) {
        header("Location: dashboard.php");
    }
    if ($_SERVER['REQUEST_METHOD']==="POST") {
        
        $email_saisi= $_POST['email'];
        $password_saisi = $_POST['password'];
        try {
            $requete = 'SELECT * FROM user WHERE email = :email';
            $afficher = $mysqlclient -> prepare($requete);
            $afficher -> execute([
                'email' => $email_saisi,
            ]);
            $user = $afficher->fetch();
           
            if ($user && password_verify($password_saisi, $user['password'])) {
                $_SESSION['email'] = $user['email'] ;
                $_SESSION['nom'] = $user['nom'];
                header("Location: dashboard.php");
                exit;
            } 
            else 
            {
                echo 'Identifiants incorrects';
            }
            } catch (Exception $e) {
                die('Erreur: Connexion Echoué'. $e->getMessage());
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
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 1rem;
            font-size: 1.8rem;
        }

        form {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 350px;
        }

        label {
            display: block;
            margin-top: 1rem;
            margin-bottom: 0.25rem;
            font-weight: bold;
            color: #555;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input[type="submit"] {
            margin-top: 1.5rem;
            width: 100%;
            padding: 0.7rem;
            background-color: #3498db;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #2980b9;
        }

        p {
            margin-top: 1rem;
            font-size: 0.95rem;
            color: #333;
            text-align: center;
        }

        a {
            color: #3498db;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Connecte-toi !</h1>

    <form action="" method="post">
        <label for="email">Email :</label>
        <input type="email" name="email" id="" required>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="" required>

        <input type="submit" value="Se connecter">
    </form>

    <p>Pas encore inscrit ? <a href="signup.php">Inscrivez-vous</a></p>

</body>
</html>
