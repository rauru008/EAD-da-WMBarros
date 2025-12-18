<?php 
require_once '../DAO/UtillDAO.php';
require_once '../DAO/empresaDAO.php';
UtillDAO::VerificarLogado();
$dao = new empresaDAO();
$empresas = $dao->ConsultarEmpresa();
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Consultar Empresa</h2>
                        <h5>Consulte todas as suas empresas aqui.</h5> 
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
                                                <th>Nome da Empresa</th>
                                                <th>Telefone da Empresa</th>
                                                <th>Endereço da Empresa</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($empresas as $item){?>
                                            <tr class="odd gradeX">
                                                <td><?= $item['nome_empresa']?></td>
                                                <td><?= $item['telefone_empresa']?></td>
                                                <td><?= $item['endereco_empresa']?></td>
                                                <td>
                                                    <a href="alterar_empresas.php?cod=<?= $item['id_empresa']?>" class="btn btn-warning btn-sm">Alterar</a>
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