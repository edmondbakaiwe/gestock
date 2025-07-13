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
                    <tr>
                        <td>01</td>
                        <td>Sac</td>
                        <td>
                            <a href="modifier.php?id=01">Modifier</a>
                            <a href="supprimer.php?id=01">Supprimer</a>
                        </td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>Chaussures</td>
                        <td>
                            <a href="modifier.php?id=02">Modifier</a>
                            <a href="supprimer.php?id=02">Supprimer</a>
                        </td>
                    </tr>
                    <tr>
                        <td>03</td>
                        <td>Veste</td>
                        <td>
                            <a href="modifier.php?id=03">Modifier</a>
                            <a href="supprimer.php?id=03">Supprimer</a>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th scope="row" colspan="2">Total produits</th>
                        <td>3</td>
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
