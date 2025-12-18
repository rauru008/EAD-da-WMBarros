<?php
require_once '../DAO/UtillDAO.php';
UtillDAO::VerificarLogado();
    require_once '../DAO/categoriaDAO.php';
    if(isset($_POST['btnGravar'])){
        $nome = trim($_POST['nome']);

        $objDAO = new CategoriaDAO();

        $ret = $objDAO->CadastrarCategoria($nome);
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
                        <h2>Nova Categoria</h2>
                        <h5>Aqui você pode <strong>cadastrar</strong> todas as suas categorias financeiras.</h5>
                    </div>
                </div>
                <hr />
                <form method="post" action="nova_categoria.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input value="<?= isset($nome) ? $nome : ''?>" class="form-control" name="nome" id="nome" placeholder="Digite o nome da categoria..." maxlength="45" />
                    </div>
                    <button name="btnGravar" onclick="return ValidarCategoria()" type="submit" class="btn btn-success">Gravar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>