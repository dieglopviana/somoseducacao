<?php $this->extend('layouts/default') ?>

<?php $this->section('content') ?>
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1>Anglo Vestibulares</h1>
        
        <P>Teste de Conhecimento - Desenvolvedor WEB</P>
        
        <ul>
            <li>DB MYSQL</li>
            <li>BOOTSTRAP</li>
            <li>JQUERY</li>
            <li>CODEIGNITER</li>
        </ul>
        
        <p>1) Criação das tabelas e suas referências (INTEGRIDADE REFERENCIAL)</p>
        
        <ul>
            <li>TABELA TAREFAS (ID, DESCRIÇÃO, RESPONSÁVEL, DATA FINALIZAÇÃO DA TAREFA, CATEGORIA)</li>
            <li>TABELA CATEGORIA (ID, DESCRIÇÃO DA CATEGORIA)</li>
            <li>TABELA DE RESPONSÁVEL (ID, NOME)</li>
        </ul>
        
        <p>2) Criação de um formulário de cadastro</p>

        <p>3) Criação de uma tela para visualização das tarefas</p>

        <ul>
            <li>EDIÇÃO E EXCLUSÃO</li>
        </ul>

        <p>4) Criação de uma tela de visualização da tarefa com detalhamento</p>

        <p class="text-right">
            <a class="btn btn-lg btn-primary" href="/tarefas" role="button">Ver tarefas &raquo;</a>
        </p>
    </div>
<?php $this->endSection() ?>