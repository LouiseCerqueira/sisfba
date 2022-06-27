<?php

//Este controlador serve para a home e formulários de inscrição (no nosso caso para os cadastros e para os logins)


namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {
		//esse método é disparado pelo arquivo Route.php


		$this->view->login = isset($_GET['login']) ? $_GET['login'] : ''; //Isso faz com que o login seja recebido na url, é essa parte onde eu olho para a url e vejo se tudo está ok (se isso não for verdade, o parametro chamado na view do formulário e faz com que apareça uma mensagem de erro)


		$this->render('index');
	}
	public function inscreverse() {

		$this->view->usuario = array(
					'nome' => '',
					'email' => '',
					'senha' => '',
				);


		$this->view->erroCadastro = false;


		$this->render('inscreverse');
	}
	public function registrar() {



		// Receber dados
		$usuario = Container::getModel('Usuario');

		$usuario->__set('nome',$_POST['nome']);
		$usuario->__set('email',$_POST['email']);
		$usuario->__set('senha', md5($_POST['senha']));


		if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail()) == 0){

				$usuario->salvar();
				$this->render('cadastro');
				 //matricula 
				
			} else {

				$this->view->usuario = array(
					'nome' => $_POST['nome'],
					'email' => $_POST['email'],
					'senha' => $_POST['senha'],
				);

				$this->view->erroCadastro = true;


				$this->render('inscreverse');
			}

		//sucesso

		

		//erro
		
	}


}


?>