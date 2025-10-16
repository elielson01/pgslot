// Funções para gerenciamento de usuários usando localStorage
document.addEventListener('DOMContentLoaded', function() {
    // Verificar se o usuário está logado
    checkLoginStatus();
    
    // Adicionar event listeners para formulários
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
        loginForm.addEventListener('submit', handleLogin);
    }
    
    const registroForm = document.getElementById('registro-form');
    if (registroForm) {
        registroForm.addEventListener('submit', handleRegistro);
    }
    
    // Verificar se estamos na página principal
    if (window.location.pathname.endsWith('index.html') || window.location.pathname.endsWith('/')) {
        setupGameInterface();
    }
});

// Verificar status de login
function checkLoginStatus() {
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    const userInfoElement = document.getElementById('user-info');
    const gameSection = document.getElementById('game-section');
    
    if (currentUser) {
        // Usuário está logado
        if (userInfoElement) {
            userInfoElement.innerHTML = `
                <p>Bem-vindo, ${currentUser.username}</p>
                <p>Saldo: R$ <span id="saldo">${currentUser.saldo.toFixed(2).replace('.', ',')}</span></p>
                <a href="#" id="logout-btn" class="btn">Sair</a>
            `;
            
            // Adicionar event listener para logout
            document.getElementById('logout-btn').addEventListener('click', function(e) {
                e.preventDefault();
                logout();
            });
        }
        
        // Configurar interface do jogo se estiver na página principal
        if (gameSection) {
            gameSection.innerHTML = `
                <div class="game-container">
                    <div class="slot-machine">
                        <div class="slot-display">
                            <!-- Grid 3x3 para os slots -->
                            <div class="slot-grid">
                                <!-- Primeira linha -->
                                <div class="slot" id="slot-0-0"><img src="images/symbols/symbol1.svg" alt="Símbolo"></div>
                                <div class="slot" id="slot-0-1"><img src="images/symbols/symbol2.svg" alt="Símbolo"></div>
                                <div class="slot" id="slot-0-2"><img src="images/symbols/symbol3.svg" alt="Símbolo"></div>
                                
                                <!-- Segunda linha -->
                                <div class="slot" id="slot-1-0"><img src="images/symbols/symbol4.svg" alt="Símbolo"></div>
                                <div class="slot" id="slot-1-1"><img src="images/symbols/symbol5.svg" alt="Símbolo"></div>
                                <div class="slot" id="slot-1-2"><img src="images/symbols/symbol6.svg" alt="Símbolo"></div>
                                
                                <!-- Terceira linha -->
                                <div class="slot" id="slot-2-0"><img src="images/symbols/symbol7.svg" alt="Símbolo"></div>
                                <div class="slot" id="slot-2-1"><img src="images/symbols/symbol8.svg" alt="Símbolo"></div>
                                <div class="slot" id="slot-2-2"><img src="images/symbols/symbol1.svg" alt="Símbolo"></div>
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
            `;
        }
    } else {
        // Usuário não está logado
        if (userInfoElement) {
            userInfoElement.innerHTML = `
                <a href="login.html" class="btn">Login</a>
                <a href="registro.html" class="btn">Registrar</a>
            `;
        }
        
        // Mostrar mensagem para fazer login se estiver na página principal
        if (gameSection) {
            gameSection.innerHTML = `
                <div class="login-message">
                    <h2>Faça login para jogar!</h2>
                    <p>Crie uma conta ou faça login para começar a jogar e ganhar prêmios incríveis!</p>
                </div>
            `;
        }
    }
}

// Função para lidar com o login
function handleLogin(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const senha = document.getElementById('senha').value;
    const mensagemErro = document.getElementById('mensagem-erro');
    
    // Verificar se os campos estão preenchidos
    if (!username || !senha) {
        mensagemErro.textContent = 'Por favor, preencha todos os campos.';
        mensagemErro.style.display = 'block';
        return;
    }
    
    // Buscar usuários no localStorage
    const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
    
    // Verificar credenciais
    const usuario = usuarios.find(u => (u.username === username || u.email === username) && u.senha === senha);
    
    if (usuario) {
        // Login bem-sucedido
        localStorage.setItem('currentUser', JSON.stringify(usuario));
        window.location.href = 'index.html';
    } else {
        mensagemErro.textContent = 'Credenciais inválidas. Tente novamente.';
        mensagemErro.style.display = 'block';
    }
}

// Função para lidar com o registro
function handleRegistro(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const senha = document.getElementById('senha').value;
    const confirmarSenha = document.getElementById('confirmar_senha').value;
    const mensagemErro = document.getElementById('mensagem-erro');
    
    // Validações básicas
    if (!username || !email || !senha || !confirmarSenha) {
        mensagemErro.textContent = 'Todos os campos são obrigatórios.';
        mensagemErro.style.display = 'block';
        return;
    }
    
    if (senha !== confirmarSenha) {
        mensagemErro.textContent = 'As senhas não coincidem.';
        mensagemErro.style.display = 'block';
        return;
    }
    
    if (senha.length < 6) {
        mensagemErro.textContent = 'A senha deve ter pelo menos 6 caracteres.';
        mensagemErro.style.display = 'block';
        return;
    }
    
    // Buscar usuários existentes
    const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
    
    // Verificar se o usuário ou email já existem
    if (usuarios.some(u => u.username === username || u.email === email)) {
        mensagemErro.textContent = 'Nome de usuário ou email já estão em uso.';
        mensagemErro.style.display = 'block';
        return;
    }
    
    // Criar novo usuário
    const novoUsuario = {
        id: Date.now().toString(),
        username,
        email,
        senha,
        saldo: 100.00,
        dataRegistro: new Date().toISOString()
    };
    
    // Adicionar à lista de usuários
    usuarios.push(novoUsuario);
    localStorage.setItem('usuarios', JSON.stringify(usuarios));
    
    // Fazer login automático
    localStorage.setItem('currentUser', JSON.stringify(novoUsuario));
    
    // Redirecionar para a página principal
    window.location.href = 'index.html';
}

// Função para logout
function logout() {
    localStorage.removeItem('currentUser');
    window.location.href = 'index.html';
}

// Função para atualizar o saldo do usuário
function updateUserSaldo(novoSaldo) {
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    if (currentUser) {
        currentUser.saldo = novoSaldo;
        localStorage.setItem('currentUser', JSON.stringify(currentUser));
        
        // Atualizar também na lista de usuários
        const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
        const index = usuarios.findIndex(u => u.id === currentUser.id);
        if (index !== -1) {
            usuarios[index].saldo = novoSaldo;
            localStorage.setItem('usuarios', JSON.stringify(usuarios));
        }
        
        // Atualizar na interface
        const saldoElement = document.getElementById('saldo');
        if (saldoElement) {
            saldoElement.textContent = novoSaldo.toFixed(2).replace('.', ',');
        }
    }
}

// Função para configurar a interface do jogo
function setupGameInterface() {
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    if (!currentUser) return;
    
    // Inicializar o jogo quando o script game.js for carregado
}