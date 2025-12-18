<?php
require_once 'Conexao.php';
require_once 'UtillDAO.php';

class contaDAO extends Conexao{
    public function CadastrarConta($banco, $agencia, $numero, $saldo){
        if(empty($banco) || empty($agencia) || empty($numero) || empty($saldo)){
            return 0;
        }else{
            $conexao = parent::retornaConexao();
            $comando_sql = 'insert into 
                            tb_conta
                            (banco_conta, agencia_conta, numero_conta, saldo_contacol, id_usuario)
                            value(?,?,?,?,?)';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $banco);
            $sql->bindValue(2, $agencia);
            $sql->bindValue(3, $numero);
            $sql->bindValue(4, $saldo);
            $sql->bindValue(5, UtillDAO::UsuarioDAO());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function ConsultarConta(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_conta,
                            banco_conta,
                            agencia_conta,
                            numero_conta,
                            saldo_contacol
                            from tb_conta
                            where id_usuario = ? order by banco_conta ASC';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtillDAO::UsuarioDAO());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->FetchAll();



    }
    public function DetalharConta($idConta){
        if($idConta == ''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_conta,
                            banco_conta,
                            agencia_conta,
                            numero_conta,
                            saldo_contacol
                            from tb_conta
                            where id_conta = ?
                            and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtillDAO::UsuarioDAO());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();

    }
    public function AlterarConta( $idConta,$banco, $agencia, $numero, $saldo){
        if(empty($banco) || empty($agencia) || empty($numero) || empty($saldo) || empty($idConta)){
            return 0;
        }else{
            $conexao = parent::retornaConexao();
            $comando_sql = 'update tb_conta
                                set banco_conta = ?,
                                    agencia_conta = ?,
                                    numero_conta = ?,
                                    saldo_contacol = ?
                                    where id_conta = ?
                                    and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $banco);
            $sql->bindValue(2, $agencia);
            $sql->bindValue(3, $numero);
            $sql->bindValue(4, $saldo);
            $sql->bindValue(5, $idConta);
            $sql->bindValue(6, UtillDAO::UsuarioDAO());

        }try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
        
    }
    public function ExcluirConta($idConta){
        if($idConta == ''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'delete
                        from tb_conta
                        where id_conta = ?
                        and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtillDAO::UsuarioDAO());

        try{
        $sql->execute();
        return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -4;
        }
    }
}
?>