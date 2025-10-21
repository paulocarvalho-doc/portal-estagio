<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = htmlspecialchars($_POST['nome']);
    $email = htmlspecialchars($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    $tipo = htmlspecialchars($_POST['tipo']);

    $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $senha, $tipo);
    $stmt->execute();

    echo "<p style='color:green;'>Cadastro realizado!</p>";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Cadastro</h1>
    <form method="post">
        <label>Nome</label>
        <input name="nome" required>

        <label>Email</label>
        <input name="email" type="email" required>

        <label>Senha</label>
        <input type="password" name="senha" required>

        <label>Tipo</label>
        <select name="tipo" required>
            <option value="estudante">Estudante</option>
            <option value="empresa">Empresa</option>
        </select>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
