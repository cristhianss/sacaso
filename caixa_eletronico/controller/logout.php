<?php

session_start();

include_once '../model/Conexao.php';
include_once '../model/Contas.php';

$contas = new Contas();
$contas->logout();

header("Location: ../login.php?sessions_ending_success");