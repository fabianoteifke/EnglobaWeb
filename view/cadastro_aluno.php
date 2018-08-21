<?php
session_start();
include_once dirname(__FILE__) . "/../config/conexao.php";
if ($_SESSION['logado'] <> TRUE) {
    session_destroy();
    header("location: ../production/login.php");
}
include_once '../model/Instituicao.class.php';

if ($_POST) {
    print_r($_POST);
    if (isset($_POST["nome"]) && isset($_POST["sobrenome"]) && isset($_POST["cpf"]) && isset($_POST["fone"]) && isset($_POST["endereco"]) && isset($_POST["matricula"]) && isset($_POST["curso"]) && isset($_POST["cidade"]) && isset($_POST["estado"])) {
        $user = new Usuario();
        $user->setNome($_POST["nome"]);
        $user->setSenha("123");
        $user->setLogin($_POST["matricula"]);
        $user->setNivel(6);
        $user->setInstituicao($_SESSION['instituicao']);
        $user->setEmail($_POST['email']);
        $user->setData_nasc($_POST['data_nasc']);
        $user->setSexo($_POST['sexo']);
        $msg = $user->salvar();
        
        $res = $pdo->prepare("SELECT max(id_usuario) FROM usuario");
        $res->execute();
        $res = $res->fetch(PDO::FETCH_ASSOC);
        echo $res['max(id_usuario)'];
        $aluno = new Aluno();
        $aluno->setSobrenome($_POST["sobrenome"]);
        $aluno->setCpf($_POST["cpf"]);
        $aluno->setTelefone($_POST["fone"]);
        $aluno->setEndereco($_POST["endereco"]);
        $aluno->setMatricula($_POST["matricula"]);
        $aluno->setCurso($_POST["curso"]);
        $aluno->setCidade($_POST["cidade"]);
        $aluno->setEstado($_POST["estado"]);
        $aluno->setId_usuario($res['max(id_usuario)']);
        if (empty($_POST["id"])) {
            $msg = $aluno->salvar();
        }
        if (isset($msg)) {
            if (!$msg) {
                $erro = "Ocorreu um erro no registro do emprego!";
            } else {
                $msg = "Emprego cadastrado com sucesso!";
                header("location: gerenciar_aluno.php");
            }
        }
    } else {
        $erro = "Houve um erro no envio do formulário";
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
        <link rel="icon" href="../production/images/toga.ico" type="image/ico" />
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
        <script type="text/javascript">

            $(document).ready(function () {

                $.getJSON('estados_cidades.json', function (data) {
                    var items = [];
                    var options = '<option value="">escolha um estado</option>';
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

            });

        </script>
    </head>
    <?php
    include_once 'menu.php';
    ?>

    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Cadastrar Alunos</h3>
                </div>

                <div class="title_right">
                    <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Pesquise aqui...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Ir!</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_content">
                            <br />
                            <form id="demo-form2" method="post" data-parsley-validate class="form-horizontal form-label-left">

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome">Nome <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="nome" name="nome" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sobrenome">Sobrenome <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="sobrenome" name="sobrenome" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo *:</label>
                                <p>
                                    M:
                                    <input type="radio" class="flat" name="sexo" id="M" value="M" checked="" required /> F:
                                    <input type="radio" class="flat" name="sexo" id="F" value="F" />
                                </p>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="estado">Estado:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="estados" class="form-control col-md-7 col-xs-12" name="estado">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cidade">Cidade:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="cidades" class="form-control col-md-7 col-xs-12" name="cidade">
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fone">Endereco <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="endereco" name="endereco" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="fone">Telefone <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="fone" name="fone" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="matricula">Matricula <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" id="matricula" name="matricula" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cpf">CPF <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cpf" name="cpf" required="required" class="form-control col-md-7 col-xs-12" placeholder="Informe o CPF">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="curso">Curso <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="curso" name="curso" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">E-mail <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" placeholder="Informe o Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Data de Nascimento <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="data_nasc" name="data_nasc" class="date-picker form-control col-md-7 col-xs-12" required="required" type="text">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button class="btn btn-primary" type="button">Cancelar</button>
                                        <button class="btn btn-primary" type="reset">Limpar Campos</button>
                                        <button type="submit" class="btn btn-success">Enviar</button>
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
<script>
            function init() {
                $('#estados').select2();
                $('#cidades').select2();

                $.getJSON('estados_cidades.json', function (data) {
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
            ;
            $(document).ready(init);
</script>
</body>
</html>
