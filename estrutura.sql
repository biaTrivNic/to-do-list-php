CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    grupo_id INT NOT NULL,
    categoria_id INT NOT NULL,
    status ENUM('pendente', 'em andamento', 'concluída') NOT NULL DEFAULT 'pendente',
    data_finalizacao DATETIME NULL
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE grupos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

INSERT INTO categorias (nome) VALUES ('Sem Categoria');

INSERT INTO grupos (nome) VALUES ('Sem Grupo');

