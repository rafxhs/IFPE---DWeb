<?php
require_once 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verifica se o nome de usuário existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se a senha está correta
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header('Location: /index.php');
    } else {
        
        echo "Nome de usuário ou senha incorretos!";
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
    <main class="main-login">
        <div class="content-login">
            <div class="content-login-title1">            
                <h2 class="titulo-login">Seja bem-vindo(a) de volta!</h2>
            </div>
            <div class="content-elements-login">
                <form class="form-login" method="POST">
                    <div class="campo-login">
                        <label for="username">Usuário</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="campo-login">
                        <label for="password">Senha</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="campo-login">
                        <button class="botao-login" type="submit">Entrar</button>
                    </div>
                    <div class="campo-register">
                        <p>Não tem uma conta? <a href="user-register.php">Cadastre-se</a></p>
                    </div>
                </form>

              
            </div>
        </div>
    </main>

    <?php include_once 'footer.php'; ?>
    <script src="JavaScript/index.js"></script>
</body>
</html>
