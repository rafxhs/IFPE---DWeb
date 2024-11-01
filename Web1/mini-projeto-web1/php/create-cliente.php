<?php
require_once 'db.php';
require_once 'authenticate.php';

$stmt = $pdo->query("SELECT nome, cpf, email, data_nascimento FROM clientes");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $email = $_POST['email'];
    $data_nascimento = $_POST['data_nascimento'];

    // Insere o novo cliente no banco de dados
    $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf, email, data_nascimento) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nome, $cpf, $email, $data_nascimento]);

    header('Location: index-cliente.php');
}
?>

<?php include_once 'head.php';?>
<body>
    <?php include_once 'header.php';?>

    <main>
        <div class="content-create">
            <div class="content-title1">            
                <h2 class="titulo-create">Adicionar Cliente</h2>
            </div>
            <div class="content-form1">
                <!-- Formulário para adicionar um novo cliente--> 
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
                        <label for="email">E-mail</label>
                        <input type="text" id="email" name="email" required>
                    </div>

                    <div class="campo">
                        <label for="data_nascimento">Data de Nascimento</label>
                        <input type="date" id="data_nascimento" name="data_nascimento" required>
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
