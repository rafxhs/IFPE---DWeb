<?php
require_once 'db.php';
require_once 'authenticate.php';

$stmt = $pdo->query("SELECT id, nome FROM funcionarios");
$funcionarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Obter todos os empréstimos para associar aos livros
$stmt = $pdo->query("SELECT * FROM clientes");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT * FROM livros");
$livros = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $cliente_id = $_POST['cliente_id'];
    $funcionario_id = $_POST['funcionario_id'];
    $data_emprestimo = $_POST['data_emprestimo'];
    $data_devolucao = $_POST['data_devolucao'];
    $livro_id = $_POST['livro_id'];

    //Insere um novo empréstimo no banco de dados
    $stmt = $pdo->prepare("INSERT INTO emprestimos (cliente_id, funcionario_id, data_emprestimo, data_devolucao) VALUES (?, ?, ?, ?)");
    $stmt->execute([$cliente_id, $funcionario_id, $data_emprestimo, $data_devolucao]);

    header('Location: index-emprestimo.php');

    exit();

}
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>
        <div class="content-create">
            <div class="content-title1">            
                <h2 class="titulo-create">Registro de Empréstimo</h2>
            </div>
            <div class="content-form1">
                <!-- Formulário para adicionar um novo empréstimo--> 
                <form method="POST" enctype="multipart/form-data">
                    <div>
                        <label for="funcionario_id">Funcionário</label>
                        <select id="funcionario_id" name="funcionario_id" required>
                            <option value="">Selecione o funcionário</option>
                            <?php foreach ($funcionarios as $funcionario): ?>
                            <option value="<?= $funcionario['id'] ?>"><?= $funcionario['nome'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="cliente_id">Cliente</label>
                        <select id="cliente_id" name="cliente_id" required>
                            <option value="">Selecione o cliente cadastrado</option>
                        <?php foreach ($clientes as $cliente): ?>
                            <option value="<?= $cliente['id'] ?>"><?= $cliente['nome'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="livro_id">Adicionar Livro</label>
                        <select id="livro_id" name="livro_id" required>
                            <option value="">Selecione o livro</option>
                        <?php foreach ($livros as $livro): ?>
                            <option value="<?= $livro['id'] ?>"><?= $livro['titulo'] ?></option>
                        <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="campo">
                        <label for="data_emprestimo">Data do Empréstimo</label>
                        <input type="date" id="data_emprestimo" name="data_emprestimo" required>
                    </div>

                    <div class="campo">
                        <label for="data_devolucao">Data de Devolução</label>
                        <input type="date" id="data_devolucao" name="data_devolucao" required>
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
    <script src="JavaScript/index.js"></script>
</body>
</html>
