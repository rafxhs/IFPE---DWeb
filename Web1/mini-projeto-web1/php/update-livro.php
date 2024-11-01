<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM livros WHERE id = ?");

$stmt->execute([$id]);

$livro = $stmt->fetch(PDO::FETCH_ASSOC);

$imagem_path = '';
if (isset($livro['imagem_id'])) {
    $stmt = $pdo->prepare("SELECT path FROM imagens WHERE id = ?");
    $stmt->execute([$livro['imagem_id']]);
    $imagem = $stmt->fetch(PDO::FETCH_ASSOC);
    $imagem_path = $imagem ? '/../storage/' . $imagem['path'] : '';
}

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtém os dados enviados pelo formulário
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $ano = $_POST['ano'];
    $genero = $_POST['genero'];
    $editora = $_POST['editora'];
    $paginas = $_POST['paginas'];
    $imagem_id = $livro['imagem_id'];

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

    // Prepara a instrução SQL para atualizar os dados do livro
    $stmt = $pdo->prepare("UPDATE livros SET titulo = ?, autor = ?, ano = ?, genero = ?, editora = ?, paginas = ?, imagem_id = ? WHERE id = ?");
    
    // Executa a instrução SQL com os novos dados do formulário
    $stmt->execute([$titulo, $autor, $ano, $genero, $editora, $paginas, $imagem_id, $id]);
    
    // Redireciona para a página de listagem de livros após a atualização
    header('Location: index-livro.php');
}
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>
    <div class="content-update">
            <div class="content-title2">            
                <h2 class="titulo-update">Editar Livro</h2>
            </div>
            <div class="content-form2">
                <!-- Formulário para editar os dados do livro -->
                <form method="POST">

                    <div class="campo">
                        <label for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" value="<?= $livro["titulo"] ?>" required> <!-- o atributo required, torna o input obrigatório -->
                    </div>
                    
                    <div class="campo">
                        <label for="autor">Autor</label>
                        <input type="text" id="autor" name="autor" value="<?= $livro["autor"] ?>" required>
                    </div>

                    <div class="campo">
                        <label for="ano">Ano</label>
                        <input type="date" id="ano" name="ano" value="<?= $livro["ano"] ?>" required>
                    </div>

                    <div class="campo">
                        <label for="genero">Gênero</label>
                        <input type="text" id="genero" name="genero" value="<?= $livro["genero"] ?>" required>
                    </div>

                    <div class="campo">
                        <label for="editora">Editora</label>
                        <input type="text" id="editora" name="editora" value="<?= $livro["editora"] ?>" required>
                    </div>

                    <div class="campo">
                        <label for="paginas">Páginas</label>
                        <input type="number" id="paginas" name="paginas" value="<?= $livro["paginas"] ?>" required>
                    </div>

                    <div class="campo">
                        <label for="imagem">Capa do livro</label>
                        <input type="file" id="imagem" name="imagem" accept="image/*">
                        <?php if ($imagem_path): ?>
                            <div class="imagem-atual">
                                <img src="<?= htmlspecialchars($imagem_path) ?>" alt="Imagem atual" style="max-width: 200px; max-height: 200px;">
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="campo">
                        <button class="botao2" type="submit">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include_once 'footer.php';?>
    <script src="../JavaScript/index.js"></script>
</body>
</html>
