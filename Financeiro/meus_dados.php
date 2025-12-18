<?php
require_once '../DAO/usuarioDAO.php';
UtillDAO::VerificarLogado();
require_once '../DAO/UtillDAO.php';
$objDAO = new UsuarioDAO();
$info = $objDAO->CarregarMeusDados();
if (isset($_POST['btnGravar'])) {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);
    
    $ret = $objDAO->GravarMeusDados($nome, $email, $senha);
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
                        <h2>Meus Dados</h2>
                        <h5>Nesta página, você poderá alterar seus dados.</h5>
                    </div>
                </div>
                <hr />
                <form method="POST" action="meus_dados.php">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite seu nome..." name="nome" id="nomeUsuario" value="<?= $info[0]['nome_usuario'] ?>" maxlength="10"/>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" type="email" placeholder="Digite seu E-mail..." name="email" id="emailUsuario" value="<?= $info[0]['email_usuario'] ?>" maxlength="50"  />
                    </div>

                    <!-- Campo de senha com botão de olho -->
                    <div class="form-group">
                        <label>Senha</label>
                        <div style="position: relative;">
                            <input class="form-control" type="password" placeholder="Digite sua senha..." name="senha" id="senha" value="<?= $info[0]['senha_usuario'] ?>" maxlength="20"  />

                            <!-- Botão do olho -->
                            <button type="button" id="toggleSenha" title="Mostrar/Esconder Senha"
                                style="position: absolute; right: 10px; top: 6px; border: none; background: none; cursor: pointer;">
                                <img id="iconeOlho" src="https://cdn-icons-png.flaticon.com/512/709/709612.png"
                                    alt="Mostrar senha" width="22" />
                            </button>
                        </div>
                    </div>

                    <button name="btnGravar" onclick="return ValidarMeusDados()" type="submit" class="btn btn-success">Gravar</button>
                </form>
            </div>
        </div>
    </div>

    <script>

        // Função para mostrar/ocultar senha
        const senhaInput = document.getElementById('senha');
        const toggleBtn = document.getElementById('toggleSenha');
        const iconeOlho = document.getElementById('iconeOlho');

        toggleBtn.addEventListener('click', () => {
            const tipo = senhaInput.getAttribute('type') === 'password' ? 'text' : 'password';
            senhaInput.setAttribute('type', tipo);

            // Troca o ícone de olho aberto/fechado
            if (tipo === 'text') {
                iconeOlho.src = 'https://cdn-icons-png.flaticon.com/512/709/709524.png'; // olho aberto
                iconeOlho.alt = 'Esconder senha';
            } else {
                iconeOlho.src = 'https://cdn-icons-png.flaticon.com/512/709/709612.png'; // olho fechado
                iconeOlho.alt = 'Mostrar senha';
            }
        });
    </script>
</body>

</html>