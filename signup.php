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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Formulaire d'inscription</title>
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
