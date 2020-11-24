<?php 

    class Usuario{

        public function atualizarUsuario($user,$senha,$nome,$cargo){
			$sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET user = ?, password = ?, nome = ?, cargo =? WHERE id = ?");
			if($sql->execute(array($user,$senha,$nome,$cargo,$_GET['id']))){
				return true;
			}else{
				return false;
			}
		}

		public static function userExists($user){
			$sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user=?");
			$sql->execute(array($user));
			if($sql->rowCount() == 1)
				return true;
			else
				return false;
		}

		public static function cadastrarUsuario($user,$senha,$nome,$cargo){
			$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?)");
			$sql->execute(array($user,$senha,$nome,$cargo));
		}

    }