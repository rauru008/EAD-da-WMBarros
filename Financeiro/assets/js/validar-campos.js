function ValidarLogin(){
    if($("#emailUsuario").val().trim() == ''){
        alert("Preencher o campo obrigatório E-MAIL!")
        $("#emailUsuario").focus();
        return false;
    }
    if ($("#senha").val().trim() == ''){
        alert("Preencher o campo obrigatório SENHA!")
        $("#senha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6){
        alert("A SENHA deve conter 6 e 8 caracteres!");
        $("#senha").focus();
        return false;
    }
}

function ValidarCadastro(){
    if ($("#nomeUsuario").val().trim() == ''){
        alert("Preencer o campo obrigatório NOME!");
        $("#nomeUsuario").focus();
        return false;
    }

    if ($("#emailUsuario").val().trim() == ''){
        alert("Preencer o campo obrigatório E-MAIL!");
        $("#emailUsuario").focus();
        return false;
    }
    if ($("#senha").val().trim() == ''){
        alert("Preencer o campo obrigatório SENHA!");
        $("#senha").focus();
        return false;
    }
    if ($("#repSenha").val().trim() == ''){
        alert("Preencer o campo obrigatório REPETIR SENHA!");
        $("#repSenha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6){
        alert("A SENHA deve conter 6 e 8 caracteres!");
        $("#senha").focus();
        return false;
    }
    if ($("#senha").val().trim() != $("#repSenha").val().trim()){
        alert("As senhas devem ser iguais!");
        $("#repSenha").focus();
        return false;
    }
}

function ValidarMeusDados(){
    if ($("#nomeUsuario").val().trim() == ''){
        alert("Preencher o campo obrigatório nome!");
        $("#nomeUsuario").focus();
        return false;
    }
    if ($("#emailUsuario").val().trim() == ''){
        alert("Preencher o campo obrigatório E-mail!")
        $("#emailUsuario").focus();
        return false;
    }
    if ($("#senha").val().trim() == ''){
        alert("Preencher o campo obrigatório senha!");
        $("#senha").focus();
        return false;
    }
    if ($("#senha").val().trim().length < 6){
        alert("A senha deve conter entre 6 ou 8 caracteres!");
        $("#senha").focus();
        return false;
    }
}

function ValidarCategoria(){
    if($("#nome").val().trim() == ''){
        alert("Preencher o campo obrigatório nome da categoria!");
        $("#nome").focus();
        return false;
    }
}
function ValidarEmpresa(){
    if($("#nomeEmp").val().trim() == ''){
        alert("Preencher o campo obrigatório nome da empresa!");
        $("#nomeEmp").focus();
        return false;
    }
    if($("#telefone").val().trim() == ''){
        alert("Preencher o campo obrigatório telefone!");
        $("#telefone").focus();
        return false;
    }
    if($("#endereco").val().trim() == ''){
        alert("Preencher o campo obrigatório endereço!");
        $("#endereco").focus();
        return false;
    }
}

function ValidarConta(){
    if($("#banco").val().trim() == ''){
        alert("Preencher o campo obrigatório nome do banco!");
        $("#banco").focus();
        return false;
    }
    if($("#agencia").val().trim() == ''){
        alert("Preencher o campo obrigatório nome da agência!");
        $("#agencia").focus();
        return false;
    }
    if($("#numero").val().trim() == ''){
        alert("Preencher o campo obrigatório número da conta!");
        $("#numero").focus();
        return false;
    }
    if($("#saldo").val().trim() == ''){
        alert("Preencher o campo obrigatório saldo!");
        $("#saldo").focus();
        return false;
    }
}
function RealizarMovimento(){
    if($("#tipo").val().trim() == ''){
        alert("Selecione um tipo de movimento!");
        $("#tipo").focus();
        return false;
    }
    if($("#data").val().trim() == ''){
        alert("Selecione uma data!");
        $("#data").focus();
        return false;
    }
    if($("#valor").val().trim() == ''){
        alert("Preencher o campo obrigatório valor!");
        $("#valor").focus();
        return false;
    }
    if($("#categoria").val().trim() == ''){
        alert("Selecione uma categoria financeira!");
        $("#categoria").focus();
        return false;
    }
    if($("#empresa").val().trim() == ''){
        alert("Selecione uma empresa!");
        $("#empresa").focus();
        return false;
    }
        if($("#conta").val().trim() == ''){
        alert("Selecione uma conta!");
        $("#conta").focus();
        return false;
    }
}
function ConsultarMovimento(){
    if($("#tipoMov").val().trim() == ''){
        alert("Selecione um tipo de movimento!");
        $("#tipoMov").focus();
        return false;
    }
    if($("#dtInicio").val().trim() == ''){
        alert("Selecione uma data de início!");
        $("#dtInicio").focus();
        return false;
    }
        if($("#dtFinal").val().trim() == ''){
        alert("Selecione uma data de fim!");
        $("#dtFinal").focus();
        return false;
    }
}