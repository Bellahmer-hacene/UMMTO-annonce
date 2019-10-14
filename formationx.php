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

$etabEr = $adresseEr = "";

$type_location = $type_logement = $surfaceLog = $adresseLog = $loyerLog = $surfaceEr = $loyerEr = "";

$travailRec = $domaineRec = $etablissementRec = $adresseRec = $salaireRec = $salaireEr = "";

$titreEr = $descEr = "";

$dateEve = $organisateurEve = $adresseEve = "";

$prixEr = $LieuDepartDec = $dateDec = $LieuArriveeDec = $prixDec = $horaireDec ='';

$type='-1';

if($_SERVER['REQUEST_METHOD'] === "POST")
{
    echo 'bjr';
   
    
    if( isset($_POST['categorie']) ){
        
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
        
        if ( (!empty($_POST['titre']))  && (!empty($_POST['domaines'])) && (!empty($_POST['description'])) && (!empty($_POST['dateFor'])) && (!empty($_POST['etablissementFor'])) && (!empty($_POST['adresseFor'])) && ((!empty($_POST['tel'])) || (!empty($_POST['email'])) || (!empty($_POST['site']) ) )){
                
                echo 'hmd';
                $errors = [];
            
                if(mb_strlen($titre) < 3){
                $errors[] = "Titre trop court, minimum 3 caractéres. ";
                $titreEr= "Titre trop court, minimum 3 caractéres. ";
                }
            
                if(mb_strlen($etablissementFor) < 3){
                $errors[] = "Champ trop court, minimum 3 caractéres. ";
                $etabEr= "Champ trop court, minimum 3 caractéres. ";
                }
            
                if(mb_strlen($adresseFor) < 3){
                $errors[] = "Champ trop court, minimum 3 caractéres. ";
                $adresseEr= "Champ trop court, minimum 3 caractéres. ";
                }
            
                if(mb_strlen($description) < 20){
                $errors[] = "Description trop court, minimum 100 caractéres. ";
                $descEr= "Description trop court, minimum 100 caractéres. ";
                }
            
                if(mb_strlen($titre) > 50){
                $errors[] = "Titre trop long, maximum 50 caractéres. ";
                $titreEr= "Titre trop long, maximum 50 caractéres. ";
                }
                
                if(date('Y-m-d')>=$dateFor){
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
                          
                $sql1="INSERT INTO formation(id_annonce,date_debut,type_formation,adresse,etablissement,prix)   VALUES($id,\"$dateFor\",\"$domaineFor\",\"$adresseFor\",\"$etablissementFor\",5000.00)";              
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
                    $sql8="INSERT INTO photo (id_annonce,photo) VALUES ('$id','Photos_par_defaut/formation.png')";
                    $bdd->query($sql8);
                } ?>
              <!-- <script> alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes"); </script>-->
            <?php header("Location: index.php");//rediriger la secretaire vers sa page 
                die;    }else{ echo 'Erreur lors de l\'insertion';}
                              
        }else{ echo 'Veuillez Remplire tout les champs';} // Verification des champs vides
                                  
    } //Fin categorie Formation
} //Fin POST
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Déposer une annonce</title>
	<link rel="stylesheet" type="text/css" href="css3/depot.css">
	<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
	<style>
    .dropbtn {
  background-color: white;
color: #3282C1;
padding: 6px;
font-size: 16px;
border: none;
cursor: pointer;
width: 160px;
font-size: 25px;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #f1f1f1;
}

.dropdown {
   position: relative;
display: inline-block;
float: right;
margin-top: 25px;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 16px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
    width: 160px;
}

.dropdown-content a {
  color: black;
padding: 12px 16px;
text-decoration: none;
display: block;
font-size: 16px;
margin: 0;
float: none;
    font-weight: 600;
}

.dropdown a:hover {background-color: #ddd}
        .show {display:block;}
        input[type=search] {
  padding: 6px;
  margin-top: 16px;
  font-size: 17px;
  border: 2px solid rgba(46,62,72,.12);
            margin-left: 15px;
}
        .posta {
    color: white;
    margin-right: 50px;
    border-radius: 5px;
    cursor: pointer;
            background-color: #EE4957;
            padding: 5px 10px;
            font-size: 20px;
}
        a.posta:hover {
    color: white;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 3px 10px 0 rgba(0,0,0,0.19);
            
}
    </style>
</head>
	<script src="verfi.js"></script>

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
		<section style="display:flex">
<form  name='formulaire' method="post" action=""  enctype="multipart/form-data" onsubmit="return verifForm(this)"  >
				<div id="formulaire">
				<div>
					<h3>Déscription de votre annonce</h3>
					<label>Catégorie de l'annonce</label>
                    

					<select  name="categorie" id="catégorie" onchange="document.location.href = this.value;">
						<option value='formationx.php' >Formations</option>
						<option value='recrutement.php' >Recrutement</option>
						<option value='logementx.php' >Logement</option>
						<option value='evenement.php' >Evénements</option>
						<option value='decouverte.php' >Découverte/Excursions</option>
					</select ><br/>
                
                <div id="Formations" >
						<label>Domaine :</label>
						<select name="domaines">
							<option value='langues' <?php if($domaineFor=='langues') echo 'selected'; ?> >Langues</option>
							<option value='informatique' <?php if($domaineFor=='informatique') echo 'selected'; ?> >Informatique</option>
							<option value='bureautique' <?php if($domaineFor=='bureautique') echo 'selected'; ?> >Bureautique</option>
							<option value='Ressources_humaines' <?php if($domaineFor=='Ressources_humaines') echo 'selected'; ?> >Ressources humaines</option>
							<option value='Finance' <?php if($domaineFor=='Finance') echo 'selected'; ?> >Finance</option>
							<option value='Marketing-Communication' <?php if($domaineFor=='Marketing-Communication') echo 'selected'; ?> >Marketing-Communication</option>
							<option value='Comptablité' <?php if($domaineFor=='Comptablité') echo 'selected'; ?> >Comptabilité</option>
							<option value='Tourisme' <?php if($domaineFor=='Tourisme') echo 'selected'; ?> >Tourisme</option>
							<option value='Autre' <?php if($domaineFor=='Autre') echo 'selected'; ?> >Autre</option>	
						</select><br/>
				</div>
                <br/><label>Titre de l'annonce :  * </label>
                    <input  onkeyup="verifTitreK(this)" onblur="verifTitre(this)" id ="titreF"  type="text" name="titre"  value="<?php echo $titre;   ?>" >
                        <br/>
                    <p id ="msg1"></p><p id ="msg1a"></p>

                        <span class="error"> <?php echo $titreEr; ?></span>
        <label>Déscription :  * </label><textarea id="descriptionF" name="description" onkeyup="verifDescK(this)" onblur="verifDesc(this)" rows="5" cols="50" ><?php echo $description;   ?> </textarea> 
                    <br/>
                    <p id ="msg2"></p><p id ="msg2a"></p>

                    <span class="error"> <?php echo $descEr; ?></span>
             </div>
                 
         
                    
            <div id="DetailsFormation">
					<h3>Details de votre annonce :  *</h3>
						<label>Date de début : *  </label><input type="date" id="dateForF" name="dateFor" onblur="madate(this)" required value="<?php echo $dateFor; ?>" ><br/> 
                       <p style =" margin-bottom: 0px ; 
                            margin-top: 0px ; 
                                padding: 0px ;  
                            margin-left: 15px ; 
                    color : #EE4957; 
                    font-weight: bold;"id="msg13"></p> <p id="msg13a"></p>
                        <span class="error"> <?php echo $dateEr; ?></span> 
						<label>Etablissement :  *  </label><input type="text" id="etablissementForF" onblur="verifEta(this)" onkeyup ="verifEtaK(this)"name="etablissementFor" value="<?php echo $etablissementFor ; ?>" ><br/>
                       	<p id ="msg5"></p><p id="msg5a"></p><p id ="msg5b"></p>
                        <span class="error"> <?php echo $etabEr; ?></span> 
						<label>Adresse :  * </label><input type="text" id="adresseForF" name="adresseFor" onblur="verifAdr(this)" onkeyup="verifAdrK(this)" value="<?php echo $adresseFor ; ?>" ><br/>
                        <span class="error"> <?php echo $adresseEr; ?></span> 
                        <p id ="msg6"></p><p id ="msg6a"></p>

				</div>
                
                
                <div>
					<h3>Informations complémentaires</h3>
                    <h4 style="text-align = center ;">Veuillez renseigner au moins un des ces trois champs</h4>
                    
				        <label>Télephone : </label><input type="text" id ="telF" name="tel" onblur ="verifTel(this)" onkeyup="verifTelK(this)"
                       value="<?php echo $tel ; ?>" ><br/>
                        <span class="error"> <?php echo $telEr;?></span> 
                        <p id ="msg8"></p>

						<label>E-mail : </label><input type="email" id ="mailF" name="email" onblur ="verifMail(this)" onkeyup="verifMailK(this)" 
                       value="<?php echo $mail ; ?>" ><br/>
                        <span class="error"> <?php echo $mailEr;?></span>
                        <p id ="msg9"></p>

						<label>Site internet : </label><input type="text" id ="siteF" name="site" onblur ="verifLink(this)" onkeyup="verifLinkK(this)"
                       value="<?php echo $site ; ?>" ><br/>
                        <span class="error"> <?php echo $siteEr;?></span> 
                        <p id ="msg10"></p>
				</div>
                
                    
                <div>
					<h3>Images</h3>
						<p>Illustrez votre annonce(au format JPEG)
						
						<input type="file" name="image1" accept="image/*"></p>
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