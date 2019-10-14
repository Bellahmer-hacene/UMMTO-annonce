<?php
session_start();
if(isset($_SESSION['id'])){
    $id_utilisateur=$_SESSION['id'];
   $existe=1;
}else{
    header("Location: index.php");
}
try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());

                }   ?> 



<?php

$categorie = $titre = $domaineFor = $description = $dateFor = $etablissementFor = $adresseFor = $tel = $dateEr =$telEr = $mailEr = $siteEr = $site = $mail= "";

$travailRec = $domaineRec = $etablissementRec = $adresseRec = $salaireRec = $salaireEr = "";

$titreEr = $descEr = "";

$adresseEr = $organEr ="";

$dateEve = $organisateurEve = $adresseEve = $horaireEve = $type_eve ="";

$prixEr = $LieuDepartDec = $dateDec = $etablissementEve = $LieuArriveeDec = $prixDec = $horaireDec ='';

$type='-1';

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    echo 'bjr';
   
    
  if( isset($_POST['categorie'])){
             
      echo 'ça va';
                $categorie=htmlspecialchars($_POST['categorie']);
                $titre=htmlspecialchars($_POST['titre']);
                $type_eve=htmlspecialchars($_POST['type_eve']);
                $description=htmlspecialchars($_POST['description']);
                $dateEve=htmlspecialchars($_POST['dateEve']);
                $organisateurEve=htmlspecialchars($_POST['organisateurEve']);
                $adresseEve=htmlspecialchars($_POST['adresseEve']);
                $horaireEve=htmlspecialchars($_POST['horaireEve']);
                $tel=htmlspecialchars($_POST['tel']);
                $etablissementEve=htmlspecialchars($_POST['Etablissement']);
                
                $type=3;
        
        if (!empty($_POST['titre'])  && !empty($_POST['type_eve']) && !empty($_POST['description']) && !empty($_POST['dateEve']) && !empty($_POST['organisateurEve']) && !empty($_POST['adresseEve']) && !empty($_POST['horaireEve']) && ((!empty($_POST['tel'])) || (!empty($_POST['email'])) || (!empty($_POST['site']) ) )){
        
            
            $errors = [];
            
                if(mb_strlen($titre) < 3){
                $errors[] = "Titre trop court, minimum 3 caractéres. ";
                $titreEr= "Titre trop court, minimum 3 caractéres. ";
                }
            
                if(mb_strlen($adresseEve) < 3){
                $errors[] = "Champ trop court, minimum 3 caractéres. ";
                $adresseEr= "Champ trop court, minimum 3 caractéres. ";
                }
            
                if(mb_strlen($organisateurEve) < 3){
                $errors[] = "Champ trop court, minimum 3 caractéres. ";
                $organEr= "Champ trop court, minimum 3 caractéres. ";
                }
            
                if(mb_strlen($description) < 20){
                $errors[] = "Description trop court, minimum 100 caractéres. ";
                $descEr= "Description trop court, minimum 100 caractéres. ";
                }
            
                if(mb_strlen($titre) > 50){
                $errors[] = "Titre trop long, maximum 50 caractéres. ";
                $titreEr= "Titre trop long, maximum 50 caractéres. ";
                }
                
                if(date('Y-m-d')>=$dateEve){
                    $dateEr= "Cette date est depassée.";
                    $errors[] = "Cette date est depassée.";             
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
            
            $sql="INSERT INTO annonce(id_utilisateur,titre,description,valide) VALUES($id_utilisateur,\"$titre\",\"$description\",'0')";
                            $bdd->query($sql);   
               
                            $resultat=$bdd->query("SELECT MAX(id_annonce) as i FROM annonce ");
                            while( $line = $resultat->fetch()){
                                    $id=$line['i'];
                                }
                           
                            echo $id;
                                echo $horaireEve;
            
    $sql1="INSERT INTO evenement(id_annonce,type_evenement,date_debut,adresse,organisateur,horaire,etablissement)  VALUES($id,\"$type_eve\",\"$dateEve\",\"$adresseEve\",\"$organisateurEve\",\"$horaireEve\",\"$etablissementEve\")";              
                            $bdd->query($sql1);
                            
                $sql2=" INSERT INTO information (id_annonce) VALUES ('$id')";
                            $bdd->query($sql2);
                    
                            $resultat1=$bdd->query("SELECT MAX(id_information) as j FROM information ");
                            while( $line1 = $resultat1->fetch()){
                                $id1=$line1['j'];
                                }
                        
                      if(!empty($_POST['email']) && !empty($_POST['site']) && !empty($_POST['tel'])){
                            $tel=htmlspecialchars($_POST['tel']);  
                            $sql3=" INSERT INTO telephone (id_information,tel) VALUES('$id1','$tel')"; 
                            $bdd->query($sql3);
                            
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_information,mail) VALUES('$id1','$mail')";
                            $bdd->query($sql9);
                                
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_information,nom_site) VALUES('$id1','$site')";
                            $bdd->query($sql8);
                            }else{
                            
                            if(!empty($_POST['email']) && !empty($_POST['tel']) && empty($_POST['site'])){
                            $tel=htmlspecialchars($_POST['tel']);
                            $sql3=" INSERT INTO telephone (id_information,tel) VALUES('$id1','$tel')"; 
                            $bdd->query($sql3);
                            
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_information,mail) VALUES('$id1','$mail')";
                            $bdd->query($sql9);
                                
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_information,nom_site) VALUES('$id1','')";
                            $bdd->query($sql8);
                                
                            }else{
                    
                            if(!empty($_POST['site']) && !empty($_POST['tel']) && empty($_POST['email'])){
                            $tel=htmlspecialchars($_POST['tel']);
                            $sql3=" INSERT INTO telephone (id_information,tel) VALUES('$id1','$tel')"; 
                            $bdd->query($sql3);
                                
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_information,nom_site) VALUES('$id1','$site')";
                            $bdd->query($sql8);
                                
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_information,mail) VALUES('$id1','')";
                            $bdd->query($sql9);
                            }else{
                               
                            if(!empty($_POST['email']) && !empty($_POST['site']) && empty($_POST['tel'])){
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_information,nom_site) VALUES('$id1','$site')";
                            $bdd->query($sql8);
                            
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_information,mail) VALUES('$id1','$mail')";
                            $bdd->query($sql9);
                                
                            $tel=htmlspecialchars($_POST['tel']);
                            $sql3=" INSERT INTO telephone (id_information,tel) VALUES('$id1','0')"; 
                            $bdd->query($sql3);
                            }else{
                                if(!empty($_POST['tel']) &&  empty($_POST['site']) && empty($_POST['email'])){
                            $tel=htmlspecialchars($_POST['tel']);
                            $sql3=" INSERT INTO telephone (id_information,tel) VALUES('$id1','$tel')"; 
                            $bdd->query($sql3);
                             
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_information,nom_site) VALUES('$id1','')";
                            $bdd->query($sql8);
                            
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_information,mail) VALUES('$id1','')";
                            $bdd->query($sql9);
                                
                                
                            }else{
                            
                            if(!empty($_POST['email']) && empty($_POST['tel']) &&  empty($_POST['site'])){
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_information,mail) VALUES('$id1','$mail')";
                            $bdd->query($sql9);
                                
                            $tel=htmlspecialchars($_POST['tel']);
                            $sql3=" INSERT INTO telephone (id_information,tel) VALUES('$id1','0')"; 
                            $bdd->query($sql3);
                            
                            $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_information,nom_site) VALUES('$id1','')";
                            $bdd->query($sql8);
                                
                            }else{
                                
                            if(!empty($_POST['site']) && empty($_POST['email']) && empty($_POST['tel'])){
                                
                             $site=htmlspecialchars($_POST['site']);   
                            $sql8=" INSERT INTO site (id_information,nom_site) VALUES('$id1','$site')";
                            $bdd->query($sql8);   
                            
                            $mail=htmlspecialchars($_POST['email']);
                            $sql9=" INSERT INTO mail (id_information,mail) VALUES('$id1','')";
                            $bdd->query($sql9);
                            
                            $tel=htmlspecialchars($_POST['tel']);
                            $sql3=" INSERT INTO telephone (id_information,tel) VALUES('$id1','0')"; 
                            $bdd->query($sql3);

                            
                                
                            }
                            

                            
                                
                            }}}}}} //Fin else
                    
                if(!empty($_FILES['image1']['name'])){
                     echo "aaaaaaaaaaaaaaa";
                    $image1=htmlspecialchars($_FILES['image1']['name']);
                    $sql4="INSERT INTO photo (id_annonce,photo) VALUES ('$id','$image1')";
                    $bdd->query($sql4);
move_uploaded_file($_FILES['image1']['tmp_name'],'image/'. $_FILES['image1']['name']);
                }
                if(!empty($_FILES['image2']['name'])){
                    $image2=htmlspecialchars($_FILES['image2']['name']);
                    $sql5="INSERT INTO photo (id_annonce,photo) VALUES ('$id','$image2')";
                    $bdd->query($sql5);
                    move_uploaded_file($_FILES['image2']['tmp_name'],'image/'. $_FILES['image2']['name']);
                }
                if(!empty($_FILES['image3']['name'])){
                    $image3=htmlspecialchars($_FILES['image3']['name']);
                    $sql6="INSERT INTO photo (id_annonce,photo) VALUES ('$id','$image3')";
                    $bdd->query($sql6);
                    move_uploaded_file($_FILES['image3']['tmp_name'],'image/'. $_FILES['image3']['name']);
                }
                if(!empty($_FILES['image4']['name'])){
                    $image4=htmlspecialchars($_FILES['image4']['name']);
                    $sql7="INSERT INTO photo (id_annonce,photo) VALUES ('$id','$image4')";
                    $bdd->query($sql7);
                    move_uploaded_file($_FILES['image4']['tmp_name'],'image/'. $_FILES['image4']['name']);
                }
                                
                if(empty($_FILES['image1']['name']) && empty($_FILES['image2']['name']) && empty($_FILES['image3']['name']) && empty($_FILES['image4']['name'])){
                    $sql8="INSERT INTO photo (id_annonce,photo) VALUES ('$id','Photos_par_defaut/events.jpg')";
                    $bdd->query($sql8);
                }
              header("Location: index.php");//rediriger la secretaire vers sa page 
                die; 
                            }else{echo 'Erreur insertion'; }
        }else{echo 'Veuillez remplir tout les champs.';}
         }
         }
         ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Déposer une annonce</title>
	<link rel="stylesheet" type="text/css" href="css3/depot.css">
	<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
	<script src="verfi.js"></script>

</head>
<body>

<header>
     
   
    
    <div id="logo">
    <a style="float:left;padding:0;margin-top:0;" href="index.php">
			<img src="newlogo.png" alt="">
        </a>			
		</div>
         <div id ="menu ">    
        <a title="Déconnexion" href="http://localhost/annonce/php/deconnexion.php" style="font-size:2em;width:40px;overflow:visible;cursor:pointer"><i class="fas fa-sign-out-alt"></i></a>
   <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><i class="fas fa-user"></i></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="categorie.php?user=<?php echo $id_utilisateur; ?>">Mes annonces</a>
    <a href="#about">Paramètres</a>
       </div></div>
</div>


		
	</header>
	
       <article><p style =" font-size : 25px ; margin-left : 25px ; text-align : center ; color : #3282C1 ; font-weight : bold ; 
       font-style : italic ;  ">Poster une annonce gratuitement <br></p></article>
      
       
	
		
		<section>
			<form  method="post" action="" onsubmit="return verifFormEve(this)" enctype="multipart/form-data">
				<div id="formulaire">
				<div>
					<h3>Déscription de votre annonce</h3>
					<label>Catégorie de l'annonce</label>
					<select  name="categorie" id="catégorie"  onchange="document.location.href = this.value;">
						<option value='evenement.php' >Evénements</option>
						<option value='recrutement.php' >Recrutement</option>
						<option value='logementx.php'  >Logement</option>
                        <option value='formationx.php'  >Formations</option>
						<option value='decouverte.php' >Découverte/Excursions</option>
					</select ><br/>
<div id="Evènement">
				<label>Type d'événement :</label>
                        <select name='type_eve'>
							<option value='Meet-up/Conférances' <?php if($type_eve == 'Meet-up/Conférances') echo 'selected';?> >Meet-up/Conférances</option>
							<option value='Salon/Expositions' <?php if($type_eve == 'Salon/Expositions') echo 'selected';?>>Salon/Expositions</option>
							<option value='Galas/Concerts/Spectacle' <?php if($type_eve == 'Galas/Concerts/Spectacle') echo 'selected';?>>Galas/Concerts/Spectacle</option>
							<option value='Cinéma' <?php if($type_eve == 'Cinéma') echo 'selected';?>>Cinéma</option>
							<option value='Evènements_sportifs' <?php if($type_eve == 'Evènements_sportifs') echo 'selected';?>>Evènements sportifs</option>
							<option value='Autre' <?php if($type_eve == 'Autre') echo 'selected';?>>Autre</option>
						</select><br/>
					</div>
				
						<br/><label>Titre de l'annonce :  *  </label><input id ="titreF"  onkeyup="verifTitreK(this)" onblur="verifTitre(this)" type="text" name="titre" value="<?php echo $titre;   ?>" >
                        <br/>
                        <p id ="msg1"></p><p id ="msg1a"></p>

                        <span class="error"> <?php echo $titreEr; ?></span>
        <label>Déscription :  *  </label><textarea id="descriptionF" name="description"  onkeyup="verifDescK(this)" onblur="verifDesc(this)" rows="5" cols="50" ><?php echo $description;   ?> </textarea> 
                   <br/>
                    <p id ="msg2"></p><p id ="msg2a"></p>

                    <span class="error"> <?php echo $descEr; ?></span>
             </div>       
<div id="DetailsEvenement" >
					<h3>Details de votre annonce :</h3>
						<label>Date :  *  </label><input type="date" id="dateEv" onblur="madate(this)"
                       name="dateEve" required  value="<?php echo $dateEve; ?>"><br/>
                        <span class="error"> <?php echo $dateEr; ?></span> 
						<label>Horraire : *  </label>
							<select name='horaireEve'>
								<option value='08:00' <?php if($horaireEve == 'huit') echo 'selected'; ?> >8h</option>
								<option value='09:00' <?php if($horaireEve == 'neuf') echo 'selected'; ?>>9h</option>
								<option value='10:00' <?php if($horaireEve == 'dix') echo 'selected'; ?>>10h</option>
								<option value='11:00' <?php if($horaireEve == 'onze') echo 'selected'; ?>>11h</option>
								<option value='12:00' <?php if($horaireEve == 'douze') echo 'selected'; ?>>12h</option>
								<option value='13:00' <?php if($horaireEve == 'treize') echo 'selected'; ?>>13h</option>
								<option value='14:00' <?php if($horaireEve == 'quatorze') echo 'selected'; ?>>14h</option>
								<option value='15:00' <?php if($horaireEve == 'quinze') echo 'selected'; ?>>15h</option>
								<option value='16:00' <?php if($horaireEve == 'seize') echo 'selected'; ?>>16h</option>
								<option value='17:00' <?php if($horaireEve == 'dixsept') echo 'selected'; ?>>17h</option>
								<option value='18:00' <?php if($horaireEve == 'dixhuit') echo 'selected'; ?>>18h</option>
								<option value='19:00' <?php if($horaireEve == 'dixneuf') echo 'selected'; ?>>19h</option>
								<option value='20:00' <?php if($horaireEve == 'vingt') echo 'selected'; ?>>20h</option>
								<option value='21:00' <?php if($horaireEve == 'vingtun') echo 'selected'; ?>>21h</option>
							</select><br/>
						<label>Adresse :  *  </label><input type="text" id="adresseForF" name="adresseEve" onblur="verifAdr(this)" onkeyup="verifAdrK(this)" value="<?php echo $adresseEve; ?>"> <br>
                        <span class="error"> <?php echo $adresseEr; ?></span>
                       	<p id ="msg6"></p><p id ="msg6a"></p>
                       <br>
                       	<label>Etablissement :  * </label>
                       	<input type="text" id="etablissementForF" name="Etablissement" value="<?php echo $etablissementEve; ?>" onblur="verifEta(this)" onkeyup="verifEtaK(this)"><br/>
						<p id ="msg5"></p><p id="msg5a"></p><p id ="msg5b"></p>

                       <br/>
                        <span class="error"> <?php echo $adresseEr; ?></span>

						<label>Organisateur : * </label>
                       <input type="text" id="org" name="organisateurEve" onblur="verifOrg(this)" onkeyup="verifOrgK(this)" value="<?php echo $organisateurEve; ?>"><br/>
                        <span class="error"> <?php echo $organEr; ?></span>
                        <p id ="msg3o"></p><p id ="msg3ao"></p><p id ="msg3bo"></p>

                        
				</div>
	<div>
					<h3>Informations complémentaires</h3>
				 <h4 style="text-align = center ;">Veuillez renseigner au moins un des ces trois champs</h4>

						<label>Télephone : </label><input type="text" id="telF" name="tel" onblur ="verifTel(this)" 
                       onkeyup ="verifTelK(this)" value="<?php echo $tel ; ?>" ><span> *</span><br/>
                        <span class="error"> <?php echo $telEr;?></span> 
                        <p id ="msg8"></p>

						<label>E-mail : </label><input type="email" id="mailF" name="email" onblur ="verifMail(this)"
                       onkeyup ="verifMailK(this)" value="<?php echo $mail ; ?>" ><br/>
                        <span class="error"> <?php echo $mailEr;?></span>
                        <p id ="msg9"></p>

						<label>Site internet : </label><input type="text" id="siteF" name="site" onblur ="verifLink(this)" 
                       onkeyup ="verifLinkK(this)" value="<?php echo $site ; ?>" ><br/>
                        <span class="error"> <?php echo $siteEr;?></span> 
                        <p id ="msg10"></p>

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
					<input type="submit" id="valider" name="valider" value="Poster l'annonce" onclick=jsa() >
			</form>
		</section>
		<script>
    </script>
    	<script src="jquery-3.3.1.min.js"></script>
    	
    	<script>
    function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
    </script>