<?php

require_once(dirname(__DIR__)."/models/data.class.php");

function data()
{
    set("title", "Titre");
    set("data", Data::getAll());
    
    return html("data.html.php", "layout.html.php");
}

function data_extract()
{
    header("Content-Type: text/csv");
    header("Content-Disposition: filename=\"data.csv\"");
    
    return Data::extract();
}

function alter_data()
{
    // TODO
}
