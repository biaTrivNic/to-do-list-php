<?php

class DatabaseHandler extends DatasourceConnection
{
    public function __construct($config)
    {
        parent::__construct($config);
    }

    public function getAllData($sql)
    {
        $result = $this->conn->query($sql);

        $tarefas = [];

        if (!empty($result->num_rows)) {
            while ($row = $result->fetch_assoc()) {
                $tarefas[] = $row;
            }

            return $tarefas;
        }

    }
    public function getTarefa($sql)
    {
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }
    public function addTarefas($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    public function deleteTarefas($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->conn->error;
        }
    }
    public function editTarefas($sql)
    {
        if ($this->conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->conn->error;
        }
    }
    public function countTarefas($sql)
    {
        $result = $this->conn->query($sql);

        $tarefas = [];

        if (!empty($result->num_rows)) {
            while ($row = $result->fetch_assoc()) {
                $tarefas[] = $row;
            }

            return $tarefas;
        }

    }
}
