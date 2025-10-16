<?php
session_start();
require_once 'config/database.php';

$mensagem = '';

// Se o usuário já estiver logado, redireciona para a página principal
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Processar o formulário de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $senha = $_POST['senha'] ?? '';
    
    if (empty($username) || empty($senha)) {
        $mensagem = 'Por favor, preencha todos os campos.';
    } else {
        // Verificar credenciais
        $stmt = $pdo->prepare("SELECT id, username, senha, saldo FROM usuarios WHERE username = ? OR email = ?");
        $stmt->execute([$username, $username]);
        $usuario = $stmt->fetch();
        
        if ($usuario && password_verify($senha, $usuario['senha'])) {
            // Login bem-sucedido
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];
            $_SESSION['saldo'] = $usuario['saldo'];
            
            header('Location: index.php');
            exit;
        } else {
            $mensagem = 'Credenciais inválidas. Tente novamente.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PG Slots</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>PG Slots - Tigrinho</h1>
        </header>

        <main>
            <div class="form-container">
                <h2>Login</h2>
                
                <?php if (!empty($mensagem)): ?>
                    <div class="mensagem erro"><?php echo htmlspecialchars($mensagem); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Nome de Usuário ou Email</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Entrar</button>
                </form>
                
                <div class="form-footer">
                    <p>Não tem uma conta? <a href="registro.php">Registre-se</a></p>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; 2023 PG Slots - Tigrinho. Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>