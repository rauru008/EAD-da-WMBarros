<?php
require_once '../DAO/UtillDAO.php';
UtillDAO::VerificarLogado();
require_once '../DAO/contaDAO.php';
$dao = new contaDAO();
if (isset($_GET['cod']) && is_numeric($_GET['cod'])){
    $idConta = $_GET['cod'];
    $dados = $dao->DetalharConta($idConta);

    if(count($dados) == 0){
        header('location: consultar_conta.php');
        exit;
    }

}else if(isset($_POST['btnGravar'])){
    $idConta = $_POST['cod'];
    $banco = trim($_POST['banco']);
    $agencia = trim($_POST['agencia']);
    $numero = trim($_POST['conta']);
    $saldo = trim($_POST['saldo']);

    $ret = $dao->AlterarConta($idConta,$banco, $agencia, $numero, $saldo);
    header('location: consultar_conta.php?ret='.$ret);
    exit;
}else if(isset($_POST['btnExcluir'])){
    $idConta = $_POST['cod'];
    $ret = $dao->ExcluirConta($idConta);
    header('location: consultar_conta.php?ret='.$ret);
    exit;    
}else{
    header('locatio: consultar_conta.php');
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
                        <h2>Alterar conta</h2>
                        <h5>Aqui você pode <strong>alterar</strong> todas as suas contas.</h5>
                    </div>
                </div>
                <hr />
                <form method="POST" action="alterar_conta.php">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_conta']?>?>">
                    <div class="form-group">
                        <label>Nome do banco*</label>
                        <input name="banco" id="banco" value="<?= $dados[0]['banco_conta']?>" class="form-control" placeholder="Digite o nome do banco." />
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input name="agencia" id="agencia" value="<?= $dados[0]['agencia_conta'] ?>" class="form-control" placeholder="Digite a Agência." />
                    </div>
                    <div class="form-group">
                        <label>Numero da conta*</label>
                        <input name="conta" id="numero" value="<?= $dados[0]['numero_conta'] ?>" type="number" class="form-control" placeholder="Digite o número da conta." />
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <input name="saldo" id="saldo" value="<?= $dados[0]['saldo_contacol'] ?>" type="number" class="form-control" placeholder="Digite o saldo da conta." />
                    </div>
                    <button name="btnGravar" onclick="return ValidarConta()" type="submit" class="btn btn-success">Gravar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger">Deletar</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    Deseja excluir a conta <b><?= $dados[0]['banco_conta'] ?></b> / <b><?= $dados[0]['agencia_conta'] ?></b> - <b><?= $dados[0]['numero_conta'] ?></b>  ?
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                        <button type="submit" name="btnExcluir" class="btn btn-primary">Sim</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>