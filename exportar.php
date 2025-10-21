<?php
include 'conexao.php';
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="vagas.csv"');

$output = fopen('php://output', 'w');
fputcsv($output, ['Título', 'Descrição', 'Local', 'Bolsa']);

$sql = "SELECT titulo, descricao, local, bolsa FROM vagas";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  fputcsv($output, $row);
}
fclose($output);