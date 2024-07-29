<h1>add grupo</h1>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $path = $_POST['path'];

    $status = $_POST['status'];

    $grupo_nome = $_POST['nome_grupo'];

    $sql = "INSERT INTO grupos (nome)
            VALUES ('$grupo_nome')";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->addTarefas($sql);

    header("Location: /tarefas/new?path={$path}&status={$status}");
    exit();
}
