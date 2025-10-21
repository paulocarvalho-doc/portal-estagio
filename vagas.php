<?php
include 'conexao.php';
include 'funcoes.php';
verificarLogin();

// Ativar exibição de erros (apenas para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Recebe parâmetros de busca e ordenação
$busca = $_GET['busca'] ?? '';
$ordenar = $_GET['ordenar'] ?? 'data_criacao';

// Valida a coluna para evitar SQL Injection
$colunas_validas = ['data_criacao', 'titulo', 'bolsa'];
if (!in_array($ordenar, $colunas_validas)) {
    $ordenar = 'data_criacao';
}

// Query para buscar vagas
$sql = "SELECT v.*, u.nome AS empresa 
        FROM vagas v 
        JOIN usuarios u ON v.empresa_id = u.id 
        WHERE titulo LIKE ? 
        ORDER BY $ordenar DESC";

$stmt = $conn->prepare($sql);
$like = "%$busca%";
$stmt->bind_param("s", $like);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Vagas Disponíveis</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <h1>Vagas Disponíveis</h1>

    <!-- Formulário de busca e ordenação -->
    <form method="get" class="form-busca">
        <input type="text" name="busca" placeholder="Buscar por título" value="<?= htmlspecialchars($busca) ?>">
        <select name="ordenar">
            <option value="data_criacao" <?= $ordenar=='data_criacao'?'selected':'' ?>>Mais Recentes</option>
            <option value="titulo" <?= $ordenar=='titulo'?'selected':'' ?>>Título</option>
            <option value="bolsa" <?= $ordenar=='bolsa'?'selected':'' ?>>Bolsa</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>

    <!-- Lista de vagas -->
    <div class="lista-vagas">
        <?php if($resultado->num_rows > 0): ?>
            <?php while($vaga = $resultado->fetch_assoc()): ?>
                <div class="vaga-card">
                    <h2><?= htmlspecialchars($vaga['titulo']) ?></h2>
                    <p><strong>Empresa:</strong> <?= htmlspecialchars($vaga['empresa']) ?></p>
                    <p><strong>Descrição:</strong> <?= htmlspecialchars($vaga['descricao']) ?></p>
                    <p><strong>Local:</strong> <?= htmlspecialchars($vaga['local']) ?></p>
                    <p><strong>Bolsa:</strong> R$ <?= number_format($vaga['bolsa'], 2, ',', '.') ?></p>
                    <p><strong>Criada em:</strong> <?= date('d/m/Y', strtotime($vaga['data_criacao'])) ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>Nenhuma vaga encontrada.</p>
        <?php endif; ?>
    </div>

    <p><a href="painel.php">Voltar ao Painel</a></p>
</body>
</html>
