<?php

session_start();

include_once '../model/Conexao.php';
include_once '../model/Contas.php';

$senhas        = array();
$contas        = new Contas();
$senha         = md5($_POST['senha']);
$novaSenha     = md5($_POST['senha_nova']);
$confNovaSenha = md5($_POST['conf_senha_nova']);
$senhaAtualBanco = $contas->verificaSenhaAtual()[0]['senha'];

if ($senha !== $senhaAtualBanco) {
    header("Location: ../view/alterar_senha.php?senha_atual_incorreta");
    exit;
}
if ($novaSenha !== $confNovaSenha) {
    header("Location: ../view/alterar_senha.php?as_senhas_nao_sao_iguais");
    exit;
}

if (!$senha) {
    header("Location: ../index.php?senha_nao_preenchida");
}

$ultimasSenhas = $contas->verificaUltimasSenhas();

foreach ($ultimasSenhas as $array) {
    foreach ((array) $array["senha"] as $senha) {
        $senhas[] = $senha;
    }
}

if (!in_array($novaSenha, $senhas, true)) {
    $trocarSenha = $contas->trocaSenha($_POST);
} else {
    header("Location: ../index.php?senha_ja_utilizada_nas_ultimas_3_vezes");
    exit;
}

if ($trocarSenha) {
    header("Location: ../index.php?senha_alterada");
} else {
    header("Location: ../index.php?senha_nao_alterada");
}
