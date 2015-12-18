function checkPromoId(promoid)
{
    return promoid.match(/A[1-5]/) != null;
}

function editRow() {
    var row = $(this).parent().parent();
    switch ($("title").html()) {
        case "Documents":
            var rang = $(row.children()[0]);
            var promo = $(row.children()[1]);
            var rangValeur = rang.html();
            var promoValeur = $(promo[0]).attr("class");
            var promos = $("#promo").children();
            var str = '<select class="tempPromos">';
            var selected = "";

            rang.html('<input type="number" value="' + rangValeur + '" size="2" style="width:35px" />');
            $(promo[0]).removeClass(promoValeur);
            for (var i = 0; i < promos.length; i++) {
                if (promos[i].value === promoValeur) {
                    selected = "selected";
                }
                else {
                    selected = "";
                }
                str += '<option value="' + promos[i].value + '" ' + selected + '>' + promos[i].text + '</option>';
            }
            str += "</select>";
            promo.html(str);
            $(this).addClass("fa-check");
            $(this).removeClass("fa-pencil");
            $(this).off("click");
            $(this).on("click", function () {
                rangValeur = $(rang.children()[0]).val();
                rang.html(rangValeur);
                promoValeur = promo.children().val();
                promo.addClass(promoValeur);
                var promoName = "";
                for (var i = 0; i < promos.length; i++) {
                    if (promos[i].value === promoValeur) {
                        promoName = promos[i].text;
                    }
                }
                promo.html(promoName);
                $(this).addClass("fa-pencil");
                $(this).removeClass("fa-check");
                $.ajax({
                    method: "PUT",
                    url: "document/" + row[0].id,
                    data: "rang=" + rangValeur + "&promo=" + promoValeur,
                    processData: false,
                    contentType: false
                });
                $(this).off("click");
                $(this).on("click", editRow);
            });
            break;
        case "Promotions":
            var promoName = $(row.children()[1]);
            var name = $(promoName[0]).text();
            $(promoName).html(
                '<input type="text" value="'+name+'" style="width: 400px" />'
            );
            $(this).addClass("fa-check");
            $(this).removeClass("fa-pencil");
            $(this).off("click");
            $(this).on("click", function () {
                name = $(promoName.children()[0]).val();
                $(promoName).html(name);
                $(this).addClass("fa-pencil");
                $(this).removeClass("fa-check");
                $.ajax({
                    method: "PUT",
                    url: "promo/" + row[0].id,
                    data: "libelle=" + name,
                    processData: false,
                    contentType: false
                });
                $(this).off("click");
                $(this).on("click", editRow);
            });
            break;
    }
}

$('.fa-pencil').on("click", editRow);

$('.fa-trash-o').on("click", function () {
    var row = $(this).parent().parent();
    var url = "";
    switch($("title").html())
    {
        case "Documents":
            url = "document/"+row[0].id;
            break;
        case "Promotions":
            url = "promo/"+row[0].id;
    }
    $.ajax({
        method: "DELETE",
        url: url,
        processData: false,
        contentType: false
    });
    row.remove();
});

$('#addForm').submit(function(e) {
    e.preventDefault();
    var data = new FormData();

    switch ($("title").html())
    {
        case "Documents":
            $("#helpBlock2").remove();
            $(".has-error").removeClass("has-error");
            if (!$("#rang").val().length)
            {
                var block = $("#rang").parent();
                block.addClass("has-error");
                block.html(block.html()+'<span id="helpBlock2" class="help-block">Vous devez spécifier un rang.</span>');
            }
            else if (!$("#libelle").val().length)
            {
                var block = $("#libelle").parent();
                block.addClass("has-error");
                block.html(block.html()+'<span id="helpBlock2" class="help-block">Vous devez spécifier un libellé.</span>');
            }
            else if (!$("#file").val().length)
            {
                var block = $("#file").parent();
                block.addClass("has-error");
                block.html(block.html()+'<span id="helpBlock2" class="help-block">Vous devez sélectionner un fichier.</span>');
            }
            else {

                data.append("document", $("#file")[0].files[0]);
                data.append("promo", $("#promo").val());
                data.append("rang", $("#rang").val());
                data.append("libelle", $("#libelle").val());

                $.ajax({
                    method: "POST",
                    url: "document",
                    data: data,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    complete: function (result) {
                        result = result.responseJSON;
                        var promoName = "";
                        var promoValeur = $("#promo").val();
                        for (var i = 0; i < $("#promo").children().length; i++) {
                            if ($("#promo").children()[i].value === promoValeur) {
                                promoName = $("#promo").children()[i].text;
                            }
                        }
                        $("table").append('<tr id="' + result.id + '">' +
                            '<td>' + $("#rang").val() + '</td>' +
                            '<td>' + promoName + '</td>' +
                            '<td>' + $("#libelle").val() + '</td>' +
                            '<td>' + result.path + '</td>' +
                            '<td><i class="fa fa-pencil" style="cursor:pointer"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o" style="cursor:pointer"></i></td>' +
                            '</tr>');

                        $($("#alert")[0]).html('<div class="alert alert-success alert-dismissible" role="alert" style="text-align:center; display: none">Le document a été ajouté !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                        $($("button.btn")[0]).click();
                        $($(".alert")[0]).fadeIn();

                        // Reset the listeners
                        $('.fa-pencil').on("click", editRow);
                        $('.fa-trash-o').on("click", function () {
                            var row = $(this).parent().parent();
                            var url = "";
                            switch ($("title").html()) {
                                case "Documents":
                                    url = "document/" + row[0].id;
                                    break;
                                case "Promotions":
                                    url = "promo/" + row[0].id;
                            }
                            $.ajax({
                                method: "DELETE",
                                url: url,
                                processData: false,
                                contentType: false
                            });
                            row.remove();
                        });
                    }
                });
            }
            break;
        case "Promotions":
            $("#helpBlock2").remove();
            $(".has-error").removeClass("has-error");
            var id = $("#id").val().toUpperCase();
            if(checkPromoId(id))
            {
                if (!$("#libelle").val().length)
                {
                    var block = $("#libelle").parent();
                    block.addClass("has-error");
                    block.html(block.html()+'<span id="helpBlock2" class="help-block">Vous devez spécifier un libellé.</span>');
                }
                else {
                    data.append("id", id);
                    data.append("libelle", $("#libelle").val());

                    $.ajax({
                        method: "POST",
                        url: "promo",
                        data: data,
                        processData: false,
                        contentType: false
                    });

                    $("table").append('<tr>' +
                        '<td>' + id + '</td>' +
                        '<td>' + $("#libelle").val() + '</td>' +
                        '<td><i class="fa fa-pencil" style="cursor:pointer"></i>&nbsp;&nbsp;&nbsp;<i class="fa fa-trash-o" style="cursor:pointer"></i></td>' +
                        '</tr>');

                    $($("#alert")[0]).html('<div class="alert alert-success alert-dismissible" role="alert" style="text-align:center; display: none">La promotion a été ajoutée !<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    $($("button.btn")[0]).click();
                    $($(".alert")[0]).fadeIn();
                    // Reset the listeners
                    $('.fa-pencil').on("click", editRow);
                    $('.fa-trash-o').on("click", function () {
                        var row = $(this).parent().parent();
                        var url = "";
                        switch ($("title").html()) {
                            case "Documents":
                                url = "document/" + row[0].id;
                                break;
                            case "Promotions":
                                url = "promo/" + row[0].id;
                        }
                        $.ajax({
                            method: "DELETE",
                            url: url,
                            processData: false,
                            contentType: false
                        });
                        row.remove();
                    });
                }
            }
            else
            {
                var block = $("#id").parent();
                block.addClass("has-error");
                block.html(block.html()+'<span id="helpBlock2" class="help-block">Votre identifiant doit contenir "A" suivi de l\'année correspondant à la promotion.</span>')
            }
            break;
    }
});