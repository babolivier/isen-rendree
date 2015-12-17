<?php

require_once("lib/limonade.php");

dispatch_get("/",                       "login");
dispatch_get("/data",                   "data");
dispatch_get("/data/extract",           "data_extract");
dispatch_get("/document",               "document");
dispatch_get("/promo",                  "promo");

dispatch_post("/",                      "check_login");
dispatch_post("/document",              "add_document");
dispatch_post("/promo",                 "add_promo");

dispatch_put("/data/:dataid",           "alter_data");
dispatch_put("/document/:documentid",   "alter_document");
dispatch_put("/promo/:promoid",         "alter_promo");

dispatch_delete("/document/:fileid",    "delete_document");
dispatch_delete("/promo/:promoid",      "delete_promo");

try {
    run();
}
catch (Exception $e) {
    error_log($e);
}