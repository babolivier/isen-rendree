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

function alter_document($documentid)
{
    $doc = new Document($documentid);

    // We'll need to parse the PUT body to get our arguments
    $params = file_get_contents("php://input", "r");

    $putParams = array();

    while(preg_match("/&/", $params))
    {
        $param = strstr($params, "&", true);
        $params = substr(strstr($params, "&"), 1);
        $putParams[strstr($param, "=", true)] = substr(strstr($param, "="), 1);
    }
    // We need it one more time for the last argument
    $param = $params;
    $putParams[strstr($param, "=", true)] = substr(strstr($param, "="), 1);

    $doc->changePromo($putParams["promo"]);
    $doc->changeRank($putParams["rang"]);
}

function delete_document($fileid)
{
    (new Document($fileid))->erase();
}
