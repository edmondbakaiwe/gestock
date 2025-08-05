<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == "POST" ) {
    if (isset($_FILES['nomImage']) && $_FILES['nomImage']['error'] === 0) {
        $file_basename = pathinfo($_FILES['nomImage']['name'], PATHINFO_FILENAME);
        $file_extension = pathinfo($_FILES['nomImage']['name'], PATHINFO_EXTENSION);
        $image = $file_basename .'_'. date("Ymd_His").'.'.$file_extension;

        $dossierTempo = $_FILES['nomImage']['tmp_name'];
        $dossierSite = 'images/'.$image;

        if (move_uploaded_file($dossierTempo, $dossierSite)) {
            $sql = 'INSERT INTO produit (nom, description, image) VALUES (:nom, :description, :image)';
            $req = $mysqlclient->prepare($sql);
            try {
                $req->execute([
                'nom' => $_POST['nom'],
                'description' => $_POST['description'],
                'image' => $image,
                ]);
                header("Location: dashboard.php");
            } catch (\Exception $e) {
                die('Erreur'.$e->getMessage());
            }
        } else {
            echo 'Echec0';
        }
    } else {
        echo 'Echec';
    }
}
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php') ?>

    <form action="" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajouter les produits</legend>
            <input type="hidden" name="id" value="<?= htmlspecialchars($produit['id']) ?>">

            
            <label for="nom">Nom: </label>
            <input type="text" name="nom" id="nom" required>
            
            <label for="description">Description: </label>
            <textarea name="description" id="description" required></textarea>

            <label for="upload">Entrer une image</label>
            <input type="file" name="nomImage" id="upload" required>
            <input type="submit" name="Ajouter" value="Ajouter">
        </fieldset>
    </form>

    <?php include('footer.php') ?>
</body>
</html>
