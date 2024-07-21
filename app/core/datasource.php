<?php

class DatasourceConnection
{
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
