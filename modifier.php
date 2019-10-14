<?php
session_start();
if(isset($_SESSION['id'])){
   $existe=1;
    $id=$_SESSION['id'];
}else{
    header('Location: index.php');
                die;   
}
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $cat=$_GET['cat'];
    $an=$_GET['id'];
    $in=$_GET['id_in'];
    echo $cat;
    if($cat=='formation'){
        echo "jfdhjkgf";
        $type_formation=htmlspecialchars($_POST['type_formation']);
        $titre=htmlspecialchars($_POST['titre']);
        $description=htmlspecialchars($_POST['description']);
        $date_debut=htmlspecialchars($_POST['date_debut']);
        $etablissement=htmlspecialchars($_POST['etablissement']);
        $adresse=htmlspecialchars($_POST['adresse']);
        $nombre=htmlspecialchars($_POST['nombre']);
        if(isset($_FILES['photo1']['name'])){
        $photo1=htmlspecialchars($_FILES['photo1']['name']);}
        if(isset($_FILES['photo2']['name'])){
        $photo2=htmlspecialchars($_FILES['photo2']['name']);}
        if(isset($_FILES['photo3']['name'])){
        $photo3=htmlspecialchars($_FILES['photo3']['name']);}
        if(isset($_FILES['photo4']['name'])){
        $photo4=htmlspecialchars($_FILES['photo4']['name']);}
        if(isset($_POST['id_photo1'])){
        $id_photo1=htmlspecialchars($_POST['id_photo1']);}
        if(isset($_POST['id_photo2'])){
        $id_photo2=htmlspecialchars($_POST['id_photo2']);}
        if(isset($_POST['id_photo3'])){
        $id_photo3=htmlspecialchars($_POST['id_photo3']);}
        if(isset($_POST['id_photo4'])){
        $id_photo4=htmlspecialchars($_POST['id_photo4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        if(!empty($_POST['supprimer1'])){
        $supprimer1=htmlspecialchars($_POST['supprimer1']);}
        if(!empty($_POST['supprimer2'])){
        $supprimer2=htmlspecialchars($_POST['supprimer2']);}
        if(!empty($_POST['supprimer3'])){
        $supprimer3=htmlspecialchars($_POST['supprimer3']);}
        if(!empty($_POST['supprimer4'])){
        $supprimer4=htmlspecialchars($_POST['supprimer4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        $mail=htmlspecialchars($_POST['mail']);
        $site=htmlspecialchars($_POST['site']);
            try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
          if(!empty($photo1) && empty($supprimer1) && !empty($id_photo1)){
            $sql7="UPDATE photo SET photo='$photo1' where id_photo=$id_photo1 ";
            $bdd->query($sql7);
              move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if(!empty($photo2) && empty($supprimer2) && !empty($id_photo2)){
            $sql7="UPDATE photo SET photo='$photo2' where id_photo=$id_photo2 ";
            $bdd->query($sql7);
            echo $photo2;
              move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if(!empty($photo3) && empty($supprimer3) && !empty($id_photo3)){
            $sql7="UPDATE photo SET photo='$photo3' where id_photo=$id_photo3 ";
            $bdd->query($sql7);
            echo $photo3;
              move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if(!empty($photo4) && empty($supprimer4) && !empty($id_photo4)){
            $sql7="UPDATE photo SET photo='$photo4' where id_photo=$id_photo4 ";
            $bdd->query($sql7);
            echo $photo4;
              move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if(!empty($supprimer1) && !empty($id_photo1)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo1";
            $bdd->query($sql11);
        }
        if(!empty($supprimer2) && !empty($id_photo2)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo2";
            $bdd->query($sql11);
        }
        if(!empty($supprimer3) && !empty($id_photo3)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo3";
            $bdd->query($sql11);
        }
        if(!empty($supprimer4) && !empty($id_photo4)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo4";
            $bdd->query($sql11);
        }
        if($nombre==0 && !empty($photo1)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo1')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if($nombre==0 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==0 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==0 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==1 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==1 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==1 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==2 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==2 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==3 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        
$sql="UPDATE annonce SET valide=0,titre=\"$titre\",description=\"$description\" where id_annonce=$an ";
$sql2="UPDATE formation SET   type_formation=\"$type_formation\",etablissement=\"$etablissement\",adresse=\"$adresse\",date_debut='$date_debut' where id_annonce=$an ";if(empty($telephone)){
    echo 'nexiste pas'.$in;
    $sql3="UPDATE telephone SET tel=0 where id_information=$in";
}else{
    echo 'existe';
    echo $telephone;
    $sql3="UPDATE telephone SET tel='$telephone' where id_information=$in"; 
}
$sql4="UPDATE mail SET mail='$mail' where id_information=$in";
$sql5="UPDATE site SET nom_site='$site' where id_information=$in";  
        if($bdd->query($sql)){ echo "1";} if($bdd->query($sql2)){ echo "2";} if($bdd->query($sql3)){ echo "3";} 
        if($bdd->query($sql4)){ echo "4";} if($bdd->query($sql5)){ echo "5";}
        echo $type_formation; echo $etablissement; echo $adresse; echo $date_debut ;
        if($bdd->query($sql) && $bdd->query($sql2) && $bdd->query($sql3) && $bdd->query($sql4) && $bdd->query($sql5) ){ header('Location: index.php');
                die;
 }}elseif($cat=='evenement'){
        $titre=htmlspecialchars($_POST['titre']);
        $description=htmlspecialchars($_POST['description']);
        $type_evenement=htmlspecialchars($_POST['type_evenement']);
        $date_debut=htmlspecialchars($_POST['date_debut']);
        $etablisement=htmlspecialchars($_POST['etablissement']);
        $adresse=htmlspecialchars($_POST['adresse']);
        $organisateur=htmlspecialchars($_POST['organisateur']);
        $horaire=htmlspecialchars($_POST['horaire']);
        $nombre=htmlspecialchars($_POST['nombre']);
        if(isset($_FILES['photo1']['name'])){
        $photo1=htmlspecialchars($_FILES['photo1']['name']);}
        if(isset($_FILES['photo2']['name'])){
        $photo2=htmlspecialchars($_FILES['photo2']['name']);}
        if(isset($_FILES['photo3']['name'])){
        $photo3=htmlspecialchars($_FILES['photo3']['name']);}
        if(isset($_FILES['photo4']['name'])){
        $photo4=htmlspecialchars($_FILES['photo4']['name']);}
        if(isset($_POST['id_photo1'])){
        $id_photo1=htmlspecialchars($_POST['id_photo1']);}
        if(isset($_POST['id_photo2'])){
        $id_photo2=htmlspecialchars($_POST['id_photo2']);}
        if(isset($_POST['id_photo3'])){
        $id_photo3=htmlspecialchars($_POST['id_photo3']);}
        if(isset($_POST['id_photo4'])){
        $id_photo4=htmlspecialchars($_POST['id_photo4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        if(!empty($_POST['supprimer1'])){
        $supprimer1=htmlspecialchars($_POST['supprimer1']);}
        if(!empty($_POST['supprimer2'])){
        $supprimer2=htmlspecialchars($_POST['supprimer2']);}
        if(!empty($_POST['supprimer3'])){
        $supprimer3=htmlspecialchars($_POST['supprimer3']);}
        if(!empty($_POST['supprimer4'])){
        $supprimer4=htmlspecialchars($_POST['supprimer4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        $mail=htmlspecialchars($_POST['mail']);
        $site=htmlspecialchars($_POST['site']);
         try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
          if(!empty($photo1) && empty($supprimer1) && !empty($id_photo1)){
            $sql7="UPDATE photo SET photo='$photo1' where id_photo=$id_photo1 ";
            $bdd->query($sql7);
              move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if(!empty($photo2) && empty($supprimer2) && !empty($id_photo2)){
            $sql7="UPDATE photo SET photo='$photo2' where id_photo=$id_photo2 ";
            $bdd->query($sql7);
            echo $photo2;
              move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if(!empty($photo3) && empty($supprimer3) && !empty($id_photo3)){
            $sql7="UPDATE photo SET photo='$photo3' where id_photo=$id_photo3 ";
            $bdd->query($sql7);
            echo $photo3;
              move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if(!empty($photo4) && empty($supprimer4) && !empty($id_photo4)){
            $sql7="UPDATE photo SET photo='$photo4' where id_photo=$id_photo4 ";
            $bdd->query($sql7);
            echo $photo4;
              move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
      if(!empty($supprimer1) && !empty($id_photo1)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo1";
            $bdd->query($sql11);
        }
        if(!empty($supprimer2) && !empty($id_photo2)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo2";
            $bdd->query($sql11);
        }
        if(!empty($supprimer3) && !empty($id_photo3)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo3";
            $bdd->query($sql11);
        }
        if(!empty($supprimer4) && !empty($id_photo4)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo4";
            $bdd->query($sql11);
        }
        if($nombre==0 && !empty($photo1)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo1')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if($nombre==0 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==0 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==0 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==1 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==1 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==1 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==2 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==2 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==3 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
$sql="UPDATE annonce SET valide=0,titre=\"$titre\",description=\"$description\" where id_annonce=$an ";
$sql2="UPDATE evenement SET   type_evenement=\"$type_evenement\",date_debut='$date_debut',adresse=\"$adresse\",organisateur=\"$organisateur\",etablissement=\"$etablisement\",horaire='$horaire' where id_annonce=$an ";
if(empty($telephone)){
    echo 'nexiste pas'.$in;
    $sql3="UPDATE telephone SET tel=0 where id_information=$in";
}else{
    echo 'existe';
    echo $telephone;
    $sql3="UPDATE telephone SET tel='$telephone' where id_information=$in"; 
} 
$sql4="UPDATE mail SET mail='$mail' where id_information=$in";
$sql5="UPDATE site SET nom_site='$site' where id_information=$in";        
        if($bdd->query($sql) && $bdd->query($sql2) && $bdd->query($sql3) && $bdd->query($sql4) && $bdd->query($sql5) ){
         header('Location: index.php');
                die;}  
    }elseif($cat=='recrutement'){
        $titre=htmlspecialchars($_POST['titre']);
        $description=htmlspecialchars($_POST['description']);
        $type_travail=htmlspecialchars($_POST['travail']);
        $domaine=htmlspecialchars($_POST['domaine']);
        $etablissement=htmlspecialchars($_POST['etablissement']);
        $adresse=htmlspecialchars($_POST['adresse']);
        $salaire=htmlspecialchars($_POST['salaire']);
        $nombre=htmlspecialchars($_POST['nombre']);
        if(isset($_FILES['photo1']['name'])){
        $photo1=htmlspecialchars($_FILES['photo1']['name']);}
        if(isset($_FILES['photo2']['name'])){
        $photo2=htmlspecialchars($_FILES['photo2']['name']);}
        if(isset($_FILES['photo3']['name'])){
        $photo3=htmlspecialchars($_FILES['photo3']['name']);}
        if(isset($_FILES['photo4']['name'])){
        $photo4=htmlspecialchars($_FILES['photo4']['name']);}
        if(isset($_POST['id_photo1'])){
        $id_photo1=htmlspecialchars($_POST['id_photo1']);}
        if(isset($_POST['id_photo2'])){
        $id_photo2=htmlspecialchars($_POST['id_photo2']);}
        if(isset($_POST['id_photo3'])){
        $id_photo3=htmlspecialchars($_POST['id_photo3']);}
        if(isset($_POST['id_photo4'])){
        $id_photo4=htmlspecialchars($_POST['id_photo4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        if(!empty($_POST['supprimer1'])){
        $supprimer1=htmlspecialchars($_POST['supprimer1']);}
        if(!empty($_POST['supprimer2'])){
        $supprimer2=htmlspecialchars($_POST['supprimer2']);}
        if(!empty($_POST['supprimer3'])){
        $supprimer3=htmlspecialchars($_POST['supprimer3']);}
        if(!empty($_POST['supprimer4'])){
        $supprimer4=htmlspecialchars($_POST['supprimer4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        $mail=htmlspecialchars($_POST['mail']);
        $site=htmlspecialchars($_POST['site']);
        try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
        if(!empty($photo1) && empty($supprimer1) && !empty($id_photo1)){
            $sql7="UPDATE photo SET photo='$photo1' where id_photo=$id_photo1 ";
            $bdd->query($sql7);
              move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if(!empty($photo2) && empty($supprimer2) && !empty($id_photo2)){
            $sql7="UPDATE photo SET photo='$photo2' where id_photo=$id_photo2 ";
            $bdd->query($sql7);
            echo $photo2;
              move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if(!empty($photo3) && empty($supprimer3) && !empty($id_photo3)){
            $sql7="UPDATE photo SET photo='$photo3' where id_photo=$id_photo3 ";
            $bdd->query($sql7);
            echo $photo3;
              move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if(!empty($photo4) && empty($supprimer4) && !empty($id_photo4)){
            $sql7="UPDATE photo SET photo='$photo4' where id_photo=$id_photo4 ";
            $bdd->query($sql7);
            echo $photo4;
              move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
      if(!empty($supprimer1) && !empty($id_photo1) ){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo1";
            $bdd->query($sql11);
        }
        if(!empty($supprimer2) && !empty($id_photo2) ){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo2";
            $bdd->query($sql11);
        }
        if(!empty($supprimer3) && !empty($id_photo3) ){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo3";
            $bdd->query($sql11);
        }
        if(!empty($supprimer4) && !empty($id_photo4) ){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo4";
            $bdd->query($sql11);
        }
        if($nombre==0 && !empty($photo1)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo1')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if($nombre==0 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==0 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==0 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==1 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==1 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==1 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==2 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==2 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==3 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
$sql="UPDATE annonce SET valide=0,titre=\"$titre\",description=\"$description\" where id_annonce=$an ";
$sql2="UPDATE travail SET   type_travail='$type_travail',domaine=\"$domaine\",etablissement=\"$etablissement\",adresse=\"$adresse\",salaire='$salaire' where id_annonce=$an ";
if(empty($telephone)){
    echo 'nexiste pas'.$in;
    $sql3="UPDATE telephone SET tel=0 where id_information=$in";
}else{
    echo 'existe';
    echo $telephone;
    $sql3="UPDATE telephone SET tel='$telephone' where id_information=$in"; 
} 
$sql4="UPDATE mail SET mail='$mail' where id_information=$in";
$sql5="UPDATE site SET nom_site='$site' where id_information=$in";        
        if($bdd->query($sql) && $bdd->query($sql2) && $bdd->query($sql3) && $bdd->query($sql4) && $bdd->query($sql5) ){
         header('Location: index.php');
                die;}  
    }elseif($cat=='sortie'){
        $titre=htmlspecialchars($_POST['titre']);
        $description=htmlspecialchars($_POST['description']);
        $date=htmlspecialchars($_POST['date']);
        $horaire=htmlspecialchars($_POST['horaire']);
        $titre=htmlspecialchars($_POST['titre']);
        $lieudepart=htmlspecialchars($_POST['lieudepart']);
        $lieuarrivee=htmlspecialchars($_POST['lieuarrivee']);
        $prix=htmlspecialchars($_POST['prix']);
        $nombre=htmlspecialchars($_POST['nombre']);
        if(isset($_FILES['photo1']['name'])){
        $photo1=htmlspecialchars($_FILES['photo1']['name']);}
        if(isset($_FILES['photo2']['name'])){
        $photo2=htmlspecialchars($_FILES['photo2']['name']);}
        if(isset($_FILES['photo3']['name'])){
        $photo3=htmlspecialchars($_FILES['photo3']['name']);}
        if(isset($_FILES['photo4']['name'])){
        $photo4=htmlspecialchars($_FILES['photo4']['name']);}
        if(isset($_POST['id_photo1'])){
        $id_photo1=htmlspecialchars($_POST['id_photo1']);}
        if(isset($_POST['id_photo2'])){
        $id_photo2=htmlspecialchars($_POST['id_photo2']);}
        if(isset($_POST['id_photo3'])){
        $id_photo3=htmlspecialchars($_POST['id_photo3']);}
        if(isset($_POST['id_photo4'])){
        $id_photo4=htmlspecialchars($_POST['id_photo4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        if(!empty($_POST['supprimer1'])){
        $supprimer1=htmlspecialchars($_POST['supprimer1']);}
        if(!empty($_POST['supprimer2'])){
        $supprimer2=htmlspecialchars($_POST['supprimer2']);}
        if(!empty($_POST['supprimer3'])){
        $supprimer3=htmlspecialchars($_POST['supprimer3']);}
        if(!empty($_POST['supprimer4'])){
        $supprimer4=htmlspecialchars($_POST['supprimer4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        $mail=htmlspecialchars($_POST['mail']);
        $site=htmlspecialchars($_POST['site']);
         try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
        if(!empty($photo1) && empty($supprimer1) && !empty($id_photo1)){
            $sql7="UPDATE photo SET photo='$photo1' where id_photo=$id_photo1 ";
            $bdd->query($sql7);
              move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if(!empty($photo2) && empty($supprimer2) && !empty($id_photo2)){
            $sql7="UPDATE photo SET photo='$photo2' where id_photo=$id_photo2 ";
            $bdd->query($sql7);
            echo $photo2;
              move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if(!empty($photo3) && empty($supprimer3) && !empty($id_photo3)){
            $sql7="UPDATE photo SET photo='$photo3' where id_photo=$id_photo3 ";
            $bdd->query($sql7);
            echo $photo3;
              move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if(!empty($photo4) && empty($supprimer4) && !empty($id_photo4)){
            $sql7="UPDATE photo SET photo='$photo4' where id_photo=$id_photo4 ";
            $bdd->query($sql7);
            echo $photo4;
              move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
      if(!empty($supprimer1) && !empty($id_photo1)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo1";
            $bdd->query($sql11);
        }
        if(!empty($supprimer2) && !empty($id_photo2)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo2";
            $bdd->query($sql11);
        }
        if(!empty($supprimer3) && !empty($id_photo3)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo3";
            $bdd->query($sql11);
        }
        if(!empty($supprimer4) && !empty($id_photo4)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo4";
            $bdd->query($sql11);
        }
        if($nombre==0 && !empty($photo1)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo1')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if($nombre==0 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==0 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==0 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==1 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==1 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==1 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==2 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==2 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==3 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        
$sql="UPDATE annonce SET valide=0,titre=\"$titre\",description=\"$description\" where id_annonce=$an ";
$sql2="UPDATE sortie SET   date_debut='$date',horaire='$horaire',adresse_depart=\"$lieudepart\",adresse_arrive=\"$lieuarrivee\",prix=$prix where id_annonce=$an ";
if(empty($telephone)){
    echo 'nexiste pas'.$in;
    $sql3="UPDATE telephone SET tel=0 where id_information=$in";
}else{
    echo 'existe';
    echo $telephone;
    $sql3="UPDATE telephone SET tel='$telephone' where id_information=$in"; 
} 
$sql4="UPDATE mail SET mail='$mail' where id_information=$in";
$sql5="UPDATE site SET nom_site='$site' where id_information=$in";   
        if($bdd->query($sql)){ echo "1";} if($bdd->query($sql2)){ echo "2";} if($bdd->query($sql3)){ echo "3";} 
        if($bdd->query($sql4)){ echo "4";} if($bdd->query($sql5)){ echo "5";}echo $date; echo $horaire; echo $lieuarrivee; echo $lieudepart; echo $an;
        if($bdd->query($sql) && $bdd->query($sql2) && $bdd->query($sql3) && $bdd->query($sql4) && $bdd->query($sql5) ){
         header('Location: index.php');
                die;}}
elseif($cat="logement"){
        $titre=htmlspecialchars($_POST['titre']);
        $description=htmlspecialchars($_POST['description']);
        $type_logement=htmlspecialchars($_POST['type_logement']);
        $type=htmlspecialchars($_POST['type']);
         $adresse=htmlspecialchars($_POST['adresse']);
     $surface=htmlspecialchars($_POST['surface']);
     $loyer=htmlspecialchars($_POST['loyer']);
    $nombre=htmlspecialchars($_POST['nombre']);
    if(isset($_FILES['photo1']['name'])){
        $photo1=htmlspecialchars($_FILES['photo1']['name']);}
        if(isset($_FILES['photo2']['name'])){
        $photo2=htmlspecialchars($_FILES['photo2']['name']);}
        if(isset($_FILES['photo3']['name'])){
        $photo3=htmlspecialchars($_FILES['photo3']['name']);}
        if(isset($_FILES['photo4']['name'])){
        $photo4=htmlspecialchars($_FILES['photo4']['name']);}
        if(isset($_POST['id_photo1'])){
        $id_photo1=htmlspecialchars($_POST['id_photo1']);}
        if(isset($_POST['id_photo2'])){
        $id_photo2=htmlspecialchars($_POST['id_photo2']);}
        if(isset($_POST['id_photo3'])){
        $id_photo3=htmlspecialchars($_POST['id_photo3']);}
        if(isset($_POST['id_photo4'])){
        $id_photo4=htmlspecialchars($_POST['id_photo4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        if(!empty($_POST['supprimer1'])){
        $supprimer1=htmlspecialchars($_POST['supprimer1']);}
        if(!empty($_POST['supprimer2'])){
        $supprimer2=htmlspecialchars($_POST['supprimer2']);}
        if(!empty($_POST['supprimer3'])){
        $supprimer3=htmlspecialchars($_POST['supprimer3']);}
        if(!empty($_POST['supprimer4'])){
        $supprimer4=htmlspecialchars($_POST['supprimer4']);}
        $telephone=htmlspecialchars($_POST['telephone']);
        $mail=htmlspecialchars($_POST['mail']);
        $site=htmlspecialchars($_POST['site']);
    try {
                    $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
                }
            catch(Exception $e)
                {
                    die('Erreur : '.$e->getMessage()); }
    if(!empty($photo1) && empty($supprimer1) && !empty($id_photo1)){
            $sql7="UPDATE photo SET photo='$photo1' where id_photo=$id_photo1 ";
            $bdd->query($sql7);
              move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if(!empty($photo2) && empty($supprimer2) && !empty($id_photo2)){
            $sql7="UPDATE photo SET photo='$photo2' where id_photo=$id_photo2 ";
            $bdd->query($sql7);
            echo $photo2;
              move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if(!empty($photo3) && empty($supprimer3) && !empty($id_photo3)){
            $sql7="UPDATE photo SET photo='$photo3' where id_photo=$id_photo3 ";
            $bdd->query($sql7);
            echo $photo3;
              move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if(!empty($photo4) && empty($supprimer4) && !empty($id_photo4)){
            $sql7="UPDATE photo SET photo='$photo4' where id_photo=$id_photo4 ";
            $bdd->query($sql7);
            echo $photo4;
              move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
      if(!empty($supprimer1) && !empty($id_photo1)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo1";
            $bdd->query($sql11);
        }
        if(!empty($supprimer2) && !empty($id_photo2)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo2";
            $bdd->query($sql11);
        }
        if(!empty($supprimer3) && !empty($id_photo3)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo3";
            $bdd->query($sql11);
        }
        if(!empty($supprimer4) && !empty($id_photo4)){
            echo "supprimer";
            $sql11="DELETE FROM photo where id_photo=$id_photo4";
            $bdd->query($sql11);
        }
    if($nombre==0 && !empty($photo1)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo1')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo1']['tmp_name'],
         'image/'. $_FILES['photo1']['name']);
        }
        if($nombre==0 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==0 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==0 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==1 && !empty($photo2)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo2')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo2']['tmp_name'],
         'image/'. $_FILES['photo2']['name']);
        }
        if($nombre==1 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==1 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==2 && !empty($photo3)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo3')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo3']['tmp_name'],
         'image/'. $_FILES['photo3']['name']);
        }
        if($nombre==2 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
        if($nombre==3 && !empty($photo4)){
            $sql12="INSERT INTO photo(id_annonce,photo) VALUES($an,'$photo4')";
            $bdd->query($sql12);
            move_uploaded_file($_FILES['photo4']['tmp_name'],
         'image/'. $_FILES['photo4']['name']);
        }
$sql="UPDATE annonce SET valide=0,titre=\"$titre\",description=\"$description\" where id_annonce=$an ";
$sql2="UPDATE logement SET type=\"$type\",type_logement=\"$type_logement\",surface='$surface',adresse=\"$adresse\",loyer='$loyer' where id_annonce=$an ";
if(empty($telephone)){
    echo 'nexiste pas'.$in;
    $sql3="UPDATE telephone SET tel=0 where id_information=$in";
}else{
    echo 'existe';
    echo $telephone;
    $sql3="UPDATE telephone SET tel='$telephone' where id_information=$in"; 
} 
$sql4="UPDATE mail SET mail='$mail' where id_information=$in";
$sql5="UPDATE site SET nom_site='$site' where id_information=$in"; 
    if($bdd->query($sql3)){
        echo 3;
    } if($bdd->query($sql)){
        echo 1;
    }
        if($bdd->query($sql) && $bdd->query($sql2) && $bdd->query($sql3) && $bdd->query($sql4) && $bdd->query($sql5) ){
         header('Location: index.php');
                die;}
}}
if(isset($_GET['id_an'])){
    $id_an=$_GET['id_an'];
     try {
           $bdd = new PDO('mysql:host=localhost;dbname=annonces;charset=utf8', 'root', '');
        }
        catch(Exception $e)
        {
                die('Erreur : '.$e->getMessage());}
$sql="SELECT id_formation FROM formation where id_annonce=$id_an ";
           $resultat = $bdd->query($sql);
    if($resultat->rowCount()>0){
        $categorie="formation";
    }
$sql="SELECT id_logement FROM logement where id_annonce=$id_an ";
           $resultat1 = $bdd->query($sql);
    if($resultat1->rowCount()>0){
        $categorie="logement";
    }
$sql="SELECT id_sortie FROM sortie where id_annonce=$id_an ";
           $resultat2 = $bdd->query($sql);
    if($resultat2->rowCount()>0){
        $categorie="sortie";
    }
$sql="SELECT id_travail FROM travail where id_annonce=$id_an ";
           $resultat3 = $bdd->query($sql);
    if($resultat3->rowCount()>0){
        $categorie="recrutement";
    }
$sql="SELECT id_evenement FROM evenement where id_annonce=$id_an ";
           $resultat4 = $bdd->query($sql);
    if($resultat4->rowCount()>0){
        $categorie="evenement";
    }
}
if($categorie=='formation'){
    $sql="SELECT titre,description FROM annonce where id_annonce=$id_an ";
    $sql2="SELECT * FROM formation where id_annonce=$id_an ";
    $sql3="SELECT id_information FROM information where id_annonce=$id_an ";
    $sql9="SELECT id_photo,photo FROM photo where id_annonce=$id_an ";
    $r=$bdd->query($sql);
    $line = $r->fetch();
    $p=$bdd->query($sql2);
     $line2 = $p->fetch();
     $j=$bdd->query($sql3);
       $line3 = $j->fetch();
    $u=$bdd->query($sql9);
    $id_in=$line3['id_information'];
    $sql4="SELECT tel FROM telephone where id_information=$id_in ";
      $t=$bdd->query($sql4);
     $linetel = $t->fetch();
    $sql5="SELECT mail FROM mail where id_information=$id_in ";
      $m=$bdd->query($sql5);
     $linemail = $m->fetch();
    $sql6="SELECT nom_site FROM site where id_information=$id_in ";
      $s=$bdd->query($sql6);
     $linesite = $s->fetch();    
}elseif($categorie=="evenement"){
    $sql="SELECT titre,description FROM annonce where id_annonce=$id_an ";
    $sql2="SELECT * FROM evenement where id_annonce=$id_an ";
    $sql3="SELECT id_information FROM information where id_annonce=$id_an ";
    $sql9="SELECT id_photo,photo FROM photo where id_annonce=$id_an ";
    $r=$bdd->query($sql);
    $line = $r->fetch();
    $p=$bdd->query($sql2);
     $line2 = $p->fetch();
     $j=$bdd->query($sql3);
       $line3 = $j->fetch();
    $u=$bdd->query($sql9);
    $id_in=$line3['id_information'];
    $sql4="SELECT tel FROM telephone where id_information=$id_in ";
      $t=$bdd->query($sql4);
     $linetel = $t->fetch();
    $sql5="SELECT mail FROM mail where id_information=$id_in ";
      $m=$bdd->query($sql5);
     $linemail = $m->fetch();
    $sql6="SELECT nom_site FROM site where id_information=$id_in ";
      $s=$bdd->query($sql6);
     $linesite = $s->fetch();  
}elseif($categorie=="recrutement"){
     $sql="SELECT titre,description FROM annonce where id_annonce=$id_an ";
    $sql2="SELECT * FROM travail where id_annonce=$id_an ";
    $sql3="SELECT id_information FROM information where id_annonce=$id_an ";
     $sql9="SELECT id_photo,photo FROM photo where id_annonce=$id_an ";
    $r=$bdd->query($sql);
    $line = $r->fetch();
    $p=$bdd->query($sql2);
     $line2 = $p->fetch();
     $j=$bdd->query($sql3);
       $line3 = $j->fetch();
     $u=$bdd->query($sql9);
    $id_in=$line3['id_information'];
    $sql4="SELECT tel FROM telephone where id_information=$id_in ";
      $t=$bdd->query($sql4);
     $linetel = $t->fetch();
    $sql5="SELECT mail FROM mail where id_information=$id_in ";
      $m=$bdd->query($sql5);
     $linemail = $m->fetch();
    $sql6="SELECT nom_site FROM site where id_information=$id_in ";
      $s=$bdd->query($sql6);
     $linesite = $s->fetch(); 
}
elseif($categorie=="logement"){
     $sql="SELECT titre,description FROM annonce where id_annonce=$id_an ";
    $sql2="SELECT * FROM logement where id_annonce=$id_an ";
    $sql3="SELECT id_information FROM information where id_annonce=$id_an ";
$sql9="SELECT id_photo,photo FROM photo where id_annonce=$id_an ";
 $u=$bdd->query($sql9);
    $r=$bdd->query($sql);
    $line = $r->fetch();
    $p=$bdd->query($sql2);
     $line2 = $p->fetch();
     $j=$bdd->query($sql3);
       $line3 = $j->fetch();
    $id_in=$line3['id_information'];
    $sql4="SELECT tel FROM telephone where id_information=$id_in ";
      $t=$bdd->query($sql4);
     $linetel = $t->fetch();
    $sql5="SELECT mail FROM mail where id_information=$id_in ";
      $m=$bdd->query($sql5);
     $linemail = $m->fetch();
    $sql6="SELECT nom_site FROM site where id_information=$id_in ";
      $s=$bdd->query($sql6);
     $linesite = $s->fetch(); 
}
elseif($categorie=="sortie"){
     $sql="SELECT titre,description FROM annonce where id_annonce=$id_an ";
    $sql2="SELECT * FROM sortie where id_annonce=$id_an ";
    $sql3="SELECT id_information FROM information where id_annonce=$id_an ";
       $sql9="SELECT id_photo,photo FROM photo where id_annonce=$id_an ";
 $u=$bdd->query($sql9);
    $r=$bdd->query($sql);
    $line = $r->fetch();
    $p=$bdd->query($sql2);
     $line2 = $p->fetch();
     $j=$bdd->query($sql3);
       $line3 = $j->fetch();
    $id_in=$line3['id_information'];
    $sql4="SELECT tel FROM telephone where id_information=$id_in ";
      $t=$bdd->query($sql4);
     $linetel = $t->fetch();
    $sql5="SELECT mail FROM mail where id_information=$id_in ";
      $m=$bdd->query($sql5);
     $linemail = $m->fetch();
    $sql6="SELECT nom_site FROM site where id_information=$id_in ";
      $s=$bdd->query($sql6);
     $linesite = $s->fetch(); 
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="fontawesome-free-5.0.13/web-fonts-with-css/css/fontawesome-all.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Lora" rel="stylesheet">
	<title>Modifier-UMMTO annonce</title>
	<link rel="stylesheet" type="text/css" href="css/modifier.css">
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
   <body OnLoad="LoadValue();">

<header>  <a style="float:left;padding:0;margin-top:0;" href="index.php">
    <div id="logo">
			<img src="newlogo.png" alt="">
    </div></a>
        <div id ="menu ">    
        <a title="Déconnexion" href="http://localhost/annonce/php/deconnexion.php" style="font-size:2em;width:40px;overflow:visible;cursor:pointer"><i class="fas fa-sign-out-alt"></i></a>
   <div class="dropdown">
<button onclick="myFunction()" class="dropbtn"><i class="fas fa-user"></i></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="categorie.php?user=<?php echo $id; ?>">Mes annonces</a>
    <a href="#about">Paramètres</a>
       </div></div>

</div>	
<a class ="posta" href="formulaire.php">+Poster une annonce</a>
	</header>
       <article><p style =" font-size : 25px ; margin-left : 25px ; text-align : center ; color : #3282C1 ; font-weight : bold ; 
       font-style : italic ;  ">Modifier votre annonce <br></p></article>
		<section>
<form method="post" action="modifier.php?cat=<?php echo $categorie; ?>&id=<?php echo $id_an; ?>&id_in=<?php echo $id_in; ?>" onsubmit="return verifForm2(this)" enctype="multipart/form-data"  >
				<div id="formulaire">
				<div>
					<h3>Déscription de votre annonce</h3>
					<?php if($categorie=="formation"){ ?>
					<div id="Formations">
					<span id="formu" value='formation' style="display:none;" ></span>
						<label>Domaine :</label>
						<select name="type_formation" >
<option <?php if($line2['type_formation']=='Langues'){echo "SELECTED";} ?>  >Langues</option>
<option <?php if($line2['type_formation']=='Informatique'){echo "SELECTED";} ?>>Informatique</option>
<option <?php if($line2['type_formation']=='Burautiue'){echo "SELECTED";} ?>>Bureautique</option>
<option <?php if($line2['type_formation']=='Ressources_humaines'){echo "SELECTED";} ?>>Ressources_humaines</option>
<option <?php if($line2['type_formation']=='Finance'){echo "SELECTED";} ?>>Finance</option>
<option <?php if($line2['type_formation']=='Marketing-Communication'){echo "SELECTED";} ?>>Marketing-Communication</option>
<option <?php if($line2['type_formation']=='Comptabilité'){echo "SELECTED";} ?>>Comptabilité</option>
<option <?php if($line2['type_formation']=='Tourisme'){echo "SELECTED";} ?>>Tourisme</option>
<option <?php if($line2['type_formation']=='Autre'){echo "SELECTED";} ?>>Autre</option>	
						</select><br/>
					</div>
						<br/><label>Titre de l'annonce : </label>
<input value="<?php echo $line['titre']; ?>" id ="titre1" name="titre"  type="text" name="titre" onkeyup="verifTitreK(this)" onblur="verifTitre(this)"  required  maxlength="70" minlenght ="10" ><span>*</span><br> 
						<p id ="msg1"></p><p id ="msg1a"></p>

						<label>Déscription : </label>
<textarea id="description1" name="description" rows="5" cols="50" onkeyup="verifDescK(this)" onblur="verifDesc(this)" required maxlength="1500" minlenght ="20" ><?php echo $line['description']; ?></textarea>
						<span>*</span><br/>
						<p id ="msg2"></p><p id ="msg2a"></p>
				</div>
				<div id="DetailsFormation">
					<h3>Details de votre annonce :</h3>
						<label>Date de début : </label>
<input id="date1" name="date_debut" value="<?php echo $line2['date_debut']; ?>"  type="date" onblur="madate(this)" required ><br/> <p id ="msg13"></p>
						<label>Etablissement : </label>
<input id="etablissement1" name='etablissement' value="<?php echo $line2['etablissement']; ?>" type="text"  onblur="verifEta(this)" onkeyup="verifEtaK(this)" required  pattern="(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?" maxlength="25" minlenght ="3" ><br/> 
				        <p id ="msg5"></p><p id ="msg5a"></p><p id ="msg5b"></p>

						<label>Adresse : </label>
<input id="adresse1" name='adresse' value="<?php echo $line2['adresse']; ?>" type="text"  onblur="verifAdr(this)" onkeyup="verifAdrK(this)"  required maxlength="80" minlenght ="5" ><br/>
						<p id ="msg6"><p id ="msg6a">
						
				</div>
				<?php }elseif($categorie=='recrutement'){ ?>
				<span id="kab" value='recrutement' style="display:none;" ></span>

				<div id="Recrutement" >
				
					<label>Type de travail :</label> <br> 
<input <?php if($line2['type_travail']=="emploi"){echo "checked";} ?> type="radio" name="travail" value="emploi" id="emploi" >Offre d'emploi
<input <?php if($line2['type_travail']=="stage"){echo "checked";} ?> type="radio" name="travail" value="stage" id="stage" >Offre de stage
						<br/>
					</div>
					<br/><label>Titre de l'annonce : </label>
<input value="<?php echo $line['titre']; ?>" id="titre2" name="titre" type="text" name="titre" onkeyup="verifTitreK(this)" onblur="verifTitre(this)" required maxlength="70" minlenght ="10" ><span>*</span><br> 
						<p id ="msg1"></p><p id ="msg1a"></p>
						<label>Déscription : </label>
<textarea required maxlength="1500" minlenght ="20" id="description2" name="description" rows="5" cols="50" onkeyup="verifDescK(this)" onblur="verifDesc(this)"><?php echo $line['description']; ?></textarea>
						<span>*</span><br/>
						<p id ="msg2"></p><p id ="msg2a"></p>
						<div id="DetailsRecrutement" >
					<h3>Details de votre annonce :</h3>
						<label>Domaine : </label>
<input value="<?php echo $line2['domaine']; ?>" type="text" id="domaine2" name="domaine" onblur="verifDom(this)" onblur="verifDomK(this)" required pattern="(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?"  ><br/>
<p id ="msg3"></p><p id ="msg3a"></p><p id ="msg3b"></p>
						
						
						<label>Etablissement : </label>
<input value="<?php echo $line2['etablissement']; ?>" type="text" id="etablissement2" name="etablissement" onblur="verifEta(this)" onkeyup = "verifEtaK(this)" required pattern="(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?" maxlength="25" minlenght ="3" ><br/>
<p id ="msg5"></p><p id="msg5a"></p><p id ="msg5b"></p>
						
						
						<label>Adresse : </label>
<input value="<?php echo $line2['adresse']; ?>" type="text" id="adresse2" name="adresse" onblur="verifAdr(this)" onkeyup="verifAdrK(this)" maxlength="80" minlenght ="5" required ><br/>
<p id ="msg6"><p id ="msg6a"></p>
						
						<label>Salaire mensuel (DZD) : </label>
<input value="<?php echo $line2['salaire']; ?>" type="" id="salaire2" name="salaire" onblur="verifSalaire(this)" onkeyup="verifSalaireK(this)" required><br/>
<p id ="msg4"></p><p id ="msg4a"></p><p id ="msg4b"></p>
				
				</div>
				<?php }elseif($categorie=='logement'){ ?>
				<div id="Logement" >
						<label>Type de location :</label>  <br> 
						<div>
<input <?php if($line2['type_logement']=="Location"){echo "checked";} ?> type="radio"  name="type_logement"   id="location" checked="checked" value ="Location">Location
                        
<input <?php if($line2['type_logement']=="Colocation"){echo "checked";} ?> type="radio" name="type_logement"   id="colocation" value="Colocation">Colocation
						 <br/>
						 </div>
					</div>
					<br/><label>Titre de l'annonce : </label>
<input value="<?php echo $line['titre']; ?>" id="titre3" name="titre" type="text" name="titre" onkeyup="verifTitreK(this)" onblur="verifTitre(this)" required maxlength="70" minlenght ="10"><span>*</span><br> 
						<p id ="msg1"></p><p id ="msg1a"></p>

						<label>Déscription : </label>
<textarea id="description3" name="description" rows="5" cols="50" onkeyup="verifDescK(this)" onblur="verifDesc(this)" required maxlength="1500" minlenght ="20" ><?php echo $line['description']; ?></textarea>
						<span>*</span><br/>
						<p id ="msg2"></p><p id ="msg2a"></p>
						
						<div id="DetailsLogement" >
					<h3>Details de votre annonce :</h3>
						<label>Adresse : </label>
<input value="<?php echo $line2['adresse']; ?>" type="text" id="adresse3" name="adresse" onblur="verifAdr(this)"
    onkeyup="verifAdrK(this)" required maxlength="80" minlenght ="5" ><span>*</span> <br/>
						<p id ="msg6"></p><p id ="msg6a"></p>
						
						<label>Type du logement : </label> 
							<select name="type">
<option <?php if($line2['type']=='Chambre'){echo "SELECTED";} ?>>Chambre</option>
<option <?php if($line2['type']=='Studio'){echo "SELECTED";} ?>>Studio</option>
							</select>
							
							<br/>
						<label>Surface(m²) : </label>
<input value="<?php echo $line2['surface']; ?>" type="number" id="surface3" name="surface" onblur="verifSurf(this)" onkeyup="verifSurfK(this)" required min ="8" max="80" pattern="\d+\.?\d{1,2}"><span>*</span> <br/>
						<p id ="msg7"></p><p id ="msg7a"></p><p id ="msg7b"></p>
						<label>Loyer mensuel DZD : </label>
<input value="<?php echo $line2['loyer']; ?>" type="number" id="loyer3" name="loyer"onblur="verifLoyer(this)" onkeyup="verifLoyerK(this)"  required min="2000" max="10000"  ><span>*</span> <br/>
						<p id ="msg11"></p><p id ="msg11a"></p><p id ="msg11b"></p>
				</div>
				<?php }elseif($categorie=="evenement"){ ?>
				<div id="Evènement" >
						<label>Type d'événement :</label>
						<select name="type_evenement">
<option <?php if($line2['type_evenement']=='Meet-up/Conférances'){echo "SELECTED";} ?>>Meet-up/Conférances</option>
<option <?php if($line2['type_evenement']=='Salon/Expositions'){echo "SELECTED";} ?>>Salon/Expositions</option>
<option <?php if($line2['type_evenement']=='Galas/Concerts/Spectacle'){echo "SELECTED";} ?>>Galas/Concerts/Spectacle</option>
<option <?php if($line2['type_evenement']=='Cinéma'){echo "SELECTED";} ?>>Cinéma</option>
<option <?php if($line2['type_evenement']=='Evènements_sportifs'){echo "SELECTED";} ?>>Evènements_sportifs</option>
<option <?php if($line2['type_evenement']=='Autre'){echo "SELECTED";} ?>>Autre</option>
						</select><br/>
					</div>
					<br/><label>Titre de l'annonce : </label>
<input value="<?php echo $line['titre']; ?>" id="titre4" name="titre" type="text" name="titre" onkeyup="verifTitreK(this)" onblur="verifTitre(this)" required maxlength="70" minlenght ="10" ><span>*</span><br> 
						<p id ="msg1"></p><p id ="msg1a"></p>

						<label>Déscription : </label>
<textarea id="description4" name="description" rows="5" cols="50" onkeyup="verifDescK(this)" onblur="verifDesc(this)" required maxlength="1500" minlenght ="20" ><?php echo $line['description']; ?></textarea>
						<span>*</span><br/>
						<p id ="msg2"></p><p id ="msg2a"></p>
						<div id="DetailsEvenement" >
					<h3>Details de votre annonce :</h3>
						<label>Date : </label>
<input id="date4" name='date_debut' value="<?php echo $line2['date_debut']; ?>" type="date" name="Date"><br/>
						
						<label>Horaire : </label>
				<select name="horaire">
<option <?php if($line2['horaire']=='08:00:00'){echo "SELECTED";} ?>>08:00</option>
<option <?php if($line2['horaire']=='09:00:00'){echo "SELECTED";} ?>>09:00</option>
<option <?php if($line2['horaire']=='10:00:00'){echo "SELECTED";} ?>>10:00</option>
<option <?php if($line2['horaire']=='11:00:00'){echo "SELECTED";} ?>>11:00</option>
<option <?php if($line2['horaire']=='12:00:00'){echo "SELECTED";} ?>>12:00</option>
<option <?php if($line2['horaire']=='13:00:00'){echo "SELECTED";} ?>>13:00</option>
<option <?php if($line2['horaire']=='14:00:00'){echo "SELECTED";} ?>>14:00</option>
<option <?php if($line2['horaire']=='15:00:00'){echo "SELECTED";} ?>>15:00</option>
<option <?php if($line2['horaire']=='16:00:00'){echo "SELECTED";} ?>>16:00</option>
<option <?php if($line2['horaire']=='17:00:00'){echo "SELECTED";} ?>>17:00</option> 
<option <?php if($line2['horaire']=='18:00:00'){echo "SELECTED";} ?>>18:00</option>
<option <?php if($line2['horaire']=='19:00:00'){echo "SELECTED";} ?>>19:00</option>
<option <?php if($line2['horaire']=='20:00:00'){echo "SELECTED";} ?>>20:00</option>
<option <?php if($line2['horaire']=='21:00:00'){echo "SELECTED";} ?>>21:00</option>                   
						</select><br/>		
						<label>Salle ou établissement : </label>
<input id="etablissement4" name='etablissement' value="<?php echo $line2['etablissement']; ?>" type="text" name="EtablissementE" onblur="verifEta(this)" onkeyup="verifEtaK(this)" required pattern="(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?" maxlength="25" minlenght ="3" ><br/>
                        <p id ="msg5"></p><p id ="msg5a"></p><p id ="msg5b"></p>
						<label>Adresse : </label>
<input id="adresse4" name='adresse' value="<?php echo $line2['adresse']; ?>" type="text" name="AdresseE" onblur="verifAdr(this)" onkeyup="verifAdr(this)" required ><br/>
						<p id ="msg6"></p><p id ="msg6a"></p>
						
                       <label>Organisateur : </label>
<input id="organisateur4" name='organisateur' value="<?php echo $line2['organisateur']; ?>" type="text" name="Organisateur" onblur="verifOrg(this)" onkeyup="verifOrg(this)" required pattern="(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?" maxlength="25" minlenght ="4" ><br/>
				        <p id ="msg3o"></p><p id ="msg3ao"></p><p id ="msg3bo"></p>
				       

				</div>
<?php }elseif($categorie=="sortie"){ ?>
				<br/><label>Titre de l'annonce : </label>
<input id="titre5" value="<?php echo $line['titre']; ?>" name="titre" type="text" name="titre" onkeyup="verifTitreK(this)" onblur="verifTitre(this)" required maxlength="70" minlenght ="10"  ><span>*</span><br> 
						<p id ="msg1"></p><p id ="msg1a"></p>

						<label>Déscription : </label>
<textarea id="description5" name="description" rows="5" cols="50" onkeyup="verifDescK(this)" onblur="verifDesc(this)" required maxlength="1500" minlenght ="20" ><?php echo $line['description']; ?></textarea>
						<span>*</span><br/>
						<p id ="msg2"></p><p id ="msg2a"></p>
				<div id="DetailsExcursion" >
					<h3>Details de votre annonce :</h3>
<label>Date : </label>
<input id="date5" value="<?php echo $line2['date_debut']; ?>" type="date" name="date"><span> *</span><br/>
                    <label>Horraire de départ : </label>
                    <select name="horaire">
<option <?php if($line2['horaire']=='08:00:00'){echo "SELECTED";} ?>>08:00</option>
<option <?php if($line2['horaire']=='09:00:00'){echo "SELECTED";} ?>>09:00</option>
<option <?php if($line2['horaire']=='10:00:00'){echo "SELECTED";} ?>>10:00</option>
<option <?php if($line2['horaire']=='11:00:00'){echo "SELECTED";} ?>>11:00</option>
<option <?php if($line2['horaire']=='12:00:00'){echo "SELECTED";} ?>>12:00</option>
<option <?php if($line2['horaire']=='13:00:00'){echo "SELECTED";} ?>>13:00</option>
<option <?php if($line2['horaire']=='14:00:00'){echo "SELECTED";} ?>>14:00</option>
<option <?php if($line2['horaire']=='15:00:00'){echo "SELECTED";} ?>>15:00</option>
<option <?php if($line2['horaire']=='16:00:00'){echo "SELECTED";} ?>>16:00</option>
<option <?php if($line2['horaire']=='17:00:00'){echo "SELECTED";} ?>>17:00</option> 
<option <?php if($line2['horaire']=='18:00:00'){echo "SELECTED";} ?>>18:00</option>
<option <?php if($line2['horaire']=='19:00:00'){echo "SELECTED";} ?>>19:00</option>
<option <?php if($line2['horaire']=='20:00:00'){echo "SELECTED";} ?>>20:00</option>
<option <?php if($line2['horaire']=='21:00:00'){echo "SELECTED";} ?>>21:00</option>                   
						</select><br/>

						<label>lieu de départ : </label>
<input id="dep5"value="<?php echo $line2['adresse_depart']; ?>" type="text" name="lieudepart"  required maxlength="80" minlenght ="5" ><span>*</span><br/>
						
						<label>Lieu d'arrivée : </label>
<input id="arr5"value="<?php echo $line2['adresse_arrive']; ?>" type="text" name="lieuarrivee"  required maxlength="80" minlenght ="5" ><span>*</span><br/>
						
						<label>Prix : </label>
<input id="prix5" onblur ="verifPrix" onkeyup ="verifPrixK" value="<?php echo $line2['prix']; ?>" type="text" name="prix" required min="100" max="200" ><br/>		
            <p id ="msg12"><p id="msg12a"><p id="msg12a"></p>
				</div>
				<?php } ?>
				<div>
				
					<h3>Informations complémentaires</h3>
						<label>Télephone : </label>
<input id="tel"  name='telephone' value="<?php echo "0".$linetel['tel']; ?>" type="text" name="Tel"  onblur= "verifTel(this)" onkeyup= "verifTelK(this)"    pattern="0[567][0-9]{8}" ><br/><p id ="msg8"></p>
						<label>E-mail : </label>
<input id="mail" name='mail' value="<?php echo $linemail['mail']; ?>" type="email"  name="Email" 
onblur= "verifMail(this)" onkeyup= "verifMailK(this)" pattern="a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}" ><br/><p id ="msg9"></p>
						<label>Site internet : </label>
<input id="site" name='site' value="<?php echo $linesite['nom_site']; ?>" type="text"  name="Site" onblur= "verifLink(this)" onkeyup= "verifLinkK(this)" pattern="(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?"  ><br/><p id ="msg10"></p>
				</div>
				 <div>
					<h3>Images</h3>
						Illustrez votre annonce <br> <br>
						<div>
					<?php $sql12="SELECT count(id_annonce) as n FROM photo WHERE id_annonce=$id_an";
                          $num=$bdd->query($sql12);
                            $linenum=$num->fetch();
                            $nombre=$linenum['n'];
                            $i=1; while( $line4 = $u->fetch()){
                        
                            ?>
            <img style="width:500px;" src="image/<?php echo $line4['photo'] ?>" alt=""> 
            <input type="file" name='photo<?php echo $i; ?>' accept="image/*" >
            <input type="checkbox" name='supprimer<?php echo $i; ?>' value="supprimer<?php echo $i; ?>"  >Supprimer
            <input style="display:none;" type="text" name="id_photo<?php echo $i; $i++; ?>" value="<?php echo $line4['id_photo']; ?>">
            
            <?php } ?>
                 <input style="display:none;" name='nombre' name="nombre"  value="<?php echo $nombre; ?>" >
                            <?php if($nombre==1){ ?>
                            <p><input type="file" name='photo2' accept="image/*" ></p>
                            <p><input type="file" name='photo3' accept="image/*" ></p>
                            <p><input type="file" name='photo4' accept="image/*" ></p>
            <?php }elseif($nombre==2){ ?>
                            <p><input type="file" name='photo3' accept="image/*" ></p>
                            <p><input type="file" name='photo4' accept="image/*" ></p>
             <?php }elseif($nombre==3){ ?>
                            <p><input type="file" name='photo4' accept="image/*" ></p>
             <?php }elseif($nombre==0){ ?>
                            <p><input type="file" name='photo1' accept="image/*" ></p>
                            <p><input type="file" name='photo2' accept="image/*" ></p>
                            <p><input type="file" name='photo3' accept="image/*" ></p>
                            <p><input type="file" name='photo4' accept="image/*" ></p>
            <?php } ?>
					</div>	
						
				</div>
				<input type='button' value='Annuler' style ="background-color: #EE4957;
    border-radius: 4px;
    font-size: 15px;
    padding: 8px 24px;
    margin-right: 10px;
    margin-bottom: 5px;
    border: 0px;
    cursor:pointer;                                                          
    color: white;
    width: 177px;
   "
     onclick="document.location.href = 'categorie.php?user=<?php echo $id;  ?>'">
<input  type='submit' id="valider" name="valider" value='Enregistrer'style ="background-color: #3282C1;
    margin-right: 10px;
    margin-bottom: 5px;
    padding: 8px 24px;
    border: 0px;
    color: white;
    border-radius: 4px;
    font-size: 15px;
    cursor: pointer;
    width: 177px;
    margin-left: 0;">
				</div>

					
			</form>
		</section>
		<footer>
	</footer>
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

 
</body>
</html>