<?php

function login()
{
    set("title", "Titre");
    
    return html("login.html.php", "layout.html.php");
}

function check_login()
{
    // TODO
}
