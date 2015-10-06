<?php

$DbLink = mysql_connect($DbHost, $DbUser, $DbPassword) or die('erreur de connexion au serveur');
mysql_select_db($DbName) or die('erreur de connexion a la base de donnees');
mysql_query("SET NAMES 'utf8'");
$query = "SELECT * FROM data WHERE identifiant LIKE '".$_SESSION['courriel']."'";
$result = mysql_query($query);
$ligne = mysql_fetch_assoc($result);
$identifiant = stripslashes($ligne['identifiant']);
$nomFils = stripslashes($ligne['nom_fils']);
$prenomFils = stripslashes($ligne['prenom_fils']);
$ddn = stripslashes($ligne['ddn_fils']);
$telMobile = stripslashes($ligne['tel_mobile']);
$courriel = stripslashes($ligne['courriel']);
mysql_close();

?>