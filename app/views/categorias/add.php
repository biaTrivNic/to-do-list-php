<h1>add categoria</h1>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $path = $_POST['path'];

    $status = $_POST['status'];

    $categoria_nome = $_POST['nome_categoria'];

    $sql = "INSERT INTO categorias (nome)
            VALUES ('$categoria_nome')";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->addTarefas($sql);

    header("Location: /tarefas/new?path={$path}&status={$status}");
    exit();
}
