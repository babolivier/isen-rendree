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
    
    $promo->setLibelle($_POST["libelle"]);
    $promo->write();
}

function delete_promo($promoid)
{
    (new Promo($promoid))->erase();
}
