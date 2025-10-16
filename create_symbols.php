<?php
// Este script cria todos os símbolos SVG necessários

$symbolsDir = __DIR__ . '/images/symbols';

// Criar diretório se não existir
if (!file_exists($symbolsDir)) {
    mkdir($symbolsDir, 0777, true);
}

// Símbolo 4 - Leão
$symbol4 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
    <circle cx="50" cy="50" r="45" fill="#f1c40f" stroke="#f39c12" stroke-width="2"/>
    <circle cx="50" cy="50" r="25" fill="#f1c40f"/>
    <circle cx="40" cy="45" r="3" fill="#2c3e50"/>
    <circle cx="60" cy="45" r="3" fill="#2c3e50"/>
    <circle cx="50" cy="55" r="4" fill="#e74c3c"/>
    <path d="M40,60 Q50,65 60,60" fill="none" stroke="#2c3e50" stroke-width="2"/>
</svg>';

// Símbolo 5 - Macaco
$symbol5 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
    <circle cx="50" cy="50" r="45" fill="#795548" stroke="#5d4037" stroke-width="2"/>
    <circle cx="50" cy="50" r="30" fill="#8d6e63"/>
    <circle cx="40" cy="40" r="5" fill="#fff"/>
    <circle cx="60" cy="40" r="5" fill="#fff"/>
    <circle cx="40" cy="40" r="2" fill="#000"/>
    <circle cx="60" cy="40" r="2" fill="#000"/>
    <circle cx="50" cy="55" r="5" fill="#5d4037"/>
    <path d="M40,65 Q50,70 60,65" fill="none" stroke="#5d4037" stroke-width="2"/>
</svg>';

// Símbolo 6 - Peixe
$symbol6 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
    <circle cx="50" cy="50" r="45" fill="#3498db" stroke="#2980b9" stroke-width="2"/>
    <path d="M30,50 Q50,30 70,50 Q50,70 30,50" fill="#2980b9" stroke="#1f618d" stroke-width="2"/>
    <circle cx="40" cy="45" r="5" fill="#fff"/>
    <circle cx="40" cy="45" r="2" fill="#000"/>
    <path d="M70,50 L85,35 L85,65 Z" fill="#2980b9" stroke="#1f618d" stroke-width="2"/>
</svg>';

// Símbolo 7 - Tartaruga
$symbol7 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
    <circle cx="50" cy="50" r="45" fill="#27ae60" stroke="#2ecc71" stroke-width="2"/>
    <circle cx="50" cy="50" r="30" fill="#16a085" stroke="#1abc9c" stroke-width="2"/>
    <path d="M35,35 L65,35 L65,65 L35,65 Z" fill="none" stroke="#1abc9c" stroke-width="2"/>
    <circle cx="75" cy="50" r="10" fill="#27ae60"/>
    <circle cx="80" cy="45" r="2" fill="#000"/>
</svg>';

// Símbolo 8 - Fênix
$symbol8 = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
    <circle cx="50" cy="50" r="45" fill="#9b59b6" stroke="#8e44ad" stroke-width="2"/>
    <path d="M30,50 Q50,20 70,50 Q60,70 50,60 Q40,70 30,50" fill="#8e44ad" stroke="#6c3483" stroke-width="2"/>
    <path d="M20,40 Q30,30 40,40" fill="none" stroke="#e74c3c" stroke-width="3"/>
    <path d="M80,40 Q70,30 60,40" fill="none" stroke="#e74c3c" stroke-width="3"/>
    <circle cx="50" cy="30" r="10" fill="#8e44ad"/>
    <circle cx="45" cy="28" r="2" fill="#fff"/>
    <circle cx="55" cy="28" r="2" fill="#fff"/>
</svg>';

// Salvar os arquivos SVG
file_put_contents($symbolsDir . '/symbol4.svg', $symbol4);
file_put_contents($symbolsDir . '/symbol5.svg', $symbol5);
file_put_contents($symbolsDir . '/symbol6.svg', $symbol6);
file_put_contents($symbolsDir . '/symbol7.svg', $symbol7);
file_put_contents($symbolsDir . '/symbol8.svg', $symbol8);

echo "Símbolos criados com sucesso!";
?>