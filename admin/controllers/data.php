<?php

require_once(dirname(__DIR__)."/models/data.class.php");

function data()
{
    set("title", "Données");
    set("data", Data::getAll());
    
    return html("list.html.php", "layout.html.php");
}

function data_extract()
{
    header("Content-Type: text/csv");
    header("Content-Disposition: filename=\"data.csv\"");
    
    return Data::extract();
}

function alter_data()
{
    $data = new Data($_POST["email"]);
    
    $data->setIdentifiant($_POST["identifiant"]);
    $data->setNomFils($_POST["nom_fils"]);
    $data->setPrenomFils($_POST["prenom_fils"]);
    $data->setDdnFils($_POST["ddn_fils"]);
    $data->setTelMobile($_POST["tel_mobile"]);
    $data->setDate($_POST["date"]);
    $data->setIp($_POST["ip"]);
    $data->write();
}
