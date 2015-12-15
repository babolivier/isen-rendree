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

function alter_promo()
{
    $promo = new Promo($_POST["id"]);
    
    $promo->setLibelle($_POST["libelle"]);
    $promo->write();
}

function delete_promo()
{
    (new Promo($_POST["promo"]))->erase();
}
