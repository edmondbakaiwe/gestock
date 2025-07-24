<?php
    include('config.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $delete = $mysqlclient -> prepare('DELETE FROM produit WHERE id = :id ');
    try {
        $delete->execute(['id'=> $id]);
        header("Location: produit.php");
        exit();
    } catch (\Exception $e) {
        die('Erreur: Echec de la suppression'.$e->getMessage());
    }
        
    
}

?>