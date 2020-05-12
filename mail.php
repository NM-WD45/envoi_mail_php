if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
$passage_ligne = "\r\n";
}
else
{
$passage_ligne = "\n";
}
$mail = $data['membre_email']; //adresse de destination.
if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail))
{
$passage_ligne = "\r\n";
}
else
{
$passage_ligne = "\n";
}
//=====Déclaration des messages au format texte et au format HTML.
$message_txt = 'Bonjour ' . $data['membre_pseudo'] . ', /n/n '. $_SESSION['pseudo'] . 
' vient de vous envoyer un message privé sur MySpaceFamily.fr.
' . $titre .' <br/> ' . $message .'
./n/n 
A très vite!';
    
$message_html = '<html><head></head><body><b>Bonjour ' . $data['membre_pseudo'] . ', <br/>'. $_SESSION['pseudo'] . ' 
vient de vous envoyer un message privé sur <a href:"http://www.myspacefamily.fr"> MySpaceFamily.fr </a>. <br/>
<strong>' . $titre .' <br/> ' . $message .'
<br/><br/>A très vite !.</body></html>';
<?php   
//=====Création de la boundary
$boundary = "-----=".md5(rand());
//=====Définition du sujet.
$sujet = $_SESSION['pseudo'] . ' vous a envoyé un message';
//=====Création du header de l'e-mail.
$header = "From: \"MySpaceFamily\"<no-reply@myspacefamily.fr>".$passage_ligne;
$header.= "Reply-to: \"WeaponsB\" <no-reply@myspacefamily.fr>".$passage_ligne;
$header.= "MIME-Version: 1.0".$passage_ligne;
$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
//=====Création du message.
$message = $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format texte.
$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_txt.$passage_ligne;
$message.= $passage_ligne."--".$boundary.$passage_ligne;
//=====Ajout du message au format HTML
$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
$message.= $passage_ligne.$message_html.$passage_ligne;
//==========
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
$message.= $passage_ligne."--".$boundary."--".$passage_ligne;

//=====Envoi de l'e-mail.
mail($mail,$sujet,$message,$header);
//==========
