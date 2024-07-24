<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $tarefa_id = (int)$_GET['tarefa_id'];
    $path = $_GET['path'];

    $sql = "SELECT 
        tarefas.id AS tarefa_id,
        tarefas.nome AS tarefa_nome,
        tarefas.descricao AS tarefa_descricao,
        grupos.nome AS grupo_nome,
        grupos.id AS grupo_id,
        categorias.nome AS categoria_nome,
        categorias.id AS categoria_id,
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

    $sql = "SELECT nome AS grupo_nome, id AS grupo_id
    FROM 
    grupos;";

    $grupos = $databaseHandler->getAllData($sql);


    $sql = "SELECT nome AS categoria_nome, id AS categoria_id
    FROM 
    categorias;";

    $categorias = $databaseHandler->getAllData($sql);
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
        <input type="hidden" id="path" name="path" value="<?php echo $path; ?>">

        <label for="nome">Nome da Tarefa:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $tarefa['tarefa_nome']; ?>" required><br><br>

        <label for="grupo_id">Grupo:</label><br>
        <select id="grupo_id" name="grupo_id" required>
            <?php foreach ($grupos as $grupo) : ?>
                <option <?php if($grupo['grupo_id'] == $tarefa['grupo_id']) echo 'selected'?> value="<?php echo $grupo['grupo_id'] ?>"><?php echo $grupo['grupo_nome']?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="categoria_id">Categoria:</label><br>
        <select id="categoria_id" name="categoria_id" required>
            <?php foreach ($categorias as $categoria) : ?>
                <option <?php if($categoria['categoria_id'] == $tarefa['categoria_id']) echo 'selected'?> value="<?php echo $categoria['categoria_id'] ?>"><?php echo $categoria['categoria_nome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>


        <label for="data_finalizacao">Data de Finalização:</label><br>
        <input type="datetime-local" id="data_finalizacao" name="data_finalizacao" value="<?php echo $tarefa['data_finalizacao'] ? date('Y-m-d\TH:i', strtotime($tarefa['data_finalizacao'])) : ''; ?>"><br><br>

        <input type="submit" value="Atualizar Tarefa">
    </form>
</body>

</html>


<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $data_finalizacao = $_POST['data_finalizacao'];
    $categoria_id = $_POST['categoria_id'];
    $grupo_id = $_POST['grupo_id'];
    $id = (int)$_POST['tarefa_id'];
    $path = $_POST['path'];

    $sql = "UPDATE tarefas 
SET nome = '$nome', 
    data_finalizacao = '$data_finalizacao',
    categoria_id = '$categoria_id',
    grupo_id = '$grupo_id' 
WHERE id = {$id}";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->editTarefas($sql);

    header("Location: {$path}");
    exit();
}
