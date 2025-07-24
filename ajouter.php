<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $requete = 'INSERT INTO produit (nom, description) VALUES (:nom, :description)';
    $add = $mysqlclient->prepare($requete);
    
    try {
        $resultat = $add->execute([
            'nom' => $_POST['nom'],
            'description' => $_POST['description']
        ]);
        
        if ($resultat) {
            echo "Produit ajouté avec succès.";
        } else {
            echo "Erreur lors de l'ajout du produit.";
        }
    } catch (PDOException $e) {
        echo "Erreur: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/ajouter.css">
    <title>Ajouter un produit</title>
</head>
<body>
    <?php include('header.php') ?>

    <form action="" method="post">
        <fieldset>
            <legend>Ajouter les produits</legend>
            <input type="hidden" name="id" value="<?= htmlspecialchars($produit['id']) ?>">

            
            <label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" required>
            
            <label for="description">Description: </label>
            <textarea name="description" id="description" required></textarea>
            
            <input type="submit" value="Ajouter">
        </fieldset>
    </form>

    <?php include('footer.php') ?>
</body>
</html>
