<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM credentials WHERE user_id = ?");
$stmt->execute([$user_id]);
$credentials = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Password Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Minhas Credenciais</h2>
        <?php if (count($credentials) > 0): ?>
          <div class="table-responsive">
            <table>
                <tr>
                    <th>Serviço</th>
                    <th>Login</th>
                    <th>Senha</th>
                </tr>
                <?php foreach ($credentials as $cred): ?>
                    <tr>
                        <td><?= htmlspecialchars($cred['service_name']) ?></td>
                        <td><?= htmlspecialchars($cred['login']) ?></td>
                        <td><?= htmlspecialchars($cred['password']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            </div>
        <?php else: ?>
            <p>Você ainda não possui credenciais salvas.</p>
        <?php endif; ?>

        <br>
        <a href="add_credential.php">+ Adicionar Nova Credencial</a>
        <br><br>
        <a href="logout.php">Sair</a>
    </div>
</body>
</html>