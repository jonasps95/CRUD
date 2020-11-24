<?php

    class Control{

        public static $cargo = [
            '0' => 'Funcionário',
            '1' => 'SubAdmin',
            '2' => 'Admin'];

        
        public static function logado(){
            return isset($_SESSION['login']) ? true : false;
        }

        public static function loggout(){
            session_destroy();
            header('Location: '.PATH_DEFAULT);
        }

        public static function carregarPagina(){
			if(isset($_GET['url'])){
				$url = explode('/',$_GET['url']);
				if(file_exists('controle/'.$url[0].'.php')){
					include('controle/'.$url[0].'.php');
				}else{
					//Página não existe!
					header('Location: '.PATH_DEFAULT);
				}
			}else{
				include('controle/home.php');
			}
		}

        public static function redirect($url){
            echo '<script>location.href="'.$url.'"</script>';
            die();
        }

        public static function uploadFile($file){
			$formatoArquivo = explode('.',$file['name']);
			$imagemNome = uniqid().'.'.$formatoArquivo[count($formatoArquivo) - 1];
			if(move_uploaded_file($file['tmp_name'],BASE_DIR.'/uploads/'.$imagemNome))
				return $imagemNome;
			else
				return false;
		}

        public static function deletefile($file){
            @unlink('uploads/'.$file);
        }

		public static function deletar($tabela,$parametro,$id=false){		
			
			$sql = MySql::conectar()->prepare("DELETE FROM `$tabela` WHERE $parametro = $id");
			
			$sql->execute();
		}
        /*
        Metodo especifico para selecionar apenas 1 registro.
		*/
		public static function select($table,$query = '',$arr = ''){
			if($query != false){
				$sql = MySql::conectar()->prepare("SELECT * FROM `$table` WHERE $query");
				$sql->execute($arr);
			}else{
				$sql = MySql::conectar()->prepare("SELECT * FROM `$table`");
				$sql->execute();
			}
			return $sql->fetch();
		}


    }