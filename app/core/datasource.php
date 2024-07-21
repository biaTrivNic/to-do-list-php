<?php

class DatasourceConnection
{
    protected $conn;

    public function __construct($config)
    {
        $this->conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);

    }
}
