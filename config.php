<?php

    try {
        $mysqlclient = new PDO(
        'mysql:host=localhost;dbname=gestock;charset=utf8', 'root', '');
        $mysqlclient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (Exception $e) {
        die('Erreur: '. $e ->getMessage());
    }
    
?>