<?php

    class Produto{

        public function atualizarProduto($categoria,$nome,$descricao,$preco,$imagem){
			$sql = MySql::conectar()->prepare("UPDATE `produto` SET categoria_id = ?, nome = ?, descricao = ?, preco = ?, foto = ? WHERE id_produto = ?");
			if($sql->execute(array($categoria,$nome,$descricao,$preco,$imagem,$_GET['id']))){
				return true;
			}else{
				return false;
			}
		}

		public static function cadastrarProduto($categoria,$nome,$descricao,$preco,$imagem){
			$sql = MySql::conectar()->prepare("INSERT INTO `produto` VALUES (null,?,?,?,?,?)");
			$sql->execute(array($categoria,$nome,$descricao,$preco,$imagem));
		}
    }