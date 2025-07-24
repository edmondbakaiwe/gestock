<?php 
    include('config.php');

    $produits = [];
    if ($_SERVER['REQUEST_METHOD']==="GET") {
        $requete = 'SELECT * FROM produit';
        $show = $mysqlclient -> prepare($requete);
        try {
            $affichage = $show->execute();
            $produits = $show->fetchAll(PDO::FETCH_ASSOC);
        } catch (\Exception $e) {
            die('Erreur: Affichage echoué'.$e->getMessage());
        }

        
        
    }
    
        

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">

    <title>Document</title>
</head>
<body>
    <?php include('header.php') ?>
    <div class="produit">
        <div class="add"><a href="ajouter.php">Ajouter</a></div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Noms</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produits as $produit):?>
                        <tr>
                            <td><?= htmlspecialchars($produit['id']) ?></td>
                            <td><?= htmlspecialchars($produit['nom']) ?></td>
                            <td>
                                <a href="modifier.php?id=<?= $produit['id'] ?>">Modifier</a>
                                <a href="#">
                                    <form action="supprimer.php" method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?= $produit['id'] ?>">
                                        <button type="submit">Supprimer</button>
                                    </form>

                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="2">Total produits</th>
                        <td><?= count($produits); ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <br>
    <br>

    <br>
    <br>
    <br>

    <?php include('footer.php') ?>
</body>
</html>
