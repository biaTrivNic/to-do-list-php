<?php

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $status = $_GET['status'] ?? 'pendente';

    $path = $_GET['path'];

    $sql = "SELECT nome AS grupo_nome, id AS grupo_id
    FROM 
    grupos;";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $grupos = $databaseHandler->getAllData($sql);


    $sql = "SELECT nome AS categoria_nome, id AS categoria_id
    FROM 
    categorias;";

    $categorias = $databaseHandler->getAllData($sql);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nome'];
    $grupo_id = $_POST['grupo_id'];
    $categoria_id = $_POST['categoria_id'];
    $status = $_POST['status'];
    $data_finalizacao = $_POST['data_finalizacao'];
    $path = $_POST['path'];

    $sql = "INSERT INTO tarefas (nome, grupo_id, categoria_id, status, data_finalizacao)
            VALUES ('$nome', $grupo_id, $categoria_id, '$status', '$data_finalizacao')";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->addTarefas($sql);

    header("Location: {$path}");
    exit();
}



?>

<!DOCTYPE html>
<html>

<head>
    <title>Inserir Tarefa</title>
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'reset.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'style.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'menu.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'header.css' ?>">
    <link rel="stylesheet" href="<?php echo '..' . DS . 'style' . DS . 'add.css' ?>">
</head>

<body>
    <div class="container">
        <?php require_once ROOT_DIR . DS . 'elements' . DS . 'menu.php'; ?>
        <div class="content">
            <?php require_once ROOT_DIR . DS . 'elements' . DS . 'header.php'; ?>
            <div class="form-board">
                <div>
                    <h1>NOVA TAREFA</h1>
                    <form action="new" method="POST">
                        <input type="hidden" id="path" name="path" value="<?php echo $path; ?>">

                        <label for="nome">Nome da Tarefa:</label><br>
                        <input type="text" id="nome" name="nome" required><br><br>

                        <label for="grupo_id">Grupo:</label><br>
                        <select id="grupo_id" name="grupo_id">
                            <?php foreach ($grupos as $grupo) : ?>
                                <option value="<?php echo $grupo['grupo_id'] ?>"><?php echo $grupo['grupo_nome'] ?></option>
                            <?php endforeach; ?>
                        </select><br><br>

                        <label for="categoria_id">Categoria:</label><br>
                        <select id="categoria_id" name="categoria_id">
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?php echo $categoria['categoria_id'] ?>"><?php echo $categoria['categoria_nome'] ?></option>
                            <?php endforeach; ?>
                        </select><br><br>

                        <label for="status">Status:</label><br>
                        <select id="status" name="status" required>
                            <option <?php if ($status == "pendente") echo "selected" ?> value="pendente">Pendente</option>
                            <option <?php if ($status == "em andamento") echo "selected" ?> value="em andamento">Em Andamento</option>
                            <option <?php if ($status == "concluída") echo "selected" ?> value="concluída">Concluída</option>
                        </select><br><br>

                        <label for="data_finalizacao">Data de Finalização:</label><br>
                        <input type="datetime-local" id="data_finalizacao" name="data_finalizacao" required><br><br>

                        <input type="submit" value="Adicionar Tarefa">
                    </form>
                </div>
                <div class="forms-container">
                    <div class="add-outros">
                        <button class="circle-btn add-btn"><img src="/assets/img/circle-plus-solid.svg" alt="">
                            <h2> Adicionar Categoria</h2>
                        </button>
                        <form action="/categorias/new" method="POST" class="add-card hide">
                            <input type="hidden" name="status" value="<?php echo $status; ?>">
                            <input type="hidden" id="path" name="path" value="<?php echo $path; ?>">
                            <label for="nome">Nome da Categoria:</label><br>
                            <input type="text" id="nome_categoria" name="nome_categoria" required><br><br>

                            <input type="submit" value="Adicionar Categoria">
                        </form>
                    </div>
                    <div class="add-outros">
                        <button class="circle-btn add-btn"><img src="/assets/img/circle-plus-solid.svg" alt="">
                            <h2> Adicionar Grupo</h2>
                        </button>
                        <form action="/grupos/new" method="POST" class="add-card hide">
                            <input type="hidden" name="status" value="<?php echo $status; ?>">
                            <input type="hidden" id="path" name="path" value="<?php echo $path; ?>">
                            <label for="nome">Nome do Grupo:</label><br>
                            <input type="text" id="nome_grupo" name="nome_grupo" required><br><br>

                            <input type="submit" value="Adicionar Grupo">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    const btn = document.querySelectorAll('.add-btn');
    const icon = document.querySelectorAll('.add-btn img');
    const form = document.querySelectorAll('.add-card');

    for (let i = 0; i < btn.length; i++) {
        btn[i].addEventListener('click', () => {
            form[i].classList.toggle('hide');
            if (icon[i].src.includes('circle-plus-solid.svg')) {
                icon[i].src = '/assets/img/circle-minus-solid.svg';
            } else {
                icon[i].src = '/assets/img/circle-plus-solid.svg';
            }
        })
    }
</script>