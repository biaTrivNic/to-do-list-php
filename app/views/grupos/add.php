<h1>add categoria</h1>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $grupo_nome = $_GET['nome_grupo'];

    $sql = "INSERT INTO grupos (nome)
            VALUES ('$grupo_nome')";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->addTarefas($sql);

    header("Location: /tarefas/new");
    exit();
}
