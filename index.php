<?php
session_start();
require_once 'config/database.php';

// Verificar se o usuário está logado
$logado = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Slots - Tigrinho</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header>
            <h1>PG Slots - Tigrinho</h1>
            <div class="user-info">
                <?php if ($logado): ?>
                    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                    <p>Saldo: R$ <span id="saldo"><?php echo number_format($_SESSION['saldo'], 2, ',', '.'); ?></span></p>
                    <a href="logout.php" class="btn">Sair</a>
                <?php else: ?>
                    <a href="login.php" class="btn">Login</a>
                    <a href="registro.php" class="btn">Registrar</a>
                <?php endif; ?>
            </div>
        </header>

        <main>
            <?php if ($logado): ?>
                <div class="game-container">
                    <div class="slot-machine">
                        <div class="slot-display">
                            <!-- Grid 3x3 para os slots -->
                            <div class="slot-grid">
                                <!-- Primeira linha -->
                                <div class="slot" id="slot-0-0"><img src="images/symbols/symbol1.png" alt="Símbolo"></div>
                                <div class="slot" id="slot-0-1"><img src="images/symbols/symbol2.png" alt="Símbolo"></div>
                                <div class="slot" id="slot-0-2"><img src="images/symbols/symbol3.png" alt="Símbolo"></div>
                                
                                <!-- Segunda linha -->
                                <div class="slot" id="slot-1-0"><img src="images/symbols/symbol4.png" alt="Símbolo"></div>
                                <div class="slot" id="slot-1-1"><img src="images/symbols/symbol5.png" alt="Símbolo"></div>
                                <div class="slot" id="slot-1-2"><img src="images/symbols/symbol6.png" alt="Símbolo"></div>
                                
                                <!-- Terceira linha -->
                                <div class="slot" id="slot-2-0"><img src="images/symbols/symbol7.png" alt="Símbolo"></div>
                                <div class="slot" id="slot-2-1"><img src="images/symbols/symbol8.png" alt="Símbolo"></div>
                                <div class="slot" id="slot-2-2"><img src="images/symbols/symbol1.png" alt="Símbolo"></div>
                            </div>
                        </div>
                        
                        <div class="controls">
                            <div class="bet-controls">
                                <button id="decrease-bet">-</button>
                                <span>Aposta: R$ <span id="bet-amount">1,00</span></span>
                                <button id="increase-bet">+</button>
                            </div>
                            <button id="spin-button" class="btn-spin">Girar</button>
                        </div>
                        
                        <div class="win-message" id="win-message"></div>
                    </div>
                </div>
            <?php else: ?>
                <div class="login-message">
                    <h2>Faça login para jogar!</h2>
                    <p>Crie uma conta ou faça login para começar a jogar e ganhar prêmios incríveis!</p>
                </div>
            <?php endif; ?>
        </main>

        <footer>
            <p>&copy; 2023 PG Slots - Tigrinho. Todos os direitos reservados.</p>
        </footer>
    </div>

    <?php if ($logado): ?>
    <script src="js/game.js"></script>
    <?php endif; ?>
</body>
</html>