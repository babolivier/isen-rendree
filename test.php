<?php
try {
    include("models/data.class.php");
    $csv = Data::extract();
    echo $csv;
} catch(Exception $e) {
    echo $e;
}
