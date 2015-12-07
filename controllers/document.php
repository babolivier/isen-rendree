<?php

require_once(dirname(__DIR__) . "/models/document.class.php");

function document()
{
    set("title", "Titre");
    set("data", Document::getAll());
    
    return html("list.html.php", "layout.html.php");
}

function add_document()
{
    $options = [];
    
    foreach(["rang", "promo", "libelle"] as $field)
        $options[$field] = $_POST[$field];
    
    File::addDocument($_FILES["document"], $options);
}

function alter_document()
{
    // TODO
}

function delete_document()
{
    (new File($_POST["id"]))->erase();
}
