<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Criptografa a senha

    // Verifica se o nome de usuário já existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->rowCount() > 0) {
        echo "Nome de usuário já existe!";
    } else {
        // Insere o novo usuário no banco de dados
        $stmt = $pdo->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $password])) {
            echo "Usuário registrado com sucesso!";
            header('Location: user-register.php');
        } else {
            echo "Erro ao registrar usuário.";
        }
    }
}
?>

<?php include_once 'head.php'; ?>
<body>
    <header>
    
        <nav id="navbar">
            <div class="container">
                <a class="navbar-brand" href="../index.php">
                    <i class="fa-solid fa-book-open" id="nav_logo"> Biblioteca Dream</i>
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
        </nav>

</header>
    <main class="main-register">
        <div class="content-register">
            <div class="content-register-title1">            
                <h2 class="titulo-register">Criar conta</h2>
            </div>
            <div class="content-elements-register">
                <form class="form-register" method="POST">
                    <div class="campo-register">
                        <label for="username">Nome de Usuário</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="campo-register">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="campo-register">
                        <button class="botao-register" type="submit">Cadastre-se</button>
                    </div>
                    <div class="campo-register">
                        <p>Já tem uma conta? <a href="user-login.php">Fazer Login</a></p>
                    </div>
                </form>

              
            </div>
        </div>
    </main>
    <?php include_once 'footer.php'; ?>
    <script src="JavaScript/index.js"></script>
</body>
</html>
