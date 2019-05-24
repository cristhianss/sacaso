<?php

include_once '../model/Conexao.php';
include_once '../model/Contas.php';

$contas = new Contas;

session_start();

if (isset($_SESSION['login'])) {
    $movimentacao = $contas->setTransaction($_POST);

    if ($movimentacao === 'nosaldo') {
        header("Location: ../index.php?sem_saldo");
        exit;
    }

    if ($movimentacao === 'saldonegativo') {
        header("Location: ../index.php?valor_a_transferir_menor_que_zero");
        exit;
    }

    if ($movimentacao === 'maiorque999') {
        header("Location: ../index.php?maior_que_999");
        exit;
    }

    if ($movimentacao === 'salario') {
        header("Location: ../index.php?nao_pode_tranferir_para_conta_salario");
        exit;
    }

    if ($movimentacao) {
        header("Location: ../index.php?transaction_success");
    } else {
        header("Location: ../index.php?transaction_failed");
    }

}
