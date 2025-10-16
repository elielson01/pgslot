document.addEventListener('DOMContentLoaded', function() {
    // Verificar se o usuário está logado
    const currentUser = JSON.parse(localStorage.getItem('currentUser'));
    if (!currentUser) return;
    
    // Elementos do DOM
    const spinButton = document.getElementById('spin-button');
    const decreaseBetButton = document.getElementById('decrease-bet');
    const increaseBetButton = document.getElementById('increase-bet');
    const betAmountElement = document.getElementById('bet-amount');
    const saldoElement = document.getElementById('saldo');
    const winMessageElement = document.getElementById('win-message');
    
    // Configurações do jogo
    const symbols = [
        'images/symbols/symbol1.svg', // Tigre
        'images/symbols/symbol2.svg', // Dragão
        'images/symbols/symbol3.svg', // Panda
        'images/symbols/symbol4.svg', // Leão
        'images/symbols/symbol5.svg', // Macaco
        'images/symbols/symbol6.svg', // Peixe
        'images/symbols/symbol7.svg', // Tartaruga
        'images/symbols/symbol8.svg'  // Fênix
    ];
    
    // Valores dos símbolos (multiplicadores)
    const symbolValues = {
        'images/symbols/symbol1.svg': 5,  // Tigre (maior valor)
        'images/symbols/symbol2.svg': 4,  // Dragão
        'images/symbols/symbol3.svg': 3,  // Panda
        'images/symbols/symbol4.svg': 3,  // Leão
        'images/symbols/symbol5.svg': 2,  // Macaco
        'images/symbols/symbol6.svg': 2,  // Peixe
        'images/symbols/symbol7.svg': 1,  // Tartaruga
        'images/symbols/symbol8.svg': 1   // Fênix
    };
    
    // Linhas de pagamento (coordenadas [linha, coluna])
    const paylines = [
        // Horizontais
        [[0,0], [0,1], [0,2]], // Linha superior
        [[1,0], [1,1], [1,2]], // Linha do meio
        [[2,0], [2,1], [2,2]], // Linha inferior
        
        // Diagonais
        [[0,0], [1,1], [2,2]], // Diagonal principal
        [[0,2], [1,1], [2,0]], // Diagonal secundária
        
        // Formas de V
        [[0,0], [1,1], [0,2]],
        [[2,0], [1,1], [2,2]],
        
        // Formas de zigue-zague
        [[0,0], [1,1], [2,2]],
        [[2,0], [1,1], [0,2]]
    ];
    
    let betAmount = 1.00;
    let isSpinning = false;
    let saldo = currentUser.saldo;
    
    // Atualizar o valor da aposta na interface
    function updateBetAmount() {
        betAmountElement.textContent = betAmount.toFixed(2).replace('.', ',');
    }
    
    // Atualizar o saldo na interface e no localStorage
    function updateSaldo() {
        saldoElement.textContent = saldo.toFixed(2).replace('.', ',');
        
        // Atualizar o saldo no localStorage
        currentUser.saldo = saldo;
        localStorage.setItem('currentUser', JSON.stringify(currentUser));
        
        // Atualizar também na lista de usuários
        const usuarios = JSON.parse(localStorage.getItem('usuarios')) || [];
        const index = usuarios.findIndex(u => u.id === currentUser.id);
        if (index !== -1) {
            usuarios[index].saldo = saldo;
            localStorage.setItem('usuarios', JSON.stringify(usuarios));
        }
    }
    
    // Obter um símbolo aleatório
    function getRandomSymbol() {
        return symbols[Math.floor(Math.random() * symbols.length)];
    }
    
    // Verificar se há combinações vencedoras
    function checkWinningCombinations(grid) {
        let winnings = 0;
        let winningLines = [];
        
        // Verificar cada linha de pagamento
        paylines.forEach((payline, index) => {
            const symbols = payline.map(coord => grid[coord[0]][coord[1]]);
            
            // Verificar se todos os símbolos na linha são iguais
            if (symbols[0] === symbols[1] && symbols[1] === symbols[2]) {
                const multiplier = symbolValues[symbols[0]];
                const lineWin = betAmount * multiplier;
                winnings += lineWin;
                winningLines.push(payline);
            }
        });
        
        return { winnings, winningLines };
    }
    
    // Destacar as linhas vencedoras
    function highlightWinningLines(winningLines) {
        // Remover destaques anteriores
        document.querySelectorAll('.slot').forEach(slot => {
            slot.classList.remove('highlight');
        });
        
        // Adicionar destaque às linhas vencedoras
        winningLines.forEach(payline => {
            payline.forEach(coord => {
                const slotElement = document.getElementById(`slot-${coord[0]}-${coord[1]}`);
                slotElement.classList.add('highlight');
            });
        });
    }
    
    // Girar os slots
    function spin() {
        if (isSpinning || saldo < betAmount) return;
        
        isSpinning = true;
        winMessageElement.textContent = '';
        
        // Deduzir o valor da aposta do saldo
        saldo -= betAmount;
        updateSaldo();
        
        // Desabilitar o botão durante o giro
        spinButton.disabled = true;
        
        // Criar uma grade 3x3 para armazenar os símbolos
        let grid = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];
        
        // Adicionar classe de animação e atualizar os slots
        for (let i = 0; i < 3; i++) {
            for (let j = 0; j < 3; j++) {
                const slotElement = document.getElementById(`slot-${i}-${j}`);
                const imgElement = slotElement.querySelector('img');
                
                slotElement.classList.add('spinning');
                
                // Definir um tempo aleatório para cada slot parar
                setTimeout(() => {
                    const symbol = getRandomSymbol();
                    imgElement.src = symbol;
                    grid[i][j] = symbol;
                    slotElement.classList.remove('spinning');
                    
                    // Verificar se todos os slots pararam
                    if (i === 2 && j === 2) {
                        setTimeout(() => {
                            const result = checkWinningCombinations(grid);
                            
                            if (result.winnings > 0) {
                                saldo += result.winnings;
                                updateSaldo();
                                winMessageElement.textContent = `Você ganhou R$ ${result.winnings.toFixed(2).replace('.', ',')}!`;
                                highlightWinningLines(result.winningLines);
                            } else {
                                winMessageElement.textContent = 'Tente novamente!';
                            }
                            
                            isSpinning = false;
                            spinButton.disabled = false;
                        }, 500);
                    }
                }, 1000 + (i * 3 + j) * 200);
            }
        }
    }
    
    // Event Listeners
    spinButton.addEventListener('click', spin);
    
    decreaseBetButton.addEventListener('click', function() {
        if (isSpinning) return;
        betAmount = Math.max(0.5, betAmount - 0.5);
        updateBetAmount();
    });
    
    increaseBetButton.addEventListener('click', function() {
        if (isSpinning) return;
        betAmount = Math.min(100, betAmount + 0.5);
        updateBetAmount();
    });
});