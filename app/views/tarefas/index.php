<!DOCTYPE html>
<html>

<head>
    <title>Tarefas</title>
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'reset.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'style.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'menu.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'header.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'tarefas.css' ?>">
</head>

<?php //require_once ROOT_DIR . DS . 'elements' . DS . 'time.php'; 
?>
<?php //require_once ROOT_DIR . DS . 'elements' . DS . 'preview.php'; 
?>

<?php

$sql = "SELECT 
    tarefas.id AS tarefa_id,
    tarefas.nome AS tarefa_nome,
    tarefas.descricao AS tarefa_descricao,
    grupos.nome AS grupo_nome,
    categorias.nome AS categoria_nome,
    tarefas.status,
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

<body>
    <div class="container">
        <?php require_once ROOT_DIR . DS . 'elements' . DS . 'menu.php'; ?>
        <div class="content">
            <?php require_once ROOT_DIR . DS . 'elements' . DS . 'header.php'; ?>
            <div class="tarefas-container">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Grupo</th>
                            <th>Categoria</th>
                            <th>Status</th>
                            <th>Fim</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tarefas as $tarefa) : ?>
                            <?php $dateTime = new DateTime($tarefa['data_finalizacao']);

                            $date = $dateTime->format('Y-m-d'); ?>
                            <tr>
                                <td><?php echo $tarefa['tarefa_nome']; ?></td>
                                <td><?php echo $tarefa['tarefa_descricao']; ?></td>
                                <td><?php echo $tarefa['grupo_nome']; ?></td>
                                <td><?php echo $tarefa['categoria_nome']; ?></td>
                                <td><?php echo $tarefa['status']; ?></td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <form class="btn-container" method="get" action="/tarefas/edit">
                                        <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                        <button class="edit-btn" type="submit">Editar</button>
                                    </form>
                                </td>
                                <td>
                                    <form class="btn-container" method="get" action="/tarefas/delete">
                                        <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                        <button class="delete-btn" type="submit"><img src="/assets/img/circle-xmark-regular.svg" alt=""></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>