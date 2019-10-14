<?php
try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());

                }   ?> 
                
<?php

    $id=$_GET['id'];
    echo $id;
    
    if($bdd->query("UPDATE annonce SET valide='1' WHERE valide='0' AND id_annonce='$id'") == true){
        
     header('Location:consulter_nouvelle_annonce.php');   
    }

?>