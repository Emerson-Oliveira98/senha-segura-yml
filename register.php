<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Password Manager</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Cadastrar Novo Usuário</h2>
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            try {
                $stmt = $pdo->prepare("INSERT INTO users (nome, username, password) VALUES (?, ?, ?)");
                $stmt->execute([$nome, $username, $password]);
                echo "<p class='success'>Cadastro realizado! <a href='index.php'>Faça login</a></p>";
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    echo "<p class='error'>Nome de usuário já existe.</p>";
                } else {
                    echo "<p class='error'>Erro no cadastro: " . $e->getMessage() . "</p>";
                }
            }
        }
        ?>
        <form method="POST">
            <input type="text" name="nome" placeholder="Seu Nome Completo" required><br>
            <input type="text" name="username" placeholder="Nome de Usuário" required><br>
            <input type="password" name="password" placeholder="Senha" required><br>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>