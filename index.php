<?php 
session_start();

if($_SERVER['REQUEST_METHOD'] === "POST"){
include("includes/configuration.php");
include("includes/fonctions.php");
            try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
if(isset($_POST['password'])){
  $username = $_POST['login'];
  $password = $_POST['password'];
    $reponse = $bdd->query("SELECT *  FROM utilisateur WHERE pseudo='$username' or mail='$username'  ");
    $row = $reponse->fetch();
        if($reponse->rowCount() > 0){
              if(crypt($password ,$row['password']) == $row['password']){
                       $id=$row['id_utilisateur'];
                       $pseudo=$row['pseudo'];
                  $_SESSION['id'] =$id ;
                  $_SESSION['pseudo'] =$pseudo ;
               header("Location: categorie.php?user=$id");//rediriger la secretaire vers sa page 
                die;
                    }
  	}else {
  		echo "Pseudo/Mot de passe invalide";
  	}}else{
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
                }
      $lastname = test_input($_POST["lastName"]);
      $login = test_input($_POST["login"]) ;
      $email = test_input($_POST["email"]) ;
      $password = test_input($_POST["pwd1"]) ;
      $passwordd = test_input($_POST["pwd2"]) ;
 if (  (!empty($_POST["lastName"])) && (!empty($_POST["email"])) && (!empty($_POST["pwd1"])) && (!empty($_POST["pwd2"]))  ) {
  $errors = [] ; 
    if (!preg_match("#^[a-zA-Zéçàè]+[ \-']?[[a-zA-Zéçàè]+[ \-']?]*[a-zA-Zéçàè]+[ ]?$#",$lastname)) {
      $nameErr = "Le nom doit contenir au moins 3 lettres"; 
        $errors[] = "erreur" ; 
    }
    if (mb_strlen($login) < 4) {
      $loginErr = "le pseudo ne doit pas faire moins de 4 caractères"; 
                $errors[] = "erreur" ; 
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Adresse mail invalide "; 
                $errors[] = "erreur" ; 
    }
    if (mb_strlen($password) < 6) {
      $passwordErr = "le mot de passe doit faire au moins 6 caractères"; 
                $errors[] = "erreur" ; 
    }
    if ($passwordd != $password) {
      $passwordErrr = "Le mot de passe de confirmation doit être identique à celui d'origine"; 
                $errors[] = "erreur" ; 
    }
     
     if (is_already_in_use('pseudo',$login, 'utilisateur')){
               $loginErrr = "Ce pseudo existe déjà"; 
                 $errors[] = "erreur" ; 
     }
     if (is_already_in_use('mail',$email, 'utilisateur')){
               $mailErrr = "cette adresse mail existe déjà"; 
                 $errors[] = "erreur" ; 
     }
     $p=crypt($password,'rl'); 
    if(count($errors) == 0)  { 
    $sql="INSERT INTO utilisateur(nom,pseudo,mail,password) VALUES('$lastname','$login','$email','$p')";
        $sql2="SELECT id_utilisateur FROM utilisateur WHERE pseudo='$login'";
            if($bdd->query($sql)){
                 $r=$bdd->query($sql2);
                $line = $r->fetch();
                $id=$line['id_utilisateur'];
                $_SESSION['id'] =$id ;
                header("Location: categorie.php?user=$id");
                die;
                        }else
                        { echo "erreur lors de l'insertion"; }    }     
 } 
 else { $incomplete = " Tous les champs sont requis " ;} 
    }
}
if(isset($_SESSION['id'])){
    $id=$_SESSION['id']; 
   $existe=1;
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Acceuil-UMMTO annonces</title>
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
   <link rel="stylesheet" type="text/css" href="css/index.css"/>
    <link rel="stylesheet" type="text/css" href="css/modal.css"/>
       <link rel="stylesheet" media="all" href="css/style.css"  />
       	     	<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
   <style>
       .social{
           padding: 20px;
  font-size: 30px;
  width: 30px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 50%;
       }
       .social:hover{
            opacity: 0.7;
       }
       .fa-facebook-f {
           padding: 20px;
  font-size: 30px;
  width: 30px;
  text-align: center;
  text-decoration: none;
  margin: 5px 2px;
  border-radius: 50%;
  background: #3B5998;
  color: white;
}
 
       
       #slide00 : hover {
           width : 100px ; 
       }
       .reseau{
           width: 100%;
       }
     .fa-facebook-f,.fa-twitter,.fa-google-plus-g {
background-color: #F1F1F1;
color: #545454;
padding: 10px;
font-size: 20px;
width: 30px;
text-align: center;
text-decoration: none;
margin: 0px 10px 0px 10px;
border-radius: 100%;
width: 40px;
height: 40px;
}
    .svg-inline--fa.fa-w-9,.svg-inline--fa.fa-w-16,.svg-inline--fa.fa-w-20 {
    width: 40px;
}
    .fa-facebook-f:hover{
         background: #3B5998;
        color: white;
        opacity: 0.7;        
    }
       .fa-twitter:hover{
         background: #55ACEE;
        color: white;
        opacity: 0.7;        
    }
       .fa-google-plus-g:hover{
         background: #dd4b39;
        color: white;
        opacity: 0.7;        
    }
       .nomcat{
           margin-left: 12px;
           text-align: left;
       
       }
       .fl a:hover{
           color :white;
       }
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
}

.dropdown a:hover {background-color: #ddd}

.show {display:block;}
       /**/
       .overlay {
 position: absolute;
top: 0;
bottom: 0;
left: 0;
right: 0;
opacity: 0;
transition: .5s ease;
background-color: #fff;
width: 100%;
height: 100%;
}
       .annonce:hover .overlay {
  opacity: 1;
}
       .text {
  color: black;
font-size: 20px;
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
text-align: justify;
right: 0;
width: 230px;
height: 300px;
}
       .annonce {
  position: relative;
  width: 50%;
}
       .des{
           color: inherit;
           text-decoration: none;
       }
      
       .section1{
           margin-top: 600px;
       }
       #nav img{
           width: 1349px;
       }
    </style>
 
</head>
<body>
    <header>
    <div id="logo">
    
			<img src="newlogo.png" alt="">
		</div>
   <?php if(!isset($existe)){ ?>
    <button class='hea'  onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><i class="fas fa-user-plus"></i>Inscription</button>
       <button class='hea' onclick="document.getElementById('id01').style.display='block'" style="width:auto;">
       <i class="fas fa-sign-in-alt"></i>Connexion</button>
       <div id="id01" class="modal">
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
     <span><h2><i class="fas fa-sign-in-alt"></i>Connexion</h2></span>
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="container">
    <label for="uname"><b>Pseudo ou adresse e-mail</b></label> 
        <input class="entrer" id ="nom" type="text" placeholder="Entrer votre pseudo ou adresse e-mail" name="login" required="required">
       <div style="color:#f44336" id="erreurnom"></div>
      <label for="psw"><b>Mot de passe</b></label>
          <input class="entrer" type="password" placeholder="Entrer votre mot de passse " id="password"name="password" required='required'>
          <div  style="color:#f44336;display:block" id="erreurpas"></div> 
      <button id="submit" type="submit">Connexion</button>
    </div>
   
  </form>
</div> 
       <div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close2" title="Close Modal">&times;</span>
  <form class="modal-content" action="" method="post">
    <div class="container">
     <span><h2><i class="fas fa-user-plus"></i>Inscription</h2></span>
      
      <label for="email"><b>Nom</b></label>
      <input class="entrer" type="text" placeholder="Entrer votre Nom" name="lastName" id="lastName" required='required'>
      <div style="color:#f44336" id="erreurnom" ></div>

      <label for="psw"><b>Pseudo</b></label>
      <input class="entrer" type="text" placeholder="Entrer votre pseudo" name="login" id="login" required='required'>
      <div style="color:#f44336" id="erreurpseudo" ></div>

      <label for="psw-repeat"><b>E-mail</b></label>
      <input class="entrer" name="email"  id ="email" type="email" placeholder="Entrer votre e-mail" required='required'>
      <div style="color:#f44336" id="erreurmail" ></div>
      
      <label for="psw-repeat"><b>Mot de passe</b></label>
      <input class="entrer" name="pwd1" id="pwd1" type="password" placeholder="Entrer votre mot de passe" required='required'>
      <div style="color:#f44336" id="erreurpwd1" ></div>
      
      <label for="psw-repeat"><b>Confirmez le mot de passe</b></label>
      <input class="entrer" name="pwd2" id="pwd2" type="password" placeholder="Confirmez votre mot de passe" required='required'>
      <div style="color:#f44336" id="erreurpwd2" ></div>
    
      <div class="clearfix">
    
        <button type="submit" class="signupbtn" id="btn">Inscription</button>
      </div>
    </div>
  </form>
</div>
   <?php }else{?>
   <a title="Déconnexion" href="http://localhost/annonce/php/deconnexion.php" style="font-size:2em;width:40px;overflow:visible;cursor:pointer"><i class="fas fa-sign-out-alt"></i></a>
   <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><i class="fas fa-user"></i></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="categorie.php?user=<?php echo $id; ?>">Mes annonces</a>
    <a href="#about">Paramètres</a>
       </div></div>

   <?php } ?>
	      <?php if(!isset($existe)){ ?>
	   <a class ="posta" onClick="aler()">+Poster une annonce</a> <?php }else{ ?>	
	   <a class ="posta" href="formationx.php">+Poster une annonce</a><?php } ?>	
	</header>
    		<nav>		
    <form action="categorie.php" method="post" class ="recherche"  >      
        <legend><h3>Le nouveau coin des étudiants</h3></legend>
		    <input id="recherche" class="rechercheinput" maxlength="20" minlength="4" type="text" placeholder="Recherche..." name="q">
              <button id="sub" type="submit"><i class="fa fa-search"></i></button> 
              </form> 
<img class="mySlides" src="students1.jpg" > 
<img class="mySlides" src="books1.jpg" > 
<img class="mySlides" src="amphi.jpg" > 
<img class="mySlides" src="tamda2.jpg" > 
<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
</script>                     
<div id ="cat">
    <a href="categorie.php?c=formation">Formations</a>
    <a href="categorie.php?c=travail">Recrutements</a>
    <a href="categorie.php?c=evenement">Evenements</a>
    <a href="categorie.php?c=sortie">Excursions</a>
    <a href="categorie.php?c=logement">Logements</a>
</div>
       </nav>
            <section class="section1" >
                <nav class="categories" style="min-height:757px">
                   <h3>Categories</h3>
		<ul id="menu">
			<li><div id="categorie_1" class="categorie"><p><a href="categorie.php?c=travail">Rectutements</a><i id="down_1" class="fas fa-angle-down"></i><i id="up_1" class="fas fa-angle-up"></i></p></div>
			<ul id="sous_categorie_1" class="sous_categorie">
				<li><a href="categorie.php?c=travail&t=stage">Offre d'emploi</a></li>
				<li><a href="categorie.php?c=travail&t=travail">Offre de stage</a></li>
			</ul></li>
			<li><div id="categorie_2" class="categorie"><a href="categorie.php?c=logement">Logement</a><i id="down_2" class="fas fa-angle-down"></i> 
                                                <i id="up_2" class="fas fa-angle-up"></i></div>
			<ul id="sous_categorie_2" class="sous_categorie">
				<li><a href="categorie.php?c=logement&t=location"><span>Location</span></a></li>
				<li><a href="categorie.php?c=logement&t=colocation"><span>Colocation</span></a></li>
			</ul></li>
			<li><div id="categorie_3" class="categorie"><a href="categorie.php?c=formation">Formations</a><i id="down_3" class="fas fa-angle-down"></i> 
                                                <i id="up_3" class="fas fa-angle-up"></i></div>
			<ul id="sous_categorie_3" class="sous_categorie">
				<li><a href="categorie.php?c=formation&t=langues">Langues</a></li>
				<li><a href="categorie.php?c=formation&t=informatique">Informatique</a></li>
				<li><a href="categorie.php?c=formation&t=burautique">Bureautique</a></li>
				<li><a href="categorie.php?c=formation&t=Ressources_humaines">Ressources humaines</a></li>
				<li><a href="categorie.php?c=formation&t=Finance">Finance</a></li>
				<li><a href="categorie.php?c=formation&t=Marketing-Communication">Marketing-Communication</a></li>
				<li><a href="categorie.php?c=formation&t=Comptabilité">Comptabilité</a></li>
				<li><a href="categorie.php?c=formation&t=Tourisme">Tourisme</a></li>
				<li><a href="categorie.php?c=formation&t=Autre">Autre</a></li>	
			</ul></li>
			<li><div id="categorie_4" class="categorie"><a href="categorie.php?c=evenement">Evénements</a><i id="down_4" class="fas fa-angle-down"></i> 
                                                <i id="up_4" class="fas fa-angle-up"></i></div>
			<ul id="sous_categorie_4" class="sous_categorie">
				<li><a href="categorie.php?c=evenement&t=Meet-up/Conférances">Meet-up/Conférances</a></li>
				<li><a href="categorie.php?c=evenement&t=Salon/Expositions">Salon/Expositions</a></li>
				<li><a href="categorie.php?c=evenement&t=Galas/Concerts/Spectacle">Galas/Concerts/Spectacle</a></li>
				<li><a href="categorie.php?c=evenement&t=Cinéma">Cinéma</a></li>
				<li><a href="categorie.php?c=evenement&t=Evènements_sportifs">Evènements sportifs</a></li>
				<li><a href="categorie.php?c=evenement&t=Autre">Autre</a></li>
			</ul></li>
			<li><div id="categorie_5" class="categorie"><a href="categorie.php?c=sortie">Découverte/<br><span style="color:white">0</span> Excursions</a></div>
			</li>
		</ul>
                </nav>
                <article >
                 <h3 style="float=left" >A la une </h3>
                  
   <div class="your-class slider" >
   <?php
 try
        {
           $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());}
             $sql="SELECT id_annonce,titre,description,date(date_public) as d,hour(date_public) as h,minute(date_public) as m FROM annonce WHERE valide=1 ORDER BY date_public DESC LIMIT 10  ";
           $resultat = $bdd->query($sql);
            if(!empty($resultat)){
                 while( $line = $resultat->fetch()){
                     $id=$line['id_annonce'];
                    
                     $image=$bdd->query("SELECT photo FROM photo where id_annonce='$id'");
                     while( $photo = $image->fetch()){
                                  $pho=$photo['photo'];
                                }
        ?>
   

    <div class="annonce">
       <div class="image" style='background-image: url("image/<?php echo $pho; ?>");'>
      
        
        </div>
         
        <div class="description">
        <h4 class="titre"><span><?php echo ''.$line['titre'].''; ?></span ></h4>
        <div class="annonceur">
            <div class="annonceu">
                
                  <p class="nom"><span>Publié Le : <?php echo ''.$line['d'].' a '.$line['h'].':'.$line['m'].''; ?></span></p>
            </div>
        </div>
       </div><a class="des" href="detail_utilisateur.php?id=<?php echo $line['id_annonce'];  ?>">
       <div class="overlay">
    <div class="text"><?php echo ''.$line['description'].''; ?></div>
  </div>
        </a>
    </div>  <?php }}   ?>
    
  


       </div> 
                </article>
                
            </section> 
            <footer class="footer">
            <section class="section2" >
            <div class="row">
  <div class="column" >
   <h4 class="nomcat"><a href="categorie.php?c=travail">Recrutements</a></h4>
      <ul class="fl">
          <li><div class="divl"><p><a class="ll" href="categorie.php?c=travail&t=emploi">Offre d'emploi</a></p></div></li>
          <li><div class="divl"><p><a class="ll" href="categorie.php?c=travail&t=stage">Offre de stage</a></p></div></li>
       </ul>
  </div>
  <div class="column" ><h4 class="nomcat"><a href="categorie.php?c=logement">Logement</a></h4>
          <ul class="fl">
              <li><div class="divl"><p><a href="categorie.php?c=logement&t=location">Location</a></p></div></li>
              <li><div class="divl"><p><a href="categorie.php?c=logement&t=colocation">Colocation</a></p></div></li>
          </ul>
  </div>
  <div class="column" >
  <h4 class="nomcat"><a href="categorie.php?c=formation">Formation</a></h4>
  <ul class="fl">
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Langues">Langues</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Informatique">Informatique</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Bureautique">Bureautique</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Ressources_humaines">Ressources humaines</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Finance">Finance</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Marketing-Communication">Marketing-Communication</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Comptabilité">Comptabilité</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Tourisme">Tourisme</a></p></div></li>
      <li><div class="divl"><p><a class="ll" href="categorie.php?c=formation&t=Autre">Autre</a></p></div></li>	
  </ul></div>
 
  
  <div class="column" ><h4 class="nomcat"><a href="categorie.php?c=evenement">Evénements</a></h4>
      <ul class="fl">
          <li><div class="divl"><p><a href="categorie.php?c=evenement&t=Meet-up/Conférances">Meet-up/Conférances</a></p></div></li>
          <li><div class="divl"><p><a href="categorie.php?c=evenement&t=Salon/Expositions">Salon/Expositions</a></p></div></li>
        <li><div class="divl"><p><a href="categorie.php?c=evenement&t=Galas/Concerts/Spectacle">Galas/Concerts/Spectacle</a></p></div></li>
          <li><div class="divl"><p><a href="categorie.php?c=evenement&t=cinéma">Cinéma</a></p></div></li>
          <li><div class="divl"><p><a href="categorie.php?c=evenement&t=Evènement_sportifs">Evènements sportifs</a></p></div></li>
          <li><div class="divl"><p><a href="categorie.php?c=evenement&t=Autre">Autre</a></p></div></li>
      </ul>
  </div>
                <div class="column" ><h4 class="nomcat"><a href="categorie.php?c=sortie">Découverte/Excursions</a></h4>
               
                  </div>
            
</div>
      
  
  </section>
  <div class="reseau">
    <p class="r" style="float:right">
    <a href="www.google.com" ><i class="fab fa-facebook-f"></i></a>
    <a href=""><i class="fab fa-twitter"></i></a>
      <a href=""><i class="fab fa-google-plus-g"></i></a>
    </p> 
 </div>
  
  
 
</footer>    
            

   
	 <script src="jquery-3.3.1.min.js"></script>


    <script type="text/javascript" src="slick/slick.min.js"></script> 
    <script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
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
     $(document).ready(function(){
     $('.sous_categorie').hide();
      $('.your-class').slick({
          slidesToShow: 3,
          slidesToScroll: 1,
          dots:true, 
          autoplay: false,
          autoplaySpeed: 2000,
      });
          $('#down_1').click(function(){
               $('#down_2').show();
              $('#down_3').show();
              $('#down_4').show();
            $('#up_2').hide();
              $('#up_3').hide();
              $('#up_4').hide();
                 $('#categorie_2').removeClass('BABABA');
              $('#categorie_3').removeClass('BABABA');
              $('#categorie_4').removeClass('BABABA');
               $('#down_1').hide();
             
              $('#up_1').show();
              $('.sous_categorie').slideUp('normal');
              $('#categorie_1').addClass('BABABA');
             $('#sous_categorie_1').slideDown('normal');      
        });
         $('#up_1').click(function(){
               $('#up_1').hide();
              $('#down_1').show();
              $('#categorie_1').removeClass('BABABA');
             $('.sous_categorie').slideUp('normal');
        });
         $('#down_2').click(function(){
              $('#down_1').show();
              $('#down_3').show();
              $('#down_4').show();
              $('#up_1').hide();
              $('#up_3').hide();
              $('#up_4').hide();
              $('#categorie_1').removeClass('BABABA');
              $('#categorie_3').removeClass('BABABA');
              $('#categorie_4').removeClass('BABABA');
              $('#down_2').hide();          
              $('#up_2').show();
              $('.sous_categorie').hide(); 
                $('#categorie_2').addClass('BABABA');
             $('#sous_categorie_2').slideDown('normal');      
        });
          $('#up_2').click(function(){
               $('#up_2').hide();
              $('#down_2').show();
                 $('#categorie_2').removeClass('BABABA');
             $('.sous_categorie').slideUp('normal');
        });
         $('#down_3').click(function(){
              $('#down_1').show();
              $('#down_2').show();
              $('#down_4').show();
              $('#up_1').hide();
              $('#up_2').hide();
              $('#up_4').hide();
              $('#categorie_2').removeClass('BABABA');
              $('#categorie_1').removeClass('BABABA');
              $('#categorie_4').removeClass('BABABA');
              $('#down_3').hide();          
              $('#up_3').show();
              $('.sous_categorie').hide();  
                $('#categorie_3').addClass('BABABA');
             $('#sous_categorie_3').slideDown('normal');      
        });
         $('#up_3').click(function(){
               $('#up_3').hide();
              $('#down_3').show();
                $('#categorie_3').removeClass('BABABA');
             $('.sous_categorie').slideUp('normal');
        });
          $('#down_4').click(function(){
              $('#down_1').show();
              $('#down_2').show();
              $('#down_3').show();
              $('#up_1').hide();
              $('#up_2').hide();
              $('#up_3').hide();
               $('#categorie_2').removeClass('BABABA');
              $('#categorie_3').removeClass('BABABA');
              $('#categorie_1').removeClass('BABABA');
              $('#down_4').hide();          
              $('#up_4').show();
              $('.sous_categorie').hide(); 
                 $('#categorie_4').addClass('BABABA');
             $('#sous_categorie_4').slideDown('normal');      
        });
          $('#up_4').click(function(){
               $('#up_4').hide();
              $('#down_4').show();
            $('#categorie_4').removeClass('BABABA');
             $('.sous_categorie').slideUp('normal');
        });
           $('#recherche').blur(function(){
              valid=true;
                                          
       if($('#recherche').val().length<4){
                valid=false;
          } });
          $('#sub').click(function(){
              if($('#recherche').val()==""){
                valid=false;
          }
              if($('#recherche').val().length<4){
                valid=false;
          }
              
            return valid;  
            
        });
     });
    </script> 
      <script>
// Get the modal
var modal = document.getElementById('id02');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
  <script>
         $(function(){ 
             $('#lastName').blur(function(){
              valid3=true;
          if($('#lastName').val()==""){
                valid3=false;
                $('#lastName').css('border','1px solid #f44336');
                $('#lastName').next("#erreurnom").show().text("Nom obligatoire.");
          }                                   
          else if(!$("#lastName").val().match(/^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/) && $('#lastName').val().length<3){
                valid3=false;
                $('#lastName').css('border','1px solid #f44336');
                $('#lastName').next("#erreurnom").show().text("Nom invalide et trop court minimum 3 caractères.");
          } 
          else if(!$("#lastName").val().match(/^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/) ){
                valid3=false;
              $('#lastName').css('border','1px solid #f44336');
                $('#lastName').next("#erreurnom").show().text("Nom invalide.");
          }   
          else if($('#lastName').val().length<3){
                valid3=false;
              $('#lastName').css('border','1px solid #f44336');
                $('#lastName').next("#erreurnom").show().text("Nom trop court minimum 3 caractères.");
          } 
          else{
              $('#lastName').css('border','');
                $('#lastName').next("#erreurnom").hide().text('');
          }});
        $('#lastName').keyup(function(){
            if($('#lastName').val().length>=3 && $("#lastName").val().match(/^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/) && $('#lastName').val()!=""){
                $('#lastName').css('border','');
            $('#lastName').next("#erreurnom").show().text("");}
        });
        
        $('#login').blur(function(){
            valid1=true;
            pseudo= $('#login').val();
            $.ajax({
                type:"POST",
                url:"php/inscrit.php",
                data:'pseudo=' + pseudo,
                success:function(data){               
          if(data == 1){
              valid1=false;
              $('#login').css('border','1px solid #f44336');
              $('#login').next("#erreurpseudo").fadeIn().text('Ce pseudo est déjà utilisé. Essayez un autre pseudo.');
                      }
          else if($('#login').val()==""){
              valid1=false;
              $('#login').css('border','1px solid #f44336');
              $('#login').next("#erreurpseudo").show().text("Pseudo obligatoire.");
                }
          else if(!$("#login").val().match(/^[a-zéçàè0-9]+$/i)){
              valid1=false;
              $('#login').css('border','1px solid #f44336');
              $('#login').next("#erreurpseudo").show().text("Pseudo invalide.");
                  }
          else  if($('#login').val().length<3){
               valid1=false;
              $('#login').css('border','1px solid #f44336');
               $('#login').next("#erreurpseudo").show().text("Pseudo trop court minimum 3 caractères.");
                  }
          else{ 
              $('#login').css('border','');
              $('#login').next("#erreurpseudo").hide().text('');    
              }}});      
              });
        $('#login').keyup(function(){
            if($('#login').val().length>=3 && $("#login").val().match(/^[a-zéçàè0-9]+$/i) && $('#login').val()!=""){
                 $('#login').css('border','');
            $('#login').next("#erreurpseudo").show().text("");}
        });
       
        $('#email').blur(function(){
            valid2=true;
            mail= $('#email').val();
            $.ajax({
                type:"POST",
                url:"php/mail.php",
                data:'mail=' + mail,
                success:function(data){
      if(data == 1){
        valid2=false;
          $('#email').css('border','1px solid #f44336');
        $('#email').next("#erreurmail").fadeIn().text("Cette adresse e-mail est déjà enregistrer. Essayez un autre e-mail.");
                    }
      else if($('#email').val()==""){
              valid1=false;
          $('#email').css('border','1px solid #f44336');
              $('#email').next("#erreurmail").show().text("E-mail obligatoire.");
                }            
      else if(!$("#email").val().match(/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/)){
        valid2=false;
          $('#email').css('border','1px solid #f44336');
        $('#email').next("#erreurmail").show().text("mail invalide.");
            }
      else  if($('#email').val().length<3){
        valid2=false;
          $('#email').css('border','1px solid #f44336');
        $('#email').next("#erreurmail").show().text("Nom trop court minimum 3 caractères.");
            }
      else{ 
          $('#email').css('border','');
        $('#email').next("#erreurmail").hide().text('');    
                    } } });});
        
        $('#email').keyup(function(){
            valid2=true;
            mail= $('#email').val();
            $.ajax({
                type:"POST",
                url:"php/mail.php",
                data:'mail=' + mail,
                success:function(data){
        if(data == 1){
                valid2=false;
                    }
        else if(!$("#email").val().match(/^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/)){
                valid2=false;
            }
        else if($('#email').val().length<3){
                valid2=false;
            } }});  });
        
         $('#pwd1').blur(function(){
              valid4=true;
          if($('#pwd1').val()==""){
                valid4=false;
              $('#pwd1').css('border','1px solid #f44336');
                $('#pwd1').next("#erreurpwd1").show().text("Entrez un mot de passe.");
          }                                     
          else if($('#pwd1').val().length<8){
                valid4=false;
              $('#pwd1').css('border','1px solid #f44336');
                $('#pwd1').next("#erreurpwd1").show().text("Utilisez 8 caractères ou plus pour votre mot de passe.");
          } 
          else{
               $('#pwd1').css('border','');
                $('#pwd1').next("#erreurpwd1").hide().text('');
          }});
        $('#pwd1').keyup(function(){
            if($('#pwd1').val().length>=8 && $('#pwd1').val()!=""){
                  $('#pwd1').css('border','');
            $('#pwd1').next("#erreurpwd1").show().text("");}
        });
        $('#pwd2').blur(function(){
              valid5=true;
          if($('#pwd2').val()=="" && $('#pwd1').val()!=""){
                valid5=false;
              $('#pwd2').css('border','1px solid #f44336');
                $('#pwd2').next("#erreurpwd2").show().text("Confirmez votre mot de passe.");
          }                                     
          else if($('#pwd1').val() != $('#pwd2').val()){
                valid5=false;
              $('#pwd2').css('border','1px solid #f44336');
                $('#pwd2').next("#erreurpwd2").show().text("Les mots de passe ne correspondent pas. Veuillez réessayer.");
          } 
          else{
               $('#pwd2').css('border','');
                $('#pwd2').next("#erreurpwd2").hide().text('');
          }});
        $('#pwd2').keyup(function(){
            if($('#pwd1').val() == $('#pwd2').val() && ($('#pwd2').val()!="" && $('#pwd1').val()!="")){
                $('#pwd2').css('border','');
            $('#pwd2').next("#erreurpwd2").show().text("");}
        });
              $('#btn').click(function(){
            if(valid1==true && valid2==true && valid3==true && valid4==true && valid5==true){
                valid=true;
                return valid; 
            }else{
                valid=false;
                return valid;
            } 
        });
             $('#nom').keyup(function(){
            valid1=true;
                 valid2=true;
           
            pseudo= $('#nom').val();
            passwor=$('#password').val();
            
            $.ajax({
                type:"POST",
                url:"php/connexio.php",
                data:'pseudo=' + pseudo +'&passwor='+passwor,
                success:function(data){
                 if(data == 1){
                        valid1=false;
       
                    }else if( data==2){
                        valid2=false;
                    }
                }
            });
            
        });
             $('#password').keyup(function(){
            valid1=true;
                 valid2=true;
           
            pseudo= $('#nom').val();
            passwor=$('#password').val();
            
            $.ajax({
                type:"POST",
                url:"php/connexio.php",
                data:'pseudo=' + pseudo +'&passwor='+passwor,
                success:function(data){
                    
                    
                 if(data == 1){
                        valid1=false;
       
                    }else if( data==2){
                        valid2=false;
        
                    }
                }
            }); 
        });
        $('#submit').click(function(){
            if(valid1==false){
                  $('#nom').css('border','');
                    $('#nom').next("#erreurnom").hide().text(''); 
                $('#password').css('border','1px solid #f44336');
             $('#password').next("#erreurpas").fadeIn().text('mot de passe incorrecte ');
                 return false;
            }else if(valid2==false){
                 $('#password').css('border','');
                  $('#password').next("#erreurpas").hide().text(''); 
             $('#nom').next("#erreurnom").fadeIn().text("login/e-mail incorrecte ");
                $('#nom').css('border','1px solid #f44336');
                return false;
            }else{
                valid=true;
                return valid;
                    }
        });
    });
    </script>
<script>
// Get the modal
var modal = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
function aler() { alert("Vous devez posseder un compte pour pouvoir poster une annonce  !!"); }
</script>

</body>
</html>