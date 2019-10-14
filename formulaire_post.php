<?php
try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());

                }   ?> 



<?php

$categorie = $titre = $domaineFor = $description = $dateFor = $etablissementFor = $adresseFor = $tel = $dateEr =$telEr = $mailEr = $siteEr = $site = $mail= "";


$type_location = $type_logement = $surfaceLog = $adresseLog = $loyerLog = $surfaceEr = $loyerEr = "";

$travailRec = $domaineRec = $etablissementRec = $adresseRec = $salaireRec = $salaireEr = "";


$dateEve = $organisateurEve = $adresseEve = "";

$prixEr = $LieuDepartDec = $dateDec = $LieuArriveeDec = $prixDec = $horaireDec ='';

$type='-1';

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    echo 'bjr';
   
    
    if( isset($_POST['categorie']) && $_POST['categorie']==="formationx" ){
        
        $type=0;
        
                $categorie=htmlspecialchars($_POST['categorie']);
                $titre=htmlspecialchars($_POST['titre']);
                $domaineFor=htmlspecialchars($_POST['domaines']);
                $description=htmlspecialchars($_POST['description']);
                $dateFor=htmlspecialchars($_POST['dateFor']);
                $etablissementFor=htmlspecialchars($_POST['etablissementFor']);
                $adresseFor=htmlspecialchars($_POST['adresseFor']);
                $tel=htmlspecialchars($_POST['tel']);
                
                echo  $dateFor ;        
        
        if ( (!empty($_POST['titre']))  && (!empty($_POST['domaines'])) && (!empty($_POST['description'])) && (!empty($_POST['dateFor'])) && (!empty($_POST['etablissementFor'])) && (!empty($_POST['adresseFor'])) && (!empty($_POST['tel'])) ){
                
                echo 'hmd';
                $errors = [];
                
                if(date('Y-m-d')>=$dateFor){
                    $dateEr= "Cette date est depassée.";
                    $errors[] = "Cette date est depassée.";             
                    }
            
                if(!preg_match('#^0[567][0-9]{8}$#',$tel)){
                    $telEr= "Numero de telephone incorrect.";
                $errors[] = "Numero de telephone incorrect.";         
                    }
                   
                $mail=$_POST['email'];
                if(!empty($mail)){
                if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $mailEr= "Adresse e-mail invalide.";
                $errors[] = "Adresse e-mail invalide.";
                    }
                }
            
                $site= $_POST['site'];
                
                if(!empty($site)){
                    
                    if (!filter_var($site, FILTER_VALIDATE_URL)) {
                        
                   
                    $siteEr= 'Cette URL est incorrect.';     
                    $errors[] = 'Cette URL est incorrect.';
                    }
                }
                        
                            if(count($errors) == 0){
                    
                            $sql="INSERT INTO annonce(id_annonce,id_utilisateur,titre,description) VALUES('','1','$titre','$description')";
                            $bdd->query($sql);    
               
                            $resultat=$bdd->query("SELECT MAX(id_annonce) as i FROM annonce ");
                            while( $line = $resultat->fetch()){
                                    $id=$line['i'];
                                }
                            echo $id;
                          
                            $sql1="INSERT INTO formation(id_formation,id_annonce,date_debut,filiere,adresse,prix)  
                            VALUES('','$id','$dateFor','$domaineFor','$adresseFor','5000.00')";              
                            $bdd->query($sql1);
                    
                            $sql2=" INSERT INTO information (id_information,id_annonce) VALUES ('','$id')";
                            $bdd->query($sql2);
                    
                            $resultat1=$bdd->query("SELECT MAX(id_information) as j FROM information ");
                            while( $line1 = $resultat1->fetch()){
                                $id1=$line1['j'];
                                }
                        
                    
                            $sql3=" INSERT INTO telephone (id_telephone,id_information,tel) VALUES('','$id1','$tel')"; 
                            $bdd->query($sql3);
                            if(isset($_POST['email'])){
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_mail,id_information,mail) VALUES('','$id1','$mail')";
                            $bdd->query($sql9);
                            }
                            if(isset($_POST['site'])){        
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_site,id_information,nom_site) VALUES('','$id1','$site')";
                            $bdd->query($sql8);
                            }
                    
                if(isset($_POST['image1'])){
                    $image1=htmlspecialchars($_POST['image1']);
                    $sql4="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image1')";
                    $bdd->query($sql4);
                }
                if(isset($_POST['image2'])){
                    $image2=htmlspecialchars($_POST['image2']);
                    $sql5="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image2')";
                    $bdd->query($sql5);
                }
                if(isset($_POST['image3'])){
                    $image3=htmlspecialchars($_POST['image3']);
                    $sql6="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image3')";
                    $bdd->query($sql6);
                }
                if(isset($_POST['image4'])){
                    $image4=htmlspecialchars($_POST['image4']);
                    $sql7="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image4')";
                    $bdd->query($sql7);
                }
               
                echo 'reussie';}else{ echo 'Erreur lors de l\'insertion';}
                              
        }else{ echo 'Veuillez Remplire tout les champs';} // Verification des champs vides
                                  
    } //Fin categorie Formation
    
    
    
    if(isset($_POST['categorie']) && $_POST['categorie']==="logement" ){
        
            $categorie=htmlspecialchars($_POST['categorie']);
                $titre=htmlspecialchars($_POST['titre']);
                $type_location=htmlspecialchars($_POST['logement']);
                $description=htmlspecialchars($_POST['description']);
                $type_logement=htmlspecialchars($_POST['typeLog']);
                $surfaceLog=htmlspecialchars($_POST['surfaceLog']);
                $adresseLog=htmlspecialchars($_POST['adresseLog']);
                $tel=htmlspecialchars($_POST['tel']);
                $loyerLog=htmlspecialchars($_POST['loyerLog']);
        
                echo $type_location;
                
                $type=2;
                
        if (!empty($_POST['titre'])  && !empty($_POST['logement']) && !empty($_POST['description']) && !empty($_POST['typeLog']) && !empty($_POST['surfaceLog']) && !empty($_POST['adresseLog']) && !empty($_POST['tel']) && !empty($_POST['loyerLog'])  ){
        
               $errors = [];
            
                if (!preg_match("#[0-9]#",$surfaceLog))  
                    { 
                    $surfaceEr='Cette surface est incorrecte.';
                    $errors[]='Erreur';
                    }
            
                if (!preg_match("#[0-9]#",$loyerLog)){
                    $loyerEr="Ce prix est invalide.";
                    $errors[]="Erreur";
                }
            
                    if(!preg_match('#^0[567][0-9]{8}$#',$tel)){
                    $telEr= "Numero de telephone incorrect.";
                $errors[] = "Numero de telephone incorrect.";         
                    }
                   
                $mail=$_POST['email'];
                if(!empty($mail)){
                if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $mailEr= "Adresse e-mail invalide.";
                $errors[] = "Adresse e-mail invalide.";
                    }
                }
            
                $site= $_POST['site'];
                
                if(!empty($site)){
                    
                    if (!filter_var($site, FILTER_VALIDATE_URL)) {
                        
                   
                    $siteEr= 'Cette URL est incorrect.';     
                    $errors[] = 'Cette URL est incorrect.';
                    }
                }
            
                        if(count($errors) == 0){
            $sql="INSERT INTO annonce(id_annonce,id_utilisateur,titre,description) VALUES('','1','$titre','$description')";
                            $bdd->query($sql);    
               
                            $resultat=$bdd->query("SELECT MAX(id_annonce) as i FROM annonce ");
                            while( $line = $resultat->fetch()){
                                    $id=$line['i'];
                                }
                            echo $id;
            
             $sql1="INSERT INTO logement(id_logement,id_annonce,type,type_logement,surface,adresse,loyer)  
                            VALUES('','$id','$type_location','$type_logement','$surfaceLog','$adresseLog','$loyerLog')";              
                            $bdd->query($sql1);
            
            
            $sql2=" INSERT INTO information (id_information,id_annonce) VALUES ('','$id')";
                            $bdd->query($sql2);
                    
                            $resultat1=$bdd->query("SELECT MAX(id_information) as j FROM information ");
                            while( $line1 = $resultat1->fetch()){
                                $id1=$line1['j'];
                                }
                        
                    
                            $sql3=" INSERT INTO telephone (id_telephone,id_information,tel) VALUES('','$id1','$tel')"; 
                            $bdd->query($sql3);
                            if(isset($_POST['email'])){
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_mail,id_information,mail) VALUES('','$id1','$mail')";
                            $bdd->query($sql9);
                            }
                            if(isset($_POST['site'])){        
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_site,id_information,nom_site) VALUES('','$id1','$site')";
                            $bdd->query($sql8);
                            }
                    
                if(isset($_POST['image1'])){
                    $image1=htmlspecialchars($_POST['image1']);
                    $sql4="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image1')";
                    $bdd->query($sql4);
                }
                if(isset($_POST['image2'])){
                    $image2=htmlspecialchars($_POST['image2']);
                    $sql5="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image2')";
                    $bdd->query($sql5);
                }
                if(isset($_POST['image3'])){
                    $image3=htmlspecialchars($_POST['image3']);
                    $sql6="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image3')";
                    $bdd->query($sql6);
                }
                if(isset($_POST['image4'])){
                    $image4=htmlspecialchars($_POST['image4']);
                    $sql7="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image4')";
                    $bdd->query($sql7);
                }
                        }else{ echo 'Erreur lors de l\'insertion';}
            
        }else { echo 'Veuillez remplir tout les champs';}
    } // Fin categorie logement
    
    if( isset($_POST['categorie']) && $_POST['categorie']==="recrutement" ){
        
                $categorie=htmlspecialchars($_POST['categorie']);
                $titre=htmlspecialchars($_POST['titre']);
                $travailRec=htmlspecialchars($_POST['travailRec']);
                $description=htmlspecialchars($_POST['description']);
                $domaineRec=htmlspecialchars($_POST['domaineRec']);
                $etablissementRec=htmlspecialchars($_POST['etablissementRec']);
                $adresseRec=htmlspecialchars($_POST['adresseRec']);
                $salaireRec=htmlspecialchars($_POST['salaireRec']);
                $tel=htmlspecialchars($_POST['tel']);
        
                $type=1;
            
        if (!empty($_POST['titre'])  && !empty($_POST['travailRec']) && !empty($_POST['description']) && !empty($_POST['domaineRec']) && !empty($_POST['etablissementRec']) && !empty($_POST['adresseRec']) && !empty($_POST['salaireRec']) && !empty($_POST['tel']) ){
        echo 'cc';
              
                $errors = [];
            
                if (!preg_match("#[0-9]#",$salaireRec)){
                    $salaireEr="Ce prix est invalide.";
                    $errors[]="Erreur";
                }
            
            
                if(!preg_match('#^0[567][0-9]{8}$#',$tel)){
                    $telEr= "Numero de telephone incorrect.";
                $errors[] = "Numero de telephone incorrect.";         
                    }
                   
                $mail=$_POST['email'];
                if(!empty($mail)){
                if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $mailEr= "Adresse e-mail invalide.";
                $errors[] = "Adresse e-mail invalide.";
                    }
                }
            
                $site= $_POST['site'];
                
                if(!empty($site)){
                    
                    if (!filter_var($site, FILTER_VALIDATE_URL)) {
                        
                   
                    $siteEr= 'Cette URL est incorrect.';     
                    $errors[] = 'Cette URL est incorrect.';
                    }
                }
            
                if(count($errors) == 0){
            
            $sql="INSERT INTO annonce(id_annonce,id_utilisateur,titre,description) VALUES('','1','$titre','$description')";
                            $bdd->query($sql);    
               
                            $resultat=$bdd->query("SELECT MAX(id_annonce) as i FROM annonce ");
                            while( $line = $resultat->fetch()){
                                    $id=$line['i'];
                                }
                            echo $id;
            
            $sql1="INSERT INTO travail(id_travail,id_annonce,type_travail,etablissement,adresse,salaire,domaine)  
                            VALUES('','$id','$travailRec','$etablissementRec','$adresseRec','$salaireRec','$domaineRec')";              
                            $bdd->query($sql1);
            
                $sql2=" INSERT INTO information (id_information,id_annonce) VALUES ('','$id')";
                            $bdd->query($sql2);
                    
                            $resultat1=$bdd->query("SELECT MAX(id_information) as j FROM information ");
                            while( $line1 = $resultat1->fetch()){
                                $id1=$line1['j'];
                                }
                        
                    
                            $sql3=" INSERT INTO telephone (id_telephone,id_information,tel) VALUES('','$id1','$tel')"; 
                            $bdd->query($sql3);
                            if(isset($_POST['email'])){
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_mail,id_information,mail) VALUES('','$id1','$mail')";
                            $bdd->query($sql9);
                            }
                            if(isset($_POST['site'])){        
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_site,id_information,nom_site) VALUES('','$id1','$site')";
                            $bdd->query($sql8);
                            }
                    
                if(isset($_POST['image1'])){
                    $image1=htmlspecialchars($_POST['image1']);
                    $sql4="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image1')";
                    $bdd->query($sql4);
                }
                if(isset($_POST['image2'])){
                    $image2=htmlspecialchars($_POST['image2']);
                    $sql5="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image2')";
                    $bdd->query($sql5);
                }
                if(isset($_POST['image3'])){
                    $image3=htmlspecialchars($_POST['image3']);
                    $sql6="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image3')";
                    $bdd->query($sql6);
                }
                if(isset($_POST['image4'])){
                    $image4=htmlspecialchars($_POST['image4']);
                    $sql7="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image4')";
                    $bdd->query($sql7);
                }
                }else { echo 'Erreur Insertion';}
        }else {echo 'Veuillez remplir tous les champs'; }
    
    }
        
         if( isset($_POST['categorie']) && $_POST['categorie']==="evenement" ){
             
                $categorie=htmlspecialchars($_POST['categorie']);
                $titre=htmlspecialchars($_POST['titre']);
                $type_eve=htmlspecialchars($_POST['type_eve']);
                $description=htmlspecialchars($_POST['description']);
                $dateEve=htmlspecialchars($_POST['dateEve']);
                $organisateurEve=htmlspecialchars($_POST['organisateurEve']);
                $adresseEve=htmlspecialchars($_POST['adresseEve']);
                $horaireEve=htmlspecialchars($_POST['horaireEve']);
                $tel=htmlspecialchars($_POST['tel']);
                
                $type=3;
        
        if (!empty($_POST['titre'])  && !empty($_POST['type_eve']) && !empty($_POST['description']) && !empty($_POST['dateEve']) && !empty($_POST['organisateurEve']) && !empty($_POST['adresseEve']) && !empty($_POST['horaireEve']) && !empty($_POST['tel'])){
        
            
            $errors = [];
                
                if(date('Y-m-d')>=$dateEve){
                    $dateEr= "Cette date est depassée.";
                    $errors[] = "Cette date est depassée.";             
                    }
            
                if(!preg_match('#^0[567][0-9]{8}$#',$tel)){
                    $telEr= "Numero de telephone incorrect.";
                $errors[] = "Numero de telephone incorrect.";         
                    }
                   
                $mail=$_POST['email'];
                if(!empty($mail)){
                if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $mailEr= "Adresse e-mail invalide.";
                $errors[] = "Adresse e-mail invalide.";
                    }
                }
            
                $site= $_POST['site'];
                
                if(!empty($site)){
                    
                    if (!filter_var($site, FILTER_VALIDATE_URL)) {
                        
                   
                    $siteEr= 'Cette URL est incorrect.';     
                    $errors[] = 'Cette URL est incorrect.';
                    }
                }
                        
                            if(count($errors) == 0){
            
            $sql="INSERT INTO annonce(id_annonce,id_utilisateur,titre,description) VALUES('','1','$titre','$description')";
                            $bdd->query($sql);    
               
                            $resultat=$bdd->query("SELECT MAX(id_annonce) as i FROM annonce ");
                            while( $line = $resultat->fetch()){
                                    $id=$line['i'];
                                }
                            echo $id;
            
            $sql1="INSERT INTO evenement(id_evenement,id_annonce,type_evenement,date_debut,adresse,organisateur,horaire)  
                            VALUES('','$id','$type_eve','$dateEve','$adresseEve','$organisateurEve','$horaireEve')";              
                            $bdd->query($sql1);
            
                $sql2=" INSERT INTO information (id_information,id_annonce) VALUES ('','$id')";
                            $bdd->query($sql2);
                    
                            $resultat1=$bdd->query("SELECT MAX(id_information) as j FROM information ");
                            while( $line1 = $resultat1->fetch()){
                                $id1=$line1['j'];
                                }
                        
                    
                            $sql3=" INSERT INTO telephone (id_telephone,id_information,tel) VALUES('','$id1','$tel')"; 
                            $bdd->query($sql3);
                            if(isset($_POST['email'])){
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_mail,id_information,mail) VALUES('','$id1','$mail')";
                            $bdd->query($sql9);
                            }
                            if(isset($_POST['site'])){        
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_site,id_information,nom_site) VALUES('','$id1','$site')";
                            $bdd->query($sql8);
                            }
                    
                if(isset($_POST['image1'])){
                    $image1=htmlspecialchars($_POST['image1']);
                    $sql4="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image1')";
                    $bdd->query($sql4);
                }
                if(isset($_POST['image2'])){
                    $image2=htmlspecialchars($_POST['image2']);
                    $sql5="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image2')";
                    $bdd->query($sql5);
                }
                if(isset($_POST['image3'])){
                    $image3=htmlspecialchars($_POST['image3']);
                    $sql6="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image3')";
                    $bdd->query($sql6);
                }
                if(isset($_POST['image4'])){
                    $image4=htmlspecialchars($_POST['image4']);
                    $sql7="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image4')";
                    $bdd->query($sql7);
                }
                            }else{echo 'Erreur insertion'; }
        }
         }
             if( isset($_POST['categorie']) && $_POST['categorie']==="decouverte" ){
                 
                $categorie=htmlspecialchars($_POST['categorie']);
                $titre=htmlspecialchars($_POST['titre']);
                $LieuDepartDec=htmlspecialchars($_POST['LieuDepartDec']);
                $description=htmlspecialchars($_POST['description']);
                $dateDec=htmlspecialchars($_POST['dateDec']);
                $LieuArriveeDec=htmlspecialchars($_POST['LieuArrivéeDec']);
                $prixDec=htmlspecialchars($_POST['prixDec']);
                $horaireDec=htmlspecialchars($_POST['horaireDec']);
                $tel=htmlspecialchars($_POST['tel']);
        
        if (isset($_POST['titre'])  && isset($_POST['dateDec']) && isset($_POST['description']) && isset($_POST['LieuDepartDec']) && isset($_POST['LieuArrivéeDec']) && isset($_POST['prixDec']) && isset($_POST['horaireDec']) && isset($_POST['tel'])){
        
                
            $errors = [];
                
                if (!preg_match("#[0-9]#",$prixDec)){
                    $prixEr="Ce prix est invalide.";
                    $errors[]="Erreur";
                }
            
                if(date('Y-m-d')>=$dateDec){
                    $dateEr= "Cette date est depassée.";
                    $errors[] = "Cette date est depassée.";             
                    }
            
                if(!preg_match('#^0[567][0-9]{8}$#',$tel)){
                    $telEr= "Numero de telephone incorrect.";
                $errors[] = "Numero de telephone incorrect.";         
                    }
                   
                $mail=$_POST['email'];
                if(!empty($mail)){
                if(!filter_var($mail,FILTER_VALIDATE_EMAIL)){
                $mailEr= "Adresse e-mail invalide.";
                $errors[] = "Adresse e-mail invalide.";
                    }
                }
            
                $site= $_POST['site'];
                
                if(!empty($site)){
                    
                    if (!filter_var($site, FILTER_VALIDATE_URL)) {
                        
                   
                    $siteEr= 'Cette URL est incorrect.';     
                    $errors[] = 'Cette URL est incorrect.';
                    }
                }
                        
                            if(count($errors) == 0){
            
            
            $sql="INSERT INTO annonce(id_annonce,id_utilisateur,titre,description) VALUES('','1','$titre','$description')";
                            $bdd->query($sql);    
               
                            $resultat=$bdd->query("SELECT MAX(id_annonce) as i FROM annonce ");
                            while( $line = $resultat->fetch()){
                                    $id=$line['i'];
                                }
                            echo $id;
            
            $sql1="INSERT INTO sortie(id_sortie,id_annonce,date_debut,adresse_depart,adresse_arrive,horaire,prix)  
                            VALUES('','$id','$dateDec','$LieuDepartDec','$LieuArriveeDec','$horaireDec','$prixDec')";              
                            $bdd->query($sql1);
            
                $sql2=" INSERT INTO information (id_information,id_annonce) VALUES ('','$id')";
                            $bdd->query($sql2);
                    
                            $resultat1=$bdd->query("SELECT MAX(id_information) as j FROM information ");
                            while( $line1 = $resultat1->fetch()){
                                $id1=$line1['j'];
                                }
                        
                    
                            $sql3=" INSERT INTO telephone (id_telephone,id_information,tel) VALUES('','$id1','$tel')"; 
                            $bdd->query($sql3);
                            if(isset($_POST['email'])){
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_mail,id_information,mail) VALUES('','$id1','$mail')";
                            $bdd->query($sql9);
                            }
                            if(isset($_POST['site'])){        
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_site,id_information,nom_site) VALUES('','$id1','$site')";
                            $bdd->query($sql8);
                            }
                    
                if(isset($_POST['image1'])){
                    $image1=htmlspecialchars($_POST['image1']);
                    $sql4="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image1')";
                    $bdd->query($sql4);
                }
                if(isset($_POST['image2'])){
                    $image2=htmlspecialchars($_POST['image2']);
                    $sql5="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image2')";
                    $bdd->query($sql5);
                }
                if(isset($_POST['image3'])){
                    $image3=htmlspecialchars($_POST['image3']);
                    $sql6="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image3')";
                    $bdd->query($sql6);
                }
                if(isset($_POST['image4'])){
                    $image4=htmlspecialchars($_POST['image4']);
                    $sql7="INSERT INTO photo (id_photo,id_annonce,photo) VALUES ('','$id','$image4')";
                    $bdd->query($sql7);
                } }else{ echo 'Erreur insertion'; }
            
        }
             }
} //Fin If POST
                    ?>


    
<!DOCTYPE html>
<html>
<head>
<script src="jquery-3.3.1.min.js" ></script>
<script>
    $(function(){
        $('#titree').keyup(function(){
            
            ti= $('#titre').val();
         
                var n = $("#titree").val().length;
        if(n<5){
        $('#titree').next("#erreurtitre").show().text('Cepseudo existe deja');
                    }else{
    $('#titree').next("#erreurtitre").hide().text("");    
                    }
                
            
        });
    });
    </script>
	<meta charset="utf-8">
	<title><?php echo "gfgf0".$categorie; ?>fhjjhfdf</title>
	<link rel="stylesheet" type="text/css" href="depot.css">
	<script>
       function fonction(t){
           var re=document.getElementById('titree');
           var tit=document.getElementById('erreurtitre');
        if(t==""){
            re.style.border="1px solid #F16627";
            tit.textContent="Veuillez remplire ce champ";
        }else{if(t.length<5){
            tit.textContent="Ce champ doit contenir au moin 5 caractere";
        }else{
            re.style.border="";
             tit.textContent="";
        }
       }}
    </script>
</head>
<body>
<header>
		<div id="titre">
			
			<div id="slogan">
				<h1>Espace etudiant</h1>
				<h3>Le nouveau coin des etudiants</h3>
			</div>
		</div>
		
	</header>
	
       <div id="nav">
       	<a href="#">Accueil</a>
		<a href="#">Mes annonces</a>
		<a href="#">Poster une annonce</a>
       
		<form>
			<label for="search_bar">Rechercher</label><input  type="search" name="search_bar" placeholder="Rechercher une annonce...">
			<a href="#">ok</a>
		</form>
		
		</div>
		<section>
			<h2>Poster une annonce</h2>
			<p id="aaa">Votre annonce sera validée par nos équipes avant la mise en ligne.</p>
			<form  method="post" action="formulaire_post.php">
				<div id="formulaire">
				<div>
					<h3>Déscription de votre annonce</h3>
					<label>Catégorie de l'annonce</label>
					<select  name="categorie" id="catégorie"  onchange="
                        
					if (document.getElementById('catégorie').selectedIndex==0) {
						document.getElementById('Formations').style.display='block';
						document.getElementById('Recrutement').style.display='none';
						document.getElementById('Logement').style.display='none';
						document.getElementById('Evènement').style.display='none';
						document.getElementById('DetailsFormation').style.display='block';
						document.getElementById('DetailsRecrutement').style.display='none';
						document.getElementById('DetailsLogement').style.display='none';
						document.getElementById('DetailsEvenement').style.display='none';
						document.getElementById('DetailsExcursion').style.display='none';

					}
					if (document.getElementById('catégorie').selectedIndex==1) {
						document.getElementById('Formations').style.display='none';
						document.getElementById('Recrutement').style.display='block';
						document.getElementById('Logement').style.display='none';
						document.getElementById('Evènement').style.display='none';
						document.getElementById('DetailsFormation').style.display='none';
						document.getElementById('DetailsRecrutement').style.display='block';
						document.getElementById('DetailsLogement').style.display='none';
						document.getElementById('DetailsEvenement').style.display='none';
						document.getElementById('DetailsExcursion').style.display='none';
					}
					if (document.getElementById('catégorie').selectedIndex==2) {
						document.getElementById('Formations').style.display='none';
						document.getElementById('Recrutement').style.display='none';
						document.getElementById('Logement').style.display='block';
						document.getElementById('Evènement').style.display='none';
						document.getElementById('DetailsFormation').style.display='none';
						document.getElementById('DetailsRecrutement').style.display='none';
						document.getElementById('DetailsLogement').style.display='block';
						document.getElementById('DetailsEvenement').style.display='none';
						document.getElementById('DetailsExcursion').style.display='none';
						}
					if (document.getElementById('catégorie').selectedIndex==3) {
						document.getElementById('Formations').style.display='none';
						document.getElementById('Recrutement').style.display='none';
						document.getElementById('Logement').style.display='none';
						document.getElementById('Evènement').style.display='block';
						document.getElementById('DetailsFormation').style.display='none';
						document.getElementById('DetailsRecrutement').style.display='none';
						document.getElementById('DetailsLogement').style.display='none';
						document.getElementById('DetailsEvenement').style.display='block';
						document.getElementById('DetailsExcursion').style.display='none';
					   }
					if (document.getElementById('catégorie').selectedIndex==4) {
						document.getElementById('Formations').style.display='none';
						document.getElementById('Recrutement').style.display='none';
						document.getElementById('Logement').style.display='none';
						document.getElementById('Evènement').style.display='none';
						document.getElementById('DetailsFormation').style.display='none';
						document.getElementById('DetailsRecrutement').style.display='none';
						document.getElementById('DetailsLogement').style.display='none';
						document.getElementById('DetailsEvenement').style.display='none';
						document.getElementById('DetailsExcursion').style.display='block';
					}
                     
                      
                                                                                                         
					">
                        

						<option value='formationx'  >Formations</option>
						<option value='recrutement' >Recrutement</option>
						<option value='logement'  >Logement</option>
						<option value='evenement' >Evénements</option>
						<option value='decouverte' >Découverte/Excursions</option>
						<script lang="javascript">
    
<?php
                        if($categorie=='logement'){ ?>
                        document.getElementById('Formations').style.display='none';
						document.getElementById('Recrutement').style.display='none';
						document.getElementById('Logement').style.display='block';
						document.getElementById('Evènement').style.display='none';
						document.getElementById('DetailsFormation').style.display='none';
						document.getElementById('DetailsRecrutement').style.display='none';
						document.getElementById('DetailsLogement').style.display='block';
						document.getElementById('DetailsEvenement').style.display='none';
						document.getElementById('DetailsExcursion').style.display='none';                                                                                     <?php } ?>
    
</script>
					</select ><br/>
                    
					<div id="Formations" >
						<label>Domaine :</label>
						<select name="domaines">
							<option value='langue' >Langues</option>
							<option value='informatique'>Informatique</option>
							<option value='bureautique'>Bureautique</option>
							<option value='ressource'>Ressources humaines</option>
							<option value='finance'>Finance</option>
							<option value='marketing'>Marketing-Communication</option>
							<option value='comptablité'>Comptabilité</option>
							<option value='tourisme'>Tourisme</option>
							<option value='autre'>Autre</option>	
						</select><br/>
					</div>
					<div id="Recrutement" style="display: none;">
					<label>Type de travail :</label>
						
						<input type="radio" name="travailRec" value="emploi" id="emploi" checked="checked"><label for="emploi">Offre d'emploi</label>
                        <input type="radio" name="travailRec" value="stage" id="stage" ><label for="stage">Offre de stage</label>
						<br/>
						
					</div>
					
					<div id="Logement" style="display: none;">
						<label>Type de location :</label>
						<div>
						 <input type="radio" name="logement" value="location" id="location" checked="checked"><label for="location">Location</label>
                         <input type="radio" name="logement" value="colocation" id="colocation"><label for="colocation">Colocation</label>
						 <br/>
						 </div>
					</div>
					<div id="Evènement" style="display: none;">
						<label>Type d'événement :</label>
                            <select name='type_eve'>
							<option>Meet-up/Conférances</option>
							<option>Salon/Expositions</option>
							<option>Galas/Concerts/Spectacle</option>
							<option>Cinéma</option>
							<option>Evènements sportifs</option>
							<option>Autre</option>
						</select><br/>
					</div>
				
						<br/><label>Titre de l'annonce : </label>
<input type="text" name="titrean" id='titree' onBlur="fonction(titrean.value)"  value="<?php echo $titre;   ?>" >
						<span id='erreurtitre'></span>
						<br/>
        <label>Déscription : </label><textarea name="description" rows="5" cols="50" value=""><?php echo $description;   ?> 
                    </textarea><span>*</span><br/>
         
				</div>
				<div id="DetailsRecrutement" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Domaine : </label><input type="text" name="domaineRec" value="<?php echo $domaineRec; ?>" ><br/>
						<label>Etablissement : </label><input type="text" name="etablissementRec" value="<?php echo $etablissementRec; ?>" ><br/>
						<label>Adresse : </label><input type="text" name="adresseRec" value="<?php echo $adresseRec; ?>" ><br/>
						<label>Salaire mensuel : </label><input type="text" name="salaireRec" value="<?php echo $salaireRec; ?>" ><br/>
                        <span class="error"> <?php echo $salaireEr; ?></span> 
				</div>
				<div id="DetailsLogement" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Adresse : </label><input type="text" name="adresseLog" value="<?php echo $adresseLog; ?>" ><span>*</span><br/>
						<label>Type du logement : </label>
							<select name="typeLog">
							<option value='Chambre'>Chambre</option>
							<option value='Studio'>Studio</option>
							</select><br/>
						<label>Surface : </label><input type="text" name="surfaceLog" value="<?php echo $surfaceLog; ?>" ><span>*</span> m²<br/>
                        <span class="error"> <?php echo $surfaceEr; ?></span> 
						<label>Loyer mensuel : </label><input type="text" name="loyerLog" value="<?php echo $loyerLog; ?>"><span>*</span> DZD<br/>
                        <span class="error"> <?php echo $loyerEr; ?></span> 
				</div>
				<div id="DetailsFormation">
					<h3>Details de votre annonce :</h3>
						<label>Date de début : </label><input type="date" name="dateFor" value="<?php echo $dateFor; ?>" ><br/>
                        <span class="error"> <?php echo $dateEr; ?></span> 
						<label>Etablissement : </label><input type="text" name="etablissementFor" value="<?php echo $etablissementFor ; ?>" ><br/>
						<label>Adresse : </label><input type="text" name="adresseFor" value="<?php echo $adresseFor ; ?>" ><br/>
				</div>
				<div id="DetailsEvenement" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Date : </label><input type="date" name="dateEve" value="<?php echo $dateEve; ?>"><br/>
                        <span class="error"> <?php echo $dateEr; ?></span> 
						<label>Horraire : </label>
							<select name='horaireEve'>
								<option>8h</option>
								<option>9h</option>
								<option>10h</option>
								<option>11h</option>
								<option>12h</option>
								<option>13h</option>
								<option>14h</option>
								<option>15h</option>
								<option>16h</option>
								<option>17h</option>
								<option>18h</option>
								<option>19h</option>
								<option>20h</option>
								<option>21h</option>
							</select><br/>
						<label>Adresse : </label><input type="text" name="adresseEve" value="<?php echo $adresseEve; ?>"><br/>
						<label>Organisateur : </label><input type="text" name="organisateurEve" value="<?php echo $organisateurEve; ?>"><br/>
				</div>
				<div id="DetailsExcursion" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Date : </label><input type="date" name="dateDec" value="<?php echo $dateDec; ?>"><span> *</span><br/>
                        <span class="error"> <?php echo $dateEr; ?></span> 
						<label>Horraire de départ : </label>
							<select name='horaireDec'>
								<option>8h</option>
								<option>9h</option>
								<option>10h</option>
								<option>11h</option>
								<option>12h</option>
								<option>13h</option>
								<option>14h</option>
								<option>15h</option>
								<option>16h</option>
								<option>17h</option>
								<option>18h</option>
								<option>19h</option>
								<option>20h</option>
								<option>21h</option>
							</select><br/>
				<label>lieu de départ : </label><input type="text" name="LieuDepartDec" value="<?php echo $LieuDepartDec; ?>"><span>*</span><br/>
				<label>Lieu d'arrivée : </label><input type="text" name="LieuArrivéeDec" value="<?php echo $LieuArriveeDec; ?>"><span>*</span><br/>
				<label>Prix : </label><input type="text" name="prixDec" value="<?php echo $prixDec; ?>"><br/>
                <span class="error"> <?php echo $prixEr; ?></span> 
				</div>
                
				<div>
					<h3>Informations complémentaires</h3>
						<label>Télephone : </label><input type="text" name="tel" value="<?php echo $tel ; ?>" ><span> *</span><br/>
                        <span class="error"> <?php echo $telEr;?></span> 
						<label>E-mail : </label><input type="email" name="email" value="<?php echo $mail ; ?>" ><br/>
                        <span class="error"> <?php echo $mailEr;?></span>
						<label>Site internet : </label><input type="text" name="site" value="<?php echo $site ; ?>" ><br/>
                        <span class="error"> <?php echo $siteEr;?></span> 
				</div>
                
				 <div>
					<h3>Images</h3>
						<p>Illustrez votre annonce(au format JPEG)
						
						<input type="file" name="image1"></p>
						<div  id="plus" style="display: block;">
							<p>
							<input type="button" name="plus" value=" Plus d'images" onclick="document.getElementById('image2').style.display='block';document.getElementById('plus').style.display='none'"> (Jusqu'a 4 images)</p>
                        </div>

						<div id="image2" style="display: none;">
							
							<input type="file" name="image2" ><br/>
						
                        
							<input type="file" name="image3" ><br/>
						
                        
							<input type="file" name="image4" ><br/>
						</div>	
                       


						

				</div>
				</div>
					<input type="submit" id="valider" name="valider" value="Poster l'annonce">
			</form>
		</section>
		<footer>
		Tous droits réservés 
	</footer>
	
</body>
</html>