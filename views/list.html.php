<div style="text-align:right">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addForm" aria-expanded="false" aria-controls="addForm">
        Ajouter
    </button>
</div>

<form class="collapse" id="addForm">
    <div class="well">
        <div class="form-group">
            <label for="promo">Promotion :</label>
            <select id="promo">
                <?php foreach($promos as $promo)
                {
                    ?>
                    <option value="<?php echo $promo["id_promo"]; ?>"><?php echo $promo["libelle"]; ?></option>
                    <?php
                }
                ?>
                <option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label for="rang">Rang :</label>
            <input type="number" class="form-control" id="rang" />
        </div>
        <div class="form-group">
            <label for="libelle">Libellé : </label>
            <input type="text" class="form-control" id="libelle" placeholder="Libellé" />
        </div>
        <div class="form-group">
            <label for="file">Fichier :</label>
            <input type="file" id="file" />
        </div>
        <div class="form-group">
            <input type="submit" class="form-control" value="Ajouter le document" id="formsubmit" />
        </div>
    </div>
</form>

<table class="table tablesorter table-striped" id="mainTable">
    <thead>
    <?php foreach ($data[0] as $key => $value) {
        ?>
        <th class="th-inner sortable both"><?php echo $key; ?></th>
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