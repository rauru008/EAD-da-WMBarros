<?php
require_once '../DAO/UtillDAO.php';
UtillDAO::VerificarLogado();
require_once '../DAO/empresaDAO.php';
if(isset($_POST['btnGravar'])){
    $empresa = trim($_POST['empresa']);
    $telefone = trim($_POST['telefone']);
    $endereco = trim($_POST['endereco']);
    $objDAO = new empresaDAO();
    $ret = $objDAO->CadastrarEmpresa($empresa, $telefone, $endereco);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php include_once '_head.php' ?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php';?>
                        <h2>Cadastrar uma nova Empresa</h2>
                        <h5>Aqui você pode cadastrar todos as suas Empresas.</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="nova_empresa.php">
                    <div class="form-group">
                        <label>Nome da Empresa*</label>
                        <input name="empresa" id="nomeEmp" value="<?= isset($empresa) ? $empresa : ''?>" class="form-control" placeholder="Digite o nome da Empresa. Exemplo: Casas Bahia." maxlength="45" />
                    </div>
                    <div class="form-group">
                        <label>Telefone*</label>
                        <input name="telefone" id="telefone" value="<?= isset($telefone) ? $telefone : ''?>" class="form-control" placeholder="Digite o numero de telefone da empresa(Opcional)." maxlength="15" />
                    </div>
                    <div class="form-group">
                        <label>Endereço*</label>
                        <input name="endereco" id="endereco" value="<?= isset($endereco) ? $endereco : ''?>" class="form-control" placeholder="Digite o endereço da empresa(Opcional)." maxlength="100"/>
                    </div>
                    <button name="btnGravar" onclick="return ValidarEmpresa()" type="submit" class="btn btn-success">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>