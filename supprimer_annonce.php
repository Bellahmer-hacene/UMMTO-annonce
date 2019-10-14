<?php
session_start();
if(empty($_SESSION['admin'])){
    header('Location: connexion_admin.php');
} ?>

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
    
    $reponse1=$bdd->query("SELECT id_information FROM information WHERE id_annonce='$id'");
       $a=0;
        echo $a;
    $ida=0;
    while( $line2 = $reponse1->fetch()){
         $ida=$line2['id_information']; 
        $a=1;
        }
    echo $ida;
    echo $a;
    
    
    
   $bdd->query("DELETE FROM photo WHERE id_annonce='$id'"); 
       
    
    $supp3=$bdd->query("DELETE FROM telephone WHERE id_information='$ida'");

    $bdd->query("DELETE FROM mail WHERE id_information='$ida'");
       
    $bdd->query("DELETE FROM site WHERE id_information='$ida'"); 
    

    $bdd->query("DELETE FROM formation WHERE id_annonce='$id'"); 
        
    $bdd->query("DELETE FROM logement WHERE id_annonce='$id'");

    $bdd->query("DELETE FROM travail WHERE id_annonce='$id'");
       
    
    $bdd->query("DELETE FROM sortie WHERE id_annonce='$id'");

    $bdd->query("DELETE FROM evenement WHERE id_annonce='$id'"); 
   
     echo 'reussie';
    
    
    
    if($a == 1){
    $supp1=$bdd->query("DELETE FROM information WHERE id_annonce='$id'");
    }
    
    $supp=$bdd->query("DELETE FROM annonce WHERE id_annonce='$id'");

     header('Location: consulter_annonce.php'); 
?>
