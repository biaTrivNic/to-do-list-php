<?php

$sql = "SELECT 
    tarefas.id AS tarefa_id,
    tarefas.nome AS tarefa_nome,
    grupos.nome AS grupo_nome,
    categorias.nome AS categoria_nome,
    tarefas.status AS tarefa_status,
    tarefas.data_finalizacao
    FROM 
        tarefas
    LEFT JOIN 
        grupos ON tarefas.grupo_id = grupos.id
    LEFT JOIN 
        categorias ON tarefas.categoria_id = categorias.id;";

$config = Config::getConfig();
$databaseHandler = new DatabaseHandler($config);
$tarefas = $databaseHandler->getAllData($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kanban - Tarefas</title>
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'reset.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'style.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'menu.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'header.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'kanban.css' ?>">
</head>

<body>
    <div class="container">
        <?php require_once ROOT_DIR . DS . 'elements' . DS . 'menu.php'; ?>

        <div class="content">
            <?php require_once ROOT_DIR . DS . 'elements' . DS . 'header.php'; ?>
            <div class="kanban-board">
                <div class="kanban-column" id="todo">
                    <h2>Pendente</h2>
                    <div class="kanban-cards" id="todo-cards">
                        <?php if (empty($tarefas)) : ?>
                            <div class="card">
                                <p>Nenhuma tarefa pendente</p>
                            </div>
                        <?php else : ?>
                            <?php foreach ($tarefas as $tarefa) : ?>
                                <?php if ($tarefa['tarefa_status'] == "pendente") : ?>
                                    <div class="card">
                                        <h3><?php echo $tarefa['tarefa_nome']; ?></h3>
                                        <p><?php echo $tarefa['categoria_nome']; ?></p>
                                        <form method="get" action="/tarefas/edit">
                                            <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                            <input type="hidden" name="path" value="/tarefas/kanban">
                                            <button class="edit-btn" type="submit">Editar</button>
                                        </form>
                                        <form class="btn-container" method="get" action="/tarefas/delete">
                                            <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                            <input type="hidden" name="path" value="/tarefas/kanban">
                                            <button class="circle-btn" id="delete-btn" type="submit"><img src="/assets/img/circle-xmark-regular.svg" alt=""></button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <form id="add-btn-pendente" class="add-btn" method="get" action="/tarefas/new">
                            <input type="hidden" name="path" value="/tarefas/kanban">
                            <input type="hidden" name="status" value="pendente">
                            <button class="circle-btn" id="delete-btn" type="submit">+</button>
                        </form>
                    </div>
                </div>
                <div class="kanban-column" id="in-progress">
                    <h2>Em andamento</h2>
                    <div class="kanban-cards" id="in-progress-cards">
                        <?php if (empty($tarefas)) : ?>
                            <div class="card">
                                <p>Nenhuma tarefa em andamento</p>
                            </div>
                        <?php else : ?>
                            <?php foreach ($tarefas as $tarefa) : ?>
                                <?php if ($tarefa['tarefa_status'] == "em andamento") : ?>
                                    <div class="card">
                                        <h3><?php echo $tarefa['tarefa_nome']; ?></h3>
                                        <p><?php echo $tarefa['categoria_nome']; ?></p>
                                        <form method="get" action="/tarefas/edit">
                                            <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                            <input type="hidden" name="path" value="/tarefas/kanban">
                                            <button class="edit-btn" type="submit">Editar</button>
                                        </form>
                                        <form class="btn-container" method="get" action="/tarefas/delete">
                                            <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                            <input type="hidden" name="path" value="/tarefas/kanban">
                                            <button class="circle-btn" id="delete-btn" type="submit"><img src="/assets/img/circle-xmark-regular.svg" alt=""></button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <form id="add-btn-andamento" class="add-btn" method="get" action="/tarefas/new">
                            <input type="hidden" name="path" value="/tarefas/kanban">
                            <input type="hidden" name="status" value="em andamento">
                            <button class="circle-btn" id="delete-btn" type="submit">+</button>
                        </form>
                    </div>
                </div>
                <div class="kanban-column" id="done">
                    <h2>Concluído</h2>
                    <div class="kanban-cards" id="done-cards">
                        <?php if (empty($tarefas)) : ?>
                            <div class="card">
                                <p>Nenhuma tarefa concluída</p>
                            </div>
                        <?php else : ?>
                            <?php foreach ($tarefas as $tarefa) : ?>
                                <?php if ($tarefa['tarefa_status'] == "concluída") : ?>
                                    <div class="card">
                                        <h3><?php echo $tarefa['tarefa_nome']; ?></h3>
                                        <p><?php echo $tarefa['categoria_nome']; ?></p>
                                        <form method="get" action="/tarefas/edit">
                                            <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                            <input type="hidden" name="path" value="/tarefas/kanban">
                                            <button class="edit-btn" type="submit">Editar</button>
                                        </form>
                                        <form class="btn-container" method="get" action="/tarefas/delete">
                                            <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                            <input type="hidden" name="path" value="/tarefas/kanban">
                                            <button class="circle-btn" id="delete-btn" type="submit"><img src="/assets/img/circle-xmark-regular.svg" alt=""></button>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <form id="add-btn-concluido" class="add-btn" method="get" action="/tarefas/new">
                            <input type="hidden" name="path" value="/tarefas/kanban">
                            <input type="hidden" name="status" value="concluída">
                            <button class="circle-btn" id="delete-btn" type="submit">+</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>