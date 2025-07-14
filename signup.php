<?php
    include('config.php');
    if ($_SERVER['REQUEST_METHOD']=== "POST") {
        // Requete pour verifier si l'utilisateur n'existe pas encore
        $requete_existance = 'SELECT * FROM user WHERE (email) VALUES (:email)';
        $verif = $mysqlclient->prepare($requete_existance);

        $requete = 'INSERT INTO user (nom, email, telephone, password) VALUES (:nom, :email, :telephone, :password) ';
        $register = $mysqlclient->prepare($requete);
        $nom = htmlspecialchars(trim($_POST['nom']));
        $email = htmlspecialchars(trim($_POST['email']));
        $telephone = htmlspecialchars(trim($_POST['telephone']));
        $password = $_POST['password'];
        $password_haché = password_hash($password, PASSWORD_DEFAULT);
        try {
            $verif = $requete_exe->execute([
                'email'=> $email
            ]);

            if ($verif -> rowCount()>0) {
                echo 'Email existant';
            }
            else
            {
                $resultat = $register -> execute([
                    'nom'=> $nom,
                    'email'=> $email,
                    'telephone'=> $telephone,
                    'password'=> $password_haché,
                ]);
                if ($resultat) {
                header("Location: index.php");
                exit;
            }
            }
            
        } catch (Exception $e) {
            die('Erreur: Inscription echoué'. $e->getMessage());
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
    <style>
        body {
            background-color: #f0f4f8;
            font-family: Arial, sans-serif;
            color: #333;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 1rem;
        }

        h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 1rem;
            text-align: center;
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
            font-size: 0.9rem;
            color: #555;
        }

        input[type="text"],
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
            background-color: #4caf50;
            border: none;
            color: white;
            font-size: 1rem;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0aee8fff;
        }
        p{
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Inscrivez-vous en remplissant ce formulaire</h1>
    <div>
        <form action="" method="post">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom">

            <label for="email">Email :</label>
            <input type="email" name="email" id="email">

            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone" id="telephone">

            <label for="password">Mot de Passe :</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="S'inscrire">
        </form>
        <p>Déjà inscrit ? <a href="login.php">Connectez vous</a></p>
    </div>
    
</body>
</html>
