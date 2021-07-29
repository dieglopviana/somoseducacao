<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel">Responsável</h4>
</div>

<div class="modal-body">
    <form>
        <?php
            if (isset($responsavel['id'])){
        ?>
                <input type="hidden" name="id" id="idResponsavel" value="<?= $responsavel['id']; ?>" />
        <?php
            }
        ?>

        <div class="form-group">
            <label for="nome" class="control-label">Nome do Responsável:</label>
            <input type="text" class="form-control" id="nome" value="<?php echo (isset($responsavel['nome']) ? $responsavel['nome'] : ''); ?>">
            <small class="text-danger hide nome_error"></small>
        </div>
    </form>
</div>

<div class="modal-footer">
    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> -->
    <button type="button" class="btn btn-primary salvar">Salvar</button>
</div>