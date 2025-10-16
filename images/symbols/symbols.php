<?php
// Este arquivo gera os símbolos SVG dinamicamente

// Função para criar os arquivos SVG se não existirem
function createSymbolFiles() {
    $symbolsDir = __DIR__;
    
    // Símbolo 3 - Panda
    $symbol3 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="#ecf0f1" stroke="#bdc3c7" stroke-width="2"/>
        <!-- Olhos do Panda -->
        <circle cx="35" cy="40" r="10" fill="#2c3e50"/>
        <circle cx="65" cy="40" r="10" fill="#2c3e50"/>
        <circle cx="35" cy="38" r="2" fill="#fff"/>
        <circle cx="65" cy="38" r="2" fill="#fff"/>
        <!-- Nariz -->
        <circle cx="50" cy="55" r="5" fill="#2c3e50"/>
        <!-- Boca -->
        <path d="M45,60 Q50,65 55,60" fill="none" stroke="#2c3e50" stroke-width="2"/>
        <!-- Orelhas -->
        <circle cx="30" cy="25" r="10" fill="#2c3e50"/>
        <circle cx="70" cy="25" r="10" fill="#2c3e50"/>
    </svg>';
    
    // Símbolo 4 - Leão
    $symbol4 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="#f1c40f" stroke="#f39c12" stroke-width="2"/>
        <!-- Juba do Leão -->
        <path d="M20,20 Q30,10 40,15 Q50,5 60,15 Q70,10 80,20 Q90,30 80,40 Q90,50 80,60 Q70,70 60,65 Q50,75 40,65 Q30,70 20,60 Q10,50 20,40 Q10,30 20,20" fill="#e67e22" stroke="#d35400" stroke-width="2"/>
        <!-- Rosto -->
        <circle cx="50" cy="50" r="25" fill="#f1c40f"/>
        <!-- Olhos -->
        <circle cx="40" cy="45" r="3" fill="#2c3e50"/>
        <circle cx="60" cy="45" r="3" fill="#2c3e50"/>
        <!-- Nariz -->
        <circle cx="50" cy="55" r="4" fill="#e74c3c"/>
        <!-- Boca -->
        <path d="M40,60 Q50,65 60,60" fill="none" stroke="#2c3e50" stroke-width="2"/>
    </svg>';
    
    // Símbolo 5 - Macaco
    $symbol5 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="#795548" stroke="#5d4037" stroke-width="2"/>
        <!-- Rosto do Macaco -->
        <circle cx="50" cy="50" r="30" fill="#8d6e63"/>
        <!-- Olhos -->
        <circle cx="40" cy="40" r="5" fill="#fff"/>
        <circle cx="60" cy="40" r="5" fill="#fff"/>
        <circle cx="40" cy="40" r="2" fill="#000"/>
        <circle cx="60" cy="40" r="2" fill="#000"/>
        <!-- Nariz -->
        <circle cx="50" cy="55" r="5" fill="#5d4037"/>
        <!-- Boca -->
        <path d="M40,65 Q50,70 60,65" fill="none" stroke="#5d4037" stroke-width="2"/>
        <!-- Orelhas -->
        <circle cx="25" cy="30" r="10" fill="#8d6e63"/>
        <circle cx="75" cy="30" r="10" fill="#8d6e63"/>
    </svg>';
    
    // Símbolo 6 - Peixe
    $symbol6 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="#3498db" stroke="#2980b9" stroke-width="2"/>
        <!-- Corpo do Peixe -->
        <path d="M30,50 Q50,30 70,50 Q50,70 30,50" fill="#2980b9" stroke="#1f618d" stroke-width="2"/>
        <!-- Olho -->
        <circle cx="40" cy="45" r="5" fill="#fff"/>
        <circle cx="40" cy="45" r="2" fill="#000"/>
        <!-- Cauda -->
        <path d="M70,50 L85,35 L85,65 Z" fill="#2980b9" stroke="#1f618d" stroke-width="2"/>
        <!-- Barbatanas -->
        <path d="M50,30 L50,20" fill="none" stroke="#1f618d" stroke-width="2"/>
        <path d="M50,70 L50,80" fill="none" stroke="#1f618d" stroke-width="2"/>
    </svg>';
    
    // Símbolo 7 - Tartaruga
    $symbol7 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="#27ae60" stroke="#2ecc71" stroke-width="2"/>
        <!-- Casco da Tartaruga -->
        <circle cx="50" cy="50" r="30" fill="#16a085" stroke="#1abc9c" stroke-width="2"/>
        <!-- Padrões do Casco -->
        <path d="M35,35 L65,35 L65,65 L35,65 Z" fill="none" stroke="#1abc9c" stroke-width="2"/>
        <path d="M35,35 L65,65" fill="none" stroke="#1abc9c" stroke-width="2"/>
        <path d="M65,35 L35,65" fill="none" stroke="#1abc9c" stroke-width="2"/>
        <!-- Cabeça -->
        <circle cx="75" cy="50" r="10" fill="#27ae60"/>
        <!-- Olho -->
        <circle cx="80" cy="45" r="2" fill="#000"/>
        <!-- Patas -->
        <circle cx="35" cy="25" r="5" fill="#27ae60"/>
        <circle cx="65" cy="25" r="5" fill="#27ae60"/>
        <circle cx="35" cy="75" r="5" fill="#27ae60"/>
        <circle cx="65" cy="75" r="5" fill="#27ae60"/>
    </svg>';
    
    // Símbolo 8 - Fênix
    $symbol8 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="45" fill="#9b59b6" stroke="#8e44ad" stroke-width="2"/>
        <!-- Corpo da Fênix -->
        <path d="M30,50 Q50,20 70,50 Q60,70 50,60 Q40,70 30,50" fill="#8e44ad" stroke="#6c3483" stroke-width="2"/>
        <!-- Asas -->
        <path d="M20,40 Q30,30 40,40" fill="none" stroke="#e74c3c" stroke-width="3"/>
        <path d="M80,40 Q70,30 60,40" fill="none" stroke="#e74c3c" stroke-width="3"/>
        <!-- Cauda -->
        <path d="M45,60 L40,80" fill="none" stroke="#e74c3c" stroke-width="3"/>
        <path d="M50,60 L50,85" fill="none" stroke="#e74c3c" stroke-width="3"/>
        <path d="M55,60 L60,80" fill="none" stroke="#e74c3c" stroke-width="3"/>
        <!-- Cabeça -->
        <circle cx="50" cy="30" r="10" fill="#8e44ad"/>
        <!-- Olhos -->
        <circle cx="45" cy="28" r="2" fill="#fff"/>
        <circle cx="55" cy="28" r="2" fill="#fff"/>
        <!-- Bico -->
        <path d="M48,35 L50,40 L52,35" fill="#e67e22" stroke="#d35400" stroke-width="1"/>
    </svg>';
    
    // Salvar os arquivos SVG
    file_put_contents($symbolsDir . '/symbol3.svg', $symbol3);
    file_put_contents($symbolsDir . '/symbol4.svg', $symbol4);
    file_put_contents($symbolsDir . '/symbol5.svg', $symbol5);
    file_put_contents($symbolsDir . '/symbol6.svg', $symbol6);
    file_put_contents($symbolsDir . '/symbol7.svg', $symbol7);
    file_put_contents($symbolsDir . '/symbol8.svg', $symbol8);
    
    // Converter SVG para PNG (opcional - requer a extensão GD)
    // Esta parte é comentada pois requer a extensão GD do PHP
    /*
    if (extension_loaded('gd')) {
        foreach (range(1, 8) as $i) {
            $svgFile = $symbolsDir . "/symbol$i.svg";
            $pngFile = $symbolsDir . "/symbol$i.png";
            
            // Converter SVG para PNG usando ImageMagick via shell
            // Isso requer que o ImageMagick esteja instalado no servidor
            // exec("convert $svgFile $pngFile");
        }
    }
    */
}

// Criar os arquivos SVG
createSymbolFiles();

// Redirecionar para o arquivo SVG solicitado
$symbol = isset($_GET['symbol']) ? intval($_GET['symbol']) : 1;
$symbol = max(1, min(8, $symbol)); // Garantir que está entre 1 e 8

$svgFile = __DIR__ . "/symbol$symbol.svg";

if (file_exists($svgFile)) {
    header('Content-Type: image/svg+xml');
    readfile($svgFile);
} else {
    header('HTTP/1.0 404 Not Found');
    echo "Símbolo não encontrado";
}
?>