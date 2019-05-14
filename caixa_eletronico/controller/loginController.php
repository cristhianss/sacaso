<?php

session_start();

include_once '../model/Conexao.php';
include_once '../model/Contas.php';

$contas = new Contas();

$cpf = addslashes($_POST['cpf']);
$senha = md5($_POST['senha']);

if (isset($_POST['cpf']) && !empty($_POST['cpf'])) {
    $contas->setLogged($cpf, $senha);
}