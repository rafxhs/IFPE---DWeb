<?php
require_once 'db.php';
require_once 'authenticate.php';

// Obter todos os usuários para associar ao funcionários
$stmt = $pdo->query("SELECT id, username FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $usuario_id = $_POST['usuario_id'];

    // Insere o novo funcionário no banco de dados
    $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, cpf, cargo, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $cpf, $cargo, $usuario_id]);

    header('Location: index-funcionario.php');
}
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>
        <div class="content-create">
            <div class="content-title1">            
                <h2 class="titulo-create">Adicionar Funcionário</h2>
            </div>
            <div class="content-form1">
                <!-- Formulário para adicionar um novo funcionário--> 
                <form method="POST" enctype="multipart/form-data">

                    <div class="campo">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" required> <!-- o atributo required, torna o input obrigatório -->
                    </div>

                    <div class="campo">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" required>
                    </div>
                    
                    <div class="campo">
                        <label for="cargo">Cargo</label>
                        <select name="cargo" id="cargo">
                            <option value="Bibliotecário(a)" selected>Bibliotecário(a)</option>
                            <option value="Estagiário(a)">Estagiário(a)</option>
                        </select>
                    </div>

                    <div>
                        <label for="usuario_id">Funcionário</label>
                        <select id="usuario_id" name="usuario_id" required>
                            <option value="">Selecione o funcionário</option>
                            <?php foreach ($usuarios as $usuario): ?>
                            <option value="<?= $usuario['id'] ?>"><?= $usuario['username'] ?></option>
                            <?php endforeach; ?>
                        </select>
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
