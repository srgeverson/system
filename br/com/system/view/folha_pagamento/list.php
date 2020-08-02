<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <form action="<?php echo server_url('?page=ControllerFolhaPagamento&option=list'); ?>" method="post">
            <h3 class="m-0 font-weight-bold text-primary">
                <span>Listar Folha de Pagamento</span>
            </h3>
            <hr>
            <div class="form-group row">
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Nome</span>
                        <input class="form-control" name="func_nome" placeholder="Digite o nome" type="text">
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">CPF</span>
                        <input class="form-control" id="cpf" name="func_cpf" placeholder="000.000.000-00"type="tel" >
                    </div>
                </div>
                <div class="col-sm-4 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <span class="input-group-text">Competência</span>
                        <input class="form-control" id="competencia" name="fopa_competencia" placeholder="00/0000" type="tel">
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2 mb-3 mb-sm-4">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerFolhaPagamento&option=new'); ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-plus"></i>
                            </span>
                            <span class="text">Incluir Único</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mb-3 mb-sm-4">
                    <div class="input-group input-group-lg">
                        <a  title="Cadastrar dados!" href="<?php echo server_url('?page=ControllerFolhaPagamento&option=batch'); ?>" class="btn btn-primary btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-folder-plus"></i>
                            </span>
                            <span class="text">Incluir Lote</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-2 mb-4 mb-sm-0">
                    <div class="input-group input-group-lg">
                        <button class="btn btn-success btn-icon-split btn-lg">
                            <span class="icon text-white-50">
                                <i class="fas fa-search"></i>
                            </span>
                            <span class="text">Filtrar</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php
            if (!isset($folhaPagamentos)) {
                echo '<h2>Use o filtro para ver os funcionários cadastrados</h2>';
            } else {
                echo '<table cellspacing="0" class="table table-bordered" id="dataTable" width="100%">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>CPF</th>';
                echo '<th>Competência</th>';
                echo '<th>Data Nascimento</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                foreach ($folhaPagamentos as $each_folha_pagamentos) {
                    echo '<tr>';
                    echo '<td>', $each_folha_pagamentos->fopa_pk_id, '</td>';
                    echo '<td>', $each_folha_pagamentos->func_nome, '</td>';
                    echo '<td>', $each_folha_pagamentos->func_cpf, '</td>';
                    echo '<td>', $each_folha_pagamentos->fopa_competencia, '</td>';
                    $data = new DateTime($each_folha_pagamentos->func_data_nascimento);
                    echo '<td>', $data->format('d-m-Y'), '</td>';
                    echo '<td>';
                    echo '<a title="Visualizar dados!" href="', server_url('?page=ControllerFolhaPagamento&option=view&fopa_pk_id=' . $each_folha_pagamentos->fopa_pk_id), '" class="btn btn-info btn-circle btn-sm" style="margin: 5px">';
                    echo '<i class="fas fa-search"></i>';
                    echo '</a>';
                    echo '<a title="Editar dados!" href="', server_url('?page=ControllerFolhaPagamento&option=edit&fopa_pk_id=' . $each_folha_pagamentos->fopa_pk_id), '" class="btn btn-warning btn-circle btn-sm" style="margin: 5px">';
                    echo '<i class="fas fa-edit"></i>';
                    echo '</a>';
                    if ($each_folha_pagamentos->fopa_status) {
                        echo '<a title="Desabilitar dados!" href="', server_url('?page=ControllerFolhaPagamento&option=disable&fopa_pk_id=' . $each_folha_pagamentos->fopa_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-times-circle"></i>';
                        echo '</a>';
                    } else {
                        echo '<a title="Ativar dados!" href="', server_url('?page=ControllerFolhaPagamento&option=enable&fopa_pk_id=' . $each_folha_pagamentos->fopa_pk_id), '" class="btn btn-success btn-circle btn-sm excluir" style="margin: 5px">';
                        echo '<i class="fas fa-check-circle"></i>';
                        echo '</a>';
                    }
                    echo '<a title="Excluir dados!" href="', server_url('?page=ControllerFolhaPagamento&option=delete&fopa_pk_id=' . $each_folha_pagamentos->fopa_pk_id), '" class="btn btn-danger btn-circle btn-sm excluir" onclick="return confirm(´Deseja realmente excluir, esta operação não podera ser desfeita!´)" style="margin: 5px">';
                    echo '<i class="fas fa-trash"></i>';
                    echo '</a>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '<tfoot>';
                echo '<tr>';
                echo '<th>Código</th>';
                echo '<th>Nome</th>';
                echo '<th>CPF</th>';
                echo '<th>Competência</th>';
                echo '<th>Data Nascimento</th>';
                echo '<th>Opções</th>';
                echo '</tr>';
                echo '</tfoot>';
                echo '</tbody>';
                echo '</table>';
            }
            ?>
        </div>
    </div>
</div>