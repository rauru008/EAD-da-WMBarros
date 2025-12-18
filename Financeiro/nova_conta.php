<?php 
    require_once '../DAO/UtillDAO.php';
UtillDAO::VerificarLogado();
    require_once '../DAO/contaDAO.php';
    if(isset($_POST['btnGravar'])){
        $banco = trim($_POST['banco']);
        $agencia = trim($_POST['agencia']);
        $conta = trim($_POST['conta']);
        $saldo = trim($_POST['saldo']);

        $objDAO = new contaDAO();
        $ret = $objDAO->CadastrarConta($banco, $agencia, $conta, $saldo);

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
                        <h2>Nova conta</h2>
                        <h5>Aqui você pode cadastrar todas as suas contas.</h5>
                    </div>
                </div>
                <hr />
                <form method="POST" action="nova_conta.php">
                    <div class="form-group">
                        <label>Nome do banco*</label>
                        <input name="banco" id="banco" value="<?= isset($banco) ? $banco : ''?>" class="form-control" placeholder="Digite o nome do banco." maxlength="20" />
                    </div>
                    <div class="form-group">
                        <label>Agência*</label>
                        <input name="agencia" id="agencia" value="<?= isset($agencia) ? $agencia : ''?>" class="form-control" placeholder="Digite a Agência." maxlength="8" />
                    </div>
                    <div class="form-group">
                        <label>Numero da conta*</label>
                        <input name="conta" id="numero" value="<?= isset($conta) ? $conta : ''?>" type="number" class="form-control" placeholder="Digite o número da conta." maxlength="12" />
                    </div>
                    <div class="form-group">
                        <label>Saldo*</label>
                        <input name="saldo" id="saldo" value="<?= isset($saldo) ? $saldo : ''?>" type="number" class="form-control" placeholder="Digite o saldo da conta." />
                    </div>
                    <button name="btnGravar" onclick="return ValidarConta()" type="submit" class="btn btn-success">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>