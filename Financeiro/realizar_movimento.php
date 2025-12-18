<?php
require_once '../DAO/UtillDAO.php';
UtillDAO::VerificarLogado();
require_once '../DAO/movimentoDAO.php';
require_once '../DAO/categoriaDAO.php';
require_once '../DAO/contaDAO.php';
require_once '../DAO/empresaDAO.php';

$objCategoria = new CategoriaDAO();
$objEmpresa = new empresaDAO();
$objConta = new contaDAO();
if(isset($_POST['btnGravar'])){
    $data = $_POST['data'];
    $valor = trim($_POST['valor']);
    $categoria = $_POST['categoria'];
    $tipoMov = $_POST['tipoMov'];
    $empresa = $_POST['empresa'];
    $obser = trim($_POST['obser']);
    $conta = $_POST['conta'];

    $objDAO = new movimentoDAO();
    $ret = $objDAO->RealizarMovimento($tipoMov, $data, $valor, $obser, $categoria, $empresa, $conta);
}
$categorias = $objCategoria->ConsultarCategoria();
$empresas = $objEmpresa->ConsultarEmpresa();
$contas = $objConta->ConsultarConta();
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
                        <h2>Realizar movimento</h2>
                        <h5>Aqui você pode realizar seus movimentos de entrada ou saída.</h5>
                        <?php include_once '_msg.php';?>
                    </div>
                </div>
                <hr />
                <form method="post">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo de movimento*</label>
                            <select name="tipoMov" id="tipo" class="form-control">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">saída</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data*</label>
                            <input id="data" name="data" type="date" class="form-control" placeholder="Digite a data do movimento." />
                        </div>
                        <div class="form-group">
                            <label>Valor(R$)</label>
                            <input id="valor" name="valor" class="form-control" placeholder="Digite o valor do movimento." />
                        </div>
                    </div>
                    <div class="col-md-6">

                        <div class="form-group">
                            <label>Selecione uma categoria</label>
                            <select id="categoria" name="categoria" class="form-control">
                                <option value="">Selecione</option>
                                <?php for($i=0; $i < count($categorias); $i++){ ?> 
                                    <option value="<?= $categorias[$i]['id_categoria'] ?>"><?= $categorias[$i]['nome_categoriacol']?></option>
                                <?php }?>
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa*</label>
                            <select id="empresa" name="empresa" class="form-control">
                                <option value="">Selecione</option>
                                <?php for($i=0; $i < count($empresas); $i++) { ?>
                                    <option value="<?= $empresas[$i]['id_empresa'] ?>"><?= $empresas[$i]['nome_empresa']?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta*</label>
                            <select id="conta" name="conta" class="form-control">
                                <option value="">Selecione</option>
                                <?php for($i=0; $i < count($contas); $i++) { ?>
                                    <option value="<?= $contas[$i]['id_conta'] ?>"><?= $contas[$i]['banco_conta']. ' - R$ '. number_format($contas[$i]['saldo_contacol'], 2, ',', '.') ?></option>
                                <?php }?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação(Opcional)</label>
                            <textarea id="obser" name="obser" class="form-control" rows="3" maxlength="200"></textarea>
                        </div>
                        <button name="btnGravar" onclick="return RealizarMovimento()" type="submit" class="btn btn-success">Finalizar lançamento</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>