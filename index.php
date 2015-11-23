<?php

require_once("lib/limonade.php");

dispatch_get("/",                  "login");
dispatch_get("/data",              "data");
dispatch_get("/data/extract",      "data_extract");
dispatch_get("/files",             "files");
dispatch_get("/promo",             "promo");

dispatch_post("/",                 "check_login");
dispatch_post("/files",            "add_file");
dispatch_post("/promo",            "add_promo");

dispatch_put("/data/:dataid",      "alter_data");
dispatch_put("/files/:fileid",     "alter_file");
dispatch_put("/promo/:promoid",    "alter_promo");

dispatch_delete("/files/:fileid",  "delete_file");
dispatch_delete("/promo/:promoid", "delete_promo");

run();
