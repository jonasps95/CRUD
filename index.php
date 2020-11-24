<?php

include('config.php');

if(Control::logado() == false){
    include('views/login.php');
}else{
    include('views/main.php');
}
