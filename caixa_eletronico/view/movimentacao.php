<!-- PHP - Incluindo Arquivos Necessarios -->
<?php

include_once '../model/Conexao.php';
include_once '../model/Contas.php';

$contas = new Contas;

session_start();

if (isset($_SESSION['login'])) {
    $movimentacao = $contas->setTransaction($_POST['tipo'], $_POST['valor']);
    if ($movimentacao) {
        header("Location: ../index.php?transaction_success");
    } else {
        header("Location: ../index.php?transaction_failed");
    }

}
