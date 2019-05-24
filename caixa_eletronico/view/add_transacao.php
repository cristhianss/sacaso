<!-- PHP - Incluindo Arquivos Necessarios -->
<?php

session_start();

if (isset($_SESSION['login'])) {

include_once '../model/Conexao.php';
include_once '../model/Contas.php';

$contas = new Contas();

$id = $_POST['id_conta'];
    ?>

    <!-- Fim - PHP -->



    <!-- HTML -Incluindo Arquivos CSS3, Bootstrap 4, etc -->
    <!DOCTYPE html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="../assets/img/icon.jpg">
    <title>Caixa Eletrônico - Informações/Transações</title>
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap/bootstrap.min.css">
    <!-- CSS da INDEX -->
    <link rel="stylesheet" href="../assets/css/index.css">
    <!-- GoogleFonts - OpenSans -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Fontawesome 5.0-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <!-- Fim - Arquivos -->
                    <!-- Formulario JQuery -->

                <!-- Tabela de Historico -->


                <h3 class="text-center">
                    Movimentação/Extrato <i class="fa fa-folder-open"></i>
                </h3><br>

                <div class="table-responsive">


                    <table class="table table-hover">
                        <thead class="thead" style="text-align: center;">
                        <tr>
                            <th>Data da Transação</th>
                            <th>Valor da Transação</th>
                            <th>Tipo da Transação</th>
                        </tr>
                        </thead>
                        <tbody style="text-align: center;">
                            <?php foreach($contas->listHistoric($id) as $historic) :?>
                        <tr>
                            <td>
                                <?php echo date("d/m/Y H:m:s", strtotime($historic['data_operacao']));?>
                            </td>

                            <td style="color: green;">
                                <?php echo $historic['valor']; ?>
                            </td>

                            <td>
                                <?php echo $historic['tipo']; ?>
                            </td>
                        </tr>
                                <?php endforeach;?>
                        </tbody>
                    </table>


                </div>

            </div>

            <!-- Fim da Tabela -->

        </div>
    </div>

    <script type="text/javascript" src="../assets/js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/script.js"></script>
<?php
}?>