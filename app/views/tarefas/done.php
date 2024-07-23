<?php if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $tarefa_id = (int)$_GET['tarefa_id'];

    print_r($tarefa_id);

    $sql = "UPDATE tarefas 
SET status = 'concluída' 
WHERE id = $tarefa_id";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->editTarefas($sql);

    header("Location: /tarefas");
    exit();
}
