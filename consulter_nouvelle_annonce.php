<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('Location: connexion_admin.php');
} ?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    
    <title>Nouvelles annonces-UMMTO annonce</title>
      <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
  <link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Sunflower" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
        <link rel="stylesheet" media="all" href="css/style.css"  />
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
          min-height: 500px;
            
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

header a:hover {
  background-color: #ddd;
  color: black;
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
    margin-right: 187px;
    border-radius: 8px;
    background-color: #F5F5F5  ;
    padding-right: 0px;
    margin-left: 161px;
    padding-bottom: 30px;
    margin-bottom: 25px;

        }
        .flex-item{
                 display: flex;
            flex-direction: row;
            flex-wrap: nowrap;


          
            justify-content: flex-start;
       height: auto;
            
        }
        .flex-{
            padding-left: 0;
          
        }
        .flex-suite{
            padding-left: 30px;
            width: 850px;
            height: 180px;
            margin-left:180px;
           
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
            width: 739px;
            
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
             height: 187px;
                width: 197px;
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
         /*Footer*/
        

        
        .footer {
height: 500px;
   left: 0;
   bottom: 0;
   width: 100%;
   
   background-color: #353e48;
   text-align: center;
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
color: #A3A7A8;;
padding: 10px 10px;
text-decoration: none;
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
       header a {
    overflow: hidden;
    display: block ; 
    float: right ;
    text-decoration: none ; 
    text-align: center ; 
    color:  #3282C1 ;
    padding: 5px 10px; 
    margin-top: 25px ; 
    margin-right: 25px ; 
    font-size: 25px;
    font-weight: bold;

}
        header img {
    float: left ; 
    margin-left: 85px ;
    margin-top: 8px ;
    height: 70px ;
    width: 200px ; 
    display: inline ; 
}

header a {
    overflow: hidden;
    display: block ; 
    float: right ;
    text-decoration: none ; 
    text-align: center ; 
    color:  #3282C1 ;
    padding: 5px 10px; 
    margin-top: 25px ; 
    margin-right: 25px ; 
    font-size: 25px;
    font-weight: bold;

}
header{
   
background-color: white;
height: 87px ; 
border-bottom: 3px solid #EE4957   ;

}


h2.adm {
    text-align: center ; 
    color: #444444 ; 
    font-size: 30px ; 
    margin-top: 30px ;
} 

        .consup{
         
            width: 720px;
            
        }
        
        .consup button{
            margin-right: 10px ; 
            margin-bottom: 5px ; 
            padding: 8px 24px;
            border: 0px ;
            color: white ; 
            border-radius: 4px ; 
            font-size: 15px ; 
            cursor: pointer ; 
        }    
        
        .consup button:hover {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 3px 10px 0 rgba(0,0,0,0.19);

        }
    
        body {
                font-family: 'Sunflower', serif;

        }
        
        #titre{
         
                margin-bottom: 0px;
                margin-top: 0px;
            
        }
    
    </style>
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
	
<span><h2 class="adm">Espace Administrateur</h2></span>
		

             
                
            
              
                  <?php
 try
        {
           $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());}
             
           
               // $sql="SELECT titre,description,date(date_publi) as d, hour(date_publi) as h, minute(date_publi) as m from  
           
                 $req=$bdd->query("SELECT annonce.id_annonce,annonce.titre,annonce.description,date(date_public) as d, hour(date_public) as h, minute(date_public) as m FROM annonce WHERE  annonce.valide='0' ORDER BY date_public DESC");     
    
    
    while($donnees3=$req->fetch()){
        
        $iden=$donnees3['id_annonce'];
    ?>            
                   
                   
                    
                   <div class="list_">
                  
                    <ul class="list">
                      
                        <li class="list-item">
                        
                        
                        <?php 
                        
                        $req1=$bdd->query("SELECT photo from PHOTO WHERE photo.id_annonce='$iden'");
        
                        $donnees4=$req1->fetch();
                        ?>
                        
                
                <div class="annonce-card">                <div class="flex-item">
                                     <div class="photo">
                                       <div class="phot">
                                           <img src="image/<?php echo $donnees4['photo']; ?>" class='pho'  />
                                       </div>     
                                </div>
                               <div class="flex-suite">
                                   <div class="flexp">
                                       <div class="flext">
                                           <div class="flexg">
                                                         <div class="hour">
                                              <h2 id='titre'> <?php echo $donnees3['titre']; ?> </h2>
                                                </div>
        <div class="hour" id="date_post"><time><span class="hours"> <span> posté le :</span> <?php echo $donnees3['d']; ?> à <?php echo $donnees3['h'].":".$donnees3['m']; ?>  </span></time></div>    
                                           </div>
                                       </div> 
                                   </div>
                                       <div  class="descri">  
                                           <p style="word-wrap:break-word;padding-right: 11px;">
                                               <?php                
                                                if(strlen($donnees3['description'])<500){
                                                echo $donnees3['description'];    }else{
                                                $texte=cutString($donnees3['description'],500);
                                                echo $texte." "; ?><a href='detailadmin.php?id=<?php echo $donnees3['id_annonce']; ?>'>Lire la suite...</a>
                                                <?php } ?> </p>
                                  </div>
                                <div class ="consup" style =" display : flex ; flex-direction : row; justify-content : flex-end; "> 
                <input type='button' value='Confirmer'style ="background-color: #75B44B;
    margin-right: 10px;
    margin-bottom: 5px;
    padding: 8px 24px;
    border: 0px;
    color: white;
    border-radius: 4px;
    font-size: 15px;
    cursor: pointer;" onclick="document.location.href = 'detailadmin.php?id=<?php echo $donnees3['id_annonce']; ?>'">   
                <input type='button' value='Supprimer' style ="background-color: #EE4957;
    border-radius: 4px;
    font-size: 15px;
    padding: 8px 24px;
    margin-right: 10px;
    margin-bottom: 5px;
    border: 0px;
    cursor:pointer;                                                          
    color: white;" onclick="document.location.href = 'supprimer_annonce_nouvelle.php?id=<?php echo $donnees3['id_annonce'];  ?>'">
                                </div>     </div></div>        </div>
                       </li> 
                    </ul></div>                   
        
                
           <?php } ?>
 


  
    
</body>
</html>

<?php

     function cutString($text,$maxTextLenght){
	if(strlen($text) > $maxTextLenght){
		$text = substr(trim($text),0,$maxTextLenght);
		$text = substr($text,0,strlen($text)-strpos(strrev($text)," "));
	}
	
	return $text;
}

?>