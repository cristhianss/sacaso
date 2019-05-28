<?php

class Contas extends Conexao
{
    public function setTransaction($postData)
    {
        $pdo = parent::get_instance();
        if ($postData['tipo'] === 'deposito') {
            if (!$this->validaDeposito($postData)) {
                return false;
            }
            $sql = "UPDATE contas SET saldo = saldo + :valor WHERE id_conta = :id_conta";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":valor", $postData['valor']);
            $sql->bindValue(":id_conta", $postData['conta']);
            try {
                return $sql->execute();
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        } elseif ($postData['tipo'] === 'saque') {
            if (!$this->validaSaque($postData)) {
                return false;
            }
            $sql = "UPDATE contas SET saldo = saldo - :valor WHERE id_conta = :id_conta";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":valor", $postData['valor']);
            $sql->bindValue(":id_conta", $postData['conta']);
            try {
                return $sql->execute();
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        } else {
            $saldoContaARemover = $this->consultaSaldo($postData)['saldo'];
            if ($saldoContaARemover < $postData['valor']) {
                return 'nosaldo';
            }

            if ($postData['valor'] <= 0) {
                return 'saldonegativo';
            }

            if ($postData['valor'] > 999) {
                return 'maiorque999';
            }

            $isTransferenciaValida = $this->validaTransferencia($postData);
            if ($isTransferenciaValida) {
                $isValorRemovido = $this->descontaNaConta($postData);
                $isValorTransferido = $this->transfereNaConta($postData);
            } else {
                return 'salario';
            }

            if ($isValorRemovido && $isValorTransferido) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function setHistoric($postData)
    {
        $pdo = parent::get_instance();
        $sql = 'INSERT INTO historico (id_conta, tipo, valor, data_operacao) VALUES (:id_conta, :tipo, :valor, NOW())';
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_conta", $_SESSION['login']);
        $sql->bindValue(":tipo", $postData['tipo']);
        $sql->bindValue(":valor", $postData['valor']);
        try {
            $sql->execute();
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function descontaNaConta($postData)
    {
        $pdo = parent::get_instance();
        $sql = "UPDATE contas SET saldo = saldo - :valor WHERE id_conta = :id_conta";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":valor", $postData['valor']);
        $sql->bindValue(":id_conta", $postData['conta']);
        try {
            return $sql->execute();
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function transfereNaConta($postData)
    {
        $pdo = parent::get_instance();
        $sql = "UPDATE contas SET saldo = saldo + :valor WHERE id_conta = :id_conta";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":valor", $postData['valor']);
        $sql->bindValue(":id_conta", $postData['conta_para_transferir']);
        try {
            return $sql->execute();
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function validaDeposito($postData)
    {
        $valorDepositado = (int) ($postData['valor']);
        if (empty($valorDepositado)) {
            return false;
        }

        if ($valorDepositado > 0 && $valorDepositado < 1000) {
            return true;
        }
    }

    public function validaTransferencia($postData)
    {
        $contaParaTransferir = $postData['conta_para_transferir'];
        $tipoContaParaTransferir = $this->consultaTipoConta($contaParaTransferir)['tipo_conta'];

        if ($tipoContaParaTransferir === "3") {
            return false;
        }

        return true;
    }

    public function validaSaque($postData)
    {
        $saldoAtual = $this->consultaSaldo($postData)['saldo'];
        $valorSacado = (int) ($postData['valor']);
        if (empty($valorSacado)) {
            return false;
        }

        if ($valorSacado > $saldoAtual) {
            return false;
        }

        if ($valorSacado > 0 && $valorSacado < 1000) {
            return true;
        }
    }

    public function consultaSaldo($postData)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT saldo FROM contas WHERE id_conta = :id_conta";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':id_conta', $postData['conta']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
    }

    public function consultaTipoConta($tipoConta)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT tipo_conta FROM contas WHERE id_conta = :id_conta";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':id_conta', $tipoConta);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetch();
        }
    }

    public function listAccounts()
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM contas INNER JOIN tipo_conta ON (tipo_conta = id_tipo_conta) ORDER BY id_conta ASC";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll();
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function listHistoric($id_conta)
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM historico WHERE id_conta = :id_conta";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_conta",$id_conta);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll();
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function getSenhaAtual()
    {
        $pdo = parent::get_instance();
        $sql = "SELECT senha FROM usuarios WHERE id_usuario = :id_usuario";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':id_usuario', $_SESSION['login']);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
        }
    }

    public function isSenhaCorrespondente($senhaAtual)
    {
        $senhaBanco = $this->getSenhaAtual()[0]['senha'];
        if (md5($senhaAtual) === $senhaBanco) {
            return true;
        }
        return false;
    }

    public function trocaSenha($postData)
    {
        if ($this->isSenhaCorrespondente($postData['senha'])) {
            $this->novaSenhaHistorico($postData);
            $pdo = parent::get_instance();
            $sql = "UPDATE usuarios SET senha = :senha WHERE id_usuario = :id_usuario";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":senha", md5($postData['senha_nova']));
            $sql->bindValue(":id_usuario", $_SESSION['login']);
            try {
                return $sql->execute();
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
        }
        return false;
    }

    public function novaSenhaHistorico($postData)
    {
        $pdo = parent::get_instance();
        $sql = "INSERT INTO senhas (id_usuario,senha) VALUES (:id_usuario, :senha)";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_usuario", $_SESSION['login']);
        $sql->bindValue(":senha", md5($postData['senha_nova']));
            try {
                return $sql->execute();
            }
            catch (PDOException $e){
                echo $e->getMessage();
            }
    }

    public function verificaUltimasSenhas()
    {
        $pdo = parent::get_instance();
        $sql = 'SELECT * FROM senhas WHERE id_usuario = :id_usuario ORDER BY id_senha DESC LIMIT 3';
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_usuario", $_SESSION['login']);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }

    }

    public function verificaSenhaAtual()
    {
        $pdo = parent::get_instance();
        $sql = 'SELECT senha FROM usuarios WHERE id_usuario = :id_usuario';
        $sql = $pdo->prepare($sql);
        $sql->bindValue(":id_usuario", $_SESSION['login']);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
        }
        catch (PDOException $e){
            echo $e->getMessage();
        }

    }

    /**
     * @param $agencia
     * @param $conta
     * @param $senha
     */
    public function setLogged($cpf, $senha)
    {
        $pdo = parent::get_instance();
        $sql = 'SELECT * FROM usuarios WHERE cpf = :cpf AND senha = :senha';
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['login'] = $sql['id_usuario'];

            header("Location: ../index.php?login_success");
            exit;
        } else {
            header("Location: ../index.php?not_login");
        }
    }

    public function logout()
    {
        unset($_SESSION['login']);
    }
}
