<?php
Class Template {
	
	private $config;
	function __construct($params) {
		$this->config = $params;
	}

	public function renderTemplate($template, $data){
		$templatesLocation = getcwd() . '/' . $this->config['default']['defaultLocation'];
		
		$loader = new Twig_Loader_Filesystem($templatesLocation);
		$twig = new Twig_Environment($loader, [
			'cache' => false,
			'debug' => true,
		]);
		$twig->addExtension(new Twig_Extension_Debug());
		
		echo $twig->render($template . '.html.twig', $data);
	}

}