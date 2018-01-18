$(document).ready(function(){
    var dataSalesman =[];
    var table = $('#tableSalesman').DataTable({
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

    $("#tableSalesman").delegate('tr', "click", function (evt) {
        $('#tableSalesman').find('tr').removeClass('active');

        $(this).toggleClass('active');
        dataSalesman = table.row(this).data();
    });

    $('#saveSalesman').on('click', function () {
        if(dataSalesman != undefined)
        {
            $('#salesman_name').attr('data-id', dataSalesman[0]);
            $('#salesman_name').val(dataSalesman[1]);
        }

    });

    $('#btnpesquisar').click(function () {
        var pesquisar = $('#searchSalesman').val();
        $.ajax({
            type: "GET",
            url: '/admin/vendedor/vendendorjson',
            data: { search: pesquisar },
            dataType: "JSON",
            success: function (data) {
                table.clear();
                table.rows.add(data);
                table.draw();
            }

        })
    });
});