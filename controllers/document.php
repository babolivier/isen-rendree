<?php

require_once(dirname(__DIR__) . "/models/document.class.php");
require_once(dirname(__DIR__) . "/models/promo.class.php");

function document()
{
    set("title", "Documents");
    set("data", Document::getAll());
    set("promos", Promo::getAll());

    return html("list.html.php", "layout.html.php");
}

function add_document()
{
    $filePath = Document::addDocument($_FILES["document"], [
        "rang" => $_POST["rang"],
        "promo" => $_POST["promo"],
        "libelle" => $_POST["libelle"]
    ]);

    json_encode(array(
        "path" => $filePath
    ));
}

function delete_document($fileid)
{
    (new Document($fileid))->erase();
}
