<?php
require_once 'UtillDAO.php';
require_once 'Conexao.php';

class movimentoDAO extends Conexao
{
    public function RealizarMovimento($tipo, $data, $valor, $obs, $categoria, $empresa, $conta)
    {
        if (empty($tipo) || empty($data) || empty($valor) || empty($categoria) || empty($empresa) || empty($conta)) {
            return 0;
        } else {
            $conexao = parent::retornaConexao();
            $comando_sql = 'INSERT INTO
                                tb_movimento
                                (tipo_movimento, data_movimento, valor_movimento, obs_movimento, id_empresa, id_conta, id_categoria, id_usuario)
                                VALUES
                                (?,?,?,?,?,?,?,?)';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $i = 1;
            $sql->bindValue($i++, $tipo);
            $sql->bindValue($i++, $data);
            $sql->bindValue($i++, $valor);
            $sql->bindValue($i++, $obs);
            $sql->bindValue($i++, $empresa);
            $sql->bindValue($i++, $conta);
            $sql->bindValue($i++, $categoria);
            $sql->bindValue($i++, UtillDAO::UsuarioDAO());

            $conexao->beginTransaction();
            try {
                $sql->execute();
                if ($tipo == 1) {
                    $comando_sql = 'UPDATE tb_conta
                                    SET saldo_contacol = saldo_contacol + ? WHERE id_conta = ?;';
                } else if ($tipo == 2) {
                    $comando_sql = 'UPDATE tb_conta 
                                    SET saldo_contacol = saldo_contacol - ? WHERE id_conta = ?;';
                }
                $sql = $conexao->prepare($comando_sql);
                $sql->bindValue(1, $valor);
                $sql->bindValue(2, $conta);

                $sql->execute();
                $conexao->commit();

                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                $conexao->rollBack();
                return -1;
            }
        }
    }

    public function FiltrarMovimento($tipoMov, $dtInicio, $dtFinal)
    {
        if (empty($dtInicio) || empty($dtFinal)) {
            return 0;
        }else{
            $conexao = parent::retornaConexao();
            $comando_sql = 'select id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento,
                            date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                            valor_movimento,
                            nome_categoriacol,
                            nome_empresa,
                            banco_conta,
                            numero_conta,
                            agencia_conta,
                            obs_movimento
                            from tb_movimento
                            inner join tb_categoria
                            on tb_categoria.id_categoria = tb_movimento.id_categoria
                            inner join tb_empresa
                            on tb_empresa.id_empresa = tb_movimento.id_empresa
                            inner join tb_conta
                            on tb_conta.id_conta = tb_movimento.id_conta
                            where tb_movimento.id_usuario = ?
                            and tb_movimento.data_movimento between ? and ?';
            if ($tipoMov != 0) {
                $comando_sql = $comando_sql . 'and tipo_movimento = ?';
            }
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, UtillDAO::UsuarioDAO());
            $sql->bindValue(2, $dtInicio);
            $sql->bindValue(3, $dtFinal);
            if ($tipoMov != 0) {
                $sql->bindValue(4, $tipoMov);
            }
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
            return 1;
        }
    }
    public function ExcluirMovimento($idMovimento, $idConta, $valor, $tipo)
    {
        if (empty($idMovimento) || empty($idConta) || empty($valor) || empty($tipo)) {
            return 0;
        } else {
            $conexao = parent::retornaConexao();
            $comando_sql = 'delete from tb_movimento where id_movimento = ?';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $idMovimento);

            $conexao->beginTransaction();
            try {
                $sql->execute();
                if ($tipo == 1) {
                    $comando_sql = 'update tb_conta set
                                    saldo_contacol = saldo_contacol - ?
                                    where id_conta = ?';
                } else if ($tipo == 2) {
                    $comando_sql = 'update tb_conta set
                                    saldo_contacol = saldo_contacol + ?
                                    where id_conta = ?';
                }
                $sql = $conexao->prepare($comando_sql);
                $sql->bindValue(1, $valor);
                $sql->bindValue(2, $idConta);

                $sql->execute();

                $conexao->commit();
                return 1;
            } catch (Exception $ex) {
                echo $ex->getMessage();
                return -1;
            }
        }
    }
    public function TotalDeEntrada() {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select sum(valor_movimento) as total_entrada
                        from tb_movimento
                        where tipo_movimento = 1
                        and id_usuario = ?'; 
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtillDAO::UsuarioDAO());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
    public function TotalDeSaida() {
                $conexao = parent::retornaConexao();
        $comando_sql = 'select sum(valor_movimento) as total_saida
                        from tb_movimento
                        where tipo_movimento = 2
                        and id_usuario = ?'; 
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtillDAO::UsuarioDAO());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function DezUltimosMovimentos(){
            $conexao = parent::retornaConexao();
            $comando_sql = 'select id_movimento,
                            tb_movimento.id_conta,
                            tipo_movimento,
                            date_format(data_movimento, "%d/%m/%Y") as data_movimento,
                            valor_movimento,
                            nome_categoriacol,
                            nome_empresa,
                            banco_conta,
                            numero_conta,
                            agencia_conta,
                            obs_movimento
                            from tb_movimento
                            inner join tb_categoria
                            on tb_categoria.id_categoria = tb_movimento.id_categoria
                            inner join tb_empresa
                            on tb_empresa.id_empresa = tb_movimento.id_empresa
                            inner join tb_conta
                            on tb_conta.id_conta = tb_movimento.id_conta
                            where tb_movimento.id_usuario = ?
                            order by tb_movimento.id_movimento DESC limit 10';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, UtillDAO::UsuarioDAO());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
            return 1;
        }
}
