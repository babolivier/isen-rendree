var dataSelect = "";

function checkPromoId(promoid)
{
    return promoid.match(/A[1-5]/) != null;
}

if($("title").text() === "Documents") {
    dataSelect = $("option")[0].value;
}

$(document).on('change', 'select', function(e) {
    if($("title").text() === "Documents") {
        dataSelect = this.options[e.target.selectedIndex].value;
    }
});

$('.fa-pencil').on("click", function() {
    var row = $(this).parent().parent();
    var rang = $(row.children()[0]);
    var rangValeur = rang.html();
    rang.html('<input type="number" value="'+rangValeur+'" size="2" style="width:35px" />');
    $(this).addClass("fa-check");
    $(this).removeClass("fa-pencil");
    $(this).off("click");
    $(this).on("click", function () {
        rangValeur = $(rang.children()[0]).value;
        rang.html(rangValeur);
    });
});

$('#addForm').submit(function(e) {
    e.preventDefault();
    var data = new FormData();

    switch ($("title").html())
    {
        case "Documents":
            data.append("document", $("#file")[0].files[0]);
            data.append("promo", dataSelect);
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