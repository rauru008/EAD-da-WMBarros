<?php
require_once '../DAO/usuarioDAO.php';
if (isset($_POST['btnFinalizar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $repSenha = $_POST['repSenha'];

    $objDAO = new UsuarioDAO();
    $ret = $objDAO->CadastrarUsuario($nome, $email, $senha, $repSenha);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php include_once '_head.php' ?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <?php include_once '_msg.php';?>
                <br /><br />
                <h2> Controle Finnceir: Cadastro</h2>
                <h5>( Faça seu cadastro )</h5>
                <br />
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencher todos os campos </strong>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="cadastro.php">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                                <input type="text" name="nome" id="nomeUsuario" class="form-control" placeholder="Seu nome" maxlength="10" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" name="email" id="emailUsuario" class="form-control" placeholder="Seu e-mail" maxlength="50"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i>Senha</span>
                                <input type=""  id="senha"  class="form-control" placeholder="Crie uma senha (Mínimo de 6 caracteres)" name="senha" maxlength="20"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock">Repetir</i></span>
                                <input type=""  id="repSenha" class="form-control" placeholder="Repita a senha criada" name="repSenha" maxlength="20"/>
                            </div>
                            <button name="btnFinalizar" type="submit" class="btn btn-success" onclick="return ValidarCadastro()">Finalizar Cadastro</button>
                            <hr />
                        </form>
                    <span>Já possui cadastro?</span> <a href="index.php">Clique aqui!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>