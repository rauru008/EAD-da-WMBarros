<?php
require_once '../DAO/UtillDAO.php';
UtillDAO::VerificarLogado();
require_once '../DAO/movimentoDAO.php';
$dao = new movimentoDAO();
$movs = $dao->DezUltimosMovimentos();
$totalEntrada = $dao->TotalDeEntrada();
$totalSaida = $dao->TotalDeSaida()

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
                        <h2>Página inicial</h2>
                        <h5>Aqui você acompanha todos os números de uma forma geral.</h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3> <?= $totalEntrada[0]['total_entrada'] != '' ? 'R$'.number_format($totalEntrada[0]['total_entrada'], 2, ',', '.') : 'Sem movimentação' ?></h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            Total de entrada

                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3> <?= $totalSaida[0]['total_saida'] != '' ? 'R$'.number_format($totalSaida[0]['total_saida'], 2, ',', '.') : 'Sem movimentação'?></h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Total de saída

                        </div>
                    </div>
                </div>
                <hr>
                <?php if (count($movs) > 0) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span>Últimos dez lançamentos.</span>
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
                <?php }else{ ?>
                    <center
                    <div class="alert alert-info col-md-12">
                        Nenhum movimento encontrado.
                    </div>
                </center>
                    <?php }?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>