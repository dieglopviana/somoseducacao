<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel">Categoria</h4>
</div>

<div class="modal-body">
    <form>
        <?php
            if (isset($categoria['id'])){
        ?>
                <input type="hidden" name="id" id="idCategoria" value="<?= $categoria['id']; ?>" />
        <?php
            }
        ?>

        <div class="form-group">
            <label for="nome" class="control-label">Nome da Categoria:</label>
            <input type="text" class="form-control" id="descricao" value="<?php echo (isset($categoria['descricao']) ? $categoria['descricao'] : ''); ?>">
            <small class="text-danger hide descricao_error"></small>
        </div>
    </form>
</div>

<div class="modal-footer">
    <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button> -->
    <button type="button" class="btn btn-primary salvar">Salvar</button>
</div>