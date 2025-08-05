<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['id']) || empty($_POST['nom']) || empty($_POST['description'])) {
        die("Erreur : Données incomplètes.");
    }

    $requete = 'UPDATE produit SET nom = :nom, description = :description WHERE id = :id';
    $update = $mysqlclient->prepare($requete);

    try {
        $resultat = $update->execute([
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'id' => $_POST['id']
        ]);
        $produits =$update->fetchAll(PDO::FETCH_ASSOC);
        header("Location: produit.php");
        exit();
    } catch (PDOException $e) {
        echo "Erreur PDO : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">

    <title>Modifier un produit</title>
</head>
<body>

<?php include('header.php') ?>

<form action="" method="post">
    <fieldset>
        <legend>Modifier un produit</legend>

        <input type="hidden" name="id" value="<?= isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '' ?>">

        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" required>

        <label for="description">Description :</label>
        <textarea name="description" id="description" required></textarea>

        <input type="submit" value="Modifier">
    </fieldset>
</form>

<?php include('footer.php') ?>

</body>
</html>
