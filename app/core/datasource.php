<?php

// $datasource = array(
//     'servername' => 'localhost',
//     'username' => 'root',
//     'password' => '1Sol1Lua@',
//     'dbname' => 'to_do_list'
// );

// class DatasourceConnection
// {
//     public function __construct($datasource)
//     {

//         $conn = new mysqli($datasource['servername'], $datasource['username'], $datasource['password'], $datasource['dbname']);

//         if ($conn->connect_error) {
//             die("Conexão falhou: " . $conn->connect_error);
//         }

//         echo "Conectado com sucesso";

//         $sql = "SELECT nome, descricao, status, data_finalizacao FROM tarefas";
//         $result = $conn->query($sql);

//         if (!empty($result->num_rows)) {
//             while ($row = $result->fetch_assoc()) {
//                 echo "id: " . $row["nome"] .$row["descricao"] .$row["status"].$row["data_finalizacao"] . "<br>";
//             }
//         } else {
//             echo "0 results";
//         }

//         $conn->close();
//     }
// }

// new DatasourceConnection($datasource);

class DatasourceConnection
{
    // $config = Config::getConfig();
    protected $conn;

    public function __construct($config)
    {
        $this->conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }

        echo "Conectado com sucesso";
    }
}
