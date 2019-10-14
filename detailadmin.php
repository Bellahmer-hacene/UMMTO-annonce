<?php 
session_start();
if(isset($_SESSION['id'])){
   $existe=1;
}
?>

<?php
try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());

                }   

$id="";

if (isset($_GET['id'])){
                
                $id=$_GET['id'];}

?> 




    <html>
<head>
    
    <meta charset="utf-8">
<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">


	<title>Detail administrateur-UMMTO annonce</title>
	<link rel="stylesheet" type="text/css" href="css2/detailadmin.css">
</head>

<body>
 <header>
     



   
    
    <div id="logo">
    <a title="Acceuil-UMMTO annonces" style="float:left;padding:0;margin-top:0;background-color:white;" href="index.php">
			<img src="newlogo.png" alt="">
        </a>
		</div>
       
        
             <div id ="menu ">    
        
            <a title="Deconnexion" style="font-size:2em"  href="deconnexion.php"><i class="fas fa-sign-out-alt"></i></a>
             <a href="consulter_annonce.php">Annonces sur le site </a>
            <a href="consulter_nouvelle_annonce.php">Nouvelles annonces</a>

</div> 


	</header>
           
  
              <div id= "info">   
              <div id ="desc">  
                  
                <?php
    
            $reponse = $bdd->query("SELECT titre FROM annonce WHERE id_annonce='$id'");
            $donnees = $reponse->fetch();

            $reponse2 = $bdd->query("SELECT description FROM annonce WHERE id_annonce='$id'");
            $donnees2 = $reponse2->fetch();

                      
            ?>
                  
            <h2><?php echo  $donnees['titre'];  ?> </h2>  

              <p style="word-wrap:break-word"> <?php echo  $donnees2['description'] ; ?> </p>    
                     </div> 
       
                 
            <?php

                    $cat1=$bdd->query("SELECT COUNT(id_formation) AS nbr FROM formation WHERE formation.id_annonce ='$id'");
                $tac1=$cat1->fetch();
                
                if($tac1['nbr']>0){
                    
      $repFormation= $bdd->query("SELECT type_formation,date_debut,adresse,prix,etablissement FROM formation,annonce WHERE annonce.id_annonce=formation.id_annonce AND annonce.id_annonce='$id'");
            $donFormation = $repFormation->fetch();
            
                ?>
                     </br>
                  
                     
                 <table>
                   <caption>Informations supplémentaires</caption>

                 <tr> </tr>
                  <tr>
                      <th><i class="fas fa-map-marker-alt"></i>Filière:</th>
                      <td><?php echo $donFormation['type_formation'];  ?></td>
                      <th><i class="far fa-calendar-alt"></i>Date : </th>
                      <td><?php echo $donFormation['date_debut'];  ?></td>                          
                  </tr>
                    <tr>
                     <th><i class="fas fa-map-marker-alt"></i>Adresse:</th>
                      <td><?php echo $donFormation['adresse'];  ?></td>
                    <th><i class="far fa-building"></i>Etablissement:</th>
                      <td><?php echo $donFormation['etablissement'];  ?></td>
                     </tr>    
                        
                    <?php 
                    
$testtel = $bdd->query("SELECT tel AS nbrt FROM information,annonce,telephone WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = telephone.id_information ");
            $settel=$testtel->fetch();
        
$testmail = $bdd->query("SELECT mail AS nbrm FROM information,annonce,mail WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = mail.id_information ");
            $setmail=$testmail->fetch();

$tesite = $bdd->query("SELECT nom_site AS nbrs FROM information,annonce,site WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = site.id_information ");
            $setsite=$tesite->fetch();

            
    if($settel['nbrt']!=0 && !empty($setmail['nbrm']) && !empty($setsite['nbrs'])){
        
        $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    <tr>
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                    
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     </tr> 
                    <?php
$site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
        
        
  <?php  }else{ if($settel['nbrt']!=0 && !empty($setmail['nbrm'])){ 
        
    $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                      <tr>
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                   
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                  
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    </tr>
        
  <?php  }else{ if($settel['nbrt']!=0 &&  !empty($setsite['nbrs'])){    

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    <tr>
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    
            <?php
                $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
 
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>

                
 
<?php }else{if( !empty($setsite['nbrs']) && !empty($setmail['nbrm'])){
 
        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                   
    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                   
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
                      
                     </div>
                     
        <?php }else{ if( !empty($setmail['nbrm'])){

        $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                    <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
<?php }else{ if( !empty($setsite['nbrs'])){

        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
<?php }else{ if($settel['nbrt']!=0){ 

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); 

?>                   <tr>
                      <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    </tr>
        
        
<?php    } ?>
                     
                     <?php } } }}}}
                
                ?>
                </table>
                
                <?php }

        $cat4=$bdd->query("SELECT COUNT( id_evenement ) AS nbr FROM evenement WHERE evenement.id_annonce ='$id'");
                $tac4=$cat4->fetch();
                if($tac4['nbr']>0){
                    $repEve= $bdd->query("SELECT etablissement,type_evenement,date_debut,adresse,organisateur,horaire,etablissement FROM evenement,annonce WHERE     annonce.id_annonce=evenement.id_annonce AND annonce.id_annonce='$id'");
                    $donEve = $repEve->fetch();   
                ?>
            
            <table>
                   <caption>Informations supplémentaires</caption>

                 <tr> </tr>
                  <tr>
                      <th><i class="type"></i>Type d'événement: </th>
                      <td><?php echo $donEve['type_evenement']; ?></td>   
                       <th><i class="far fa-calendar-alt"></i>Date : </th>
                      <td><?php echo $donEve['date_debut']; ?></td>
                       
                  </tr>
                     <th><i class="fas fa-map-marker-alt"></i>Adresse:</th>
                      <td><?php echo $donEve['adresse']; ?></td>
                    <th><i class="org"></i>Organisateur: </th>
                      <td><?php echo $donEve['organisateur']; ?></td>
                  <tr>
                      
                  </tr>
                  <tr>
                        <th><i class="far fa-clock"></i>Horaire: </th>
                      <td><?php echo $donEve['horaire']; ?></td>
                   <th><i class="far fa-building"></i>Etablissement:</th>
                      <td><?php echo $donEve['etablissement'];  ?></td>
                     </tr>   
                    
                        
                        
                    <?php 
                    
$testtel = $bdd->query("SELECT tel AS nbrt FROM information,annonce,telephone WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = telephone.id_information ");
            $settel=$testtel->fetch();
        
$testmail = $bdd->query("SELECT mail AS nbrm FROM information,annonce,mail WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = mail.id_information ");
            $setmail=$testmail->fetch();

$tesite = $bdd->query("SELECT nom_site AS nbrs FROM information,annonce,site WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = site.id_information ");
            $setsite=$tesite->fetch();

            
    if($settel['nbrt']!=0 && !empty($setmail['nbrm']) && !empty($setsite['nbrs'])){
        
        $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    <tr>
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                    
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     </tr> 
                    <?php
$site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
        
        
  <?php  }else{ if($settel['nbrt']!=0 && !empty($setmail['nbrm'])){ 
        
    $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                      <tr>
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                   
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                  
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    </tr>
        
  <?php  }else{ if($settel['nbrt']!=0 &&  !empty($setsite['nbrs'])){    

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    <tr>
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    
            <?php
                $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
 
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>

                
 
<?php }else{if( !empty($setsite['nbrs']) && !empty($setmail['nbrm'])){
 
        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                   
    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                   
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
                      
                     </div>
                     
        <?php }else{ if( !empty($setmail['nbrm'])){

        $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                    <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
<?php }else{ if( !empty($setsite['nbrs'])){

        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
<?php }else{ if($settel['nbrt']!=0){ 

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); 

?>                   <tr>
                      <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    </tr>
        
        
<?php    } ?>
                     
                     <?php } } }}}}
                
                ?>
                </table>
      <?php          } 

            $cat2=$bdd->query("SELECT COUNT( id_logement ) AS nbr FROM logement WHERE logement.id_annonce ='$id'");
                $tac2=$cat2->fetch();
                if($tac2['nbr']>0){ 
                
                
                
                $repLogement= $bdd->query("SELECT type,type_logement,surface,adresse,loyer FROM logement,annonce WHERE annonce.id_annonce=logement.id_annonce AND annonce.id_annonce='$id'");
                $donLogement = $repLogement->fetch(); ?>
                 
                        <table>
                   <caption>Informations supplémentaires</caption>

                 <tr> </tr>
                  <tr>
                      <th><i class="type"></i>Type: </th>
                      <td><?php echo $donLogement['type']; ?></td> 
                      <th><i class="fas fa-home"></i>Type de logement: </th>
                      <td><?php echo $donLogement['type_logement']; ?></td>
                
                  </tr>
                    <th><i class="fas fa-arrows-alt"></i>Surface:</th>
                      <td><?php echo $donLogement['surface']; ?> m²</td>
                      <th><i class="fas fa-money-bill"></i> Loyer: </th>
                    <td><?php echo $donLogement['loyer']; ?> DZD</td>
                  <tr>
                      
                  </tr>
                  <tr>
                     <th><i class="fas fa-map-marker-alt"></i>Adresse:</th>
                      <td><?php echo $donLogement['adresse']; ?></td>  
                      
                      
                <?php 
                    
$testtel = $bdd->query("SELECT tel AS nbrt FROM information,annonce,telephone WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = telephone.id_information ");
            $settel=$testtel->fetch();
        
$testmail = $bdd->query("SELECT mail AS nbrm FROM information,annonce,mail WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = mail.id_information ");
            $setmail=$testmail->fetch();

$tesite = $bdd->query("SELECT nom_site AS nbrs FROM information,annonce,site WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = site.id_information ");
            $setsite=$tesite->fetch();

            
    if($settel['nbrt']!=0 && !empty($setmail['nbrm']) && !empty($setsite['nbrs'])){
        
        $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                        </tr>
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                      <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    <?php
$site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                   
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
        
        
  <?php  }else{ if($settel['nbrt']!=0 && !empty($setmail['nbrm'])){ 
        
    $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                      
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                        </tr>                  
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                  <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    </tr>
        
  <?php  }else{ if($settel['nbrt']!=0 &&  !empty($setsite['nbrs'])){    

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
    </tr>
            <?php
                $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>

                
 
<?php }else{if( !empty($setsite['nbrs']) && !empty($setmail['nbrm'])){
 
        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
</tr>
    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                   <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
                      
                     </div>
                     
        <?php }else{ if( !empty($setmail['nbrm'])){

        $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                    
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
<?php }else{ if( !empty($setsite['nbrs'])){

        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
<?php }else{ if($settel['nbrt']!=0){ 

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); 

?>                   
                      <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    </tr>
        
        
<?php    } ?>
                     
                     <?php } } }}}}
                
                ?>
                </table>
<?php  }
    
$cat3=$bdd->query("SELECT COUNT( id_travail ) AS nbr FROM travail WHERE travail.id_annonce ='$id'");
                $tac3=$cat3->fetch();
                if($tac3['nbr']>0){
$repTravail= $bdd->query("SELECT type_travail,etablissement,adresse,salaire,domaine FROM travail,annonce WHERE annonce.id_annonce=travail.id_annonce AND annonce.id_annonce='$id'");
$donTravail = $repTravail->fetch(); ?>
                    
                    <table>
                   <caption>Informations supplémentaires</caption>

                 <tr> </tr>
                  <tr>
                      <th><i class="fas fa-briefcase"></i>Type de travail: </th>
                      <td><?php echo $donTravail['type_travail']; ?></td>   
                       <th><i class="far fa-building"></i>Etablissement:</th>
                      <td><?php echo $donTravail['etablissement']; ?></td>
                       
                  </tr>
                     <th><i class="fas fa-map-marker-alt"></i>Adresse:</th>
                      <td><?php echo $donTravail['adresse']; ?></td>
                      <th><i class="fas fa-money-bill"></i> Salaire: </th>
                    <td><?php echo $donTravail['salaire']; ?> DZD</td>
                  <tr>
                      
                  </tr>
                  <tr>
                      <th><i class="fas fa-graduation-cap"></i>Domaine: </th>
                      <td><?php echo $donTravail['domaine']; ?></td>
                      

        
                  <?php 
                    
$testtel = $bdd->query("SELECT tel AS nbrt FROM information,annonce,telephone WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = telephone.id_information ");
            $settel=$testtel->fetch();
        
$testmail = $bdd->query("SELECT mail AS nbrm FROM information,annonce,mail WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = mail.id_information ");
            $setmail=$testmail->fetch();

$tesite = $bdd->query("SELECT nom_site AS nbrs FROM information,annonce,site WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = site.id_information ");
            $setsite=$tesite->fetch();

            
    if($settel['nbrt']!=0 && !empty($setmail['nbrm']) && !empty($setsite['nbrs'])){
        
        $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                        </tr>
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                      <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    <?php
$site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                   
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
        
        
  <?php  }else{ if($settel['nbrt']!=0 && !empty($setmail['nbrm'])){ 
        
    $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                      
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                        </tr>                  
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                  <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    </tr>
        
  <?php  }else{ if($settel['nbrt']!=0 &&  !empty($setsite['nbrs'])){    

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    </tr>
            <?php
                $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>

                
 
<?php }else{if( !empty($setsite['nbrs']) && !empty($setmail['nbrm'])){
 
        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
</tr>
    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                   <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
                      
                     </div>
                     
        <?php }else{ if( !empty($setmail['nbrm'])){

        $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                    
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
<?php }else{ if( !empty($setsite['nbrs'])){

        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
<?php }else{ if($settel['nbrt']!=0){ 

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); 

?>                   
                      <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    </tr>
        
        
<?php    } ?>
                     
                     <?php } } }}}}
                
                ?>
                </table>
                
                <?php }

        

 
                $cat5=$bdd->query("SELECT COUNT( id_sortie ) AS nbr FROM sortie WHERE sortie.id_annonce ='$id'");
                $tac5=$cat5->fetch();
                if($tac5['nbr']>0){

                    $repSortie= $bdd->query("SELECT date_debut,adresse_depart,adresse_arrive,horaire,prix FROM sortie,annonce WHERE annonce.id_annonce=sortie.id_annonce AND annonce.id_annonce='$id'");

                    $donSortie = $repSortie->fetch(); ?>
                
               <table>
                   <caption>Informations supplémentaires</caption>

                 <tr> </tr>
                  <tr>  
                       <th><i class="far fa-calendar-alt"></i>Date de début : </th>
                      <td><?php echo $donSortie['date_debut']; ?></td>
                      <th><i class="fas fa-map-marker-alt"></i>Adresse de départ:</th>
                      <td><?php echo $donSortie['adresse_depart']; ?></td>
                  </tr>
                           
                    
                  <tr>
                      <th><i class="fas fa-map-marker-alt"></i>Adresse d'arrivée:</th>
                      <td><?php echo $donSortie['adresse_arrive']; ?></td>
                        <th><i class="far fa-clock"></i>Horaire: </th>
                      <td><?php echo $donSortie['horaire']; ?></td>
                    </tr>     
                   
                <tr>
                   <th><i class="fas fa-money-bill"></i> Prix: </th> 
                   <td><?php echo $donSortie['prix'];  ?> DZD</td>
                
                  <?php 
                    
$testtel = $bdd->query("SELECT tel AS nbrt FROM information,annonce,telephone WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = telephone.id_information ");
            $settel=$testtel->fetch();
        
$testmail = $bdd->query("SELECT mail AS nbrm FROM information,annonce,mail WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = mail.id_information ");
            $setmail=$testmail->fetch();

$tesite = $bdd->query("SELECT nom_site AS nbrs FROM information,annonce,site WHERE annonce.id_annonce ='$id'AND annonce.id_annonce = information.id_annonce AND information.id_information = site.id_information ");
            $setsite=$tesite->fetch();

            
    if($settel['nbrt']!=0 && !empty($setmail['nbrm']) && !empty($setsite['nbrs'])){
        
        $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                        </tr>
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                      <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    <?php
$site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                   
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
        
        
  <?php  }else{ if($settel['nbrt']!=0 && !empty($setmail['nbrm'])){ 
        
    $tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                      
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                        </tr>                  
                    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                  <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                     
                    </tr>
        
  <?php  }else{ if($settel['nbrt']!=0 &&  !empty($setsite['nbrs'])){    

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); ?>
                    
                    <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
    </tr>
            <?php
                $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     <tr>
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>

                
 
<?php }else{if( !empty($setsite['nbrs']) && !empty($setmail['nbrm'])){
 
        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                     
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
</tr>
    <?php
 $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                   <tr>
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
                      
                     </div>
                     
        <?php }else{ if( !empty($setmail['nbrm'])){

        $mail=$bdd->query("SELECT mail
FROM mail, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = mail.id_information");
            
        $laim=$mail->fetch(); ?>
                    
                    <th><i class="far fa-envelope"></i>Mail:</th>
                    <td><?php echo $laim['mail'];   ?></td>
                    </tr>
<?php }else{ if( !empty($setsite['nbrs'])){

        $site=$bdd->query("SELECT nom_site
FROM site, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = site.id_information");
            
        $tise=$site->fetch(); ?>
                    
                     <th><i class="fas fa-link"></i>Site:</th>
                      <td><a href="<?php echo $tise['nom_site']; ?>"><?php echo $tise['nom_site']; ?></a></td>
                     </tr>
<?php }else{ if($settel['nbrt']!=0){ 

$tel=$bdd->query("SELECT tel
FROM telephone, information, annonce
WHERE annonce.id_annonce ='$id'
AND annonce.id_annonce = information.id_annonce
AND information.id_information = telephone.id_information");
            
        $let=$tel->fetch(); 

?>                   
                      <th><i class="fas fa-phone"></i>Tél:</th>
                      <td>0<?php echo $let['tel'];  ?></td>
                    </tr>
        
        
<?php    } ?>
                     
                     <?php } } }}}}
                
                ?>
                </table>
                      

<?php  } ?>

<?php

            $tas=$bdd->query("SELECT COUNT(id_photo) AS nbre FROM photo WHERE photo.id_annonce='$id'");
                $sat=$tas->fetch();

            if($sat['nbre']==1){
            
            $reponse3 = $bdd->query("SELECT photo FROM annonce,photo WHERE annonce.id_annonce=photo.id_annonce AND annonce.id_annonce='$id' ") ; 
            $donnees3 = $reponse3->fetch();

?>
                  
                  <div class="slideshow-container">

            <div class="mySlides fade">
  <img src="image/<?php  echo $donnees3['photo']; ?>" style="width: 900px;
    height: 500px ; ">
            </div>

                    </div> 
<?php } ?>

        <?php
                if($sat['nbre']==2){
            
            $reponse3 = $bdd->query("SELECT photo FROM annonce,photo WHERE annonce.id_annonce=photo.id_annonce AND annonce.id_annonce='$id' ") ; 
            $donnees3 = $reponse3->fetch(); ?>
                
<div class="slideshow-container">

                <div class="mySlides fade">
  <img src="image/<?php  echo $donnees3['photo']; ?>" style="width: 900px;
    height: 500px ; ">
                </div>
                <?php    $donnees4 = $reponse3->fetch(); 
                   
                ?>
                <div class="mySlides fade">
  <img src="image/<?php  echo $donnees4['photo']; ?>" style="width: 900px;
    height: 500px ;">
                </div>



<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div> 
<?php } ?>


<?php
                if($sat['nbre']==3){
            
            $reponse3 = $bdd->query("SELECT photo FROM annonce,photo WHERE annonce.id_annonce=photo.id_annonce AND annonce.id_annonce='$id' ") ; 
            $donnees3 = $reponse3->fetch(); ?>
                
<div class="slideshow-container">

                <div class="mySlides fade">
  <img src="image/<?php  echo $donnees3['photo']; ?>" style="width: 900px;
    height: 500px ; ">
                </div>
                <?php    $donnees4 = $reponse3->fetch();                 ?>
                <div class="mySlides fade">
  <img src="image/<?php  echo $donnees4['photo']; ?>" style="width: 900px;
    height: 500px ;">
                </div>
                <?php    $donnees5 = $reponse3->fetch(); ?>
                <div class="mySlides fade">
    <img src="image/<?php  echo $donnees4['photo']; ?>" style="width: 900px;
    height: 500px ;">
                </div>
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div> 
<?php } ?>

<?php
                if($sat['nbre']==4){
            
                $reponse3 = $bdd->query("SELECT photo FROM annonce,photo WHERE annonce.id_annonce=photo.id_annonce AND annonce.id_annonce='$id' ") ; 
                $donnees3 = $reponse3->fetch(); ?>
                
<div class="slideshow-container">

                <div class="mySlides fade">
  <img src="image/<?php  echo $donnees3['photo']; ?>" style="width: 900px;
    height: 500px ; ">
                </div>
                <?php    $donnees4 = $reponse3->fetch();                 ?>
                <div class="mySlides fade">
  <img src="image/<?php  echo $donnees4['photo']; ?>" style="width: 900px;
    height: 500px ;">
                </div>
                <?php    $donnees5 = $reponse3->fetch(); ?>
                <div class="mySlides fade">
    <img src="image/<?php  echo $donnees5['photo']; ?>" style="width: 900px;
    height: 500px ;">
                </div>
                <?php    $donnees6 = $reponse3->fetch(); ?>
                <div class="mySlides fade">
    <img src="image/<?php  echo $donnees6['photo']; ?>" style="width: 900px;
    height: 500px ;">
                </div>

<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

</div> 
<?php } ?>
                  
                  
<br>
<div class ="consup" style="margin-left : 35% ;" > 
   <input type="button" style ="background-color : #75B44B;  border-radius: 4px;
    font-size: 15px;
    padding: 8px 24px;
    margin-right: 10px;
    margin-bottom: 5px;
    border: 0px;
    cursor:pointer;                                                          
    color: white;" value='Confirmer' name="boutton" onclick="document.location.href='confirmer.php?id=<?php echo $id; ?>'">
   
   
   <input type="button" style ="background-color : #EE4957 ;  border-radius: 4px;
    font-size: 15px;
    padding: 8px 24px;
    margin-right: 10px;
    margin-bottom: 5px;
    border: 0px;
    cursor:pointer;                                                          
    color: white; " value='Supprimer' name="boutton" onclick="document.location.href='supprimer_annonce_nouvelle.php?id=<?php echo $id; ?>'">

  

    </div>
    <footer>
        
    </footer>
    
<script>
     
 var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
} 
     </script>
           
           

</body>
    </html>

    