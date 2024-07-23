<?php

$sql = "SELECT nome AS grupo_nome, id AS grupo_id
    FROM 
    grupos;";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$grupos = $databaseHandler->getAllData($sql);


$sql = "SELECT nome AS categoria_nome, id AS categoria_id
    FROM 
    categorias;";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$categorias = $databaseHandler->getAllData($sql);

?>

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

        <label for="grupo_id">Grupo:</label><br>
        <select id="grupo_id" name="grupo_id" required>
            <?php foreach ($grupos as $grupo) : ?>
                <option value="<?php echo $grupo['grupo_id'] ?>"><?php echo $grupo['grupo_nome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="categoria_id">Categoria:</label><br>
        <select id="categoria_id" name="categoria_id" required>
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?php echo $categoria['categoria_id'] ?>"><?php echo $categoria['categoria_nome'] ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="status">Status:</label><br>
        <select id="status" name="status" required>
            <option value="pendente">Pendente</option>
            <option value="em andamento">Em Andamento</option>
            <option value="concluída">Concluída</option>
        </select><br><br>

        <label for="data_finalizacao">Data de Finalização:</label><br>
        <input type="datetime-local" id="data_finalizacao" name="data_finalizacao"><br><br>

        <input type="submit" value="Adicionar Tarefa">
    </form>
</body>

</html>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $grupo_id = $_POST['grupo_id'];
    $categoria_id = $_POST['categoria_id'];
    $status = $_POST['status'];
    $data_finalizacao = $_POST['data_finalizacao'];

    $sql = "INSERT INTO tarefas (nome, grupo_id, categoria_id, status, data_finalizacao)
            VALUES ('$nome', $grupo_id, $categoria_id, '$status', '$data_finalizacao')";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->addTarefas($sql);

    header("Location: /tarefas");
    exit();
}
