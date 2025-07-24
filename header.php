<?php
session_start();
include('config.php');
// if ($_SERVER['REQUEST_METHOD']=== "POST") {
//      $_SESSION = [];
//     session_destroy();

//     header("Location: index.php");
//     exit;
// }


?>

<div class="header">
            <div class="sidebar">
                <div class="menu">
                    <ul>
                        <li><a href="index.php"> Acceuil</a></li>
                        <li><a href="produit.php"> Les produits</a></li>
                    </ul>
                </div>
                <div class="log">
                    <form action="" method="post">
                        <input type="submit" value="Déconnecter" style="
                            background-color: #e74c3c;
                            color: white;
                            padding: 10px 20px;
                            border: none;
                            border-radius: 8px;
                            font-size: 16px;
                            font-weight: bold;
                            cursor: pointer;
                            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                            transition: background-color 0.3s ease, transform 0.2s ease;
                            " 
                            onmouseover="this.style.backgroundColor='#c0392b'; this.style.transform='scale(1.05)';" 
                            onmouseout="this.style.backgroundColor='#e74c3c'; this.style.transform='scale(1)';">

                    </form>
                </div>
                
            </div>
        </div>