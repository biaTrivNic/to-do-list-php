<?php

$sql = "SELECT COUNT(*) AS total_tarefas
FROM tarefas
WHERE status = 'pendente';";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$tarefasPendentes = $databaseHandler->countTarefas($sql);

$sql = "SELECT COUNT(*) AS total_tarefas
FROM tarefas
WHERE status = 'em andamento';";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$tarefasAndamento = $databaseHandler->countTarefas($sql);

$sql = "SELECT COUNT(*) AS total_tarefas
FROM tarefas
WHERE status = 'concluída';";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$tarefasConcluida = $databaseHandler->countTarefas($sql);

$total_de_tarefas = $tarefasPendentes[0]['total_tarefas'] + $tarefasAndamento[0]['total_tarefas'] + $tarefasConcluida[0]['total_tarefas'];

?>

<section>
    <h1>Você tem:</h1>
    <div>
        <h1><?php echo $tarefasPendentes[0]['total_tarefas'] ?> tarefa pendentes</h1>
        <div></div>
    </div>
    <div>
        <h1><?php echo $tarefasAndamento[0]['total_tarefas'] ?> tarefa em andamento</h1>
        <div></div>
    </div>
    <div>
        <h1><?php echo $tarefasConcluida[0]['total_tarefas'] ?> tarefa em concluidas</h1>
        <div></div>
    </div>
</section>