<?php

require_once(dirname(__DIR__)."/models/promo.class.php");

function promo()
{
    set("title", "Titre");
    set("data", Promo::getAll());
    
    return html("list.html.php", "layout.html.php");
}

function add_promo()
{
    // TODO
}

function alter_promo()
{
    // TODO
}

function delete_promo()
{
    // TODO
}
