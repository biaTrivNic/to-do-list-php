<h1>olaaaaaa delet</h1>

<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $tarefa_id = (int)$_GET['tarefa_id'];

$sql = "DELETE FROM tarefas WHERE id = {$tarefa_id};";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$databaseHandler->deleteTarefas($sql);

header("Location: /tarefas");
exit();

}