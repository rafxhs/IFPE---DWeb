CREATE DATABASE biblioteca;

USE biblioteca;

-- Criar a tabela de usuários
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Criar a tabela de imagens
CREATE TABLE imagens (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    path VARCHAR(255) NOT NULL
);

-- Criar a tabela de livros
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    autor VARCHAR(100) NOT NULL,
    ano DATE NOT NULL,
    genero VARCHAR(50) NOT NULL,
    editora VARCHAR(50) NOT NULL,
    paginas DECIMAL NULL,
    imagem_id INT,
    FOREIGN KEY (imagem_id) REFERENCES imagens(id) ON DELETE SET NULL
);

-- Criar a tabela de funcionários
CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    cargo VARCHAR(30) NOT NULL,
    usuario_id INT,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE SET NULL
);

-- Criar a tabela de clientes
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    email VARCHAR(100) NOT NULL,
    data_nascimento DATE NOT NULL
);

-- Criar a tabela de empréstimos
CREATE TABLE emprestimos (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    cliente_id INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    funcionario_id INT NOT NULL,
    FOREIGN KEY (funcionario_id) REFERENCES funcionarios(id) ON DELETE CASCADE,
    data_emprestimo DATE NOT NULL,
    data_devolucao DATE
);


-- Criar a tabela a partir da relação n:n entre a tabela emprestimos e livros
CREATE TABLE livros_emprestados (
	
	emprestimo_id INT NOT NULL,
	livro_id INT NOT NULL,
	PRIMARY KEY (emprestimo_id, livro_id),
	CONSTRAINT
		FOREIGN KEY (emprestimo_id) 
		REFERENCES emprestimos(id) ON DELETE CASCADE,
	CONSTRAINT
    		FOREIGN KEY (livro_id) 
		REFERENCES livros(id) ON DELETE CASCADE
	
);