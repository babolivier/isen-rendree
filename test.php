<?php
try {
    include("models/promo.class.php");
    $promo = new Promo("test");
    $promo->erase();
} catch(Exception $e) {
    echo $e;
}
