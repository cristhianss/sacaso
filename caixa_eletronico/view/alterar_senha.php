<!DOCTYPE html>
<html>
<head>
    <title>Caixa Eletrônico - Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/icon.jpg">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/bootstrap.min.css">
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
    <!-- GoogleFonts - OpenSans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Fontawesome 5.0-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="col-md-12 col-md-offset-6">
        <h1> Caixa Eletrônico - Alterar senha</h1>
        <form method="POST" class="log" action="../controller/alterarSenhaController.php">
            <br><br><p>Digite sua senha atual e uma nova senha:</p><br>
            <input type="password" name="senha" class="form-control field" placeholder="Digite sua senha atual" autofocus required><br>
            <input type="password" name="senha_nova" class="form-control field" placeholder="Digite uma nova senha" required><br>
            <input type="password" name="conf_senha_nova" class="form-control field" placeholder="Digite novamente a nova senha" required><br>
            <button class="btn btn-default" type="submit">
                <i class="fa fa-lock"></i> Alterar senha
            </button><br><br>
        </form>
        <p id="credits">&copy; SacaSó - <?php echo date("Y"); ?> - Todos os direitos Reservados</p>
    </div>
</div>
</body>
</html>