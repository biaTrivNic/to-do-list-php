<?php

$sql = "SELECT 
    tarefas.id AS tarefa_id,
    tarefas.nome AS tarefa_nome,
    tarefas.descricao AS tarefa_descricao,
    grupos.nome AS grupo_nome,
    categorias.nome AS categoria_nome,
    tarefas.status AS tarefa_status,
    tarefas.data_criacao,
    tarefas.data_finalizacao
    FROM 
        tarefas
    LEFT JOIN 
        grupos ON tarefas.grupo_id = grupos.id
    LEFT JOIN 
        categorias ON tarefas.categoria_id = categorias.id;";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$tarefas = $databaseHandler->getAllTarefas($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban - Tarefas</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="kanban-board">
        <div class="kanban-column" id="todo">
            <h2>To Do</h2>
            <div class="kanban-cards" id="todo-cards">
                <?php foreach ($tarefas as $tarefa) : ?>
                    <?php if ($tarefa['tarefa_status'] == "pendente") : ?>
                        <tr>
                            <td><?php echo $tarefa['tarefa_nome']; ?></td>
                            <td><?php echo $tarefa['categoria_nome']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="kanban-column" id="in-progress">
            <h2>In Progress</h2>
            <div class="kanban-cards" id="in-progress-cards">
                <?php foreach ($tarefas as $tarefa) : ?>
                    <?php if ($tarefa['tarefa_status'] == "em andamento") : ?>
                        <tr>
                            <td><?php echo $tarefa['tarefa_nome']; ?></td>
                            <td><?php echo $tarefa['categoria_nome']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="kanban-column" id="done">
            <h2>Done</h2>
            <div class="kanban-cards" id="done-cards">
                <?php foreach ($tarefas as $tarefa) : ?>
                    <?php if ($tarefa['tarefa_status'] == "concluída") : ?>
                        <tr>
                            <td><?php echo $tarefa['tarefa_nome']; ?></td>
                            <td><?php echo $tarefa['categoria_nome']; ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>

            </div>
        </div>
    </div>

</body>

</html>