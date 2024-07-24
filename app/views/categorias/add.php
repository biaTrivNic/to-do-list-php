<h1>add categoria</h1>

<?php 

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $categoria_nome = $_GET['nome_categoria'];

    $sql = "INSERT INTO categorias (nome)
            VALUES ('$categoria_nome')";

    $config = Config::getConfig();
    $databaseHandler = new DatabaseHandler($config);
    $databaseHandler->addTarefas($sql);

    header("Location: /tarefas/new");
    exit();
}
