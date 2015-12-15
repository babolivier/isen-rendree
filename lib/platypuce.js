var dataSelect = $("option")[0].value;

$(document).on('change', 'select', function(e) {
    dataSelect = this.options[e.target.selectedIndex].value;
});

$('#addForm').submit(function(e) {

    e.preventDefault();
    var data = new FormData();
    data.append("document", $("#file")[0].files[0]);
    data.append("promo", dataSelect);
    data.append("rang", $("#rang").val());
    data.append("libelle", $("#libelle").val());

    $.ajax({
        method: "POST",
        url: "document",
        data: data,
        processData: false,
        contentType: false,
        complete: function (result) {
            console.log(result);
        }
    });
});