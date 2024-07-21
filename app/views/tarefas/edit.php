<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $tarefa_id = $_GET['tarefa_id'];

    $sql = "SELECT 
        tarefas.id AS tarefa_id,
        tarefas.nome AS tarefa_nome,
        tarefas.descricao AS tarefa_descricao,
        grupos.nome AS grupo_nome,
        categorias.nome AS categoria_nome,
        tarefas.status,
        tarefas.data_criacao,
        tarefas.data_finalizacao
    FROM 
        tarefas
    LEFT JOIN 
        grupos ON tarefas.grupo_id = grupos.id
    LEFT JOIN 
        categorias ON tarefas.categoria_id = categorias.id
    WHERE 
        tarefas.id = {$tarefa_id}";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $tarefa = $databaseHandler->getTarefa($sql);

    if ($tarefa) {
        // Exiba os dados da tarefa
        echo "Nome da Tarefa: " . $tarefa['tarefa_nome'] . "<br>";
        // Continue exibindo outros campos conforme necessário
    } else {
        echo "Nenhuma tarefa encontrada com o ID fornecido.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Tarefa</title>
</head>

<body>
    <h1>Editar Tarefa</h1>
    <form action="edit" method="POST">
        <input type="hidden" id="tarefa_id" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">

        <label for="nome">Nome da Tarefa:</label><br>
        <input type="text" id="nome" name="nome" value="nome" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required><?php echo $tarefa['tarefa_descricao']; ?></textarea><br><br>

        <label for="data_criacao">Data de Criação:</label><br>
        <input type="datetime-local" id="data_criacao" name="data_criacao" value="<?php echo date('Y-m-d\TH:i', strtotime($tarefa['data_criacao'])); ?>" required><br><br>

        <label for="data_finalizacao">Data de Finalização:</label><br>
        <input type="datetime-local" id="data_finalizacao" name="data_finalizacao" value="<?php echo $tarefa['data_finalizacao'] ? date('Y-m-d\TH:i', strtotime($tarefa['data_finalizacao'])) : ''; ?>"><br><br>

        <input type="submit" value="Atualizar Tarefa">
    </form>
</body>

</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_finalizacao = $_POST['data_finalizacao'];
    $tarefa_id = $_POST['tarefa_id'];

    $sql = "UPDATE tarefas 
SET nome = '{$nome}', 
    descricao = '{$descricao}', 
    data_finalizacao = {$data_finalizacao} 
WHERE id = {$tarefa_id}";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->editTarefas($sql);

    header("Location: /tarefas");
    exit();

}
