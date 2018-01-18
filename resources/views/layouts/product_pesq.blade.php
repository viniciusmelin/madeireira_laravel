<!-- Modal -->
<div id="modalProduct" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Selecionar Produto</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-9">
                            <div class="form-group">
                                <label for="searchProduct">Pesquisar</label>
                                <input type="search" class="form-control" name="searchProduct" id="searchProduct" placeholder="Informe o nome do Produto">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <label for="btnpesquisarProduct"></label>
                                <div style="margin-top: 5px;">
                                    <button  class="btn btn-info form-control" name="btnpesquisarProduct" id="btnpesquisarProduct">
                                        <span class="glyphicon glyphicon-search"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table table-hover table-bordered" id="tableProduct">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Produto</th>
                                    <th>Preço</th>
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
                <button type="button" class="btn btn-success btn-lg pull-right" id="selectProduct" data-dismiss="modal">Selecionar</button>
            </div>
        </div>

    </div>
</div>