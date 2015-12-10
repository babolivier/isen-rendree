<table class="table">
    <thead>
    <?php foreach ($data[0] as $key => $value) {
        ?>
        <th><?php echo $key; ?></th>
        <?php
    }
    ?>
    <th>Opérations</th>
    </thead>
    <tbody>
    <?php foreach ($data as $student) {
        ?>
        <tr>
            <?php
            foreach ($student as $field => $value) {
                if (is_array($value)) {
                    ?>
                    <td id="<?php echo $value["id"]; ?>"><?php echo $value["libelle"]; ?></td>
                    <?php
                } else {
                    ?>
                    <td><?php echo $value; ?></td>
                    <?php
                }
            }
            ?>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>