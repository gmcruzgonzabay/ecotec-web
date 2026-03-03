
$(document).on("click", ".btn-eliminar", function() {

    let id = $(this).data("id");
    let boton = $(this);

    if(confirm("¿Seguro que desea eliminar este registro?")) {

        $.ajax({
            url: "index.php",
            type: "GET",
            data: {
                accion: "eliminar",
                id: id
            },
            success: function(response) {
                boton.closest(".mb-3").remove();
            }
        });

    }
});

$(document).on("keyup", "#buscar", function() {

    let termino = $(this).val();

    $.ajax({
        url: "index.php",
        type: "GET",
        data: {
            accion: "buscar",
            termino: termino
        },
        success: function(response) {
            $("#contenedorUsuarios").html(response);
        }
    });

});
