let mix = require('laravel-mix');

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

// mix.copyDirectory('resources/assets/adminlte/css', 'public/adminlte/css');
//mix.styles(['resources/assets/adminlte/css/AdminLTE.css','resources/assets/adminlte/css/auth.css'],'public/adminlte/css/AdminLTE.min.css');
//.js('resources/assets/adminlte/js/adminlte.js','public/adminlte/js/adminlte.min.js')


/*Copia os arquivos do adminLTE*/
mix.copy('node_modules/admin-lte/dist/css/AdminLTE.css','public/adminlte/css/AdminLTE.min.css');
mix.copy('node_modules/admin-lte/dist/css/skins/_all-skins.css','public/adminlte/css/skins/all-skins.min.css');
mix.copy('node_modules/admin-lte/dist/js/adminlte.js','public/adminlte/js/adminlte.min.js');
/* -----------------------*/

/* Capia os plugins do AdminLTE*/ 
mix.copy('node_modules/admin-lte/plugins/iCheck/icheck.js','public/adminlte/plugins/icheck/icheck.min.js');
mix.copy('node_modules/admin-lte/plugins/iCheck/square/_all.css','public/adminlte/plugins/icheck/square/_all.min.css');
mix.copy('node_modules/admin-lte/plugins/iCheck/square/*.png','public/adminlte/plugins/icheck/square');

/**
 * Input Mask
 */
mix.copy('node_modules/inputmask/dist/jquery.inputmask.bundle.js','public/adminlte/plugins/input-mask/jquery.inputmask.bundle.js');
mix.copy('node_modules/inputmask/css/inputmask.css','public/adminlte/plugins/input-mask/css');
mix.copy('node_modules/inputmask/dist/inputmask/phone-codes','public/adminlte/plugins/input-mask/phone-codes');

/** DataTables Bootstrap*/
mix.copy('node_modules/datatables.net-bs/css/dataTables.bootstrap.css','public/adminlte/plugins/datatables/css/dataTables.bootstrap.min.css');
mix.copy('node_modules/datatables.net-bs/js/dataTables.bootstrap.js','public/adminlte/plugins/datatables/js/dataTables.bootstrap.min.js');
mix.copy('node_modules/datatables.net/js/jquery.dataTables.js','public/adminlte/plugins/datatables/js/jquery.dataTables.min.js');


/**Select2 */
mix.copy('node_modules/select2/dist/css/select2.css','public/adminlte/plugins/select2/css/select2.min.css');
mix.copy('node_modules/select2/dist/js/select2.js','public/adminlte/plugins/select2/js/select2.min.js');
mix.copy('node_modules/select2/dist/js/i18n','public/adminlte/plugins/select2/js/i18n');


/**Select2 */
mix.copy('node_modules/font-awesome/css/font-awesome.css','public/font-awesome/css/font-awesome.min.css');
mix.copy('node_modules/font-awesome/fonts','public/font-awesome/fonts');



/**Select2 */
mix.copy('node_modules/jquery/dist/jquery.js','public/js/jquery.min.js');


/**Ionicons */
mix.copy('node_modules/ionicons/dist/css/ionicons.css','public/ionicons/css/ionicons.min.css');
mix.copy('node_modules/ionicons/dist/fonts','public/ionicons/fonts');



/**Ionicons */
mix.copy('node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker.css','public/adminlte/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css');
mix.copy('node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.js','public/adminlte/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js');


/**Sistema */

mix.copy('resources/assets/js/client/client_pesq.js','public/js');
mix.copy('resources/assets/js/product/product_pesq.js','public/js');
mix.copy('resources/assets/js/salesman/salesman_pesq.js','public/js');
mix.copy('resources/assets/js/order/order.js','public/js');
mix.copy('resources/assets/js/client/client_editar.js','public/js');



mix.copy('node_modules/jquery-validation/dist/localization/messages_pt_BR.js','public/adminlte/plugins/jqueryvalidation/localization/messages_pt_BR.js');
mix.copy('node_modules/jquery-validation/dist/jquery.validate.min.js','public/adminlte/plugins/jqueryvalidation/jquery.validate.min.js');