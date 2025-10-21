<?php
session_start();
include 'conexao.php';
include 'funcoes.php';
verificarLogin();

// Garantir que $usuario seja um array associativo
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];

// Se a sessão armazenou só o ID, buscamos os dados completos no banco
if (!is_array($usuario)) {
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $usuario); // $usuario contém só o ID
    $stmt->execute();
    $usuario = $stmt->get_result()->fetch_assoc();
    $_SESSION['usuario'] = $usuario; // atualiza a sessão corretamente
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Olá, <?= htmlspecialchars($usuario['nome']) ?> (<?= htmlspecialchars($usuario['tipo']) ?>)</h1>

    <?php if ($usuario['tipo'] == 'empresa'): ?>
        <form method="post">
            <label>Título</label>
            <input name="titulo">

            <label>Descrição</label>
            <textarea name="descricao"></textarea>

            <label>Local</label>
            <input name="local">

            <label>Bolsa</label>
            <input name="bolsa">

            <button type="submit">Cadastrar Vaga</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $sql = "INSERT INTO vagas (empresa_id, titulo, descricao, local, bolsa) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("isssd", $usuario['id'], $_POST['titulo'], $_POST['descricao'], $_POST['local'], $_POST['bolsa']);
            $stmt->execute();
            echo "<p style='color:green;'>Vaga cadastrada!</p>";
        }
        ?>
    <?php else: ?>
        <form method="post" enctype="multipart/form-data" action="upload.php">
            <label>Enviar currículo (PDF)</label>
            <input type="file" name="curriculo">
            <button type="submit">Enviar</button>
        </form>
    <?php endif; ?>

    <p><a href="vagas.php">Ver Vagas</a> | <a href="logout.php">Sair</a></p>
</body>
</html>
