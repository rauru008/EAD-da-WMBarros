<?php
require_once '../DAO/UtillDAO.php';
require_once '../DAO/categoriaDAO.php';
UtillDAO::VerificarLogado();
$dao = new CategoriaDAO();
$categorias = $dao->ConsultarCategoria();
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
                        <h2>Consultar Categoria</h2>
                        <h5>Consulte todas as suas categorias aqui.</h5>

                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <!-- Advanced Tables -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                
                                <span>Categorias cadastradas.</span>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr> 
                                                
                                                <th>Nome da categoria</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($categorias as $item){?>
                                            <tr class="odd gradeX">
                                                <td><?=$item['nome_categoriacol']?></td>
                                                <td>
                                                    <a href="alterar_categoria.php?cod=<?= $item['id_categoria']?>" class="btn btn-warning btn-sm">Alterar</a>
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