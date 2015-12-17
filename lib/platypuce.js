function checkPromoId(promoid)
{
    return promoid.match(/A[1-5]/) != null;
}

function editRow() {
    var row = $(this).parent().parent();
    var rang = $(row.children()[0]);
    var promo = $(row.children()[1]);
    var rangValeur = rang.html();
    var promoValeur = $(promo[0]).attr("class");
    var promos = $("#promo").children();
    var str = '<select class="tempPromos">';
    var selected = "";

    rang.html('<input type="number" value="'+rangValeur+'" size="2" style="width:35px" />');
    $(promo[0]).removeClass(promoValeur);
    for(var i = 0; i < promos.length; i++)
    {
        if (promos[i].value === promoValeur)
        {
            selected = "selected";
        }
        else
        {
            selected = "";
        }
        str += '<option value="'+promos[i].value+'" '+selected+'>'+promos[i].text+'</option>';
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
        for(var i = 0; i < promos.length; i++)
        {
            if (promos[i].value === promoValeur)
            {
                promoName = promos[i].text;
            }
        }
        promo.html(promoName);
        $(this).addClass("fa-pencil");
        $(this).removeClass("fa-check");
        // Insert AJAX request here
        $(this).off("click");
        $(this).on("click", editRow);
    });
}

$('.fa-pencil').on("click", editRow);

$('#addForm').submit(function(e) {
    e.preventDefault();
    var data = new FormData();

    switch ($("title").html())
    {
        case "Documents":
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

                }
            });
            break;
        case "Promotions":
            if(checkPromoId($("#id").val()))
            {
                data.append("id", $("#id").val());
                data.append("libelle", $("#libelle").val());

                $.ajax({
                    method: "POST",
                    url: "promo",
                    data: data,
                    processData: false,
                    contentType: false,
                    complete: function (result) {
                        console.log(result);
                    }
                });
            }
            else
            {
                var block = $(".form-group:first-child");
                block.addClass("has-error");
                block.html(block.html()+'<span id="helpBlock2" class="help-block">Votre identifiant doit contenir "A" suivi de l\'année correspondant à la promotion.</span>')
            }
            break;
    }
});