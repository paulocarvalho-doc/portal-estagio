<?php
include 'funcoes.php';
verificarLogin();
$usuario = $_SESSION['usuario'];

if ($usuario['tipo'] == 'estudante' && isset($_FILES['curriculo'])) {
    $arquivo = $_FILES['curriculo'];

    if ($arquivo['type'] == 'application/pdf' && $arquivo['size'] <= 2 * 1024 * 1024) {
        if(!is_dir('uploads')) mkdir('uploads', 0755, true);

        $nome = uniqid() . '.pdf';
        move_uploaded_file($arquivo['tmp_name'], "uploads/$nome");

        include 'conexao.php';
        $sql = "INSERT INTO curriculos (estudante_id, arquivo) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("is", $usuario['id'], $nome);
        $stmt->execute();

        echo "<p style='color:green;'>Currículo enviado!</p>";
    } else {
        echo "<p style='color:red;'>Arquivo inválido.</p>";
    }
}
?>

<p><a href="painel.php">Voltar</a></p>
