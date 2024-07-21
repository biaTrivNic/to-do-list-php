<!DOCTYPE html>
<html>
<head>
    <title>Inserir Tarefa</title>
</head>
<body>
    <h1>Inserir Nova Tarefa</h1>
    <form action="new" method="POST">
        <label for="nome">Nome da Tarefa:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required></textarea><br><br>

        <label for="grupo_id">Grupo:</label><br>
        <select id="grupo_id" name="grupo_id" required>
            <!-- Options should be populated from the database -->
            <option value="1">Grupo A</option>
            <option value="2">Grupo B</option>
            <option value="3">Grupo C</option>
            <option value="4">Grupo D</option>
            <option value="5">Grupo E</option>
        </select><br><br>

        <label for="categoria_id">Categoria:</label><br>
        <select id="categoria_id" name="categoria_id" required>
            <!-- Options should be populated from the database -->
            <option value="1">Desenvolvimento</option>
            <option value="2">Design</option>
            <option value="3">Marketing</option>
            <option value="4">Vendas</option>
            <option value="5">Suporte</option>
        </select><br><br>

        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="pendente">Pendente</option>
            <option value="em andamento">Em Andamento</option>
            <option value="concluída">Concluída</option>
        </select><br><br>

        <label for="data_criacao">Data de Criação:</label><br>
        <input type="datetime-local" id="data_criacao" name="data_criacao" required><br><br>

        <label for="data_finalizacao">Data de Finalização:</label><br>
        <input type="datetime-local" id="data_finalizacao" name="data_finalizacao"><br><br>

        <input type="submit" value="Inserir Tarefa">
    </form>
</body>
</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $grupo_id = $_POST['grupo_id'];
    $categoria_id = $_POST['categoria_id'];
    $status = $_POST['status'];
    $data_criacao = $_POST['data_criacao'];
    $data_finalizacao = $_POST['data_finalizacao'];

$sql = "INSERT INTO tarefas (nome, descricao, grupo_id, categoria_id, status, data_criacao, data_finalizacao)
            VALUES ('$nome', '$descricao', $grupo_id, $categoria_id, '$status', '$data_criacao', '$data_finalizacao')";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$databaseHandler->addTarefas($sql);

header("Location: /tarefas");
exit();

}

