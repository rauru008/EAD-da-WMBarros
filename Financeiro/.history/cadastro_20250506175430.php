<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php'
?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br /><br />
                <h2> Controle Finnceir: Cadastro</h2>

                <h5>( Faça seu cadastro )</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Preencher todos os campos </strong>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                                <input type="text" class="form-control" placeholder="Seu nome" />
                            </div>
                            
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="Your Email" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Crie uma senha (Mínimo de )" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Retype Password" />
                            </div>

                            <a href="index.html" class="btn btn-success ">Register Me</a>
                            <hr />
                            Already Registered ? <a href="login.html">Login here</a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>

</body>

</html>