<?php

require_once(dirname(__DIR__)."/controllers/data.php");
require_once(dirname(__DIR__)."/models/data.class.php");
require_once(dirname(__DIR__)."/../DbIds.php");

function login()
{
    set("title", "Login");
    
    return html("login.html.php", "layout.html.php");
}

function check_login()
{
    $identifiers = getAdminIdentifiers();
    
    if($_POST["login"] != $identifiers[0] || $_POST["password"] != $identifiers[1])
    {
        set("title", "Erreur");
        set("error", true);
    } else
    {
        set("title", "Accueil");
        set("error", false);
    }
    
    return html("login.html.php", "layout.html.php");
}
