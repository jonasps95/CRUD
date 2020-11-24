<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />

</head>
<body>
    <section>
        <?php 
            if(isset($_POST['acao'])){
                $user = $_POST['user'];
                $password = $_POST['password'];
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ? AND password = ?");
                $sql->execute(array($user,$password));
                if($sql->rowCount() == 1){
                    $info = $sql->fetch();
                    //logamos com sucesso
                    $_SESSION['login'] = true;
                    $_SESSION['user'] = $user;
                    $_SESSION['password'] = $password;
                    $_SESSION['cargo'] = $info['cargo'];
                    $_SESSION['nome'] = $info['nome'];

                    Control::redirect(PATH_DEFAULT);
                }else{
                    echo 'usuário ou senha incorretos';
                }
            }
        ?>
        <div class="container">
            <div class="box-login">
                <h2>Faça Login:</h2>
                <form method="POST">
                    <div class="form-group">
                        <label for="user">User</label>
                        <input type="text" name="user" class="form-control" id="user">
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha</label>
                        <input type="password" name="password" class="form-control" id="senha">
                    </div>
                    <input type="submit" name="acao" value="Logar!" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>