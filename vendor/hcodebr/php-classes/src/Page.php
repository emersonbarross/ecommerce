<?php 

namespace Hcode;

use Rain\Tpl;

class Page
{

	private $tpl;
	private $options = [];
	private $defaults = [
		"data"=>[]
	];

	public function __construct($opts = array(), $tpl_dir = "/views/"){

		$this->options = array_merge($this->defaults, $opts); // O "array_merge" mescla os dados das duas arrays, mas se houver conflito os dados da array mais a direita se sobressai.

		$config = array(
			"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir, //Se for chamado na classe PageAdmin, sera a pasta de la, se não, sera a padrao.
			"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
			"debug"         => false
	    );

		Tpl::configure( $config );

		$this->tpl = new Tpl;

		$this->setData($this->options["data"]);

		$this->tpl->draw("header"); //irá chamar o arquivo para exibição do cabeçalho, será html.

	}

	private function setData($data = array())
	{

		foreach ($data as $key => $value) {
			$this->tpl->assign($key, $value);
		}

	}

	public function setTpl($name, $data = array(), $returnHTML = false) //Irá compor o corpo da pagina, 1º param nome, 2º param os dados ou variaveis que forem passadas, 3º se que exibir o conteudo passado, por padrão false.
	{

		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	}

	public function __destruct(){

		$this->tpl->draw("footer"); // Irá chamar em todas as paginas o rodape.

	}

}

 ?> 