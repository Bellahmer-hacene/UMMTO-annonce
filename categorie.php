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
                 header("Location: categorie.php?user=$id");
                die;
                    }
  	}else {
  		echo "Pseudo/Mot de passe invalide";
  	}}elseif(isset($_POST["lastName"])){
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
   $existe=1;
    $id=$_SESSION['id'];
}
if(isset($_GET['user']) ){
   $user=$_GET['user'];
   
$sql="SELECT id_annonce as id_annonce,titre,description,date(date_public) as d,hour(date_public) as h,minute(date_public) as m  FROM annonce where id_utilisateur=$user";  }

elseif(isset($_GET['c']) AND isset($_GET['t']) ){
   $c= htmlspecialchars($_GET['c']);
    $t=htmlspecialchars($_GET['t']);
    
    $n=1;
$sql="SELECT a.id_annonce as id_annonce,titre,description,date(date_public) as d,hour(date_public) as h,minute(date_public) as m  FROM annonce a,$c t WHERE valide=1 AND a.id_annonce=t.id_annonce and t.type_$c='$t'";
}

elseif(isset($_GET['c'])){
   $c=htmlspecialchars($_GET['c']);
   $n=2;
    $sql="SELECT a.id_annonce as id_annonce,titre,description,date(date_public) as d,hour(date_public) as h,minute(date_public) as m  FROM annonce a,$c t WHERE valide=1 AND a.id_annonce=t.id_annonce";
}
else{
    $n=3;
     $sql="SELECT id_annonce as id_annonce,titre,description,date(date_public) as d,hour(date_public) as h,minute(date_public) as m FROM annonce WHERE valide=1  ";
}
if(isset($_GET['q']) and !empty($_GET['q'])){
    
    $q=htmlspecialchars($_GET['q']);
    $s=explode(' ',$q);
$sql='SELECT id_annonce as id_annonce,titre,description,date(date_public) as d,hour(date_public) as h,minute(date_public) as m  FROM annonce ' ;
    $i=0;
    foreach($s as $mot){
        if(strlen($mot)>3){
        if($i==0){
            $sql.=" WHERE valide=1 AND ";
        }else{
            $sql.=" OR ";
            
        }
        $sql.='CONCAT(titre,description) like"%'.$mot.'%"';
        $i++;
    }}
    $n=0;
}
if(isset($_POST['q']) and !empty($_POST['q'])){
    
    $q=htmlspecialchars($_POST['q']);
    $s=explode(' ',$q);
$sql='SELECT id_annonce,titre,description,date(date_public) as d,hour(date_public) as h,minute(date_public) as m  FROM annonce ' ;
    $i=0;
    foreach($s as $mot){
        if(strlen($mot)>3){
           
        if($i==0){
            $sql.=" WHERE valide=1 AND ";
        }else{
            $sql.=" OR ";
            
        }
        $sql.='CONCAT(titre,description) like"%'.$mot.'%"';
        $i++;
    } }
    $n=0;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <title>Catégorie-UMMTO annonces</title>
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sunflower" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
        <link rel="stylesheet" media="all" href="css/style.css"  />
           
               <link rel="stylesheet" type="text/css" href="css/index.css"/>
                 <link rel="stylesheet" type="text/css" href="css/detail.css"/>
                  <link rel="stylesheet" type="text/css" href="css/modal.css"/>
                 <link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
   
    <style>
         @font-face {
    font-family: 'aileronregular';
    src: url('css/fonts/Aileron-Regular-webfont.eot');
    src: url('css/fonts/Aileron-Regular-webfont.eot?#iefix') format('embedded-opentype'),
         url('css/fonts/Aileron-Regular-webfont.woff2') format('woff2'),
         url('css/fonts/Aileron-Regular-webfont.woff') format('woff'),
         url('css/fonts/Aileron-Regular-webfont.ttf') format('truetype'),
         url('css/fonts/Aileron-Regular-webfont.svg#aileronregular') format('svg');
    font-weight: 400;
    font-style: normal;

}
        #l{
            display: none;
        }
       
        
html, body{
           padding: 0;
           margin: 0%;
            font-family: 'Sunflower', sans-serif;
        }
       
        h1{ color: rgba(46, 58, 72, 0.6);
            margin-top: 0%;
            margin-bottom: 10%;
            margin-left: 10%;
                padding: 14px 16px;
        }
        #titre_principal
{   float: left;
    display: flex;
    flex-direction: column;
}


        nav{
            float: right;
        }
        nav ul
{
    list-style-type: none;
    display: flex;
}

nav li
{    padding-left: 5px;
    
}
        nav a
{
    font-size: 1.3em;
    color: #2e3e48;
      padding: 10px 10px;
    text-decoration: none;
}
        section{
            display: flex;
        }
        .categories{
            overflow: hidden;
          min-height:764px;
            
            position: relative;
            display: block;
        
            padding: 10px;
     
           box-shadow: rgba(121,121,121,.35) 1px 10px 20px;
            border-radius: 5px;
            background-color: white;
            flex: 0.75;
            margin-left: 15px;
            margin-right: 20px;
            margin-bottom: 30px;
        }
        #menu  {
            margin-right: 0.5em;
      height: 100%;
           /* overflow: auto;*/
            padding-left: 0.2em;
            flex-direction: column;
        }
        #menu li{
            font-size: 0.99em;
            padding: 0.5em;
            /*padding-left: 1em;*/
           
        }
        .sous_categorie{
            display: none;
          flex-direction: column;
            padding-left: 0;
        }
        h3{
            text-align: center;
        }
        .categorie{
            text-align: center;
        }.categorie a{
           margin-right:8px; 
        }
        .sous_categorie li{
            background-color: #F1F1F1;
            padding-right: 2em;
            text-align: center;
        }
        #up_1 , #up_2 , #up_3 ,#up_4{
            display: none;
        }  
        article{
            flex: 4;
            overflow: hidden;
        }
        .BABABA{
            background-color: #BABABA;
        }
        svg{
            width: 3em;
            padding: 0.2em 0.2em 0em 0.2em ;
        }
        * {
      box-sizing: border-box;
    }
        .article{
            display: flex;
            flex-direction: column;
        }
        .text{
           
            text-align: justify;
            height: 210px;
            overflow: hidden;
        }
        .suite{
            margin-top: 50px;
        }     
        p{
            margin: 0;
        }
        /**/
.topnav {
    font-size: 1.5em;
    color: #707070;
    width: 100%;
  overflow: hidden;
}
.topnav a {
  float: left;
  display: block;
  color: #2e3e48;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 0.9em;
}
.topnav a.active {
  background-color: #2196F3;
  color: white;
}

.topnav .search-container {
  float: right;
}

.topnav input[type=search] {
  padding: 6px;
  margin-top: 22px;
  font-size: 17px;
  border: 2px solid rgba(46,62,72,.12);
    margin-left: 16px;
}

.topnav .search-container button {
  float: right;
  padding: 8.1px 10px;
  margin-top: 8px;
  margin-right: 16px;
  background: #ddd;
  font-size: 17px;
  border: none;
  cursor: pointer;
}

.topnav .search-container button:hover {
  background: #ccc;
}

@media screen and (max-width: 600px) {
  .topnav .search-container {
    float: none;
  }
  .topnav a, .topnav input[type=search], .topnav .search-container button {
    float: none;
    display: block;
    text-align: left;
    width: 100%;
    margin: 0;
    padding: 14px;
  }
   
  .topnav input[type=search] {
    border: 1px solid rgba(46,62,72,.12); 
  }
}
        .top{
            height: 70px;
            width: 100%;
        }
     
        .bound{
            width: 100%;
            margin: 0;
            line-height: 1.45;
        }   
        .list{
            list-style: none;
padding-left: 0;
        }
        .list-item{
            padding-top: 10px;
            margin: 0;
      
            border-width: 0 !important;
        }
        .card{
                background-color: gray;
            overflow: hidden;
            height: 180px;
            padding: 0 !important;
            margin: 0 !important;
            border-width: 0 !important;
            background: #fff;
            border-radius: 8px;
        }
        .lien{
            position: absolute;

top: 0;

bottom: 0;

left: 0;

right: 0;
        }
        .visibilyte{
            border: 0;

clip: rect(0 0 0 0);

position: absolute;

overflow: hidden;

margin: -1px;

padding: 0;

width: 1px;

height: 1px;
        }
        .annonce-card{
            border-radius: 8px;
           background-color: #F1F1F1;
            padding-right: 20px;
            height: 212px;
        }
        .flex-item{
            overflow: hidden;
                 display: flex;
            flex-direction: row;
            flex-wrap: nowrap;


          
            justify-content: flex-start;
       height: 210px;
            
        }
        .flex-{
            padding-left: 0;
          
        }
        .flex-suite{
            padding-left: 30px;
            width: 850px;
            height: 180px;
           
        }
        .flext{
            margin-top: 3px;
            display: flex;
            flex-direction: row;
                        
flex-wrap: nowrap;
            
        }
        .flexg{
            padding-left: 0;
        }
        .hour{
            overflow: hidden !important;

text-overflow: ellipsis !important;
            white-space: nowrap !important;
            font-size: .875rem;

line-height: 1.6;
            color: rgba(46,62,72,.6);
        }
        .hours{
            font-size: .8rem;

line-height: 1.6;
            color: rgba(46,62,72,.6);
        }
        .title{
            font-size: 1.75rem;
            overflow: hidden;

text-overflow: ellipsis;
            line-height: 1.45 !important;
        }
        .titlien{
            text-decoration: none;
            font-size: 1.75rem;
        }
        .descri{
           font-family: 'Lora',serif;
height: 110px;
text-align: justify;
width: 831px;
font-size: .875rem;
line-height: 1.6;
overflow: hidden;
text-overflow: ellipsis;
max-height: 8.9em;
            
        }
        .photo{
            width: 200px;
            min-width: 0;
            padding-left: 10px;
           height: 180px;
        }
        .phot{
          
            margin-top: 10px;
        }
        .pho{
                height: 189px;
    width: 190px;
            background-position: 50%;

background-size: cover;

background-color: #757575;

display: block;

position: relative;
           
            margin-bottom: 0;
        }
        .chuck{
           /* padding-bottom: 20px !important;*/
        }
        .list_{
            padding-left: 20px;
            padding-right: 20px;
        }
        .p{
            padding-bottom: 20px;
        }
        .t{
            margin-top: 20px;
        }
        .lieuu{
            padding-bottom: 20px;
            
            display: flex;
            justify-content: flex-start;
            flex-direction: row;
            flex-wrap: nowrap;
        }
        .titr{
            font-family: 'Lora',serif;
                font-size: 1.5em;
    color: #2e3e48;
            
        }
       /* li a{
            text-decoration: none;
            color:inherit;
            
        }*/
        
        article a {
            text-decoration: none;

color: inherit;
        }
        
        /* Container for flexboxes */
.row {
    display: -webkit-flex;
    display: flex;
    width: 100%;
}

/* Create three equal columns that sits next to each other */
.column {
    -webkit-flex: 1;
    -ms-flex: 1;
    flex: 1;
    padding: 10px;
    height: 300px; /* Should be removed. Only for demonstration */
}
        .fl{
            color: hsla(0,0%,100%,.7);
          
line-height: 1.6;
            flex-direction: column;
padding-left: 0;
            display: block;
            box-sizing: border-box;
           /* font-size: 0.99em;*/
            list-style-type: none;
            text-align: left;
        }
        .fl a {
            font-size: 1.1em;
color: #F1F1F1;
padding: 10px 10px;
text-decoration: none;
        }
        .fl a:hover {
    color: white;
}
        .ll{
            font-size: 1rem;
padding: 0.5em;
        }
        h4{
         color: #fff;
            
        }
        .divl{
            padding: 0 16px 16px 2px;
        }
        .couleur1{
           font-weight: bold;
        }
       
        h4 a {
    text-decoration: none;
    color: #fff;
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
        input[type=search] {
  padding: 6px;
  margin-top: 16px;
  font-size: 17px;
  border: 2px solid rgba(46,62,72,.12);
            margin-left: 15px;
}
        
   </style>
</head>
<body>
<header>
    <div id="logo">
    <a style="float:left;padding:0;margin-top:0;" href="index.php">
			<img src="newlogo.png" alt="">
			</a>
		</div>
   <?php if(!isset($existe)){ ?>
    <button class='hea'  onclick="document.getElementById('id02').style.display='block'" style="width:auto;"><i class="fas fa-user-plus"></i>Inscription</button>
       <button class='hea' onclick="document.getElementById('id01').style.display='block'" style="width:auto;"><i class="fas fa-sign-in-alt"></i>Connexion</button>
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
            <section>
              <div style="display:flex;flex-direction:column">
               <form method="get">
    <input id="recherche" class="search" maxlength="20" minlength="4" type="search" placeholder="Recherche..." name="q" value="<?php if(!empty($q)) echo $q;  ?>"><button id="sub" style="padding:9px 9px 5px 9px" type="submit"><i class="fa fa-search"></i></button>
    </form>
                <nav class="categories">
                   <h3>Categories</h3>

		<ul id="menu">
			<li><div id="categorie_1" class="categorie"><p><a href="categorie.php?c=travail">Rectutements</a><i id="down_1" class="fas fa-angle-down"></i><i id="up_1" class="fas fa-angle-up"></i></p></div>
			<ul id="sous_categorie_1" class="sous_categorie">
				<li><a href="categorie.php?c=travail&t=emploi">Offre d'emploi</a></li>
				<li><a href="categorie.php?c=travail&t=stage">Offre de stage</a></li>
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
                </div>
                <article >
                <div style="margin-left: 26px;
margin-top: 16px;
font-size: 21px;
color: #2e3e48;">
                <p> <?php if(!empty($c)){
                    if($c=="travail"){
                        echo "Recrutement";
                    }elseif($c=="sortie"){
                        echo "Decouverte/Excursion";
                    }else{
                        echo $c;
                    }}
                    if(!empty($t)){
                        if($t=="emploi"){
                            echo " <span>&#x25B6;</span> Offre d'emploi";
                        }elseif($t=="stage"){
                            echo " <span>&#x25B6;</span> Offre de stage";
                        }else{
                            echo " <span>&#x25B6;</span> ".$t ;
                        }
                        
                    }
                 ?></p></div>
              
                  <?php
 try
        {
           $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());}
             
           $resultat = $bdd->query($sql);
                    if($resultat->rowCount()>0){
                      
            if(!empty($resultat)){
                
        ?>
                 
                   <div class="list_">
                  
                    <ul class="list">
                       <?php  while( $line = $resultat->fetch()){
                         $id=$line['id_annonce'];
                    
                     $image=$bdd->query("SELECT photo FROM photo where id_annonce='$id'");
                     while( $photo = $image->fetch()){
                                  $pho=$photo['photo'];
                                }?>
                        <li class="list-item">
                        
                            
                            <div class="annonce-card" <?php if(!isset($user)){ ?> style="height:182px;" <?php }?>>
                                <div class="flex-item">
                                    
                                     <div class="photo">
                                       <div class="phot">
                                     
                                        <span class="pho" style='background-image: url("image/<?php echo $pho; ?>");
                                             <?php if(!isset($user)){  ?> height:160px;' <?php }else{ echo"'"; } ?>
                                           ></span>
                                       </div>
                                     
                                     
                                   </div>
   
                               <div class="flex-suite">
                                   <div class="flexp">
                                       <div class="flext">
                                           <div class="flexg">
                                           
                <div class="hour"><span class="titr">
                                              <?php if (isset($q)){
                                                                 $titr=$line['titre'];
                                                   $i=0;
                                               foreach($s as $mot){
                                                   
                                               $titr=str_ireplace($mot,'<span class="couleur1">'.$mot.'</span>',$titr);
                                                   
                                               }
                                                                 $des=$line['description'];
                                                                 $j=0;
                                                                 foreach($s as $mot){
                                                                    
                                               $des=str_ireplace($mot,'<span class="couleur1">'.$mot.'</span>',$des);
                                                   
                                               }}else{
            $titr=$line['titre'];
            $des=$line['description'];
        }
                                                                 
                                               ?>
                                                <span><?php echo ''.$titr.''; ?></span></span></div>
                            <div class="hour"><time><span class="hours"> <span> posté le :<?php echo ''.$line['d'].' a '.$line['h'].':'.$line['m'].''; ?> </span></span></time></div>
                                               
                                           </div>
                                       </div>
                                       
                                   </div>
                                  
                                       <div  class="descri">
                                   <p style="word-wrap:break-word">
                                               <?php                
                                                if(strlen($line['description'])<430){
            echo $line['description']; ?><a href="detail_utilisateur?id=<?php echo $line['id_annonce']; ?>">Lire la suite...</a><?php      
                                                }else{
                                                $texte=cutString($line['description'],430);
                                                echo $texte." "; ?><a href='detail_utilisateur?id=<?php echo $line['id_annonce']; ?>'>Lire la suite...</a>
                                                <?php } ?> </p>
                                   </div>
                                   <?php if(isset($user)){ ?>
                                   <div class ="consup" style =" display : flex ; flex-direction : row; justify-content : flex-end; "> 
                <input type='button' value='Modifier'style ="background-color: #75B44B;
    margin-right: 10px;
    margin-bottom: 5px;
    padding: 8px 24px;
    border: 0px;
    color: white;
    border-radius: 4px;
    font-size: 15px;
    cursor: pointer;" onclick="document.location.href = 'modifier.php?id_an=<?php echo $line['id_annonce']; ?>'">   
                <input type='button' value='Supprimer' style ="background-color: #EE4957;
    border-radius: 4px;
    font-size: 15px;
    padding: 8px 24px;
    margin-right: 10px;
    margin-bottom: 5px;
    border: 0px;
    cursor:pointer;                                                          
    color: white;" onclick="document.location.href = 'supprimer_utilisateur.php?id=<?php echo $line['id_annonce'];  ?>'">
                                </div><?php } ?></div></div></div>
                     </li> <?php }   ?> 
                    </ul></div>
                   
        <?php } }else{  ?><?php if(!isset($user)){ ?><h1 style="text-align:center; font-size: 1.5em;">Aucun resultat pour :<?php if(isset($q)){
                        echo $q;}
                      elseif(isset($c) and !isset($t)){
                          if($c=="sortie"){
                              echo "Découverte/Excursions";
                          }elseif($c=="travail"){
                              echo "Recrutement";
                          }
                          else{
                        
                        echo $c;}}else{
                        if(isset($t)){
                            if($t=="stage"){
                                echo "offre de stage";
                            } 
                            elseif($t=="emploi"){
                                echo "offre de d'emploi";
                            } 
                            elseif($t=="Ressources_humaines"){
                                echo "Ressources humaines";
                            }
                            elseif($t=="Evènement_sportifs"){
                                echo "Evènement sportifs";
                            }else{
                                echo $t;
                            }     
                        }
                    } ?>...
                </h1><?php }else{ ?>
                    <h1 style="text-align:center; font-size: 1.5em;"> Aucune annonce postée pour le moment </h1>
                 <?php }} ?>
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
          else if(!$("#lastName").val().match(/^[a-zéçàè]+$/i) && $('#lastName').val().length<3){
                valid3=false;
                $('#lastName').css('border','1px solid #f44336');
                $('#lastName').next("#erreurnom").show().text("Nom invalide et trop court minimum 3 caractères.");
          } 
          else if(!$("#lastName").val().match(/^[a-zéçàè]+$/i) ){
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
            if($('#lastName').val().length>=3 && $("#lastName").val().match(/^[a-zéçàè]+$/i) && $('#lastName').val()!=""){
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
          else if(!$("#login").val().match(/^[a-zéçàè]+$/i)){
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
            if($('#login').val().length>=3 && $("#login").val().match(/^[a-zéçàè]+$/i) && $('#login').val()!=""){
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
</script>
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
function aler() { alert("Vous devez posseder un compte pour pouvoir poster une annonce  !!"); }
</script>
  
    <?php

     function cutString($text,$maxTextLenght){
	if(strlen($text) > $maxTextLenght){
		$text = substr(trim($text),0,$maxTextLenght);
		$text = substr($text,0,strlen($text)-strpos(strrev($text)," "));
	}
	
	return $text;
}

?>
</body>
</html>