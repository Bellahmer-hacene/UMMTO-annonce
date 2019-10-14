<?php
if($_SERVER['REQUEST_METHOD'] === "POST")
{
                $categorie=htmlspecialchars($_POST['categorie']);
                $titre=htmlspecialchars($_POST['titre']);
                $LieuDepartDec=htmlspecialchars($_POST['LieuDepartDec']);
                $description=htmlspecialchars($_POST['description']);
                $dateDec=htmlspecialchars($_POST['dateDec']);
                $LieuArriveeDec=htmlspecialchars($_POST['LieuArrivéeDec']);
                $prixDec=htmlspecialchars($_POST['prixDec']);
                $horaireDec=htmlspecialchars($_POST['horaireDec']);
                $tel=htmlspecialchars($_POST['tel']);
    $sql="INSERT INTO annonce(id_utilisateur,titre,description) VALUES('1','$titre','$description')";
                            $bdd->query($sql);    
    
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


	<title>Déposer une annonce</title>
	<link rel="stylesheet" type="text/css" href="css/depot.css">
</head>
<body>
<script src="verfi.js"></script>
<header>
     
   
    
    <div id="logo">
			<img src="newlogo.png" alt="">
		</div>
        <div id ="menu ">    
        <a style="font-size:2em"  href=""><i class="fas fa-sign-out-alt"></i></a>
       <a style="font-size:2em" href=""><i class="fas fa-user-cog"></i></a>
	   <a style="font-size:2em" href=""><i class="fas fa-plus-square"></i></a> 

</div>

		
	</header>
	

		

	
       
		
		<section>
			<form  method="post" action="" onsubmit="return verifForm(this)"  >
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

						<option>Formations</option>
						<option>Recrutement</option>
						<option>Logement</option>
						<option>Evénements</option>
						<option>Découverte/Excursions</option>
					</select ><br/>
					<div id="Formations">
						<label>Domaine :</label>
						<select>
							<option>Langues</option>
							<option>Informatique</option>
							<option>Bureautique</option>
							<option>Ressources humaines</option>
							<option>Finance</option>
							<option>Marketing-Communication</option>
							<option>Comptabilité</option>
							<option>Tourisme</option>
							<option>Autre</option>	
						</select><br/>
					</div>
					<div id="Recrutement" style="display: none;">
					<label>Type de travail :</label>
						
						<input type="radio" name="travail" value="emploi" id="emploi" checked="checked"><label for="emploi">Offre d'emploi</label>
                        <input type="radio" name="travail" value="stage" id="stage" ><label for="stage">Offre de stage</label>
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
						<label>Type d'événement :</label><select>
							<option>Meet-up/Conférances</option>
							<option>Salon/Expositions</option>
							<option>Galas/Concerts/Spectacle</option>
							<option>Cinéma</option>
							<option>Evènements sportifs</option>
							<option>Autre</option>
						</select><br/>
					</div>
					
						<br/><label>Titre de l'annonce : </label>
						<input name="titre" type="text" name="titre" onkeyup="verifTitrep(this)" onblur="verifTitre(this)"><span>*</span><br> 
						<p id ="msg1"></p><p id ="msg1a"></p>

						<label>Déscription : </label>
						<textarea name="description" rows="5" cols="50" onkeyup="verifDesc(this)"></textarea>
						<span>*</span><br/>
						<p id ="msg2"></p><p id ="msg2a"></p>
				</div>
				<div id="DetailsRecrutement" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Domaine : </label>
						<input type="text" name="Domaine" onkeyup="verifDom(this)"><br/>
						<p id ="msg3"></p><p id ="msg3a"></p><p id ="msg3b"></p>
						<label>Etablissement : </label>
						<input type="text" name="Etablissement" onkeyup="verifEta(this)" ><br/>
						<p id ="msg5"></p><p id ="msg5a"></p><p id ="msg5b"></p>
						<label>Adresse : </label>
						<input type="text" name="Adresse" onkeyup="verifAdr(this)" ><br/>
						<p id ="msg6"><p id ="msg6a">
						<label>Salaire mensuel : </label>
						<input type="text" name="Salaire" onkeyup="verifSalaire(this)"><br/>
						<p id ="msg4"></p><p id ="msg4a"></p><p id ="msg4b"></p>
				</div>
				<div id="DetailsLogement" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Adresse : </label><input type="text" name="Adresse" onkeyup="verifAdrr(this)"><span>*</span> <br/>
						<p id ="msg6x"><p id ="msg6ax">
				
						<label>Type du logement : </label>
							<select name="Type">
							<option>Chambre</option>
							<option>Studio</option>
							</select><br/>
						<label>Surface : </label><input type="text" name="Surface" onkeyup="verifSurf(this)"><span>*</span> m²<br/>
						<p id ="msg7"></p><p id ="msg7a"></p><p id ="msg7b"></p>
						<label>Loyer mensuel : </label><input type="text" name="Loyer"onkeyup="verifLoyer(this)"><span>*</span> DZD<br/>
						<p id ="msg11"></p><p id ="msg11a"></p><p id ="msg11b"></p>
				</div>
				<div id="DetailsFormation">
					<h3>Details de votre annonce :</h3>
						<label>Date de début : </label>
						<input type="date" name="Date"><br/>
						<label>Etablissement : </label>
						<input type="text" name="Etablissement" onkeyup="verifEtaa(this)" ><br/>
				        <p id ="msg5x"></p><p id ="msg5ax"></p><p id ="msg5bx"></p>

						<label>Adresse : </label>
						<input type="text" name="Etablissement" onkeyup="verifAdrrr(this)"><br/>
						<p id ="msg6z"><p id ="msg6azz">
						
				</div>
				<div id="DetailsEvenement" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Date : </label><input type="date" name="Date"><br/>
						<label>Horraire : </label>
							<select>
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
						<label>Salle ou établissement : </label>
                        <input type="text" name="Etablissement" onblur="verifEtaaa(this)" ><br/>
                        <p id ="msg5z"></p><p id ="msg5az"></p><p id ="msg5bz"></p>

						<label>Adresse : </label>
						<input type="text" name="Adresse" onkeyup="verifAdre(this)"><br/>
						<p id ="msg6e"></p><p id ="msg6ae"></p>
						
                       <label>Organisateur : </label>
                        <input type="text" name="Organisateur" onkeyup="verifOrg(this)"><br/>
				        <p id ="msg3o"></p><p id ="msg3ao"></p><p id ="msg3bo"></p>

				</div>
				<div id="DetailsExcursion" style="display: none;">
					<h3>Details de votre annonce :</h3>
						<label>Date : </label><input type="date" name="Date"><span> *</span><br/>
						<label>Horraire de départ : </label>
							<select>
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
						<label>lieu de départ : </label>
						<input type="text" name="LieuDepart" ><span>*</span><br/>
						
						<label>Lieu d'arrivée : </label>
						<input type="text" name="LieuArrivée" ><span>*</span><br/>
						
						<label>Prix : </label>
						<input type="text" name="Prix"><br/>
						
						
				</div>
				<div>
					<h3>Informations complémentaires</h3>
						<label>Télephone : </label><input type="text" name="Tel"  onkeyup= "verifTel(this)"><br/><p id ="msg8"></p>
						<label>E-mail : </label><input type="email" name="Email" onkeyup= "verifMail(this)"><br/><p id ="msg9"></p>
						<label>Site internet : </label><input type="text" name="Site" onkeyup= "verifLink(this)" ><br/><p id ="msg10"></p>
				</div>
				 <div>
					<h3>Images</h3>
						<p>Illustrez votre annonce
						
						<input type="file" name="image1" value="" ></p>
						<div  id="plus" style="display: block;">
							<p>
							<input type="button" name="plus" value=" Plus d'images"
                       onclick="document.getElementById('image2').style.display='block';document.getElementById('plus').style.display='none'"> (Jusqu'a 4 images)</p>
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