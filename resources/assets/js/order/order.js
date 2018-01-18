$(document).ready(function () {

    $('#priceproduct').inputmask( 'currency',{"autoUnmask": true,
        radixPoint:",",
        groupSeparator: ".",
        allowMinus: false,
        prefix: 'R$ ',            
        digits: 2,
        digitsOptional: false,
        rightAlign: false,
        unmaskAsNumber: true
    });
        $('#amountOrder').inputmask('decimal',
        { 'alias': 'numeric',
            'groupSeparator': '.',
            'autoGroup': true,
            'digits': 2,
            'radixPoint': ",",
            'digitsOptional': false,
            'allowMinus': false,
            'prefix': 'R$ ',
            'rightAlign': false,
            'placeholder': '0'
        }
        );
    $("#cpfcnpj").inputmask();
    var datarow =[];
    var dataItens = [];
    var total = 0;
    var totalItens = 0;
    var tableItems = $('#tableItems').DataTable({
        "bFilter": false,
        "lengthChange": false,
        "pageLength": 5,
        "dom": 'B<"down"i>rt<"bottom"<"#refresh">flp><"clear">',
        'select': true,
        'selectionMode': "single",
        'responsive': true,

        'createdRow': function( row, data, dataIndex ) 
        {
          $(row).attr('id',data[0][0]);
        },
        "columnDefs": [
            {
                'width': '2px',
                'targets': [0]
            },
            {
                'maxwidth':'15px',
                'targets':[2,3]
            },
            {
                'width': '2px',
                'targets': [4]
            }
        ],
    });

    $('#btnfinalizar').click(function(){
        if(tableItems.info().recordsTotal < 1)
        {

        }
        var order_id = $('#order_id').val();
        var people_id = $('#nameClient').attr('data-id');
        $.ajax({
            type:'POST',
            url:'',
            dataType:'',
            data:{},
            success:function(data)
            {
                if(data['result']=='ok')
                {
                    window.location.href = ''
                }
            }
        });
    });
    $('#btnAdicionar').click(function () {

        if($('#nameClient').attr('data-id')==undefined)
        {
            $('#nameClient').parent().addClass('has-feedback has-error');
            $('#nameClient').focus();
            return;
        }
        if($('#salesman_name').attr('data-id')==undefined)
        {
            $('#salesman_name').parent().addClass('has-feedback has-error');
            $('#salesman_name').focus();
            return;
        }
        if($('#nameproduct').attr('data-id')==undefined)
        {

            $('#nameproduct').parent().addClass('has-feedback has-error');
            $('#nameproduct').focus();
            return;
        }
        if(!$('#formItem').valid())
            return;

        var item = addValues(true);
        var order_id = $('#order_id').val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var people_id = $('#nameClient').attr('data-id');
        var salesman_id = $('#salesman_name').attr('data-id');
        $.ajax({
            type: "POST",
            url: "/admin/pedidos/salvar",
            data: {people_id:people_id, salesman_id:salesman_id, order_id :order_id,item_id: item.id,quantidade: item.amount,_token:CSRF_TOKEN},
            dataType: "json",
            success: function(data){
                if(data['result']=='ok')
                {
                    $('#order_id').val(data['order_id']);
                    $('#message').show();
                    $('#message_title').text(data['title']);
                    $('#message_body').text(data['msg']);
                    $('#message_class').addClass(data['class']);
                    var t = 0;
                    var time =  setInterval(function(){
                        ++t;
                        $('#message').hide();
                        if(t==5)
                        {
                            clearInterval(time);
                        }
                        
                    },5000);

                    t = 0;
                }

            }
        });

        if($('#tableItems tbody > tr#'+item.id+'').length>0)
        {
            tableItems.row('[id='+item.id+']').data([
                item.id,
                item.description,
                item.price,
                item.amount,
                item.btn
            ]).draw();
        }
        else
        {
            $('#tableItems').DataTable().row.add([
                item.id,
                item.description,
                item.price,
                item.amount,
                item.btn
            ]).draw();
        }
        update();
        addValues(false);
        tableItems.columns.adjust().draw();
    });


    function update()
    {
        tableItems.row().each(function(index)
        {
            var data = tableItems.row(index).data();
            total += (data[2]* data[3]);
            totalItens += data[3]; 
        });
        $('#amountOrder').val(total);
        $('#amountOrderItem').text(parseInt(totalItens));
        total = totalItens = 0;
    }

    function addValues(yesno)
    {
        var item = [];
        if(yesno)
        {
            
            item.id = $('#nameproduct').attr('data-id');
            item.description = $('#nameproduct').attr('data-name');
            item.price = $('#nameproduct').attr('data-price');
            item.amount = $('#amount').val();
            item.btn = '<button type="button" data-toggle="modal" data-target="#modalRemoveItem" title="Remover Item" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button>';
            return item;
        }
        else
        {
            $('#nameproduct').removeAttr('data-id');
            $('#nameproduct').val('').removeAttr('data-name');
             $('#nameproduct').val('').removeAttr('data-price');
            $('#priceproduct').val('');
            $('#amount').val('');
            
        }
    }

    $('#tableItems').on('click','tbody tr',function(){
        if(tableItems.page.info().recordsTotal > 0)
        {
            dataItens = tableItems.row(this).data();
            datarow = tableItems.row(this);
            $('#removeItem_id').val(datarow[1]);
        }
    });

    $('#saveClient').on('click', function (event) {
        if ($('#nameClient').is('[data-id]')) {
            $('#nameClient').parent().removeClass('has-feedback has-error');
        }
    });

    $('#saveSalesman').on('click', function (event) {
        if ($('#salesman_name').is('[data-id]')) {
            $('#salesman_name').parent().removeClass('has-feedback has-error');
        }
    });
    $('#removeItem').click(function(){
        var order_id = $('#order_id').val();
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var product_id = dataItens[0];
        $.ajax({
            url:'/admin/pedido/removeritem',
            type:'POST',
            data:{_token:CSRF_TOKEN, order_id:order_id,product_id:product_id},
            dataType:'JSON',
            success:function(data)
            {
                if(data['result']=='ok')
                {
                    tableItems.row(datarow).remove().draw();
                    $('#modalRemoveItem').modal('toggle');					
                }
            }
        });
    });
});
$('#formItem').validate(
    {
        onfocusout: function(element){

            if($(element).valid())
            {
                $(element).parent().removeClass('has-feedback has-error');
            }
            else
            {
                $(element).parent().addClass('has-feedback has-error');
            }
            
        },
        rules:{
            amount :{
                required:true
            }
        },
        messages:{
            amount:{
                required:"Informar Quantidade"
            }
        },
        highlight: function(element){
            $(element).parent().addClass('has-feedback has-error');
        }
    });