<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service = $_POST['service_name'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("INSERT INTO credentials (user_id, service_name, login, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user_id, $service, $login, $password]);
        echo "<p class='success'>Credencial adicionada!</p>";
    } catch (PDOException $e) {
        echo "<p class='error'>Erro ao salvar: " . $e->getMessage() . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Adicionar Credencial</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Adicionar Nova Credencial</h2>
        <form method="POST">
            <input type="text" name="service_name" placeholder="Nome do Serviço" required><br>
            <input type="text" name="login" placeholder="Login" required><br>
            <input type="password" name="password" placeholder="Senha" required><br>
            <button type="submit">Salvar</button>
        </form>
        <br>
        <a href="dashboard.php">Voltar ao Dashboard</a>
    </div>
</body>
</html>