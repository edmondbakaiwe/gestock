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
    <title>Document</title>

    <style>
        /* ====== Styles généraux ====== */
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            color: #333;
            margin: 0;
        }

        /* ====== Header ====== */
        .header {
            background: #3498db;
            padding: 1rem;
        }

        .header .sidebar {
            display: flex;
            justify-content: space-between; /* menu à gauche, autre contenu à droite */
            align-items: center;
            max-width: 1200px;
            margin: auto;
        }

        .header .menu ul {
            list-style: none;
            display: flex;
            gap: 20px;
            margin: 0;
            padding: 0;
        }

        .header .menu li {
            display: inline;
        }

        .header .menu a {
            color: white;
            text-decoration: none;
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .header .menu a:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* ====== Bouton "Ajouter" ====== */
        .add {
            text-align: center;
            margin: 15px 0;
        }

        .add a {
            background: #2ecc71;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }

        .add a:hover {
            background: #27ae60;
        }

        /* ====== Tableaux ====== */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        table th {
            background: #3498db;
            color: white;
        }

        table tr:nth-child(even) {
            background: #f2f2f2;
        }

        /* ====== Boutons d'action ====== */
        .action-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
        }

        .action-buttons a {
            background: #3498db;
            color: white;
            padding: 6px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .action-buttons a:hover {
            background: #2980b9;
        }

        .action-buttons form {
            display: inline;
        }

        .action-buttons button {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .action-buttons button:hover {
            background: #c0392b;
        }
    </style>
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
                                <div class="action-buttons">
                                    <a href="modifier.php?id=<?= $produit['id'] ?>">Modifier</a>
                                    <form action="supprimer.php" method="POST">
                                        <input type="hidden" name="id" value="<?= $produit['id'] ?>">
                                        <button type="submit">Supprimer</button>
                                    </form>
                                </div>
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
