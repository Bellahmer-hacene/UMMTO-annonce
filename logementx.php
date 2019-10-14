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

                }  

$categorie = $titre = $domaineFor = $description = $dateFor = $etablissementFor = $adresseFor = $tel = $dateEr =$telEr = $mailEr = $siteEr = $site = $mail= "";


$type_location = $type_logement = $surfaceLog = $adresseLog = $loyerLog = $surfaceEr = $loyerEr = "";

$travailRec = $domaineRec = $etablissementRec = $adresseRec = $salaireRec = $salaireEr = "";

$titreEr = $descEr = $adresseEr = "";

$dateEve = $organisateurEve = $adresseEve = "";

$prixEr = $LieuDepartDec = $dateDec = $LieuArriveeDec = $prixDec = $horaireDec ='';

$type='-1';

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    echo 'bjr';
if(isset($_POST['categorie']) ){
        
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
                
        if (!empty($_POST['titre'])  && !empty($_POST['logement']) && !empty($_POST['description']) && !empty($_POST['typeLog']) && !empty($_POST['surfaceLog']) && !empty($_POST['adresseLog']) &&((!empty($_POST['tel'])) || (!empty($_POST['email'])) || (!empty($_POST['site']) ) ) && !empty($_POST['loyerLog'])  ){
        
               $errors = [];
            
                if(mb_strlen($titre) < 3){
                $errors[] = "Titre trop court, minimum 3 caractéres. ";
                $titreEr= "Titre trop court, minimum 3 caractéres. ";
                }
            
                if(mb_strlen($description) < 20){
                $errors[] = "Description trop court, minimum 100 caractéres. ";
                $descEr= "Description trop court, minimum 100 caractéres. ";
                }
            
                if(mb_strlen($adresseLog) < 3){
                $errors[] = "Champ trop court, minimum 3 caractéres. ";
                $adresseEr= "Champ trop court, minimum 3 caractéres. ";
                }
                
                if(mb_strlen($titre) > 50){
                $errors[] = "Titre trop long, maximum 50 caractéres. ";
                $titreEr= "Titre trop long, maximum 50 caractéres. ";
                }
            
                
            
                if (!preg_match("#[0-9]#",$loyerLog)){
                    $loyerEr="Ce prix est invalide.";
                    $errors[]="Erreur";
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
                    
                    if (!preg_match(" (http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?)",$site)) {
                        
                   
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
            
             $sql1="INSERT INTO logement(id_annonce,type,type_logement,surface,adresse,loyer)  
                            VALUES(\"$id\",\"$type_location\",\"$type_logement\",\"$surfaceLog\",\"$adresseLog\",\"$loyerLog\")";              
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
                    $sql8="INSERT INTO photo (id_annonce,photo) VALUES ('$id','Photos_par_defaut/town-streets-views-skyscrapers-flat-design-illustration-41786087.jpg')";
                    $bdd->query($sql8);
                }
                header("Location: index.php");//rediriger la secretaire vers sa page 
                die; 
                        }else{ echo 'Erreur lors de l\'insertion';
                              
                            }
            
        }else { echo 'Veuillez remplir tout les champs';}
    } // Fin categorie logement
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Déposer une annonce</title>
	<link rel="stylesheet" type="text/css" href="css3/depot.css">
	<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
</head>
<body>
<script src="verfi.js"></script>
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
			<form  method="post" action="" onsubmit="return verifFormLog(this)" enctype="multipart/form-data">
				<div id="formulaire">
				<div>
					<h3>Déscription de votre annonce</h3>
					<label>Catégorie de l'annonce * </label>
					<select  name="categorie" id="catégorie"  onchange="document.location.href = this.value;">
						<option value='logementx.php'  >Logement</option>
                        <option value='formationx.php'  >Formations</option>
						<option value='recrutement.php' >Recrutement</option>
                        <option value='evenement.php' >Evénements</option>
						<option value='decouverte.php' >Découverte/Excursions</option>
					</select ><br/>
                    <div id="Logement" >
						<label>Type de location :  * </label><br>
						<div>
						 <input type="radio" name="logement" value="location" checked = "checked" id="location" <?php if($type_location=='location') echo "checked='checked'";  ?> >Location
                         <input type="radio" name="logement" value="colocation" id="colocation" <?php if($type_location=='colocation') echo "checked='checked'";  ?> >Colocation
						 <br/>
				        </div>
                    </div>
                    
             <br/><label>Titre de l'annonce :  * </label><input id ="titreF"  onkeyup="verifTitreK(this)" onblur="verifTitre(this)" type="text" name="titre" value="<?php echo $titre;   ?>" >
                        <span>*</span><br/>
                    <p id ="msg1"></p><p id ="msg1a"></p>

                        <span class="error"> <?php echo $titreEr; ?></span>
        <label>Déscription :  * </label><textarea id="descriptionF" name="description" onkeyup="verifDescK(this)" onblur="verifDesc(this)" rows="5" cols="50" ><?php echo $description;   ?> </textarea> 
                    <br/>
                    <p id ="msg2"></p><p id ="msg2a"></p>

                    <span class="error"> <?php echo $descEr; ?></span>
             </div>
<div id="DetailsLogement" >
					<h3>Details de votre annonce :</h3>
						

                        <span class="error"> <?php echo $adresseEr; ?></span>
						<label>Type du logement : </label>
							<select name="typeLog">
							<option value='Chambre'>Chambre</option>
							<option value='Studio'>Studio</option>
							<option value='F2'> F2 </option>
							<option value='F3'> F3 </option>
							
							</select><br/>
						<label>Surface (m²) : * </label><input type="text" id="surf" name="surfaceLog" onblur="verifSurf(this)" onkeyup="verifSurfK(this)" value="<?php echo $surfaceLog; ?>" ><span>*</span> <br/>
                        <p id ="msg7"></p><p id ="msg7a"></p><p id ="msg7b"></p>

                        <span class="error"> <?php echo $surfaceEr; ?></span> 
						<label>Loyer mensuel (DZD) :  * </label><input type="text" id="loyer" name="loyerLog" onblur="verifLoyer(this)" onkeyup="verifLoyerK(this)"  value="<?php echo $loyerLog; ?>"><span>*</span><br/>
                        <span class="error"> <?php echo $loyerEr; ?></span> 
                  		<p id ="msg11"></p><p id ="msg11a"></p><p id ="msg11b"></p>
                  		<label>Adresse :  * </label><input type="text" id="adresseForF"
                       name="adresseLog" onblur="verifAdr(this)" onkeyup="verifAdrK(this)"  value="<?php echo $adresseLog; ?>" ><span>*</span><br/>                        
                        <p id ="msg6"><p id ="msg6a">
      
				</div>
                    <div>
					<h3>Informations complémentaires</h3>
                <h4 style="text-align = center ;">Veuillez renseigner au moins un des ces trois champs</h4>

						  <label>Télephone : </label><input type="text" id="telF" name="tel" onblur ="verifTel(this)" 
                       onkeyup ="verifTelK(this)" value="<?php echo $tel ; ?>" ><br/>
                        <span class="error"> <?php echo $telEr;?></span> 
                        <p id ="msg8"></p>

						<label>E-mail : </label><input type="email" id="mailF" name="email" onblur ="verifMail(this)" 
                       onkeyup ="verifMailK(this)" value="<?php echo $mail ; ?>" ><br/>
                        <span class="error"> <?php echo $mailEr;?></span>
                        <p id ="msg9"></p>

						<label>Site internet : </label><input type="text" id="siteF" name="site" onblur ="verifLink(this)"
                      onkeyup ="verifLinkK(this)"  value="<?php echo $site ; ?>" ><br/>
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
					<input type="submit" id="valider" name="valider" value="Poster l'annonce"  >
			</form>
		</section>
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
    <script>
    