<?php
require_once 'Conexao.php';
require_once 'UtillDAO.php';
class CategoriaDAO extends Conexao{
public function CadastrarCategoria($nome){
        if(empty(trim($nome))){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_categoria
                        (nome_categoriacol, id_usuario)
                        value (?, ?);';

        $slq = new PDOStatement();

        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtillDAO::UsuarioDAO());

        try{
            $sql->execute();

            return 1;
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }
    } 

public function ExcluirCategoria($id_categoria){
    if($id_categoria == ''){
        return 0; 
    }

    $conexao = parent::retornaConexao();

    $comando_sql = 'delete
                    from tb_categoria
                    where id_categoria = ?
                    and id_usuario = ?';
    $sql = new PDOStatement();
    $sql = $conexao->prepare($comando_sql);

    $sql->bindValue(1, $id_categoria);
    $sql->bindValue(2, UtillDAO::UsuarioDAO());

    try{
        $sql->execute();
        return 1;
    }catch(Exception $ex){
        return -4;
    }
}

public function ConsultarCategoria(){
    $conexao = parent::retornaConexao();

    $comando_sql = 'select id_categoria,
                            nome_categoriacol
                            from tb_categoria
                            where id_usuario = ? order by nome_categoriacol ASC';
    $sql = new PDOStatement();
    $sql = $conexao->prepare($comando_sql);
    $sql->bindValue(1, UtillDAO::UsuarioDAO());

    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $sql->execute();
    return $sql->fetchAll();

}

public function AlteralCategoria($nome, $id_categoria){
    if(trim($nome) == '' || $id_categoria == ''){
        return 0;
    }

    $conexao = parent::retornaConexao();
    $comando_sql = 'update tb_categoria
                        set nome_categoriacol = ?
                        where id_categoria = ?
                        and id_usuario = ?';
    $sql = new PDOStatement();
    $sql = $conexao->prepare($comando_sql);
    
    $sql->bindValue(1, $nome);
    $sql->bindValue(2, $id_categoria);
    $sql->bindValue(3, UtillDAO::UsuarioDAO());

    try{
        $sql->execute();
        return 1;
    }
    catch(Exception $ex){
        echo $ex->getMessage();
        return -1;

    }
     
}

public function DetalharCategoria($id_categoria){
    $conexao = parent::retornaConexao();
    $comando_sql = 'select id_categoria,
                        nome_categoriacol
                        from tb_categoria
                        where id_categoria = ?
                        and id_usuario = ?';
    $sql = new PDOStatement ();
    $sql = $conexao->prepare($comando_sql);
    $sql->bindValue(1, $id_categoria);
    $sql->bindValue(2, UtillDAO::UsuarioDAO());
    
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $sql->execute();
    return $sql->fetchAll();
}

}



?>
