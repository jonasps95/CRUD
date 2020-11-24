<?php 

session_start();
date_default_timezone_set('America/Sao_Paulo');

$autoload = function($class){
    include('classes/'.$class.'.php');
};

spl_autoload_register($autoload);


//Conecta Banco de Dados!
define('HOST','localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DBNAME', 'crud');

define('PATH_DEFAULT','http://localhost/Servidor/Meus%20Projetos/CRUD/');

define('BASE_DIR',__DIR__);

function pegaCargo($indice){
    return Control::$cargo[$indice];
}

function verificaPermissao($permissao){
    if($_SESSION['cargo'] >= $permissao){
        return;
    }else{
        echo 'style="display:none;"';
    }
}

function verificaPermissaoPagina($permissao){
    if($_SESSION['cargo'] >= $permissao){
        return;
    }else{
        include('views/permissao_negada.php');
        die();
    }
}