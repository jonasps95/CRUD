<?php
    if(isset($_GET['loggout'])){
        @Control::loggout();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link href="css/style.css" rel="stylesheet" />

</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-light bg-info">
            <a class="navbar-brand">LogoMarca</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link active" href="home">Visualizar <span class="sr-only">(current)</span></a>
                    <a class="nav-item nav-link active" href="cadastrar-produto">Adicionar Produto <span class="sr-only"></span></a>
                    <a <?php verificaPermissao(2) ?>class="nav-item nav-link active" href="cadastrar-usuario">Cadastrar Usuário <span class="sr-only"></span></a>
                    <a <?php verificaPermissao(2) ?>class="nav-item nav-link active" href="gerenciar-usuarios">Gerenciar Usuários <span class="sr-only"></span></a>
                    <a class="nav-item nav-link active" href="<?php echo PATH_DEFAULT ?>?loggout">Sair <span class="sr-only">(current)</span></a>
                </div>
            </div>
        </nav>
    </header>

    <?php
        Control::carregarPagina();
    ?>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
</body>
</html>