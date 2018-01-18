<!-- Modal -->
<div id="modalSalesman" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Selecionar Vendedor</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="searchSalesman">Pesquisar</label>
                                <input type="search" class="form-control" name="searchSalesman" id="searchSalesman" placeholder="Informe o nome do vendedor">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="btnpesquisar"></label>
                                <div style="margin-top: 5px;">
                                    <button class="btn btn-info form-control" name="btnpesquisar" id="btnpesquisar"><span class="glyphicon glyphicon-search"></span></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered" id="tableSalesman">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-lg pull-left" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-success btn-lg pull-right" id="saveSalesman" data-dismiss="modal">Selecionar</button>
            </div>
        </div>

    </div>
</div>