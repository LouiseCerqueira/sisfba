<?php

namespace MF\Controller;

abstract class Action {

	protected $view;

	public function __construct() {
		$this->view = new \stdClass();
	}

	protected function render($view, $layout = 'layout') {
		$this->view->page = $view;

		if(file_exists("../App/Views/".$layout.".phtml")) {
			require_once "../App/Views/".$layout.".phtml";
		} else {
			$this->content();
		}
	}

	protected function content() {
		$classAtual = get_class($this);

		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);

		$classAtual = strtolower(str_replace('Controller', '', $classAtual));

		require_once "../App/Views/".$classAtual."/".$this->view->page.".phtml";
	}
}

//classAtual pega o nome da class sem o controller para que o sistema possa acessar esses arquivos dentro das partas que estão dentro do diretório View, isso significa que para cada controller (no caso da autenticação não foi necessário) temos que ter uma pasta nomeada com o nome da classe de controle. Para IndexController temos  View\index, para AppController temos View\app e assim por diante


?>
