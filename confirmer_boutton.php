<?php
try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());

                }   ?> 

<!DOCTYPE html>
<html>
<head>
	<title>Espace étudiant</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="auth.css">
</head>
<body>
	<header>
    </header>
    
    
    <div id='auth'>     // Page detaillé pour confirmation.
        
        <input type="button" value='Confirmer' name="boutton" onclick="document.location.href='confirmer.php?id=120'">
        // X c'est l'id de l'annonce recuperé 
    </div>
    
    </body>
    </html>