<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel">Realizar testes de Operação</h4>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <strong>Responsável:</strong>
            <?= $tarefas['responsavel']; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <strong>Categoria:</strong>
            <?= $tarefas['categoria']; ?>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-md-12">
            <strong>Prazo:</strong>
            <?= date('d/m/Y', strtotime($tarefas['data_finalizacao'])); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <strong>Descrição:</strong>
            <p><?= nl2br($tarefas['descricao']); ?></p>
        </div>
    </div>


</div>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
</div>