<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $genero = $_POST['genero'];
    $editora = $_POST['editora'];
    $paginas = $_POST['paginas'];

    // Verificar se foi enviada uma nova imagem
    if (!empty($_FILES['imagem']['name'])) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $novoNome = uniqid() . '.' . $extensao;
        $caminho = __DIR__ . '/../storage/' . $novoNome;

        // Mover o arquivo para a pasta storage
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho)) {
            // Inserir o caminho da nova imagem na tabela imagens
            $stmt = $pdo->prepare("INSERT INTO imagens (path) VALUES (?)");
            $stmt->execute([$novoNome]);
            $imagem_id = $pdo->lastInsertId();
        }
    } else {
        $imagem_id = null;
    }

    // Prepara a instrução SQL para inserir um novo livro no banco de dados
    $stmt = $pdo->prepare("INSERT INTO livros (titulo, autor, ano, genero, editora, paginas, imagem_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$titulo, $autor, $ano, $genero, $editora, $paginas, $imagem_id]);

    // Redireciona para a página de listagem de livros após a inserção
    header('Location: index-livro.php');
    exit();
}
?>

<?php include_once 'head.php';?>
<body id="create-page">
    <?php include_once 'header.php';?>

    <main>
        <div class="content-create">
            <div class="content-title1">            
                <h2 class="titulo-create">Adicionar Livro</h2>
            </div>
            <div class="content-form1">
                <!-- Formulário para adicionar um novo livro --> 
                <form method="POST" enctype="multipart/form-data">

                    <div class="campo-item">
                        <div class="campo">
                            <label for="titulo">Título</label>
                            <!-- Campo para inserir o título do livro -->
                            <input type="text" id="titulo" name="titulo" placeholder="título" required> <!-- o atributo required, torna o input obrigatório -->
                        </div>
                    
                        <div class="campo">
                            <label for="autor">Autor</label>
                            <!-- Campo para inserir o autor do livro -->
                            <input type="text" id="autor" name="autor" required>
                        </div>
                    </div>

                    <div>
                        <div class="campo">
                            <label for="ano">Ano</label>
                            <!-- Campo para inserir o/a ano/data de lançamento do livro -->
                            <input type="date" id="ano" name="ano" required>
                        </div>
                    
                        <div class="campo">
                            <label for="genero">Gênero</label>
                            <!-- Campo para inserir o gênero do livro -->
                            <input type="text" id="genero" name="genero" required>
                        </div>
                    </div>

                    <div>
                        <div class="campo">
                            <label for="editora">Editora</label>
                            <!-- Campo para inserir a editora do livro -->
                            <input type="text" id="editora" name="editora" required>
                        </div>
                    
                        <div class="campo">
                            <label for="paginas">Páginas</label>
                            <!-- Campo para inserir a quantidade de páginas do livro -->
                            <input type="number" id="paginas" name="paginas" required>
                        </div>
                    </div>

                    <div class="campo">
                        <label for="imagem">Capa do livro</label>
                        <!-- Campo para inserir a capa do livro -->
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                    </div>
                    
                    <div class="campo">
                        <!-- Botão para submeter o formulário -->
                        <button class="botao1" type="submit">Adicionar</button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <?php include_once 'footer.php';?>
    <script src="../JavaScript/index.js"></script>
</body>
</html>
