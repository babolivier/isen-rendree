<?php

if(isset($error))
{
    if($error)
        echo "<h1>T'es mauvais Jack</h1>";
    else
    {
?>

<h1>T'es connecté gros</h1>

<?php }} else { ?>

<form method="POST">
    <input type="text" placeholder="identifier" name="login"/>
    <input type="password" placeholder="password" name="password"/>
    <input type="submit" value="login"/>
</form>

<?php } ?>