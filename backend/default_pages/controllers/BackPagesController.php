<?php
namespace backend\default_pages\controllers;
use includes\common\NewInstance;
use backend\default_pages\models\BackPagesModel;

class BackPagesController extends BasePagesController {
	use NewInstance;
	public $model;
	public function __construct(){
		parent::__construct();
	    $this->model = BackPagesModel::newInstance();
		
	}
	public function action( ) {
		// TODO: Implement action() method.
		
	}
	
	
	public function render( ) {
		// TODO: Implement render() method.
	
		
	}

	
	
}