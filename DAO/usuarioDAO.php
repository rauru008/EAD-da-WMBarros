<?php
require_once 'Conexao.php';
require_once 'UtillDAO.php';
class UsuarioDAO extends Conexao
{
    public function ValidarLogin($email, $senha)
    {
        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_usuario, nome_usuario
                         from tb_usuario
                         where email_usuario = ? and senha_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->bindValue(2, $senha);
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        $user = $sql->fetchAll();
        if (count($user) == 0) {
            return -6;
        }
            $cod = $user[0]['id_usuario'];
            $nome = $user[0]['nome_usuario'];
            UtillDAO::CriarSessao($cod, $nome);
            header("location: ../Financeiro/meus_dados.php");
            exit;
    }
    public function VerificarDuplicidade($email){
        if(trim($email) == ''){
            return 0;
        }else{
            $conexao = parent::retornaConexao();
            $comando_sql = 'select count(email_usuario) as contar
                             from tb_usuario where email_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1,$email);
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            $contar = $sql->fetchAll();
            return $contar[0]['contar'];
        }
    }
        public function VerificarDuplicidadeAlteracao($email){
        if(trim($email) == ''){
            return -5;
        }else{
            $conexao = parent::retornaConexao();
            $comando_sql = 'select count(email_usuario) as contar
                             from tb_usuario where email_usuario = ? and id_usuario != ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $email);
            $sql->bindValue(2, UtillDAO::UsuarioDAO());
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            
            $sql->execute();
            $contar = $sql->fetchAll();
            return $contar[0]['contar'];
        }
    }
    public function CadastrarUsuario($nome, $email, $senha, $repSenha)
    {
        if (empty($nome) || empty($email) || empty($senha || empty($repSenha))) {
            return 0;
        }
        if (strlen($senha) < 6){
            return -2;
        }
        if (trim($senha) != trim($repSenha)){
            return -3;
        }
        if($this->VerificarDuplicidade($email) != 0 ){
            return -5;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_usuario
                        (nome_usuario, email_usuario, senha_usuario, data_cadastro)
                        values(?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        
        $sql->bindValue(1,$nome);
        $sql->bindValue(2,$email);
        $sql->bindValue(3,$senha);
        $sql->bindValue(4, date('Y-m-d'));
        try{
            $sql->execute();
            echo "deu certo";
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    }


    public function CarregarMeusDados()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT nome_usuario, email_usuario, senha_usuario FROM tb_usuario WHERE id_usuario = ?;';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtillDAO::UsuarioDAO());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function GravarMeusDados($nome, $email, $senha)
    {
        if (empty($nome) || empty($senha) || empty($email)) {
            return 0;
        }
        if($this->VerificarDuplicidadeAlteracao($email) > 0){
            return -5;
        }
        if (strlen($senha) < 6) {
            return -2;
        }
            $conexao = parent::retornaConexao();
            $comando_sql = 'UPDATE tb_usuario SET nome_usuario = ?,  email_usuario = ?, senha_usuario = ? WHERE id_usuario = ?;';

            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $i=1;
            $sql->bindValue($i++, $nome);
            $sql->bindValue($i++, $email);
            $sql->bindValue($i++, $senha);
            $sql->bindValue($i++, UtillDAO::UsuarioDAO());

            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
            }
        }
}
