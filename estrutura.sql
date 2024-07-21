CREATE TABLE tarefas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT,
    grupo_id INT NOT NULL,
    categoria_id INT NOT NULL,
    status ENUM('pendente', 'em andamento', 'concluída') NOT NULL DEFAULT 'pendente',
    data_criacao DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    data_finalizacao TIMESTAMP NULL
);

CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

CREATE TABLE grupos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    descricao TEXT
);

INSERT INTO tarefas (nome, descricao, grupo_id, categoria_id, status, data_criacao, data_finalizacao)
VALUES 
('Tarefa 1', 'Descrição da tarefa 1', 1, 1, 'pendente', CURRENT_TIMESTAMP, NULL),
('Tarefa 2', 'Descrição da tarefa 2', 1, 2, 'em andamento', CURRENT_TIMESTAMP, NULL),
('Tarefa 3', 'Descrição da tarefa 3', 2, 1, 'concluída', CURRENT_TIMESTAMP, '2024-07-16 10:00:00'),
('Tarefa 4', 'Descrição da tarefa 4', 2, 3, 'pendente', CURRENT_TIMESTAMP, NULL),
('Tarefa 5', 'Descrição da tarefa 5', 3, 2, 'em andamento', CURRENT_TIMESTAMP, NULL),
('Tarefa 6', 'Descrição da tarefa 6', 3, 3, 'concluída', CURRENT_TIMESTAMP, '2024-07-17 15:30:00');

INSERT INTO categorias (nome)
VALUES 
('Desenvolvimento'),
('Design'),
('Marketing'),
('Vendas'),
('Suporte');

INSERT INTO grupos (nome, descricao)
VALUES 
('Grupo A', 'Grupo focado em projetos de desenvolvimento de software'),
('Grupo B', 'Grupo dedicado ao design gráfico e UI/UX'),
('Grupo C', 'Grupo responsável por campanhas de marketing digital'),
('Grupo D', 'Grupo especializado em estratégias de vendas'),
('Grupo E', 'Grupo que oferece suporte ao cliente e pós-venda');
