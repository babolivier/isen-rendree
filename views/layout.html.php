<!DOCTYPE html>

<html>
    <head>
        <meta charset = "utf-8">
        <title>
            <?php echo $title; ?>
        </title>
        
        <link href="lib/css/bootstrap.min.css" rel="stylesheet">

        <link href="lib/fonts/css/font-awesome.min.css" rel="stylesheet">
        <link href="lib/css/animate.min.css" rel="stylesheet">

        <link href="lib/css/custom.css" rel="stylesheet">
        <link href="lib/css/icheck/flat/green.css" rel="stylesheet">


        <script src="lib/js/jquery.min.js"></script>

        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background:#F7F7F7;">
        <ul>
            <?php echo $content; ?>
        </ul>
    </body>
</html>