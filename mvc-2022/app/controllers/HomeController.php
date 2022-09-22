<?php

/**
 * home - Controller de exemplo
 * @author Cândido Farias
 * @package mvc
 * @since 0.1
 */
class HomeController extends MainController
{

	public function __construct(){
		parent::__construct();
		if(!isset($_SESSION['user'])){
			header("Location:".URL_BASE."users/login");
		}
	}

	/**
	 * Carrega a página "/views/home/index.php"
	 */
    public function index() {
		# Título da página
		$this->title = 'Home';

		$model=$this->load_model("Home");

		$mostrarValores=$model->lerValores();
		$data['home']=$mostrarValores;


	
		# Essa página não precisa de modelo (model)
		
		# Carrega os arquivos do view		
		$this->view->show('home/home', $data);
	
		
    } // index

	public function graficoInput(){

		$model=$this->load_model("Home");
		$dias=$model->input();
		$grafico['input']=$dias;
		/*$ano=[];
		$contAno=0;
		$mes=[];
		$contMes=0;
		$dia=[];
		$contDia=0;

		foreach ($dias as $mostra) {
			$data=$mostra['date']=;


			$dataExplode=explode("-", $data);
			$ano[$contAno++]=$dataExplode[0];
			$mes[$contMes++]=$dataExplode[1];
			$dia[$contDia++]=$dataExplode[2];


		}
	
		$datas=[
			0=>$ano,
			1=>$mes,
			2=>$dia
		];*/
		
		//print_r($diasExplode);
		$this->view->show('home/home', $grafico);

	}

	
		



}// class HomeController