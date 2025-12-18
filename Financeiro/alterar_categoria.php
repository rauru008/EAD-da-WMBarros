<?php
require_once '../DAO/UtillDAO.php';
UtillDAO::VerificarLogado();
require_once '../DAO/categoriaDAO.php';
$objDAO = new CategoriaDAO();
if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $id_categoria = $_GET['cod'];
    $dados = $objDAO->DetalharCategoria($id_categoria);

    if (count($dados) == 0) {
        header('location: consultar_categoria.php');
        exit;
    }
} else if (isset($_POST['btnGravar'])) {
    $id_categoria = $_POST['cod'];
    $nome = trim($_POST['nome']);

    $ret = $objDAO->AlteralCategoria($nome, $id_categoria);

    header('location: consultar_categoria.php?ret=' .$ret);
    exit;

} else if (isset($_POST['btnExcluir'])) {
    $id_categoria = $_POST['cod'];
    $ret = $objDAO->ExcluirCategoria($id_categoria);

    header('location: consultar_categoria.php?ret='.$ret);
    exit;
} else {
    header('location: consultar_categoria.php' );
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
                        <h2>Alterar Categoria</h2>
                        <h5>Aqui você pode <strong>alterar</strong> ou deletar suas categorias.</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="alterar_categoria.php">
                    <form method="post" action="alterar_categoria.php">
                        <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                        <div class="form-group">
                            <label>Nome</label>
                            <input value="<?= $dados[0]['nome_categoriacol'] ?>" class="form-control" name="nome" id="nome" placeholder="Digite o nome da categoria..." />
                        </div>
                        <button name="btnGravar" onclick="return ValidarCategoria()" type="submit" class="btn btn-success">Gravar</button>
                        <button type="button" data-toggle="modal" data-target="#modalExcluir"  class="btn btn-danger">Deletar</button>
                        <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header"> 
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                    </div>
                                    <div class="modal-body">
                                        Deseja excluir a categoria <b><?= $dados[0]['nome_categoriacol']?></b>  ?
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Não</button>
                                        <button type="submit" name="btnExcluir" class="btn btn-primary">Sim</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </form>

            </div>
        </div>
    </div>
</body>

</html>