<?php 
    verificaPermissaoPagina(1);

	if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $valor = Control::select('produto','id_produto = ?',array($id));
	}else{
        echo '<div class="alert alert-primary" role="alert">Você precisa passar o parametro ID.</div>';
		die();
    }

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
                    $imagem_atual = $_POST['imagem_atual'];

                    if($imagem['name'] != ''){
                        //Existe upload de imagem
                        Control::deleteFile($imagem_atual);
						$imagem = Control::uploadFile($imagem);
                        $produto = new Produto();
                        $produto->atualizarProduto($categoria,$nome,$descricao,$preco,$imagem);
                        $valor = Control::select('produto','id_produto = ?',array($id));
                        echo '<div class="alert alert-primary" role="alert">Produto Atualizado com sucesso!</div>';
                    }else{
                        $imagem = $imagem_atual;
                        $produto = new Produto();
                        $produto->atualizarProduto($categoria,$nome,$descricao,$preco,$imagem);
                        $valor = Control::select('produto','id_produto = ?',array($id));
                        echo '<div class="alert alert-primary" role="alert">Produto Atualizado com sucesso!</div>';
                    }
                }else{

                }
                
            ?>
                 <div class="form-row">
                    <div class="form-group col-6">
                        <label>Categoria:</label>
                        <select name="categoria" class="form-control col-12">
                            <option value="<?php echo $valor['categoria_id']; ?>">Categoria Atual</option>
                            <?php
                                $categorias = MySql::conectar()->prepare("SELECT * FROM `categoria` ");
                                $categorias->execute();
                                $categorias = $categorias->fetchAll();
                                
                                foreach ($categorias as $key => $value) { ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['nome-categoria'] ;?></option>
                               <?php } ?>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Imagem do Produto</label>
                        <input type="file" name="imagem" class="form-control-file">
                        <input type="hidden" name="imagem_atual" value="<?php echo $valor['foto']; ?>">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Nome do Produto</label>
                        <input type="text" value="<?php echo $valor['nome']; ?>" name="nome" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label>Preço</label>
                        <input type="float" value="<?php echo $valor['preco']; ?>" name="preco" class="form-control">
                    </div>
                    
                    <div class="form-group col-md-12">
                        <label>Descrição</label>
                        <textarea name="descricao" value="<?php echo $valor['descricao']; ?>" class="form-control"><?php echo $valor['descricao']; ?></textarea>
                    </div>

                    <div class="form-group col-md-6">
                        <input style="max-height: 40px; margin-top: 30px;" type="submit" name="acao" value="Cadastrar" class="btn btn-primary">
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</section>