<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="exampleModalLabel">Tarefa</h4>
</div>

<div class="modal-body">
    <?php
        if (count($responsaveis) >= 1 AND count($categorias) >= 1){
    ?>
            <form>
                <?php
                    if (isset($tarefa['id'])){
                ?>
                        <input type="hidden" name="id" id="idTarefa" value="<?= $tarefa['id']; ?>" />
                <?php
                    }
                ?>

                <div class="form-group">
                    <label for="nome" class="control-label">Responsável:</label>
                    <select class="form-control" name="responsavel_id" id="responsavel_id">
                        <option value="">Selecione o Responsável</option>
                        <?php
                            foreach ($responsaveis as $responsavel) {
                        ?>
                                <option value="<?= $responsavel['id']; ?>" <?= ((isset($tarefa['responsavel_id']) AND $responsavel['id'] == $tarefa['responsavel_id']) ? 'selected' : '') ?>><?= $responsavel['nome']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <small class="text-danger hide responsavel_id_error"></small>
                </div>

                <div class="form-group">
                    <label for="nome" class="control-label">Categoria:</label>
                    <select class="form-control" name="categoria_id" id="categoria_id">
                        <option value="">Selecione o Responsável</option>
                        <?php
                            foreach ($categorias as $categoria) {
                        ?>
                                <option value="<?= $categoria['id']; ?>" <?= ((isset($tarefa['categoria_id']) AND $categoria['id'] == $tarefa['categoria_id']) ? 'selected' : '') ?>><?= $categoria['descricao']; ?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <small class="text-danger hide categoria_id_error"></small>
                </div>

                <div class="form-group">
                    <label for="nome" class="control-label">Título da Tarefa:</label>
                    <input type="text" class="form-control" name="titulo" id="titulo" value="<?php echo (isset($tarefa['titulo']) ? $tarefa['titulo'] : ''); ?>">
                    <small class="text-danger hide titulo_error"></small>
                </div>

                <div class="form-group">
                    <label for="nome" class="control-label">Descrição da tarefa:</label>
                    <textarea class="form-control" rows="3" name="descricao" id="descricao"><?php echo (isset($tarefa['descricao']) ? nl2br($tarefa['descricao']) : ''); ?></textarea>
                    <small class="text-danger hide descricao_error"></small>
                </div>

                <div class="form-group">
                    <label for="nome" class="control-label">Data Finalização:</label>
                    <input type="date" class="form-control" name="data_finalizadao" id="data_finalizacao" value="<?php echo (isset($tarefa['data_finalizacao']) ? $tarefa['data_finalizacao'] : ''); ?>">
                    <small class="text-danger hide data_finalizacao_error"></small>
                </div>
            </form>
    <?php
        } else {
    ?>
            <div class="alert alert-danger" role="alert">
                <strong>Ops!</strong> Para ciar um tarefa é preciso ter cadastrado ao menos um responsável e uma categoria
            </div>
    <?php
        }
    ?>
</div>

<div class="modal-footer">
    <?php
        if (count($responsaveis) >= 1 AND count($categorias) >= 1){
    ?>
            <button type="button" class="btn btn-primary salvar">Salvar</button>
    <?php
        } else {
    ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <?php
        }
    ?>
</div>