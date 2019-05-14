<?php

class Contas extends Conexao
{

    public function setTransaction($tipo, $valor)
    {
        $pdo = parent::get_instance();
        if ($tipo == 'deposito') {
            $sql = "UPDATE contas SET saldo = saldo + :valor WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":valor", $valor);
            $sql->bindValue(":id", $_SESSION['login']);
            return $sql->execute();
        } else {
            $sql = "UPDATE contas SET saldo = saldo - :valor WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue(":valor", $valor);
            $sql->bindValue(":id", $_SESSION['login']);
            return $sql->execute();
        }
    }

    public function listAccounts()
    {
        $pdo = parent::get_instance();
        $sql = "SELECT * FROM contas ORDER BY id ASC";
        $sql = $pdo->prepare($sql);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return $sql->fetchAll();
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
        $sql = 'SELECT * FROM contas WHERE cpf = :cpf AND senha = :senha';
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':cpf', $cpf);
        $sql->bindValue(':senha', $senha);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();

            $_SESSION['login'] = $sql['id'];

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
