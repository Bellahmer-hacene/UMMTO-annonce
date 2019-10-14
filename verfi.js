var msg1 = "Le tire doit avoir au minimum 10 caractères" ;
var msg1a = "Le titre ne doit pas avoir plus de 70 caractères" ; 

var msg2 = "Description trop courte" ;
var msg2a = "Description trop longue" ; 

var msg3 = "Le nom du domaine ne peut contenir que des lettres" ; 
var msg3a = "Nom du domaine trop court" ; 
var msg3b = "Nom du domaine trop long" ; 

var msg3o = "Ce champs ne doit pas contenir de chiffres" ; 
var msg3ao = "Chaine trop courte" ; 
var msg3bo = "Chaine trop longue" ;     

var msg4 = "Le salaire doit etre supérieure à 10.000 DA" ;     
var msg4a = "Veuillez introduire le salaire en chiffres numériques" ;     
var msg4b = "Salaire incohérent" ;

var msg5 = "Le nom de l'etablissement ne doit contenir que des lettres " ; 
var msg5a = "Nom de l'etablissement trop court   " ; 
var msg5b = "Nom de l'etablissement trop long " ; 
    
var msg5x = "Le nom de l'etablissement ne doit contenir que des lettres  " ; 
var msg5ax = "Nom de l'etablissement trop court   " ; 
var msg5bx = "Nom de l'etablissement trop long " ;     

var msg5z = "Le nom de l'etablissement ne doit contenir que des lettres " ; 
var msg5az = "Nom de l'etablissement trop court   " ; 
var msg5bz = "Nom de l'etablissement trop long " ;       

var msg7 = "Surface incohérante" ;     
var msg7a = "Respectez un des ces deux formats : xx ou xx.xx" ;     
var msg7b = "Valeur impossible " ;     

var msg11 = "Le prix du loyer est incohérent" ;     
var msg11a = "Respectez le format" ;     
var msg11b = "Le prix du loyer est incohérent " ; 
    
var msg12 = "Le prix est incohérent" ;     
var msg12a = "Veuillez introduire le prix en chiffres numériques" ;     
var msg12b = "Le prix est incohérent " ; 

var msg6 = "Adresse trop courte " ; 
var msg6a = "Adresse trop longue" ; 

var msg6x = "Adresse trop courte " ; 
var msg6ax = "Adresse trop longue" ;     
 
var msg6z = "Adresse trop courte " ; 
var msg6azz = "Adresse trop longue" ;  
    
var msg6e = "Adresse trop courte " ; 
var msg6ae = "Adresse trop longue" ;  

var msg8 = "Numéro de téléphone incorrect" ;  
var msg9 = "Adresse mail incorrecte" ;  
var msg10 = "URL incorrecte" ;  

var msg12a = "Veuillez introduire le prix en chiffres" ;
var msg12b = "Prix incohérent(très élevé)" ;
var msg12 = "Prix incohérent(trop bas) " ;


var msg13 ="La date doit etre supérieure à celle d'aujourd'hui" ; 
var msg13a ="Ce champs est requis" ; 

 
var msg14 ="" ; 
var msg15 ="" ; 
    function madate(champ) {
        var dateString = champ.value;
        var myDate = new Date(dateString);
        var today = new Date();
        if ( myDate <= today ) {
                  document.getElementById("msg13").innerHTML = msg13 ; 
        surligne(champ, true);

            return false;}
             else if ( myDate = "" ) {
                  document.getElementById("msg13").innerHTML = msg13a ; 
        surligne(champ, true);

            return false;
        }
             else { document.getElementById("msg13").innerHTML = "" ; 
        surligne(champ, false);

        return true;}
    }
    
function verifTitre(champ){
   if(champ.value.length < 10){ 
       document.getElementById("msg1").innerHTML = msg1 ; 
      surligne(champ, true);
      return false;
    }  else if (champ.value.length > 70) {
      document.getElementById("msg1a").innerHTML = msg1a ; 
      surligne(champ, true);
      return false; 
   } else {
       return true ; 
   }
}

function verifTitreK(champ){
   if(champ.value.length < 10){ 
      return false;
    }  else if (champ.value.length > 70) {
      return false; 
   } else { 
        document.getElementById("msg1").innerHTML = "" ; 
               document.getElementById("msg1a").innerHTML = "" ; 

        surligne(champ, false);
        return true;
   }
}

    

    
    
    
function verifDesc(champ){
   if(champ.value.length < 20)  {      
       document.getElementById("msg2").innerHTML = msg2 ; 
      surligne(champ, true);
      return false;
   } else if (champ.value.length > 1500) {
      document.getElementById("msg2a").innerHTML = msg2a ; 
      surligne(champ, true);
      return false;
}else {
    document.getElementById("msg2a").innerHTML = "" ; 
    document.getElementById("msg2").innerHTML = "" ; 
    surligne(champ, false);
    return true;
   }
}    

function verifDescK(champ){
   if(champ.value.length < 20)  {      
   
      return false;
   } else if (champ.value.length > 200) {
     
      return false;
}else {
    document.getElementById("msg2a").innerHTML = "" ; 
    document.getElementById("msg2").innerHTML = "" ; 
    surligne(champ, false);
    return true;
   }
}   

function verifDom(champ)
{
      var regex = /^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/ ; 

   if (champ.value.length < 5){
        document.getElementById("msg3a").innerHTML = msg3a ; 
        surligne(champ, true);
        return false;
       }

   else if (!regex.test(champ.value)) {
        document.getElementById("msg3").innerHTML = msg3 ; 
        surligne(champ, true);
        return false;
   }
    else if (champ.value.length > 30) {
        document.getElementById("msg3b").innerHTML = msg3b ; 
        surligne(champ, true);
        return false;
       } 
    else {
      document.getElementById("msg3").innerHTML = "" ; 
      document.getElementById("msg3a").innerHTML = "" ; 
      document.getElementById("msg3b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}

function verifDomK(champ)
{
      var regex = /^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/ ; 

   if (champ.value.length < 5){
        return false;
       }

   else if (!regex.test(champ.value)) {
        return false;
   }
    else if (champ.value.length > 30) {
        return false;
       } 
    else {
      document.getElementById("msg3").innerHTML = "" ; 
      document.getElementById("msg3a").innerHTML = "" ; 
      document.getElementById("msg3b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 


/*/^[a-zA-Zéçàè]+[ \-']?[[a-zA-Zéçàè]+[ \-']?]*[a-zA-Zéçàè]+[ ]?$/;*/
/* /^(([A-Za-z]+[\-\']?)*([A-Za-z]+)?\s)+([A-Za-z]+[\-\']?)*([A-Za-z]+)?$/*/

function verifOrg(champ)
{
   var regex = /^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/ ; 

   if (champ.value.length < 3){
        document.getElementById("msg3ao").innerHTML = msg3ao ; 
        surligne(champ, true);
        return false;
       }

   else if (!regex.test(champ.value)) {
        document.getElementById("msg3o").innerHTML = msg3o ; 
        surligne(champ, true);
        return false;
   }
    else if (champ.value.length > 35) {
        document.getElementById("msg3bo").innerHTML = msg3bo ; 
        surligne(champ, true);
        return false;
       } 
    else {
      document.getElementById("msg3o").innerHTML = "" ; 
      document.getElementById("msg3ao").innerHTML = "" ; 
      document.getElementById("msg3bo").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}    

function verifOrgK(champ)
{
   var regex = /^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/ ; 

   if (champ.value.length < 3){
        return false;
       }

   else if (!regex.test(champ.value)) {
        return false;
   }
    else if (champ.value.length > 80) {
        return false;
       } 
    else {
      document.getElementById("msg3o").innerHTML = "" ; 
      document.getElementById("msg3ao").innerHTML = "" ; 
      document.getElementById("msg3bo").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 

function verifAdr(champ){
   if(champ.value.length < 5){      
       document.getElementById("msg6").innerHTML = msg6 ; 
      surligne(champ, true);
      return false;
   } 
     else if(champ.value.length > 80 ) {  
       document.getElementById("msg6a").innerHTML = msg6a ; 
      surligne(champ, true);
      return false;
   } 
    else {
         document.getElementById("msg6").innerHTML = "" ; 
      document.getElementById("msg6a").innerHTML = "" ; 
     
      return true;
   }
} 

function verifAdrK(champ){
   if(champ.value.length < 5){      
      return false;
   } 
     else if(champ.value.length > 80 ) {  
      return false;
   } 
    else {
      document.getElementById("msg6").innerHTML = "" ; 
      document.getElementById("msg6a").innerHTML = "" ; 
       surligne(champ, false);
      return true;
   }
} 

/*function verifDate(champ){
   if(champ.value.length < 5){      
       document.getElementById("msg6").innerHTML = msg6 ; 
      surligne(champ, true);
      return false;
   } 
     else if(champ.value.length > 80 ) {  
       document.getElementById("msg6a").innerHTML = msg6a ; 
      surligne(champ, true);
      return false;
   } 
    else {
      document.getElementById("msg6").innerHTML = "" ; 
      document.getElementById("msg6a").innerHTML = "" ; 
       surligne(champ, false);
      return true;
   }
} */



function verifAdre(champ){
   if(champ.value.length < 5){      
       document.getElementById("msg6e").innerHTML = msg6e ; 
      surligne(champ, true);
      return false;
   } 
     else if(champ.value.length > 35 ) {  
       document.getElementById("msg6ae").innerHTML = msg6ae ; 
      surligne(champ, true);
      return false;
   } 
    else {
      document.getElementById("msg6e").innerHTML = "" ; 
      document.getElementById("msg6ae").innerHTML = "" ; 
       surligne(champ, false);
      return true;
   }
}     
    
function verifAdrr(champ){
   if(champ.value.length < 5){      
       document.getElementById("msg6x").innerHTML = msg6x ; 
      surligne(champ, true);
      return false;
   } 
     else if(champ.value.length > 35 ) {  
       document.getElementById("msg6ax").innerHTML = msg6ax ; 
      surligne(champ, true);
      return false;
   } 
    else {
      document.getElementById("msg6x").innerHTML = "" ; 
      document.getElementById("msg6ax").innerHTML = "" ; 
       surligne(champ, false);
      return true;
   }
} 

function verifAdrrK(champ){
   if(champ.value.length < 5){      
      return false;
   } 
     else if(champ.value.length > 35 ) {  
      return false;
   } 
    else {
      document.getElementById("msg6x").innerHTML = "" ; 
      document.getElementById("msg6ax").innerHTML = "" ; 
       surligne(champ, false);
      return true;
   }
} 


    
function verifAdrrr(champ){
   if(champ.value.length < 5){      
       document.getElementById("msg6z").innerHTML = msg6z ; 
      surligne(champ, true);
      return false;
   } 
     else if(champ.value.length > 35 ) {  
       document.getElementById("msg6azz").innerHTML = msg6azz ; 
      surligne(champ, true);
      return false;
   } 
    else {
      document.getElementById("msg6z").innerHTML = "" ; 
      document.getElementById("msg6azz").innerHTML = "" ; 
       surligne(champ, false);
      return true;
   }
}      
    
function verifSalaire(champ)
{
   var regex = /^[0-9]*$/;
    var salaire = Number(champ.value);

   if(salaire < 10000 )
   {
        document.getElementById("msg4").innerHTML = msg4 ; 
        surligne(champ, true);
        return false;
   }   
    else if(!regex.test(champ.value))
   {
        document.getElementById("msg4a").innerHTML = msg4a ; 
        surligne(champ, true);
        return false;
   }   
    else if( salaire > 100000)
   {
        document.getElementById("msg4b").innerHTML = msg4b ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg4").innerHTML = "" ; 
      document.getElementById("msg4a").innerHTML = "" ; 
      document.getElementById("msg4b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 



function verifSalaireK(champ)
{
   var regex = /^[0-9]*$/;
    var salaire = Number(champ.value);

   if(salaire < 10000 )
   {
        return false;
   }   
    else if(!regex.test(champ.value))
   {
        return false;
   }   
    else if( salaire > 100000)
   {
        return false;
   }
   else
   {
      document.getElementById("msg4").innerHTML = "" ; 
      document.getElementById("msg4a").innerHTML = "" ; 
      document.getElementById("msg4b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 




function verifSurf(champ)
{
   var regex = /^\d+\.?\d{1,2}$/;
    var surface = Number(champ.value);

   if(!regex.test(champ.value))
   {
        document.getElementById("msg7a").innerHTML = msg7a ; 
        surligne(champ, true);
        return false;
   }   
    else if(surface < 8 )
   {
        document.getElementById("msg7").innerHTML = msg7 ; 
        surligne(champ, true);
        return false;
   }   
    
    else if( surface > 80)
   {
        document.getElementById("msg7b").innerHTML = msg7b ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg7").innerHTML = "" ; 
      document.getElementById("msg7a").innerHTML = "" ; 
      document.getElementById("msg7b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 

function verifSurfK(champ)
{
   var regex = /^\d+\.?\d{1,2}$/;
    var surface = Number(champ.value);

   if(!regex.test(champ.value))
   {
        return false;
   }   
    else if(surface < 8 )
   {
        return false;
   }   
    
    else if( surface > 80)
   {
        return false;
   }
   else
   {
      document.getElementById("msg7").innerHTML = "" ; 
      document.getElementById("msg7a").innerHTML = "" ; 
      document.getElementById("msg7b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}







function verifLoyer(champ)
{
   var regex = /^[0-9]+$/;
       var loyer = Number(champ.value);

  if(!regex.test(champ.value))
   {
        document.getElementById("msg11a").innerHTML = msg11a ; 
        surligne(champ, true);
        return false;
   } 
    else if(loyer < 2000 )
   {
        document.getElementById("msg11").innerHTML = msg11 ; 
        surligne(champ, true);
        return false;
   }   
   
    else if( loyer > 10000)
   {
        document.getElementById("msg11b").innerHTML = msg11b ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg11").innerHTML = "" ; 
      document.getElementById("msg11a").innerHTML = "" ; 
      document.getElementById("msg11b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 

/*function verifLoyer(champ)
{
   var regex = /^\d+\.?\d{1,2}$/;
    var loyer = Number(champ.value);

  if(!regex.test(champ.value))
   {
        document.getElementById("msg11a").innerHTML = msg11a ; 
        surligne(champ, true);
        return false;
   } 
    else if(loyer < 2000 && document.getElementById('typel').selectedIndex==0 && document.getElementById('typel').selectedIndex==1 )
   {
        document.getElementById("msg11").innerHTML = msg11 ; 
        surligne(champ, true);
        return false;
   }   
   
    else if( loyer > 10000 && document.getElementById('typel').selectedIndex==0 && document.getElementById('typel').selectedIndex==1 )
   {
        document.getElementById("msg11b").innerHTML = msg11b ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg11").innerHTML = "" ; 
      document.getElementById("msg11a").innerHTML = "" ; 
      document.getElementById("msg11b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}
*/





function verifLoyerK(champ)
{
   var regex = /^\d+\.?\d{1,2}$/;
    var loyer = Number(champ.value);

  if(!regex.test(champ.value))
   {
        return false;
   } 
    else if(loyer < 2000 )
   {
        return false;
   }   
   
    else if( loyer > 10000)
   {
        return false;
   }
   else
   {
      document.getElementById("msg11").innerHTML = "" ; 
      document.getElementById("msg11a").innerHTML = "" ; 
      document.getElementById("msg11b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}
 



function verifPrix(champ)
{
   var regex = /^[0-9]+$/;
       var prix = Number(champ.value);

  if(!regex.test(champ.value))
   {
        document.getElementById("msg12a").innerHTML = msg12a ; 
        surligne(champ, true);
        return false;
   } 
    else if(prix < 100 )
   {
        document.getElementById("msg12").innerHTML = msg12 ; 
        surligne(champ, true);
        return false;
   }   
   
    else if( prix > 5000)
   {
        document.getElementById("msg12b").innerHTML = msg12b ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg12").innerHTML = "" ; 
      document.getElementById("msg12a").innerHTML = "" ; 
      document.getElementById("msg12b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 


function verifPrixK(champ)
{
   var regex = /^[0-9]+$/;
       var prix = Number(champ.value);

  if(!regex.test(champ.value))
   {
        return false;
   } 
    else if(prix < 100 )
   {
        return false;
   }   
   
    else if( prix > 5000)
   {
        return false;
   }
   else
   {
      document.getElementById("msg12").innerHTML = "" ; 
      document.getElementById("msg12a").innerHTML = "" ; 
      document.getElementById("msg12b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}

/* /^[a-zA-Zéçàè]+[ \-']?[[a-zA-Zéçàè]+[ \-']?]*[a-zA-Zéçàè]+[ ]?$/; */
function verifEta(champ)
{
   var regex = /^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/ ; 

   if (champ.value.length < 3){
        document.getElementById("msg5a").innerHTML = msg5a ; 
        surligne(champ, true);
        return false;
       }

   else if (!regex.test(champ.value)) {

        document.getElementById("msg5").innerHTML = msg5 ; 
        surligne(champ, true);
        return false;
   }
    else if (champ.value.length > 50) {
        document.getElementById("msg5b").innerHTML = msg5b ; 
        surligne(champ, true);
        return false;
       } 
    else {
        

      document.getElementById("msg5").innerHTML = "" ; 
      document.getElementById("msg5a").innerHTML = "" ; 
      document.getElementById("msg5b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}   

function verifEtaK(champ)
{
   var regex = /^(([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+)?)+([A-Za-zéçàè]+[ \-']?)*([A-Za-zéçàè]+[])?$/ ; 

   if (champ.value.length < 3){
        return false;
       }

   else if (!regex.test(champ.value)) {
        return false;
   }
    else if (champ.value.length > 100) {
        return false;
       } 
    else {
        

      document.getElementById("msg5").innerHTML = "" ; 
      document.getElementById("msg5a").innerHTML = "" ; 
      document.getElementById("msg5b").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}  

function verifEtaa(champ)
{
var regex = /^[a-zA-Zéçàè]+[ \-']?[[a-zA-Zéçàè]+[ \-']?]*[a-zA-Zéçàè]+[ ]?$/;
   if (champ.value.length < 3){
        document.getElementById("msg5ax").innerHTML = msg5ax ; 
        surligne(champ, true);
        return false;
       }

   else if (!regex.test(champ.value)) {
        document.getElementById("msg5x").innerHTML = msg5x ; 
        surligne(champ, true);
        return false;
   }
    else if (champ.value.length > 25) {
        document.getElementById("msg5bx").innerHTML = msg5bx ; 
        surligne(champ, true);
        return false;
       } 
    else {
      document.getElementById("msg5x").innerHTML = "" ; 
      document.getElementById("msg5ax").innerHTML = "" ; 
      document.getElementById("msg5bx").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 

function verifEtaaa(champ)
{
var regex = /^[a-zA-Zéçàè]+[ \-']?[[a-zA-Zéçàè]+[ \-']?]*[a-zA-Zéçàè]+[ ]?$/;
   if (champ.value.length < 3){
        document.getElementById("msg5az").innerHTML = msg5az ; 
        surligne(champ, true);
        return false;
       }

   else if (!regex.test(champ.value)) {
        document.getElementById("msg5z").innerHTML = msg5z ; 
        surligne(champ, true);
        return false;
   }
    else if (champ.value.length > 25) {
        document.getElementById("msg5bz").innerHTML = msg5bz ; 
        surligne(champ, true);
        return false;
       } 
    else {
      document.getElementById("msg5z").innerHTML = "" ; 
      document.getElementById("msg5az").innerHTML = "" ; 
      document.getElementById("msg5bz").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}     


    
    
function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
        document.getElementById("msg9").innerHTML = msg9 ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg9").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}

function verifMailK(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
        return false;
   }
   else
   {
      document.getElementById("msg9").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}

  
function verifTel(champ)
{
   var regex = /^0[567][0-9]{8}$/;
   if(!regex.test(champ.value))
   {
        document.getElementById("msg8").innerHTML = msg8 ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg8").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}

function verifTelK(champ)
{
   var regex = /^0[567][0-9]{8}$/;
   if(!regex.test(champ.value))
   {
        return false;
   }
   else
   {
      document.getElementById("msg8").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}


    
function verifLink(champ)
{
   var regex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
   if(!regex.test(champ.value))
   {
        document.getElementById("msg10").innerHTML = msg10 ; 
        surligne(champ, true);
        return false;
   }
   else
   {
      document.getElementById("msg10").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
}   

function verifLinkK(champ)
{
   var regex = /^(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[a-z0-9]+([\-\.]{1}[a-z0-9]+)*\.[a-z]{2,5}(:[0-9]{1,5})?(\/.*)?$/;
   if(!regex.test(champ.value))
   {
        return false;
   }
   else
   {
      document.getElementById("msg10").innerHTML = "" ; 
      surligne(champ, false);
      return true;
   }
} 

/*&& telOk || mailOk || siteOk */
/*function verifForm(f) {

        var titreOk = verifTitre(f.titre) ;
        var descOk = verifDesc(f.description) ;
        var telOk = verifTel(f.tel) ;
        var mailOk = verifMail(f.email) ; 
        var siteOk = verifLink (f.site) ;
        var adrOk = verifAdr(f.adresseFor);
        var etaOk = verifEta(f.etablissementFor);

   if(orgaOk && adrOk &&  etaOk && titreOk && descOk )  
      return true;
   else{ 
   
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
 
    }*/
    
function verifForm(f) {

        var titreOk = verifTitre(f.titreF) ;
        var descOk = verifDesc(f.descriptionF) ;
        var dateOk = madate(f.dateForF) ; 
        var etaOk = verifEta(f.etablissementForF) ;
        var adrOk = verifAdr(f.adresseForF) ; 
        var telOk = verifTel(f.telF) ; 
        var mailOk = verifMail(f.mailF) ; 
        var siteOk = verifLink(f.siteF) ; 
       

   if(titreOk && descOk && dateOk && etaOk && adrOk && (telOk || mailOk || siteOk )) {
       alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes");
       return true;
   }
      
   else{ 
   
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
 
    }
    
function verifFormDec(f) {

        var titreOk = verifTitre(f.titreF) ;
        var descOk = verifDesc(f.descriptionF) ;
        var dateOk = madate(f.dateForF) ; 
        var adrOk = verifAdr(f.adresseForF) ; 
        var adraOk = verifAdrr(f.adrA) ;
        var prixOk = verifPrix(f.prixE) ; 
        var telOk = verifTel(f.telF) ; 
        var mailOk = verifMail(f.mailF) ; 
        var siteOk = verifLink(f.siteF) ; 
       

   if(titreOk && descOk && dateOk && adrOk && adraOk && prixOk && (telOk || mailOk || siteOk)) 
      {
       alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes");
       return true;
   }
   else{ 
   
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
 
    }
    
function verifFormRec(f) {
    
        var titreOk = verifTitre(f.titreF) ;
        var descOk = verifDesc(f.descriptionF) ;
        var adrOk = verifAdr(f.adresseForF) ; 
        var salOk = verifSalaire(f.sal) ; 
        var domOk = verifDom(f.dom) ;  
        var telOk = verifTel(f.telF) ; 
        var mailOk = verifMail(f.mailF) ; 
        var siteOk = verifLink(f.siteF) ; 
        var etaOk = verifEta(f.etablissementForF) ;


  if(titreOk && descOk && domOk && adrOk && salOk && etaOk && (telOk || mailOk || siteOk)) 
    {
       alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes");
       return true;
   }
   else{ 
   
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }

}
    
function verifFormEve(f) {
        var titreOk = verifTitre(f.titreF) ;
        var descOk = verifDesc(f.descriptionF) ;
        var adrOk = verifAdr(f.adresseForF) ;
        var etaOk = verifEta(f.etablissementForF) ;
        var telOk = verifTel(f.telF) ; 
        var mailOk = verifMail(f.mailF) ; 
        var siteOk = verifLink(f.siteF) ;
         var orgOk = verifOrg(f.org);
        


  if(titreOk && descOk && orgOk && adrOk && etaOk && (telOk || mailOk || siteOk)) 
    {
       alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes");
       return true;
   }
   else{ 
   
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }

}
  
function verifFormLog(f) {
        var titreOk = verifTitre(f.titreF) ;
        var descOk = verifDesc(f.descriptionF) ;
        var adrOk = verifAdr(f.adresseForF) ;
        var surfOk = verifSurf(f.surf);
        var loyOk = verifLoyer(f.loyer);
        var telOk = verifTel(f.telF) ; 
        var mailOk = verifMail(f.mailF) ; 
        var siteOk = verifLink(f.siteF) ;
        
        


  if(titreOk && descOk && surfOk && adrOk && loyOk && (telOk || mailOk || siteOk)){
       alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes");
       return true;
   }
  
   else{ 
   
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }

}
/*   (titreOk && descOk &&  etaOk && adrOk && dateOk && (telOk || mailOk || siteOk )) ||; 
        
        */ 

function verifForm2(f){

        var telOk = verifTel(f.tel) ; 
        var mailOk = verifMail(f.mail) ; 
        var siteOk = verifLink(f.site) ;
           
       

   if (telOk || mailOk || siteOk )  {
       alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes");
       return true;
   } 
 
   else{ 
   
     alert("Veuillez remplir correctement tous les champs");
      return false;
   }
 
    }

   
/*var titreok2 = verifTitre(f.titre2) ;
    var descok2 = verifDesc(f.description2) ;
         
        if (titreok2 && descok2) {
       alert("Votre annonce a bien été envoyée, elle sera confirmée par nos équipes");
       return false;
   } else{ 
   
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }




     }
     } */ 
     
/* var titreOk = verifTitre(f.titre1) ;
        var descOk = verifDesc(f.description1) ;
       var etaOk = verifEta(f.etablissement1) ;
        var adrOk = verifAdr(f.adresse1) ;
        var dateOk = madate(f.date1) ;*/

function surligne(champ, erreur){
   if(erreur)
      champ.style.borderColor = "#EE4957";
   else
      champ.style.borderColor = "#75B44B" ;
}    
 

