<?php

require_once(dirname(__DIR__)."/controllers/data.php");
require_once(dirname(__DIR__)."/models/data.class.php");
require_once(dirname(__DIR__)."/../DbIds.php");

function redirect_data()
{
    header("Location: data");
}
