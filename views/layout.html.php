<!DOCTYPE html>

<html>
    <head>
        <meta charset = "utf-8">
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" href="lib/bootstrap.min.css" />
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="lib/jquery-2.1.4.min.js"></script>
        <script src="lib/jquery.tablesorter.min.js"></script>
        <script src="lib/bootstrap.min.js"></script>
    </head>
    <body>


        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">Administration rentrée ISEN Brest</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="data">Données</a></li>
                        <li><a href="document">Documents</a></li>
                        <li><a href="promo">Promotions</a></li>
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