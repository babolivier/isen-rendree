<?php
  session_name("Rentree");
  @session_start();

  require_once('../config.php');

  if (!empty($_POST)) {
  
    $nomFils = addslashes (chop($_POST['nomFils']));
    $prenomFils = addslashes (chop($_POST['prenomFils']));
    $ddn = addslashes (chop($_POST['ddn']));
    $telMobile = addslashes (chop($_POST['telMobile']));
    $courriel = addslashes (chop($_POST['courriel']));
    $ip="";
    if (getenv("HTTP_CLIENT_IP"))
      $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
      $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
      $ip = getenv("REMOTE_ADDR");
    else
      $ip = "UNKNOWN";
    
    $checkMail = mailCheck($courriel);
    if ($checkMail!="OK") {
        $message = array('status' => 400, 'message' => $checkMail);    
    }
    else {
      if ($_SESSION['existe']=="TRUE") {
        $query = "UPDATE data 
          SET  nom_fils ='".$nomFils."', prenom_fils='".$prenomFils."', ddn_fils='".$ddn."',
          tel_mobile='".$telMobile."', courriel='".$courriel."', date=NOW(), ip='".$ip."' WHERE identifiant='".$_SESSION['courriel']."'";
      }
      else {
        $query = "INSERT INTO data 
          (identifiant, nom_fils, prenom_fils, ddn_fils, tel_mobile, courriel, date, ip ) 
          VALUES ('".$_SESSION['courriel']."', '".$nomFils."', '".$prenomFils."', '".$ddn."', '".$telMobile."','".$courriel."', NOW(), '".$ip."' )";
        $_SESSION['existe'] = "TRUE";  
      }
      $DbLink = mysql_connect($DbHost, $DbUser, $DbPassword) or die('erreur de connexion au serveur');
      mysql_select_db($DbName) or die('erreur de connexion a la base de donnees');
      mysql_query("SET NAMES 'utf8'");
      $result = mysql_query($query);
      if (!$result) {
        $message = array('status' => 400, 'message' => "Requête invalide : ".$query);
      }
      else {
        $message = array('status' => 200, 'message' => "OK");
      }
      mysql_close();    
    }
    echo json_encode($message);
  }


?>