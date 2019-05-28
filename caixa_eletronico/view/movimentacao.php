<?php

include_once '../model/Conexao.php';
include_once '../model/Contas.php';

$contas = new Contas;

session_start();

if (isset($_SESSION['login'])) {
    if ($_POST['valor'] == '') {
        header("Location: ../index.php?valor_obrigatorio");
        exit;
    }

    if ($_POST['tipo'] === 'transferir') {
        if ($_POST['conta_para_transferir'] === 'Selecione para transferir') {
            header("Location: ../index.php?transaction=conta_obrigatoria");
            exit;
        }
    }

    $movimentacao = $contas->setTransaction($_POST);

    if ($movimentacao) {
        $contas->setHistoric($_POST);
    }

    if ($movimentacao === 'nosaldo') {
        header("Location: ../index.php?sem_saldo");
        exit;
    }

    if ($movimentacao === 'saldomenor') {
        header("Location: ../index.php?transaction=saldo_menor");
        exit;
    }

    if ($movimentacao === 'saldonegativo') {
        header("Location: ../index.php?valor_a_transferir_menor_que_zero");
        exit;
    }

    if ($movimentacao === 'maiorque999') {
        echo '<script>location.href="../index.php?transaction=limite";</script>';
        exit();
    }

    if ($movimentacao === 'salario') {
        header("Location: ../index.php?transaction=salario");
        exit;
    }

    if ($movimentacao) {
        echo '<script>location.href="../index.php?transaction=success";</script>'; 
    } else {
        echo '<script>location.href="../index.php?transaction=failed";</script>'; 
    }

}
