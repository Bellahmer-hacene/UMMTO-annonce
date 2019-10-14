<?php

if(!empty($_POST['pseudo']) && !empty($_POST['passwor'])){
   
    $pseudo=htmlspecialchars(addslashes($_POST['pseudo']));
    $passwor=htmlspecialchars(addslashes($_POST['passwor']));    
       try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
        //verifier que le login et le mot de passe sont corrects
        $reponse = $bdd->query("SELECT * FROM utilisateur WHERE pseudo='$pseudo' or mail='$pseudo'  ");
        $row = $reponse->fetch();
        if($reponse->rowCount() == 1){
            if(crypt($passwor ,$row['password']) == $row['password'])
            {    echo "5";
            }else{
                echo"1";
                 }}else{
                    echo"2";
                       }}  
   



?>