<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>

<div class="page-header">
    <h2>Tarefas</h2>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <a href="/tarefa/form" class="btn btn-primary pull-right" data-toggle="modal" data-target="#formModal">Novo</a>
    </div>
</div>

<div class="row form-group">
    <?php
        if (count($tarefas) >= 1){
    ?>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoria</th>
                            <th>Responsável</th>
                            <th>Prazo</th>
                            <th class="text-center">Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($tarefas as $tarefa) {
                        ?>
                                <tr>
                                    <td style="width: 25%; vertical-align: middle;"><?= $tarefa['titulo']; ?></td>
                                    <td style="width: 20%; vertical-align: middle;"><?= $tarefa['categoria']; ?></td>
                                    <td style="width: 25%; vertical-align: middle;"><?= $tarefa['responsavel']; ?></td>
                                    <td style="width: 10%; vertical-align: middle;"><?= date('d/m/Y', strtotime($tarefa['data_finalizacao'])); ?></td>
                                    <td class="text-right" style="width: 20%;">
                                        <a href="/tarefa/detalhes/<?= $tarefa['id']; ?>" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detalheModal">Detalhes</a>
                                        <a href="/tarefa/form/<?= $tarefa['id']; ?>" class="btn btn-info btn-sm" title="Alterar" data-toggle="modal" data-target="#formModal">Alterar</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal" data-whatever="<?= $tarefa['id']; ?>">Excluir</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>

                <?= $pager->links('tarefas', 'paginate_full') ?>
            </div>
    <?php
        } else {
    ?>
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                    <strong>Nenhuma Tarefa Cadastrada!</strong>
                </div>
            </div>
    <?php
        }
    ?>
</div>


<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="detalheModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content"></div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Confirmar</h4>
            </div>

            <div class="modal-body">
                Você tem certeza que deseja continuar?
            </div>

            <div class="modal-footer">
                <input type="hidden" id="id_tarefa" value="" />
                <button type="button" class="btn btn-default cancelar" data-dismiss="modal">Não</button>
                <button type="button" class="btn btn-primary excluir">Sim</button>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection() ?>



<?php $this->section('javascript'); ?>

    <script type="text/javascript">

        $(document).ready(function(){
            
            $('body').on('click', '.salvar', function(){
                $('.salvar').addClass('disabled').html('Aguarde...');

                var idTarefa = ($('#idTarefa').val() != undefined ? $('#idTarefa').val() : '');

                var data = 'responsavel_id=' + $('#responsavel_id').val();
                data += '&categoria_id=' + $('#categoria_id').val();
                data += '&titulo=' + $('#titulo').val();
                data += '&descricao=' + $('#descricao').val();
                data += '&data_finalizacao=' + $('#data_finalizacao').val();
                data += '&id=' + idTarefa;

                $.ajax({
                    'url': '/tarefa/create',
                    'method': 'post',
                    'data': data,
                    'dataType': 'json',
                    'success': function(response){
                        if (response.status_error == 0){
                            $('.text-danger').addClass('hide').html('');
                            $('.salvar').addClass('hide');
                            
                            if (idTarefa == ''){
                                msg = '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Tarefa cadastrada com sucesso!</div>';
                            } else {
                                msg = '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Tarefa alterada com sucesso!</div>';
                            }
                            
                            $('.modal-body').html(msg);
                        } else {
                            $('.text-danger').addClass('hide').html('');
                            
                            Object.keys(response.validator).forEach(function(k){
                                $('.' + k + '_error').removeClass('hide').html(response.validator[k]);
                            });
                        }

                        $('.salvar').removeClass('disabled').html('Salvar');
                    }
                })
            })


            $('body').on('click', '.excluir', function(){
                idTarefa = $('input#id_tarefa').val();

                $('.excluir').addClass('disabled').html('Aguarde...');
                $('.cancelar').addClass('hide');

                $.ajax({
                    'url': '/tarefa/delete',
                    'method': 'post',
                    'data': 'id=' + idTarefa,
                    'dataType': 'json',
                    'success': function(response){
                        $('.excluir').addClass('hide');

                        if (response.status_error == 0){
                            $('.modal-body').html('<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Tarefa excluída com sucesso!</div>');
                        } else {
                            $('.modal-body').html('<div class="alert alert-danger" role="alert"><strong>Ops!</strong> ' + response.error + '</div>');
                        }
                    }
                })
            })



            $('#formModal').on('hidden.bs.modal', function (e) {
                location.reload();
            })


            $('#confirmModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget)
                var idTarefa = button.data('whatever')

                $('input#id_tarefa').val(idTarefa)
            })


            $('#confirmModal').on('hidden.bs.modal', function (e) {
                location.reload();
            })

            $('#detalheModal').on('hidden.bs.modal', function (e) {
                location.reload();
            })

        });

    </script>

<?php $this->endSection() ?>