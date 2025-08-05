<?php
    include('config.php');
    if ($_SERVER['REQUEST_METHOD']=== "POST") {
        // Requete pour verifier si l'utilisateur n'existe pas encore
        $search_email = 'SELECT * FROM user WHERE email=:email';
        $requete_exe = $mysqlclient->prepare($search_email);


        $requete = 'INSERT INTO user (nom, email, telephone, password) VALUES (:nom, :email, :telephone, :password) ';
        $register = $mysqlclient->prepare($requete);
        $nom = htmlspecialchars(trim($_POST['nom']));
        $email = htmlspecialchars(trim($_POST['email']));
        $telephone = htmlspecialchars(trim($_POST['telephone']));
        $password = $_POST['password'];
        $password_haché = password_hash($password, PASSWORD_DEFAULT);
        try {
            $requete_exe->execute([
                'email'=> $email
            ]);

            if ($requete_exe -> rowCount()>0) {
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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'inscription</title>
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
            max-width: 450px;
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

        input[type="text"],
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

    <h1>Inscrivez-vous en remplissant ce formulaire</h1>

    <div class="form-container">
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
        <p>Déjà inscrit ? <a href="login.php">Connectez-vous</a></p>
    </div>

</body>
</html>

