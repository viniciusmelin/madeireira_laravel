$(document).ready(function(){
    var dataClient = [];
    var tableClient = $('#tableClient').DataTable({
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

    $("#tableClient").delegate('tr', "click", function (evt) {
        $('#tableClient').find('tr').removeClass('active');

        $(this).toggleClass('active');
        dataClient = tableClient.row(this).data();
    });

    $('#saveClient').on('click', function () {
        console.log(dataClient);
        if(dataClient != undefined)
        {
            $('#nameClient').attr('data-id', dataClient[0]);
            $('#nameClient').val(dataClient[1]);
            $('#cpfcnpj').val(dataClient[2]);  
        }
        
    });

    $('#btnpesquisarClient').click(function () {
        var pesquisar = $('#searchClient').val();
        $.ajax({
            type: "GET",
            url: '/admin/cliente/clientejson',
            data: { search: pesquisar },
            dataType: "JSON",
            success: function (data) {
                console.log(data);
                tableClient.clear();
                tableClient.rows.add(data);
                tableClient.draw();
            }

        })
    });
});