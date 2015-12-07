<?php

require_once(dirname(__DIR__)."/models/file.class.php");

function files()
{
    set("title", "Titre");
    set("data", File::getAll());
    
    return html("list.html.php", "layout.html.php");
}

function add_file()
{
    $options = [];
    
    foreach(["rang", "promo", "libelle"] as $field)
        $options[$field] = $_POST[$field];
    
    File::addDocument($_FILES["document"], $options);
}

function alter_file()
{
    // TODO
}

function delete_file()
{
    (new File($_POST["id"]))->erase();
}
