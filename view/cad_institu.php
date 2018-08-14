<?php
session_start();
include_once dirname(__FILE__) . "/../config/conexao.php";
if($_GET){
$h = $_GET['h'];
if (!empty($h)) {
    //$pdo->query("UPDATE user_temporario SET email='$mail'");
} else {
    echo 'erro no cadastro';
}
}
include_once '../model/Instituicao.class.php';
$user = new usuario();
$inst = new Instituicao();
$mod = new modulo();
if ($_POST) {
    //Verifica a existência dos campos no POST do formulário
    if (isset($_POST["nome"]) && isset($_POST["email"]) && isset($_POST["senha"])) {
        $login = $_POST['login'];
        $sql = $pdo->prepare("SELECT * FROM usuario WHERE login = '" . $login . "' ");
        $sql->execute();
        $num = $sql->rowCount();
        if ($num === 0) {

            $mod->setCurso($_POST['curso']);
            $mod->setDocumentos($_POST['documentos']);
            $mod->setTamanho(4);
            $msg = $mod->salvar();

            $res = $pdo->prepare("SELECT max(id_modulo) FROM modulos");
            $res->execute();
            $res = $res->fetch(PDO::FETCH_ASSOC);

            $inst->setCidade($_POST['cidade']);
            $inst->setEstado($_POST['estado']);
            $inst->setEndereco($_POST['endereco']);
            $inst->setNome($_POST['nome_institu']);
            $inst->setModulo($res['max(id_modulo)']);
            $inst->setValor(2);
            $msg = $inst->salvar();

            $res = $pdo->prepare("SELECT max(id_institu) FROM instituicao");
            $res->execute();
            $res = $res->fetch(PDO::FETCH_ASSOC);
            
            $user->setNome($_POST["nome"]);
            $user->setSenha($_POST["senha"]);
            $user->setNivel($_POST["nivel"]);
            $user->setInstituicao($res['max(id_institu)']);
            $res = $pdo->prepare("SELECT * FROM user_temporario WHERE MD5(id) = '$h'");
            $res->execute();
            $res = $res->fetch(PDO::FETCH_ASSOC);
            $user->setEmail($res['email']);
            $user->setData_nasc($_POST['data_nasc']);
            $user->setSexo($_POST['sexo']);
            $msg = $user->salvar();

            if (isset($msg)) {
                if (!$msg) {
                    $erro = "Ocorreu um erro no registro do usuário!";
                } else {
                    $msg = "Usuário cadastrado com sucesso!";
                }
            }
        } elseif ($num <> 0) {
            $msgimgerro = "Este email já está cadastrado";
        }
    } else {
        $erro = "Houve um erro no envio do formulário, verifique se TODOS os campos estão preenchidos corretamente";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>EnglobaWeb</title>

        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- iCheck -->
        <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
        <!-- bootstrap-wysiwyg -->
        <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
        <!-- starrr -->
        <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
    </head>
    <?php
    include_once 'menu.php';
    ?>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Termine seu cadastro</h3>
                </div>
                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <!--  <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button">Go!</button>
                            </span>
                          </div> -->
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Formulário de cadastro <small>falta apenas esta etapa</small></h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="post" action="cad_institu.php">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nome da instituição <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="name_inst" name="name_inst" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="estado" required="required" id="estados">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Cidade <span class="required">*</span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="cidade" required="required" id="cidades">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Endereço da instituição <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="last-name" name="endereco" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Vai querer um repositório de documentos?</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                        <div class="">
                                            <label>
                                                <input type="checkbox" class="js-switch" value="repositorio" checked /> Repositório de documentos
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Tipo de instituição</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div id="gender" class="btn-group" data-toggle="buttons">
                                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="gender" value="1"> &nbsp; Cursos e turmas &nbsp;
                                            </label>
                                            <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                                <input type="radio" name="gender" value="0"> Apenas turmas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="nome" class="control-label col-md-3 col-sm-3 col-xs-12">Seu nome</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="nome" class="form-control col-md-7 col-xs-12" type="text" name="nome">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="login" class="control-label col-md-3 col-sm-3 col-xs-12">Login</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="login" class="form-control col-md-7 col-xs-12" type="text" name="login">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="senha" class="control-label col-md-3 col-sm-3 col-xs-12">Senha</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="senha" class="form-control col-md-7 col-xs-12" type="password" name="senha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="senha2" class="control-label col-md-3 col-sm-3 col-xs-12">Confirmar senha</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="senha2" class="form-control col-md-7 col-xs-12" type="password" name="senha2">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <p>
                                            M:
                                            <input type="radio" class="flat" name="sexo" id="genderM" value="M" checked="" required /> F:
                                            <input type="radio" class="flat" name="sexo" id="genderF" value="F" />
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de nascimento</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" data-inputmask="'mask': '99/99/9999'">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary" type="button">Cancel</button>
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                        <button type="submit" class="btn btn-success">Submit</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /page content -->

    <!-- footer content -->
    <footer>
        <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
        </div>
        <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->
</div>
</div>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="../vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="../vendors/nprogress/nprogress.js"></script>
<!-- bootstrap-progressbar -->
<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
<!-- iCheck -->
<script src="../vendors/iCheck/icheck.min.js"></script>
<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="../vendors/starrr/dist/starrr.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script type="text/javascript" src="jquery-1.7.1.min.js"></script>
<script>
    function init() {
        $("#formulario").validate({
            rules: {
                cpf: {cpf: true, required: true}
            },
            messages: {
                cpf: {cpf: 'CPF inválido'}
            }
            , submitHandler: function (form) {
                form.submit();
            }
        });

        $('#estados').select2();
        $('#cidades').select2();
        $.getJSON('../vendors/estados_cidades.json', function (data) {
            var items = [];
            var options = '<option value="">Escolha um estado</option>';
            $.each(data, function (key, val) {
                options += '<option value="' + val.nome + '">' + val.nome + '</option>';
            });
            $("#estados").html(options);

            $("#estados").change(function () {

                var options_cidades = '';
                var str = "";

                $("#estados option:selected").each(function () {
                    str += $(this).text();
                });

                $.each(data, function (key, val) {
                    if (val.nome == str) {
                        $.each(val.cidades, function (key_city, val_city) {
                            options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                        });
                    }
                });
                $("#cidades").html(options_cidades);

            }).change();

        });
    }
    $(document).ready(init);
</script>

</body>
</html>
