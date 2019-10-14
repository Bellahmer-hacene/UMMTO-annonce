<?php
$pseudo= $_POST['pseudo'];

try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
$reponse = $bdd->query("select pseudo from utilisateur where pseudo='$pseudo'");
       
if($reponse->rowCount() > 0){
    echo "1";
}else{
    echo "2";
}

?>