<?php
session_start();
try {
    $login = $_POST['login']; //Pegando dados passados por AJAX
    $senha = $_POST['senha'];
    include_once dirname(__FILE__) . "/../config/conexao.php";
    $sql = "SELECT * FROM usuario WHERE login ='" . $login . "' AND senha='" . $senha . "'";
    $query = $pdo->query($sql);
    if ($query) {
        $sql_result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($sql_result as $key => $value) {
            foreach ($value as $chave => $valor) {
                $_SESSION[$chave] = $valor;
            }
        }
    }
    $num = $query->rowCount();
    if ($num == 0) {
        echo 0;
        exit;
    } elseif ($num > 0 && $_SESSION['nivel'] == '1') {
        echo 1;
        //session_start();
        $_SESSION['logado'] = TRUE;
        header("Location: ../production/index.php");
        exit;
    } elseif ($num > 0 && $_SESSION['nivel'] == '2') {
        echo 1;
        //session_start();
        $_SESSION['logado'] = TRUE;
        header("Location: ../production/index.php");
        exit;
    }elseif ($num > 0 && $_SESSION['nivel'] == '3') {
        echo 1;
        //session_start();
        $_SESSION['logado'] = TRUE;
        header("Location: ../production/index.php");
        exit;
    }elseif ($num > 0 && $_SESSION['nivel'] == '4') {
        echo 1;
        //session_start();
        $_SESSION['logado'] = TRUE;
        header("Location: ../production/index.php");
        exit;
    }elseif ($num > 0 && $_SESSION['nivel'] == '5') {
        echo 1;
        //session_start();
        $_SESSION['logado'] = TRUE;
        header("Location: ../production/index.php");
        exit;
    }elseif ($num > 0 && $_SESSION['nivel'] == '6') {
        echo 1;
        //session_start();
        $_SESSION['logado'] = TRUE;
        header("Location: ../production/index.php");
        exit;
    }
} catch (PDOException $error_select) {
    print "Erro!: " . $error_select->getMessage() . "<br/>";
    die();
}
//
//echo "id_user = " . $_SESSION['id_user'] . "<br />";
//echo "login = " . $_SESSION['login'] . "<br />";
//echo "senha = " . $_SESSION['senha'] . "<br />";
//print_r($sql_result);