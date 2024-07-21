<!DOCTYPE html>
<html>

<head>
    <title>Tarefas</title>
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'reset.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'style.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'menu.css' ?>">
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
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Grupo</th>
                        <th>Categoria</th>
                        <th>Status</th>
                        <th>Data de Criação</th>
                        <th>Data de Finalização</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tarefas as $tarefa) : ?>
                        <tr>
                            <td><?php echo $tarefa['tarefa_nome']; ?></td>
                            <td><?php echo $tarefa['tarefa_descricao']; ?></td>
                            <td><?php echo $tarefa['grupo_nome']; ?></td>
                            <td><?php echo $tarefa['categoria_nome']; ?></td>
                            <td><?php echo $tarefa['status']; ?></td>
                            <td><?php echo $tarefa['data_criacao']; ?></td>
                            <td><?php echo $tarefa['data_finalizacao']; ?></td>
                            <td>
                                <form method="get" action="/tarefas/delete">
                                    <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                    <button type="submit">Deletar</button>
                                </form>
                            </td>
                            <td>
                                <form method="get" action="/tarefas/edit">
                                    <input type="hidden" name="tarefa_id" value="<?php echo $tarefa['tarefa_id']; ?>">
                                    <button type="submit">Editar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>