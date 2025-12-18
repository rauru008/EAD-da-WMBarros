<?php
require_once '../DAO/UtillDAO.php';
require_once '../DAO/usuarioDAO.php';
if (isset($_POST['btnAcessar'])){
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    $objDAO = new UsuarioDAO();

    $ret = $objDAO->ValidarLogin($email, $senha);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php';?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2> sistema de controle Financeiro Web</h2>
                <h5>( Efetuar login )</h5>
                <br />
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <?php include_once '_msg.php'; ?>
                        <strong>Entre com seus dados.</strong>
                    </div>
                    <div class="panel-body">
                            <br />
                            <form method="POST" action="index.php">
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                    <input type="email" name="email" id="emailUsuario" class="form-control" placeholder="Seu E-mail " />
                                </div>
                                <div class="form-group input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="senha" id="senha" class="form-control" placeholder="Sua senha" />
                                </div>
                                <button onclick="return ValidarLogin()" class="btn btn-primary" name="btnAcessar">Acessar</button>
                            </form>
                            <hr />
                            <span>Não registrado?</span> <a href="cadastro.php">clique aqui!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>