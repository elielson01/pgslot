<?php
session_start();
require_once 'config/database.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Usuário não autenticado']);
    exit;
}

// Verificar se o saldo foi enviado
if (!isset($_POST['saldo'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Saldo não fornecido']);
    exit;
}

$user_id = $_SESSION['user_id'];
$saldo = floatval($_POST['saldo']);

// Atualizar o saldo na sessão
$_SESSION['saldo'] = $saldo;

// Atualizar o saldo no banco de dados
try {
    $stmt = $pdo->prepare("UPDATE usuarios SET saldo = ? WHERE id = ?");
    $stmt->execute([$saldo, $user_id]);
    
    echo json_encode(['success' => true, 'saldo' => $saldo]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Erro ao atualizar saldo']);
}
?>