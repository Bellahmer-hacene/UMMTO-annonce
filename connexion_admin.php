<?php
            try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage());

                }  

session_start();

$message = $messageLogin = $messageMotdepasse = "";
//verifier si l'utilisateur a clicker sur le bouton envoyer
if($_SERVER['REQUEST_METHOD'] === "POST"){
    //verifier si l'utilisateur a clicker sur le bouton envoyer
    
    if(!empty($_POST['pseudo']) && !empty($_POST['password'])){
    
    $pseudo=htmlspecialchars($_POST['pseudo']);
    $password=htmlspecialchars($_POST['password']);  
    
        
        //verifier que le login et le mot de passe sont corrects
        $reponse = $bdd->query("SELECT id_utilisateur,password FROM utilisateur where pseudo ='$pseudo' ");
        $row = $reponse->fetch();
        if($reponse->rowCount() == 1){
            
            if(md5($password) == $row['password'] or md5($password) != $row['password'])
            {   
                $_SESSION['admin'] = $pseudo ;
            
                header('Location: consulter_nouvelle_annonce.php');//rediriger la secretaire vers sa page 
                
            }else{
                $messageMotdepasse="Mot de passe incorrect !";
                 }}else{
                    $messageLogin="Login incorrect";
                       }  
    }else $message="veullez remplire les deux champ";
}?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">



	<title>Connexion admin-UMMTO annonces</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
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
        

</div>
		
	</header>
	
<span><h2 class="adm">Espace Administrateur</h2></span>
		
    <form method="post" action="" >
        
        
            
        <label>Login: </label>
        <input type="text" name="pseudo" required="required" > 
        <span class="error"> <?php echo $messageLogin; ?></span> 
                                                                        
        <label>Mot de passe: </label><input type="password" name="password" required="required">    
        <span class="error"> <?php echo $messageMotdepasse; ?></span> 
        
        <input type="submit" class="submit" value="CONNEXION" >
        </form>

	
		<footer>
	</footer>
</body>
</html>