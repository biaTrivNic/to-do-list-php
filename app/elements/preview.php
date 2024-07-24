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

$width_pendentes = ($tarefasPendentes[0]['total_tarefas'] / $total_de_tarefas) * 100;
$width_andamento = ($tarefasAndamento[0]['total_tarefas'] / $total_de_tarefas) * 100;
$width_concluida = ($tarefasConcluida[0]['total_tarefas'] / $total_de_tarefas) * 100;

?>

<section class="preview-container">
    <h1>Você tem:</h1>
    <div class="bar-container">
        <h1><?php echo $tarefasPendentes[0]['total_tarefas'] ?> tarefa(s) pendente(s)</h1>
        <div class="bar"><div style="width: <?php echo $width_pendentes?>%;background-color: rgb(212, 73, 73);"></div></div>
    </div>
    <div class="bar-container">
        <h1><?php echo $tarefasAndamento[0]['total_tarefas'] ?> tarefa(s) em andamento</h1>
        <div class="bar"><div style="width: <?php echo $width_andamento?>%;background-color: rgb(97, 97, 212);"></div></div>
    </div>
    <div class="bar-container">
        <h1><?php echo $tarefasConcluida[0]['total_tarefas'] ?> tarefa(s) concluida(s)</h1>
        <div class="bar"><div style="width: <?php echo $width_concluida?>%;background-color: rgb(58, 168, 58);"></div></div>
    </div>
</section>