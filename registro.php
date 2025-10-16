<?php
session_start();
require_once 'config/database.php';

$mensagem = '';

// Se o usuário já estiver logado, redireciona para a página principal
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Processar o formulário de registro
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmar_senha = $_POST['confirmar_senha'] ?? '';
    
    // Validações básicas
    if (empty($username) || empty($email) || empty($senha)) {
        $mensagem = 'Todos os campos são obrigatórios.';
    } elseif ($senha !== $confirmar_senha) {
        $mensagem = 'As senhas não coincidem.';
    } elseif (strlen($senha) < 6) {
        $mensagem = 'A senha deve ter pelo menos 6 caracteres.';
    } else {
        // Verificar se o usuário ou email já existem
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetchColumn() > 0) {
            $mensagem = 'Nome de usuário ou email já estão em uso.';
        } else {
            // Inserir novo usuário
            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO usuarios (username, email, senha, saldo) VALUES (?, ?, ?, 100.00)");
            
            if ($stmt->execute([$username, $email, $senha_hash])) {
                // Login automático após o registro
                $user_id = $pdo->lastInsertId();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['saldo'] = 100.00;
                
                header('Location: index.php');
                exit;
            } else {
                $mensagem = 'Erro ao registrar. Tente novamente.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - PG Slots</title>
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
                <h2>Criar Conta</h2>
                
                <?php if (!empty($mensagem)): ?>
                    <div class="mensagem erro"><?php echo htmlspecialchars($mensagem); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">Nome de Usuário</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" id="senha" name="senha" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirmar_senha">Confirmar Senha</label>
                        <input type="password" id="confirmar_senha" name="confirmar_senha" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </form>
                
                <div class="form-footer">
                    <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
                </div>
            </div>
        </main>

        <footer>
            <p>&copy; 2023 PG Slots - Tigrinho. Todos os direitos reservados.</p>
        </footer>
    </div>
</body>
</html>