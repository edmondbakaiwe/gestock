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
    <link rel="stylesheet" href="style/style.css">

    <title>Connexion</title>
   
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
