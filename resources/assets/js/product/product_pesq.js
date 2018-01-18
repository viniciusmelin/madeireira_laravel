
$(document).ready(function(){
    var tableProduct = $('#tableProduct').DataTable({
        "bFilter": false,
        "lengthChange": false,
        "pageLength": 5,
        "dom": 'B<"down"i>rt<"bottom"<"#refresh">flp><"clear">',
        'select': true,
        'selectionMode': "single",
        "columnsDefs": [
            {
                'width': '10px',
                'targets': [0]
            }
        ],
    });

// 
    $("#tableProduct").delegate('tr', "click", function () {
        $('#tableProduct').find('tr').removeClass('active');

        $(this).toggleClass('active');
        dataProduct = tableProduct.row(this).data();
    });

    $('#selectProduct').on('click', function () {

        $('#nameproduct').attr('data-id', dataProduct[0]);
        $('#nameproduct').attr('data-name', dataProduct[1]);
        $('#nameproduct').attr('data-price', dataProduct[2]);
        $('#nameproduct').val(dataProduct[1]);
        $('#priceproduct').val(dataProduct[2]);
    });


    $('#nameproduct').on('keypress',function(e){
        var keycode = event.keyCode || event.which;
        if(keycode ==13)
        {
           $('#modalProduct').modal('show');
           $('#searchProduct').val($('#nameproduct').val());
           $('#btnpesquisarProduct').trigger('click');
        }
    });

    $('#btnpesquisarProduct').click(function () {
        var pesquisar = $('#searchProduct').val();
        $.ajax({
            type: "GET",
            url: '/admin/produto/produtojson',
            data: { search: pesquisar },
            dataType: "JSON",
            success: function (data) {
                tableProduct.clear();
                tableProduct.rows.add(data);
                tableProduct.draw();
            }

        })
    });
});