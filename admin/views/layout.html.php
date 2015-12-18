<!DOCTYPE html>

<html>
    <head>
        <meta charset = "utf-8">
        <title>Rentrée ISEN Brest - <?php echo $title; ?> - Administration</title>
        <link rel="stylesheet" href="lib/bootstrap.min.css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="lib/jquery-2.1.4.min.js"></script>
        <script src="lib/jquery.tablesorter.min.js"></script>
        <script src="lib/bootstrap.min.js"></script>
        <style>
            .table-striped > tbody > tr:nth-of-type(2n+1) {
                background-color: #A1C5D2;
            }
            .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                border-top: 1px solid rgb(161, 197, 210);
            }
            .table > thead > tr > th {
                border-bottom: 2px solid #809fab;
            }
        </style>
    </head>
    <body style="background:#c5efff">


        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand">Administration rentrée ISEN Brest</span>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li <?php if($title == "Données") { ?>class="active"<?php } ?>><a href="data">Données</a></li>
                        <li <?php if($title == "Documents") { ?>class="active"<?php } ?>><a href="document">Documents</a></li>
                        <li <?php if($title == "Promotions") { ?>class="active"<?php } ?>><a href="promo">Promotions</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <?php echo $content; ?>
        </div>
        <script>
            $(function(){
                $("#mainTable").tablesorter();
            });
        </script>
        <script src="lib/platypuce.js"></script>
    </body>

</html>