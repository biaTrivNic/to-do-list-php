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
    grupos.nome AS grupo_nome,
    categorias.nome AS categoria_nome,
    tarefas.status,
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

<body>
    <div class="container">
        <?php require_once ROOT_DIR . DS . 'elements' . DS . 'menu.php'; ?>
        <div class="content">
            <?php require_once ROOT_DIR . DS . 'elements' . DS . 'header.php'; ?>
            <div class="tarefas-container">
                <table>
                    <thead>
                        <tr>
                            <th>Tarefa</th>
                            <th>Grupo</th>
                            <th>Categoria</th>
                            <th>
                                <p style="text-align: center;">Status</p>
                            </th>
                            <th>Fim</th>
                            <th></th>
                            <th></th>
                            <th>
                                <form class="btn-container" method="get" action="/tarefas/new">
                                    <input type="hidden" name="path" value="/tarefas">
                                    <button class="circle-btn new-btn" type="submit"><img src="/assets/img/circle-plus-solid.svg" alt=""> Nova</b>
                                </form>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php if(empty($tarefas)): ?>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Nenhuma tarefa encontrada</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    <?php else: ?>
                        <?php foreach ($tarefas as $tarefa) : ?>
                            <?php $dateTime = new DateTime($tarefa['data_finalizacao']);

                            $date = $dateTime->format('Y-m-d');

                            switch ($tarefa['status']) {
                                case "concluída":
                                    $class = "concluida";
                                    break;
                                case "em andamento":
                                    $class = "andamento";
                                    break;
                                case "pendente":
                                    $class = "pendente";
                                    break;
                            }

                            ?>
                            <tr>
                                <td><?php echo $tarefa['tarefa_nome']; ?></td>
                                <td><?php echo $tarefa['grupo_nome']; ?></td>
                                <td><?php echo $tarefa['categoria_nome']; ?></td>
                                <td>
                                    <div class="<?php echo $class ?>"><?php echo $tarefa['status']; ?></div>
                                </td>
                                <td><?php echo $date; ?></td>
                                <td>
                                    <form class="btn-container" method="get" action="/tarefas/edit">
                                        <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                        <input type="hidden" name="path" value="/tarefas">
                                        <button class="edit-btn" type="submit">Editar</button>
                                    </form>
                                </td>
                                <td>
                                    <form class="btn-container" method="get" action="/tarefas/done">
                                        <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                        <button class="circle-btn" type="submit"><img src="/assets/img/circle-check-regular.svg" alt=""></button>
                                    </form>
                                </td>
                                <td>
                                    <form class="btn-container" method="get" action="/tarefas/delete">
                                        <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                        <input type="hidden" name="path" value="/tarefas">
                                        <button class="circle-btn" type="submit"><img src="/assets/img/circle-xmark-regular.svg" alt=""></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>