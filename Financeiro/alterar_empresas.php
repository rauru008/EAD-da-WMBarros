<?php
require_once '../DAO/UtillDAO.php';
require_once '../DAO/empresaDAO.php';
UtillDAO::VerificarLogado();
$dao = new empresaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idEmpresa = $_GET['cod'];
    $dados = $dao->DetalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btnGravar'])) {
    $idEmpresa = $_POST['cod'];
    $nome = $_POST['empresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $ret = $dao->AlterarEmpresa($idEmpresa, $nome, $telefone, $endereco);
    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btnExcluir'])) {
    $idEmpresa = $_POST['cod'];

    $ret = $dao->DeletarEmpresa($idEmpresa);
    header('location: consultar_empresa.php?ret='.$ret);
    exit;
} else {
    header('location: consultar_empresa.php');
    exit;
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Alterar ou excluir uma empresa</h2>
                        <h5>Aqui você pode <strong>alterar</strong> e deletar suas empresas.</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="alterar_empresas.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_empresa'] ?>">
                    <div class="form-group">
                        <label>Nome da Empresa*</label>
                        <input name="empresa" id="nomeEmp" value="<?= $dados[0]['nome_empresa'] ?>" class="form-control" placeholder="Digite o nome da Empresa. Exemplo: Casas Bahia." />
                    </div>
                    <div class="form-group">
                        <label>Telefone*</label>
                        <input name="telefone" id="telefone" value="<?= $dados[0]['telefone_empresa'] ?>" class="form-control" placeholder="Digite o numero de telefone da empresa(Opcional)." />
                    </div>
                    <div class="form-group">
                        <label>Endereço*</label>
                        <input name="endereco" id="endereco" value="<?= $dados[0]['endereco_empresa'] ?>" class="form-control" placeholder="Digite o endereço da empresa(Opcional)." />
                    </div>
                    <button name="btnGravar" onclick="return ValidarEmpresa()" type="submit" class="btn btn-success">Gravar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Deletar</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a empresa <b><?= $dados[0]['nome_empresa'] ?></b> ?
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                        <button type="submit" name="btnExcluir" class="btn btn-primary">Sim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>