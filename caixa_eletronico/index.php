<?php
setlocale(LC_MONETARY, 'pt_BR');
session_start();
if (isset($_SESSION['login'])) {
    include_once 'model/Conexao.php';
    include_once 'model/Contas.php';
    $contas = new Contas(); ?>
    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="assets/img/icon.jpg">
        <title>Caixa Eletrônico - Home</title>
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="assets/css/jquery.toast.min.css">
        <link rel="stylesheet" href="assets/css/index.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    </head>
    <body>
    <div class="d-flex">
        <nav class="sidebar">
            <ul class="list-unstyled">
                <div class="image_company">
                    <img src="assets/img/logo.png" class="rounded-circle rounded mx-auto d-block">
                </div><br><br>
                <span class="text-center logo">
                        Caixa Eletrônico - PHP
                    </span><hr>
                <li><a href=""><i class="fa fa-home"></i> Home</a></li>
                <li><a href="view/alterar_senha.php"><i class="fas fa-user"></i> Alterar senha </a></li>
                <li><a href="controller/logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a></li>
            </ul>
        </nav>
        <div class="content p-1">
            <div class="list-group-item" style="background-color: #eaeef3">
                <div class="mr-auto p-2">
                    <h2 class="text-center"> Saca Só <i class="fa fa-money-check-alt"></i></h2><br><br>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead">
                        <tr>
                            <th>TIPO DE CONTA</th>
                            <th>SALDO</th>
                            <th>AÇÕES</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($contas->listAccounts() as $account): ?>
                            <tr class="tr">
                                <td><?php echo $account['nome_conta']?></td>
                                <td><?php echo 'R$ '. number_format($account['saldo'],2,",",".");?></td>
                                <td>
                                    <form method="POST" id="form" action="view/movimentacao.php">
                                        <input type="text" class="form-control" id="currency<?= $account['id_conta']; ?>" name="valor" placeholder="Digite um valor" required>
                                        <input type="hidden" name="conta" value="<?php echo $account['id_conta']; ?>">
                                        <br>
                                        <button type="submit" id="submitBtn" name="tipo" value="deposito" class="btn btn-warning btn-xs">Depósito</button>
                                        <button type="submit" name="tipo" value="saque" class="btn btn-warning btn-xs">Saque</button>
                                        <button type="submit" name="tipo" value="transferir" class="btn btn-warning btn-xs">Transferir</button>
                                        <select name="conta_para_transferir" id="transferirconta">
                                            <option>Selecione para transferir</option>
                                            <?php foreach ($contas->listAccounts() as $conta): ?>
                                                <option value="<?php echo $conta['id_conta']?>"><?php echo $conta['nome_conta']?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button onclick="location.href='view/add_transacao.php?conta=<?php echo $account['id_conta']; ?>'" type="button" class="btn btn-warning btn-xs">Extrato</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.maskMoney.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.toast.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.url.js" type="text/javascript"></script>
    <script src="assets/js/script.js" type="text/javascript"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: login.php?access_denied');
}?>