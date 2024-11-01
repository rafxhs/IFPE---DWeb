<?php
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];


$stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE id = ?");
$stmt->execute([$id]);
$funcionario = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $pdo->query("SELECT id, username FROM usuarios");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $cargo = $_POST['cargo'];
    $usuario_id = $_POST['usuario_id'];

    $stmt = $pdo->prepare("UPDATE funcionarios SET nome = ?, cpf = ?, cargo = ?, usuario_id = ? WHERE id = ?");
    $stmt->execute(params: [$nome, $cpf, $cargo, $usuario_id, $id]);

    // Pega as opções de cargo do formulário
    $cargos = [
    'opcao1' => 'Bibliotecário(a)',
    'opcao2' => 'Estagiário(a)'
];

    header('Location: index-funcionario.php?id=' . $id);
}
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>
    <main>
        <div class="content-create">
            <div class="content-title1">            
                <h2 class="titulo-create">Editar Funcionários</h2>
            </div>
            <div class="content-form1">
                <!-- Formulário para editar os dados do funcionario -->
                <form method="POST" enctype="multipart/form-data">

                    <div class="campo">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" value="<?= $funcionario["nome"] ?>" required> <!-- o atributo required, torna o input obrigatório -->
                    </div>

                    <div class="campo">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" value="<?= $funcionario["cpf"] ?>" required>
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
                        <button class="botao1" type="submit">Atualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <?php include_once 'footer.php';?>
</body>
