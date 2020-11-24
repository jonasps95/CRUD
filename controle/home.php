<?php 

    if(isset($_GET['excluir'])){
        $idExcluir = intval($_GET['excluir']);
        $selectImagem = MySql::conectar()->prepare("SELECT foto FROM `produto` WHERE id_produto = ?");
        $selectImagem->execute(array($idExcluir));

        $imagem = $selectImagem->fetch()['foto'];
        Control::deleteFile($imagem);
        Control::deletar('produto','id_produto',$idExcluir);
        Control::redirect(PATH_DEFAULT.'home');
    }

    $categorias = MySql::conectar()->prepare("SELECT * FROM `categoria`");
    $categorias->execute();
    $categorias = $categorias->fetchAll();

    $precos = MySql::conectar()->prepare("select min(preco), max(preco) from `produto`");
    $precos->execute();
    $precos = $precos->fetch();

    $maxValor = ($precos[1] + 1);
    $minValor = ($precos[0] - 1);

?>

    <section>
        <div class="filtro bg-info">
            <div class="container">
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <span style="font-weight: bold;">Filtro: </span>
                            <label>Categoria</label>
                            <select name="busca-categoria" class="form-control ">
                                <option selected value="" >Todas</option>
                                <?php 
                                    foreach ($categorias as $key => $value) { ?>
                                    <option value="<?php echo $value['id'];?>"><?php echo $value['nome-categoria'];?></option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="inputNome">Nome</label>
                            <input type="text" name="busca-nome" class="form-control" id="inputNome">
                        </div>
                        <div class="form-group col-md-2">
                            <label>Menor Preço</label>
                            <input type="range" name="busca-min-valor" value="0" min="<?php echo $minValor ;?>" max="<?php echo $maxValor; ?>" class="form-control-range" oninput="display1.value=value" onchange="display1.value=value">
                            <span>R$</span><input style="max-width: 50px;" type="text" id="display1" value="0" readonly>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Maior Preço</label>
                            <input type="range" name="busca-max-valor" value="<?php echo $maxValor ?>" min="<?php echo $minValor; ?>" max="<?php echo $maxValor;?>" class="form-control-range" oninput="display2.value=value" onchange="display2.value=value">
                            <span>R$</span><input style="max-width: 50px;" type="text" id="display2" value="0" readonly>
                        </div>
                        <input style="max-height: 40px; margin-top: 10px;" type="submit" name="filtrar" value="Buscar" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Nome:</th>
                    <th scope="col">Categoria:</th>
                    <th scope="col">Preço (R$)</th>
                    <th scope="col">Imagem</th>
                    <th <?php verificaPermissao(1) ?> scope="col">Admin</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    //SE EXISTE FILTRO FILTRO DE BUSCA!
                    if(isset($_POST['filtrar'])){
                        $buscaCategoria = $_POST['busca-categoria'];
                        $buscaNome = $_POST['busca-nome'];
                        $buscaMinValor = $_POST['busca-min-valor'];
                        $buscaMaxValor = $_POST['busca-max-valor'];
                                    
                        if($buscaCategoria != '' && $buscaNome == ''){
                            $produtos = MySql::conectar()->prepare("SELECT * FROM `produto` INNER JOIN `categoria` ON (categoria.id=produto.categoria_id) WHERE categoria_id = $buscaCategoria AND preco BETWEEN $buscaMinValor AND $buscaMaxValor");
                            $produtos->execute();
                            $produtos = $produtos->fetchAll();
                        }elseif($buscaNome != '' && $buscaCategoria == ''){
                            $produtos = MySql::conectar()->prepare("SELECT * FROM `produto` INNER JOIN `categoria` ON (categoria.id=produto.categoria_id) WHERE nome LIKE '%$buscaNome%' AND preco BETWEEN $buscaMinValor AND $buscaMaxValor");
                            $produtos->execute();
                            $produtos = $produtos->fetchAll();
                        }elseif($buscaNome != '' && $buscaCategoria != ''){
                            $produtos = MySql::conectar()->prepare("SELECT * FROM `produto` INNER JOIN `categoria` ON (categoria.id=produto.categoria_id) WHERE categoria_id = $buscaCategoria AND nome LIKE '%$buscaNome%' AND preco BETWEEN $buscaMinValor AND $buscaMaxValor");
                            $produtos->execute();
                            $produtos = $produtos->fetchAll();
                        }else{
                            $produtos = MySql::conectar()->prepare("SELECT * FROM `produto` INNER JOIN `categoria` ON (categoria.id=produto.categoria_id) WHERE preco BETWEEN $buscaMinValor AND $buscaMaxValor");
                            $produtos->execute();
                            $produtos = $produtos->fetchAll();
                        }

                    }else{
                        $produtos = MySql::conectar()->prepare("SELECT * FROM `produto` INNER JOIN `categoria` ON (categoria.id=produto.categoria_id)");
                        $produtos->execute();
                        $produtos = $produtos->fetchAll();
                    }
                    foreach ($produtos as $key => $value) {   ?>
                        <tr>
                            <th scope="row"><?php echo $value['id_produto']; ?></th>
                            <td><?php echo $value['nome']; ?></td>
                            <td><?php echo $value['nome-categoria']; ?></td>
                            <td><?php echo $value['preco']; ?></td>
                            <td><a data-fancybox="gallery" href="<?php echo PATH_DEFAULT ?>uploads/<?php echo $value['foto'] ?>">Ver Imagem</a></td>
                            <td <?php verificaPermissao(1) ?>>
                                <a href="editar-produto?id=<?php echo $value['id_produto']; ?>">edit </a>
                                <a href="home?excluir=<?php echo $value['id_produto']?>" onclick="return confirm('Tem certeza que deseja deletar este registro?')"> exc</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </section>