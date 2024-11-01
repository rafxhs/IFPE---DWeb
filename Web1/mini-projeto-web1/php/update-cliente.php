<?php
// Inclui o arquivo de conexão com o banco de dados
require_once 'db.php';
require_once 'authenticate.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM clientes WHERE id = ?");

$stmt->execute([$id]);

// Recupera os dados do cliente como um array associativo
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

// Verifica se o formulário foi submetido através do método POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    $stmt = $pdo->prepare("UPDATE clientes SET nome = ?, cpf = ?, email = ?, data_nascimento = ? WHERE id = ?");
    
    $stmt->execute([$nome, $cpf, $email, $data_nascimento, $id]);
    
    header('Location: index-cliente.php');
}
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>
        <div class="content-create">
            <div class="content-title1">            
                <h2 class="titulo-create">Editar Cliente</h2>
            </div>
            <div class="content-form1">
                <!-- Formulário para editar os dados do cliente -->
                <form method="POST" enctype="multipart/form-data">

                    <div class="campo">
                        <label for="nome">Nome</label>
                        <input type="text" id="nome" name="nome" value="<?= $cliente["nome"] ?>" required> <!-- o atributo required, torna o input obrigatório -->
                    </div>

                    <div class="campo">
                        <label for="cpf">CPF</label>
                        <input type="text" id="cpf" name="cpf" value="<?= $cliente["cpf"] ?>" required>
                    </div>
                    
                    <div class="campo">
                        <label for="email">E-mail</label>
                        <input type="text" id="email" name="email" value="<?= $cliente["email"] ?>" required>
                    </div>

                    <div class="campo">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" value="<?= $cliente["data_nascimento"] ?>" required>
                    </div>
                    
                    <div class="campo">
                        <button class="botao1" type="submit">Atualizar</button>
                    </div>

                </form>
            </div>
        </div>
    </main>

    <?php include_once 'footer.php';?>
    <script src="../JavaScript/index.js"></script>
</body>
</html>
