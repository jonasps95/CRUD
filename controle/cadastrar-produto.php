<?php 
    verificaPermissaoPagina(1);
?>

<section>
    <div class="container">
        <div class="box-cad-user bg-info">
            <form method="post" enctype="multipart/form-data">
            
            <?php 
                if(isset($_POST['acao'])){
                    $nome = $_POST['nome'];
                    $categoria = $_POST['categoria'];
                    $descricao = $_POST['descricao'];
                    $preco = $_POST['preco'];
                    $imagem = $_FILES['imagem'];

                    if($nome == '' || $categoria == '' || $descricao == '' || $preco == '' || $imagem == ''){
                        echo '<div class="alert alert-primary" role="alert"> Campos Vazios não São Permitidos!</div>';
                    }else{
                        $produto = new Produto();
                        $imagem = Control::uploadFile($imagem);
                        $produto->cadastrarProduto($categoria,$nome,$descricao,$preco,$imagem);
                        echo '<div class="alert alert-primary" role="alert">Cadastro Realizado com sucesso!</div>';
                    }
                }
                
            ?>
                <div class="form-row">
                    <div class="form-group col-6">
                        <label>Categoria:</label>
                        <select name="categoria" class="form-control col-12">
                            <?php
                                $categorias = MySql::conectar()->prepare("SELECT * FROM `categoria` ");
                                $categorias->execute();
                                $categorias = $categorias->fetchAll();
                                
                                foreach ($categorias as $key => $value) { ?>
                                    <option value="<?php echo $value['id'] ?>"><?php echo $value['nome-categoria'] ?></option>
                               <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleFormControlFile1">Imagem do Produto</label>
                        <input type="file" name="imagem" class="form-control-file" id="exampleFormControlFile1">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Nome do Produto</label>
                        <input type="text" name="nome" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Preço</label>
                        <input type="float" name="preco" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label>Descrição</label>
                        <textarea name="descricao" class="form-control"></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <input style="max-height: 40px; margin-top: 30px;" type="submit" name="acao" value="Cadastrar" class="btn btn-primary">
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</section>