<?php

include_once(dirname(__DIR__)."../models/data.class.php");

function data()
{
    set("title", "Titre");
    
    return html("data.html.php", "layout.html.php");
}

function data_extract()
{
    header("Content-Type: text/csv");
    
    echo Data::extract();
}

function alter_data()
{
    // TODO
}
