USE biblioteca;

-- Criação de usuários para funcionários
INSERT INTO usuarios (username, password) VALUES
('rafaelaneves', '$2y$10$dMEM0XJ6xijr7r0G7OpYWOkNEjmJ.5Uvh0MJiS2GVmDZGoK8PMYD2'),

-- Criação de funcionários
INSERT INTO funcionarios (nome, cpf, cargo, usuario_id) VALUES
('Rafaela Neves', 72748876539, 'Bibliotecária', 1),


-- Criação de livros
INSERT INTO livros (titulo, autor, ano, genero, editora, paginas, imagem_id) VALUES
('O Senhor dos Anéis', 'J. R. R. Tolkien', '1954-07-29', 'Ficção, Fantasia', 'Allen & Unwin', 576, 1);

-- Criação de emprestimos
INSERT INTO emprestimos (cliente_id, funcionario_id, data_emprestimo, data_devolucao) VALUES
(1, 3, '2024-09-01', '2024-09-05'),
(2, 1, '2024-09-02', '2024-09-06'),
(3, 3, '2024-09-03', '2024-09-07'),
(4, 2, '2024-09-04', '2024-09-08');

-- Inserir a imagem padrão na tabela imagens
INSERT INTO imagens (path) VALUES ('profile.jpg', 'biblioteca.jpeg', 'éassimqueacaba.jpg', '');

-- Criação de livros emprestados
INSERT INTO livro_emprestado (emprestimo_id, livro_id) VALUES
(1, 1), (1, 2), (2, 1), (2, 3), (3, 1);