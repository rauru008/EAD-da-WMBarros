<?php
require_once '../DAO/UtillDAO.php';
require_once '../DAO/movimentoDAO.php';
UtillDAO::VerificarLogado();
$tipoMov = '';
$dtInicio = '';
$dtFinal = '';
if (isset($_POST['btnPesquisar'])) {
    $tipoMov = $_POST['tipoMov'];
    $dtInicio = $_POST['dtInicio'];
    $dtFinal = $_POST['dtFinal'];

    $objDAO = new movimentoDAO();
    $movs = $objDAO->FiltrarMovimento($tipoMov, $dtInicio, $dtFinal);
}else if(isset($_POST['btnExcluir'])){
    $idMov = $_POST['idMov'];
    $idConta = $_POST['idConta'];
    $tipo = $_POST['tipo'];
    $valor = $_POST['valor'];

    $DAO = new movimentoDAO();
    $ret = $DAO->ExcluirMovimento($idMov, $idConta, $valor, $tipo);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include_once '_head.php' ?>
</head>

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
                        <?php include_once '_msg.php'; ?>
                        <h2>Consultar movimento</h2>
                        <h5>Consulte todos os movimentos em um determinado período.</h5>
                        <?php include_once '_msg.php'; ?>
                    </div>
                </div>
                <hr />
                <form action="consultar_movimento.php" method="POST">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Selecione um Tipo de movimento*</label>
                            <select class="form-control" name="tipoMov" id="tipoMov">
                                <option value="0" <?= $tipoMov == 0 ? 'selected' : '' ?>>TODOS</option>
                                <option value="1" <?= $tipoMov == 1 ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipoMov == 2 ? 'selected' : '' ?>>saída</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Inicial*</label>
                            <input type="date" class="form-control" name="dtInicio" id="dtInicio" value="<?= isset($dtInicio) ? $dtInicio : '' ?>" placeholder="Digite a data do movimento." />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Final*</label>
                            <input type="date" class="form-control" name="dtFinal" id="dtFinal" value="<?= isset($dtFinal) ? $dtFinal : '' ?>" placeholder="Digite a data do movimento." />
                        </div>
                    </div>
                    <center>
                        <button class="btn btn-info" onclick="return ConsultarMovimento()" name="btnPesquisar">Pesquisar</button>
                    </center>
                </form>
                <hr>
                <?php if (isset($movs)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span>Resultado encontrado.</span>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;

                                                for ($i = 0; $i < count($movs); $i++) {
                                                    if ($movs[$i]['tipo_movimento'] == 1) {
                                                        $total = $total + $movs[$i]['valor_movimento'];
                                                    } else if($movs[$i]['tipo_movimento'] == 2){
                                                        $total = $total - $movs[$i]['valor_movimento'];
                                                    }
                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $movs[$i]['data_movimento'] ?></td>
                                                        <td style="color: <?= $movs[$i]['tipo_movimento'] == 1 ? 'green' : 'red' ?>;"><?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?></td>
                                                        <td><?= $movs[$i]['nome_categoriacol'] ?></td>
                                                        <td><?= $movs[$i]['nome_empresa'] ?></td>
                                                        <td><?= $movs[$i]['banco_conta'] ?> / Ag. <?= $movs[$i]['agencia_conta'] ?> - núm. <?= $movs[$i]['numero_conta'] ?></td>
                                                        <td>R$<?= $movs[$i]['valor_movimento'] ?></td>
                                                        <td><?= $movs[$i]['obs_movimento'] != '' ? $movs[$i]['obs_movimento'] : 'Sem Observação' ?></td>
                                                        <td>
                                                            <form method="post" action="consultar_movimento.php">
                                                                <a href="#" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExcluir<?= $i ?>" >Excluir</a>
                                                                <input type="hidden" name="idMov" value="<?= $movs[$i]['id_movimento'] ?>">
                                                                <input type="hidden" name="idConta" value="<?= $movs[$i]['id_conta'] ?>">
                                                                <input type="hidden" name="tipo" value="<?= $movs[$i]['tipo_movimento'] ?>">
                                                                <input type="hidden" name="valor" value="<?= $movs[$i]['valor_movimento'] ?>">
                                                                <div class="modal fade" id="modalExcluir<?= $i ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <center><b>Deseja excluir o moviment:</b></center><br><br>
                                                                                <b>Data do movimento:</b> <?= $movs[$i]['nome_empresa'] ?><br>
                                                                                <b>Tipo do movimento:</b> <?= $movs[$i]['tipo_movimento'] == 1 ? 'Entrada' : 'Saída' ?><br>
                                                                                <b>Nome categoria:</b> <?= $movs[$i]['nome_categoriacol'] ?><br>
                                                                                <b>Nome empresa:</b> <?= $movs[$i]['nome_empresa'] ?><br>
                                                                                <b>A conta usada:</b> <?= $movs[$i]['banco_conta'] ?> / Ag. <?= $movs[$i]['agencia_conta'] ?> - núm. <?= $movs[$i]['numero_conta'] ?><br>
                                                                                <b>Valor do movimento:</b> R$ <?= $movs[$i]['valor_movimento'] ?><br>
                                                                                <b>Observação:</b> <?= $movs[$i]['obs_movimento'] != '' ? $movs[$i]['obs_movimento'] : 'Sem Observação' ?>
                                                                                <div class="modal-footer">  
                                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                                                                    <button type="submit" name="btnExcluir" class="btn btn-primary">Sim</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style='color: <?= $total < 0 ? 'red' : 'green' ?>;'>Total: R$ <?= number_format($total, 2, ',', '.'); ?></label>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>