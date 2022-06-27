<?php


//Esse controlador serve para as restrições das páginas internas do sistema (no nosso caso, é aqui que vamos definir onde cada usuário vai poder ter acesso as coisas)

namespace App\Controllers;

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class AppController extends Action {
	public function painel(){ //esse método é disparado pelo arquivo Route.php


		$this->validaAutenticacao();//verifica se a sessão foi iniciada


			//Tratativa de recuperação dos Tweets
			//$tweet =Container::getModel('Tweet');

			//$tweet->__set('id_usuario',$_SESSION['id']);


			//$tweets = $tweet->getAll();

			


			//$this->view->tweets = $tweets;


			$this->render('painel'); // aqui ele renderiza para a página timeline (aqui)

}

	public function tweet(){
 

		$this->validaAutenticacao();//verifica se a sessão foi iniciada

			$tweet = Container::getModel('Tweet');   //instância do método já conectada com o Banco de dados
			$tweet-> __set('tweet',$_POST['tweet']);
			$tweet-> __set('id_usuario',$_SESSION['id']);

			$tweet->salvar();

			header('Location:/timeline');


	}
public function validaAutenticacao(){
	
	session_start();
	if(!isset($_SESSION['id'])||  $_SESSION['id'] == '' || !isset($_SESSION['nome']) ||  $_SESSION['nome'] == '' ){
		header('Location: /?login=erro');
		 //se a sessão não foi iniciada, ele força redirecionamento para login erro
	}
}
}
?>