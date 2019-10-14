<?php
$mail= $_POST['mail'];

try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
$reponse = $bdd->query("select mail from utilisateur where mail='$mail'");
       
if($reponse->rowCount() > 0){
    echo "1";
}else{
    echo "2";
}

?>