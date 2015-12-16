<?php

require_once(dirname(__DIR__)."/controllers/data.php");
require_once(dirname(__DIR__)."/models/data.class.php");
require_once(dirname(__DIR__)."/../DbIds.php");

function getAdminIdentifiers()
{
    return ["toto", "tata"];
}

function login()
{
    set("title", "Login");
    
    return html("login.html.php", "layout.html.php");
}

function check_login()
{
    $identifiers = getAdminIdentifiers();
    
    if($_POST["login"] != $identifiers[0] || $_POST["password"] != $identifiers[1])
        return login();
    
    set("title", "Home");
    
    return html("home.html.php", "layout.html.php");
}
