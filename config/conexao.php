<?php

//include_once "config.php";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=aluno_engloba","root","");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Não foi possível se conectar ao banco!' . '<br/>';
    die($e->getMessage());
}