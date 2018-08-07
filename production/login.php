<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../production/images/toga.ico" type="image/ico" />
        <title>Englobaweb</title>
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- Animate.css -->
        <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="extra/js/jquery.validate.js" type="text/javascript"></script>
        <script>
            $(document).ready(function () {
            //    $('#errolog').hide(); //Esconde o elemento com id errolog
//                $('#login_form').submit(function () { 	//Ao submeter formulário
//                    var login = $('#login').val(); //Pega valor do campo login
//                    var senha = $('#senha').val(); //Pega valor do campo senha
//                    $.ajax({//Função AJAX
//                        url: "../controller/validar_user.php", //Arquivo php
//                        type: "post", //Método de envio
//                        data: "login=" + login + "&senha=" + senha, //Dados
//                        success: function (result) {			//Sucesso no AJAX
//                            if (result == 0) {
//                                $('#errolog').hide();
//                            }
//                        }
//                    })
//                    return false; //Evita que a página seja atualizada
//                });
            });
        </script>  
    </head>

    <body class="login">
        <div>
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form id="login_form" method="POST" action="../controller/validar_user.php">
                            <h1>Login</h1>
                            <div>
                                <input type="text" name="login" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="password" name="senha" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default submit">Entrar</button>
                                <a class="reset_pass" href="#">Esqueceu sua senha?</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Ainda não possui uma conta?
                                    <a href="#signup" class="to_register"> Criar conta </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-mortar-board"></i> Englobaweb</h1>
                                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                    <?php if($_SESSION['login_inv'] == 1){ echo "<p>Login ou senha incorretos</p>";} ?>
                </div>

                <div id="register" class="animate form registration_form">
                    <section class="login_content">
                        <form id="cad_form" method="POST">
                            <h1>Criar conta</h1>
                            <div>
                                <input type="text" class="form-control" placeholder="Username" required="" />
                            </div>
                            <div>
                                <input type="email" class="form-control" placeholder="Email" required="" />
                            </div>
                            <div>
                                <input type="password" class="form-control" placeholder="Password" required="" />
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default submit">Cadastrar</button>
                            </div>

                            <div class="clearfix"></div>

                            <div class="separator">
                                <p class="change_link">Já é cadastrado?
                                    <a href="#signin" class="to_register"> Login </a>
                                </p>

                                <div class="clearfix"></div>
                                <br />

                                <div>
                                    <h1><i class="fa fa-mortar-board"></i> Englobaweb</h1>
                                    <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </body>
</html>
