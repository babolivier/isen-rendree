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
    File::addDocument($_FILES["document"], [
        "rang" => $_POST["rang"],
        "promo" => $_POST["promo"],
        "libelle" => $_POST["libelle"]
    ]);
}

function alter_document()
{
    $document = new Document($_POST["id"]);
    
    $document->setRang($_POST["rang"]);
    $document->setPromo($_POST["promo"]);
    $document->setLibelle($_POST["libelle"]);
    $document->setFichier($_POST["fichier"]);
}

function delete_document()
{
    (new File($_POST["id"]))->erase();
}
