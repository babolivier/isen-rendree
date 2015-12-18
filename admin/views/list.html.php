<h2>Traitement des <?php echo strtolower($title); ?></h2>

<div id="alert"></div>
<?php if($title == "Documents" || $title == "Promotions")
{
    echo '<div style="text-align:right">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#addForm" aria-expanded="false" aria-controls="addForm">
        Ajouter
    </button>
</div>';
}
else if($title == "Données")
{
    echo '<div style="text-align:right">
    <a href="data/extract" class="btn btn-primary">
        Tout télécharger (format CSV)
    </a>
</div>';
}
?>


<form class="collapse" id="addForm">
    <?php
        switch($title)
        {
            case "Documents":
                echo '<div class="well">
        <div class="form-group">
            <label for="promo">Promotion :</label>
            <select id="promo">';
                foreach($promos as $promo)
                {
                    echo '<option value="'.$promo["Identifiant"].'">'.$promo["Libellé"].'</option>';
                }
                echo '<option value=""></option>
            </select>
        </div>
        <div class="form-group">
            <label class="control-label" for="rang">Rang :</label>
            <input type="number" class="form-control" id="rang" />
        </div>
        <div class="form-group">
            <label class="control-label" for="libelle">Libellé : </label>
            <input type="text" class="form-control" id="libelle" placeholder="Libellé" />
        </div>
        <div class="form-group">
            <label class="control-label" for="file">Fichier :</label>
            <input type="file" id="file" />
        </div>
        <div class="form-group">
            <input type="submit" class="form-control" value="Ajouter le document" id="formsubmit" />
        </div>
    </div>';
                break;
            case "Promotions":
                echo '<div class="well">
        <div class="form-group">
            <label class="control-label" for="id">Identifiant :</label>
            <input type="text" class="form-control" id="id" placeholder="Identifiant" />
        </div>
        <div class="form-group">
            <label class="control-label" for="libelle">Libellé : </label>
            <input type="text" class="form-control" id="libelle" placeholder="Libellé" />
        </div>
        <div class="form-group">
            <input type="submit" class="form-control" value="Ajouter la promotion" id="formsubmit" />
        </div>
    </div>';
                break;
        }
    ?>
</form>

<table class="table tablesorter table-striped" id="mainTable">
    <thead>
    <?php foreach ($data[0] as $key => $value) {
        if ($key != "id") {
            ?>
            <th class="th-inner sortable both" style="cursor:pointer"><?php echo $key; ?></th>
            <?php
        }
    }
    if ($title != "Données") {
        ?>
        <th>Opérations</th>
        <?php
    }
    ?>
    </thead>
    <tbody>
    <?php foreach ($data as $element) {
        ?>
        <tr id="<?php echo $element["id"]; ?>">
            <?php
            foreach ($element as $field => $value) {
                if ($field != "id") {
                    if (is_array($value)) {
                        ?>
                        <td class="<?php echo $value["id"]; ?>"><?php echo $value["libelle"]; ?></td>
                        <?php
                    } else {
                        ?>
                        <td><?php echo $value; ?></td>
                        <?php
                    }
                }
            }
            if ($title != "Données") {
                ?>
                <td><i class="fa fa-pencil" style="cursor:pointer"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o"
                                                                                            style="cursor:pointer"></i>
                </td>
                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>