<?php

//Controlador para autenticação



namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action {
	public function autenticar(){ //esse método é disparado pelo arquivo Route.php

		//acessa o Model para receber usuário
		$usuario = Container::getModel('Usuario');
		$usuario->__set('email', $_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));
		
		

		$usuario->autenticar();
		//aqui ele força o sistema a se existir um usuário cadastrado, ele ser redirecionado para a Timeline
		//Podemos criar aqui o redirecionamento dos professores e alunos (vai ser feita essa parte em AppController)
		if($usuario->__get('id')!='' && $usuario->__get('nome')!=''){

			session_start();

			$_SESSION['id']=$usuario->__get('id');
			$_SESSION['nome']=$usuario->__get('nome');
			header('Location: /painel'); 



		}else{
			header('Location: /?login=erro');
		}


		//echo "<pre>";
		//print_r($usuario);
		//echo "</pre>";
	}

	public function sair(){
		session_start();

		session_destroy();
		header('Location:/');
	}




}

?>