<?php 
    verificaPermissaoPagina(2);
?>

<section>
    <div class="container">
        <div class="box-cad-user bg-info">
            <form method="post">
            
            <?php 
                if(isset($_POST['acao'])){
                    $cargo = $_POST['cargo'];
                    $user = $_POST['user'];
                    $nome = $_POST['nome'];
                    $senha = $_POST['senha'];

                    if($cargo == '' || $nome == '' || $senha == ''){
                        echo '<div class="alert alert-primary" role="alert"> Campos Vazios não São Permitidos!</div>';
                    }else if(Usuario::userExists($user)){
                        echo '<div class="alert alert-primary" role="alert"> Usuário já existe!</div>';
                    }else{
                        $usuario = new Usuario();
                        $usuario->cadastrarUsuario($user,$senha,$nome,$cargo,);
                        echo '<div class="alert alert-primary" role="alert">Cadastro Realizado com sucesso!</div>';
                    }
                }
                
            ?>
                <div class="form-row">
                    <div class="form-group col-12">
                        <label>Cargo:</label>
                        <select name="cargo" class="form-control ">
                            <?php
                                foreach (Control::$cargo as $key => $value) {
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputNome">Nome do Funcionário</label>
                        <input type="text" name="nome" class="form-control" id="inputNome">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputUser">User</label>
                        <input type="text" name="user" class="form-control" id="inputUser">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="inputSenha">Senha!</label>
                        <input type="password" name="senha" class="form-control" id="inputSenha">
                    </div>
                    <div class="form-group col-md-6">
                        <input style="max-height: 40px; margin-top: 30px;" type="submit" name="acao" value="Cadastrar" class="btn btn-primary">
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</section>