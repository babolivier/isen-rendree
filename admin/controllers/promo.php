<?php

require_once(dirname(__DIR__)."/models/promo.class.php");

function promo()
{
    set("title", "Promotions");
    set("data", Promo::getAll());
    
    return html("list.html.php", "layout.html.php");
}

function add_promo()
{
    Promo::addPromo([
        "id" => $_POST["id"],
        "libelle" => $_POST["libelle"]
    ]);
}

function alter_promo($promoid)
{
    $promo = new Promo($promoid);

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
    
    $promo->setLibelle($putParams["libelle"]);
    $promo->write();
}

function delete_promo($promoid)
{
    (new Promo($promoid))->erase();
}
