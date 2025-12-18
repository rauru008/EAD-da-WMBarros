<?php
require_once 'Conexao.php';
require_once 'UtillDAO.php';

class empresaDAO extends Conexao
{
    public function CadastrarEmpresa($nome, $telefone, $endereco)
    {
        if (trim(empty($nome))) {
            return 0;
        } else {
            $conexao = parent::retornaConexao();
            $comando_sql = 'insert into tb_empresa
                                (nome_empresa, telefone_empresa, endereco_empresa, id_usuario)
                                value(?,?,?,?)';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1,$nome);
            $sql->bindValue(2,$telefone);
            $sql->bindValue(3,$endereco);
            $sql->bindValue(4,UtillDAO::UsuarioDAO());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
    }

    public function ConsultarEmpresa(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_empresa,
                            nome_empresa,
                            telefone_empresa,
                            endereco_empresa
                            from tb_empresa
                            where id_usuario = ? order by nome_empresa ASC';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtillDAO::UsuarioDAO());
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll(); 
    }

    public function AlterarEmpresa($idEmpresa, $nome, $telefone, $endereco){
        if(trim(empty($nome)) || $idEmpresa == ''){
            return 0;
        }else{
            $conexao = parent::retornaConexao();
            $commando_sql = 'update tb_empresa
                                set nome_empresa = ?,
                                    telefone_empresa = ?,
                                    endereco_empresa = ?
                                    where id_empresa = ?
                                    and id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($commando_sql);

            $sql->bindValue(1, $nome);
            $sql->bindValue(2, $telefone);
            $sql->bindValue(3, $endereco);
            $sql->bindValue(4, $idEmpresa);
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

    public function DetalharEmpresa($idEmpresa){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_empresa,
                            nome_empresa,
                            telefone_empresa,
                            endereco_empresa
                            from tb_empresa
                            where id_empresa = ?
                            and id_usuario = ?';  
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtillDAO::UsuarioDAO());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();

    }

    public function DeletarEmpresa($idEmpresa){
        if(trim(empty($idEmpresa))){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql =  'delete
                            from tb_empresa
                            where id_empresa = ?
                            and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
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
