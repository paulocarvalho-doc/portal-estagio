<?php
include 'conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($usuario = $resultado->fetch_assoc()) {
        if (password_verify($senha, $usuario['senha'])) {
            session_regenerate_id(true); // segurança
            $_SESSION['usuario'] = $usuario;
            header("Location: painel.php");
            exit;
        }
    }
    $erro = "Login inválido.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Login</h1>
    <?php if (isset($erro)) echo "<p style='color:red;'>$erro</p>"; ?>
    <form method="post">
        <label>Email</label>
        <input name="email" type="email" required>

        <label>Senha</label>
        <input name="senha" type="password" required>

        <button type="submit">Entrar</button>
    </form>
    <p><a href="cadastro.php">Ainda não tem conta? Cadastre-se</a></p>
</body>
</html>
