$(document).ready(function(){
    var row;
    var table = $('#phonetable').DataTable(
     {
         "dataSrc": "",
         "columnDefs": [
         {
             "targets": [0],
             "visible": false,
             "searchable": false
         },
         {
             "targets": [4],
             "searchable": false
         }
     ]});
     var tableAddress = $('#tableAddress').DataTable({
         "dataSrc": "",
         "columnDefs": [
         {
             "targets": [0],
             "visible": false,
             "searchable": false
         },
         {
             "targets": [7],
             "searchable": false
         }
         ]});

     var tableEmail = $('#tableEmail').DataTable({
         "dataSrc": "",
         "columnDefs": [
         {
             "targets": [0],
             "visible": false,
             "searchable": false
         }
         ]});
 
     $('#phonetable').on('click', 'tbody tr', function () {
         if(table.page.info().recordsTotal >0)
         {
             var data = table.row( this ).data();
             $('#phone_type_id option[name='+data[3]+']').prop('selected', true);
             $('#phone_number').val(data[1]);
             $('#phone_id').val(data[0]);
             $('#removephone_id').val(data[0]);
             data[2]=="Sim" ? $('#main_phone').iCheck('check'): $('#main_phone').iCheck('uncheck');
             row = table.row(this);
         }

     } );
    
    $('#tableAddress').on('click','tbody tr',function(){
        if(tableAddress.page.info().recordsTotal > 0)
        {
            var data = tableAddress.row(this).data();
            $('#street').val(data[1]);
            $('#neighborhood').val(data[2]);
            $('#number').val(data[3]);
            $('#city').val(data[4]);
            $('#zipcode').val(data[5]);
            $('#complement').val(data[6]);
            $('#address_id').val(data[0]);
            $('#removeAddress_id').val(data[0]);
            row = tableAddress.row(this);
        }
    });

    $('#tableEmail').on('click','tbody tr',function(){
        if(tableEmail.page.info().recordsTotal > 0)
        {
            var data = tableEmail.row(this).data();
            $('#email').val(data[1]);
            data[2]=='Sim' ? $('#main_email').iCheck('check'):$('#main_email').iCheck('uncheck');
            $('#email_id').val(data[0]);
            $('#removeEmail_id').val(data[0]);
            row = tableEmail.row(this);

        }
    });

 $('#saveEmail').click(function(){
     var caminho="";
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     var main = $('#main_email').is(':checked') ? 1:0;
     var email = $('#email').val();
     var people_id = $('#code').val();
     var id = $('#email_id').val();
     var data={_token: CSRF_TOKEN, main:main, email:email, people_id: people_id, id:id};
     if($('#email_id').val()==null || $('#email_id').val()=="")
     {
         caminho = "/admin/cliente/email/salvar";
     }
     else
     {
         caminho = "/admin/cliente/email/atualizar";
     }
     $.ajax({
         url: caminho,
         type: "POST",
         dataType:"JSON",
         data: data,
         success:function(data)
         {
             if(data['result']=="ok" && data['action']=="update")
             {
                 row.data([
                 data['object']['id'],
                 data["object"]["email"],
                 data["object"]["main"]== 1 ? 'Sim':'Não',
                 '<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEmail" title="Editar Email"><span class="fa fa-edit"></span></button><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveEmail" title="Excluir Email"><span class="glyphicon glyphicon-remove"></button></td>']);

             }
             else if(data['result']=="ok" && data['action']=="store")
             {
                     var email = data['object'];
                     $('#tableEmail').DataTable().row.add([
                         email.id,
                         email.email,
                         email.main== 1 ? 'Sim':'Não',
                         '<td><button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalEmail" title="Editar Email"><span class="fa fa-edit"></span></button> <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalRemoveEmail" title="Excluir Email"><span class="glyphicon glyphicon-remove"></button></td>'                    
                     ]).draw();
             }

             $('#modalEmail').modal('hide');
             $('#countEmail').text(tableEmail.page.info().recordsTotal);
         }
     });

 });
 $('#saveAddress').click(function(){
         var caminho="";
         var data =[];
         var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
         var address_id = $('#address_id').val();
         var street = $('#street').val();
         var neighborhood = $('#neighborhood').val();
         var number = $('#number').val();
         var zipcode = $('#zipcode').val();
         var complement = $('#complement').val();
         var city = $('#city').val();
         var people_id = $('#code').val();
         data = {people_id: people_id, _token: CSRF_TOKEN, id: address_id, street: street, neighborhood: neighborhood, number: number, zip_code: zipcode, complement: complement, city:city};
         if($('#address_id').val()==null || $('#address_id').val()=="")
         {
             caminho = '/admin/cliente/endereco/salvar';
         }
         else
         {
             caminho = '/admin/cliente/endereco/atualizar';
         }
         $.ajax({
             url: caminho,
             type: 'POST',
             data: data,
             dataType: 'JSON',
             success: function(data)
             {
                 if(data['result']=='ok' && data['action']=="update")
                 {
                     row.data([
                         data['object']['id'],
                         data["object"]["street"],
                         data["object"]["neighborhood"],
                         data["object"]["number"],
                         data["object"]["city"],
                         data["object"]["zip_code"],
                         data["object"]["complement"],
                         '<td><button type="button" data-toggle="modal" data-target="#modalAddress" title="Editar Endereço" class="btn btn-info"><span class="fa fa-edit"></span></button> <button type="button" data-toggle="modal" data-target="#modalRemoveAddress" title="Excluir Endereço" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>'
                         ]);
                 }
                 else if(data['result']=='ok' && data['action']=="store")
                 {
                     var address = data['object'];
                     $('#tableAddress').DataTable().row.add([
                         address.id,
                         address.street,
                         address.neighborhood,
                         address.number,
                         address.city,
                         address.zip_code,
                         address.complement,
                         '<td><button type="button" data-toggle="modal" data-target="#modalAddress" title="Editar Endereço" class="btn btn-info"><span class="fa fa-edit"></span></button> <button type="button" data-toggle="modal" data-target="#modalRemoveAddress" title="Excluir Endereço" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>'
                     ]).draw();
                 }
                 $('#modalAddress').modal('hide');
                 $('#countAddress').text(tableAddress.page.info().recordsTotal);
             }
         });
 });

 $('#savephone').click(function(){
     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
     var phoneid = $('#phone_id').val();
     var data="";
     var caminho="";
     var main = $('#main_phone').is(':checked') ? 1:0;
     if($('#phone_id').val()==null || $('#phone_id').val()=="")
     {
         caminho = '/admin/cliente/telefone/salvar';
         datavalue = {_token: CSRF_TOKEN,number:$('#phone_number').val(),people_id:$('#code').val(),phone_type_id: $('#phone_type_id option:selected').val(),main: main};
     }
     else
     {
         caminho = '/admin/cliente/telefone/atualizar';
         datavalue = {id:$('#phone_id').val(),_token: CSRF_TOKEN,number:$('#phone_number').val(),people_id:$('#code').val(),phone_type_id: $('#phone_type_id option:selected').val(),main:main};
     }
         $.ajax({
             url: caminho,
             type: 'POST',
             data: datavalue,
             dataType:'JSON',
             success: function(data)
             {
                 if(data['result']=='ok'&& data['action']=='update')
                 {
                     row.data([data['object']['id'],data['object']['number'],data['object']['main']==1 ? 'Sim':'Não',data['object']['phone_type']['description'],'<td><button type="button" data-toggle="modal" data-target="#modalPhone" title="Editar Telefone" class="btn btn-info"><span class="fa fa-edit"></span></button> <button type="button" data-toggle="modal" data-target="#modalremove" title="Editar Telefone" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>']).draw();                 
                 }
                 else if(data['result']=='ok'&& data['action']=='store')
                 {
                     $('#phonetable').DataTable().row.add([
                     data['object'].id,
                     data['object'].number,
                     data['object'].main == 1 ? 'Sim':'Não',
                     data['object'].phone_type.description,
                     '<td><button type="button" data-toggle="modal" data-target="#modalPhone" title="Editar Telefone" class="btn btn-info"><span class="fa fa-edit"></span></button> <button type="button" data-toggle="modal" data-target="#modalremove" title="Editar Telefone" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></td>']).draw();
                 }
                 $('#modalPhone').modal('toggle');
                 $('#countPhones').text(table.page.info().recordsTotal);
             }
         });
 });


 $('#removephone').click(function(){
     $.ajax({
         url: '/admin/cliente/telefone/remover',
         type: 'POST',
         data:{_token:$('meta[name="csrf-token"]').attr('content'),id:$('#removephone_id').val()},
         dataType: 'JSON',
         success: function(data)
         {
             table.row(row).remove().draw();
             $('#modalremove').modal('toggle');
             $('#countPhones').text(table.page.info().recordsTotal);
         }
     });
 });

 $('#removeAddress').click(function(){
     $.ajax({
         url: '/admin/cliente/endereco/remover',
         type: 'POST',
         data:{_token:$('meta[name="csrf-token"]').attr('content'),id:$('#removeAddress_id').val()},
         dataType: 'JSON',
         success: function(data)
         {
             tableAddress.row(row).remove().draw();
             $('#modalRemoveAddress').modal('toggle');
             $('#countAddress').text(tableAddress.page.info().recordsTotal);
         }
     });
 });
 

 $('#removeEmail').click(function(){
     $.ajax({
         url: '/admin/cliente/email/remover',
         type: 'POST',
         data:{_token:$('meta[name="csrf-token"]').attr('content'),id:$('#removeEmail_id').val()},
         dataType: 'JSON',
         success: function(data)
         {
             tableEmail.row(row).remove().draw();
             $('#modalRemoveEmail').modal('toggle');
             $('#countEmail').text(tableEmail.page.info().recordsTotal);
         }
     });
 });

 $('#modalEmail').on('hidden.bs.modal',function(){
     $('#email_id').val("");
     $('#removeEmail_id').val("");
     $('#email').val("");
     $('#main_email').iCheck('uncheck');

 });


 $('#modalPhone').on('hidden.bs.modal',function(){
     $('#phone_id').val("");
     $('#phone_number').val("");
     $('#main_phone').iCheck('uncheck');
 });

 $('#modalAddress').on('hidden.bs.modal',function(){
     $('#street').val("");
     $('#neighborhood').val("");
     $('#number').val("");
     $('#city').val("");
     $('#zipcode').val("");
     $('#complement').val("");
     $('#address_id').val("");
 });

});