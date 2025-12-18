<?php
require_once '../DAO/UtillDAO.php';
require_once '../DAO/contaDAO.php';
UtillDAO::VerificarLogado();
$dao = new contaDAO();
$contas = $dao->ConsultarConta();
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
                        <h2>Consultar Contas</h2>
                        <h5>Consulte todas as suas Contas aqui.</h5> 
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <span>Empresas cadastradas.</span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Nome do banco</th>
                                                <th>Agência</th>
                                                <th>Número da conta</th>
                                                <th>Saldo</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php foreach($contas as $itens) {?>
                                            <tr class="odd gradeX">
                                                <td><?= $itens['banco_conta']?></td>
                                                <td><?= $itens['agencia_conta']?></td>
                                                <td><?= $itens['numero_conta']?></td>
                                                <td>R$<?= number_format($itens['saldo_contacol'], 2, ',', '.');?></td>
                                                <td>
                                                    <a href="alterar_conta.php?cod=<?= $itens['id_conta']?>" class="btn btn-warning btn-sm">Alterar</a>
                                                </td>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>