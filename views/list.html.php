<ul>
    <?php
        foreach($data as $item)
        {
            echo "<li><ul>";
            
            foreach($item as $field => $value)
                echo "<li>".$field." : ".$value."</li>";
            
            echo "</li></ul>";
        }
    ?>
</ul>