<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>

<div class="page-header">
    <h2>Categorias</h2>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <a href="/categoria/form" class="btn btn-primary pull-right" data-toggle="modal" data-target="#formModal">Novo</a>
    </div>
</div>

<div class="row form-group">
    <?php
        if (count($categorias) >= 1){
    ?>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Descrição</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($categorias as $categoria) {
                        ?>
                                <tr>
                                    <td style="width: 5%; vertical-align: middle;"><?= $categoria['id']; ?></td>
                                    <td style="width: 83%; vertical-align: middle;"><?= $categoria['descricao']; ?></td>
                                    <td style="width: 14%;">
                                        <a href="/categoria/form/<?= $categoria['id']; ?>" class="btn btn-info btn-sm" title="Alterar" data-toggle="modal" data-target="#formModal">Alterar</a>
                                        <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#confirmModal"data-whatever="<?= $categoria['id']; ?>">Excluir</a>
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>

                <?= $pager->links('categorias', 'paginate_full') ?>
            </div>
    <?php
        } else {
    ?>
            <div class="col-md-12">
                <div class="alert alert-warning" role="alert">
                    <strong>Nenhuma Categoria Cadastrada!</strong>
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
                <input type="hidden" id="id_categoria" value="" />
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
                var descricao   = $('#descricao').val();
                var idCategoria = ($('#idCategoria').val() != undefined ? $('#idCategoria').val() : '');

                $('.salvar').addClass('disabled').html('Aguarde...');

                $.ajax({
                    'url': '/categoria/create',
                    'method': 'post',
                    'data': 'descricao=' + descricao + '&id=' + idCategoria,
                    'dataType': 'json',
                    'success': function(response){
                        if (response.status_error == 0){
                            $('.descricao_error').addClass('hide').html('');
                            $('.salvar').addClass('hide');
                            
                            if (idCategoria == ''){
                                msg = '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Categoria cadastrado com sucesso!</div>';
                            } else {
                                msg = '<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Categoria alterado com sucesso!</div>';
                            }
                            
                            $('.modal-body').html(msg);
                        } else {
                            $('.descricao_error').removeClass('hide').html(response.validator.descricao);
                        }

                        $('.salvar').removeClass('disabled').html('Salvar');
                    }
                })
            })


            $('body').on('click', '.excluir', function(){
                idCategoria = $('input#id_categoria').val();

                $('.excluir').addClass('disabled').html('Aguarde...');
                $('.cancelar').addClass('hide');

                $.ajax({
                    'url': '/categoria/delete',
                    'method': 'post',
                    'data': 'id=' + idCategoria,
                    'dataType': 'json',
                    'success': function(response){
                        $('.excluir').addClass('hide');

                        if (response.status_error == 0){
                            $('.modal-body').html('<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Categoria excluída com sucesso!</div>');
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
                var idResponsavel = button.data('whatever')

                $('input#id_categoria').val(idResponsavel)
            })


            $('#confirmModal').on('hidden.bs.modal', function (e) {
                location.reload();
            })

        });

    </script>

<?php $this->endSection() ?>