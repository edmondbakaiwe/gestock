<?php
    include('config.php');
    $requete = 'SELECT * FROM produit';
    $produit = $mysqlclient -> prepare($requete);
    try {
        $product = $produit-> execute();
        $product = $produit -> fetchAll(PDO::FETCH_ASSOC);
    } catch (\Exception $e) {
        die('Erreur: Erreur lors de la recupération du produit'.$e->getMessage());
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Document</title>
</head>
<body>
    <div class="global">
         <?php include('header.php') ?>
        <div class="body">
            <section class="Acceuil">
                <h1>Bienvenue dans notre magasin</h1>
                <p>Gérer vos produits en efficacité</p>
                <a href="produit.php" class="btn-primary">Gère ton stocke combi</a>
            </section>
            <section class="produit">
                <?php foreach ($product as $produc):?>
                    <div class="display-produit">
                        <div class="image">
                            <img src="images/<?= htmlspecialchars($produc['image']) ?>" alt="" width="200">
                        </div>
                        <div class="title">
                            <p><?= htmlspecialchars($produc['nom']) ?> </p>
                        </div>
                    </div>
                <?php endforeach ;?>
            </section>
            
        </div>
        <?php include('footer.php') ?>
    </div>
</body>
</html>