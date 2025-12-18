<?php
require_once '../DAO/UtillDAO.php';

?>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="inicial.php" class="navbar-brand">Controle Financeiro</a>
    </div>
    <div style="color: white; padding: 15px 50px 5px 50px; float: right;
font-size: 16px;"><span>Olá <?= UtillDAO::NomeUsuario() ?> seja bem vindo! Dúvidas ligue para: (00) 99999-9999</span> 
</div>
</nav>