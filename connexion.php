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
                header('Location: index.php');//rediriger la secretaire vers sa page 
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
            if($bdd->query($sql)){
                echo"Bienvenue parmi nous merde !" ;   
                        }else
                        { echo "erreur lors de l'insertion"; }    }     
 } 
 else { $incomplete = " Tous les champs sont requis " ;} 
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php if(isset($h)) echo $h; ?></title>
  <link rel="stylesheet" type="text/css" href="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<style>
/* Full-width input fields */
input[type=text], input[type=password] ,input[type=email] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
    /* Inscription modal*/
    input[type=text], input[type=password] ,input[type=email] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    display: inline-block;
    border: none;
    background: #f1f1f1;
}

/* Add a background color when the inputs get focus */
input[type=text]:focus, input[type=password]:focus ,input[type=email]:focus {
    background-color: #ddd;
    outline: none;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
    opacity: 0.9;
}

button:hover {
    opacity:1;
}

/* Extra styles for the cancel button */
.cancelbtn2 {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.cancelbtn2, .signupbtn {
  float: left;
  width: 50%;
}
/* Add padding to container elements */
.container {
    padding: 16px;
}
/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
   /* background-color: #474e5d;*/
    padding-top: 50px;
}
/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}
/* Style the horizontal ruler */
hr {
    border: 1px solid #f1f1f1;
    margin-bottom: 25px;
}
/* The Close Button (x) */
.close2 {
    position: absolute;
    right: 35px;
    top: 15px;
    font-size: 40px;
    font-weight: bold;
    color: #f1f1f1;
}
.close2:hover,
.close2:focus {
    color: #f44336;
    cursor: pointer;
}
/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
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
</style>
</head>
<body>    
<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Connexion</button>
<div id="id01" class="modal">
  <form class="modal-content animate" action="" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
    </div>
    <div class="container">
    <label for="uname"><b>Pseudo ou adresse e-mail</b></label> 
        <input id ="nom" type="text" placeholder="Entrer votre pseudo ou adresse e-mail" name="login" required="required">
       <div style="color:#f44336" id="erreurnom"></div>
      <label for="psw"><b>Mot de passe</b></label>
          <input type="password" placeholder="Entrer votre mot de passse " id="password"name="password" required='required'>
          <div  style="color:#f44336;display:block" id="erreurpas"></div> 
      <button id="submit" type="submit">Connexion</button>
    </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Annuler</button>
      <span class="psw"><a href="#">Mot de passe oubliées?</a></span>
    </div>
  </form>
</div> 
<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Inscription</button>
<div id="id02" class="modal">
  <span onclick="document.getElementById('id02').style.display='none'" class="close2" title="Close Modal">&times;</span>
  <form class="modal-content" action="" method="post">
    <div class="container">
     
      <hr>
      <label for="email"><b>Nom</b></label>
      <input type="text" placeholder="Entrer votre Nom" name="lastName" id="lastName" required='required'>
      <div style="color:#f44336" id="erreurnom" ></div>

      <label for="psw"><b>Pseudo</b></label>
      <input type="text" placeholder="Entrer votre pseudo" name="login" id="login" required='required'>
      <div style="color:#f44336" id="erreurpseudo" ></div>

      <label for="psw-repeat"><b>E-mail</b></label>
      <input name="email"  id ="email" type="email" placeholder="Entrer votre e-mail" required='required'>
      <div style="color:#f44336" id="erreurmail" ></div>
      
      <label for="psw-repeat"><b>Mot de passe</b></label>
      <input name="pwd1" id="pwd1" type="password" placeholder="Entrer votre mot de passe" required='required'>
      <div style="color:#f44336" id="erreurpwd1" ></div>
      
      <label for="psw-repeat"><b>Mot de passe(confirmation)</b></label>
      <input name="pwd2" id="pwd2" type="password" placeholder="Confirmer votre mot de passe" required='required'>
      <div style="color:#f44336" id="erreurpwd2" ></div>
    
      <div class="clearfix">
        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn2">Annuler</button>
        <button type="submit" class="signupbtn" id="btn">Inscription</button>
      </div>
    </div>
  </form>
</div>

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
  <script src="jquery-3.3.1.min.js"></script>
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





</body>
</html>